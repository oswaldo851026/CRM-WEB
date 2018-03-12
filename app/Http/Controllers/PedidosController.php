<?php

namespace App\Http\Controllers;

use App\Pedidos;
use App\Clientes;
use App\User;
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
      ->select("pedidos.id as idpedidos", "pedidos.*", "clientes.razon_social", "users.first_name")
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
       if (Sentry::check()){ 
        $idusuario = Sentry::getUser()->id;
        $idperfil = Sentry::getUser()->id_perfil; 
        $lista_usuarios =  DB::table('users')->get();
        $clientes = Clientes::all();
        $productos = productos::all();
        return view('pedidos.create',['idusuario'=>$idusuario, 'idperfil' => $idperfil, 'lista_usuarios' => $lista_usuarios, 'clientes'=>$clientes, "productos"=> $productos]);
       } else {

        return View('sentinel.sessions.login');

       }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (Sentry::check()){ 
        $idusuario = Sentry::getUser()->id;
        $idperfil = Sentry::getUser()->id_perfil; 
       $pedidos = new Pedidos();
       if($request->optradio == "nuevo") {
        $cliente_nuevo = New Clientes();
        $cliente_nuevo->nombre = $request->nombre_contacto;
        $cliente_nuevo->apellidos = $request->apellidos_contacto;
        $cliente_nuevo->razon_social = $request->razon_social;
        $cliente_nuevo->telefono = $request->telefono;
        $cliente_nuevo->direccion = $request->direccion;
        $cliente_nuevo->descuento = $request->descuento;
        $cliente_nuevo->save();
        $id_cliente = $cliente_nuevo->id; 

       }
       if($request->optradio == "existente") {
        $datos_cliente = json_decode($request->datos_cliente);
        $id_cliente = $datos_cliente->idcliente; 
       }
    
     $pedidos->id_cliente = $id_cliente;
     $pedidos->id_usuario = $idusuario;
     $pedidos->asunto = $request->asunto;
     $pedidos->estatus = $request->estatus;
     $pedidos->comentarios = $request->comentarios;
     $pedidos->id_vendedor = $request->id_vendedor;
     $pedidos->metodo_pago = $request->metodo_pago;
     $pedidos->direccion_envio = $request->direccion_envio;
     $fecha_entrega = date("Y-m-d",strtotime($request->fecha_entrega));
     $pedidos->fecha_entrega = $fecha_entrega;
     $pedidos->subtotal = $request->subtotal;
     $pedidos->descuento = $request->descuento;
     $pedidos->iva = $request->iva;
     $pedidos->total = $request->total;

     if($pedidos->save()){
     
      if(sizeof($request->idproducto)>0){
      $this->insertarDetallePedidos($request, $pedidos->id, 1);
      }
      //$this->actualizarExistencias($request,  $pedidos->id);

     }


      return redirect("pedidos");
      } else {

      return View('sentinel.sessions.login');
       }

    }

    public function insertarDetallePedidos(Request $request, $idpedido,  $tipo){ //tipo = 1 es insertar el 2 es para editar.

    foreach($request->idproducto as $idproducto){
    $detalle_pedido = new Detalle_pedido();
    $detalle_pedido->id_pedido = $idpedido;
    $detalle_pedido->id_producto = $idproducto;
    $detalle_pedido->nombre_producto = $request->producto_ + $idproducto;
    $detalle_pedido->descripcion_producto = $request->descripcion_ + $idproducto;
    $cantidad = $request->cantidad_ + $idproducto;
    $detalle_pedido->cantidad_producto = $cantidad;
   // $precio = db::table('productos')->select("precio")->where("id", $idproducto)->first()->precio;
    $precio = $request->precio_ + $idproducto;
    $detalle_pedido->precio_producto = $precio;
    $importe = $cantidad * $precio;
    $detalle_pedido->importe = $importe;
    $detalle_pedido->save();

    }


    }

    public function actualizarExistencias(Request $request, $idpedido){


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
