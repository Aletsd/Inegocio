@extends('layouts.primary')

@section('content')
    <div class="container-fluid">

        <div class="row page-titles">
            <div class="col-12 align-self-center">
                <h4 class="text-themecolor">Resumen</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Proyectos en curso</h5>
                        <div class="row">
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
                                                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#mEditarProyecto" onclick="EditarProyecto('{{$proyecto->id}}','{{$proyecto->nombre}}','{{$proyecto->proyectoid}}')"><i class="fa fa-pencil"></i> Editar</a>
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

                            <div class="col-12 text-right mt-4">
                                <a href="{{route('proyectos.index')}}" class="btn btn-info">Ver más</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5>Mensajes recientes</h5>
                                <div class="col-12">
                                    <div class="mt-3">
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">Proyecto</th>
                                                    <th scope="col">Emisor</th>
                                                    <th scope="col" class="text-center"># Mensajes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($mensajes as $mensaje)

                                                        <tr data-href="{{route('proyectos.show',$mensaje->proyecto->id)}}">
                                                            <td>
                                                                <div class="media">
                                                                    {{$mensaje->proyecto->nombre}}
                                                                </div>
                                                            </td>
                                                            <td>{{$mensaje->emisor->nombres}}</td>
                                                            <td class="text-center">{{$mensaje->mensaje}}</td>
                                                        </tr>

                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6">

                          <div class="card">
                              <div class="card-body">
                                  <h5>Nuevos archivos</h5>
                                  <div class="col-12">
                                      <div class="mt-3">
                                          <div class="table-responsive">
                                              <table class="table mb-0 table-hover">
                                                  <tbody>
                                                    @foreach ($documentos as $documento)
                                                      <tr class='clickable-row' >
                                                          <td>
                                                            <a href="{{route('proyectos.show',$documento->proyecto_id)}}">
                                                              <div class="row">
                                                                  <div class="col-2">
                                                                      <i class="fa fa-paperclip fa-2x mr-3" aria-hidden="true"></i>
                                                                  </div>
                                                                  <div class="col-10">
                                                                      {{$documento->nombre_archivo}} <br><small class="small"><strong>{{$documento->proyecto->nombre}}</strong></small>
                                                                  </div>
                                                              </div>
                                                            </a>
                                                          </td>

                                                      </tr>
                                                    @endforeach



                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

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
@endsection
@section('script')
  <script src="/assets/js/proyecto.js"></script>
<script>
  $('#myTable').on( 'click', 'tbody tr', function () {
    window.location.href = $(this).data('href');
  });
</script>
@endsection
