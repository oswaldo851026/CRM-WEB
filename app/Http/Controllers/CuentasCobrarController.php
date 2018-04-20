<?php

namespace App\Http\Controllers;

use App\Cuentas_cobrar;
use Illuminate\Http\Request;
use DB;
use Sentry;
use Detalle_ordenesCompra;
Use Proveedores;
use Illuminate\Support\Facades\Input;

class CuentasCobrarController extends Controller
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
      $listacuentas_cobrar = DB::table('cuentas_cobrar')
      ->select("cuentas_cobrar.id as idcuentas_cobrar", "cuentas_cobrar.*")
      ->leftJoin('detalle_ordenes_compras','cuentas_cobrar.id_ordencompra','detalle_ordenes_compras.id')
      ->leftJoin('proveedores','cuentas_cobrar.id_proveedor','proveedores.id');
      if(!empty($busqueda)) { 
      $listacuentas_cobrar= $listacuentas_cobrar->orwhere('cuentas_cobrar.estatus', 'like', $busqueda)
      ->orWhere('cuentas_cobrar.monto', 'like', $busqueda);
      //->orWhere('pagar.id', 'like', $busqueda);
      }
      $listacuentas_cobrar= $listacuentas_cobrar->orderBy('id')->paginate(10);

      return view('cobrar.index',['listacuentas_cobrar'=>$listacuentas_cobrar]);
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
     $detalle_ordenes_compras = DB::table('detalle_ordenes_compras')->get();
     $proveedores = DB::table('proveedores')->get();
     return view('cobrar.create',['detalle_ordenes_compras'=>$detalle_ordenes_compras, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario]);

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
    
    $cuentas_cobrar = new cuentas_cobrar($request->all());
  
    if(Input::hasFile('imagen_principal')){
            $imagen=Input::file('imagen_principal');
            $ruta= public_path().'/img/cuentas_cobrar/';
            $imagen->move(public_path().'/img/cuentas_cobrar/',$imagen->getClientOriginalName());
            $pagar->imagen_principal = $imagen->getClientOriginalName();
           
        }

    if($cuentas_cobrar->save()){
          session()->flash('crearcuentas_cobrar', "Una orden de cobro ha sido creada");
          return redirect("cuentas_cobrar");
      }else{
          return view('cuentas_cobrar.create',["cuentas_cobrar"=>$cuentas_cobrar]);
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
     $detalle_ordenes_compras = DB::table('detalle_ordenes_compras')->get();
     $editar_cuentas_cobrar =cuentas_cobrar::findOrFail($id);
     $proveedores = DB::table('proveedores')->get();
     return view('cuentas_pagar.view',['detalle_ordenes_compras'=>$detalle_ordenes_compras, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario, 
        'cuentas_cobrar'=> $editar_cuentas_cobrar]);

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
     $detalle_ordenes_compras = DB::tables('detalle_ordenes_compras')->get();
     $editar_cuentas_cobrar =cuentas_cobrar::findOrFail($id);
     $proveedores = DB::table('proveedores')->get();
     return view('cuentas_pagar.edit',['detalle_ordenes_compras'=>$detalle_ordenes_compras, 'proveedores'=>$proveedores, 'idusuario'=>$idusuario, 
        'cuentas_cobrar'=> $editar_cuentas_cobrar]);

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
      $cuentas_cobrar = cuentas_cobrar::findOrFail($id);
    if(Input::hasFile('imagen_principal')){
            $imagen=Input::file('imagen_principal');
            $ruta= public_path().'/img/cuentas_cobrar/';
            $imagen->move(public_path().'/img/cuentas_cobrar/',$imagen->getClientOriginalName());
            $pagar->imagen_principal = $imagen->getClientOriginalName();
           
        }

    if($cuentas_cobrar->update($request->all())){
          session()->flash('crearcuentas_cobrar', "Una orden de cobro ha sido editada");
          return redirect("cuentas_cobrar");
      }else{
          return view('cuentas_cobrar.edit',["cuentas_cobrar"=>$cuentas_cobrar]);
        
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
      $cuentas_cobrar = cuentas_cobrar::findOrFail($id);
     if ($cuentas_cobrar->delete()) {
        return redirect("cuentas_cobrar")->with(['mensaje_eliminarProspecto', 'Una orden de cobro ha sido eliminada']);
      } else {

      return redirect("cuentas_cobrar")->with('mensaje_eliminarProspecto2', 'Una orden de cobro no pudo ser eliminada');
    }


    }
}

