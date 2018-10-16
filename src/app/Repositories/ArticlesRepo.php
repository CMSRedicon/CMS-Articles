<?php
namespace Redicon\CMS_Articles\App\Repositories;

use Illuminate\Support\Collection;
use Redicon\CMS_Articles\App\Models\Articles;
use Redicon\CMS_Articles\App\Models\ArticlesDescription;

/**
 * Logika dla paczki
 */
class ArticlesRepo
{

    private $errors;
    private $articles_file_repo;
    public function __construct()
    {
        $this->errors = array();
        $this->articles_file_repo = new ArticlesFileRepo();

    }

    /**
     * Zwraca błędy
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Przepisuje nazwy zmiennych
     *
     * @param Article $article
     * @return Collection
     */
    public function prepareArticleToEditable(Articles $article): Collection
    {

        $tmp = collect($article->toArray());
        $tmp->put('articles_description_name', $article->ArticlesDescription->name);
        $tmp->put('articles_description_lead', $article->ArticlesDescription->lead);
        $tmp->put('articles_description_img_src', $article->ArticlesDescription->img_src);
        $tmp->put('articles_order', $article->order);
        $tmp->put('articles_description_description', $article->ArticlesDescription->description);
        $tmp->put('articles_seo_title', $article->ArticlesDescription->ArticlesSeo->title ?? null);
        $tmp->put('articles_seo_meta', $article->ArticlesDescription->ArticlesSeo->meta ?? null);
        $tmp->put('articles_seo_keywords', $article->ArticlesDescription->ArticlesSeo->keywords ?? null);
        $tmp->put('articles_is_public', $article->is_public);
        $tmp->put('article_category_id', $article->article_category_id);
        $tmp->put('articles_description_slug', $article->ArticlesDescription->slug);
        $tmp->put('articles_description_id', $article->ArticlesDescription->id);

        return $tmp;
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

        $article = Articles::create([
            'parent_id' => null, //todo
            'article_category_id' => $data['article_category_id'],
            'in_menu' => 1,
            'is_public' => !empty($data['articles_is_public']) ? 1 : 0,
            'template' => 'default',
            'order' => $data['articles_order'],
        ]);

        $articlesDescription = $article->ArticlesDescription()->create([
            'slug' => $data['articles_description_slug'] ?? null,
            'lang' => $data['articles_lang' ?? null],
            'name' => $data['articles_description_name'] ?? null,
            'lead' => $data['articles_description_lead'] ?? null,
            'description' => $data['articles_description_description'] ?? null,
        ]);

        if (!empty($data['articles_seo_title']) || !empty($data['articles_seo_meta']) || !empty($data['articles_seo_keywords'])) {
            $articlesDescription->ArticlesSeo()->create([
                'title' => $data['articles_seo_title'] ?? null,
                'meta' => $data['articles_seo_meta'] ?? null,
                'keywords' => $data['articles_seo_keywords'] ?? null,
            ]);
        }

        if (!empty($data['articles_description_img_src'])) {
            $articlesDescriptionImgSrc = $this->articles_file_repo->saveArticleImage($article->id, $articlesDescription->id, $data['articles_description_img_src']);
            $articlesDescription->img_src = $articlesDescriptionImgSrc;
            $articlesDescription->save();
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
 
        if (isset($data['parent_id'])) {
            $article->parent_id = $data['parent_id'];
        }

        if (isset($data['article_category_id'])) {
            $article->article_category_id = $data['article_category_id'];
        }

        if (isset($data['in_menu'])) {
            $article->in_menu = $data['in_menu'];
        }

        if (isset($data['articles_order'])) {
            $article->order = $data['articles_order'];
        }

        if (isset($data['articles_description_description'])) {
            $articlesDescription->description = $data['articles_description_description'];
        }

        if (isset($data['articles_description_slug'])) {
            $articlesDescription->slug = $data['articles_description_slug'];
        }

        if (isset($data['articles_description_name'])) {
            $articlesDescription->name = $data['articles_description_name'];
        }

        if (!empty($data['articles_description_img_src'])) {
            if (!empty($articlesDescription->img_src)) {
                $path = $article->id . '/' . $articlesDescription->id;
                $this->articles_file_repo->deleteArticleFiles($path);
            }
            $articlesDescription->img_src = $this->articles_file_repo->saveArticleImage($article->id, $articlesDescription->id, $data['articles_description_img_src']);
        }

        if (!empty($data['articles_seo_title']) || !empty($data['articles_seo_meta']) || !empty($data['articles_seo_keywords'])) {

            if(empty($articlesDescription->ArticlesSeo)){
                $articlesDescription->ArticlesSeo()->create([
                    'title' => $data['articles_seo_title'] ?? null,
                    'meta' => $data['articles_seo_meta'] ?? null,
                    'keywords' => $data['articles_seo_keywords'] ?? null,
                ]);
            }else{
                $articlesDescription->ArticlesSeo()->update([
                    'title' => $data['articles_seo_title'] ?? null,
                    'meta' => $data['articles_seo_meta'] ?? null,
                    'keywords' => $data['articles_seo_keywords'] ?? null,
                ]);
            }
        }else{
            $articlesDescription->ArticlesSeo()->delete();
        }

        $article->save();
        $articlesDescription->save();

        return true;
    }

}
