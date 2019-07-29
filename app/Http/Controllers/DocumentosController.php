<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GestionProyecto;
use App\DesarrolloProyecto;
use App\OperacionProyecto;
use App\DisenoPropuestaProyecto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use File;
use App\User;
use App\Documento;
use Alert;
use Illuminate\Support\Facades\DB;

class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
          $size = Storage::disk('s3')->size($filenametostore);
          $size = ($size/1024)/1024;
          DB::beginTransaction();

          $documento = new Documento;

          $documento->fill([
            'proyecto_id' => $request->proyecto_id,
            'user_id' => $usuario->id,
            'nombre_archivo' => $request->nombre.'.'.$extension,
            'nombre_nube' => $filenametostore,
            'peso_archivo' => number_format($size, 2),
            'etapa' => $request->etapa,
            'tipo' => $request->tipo,
          ]);
          $documento->save();

          DB::commit();
          return response()->json([ 'status' => true, 'documento' => $documento]);

        } catch (Exception $ex) {
            DB::rollback();
            return response()->json([ 'status' => false]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $documento = Documento::find($id);

      return response()->json([ 'status' => true, 'documento' => $documento]);
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
      try {
          DB::beginTransaction();

          $documento = Documento::find($id);
          $documento->nombre_archivo = $request->nombre_archivo;
          if ($request->tipo) {
            $documento->tipo = $request->tipo;
            $documento->etapa = $request->etapa;
          }

          $documento->save();

          DB::commit();
          return response()->json([ 'status' => true, 'documento' => $documento]);

        } catch (Exception $ex) {
            DB::rollback();
            return response()->json([ 'status' => false]);

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
        Documento::find($id)->delete();
        return response()->json([ 'status' => true, 'respuesta' => 'documento eliminado correctamente']);
    }

    public function descargarDocumento($id)
    {
        $documento = Documento::find($id);
        $documento = $documento->nombre_nube;
        return Storage::disk('s3')->download($documento);
    }

    public function CheckArchivos(Request $request){

      $archivo = null;

      if ($request->tipo == 1) {
        $archivo = DisenoPropuestaProyecto::find($request->id);
      }elseif($request->tipo == 2) {
        $archivo = DesarrolloProyecto::find($request->id);
      }elseif($request->tipo == 3) {
        $archivo = OperacionProyecto::find($request->id);
      }elseif($request->tipo == 4) {
        $archivo = GestionProyecto::find($request->id);
      }

      if ($archivo->estatus != 1) {
        $archivo->estatus = 1;
      }else {
        $archivo->estatus = 0;
      }
      $archivo->save();
      $avance = $this->CalcularAvance($request->proyecto_id);

      return response()->json([ 'status' => true, 'avance' => $avance]);
    }

    public function CalcularAvance($id_proyecto){
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

        return $avance;
    }

    public function GetDocumento(Request $request){
      $etapa = $request->etapa;
      if ($request->etapa == 1 || $request->etapa == 2 || $request->etapa == 3) {
        $documentosLegal = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 1)->get();
        $documentosProyecto = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 2)->get();
        $documentosTecnico = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 3)->get();
        $documentosComercial = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 4)->get();
        $documentosAdministrativo = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 5)->get();

        return view('proyecto.documento', compact('documentosLegal','documentosProyecto','documentosTecnico','documentosComercial','documentosAdministrativo', 'etapa'));
      }elseif($request->etapa == 4){
        $documentosMetodologia = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 6)->get();
        $documentosCapacitacion = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 7)->get();

        return view('proyecto.documento', compact('documentosMetodologia','documentosCapacitacion', 'etapa'));
      }else {
        return 'etapa no encontrada';
      }
    }

    public function GetDocumentoHistorico(Request $request){
      $etapa = $request->etapa;
      if ($request->etapa == 1 || $request->etapa == 2 || $request->etapa == 3) {
        $documentosLegal = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 1)->onlyTrashed()->get();
        $documentosProyecto = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 2)->onlyTrashed()->get();
        $documentosTecnico = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 3)->onlyTrashed()->get();
        $documentosComercial = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 4)->onlyTrashed()->get();
        $documentosAdministrativo = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 5)->onlyTrashed()->get();

        return view('proyecto.historico', compact('documentosLegal','documentosProyecto','documentosTecnico','documentosComercial','documentosAdministrativo', 'etapa'));
      }elseif($request->etapa == 4){
        $documentosMetodologia = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 6)->onlyTrashed()->get();
        $documentosCapacitacion = Documento::where('proyecto_id', $request->proyecto_id)->where('etapa', $request->etapa)->where('tipo', 7)->onlyTrashed()->get();

        return view('proyecto.historico', compact('documentosMetodologia','documentosCapacitacion', 'etapa'));
      }else {
        return 'etapa no encontrada';
      }
    }

    public function RestauraDocumento(Request $request){
      Documento::onlyTrashed()->find($request->id_documento)->restore();
      return response()->json([ 'status' => true, 'respuesta' => 'documento restaurado correctamente']);
    }

    public function EliminarPermanenteDocumento($id){
      Documento::onlyTrashed()->find($id)->forceDelete();
      return response()->json([ 'status' => true, 'respuesta' => 'documento eliminado permanentemente']);
    }


}
