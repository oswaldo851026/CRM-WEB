<?php

namespace App\Http\Controllers;

use App\Inventarios;
use App\Inventarios2;
use Illuminate\Http\Request;
use App\Pedidos;
use App\Clientes;
use App\User;
use App\Detalle_pedido;
use App\Productos;
use App\Almacen;
use App\Materia_Prima;
use Sentry;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class InventariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
         
     if (Sentry::check()){ 

    
        $productos = Productos::all();
        $almacenes = Almacen::all();
         $materia_prima = Materia_Prima::all();

       $optradio = $request->input('optradio'); 
      
       if(empty($optradio)){

        $valcheck = "checked";
        $valcheck2 = "";
       } else if($optradio == "Prod"  ){
        $valcheck = "checked";
        $valcheck2 = "";

       } else if($optradio == "Mp"){
        
        $valcheck = "";
        $valcheck2 = "checked";

       }


      $movimiento= $request->input('movimiento');  
      $producto= $request->input('buscarproducto'); 
      $materiaprima= $request->input('buscarmateriaprima');   
      $almacen = $request->input('almacen');  
      $fecha_inicio = $request->input("fecha_inicio"); 
      $fecha_final =  $request->input("fecha_final"); 
      $idusuario = Sentry::getUser()->id;
      $idperfil = Sentry::getUser()->id_perfil; 
      $fecha_inicio =  date("Y-m-d",strtotime($request->fecha_inicio));
      $fecha_final2 =  date("Y-m-d",strtotime($request->fechaf_final));
       //inventarios producto
      


      $listaInventarios = DB::table('inventarios')
      ->select("inventarios.id as idinventarios", "inventarios.concepto",  "productos.codigo" , "productos.nombre" , "almacen.nombre_almacen"  , "inventarios.cantidad", "inventarios.tipo_movimiento", "inventarios.created_at" )
      ->leftJoin('productos','inventarios.id_producto','productos.codigo')
      ->leftJoin('almacen','inventarios.id_almacen','almacen.id');


        if(!empty($producto)){
        if($producto == "todos"){
          $producto == "";
        }
       $listaInventarios= $listaInventarios->where('inventarios.id_producto', 'like', "Prod".$producto);
       if(!empty($almacen)){
       $listaInventarios= $listaInventarios->orWhere('inventarios.id_almacen', 'like', $almacen);
        }
       if(!empty($movimiento)){
       $listaInventarios= $listaInventarios->orWhere('inventarios.tipo_movimiento', 'like', $movimiento);
        }
        if(!empty($fecha_final)){
       $listaInventarios= $listaInventarios->orWhereBetween('inventarios.created_at', [$fecha_inicio, $fecha_final2]);
       }
       }
      $listaInventarios= $listaInventarios->orderBy('inventarios.created_at')->paginate(10);




      //Inventario materia prima 
      $listaInventarios2 = DB::table('inventarios2')
      ->select("inventarios2.id as idinventarios", "inventarios2.concepto",  "materia_primas.codigo" , "materia_primas.nombre" , "almacen.nombre_almacen"  , "inventarios2.cantidad", "inventarios2.tipo_movimiento", "inventarios2.created_at" )
      ->leftJoin('materia_primas','inventarios2.id_materiaPrima','materia_primas.codigo')
      ->leftJoin('almacen','inventarios2.id_almacen','almacen.id');

        if(!empty($materiaprima)){
          if($materiaprima == "todos"){
          $materiaprima == "";
        }
       $listaInventarios2= $listaInventarios2->where('inventarios2.id_materiaPrima', 'like', "Mp".$materiaprima);
       if(!empty($almacen)){
       $listaInventarios2= $listaInventarios2->orWhere('inventarios2.id_almacen', 'like', $almacen);
       }
       if(!empty($movimiento)){
       $listaInventarios2= $listaInventarios2->orWhere('inventarios2.tipo_movimiento', 'like', $movimiento);
       }
       if(!empty($fecha_final)){
       $listaInventarios2= $listaInventarios2->orWhereBetween('inventarios2.created_at', [$fecha_inicio, $fecha_final2]);
       }
      }

    
     
      $listaInventarios2= $listaInventarios2->orderBy('inventarios2.created_at')->paginate(10);
      
        

      return view('inventarios.index',['listaInventarios'=>$listaInventarios, 'listaInventarios2'=>$listaInventarios2, 'productos'=>$productos, 'almacenes'=>$almacenes, "materia_prima" => $materia_prima, "valcheck2"=> $valcheck2, "valcheck"=>$valcheck   ]);
      } else {

      return View('sentinel.sessions.login');
       }


    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    }
    public function store(Request $request)
    {
        
         
   if(substr( $request->inputproducto , 0, 2 ) == "Pr"){
    $registro_inventario = new Inventarios();

   } else {
    $registro_inventario = new Inventarios2(); //materias primas


     }

    $registro_inventario->concepto = "Hecha desde el panel";
    $registro_inventario->id_materiaPrima = $request->inputproducto;
    if($request->tipo_movimiento == "salida"){
      $registro_inventario->cantidad = $request->inputcantidad  - ($request->inputcantidad *2);
    }else{

      $registro_inventario->cantidad = $request->inputcantidad;
    }
    
    $registro_inventario->id_almacen = $request->inputalmacen;
    $registro_inventario->tipo_movimiento= $request->tipo_movimiento;
    $registro_inventario->save();

 
  
  return redirect("pedidos");



    }

     public function agregarRegistro(Request $request)
    {
        
         
   if(substr( $request->inputproducto , 0, 2 ) == "Pr"){
    $registro_inventario = new Inventarios();
    $registro_inventario->id_producto = $request->inputproducto;

   } else {
    $registro_inventario = new Inventarios2(); //materias primas
    $registro_inventario->id_materiaPrima = $request->inputproducto;

     }

    $registro_inventario->concepto = "Hecha desde el panel";

    if($request->tipo_movimiento == "salida"){
      $registro_inventario->cantidad = $request->inputcantidad  - ($request->inputcantidad *2);
    }else{

      $registro_inventario->cantidad = $request->inputcantidad;
    }
    
    $registro_inventario->id_almacen = $request->inputalmacen;
    $registro_inventario->tipo_movimiento= $request->inputmovimiento;
    $registro_inventario->save();

 
  
  return redirect("inventarios");



    }






    /**
     * Display the specified resource.
     *
     * @param  \App\Inventarios  $inventarios
     * @return \Illuminate\Http\Response
     */
    public function show(Inventarios $inventarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventarios  $inventarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventarios $inventarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventarios  $inventarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventarios $inventarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventarios  $inventarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventarios $inventarios)
    {
        //
    }
}
