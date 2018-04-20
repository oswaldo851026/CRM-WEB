<?php

namespace App\Http\Controllers;

use App\Categorias;
use Illuminate\Http\Request;
use DB;
use Sentry;
use Illuminate\Support\Facades\Input;


class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if (Sentry::check()){ 
      $idperfil = Sentry::getUser()->id_perfil;
      $busqueda= $request->input('search');
      $listaCategorias = DB::table('categorias')
      ->select("categorias.id as idcategorias","categorias.*");
      
      if(!empty($busqueda)) { 
      $listaCategorias= $listaCategorias->where('categorias.nombre', 'like', $busqueda)
     /** ->Where('categorias.nombre', 'like', $busqueda)*/
      ->orWhere('categorias.descripcion', 'like', $busqueda);
      
      
      }
      
      $listaCategorias= $listaCategorias->orderBy('id')->paginate(10);
      if($idperfil == 1) {
      return view('categorias.index',['listaCategorias'=>$listaCategorias]);
      }
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
     $idperfil = Sentry::getUser()->id_perfil;
     $idusuario = Sentry::getUser()->id;
     $categorias = DB::table('categorias')->get();
     $proveedores = DB::table('proveedores')->get();
      if($idperfil == 1) {
     return view('categorias.create',['categorias'=>$categorias, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario]);
     } 
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
    
    $categorias = new Categorias($request->all());
  


    if($categorias->save()){
          session()->flash('crearCategorias', "Una categoria ha sido creada");
          return redirect("categorias");
      }else{
          return view('categorias.create',["categorias"=>$categorias]);
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
    $idperfil = Sentry::getUser()->id_perfil;
     $idusuario = Sentry::getUser()->id;
     $categorias = Categorias::find($id);
     if($idperfil == 1) {
     return view('categorias.view',['categorias'=>$categorias, "idusuario" => $idusuario]);
      }

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
      $idperfil = Sentry::getUser()->id_perfil;
     $idusuario = Sentry::getUser()->id;
     $categorias = Categorias::find($id);
 
     if($idperfil <> 1) {
     return view('categorias.edit',['categorias'=>$categorias, "idusuario" => $idusuario]);
    }
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
    $categorias = categorias::findOrFail($id);
    if($categorias->update($request->all())){
          session()->flash('crearCategorias', "Una categoria ha sido editada");
          return redirect("categorias");
      }else{
          return view('Categorias.edit',["categorias"=>$categorias]);
        
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
      $idperfil = Sentry::getUser()->id_perfil;
       if($idperfil == 1) {
      $categorias = Categorias::findOrFail($id);
     if ($categorias->delete()) {
        return redirect("categorias")->with(['mensaje_eliminarProspecto', 'Una categoria ha sido eliminada']);
      } else {

      return redirect("categorias")->with('mensaje_eliminarProspecto2', 'La categoria no pudo ser eliminada');
    }

       }
    }
}