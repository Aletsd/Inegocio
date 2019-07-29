@extends('layouts.primary')

@section('content')
  <div class="container-fluid">

      <div class="row page-titles">
          <div class="col-8 align-self-center">
              <h4 class="text-themecolor">Material de apoyo</h4>
               <small class="breadcrums"><a href="{{route('resumen')}}">Resumen</a> <i class="fa fa-caret-right" aria-hidden="true"></i>  Material de apoyo</small>
          </div>
          <div class="col-4 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                  @if (Auth::user()->rol->rol === 'Administrador' || Auth::user()->rol->rol === 'Colaborador A')
                    <button data-toggle="modal" data-target="#mNuevoProyecto" class="acccion btn btn-primary d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> <span>Subir archivo</span></button>
                  @endif
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <h5>Archivos</h5>
                      <!-- Tabla-->
                      <div class="table-responsive">
                          <table id="example" class="table" style="width: 100%;" role="grid" aria-describedby="example_info">
                              <thead>
                                   <tr>
                                      <th>Archivo</th>
                                      <th>Descripción</th>
                                      <th>Acciones</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($materiales as $material)
                                  <tr role="row" class="odd">
                                      <td class="sorting_1">
                                          <div class="media">
                                              <i class="fa fa-paperclip fa-2x mr-3" aria-hidden="true"></i> {{$material->nombre_archivo}}
                                          </div>
                                      </td>

                                      <td>{{$material->descripcion}}</td>

                                      <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                          <a href="{{route('descargarArchivo', $material->id)}}" class="acccion btn btn-success btn-sm d-lg-block m-l-15"><i class="fa fa-download" aria-hidden="true"></i> <span>Descargar</span></a>
                                        </div>
                                        @if (Auth::user()->rol->rol === 'Administrador' || Auth::user()->rol->rol === 'Colaborador A')
                                          <div class="d-flex justify-content-between align-items-center">
                                              <a href="#" class="acccion btn btn-primary btn-sm d-lg-block m-l-15" onclick="EliminarMaterial('{{$material->id}}')"><i class="fa fa-trash-o"></i> <span>Eliminar</span></a>
                                          </div>
                                        @endif
                                      </td>
                                  </tr>
                                @endforeach

                                </tbody>
                          </table>
                      </div>
                      <!-- /Tabla-->
                  </div>
              </div>
          </div>
      </div>

  </div>
@endsection
@section('modal')
  <!-- Modal Subir Archivos -->
  <div class="modal fade" id="mNuevoProyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Archivo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form accept-charset="UTF-8" enctype="multipart/form-data" action="{{route('material.store')}}" method="post">
                    @csrf
                      <div class="form-group text-center mt-3">
                          <div class="upload-btn-wrapper">
                            <button class="btn-block"><i class="fa fa-cloud-upload fa-5x"></i><br>Subir archivo</button>
                            <input type="file" name="myfile">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="invitacion">Descripción<span class="requerido">*</span></label>
                          <input type="text" class="form-control" id="invitacion" name="descripcion" placeholder="">
                      </div>
                      <div class="text-right mt-4">
                          <button type="submit" class="btn btn-info">Subir archivo</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('script')
  <script src="/assets/js/dropify/dropify.js"></script>
  <script src="/assets/js/material.js"></script>
  <script>
      $(document).ready(function() {
          $('#example').DataTable({
              "language": {
                  "search": "Buscar",
                  "info":           "Mostrando _START_ - _END_ de _TOTAL_ archivos",
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
