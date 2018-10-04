<?php

namespace Redicon\CMS_Articles\App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Redicon\CMS_Articles\App\Models\Articles;

class ArticlesController extends Controller
{
    
    public function index()
    {
        $articles = Articles::all();
        return view('admin_articles::index', compact('articles'));
    }

}