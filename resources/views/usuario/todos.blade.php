@extends('layouts.primary')

@section('content')
  <div class="container-fluid">

      <div class="row page-titles">
          <div class="col-8 align-self-center">
              <h4 class="text-themecolor">Usuarios</h4>
              <small class="breadcrums"><a href="{{route('resumen')}}">Resumen</a> <i class="fa fa-caret-right" aria-hidden="true"></i> Usuarios </small>
          </div>
          <div class="col-4 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                  <a href="{{route('usuario.create')}}" class="acccion btn btn-primary d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> <span>Nuevo usuario</span></a>
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <div class="table-responsive">
                          <table id="example" class="table table-striped table-bordered" style="width:100%">
                              <thead>
                                  <tr>
                                      <th>Usuario</th>
                                      <th>Email</th>
                                      <th>Empresa</th>
                                      <th>Rol</th>
                                      <th width="16%">Acciones</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @if (Auth::user()->rol->rol == 'Cliente A' || Auth::user()->rol->rol == 'Cliente B')
                                    @foreach ($usuarios as $user)
                                      <tr>
                                        <td>
                                          <div class="media">
                                            <img class="mr-3" src="{{empty ($user->usuario->img_perfil) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.$user->usuario->img_perfil}}" width="34" alt="Producto 1">
                                            <div class="media-body">
                                              {{$user->usuario->nombres}}
                                            </div>
                                          </div>
                                        </td>
                                        <td>{{$user->usuario->email}}</td>
                                        <td>{{$user->usuario->empresa}}</td>
                                        <td>{{$user->usuario->rol->rol}}</td>
                                        <td>
                                          <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{route('usuario.show',$user->usuario->id)}}" class="acccion btn btn-primary btn-sm d-lg-block m-l-15"><i class="fa fa-pencil"></i> <span>Editar</span></a>
                                            <a href="#" data-toggle="modal" data-target="#mPermisosUsuario" class="acccion btn btn-primary btn-sm d-lg-block ml-1 mr-1" onclick="GetProyectos('{{$user->usuario->id}}')"><i class="fa fa-key"></i> <span>Permisos</span></a>
                                            <a href="#" class="acccion btn btn-primary btn-sm d-lg-block m-l-15" onclick="EliminarUsuario('{{$user->usuario->id}}')"><i class="fa fa-trash-o"></i> <span>Eliminar</span></a>
                                          </div>
                                        </td>
                                      </tr>
                                    @endforeach
                                  @else
                                    @foreach ($usuarios as $user)
                                      <tr>
                                        <td>
                                          <div class="media">
                                            <img class="mr-3" src="{{empty ($user->img_perfil) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.$user->img_perfil}}" width="34" alt="Producto 1">
                                            <div class="media-body">
                                              {{$user->nombres}}
                                            </div>
                                          </div>
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->empresa}}</td>
                                        <td>
                                           @if(isset($user->rol->rol))
                                             {{$user->rol->rol}}
                                           @else
                                             {{$user->rol}}
                                           @endif

                                        </td>
                                        <td>
                                          <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{route('usuario.show',$user->id)}}" class="acccion btn btn-primary btn-sm d-lg-block m-l-15"><i class="fa fa-pencil"></i> <span>Editar</span></a>
                                            <a href="#" data-toggle="modal" data-target="#mPermisosUsuario" class="acccion btn btn-primary btn-sm d-lg-block ml-1 mr-1" onclick="GetProyectos('{{$user->id}}')"><i class="fa fa-key"></i> <span>Permisos</span></a>
                                            <a href="#" class="acccion btn btn-primary btn-sm d-lg-block m-l-15" onclick="EliminarUsuario('{{$user->id}}')"><i class="fa fa-trash-o"></i> <span>Eliminar</span></a>
                                          </div>
                                        </td>
                                      </tr>
                                    @endforeach
                                  @endif


                              </tbody>
                          </table>
                      </div>

                  </div>
              </div>
          </div>
      </div>

  </div>
@endsection
@section('modal')
  <!-- Modal Subir Archivos -->
  <div class="modal fade" id="mPermisosUsuario" tabindex="-1" role="dialog" aria-labelledby="mPermisosUsuario" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Permisos de Usuario</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form>
                      <div id="divProyectos">
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row" id='divPermisos'>

                        </div>
                      <div class="text-right mt-4">
                          <button type="button" class="btn btn-info" onclick="GuardarPermiso()">Guardar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('script')
  <script src="/assets/js/usuario.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script>
      $(document).ready(function() {
          $('#example').DataTable({
            dom: 'Bfrtip',

            buttons: [
              {
                  extend: 'pdf',
                  className: 'btn btn-sm btn-outline-danger'
              },
              {
                  extend: 'excel',
                  className: 'btn btn-sm btn-outline-success ml-2'
              }


            ],
              "language": {
                  "search": "Buscar",
                  "info":           "Mostrando _START_ - _END_ de _TOTAL_ usuarios",
                  "infoEmpty":      "Mostrando 0 de 0 de 0 entradas",
                  "lengthMenu":     "Mostrando _MENU_ registros",
                  "paginate": {
                      "first":      "Primero",
                      "last":       "Último",
                      "next":       "Sig",
                      "previous":   "Ant"
                  },
              }
          });
      } );
  </script>
@endsection
