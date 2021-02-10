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

Route::resource('/products', 'ProductController');
Route::get('/product/{id}', 'productController@product');
Route::resource('/categorias', 'CategoryController');
Route::get('/categoria/{id}', 'CategoryController@verproducto');
Route::get('/order/{id}', 'OrderController@orderuser');
Route::get('/cliente/{phone}','ClienteController@existecliente');
Route::get('/cliente/{name}/{email}/{phone}/{address}','ClienteController@crearcliente' ); 
Route::get('/cart/{id}/{product_id}/{cantidad}', 'CartController@crearcarrtito');
Route::get('/order/{id}/{cart_id}/{total}', 'OrderController@order');
