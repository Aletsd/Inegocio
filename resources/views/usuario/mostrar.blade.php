@extends('layouts.primary')

@section('content')
  <div class="container-fluid">

      <div class="row page-titles">
          <div class="col-12 align-self-center">
              @if (!empty ($usuario) && $usuario->id == Auth::user()->id)
                <h4 class="text-themecolor">Mi perfil</h4>
              @elseif (!empty ($usuario))
                <h4 class="text-themecolor">Editar usuario</h4>
              @else
                <h4 class="text-themecolor">Nuevo usuario</h4>
              @endif
               <small class="breadcrums"><a href="{{route('resumen')}}">Resumen</a> <i class="fa fa-caret-right" aria-hidden="true"></i> <a href="{{route('usuarios')}}">Usuarios</a> <i class="fa fa-caret-right" aria-hidden="true"></i> Mi perfil</small>
          </div>
      </div>

      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <h5>Información</h5>
                    @if (empty ($usuario))
                      <form action="{{route('usuario.store')}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" >
                        @csrf
                    @else
                      <form action="{{route('usuario.update', $usuario->id)}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" >
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                    @endif


                        <div class="row">
                            <div class="col-12">
                                  <div class="form-group">
                                      <div class="avatar-upload">
                                          <div class="avatar-edit">
                                              <input type='file' id="imageUpload" name="myfile" accept=".png, .jpg, .jpeg" />
                                              <label for="imageUpload"></label>
                                          </div>
                                            <div id="mi-foto" class="avatar-preview" style="background-image:url('{{empty ($usuario->img_perfil) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.$usuario->img_perfil}}')">
                                              <div id="imagePreview"></div>
                                          </div>
                                          <div class="text-center mt-2">Subir Foto/Logotipo</div>
                                      </div>
                                  </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                  <div class="form-group">
                                      <label for="">Nombre<span class="requerido">*</span></label>
                                      <input type="text" class="form-control" id="nombres" name="nombres" value="{{empty ($usuario) ? '' : $usuario->nombres}}" required>
                                  </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                  <div class="form-group">
                                      <label for="">Apellido<span class="requerido">*</span></label>
                                      <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{empty ($usuario) ? '' : $usuario->apellidos}}" required>
                                  </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                  <div class="form-group">
                                      <label for="origin">Empresa<span class="requerido">*</span></label>
                                      <input type="text" class="form-control" id="empresa" name="empresa" value="{{empty ($usuario) ? '' : $usuario->empresa}}" required>
                                  </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                  <div class="form-group">
                                      <label for="">Correo electrónico<span class="requerido">*</span></label>
                                      @if (empty ($usuario))
                                      <input  type="email" class="form-control" id="email" name="email" value="{{empty ($usuario) ? '' : $usuario->email}}" required>
                                      @else
                                        <input readonly type="email" class="form-control" id="email" name="email" value="{{empty ($usuario) ? '' : $usuario->email}}">
                                      @endif

                                  </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                  <div class="form-group">
                                      <label for="">Celular</label>
                                      <input type="tel" class="form-control" id="celular" name="celular" value="{{empty ($usuario) ? '' : $usuario->telefono}}">
                                  </div>
                            </div>

                            <div class="col-12 col-sm-4">
                              @isset($roles)
                                <div class="form-group">
                                    <label for="">Rol</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="rol">
                                        <option value="0" selected disabled>Seleccionar...</option>
                                        @foreach ($roles as $rol)
                                          @if (isset($usuario->rol->id) && $rol->id === $usuario->rol->id)
                                            <option value="{{$rol->id}}" selected>{{$rol->rol}}</option>
                                          @else
                                            <option value="{{$rol->id}}" >{{$rol->rol}}</option>
                                          @endif
                                        @endforeach
                                    </select>
                                </div>
                              @endisset
                            </div>
                            @if (Auth::user()->rol->tipo == "cliente" || Auth::user()->rol->tipo == "admin")
                              <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Datos fiscales</label>
                                        <textarea class="form-control" id="" rows="3" name="datos_fiscales" Placeholder="(Sólo si es cliente)">{{empty ($usuario) ? '' : $usuario->datos_fiscales}}</textarea>
                                    </div>
                              </div>
                            @endif

                            <div class="col-12">
                                <h5>Contraseña</h5>
                                <hr>
                            </div>

                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label for="">Nueva contraseña</label>
                                    <input type="password" class="form-control" id="nueva_contraseña" name="nueva_contraseña">
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    <label for="">Repetir contraseña</label>
                                    <input type="password" class="form-control" id="rep_nueva_contraseña" name="rep_nueva_contraseña">
                                </div>
                            </div>
                          @if (!empty ($usuario) && $usuario->id != Auth::user()->id)


                              <div class="col-12">
                                  <h5>Proyectos</h5>
                                  <hr>
                              </div>
                              <div class="col-12 col-sm-6">

                                          <div class="form-group">
                                              <label for="">Proyecto<span class="requerido">*</span></label>
                                              <select class="form-control" id="Select1" name="proyecto">
                                                  <option value="0">Seleccionar...</option>
                                                  @foreach ($proyectos as $proyecto)
                                                    <option value="{{$proyecto->id}}">{{$proyecto->nombre}}</option>
                                                  @endforeach

                                              </select>
                                          </div>


                              </div>

                                <div class="col-12 col-sm-6">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th>Proyectos asignados</th>
                                            <th class="text-right">Acciones</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($usuario->proyectos as $proyecto)
                                            <tr>
                                              <td>{{$proyecto->nombre}}</td>
                                              <td class="text-right" onclick="RemoverProyecto({{$usuario->id}},{{$proyecto->id}})"><a class="btn btn-danger btn-sm text-white"  href='#'><i class="fa fa-times-circle" aria-hidden="true" ></i></a></td>
                                            </tr>
                                          @endforeach

                                        </tbody>
                                      </table>
                                  </div>


                            @endif

                            @if (empty ($usuario))
                              <div class="col-12 text-center mt-5 mb-4">
                                  <button class="btn btn-info" type="submit">Crear usuario</button>
                              </div>
                            @else
                              <div class="col-12 text-center mt-5 mb-4">
                                  <button class="btn btn-info" type="submit">Actualizar</button>
                              </div>
                            @endif

                        </div>

                      </form>



                  </div>
              </div>
          </div>
      </div>

  </div>
@endsection

@section('script')
<script src="/assets/js/usuario.js"></script>
<script>
  function Prueba(){
    Swal.fire(
      'Usuario nuevo!',
      'Agregado correctamente!',
      'success'
    )
  }
</script>
@endsection
