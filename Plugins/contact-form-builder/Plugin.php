<?php

namespace Plugins\ContactFormBuilder;

use App\Libraries\Hook;

class Plugin
{
    public static function onActivate(): void
    {
        // Automatically create cms_leads table if not exists
        try {
            $forge = \Config\Database::forge();
            $forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                ],
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                ],
                'subject' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ],
                'message' => [
                    'type' => 'TEXT',
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
            $forge->createTable('cms_leads', true);
        } catch (\Throwable $e) {
            log_message('error', 'ContactFormBuilder migration failed: ' . $e->getMessage());
        }
    }

    public static function onDeactivate(): void
    {
        log_message('info', 'Plugin contact-form-builder deactivated.');
    }

    public static function onUninstall(): void
    {
        try {
            $forge = \Config\Database::forge();
            $forge->dropTable('cms_leads', true);
        } catch (\Throwable $e) {}
    }

    public static function boot(): void
    {
        // Boot lifecycle
    }
}
