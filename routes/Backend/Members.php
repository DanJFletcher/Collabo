<?php

Route::group([
    'prefix'     => 'members',
    'as'         => 'members.',

], function () {

    /*
     *  Members
     */

    Route::get('/','MembersController@index' )->name('index');
    Route::get('show','MembersController@show')->name('show');
    Route::post('email-user', 'MembersController@mailUser')->name('email-user');
});


