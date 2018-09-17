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
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home'); //概览
    Route::resource('/theme', 'ThemeController');
    Route::get('/theme/{id}/option','OptionController@index');
    Route::get('/option/load','OptionController@load_data');
    Route::get('excel/export','ExcelController@export');
    Route::get('excel/import','ExcelController@import');
});
