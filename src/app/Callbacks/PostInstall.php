<?php
namespace App\Callbacks;

class PostInstall {

    public function run(){

        try{
            \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--path' => 'vendor\redicon\cms_articles\src\database\migrations']);
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Redicon\CMS_Articles\Database\Seeds\DatabaseSeeder']);
        }catch(\Exception $e){
            echo $e->getMessage() . PHP_EOL;
        }
        
    }

}