<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use App\Models\testingModel;

class ToolsController extends BaseController
{
    public $role = '';
    public function __construct()
    {
        $this->role = session()->get('role');

        // if ($this->role != "admin") {
        //     // if ($this->role != "editor") {
        //     echo 'Access denied';
        //     exit;
        //     // }
        // }
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
        $allow_types = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'ppt', 'pptx'];
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
                $uploadOk = 0;

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


    public function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return substr($haystack, 0, $length) === $needle;
    }

    function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if (!$length) {
            return true;
        }

        return substr($haystack, -$length) === $needle;
    }

    public function fetchChildOptions()
    {
        // Get parameters from the Ajax request
        $parentModel = 'App\Models\\' . $this->request->getPost('parentModel');
        $childModel = 'App\Models\\' . $this->request->getPost('childModel');
        $parentId = $this->request->getPost('parentId');
        $parentForeignKey = $this->request->getPost('parentForeignKey');
        $childListLabel = $this->request->getPost('childListLabel');
        $childListValue = $this->request->getPost('childListValue');

        // Load the required models
        $parentModel = new $parentModel();
        $childModel = new $childModel();

        // Fetch child records based on the parent ID
        $childRecords = $childModel->where($parentForeignKey, $parentId)->findAll();

        // Prepare data for the child dropdown
        $options = [];
        foreach ($childRecords as $record) {
            $options[] = [
                'label' => $record[$childListLabel],
                'value' => $record[$childListValue]
            ];
        }

        // Return data as JSON
        return $this->response->setJSON($options);
    }
}
