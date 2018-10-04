<?php
namespace App\Callbacks;

class PostInstall {

    public function getCommands() : array{
    
        return [
        'php artisan migrate:fresh --path=vendor\redicon\cms_articles\src\database\migrations',
        'php artisan db:seed --class=Redicon\CMS_Articles\Database\Seeds\DatabaseSeeder'
        ];
        
    }

}