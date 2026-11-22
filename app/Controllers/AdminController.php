<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\Admin\BaseAdminController;

class AdminController extends BaseAdminController
{
    public function index()
    {
        $data['bread'] = '';
        $data['currentMenu'] = '';
        $data['user'] = $this->currentUser;
        return view("admin/dashboard", $data);
    }

    public function userlist()
    {
        $data['bread'] = 'userlist';
        $data['user'] = $this->currentUser;
        $model = new UserModel();
        $data['records'] = $model->where('role', 'editor')->findAll();
        return view("admin/userlist", $data);
    }

    public function profile()
    {
        $user = auth()->user();
        $model = new UserModel();
        $admin = null;
        try {
            $admin = $model->where('role', 'admin')->first();
        } catch (\Throwable $e) {}

        $data['admin'] = $admin ?: [
            'name'        => $user ? ($user->username ?? 'Admin') : 'Admin',
            'first_name'  => $user ? ($user->username ?? 'Admin') : 'Admin',
            'last_name'   => '',
            'email'       => $user ? ($user->email ?? 'admin@mail.com') : 'admin@mail.com',
            'phone_no'    => '',
            'profile_pic' => '',
        ];
        $data['bread'] = 'Profile';
        $data['user']  = $this->currentUser;
        return view("admin/profile", $data);
    }

    public function UpdateProfile()
    {
        session()->setFlashdata("mtype", "warning");
        $user = auth()->user();
        $model = new UserModel();
        $admin = null;
        try {
            $admin = $model->where('role', 'admin')->first();
        } catch (\Throwable $e) {}

        $firstName = trim((string) $this->request->getPost('first_name'));
        $lastName  = trim((string) $this->request->getPost('last_name'));
        $email     = trim((string) $this->request->getPost('email'));
        $phone     = trim((string) $this->request->getPost('phone_no'));

        if (empty($firstName) || empty($email)) {
            session()->setFlashdata("message", "First name and email are required.");
            return redirect()->back()->withInput();
        }

        // Upload Profile Picture
        $profilePic = $this->uploadImage('profile_pic', 'profile');

        // Update Shield User if email changed
        if ($user && $email !== $user->email) {
            $user->fill(['email' => $email]);
            auth()->getProvider()->save($user);
        }

        // Update legacy UserModel for compatibility
        try {
            $data = [
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'name'       => trim($firstName . ' ' . $lastName),
                'email'      => $email,
                'phone_no'   => $phone,
            ];
            if ($profilePic) {
                $data['profile_pic'] = $profilePic;
                session()->set('profile_pic', $profilePic);
            }
            if ($admin) {
                $model->update($admin['id'], $data);
            }
        } catch (\Throwable $e) {}

        session()->setFlashdata("mtype", "success");
        session()->setFlashdata("message", "Profile updated successfully!");
        return redirect()->to(base_url('/admin/profile'));
    }

    public function UpdatePassword()
    {
        session()->setFlashdata("mtype", "warning");
        $password = (string) $this->request->getPost('password');
        $cpassword = (string) $this->request->getPost('cpassword');

        if (strlen($password) < 8) {
            session()->setFlashdata("message", "Password must be at least 8 characters long.");
            return redirect()->back()->withInput();
        }

        if ($password !== $cpassword) {
            session()->setFlashdata("message", "The Password and Confirm Password must match.");
            return redirect()->back()->withInput();
        }

        // 1. Update Shield authenticated user
        $user = auth()->user();
        if ($user) {
            $user->fill(['password' => $password]);
            auth()->getProvider()->save($user);
        }

        // 2. Also update legacy user table for backward compatibility
        try {
            $model = new UserModel();
            $admin = $model->where('role', 'admin')->first();
            if ($admin) {
                $model->update($admin['id'], ['password' => password_hash($password, PASSWORD_DEFAULT)]);
            }
        } catch (\Throwable $e) {}

        session()->setFlashdata("mtype", "success");
        session()->setFlashdata("message", "Password changed successfully in Shield!");
        return redirect()->to(base_url('/admin/profile'));
    }
}
