<?php

namespace App\Controllers;

use App\Controllers\Admin\BaseAdminController;

class PluginsController extends BaseAdminController
{
    private function getPluginBasePath(): string
    {
        $dir = ROOTPATH . 'plugins/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        return $dir;
    }

    public function getPlugins(): array
    {
        $pluginsPath = $this->getPluginBasePath();
        $plugins = array_filter(scandir($pluginsPath), function ($item) use ($pluginsPath) {
            return is_dir($pluginsPath . $item) && !in_array($item, ['.', '..'], true);
        });

        $pluginDetails = [];
        foreach ($plugins as $plugin) {
            $defaultThumbnail = base_url('assets/backend/mdb5/img/plugin_default.png');
            $thumbFile = $pluginsPath . $plugin . '/thumbnail.jpg';
            $thumbnailPath = file_exists($thumbFile) ? base_url('plugins/' . $plugin . '/thumbnail.jpg') : $defaultThumbnail;

            $activeFile = $pluginsPath . $plugin . '/.active';
            $isActive = (file_exists($activeFile) && trim(file_get_contents($activeFile)) === '1');

            $manifestFile = $pluginsPath . $plugin . '/plugin.json';
            $manifest = file_exists($manifestFile) ? json_decode(file_get_contents($manifestFile), true) : [];

            $pluginDetails[] = [
                'name'        => $manifest['name'] ?? $plugin,
                'slug'        => $plugin,
                'description' => $manifest['description'] ?? 'No description provided.',
                'version'     => $manifest['version'] ?? '1.0.0',
                'author'      => $manifest['author'] ?? 'Community Developer',
                'thumbnail'   => $thumbnailPath,
                'isActive'    => $isActive,
            ];
        }

        return $pluginDetails;
    }

    public function activate($plugin)
    {
        $plugin = preg_replace('/[^a-zA-Z0-9_-]/', '', (string) $plugin);
        $pluginsPath = $this->getPluginBasePath();
        $targetDir = $pluginsPath . $plugin;

        if (!is_dir($targetDir)) {
            $this->flashError("Plugin '{$plugin}' not found.");
            return redirect()->to(base_url('admin/plugins'));
        }

        $activeFile = $targetDir . '/.active';
        if (file_put_contents($activeFile, '1') !== false) {
            $this->flashSuccess("Plugin '{$plugin}' activated successfully.");
        } else {
            $this->flashError("Failed to activate plugin '{$plugin}'.");
        }

        return redirect()->to(base_url('admin/plugins'));
    }

    public function deactivate($plugin)
    {
        $plugin = preg_replace('/[^a-zA-Z0-9_-]/', '', (string) $plugin);
        $pluginsPath = $this->getPluginBasePath();
        $targetDir = $pluginsPath . $plugin;

        if (!is_dir($targetDir)) {
            $this->flashError("Plugin '{$plugin}' not found.");
            return redirect()->to(base_url('admin/plugins'));
        }

        $activeFile = $targetDir . '/.active';
        if (file_put_contents($activeFile, '0') !== false) {
            $this->flashSuccess("Plugin '{$plugin}' deactivated successfully.");
        } else {
            $this->flashError("Failed to deactivate plugin '{$plugin}'.");
        }

        return redirect()->to(base_url('admin/plugins'));
    }

    public function addons()
    {
        $data = [
            'plugins'     => $this->getPlugins(),
            'currentMenu' => 'plugins',
            'bread'       => 'Installed Plugins & Addons',
            'user'        => $this->currentUser,
        ];

        return view('admin/addons', $data);
    }
}
