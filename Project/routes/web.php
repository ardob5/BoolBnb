<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', 'ApartmentsController@index')->name('home'); //ROTTA DELLA HOMEPAGE

Route::get('/search', 'ApartmentsController@search')->name('search'); //ROTTA DEI RISULTATI DI RICERCA

Route::get('/show/{id}', 'ApartmentsController@show')->name('show'); //ROTTA DELLA VISTA DETTAGLI APPARTAMENTO

Route::get('/create', 'ApartmentsController@create')->name('create')->middleware('auth'); //ROTTA DELLA CREAZIONE APPARTAMENTO CON UTENTE VERIFICATO
Route::post('/store', 'ApartmentsController@store')->name('store_apartment')->middleware('auth'); //ROTTA DELL'UPLOAD DATI CREATI SU DATABASE

Route::get('/myApartments', 'ApartmentsController@myApartments')->name('my_apartments')->middleware('auth'); //ROTTA DELLA VISTA APPARTAMENTI PROPRIETARI DELL'UTENTE

Route::get('/edit/{id}', 'ApartmentsController@edit')->name('edit')->middleware('auth'); //ROTTA DELL'EDITING APPARTAMENTO
Route::post('/update/{it}', 'ApartmentsController@update')->name('update')->middleware('auth'); //ROTTA DELL'UPLOAD DATI MODIFICATI APPARTAMENTO

Route::get('/delete/{id}', 'ApartmentsController@delete')->name('delete')->middleware('auth'); //ROTTA PER LA CANCELLAZIONE DAL DATABASE DELL'APPARTAMENTO SELEZIONATO

Route::get('/delete_image/{id}', 'PhotosController@delete')->name('delete_img')->middleware('auth'); //ROTTA PER LA CANCELLAZIONE DELLE FOTO SELEZIONATE RELATIVE ALL'APPARTAMENTO SELEZIONATO

Route::get('/stats/{id}', 'ApartmentsController@stats')->name('stats')->middleware('auth');

Route::post('/informations_message/{id}', 'ApartmentsController@saveInformations')->name('informations'); //ROTTA I MESSAGGI INVIATI DA SALVARE NEL DATABASE

Route::get('/show_msg/{id}', 'ApartmentsController@showMsg')->name('show_msg')->middleware('auth');

Route::get('/payment/process', 'PaymentsController@process')->name('payment.process');
