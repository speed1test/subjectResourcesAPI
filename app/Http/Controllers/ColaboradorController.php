<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colaborador;
use App\Key;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except('listar_colaboradores');
    }

    public function index()
    {
        $c = Colaborador::all();
        return view('colaborador.colaboradores', compact('c'));
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

      $c = Colaborador::create(
      [
          'nombre' => $request->nombre,
          'contacto' => $request->con,
          'descripcion' => $request->des,

      ]);

      return back()->with('success', 'Colaborador creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $c = Colaborador::find($id);
      return view('colaborador.colaborador_edit', compact('c'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      Colaborador::where('id', $id)
     ->update([
       'nombre' => $request->nombre,
       'contacto' => $request->con,
       'descripcion' => $request->des,
       ]);

     return redirect()->route('colaboradores.index')->with('edit', 'Colaborador editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      Colaborador::destroy($id);
     return back()->with('delete', 'Colaborador eliminado correctamente');
    }


    //API
    public function listar_colaboradores($key){
        
        $key = Key::where('llave', $key)->get();
        if(count($key)>0){
           return Colaborador::all();
        }else{
          return [];
        }
    }
}
