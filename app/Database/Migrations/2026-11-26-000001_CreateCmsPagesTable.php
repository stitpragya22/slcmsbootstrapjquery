<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCmsPagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
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
            'content' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'meta_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'meta_description' => [
                'type' => 'TEXT',
                'null' => true,
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

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('cms_pages', true);

        // Seed initial default pages
        $db = \Config\Database::connect();
        $builder = $db->table('cms_pages');

        $builder->insertBatch([
            [
                'title'            => 'About SLCMS',
                'slug'             => 'about-us',
                'content'          => '<h3>Welcome to SLCMS</h3><p>SLCMS is a modern, ultra-lightweight Content Management System built on top of <strong>CodeIgniter 4</strong>, <strong>Shield RBAC</strong>, <strong>Bootstrap 5</strong>, and <strong>jQuery</strong>.</p><p>It features a zero file-mutation CRUD generator, an extensible WordPress-style Hook API, and a dynamic modular plugin marketplace.</p>',
                'meta_title'       => 'About Us - SLCMS v1',
                'meta_description' => 'Learn more about SLCMS, the lightweight and fast CodeIgniter 4 CMS platform.',
                'is_published'     => 1,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'title'            => 'Privacy Policy',
                'slug'             => 'privacy-policy',
                'content'          => '<h3>Privacy Policy</h3><p>Your privacy is important to us. SLCMS does not collect or sell your personal data. All data stored within this system remains strictly on your own database server.</p>',
                'meta_title'       => 'Privacy Policy - SLCMS',
                'meta_description' => 'Privacy Policy and data transparency statement for SLCMS.',
                'is_published'     => 1,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'title'            => 'Terms & Conditions',
                'slug'             => 'terms-conditions',
                'content'          => '<h3>Terms and Conditions</h3><p>By using SLCMS and its plugin marketplace ecosystem, you agree to comply with open-source licensing standards under the MIT License.</p>',
                'meta_title'       => 'Terms & Conditions - SLCMS',
                'meta_description' => 'Terms of service and open source licensing guidelines.',
                'is_published'     => 1,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('cms_pages', true);
    }
}
