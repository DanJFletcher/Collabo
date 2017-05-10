<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('donations', 'DonationController@index')->name('donations');
Route::post('donations', 'DonationController@collect')->name('donations.collect');
Route::post('paypal', 'PaypalController@postPaypalPayment' )->name('paypal.collect');
Route::get('paypal/status', 'PaypalController@getPaypalSatus')->name('paypal.status');






