<?php

namespace App\Controllers;

use App\Controllers\Admin\BaseAdminController;
use App\Libraries\PluginManager;

class MarketplaceController extends BaseAdminController
{
    private PluginManager $pluginManager;

    public function __construct()
    {
        $this->pluginManager = new PluginManager();
    }

    public function index()
    {
        $installed = $this->pluginManager->getInstalledPlugins();
        $catalog   = $this->pluginManager->getMarketplaceCatalog();

        $data = [
            'installed'   => $installed,
            'catalog'     => $catalog,
            'currentMenu' => 'marketplace',
            'bread'       => 'Plugin Marketplace & Addons',
            'user'        => $this->currentUser,
        ];

        return view('admin/marketplace/index', $data);
    }

    public function uploadZip()
    {
        $file = $this->request->getFile('plugin_zip');

        if (!$file || !$file->isValid()) {
            $this->flashError('Please select a valid plugin ZIP file.');
            return redirect()->to(base_url('admin/marketplace'));
        }

        $ext = strtolower($file->getExtension());
        if ($ext !== 'zip') {
            $this->flashError('Only .ZIP files are allowed.');
            return redirect()->to(base_url('admin/marketplace'));
        }

        $tempPath = $file->getTempName();
        $result = $this->pluginManager->installFromZip($tempPath);

        if ($result['success']) {
            $this->flashSuccess($result['message']);
        } else {
            $this->flashError($result['message']);
        }

        return redirect()->to(base_url('admin/marketplace'));
    }

    public function install(string $slug)
    {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
        $catalog = $this->pluginManager->getMarketplaceCatalog();
        $item = null;

        foreach ($catalog as $cat) {
            if ($cat['slug'] === $slug) {
                $item = $cat;
                break;
            }
        }

        if (!$item) {
            $this->flashError("Plugin '{$slug}' is not found in the Marketplace catalog.");
            return redirect()->to(base_url('admin/marketplace'));
        }

        // Install marketplace package: generate plugin structure with manifest
        $destDir = $this->pluginManager->getPluginsPath() . $slug;
        if (!is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }

        $manifest = [
            'slug'        => $slug,
            'name'        => $item['name'],
            'version'     => $item['version'],
            'description' => $item['description'],
            'author'      => $item['author'],
            'author_url'  => $item['author_url'],
            'icon'        => $item['icon'],
            'category'    => $item['category'],
            'menu'        => [
                'label' => $item['name'],
                'icon'  => $item['icon'],
                'route' => 'admin/addons/' . $slug,
            ],
        ];

        file_put_contents($destDir . '/plugin.json', json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        // Create main Plugin bootstrap file
        $pluginPhp = <<<PHP
<?php

namespace Plugins\\{$slug};

use App\Libraries\Hook;

class Plugin
{
    public static function onActivate(): void
    {
        log_message('info', 'Plugin {$slug} activated.');
    }

    public static function onDeactivate(): void
    {
        log_message('info', 'Plugin {$slug} deactivated.');
    }

    public static function boot(): void
    {
        // Register hooks or routes
    }
}
PHP;
        file_put_contents($destDir . '/Plugin.php', $pluginPhp);
        file_put_contents($destDir . '/.active', '0');

        $this->pluginManager->scanAndSync();
        $this->flashSuccess("Plugin '{$item['name']}' downloaded and installed from Marketplace successfully!");
        return redirect()->to(base_url('admin/marketplace'));
    }

    public function activate(string $slug)
    {
        if ($this->pluginManager->activate($slug)) {
            $this->flashSuccess("Plugin '{$slug}' activated successfully.");
        } else {
            $this->flashError("Failed to activate plugin '{$slug}'.");
        }
        return redirect()->to(base_url('admin/marketplace'));
    }

    public function deactivate(string $slug)
    {
        if ($this->pluginManager->deactivate($slug)) {
            $this->flashSuccess("Plugin '{$slug}' deactivated successfully.");
        } else {
            $this->flashError("Failed to deactivate plugin '{$slug}'.");
        }
        return redirect()->to(base_url('admin/marketplace'));
    }

    public function uninstall(string $slug)
    {
        if ($this->pluginManager->uninstall($slug)) {
            $this->flashSuccess("Plugin '{$slug}' uninstalled and purged successfully.");
        } else {
            $this->flashError("Failed to uninstall plugin '{$slug}'.");
        }
        return redirect()->to(base_url('admin/marketplace'));
    }
}
