@extends('layouts.primary')

@section('content')
  <div class="container-fluid">

      <div class="row page-titles">
          <div class="col-8 align-self-center">
              <h4 class="text-themecolor">Categorias del blog</h4>
               <small class="breadcrums"><a href="{{route('resumen')}}">Resumen</a> <i class="fa fa-caret-right" aria-hidden="true"></i>  Categorías del blog</small>
          </div>
          <div class="col-4 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                <button data-toggle="modal" data-target="#mNuevaCategoria"  class="acccion btn btn-primary d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> <span>Crear categoría</span></button>
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <h5>Categorías</h5>
                      <!-- Tabla-->
                      <div class="table-responsive">
                          <table id="example" class="table" style="width: 100%;" role="grid" aria-describedby="example_info">
                              <thead>
                                   <tr>
                                      <th>Título</th>
                                      <th>Acciones</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($categorias as $categoria)
                                  <tr role="row" class="odd">
                                      <td class="sorting_1">
                                          <div class="media">
                                            {{$categoria->title}}
                                          </div>
                                      </td>

                                      <td>
                                        
                                        <div class="d-flex align-items-center">
                                            <button class="acccion btn btn-primary btn-sm d-lg-block mr-1" data-toggle="modal" data-target="#mEditarCategoria" onclick="EditarCategoria({{$categoria->id}})"><i class="fa fa-pencil"></i> <span>Editar</span></button>
                                            <a href="#" class="acccion btn btn-primary btn-sm d-lg-block m-l-15" onclick="EliminarCategoria('{{$categoria->id}}')"><i class="fa fa-trash-o"></i> <span>Eliminar</span></a>
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
@section('modal')
  <!-- Modal Subir Archivos -->
  <div class="modal fade" id="mNuevaCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Categoría</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form accept-charset="UTF-8" action="{{route('categorias.store')}}" method="post">
                    @csrf
                      <div class="form-group">
                          <label for="invitacion">Título<span class="requerido">*</span></label>
                          <input type="text" class="form-control" id="invitacion" name="titulo" placeholder="Título de la categoría" required>
                      </div>
                      <div class="text-right mt-4">
                          <button type="submit" class="btn btn-info">Guardar Categoría</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

   <!-- Modal Subir Archivos -->
   <div class="modal fade" id="mEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Categoría</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form accept-charset="UTF-8">
                    @csrf
                      <div class="form-group">
                          <input type="hidden" id="idCategoria" name="idCategoria" value="">
                          <label for="invitacion">Título<span class="requerido">*</span></label>
                          <input type="text" class="form-control" id="editartitulo" name="titulo" placeholder="Título de la categoría" required>
                      </div>
                      <div class="text-right mt-4">
                          <button type="submit" class="btn btn-info" onclick="ActualizarCategoria()">Actualizar</button>
                      </div>
                  </form>
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
