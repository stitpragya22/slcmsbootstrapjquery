<?php

namespace App\Controllers;

class SettingsController extends BaseController
{
    /**
     * Display Global Site Settings
     */
    public function index()
    {
        $db = \Config\Database::connect();
        $settings = [];

        if ($db->tableExists('cms_settings')) {
            $rows = $db->table('cms_settings')->get()->getResultArray();
            foreach ($rows as $r) {
                $settings[$r['key']] = $r['value'];
            }
        }

        return view('admin/settings/index', [
            'settings' => $settings,
            'title'    => 'Global CMS Settings & Custom Code',
        ]);
    }

    /**
     * Update Global Settings
     */
    public function update()
    {
        $db = \Config\Database::connect();
        if (!$db->tableExists('cms_settings')) {
            return redirect()->to(base_url('admin/settings'))->with('error', 'Settings table does not exist. Please run spark migrate.');
        }

        $fields = [
            'site_title',
            'site_tagline',
            'custom_header_css',
            'custom_header_js',
            'custom_footer_js',
        ];

        foreach ($fields as $field) {
            $val = $this->request->getPost($field);
            if ($val !== null) {
                $exists = $db->table('cms_settings')->where('key', $field)->countAllResults();
                if ($exists > 0) {
                    $db->table('cms_settings')->where('key', $field)->update([
                        'value'      => $val,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                } else {
                    $db->table('cms_settings')->insert([
                        'key'        => $field,
                        'value'      => $val,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }
        }

        return redirect()->to(base_url('admin/settings'))->with('message', 'Global settings and custom CSS/JS updated successfully!');
    }
}
