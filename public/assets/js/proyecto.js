function EditarProyecto(proyecto_id, proyecto_nombre, proyectoid){
  $('#proyectoNombre').val(proyecto_nombre);
  $('#proyectoId').val(proyectoid);
  $('#proyecto_id').val(proyecto_id);
}
function ArchivarProyecto(proyecto_id){
    Swal.fire({
    title: '¿Estas seguro?',
    text: "¿En verdad desea archivar el proyecto?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!',
    cancelButtonText:'Cancelar!'
  }).then((result) => {
    var parametros = {
      "proyecto_id" : proyecto_id,
    };
    $.ajax({
        url:  '/proyectos/'+proyecto_id,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "delete",
        async: true,
        beforeSend: function() {
            $(".loading").toggle();
        },success:  function (data) {
            if (data.status) {
              location.reload();
            }

        }
    });
  })

}

function RestaurarProyecto(proyecto_id){
    Swal.fire({
    title: '¿Estas seguro?',
    text: "¿En verdad desea restaurar el proyecto?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!',
    cancelButtonText:'Cancelar!'
  }).then((result) => {
    if (result.value) {
      url="/restaurar-proyecto/"+proyecto_id;
      location.href =url;
    }
  })
}
function EliminarPermanenteProyecto(proyecto_id){
    Swal.fire({
    title: '¿Estas seguro?',
    text: "¿En verdad desea restaurar el proyecto?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!',
    cancelButtonText:'Cancelar!'
  }).then((result) => {
    if (result.value) {
      url="/eliminar-permanente-royecto/"+proyecto_id;
      location.href =url;
    }
  })
}
