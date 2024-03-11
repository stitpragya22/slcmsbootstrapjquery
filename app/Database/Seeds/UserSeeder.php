<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;
class UserSeeder extends Seeder
{
    public function run()
    {
        $user_object = new UserModel();

		$user_object->insertBatch([
			[
				"name" => "Admin User",
				"email" => "admin@mail.com",
				"phone_no" => "7385307897",
				"role" => "admin",
				"password" => password_hash("12345678", PASSWORD_DEFAULT)
			],
			[
				"name" => "Editor User",
				"email" => "editor@mail.com",
				"phone_no" => "9423724057",
				"role" => "editor",
				"password" => password_hash("12345678", PASSWORD_DEFAULT)
			]
		]);

    }
}
