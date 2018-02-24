<?php

namespace App\Http\Controllers;

use App\Materia_Prima;
use Illuminate\Http\Request;
use DB;
use Sentry;
use Categorias;
use Proveedores;
use Illuminate\Support\Facades\Input;


class MateriaPrimaController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    //  {
    //     $keyword = $request->get('search');
    //     $perPage = 25;

    //     if (!empty($keyword)) {
    //         $materiaprima = Materia_prima::where('nombre', 'LIKE', "%$keyword%")
    //             ->orWhere('descripcion', 'LIKE', "%$keyword%")
    //             ->orWhere('costo', 'LIKE', "%$keyword%")
    //             ->orWhere('comentarios', 'LIKE', "%$keyword%")
                
    //             ->paginate($perPage);
    //     } else {
    //         $materiaprima = Materia_prima::paginate($perPage);
    //     }

    //     return view ('materiaprima.index', compact('materiaprima'));
    // }
    {
      if (Sentry::check()){ 
         $idusuario = Sentry::getUser()->id;
      $idperfil = Sentry::getUser()->id_perfil; 
      $busqueda= $request->input('search');
      $materiaprima = DB::table('materia_primas')
      ->select("materia_primas.id as idmateriaprima", "materia_primas.*", "proveedores.razon_social as nombreproveedor", "categorias.nombre as nombrecategoria")
      ->leftJoin('categorias','materia_primas.id_categoria','categorias.id')
      ->leftJoin('proveedores','materia_primas.id_proveedor','proveedores.id');
      if(!empty($busqueda)) { 
      $materiaprima= $materiaprima->where('materiaprima.nombre', 'like', $busqueda)
      ->orWhere('materia_primas.costo', 'like', $busqueda)
      ->orWhere('materia_primas.descripcion', 'like', $busqueda)
      ->orWhere('materia_primas.id', 'like', $busqueda);
      }
      $materiaprima= $materiaprima->orderBy('id')->paginate(10);

      return view('materiaprima.index',['materiaprima'=>$materiaprima]);
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
     return view('materiaprima.create',['categorias'=>$categorias, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario]);

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
    
    $materiasprimas = new Materia_Prima($request->all());
  

    if($materiasprimas->save()){
          session()->flash('crearmateria', "ha sido creado");
          return redirect("materiaprima");
      }else{
          return view('materiaprima.create',["materiasprimas"=>$materiasprimas]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promotor  $promotor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    if (Sentry::check()){ 
     $idusuario = Sentry::getUser()->id;
     $categorias = DB::table('categorias')->get();
     $editar_materiaprima =Materia_prima::findOrFail($id);
     $proveedores = DB::table('proveedores')->get();
     return view('materiaprima.view',['categorias'=>$categorias, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario, 
        'materiasprimas'=> $editar_materiaprima]);

     } else {

        return View('sentinel.sessions.login');
     }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotor  $promotor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
   
     if (Sentry::check()){ 
     $idusuario = Sentry::getUser()->id;
     $categorias = DB::table('categorias')->get();
     $editar_materiaprima =Materia_prima::findOrFail($id);
     $proveedores = DB::table('proveedores')->get();
     return view('materiaprima.edit',['categorias'=>$categorias, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario, 
        'materiasprimas'=> $editar_materiaprima]);

     } else {

        return View('sentinel.sessions.login');
     }

    

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\materiaprima  $materiaprima
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $requestData = $request->all();
        
        $MateriaPrima = Materia_prima::findOrFail($id);
        $MateriaPrima->update($requestData);

        return redirect('materiaprima')->with('flash_message', 'materia prima actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MateriaPrima  $materiaprima
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $MateriaPrima = Materia_prima::findOrFail($id);
     if ($MateriaPrima->delete()) {
        return redirect("materiaprima")->with(['mensaje_eliminarcliente', 'Un cliente ha sido eliminado']);
      } else {

      return redirect("materiaprima")->with('mensaje_eliminarcliente2', 'El cliente no puede ser eliminado');
    }
    }
}
