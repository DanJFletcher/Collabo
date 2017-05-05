<?php

Route::group([
    'prefix'     => 'reports',
    'as'         => 'reports.',
    'namespace'  => 'Reports',
], function () {

    /*
     *  Events
     */
    Route::get('/', 'ReportController@index')->name('index');
    Route::get('create', 'ReportController@create')->name('create');
    Route::post('create_post', 'ReportController@createPost')->name('create_post');

});







