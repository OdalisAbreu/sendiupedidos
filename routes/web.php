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
//https://akivaron.github.io/miminium/credits.html

use App\Http\Controllers\OrderController;

Route::get('/', 'TestController@welcome');

Auth::routes();

//General
Route::get('/search', 'SearchController@show');// Busqueda
Route::get('/home', 'OrderController@index')->name('home');// Manejo de ordenes
Route::get('/map', 'DirectionsController@map')->name('home'); // Vista del MApa


//Product
Route::get('products/json', 'SearchController@data'); //Vista Json de los productos
Route::get('products/{id}', 'ProductController@show'); // Vista producto especifico
Route::get('categories/{category}', 'CategoryController@show');

//Cart
Route::get('/car', 'HomeController@index')->name('home'); //Vista del carrito
Route::post('/cart', 'CartDetailController@store'); // Guardar Carrito
Route::delete('/cart', 'CartDetailController@destroy');//Eliminar carrito

//Order
Route::post('/order', 'CartController@update'); // Actualizar controler 
Route::get('orders/{id}/{status}', 'OrderController@editar'); // Editar status de orden
Route::get('order/{id}', 'PedidosController@show'); // Vista de impresion de la orden 
Route::get('order-pdf','PedidosController@exportPdf'); // Vista PDF de la orden


    Route::get('admin/products', 'ProductController@index'); //listar 
	Route::get('admin/products/create', 'ProductController@create'); //formulario para crear
	Route::post('admin/products', 'ProductController@store'); //crear
	Route::get('admin/products/{id}/edit', 'ProductController@edit'); //form editar
	Route::post('admin/products/{id}/edit', 'ProductController@update'); //actualizar
	Route::post('admin/products/{id}/delete', 'ProductController@destroy'); //eliminar

	Route::get('admin/products/{id}/images', 'ImageController@index'); //listado imagenes 
	Route::post('admin/products/{id}/images', 'ImageController@store'); //registrar
	Route::delete('admin/products/{id}/images', 'ImageController@destroy'); //eliminar image
	Route::get('admin/products/{id}/images/select/{image}', 'ImageController@select'); //destacar 

	//category
	Route::get('admin/categories', 'CategoryController@index'); //listar 
	Route::get('admin/categories/create', 'CategoryController@create'); //formulario para crear
	Route::post('admin/categories', 'CategoryController@store'); //crear
	Route::get('admin/categories/{category}/edit', 'CategoryController@edit'); //form editar
	
	Route::post('admin/categories/{category}/edit', 'CategoryController@update'); //actualizar
	Route::delete('admin/categories/{category}', 'CategoryController@destroy'); //eliminar



Route::middleware(['auth','admin'])->namespace('Admin')->prefix('admin')->group(function () {
	
	
});