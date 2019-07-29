<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Alert;
use Mail;
use File;
use App\User;
use App\Role;
use App\Proyecto;
use App\ProyectoUser;
use App\Permit;
use App\Cliente;
use App\Mail\NewUserEmail;
use App\Mail\ProyectAsignedEmail;

class UsuarioController extends Controller
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

        if (Auth::user()->rol->rol === 'Administrador' || Auth::user()->rol->rol === 'Cliente A' || Auth::user()->rol->rol === 'Colaborador A'){
          if (Auth::user()->rol->tipo == 'admin') {
            $roles = Role::all();
            $proyectos = Proyecto::where('estatus', 1)->get();
          }else {
            $roles = Role::where('tipo', Auth::user()->rol->tipo)->get();
            $proyectos= Auth::user()->proyectos()->where('estatus', 1);
          }
          $usuario = '';
          return view('usuario.mostrar', compact('usuario', 'roles', 'proyectos'));
        }else {
          Alert::warning('Acceso denegado!',Auth::user()->rol->rol);
          return back()->withInput();
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
      try{
          if ($request->nueva_contraseña != $request->rep_nueva_contraseña) {
            Alert::error('Las contraseñas no coinciden');
            return back()->withInput();
          }
          if ($request->nombres == "" || $request->apellidos == "") {
            Alert::error('Los nombres y apellidos son requeridos');
            return back()->withInput();
          }
          if ($request->empresa == "") {
            Alert::error('Nombre de la empresa es requerido');
            return back()->withInput();
          }
          $exist_user = User::where('email', $request->email)->withTrashed()->get();
          if (count($exist_user) > 0) {
            Alert::error('El correo electrónico esta en uso');
            return back()->withInput();
          }
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

              $user  = new User;

              $user->fill([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'empresa' => $request->empresa,
                'rol_id' => $request->rol,
                'img_perfil' => $filenametostore,
                'email' => $request->email,
                'datos_fiscales' => $request->datos_fiscales,
                'password' => bcrypt($request->nueva_contraseña),
              ]);

              $user->save();
              if (Auth::user()->rol->rol === 'Cliente A') {
                $cliente = new Cliente;
                $cliente->fill([
                  'user_id' => Auth::user()->id,
                  'cliente_id' => $user->id,
                ]);
                $cliente->save();
              }


              $user->password = $request->nueva_contraseña;
              $destinatario = $user->email;
              Mail::to($destinatario)->send(new NewUserEmail($user));
              if ($request->proyecto){
                    $proyecto = Proyecto::find($request->proyecto);
            				$user->proyectos()->attach($proyecto);

            				$permisos  = Permit::where('proyecto_id', $request->proyecto)->where('user_id', $user->id)->get();
            				if (count($permisos) == 0) {
            					if ($user->rol->rol === 'Cliente A' || $user->rol->rol === 'Administrador' || $user->rol->rol === 'Colaborador A') {
            					$permisos  = new Permit;

            					$permisos->fill([
            						'proyecto_id' => $request->proyecto,
            						'user_id' => $user->id,
            						'diseño' => true,
            						'desarrollo' => true,
            						'operacion' => true,
            						'gestion' => true
            					]);

            					$permisos->save();
            					}else {
            					$permisos  = new Permit;

            					$permisos->fill([
            						'proyecto_id' => $proyecto->id,
            						'user_id' => $user->id,
            					]);

            					$permisos->save();
            					}

            				}
                }
                    DB::commit();


          });

          Alert::success('Agregado con exito!', 'Nuevo usuario');
          return redirect()->route('usuarios');
      } catch (Exception $e){
          DB::rollback();
          Alert::error($e, 'Error al insertar nuevo usuario');
          return back()->withInput();
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
      if (Auth::user()->id == $id || Auth::user()->rol->rol === 'Administrador' || Auth::user()->rol->rol === 'Cliente A' || Auth::user()->rol->rol === 'Colaborador A'){
        $usuario = User::where('id', $id)->first();
        if (Auth::user()->rol->tipo === 'admin') {
          $proyectos = Proyecto::where('estatus', 1)->get();
          $roles = Role::all();
        }elseif (Auth::user()->rol->rol === 'Colaborador A') {
          $proyectos = Proyecto::where('estatus', 1)->get();
          $roles = Role::where('tipo', Auth::user()->rol->tipo)->get();
        }elseif (Auth::user()->rol->rol === 'Cliente A' || Auth::user()->rol->rol === 'Cliente B') {
          $proyectos = Proyecto::select('proyectos.id','proyectos.nombre')
                            ->join('proyecto_user','proyectos.id','=','proyecto_user.user_id')
                            ->where('proyectos.estatus', '1')
                            ->where('proyecto_user.user_id', Auth::user()->id)
                            ->get();

          $roles = Role::where('tipo', Auth::user()->rol->tipo)->get();
        }else {
          Alert::error('Acceso denegado');
          return back()->withInput();
          $proyectos = '';
          $roles = '';
        }

        return view('usuario.mostrar', compact('usuario', 'roles', 'proyectos'));
      }else {
        Alert::warning('Acceso denegado!',Auth::user()->rol->rol);
        return back()->withInput();
      }

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
      if ($request->nueva_contraseña != null && $request->nueva_contraseña != $request->rep_nueva_contraseña) {
        Alert::error('Las contraseñas no coinciden');
        return back()->withInput();
      }
      if (Auth::user()->id == $id || Auth::user()->rol->rol === 'Administrador' || Auth::user()->rol->rol === 'Cliente A' || Auth::user()->rol->rol === 'Colaborador A'){
        $usuario = User::find($id);
        $usuario->nombres = $request->nombres;
        $usuario->Apellidos = $request->apellidos;
        if ($request->rol){
          $usuario->rol_id = $request->rol;
        }
        $usuario->telefono = $request->celular;
        $usuario->empresa = $request->empresa;
        if ($request->datos_fiscales){
          $usuario->datos_fiscales = $request->datos_fiscales;
        }
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
          $usuario->img_perfil = $filenametostore;
        }

        if ($request->proyecto != 0){

          $proyect = ProyectoUser::where('proyecto_id', $request->proyecto)->where('user_id', $id)->get();

          if (count($proyect) == 0) {
            $proyecto = Proyecto::find($request->proyecto);

            $usuario->proyectos()->attach($proyecto);

            $destinatario = $request->email;
            $name_user = $request->nombres;
            Mail::to($destinatario)->send(new ProyectAsignedEmail($proyecto, $name_user));
          }

          $permisos  = Permit::where('proyecto_id', $request->proyecto)->where('user_id', $id)->get();
          if (count($permisos) == 0) {
            if ($usuario->rol->rol === 'Cliente A' || $usuario->rol->rol === 'Administrador' || $usuario->rol->rol === 'Colaborador A') {
              $permisos  = new Permit;

              $permisos->fill([
                'proyecto_id' => $request->proyecto,
                'user_id' => $id,
                'diseño' => true,
                'desarrollo' => true,
                'operacion' => true,
                'gestion' => true
              ]);

              $permisos->save();
            }else {
              $permisos  = new Permit;

              $permisos->fill([
                'proyecto_id' => $request->proyecto,
                'user_id' => $id,
              ]);

              $permisos->save();
            }

          }

        }
        $usuario->email = $request->email;

        if ($request->nueva_contraseña != null && $request->nueva_contraseña == $request->rep_nueva_contraseña) {
          $usuario->password = bcrypt($request->nueva_contraseña);
        }
        $usuario->save();
        Alert::success('Actualizado con exito!', 'Usuario');
        return back()->withInput();
      }else {
        Alert::warning('Acceso denegado!',Auth::user()->rol->rol);
        return back()->withInput();
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
    public function detachProyect($user_id, $proyecto_id){
      $proyecto = Proyecto::find($proyecto_id);
      $user = User::find($user_id)->proyectos()->detach($proyecto);

      Alert::success('Removido con exito!', 'Proyecto');
      return back()->withInput();
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        Alert::success('Eliminado con exito!', 'Usuario');
        return back()->withInput();
    }


    public function perfil(){
      $usuario = Auth::user();

      return view('usuario.mostrar', compact('usuario'));
    }

    public function usuarios(){

      if (Auth::user()->rol->rol === 'Administrador'){
        $usuarios = User::all();
        return view('usuario.todos', compact('usuarios'));
      }if (Auth::user()->rol->rol === 'Colaborador A'){
        $usuarios = User::join('roles','roles.id','=','users.rol_id')
                          ->where('roles.tipo','<>', 'admin')
                          ->get();
        return view('usuario.todos', compact('usuarios'));
      }elseif (Auth::user()->rol->rol === 'Cliente A' || Auth::user()->rol->rol === 'Cliente B'){
        $usuarios = Auth::user()->clientes;

        return view('usuario.todos', compact('usuarios'));
      }else {
        Alert::warning('Acceso denegado!',Auth::user()->rol->rol);
        return back()->withInput();
      }

    }
    public function getProyectos($usuario_id){
      $user = User::find($usuario_id);
      $proyectos = $user->proyectos;

      return view('usuario.proyectos', compact('proyectos', 'usuario_id'));
    }

    public function getPermisos($proyecto_id, $usuario_id){
      $permisos = Permit::where('proyecto_id', $proyecto_id)->where('user_id', $usuario_id)->first();

      return view('usuario.permisos', compact('permisos'));
    }

    public function GuardarPermiso(Request $request){
      try{
          $result = DB::transaction(function() use ($request){
              $permisos = Permit::find($request->permiso_id);

              if ($request->diseño == 'true') {
                $permisos->diseño = 1;
              }else {
                $permisos->diseño = 0;
              }

              if ($request->desarrollo == 'true') {
                $permisos->desarrollo = 1;
              }else {
                $permisos->desarrollo = 0;
              }

              if ($request->operacion == 'true') {
                $permisos->operacion = 1;
              }else {
                $permisos->operacion = 0;
              }

              if ($request->gestion == 'true') {
                $permisos->gestion = 1;
              }else {
                $permisos->gestion = 0;
              }

              $permisos->save();

              DB::commit();

              return ['status' => true, 'message' => 'Permisos asignados correctamente.'];
          });

          return response()->json($result);
      } catch (Exception $e){
          DB::rollBack();
          return response()->json([ 'status' => false, 'message' => 'Ocurrió un problema al asignar permisos.']);
      }
    }


}
