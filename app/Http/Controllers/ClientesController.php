<?php

namespace App\Http\Controllers;

use App\Clientes;
use DB;
use Sentry;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $idusuario = Sentry::getUser()->id;
      $idperfil = Sentry::getUser()->id_perfil; 
       if (Sentry::check()){ 
      $busqueda= $request->input('search');
      $listaclientes = DB::table('clientes')
      ->select("clientes.id as idcliente", "clientes.*");
    
      $listaclientes= $listaclientes->orderBy('id')->paginate(10);

      return view('clientes.index',['listaclientes'=>$listaclientes]);
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
     $clientes = DB::table('clientes')->get();
     
     return view('clientes.create',['clientes'=>$clientes, 
        // 'proveedores'=>$proveedores, 
        'idusuario'=>$idusuario]);

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
         $cliente = new Clientes($request->all());
  

    if($cliente->save()){
          session()->flash('crearcliente', "ha sido agregado");
          return redirect("clientes");
      }else{
          return view('clientes.create',["cliente"=>$cliente]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
     {
    if (Sentry::check()){ 
     $idusuario = Sentry::getUser()->id;
     
     $editar_clientes =Clientes::findOrFail($id);
     $proveedores = DB::table('clientes')->get();
    return view('clientes.view',['clientes'=>$editar_clientes, 'idusuario'=>$idusuario
        ]);

     } else {

        return View('sentinel.sessions.login');
     }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
   {
   
     if (Sentry::check()){ 
     $idusuario = Sentry::getUser()->id;
     $editar_clientes =Clientes::findOrFail($id);
     
     return view('clientes.edit',['clientes'=>$editar_clientes, 'idusuario'=>$idusuario
        ]);

     } else {

        return View('sentinel.sessions.login');
     }

    

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

    $cliente = Clientes::findOrFail($id);
        if($cliente->update ($request->all())){
          session()->flash('crearcliente', "Un cliente ha sido editado");
          return redirect("clientes");
     } else{
          return view('clientes.edit',["clientes"=>$cliente]);
      }
     }
        
    
     

      
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $cliente = Clientes::findOrFail($id);
     if ($cliente->delete()) {
        return redirect("clientes")->with(['mensaje_eliminarcliente', 'Un cliente ha sido eliminado']);
      } else {

      return redirect("clientes")->with('mensaje_eliminarcliente2', 'El cliente no puede ser eliminado');
    }
    }
}
