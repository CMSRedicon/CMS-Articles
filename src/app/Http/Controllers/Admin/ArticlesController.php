<?php

namespace Redicon\CMS_Articles\App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Redicon\CMS_Articles\App\Models\Articles;
use Redicon\CMS_Articles\App\Models\ArticlesCategories;

class ArticlesController extends Controller
{
    
    public function index()
    {
        $articles = Articles::all();
        return view('admin_articles::index', compact('articles'));
    }


    /**
     * Widok tworzenia artykułu
     *
     * @param String $lang
     * @return void
     */
    public function create(String $lang = null){

        if(is_null($lang)) $lang = 'pl';

        $articlesCategories = [];
        
        ArticlesCategories::whereHas('ArticlesCategoriesDescription',function($query) use($lang){
            $query->where('lang', $lang);
        })->each(function($item) use(&$articlesCategories){
            $articlesCategories[$item->id] = $item->ArticlesCategoriesDescription->first()->name;
        });

        return view('admin_articles::create',compact('articlesCategories'));

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