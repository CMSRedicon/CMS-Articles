<?php

namespace Redicon\CMS_Articles\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Redicon\CMS_Articles\App\Models\ArticlesCategories;
use Redicon\CMS_Articles\App\Repositories\ArticlesCategoriesRepo;
use Redicon\CMS_Articles\App\Models\ArticlesCategoriesDescription;
use Redicon\CMS_Articles\App\Http\Request\Admin\StoreArticlesCategoriesRequest;
use Redicon\CMS_Articles\App\Http\Request\Admin\UpdateArticlesCategoriesRequest;
use Redicon\CMS_Articles\App\Http\Request\Admin\StoreArticlesCategoriesPositionRequest;
use Redicon\CMS_Articles\App\Http\Request\Admin\UpdateArticlesCategoriesPositionRequest;
use Redicon\CMS_Articles\App\Http\Request\Admin\StoreArticlesCategoriesDescriptionRequest;

class ArticlesCategoriesDescriptionController extends Controller
{

    private $articlesCategoriesRepo;

    public function __construct()
    {
        $this->articlesCategoriesRepo = new ArticlesCategoriesRepo();
    }

    /**
     * Widok dodania opisu
     *
     * @param integer $articleCategoryId
     * @param String $lang
     * @return void
     */
    public function create(int $articleCategoryId, String $lang = null){
        if(is_null($lang)) $lang = 'pl';

        $articleCategory = ArticlesCategories::findOrFail($articleCategoryId);
        return view('cms_articles_admin_articles_categories::create', compact('lang', 'articleCategory'));
    }
 
    /**
     * Zapis zasobu
     *
     * @param StoreArticlesCategoriesDescriptionRequest $request
     * @param integer $articleCategoryId
     * @return void
     */
    public function store(StoreArticlesCategoriesDescriptionRequest $request, int $articleCategoryId){
  
        $data = $request->all();

        $articleCategory = ArticlesCategories::findOrFail($articleCategoryId);

        DB::beginTransaction();
        
        try{
            
            $articleCategory->ArticlesCategoriesDescription()->create($data);

        }catch(\PDOException $e){
            DB::rollback();
            redirect()->route('admin.articles.categories.index')->with('danger', implodeArrayToHtml($e->getMessage()));

        }catch(\Exception $e){
            DB::rollback();
            redirect()->route('admin.articles.categories.index')->with('danger', implodeArrayToHtml($e->getMessage()));
        }
        
        DB::commit();
        
        return redirect()->route('admin.articles.categories.index')->with('success', 'Pomyślnie zapisano!');
    }
    /**
     * Usunięcie zasobów
     *
     * @param integer $articleCategoriesDescriptionId
     * @return void
     */
    public function delete(int $articleCategoriesDescriptionId)
    {
        
        $articleCategoriesDescription = ArticlesCategoriesDescription::findOrFail($articleCategoriesDescriptionId);
        $articleCategoriesDescription->delete();
        return redirect()->route('admin.articles.categories.index')->with('success', 'Pomyślnie usunięto!');
    }
 
}
