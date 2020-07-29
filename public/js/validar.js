function validarPaciente(){
	nombre=$('#nombre').val();
	if( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) ) {
	  	$('#nombre').parent().parent().attr("class",'form-group has-error')
	  	$('#nombre').parent().children("span").text("El campo es obligatorio").show()
	}else{
		$('#nombre').parent().parent().attr("class",'form-group has-success')
		$('#nombre').parent().children("span").text("El campo es obligatorio").hide()
	}
	dni=$('#nuevodni').val();
	if( dni == null || dni.length == 0 || /^\s+$/.test(dni) ) {
	  	$('#nuevodni').parent().attr("class",'form-group has-error')
	  	$('#nuevodni').parent().children("span").text("El campo es obligatorio").show()
	}else{
		$('#nuevodni').parent().parent().attr("class",'form-group has-success')
		$('#nuevodni').parent().children("span").text("El campo es obligatorio").hide()
	}	
}