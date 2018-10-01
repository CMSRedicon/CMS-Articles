<?php

Route::group(['middleware' => ['auth', 'language']], function () {
    Route::get('articles', 'Redicon\CMS_Articles\Admin\ArticlesController@index');
});