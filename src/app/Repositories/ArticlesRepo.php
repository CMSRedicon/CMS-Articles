<?php
namespace Redicon\CMS_Articles\App\Repositories;

use App\Models\GlobalSeo;
use Redicon\CMS_Articles\App\Models\Articles;
use Redicon\CMS_Articles\App\Models\ArticlesCategories;
use Redicon\CMS_Articles\App\Models\ArticlesDescription;

/**
 * Logika dla paczki
 */
class ArticlesRepo extends Repositories
{
    public function __construct(){
        parent::__construct();
    }
    /**
     * Pobiera kategorie per lang
     *
     * @param String $lang
     * @return array
     */
    public function getArticlesCategories(String $lang): array
    {
        $articlesCategories = [];
        ArticlesCategories::whereHas('ArticlesCategoriesDescription', function ($query) use ($lang) {
            $query->where('lang', $lang);
        })->each(function ($item) use (&$articlesCategories) {
            $articlesCategories[$item->id] = $item->ArticlesCategoriesDescription->first()->name;
        });
        return $articlesCategories;
    }

    /**
     * Zapis artykułu
     *
     * @param array $data
     * @return boolean
     */
    public function store(array $data): bool
    {

        if (empty($data)) {
            $this->errors[] = "Brak danych!";
            return false;
        }
        $data['lang'] = 'pl';
        $data['order'] = (Articles::all()->pluck('order')->max() ?? 0) + 1;

        $article = Articles::create($data);
        $articleDescription = $article->ArticlesDescription()->create($data);

        $slug = '/pl/' . str_slug($data['name'], '-');

        GlobalSeo::create([
            'slug' => $slug,
            'instance' => get_class($articleDescription),
            'instance_id' => $articleDescription->id,
            'lang' => $articleDescription->lang,
        ]);

        return true;
    }
    /**
     * Zapis artykułu
     *
     * @param array $data
     * @return boolean
     */
    public function descriptionStore(array $data, Articles $article): bool
    {

        if (empty($data)) {
            $this->errors[] = "Brak danych!";
            return false;
        }

        $articlesDescription = $article->ArticlesDescription()->create([
            'lang' => $data['articles_lang'],
            'name' => $data['name'] ?? null,
            'lead' => $data['lead'] ?? null,
            'description' => $data['description'] ?? null,
        ]);

        if (isset($data['articles_seo_title']) || isset($data['articles_seo_meta']) || isset($data['articles_seo_keywords'])) {
            $articlesDescription->ArticlesSeo()->updateOrCreate(
                ['articles_description_id' => $articlesDescription->id],
                [
                    'title' => !empty($data['articles_seo_title']) ? $data['articles_seo_title'] : null,
                    'meta' => !empty($data['articles_seo_meta']) ? $data['articles_seo_meta'] : null,
                    'keywords' => !empty($data['articles_seo_keywords']) ? $data['articles_seo_keywords'] : null,
                ]);
        }

        if (!empty($data['img_src'])) {
            $path = $article->id . '/' . $articlesDescription->id . '/' . $data['articles_lang'];
            $articlesDescriptionImgSrc = $this->articlesFileRepo->saveArticleImage($path, $data['img_src']);
            $articlesDescription->img_src = $articlesDescriptionImgSrc;
            $articlesDescription->save();
        }

        if (!empty($data['slug'])) {
            GlobalSeo::create([
                'slug' => $data['slug'],
                'instance' => get_class($articlesDescription),
                'instance_id' => $articlesDescription->id,
                'lang' => $articlesDescription->lang,
            ]);
        }

        return true;
    }

    /**
     * Update danych
     *
     * @param array $data
     * @param Articles $article
     * @return boolean
     */
    public function update(array $data, Articles $article, ArticlesDescription $articlesDescription): bool
    {
        if (empty($data)) {
            $this->errors[] = "Brak danych!";
            return false;
        }

        if (isset($data['articles_is_public'])) {
            $article->is_public = $data['articles_is_public'];
        }

        if (isset($data['parent_id'])) {
            $article->parent_id = $data['parent_id'];
        }

        if (empty($data['article_category_id'])) {
            $article->article_category_id = null;
        }else{
            $article->article_category_id = $data['article_category_id'];
        }

        if (isset($data['in_menu'])) {
            $article->in_menu = $data['in_menu'];
        }

        if (isset($data['description'])) {
            $articlesDescription->description = $data['description'];
        }

        if (isset($data['lead'])) {
            $articlesDescription->lead = $data['lead'];
        }

        if (isset($data['name'])) {
            $articlesDescription->name = $data['name'];
        }

        if (!empty($data['img_src'])) {
            $path = $article->id . '/' . $articlesDescription->id . '/' . $articlesDescription->lang;
            if (!empty($articlesDescription->img_src)) {
                $this->articlesFileRepo->deleteArticleFiles($path);
            }
            $articlesDescription->img_src = $this->articlesFileRepo->saveArticleImage($path, $data['img_src']);
        }

        $articlesDescription->ArticlesSeo()->updateOrCreate(
            ['articles_description_id' => $articlesDescription->id],
            [
                'title' => !empty($data['articles_seo_title']) ? $data['articles_seo_title'] : null,
                'meta' => !empty($data['articles_seo_meta']) ? $data['articles_seo_meta'] : null,
                'keywords' => !empty($data['articles_seo_keywords']) ? $data['articles_seo_keywords'] : null,
            ]
        );

        if(!empty($data['slug'])){
            GlobalSeo::slugs($articlesDescription)->updateOrCreate([
                'instance_id' => $articlesDescription->id,
                'lang' => $articlesDescription->lang,
                'instance' => get_class($articlesDescription)
            ],[
                'slug' => $data['slug']
            ]);
        }

        $article->save();
        $articlesDescription->save();
        return true;
    }

}
