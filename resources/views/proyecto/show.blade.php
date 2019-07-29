@extends('layouts.primary')

@section('content')
  <!-- Contenido -->
    <div class="container-fluid">

        <div class="row page-titles">
            <div class="col-8 align-self-center">
                <h4 class="text-themecolor">{{$proyecto->nombre}}</h4>
                <input type="hidden" id="proyecto_id" name="proyecto_id" value="{{$proyecto->id}}">
                <input type="hidden" id="receptor_id" name="receptor_id" value="">
                <input type="hidden" id="seccion_siva" name="seccion_siva" value="1">


                <small class="breadcrums"><a href="index.html">Resumen</a> <i class="fa fa-caret-right" aria-hidden="true"></i> <a href="{{route('proyectos.index')}}">Proyectos</a> <i class="fa fa-caret-right" aria-hidden="true"></i> {{$proyecto->nombre}}</small>
            </div>
            <div class="col-4 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    ID: {{$proyecto->proyectoid}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#proyectos"><i class="fa fa-comments" aria-hidden="true"></i> <span>Chat</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#siva"
                    @if (Auth::user()->permisos->diseño)
                      onclick="GetDocumento('1','btnDiseño')"
                    @elseif (Auth::user()->permisos->desarrollo)
                      onclick="GetDocumento('1','btnDesarrollo')"
                    @elseif (Auth::user()->permisos->operacion)
                      onclick="GetDocumento('1','btnAdministración')"
                    @elseif (Auth::user()->permisos->gestion)
                      onclick="GetDocumento('1','btnGestión')"
                    @endif>
                    <i class="fa fa-folder-open" aria-hidden="true" ></i> <span>SIVA</span></a>
                  </li>
                  @if (Auth::user()->rol->rol === 'Administrador' || Auth::user()->rol->rol === 'Colaborador A')
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#avance"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Avance</span></a>
                    </li>
                  @endif
                </ul>

                <!-- Tab panes -->
                <div class="tab-content card">
                    <!-- Conversaciones -->
                    <div class="tab-pane container active" id="proyectos">
                        <div class="row">
                            <div class="chat-main-box">
                                <!-- Panel IZQ -->
                                <div class="chat-left-aside">
                                    <div class="open-panel"><i class="ti-angle-right"></i></div>
                                    <div class="chat-left-inner" style="">
                                        <div class="form-material row">
                                            <!--<div class="col-2">
                                                <button data-toggle="modal" data-target="#mNuevaConversacion" type="button" class="btn btn-light acccion border-bottom"><i class="fa fa-user-plus"></i></button>
                                            </div>-->
                                            <div class="col-12">
                                                <input class="form-control" type="text" id="buscarUsuario" placeholder="Buscar Contacto">
                                            </div>

                                        </div>
                                        <ul class="chatonline style-none ps ps--theme_default" id="listaConversaciones">
                                            @foreach ($proyecto->usuarios as $usuario)
                                              @if ($usuario->id != Auth::user()->id)
                                                <li>
                                                    <a href="javascript:void(0)" class="activado" id='{{'div'.$usuario->id}}' onclick="AbrirChat('{{$proyecto->id}}','{{$usuario->id}}',this.id)">
                                                      <img src="{{empty ($usuario->img_perfil) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.$usuario->img_perfil}}" alt="user-img" class="img-circle">
                                                       <span>{{$usuario->nombres}}
                                                         @foreach ($pendientes as $pendiente)
                                                           @if ($pendiente->emisor_id ==$usuario->id)
                                                             <span class="text-danger" id="{{$usuario->nombres}}">({{$pendiente->mensajes}})
                                                             </span>
                                                           @endif
                                                         @endforeach
                                                         <small class="text-muted text-center" id='estado{{$usuario->id}}'>desconectado</small>
                                                      </span>
                                                    </a>
                                                </li>
                                              @endif

                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                                <!-- /Panel IZQ -->
                                <!-- Panel Derecho -->
                                <div class="chat-right-aside">
                                <div class="chat-main-header border-bottom">
                                    <div class="p-2 b-b">
                                        <form class="form-row" action="">
                                            <div class="col-12 col-sm-4 ml-auto">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="buscarMensaje" placeholder="Buscar mensaje...">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="chat-rbox ps ps--theme_default">
                                  <ul class="chat-list pl-3 pr-3 pt-0" id="mensajes">

                                  </ul>

                                  <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                                      <div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;">

                                      </div>
                                  </div>
                                  <div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;">
                                      <div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;">

                                      </div>
                                  </div>
                            </div>
                                <div class="card-body border-top">
                                    <div class="row">
                                        <div class="col-8 col-sm-8 col-md-7 col-lg-9 pr-0">
                                            <textarea rows="2" placeholder="Escribir mensaje..." class="form-control" id="mensaje"></textarea>
                                        </div>
                                        <div class="col-4 col-sm-4 col-md-5 col-lg-3 pl-0 text-right">
                                            <button data-toggle="modal" data-target="#mSubirArchivo" type="button" class="btn btn-secondary btn-sm acccion"><i class="fa fa-paperclip"></i></button>
                                            <button type="button" class="btn btn-primary btn-sm acccion" onclick="EnviarMensaje('texto')"><i class="fa fa-paper-plane"></i> <span>Enviar</span> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- /Panel Derecho -->
                            </div>
                        </div>
                    </div>
                    <!-- /Conversaciones -->
                    <!-- SIVA -->
                    <div class="tab-pane container fade p-4" id="siva">
                        <div class="row">
                            <div class="col-12 d-block d-sm-none">
                                <form action="#" class="form-row">
                                    <div class="form-group col-12">
                                        <label for="exampleFormControlSelect1">Fase:</label>
                                        <select class="form-control" id="exampleFormControlSelect1" onchange="GetDocumento(this.value,this.id)">
                                          @if (Auth::user()->permisos->diseño)
                                            <option value="1">Diseño de propuesta</option>
                                          @endif
                                          @if (Auth::user()->permisos->desarrollo)
                                            <option value="2">Desarrollo</option>
                                          @endif
                                          @if (Auth::user()->permisos->operacion)
                                            <option value="3">Administración del proyecto</option>
                                          @endif
                                          @if (Auth::user()->permisos->gestion)
                                            <option value="4">Gestión de empresa</option>
                                          @endif
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div id="categorias" class="col-12 col-sm-3 col-md-3 col-lg-3 p-0 d-none d-sm-block">
                                @if (Auth::user()->permisos->diseño)
                                  <div class="bd-highlight" onclick="GetDocumento('1', this.id)" id="btnDiseño">Diseño de propuesta</div>
                                @endif
                                @if (Auth::user()->permisos->desarrollo)
                                  <div class="bd-highlight" onclick="GetDocumento('2', this.id)" id="btnDesarrollo">Desarrollo</div>
                                @endif
                                @if (Auth::user()->permisos->operacion)
                                  <div class="bd-highlight" onclick="GetDocumento('3', this.id)" id="btnAdministración">Administración del proyecto</div>
                                @endif
                                @if (Auth::user()->permisos->gestion)
                                  <div class="bd-highlight" onclick="GetDocumento('4', this.id)" id="btnGestión">Gestión de empresa</div>
                                @endif
                            </div>
                            <div id="subcategorias" class="col-12 col-sm-9 col-md-9 col-lg-9">
                                <div class="row pt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 text-right">
                                                <button id="subirArchivo" class="btn btn-primary acccion" data-toggle="modal" data-target="#mSubirArchivo"><i class="fa fa-paperclip" aria-hidden="true"></i> <span>Subir Archivo</span></button>
                                                <button id="GotoHistorico" class="btn btn-secondary acccion" onclick="GetDocumentoHistorico()"><i class="fa fa-archive" aria-hidden="true" ></i> <span>Histórico</span></button>
                                                <button id="GotoSiva" class="btn btn-secondary acccion" onclick="GetDocumento(5, this.id)"><i class="fa fa-folder-open" aria-hidden="true"></i> <span>SIVA</span></button>
                                            </div>
                                            <!-- Gestión de Archivos -->
                                            <div class="col-12">
                                                <div class="container">
                                                    <h2 id="dymanicTitle">SIVA</h2>
                                                    <div id="accordion">

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Gestión de Archivos -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /SIVA -->
                    <!-- Avance-->
                    <div class="tab-pane container fade p-4" id="avance">
                        <div class="row">
                            <div class="col-12">
                                <h2>Ponderador</h2>
                            </div>
                            <div class="col-12">
                                <div class="progress" style="height:30px;">
                                    <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><span>Diseño 10%</span></div>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">Desarrollo 40%</div>
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 40%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Operación 40%</div>
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 10%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Gestión 10%</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <h2>Avance <span id='SpanAvance'>{{$avance}}</span> %</h2>
                            </div>
                            <div class="col-12">
                                <div class="progress" style="height:30px;">
                                    <div class="progress-bar" role="progressbar" style="width:{{round($disenoCount->avance)}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id='diseñoDiv'><span> <span id='diseñoP'>{{empty ($disenoCount->avance) ? 0 : round($disenoCount->avance)}}</span>%</span></div>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{round($desarrolloCount->avance)}}%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" id='desarrolloDiv'><span> <span id='desarrolloP'>{{empty ($desarrolloCount->avance) ? 0 : round($desarrolloCount->avance)}}</span>%</span></div>
                                    <div class="progress-bar bg-info" role="progressbar" style="width: {{round($operacionCount->avance)}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" id='operacionDiv'><span> <span id='operacionP'>{{empty ($operacionCount->avance) ? 0 : round($operacionCount->avance)}}</span>%</span></div>
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{round($gestionCount->avance)}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" id='gestionDiv'><span> <span id='gestionP'>{{empty ($gestionCount->avance) ? 0 : round($gestionCount->avance)}}</span>%</span></div>
                                </div>
                            </div>
                            <!-- Diseño de propuesta -->



                              <div class="col-12 mt-5">
                                  <h4>Diseño de Propuesta</h4>
                                  <hr>
                              </div>
                              <div class="col-12">
                                  <div class="row">
                                    @foreach ($disenos as $diseño)
                                      <div class="col-sm-4">
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="diseño{{$diseño->diseño->id}}" value="{{$diseño->diseño->avance}}" @if ($diseño->estatus) checked  @endif onclick="CheckArchivos({{$diseño->id}},1,{{$diseño->diseño->avance}}, this.id)">
                                            <label class="custom-control-label" for="diseño{{$diseño->diseño->id}}">{{$diseño->diseño->nombre}}</label>
                                          </div>
                                      </div>
                                    @endforeach

                                  </div>
                              </div>

                            <!-- /Diseño de propuesta -->
                            <!-- Desarrollo -->

                            <div class="col-12 mt-5">
                                <h4>Desarrollo</h4>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                  @foreach ($desarrollos as $desarrollo)
                                    <div class="col-sm-4">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="{{'desarrollo'.$desarrollo->desarrollo->id}}" value="{{$desarrollo->desarrollo->avance}}" @if ($desarrollo->estatus) checked  @endif onclick="CheckArchivos({{$desarrollo->id}},2,{{$desarrollo->desarrollo->avance}}, this.id)">
                                          <label class="custom-control-label" for="{{'desarrollo'.$desarrollo->desarrollo->id}}">{{$desarrollo->desarrollo->nombre}}</label>
                                        </div>
                                    </div>
                                  @endforeach

                                </div>
                            </div>

                            <!-- /Desarrollo -->
                            <!-- Operacion -->

                            <div class="col-12 mt-5">
                                <h4>Operacion</h4>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                  @foreach ($operaciones as $operacion)
                                    <div class="col-sm-4">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="{{'operacion'.$operacion->operacion->id}}" value="{{$operacion->operacion->avance}}" @if ($operacion->estatus) checked  @endif onclick="CheckArchivos({{$operacion->id}},3,{{$operacion->operacion->avance}}, this.id)">
                                          <label class="custom-control-label" for="{{'operacion'.$operacion->operacion->id}}">{{$operacion->operacion->nombre}}</label>
                                        </div>
                                    </div>
                                  @endforeach

                                </div>
                            </div>

                            <!-- /Operacion -->
                            <!-- Operacion -->

                            <div class="col-12 mt-5">
                                <h4>Gestion de Empresa</h4>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                  @foreach ($gestiones as $ges)
                                    <div class="col-sm-4">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="{{'gestion'.$ges->gestion->id}}" value="{{$ges->gestion->avance}}" @if ($ges->estatus) checked  @endif onclick="CheckArchivos({{$ges->id}},4,{{$ges->gestion->avance}}, this.id)">
                                          <label class="custom-control-label" for="{{'gestion'.$ges->gestion->id}}">{{$ges->gestion->nombre}}</label>
                                        </div>
                                    </div>
                                  @endforeach

                                </div>
                            </div>

                            <!-- /Operacion -->
                        </div>
                    </div>
                    <!-- /Avance -->
                </div>
                <!-- /Tab panes -->

            </div>
        </div>

    </div>

  <!-- /Contenido -->
@endsection
@section('modal')
  <!-- Modal Nueva conversacion -->
  <div class="modal fade" id="mNuevaConversacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Nueva conversación</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">


                      <div class="form-group">
                          <label for="cliente">Usuario</label>
                          <select class="form-control" id="select_usuario">
                              <option>Seleccionar...</option>
                              @foreach ($usuarios as $usuario)
                                @if ($usuario->id != Auth::user()->id)
                                  <option value="{{$usuario->id}}">{{$usuario->nombres}}</option>
                                @endif

                              @endforeach

                          </select>
                          <div class="text-right mt-2">
                          <button class="btn btn-primary" onclick="AñadirUser()">+ Añadir otro usuario</button>
                          </div>
                      </div>

                      <div class="text-right mt-4">
                          <button type="button" class="btn btn-info" data-dismiss="modal">Continuar</button>
                      </div>

              </div>
          </div>
      </div>
  </div>

  <!-- Modal Subir Archivo -->
  <div class="modal fade" id="mSubirArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Subir Documento</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form accept-charset="UTF-8" enctype="multipart/form-data" id="subir-archivo-ajax" method="#">
                      <div class="form-group">
                          <label for="proyectoNombre">Nombre del documento<span class="requerido">*</span></label>
                          <input type="text" class="form-control" id="NombreDocumento" name="NombreDocumento">
                      </div>
                      <div class="form-group text-center mt-3">
                          <div class="upload-btn-wrapper">
                            <button class="btn-block"><i class="fa fa-cloud-upload fa-5x"></i><br>Subir Archivo</button>
                            <input type="file" name="myfile" id="myfile" accept="audio/*,video/*,image/*,.DWF,.DWFx,.DWG,.DWL,.pdf,.xlsx,.doc,.xls,.xlsb,.xlsm,.docx,.docm,.dotx,.doc,.pptx,.pptm,.ppt" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="carpeta">Organizar</label>
                          <select class="form-control" id="tipoPoliza" name="tipoPoliza">
                            <option value="0">Seleccionar...</option>
                            <optgroup value="1" label="Diseño de Propuesta">
                              <option value="1">Legal</option>
                              <option value="2">Proyecto Ejecutivo</option>
                              <option value="3">Técnico</option>
                              <option value="4">Comercial</option>
                              <option value="5">Administrativo</option>
                            </optgroup>
                            <optgroup value="2" label="Desarrollo">
                              <option value="1">Legal</option>
                              <option value="2">Proyecto Ejecutivo</option>
                              <option value="3">Técnico</option>
                              <option value="4">Comercial</option>
                              <option value="5">Administrativo</option>
                            </optgroup>
                            <optgroup value="3" label="Administración del Proyecto">
                              <option value="1">Legal</option>
                              <option value="2">Proyecto Ejecutivo</option>
                              <option value="3">Técnico</option>
                              <option value="4">Comercial</option>
                              <option value="5">Administrativo</option>
                            </optgroup>
                            <optgroup value="4" label="Gestión de Empresa">
                              <option value="6">Metodología</option>
                              <option value="7">Capacitación y desarrollo</option>
                            </optgroup>
                          </select>
                      </div>
                      <div class="text-right mt-4">
                          <button type="button" class="btn btn-info upload">Subir Archivo</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <!-- Modal Editar Archivo -->
  <div class="modal fade" id="mEditarArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar Documento</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form>
                      <div class="form-group">
                          <input type="hidden" id="id_documento" name="id_documento" value="">
                          <label for="proyectoNombre">Nombre del documento<span class="requerido">*</span></label>
                          <input type="text" class="form-control" id="proyectoNombre" value="Mapeo del Archivo.PDF">
                      </div>
                      <div class="form-group">
                          <label for="carpeta">Organizar</label>
                          <select class="form-control" id="tipoPolizaEdit" name="tipoPolizaEdit">
                            <option value="0">Seleccionar...</option>
                            <optgroup value="1" label="Diseño de Propuesta">
                              <option value="1">Legal</option>
                              <option value="2">Proyecto Ejecutivo</option>
                              <option value="3">Técnico</option>
                              <option value="4">Comercial</option>
                              <option value="5">Administrativo</option>
                            </optgroup>
                            <optgroup value="2" label="Desarrollo">
                              <option value="1">Legal</option>
                              <option value="2">Proyecto Ejecutivo</option>
                              <option value="3">Técnico</option>
                              <option value="4">Comercial</option>
                              <option value="5">Administrativo</option>
                            </optgroup>
                            <optgroup value="3" label="Administración del Proyecto">
                              <option value="1">Legal</option>
                              <option value="2">Proyecto Ejecutivo</option>
                              <option value="3">Técnico</option>
                              <option value="4">Comercial</option>
                              <option value="5">Administrativo</option>
                            </optgroup>
                            <optgroup value="4" label="Gestión de Empresa">
                              <option value="6">Metodología</option>
                              <option value="7">Capacitación y desarrollo</option>
                            </optgroup>
                          </select>
                      </div>
                      <div class="text-right mt-4">
                          <button type="button" class="btn btn-info" onclick="ActualizarDocumento()">Actualizar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

@endsection
@section('script')
  <script>
    function EnLinea(id){
      id='#estado'+id;
      $(id).text('En linea');
      $(id).removeClass('text-muted');
      $(id).addClass('text-success');
    }
    Echo.private('App.User.{{$user->id}}')
        .listen('TestEvent', (e) => {
          console.log("TestEvent (Pusher):", e);
          if ($('#proyecto_id').val() == e.id_proyecto) {
            if ($('#receptor_id').val() == e.mensaje.emisor_id) {
              AbrirChat(e.id_proyecto,$('#receptor_id').val());
              EnLinea(e.mensaje.emisor_id);
            }else{
              BuscarUsuario();
            }

          }
        });




                  Echo.join('chat')
                      .joining((user) => {
                          id='#estado'+user.id;
                          $(id).text('En linea');
                          $(id).removeClass('text-muted');
                          $(id).addClass('text-success');
                          console.log(user);
                      });
                  Echo.join('chat')
                      .leaving((user) => {
                            id='#estado'+user.id;
                            $(id).text('desconectado');
                            $(id).removeClass('text-success');
                            $(id).addClass('text-muted');

                            console.log(user);
                      });
                    Echo.join('chat')
                      .listen('UserOnline', (e) => {
                          console.log('UserOnline');
                          console.log(e);
                          this.friend = e.user;
                      });
                    Echo.join('chat')
                      .listen('UserOffline', (e) => {
                        console.log('UserOffline');
                          console.log(e);
                          this.friend = e.user;
                      });




  </script>
  <script src="/assets/js/chat.js"></script>
  <script src="/assets/js/usuario.js"></script>
  <script>

    $("#GotoHistorico").click(function(){
      //$(".acciones2").css("display", "inline-flex");
      //$(".acciones1").css("display", "none");
      //$("#contrato").css("display", "none");
      //$("#escrituraTerreno").css("display", "none");
      //$("#subirArchivo").css("display", "none");
      $("#GotoHistorico").css("display", "none");
      $("#GotoSiva").css("display", "inline-block");
      $("#dymanicTitle").html("Histórico");
    });

    $("#GotoSiva").click(function(){
      //$(".acciones2").css("display", "none");
      //$(".acciones1").css("display", "inline-flex");
      //$("#contrato").css("display", "table-row");
      //$("#escrituraTerreno").css("display", "table-row");
      //$("#subirArchivo").css("display", "inline-block");
      $("#GotoHistorico").css("display", "inline-block");
      $("#GotoSiva").css("display", "none");
      $("#dymanicTitle").html("SIVA");
    });
  </script>
@endsection
