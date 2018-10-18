<?php
namespace Redicon\CMS_Articles\App\Repositories;

use Redicon\CMS_Articles\App\Repositories\ArticlesFileRepo;

abstract class Repositories {

    public $errors;
    public $articlesFileRepo;
    public function __construct()
    {
        $this->errors = array();
        $this->articlesFileRepo = new ArticlesFileRepo();

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


}