<?php
namespace App\Callbacks;

class PostUpdate {

     /**
     * Zadania które zostaną odpalone w szkielecie po update paczki
     *
     * @return array
     */
    public function getCommands() : array{
    
        return [
            'php artisan migrate --path=vendor\redicon\cms_articles\src\database\migrations'
        ];
        
    }
}