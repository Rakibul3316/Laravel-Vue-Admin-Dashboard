<?php

use Illuminate\Support\Facades\Route;

Route::group( [

    'middleware' => 'api',
    'prefix'     => 'auth',

], function ( $router ) {

    Route::post( '/login', 'AuthController@login' );
    Route::post( '/signup', 'AuthController@signup' );
    Route::post( '/logout', 'AuthController@logout' );
    Route::post( '/refresh', 'AuthController@refresh' );
    Route::post( '/me', 'AuthController@me' );

} );

Route::apiResource( '/employee', 'Api\EmployeeController' );
Route::apiResource( '/supplier', 'Api\SuppliersController' );
Route::apiResource( '/category', 'Api\CategoryController' );
Route::apiResource( '/product', 'Api\ProductController' );
Route::apiResource( '/expense', 'Api\ExpensController' );
Route::apiResource( '/customer', 'Api\CustomerController' );

Route::post( '/salary/paid/{id}', 'Api\SalaryController@paid' );
Route::get( '/salary', 'Api\SalaryController@allSalary' );
Route::get( '/salary/view/{id}', 'Api\SalaryController@viewSalary' );
Route::put( '/stock/update/{id}', 'Api\ProductController@stockUpdate' );

Route::get( '/getting/product/{id}', 'Api\PosController@getProduct' );
Route::post( '/orderdone', 'Api\PosController@orderDone' );
Route::post( '/search/order', 'Api\PosController@searchOrderDate' );

// Admin Dashboard
Route::get( '/today/sell', 'Api\PosController@todaySell' );
Route::get( '/today/income', 'Api\PosController@todayIncome' );
Route::get( '/today/due', 'Api\PosController@todayDue' );
Route::get( '/today/expense', 'Api\PosController@todayExpense' );
Route::get( '/today/stockout', 'Api\PosController@todayStockout' );

Route::get( '/addToCart/{id}', 'Api\CartController@addToCart' );
Route::get( '/cart/product', 'Api\CartController@cartProduct' );
Route::get( '/remove/cart/{id}', 'Api\CartController@removeCart' );
Route::get( '/increment/{id}', 'Api\CartController@increment' );
Route::get( '/decrement/{id}', 'Api\CartController@decrement' );
Route::get( '/vats', 'Api\CartController@vats' );

Route::get( '/orders', 'Api\OrderController@todayOrder' );
Route::get( '/order/details/{id}', 'Api\OrderController@orderDetails' );
Route::get( '/order/orderdetails/{id}', 'Api\OrderController@orderDetailsAll' );
