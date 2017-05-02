<?php

Route::group([
    'prefix'     => 'events',
    'as'         => 'events.',
    'namespace'  => 'Events',
], function () {

    /*
     *  Events
     */
    Route::get('/', 'EventController@index')->name('index');
    Route::get('create', 'EventController@create')->name('create');
    Route::post('create_post', 'EventController@createPost')->name('create_post');
    
});