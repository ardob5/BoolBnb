<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', 'ApartmentsController@index')->name('home');
