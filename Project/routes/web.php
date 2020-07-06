<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', 'ApartmentsController@index')->name('home');

Route::get('/search', 'ApartmentsController@search')->name('search');

Route::get('/show/{id}', 'ApartmentsController@show')->name('show');

Route::get('/create', 'ApartmentsController@create')->name('create')->middleware('auth');
Route::post('/store', 'ApartmentsController@store')->name('store_apartment')->middleware('auth');

Route::get('/myApartments', 'ApartmentsController@myApartments')->name('my_apartments')->middleware('auth');

Route::get('/edit/{id}', 'ApartmentsController@edit')->name('edit')->middleware('auth');
Route::post('/update/{it}', 'ApartmentsController@update')->name('update')->middleware('auth');

Route::get('/delete/{id}', 'ApartmentsController@delete')->name('delete')->middleware('auth');

Route::get('/delete_image/{id}', 'PhotosController@delete')->name('delete_img')->middleware('auth');

Route::post('/informations_message/{id}', 'ApartmentsController@saveInformations')->name('informations');