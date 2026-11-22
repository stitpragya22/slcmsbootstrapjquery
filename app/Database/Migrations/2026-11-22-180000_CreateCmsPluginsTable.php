<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCmsPluginsTable extends Migration
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
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'version' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'default'    => '1.0.0',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'author_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'default'    => 'plug',
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'default'    => 'General',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'settings_json' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->addKey('is_active');
        $this->forge->createTable('cms_plugins', true);
    }

    public function down()
    {
        $this->forge->dropTable('cms_plugins', true);
    }
}
