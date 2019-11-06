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

Route::redirect('/','articles');
Auth::routes();
Route::view('articles/datatable','articles-datatable')->name('articles.datatable')->middleware('auth');
Route::get('articles/get-datatable','ArticleController@getDatatable')->name('articles.getdatatable')->middleware('auth');
Route::resource('articles','ArticleController')->middleware('auth');
