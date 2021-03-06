<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});
Route::get('importExportView', 'HomeController@importExportView');

Route::get('export', 'HomeController@export')->name('export');

Route::post('import', 'HomeController@import')->name('import');
Route::get('/v1/callback', 'MyController@callback')->name('callback');

Route::get('/home', 'HomeController@index')->name('home');
