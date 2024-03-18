<?php

namespace App\Controllers;
use App\Plugins\HelloWorldPlugin\HelloWorldPlugin;
use App\Plugins\TaskManagerPlugin;

class Home extends BaseController
{
    public function index()
    {
        $plugin = new HelloWorldPlugin();
        echo $plugin->renderHelloWorldMessage();
    }
}
