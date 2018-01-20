<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    /**
     *  网站首页
     */
    public function index()
    {
        return view('index');
    }
}
