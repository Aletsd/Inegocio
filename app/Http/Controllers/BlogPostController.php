<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Alert;
use File;
use App\BlogCategory;
use App\BlogPost;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user();
        $publicaciones = BlogPost::all();
        return view('publicacion.index', compact('publicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = BlogCategory::all();
        return view('publicacion.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $result = DB::transaction(function() use ($request){
                $filenametostore="";
                if ($request->myfile != "") {
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
                }

                $status = 0;
                if(isset($request->publicar) && $request->publicar == 1){
                    $status = 1;
                }
  
                $post  = new BlogPost;
  
                $post->fill([
                  'user_id'=> Auth::user()->id,
                  'category_id'=>$request->category,
                  'title' => $request->name,
                  'introduction' => $request->introduction,
                  'description' => $request->description,
                  'avatar' => $filenametostore,
                  'topic' => $request->topic,
                  'status'=>$status
                ]);
  
                $post->save();
                DB::commit();
  
            });
  
            Alert::success('Agregado con exito!', 'Nueva publicación');
            return back()->withInput();
        } catch (Exception $e){
            DB::rollback();
            Alert::error($e, 'Error al insertar la publicación');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorias = BlogCategory::all();
        $post = BlogPost::where('id', $id)->first();
        return view('publicacion.show', compact('post','categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogPost  $blogPost
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
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $result = DB::transaction(function() use ($request, $id){
                $post = BlogPost::find($id);

                $status = 0;
                if(isset($request->publicar) && $request->publicar == 1){
                    $status = 1;
                }

                $post->update([
                    'category_id'=>$request->category,
                    'title' => $request->name,
                    'introduction' => $request->introduction,
                    'description' => $request->description,
                    'topic' => $request->topic,
                    'status'=>$status
                ]);
                
                $filenametostore="";
                if ($request->myfile != "") {
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

                    if($post->avatar != ""){
                        Storage::disk('s3')->delete($post->avatar);
                    }
                    $post->update([
                        'avatar'=>$filenametostore
                    ]);
                }
                DB::commit();
            });

            Alert::success('Editado con exito!', 'Editar publicación');
            return back()->withInput();
        } catch (Exception $e){
            DB::rollback();
            Alert::error($e, 'Error al editar la publicación');
            return back()->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function deletePost($id)
    {
        try {

            DB::beginTransaction();
  
            BlogPost::find($id)->delete();
  
            DB::commit();
            Alert::success('Eliminado con exito!', 'Publicación');
            return redirect('/publicaciones');
  
          } catch (Exception $ex) {
              DB::rollback();
              Alert::error($ex, 'Error al eliminar la publicación');
              return redirect('/publicaciones');
  
          }
        return $id;
    }
}
