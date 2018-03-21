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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/cadastrar', 'HomeController@store')->name('store');
Route::delete('/deletar/{id}', 'HomeController@destroy')->name('home.destroy');
Route::resource('/taxas', 'TaxasController');
Route::get('search/autocomplete', 'SearchController@autocomplete');

