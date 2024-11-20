<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data=[
            "title"=> "Welcome To The Saas FrontEnd Page",
        ];
        return view("index",$data);
    }
}
