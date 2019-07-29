$(function() {

    "use strict";

    var cht = function() {
        var topOffset = 415;
        var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        $(".chat-list").css("height", (height) + "px");
    };
    $(window).ready(cht);
    $(window).on("resize", cht);

    // this is for the left-aside-fix in content area with scroll
    var chtin = function() {
        var topOffset = 220;
        var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        $(".chat-left-inner").css("height", (height) + "px");
    };
    $(window).ready(chtin);
    $(window).on("resize", chtin);

    $(".open-panel").on("click", function() {
        $(".chat-left-aside").toggleClass("open-pnl");
        $(".open-panel i").toggleClass("ti-angle-left");
    });

        /*var pusher = new Pusher("670419d4e31b9b0c477b");
        var canal = pusher.subscribe('canal_prueba');
        canal.bind('nuevo_mensaje', function(){

        });*/
});
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function AbrirChat(proyecto_id,emisor_id, id_a){

  id_a = '#'+id_a;
  $('.activado').removeClass('active');
  $(id_a).addClass('active');
  $('#receptor_id').val(emisor_id);
  var parametros = {
      "proyecto_id" : proyecto_id,
      "emisor_id" : emisor_id,
  };
  $.ajax({
      url:  '/getchat',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "post",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        $('#mensajes').html(data);
        var altura = $('#mensajes').height();
        var altura = document.getElementById('mensajes').scrollHeight;
        $(".chat-rbox").animate({scrollTop:altura+"px"});
      }
  });
  $.ajax({
      url:  '/visto',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "post",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {

      }
  });
}

//buscar mensaje
$( "#buscarMensaje" ).keyup(function() {
  busqueda = $('#buscarMensaje').val(),
  BuscarChat(busqueda)
});
function BuscarChat(busqueda){
  var parametros = {
      "proyecto_id" : $('#proyecto_id').val(),
      "emisor_id" : $('#receptor_id').val(),
      "busqueda" :  busqueda,
  };
  $.ajax({
      url:  '/buscar-mensaje',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "post",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        $('#mensajes').html(data);
      }
  });
}
function EnviarMensaje(tipo){
  id='#estado'+$('#receptor_id').val();
  estado = $(id).text();
  var parametros = {
    "proyecto_id" : $('#proyecto_id').val(),
    "receptor_id" : $('#receptor_id').val(),
    "mensaje" : $('#mensaje').val(),
    "tipo": tipo,
    'estado': estado,
  };
  if ($('#receptor_id').val() == '') {
    Swal.fire({
      type: 'error',
      title: 'Destinatario no seleccionado.',
      text: 'Porfavor elija un destinatario antes de enviar un mensaje.!',
    })
    return 0;
  }
  if ($('#mensaje').val() == '') {
    return 0;
  }

  $.ajax({
      url:  '/mensaje',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "post",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        console.log(data.status);
        if (data.status) {
          AbrirChat($('#proyecto_id').val(),$('#receptor_id').val())
          $('#mensaje').val("");
        }
      }
  });

}

function AñadirUser(){
  var parametros = {
    "proyecto_id" : $('#proyecto_id').val(),
    "usuario_id" : $('#select_usuario').val(),
  };
  $.ajax({
      url:  '/agregar-usuario',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "post",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        location.reload();
      }
  });
}

$( "#buscarUsuario" ).keyup(function() {
  BuscarUsuario();
  // listaConversaciones
});
function BuscarUsuario(){
  var parametros = {
    "proyecto_id" : $('#proyecto_id').val(),
    "buscarUsuario" : $('#buscarUsuario').val(),
  };

  $.ajax({
      url:  '/buscarUsuario',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "post",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        console.log(data);
        //data= JSON.stringify(data);
        i = 0;
        $('#listaConversaciones').empty();
        while (i < data.usuarios.length) {
          j = 0;
          img = '/assets/img/default.jpg';
          if (data.usuarios[i].img_perfil != null) {
            img = 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'+data.usuarios[i].img_perfil;
          }
          var usuariohtml ="<li><a href='javascript:void(0)' class='active' onclick='AbrirChat("+$('#proyecto_id').val()+","+data.usuarios[i].id+")'><img src='"+img+"' alt='user-img' class='img-circle'><span>"+data.usuarios[i].nombres;
          console.log(data.pendientes);
          while (j < data.pendientes.length){

            if (data.pendientes[j].emisor_id == data.usuarios[i].id){
              usuariohtml+=`<span class="text-danger" id="'"+data.usuarios[i].nombres+"'">(`+(data.pendientes[j].mensajes)+`)</span>`;
            }
            j++;
          }
          usuariohtml+="<small class='text-muted text-center' id='estado"+data.usuarios[i].id+"'>desconectado</small>";
          usuariohtml+="</span></a></li>";
          $('#listaConversaciones').append(usuariohtml);
          i++;
        }
      }
  });
}
function CheckArchivos(id, tipo, avance, check_id){
  var parametros = {
    "id" : id,
    "tipo" : tipo,
    "proyecto_id" : $('#proyecto_id').val(),
  };
  $.ajax({
      url:  '/check-archivos',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "post",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        //console.log(data);
        if (data.status) {
          if ($('#' + check_id).is(":checked")) {

            $('#SpanAvance').text(data.avance);
            if (tipo==1) {
              texto = $('#diseñoP').text();
              $('#diseñoP').text((parseFloat(texto)+parseFloat(avance)).toFixed(2));
              $('#diseñoDiv').css("width",(parseFloat(texto)+parseFloat(avance)+'%'));
            }else if (tipo==2) {
              texto = $('#desarrolloP').text();
              $('#desarrolloP').text((parseFloat(texto)+parseFloat(avance)).toFixed(2));
              $('#desarrolloDiv').css("width",(parseFloat(texto)+parseFloat(avance)+'%'));
            }else if (tipo==3) {
              texto = $('#operacionP').text();
              $('#operacionP').text((parseFloat(texto)+parseFloat(avance)).toFixed(2));
              $('#operacionDiv').css("width",(parseFloat(texto)+parseFloat(avance)+'%'));
            }else if (tipo==4) {
              texto = $('#gestionP').text();
              $('#gestionP').text((parseFloat(texto)+parseFloat(avance)).toFixed(2));
              $('#gestionDiv').css("width",(parseFloat(texto)+parseFloat(avance)+'%'));
            }
          }else {
            $('#SpanAvance').text(data.avance);
            if (tipo==1) {
              texto = $('#diseñoP').text();
              $('#diseñoP').text((parseFloat(texto)-parseFloat(avance)).toFixed(2));
              $('#diseñoDiv').css("width",(parseFloat(texto)+parseFloat(avance)-'%'));
            }else if (tipo==2) {
              texto = $('#desarrolloP').text();
              $('#desarrolloP').text((parseFloat(texto)-parseFloat(avance)).toFixed(2));
              $('#desarrolloDiv').css("width",(parseFloat(texto)+parseFloat(avance)-'%'));
            }else if (tipo==3) {
              texto = $('#operacionP').text();
              $('#operacionP').text((parseFloat(texto)-parseFloat(avance)).toFixed(2));
              $('#operacionDiv').css("width",(parseFloat(texto)+parseFloat(avance)-'%'));
            }else if (tipo==4) {
              texto = $('#gestionP').text();
              $('#gestionP').text((parseFloat(texto)-parseFloat(avance)).toFixed(2));
              $('#gestionDiv').css("width",(parseFloat(texto)+parseFloat(avance)-'%'));
            }
          }


        }

      }
  });
}


$(document).ready(function() {
    $(".upload").on('click', function() {
        var formData = new FormData();
        var files = $('#myfile')[0].files[0];
        var nombre = $('#NombreDocumento').val();
        var tipo = $('#tipoPoliza').val();
        var proyecto_id = $('#proyecto_id').val();
        var seccion_siva = $('#seccion_siva').val();
        var selected = $('#tipoPoliza option:selected');
        etapa = selected.closest('optgroup').attr('value');
        formData.append('myfile',files);
        formData.append('nombre',nombre);
        formData.append('tipo',tipo);
        formData.append('etapa',etapa);
        formData.append('proyecto_id',proyecto_id);
        formData.append('seccion_siva',seccion_siva);
        if (tipo == 0) {
          Swal.fire({
            type: 'error',
            title: 'Error del documento...',
            text: 'Seleccione un tipo de documento!',
          });
        }else if (nombre == '') {
          Swal.fire({
            type: 'error',
            title: 'Errro nombre de documento',
            text: 'Ingrese el nombre del documento!',
          });
        }else if (files == null) {
          Swal.fire({
            type: 'error',
            title: 'Archivo',
            text: 'Seleccione un archivo!',
          });
        }else {
          $.ajax({
              url: '/documentos',
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              async: true,
              success: function(response) {
                  Swal.fire({
                    type: 'success',
                    title: 'Documento',
                    text: 'Agregado correctamente!',
                  });
                  $('.close').click();
                  if (etapa == 1) {
                    $('#btnDiseño').click();
                  }else if (etapa == 2) {
                    $('#btnDesarrollo').click();
                  }else if (etapa == 3) {
                    $('#btnAdministración').click();
                  }else if (etapa == 4) {
                    $('#btnGestión').click();
                  }
                  if ($('#receptor_id').val() != "") {

                    $('#mensaje').val('se ha subido al SIVA el archivo '+response.documento.nombre_archivo);
                    EnviarMensaje('archivo')
                  }
              }
          });
        }

        return false;
    });
});

function GetDocumento(etapa, id){
  $('#dymanicTitle').val('SIVA');
  if (etapa == 5) {
    var parametros = {
      "proyecto_id" : $('#proyecto_id').val(),
      "etapa" : $('#seccion_siva').val(),
    };
  }else {
    var parametros = {
      "proyecto_id" : $('#proyecto_id').val(),
      "etapa" : etapa,
    };
    id = '#'+id;
    $('#btnDiseño').removeClass('active');
    $('#btnDesarrollo').removeClass('active');
    $('#btnAdministración').removeClass('active');
    $('#btnGestión').removeClass('active');

    $(id).addClass('active');

    $('#seccion_siva').val(etapa);
  }



  $.ajax({
      url:  '/getdocumento',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "get",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        $('#accordion').html(data);
      }
  });
}

function GetDocumentoHistorico(){
  var parametros = {
    "proyecto_id" : $('#proyecto_id').val(),
    "etapa" : $('#seccion_siva').val(),
  };

  $.ajax({
      url:  '/getdocumentohistorico',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "get",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        $('#accordion').html(data);
      }
  });
}
function ArchivarDocumento(id_documento){
  Swal.fire({
  title: '¿Estas seguro?',
  text: "¿Desea archivar este usuario?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!',
  cancelButtonText:'Cancelar!'
}).then((result) => {
  if (result.value) {
    var parametros = {
      "id_documento" : id_documento,
    };
    $.ajax({
        url:  '/documentos/'+id_documento,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "delete",
        async: true,
        beforeSend: function() {
            $(".loading").toggle();
        },success:  function (data) {
            GetDocumento($('#seccion_siva').val());
        }
    });
  }
})

}

function EditarDocumento(id_documento){

  $.ajax({
      url:  '/documentos/'+id_documento,
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "get",
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        $('#proyectoNombre').val(data.documento.nombre_archivo);
        $('#id_documento').val(data.documento.id);

      }
  });

}

function RestaurarDocumento(id_documento){
  var parametros = {
    "id_documento" : id_documento,
  };
  $.ajax({
      url:  '/restaura-documento',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "post",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
          //GetDocumento($('#seccion_siva').val());
          GetDocumentoHistorico();
      }
  });
}
function ElminarDocumentoPermanente(id_documento){
  Swal.fire({
    title: '¿Estas seguro?',
    text: "¿En verdad desea eliminar este documento?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!',
    cancelButtonText:'Cancelar!'
  }).then((result) => {
    if (result.value) {
      var parametros = {
        "id_documento" : id_documento,
      };
      $.ajax({
          url:  '/eliminar-permanente-documento/'+id_documento,
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          type: "get",
          async: true,
          beforeSend: function() {
              $(".loading").toggle();
          },success:  function (data) {
              //GetDocumentoHistorico();
              GetDocumento($('#seccion_siva').val())
          }
      });
    }
  })

}

function ActualizarDocumento(){
  var selected = $('#tipoPolizaEdit option:selected');
  etapa = selected.closest('optgroup').attr('value');
  var parametros = {
    "id" : $('#id_documento').val(),
    "nombre_archivo" : $('#proyectoNombre').val(),
    "tipo" : $('#tipoPolizaEdit').val(),
    'etapa': etapa,
  };
  $.ajax({
      url:  '/documentos/'+$('#id_documento').val(),
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "put",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        GetDocumento($('#seccion_siva').val());
        Swal.fire({
          type: 'success',
          title: 'Documento',
          text: 'Actualizado correctamente!',
        });
        $('.close').click();
      }
  });
}
