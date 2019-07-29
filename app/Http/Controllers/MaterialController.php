<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Alert;
use File;
use App\Material;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $usuario = Auth::user();
      $materiales = Material::all();
      return view('material.crear', compact('materiales'));
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
       try {
           //get filename with extension
           $filenamewithextension = $request->file('myfile')->getClientOriginalName();
           //get filename without extension
           $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
           //get file extension
           $extension = $request->file('myfile')->getClientOriginalExtension();
           //filename to store
           $filenametostore = $filename.'_'.time().'.'.$extension;
           //Upload File to s3
           Storage::disk('s3')->put($filenametostore, fopen($request->file('myfile'), 'r+'), 'public');

           $usuario = Auth::user();

           DB::beginTransaction();

           DB::table('materiales')->insert([
                "usuario_id" => $usuario->id,
               'nombre_archivo' => $filenametostore,
               'descripcion' => $request->descripcion,

           ]);

           DB::commit();
           Alert::success('Material agregado con exito!', 'Nuevo Material');
           return back()->withInput();

         } catch (Exception $ex) {
             DB::rollback();
             Alert::error($ex, 'Erro al agregar material');
             return back()->withInput();

         }
       //Store $filenametostore in the database
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function descargarArchivo($id)
    {
        $material = Material::find($id);
        $archivo = $material->nombre_archivo;
        return Storage::disk('s3')->download($archivo);
    }
    public function deleteArchivo($id){
      //Eliminacion temporal
      try {

          DB::beginTransaction();

          Material::find($id)->delete();

          DB::commit();
          Alert::success('Eliminado con exito!', 'Material');
          return redirect('/material');

        } catch (Exception $ex) {
            DB::rollback();
            Alert::error($ex, 'Erro al insertar nuevo usuario');
            return redirect('/material');

        }
      return $id;
    }

}
