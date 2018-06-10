function removeComentario(idComp,idComent,loop){
	var dom="coment-"+loop;
		var datos = {
			idComplejo : idComp,
			idComentario : idComent
		};

		$.ajax({	
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '/complejos/delete/comentario',
			type: 'POST',
			dataType: "json",
			data: datos,
			success: function(data){
				swal(
					'Éxito!',
					'Comentario borrado correctamente',
					'success'
					);
				ocultarComentario(dom);
			},
			error: function(data){
				swal(
					'Error!',
					'Se produjo un error al borrar el comentario',
					'error'
					)
			}
		});

}

function ocultarComentario(dom){

	var element = $("#"+dom)
	element.remove();
}
