<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Proyecto;
use App\Material;
use App\Mensaje;
use App\Documento;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function resumen()
    {
        $proyectos = Auth::user()->proyectos()->where('estatus', 1)->paginate(3);
        $materiales = Material::get()->take(3);
        $user = Auth::user();
        $mensajes = Mensaje::select(DB::raw('count(*) as mensaje, receptor_id, emisor_id, proyecto_id'))
                     ->where('receptor_id', $user->id)
                     ->where('visto','=', null)
                     ->groupBy('receptor_id')
                     ->groupBy('emisor_id')
                     ->groupBy('proyecto_id')
                     ->get();
                     /*Mensaje::where('receptor_id', $user->id)
                           ->where('visto','=', null)
                           //->groupBy('emisor_id')
                           ->get();*/

        $documentos = Documento::select(DB::raw('documentos.id, documentos.nombre_archivo, documentos.proyecto_id'))
                    ->join('proyectos', 'documentos.proyecto_id', '=', 'proyectos.id')
                    ->join('proyecto_user', 'proyectos.id', '=', 'proyecto_user.proyecto_id')
                    ->where('proyecto_user.user_id', $user->id)
                    ->where('proyectos.deleted_at', null)
                    ->where('proyectos.estatus', 1)
                    ->groupBy('documentos.id')
                    ->groupBy('documentos.nombre_archivo')
                    ->groupBy('documentos.proyecto_id')
                    ->get()
                    ->take(5);
        return view('resumen', compact('proyectos', 'documentos', 'mensajes'));
    }

}
