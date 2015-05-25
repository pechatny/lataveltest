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

Route::get('/', 'WelcomeController@index');

Route::get('/api/orders/create', 'Api\OrdersController@create');
Route::get('/api/orders', 'Api\OrdersController@orders');
Route::get('/api/orders/{id}', 'Api\OrdersController@order');
Route::get('/api/orders_where/two/{id_1}/{id_2}', 'Api\OrdersController@orders_where_two');
Route::get('/api/orders_where/not/{id_1}/{id_2}', 'Api\OrdersController@orders_where_not');
Route::get('/api/orders_where/only/{id_1}', 'Api\OrdersController@orders_where_only');

Route::get('/table', 'OrdersController@table');
Route::get('/sold', 'OrdersController@sold');


Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Event::listen('illuminate.query', function($query)
//{
//    var_dump($query);
//});
