<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCmsSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'key' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'value' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('key');
        $this->forge->createTable('cms_settings', true);

        // Seed initial default settings
        $db = \Config\Database::connect();
        $builder = $db->table('cms_settings');

        $builder->insertBatch([
            [
                'key'        => 'site_title',
                'value'      => 'SLCMS v1 - Modern Lightweight CMS',
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'key'        => 'site_tagline',
                'value'      => 'Powered by CodeIgniter 4, Shield, Bootstrap 5 & jQuery',
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'key'        => 'custom_header_css',
                'value'      => "/* Global Custom CSS injected into <head> */\n",
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'key'        => 'custom_header_js',
                'value'      => "<!-- Global Custom Header Scripts (e.g. Google Tag Manager / Analytics) -->\n",
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'key'        => 'custom_footer_js',
                'value'      => "<!-- Global Custom Footer Scripts (e.g. Chat Widget, Custom JS) -->\n",
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('cms_settings', true);
    }
}
