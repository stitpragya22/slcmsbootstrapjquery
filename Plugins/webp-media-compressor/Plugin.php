<?php

namespace Plugins\WebpMediaCompressor;

class Plugin
{
    public static function onActivate(): void
    {
        log_message('info', 'Plugin webp-media-compressor activated.');
    }

    public static function onDeactivate(): void
    {
        log_message('info', 'Plugin webp-media-compressor deactivated.');
    }

    public static function onUninstall(): void
    {
        log_message('info', 'Plugin webp-media-compressor uninstalled.');
    }

    public static function boot(): void
    {
        // Hook into media uploads
    }
}
