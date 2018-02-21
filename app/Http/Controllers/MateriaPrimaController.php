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
     {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $materiaprima = Materia_prima::where('nombre', 'LIKE', "%$keyword%")
                ->orWhere('descripcion', 'LIKE', "%$keyword%")
                ->orWhere('costo', 'LIKE', "%$keyword%")
                ->orWhere('comentarios', 'LIKE', "%$keyword%")
                
                ->paginate($perPage);
        } else {
            $materiaprima = Materia_prima::paginate($perPage);
        }

        return view ('materiaprima.index', ['materiaprima'=>$materiaprima]);
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
        $materiasprimas = Materia_prima::findOrFail($id);
          $categorias = DB::table('categorias')->get();
          $proveedores = DB::table('proveedores')->get();
        return view('materiaprima.show', compact('MateriaPrima'));
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

        $materiasprimas = Materia_prima::findOrFail($id);
  $categorias = DB::table('categorias')->get();
          $proveedores = DB::table('proveedores')->get();


        return view('materiaprima.edit', ["materiasprimas"=>$materiasprimas, "idusuario" => $idusuario, 'categorias'=>$categorias, 'proveedores'=>$proveedores]);
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
         $materiasprimas = $request->all();
        
        $materiasprimas = Materia_prima::findOrFail($id);
        $materiasprimas->update($materiasprimas);

        // return redirect('materiaprima')->with('flash_message', 'materia prima actualizado!');
        if($materiasprimas->update($request->all())){
          session()->flash('crearProducto', "Un producto ha sido editado");
          return redirect("materiaprima");
      }else{
          return view('materiaprima.edit',["materias_primas"=>$materiasprimas]);
        
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MateriaPrima  $materiaprima
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Materia_prima::destroy($id);

        return redirect('materiaprima')->with('flash_message', 'materia prima Borrado!');
    }
}
