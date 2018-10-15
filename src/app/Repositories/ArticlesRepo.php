<?php
namespace Redicon\CMS_Articles\App\Repositories;

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


}