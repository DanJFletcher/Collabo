<?php

Route::group([
    'prefix'     => 'messages',
], function () {

Route::get('/', 'MessagesController@index')->name('messages.index');
Route::get('conversations/{id}', 'ConversationsController@show')->name('conversations.show');

});