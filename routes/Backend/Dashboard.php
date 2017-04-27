<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('donations', 'DonationController@index')->name('donations');
Route::post('donations', 'DonationController@collect')->name('donations.collect');




