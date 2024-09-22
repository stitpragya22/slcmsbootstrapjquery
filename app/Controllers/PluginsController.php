<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class PluginsController extends Controller
{
    public function __construct()
    {
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
    }
    // In your Plugins controller

    public function getPlugins()
    {
        $pluginsPath = FCPATH . 'Plugins/';
        $plugins = array_filter(scandir($pluginsPath), function ($item) use ($pluginsPath) {
            return is_dir($pluginsPath . $item) && !in_array($item, ['.', '..']);
        });

        $pluginDetails = [];
        foreach ($plugins as $plugin) {
            $defaultThumbnailPath = base_url('Plugins/default_thumbnail.jpg');
            $thumbnailPath = base_url('Plugins/' . $plugin . '/thumbnail.jpg'); // Assuming thumbnail.jpg is the thumbnail image name
            if (!file_exists($pluginsPath . $plugin . '/thumbnail.jpg')) {
                $thumbnailPath = $defaultThumbnailPath;
            }
            $activeFile = $pluginsPath . $plugin . '/.active';
            $isActive = (file_exists($activeFile) && trim(file_get_contents($activeFile)) === '1');

            $pluginDetails[] = [
                'name' => $plugin,
                'thumbnail' => $thumbnailPath,
                'isActive' => $isActive,
            ];
        }

        return $pluginDetails;
    }

    public function activate($plugin)
    {
        $activeFile = FCPATH . 'Plugins/' . $plugin . '/.active';
        if (file_put_contents($activeFile, '1') !== false) {
            // Plugin activated successfully
            return redirect()->back()->with('success', 'Plugin activated successfully.');
        } else {
            // Error activating plugin
            return redirect()->back()->with('error', 'Error activating plugin.');
        }
    }

    public function deactivate($plugin)
    {
        $activeFile = FCPATH . 'Plugins/' . $plugin . '/.active';
        if (file_put_contents($activeFile, '0') !== false) {
            // Plugin deactivated successfully
            return redirect()->back()->with('success', 'Plugin deactivated successfully.');
        } else {
            // Error deactivating plugin
            return redirect()->back()->with('error', 'Error deactivating plugin.');
        }
    }

    public function addons()
    {
        $data['plugins']=$this->getPlugins();
        return view("admin/addons",$data);
    }
}
