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
    Route::get('/push/articleType', 'Push\PushController@articleType');
    Route::get('/push/articleTypeSelect/{id}', 'Push\PushController@articleTypeSelect');
    Route::get('/push/searchType/{content}', 'Push\PushController@searchType');
    Route::any('/push/editArticleType/{id}', 'Push\PushController@editArticleType');
    Route::get('/push/editArticleTypeStatus/{id}/{pid}', 'Push\PushController@editArticleTypeStatus');
    Route::get('/push/deleteArticleType/{id}/{pid}', 'Push\PushController@deleteArticleType');
    Route::any('/push/addArticleType', 'Push\PushController@addArticleType');
    Route::get('/push/appList', 'Push\PushController@appList');
    Route::any('/push/createApp', 'Push\PushController@createApp');
    Route::any('/push/deleteApp/{id}', 'Push\PushController@deleteApp');
    Route::any('/push/editApp/{id}', 'Push\PushController@editApp');
    Route::any('/push/editAppStatus/{id}', 'Push\PushController@editAppStatus');
});
