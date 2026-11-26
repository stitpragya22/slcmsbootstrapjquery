<?php

namespace Plugins\BlogManager;

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
                    'default'    => 'General',
                ],
                'excerpt' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'content' => [
                    'type' => 'LONGTEXT',
                    'null' => true,
                ],
                'featured_image' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ],
                'author_name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'default'    => 'Editor',
                ],
                'views_count' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'default'    => 0,
                ],
                'is_published' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'default'    => 1,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);

            $forge->addPrimaryKey('id');
            $forge->createTable('cms_blog_posts', true);

            // Seed initial blog posts
            $db = \Config\Database::connect();
            if ($db->table('cms_blog_posts')->countAllResults() === 0) {
                $db->table('cms_blog_posts')->insertBatch([
                    [
                        'title'          => 'Why Lightweight CMS Architecture Wins in 2026',
                        'slug'           => 'why-lightweight-cms-wins',
                        'category'       => 'Technology',
                        'excerpt'        => 'Explore why developers and businesses are moving away from bloated monoliths toward modular, high-speed architectures.',
                        'content'        => '<p>In today\'s digital landscape, web performance is paramount. Heavy CMS engines with hundreds of unused dependencies slow down Time-To-First-Byte (TTFB) and hurt Core Web Vitals.</p><p>By coupling CodeIgniter 4 with Bootstrap 5 and a zero file-mutation plugin system, SLCMS delivers sub-50ms responses with robust security.</p>',
                        'featured_image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80',
                        'author_name'    => 'Stitpragya Tech',
                        'views_count'    => 142,
                        'is_published'   => 1,
                        'created_at'     => date('Y-m-d H:i:s'),
                        'updated_at'     => date('Y-m-d H:i:s'),
                    ],
                    [
                        'title'          => 'Building Modular Plugins for SLCMS: A Developer Guide',
                        'slug'           => 'building-modular-plugins-slcms',
                        'category'       => 'Tutorials',
                        'excerpt'        => 'Learn how to create, test, and distribute custom plugins using the SLCMS Hook and lifecycle API.',
                        'content'        => '<p>Every plugin in SLCMS resides in its own self-contained directory under <code>Plugins/</code>. It contains a <code>plugin.json</code> manifest and a lifecycle class.</p><p>You can listen to lifecycle events or declare dynamic addon routes with zero configuration.</p>',
                        'featured_image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=800&q=80',
                        'author_name'    => 'SLCMS Core',
                        'views_count'    => 98,
                        'is_published'   => 1,
                        'created_at'     => date('Y-m-d H:i:s'),
                        'updated_at'     => date('Y-m-d H:i:s'),
                    ],
                ]);
            }
        } catch (\Throwable $e) {
            log_message('error', 'BlogManager activation failed: ' . $e->getMessage());
        }

        Hook::doAction('slcms.plugin.activated', 'blog-manager');
    }

    public static function onDeactivate(): void
    {
        Hook::doAction('slcms.plugin.deactivated', 'blog-manager');
    }

    public static function onUninstall(): void
    {
        try {
            $forge = \Config\Database::forge();
            $forge->dropTable('cms_blog_posts', true);
        } catch (\Throwable $e) {}

        Hook::doAction('slcms.plugin.uninstalled', 'blog-manager');
    }
}
