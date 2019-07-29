
function EliminarUsuario(id){
    Swal.fire({
    title: '¿Estas seguro?',
    text: "¿En verdad desea eliminar este usuario?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!',
    cancelButtonText:'Cancelar!'
  }).then((result) => {
    if (result.value) {
      url="usuario/delete/"+id;
      location.href =url;
    }
  })
}

function GetProyectos(usuario_id){
  var parametros = {
      "usuario_id" : usuario_id,

  };
  $.ajax({
      url:  '/get-proyectos/'+usuario_id,
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "get",
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        $('#divProyectos').html(data);
      }
  });
}

function getPermisos(usuario_id, proyecto_id){
  var parametros = {
      "proyecto_id" : proyecto_id,
      "usuario_id" : usuario_id,
  };
  $.ajax({
      url:  '/get-permisos/'+proyecto_id+'/'+usuario_id,
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "get",
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        $('#divPermisos').html(data);
      }
  });
}

function GuardarPermiso(){

  var parametros = {
      'permiso_id' :  $('#permiso_id').val(),
      'diseño' : $('#diseñocheck').is(":checked"),
      'desarrollo' : $('#desarrollocheck').is(":checked"),
      'operacion' : $('#operacioncheck').is(":checked"),
      'gestion' : $('#gestioncheck').is(":checked"),
  };

  $.ajax({
      url:  '/guardar-permisos',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: "post",
      data: parametros,
      async: true,
      beforeSend: function() {
          $(".loading").toggle();
      },success:  function (data) {
        if (data.status) {
          Swal.fire({
            type: 'success',
            title: 'Permisos',
            text: 'Actualizado correctamente!',
          });
          //$('.close').click();
        }
      }
  });
}

function RemoverProyecto(user_id, proyect_id){
    Swal.fire({
    title: '¿Estas seguro?',
    text: "¿En verdad desea remover el proyecto de este usuario?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!',
    cancelButtonText:'Cancelar!'
  }).then((result) => {
    if (result.value) {
      url="/detachProyect/"+user_id+"/"+proyect_id;
      location.href =url;
    }
  })
}
