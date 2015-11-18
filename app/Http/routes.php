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

App::setLocale('es');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'DashboardController@index']);

    Route::group(['prefix' => 'campaigns', 'as' => 'campaigns::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CampaignsController@index']);
        Route::get('/view/{id}', ['as' => 'show', 'uses' => 'CampaignsController@show']);
        Route::get('/mailing/{id}', ['as' => 'show', 'uses' => 'CampaignsController@mailing']);
        Route::get('/new', ['as' => 'create', 'uses' => 'CampaignsController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'CampaignsController@store']);
        Route::post('/save_item', ['as' => 'save_item', 'uses' => 'CampaignsController@saveItem']);
    });

    Route::group(['prefix' => 'reports', 'as' => 'reports::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'ReportsController@index']);
        Route::get('/single', ['as' => 'single', 'uses' => 'ReportsController@single']);
    });

    Route::group(['prefix' => 'analytics', 'as' => 'analytics::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'AnalyticsController@index']);
        Route::get('/single', ['as' => 'single', 'uses' => 'AnalyticsController@single']);
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'UserController@edit']);
        Route::get('/charts', ['as' => 'charts', 'uses' => 'UserController@charts']);
    });

    Route::group(['prefix' => 'wallet', 'as' => 'wallet::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'WalletsController@index']);
    });

    Route::match(['get', 'post'], 'logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout']);

    //Rutas de ajax
    Route::group([], function () {
        Route::match(['get', 'post'], 'profile_edit', ['as' => 'edit.profile', 'uses' => 'UserController@editProfile']);
    });
});

Route::group(['middleware' => 'auth.ready'], function () {
    Route::get('login', ['as' => 'auth.index', 'uses' => 'AuthController@index']);
    Route::post('login', ['as' => 'auth.login', 'uses' => 'AuthController@login']);

});




