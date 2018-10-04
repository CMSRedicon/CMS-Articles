<?php
namespace App\Callbacks;

class PostInstall {

    private $parent_vendor_path;

    public function __construct(String $parent_vendor_path)
    {
        $this->parent_vendor_path = $parent_vendor_path;
    }

    public function run(){

        require_once $this->parent_vendor_path;

        try{
            \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--path' => 'vendor\redicon\cms_articles\src\database\migrations']);
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Redicon\CMS_Articles\Database\Seeds\DatabaseSeeder']);
        }catch(\Exception $e){
            echo $e->getMessage() . PHP_EOL;
        }
        
    }

}