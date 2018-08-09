<?php

namespace App\Http\Controllers;

use App\Productos;
use Illuminate\Http\Request;
use DB;
use Sentry;
use Categorias;
use Proveedores;
use Illuminate\Support\Facades\Input;
header("Access-Control-Allow-Origin: *");

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if (Sentry::check()){ 
      $idusuario = Sentry::getUser()->id;
      $idperfil = Sentry::getUser()->id_perfil; 
      $busqueda= $request->input('search');
      $listaProductos = DB::table('productos')
      ->select("productos.id as idproductos", "productos.*", "proveedores.razon_social as nombreproveedor", "categorias.nombre as nombrecategoria")
      ->leftJoin('categorias','productos.id_categoria','categorias.id')
      ->leftJoin('proveedores','productos.id_proveedor','proveedores.id');
      if(!empty($busqueda)) { 
      $listaProductos= $listaProductos->where('productos.nombre', 'like', $busqueda)
      ->orWhere('productos.codigo', 'like', $busqueda)
      ->orWhere('productos.descripcion', 'like', $busqueda)
      ->orWhere('productos.id', 'like', $busqueda);
      }
      $listaProductos= $listaProductos->orderBy('id')->paginate(10);

      return view('productos.index',['listaProductos'=>$listaProductos]);
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
     $categorias = DB::table('categorias')->get();
     $proveedores = DB::table('proveedores')->get();
     return view('productos.create',['categorias'=>$categorias, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario]);

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
    
    $productos = new Productos($request->all());
    $productos->codigo = "Prod";
  
    if(Input::hasFile('imagen_principal')){
            $imagen=Input::file('imagen_principal');
            $ruta= public_path().'/img/productos/';
            $imagen->move(public_path().'/img/productos/',$imagen->getClientOriginalName());
            $productos->imagen_principal = $imagen->getClientOriginalName();
           
        }

    if($productos->save()){
       
      $productos->codigo = "Prod".$productos->id;
      $productos->save();

          session()->flash('crearProducto', "Un producto ha sido creado");
          return redirect("productos");
      }else{
          return view('productos.create',["productos"=>$productos]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    if (Sentry::check()){ 
     $idusuario = Sentry::getUser()->id;
     $categorias = DB::table('categorias')->get();
     $editar_producto =Productos::findOrFail($id);
     $proveedores = DB::table('proveedores')->get();
     return view('productos.view',['categorias'=>$categorias, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario, 
        'producto'=> $editar_producto]);

     } else {

        return View('sentinel.sessions.login');
     }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
   
     if (Sentry::check()){ 
     $idusuario = Sentry::getUser()->id;
     $categorias = DB::table('categorias')->get();
     $editar_producto =Productos::findOrFail($id);
     $proveedores = DB::table('proveedores')->get();
    
     return view('productos.edit',['categorias'=>$categorias, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario, 
        'producto'=> $editar_producto]);

     } else {

        return View('sentinel.sessions.login');
     }

    

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $productos = Productos::findOrFail($id);
    if(Input::hasFile('imagen_principal')){
            $imagen=Input::file('imagen_principal');
            $ruta= public_path().'/img/productos/';
            $imagen->move(public_path().'/img/productos/',$imagen->getClientOriginalName());
            $productos->imagen_principal = $imagen->getClientOriginalName();
           
        }


    if($productos->update($request->all())){
          session()->flash('crearProducto', "Un producto ha sido editado");
          return redirect("productos");
      }else{
          return view('productos.edit',["productos"=>$productos]);
        
      }
     

      


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $productos = Productos::findOrFail($id);
     if ($productos->delete()) {
        return redirect("productos")->with(['mensaje_eliminarProspecto', 'Un producto ha sido eliminado']);
      } else {

      return redirect("productos")->with('mensaje_eliminarProspecto2', 'El producto no pudo ser eliminado');
    }


    }


    public function listaProductosM(Request $request)
    {
 
      //$idusuario = Sentry::getUser()->id;
     // $idperfil = Sentry::getUser()->id_perfil; 
      $busqueda= $request->input('search');
      $listaProductos = DB::table('productos')
      ->select("productos.id as idproductos", "productos.*", "productos.existencias", "proveedores.razon_social as nombreproveedor", "categorias.nombre as nombrecategoria")
      ->leftJoin('categorias','productos.id_categoria','categorias.id')
      ->leftJoin('proveedores','productos.id_proveedor','proveedores.id');
      if(!empty($busqueda)) { 
      $listaProductos= $listaProductos->where('productos.nombre', 'like', $busqueda)
      ->orWhere('productos.codigo', 'like', $busqueda)
      ->orWhere('productos.descripcion', 'like', $busqueda)
      ->orWhere('productos.id', 'like', $busqueda);
      }
      $listaProductos= $listaProductos->orderBy('id')->get();

      return response()->json($listaProductos);  

    }









}
