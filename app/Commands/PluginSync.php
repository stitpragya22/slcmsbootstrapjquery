<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Libraries\PluginManager;

class PluginSync extends BaseCommand
{
    protected $group       = 'Plugins';
    protected $name        = 'plugins:sync';
    protected $description = 'Scan, sync, and optionally activate plugins.';
    protected $usage       = 'plugins:sync [activate-all | activate <slug>]';
    protected $arguments   = [
        'action' => 'Optional action: activate-all or activate <slug>',
    ];

    public function run(array $params)
    {
        $pm = new PluginManager();
        $installed = $pm->scanAndSync();
        CLI::write('Scanned & synced ' . count($installed) . ' plugins.', 'green');

        $action = $params[0] ?? null;
        if ($action === 'activate-all') {
            foreach ($installed as $p) {
                $pm->activate($p['slug']);
                CLI::write('Activated: ' . $p['slug'], 'yellow');
            }
        } elseif ($action === 'activate' && !empty($params[1])) {
            $slug = $params[1];
            $pm->activate($slug);
            CLI::write("Activated: {$slug}", 'yellow');
        }
    }
}
