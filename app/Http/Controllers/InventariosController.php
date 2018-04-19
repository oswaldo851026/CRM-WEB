<?php

namespace App\Http\Controllers;

use App\Inventarios;
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
      $fecha_inicio = $request->input('fecha_inicio');
      $fecha_final =  $request->input('fecha_final');  
      $idusuario = Sentry::getUser()->id;
      $idperfil = Sentry::getUser()->id_perfil; 
      $listaInventarios = DB::table('inventarios')
      ->select("inventarios.id as idinventarios", "inventarios.concepto",  "productos.nombre" , "productos.codigo", "almacen.nombre_almacen"  , "inventarios.cantidad", "inventarios.tipo_movimiento", "inventarios.descripcion" )
      ->leftJoin('productos','inventarios.id_producto','productos.id')
      ->leftJoin('almacen','inventarios.id_almacen','almacen.id');
      if(!empty($busqueda)) { 
      $listaInventarios= $listaInventarios->where('productos.nombre', 'like', $busqueda)
      ->orWhere('inventarios.concepto', 'like', $busqueda)
      ->orWhere('productos.nombre', 'like', $busqueda)
      ->orWhere('almacen.nombre_almacen', 'like', $busqueda);
      }
      if(!empty($fecha_inicio) && !empty($fecha_final)) { 
      $listaInventarios= $listaInventarios->orWhereBetween('created_at', [$fecha_inicio, $fecha_final]);

      }
             
      $listaInventarios= $listaInventarios->orderBy('id')->paginate(10);

      return view('inventarios.index',['listaInventarios'=>$listaInventarios, 'productos'=>$productos, 'almacenes'=>$almacenes, "materia_prima" => $materia_prima ]);
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
