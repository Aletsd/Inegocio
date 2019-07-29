<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\TestEvent;
use DB;
use Mail;
use App\Mensaje;
use App\User;
use App\Mail\mensajesPendientes;
use Pusher;

class MensajeController extends Controller
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
        try{
            $result = DB::transaction(function() use ($request){
                $user = Auth::user();
                $mensaje = new Mensaje;

                $mensaje->fill([
                    'proyecto_id' => $request->proyecto_id,
                    'emisor_id' => $user->id,
                    'receptor_id' => $request->receptor_id,
                    'tipo' => $request->tipo,
                    'mensaje' => $request->mensaje,
                    'visto' => 0,
                ]);

                $mensaje->save();
                $user = User::find($request->receptor_id);
                event(new TestEvent($user, $mensaje,$request->proyecto_id));
                //enviar correo, solo si el usuario esta desconectado

                if ($request->estado == 'desconectado') {
                  $destinatario = $mensaje->receptor->email;
                  Mail::to($destinatario)->send(new mensajesPendientes($mensaje));
                }


                DB::commit();

                return ['status' => true, 'message' => 'Mensaje enviado correctamente.'];
            });

            return response()->json($result);
        } catch (Exception $e){
            DB::rollBack();
            return response()->json([ 'status' => false, 'message' => 'Ocurrió un problema al crear el empleado.']);
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
    public function getchat(Request $request)
    {
        $user = Auth::user();
        $emisor_id = $request->emisor_id;
        $conversacion = Mensaje::where('proyecto_id',$request->proyecto_id)
                                ->where(function($q) use ($request, $user){
                                  $q->where('emisor_id', $user->id)
                                    ->where('receptor_id', $request->emisor_id)
                                    ->orWhere('receptor_id', $user->id)
                                    ->where('emisor_id', $request->emisor_id);
                                })
                               ->get();
        return view('proyecto.chat', compact('conversacion', 'emisor_id'));
    }

    public function buscarMensaje(Request $request){
      $user = Auth::user();
      $emisor_id = $request->emisor_id;
      $conversacion = Mensaje::where('proyecto_id',$request->proyecto_id)
                              ->where('mensaje','like', "%$request->busqueda%")
                              ->where(function($q) use ($request, $user){
                                $q->where('emisor_id', $user->id)
                                  ->where('receptor_id', $request->emisor_id)
                                  ->orWhere('receptor_id', $user->id)
                                  ->where('emisor_id', $request->emisor_id);
                              })
                             ->get();
      return view('proyecto.chat', compact('conversacion', 'emisor_id'));
    }

    public function Visto(Request $request){
      $user = Auth::user();
      $emisor_id = $request->emisor_id;
      $conversacion = Mensaje::where('proyecto_id',$request->proyecto_id)
                              ->where('emisor_id', $emisor_id)
                              ->where('receptor_id', $user->id)
                              ->where('visto', null)
                             ->get();

      foreach ($conversacion as $conver) {
         $conver->visto = true;
         $conver->save();
      }
    }

}
