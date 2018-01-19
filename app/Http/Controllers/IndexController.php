<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

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
