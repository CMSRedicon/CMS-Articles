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
    public function index()
    {
        $articlesCategories = ArticlesCategories::all();
        return view('cms_articles_admin_articles_categories::index', compact('articlesCategories'));
    }

    // /**
    //  * Widok dodania opisu
    //  *
    //  * @param integer $articleCategoryId
    //  * @param String $lang
    //  * @return void
    //  */
    // public function descriptionCreate(int $articleCategoryId, String $lang = null){
    //     if(is_null($lang)) $lang = 'pl';

    //     $articleCategory = ArticlesCategories::findOrFail($articleCategoryId);
    //     return view('cms_articles_admin_articles_categories::create', compact('lang', 'articleCategory'));
    // }
 
    // /**
    //  * Zapis zasobu
    //  *
    //  * @param StoreArticlesCategoriesDescriptionRequest $request
    //  * @param integer $articleCategoryId
    //  * @return void
    //  */
    // public function descriptionStore(StoreArticlesCategoriesDescriptionRequest $request, int $articleCategoryId){
  
    //     $data = $request->all();
    //     $articleCategory = ArticlesCategories::findOrFail($articleCategoryId);
        
    //     DB::beginTransaction();
        
    //     try{
            
    //         $articleCategory->ArticlesCategoriesDescription()->create($data);

    //     }catch(\PDOException $e){
    //         DB::rollback();
    //         redirect()->route('admin.articles.categories.index')->with('danger', implodeArrayToHtml($e->getMessage()));

    //     }catch(\Exception $e){
    //         DB::rollback();
    //         redirect()->route('admin.articles.categories.index')->with('danger', implodeArrayToHtml($e->getMessage()));
    //     }

    //     return redirect()->route('admin.articles.categories.index')->with('success', 'Pomyślnie zapisano!');
    // }


    /**
     * Zapis nowej kategorii
     *
     * @param StoreArticlesCategoriesRequest $request
     * @return void
     */
    public function store(StoreArticlesCategoriesRequest $request)
    {
        $data = $request->all();
        DB::beginTransaction();
      
        try {
            ArticlesCategories::create($data);

        } catch (\PDOException $e) {
            DB::rollback();
            return redirect()->route('admin.articles.categories.index')->with('danger', implodeArrayToHtml($e->getMessage()));

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.articles.categories.index')->with('danger', implodeArrayToHtml($e->getMessage()));
        }

        DB::commit();
        return redirect()->route('admin.articles.categories.index')->with('success', 'Pomyślnie zapisano!');
    }
    /**
     * Edycja
     *
     * @param integer $articleCategoriesDescriptionId
     * @return void
     */
    public function edit(int $articleCategoriesDescriptionId)
    {
        $articleCategoryDescription = ArticlesCategoriesDescription::where('id', $articleCategoriesDescriptionId)->firstOrFail();
        $articleCategory = $articleCategoryDescription->ArticlesCategories;
        return view('cms_articles_admin_articles_categories::edit', compact('articleCategoryDescription','articleCategory'));
    }

    /**
     * Update zasobów
     *
     * @param UpdateArticlesCategoriesRequest $request
     * @param integer $articleCategoriesDescriptionId
     * @return void
     */
    public function update(UpdateArticlesCategoriesRequest $request, int $articleCategoriesDescriptionId)
    {

        $articleCategoryDescription = ArticlesCategoriesDescription::findOrFail($articleCategoriesDescriptionId);
        $data = $request->all();

        DB::beginTransaction();

        try {

            if (!$this->articlesCategoriesRepo->update($data, $articleCategoryDescription)) {
                DB::rollback();
                return redirect()->route('admin.articles.categories.index')->with('danger', implodeArrayToHtml($articlesCategoriesRepo->getErrors()));
            }

        } catch (\PDOException $e) {

            DB::rollback();
            return redirect()->route('admin.articles.categories.index')->with('danger', implodeArrayToHtml($e->getMessage()));

        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('admin.articles.categories.index')->with('danger', implodeArrayToHtml($e->getMessage()));

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
    public function delete(int $articleCategoriesId)
    {
        $articleCategory = ArticlesCategories::findOrFail($articleCategoriesId);
        $articleCategory->delete();
        return redirect()->route('admin.articles.categories.index')->with('success', 'Pomyślnie usunięto!');
    }
    // /**
    //  * Usunięcie zasobów
    //  *
    //  * @param integer $articleCategoriesDescriptionId
    //  * @return void
    //  */
    // public function descriptionDelete(int $articleCategoriesDescriptionId)
    // {
        
    //     $articleCategoriesDescription = ArticlesCategoriesDescription::findOrFail($articleCategoriesDescriptionId);
    //     $articleCategoriesDescription->delete();
    //     return redirect()->route('admin.articles.categories.index')->with('success', 'Pomyślnie usunięto!');
    // }

    /**
     * Zapis /
     *
     * @param StoreArticlesCategoriesPositionRequest $request
     * @return void
     */
    public function positionUpdate(UpdateArticlesCategoriesPositionRequest $request){

        $data = $request->all();
        
        DB::beginTransaction();         

        try{
            
            $ids = array_keys($data['position']);

            $articlesCategories = ArticlesCategories::whereIn('id', $ids)->get();

            $articlesCategories->each(function($item) use($data){

                $item->position = $data['position'][$item->id];
                $item->save();

            });

        }catch(\PDOException $e){
            DB::rollback();
            return redirect()->route('admin.articles.categories.index')->with('danger', implodeArrayToHtml($e->getMessage()));
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('admin.articles.categories.index')->with('danger', implodeArrayToHtml($e->getMessage()));
        }
        
        DB::commit();
      
        return redirect()->route('admin.articles.categories.index')->with('success', "pomyślnie Zapisano");
    }
}
