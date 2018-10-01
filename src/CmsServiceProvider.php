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
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Redicon\CMS_Articles\Admin\ArticlesController');
        $this->loadViewsFrom(__DIR__.'/views/admin/articles', 'admin_articles');
        $this->publishes([
            __DIR__.'/views/admin/articles' => resource_path('views/vendor/admin/articles'),
        ]);
    }
}
