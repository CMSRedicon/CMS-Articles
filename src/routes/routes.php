<?php

Route::group(['middleware' => ['auth', 'language']], function () {
    Route::get('articles', 'Redicon\CMS_Articles\App\Http\Controllers\Admin\ArticlesController@index');
});