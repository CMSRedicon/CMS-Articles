<?php
namespace Redicon\CMS_Articles\App\Repositories;

use Redicon\CMS_Articles\App\Models\Articles;

/**
 * Logika dla paczki
 */
class ArticlesRepo {

    private $errors;
    private $articles_file_repo;
    public function __construct(){
        $this->errors = array();
        $this->articles_file_repo = new ArticlesFileRepo();

    }

    /**
     * Zwraca błędy
     *
     * @return array
     */
    public function getErrors() : array{
        return $this->errors;
    }

    /**
     * Zapis artykułu
     *
     * @param array $data
     * @return boolean
     */
    public function store(array $data): bool{

        if(empty($data)){
            $this->errors[] = "Brak danych!";
            return false;
        } 

        $article = Articles::create([
            'parent_id' => null, //todo
            'article_category_id' => $data['article_category_id'],
            'in_menu' => 1,
            'is_public' => !empty($data['articles_is_public']) ? 1:0,
            'template' => 'default',
            'order' => $data['articles_order']
        ]);
 

       $articlesDescription = $article->ArticlesDescription()->create([
            'slug' => $data['articles_seo_slug'] ?? null,
            'lang' => $data['articles_lang' ?? null],
            'name' => $data['articles_description_name'] ?? null,
            'lead' => $data['articles_description_lead'] ?? null,
            'description' => $data['articles_description_description'] ?? null,
        ]);

        if(!empty($data['articles_description_img_src'])){
            $articlesDescriptionImgSrc = $this->articles_file_repo->saveArticleImage($article->id, $articlesDescription->id, $data['articles_description_img_src']);
        }

        return true;
    }


}