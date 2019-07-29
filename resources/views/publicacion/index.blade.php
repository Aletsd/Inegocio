@extends('layouts.primary')

@section('content')
  <div class="container-fluid">

      <div class="row page-titles">
          <div class="col-8 align-self-center">
              <h4 class="text-themecolor">Publicaciones</h4>
               <small class="breadcrums"><a href="{{route('resumen')}}">Resumen</a> <i class="fa fa-caret-right" aria-hidden="true"></i>  Publicaciones</small>
          </div>
          <div class="col-4 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                    <a href="{{route('publicaciones.create')}}" class="acccion btn btn-primary d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> <span>Nueva publicación</span></a>
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <h5>Publicaciones</h5>
                      <!-- Tabla-->
                      <div class="table-responsive">
                          <table id="example" class="table" style="width: 100%;" role="grid" aria-describedby="example_info">
                              <thead>
                                   <tr>
                                      <th width="30%">Título</th>
                                      <th width="30%">Introducción</th>
                                      <th>Fecha</th>
                                      <th>Acciones</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($publicaciones as $publicacion)
                                  <tr role="row" class="odd">
                                      <td class="sorting_1">
                                          <div class="media">
                                            <img class="mr-3" src="{{empty ($publicacion->avatar) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.$publicacion->avatar}}" width="34" alt="Producto 1">
                                              <div class="media-body">
                                                  {{$publicacion->title}}
                                              </div>
                                          </div>
                                      </td>

                                      <td>{{$publicacion->introduction}}</td>
                                      <td>{{$publicacion->created_at}}</td>
                                      <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{route('publicaciones.show',$publicacion->id)}}" class="acccion btn btn-primary btn-sm d-lg-block m-l-15"><i class="fa fa-pencil"></i> <span>Editar</span></a>
                                            <a href="#" class="acccion btn btn-primary btn-sm d-lg-block m-l-15" onclick="EliminarPublicacion('{{$publicacion->id}}')"><i class="fa fa-trash-o"></i> <span>Eliminar</span></a>
                                        </div>
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
@section('script')
  <script src="/assets/js/dropify/dropify.js"></script>
  <script src="/assets/js/blog.js"></script>
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
