<?php

namespace Plugins\SeoOptimizer;

use App\Libraries\Hook;

class Plugin
{
    public static function onActivate(): void
    {
        log_message('info', 'Plugin seo-optimizer activated.');
    }

    public static function onDeactivate(): void
    {
        log_message('info', 'Plugin seo-optimizer deactivated.');
    }

    public static function onUninstall(): void
    {
        log_message('info', 'Plugin seo-optimizer uninstalled.');
    }

    public static function boot(): void
    {
        Hook::addFilter('slcms.seo.tags', function ($tags) {
            $tags['generator'] = 'SLCMS v1 - CodeIgniter 4';
            return $tags;
        });
    }
}
