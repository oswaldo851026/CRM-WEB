<?php

namespace App\Http\Controllers;

use App\Perfiles;
use Illuminate\Http\Request;
use DB;
use Sentry;
use Illuminate\Support\Facades\Input;

class PerfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
              if (Sentry::check()){ 
        $listaPerfiles = DB::table('perfiles')->get();

      return view('perfiles.index',['listaPerfiles'=>$listaPerfiles]);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfiles  $perfiles
     * @return \Illuminate\Http\Response
     */
    public function show(Perfiles $perfiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfiles  $perfiles
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfiles $perfiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfiles  $perfiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfiles $perfiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfiles  $perfiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfiles $perfiles)
    {
        //
    }
}
