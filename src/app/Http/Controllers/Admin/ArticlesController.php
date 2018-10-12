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

    /**
     * TODO
     * Edycja artykułu 
     *
     * @param integer $article_id
     * @param string $lang
     * @return void
     */
    public function edit(int $article_id, string $lang = null){

        dump($lang);
        dd($article_id);

    }

    

}