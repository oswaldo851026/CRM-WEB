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
Route::resource('clientes','ClientesController');
Route::resource('perfiles','PerfilesController');
Route::resource('materiaprima','MateriaPrimaController');
Route::resource('user','UsuariosController');
Route::resource('pedidos','PedidosController');
Route::resource('inventarios','InventariosController');
Route::resource('billMaterials','BillMaterialsController');
Route::resource('compras','OrdenesCompraController');
Route::resource('categorias','CategoriasController');
Route::resource('proveedores','ProveedoresController');
Route::resource('cuentasPorPagar','CuentasPagarController');
Route::resource('cuentasPorCobrar','CuentasCobrarController');
Route::resource('almacenes','AlmacenController');
Route::post('inventarios/agregarRegistro','InventariosController@agregarRegistro');
Route::resource('almacenes','AlmacenController');
Route::get('/productos',array('as' => 'home','uses'=>'ProductosController@index')); //ruta de inicio
