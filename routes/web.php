<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'Auth\LoginController@index')->name('auth.login.index');
Route::post('/login', 'Auth\LoginController@login')->name('auth.login.login');
Route::get('/logout', 'Auth\LoginController@logout')->name('auth.login.logout');

//dashboard
Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard.index');