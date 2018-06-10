var abierto = false;
var idAbierto;

function cerrarForm(){
	$("#add-cancha-"+idAbierto).remove();
}

function formCancha(id){
	if(abierto){
		cerrarForm();
	}
	else{
		abierto = true;
	}
	idAbierto = id;
	var metodo = "addCancha('"+id+"')";
	var formulario = 	'<div class="form-cancha" id="add-cancha-'+id+'">'+
	'Tamaño'+
	'<select id="size" class="form-control">'+
	'<option value="4">4</option>'+
	'<option value="5">5</option>'+
	'<option value="6">6</option>'+
	'<option value="7">7</option>'+
	'<option value="8">8</option>'+
	'<option value="9">9</option>'+
	'<option value="10">10</option>'+
	'<option value="11">11</option>'+
	'</select>'+
	"Material"+
	'<select id="material" class="form-control">'+
	'<option value="Alfombra">Alfombra</option>'+
	'<option value="Sintetico">Sintético</option>'+
	'<option value="Tierra">Tierra</option>'+
	'<option value="Cesped">Cesped</option>'+
	'</select><br>'+
	'<button class="btn btn-primary" onclick='+metodo+'>'+
	'Nueva</button>'+
	'<button class="btn" onclick="cerrarForm()">'+
	'Cancelar</button>'+
	'</div>'

	;		
	$("#form-"+id).append(formulario);
}

function addCancha(ide){
	var datos = {
		tamanio : $("#size").val(),
		material : $("#material").val(),
		id : ide
	};


	$.ajax({	
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: '/complejos/add/cancha',
		type: 'POST',
		dataType: "json",
		data: datos,
		success: function(data){
			swal(
				'Éxito!',
				'Cancha agregada correctamente',
				'success'
				)
		},
		error: function(data){
			swal(
				'Error!',
				'Se produjo un error al agregar la cancha',
				'error'
				)
		}
	});
	abierto = false;
	cerrarForm();
}

function removeCancha(ide,tamanio,material,loop){
	var dom="cancha-"+loop;
		var datos = {
			tamanio : tamanio,
			material : material,
			id : ide
		};

		$.ajax({	
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '/complejos/delete/cancha',
			type: 'POST',
			dataType: "json",
			data: datos,
			success: function(data){
				swal(
					'Éxito!',
					'Cancha borrada correctamente',
					'success'
					);
				ocultarCancha(dom);
			},
			error: function(data){
				swal(
					'Error!',
					'Se produjo un error al borrar la cancha',
					'error'
					)
			}
		});

}

function ocultarCancha(dom){

	var element = $("#"+dom)
	element.remove();
}
