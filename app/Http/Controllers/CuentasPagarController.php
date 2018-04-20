<?php

namespace App\Http\Controllers;

use App\Cuentas_pagar;
use Illuminate\Http\Request;
use DB;
use Sentry;
use Detalle_pedido;
use Clientes;
use Illuminate\Support\Facades\Input;

class CuentasPagarController extends Controller
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
      $listacuentas_pagar = DB::table('cuentas_pagar')
      ->select("cuentas_pagar.id as idcuentas_pagar", "cuentas_pagar.*")
      ->leftJoin('detalle_pedidos','cuentas_pagar.id_pedido','detalle_pedidos.id')
      ->leftJoin('clientes','cuentas_pagar.id','clientes.id');
      if(!empty($busqueda)) { 
      $listacuentas_pagar= $listacuentas_pagar->orwhere('cuentas_pagar.estatus', 'like', $busqueda)
      ->orWhere('cuentas_pagar.monto', 'like', $busqueda);
      //->orWhere('pagar.id', 'like', $busqueda);
      }
      $listacuentas_pagar= $listacuentas_pagar->orderBy('id')->paginate(10);

      return view('pagar.index',['listacuentas_pagar'=>$listacuentas_pagar]);
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
     $detalle_pedidos = DB::table('detalle_pedidos')->get();
     $clientes = DB::table('clientes')->get();
     return view('pagar.create',['detalle_pedidos'=>$detalle_pedidos, 'clientes'=>$clientes, 'idusuario'=>$idusuario]);

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
    
    $cuentas_pagar = new cuentas_pagar($request->all());
  
    if(Input::hasFile('imagen_principal')){
            $imagen=Input::file('imagen_principal');
            $ruta= public_path().'/img/cuentas_pagar/';
            $imagen->move(public_path().'/img/cuentas_pagar/',$imagen->getClientOriginalName());
            $pagar->imagen_principal = $imagen->getClientOriginalName();
           
        }

    if($cuentas_pagar->save()){
          session()->flash('crearcuentas_pagar', "Una orden de pago ha sido creada");
          return redirect("cuentas_pagar");
      }else{
          return view('cuentas_pagar.create',["cuentas_pagar"=>$cuentas_pagar]);
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
     $detalle_pedidos = DB::table('detalle_pedidos')->get();
     $editar_cuentas_pagar =cuentas_pagar::findOrFail($id);
     $clientes = DB::table('clientes')->get();
     return view('cuentas_pagar.view',['detalle_pedidos'=>$detalle_pedidos, 'clientes'=>$clientes, 'idusuario'=>$idusuario, 
        'cuentas_pagar'=> $editar_cuentas_pagar]);

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
     $detalle_pedidos = DB::tables('detalle_pedido')->get();
     $editar_cuentas_pagar =cuentas_pagar::findOrFail($id);
     $clientes = DB::table('clientes')->get();
     return view('cuentas_pagar.edit',['detalle_pedidos'=>$detalle_pedidos, 'clientes'=>$clientes, 'idusuario'=>$idusuario, 
        'cuentas_pagar'=> $editar_cuentas_pagar]);

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
      $cuentas_pagar = cuentas_pagar::findOrFail($id);
    if(Input::hasFile('imagen_principal')){
            $imagen=Input::file('imagen_principal');
            $ruta= public_path().'/img/cuentas_pagar/';
            $imagen->move(public_path().'/img/cuentas_pagar/',$imagen->getClientOriginalName());
            $pagar->imagen_principal = $imagen->getClientOriginalName();
           
        }

    if($cuentas_pagar->update($request->all())){
          session()->flash('crearcuentas_pagar', "Una orden de pago ha sido editada");
          return redirect("cuentas_pagar");
      }else{
          return view('cuentas_pagar.edit',["cuentas_pagar"=>$cuentas_pagar]);
        
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
      $cuentas_pagar = cuentas_pagar::findOrFail($id);
     if ($cuentas_pagar->delete()) {
        return redirect("cuentas_pagar")->with(['mensaje_eliminarProspecto', 'Una orden de pago ha sido eliminada']);
      } else {

      return redirect("cuentas_pagar")->with('mensaje_eliminarProspecto2', 'Una orden de pago no pudo ser eliminada');
    }


    }
}
