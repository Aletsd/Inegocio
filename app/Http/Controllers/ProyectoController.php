<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;
use App\Proyecto;
use App\User;
use Alert;
use Illuminate\Support\Facades\DB;
use App\Documento;
use App\Mensaje;
use App\Desarrollo;
use App\DisenoPropuesta;
use App\Gestion;
use App\Operacion;
use App\GestionProyecto;
use App\DesarrolloProyecto;
use App\OperacionProyecto;
use App\DisenoPropuestaProyecto;
use App\Permit;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = Auth::user()->proyectos()->where('estatus', 1)->paginate(6);

        $historico = Proyecto::where('estatus', 0)->get();
        return view('proyecto.index', compact('proyectos', 'historico'));
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
          $filenametostore = "";
          if ($request->myfile) {
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

          DB::beginTransaction();

          $proyect  = new Proyecto;

          $proyect->fill([
            'nombre' => $request->proyectoNombre,
            'proyectoid' => $request->proyectoId,
            'imagen' => $filenametostore,
            'porcentaje' => 0,
            'estatus' => 1,
          ]);

          $proyect->save();

          $permisos  = new Permit;

          $permisos->fill([
            'proyecto_id' => $proyect->id,
            'user_id' => Auth::user()->id,
            'diseño' => true,
            'desarrollo' => true,
            'operacion' => true,
            'gestion' => true
          ]);

          $permisos->save();

          $user = Auth::user()->proyectos()->attach($proyect);
          $gestion_empresa =Gestion::all();
          $operaciones = Operacion::all();
          $diseños= DisenoPropuesta::all();
          $desarollos= Desarrollo::all();
          $proyect->gestion()->sync($gestion_empresa);
          $proyect->operaciones()->sync($operaciones);
          $proyect->diseños()->sync($diseños);
          $proyect->desarrollos()->sync($desarollos);


          DB::commit();
          Alert::success('Agregado con exito!', 'Proyecto: '.$request->proyectoNombre);
          return back()->withInput();

        } catch (Exception $ex) {
            DB::rollback();
            Alert::error($ex, 'Error al agregar el proyecto');
            return back()->withInput();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_proyecto)
    {
        $proyecto = Proyecto::find($id_proyecto);
        //dd($proyecto->diseños[0]->comun);
        $gestionCount = GestionProyecto::select(DB::raw('count(*) as cuenta, SUM(0.48) as avance'))
                       ->where('proyecto_id',$id_proyecto)
                       ->where('estatus','=', 1)
                       ->first();
         $desarrolloCount = DesarrolloProyecto::select(DB::raw('count(*) as cuenta, SUM(0.72) as avance'))
                      ->where('proyecto_id',$id_proyecto)
                      ->where('estatus','=', 1)
                      ->first();
         $disenoCount = DisenoPropuestaProyecto::select(DB::raw('count(*) as cuenta, SUM(0.4545) as avance'))
                      ->where('proyecto_id',$id_proyecto)
                      ->where('estatus','=', 1)
                      ->first();
          $operacionCount = OperacionProyecto::select(DB::raw('count(*) as cuenta, SUM(1.22) as avance'))
                       ->where('proyecto_id',$id_proyecto)
                       ->where('estatus','=', 1)
                       ->first();
        $avance = round(floatval($gestionCount->avance),1)+round(floatval($desarrolloCount->avance),1)+round(floatval($disenoCount->avance),1)+round(floatval($operacionCount->avance),1);
        $gestiones = GestionProyecto::where('proyecto_id',$id_proyecto)->get();
        $desarrollos = DesarrolloProyecto::where('proyecto_id',$id_proyecto)->get();
        $disenos = DisenoPropuestaProyecto::where('proyecto_id',$id_proyecto)->get();
        $operaciones = OperacionProyecto::where('proyecto_id',$id_proyecto)->get();
        //dd($disenos[0]->diseño);

        $proyecto->porcentaje = $avance;
        $proyecto->save();
        $usuarios = User::all();
        $user = Auth::user();
        $pendientes = Mensaje::select(DB::raw('count(*) as mensajes, receptor_id, emisor_id'))
                     ->where('proyecto_id',$id_proyecto)
                     ->where('receptor_id', $user->id)
                     ->where('visto','=', null)
                     ->groupBy('receptor_id')
                     ->groupBy('emisor_id')
                     ->get();

        $doc_diseño = Documento::where('etapa', '1')->where('proyecto_id',$id_proyecto)->get();
        $doc_desarrollo = Documento::where('etapa', '2')->where('proyecto_id',$id_proyecto)->get();
        $doc_administracion = Documento::where('etapa', '3')->where('proyecto_id',$id_proyecto)->get();
        $doc_gestion = Documento::where('etapa', '4')->where('proyecto_id',$id_proyecto)->get();

        return view('proyecto.show', compact('disenos','gestiones','desarrollos','operaciones','doc_diseño','doc_desarrollo','doc_administracion','doc_gestion','proyecto', 'usuarios', 'user', 'pendientes','gestionCount','desarrolloCount','disenoCount','operacionCount', 'avance'));
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
    public function update(Request $request)
    {
      try {
        $filenametostore = "";
        DB::beginTransaction();

        $proyecto = Proyecto::find($request->proyecto_id);
        if ($request->myfile) {
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
          $size = Storage::disk('s3')->size($filenametostore);
          $size = ($size/1024)/1024;
        }else {
          $filenametostore = $proyecto->imagen;
        }

          $proyecto->fill([
            'nombre' => $request->proyectoNombre,
            'imagen' => $filenametostore,
          ]);
          $proyecto->save();

          DB::commit();
          Alert::success('Actualizado con exito!', 'Proyecto');
          return back()->withInput();

        } catch (Exception $ex) {
          DB::rollback();
          Alert::error($ex, 'Erro al actualizar proyecto');
          return back()->withInput();

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proyecto = Proyecto::find($id);
        $proyecto->estatus = 0;
        $proyecto->save();
        return response()->json([ 'status' => true, 'respuesta' => 'proyecto archivado correctamente']);
    }

    public function agregarUsuario(Request $request){
      $proyecto = Proyecto::find($request->proyecto_id);
      User::find($request->usuario_id )->proyectos()->attach($proyecto);
      Alert::success('con exito!', 'Usuario agregado al proyecto proyecto');
      return redirect('/');
    }

    public function buscarUsuario(Request $request){
      $user = Auth::user();
      $usuarios = User::select(DB::raw('users.id, users.nombres, img_perfil'))
            ->join('proyecto_user', 'users.id', '=', 'proyecto_user.user_id')
            ->join('proyectos', 'proyectos.id', '=', 'proyecto_user.proyecto_id')
            ->where('proyecto_user.proyecto_id', $request->proyecto_id)
            ->where('users.nombres', 'like', "%$request->buscarUsuario%")
            ->where('users.id', '<>', $user->id)
            ->get();

       $pendientes = Mensaje::select(DB::raw('count(*) as mensajes, receptor_id, emisor_id'))
                    ->where('proyecto_id',$request->proyecto_id)
                    ->where('receptor_id', $user->id)
                    ->where('visto','=', null)
                    ->groupBy('receptor_id')
                    ->groupBy('emisor_id')
                    ->get();

      return  response()->json(['status' => true, 'usuarios' => $usuarios, 'pendientes' => $pendientes]);
    }
    public function RestaurarProyecto(Request $request){

      $proyecto = Proyecto::find($request->proyecto_id);
      $proyecto->estatus = 1;
      $proyecto->save();
      Alert::success('con exito!', 'proyecto restaurado correctamente');
      return back()->withInput();
    }
    public function EliminarPermanenteProyecto($id){
      Proyecto::find($id)->delete();
      Alert::success('con exito!', 'proyecto eliminado permanentemente');
      return back()->withInput();
    }

}
