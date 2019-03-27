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
//后台
Route::any('admin/index','Admin\AdminController@index');
Route::any('admin/top','Admin\AdminController@top');
Route::any('admin/main','Admin\AdminController@main');
Route::any('admin/menu','Admin\AdminController@menu');
//前台
Route::any('watch/index','Watch\WatchController@index');