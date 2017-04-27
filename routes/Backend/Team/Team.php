<?php

    Route::get('/', 'TeamController@index')->name('teams.index');
    Route::get('create', 'TeamController@create')->name('teams.create');
    Route::post('teams', 'TeamController@store')->name('teams.store');
    Route::get('edit/{id}', 'TeamController@edit')->name('teams.edit');
    Route::put('edit/{id}', 'TeamController@update')->name('teams.update');
    Route::delete('destroy/{id}', 'TeamController@destroy')->name('teams.destroy');

    Route::get('switch/{id}', 'TeamController@switchTeam')->name('teams.switch');
    Route::post('join', 'TeamController@joinTeam')->name('teams.join');
    Route::get('view-join/{id}', 'TeamController@seeTeam')->name('teams.view');

    Route::get('members/{id}', 'TeamMemberController@show')->name('teams.members.show');
    Route::get('members/resend/{invite_id}', 'TeamMemberController@resendInvite')->name('teams.members.resend_invite');
    Route::post('members/{id}', 'TeamMemberController@invite')->name('teams.members.invite');
    Route::delete('members/{id}/{user_id}', 'TeamMemberController@destroy')->name('teams.members.destroy');

    Route::delete('members/leave/{id}/{user_id}', 'TeamMemberController@leave')->name('teams.members.leave');

    Route::get('accept/{token}', 'AuthController@acceptInvite')->name('teams.accept_invite');
    Route::get('deny/{token}', 'AuthController@denyInvite')->name('teams.deny_invite');
