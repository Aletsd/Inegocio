function EliminarMaterial(id){
    Swal.fire({
    title: '¿Estas seguro?',
    text: "¿En verdad desea eliminar el archivo?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!',
    cancelButtonText:'Cancelar!'
  }).then((result) => {
    if (result.value) {
      url="material/delete/"+id;
      location.href =url;
    }
  })
}
