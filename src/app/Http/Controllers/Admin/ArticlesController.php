<?php

namespace Redicon\CMS_Articles\App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Redicon\CMS_Articles\App\Models\Articles;
use Redicon\CMS_Articles\App\Models\ArticlesCategories;
use Redicon\CMS_Articles\App\Repositories\ArticlesRepo;
use Redicon\CMS_Articles\App\Models\ArticlesDescription;
use Redicon\CMS_Articles\App\Http\Request\Admin\StoreArticlesRequest;
use Redicon\CMS_Articles\App\Http\Request\Admin\UpdateArticlesRequest;
use Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController;
use Redicon\CMS_Articles\App\Http\Request\Admin\StoreArticlesDescriptionRequest;

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
        $articlesCategories = [];
        ArticlesCategories::whereHas('ArticlesCategoriesDescription', function ($query) {
            $query->where('lang', 'pl');
        })->each(function ($item) use (&$articlesCategories) {
            $articlesCategories[$item->id] = $item->ArticlesCategoriesDescription->first()->name;
        });

        return view('admin_articles::index', compact('articles', 'articlesCategories'));
    }

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
     * Widok tworzenia articles_description
     * @param String $lang
     * @return void
     */
    public function create(int $articleId,String $lang = null)
    {

        if (is_null($lang)) {
            $lang = 'pl';
        }

        $article = Articles::where('id', $articleId)->firstOrFail();

        $articlesCategories = [];

        ArticlesCategories::whereHas('ArticlesCategoriesDescription', function ($query) use ($lang) {
            $query->where('lang', $lang);
        })->each(function ($item) use (&$articlesCategories) {
            $articlesCategories[$item->id] = $item->ArticlesCategoriesDescription->first()->name;
        });

        return view('admin_articles::create', compact('articlesCategories', 'lang','article'));

    }

    /**
     * Zapis artykułu
     *
     * @param StoreArticlesRequest $request
     * @return void
     */
    public function descriptionStore(StoreArticlesDescriptionRequest $request, int $articleId)
    {
        $data = $request->all();
        $article = Articles::where('id', $articleId)->firstOrFail();

        DB::beginTransaction();

        try {

            if (!$this->articlesRepo->descriptionStore($data, $article)) {
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
    
    // }

    /**
     * TODO
     * Edycja artykułu
     *
     * @param integer $article_id
     * @param string $lang
     * @return void
     */
    public function edit(int $articleId, string $lang = null)
    {

        if (is_null($lang)) {
            $lang = 'pl';
        }

        $article = Articles::where('id', $articleId)->firstOrFail();

        //jeżeli nie ma wersji językowej
        if (!hasLang($article, 'ArticlesDescription', $lang)) {
            return redirect()->action('\\' . ArticlesController::class . '@create', ['article_id' => $articleId,'lang' => $lang]);
        }

        $articlesDescription = ArticlesDescription::where('article_id', $articleId)->where('lang', $lang)->firstOrFail();
        $articlesCategories = $this->articlesRepo->getArticlesCategories($lang);
        $articlesSeo = $articlesDescription->ArticlesSeo->toArray() ?? array();
 
        return view('admin_articles::edit', compact('article', 'articlesDescription' ,'lang', 'articlesCategories', 'articlesSeo'));

    }

    /**
     * Update zasobu
     *
     * @param UpdateArticlesRequest $request
     * @param integer $article_id
     * @param integer $article_description_id
     * @return void
     */
    public function update(UpdateArticlesRequest $request, int $articleId, int $article_description_id)
    {

        $article = Articles::where('id', $articleId)->whereHas('ArticlesDescription', function ($q) use ($article_description_id) {
            $q->where('id', $article_description_id);
        })->firstOrFail();

        $data = $request->all();

        DB::beginTransaction();

        try {

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
