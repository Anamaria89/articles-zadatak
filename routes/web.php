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

//Route::get('/', function () {
//    return view('welcome');
//});



Route::get('/', 'IndexController@index')->name('index');
//AUTH 
Route::any('/login', 'UsersController@login')->name('login');
//Route::get('/register', 'UsersController@create')->name('createuser');
//Route::post('/register', 'UsersController@register')->name('register');
Route::any('/logout', 'UsersController@logout')->name('logout');

// ARTICLES MODUL START
Route::get('/articles', 'ArticlesController@index')->name('articles.index');
Route::post('/articles', 'ArticlesController@index')->name('articles.index');
Route::get('/articles/create', 'ArticlesController@create')->name('articles.create');
Route::post('/articles/store', 'ArticlesController@store')->name('articles.store');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/articles/{article}/edit', 'ArticlesController@edit')->name('articles.edit');
Route::post('/articles/{article}/edit', 'ArticlesController@update')->name('articles.update');
Route::delete('/articles/{article}/delete', 'ArticlesController@delete')->name('articles.delete');
//ARTICLE MODUL END
