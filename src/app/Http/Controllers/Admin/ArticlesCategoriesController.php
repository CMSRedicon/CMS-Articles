<?php

namespace Redicon\CMS_Articles\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redicon\CMS_Articles\App\Models\ArticlesCategories;

class ArticlesCategoriesController extends Controller
{
    
    public function index(){
        $articlesCategories = ArticlesCategories::all();
        return view('cms_articles_admin_articles_categories::index', compact('articlesCategories'));
    }

    public function create(){



    }

}
