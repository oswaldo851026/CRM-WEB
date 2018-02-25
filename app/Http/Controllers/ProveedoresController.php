<?php

namespace App\Http\Controllers;

use App\Proveedores;
use Illuminate\Http\Request;
use DB;
use Sentry;
use Illuminate\Support\Facades\Input;


class ProveedoresController extends Controller
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
      $listaProveedores = DB::table('proveedores')
      ->select("proveedores.id as idproveedores", "proveedores.*");

      if(!empty($busqueda)) { 
      $listaProductos= $listaProductos->Where('proveedores.nombre_contacto', 'like', $busqueda)
      ->orWhere('proveedores.direccion', 'like', $busqueda)
      ->orWhere('proveedores.razon_social', 'like', $busqueda)
      ->orWhere('proveedores.telefono', 'like', $busqueda)
      ->orWhere('proveedores.id', 'like', $busqueda);

      }
      $listaProveedores= $listaProveedores->orderBy('id')->paginate(10);
      
      
      return view('proveedores.index',['listaProveedores'=>$listaProveedores]);
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
     return view('proveedores.create',['categorias'=>$categorias, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario]);

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
    
    $proveedores = new Proveedores($request->all());
  


    if($proveedores->save()){
          session()->flash('crearproveedores', "Un Proveedor fue creado");
          return redirect("proveedores");
      }else{
          return view('proveedores.create',["proveedores"=>$proveedores]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedores  $Proveedores
     * @return \Illuminate\Http\Response
     */
    
 
    public function edit($id)
    {
   
     if (Sentry::check()){ 
     $idusuario = Sentry::getUser()->id;
     $categorias = DB::table('categorias')->get();
     $editar_proveedores =Proveedores::findOrFail($id);
     $proveedores = DB::table('proveedores')->get();
     return view('proveedores.edit',['categorias'=>$categorias, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario, 
        'proveedores'=> $editar_proveedores]);

     } else {

        return View('sentinel.sessions.login');
     }

    

    }



    public function show($id)
    {
    if (Sentry::check()){ 
     $idusuario = Sentry::getUser()->id;
  
     $ver_proveedor=Proveedores::findOrFail($id);
     $proveedores = DB::table('proveedores')->get();
     return view('proveedores.view',['proveedores'=>$ver_proveedor, 'idusuario'=>$idusuario, 
        ]);

     } else {

        return View('sentinel.sessions.login');
     }

    }

     







    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedores  $Proveedores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
   {
     $proveedores = Proveedores::find($id);
    if($proveedores->update($request->all())){
          session()->flash('crearproveedores', "El proveedor ha sido editado");
          return redirect("proveedores");
      }else{
          return view('proveedores.edit',["proveedores"=>$proveedores]);
        
      }
     

      


    }







    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedores $Proveedores
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $proveedores = Proveedores::findOrFail($id);
     if ($proveedores->delete()) {
        return redirect("proveedores")->with(['mensaje_eliminarProspecto', 'el proveedor fue eliminado']);
      } else {

      return redirect("proveedores")->with('mensaje_eliminarProspecto2', 'El proveedor no fue eliminado');
    }


    }
}
