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
    Route::get('user','ReportController@userReports')->name('user');
    Route::get('user-table','ReportController@userReportsTable')->name('user-table');
    Route::get('team','ReportController@teamReports')->name('team');
    Route::get('team-table','ReportController@teamReportsTable')->name('team-table');
    Route::get('event','ReportController@eventReports')->name('event');
    Route::get('event-table','ReportController@eventReportsTable')->name('event-table');
    Route::get('donations','ReportController@donationReports')->name('donation');
    Route::get('donations-table','ReportController@donationReportsTable')->name('donation-table');

});







