@extends('layouts.primary')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-8 align-self-center">
            <h4 class="text-themecolor">Proyectos</h4>
            <small class="breadcrums"><a href="index.html">Resumen</a> <i class="fa fa-caret-right" aria-hidden="true"></i> Proyectos </small>
        </div>
        @if (Auth::user()->rol->tipo == "admin")
          <div class="col-4 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                  <button data-toggle="modal" data-target="#mNuevoProyecto" class="acccion btn btn-primary d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> <span>Nuevo proyecto</span></button>
              </div>
          </div>
        @endif

    </div>

    <div class="row">
        <div class="col-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#proyectos"><i class="fa fa-briefcase" aria-hidden="true"></i> <span>Proyectos en curso</span></a>
              </li>
              @if (Auth::user()->rol->rol === 'Administrador' || Auth::user()->rol->rol === 'Colaborador A')
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#historico"><i class="fa fa-archive" aria-hidden="true"></i> <span>Histórico</span></a>
                </li>
              @endif
            </ul>

            <!-- Tab panes -->
            <div class="tab-content pt-4  pb-5 card">
                <!-- Proyectos -->
                <div class="tab-pane container active" id="proyectos">
                    <div class="row">
                        <!-- Proyecto -->
                        @foreach ($proyectos as $proyecto)


                          <div class="col-12 col-sm-6 col-md-6 col-lg-4 mt-3">
                              <div class="proyecto m-auto">
                                  <div class="row">
                                      <div class="col-4">
                                          <img class="rounded-circle" src="{{empty($proyecto->imagen) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.$proyecto->imagen}}" alt="Imagen del proyecto">
                                          @if (Auth::user()->rol->rol === 'Administrador' || Auth::user()->rol->rol === 'Colaborador A')
                                          <a href="#" class="btn-more" data-toggle="dropdown" id="abri-menu-proyecto">
                                              <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                          </a>

                                            <div class="dropdown-menu" id='menu-proyecto'>
                                                <a onclick="EditarProyecto('{{$proyecto->id}}','{{$proyecto->nombre}}','{{$proyecto->proyectoid}}')" class="dropdown-item" href="#" data-toggle="modal" data-target="#mEditarProyecto" ><i class="fa fa-pencil"></i> Editar</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#" onclick="ArchivarProyecto({{$proyecto->id}})"><i class="fa fa-archive"></i> Archivar</a>
                                            </div>
                                          @endif
                                      </div>
                                      <div class="col-8">
                                          <p class="m-0">{{$proyecto->nombre}}</p>
                                          <small><strong>ID:</strong>{{$proyecto->proyectoid}}</small>
                                          <div class="progress inegocio-progress mt-2">
                                              <div class="progress-bar" style="width:{{$proyecto->porcentaje}}%">Progreso {{$proyecto->porcentaje}}%</div>
                                          </div>
                                          <div class="text-right">
                                            <a href="{{route('proyectos.show',$proyecto->id)}}" class="btn-ir mt-3 btn btn-primary btn-sm text-uppercase">Ir al proyecto</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        @endforeach
                        <!-- /Proyecto -->


                        <div class="col-12  mt-5">


                            <nav class="pull-right">
                              {{ $proyectos->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Proyectos -->
                <!-- Histórico -->
                @if (Auth::user()->rol->rol === 'Administrador')
                <div class="tab-pane container fade" id="historico">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Proyecto</th>
                                    <th>ID</th>
                                    <th>Estatus</th>
                                    <th>Cliente</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($historico as $proyecto)
                                <tr>
                                  <td>
                                    <div class="media">
                                      <img class="mr-3" src="{{empty($proyecto->imagen) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.$proyecto->imagen}}" width="34" alt="Producto 1">
                                      <div class="media-body">
                                        {{$proyecto->nombre}}
                                      </div>
                                    </div>
                                  </td>
                                  <td>{{$proyecto->proyectoid}}</td>
                                  <td>{{$proyecto->estatus}}</td>
                                  <td>{{$proyecto->cliente}}</td>
                                  <td>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <a href="#" class="acccion btn btn-link btn-sm d-lg-block m-l-15" onclick="RestaurarProyecto('{{$proyecto->id}}')"><i class="fa fa-briefcase"></i> <span>Restaurar</span></a>
                                      <a href="{{route('proyectos.show',$proyecto->id)}}" class="acccion btn btn-link btn-sm d-lg-block m-l-15"><i class="fa fa-eye"></i> <span>Ver</span></a>
                                      <a href="#" class="acccion btn btn-link btn-sm d-lg-block m-l-15" onclick="EliminarPermanenteProyecto('{{$proyecto->id}}')"><i class="fa fa-trash-o"></i> <span>Eliminar</span></a>
                                    </div>
                                  </td>
                                </tr>
                              @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                <!-- /Histórico -->
            </div>
            <!-- /Tab panes -->

        </div>
    </div>

</div>
@endsection

@section('modal')
  <!-- Modal Actualizar proyecto -->
  <div class="modal fade" id="mEditarProyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar Proyecto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form accept-charset="UTF-8" enctype="multipart/form-data" action="{{route('actualizarproyecto')}}" method="post">
                    @csrf
                      <div class="form-group">
                          <label for="proyectoNombre">Nombre del proyecto<span class="requerido">*</span></label>
                          <input type="text" class="form-control" id="proyectoNombre" name="proyectoNombre" value="">
                          <input type="hidden" id="proyecto_id" name="proyecto_id" value="">
                      </div>
                      <div class="form-group">
                          <label for="proyectoId">ID<span class="requerido">*</span></label>
                          <input type="text" class="form-control" id="proyectoId" disabled value="">
                      </div>
                      <div class="form-group text-center mt-3">
                          <div class="upload-btn-wrapper">
                            <button class="btn-block"><i class="fa fa-cloud-upload fa-5x"></i><br>Subir imagen</button>
                            <input type="file" name="myfile">
                          </div>
                      </div>
                      <div class="text-right mt-4">
                          <button type="submit" class="btn btn-info">Actualizar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal Nuevo proyecto -->
  <div class="modal fade" id="mNuevoProyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Nuevo Proyecto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form accept-charset="UTF-8" enctype="multipart/form-data" action="{{route('proyectos.store')}}" method="post">
                    @csrf
                      <div class="form-group">
                          <label for="proyectoNombre">Nombre del proyecto<span class="requerido">*</span></label>
                          <input type="text" class="form-control" id="proyectoNombre" name="proyectoNombre" required>
                      </div>
                      <div class="form-group">
                          <label for="proyectoId">ID<span class="requerido">*</span></label>
                          <input type="number" class="form-control" id="proyectoId" name="proyectoId" required>
                      </div>


                      <div class="form-group text-center mt-3">
                          <div class="upload-btn-wrapper">
                            <button class="btn-block"><i class="fa fa-cloud-upload fa-5x"></i><br>Subir imagen</button>
                            <input type="file" name="myfile">
                          </div>
                      </div>
                      <div class="text-right mt-4">
                          <button type="submit" class="btn btn-info">Crear Proyecto</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('script')
  <script src="/assets/js/proyecto.js"></script>
  <script>
      $(document).ready(function() {
          $('#example').DataTable({
              "language": {
                  "search": "Buscar",
                  "info":           "Mostrando _START_ - _END_ de _TOTAL_ proyectos",
                  "infoEmpty":      "Mostrando 0 de 0 de 0 entradas",
                  "lengthMenu":     "Mostrando _MENU_ registros",
                  "paginate": {
                      "first":      "Primero",
                      "last":       "Último",
                      "next":       "Siguiente",
                      "previous":   "Anterior"
                  },
              }
          });
      } );
  </script>
@endsection
