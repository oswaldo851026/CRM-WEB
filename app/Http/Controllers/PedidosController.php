<?php

namespace App\Http\Controllers;

use App\Pedidos;
use App\Clientes;
use App\User;
use App\Detalle_pedido;
use App\Productos;
use App\Inventarios;
use App\Inventarios2;

use App\Cuentas_pagar;
use Sentry;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;



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
             
      $listaPedidos= $listaPedidos->orderBy('created_at', "desc")->paginate(10);

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

/*
      if( $request->metodo_pago == "Credito"){

       $cobrar = new Cuentas_pagar();
       $cobrar->id_pedido =  $pedidos->id;
       $cobrar->id_cliente =  $pedidos->id_cliente;
       $cobrar->estatus =  "Pendiente por cobro";
       $cobrar->monto=  $pedidos->total;
       $cobrar->save();
      }
 */    
      if(sizeof($request->idproducto)>0){
      $this->insertarDetallePedidos($request, $pedidos->id, 1, $request->estatus);
      }
      //$this->actualizarExistencias($request,  $pedidos->id);

     }


      return redirect("pedidos");
      } else {

      return View('sentinel.sessions.login');
       }

    }

    public function insertarDetallePedidos(Request $request, $idpedido,  $tipo, $estatus, $estatus_anterior = false){ //tipo = 1 es insertar el 2 es para editar.

   if($tipo == 2){


    Detalle_pedido::where("id_pedido", $idpedido)->delete();

   }


    foreach($request->idproducto as $idproducto){
    $detalle_pedido = new Detalle_pedido();
    $detalle_pedido->id_pedido = $idpedido;
    $detalle_pedido->id_producto = $idproducto;
    $detalle_pedido->nombre_producto = Input::get('producto_'.$idproducto);
    $detalle_pedido->descripcion_producto = Input::get('descripcion_'.$idproducto);
    $cantidad = Input::get('cantidad_'.$idproducto);
    $detalle_pedido->cantidad_producto = $cantidad;
    $precio = db::table('productos')->select("precio")->where("id", $idproducto)->first()->precio;
    //$precio = Input::get('precio_'.$idproducto);
    $detalle_pedido->precio_producto = $precio;
    $importe = $cantidad * $precio;
    $detalle_pedido->importe = $importe;
    if($estatus == "enviado" && $estatus_anterior <> "enviado" && $estatus_anterior <> "pagado" && $estatus_anterior <> "cancelado"){
           
    $this->actualizarExistencias($idpedido, $cantidad, $idproducto, $tipo);
    }
    $detalle_pedido->save();

    }


    }

    public function actualizarExistencias($idpedido, $cantidad, $idproducto, $tipo){
    
    $codigo= "Prod".$idproducto;
    $info_producto =  DB::table('productos')->where("id", $idproducto)->first();

    $existencia_producto = $info_producto->existencias;

     if($existencia_producto >  $cantidad) {  


    $actualizar_existencia =  $existencia_producto - $cantidad;
    Productos::where("id", $idproducto)->update(['existencias' => $actualizar_existencia ]);
       
     $array_mercancias =  Inventarios::select("cantidad", "id_producto" )->where("id_producto", $codigo)->orderBy("created_at");

    $registro_inventario = new Inventarios();
    $registro_inventario->concepto = "Registro hecho mediante pedido";
    $registro_inventario->id_producto= "Prod".$idproducto;
    $registro_inventario->cantidad = $cantidad - ($cantidad *2);
    $registro_inventario->id_almacen = 1;
    $registro_inventario->tipo_movimiento= "salida";
    $registro_inventario->save();

    } 
   

   if($tipo == 2){

    

    }

  

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function show($idpedido)
    {
          $pedidos = Pedidos::find($idpedido);
      $detalle_pedidos = Detalle_pedido::where("id_pedido", $idpedido)->get();

       if (Sentry::check()){ 
        $idusuario = Sentry::getUser()->id;
        $idperfil = Sentry::getUser()->id_perfil; 
        $lista_usuarios =  DB::table('users')->get();
        
       $clientes = Clientes::all();
        $productos = productos::all();
        return view('pedidos.view',['idusuario'=>$idusuario, 'idperfil' => $idperfil, 'lista_usuarios' => $lista_usuarios, 'clientes'=>$clientes, "productos"=> $productos, "pedidos"=>$pedidos, "detalle_pedidos" => $detalle_pedidos]);
       } else {

        return View('sentinel.sessions.login');

       }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function edit($idpedido)
    {
      

      $pedidos = Pedidos::find($idpedido);
      $detalle_pedidos = Detalle_pedido::where("id_pedido", $idpedido)->get();

       if (Sentry::check()){ 
        $idusuario = Sentry::getUser()->id;
        $idperfil = Sentry::getUser()->id_perfil; 
        $lista_usuarios =  DB::table('users')->get();
        
       $clientes = Clientes::all();
        $productos = productos::all();
        return view('pedidos.edit',['idusuario'=>$idusuario, 'idperfil' => $idperfil, 'lista_usuarios' => $lista_usuarios, 'clientes'=>$clientes, "productos"=> $productos, "pedidos"=>$pedidos, "detalle_pedidos" => $detalle_pedidos]);
       } else {

        return View('sentinel.sessions.login');

       }





    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
      
      if (Sentry::check()){ 
        $idusuario = Sentry::getUser()->id;
        $idperfil = Sentry::getUser()->id_perfil; 
        $estatus_anterior =  DB::table('pedidos')->where("id", $id)->first()->estatus;
       $pedidos = Pedidos::findOrFail($id);
     
       $datos_cliente = json_decode($request->datos_cliente);
        $id_cliente = $datos_cliente->idcliente; 

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

     if($pedidos->update()){
     
      if(sizeof($request->idproducto)>0){
      $this->insertarDetallePedidos($request, $pedidos->id, 2, $request->estatus, $estatus_anterior);

      }
      

     }


      return redirect("pedidos");
      } else {

      return View('sentinel.sessions.login');
       }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedidos = Pedidos::findOrFail($id);
     if ($pedidos->delete()) {
        return redirect("pedidos")->with(['mensaje_eliminarProspecto', 'Un producto ha sido eliminado']);
      } else {

      return redirect("pedidos")->with('mensaje_eliminarProspecto2', 'El producto no pudo ser eliminado');
    }



    }
}
