<?php

namespace App\Http\Controllers;

use App\Pedidos;
use App\Clientes;
use App\Detalle_pedido;
use App\Productos;
use DB;
use Sentry;



use Illuminate\Http\Request;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    

    if (Sentry::check()){ 
      $busqueda= $request->input('search');
      $fecha_inicio = $request->input('fecha_inicio');
      $fecha_final =  $request->input('fecha_final');  
      $idusuario = Sentry::getUser()->id;
      $idperfil = Sentry::getUser()->id_perfil; 
      $listaPedidos = DB::table('pedidos')
      ->select("pedidos.id as idpedidos", "pedidos.*", "clientes.razon_social as nombreclientes, user.first_name")
      ->leftJoin('clientes','pedidos.id_cliente','clientes.id')
      ->leftJoin('users','pedidos.id_usuario','users.id');
      if(!empty($busqueda)) { 
      $listaPedidos= $listaPedidos->where('pedidos.asunto', 'like', $busqueda)
      ->orWhere('pedidos.estatus', 'like', $busqueda)
      ->orWhere('clientes.razon_social', 'like', $busqueda)
      ->orWhere('pedidos.id', 'like', $busqueda);
      }
      if(!empty($fecha_inicio) && !empty($fecha_final)) { 
      $listaPedidos= $listaPedidos->orWhereBetween('created_at', [$fecha_inicio, $fecha_final]);

      }
             
      $listaPedidos= $listaPedidos->orderBy('id')->paginate(10);

      return view('pedidos.index',['listaPedidos'=>$listaPedidos]);
      } else {

      return View('sentinel.sessions.login');
       }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function show(Pedidos $pedidos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedidos $pedidos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedidos $pedidos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedidos $pedidos)
    {
        //
    }
}
