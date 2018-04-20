<?php

namespace App\Http\Controllers;

use App\Almacen;
use Illuminate\Http\Request;
use DB;
use Sentry;
use Illuminate\Support\Facades\Input;


class AlmacenController extends Controller
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
      $listaAlmacen = DB::table('almacen')
      ->select("almacen.id as idalmacen", "almacen.*");
     
      if(!empty($busqueda)) { 
      $listaAlmacen= $listaAlmacen->where('almacen.nombre_almacen', 'like', $busqueda)
      /*->where('almacen.nombre_almacen', 'like', $busqueda)*/
      ->orWhere('almacen.descripcion', 'like', $busqueda)
      ->orWhere('almacen.id', 'like', $busqueda);
     }

      $listaAlmacen= $listaAlmacen->orderBy('id')->paginate(10);

      return view('almacen.index',['listaAlmacen'=>$listaAlmacen]);
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
     return view('almacen.create',['categorias'=>$categorias, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario]);

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
    
    $almacen = new almacen($request->all());
  
   
           
        

    if($almacen->save()){
          session()->flash('crearAlmacen', "Un Almacen ha sido creado");
          return redirect("almacenes");
      }else{
          return view('almacenes.create',["almacen"=>$almacen]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */


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
     $editar_almacen =almacen::findOrFail($id);
     $proveedores = DB::table('proveedores')->get();
     return view('almacen.edit',['idusuario'=>$idusuario, 
        'almacen'=> $editar_almacen]);

     } else {

        return View('sentinel.sessions.login');
     }

    

    }

    public function show($id)
    {
   
     if (Sentry::check()){ 
     $idusuario = Sentry::getUser()->id;
     $editar_almacen =almacen::findOrFail($id);
     $proveedores = DB::table('proveedores')->get();
     return view('almacen.view',['idusuario'=>$idusuario, 
        'almacen'=> $editar_almacen]);

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
      $almacen = almacen::findOrFail($id);
    
           

    if($almacen->update($request->all())){
          session()->flash('crearAlmacen', "Un almacen ha sido editado");
          return redirect("almacenes");
      }else{
          return view('almacenes.edit',["almacen"=>$almacen]);
        
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
      $almacen = almacen::findOrFail($id);
     if ($almacen->delete()) {
        return redirect("almacenes")->with(['mensaje_eliminarProspecto', 'Un almacen ha sido eliminado']);
      } else {

      return redirect("almacenes")->with('mensaje_eliminarProspecto2', 'El almacen no pudo ser eliminado');
    }


    }
}