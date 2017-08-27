<?php

Route::group([
    'prefix'     => 'message',
], function () {

Route::get('/', 'MessagesController@index')->name('messages.index');
Route::get('/{id}', 'MessagesController@chatHistory')->name('messages.read');

});