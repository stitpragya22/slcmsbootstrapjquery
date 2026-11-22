<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCmsModulesTable extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'folder',
            ],
            'table_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'controller' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'model' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'fields_json' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'in_menu' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_active' => [
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('cms_modules', true);
    }

    public function down()
    {
        $this->forge->dropTable('cms_modules', true);
    }
}
