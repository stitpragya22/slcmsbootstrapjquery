<?php

namespace App\Controllers;
use App\Models\UserModel;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function __construct()
    {
        
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        $data['bread']='';
        $data['currentMenu']='';
        return view("admin/dashboard",$data);
    }
    
    public function userlist()
    {
        $data['bread']='userlist';
        $model= new UserModel();
        $data['records']=$model->where('role','editor')->findAll();
        // dd($data);
        return view("admin/userlist",$data);
    }
    
    public function profile()
    {
        $model=new UserModel();
        $admin=$model->where('role','admin')->first();
        $data['admin']=$admin;
        $data['bread']='Profile';
        return view("admin/profile",$data);
    }
    
    public function checkAndUploadImage($file, $target_dir, $size)
    {
        $filename = '';
        if ($file['name'] == null || $file['tmp_name'] == '') {
            $uploadOk = 0;
        } else {
            $uploadOk = 1;
            $target_file = $target_dir . '/' . basename($file["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($file["tmp_name"]);
            if ($check == false) {
                $uploadOk = 0;
            }
            if ($file["size"] > $size) {
                $uploadOk = 0;
                echo "big size";
            }
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $uploadOk = 0;
            }
            if ($uploadOk == 1) {
                $randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 4);
                $public_id = $randomletter . '_' . time();
                $filename = $public_id . '.' . $imageFileType;
                $target_file = $target_dir . '/' . $filename;
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            }
        }
        $data['uploadOk'] = $uploadOk;
        $data['filename'] = $filename;
        return $data;
    }
    
    public function UpdateProfile()
    {
        // dd($_POST);
        session()->setFlashdata("mtype", "warning");
        $model=new UserModel();
        $admin=$model->where('role','admin')->first();
        $data['first_name']=$this->request->getVar('first_name');
        $data['last_name']=$this->request->getVar('last_name');
        $data['name']=$data['first_name'].' '.$data['last_name'];
        $data['email']=$this->request->getVar('email');
        $data['phone_no']=$this->request->getVar('phone_no');
        $data['id']=$admin['id'];
        foreach ($data as $key => $val)
        {
            if($val=="")
            {session()->setFlashdata("message", "The ".$key." is Must ..");
            return redirect()->back()->withInput();}
        }
        
        $target_dir="uploads/profile";
            $size=500000*100;
            $file=$_FILES['profile_pic'];
            $uploadResult=$this->checkAndUploadImage($file, $target_dir, $size);
            $uploadOk=$uploadResult['uploadOk'];
            if($uploadOk==1){
                $data['profile_pic']=$uploadResult['filename'];
                session()->set('profile_pic',$uploadResult['filename']);
            }
            else{
                // if($id==0)
                // {
                //     session()->setFlashdata("message", "The thumbnail is Must For New BlogCategory ");
                //      return redirect()->back()->withInput();
                // }
                // else{
                    if(($_FILES['profile_pic']['tmp_name'])!="")
                    {
                        
                    session()->setFlashdata("message", "The profile_pic is Invalid");
                     return redirect()->back()->withInput();
                    }
                // }
            }
            
        $model->save($data);
        session()->setFlashdata("mtype", "success");
        session()->setFlashdata("message", "Profile Stored Successfully!");
        return redirect()->to(base_url('/admin/profile'));
    }
    
    public function UpdatePassword()
    {
        session()->setFlashdata("mtype", "warning");
        $model=new UserModel();
        $admin=$model->where('role','admin')->first();
        $data['password']=$this->request->getVar('password');
        $data['cpassword']=$this->request->getVar('cpassword');
        $data['id']=$admin['id'];
        foreach ($data as $key => $val)
        {
            if($val=="")
            {session()->setFlashdata("message", "The ".$key." is Must ..");
            return redirect()->back()->withInput();}
            if($data['cpassword']!=$data['password'])
            {session()->setFlashdata("message", "The Password And Confirm Password Must Be Same ..");
            return redirect()->back()->withInput();}
        }
        
        unset($data['cpassword']);
        // Now No error continue with encryption of password 
        $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
        $model->save($data);
        session()->setFlashdata("mtype", "success");
        session()->setFlashdata("message", "Password Changed Successfully!");
        return redirect()->to(base_url('/admin/profile'));
    }
}