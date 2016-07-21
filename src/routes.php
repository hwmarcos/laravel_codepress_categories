<?php

Route::group(['prefix' => 'admin/categories', 'as' => 'admin.categories.', 'namespace' => 'CodePress\CodeCategory\Controllers'], function () {
    Route::get('/', ['uses' => 'AdminCategororiesController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'AdminCategororiesController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'AdminCategororiesController@store', 'as' => 'store']);
});