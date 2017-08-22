<?php

Route::group([
    'prefix'     => 'teams',
    'as'         => 'teams.',
    'namespace' => 'Teamwork'

], function () {

    Route::get('/', 'TeamController@index')->name('index');
    Route::get('create', 'TeamController@create')->name('create');
    Route::post('teams', 'TeamController@store')->name('store');
    Route::get('edit/{id}', 'TeamController@edit')->name('edit');
    Route::put('edit/{id}', 'TeamController@update')->name('update');
    Route::delete('destroy/{id}', 'TeamController@destroy')->name('destroy');

    Route::get('switch/{id}', 'TeamController@switchTeam')->name('switch');
    Route::post('join', 'TeamController@joinTeam')->name('join');
    Route::get('view-join/{id}', 'TeamController@seeTeam')->name('view');

    Route::get('members/{id}', 'TeamMemberController@show')->name('members.show');
    Route::get('members/resend/{invite_id}', 'TeamMemberController@resendInvite')->name('members.resend_invite');
    Route::post('members/{id}', 'TeamMemberController@invite')->name('members.invite');
    Route::delete('members/{id}/{user_id}', 'TeamMemberController@destroy')->name('members.destroy');

    Route::delete('members/leave/{id}/{user_id}', 'TeamMemberController@leave')->name('members.leave');

    Route::get('accept/{token}', 'AuthController@acceptInvite')->name('accept_invite');
    Route::get('deny/{token}', 'AuthController@denyInvite')->name('deny_invite');

    Route::get('create/event/{id}', 'TeamController@event')->name('create.event');
});
//
//->middleware('teamowner')
