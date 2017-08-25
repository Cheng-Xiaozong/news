<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//首页

Route::auth();
Route::get('/home', 'HomeController@index');
Route::group(['middleware'=>['auth']],function(){
    Route::get('/', 'Index\IndexController@index');
    Route::get('/index', 'Index\IndexController@indexPage');
    Route::get('/content', 'Index\IndexController@content');
    Route::get('/article', 'Article\ArticleController@index');
    Route::any('/article/create', 'Article\ArticleController@create');
    Route::any('/article/typeSelect/{type_id}', 'Article\ArticleController@typeSelect');
    Route::get('/article/detail/{id}', 'Article\ArticleController@detail');
    Route::get('/article/search/{content}', 'Article\ArticleController@search');
    Route::get('/article/delete/{id}', 'Article\ArticleController@delete');
    Route::any('/article/edit/{id}', 'Article\ArticleController@edit');
    Route::get('/article/editStatus/{id}', 'Article\ArticleController@editStatus');
    Route::get('/article/type', 'Article\ArticleController@typeIndex');
    Route::get('/article/editTypeStatus/{id}', 'Article\ArticleController@editTypeStatus');
    Route::any('/article/editType/{id}', 'Article\ArticleController@editType');
    Route::get('/article/deleteType/{id}', 'Article\ArticleController@deleteType');
    Route::any('/article/createType', 'Article\ArticleController@createType');
});
