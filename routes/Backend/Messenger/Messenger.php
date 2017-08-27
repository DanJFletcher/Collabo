<?php

Route::group([
    'prefix'     => 'messaging',
], function () {

Route::get('/', 'MessengerController@index')->name('messenger.index');
Route::get('messaging/{id}', 'MessengerController@chatHistory')->name('message.read');

});