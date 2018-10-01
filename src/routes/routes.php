<?php
Route::group(['middleware' => ['web','auth', 'language']], function () {
    Route::get('/admin/articles', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@index');
});