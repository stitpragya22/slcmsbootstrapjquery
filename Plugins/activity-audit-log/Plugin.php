<?php

namespace Plugins\ActivityAuditLog;

use App\Libraries\Hook;

class Plugin
{
    public static function onActivate(): void
    {
        try {
            $forge = \Config\Database::forge();
            $forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'user_email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                ],
                'action' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                ],
                'details' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'ip_address' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 45,
                    'null'       => true,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
            $forge->addPrimaryKey('id');
            $forge->createTable('cms_audit_logs', true);
        } catch (\Throwable $e) {
            log_message('error', 'AuditLog table creation failed: ' . $e->getMessage());
        }
    }

    public static function onDeactivate(): void
    {
        log_message('info', 'Plugin activity-audit-log deactivated.');
    }

    public static function onUninstall(): void
    {
        try {
            $forge = \Config\Database::forge();
            $forge->dropTable('cms_audit_logs', true);
        } catch (\Throwable $e) {}
    }

    public static function boot(): void
    {
        // Listen to core plugin and CRUD lifecycle events
        Hook::addAction('slcms.plugin.activated', function ($slug) {
            self::log('PLUGIN_ACTIVATED', "Plugin '{$slug}' was activated.");
        });

        Hook::addAction('slcms.plugin.deactivated', function ($slug) {
            self::log('PLUGIN_DEACTIVATED', "Plugin '{$slug}' was deactivated.");
        });

        Hook::addAction('slcms.plugin.uninstalled', function ($slug) {
            self::log('PLUGIN_UNINSTALLED', "Plugin '{$slug}' was uninstalled.");
        });
    }

    public static function log(string $action, string $details = ''): void
    {
        try {
            $db = \Config\Database::connect();
            if ($db->tableExists('cms_audit_logs')) {
                $user = function_exists('auth') && auth()->loggedIn() ? auth()->user() : null;
                $request = service('request');

                $db->table('cms_audit_logs')->insert([
                    'user_email' => $user ? ($user->email ?? 'System') : 'System',
                    'action'     => $action,
                    'details'    => $details,
                    'ip_address' => $request ? $request->getIPAddress() : '127.0.0.1',
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        } catch (\Throwable $e) {}
    }
}
