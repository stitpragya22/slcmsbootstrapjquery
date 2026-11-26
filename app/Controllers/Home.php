<?php

namespace App\Controllers;

use App\Libraries\PluginManager;
use ZipArchive;

class Home extends BaseController
{
    public function index()
    {
        $modules = [];
        try {
            $db = \Config\Database::connect();
            if ($db->tableExists('cms_modules')) {
                $modules = $db->table('cms_modules')
                    ->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->orderBy('name', 'ASC')
                    ->get()
                    ->getResultArray();
            }
        } catch (\Throwable $e) {}

        $data = [
            'modules'     => $modules,
            'currentUser' => auth()->loggedIn() ? auth()->user() : null,
        ];

        return view('landing', $data);
    }

    /**
     * Display a public Custom Page (e.g. /page/about-us)
     */
    public function page(string $slug)
    {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
        $db = \Config\Database::connect();

        $page = null;
        if ($db->tableExists('cms_pages')) {
            $page = $db->table('cms_pages')
                ->where('slug', $slug)
                ->where('is_published', 1)
                ->get()
                ->getRowArray();
        }

        if (!$page) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Page '{$slug}' not found.");
        }

        $data = [
            'page'        => $page,
            'currentUser' => auth()->loggedIn() ? auth()->user() : null,
        ];

        return view('pages/show', $data);
    }

    /**
     * Public WordPress.org-style Plugin Marketplace Directory
     */
    public function marketplace()
    {
        $pluginManager = new PluginManager();
        $catalog = $pluginManager->getMarketplaceCatalog();

        $data = [
            'catalog'     => $catalog,
            'currentUser' => auth()->loggedIn() ? auth()->user() : null,
        ];

        return view('marketplace/index', $data);
    }

    /**
     * Single Plugin Detailed Documentation & Showcase Page
     */
    public function marketplaceDetail(string $slug)
    {
        $pluginManager = new PluginManager();
        $plugin = $pluginManager->getPluginDetails($slug);

        if (!$plugin) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Plugin '{$slug}' not found.");
        }

        $data = [
            'plugin'      => $plugin,
            'currentUser' => auth()->loggedIn() ? auth()->user() : null,
        ];

        return view('marketplace/detail', $data);
    }

    /**
     * Developer Profile & Plugin Portfolio Page
     */
    public function marketplaceDeveloper(string $authorSlug)
    {
        $pluginManager = new PluginManager();
        $portfolio = $pluginManager->getPluginsByAuthor($authorSlug);

        $data = [
            'author'      => $portfolio['author'],
            'plugins'     => $portfolio['plugins'],
            'currentUser' => auth()->loggedIn() ? auth()->user() : null,
        ];

        return view('marketplace/developer', $data);
    }

    /**
     * Mini Frontend UI Starter Template Demo
     */
    public function starter()
    {
        $data = [
            'currentUser' => auth()->loggedIn() ? auth()->user() : null,
        ];

        return view('starter', $data);
    }

    /**
     * Developer Documentation Portal
     */
    public function docs()
    {
        $data = [
            'currentUser' => auth()->loggedIn() ? auth()->user() : null,
        ];

        return view('docs/index', $data);
    }

    /**
     * Download Plugin as a .ZIP archive directly from the public marketplace
     */
    public function marketplaceDownload(string $slug)
    {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
        $pluginPath = is_dir(ROOTPATH . 'plugins/' . $slug)
            ? ROOTPATH . 'plugins/' . $slug
            : ROOTPATH . 'Plugins/' . $slug;

        if (!is_dir($pluginPath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Plugin '{$slug}' not found.");
        }

        $zipFile = WRITEPATH . 'cache/' . $slug . '-v1.0.0.zip';
        $zip = new ZipArchive();

        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($pluginPath, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = $slug . '/' . substr($filePath, strlen($pluginPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
        }

        if (file_exists($zipFile)) {
            return $this->response->download($zipFile, null)->setFileName($slug . '.zip');
        }

        return redirect()->to(base_url('marketplace'));
    }
}
