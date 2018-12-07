<?php
namespace App\Callbacks;

class PostInstall {

    /**
     * Zadania które zostaną odpalone w szkielecie po instalacji paczki
     * Niestety narazie tylko ten sposób wywołania działa (shell_exec wywołanie w postPackageInstall z skryptu composera)
     *
     * @return array
     */
    public function getCommands() : array{
    
        return [
            'php artisan migrate --path=vendor\redicon\cms_articles\src\database\migrations',
            'php artisan db:seed --class=Redicon\CMS_Articles\Database\Seeds\DatabaseSeeder',
            'php artisan vendor:publish --provider=Redicon\CMS_Articles\CmsServiceProvider',
        ];
        
    }

}