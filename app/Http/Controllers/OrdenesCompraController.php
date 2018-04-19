<?php

namespace App\Http\Controllers;

use App\Ordenes_compra;
use App\Proveedores;
use App\User;
use App\detalle_ordenesCompra;
use App\Almacen;
use App\Clientes;
use App\Productos;
use App\Materia_prima;
use DB;
use Sentry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class OrdenesCompraController extends Controller
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
      $listaPedidos = DB::table('ordenes_compras')
      ->select("ordenes_compras.id as idcompras", "ordenes_compras.*", "proveedores.razon_social", "users.first_name")
      ->leftJoin('proveedores','ordenes_compras.id_proveedor','proveedores.id')
      ->leftJoin('users','ordenes_compras.id_usuario','users.id');
      if(!empty($busqueda)) { 
      $listaPedidos= $listaPedidos->where('ordenes_compras.asunto', 'like', $busqueda)
      ->orWhere('ordenes_compras.estatus', 'like', $busqueda)
      ->orWhere('proveedores.razon_social', 'like', $busqueda)
      ->orWhere('ordenes_compras.id', 'like', $busqueda);
      }
      if(!empty($fecha_inicio) && !empty($fecha_final)) { 
      $listaPedidos= $listaPedidos->orWhereBetween('created_at', [$fecha_inicio, $fecha_final]);

      }
             
      $listaPedidos= $listaPedidos->orderBy('id')->paginate(10);

      return view('ordendecompra.index',['listaPedidos'=>$listaPedidos]);
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
        // $lista_usuarios =  DB::table('users')->get();
        $almacen = DB::table('almacen')->get();
        $clientes = Proveedores::all();
        $materias_primas = Materia_prima::all();
        return view('ordendecompra.create',['idusuario'=>$idusuario, 'idperfil' => $idperfil, 'almacen' => $almacen, 'clientes'=>$clientes, "materias_primas"=> $materias_primas]);
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
       $pedidos = new Ordenes_compra();
       if($request->optradio == "nuevo") {
        $cliente_nuevo = New Proveedores();
        $cliente_nuevo->nombre_contacto = $request->nombre_contacto;
        $cliente_nuevo->apellido_contacto = $request->apellidos_contacto;
        
        $cliente_nuevo->razon_social = $request->razon_social;
        $cliente_nuevo->telefono = $request->telefono;
        $cliente_nuevo->direccion = $request->direccion;
       
        $cliente_nuevo->save();
        $id_proveedor = $cliente_nuevo->id; 

       }
       if($request->optradio == "existente") {
        $datos_cliente = json_decode($request->datos_cliente);
        $id_proveedor = $datos_cliente->idcliente; 
       }
    
     $pedidos->id_proveedor = $id_proveedor;
     $pedidos->id_usuario = $idusuario;
     $pedidos->asunto = $request->asunto;
     $pedidos->estatus = $request->estatus;
     $pedidos->comentarios = $request->comentarios;
     $pedidos->id_almacen = $request->id_almacen;
     $pedidos->metodo_pago = $request->metodo_pago;
     $pedidos->direccion_envio = $request->direccion_envio;
     $fecha_entrega = date("Y-m-d",strtotime($request->fecha_entrega));
     $pedidos->fecha_entrega = $fecha_entrega;
     $pedidos->subtotal = $request->subtotal;
     
     $pedidos->iva = $request->iva;
     $pedidos->total = $request->total;

     if($pedidos->save()){
     
      if(sizeof($request->idproducto)>0){
      $this->insertarDetalleOrdenesCompra($request, $pedidos->id, 1);
      }
      //$this->actualizarExistencias($request,  $pedidos->id);

     }


      return redirect("compras");
      } else {

      return View('sentinel.sessions.login');
       }

    }

    public function insertarDetalleOrdenesCompra(Request $request, $idpedido,  $tipo){ 

    foreach($request->idproducto as $idproducto){
    $detalle_ordenesCompra = new detalle_ordenesCompra();
    $detalle_ordenesCompra->id_ordenCompra = $idpedido;
    $detalle_ordenesCompra->id_producto = $idproducto;
    $detalle_ordenesCompra->nombre_producto = $request->producto_ + $idproducto;
    Input::get('producto_'.$idproducto);
    $detalle_ordenesCompra->descripcion_producto = 
    Input::get('descripcion_'.$idproducto);
    $cantidad = Input::get('cantidad_'.$idproducto);
    $detalle_ordenesCompra->cantidad_producto = $cantidad;
  
    $precio = $request->precio_ + $idproducto;
    $detalle_ordenesCompra->precio_producto = $precio;
    $importe = $cantidad * $precio;
    $detalle_ordenesCompra->importe = $importe;
    $detalle_ordenesCompra->save();

    }


    }

    public function actualizarExistencias(Request $request, $idpedido){


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ordenes_compra  $ordenes_compra
     * @return \Illuminate\Http\Response
     */
    public function show(Ordenes_compra $ordenes_compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ordenes_compra  $ordenes_compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordenes_compra $ordenes_compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ordenes_compra  $ordenes_compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordenes_compra $ordenes_compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ordenes_compra  $ordenes_compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordenes_compra $ordenes_compra)
    {
        //
    }
}
