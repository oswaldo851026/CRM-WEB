<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
use Sentry;
use Illuminate\Support\Facades\Input;

class UsuariosController extends Controller
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
      $listaUser = DB::table('users')
      ->select("users.id as iduser", "users.*", "perfiles.*")
      ->leftJoin('perfiles','users.id_perfil','perfiles.id');
      if(!empty($busqueda)) { 
      $listaUser= $listaUser->where('users.first_name', 'like', $busqueda)
      ->orWhere('users.last_name', 'like', $busqueda)
      ->orWhere('users.email', 'like', $busqueda)
      ->orWhere('users.id', 'like', $busqueda);
      }
      $listaUser= $listaUser->orderBy('users.id')->paginate(10);

      return view('user.index',['listaUser'=>$listaUser]);
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
     $perfiles = DB::table('perfiles')->get();
      
     return view('user.create',['perfiles'=>$perfiles, 'idusuario'=>$idusuario]);

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
    
      if (Sentry::check()){    



 if($request->password_1 == $request->password_2) {
     $user= Sentry::register(array(
     'first_name' => $request->nombre,
     'last_name'    => $request->apellidos,
     'email' => $request->email,
     'id_perfil' => $request->id_perfil,
     'password' => $request->password_1,
     'username' => $request->usuario,


), true);

    session()->flash('mensajeUsuariosCrear', "El usuario ha sido creado");
    return redirect("user");

} else {

    session()->flash('mensajeUsuariosError', "La contraseña que escribió no coicide");
    return redirect("user");

    }
  

  }   else {

        return View('sentinel.sessions.login');
}


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         if (Sentry::check()){ 
     $idusuario = Sentry::getUser()->id;
     $perfiles = DB::table('perfiles')->get();
     $editar_user = User::findOrFail($id);
     return view('user.edit',['perfiles'=>$perfiles, 'idusuario'=>$idusuario, 'user'=>$editar_user]);

     } else {

        return View('sentinel.sessions.login');
     }
     
        



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
    if (Sentry::check()){ 
     $user = Sentry::findUserById($id);
     $user->first_name = $request->nombre;
     $user->last_name   = $request->apellidos;
     $user->email = $request->email;
     $user->id_perfil = $request->id_perfil;
     $user->username = $request->usuario;
    if(!empty($request->password_1)) {
    if($request->password_1 == $request->password_2) {
     $user->password = $request->password_1;
    }
    }
    $user->update();
    session()->flash('mensajeUsuariosEditar', "El usuario ha sido editado");
    return redirect("user");


    } else {

   return View('sentinel.sessions.login');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuarios $usuarios)
    {
        //
    }
}
