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

//Cientes
Route::get('/cliente/{phone}','ClienteController@existecliente');
Route::get('/cliente/{name}/{email}/{phone}','ClienteController@crearcliente' ); 

//Productos
Route::resource('/products', 'ProductController');
Route::get('/product/{id}', 'productController@product');

//Categorias
Route::resource('/categorias', 'CategoryController');
Route::get('/categoria/{id}', 'CategoryController@verproducto');

//Ordenes
Route::get('/order/{id}', 'OrderController@orderuser');
Route::get('/order/{id}/{orderid}', 'OrderController@vieworder');
Route::get('/order/{id}/{cart_id}/{total}/{direction}', 'OrderController@order');
Route::get('/cart/{id}/{product_id}/{cantidad}', 'CartController@crearcarrtito');

//Dirreccion
Route::get('/direction/{name}/{desccription}/{lat}/{log}/{user_id}','DirectionsController@guardarMap');
Route::get('/direction/{coordenadas}','DirectionsController@consultmap');
Route::get('/user_direction/{user_id}','DirectionsController@verdirection');
Route::get('/validar_direction/{user_id}/{name}','DirectionsController@validardirrecion');
Route::get('/note_direction/{id}/{note}','DirectionsController@notedirection');

