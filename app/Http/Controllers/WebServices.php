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
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

Class WebServices extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getClientes()
    {
    
    $clientes = Clientes::where("id", "<>", "10")->get();
    return response()->json($clientes);  
    }

    public function getProductos()
    {
    
    $productos = productos::where("id", "<>", "4")->get();
    return response()->json($productos); 
    }

    public function getPedidos()
    {
    
    $productos = productos::all();
     $listaPedidos = DB::table('pedidos')
      ->select("pedidos.id as idpedidos", "pedidos.*", "clientes.razon_social")
      ->leftJoin('clientes','pedidos.id_cliente','clientes.id')->orderBy("created_at", "desc")->get();
      return response()->json($listaPedidos); 
    }

  public function crearPedido(Request $request )
    {
    

      //$datos2 =  json_decode($request->all());
      $datos=  $request->json()->all();
    



     $pedidos = new Pedidos();
     $pedidos->id_cliente = $datos['cdata']['cliente'];
     $pedidos->id_usuario = 1;
     $pedidos->asunto =  $datos['cdata']['asunto'];
     $pedidos->estatus = $datos['cdata']['estatus'];
     $pedidos->comentarios = "";
     $pedidos->id_vendedor = 1;
     $pedidos->metodo_pago =  $datos['cdata']['metodoPago'];
     $pedidos->direccion_envio = "n/a";
     $fecha_entrega = date("Y-m-d");
     $pedidos->fecha_entrega = $fecha_entrega;
     $pedidos->subtotal = $datos['cdata']['subtotal'];
     $pedidos->descuento = 0;
     $pedidos->iva = $datos['cdata']['subtotal']*16;
     $pedidos->total = $datos['cdata']['subtotal']*1.16;
       



       
 


     if($pedidos->save() && sizeof($datos['rdata'])>0){


            
              foreach($datos['rdata'] as $row){
               
              $numprueba =  sizeof($datos['rdata']);
       
               
               $datos_producto = db::table('productos')->select("*")->where("codigo", $row['col1'])->first(); 
               $detalle_pedido = new Detalle_pedido();
               $detalle_pedido->id_producto = $datos_producto->id;
               $detalle_pedido->id_pedido = $pedidos->id;
               $detalle_pedido->nombre_producto = $datos_producto->nombre;
               $detalle_pedido->descripcion_producto = $datos_producto->descripcion;
               $detalle_pedido->cantidad_producto =  $row['col3'];
               $detalle_pedido->precio_producto = $datos_producto->precio;
               $importe = $row['col3'] * $datos_producto->precio;
               $detalle_pedido->importe = $importe;
               if($pedidos->estatus  == "enviado" ){
                //logica para las existencias                  
               } 
            
               $detalle_pedido->save();
            
             
               } // endforeach
              
              
} //end if pedido saved



return $datos;


}

}