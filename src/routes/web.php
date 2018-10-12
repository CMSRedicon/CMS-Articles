<?php
Route::group(['middleware' => ['web','auth', 'language']], function () {
    /* Artykuły */
    Route::get('/admin/articles', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@index')->name('admin.articles.index');
    Route::get('/admin/articles/edit/{article_id}/{lang?}', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@edit')->name('admin.articles.edit');
    Route::post('/admin/articles/order/store', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@store')->name('admin.articles.order.store');

    /* Ajax */
    Route::post('/ajax/saveArticlesVisibility', 'Redicon\CMS_Articles\App\Http\Controllers\Ajax\AjaxController@saveArticlesVisibility');
});