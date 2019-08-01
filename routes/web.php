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
Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::group(
  ['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function(){

        
        
        Route::group(['middleware' => ['auth','auto-check-permission'] ] ,function(){
            Route::resource('governorate','GovernorateController');
            Route::resource('category','CategoryController');
            Route::resource('governorate.city','GovernorateCityController');
            Route::resource('client','ClientController');
            Route::resource('post','PostController');
            Route::resource('donation','DonationController');
            Route::resource('contact','ContactController');
            Route::resource('user','UserController')->middleware('role:admin');
            Route::resource('role','RoleController')->middleware('role:admin');
            Route::get('contactsearch','ContactController@search')->name('contact.search');
            Route::get('donationsearch','DonationController@search')->name('donation.search');
            Route::get('setting','SettingController@edit')->name('setting.edit')->middleware('role:admin|editor');;
            Route::post('setting','SettingController@store')->name('setting.store');
            Route::get('admin','AdminController@edit')->name('admin.edit');
            Route::post('admin','AdminController@store')->name('admin.store');
        
        
        } );
        
        


    });
