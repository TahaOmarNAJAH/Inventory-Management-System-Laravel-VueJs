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

Route::post('/stock/update/{id}','API\ProductController@updateStock');

Route::get('/salaries','API\SalaryController@index');
Route::post('/salay/pay/{id}','API\SalaryController@pay');
Route::get('/salaries/{month}','API\SalaryController@salariesByMonth');
Route::get('/edit/salary/{id}','API\SalaryController@edit');
Route::post('/salary/update/{id}','API\SalaryController@SalaryUpdate');

