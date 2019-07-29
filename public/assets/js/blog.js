function EditarCategoria(idCategoria){

    $.ajax({
        url:  '/categorias/'+idCategoria,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "get",
        async: true,
        beforeSend: function() {
            $(".loading").toggle();
        },success:  function (data) {
          $('#editartitulo').val(data.categoria.title);
          $('#idCategoria').val(idCategoria);
  
        }
    });
  
  }

  function ActualizarCategoria(){
    var parametros = {
      "id" : $('#idCategoria').val(),
      "title" : $('#editartitulo').val()
    };
    console.log(parametros);
    $.ajax({
        url:  '/categorias/'+$('#idCategoria').val(),
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "put",
        data: parametros,
        async: true,
        beforeSend: function() {
            $(".loading").toggle();
        },success:  function (data) {
          Swal.fire({
            type: 'success',
            title: 'Categoria',
            text: 'Actualizado correctamente!',
          });
          location.reload();
        }
    });
  }

  function EliminarCategoria(id){
    Swal.fire({
    title: '¿Estas seguro?',
    text: "¿En verdad desea eliminar la categoría?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!',
    cancelButtonText:'Cancelar!'
  }).then((result) => {
    if (result.value) {
      url="categorias/delete/"+id;
      location.href =url;
    }
  })
}

function EliminarPublicacion(id){
  Swal.fire({
  title: '¿Estas seguro?',
  text: "¿En verdad desea eliminar la publicación?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!',
  cancelButtonText:'Cancelar!'
}).then((result) => {
  if (result.value) {
    url="publicaciones/delete/"+id;
    location.href =url;
  }
})
}
