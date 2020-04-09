<?php

/*
|--------------------------------------------------------------------------
| Backpack Crud Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


/*Route::group(['namespace' => 'Auth'], function(){
	Route::get('login', 'LoginController@index');
	Route::get('register', 'RegisterController@index');
	Route::get('password/reset', 'ResetPasswordController@index');
});*/
Auth::routes();

Route::group(['middleware' => 'guest'], function(){

	Route::get('inc/unauthorized', function(){
		return view('inc/unauthorized');
	});

	Route::get('lessons', 'LessonsController@index')->name('lessons.index');
	Route::get('plans', 'PlansController@index')->name('plans.index');
	Route::get('plan/{plan}', 'PlansController@show')->name('plans.show');
	Route::get('braintree/token', 'BraintreeTokenController@token');
	Route::post('subscribe', 'SubscriptionsController@store')->name('subscribe.store');
});

Route::group(['middleware' => 'auth'], function(){
	Route::get('/', 'HomeController@index');
});



//Admin group
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){
	CRUD::resource('customer', 'Admin\CustomerCrudController');
	CRUD::resource('lesson', 'Admin\LessonCrudController');
	CRUD::resource('category', 'Admin\CategoryCrudController');
});

//Page Routes
Route::get('{page}/{subs?}', ['uses' => 'PageController@index'])
     ->where(['page' => '^((?!admin).)*$', 'subs' => '.*']);



