<?php

namespace Plugins\PortfolioMaker;

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
                'title' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                ],
                'slug' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'unique'     => true,
                ],
                'category' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'default'    => 'Web Development',
                ],
                'client_name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                    'null'       => true,
                ],
                'description' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'project_url' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ],
                'cover_image' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ],
                'completion_date' => [
                    'type' => 'DATE',
                    'null' => true,
                ],
                'is_featured' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'default'    => 1,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);

            $forge->addPrimaryKey('id');
            $forge->createTable('cms_portfolio_projects', true);

            // Seed initial portfolio projects
            $db = \Config\Database::connect();
            if ($db->table('cms_portfolio_projects')->countAllResults() === 0) {
                $db->table('cms_portfolio_projects')->insertBatch([
                    [
                        'title'           => 'SLCMS 2.0 Web Platform',
                        'slug'            => 'slcms-platform',
                        'category'        => 'Web Development',
                        'client_name'     => 'Open Source Community',
                        'description'     => 'A modular, high-speed CMS platform engineered with CodeIgniter 4 and Bootstrap 5.',
                        'project_url'     => 'https://slcms.stitpragya.in',
                        'cover_image'     => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80',
                        'completion_date' => '2026-11-20',
                        'is_featured'     => 1,
                        'created_at'      => date('Y-m-d H:i:s'),
                    ],
                    [
                        'title'           => 'Brand Identity & Mobile UX',
                        'slug'            => 'brand-identity-mobile-ux',
                        'category'        => 'UI/UX Design',
                        'client_name'     => 'Tech Ventures Ltd',
                        'description'     => 'Minimalist user interface design and mobile design system for next-generation apps.',
                        'project_url'     => 'https://stitpragya.in',
                        'cover_image'     => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=800&q=80',
                        'completion_date' => '2026-10-15',
                        'is_featured'     => 1,
                        'created_at'      => date('Y-m-d H:i:s'),
                    ],
                    [
                        'title'           => 'High-Speed E-Commerce Infrastructure',
                        'slug'            => 'ecommerce-infrastructure',
                        'category'        => 'E-Commerce',
                        'client_name'     => 'Retail Direct',
                        'description'     => 'Cloud-native inventory, checkout pipeline, and payment gateway integration.',
                        'project_url'     => 'https://slcms.stitpragya.in/marketplace',
                        'cover_image'     => 'https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=800&q=80',
                        'completion_date' => '2026-09-30',
                        'is_featured'     => 1,
                        'created_at'      => date('Y-m-d H:i:s'),
                    ],
                ]);
            }
        } catch (\Throwable $e) {
            log_message('error', 'PortfolioMaker activation failed: ' . $e->getMessage());
        }

        Hook::doAction('slcms.plugin.activated', 'portfolio-maker');
    }

    public static function onDeactivate(): void
    {
        Hook::doAction('slcms.plugin.deactivated', 'portfolio-maker');
    }

    public static function onUninstall(): void
    {
        try {
            $forge = \Config\Database::forge();
            $forge->dropTable('cms_portfolio_projects', true);
        } catch (\Throwable $e) {}

        Hook::doAction('slcms.plugin.uninstalled', 'portfolio-maker');
    }
}
