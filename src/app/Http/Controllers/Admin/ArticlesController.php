<?php

namespace Redicon\CMS_Articles\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController;
use Redicon\CMS_Articles\App\Http\Request\Admin\StoreArticlesRequest;
use Redicon\CMS_Articles\App\Models\Articles;
use Redicon\CMS_Articles\App\Models\ArticlesCategories;
use Redicon\CMS_Articles\App\Models\ArticlesDescription;
use Redicon\CMS_Articles\App\Repositories\ArticlesRepo;
use Redicon\CMS_Articles\App\Http\Request\Admin\UpdateArticlesRequest;

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
    public function create(String $lang = null)
    {

        if (is_null($lang)) {
            $lang = 'pl';
        }

        $articlesCategories = [];

        ArticlesCategories::whereHas('ArticlesCategoriesDescription', function ($query) use ($lang) {
            $query->where('lang', $lang);
        })->each(function ($item) use (&$articlesCategories) {
            $articlesCategories[$item->id] = $item->ArticlesCategoriesDescription->first()->name;
        });

        return view('admin_articles::create', compact('articlesCategories', 'lang'));

    }

    /**
     * Zapis artykułu
     *
     * @param StoreArticlesRequest $request
     * @return void
     */
    public function store(StoreArticlesRequest $request)
    {

        $data = $request->all();

        DB::beginTransaction();

        try {

            if (!$this->articlesRepo->store($data)) {
                DB::rollback();
                dd($e);
                return redirect()->route('admin.articles.index')->with('error', implodeArrayToHtml($this->articlesRepo->getErrors(), null));
            }

        } catch (\PDOException $e) {
            // app('sentry')->captureException($e);
            DB::rollback();
            dd($e);
            return redirect()->route('admin.articles.index')->with('error', implodeArrayToHtml($e->getMessage()));

        } catch (\Exception $e) {
            //app('sentry')->captureException($e);
            DB::rollback();
            dd($e);
            return redirect()->route('admin.articles.index')->with('error', implodeArrayToHtml($e->getMessage()));

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
    public function edit(int $article_id, string $lang = null)
    {

        if(is_null($lang)) $lang = 'pl';

        $article = Articles::where('id', $article_id)->firstOrFail();

        //jeżeli nie ma wersji językowej
        if (!hasLang($article, 'ArticlesDescription', $lang)) {
            return redirect()->action('\\' . ArticlesController::class . '@create', ['lang' => $lang]);
        }

        $article = Articles::byLanguage($lang)->where('id', $article_id)->firstOrFail();
        $article->ArticlesDescription = $article->ArticlesDescription->first();
        $article = $this->articlesRepo->prepareArticleToEditable($article);

        $articlesCategories = [];
        ArticlesCategories::whereHas('ArticlesCategoriesDescription', function ($query) use ($lang) {
            $query->where('lang', $lang);
        })->each(function ($item) use (&$articlesCategories) {
            $articlesCategories[$item->id] = $item->ArticlesCategoriesDescription->first()->name;
        });


        return view('admin_articles::edit', compact('article', 'lang','articlesCategories'));

    }

    /**
     * Update zasobu
     *
     * @param UpdateArticlesRequest $request
     * @param integer $article_id
     * @param integer $article_description_id
     * @return void
     */
    public function update(UpdateArticlesRequest $request, int $article_id, int $article_description_id){

        $article = Articles::where('id', $article_id)->whereHas('ArticlesDescription',function($q) use($article_description_id){
            $q->where('id', $article_description_id);
        })->firstOrFail();

        $data = $request->all();
       
        DB::beginTransaction();
        
        try{

            if (!$this->articlesRepo->update($data, $article, $article->ArticlesDescription->first())) {
                DB::rollback();
                dd($e);
                return redirect()->route('admin.articles.index')->with('error', implodeArrayToHtml($this->articlesRepo->getErrors(), null));
            }


        } catch (\PDOException $e) {
            // app('sentry')->captureException($e);
            DB::rollback();
            dd($e);
            return redirect()->route('admin.articles.index')->with('error', implodeArrayToHtml($e->getMessage()));

        } catch (\Exception $e) {
            //app('sentry')->captureException($e);
            DB::rollback();
            dd($e);
            return redirect()->route('admin.articles.index')->with('error', implodeArrayToHtml($e->getMessage()));

        }
        
        DB::commit();
        return redirect()->route('admin.articles.index')->with('success', 'Pomyślnie zapisano !');

    }

}
