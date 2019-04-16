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

//Route::get('/articles', 'ArticlesController@index')->name('articles.index');