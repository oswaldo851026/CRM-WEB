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



Route::get('productosM','WebServices@getProductos');


Route::get('servicelistaProductos','WebServices@getProductos');
Route::get('servicelistaClientes','WebServices@getClientes');
Route::get('servicelistaPedidos','WebServices@getPedidos');
Route::post('serviceCrearPedido','WebServices@CrearPedido');


