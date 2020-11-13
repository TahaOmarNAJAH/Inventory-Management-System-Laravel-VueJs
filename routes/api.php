<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employees','API\EmployeeController');
Route::apiResource('/suppliers','API\SupplierController');
Route::apiResource('/categories','API\CategoryController');
Route::apiResource('/products','API\ProductController');
Route::apiResource('/expenses','API\ExpenseController');
Route::apiResource('/customers','API\CustomerController');

Route::post('/stock/update/{id}','API\ProductController@updateStock');

Route::get('/salaries','API\SalaryController@index');
Route::post('/salay/pay/{id}','API\SalaryController@pay');
Route::get('/salaries/{month}','API\SalaryController@salariesByMonth');
Route::get('/edit/salary/{id}','API\SalaryController@edit');
Route::post('/salary/update/{id}','API\SalaryController@SalaryUpdate');

Route::get('/products/category/{id}','API\PosController@getProductsByCategory');

Route::get('/orders','API\OrderController@allOrders');
Route::post('/order/save','API\OrderController@saveOrder');

Route::get('/addToCart/{id}','API\CartController@addToCart');
Route::get('/cart/products','API\CartController@getCartProducts');
Route::get('/cart/increment/{id}','API\CartController@incrementQty');
Route::get('/cart/decrement/{id}','API\CartController@decrementQty');
Route::get('/cart/delete/{id}','API\CartController@removeItem');
Route::get('/vats','API\CartController@vats');


