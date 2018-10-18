<?php

namespace Redicon\CMS_Articles\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Redicon\CMS_Articles\App\Models\ArticlesCategories;
use Redicon\CMS_Articles\App\Repositories\ArticlesCategoriesRepo;
use Redicon\CMS_Articles\App\Models\ArticlesCategoriesDescription;
use Redicon\CMS_Articles\App\Http\Request\Admin\UpdateArticlesCategoriesRequest;

class ArticlesCategoriesController extends Controller
{

    private $articlesCategoriesRepo;

    public function __construct()
    {
        $this->articlesCategoriesRepo = new ArticlesCategoriesRepo();
    }
    /**
     * Główny index
     *
     * @return void
     */
    public function index(){
        $articlesCategories = ArticlesCategories::all();
        return view('cms_articles_admin_articles_categories::index', compact('articlesCategories'));
    }

    /**
     * Edycja
     *
     * @param integer $articleCategoriesDescriptionId
     * @return void
     */
    public function edit(int $articleCategoriesDescriptionId){
        $articleCategoryDescription = ArticlesCategoriesDescription::where('id', $articleCategoriesDescriptionId)->firstOrFail();
        return view('cms_articles_admin_articles_categories::edit', compact('articleCategoryDescription'));
    }

    /**
     * Update zasobów
     *
     * @param UpdateArticlesCategoriesRequest $request
     * @param integer $articleCategoriesDescriptionId
     * @return void
     */
    public function update(UpdateArticlesCategoriesRequest $request, int $articleCategoriesDescriptionId){

        $articleCategoryDescription = ArticlesCategoriesDescription::where('id', $articleCategoriesDescriptionId)->firstOrFail();
        $data = $request->all();
        
        DB::beginTransaction();

        try{

            if(!$this->articlesCategoriesRepo->update($data, $articleCategoryDescription)){
                DB::rollback();
                return redirect()->route('admin.articles.categories.index')->with('error', implodeArrayToHtml($articlesCategoriesRepo->getErrors()));
            }

        }catch(\PDOException $e){

            DB::rollback();
            return redirect()->route('dmin.articles.categories.index')->with('error', implodeArrayToHtml($e->getMessage()));

        }catch(\Exception $e){

            DB::rollback();
            return redirect()->route('dmin.articles.categories.index')->with('error', implodeArrayToHtml($e->getMessage()));

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
    public function delete(int $articleCategoriesDescriptionId){


    }

}