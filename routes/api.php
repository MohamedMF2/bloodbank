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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group( ["prefix" => "v1" , 'namespace' => 'Api'] , function (){
    Route::get ('governorates' , 'MainController@governorates') ;
    Route::get ('cities' , 'MainController@cities') ;
    Route::get ('bloodtypes' , 'MainController@blood_types') ;
    Route::post('register' , 'AuthController@register') ;
    Route::post('login' , 'AuthController@login') ;
    Route::post('resetpassword','AuthController@reset_password');
    Route::post('newpassword','AuthController@new_password');

Route::group([ 'middleware' => 'auth:api'],function(){
    Route::get ('categories' , 'MainController@categories') ;
    Route::get ('posts' , 'MainController@posts') ;
    Route::get ('post/{id}' , 'MainController@post') ;
    Route::get('settings','MainController@settings');
    Route::post('profile','AuthController@profile');
    Route::post('contacts','AuthController@contacts');
    Route::post('donationrequest','AuthController@donation_request');
    Route::get('donationrequests','MainController@donation_requests');
    Route::get('donationrequest/{id}','MainController@donation_request');
    Route::post('favouriteposts','MainController@favourite_posts');
    Route::post('togglefavourite','MainController@toggle_favourite');
    Route::post('notificationsetting','AuthController@notification_setting');
    Route::post('registertoken','AuthController@registerToken');
    Route::post('removetoken','AuthController@removeToken');

});

});