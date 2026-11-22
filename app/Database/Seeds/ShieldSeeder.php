<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;

class ShieldSeeder extends Seeder
{
    public function run()
    {
        $users = auth()->getProvider();

        // 1. Admin User
        $adminEmail = 'admin@mail.com';
        $admin = $users->findByCredentials(['email' => $adminEmail]);
        if (!$admin) {
            $admin = new User([
                'username' => 'admin',
                'email'    => $adminEmail,
                'password' => '12345678',
            ]);
            $users->save($admin);
            $admin = $users->findById($users->getInsertID());
            $admin->activate();
        }
        $admin->syncGroups('admin', 'superadmin');

        // 2. Editor User
        $editorEmail = 'editor@mail.com';
        $editor = $users->findByCredentials(['email' => $editorEmail]);
        if (!$editor) {
            $editor = new User([
                'username' => 'editor',
                'email'    => $editorEmail,
                'password' => '12345678',
            ]);
            $users->save($editor);
            $editor = $users->findById($users->getInsertID());
            $editor->activate();
        }
        $editor->syncGroups('editor');
    }
}
