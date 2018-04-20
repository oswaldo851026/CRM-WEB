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
      $busqueda= $request->input('search');


      $movimiento= $request->input('movimiento');  
      $producto= $request->input('busquedaproducto');  
      $almacen = $request->input('almacen');  
      $fecha_inicio = $request->input('fecha_inicio');
      $fecha_final =  $request->input('fecha_final');  
      $idusuario = Sentry::getUser()->id;
      $idperfil = Sentry::getUser()->id_perfil; 
      //inventarios producto
      

      $listaInventarios = DB::table('inventarios')
      ->select("inventarios.id as idinventarios", "inventarios.concepto",  "productos.codigo" , "productos.nombre" , "almacen.nombre_almacen"  , "inventarios.cantidad", "inventarios.tipo_movimiento", "inventarios.created_at" )
      ->leftJoin('productos','inventarios.id_producto','productos.codigo')
      ->leftJoin('almacen','inventarios.id_almacen','almacen.id');

    


    if($radio = "Mp"){
    

    }

    if($radio = "Prod"){

      
    }

      
             
      $listaInventarios= $listaInventarios->orderBy('inventarios.created_at')->paginate(10);




      //Inventario materia prima 
      $listaInventarios2 = DB::table('inventarios2')
      ->select("inventarios2.id as idinventarios", "inventarios2.concepto",  "materia_primas.codigo" , "materia_primas.nombre" , "almacen.nombre_almacen"  , "inventarios2.cantidad", "inventarios2.tipo_movimiento", "inventarios2.created_at" )
      ->leftJoin('materia_primas','inventarios2.id_materiaPrima','materia_primas.codigo')
      ->leftJoin('almacen','inventarios2.id_almacen','almacen.id');
     
      $listaInventarios2= $listaInventarios2->orderBy('inventarios2.created_at')->paginate(10);
      
        

      return view('inventarios.index',['listaInventarios'=>$listaInventarios, 'listaInventarios2'=>$listaInventarios2, 'productos'=>$productos, 'almacenes'=>$almacenes, "materia_prima" => $materia_prima ]);
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
        
         if (Sentry::check()){ 
   if(substr( $request->inputproducto , 0, 2 ) == "Pr"){
    $registro_inventario = new Inventarios();

   } else {
    $registro_inventario = new Inventarios2(); //materias primas
     }

   $registro_inventario = new Inventarios();
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

 
  }
  echo "hola";
  
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
