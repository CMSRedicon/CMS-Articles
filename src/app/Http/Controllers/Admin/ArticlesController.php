<?php

namespace Redicon\CMS_Articles\App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    
    public function index()
    {
        return view('admin_articles::index');
    }

}