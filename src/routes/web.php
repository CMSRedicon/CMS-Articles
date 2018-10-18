<?php
Route::group(['middleware' => ['web','auth', 'language']], function () {
    
    /* Artykuły */
    Route::get('/admin/articles', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@index')->name('admin.articles.index');
    Route::get('/admin/articles/create/{article_id}/{lang?}', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@create')->name('admin.articles.create');
    Route::get('/admin/articles/edit/{article_id}/{lang?}', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@edit')->name('admin.articles.edit');
    Route::post('/admin/articles/update/{article_id}/{article_description_id}', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@update')->name('admin.articles.update');
    Route::post('/admin/articles/order/store', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@store')->name('admin.articles.order.store');
    Route::get('/admin/articles/delete/{article_id}', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@delete')->name('admin.articles.delete');
   
    Route::post('/admin/articles/description/store/{article_id}', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@descriptionStore')->name('admin.articles.description.store');
    Route::post('/admin/articles/store', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@store')->name('admin.articles.store');
   

    /* Kategorie artykułów */
    Route::get('/admin/articles/categories', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesCategoriesController@index')->name('admin.articles.categories.index');
    Route::get('/admin/articles/categories/create', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesCategoriesController@create')->name('admin.articles.categories.create');

    /* Ajax */
    Route::post('/ajax/saveArticlesVisibility', 'Redicon\CMS_Articles\App\Http\Controllers\Ajax\AjaxController@saveArticlesVisibility');
});