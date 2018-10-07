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

Route::get('/', 'IndexController@index')->middleware('checkweixin');
Route::resource('/v1','IndexController');
Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home'); //概览
    Route::resource('/theme', 'ThemeController');
    Route::get('/theme/{id}/option','OptionController@index');
    Route::get('/theme/{id}/option/create','OptionController@create');
    Route::get('/option/load','OptionController@load_data');
    Route::post('/excel/export','ExcelController@export');
    Route::post('/excel/import','ExcelController@import');
});
Route::get('/getconfig','WechatController@getconfig');
//weixin login
Route::get('auth/weixin', 'WechatController@redirectToProvider');
Route::get('auth/weixin/callback', 'WechatController@handleProviderCallback');
//file
Route::post('/file/uploadPicture', 'FileController@uploadPicture');
