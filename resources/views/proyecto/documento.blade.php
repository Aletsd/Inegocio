@if ($etapa == 4)
  @if ($documentosMetodologia->count() > 0)
    <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#DisenoMetodología">
              Metodología
          </a>
        </div>
        <div id="DisenoMetodología" class="collapse" data-parent="#accordion">
            <div class="card-body table-responsive">
                <!-- Tabla -->
                <table class="table dataTable no-footer siva-files table-striped" style="width: 100%;" role="grid" aria-describedby="example_info"><!--
                    <thead>
                         <tr role="row"><th>Archivo</th><th>Acciones</th></tr>
                    </thead> -->
                    <tbody>
                      @foreach ($documentosMetodologia as $documento)
                        <tr role="row" class="odd">
                             <td class="sorting_1">
                                <div class="media">
                                    <span><a href="#">{{$documento->nombre_archivo}}</a> <br><small>{{$documento->created_at}} | Tamaño: {{$documento->peso_archivo}}mb</small></span>

                                </div>
                            </td>

                            <td>
                                <div id="accionesBtn" class="mt-2 acciones acciones1">
                                     <a class="acccion btn btn-success btn-sm d-lg-block mr-1" href="{{route('documento', $documento->id)}}"><i class="fa fa-download" aria-hidden="true"></i> <span>Descargar</span></a>

                                    <button class="acccion btn btn-primary btn-sm d-lg-block mr-1" data-toggle="modal" data-target="#mEditarArchivo" onclick="EditarDocumento({{$documento->id}})"><i class="fa fa-pencil"></i> <span>Editar</span></button>

                                    <button class="acccion btn btn-secondary btn-sm d-lg-block" onclick="ArchivarDocumento({{$documento->id}})"><i class="fa fa-archive"></i> <span>Archivar</span></button>
                                </div>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                <!-- /Tabla -->
            </div>
        </div>
    </div>
  @else
    <div class="card">
        <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" href="#DisenoMetodología">
                Metodología
            </a>
        </div>
        <div id="DisenoMetodología" class="collapse" data-parent="#accordion">
            <div class="card-body">
                No hay documentos cargados aún.
            </div>
        </div>
    </div>


  @endif
  @if ($documentosMetodologia->count() > 0)
    <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#DisenoCapacitación">
              Capacitación y desarrollo
          </a>
        </div>
        <div id="DisenoCapacitación" class="collapse" data-parent="#accordion">
            <div class="card-body table-responsive">
                <!-- Tabla -->
                <table class="table dataTable no-footer siva-files table-striped" style="width: 100%;" role="grid" aria-describedby="example_info"><!--
                    <thead>
                         <tr role="row"><th>Archivo</th><th>Acciones</th></tr>
                    </thead> -->
                    <tbody>
                      @foreach ($documentosCapacitacion as $documento)
                        <tr role="row" class="odd">
                             <td class="sorting_1">
                                <div class="media">
                                    <span><a href="#">{{$documento->nombre_archivo}}</a> <br><small>{{$documento->created_at}} | Tamaño: {{$documento->peso_archivo}}mb</small></span>

                                </div>
                            </td>

                            <td>
                                <div id="accionesBtn" class="mt-2 acciones acciones1">
                                     <a class="acccion btn btn-success btn-sm d-lg-block mr-1" href="{{route('documento', $documento->id)}}"><i class="fa fa-download" aria-hidden="true"></i> <span>Descargar</span></a>

                                    <button class="acccion btn btn-primary btn-sm d-lg-block mr-1" data-toggle="modal" data-target="#mEditarArchivo" onclick="EditarDocumento({{$documento->id}})"><i class="fa fa-pencil"></i> <span>Editar</span></button>

                                    <button class="acccion btn btn-secondary btn-sm d-lg-block" onclick="ArchivarDocumento({{$documento->id}})"><i class="fa fa-archive"></i> <span>Archivar</span></button>
                                </div>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                <!-- /Tabla -->
            </div>
        </div>
    </div>
  @else
    <div class="card">
        <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" href="#DisenoCapacitación">
                Capacitación y desarrollo
            </a>
        </div>
        <div id="DisenoCapacitación" class="collapse" data-parent="#accordion">
            <div class="card-body">
                No hay documentos cargados aún.
            </div>
        </div>
    </div>


  @endif
@else
  @if ($documentosLegal->count() > 0)
    <div class="card">
        <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#DisenoLegal">
                Legal
            </a>
        </div>
        <div id="DisenoLegal" class="collapse show" data-parent="#accordion">
            <div class="card-body table-responsive">
                <!-- Tabla -->
                <table class="table dataTable no-footer siva-files table-striped" style="width: 100%;" role="grid" aria-describedby="example_info"><!--
                    <thead>
                         <tr role="row"><th>Archivo</th><th>Acciones</th></tr>
                    </thead> -->
                    <tbody>
                      @foreach ($documentosLegal as $documento)
                        <tr role="row" class="odd">
                             <td class="sorting_1">
                                <div class="media">
                                    <span><a href="#">{{$documento->nombre_archivo}}</a> <br><small>{{$documento->created_at}} | Tamaño: {{$documento->peso_archivo}}mb</small></span>

                                </div>
                            </td>

                            <td>
                                <div id="accionesBtn" class="mt-2 acciones acciones1">
                                     <a class="acccion btn btn-success btn-sm d-lg-block mr-1" href="{{route('documento', $documento->id)}}"><i class="fa fa-download" aria-hidden="true"></i> <span>Descargar</span></a>

                                    <button class="acccion btn btn-primary btn-sm d-lg-block mr-1" data-toggle="modal" data-target="#mEditarArchivo" onclick="EditarDocumento({{$documento->id}})"><i class="fa fa-pencil"></i> <span>Editar</span></button>

                                    <button class="acccion btn btn-secondary btn-sm d-lg-block" onclick="ArchivarDocumento({{$documento->id}})"><i class="fa fa-archive"></i> <span>Archivar</span></button>
                                </div>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                <!-- /Tabla -->
            </div>
        </div>
    </div>
  @else
    <div class="card">
        <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" href="#DisenoLegal">
                Legal
            </a>
        </div>
        <div id="DisenoLegal" class="collapse" data-parent="#accordion">
            <div class="card-body">
                No hay documentos cargados aún.
            </div>
        </div>
    </div>


  @endif
  @if ($documentosProyecto->count() > 0)
    <div class="card">
        <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#DisenoProyectoEjecutivo">
                Proyecto Ejecutivo
            </a>
        </div>
        <div id="DisenoProyectoEjecutivo" class="collapse" data-parent="#accordion">
            <div class="card-body table-responsive">
                <!-- Tabla -->
                <table class="table dataTable no-footer siva-files table-striped" style="width: 100%;" role="grid" aria-describedby="example_info"><!--
                    <thead>
                         <tr role="row"><th>Archivo</th><th>Acciones</th></tr>
                    </thead> -->
                    <tbody>
                      @foreach ($documentosProyecto as $documento)
                        <tr role="row" class="odd">
                             <td class="sorting_1">
                                <div class="media">
                                    <span><a href="#">{{$documento->nombre_archivo}}</a> <br><small>{{$documento->created_at}} | Tamaño: {{$documento->peso_archivo}}mb</small></span>

                                </div>
                            </td>

                            <td>
                                <div id="accionesBtn" class="mt-2 acciones acciones1">
                                     <a class="acccion btn btn-success btn-sm d-lg-block mr-1" href="{{route('documento', $documento->id)}}"><i class="fa fa-download" aria-hidden="true"></i> <span>Descargar</span></a>

                                    <button class="acccion btn btn-primary btn-sm d-lg-block mr-1" data-toggle="modal" data-target="#mEditarArchivo" onclick="EditarDocumento({{$documento->id}})"><i class="fa fa-pencil"></i> <span>Editar</span></button>

                                    <button class="acccion btn btn-secondary btn-sm d-lg-block" onclick="ArchivarDocumento({{$documento->id}})"><i class="fa fa-archive"></i> <span>Archivar</span></button>
                                </div>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                <!-- /Tabla -->
            </div>
        </div>
    </div>
  @else
    <div class="card">
        <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" href="#DisenoProyectoEjecutivo">
                Proyecto Ejecutivo
            </a>
        </div>
        <div id="DisenoProyectoEjecutivo" class="collapse" data-parent="#accordion">
            <div class="card-body">
                No hay documentos cargados aún.
            </div>
        </div>
    </div>


  @endif
  @if ($documentosTecnico->count() > 0)
    <div class="card">
        <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#DisenoTecnico">
                Técnico
            </a>
        </div>
        <div id="DisenoTecnico" class="collapse" data-parent="#accordion">
            <div class="card-body table-responsive">
                <!-- Tabla -->
                <table class="table dataTable no-footer siva-files table-striped" style="width: 100%;" role="grid" aria-describedby="example_info"><!--
                    <thead>
                         <tr role="row"><th>Archivo</th><th>Acciones</th></tr>
                    </thead> -->
                    <tbody>
                      @foreach ($documentosTecnico as $documento)
                        <tr role="row" class="odd">
                             <td class="sorting_1">
                                <div class="media">
                                    <span><a href="#">{{$documento->nombre_archivo}}</a> <br><small>{{$documento->created_at}} | Tamaño: {{$documento->peso_archivo}}mb</small></span>

                                </div>
                            </td>

                            <td>
                                <div id="accionesBtn" class="mt-2 acciones acciones1">
                                     <a class="acccion btn btn-success btn-sm d-lg-block mr-1" href="{{route('documento', $documento->id)}}"><i class="fa fa-download" aria-hidden="true"></i> <span>Descargar</span></a>

                                    <button class="acccion btn btn-primary btn-sm d-lg-block mr-1" data-toggle="modal" data-target="#mEditarArchivo" onclick="EditarDocumento({{$documento->id}})"><i class="fa fa-pencil"></i> <span>Editar</span></button>

                                    <button class="acccion btn btn-secondary btn-sm d-lg-block" onclick="ArchivarDocumento({{$documento->id}})"><i class="fa fa-archive"></i> <span>Archivar</span></button>
                                </div>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                <!-- /Tabla -->
            </div>
        </div>
    </div>
  @else
    <div class="card">
        <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" href="#DisenoTecnico">
                Técnico
            </a>
        </div>
        <div id="DisenoTecnico" class="collapse" data-parent="#accordion">
            <div class="card-body">
                No hay documentos cargados aún.
            </div>
        </div>
    </div>


  @endif
  @if ($documentosComercial->count() > 0)
    <div class="card">
        <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#DisenoComercial">
                Comercial
            </a>
        </div>
        <div id="DisenoComercial" class="collapse" data-parent="#accordion">
            <div class="card-body table-responsive">
                <!-- Tabla -->
                <table class="table dataTable no-footer siva-files table-striped" style="width: 100%;" role="grid" aria-describedby="example_info"><!--
                    <thead>
                         <tr role="row"><th>Archivo</th><th>Acciones</th></tr>
                    </thead> -->
                    <tbody>
                      @foreach ($documentosComercial as $documento)
                        <tr role="row" class="odd">
                             <td class="sorting_1">
                                <div class="media">
                                    <span><a href="#">{{$documento->nombre_archivo}}</a> <br><small>{{$documento->created_at}} | Tamaño: {{$documento->peso_archivo}}mb</small></span>

                                </div>
                            </td>

                            <td>
                                <div id="accionesBtn" class="mt-2 acciones acciones1">
                                     <a class="acccion btn btn-success btn-sm d-lg-block mr-1" href="{{route('documento', $documento->id)}}"><i class="fa fa-download" aria-hidden="true"></i> <span>Descargar</span></a>

                                    <button class="acccion btn btn-primary btn-sm d-lg-block mr-1" data-toggle="modal" data-target="#mEditarArchivo" onclick="EditarDocumento({{$documento->id}})"><i class="fa fa-pencil"></i> <span>Editar</span></button>

                                    <button class="acccion btn btn-secondary btn-sm d-lg-block" onclick="ArchivarDocumento({{$documento->id}})"><i class="fa fa-archive"></i> <span>Archivar</span></button>
                                </div>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                <!-- /Tabla -->
            </div>
        </div>
    </div>
  @else
    <div class="card">
        <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" href="#DisenoComercial">
                Comercial
            </a>
        </div>
        <div id="DisenoComercial" class="collapse" data-parent="#accordion">
            <div class="card-body">
                No hay documentos cargados aún.
            </div>
        </div>
    </div>


  @endif
  @if ($documentosAdministrativo->count() > 0)
    <div class="card">
        <div class="card-header">
          <a class="collapsed card-link" data-toggle="collapse" href="#DisenoAdministrativo">
              Administrativo
          </a>
        </div>
        <div id="DisenoAdministrativo" class="collapse" data-parent="#accordion">
            <div class="card-body table-responsive">
                <!-- Tabla -->
                <table class="table dataTable no-footer siva-files table-striped" style="width: 100%;" role="grid" aria-describedby="example_info"><!--
                    <thead>
                         <tr role="row"><th>Archivo</th><th>Acciones</th></tr>
                    </thead> -->
                    <tbody>
                      @foreach ($documentosAdministrativo as $documento)
                        <tr role="row" class="odd">
                             <td class="sorting_1">
                                <div class="media">
                                    <span><a href="#">{{$documento->nombre_archivo}}</a> <br><small>{{$documento->created_at}} | Tamaño: {{$documento->peso_archivo}}mb</small></span>

                                </div>
                            </td>

                            <td>
                                <div id="accionesBtn" class="mt-2 acciones acciones1">
                                     <a class="acccion btn btn-success btn-sm d-lg-block mr-1" href="{{route('documento', $documento->id)}}"><i class="fa fa-download" aria-hidden="true"></i> <span>Descargar</span></a>

                                    <button class="acccion btn btn-primary btn-sm d-lg-block mr-1" data-toggle="modal" data-target="#mEditarArchivo" onclick="EditarDocumento({{$documento->id}})"><i class="fa fa-pencil"></i> <span>Editar</span></button>

                                    <button class="acccion btn btn-secondary btn-sm d-lg-block" onclick="ArchivarDocumento({{$documento->id}})"><i class="fa fa-archive"></i> <span>Archivar</span></button>
                                </div>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                <!-- /Tabla -->
            </div>
        </div>
    </div>
  @else
    <div class="card">
        <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" href="#DisenoAdministrativo">
                Administrativo
            </a>
        </div>
        <div id="DisenoAdministrativo" class="collapse" data-parent="#accordion">
            <div class="card-body">
                No hay documentos cargados aún.
            </div>
        </div>
    </div>


  @endif
@endif
