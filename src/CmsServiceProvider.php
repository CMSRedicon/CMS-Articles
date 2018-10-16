<?php

namespace Redicon\CMS_Articles;
use Artisan;
use App\Repositories\FileRepo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        //tłumaczenia
        $this->loadTranslationsFrom(__DIR__.'/lang', 'cms_articles_lang');

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //kontrolery
        $this->app->make('Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController');
        $this->app->make('Redicon\CMS_Articles\App\Http\Controllers\Ajax\AjaxController');

        //widoki
        $this->loadViewsFrom(__DIR__.'/views/admin/articles', 'admin_articles');
        $this->loadViewsFrom(__DIR__.'/views/partials', 'cms_articles_partials');
        $this->loadViewsFrom(__DIR__.'/views/menu', 'cms_articles_menu');

        //vendory
        $this->publishes([
            __DIR__.'/views/admin/articles' => resource_path('views/vendor/admin/articles'),
            __DIR__.'/public/assets/output' => public_path('vendor/cms_articles/assets'),
            __DIR__.'/public/assets/articles' => public_path('vendor/cms_articles/articles'),
        ], 'cms_articles_vendors');
 
        //pliki artykułu - zdjęcie główne
        $this->app->config['filesystems.disks.articles'] = array(
            'driver' => 'local',
            'root' => storage_path('app/articles')
        );

        //stworzenie folderu
        if (!Storage::has('articles')) {
            Storage::makeDirectory('articles');
        }
    }
}
