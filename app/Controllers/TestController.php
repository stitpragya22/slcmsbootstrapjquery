<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Controllers\BaseController;
use App\Models\TestModel;

class TestController extends BaseController
{
    public $role='';
    public function __construct()
    {
        $this->role=session()->get('role');
        
        if ($this->role != "admin") {
            // if ($this->role != "editor") {
            echo 'Access denied';
            exit;
            // }
        }
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
    
    public function checkAndUploadFile($file, $target_dir, $size)
    {
        $filename = '';
        $allow_types=['jpg','jpeg','png','gif','pdf','doc','docx','ppt','pptx'];
        if ($file['name'] == null || $file['tmp_name'] == '') {
            $uploadOk = 0;
        } else {
            $uploadOk = 1;
            $target_file = $target_dir . '/' . basename($file["name"]);
            $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            if ($file["size"] > $size) {
                $uploadOk = 0;
                echo "big size";
            }
            if (!in_array($FileType, $allow_types))
            $uploadOk=0;
            
            if ($uploadOk == 1) {
                $randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 4);
                $public_id = $randomletter . '_' . time();
                $filename = $public_id . '.' . $FileType;
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
    

    public function index($id=0){
        $model=new UserModel();
        $admin=$model->where('role','admin')->first();
        $data['admin']=$admin;
        session()->set('currentMenu','Test');
        $model=new TestModel();
        if($id>0){
        $data['CurrentRecord']=$model->where('id',$id)->first();
        }
        $data['records']=$model->findAll();
        $data['bread']='Add/Edit Test';
        
        return view($this->role.'/test/add_edit',$data);
        
    }
    
    
        public function Store()
        {
            session()->setFlashdata("mtype", "warning");
            $id=(null !== $this->request->getVar('id'))?$this->request->getVar('id'):0;
            $model=new TestModel();
            $data=[
                 "title" => $this->request->getVar("title") , 
       "slug" => $this->request->getVar("slug") , 
      
                ];
            if($id>0)
            $data['id']=$id;
            foreach ($data as $key => $val)
            {
                if($val=="" || $val==NULL)
                {
                    session()->setFlashdata("message", "The ".$key." is Must For Job Post");
                    return redirect()->back()->withInput();
                }
            }    
                
                $model->save($data);
                session()->setFlashdata("mtype", "success");
                session()->setFlashdata("message", " Test Stored Successfully!");
                return redirect()->to(base_url('/TestController'));
        }
        
        
        public function delete($id)
        {
            $model=new TestModel();
            $model->where('id',$id)->delete();
            session()->setFlashdata("mtype", "success");
            session()->setFlashdata("message", " Test Deleted Successfully!");
            return redirect()->to(base_url('/TestController'));
            
        }
    
    }
