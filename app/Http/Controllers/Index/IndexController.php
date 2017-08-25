<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //首页
    public function index()
    {
        return view('Index.index');
    }

    //首页
    public function indexPage()
    {
        return view('Index.content-index');
    }

}
