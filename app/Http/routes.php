<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'guardian', 'preview']], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'DashboardController@index']);

    Route::group(['prefix' => 'campaigns', 'as' => 'campaigns::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CampaignsController@index']);
        Route::get('/view/{id}', ['as' => 'show', 'uses' => 'CampaignsController@show']);
        Route::get('subcampaign/view/{id}', ['as' => 'sub', 'uses' => 'CampaignsController@subcampaign']);
        Route::get('/mailing/{id}', ['as' => 'mailing', 'uses' => 'CampaignsController@mailing']);
        Route::get('/new', ['as' => 'create', 'uses' => 'CampaignsController@create']);
        Route::post('/save_item', ['as' => 'save_item', 'uses' => 'CampaignsController@saveItem']);
        Route::post('/save_item_video', ['as' => 'save_item_video', 'uses' => 'CampaignsController@saveItemVideo']);
        Route::post('/send_mailing', ['as' => 'send_mailing', 'uses' => 'CampaignsController@sendMailing']);
        Route::get('/deposits', ['as' => 'deposits', 'uses' => 'CampaignsController@deposits']);
        Route::match(['get', 'post'], '/search', ['as' => 'search::campaign', 'uses' => 'CampaignsController@search']);

        Route::group([], function () {
            Route::match(['post', 'get'], '/store', ['as' => 'store', 'uses' => 'CampaignsController@store']);
        });
    });

    Route::group(['prefix' => 'reports', 'as' => 'reports::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'ReportsController@index']);
        Route::get('/single', ['as' => 'single', 'uses' => 'ReportsController@single']);
        Route::get('/invoice', ['as' => 'invoice', 'uses' => 'PdfController@invoice']);
    });

    Route::group(['prefix' => 'analytics', 'as' => 'analytics::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'AnalyticsController@index']);
        Route::get('/{id}/{type?}', ['as' => 'single', 'uses' => 'AnalyticsController@single']);
    });

    Route::group(['prefix' => 'pdf', 'as' => 'pdf::'], function () {
        Route::get('/print', ['as' => 'invoice'], 'PdfController@invoice');
//        Route::get('/print', 'PdfController@invoice');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'UserController@edit']);
        Route::get('/charts', ['as' => 'charts', 'uses' => 'UserController@charts']);
        /*Route::match(['get', 'post'], 'profile_edit', ['as' => 'edit.profile', 'uses' => 'UserController@editProfile']);
        Route::match(['get', 'post'], 'profile_pass', ['as' => 'edit.pass', 'uses' => 'UserController@editPass']);*/
    });

    Route::group(['prefix' => 'wallet', 'as' => 'wallet::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'WalletsController@index']);
    });

    Route::group(['prefix' => 'budget', 'as' => 'budget::'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'BudgetController@index']);
        Route::get('/deposits', ['as' => 'deposits', 'uses' => 'BudgetController@deposits']);

        Route::get('/invoices/{id}', ['as' => 'invoices', 'uses' => 'BudgetController@invoices']);

        // PayPal Payment
        Route::post('/paypal/store', ['as' => 'paypal.store', 'uses' => 'PayPalPaymentController@getCheckout']);
        Route::get('/paypal/done/{payment_id}', ['as' => 'paypal.done', 'uses' => 'PayPalPaymentController@getDone']);
        Route::get('/paypal/cancel/{payment_id}', ['as' => 'paypal.cancel', 'uses' => 'PayPalPaymentController@getCancel']);
        //Route::get('/paypal', ['as' => 'paypal', 'uses' => 'PayPalPaymentController@index']);
        //Route::get('/paypal/index', ['as' => 'paypal.index', 'uses' => 'PayPalPaymentController@index']);

        Route::post('/conekta', ['as' => 'conekta', 'uses' => 'ConektaController@conekta']);

        Route::post('/giftcard', ['as' => 'giftcard.exchange', 'uses' => 'GiftCardsController@exchange']);
    });

    Route::match(['get', 'post'], 'logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout']);

    Route::group([], function () {
        Route::match(['get', 'post'], 'profile_edit', ['as' => 'edit.profile', 'uses' => 'UserController@editProfile']);
        Route::match(['get', 'post'], 'profile_pass', ['as' => 'edit.pass', 'uses' => 'UserController@editPass']);
    });
});

Route::group(['middleware' => ['auth.ready']], function () {
    Route::get('/login', ['as' => 'auth.index', 'uses' => 'AuthController@index']);     //vista index
    Route::post('/login', ['as' => 'auth.login', 'uses' => 'AuthController@login']);    //form
    Route::post('/signUp', ['as' => 'auth.signUp', 'uses' => 'AuthController@signUp']);     //ruta post que registra al nuevo usuario
    Route::get('/register', ['as' => 'auth.register', 'uses' => 'AuthController@register']);//vista de registro
    Route::post('/restore', ['as' => 'auth.restore', 'uses' => 'AuthController@restore']);  //2do paso de recuperar contraseña
    Route::get('/restore/password/{id}/{token}', ['as' => 'auth.reset', 'uses' => 'AuthController@verify']); //3er paso de recuperar contraseña valida el token de nueva contraseña
    Route::get('/register/verify/{id}/{token}', ['as' => 'auth.verify', 'uses' => 'AuthController@verify']); //ruta que valida el correo
    Route::get('/restore/password', ['as' => 'auth.newpassword', 'uses' => 'AuthController@newpassword']);   //4to paso de recuperar contraseña vista para poner la nueva contraseña
    Route::post('/restore/password', ['as' => 'auth.newpass', 'uses' => 'AuthController@newpass']);         //5to paso de recuperar contraseña
    Route::get('/remove',['as'=> 'auth.remove','uses'=> 'AuthController@remove']); //cancela los codigos del usuario que se pasa
});

Route::get('/choose', ['as' => 'choose.platform', function () {
    return view('choose', [
        'color' => '#1565c0',
        'msg' => Input::has('msg') ? Input::get('msg') : 'Selecciona alguna de las plataformas.'
    ]);
}]);

Route::get('/terms', ['as' => 'terms',  'uses' => 'AuthController@terms']);