<?php

namespace Redicon\CMS_Articles;
use Artisan;
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
        $this->app->make('Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController');
        $this->loadViewsFrom(__DIR__.'/views/admin/articles', 'admin_articles');
        $this->loadViewsFrom(__DIR__.'/views/partials', 'cms_articles_partials');
        $this->loadViewsFrom(__DIR__.'/views/menu', 'cms_articles_menu');

        //widoki
        $this->publishes([
            __DIR__.'/views/admin/articles' => resource_path('views/vendor/admin/articles'),
        ]);

        //assets
        $this->publishes([
            __DIR__.'/public/assets/output' => public_path('vendor/cms_articles/assets'),
        ]);

        //obrazek artykułu testowego
        $this->publishes([
            __DIR__.'/public/assets/articles' => public_path('vendor/cms_articles/articles'),
        ]);

    }
}
