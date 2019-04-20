<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//use App\Http\Resources\User;
//use App\Http\Resources\Article;
use App\User;
use App\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\ArticleCollection;
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('/', 'IndexController@index')->name('index');
Route::get('/articles', function () {
            return new ArticleCollection(Article::all());
});

Route::any('/login', 'UsersController@login')->name('login');
//Route::get('/register', 'UsersController@create')->name('createuser');
//Route::post('/register', 'UsersController@register')->name('register');
Route::any('/logout', 'UsersController@logout')->name('logout');
//Route::post('/articles', 'ArticlesController@index')->name('articles.index');
Route::get('/articles/create', 'api\ArticlesController@create')->name('api.articles.create');
Route::post('/articles/store', 'api\ArticlesController@store')->name('api.articles.store');
Route::get('/articles/{article}', 'api\ArticlesController@show')->name('api.articles.show');
Route::get('/articles/{article}/edit', 'api\ArticlesController@edit')->name('api.articles.edit');
Route::post('/articles/{article}/edit', 'api\ArticlesController@update')->name('api.articles.update');
Route::get('/articles/{article}/delete', 'api\ArticlesController@delete')->name('api.articles.delete');
//Route::get('/articles', 'ArticlesController@index')->name('articles.index');