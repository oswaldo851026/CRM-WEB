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



Route::get('/', array('as' => 'login', function()
{
    return View::make('sentinel/sessions/login');
}));

Route::resource('productos','ProductosController');
Route::resource('materiaprima','MateriaPrimaController');
Route::resource('user','UsuariosController');
Route::get('/productos',array('as' => 'home','uses'=>'ProductosController@index')); //ruta de inicio