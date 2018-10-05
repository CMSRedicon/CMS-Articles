<?php
namespace App\Callbacks;

class PostUpdate {

     /**
     * Zadania które zostaną odpalone w szkielecie po update paczki
     * Niestety narazie tylko ten sposób wywołania działa (shell_exec wywołanie w postPackageUpdate z skryptu composera)
     *
     * @return array
     */
    public function getCommands() : array{
    
        return [
            'php artisan migrate --path=vendor\redicon\cms_articles\src\database\migrations'
        ];
        
    }
}