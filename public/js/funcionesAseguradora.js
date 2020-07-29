window.addEventListener('load', function(){
	cargarListaAseguradora();
 }, false);
//Cargar lista de aseguradoras
function cargarListaAseguradora(){
    token=$('#token').val();    
    $.ajax({
        url: "listaAseguradora",
        type: "POST",
        headers: {'X-CSRF-TOKEN': token},
        success: function(dato){
            $('#tblAseguradora').empty().html(dato);                    
        },
        error: function(){
            alertify.error('Sucedio un error')
        }
    });	
}
//Funcion para registrar aseguradoras 
function RegistroAseguradora(){
	nombreA=$('#nomAseguradora').val()
	rucA=$('#rucAseguradora').val()
	docum=$('#tipoDocuA').val()
	produc=$('#tipoProducA').val()
	moneda=$('#tipoMoneda').val()
	token=token=$('#token').val()
	if(nombreA.length>1){
		if(rucA.length>=11){
			if(docum.length>1){
				if(produc.length>1){
					if(moneda.length>1){
						$.ajax({
							url: 'RAseguradora',
							type: 'POST',
							data: {
								nombreA : nombreA,
								rucA : rucA,
								docum : docum, 
								produc : produc,
								moneda : moneda
							},
							headers:{'X-CSRF-TOKEN': token},
							success: function(res){
								if(res=='Registrado'){
									alertify.alert("Aseguradora Registrada")
									$('#frmAseguradora')[0].reset()
									cargarListaAseguradora()
								}else{
									alertify.error("Ocurrio un error")		
								}
							}
						});
					}else{
						alertify.error("Ingrese un tipo de moneda")		
					}
				}else{
					alertify.error("Ingrese un tipo de producto")		
				}
			}else{
				alertify.error("Ingrese un tipo de documento")		
			}
		}else{
			alertify.error("Ingrese un Numero de RUC")	
		}
	}else{
		alertify.error("Ingrese un Nombre")
	}
}
//Funcion para cargar datos de la aseguradora
function CargarAseguradora(idA){
	token=token=$('#token').val()
	$.ajax({
		url: 'CargarAs',
		type: 'POST',
		headers:{'X-CSRF-TOKEN': token},
		data: {
			idA: idA
		},
		success: function (data){		
			$('#nomAseguradora').val(data[0].nombre_aseguradora)
			$('#rucAseguradora').val(data[0].ruc)
			$('#tipoDocuA').val(data[0].tipodoc)
			$('#tipoProducA').val(data[0].producto)
			$('#tipoMoneda').val(data[0].numcomp)
			$('#btnGuardarAse').attr({'id':'modificarAseg','class':'btn btn-warning btn-sm','onclick': "ModificarAseguradora("+idA+")"})
			$('#titAse').attr({'class':'fa fa-edit'})	
			$('.dbt').attr('disabled',true)
		}
	});
}
//Funcion para modifiar la aseguradora
function ModificarAseguradora(idA){
	nombreA=$('#nomAseguradora').val()
	rucA=$('#rucAseguradora').val()
	docum=$('#tipoDocuA').val()
	produc=$('#tipoProducA').val()
	moneda=$('#tipoMoneda').val()
	token=token=$('#token').val()
	if(nombreA.length>1){
		if(rucA.length>=11){
			if(docum.length>1){
				if(produc.length>1){
					if(moneda.length>1){
						$.ajax({
							url: 'ModAseg',
							type: 'POST',
							data: {
								nombreA : nombreA,
								rucA : rucA,
								docum : docum, 
								produc : produc,
								moneda : moneda,
								id: idA
							},
							headers:{'X-CSRF-TOKEN': token},
							success: function(res){
								if(res=='Actualizado'){
									alertify.alert("Datos Actualizados")
									$('#frmAseguradora')[0].reset()
									cargarListaAseguradora()
									$('#modificarAseg').attr({'id':'btnGuardarAse','class':'btn btn-success btn-sm','onclick': "RegistroAseguradora()"})
									$('#titAse').attr({'class':'fa fa-save'})	
									$('.dbt').attr('disabled',false)									
								}else{
									alertify.log("No se encontraron cambios")		
									$('#modificarAseg').attr({'id':'btnGuardarAse','class':'btn btn-success btn-sm','onclick': "RegistroAseguradora()"})
									$('#titAse').attr({'class':'fa fa-save'})	
									$('.dbt').attr('disabled',false)
									$('#frmAseguradora')[0].reset()										
								}
							}
						});
					}else{
						alertify.error("Ingrese un tipo de moneda")		
					}
				}else{
					alertify.error("Ingrese un tipo de producto")		
				}
			}else{
				alertify.error("Ingrese un tipo de documento")		
			}
		}else{
			alertify.error("Ingrese un Numero de RUC")	
		}
	}else{
		alertify.error("Ingrese un Nombre")
	}	
}
//Funcion de eliminar aseguradora
function eliminarAseguradora(idA){
      alertify.confirm("<p>Realmente desea Eliminar esta aseguradora.", function (e) {
            if (e) {
				token=$('#token').val()
				$.ajax({
					url: 'EliAse',
					type: 'POST',
					headers:{'X-CSRF-TOKEN': token},
					data: { idA: idA },
					success: function (res){
						if(res=="Eliminado"){
							alertify.log('Aseguradora Eliminada')
							cargarListaAseguradora()
						}else{
							alertify.error("Primero Elimine las Compañias registradas con la aseguradora")		
						}
					}, 
					error: function (){
						alertify.error("Ocurrio un error al eliminar la aseguradoras")	
					}
				});                  
            } else { 
                        alertify.error("Accion Cancelada '" + alertify.labels.cancel + "'");
            }
      }); 
      return false
}