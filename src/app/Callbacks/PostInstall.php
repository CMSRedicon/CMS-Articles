<?php
namespace App\Callbacks;

class PostInstall {

    /**
     * Zadania które zostaną odpalone w szkielecie po instalacji paczki
     *
     * @return array
     */
    public function getCommands() : array{
    
        return [
            'php artisan migrate --path=vendor\redicon\cms_articles\src\database\migrations',
            'php artisan db:seed --class=Redicon\CMS_Articles\Database\Seeds\DatabaseSeeder'
        ];
        
    }

}