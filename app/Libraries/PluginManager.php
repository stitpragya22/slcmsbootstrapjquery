<?php

namespace App\Libraries;

use App\Models\CmsPluginModel;
use ZipArchive;

class PluginManager
{
    private string $pluginsPath;
    private CmsPluginModel $model;

    public function __construct()
    {
        $this->pluginsPath = ROOTPATH . 'plugins/';
        if (!is_dir($this->pluginsPath) && is_dir(ROOTPATH . 'Plugins/')) {
            $this->pluginsPath = ROOTPATH . 'Plugins/';
        } elseif (!is_dir($this->pluginsPath)) {
            mkdir($this->pluginsPath, 0755, true);
        }
        $this->model = new CmsPluginModel();
    }

    public function getPluginsPath(): string
    {
        return $this->pluginsPath;
    }

    /**
     * Scan the plugins directory and synchronize with database registry
     */
    public function scanAndSync(): array
    {
        $dirs1 = glob(ROOTPATH . 'plugins/*', GLOB_ONLYDIR) ?: [];
        $dirs2 = glob(ROOTPATH . 'Plugins/*', GLOB_ONLYDIR) ?: [];
        $dirs = array_unique(array_merge($dirs1, $dirs2));
        $installed = [];

        foreach ($dirs as $dir) {
            $slug = basename($dir);
            $manifestFile = $dir . '/plugin.json';

            if (!file_exists($manifestFile)) {
                continue;
            }

            $manifest = json_decode((string) file_get_contents($manifestFile), true);
            if (!is_array($manifest) || empty($manifest['name'])) {
                continue;
            }

            $record = $this->model->where('slug', $slug)->first();
            $data = [
                'slug'        => $slug,
                'name'        => $manifest['name'] ?? ucfirst($slug),
                'version'     => $manifest['version'] ?? '1.0.0',
                'description' => $manifest['description'] ?? '',
                'author'      => $manifest['author'] ?? 'Community Developer',
                'author_url'  => $manifest['author_url'] ?? '',
                'icon'        => $manifest['icon'] ?? 'plug',
                'category'    => $manifest['category'] ?? 'General',
            ];

            if ($record) {
                $this->model->update($record['id'], $data);
                $data['id'] = $record['id'];
                $data['is_active'] = (int) $record['is_active'];
            } else {
                $data['is_active'] = 0;
                $data['id'] = $this->model->insert($data);
            }

            $installed[] = $data;
        }

        return $installed;
    }

    /**
     * Get all installed plugins from database
     */
    public function getInstalledPlugins(): array
    {
        $this->scanAndSync();
        return $this->model->orderBy('name', 'ASC')->findAll();
    }

    /**
     * Activate a plugin
     */
    public function activate(string $slug): bool
    {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
        $record = $this->model->where('slug', $slug)->first();

        if (!$record) {
            return false;
        }

        $this->model->update($record['id'], ['is_active' => 1]);

        // Legacy .active file support
        $activeFile = $this->pluginsPath . $slug . '/.active';
        @file_put_contents($activeFile, '1');

        // Execute plugin lifecycle hook if available
        $this->executeLifecycle($slug, 'onActivate');

        Hook::doAction('slcms.plugin.activated', $slug);
        return true;
    }

    /**
     * Deactivate a plugin
     */
    public function deactivate(string $slug): bool
    {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
        $record = $this->model->where('slug', $slug)->first();

        if (!$record) {
            return false;
        }

        $this->model->update($record['id'], ['is_active' => 0]);

        $activeFile = $this->pluginsPath . $slug . '/.active';
        @file_put_contents($activeFile, '0');

        $this->executeLifecycle($slug, 'onDeactivate');

        Hook::doAction('slcms.plugin.deactivated', $slug);
        return true;
    }

    /**
     * Completely uninstall a plugin (drops files and records)
     */
    public function uninstall(string $slug): bool
    {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
        $record = $this->model->where('slug', $slug)->first();

        if ($record) {
            $this->executeLifecycle($slug, 'onUninstall');
            $this->model->delete($record['id']);
        }

        $targetDir = $this->pluginsPath . $slug;
        if (is_dir($targetDir)) {
            $this->deleteDirectory($targetDir);
        }

        Hook::doAction('slcms.plugin.uninstalled', $slug);
        return true;
    }

    /**
     * Install a plugin from an uploaded ZIP archive
     */
    public function installFromZip(string $zipTempPath): array
    {
        $zip = new ZipArchive();
        if ($zip->open($zipTempPath) !== true) {
            return ['success' => false, 'message' => 'Unable to open ZIP archive.'];
        }

        // Search for plugin.json in zip
        $manifestPathInZip = null;
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $filename = $zip->getNameIndex($i);
            if (basename($filename) === 'plugin.json') {
                $manifestPathInZip = $filename;
                break;
            }
        }

        if (!$manifestPathInZip) {
            $zip->close();
            return ['success' => false, 'message' => 'Invalid plugin package: missing plugin.json manifest.'];
        }

        $manifestContent = $zip->getFromName($manifestPathInZip);
        $manifest = json_decode((string) $manifestContent, true);

        if (!is_array($manifest) || empty($manifest['name'])) {
            $zip->close();
            return ['success' => false, 'message' => 'Invalid plugin.json manifest file.'];
        }

        // Determine destination slug
        $prefix = dirname($manifestPathInZip);
        $slug = !empty($manifest['slug']) ? $manifest['slug'] : (!empty($prefix) && $prefix !== '.' ? basename($prefix) : preg_replace('/[^a-zA-Z0-9_-]/', '', strtolower($manifest['name'])));
        $destDir = $this->pluginsPath . $slug;

        if (!is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }

        // Safe extraction
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $entry = $zip->getNameIndex($i);

            // Prevent directory traversal
            if (str_contains($entry, '../') || str_contains($entry, '..\\')) {
                continue;
            }

            // Strip prefix if extracted from subdirectory
            $relativePath = $entry;
            if ($prefix !== '.' && str_starts_with($entry, $prefix . '/')) {
                $relativePath = substr($entry, strlen($prefix) + 1);
            }

            if (empty($relativePath)) {
                continue;
            }

            $target = $destDir . '/' . $relativePath;
            if (str_ends_with($entry, '/')) {
                if (!is_dir($target)) {
                    mkdir($target, 0755, true);
                }
            } else {
                $targetParent = dirname($target);
                if (!is_dir($targetParent)) {
                    mkdir($targetParent, 0755, true);
                }
                file_put_contents($target, $zip->getFromIndex($i));
            }
        }

        $zip->close();

        // Register in database
        $this->scanAndSync();

        return [
            'success' => true,
            'slug'    => $slug,
            'name'    => $manifest['name'],
            'message' => "Plugin '{$manifest['name']}' installed successfully!",
        ];
    }

    /**
     * Boot all active plugins: registers routes, hooks, menus
     */
    public function bootActivePlugins(): void
    {
        $activePlugins = $this->model->where('is_active', 1)->findAll();

        foreach ($activePlugins as $plugin) {
            $slug = $plugin['slug'];
            $dir = $this->pluginsPath . $slug;

            if (!is_dir($dir)) {
                continue;
            }

            // 1. Load routes if exists
            $routesFile = $dir . '/routes.php';
            if (file_exists($routesFile)) {
                include_once $routesFile;
            }

            // 2. Boot main Plugin class if exists
            $this->executeLifecycle($slug, 'boot');
        }
    }

    /**
     * Curated Online Marketplace Catalog Feed
     */
    public function getMarketplaceCatalog(): array
    {
        $installedSlugs = array_column($this->model->findAll(), 'slug');

        $catalog = [
            [
                'slug'        => 'seo-optimizer',
                'name'        => 'SEO Master & Sitemap Generator',
                'version'     => '1.2.0',
                'description' => 'Automatic XML sitemap generation, OpenGraph social meta tags, and robots.txt editor.',
                'author'      => 'Stitpragya Technologies',
                'author_url'  => 'https://stitpragya.in',
                'icon'        => 'search',
                'category'    => 'SEO & Marketing',
                'rating'      => 4.9,
                'downloads'   => '1,420',
                'price'       => 'Free',
            ],
            [
                'slug'        => 'stripe-payments',
                'name'        => 'Stripe & Razorpay Checkout Gateway',
                'version'     => '2.0.1',
                'description' => 'Accept debit/credit cards, UPI, and subscriptions with automated webhook transaction recording.',
                'author'      => 'SLCMS Core Team',
                'author_url'  => 'https://slcms.stitpragya.in',
                'icon'        => 'credit-card',
                'category'    => 'E-Commerce & Payments',
                'rating'      => 4.8,
                'downloads'   => '2,150',
                'price'       => 'Free',
            ],
            [
                'slug'        => 'contact-form-builder',
                'name'        => 'Drag & Drop Form Builder',
                'version'     => '1.0.5',
                'description' => 'Build custom forms, capture visitor leads, and trigger automated email notifications.',
                'author'      => 'Stitpragya Technologies',
                'author_url'  => 'https://stitpragya.in',
                'icon'        => 'envelope-open-text',
                'category'    => 'Forms & Leads',
                'rating'      => 4.7,
                'downloads'   => '980',
                'price'       => 'Free',
            ],
            [
                'slug'        => 'activity-audit-log',
                'name'        => 'Enterprise Activity & Audit Logger',
                'version'     => '1.1.0',
                'description' => 'Track all administrator, editor, and user actions with IP addresses and change diffs.',
                'author'      => 'SLCMS Security Lab',
                'author_url'  => 'https://slcms.stitpragya.in',
                'icon'        => 'history',
                'category'    => 'Security & Auditing',
                'rating'      => 5.0,
                'downloads'   => '3,200',
                'price'       => 'Free',
            ],
            [
                'slug'        => 'webp-media-compressor',
                'name'        => 'WebP Auto-Compressor & Optimizer',
                'version'     => '1.0.0',
                'description' => 'Automatically compress and convert uploaded PNG & JPG images to WebP, saving 70% storage.',
                'author'      => 'Community Contributor',
                'author_url'  => 'https://stitpragya.in',
                'icon'        => 'image',
                'category'    => 'Media & Storage',
                'rating'      => 4.9,
                'downloads'   => '1,890',
                'price'       => 'Free',
            ],
        ];

        foreach ($catalog as &$item) {
            $item['is_installed'] = in_array($item['slug'], $installedSlugs, true);
        }

        return $catalog;
    }

    /**
     * Check if a plugin is currently active
     */
    public static function isActive(string $slug): bool
    {
        try {
            $db = \Config\Database::connect();
            if ($db->tableExists('cms_plugins')) {
                $row = $db->table('cms_plugins')->where('slug', $slug)->get()->getRowArray();
                if ($row && (int) $row['is_active'] === 1) {
                    return true;
                }
            }
        } catch (\Throwable $e) {}

        $dir1 = ROOTPATH . 'plugins/' . $slug . '/.active';
        $dir2 = ROOTPATH . 'Plugins/' . $slug . '/.active';
        if ((file_exists($dir1) && trim((string) file_get_contents($dir1)) === '1') ||
            (file_exists($dir2) && trim((string) file_get_contents($dir2)) === '1')) {
            return true;
        }

        return false;
    }

    /**
     * Get detailed information for a single plugin
     */
    public function getPluginDetails(string $slug): ?array
    {
        $catalog = $this->getMarketplaceCatalog();
        $matched = null;

        foreach ($catalog as $item) {
            if ($item['slug'] === $slug) {
                $matched = $item;
                break;
            }
        }

        // If not in standard catalog, scan file system
        if (!$matched) {
            $dir = is_dir(ROOTPATH . 'plugins/' . $slug) ? ROOTPATH . 'plugins/' . $slug : (is_dir(ROOTPATH . 'Plugins/' . $slug) ? ROOTPATH . 'Plugins/' . $slug : null);
            if ($dir && file_exists($dir . '/plugin.json')) {
                $manifest = json_decode((string) file_get_contents($dir . '/plugin.json'), true);
                if ($manifest) {
                    $matched = [
                        'slug'        => $slug,
                        'name'        => $manifest['name'] ?? ucfirst($slug),
                        'version'     => $manifest['version'] ?? '1.0.0',
                        'description' => $manifest['description'] ?? '',
                        'author'      => $manifest['author'] ?? 'Community Contributor',
                        'author_url'  => $manifest['author_url'] ?? '',
                        'icon'        => $manifest['icon'] ?? 'plug',
                        'category'    => $manifest['category'] ?? 'Utilities',
                        'rating'      => 4.8,
                        'downloads'   => '1,200',
                        'price'       => 'Free',
                        'is_installed'=> true,
                    ];
                }
            }
        }

        if (!$matched) {
            return null;
        }

        // Add author slug
        helper('url');
        $matched['author_slug'] = url_title($matched['author'], '-', true);

        // Check for local README.md
        $pluginDir = is_dir(ROOTPATH . 'plugins/' . $slug) ? ROOTPATH . 'plugins/' . $slug : (is_dir(ROOTPATH . 'Plugins/' . $slug) ? ROOTPATH . 'Plugins/' . $slug : null);
        $readmeContent = null;
        if ($pluginDir && file_exists($pluginDir . '/README.md')) {
            $readmeContent = (string) file_get_contents($pluginDir . '/README.md');
        }
        $matched['readme'] = $readmeContent;

        // Check active status
        $matched['is_active'] = self::isActive($slug);

        return $matched;
    }

    /**
     * Get all plugins authored by a specific developer
     */
    public function getPluginsByAuthor(string $authorSlug): array
    {
        helper('url');
        $catalog = $this->getMarketplaceCatalog();
        $plugins = [];
        $authorInfo = [
            'name'        => '',
            'slug'        => $authorSlug,
            'url'         => '',
            'badge'       => 'Verified Developer',
            'bio'         => 'Certified creator and core contributor to the SLCMS modular plugin ecosystem.',
        ];

        foreach ($catalog as $item) {
            $slugified = url_title($item['author'], '-', true);
            if ($slugified === $authorSlug || stripos($item['author'], str_replace('-', ' ', $authorSlug)) !== false) {
                $item['author_slug'] = $slugified;
                $plugins[] = $item;
                if (empty($authorInfo['name'])) {
                    $authorInfo['name'] = $item['author'];
                    $authorInfo['url']  = $item['author_url'] ?? '';
                }
            }
        }

        if (empty($authorInfo['name'])) {
            $authorInfo['name'] = ucwords(str_replace('-', ' ', $authorSlug));
        }

        return [
            'author'  => $authorInfo,
            'plugins' => $plugins,
        ];
    }

    private function executeLifecycle(string $slug, string $method): void
    {
        $safeNs = str_replace(['-', '_'], '', ucwords($slug, '-_'));
        $class  = 'Plugins\\' . $safeNs . '\\Plugin';
        $file   = $this->pluginsPath . $slug . '/Plugin.php';

        if (file_exists($file)) {
            try {
                require_once $file;
                if (class_exists($class) && method_exists($class, $method)) {
                    call_user_func([$class, $method]);
                }
            } catch (\Throwable $e) {
                log_message('error', "Plugin lifecycle error in {$slug}::{$method}: " . $e->getMessage());
            }
        }
    }

    private function deleteDirectory(string $dir): void
    {
        if (!is_dir($dir)) {
            return;
        }
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            is_dir($path) ? $this->deleteDirectory($path) : unlink($path);
        }
        rmdir($dir);
    }
}
