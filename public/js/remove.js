
function remove(id){

  swal.queue([{
    title: '¿Estas seguro de querer eliminar el complejo?',
    confirmButtonText: 'Si, eliminar',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      return fetch('/complejos/delete/'+id))
        .then(response => response.json())
        .then(data => swal.insertQueueStep({type: 'success', title : 'Complejo eliminado'}))
        .catch(() => {
          swal.insertQueueStep({
            type: 'error',
            title: 'No se pudo eliminar el complejo'
          })
        })
    }
  }]);
  var dom = "comp-"+id;
  ocultarComplejo(dom);
}

function ocultarComplejo(dom){
  var element = document.getElementById(dom);
  element.parentNode.removeChild(element);
}
