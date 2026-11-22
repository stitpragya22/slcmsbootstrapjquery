<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class EditorController extends BaseController
{
    public function __construct()
    {
        // Shield route filter group:editor,admin,superadmin ensures authorized access
    }
    public function index()
    {
        return view("editor/dashboard");
    }
}
