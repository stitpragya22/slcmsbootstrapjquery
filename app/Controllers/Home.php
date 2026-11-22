<?php

namespace App\Controllers;

use App\Models\CmsModuleModel;

class Home extends BaseController
{
    public function index()
    {
        $modules = [];
        try {
            $db = \Config\Database::connect();
            if ($db->tableExists('cms_modules')) {
                $modules = $db->table('cms_modules')
                    ->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->orderBy('name', 'ASC')
                    ->get()
                    ->getResultArray();
            }
        } catch (\Throwable $e) {
            // Graceful fallback
        }

        $data = [
            'modules'     => $modules,
            'currentUser' => auth()->loggedIn() ? auth()->user() : null,
        ];

        return view('landing', $data);
    }
}
