<?php

Route::group(['middleware' => ['auth', 'language']], function () {
    Route::get('admin/articles', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@index');
});