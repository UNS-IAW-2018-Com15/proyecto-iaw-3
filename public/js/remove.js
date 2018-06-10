
function remove(id){
  var url = '/complejos/delete/'+id;
    var dom = "comp-"+id;
  swal.queue([{
    title: '¿Estas seguro de querer eliminar el complejo?',
    confirmButtonText: 'Si, eliminar',
    showCancelButton: true,
    cancelButtonText: 'No, me confundi',
    showLoaderOnConfirm: true,
    allowOutsideClick: () => !swal.isLoading(),
    preConfirm: () => {
      return fetch(url)
        .then(response => response.json())
        .then(data => swal.insertQueueStep({type: 'success', title : 'Complejo eliminado'}),  ocultarComplejo(dom))
        .catch(() => {
          swal.insertQueueStep({
            type: 'error',
            title: 'No se pudo eliminar el complejo'
          })
        })
    }
  }]);

}

function ocultarComplejo(dom){
  var element = document.getElementById(dom);
  element.parentNode.removeChild(element);
}
