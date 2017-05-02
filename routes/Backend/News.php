<?php

Route::group([
    'prefix'     => 'news',
    'as'         => 'news.',
    'namespace'  => 'News',
], function () {

    /*
     *  Events
     */
    Route::get('/', 'NewsController@index')->name('index');
    Route::get('create', 'NewsController@create')->name('create');
    Route::post('create_post', 'NewsController@createPost')->name('create_post');
    
});