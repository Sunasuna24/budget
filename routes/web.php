<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/transactions/create', 'TransactionsController@create');

Route::get('/transactions/{category?}', 'TransactionsController@index');

Route::post('/transactions', 'TransactionsController@store');
Route::put('/transactions/{transaction}', 'TransactionsController@update');
Route::get('/transactions/{transaction}', 'TransactionsController@edit');
Route::delete('/transactions/{transaction}', 'TransactionsController@destroy');