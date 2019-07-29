<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Alert;
use File;
use App\BlogCategory;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user();
        $categorias = BlogCategory::all();
        return view('categoria.index', compact('categorias'));
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
            DB::beginTransaction();
 
            DB::table('blog_categories')->insert([
                'title' => $request->titulo
            ]);
 
            DB::commit();
            Alert::success('Categoría agregada con exito!', 'Nueva Categoria');
            return redirect('/categorias');
 
          } catch (Exception $ex) {
              DB::rollback();
              Alert::error($ex, 'Erro al agregar categoría');
              return redirect('/categorias');
 
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = BlogCategory::find($id);

        return response()->json([ 'status' => true, 'categoria' => $categoria]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogCategory  $blogCategory
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
     * @param  \App\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try {
            DB::beginTransaction();
  
            $categoria = BlogCategory::find($id);
            $categoria->title = $request->title;
            $categoria->save();
  
            DB::commit();
            return response()->json([ 'status' => true, 'categoria' => $categoria]);
  
          } catch (Exception $ex) {
              DB::rollback();
              return response()->json([ 'status' => false]);
  
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function deleteCategory($id)
    {
        try {

            DB::beginTransaction();
  
            BlogCategory::find($id)->delete();
  
            DB::commit();
            Alert::success('Eliminado con exito!', 'Categoría');
            return redirect('/categorias');
  
          } catch (Exception $ex) {
              DB::rollback();
              Alert::error($ex, 'Error al eliminar categoría');
              return redirect('/categorias');
  
          }
        return $id;
    }
}
