<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (!function_exists('get_cms_setting')) {
    /**
     * Retrieve a global CMS setting with static in-memory caching
     */
    function get_cms_setting(string $key, string $default = ''): string
    {
        static $settings = null;

        if ($settings === null) {
            $settings = [];
            try {
                $db = \Config\Database::connect();
                if ($db->tableExists('cms_settings')) {
                    $rows = $db->table('cms_settings')->get()->getResultArray();
                    foreach ($rows as $r) {
                        $settings[$r['key']] = $r['value'];
                    }
                }
            } catch (\Throwable $e) {
                // Table might not exist yet during migrations
            }
        }

        return $settings[$key] ?? $default;
    }
}
