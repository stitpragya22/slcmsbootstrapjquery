<?php

namespace App\Plugins\HelloWorldPlugin;

use CodeIgniter\Controller;

class HelloWorldPluginController extends Controller
{
    public function index()
    {
        return "Hello, World! This is from the HelloWorldPlugin.";
    }
}
