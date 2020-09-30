window.addEventListener('load', function(){
	cargarListaCompania();
 }, false);
//Cargar lista de aseguradoras
function cargarListaCompania(){
    token=$('#token').val();    
    $.ajax({
        url: "listaCompania",
        type: "GET",
        headers: {'X-CSRF-TOKEN': token},
        success: function(dato){
            $('#tblCompania').empty().html(dato);                    
        },
        error: function(){
            alertify.error('Sucedio un error')
        }
    });	
}
//Funcion para registrar aseguradoras 
function RegistroCompania(){
	nombreC=$('#nomCompania').val()
	rucCo=$('#rucCompania').val()
	Aseguradora=$('#idAseguradora').val()
	coFi=$('#copagoFijo').val()
	coVa=$('#copagoVariable').val()
	token=token=$('#token').val()
	if(nombreC.length>1){		
			if(Aseguradora!=0){
				if(coFi.length>=0){
					if(coFi>=0){
						if(coVa.length>=0){
							if(coVa>=0){
								$.ajax({
									url: 'compania',
									type: 'POST',
									headers:{'X-CSRF-TOKEN': token},
									data: {
										nombreC : nombreC,
										rucCo : rucCo,
										Aseguradora : Aseguradora,
										coFi : coFi,
										coVa : coVa										 
									},
									success: function (resp){
										cargarListaCompania();
										$('#frmCompaniaC')[0].reset()
										alertify.alert('Compañia Registrada')										
									},
									error: function (){
										alertify.error('Ocurrio un error registrando la compañia')
									}

								});
							}else{
								alertify.error('Ingrese solo valores positivos')
							}
						}else{
							alertify.error('Ingrese el monto de copago variable')
						}
					}else{
						alertify.error('Ingrese solo valores positivos ')
					}
				}else{
					alertify.error('Ingrese el monto de copago FIjo')
				}
			}else{
				alertify.error('Selecciona una Aseguradora')
			}
	}else{
		alertify.error('Ingrese el nombre de la compania')
	}

}
//Funcion para cargar datos de la aseguradora
function CargarCompanias(idC){
	token=token=$('#token').val()
	$.ajax({
		url: 'compania/'+idC+"/edit",
		type: 'GET',
		headers:{'X-CSRF-TOKEN': token},
		success: function (data){		
			$('#nomCompania').val(data[0].nombre)
			$('#rucCompania').val(data[0].ruc)
			$('#idAseguradora').val(data[0].tipo_seguro_id).change()
			$('#copagoFijo').val(data[0].copagoFijo)
			$('#copagoVariable').val(data[0].copagoVariable)			
			$('#btnCompania').attr({'id':'modificarComp','class':'btn btn-warning btn-sm','onclick': "ModificarCompania("+idC+")"})
			$('#titCom').attr({'class':'fa fa-edit'})	
			$('.tblc').attr('disabled',true)			
		}
	});
}
//Funcion para modifiar la aseguradora
function ModificarCompania(idA){
	nombreC=$('#nomCompania').val()
	rucCo=$('#rucCompania').val()
	Aseguradora=$('#idAseguradora').val()
	coFi=$('#copagoFijo').val()
	coVa=$('#copagoVariable').val()
	token=token=$('#token').val()
	if(nombreC.length>1){
		if(rucCo.length>=11){
			if(Aseguradora!=0){
				if(coFi.length>=0){
					if(coFi>=0){
						if(coVa.length>=0){
							if(coVa>=0){
								$.ajax({
									url: 'compania/'+idA,
									type: 'PUT',
									headers:{'X-CSRF-TOKEN': token},
									data: {
										nombreC : nombreC,
										rucCo : rucCo,
										Aseguradora : Aseguradora,
										coFi : coFi,
										coVa : coVa										 
									},
									success: function (resp){
										if(resp=='Actualizado'){
										cargarListaCompania();
										$('#frmCompaniaC')[0].reset()
										alertify.alert('Compañia Actualizada')											
										$('#modificarComp').attr({'id':'btnCompania','class':'btn btn-success btn-sm','onclick': "RegistroCompania()"})
										$('#titCom').attr({'class':'fa fa-save'})											
										}else{
										alertify.log(resp)
										$('#frmCompaniaC')[0].reset()
										$('#modificarComp').attr({'id':'btnCompania','class':'btn btn-success btn-sm','onclick': "RegistroCompania()"})
										$('#titCom').attr({'class':'fa fa-save'})
										$('.tblc').attr('disabled',false)		
										}

									},
									error: function (){
										alertify.error('Ocurrio un error actualizando compañia')
									}

								});
							}else{
								alertify.error('Ingrese solo valores positivos')
							}
						}else{
							alertify.error('Ingrese el monto de copago variable')
						}
					}else{
						alertify.error('Ingrese solo valores positivos ')
					}
				}else{
					alertify.error('Ingrese el monto de copago FIjo')
				}
			}else{
				alertify.error('Selecciona una Aseguradora')
			}
		}else{
			alertify.error('Ingrese el numero de RUC')
		}
	}else{
		alertify.error('Ingrese el nombre de la compania')
	}	
}
//Funcion de eliminar aseguradora
function eliminarCompania(idC, nombre){
      alertify.confirm("<p>Realmente desea Eliminar la compania "+nombre+".", function (e) {
            if (e) {
				token=$('#token').val()
				$.ajax({
					url: 'compania/'+idC,
					type: 'DELETE',
					headers:{'X-CSRF-TOKEN': token},					
					success: function (res){
						if(res=="Eliminado"){
							alertify.log('Compañia Eliminada')
							cargarListaCompania()
						}else{
							alertify.error("No se puede eliminar mientras tenga pacientes registrados con esta compañia")		
						}
					}, 
					error: function (){
						alertify.error("Ocurrio un error al eliminar la Compañia")	
					}
				});                  
            } else { 
                        alertify.error("Accion Cancelada '" + alertify.labels.cancel + "'");
            }
      }); 
      return false
}
function cargarCostos(){
	$.ajax({
		url: 'CostosC',
		type: 'GET',
		success: function (resp){
			console.log(resp)
		}, 
		error: function (){
			alertify.error('Ocurrio un error cargando los costos')
		}
	});
}
function actualizarCostos(id){
	costo=$('#costo'+id).val()
	token=$('#token').val()
	$.ajax({
		url: 'ACostos/'+id+"/"+costo,
		type: 'POST',
		headers:{'X-CSRF-TOKEN': token},
		success: function (resp){
			console.log(resp)
			if(resp=="Error"){
				alertify.error('No se encontraron cambios, No se pudo actualizar')
			}else{
				
				alertify.success('Actualizado')
			}

		},
		error: function (){
			alertify.error('Ocurrio un error al Actualizar')
		}
	});
}
function CargarCompaniasModal(idC){
	limpiar()
	token=token=$('#token').val()
	$.ajax({
		url: 'compania/'+idC+"/edit",
		type: 'GET',
		headers:{'X-CSRF-TOKEN': token},
		success: function (data){		
			$('#idCompa').val(data[0].id)
			$('#nombreCo').val(data[0].nombre)
			$('#rucom').val(data[0].ruc)
			$('#idAseguradoraM').val(data[0].tipo_seguro_id).change()
			$('#copaFM').val(data[0].copagoFijo)
			$('#covaM').val(data[0].copagoVariable)					
		}
	});
}
function limpiar(){
	$('#nombreCo').val("")
	$('#rucom').val("")
	$('#idAseguradoraM').val("Seleccionar").change()
	$('#copaFM').val("")
	$('#covaM').val("")			
		
}

function modificarModal(){
	nombreC=$('#nombreCo').val()
	rucCo=$('#rucom').val()
	Aseguradora=$('#idAseguradoraM').val()
	coFi=$('#copaFM').val()
	coVa=$('#covaM').val()
	idC=$('#idCompa').val()
	if(nombreC.length>0){//Verifico que el nombre no este vacio
		if(Aseguradora!='0'){
			if(coFi.length>=0){
				if(coVa.length>=0){
					$.ajax({
						url: 'compania/'+idC,
						type: 'PUT',
						headers:{'X-CSRF-TOKEN': token},
						data: {
							nombreC : nombreC,
							rucCo : rucCo,
							Aseguradora : Aseguradora,
							coFi : coFi,
							coVa : coVa										 
						},
						success: function (resp){
							if(resp=='Actualizado'){
							cargarListaCompania();
							$('#formModal')[0].reset()
							$('#modalMod').modal('hide')
							alertify.success('Compañia Actualizada')																					
							}else{
							alertify.log(resp)
							$('#frmCompaniaC')[0].reset()	
							}
				
						},
						error: function (){
							alertify.error('Ocurrio un error actualizando compañia')
						}
				
					});
				}else{
					alertify.error('No se pueden ingresar valor negativos en el copago variable')
				}
			}else{
				alertify.error('No se pueden ingresar valor negativos en el copago fijo')
			}
		}else{
			alertify.error('Tiene que seleccionar una compania aseguradora')
		}
	}else{
		alertify.error('El campo de nombre no puede estar vacio')
	}
}