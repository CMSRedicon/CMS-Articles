<?php

namespace Redicon\CMS_Articles\App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Redicon\CMS_Articles\App\Models\Articles;
use Redicon\CMS_Articles\App\Models\ArticlesCategories;
use Redicon\CMS_Articles\App\Repositories\ArticlesRepo;
use Redicon\CMS_Articles\App\Http\Request\Admin\StoreArticlesRequest;

class ArticlesController extends Controller
{

    private $articlesRepo;

    public function __construct()
    {
        $this->articlesRepo = new ArticlesRepo();
    }
    
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

        return view('admin_articles::create',compact('articlesCategories', 'lang'));

    }

    /**
     * Zapis artykułu
     *
     * @param StoreArticlesRequest $request
     * @return void
     */
    public function store(StoreArticlesRequest $request){
    
        $data = $request->all();
       
        DB::beginTransaction();
        
        try{

            if(!$this->articlesRepo->store($data)){
                DB::rollback();
                return redirect()->route('admin.articles.index')->with('error', implodeArrayToHtml($this->articlesRepo->getErrors(),null));
            }
                            

        }catch(\PDOException $e){

            DB::rollback();

        }catch(\Exception $e){
            
            DB::rollback();
            

        }
        
        DB::commit();
        return redirect()->route('admin.articles.index')->with('success', 'Pomyślnie zapisano !');
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