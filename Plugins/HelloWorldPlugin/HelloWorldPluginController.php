<?php

namespace Plugins\HelloWorldPlugin;

use CodeIgniter\Controller;

class HelloWorldPluginController extends Controller
{
    public function index()
    {
        return view('Plugins\HelloWorldPlugin\Views\index');
    }
}
