<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->name('auth.')->middleware('guest')->group(function(){
    Route::get('/login', 'LoginController@index')->name('login.index');
    Route::post('/login', 'LoginController@login')->name('login.login');
    Route::get('recuperar-senha', 'ResetPasswordController@showRecoverPasswordForm')->name('show-recover-password-form');
    Route::post('send-recover-link', 'ResetPasswordController@sendRecoverLink')->name('send-recover-link');
    Route::get('redefinir-senha/{remember_token}', 'ResetPasswordController@showResetPasswordForm')->name('show-reset-password-form');
    Route::post('reset-password', 'ResetPasswordController@reset')->name('reset');
});

Route::get('/logout', 'Auth\LoginController@logout')->name('auth.login.logout');

Route::namespace('Admin')->name('admin.')->middleware('auth')->group(function(){
    //dashboard
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
    //Users
    Route::resource('users', 'UserController');
    //Customers
    Route::resource('customers', 'CustomerController');
    //Products
    Route::resource('products', 'ProductController');
    //Orders
    Route::resource('orders', 'OrderController');
});





