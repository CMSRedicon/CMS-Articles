<?php
namespace Redicon\CMS_Articles\App\Repositories;

use Redicon\CMS_Articles\App\Models\Articles;

/**
 * Logika dla paczki
 */
class ArticlesRepo {

    private $errors;
    public function __construct(){
        $this->errors = array();
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

        dd($data);
        $article->ArticlesDescription()->create([]);

        return true;
    }


}