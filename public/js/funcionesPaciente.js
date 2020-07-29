   window.addEventListener('DOMContentLoaded', function(){
   $('#dni').focus()   
   tabla('tblPaciente') 
  
    $(document).keydown(function (e){
        buscarpacientet(e)

    });
 

    $('#btnAgregarC').click(function(){//btn agregar compañia? //se ejecuta al hacer click  
    nombreC=$('#nombreC').val()
    rucCo=$('#rucCo').val()
    Aseguradora=$('#Aseguradora').val()
    coFi=$('#coFi').val()
    coVa=$('#coVa').val()    
    if(nombreC.length>1){        
            if(Aseguradora!=0){
                if(coFi.length>=0){
                    if(coFi>=0){
                        if(coVa.length>=0){
                            if(coVa>=0){
                                AgregarCompania();                                
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
        
    });
//Funcion para editar

//Fin de funcion para editar

    $('#btnLimpiar').click(function(){//ejecuta la funcion limpíar al hacer click en el boton
        limpiar()
    })
    $('#btnAgregarPaciente').click(function(){//ejecuta la funcion agregar al hacer click en el boton 
        registroPaciente()
    })
    $('#btnBuscarPaciente').click(function(){//ejecutar la funciona buscar pacientes
        BuscarPaciente()
    })
    $('#tipoServicio').change(function (){
        t=$('#tipoServicio').val()
        $('#compania').find('option').remove();            
        $('#compania').append('<option value="0">Seleccionar</option>');                    
        cargarCompanias(t);
    });

$('#tipoServicio').change(function(){  
  ts=$("#tipoServicio option:selected").index()
  if(ts!=1){   
    $('#compania').attr('disabled',false)
  }else{     
    $('#compania').attr('disabled',true)
    $('#parentesco > option[value="Titular"]').attr('selected', 'selected');    
  }
});
$('#abtn').click(function (){
  ida=$('#tipoServicio').val()
$('#Aseguradora > option[value='+ida+']').attr('selected', 'selected');            
});
  $('#idtipo_plan > option[value="1"]').attr('selected', 'selected');    
 }, false)


   function tabla(tabla){//Proporciona estilos a las tablas
        $('#'+tabla).dataTable({
        "sPaginationType":"full_numbers",
        "bJqueryUI": true,        
        "language": {
                    "lengthMenu": "Mostrar _MENU_ Registros por pagina",
                    "zeroRecords": "No hay coincidencias",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No registros disponibles",
                    "infoFiltered": "(Filtrado del total de  _MAX_ registros)",
                    "sSearch": "Buscar:",               
                    "paginate":{
                    "sFirst": "Primero",
                    "sLast": "Ultimo",
                    "sNext": "Siguiente",                 
                    "sPrevious": "Anterior" 
                    }
                  }                         
        });
    }
    function buscarpacientet(e){//Devuelve la lista de paciente haciendo uso de la tecla enter
        if(e.keyCode===13){
            BuscarPaciente()
        }
    }  
    function BuscarPaciente(){//Devuelde la lista de pacientes que conincide con los parametros indicados
        dni= $('#dni').val();
        nombre=$('#nombre').val();
        token=$('#token').val();        
        valor="";
        if(dni.length>7){
            valor=dni;
        }else if(nombre.length>2){
            valor=nombre;
        }else if(dni.length==0 && nombre.length==0){
            alertify.error('Ingrese un parametro de busqueda')
        }
        $.ajax({
            url: "DatosPaciente/"+valor,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',        
            beforeSend: function(){
    	      	document.getElementById("upload-img").style.display="block";
    	      	document.getElementById("upload-img").innerHTML="<img src='img/espere.gif' />";         
            }, 
            success: function(resp){
                document.getElementById("upload-img").style.display="none";
                if(resp=='No hay datos'){                
                    alertify.error('No hay paciente con esos parametros')
                    $('#dni').val(dni);
                }else{                 
                    $('#seccionTabla').empty().html(resp);
                    tabla('tblPaciente');
                }
            },
            error: function(){
                document.getElementById("upload-img").style.display="none";
                alertify.error('Ocurrio un error')
            }
        });        
    }	
    function estado(valor){//habilita o deshabilita los inputs
        $('#nombre').prop('disabled', valor);
        $('#direccion').prop('disabled', valor);
        $('#fecnac').prop('disabled', valor);
        $('#sexo').prop('disabled', valor);
        $('#telefono').prop('disabled', valor);
        $('#email').prop('disabled', valor);
        $('#tipoServicio').prop('disabled', valor);
        $('#compania').prop('disabled', valor);
    }
    function registroPaciente(){//realiza el registro de nuevos pacientes
        formData = new FormData($("#frmPaciente")[0]);
        token=$('#token').val();    
        if(validarCamposRegistro()){
            $.ajax({
                url: "Paciente",
                type: 'POST',
                headers: {'X-CSRF-TOKEN': token},
                data: formData,          
                contentType: false,
                processData: false,            
                beforeSend: function(){
               // document.getElementById("upload-img").style.display="block";
               // document.getElementById("upload-img").innerHTML="<img src='img/espere.gif' />";         
                },
                success: function(re){                
                    if(re=='ocurrio un error'){                    
                        alertify.error("Ocurrio un error al registrar el paciente");
                        document.getElementById("upload-img").style.display="none";
                        $('#registro').modal('hide')  
                    }else if(re=='No se recibieron Datos'){
                        alertify.error("Ocurrio un errro a enviar los datos");   
                        document.getElementById("upload-img").style.display="none"; 
                        $('#registro').modal('hide')                  
                    }else if(re=='El paciente ya esta registrado'){                    
                        document.getElementById("upload-img").style.display="none";
                        $('#registro').modal('hide')  
                        alertify.alert('Paciente ya se encuentra registrado')
                    }else if(re.mensaje=='registrado'){
                        document.getElementById("upload-img").style.display="none";                 
                        alertify.success("Paciente Regitrado")
                        $('#compania').val('Seleccionar').trigger('change.select2');
                        BuscarPaciente()
                        limpiar()
                    }
                },
                error: function(){
                    document.getElementById("upload-img").style.display="none";
                }
            });            
        }else{
            console.log('no se verifo')
        }
    }
    function limpiar(){
        $('#frmPaciente')[0].reset()  
        estado(false)
        $('#nombre').focus()
    }
    function cargarDia(){//Cagra la lista de pacientes del dia
        token=$('#token').val();    
        $.ajax({
            url: "listaDia",
            type: "POST",
            headers: {'X-CSRF-TOKEN': token},
            success: function(dato){
                $('#tblLista').empty().html(dato);
                tabla('tblD');
            },
            error: function(){
                alertify.error('Sucedio un error')
            }
        });
    }
    function comboTipo(){//deshabilta el campo compania si no es del tipo rimac
        ts=$('#tipoServicio').val();
        if(ts=='1'){
            $('#compania').attr('disabled',true);
        }else if(ts=='2'){
            $('#compania').attr('disabled',false);
        }
    }
function validarCamposRegistro(){
        nombre = $('#nombre').val()
        dni = $('#dni').val()
        fecnac = $('#fecnac').val()
        sexo = $('#sexo').val()    
        tipos = $('#tipoServicio').val()
        compania = $('#compania').val()
        parentesco = $('#parentesco').val()
        planmed = $('#planmedico').val()
        tipoPlan =$('#tipoAtencion').val()
        if (nombre.length>1) {//Si el campo nombre tiene mas de un valor
            if (dni.length>0 && dni.length>=8) {//si el campo dni cumple los requisitos
                if (fecnac.length>0 && fecnac.length==10) {//verificar el campo fecha de nacimiento
                    if (sexo!=0) {
                        if (tipos==0) {//Si no selecciona un tipo de servicios
                            alertify.error('Seleccione un tipo de Servicio')
                            $('#tipoServicio').focus()
                            return false                               
                        }else{//si a selecciona un valor para el tipo de servicio
                            if (tipos==1) {//Si el tipo de servicio es particular
                                if (parentesco!=0) {//Si a selecciona un nivel de parentesco
                                    if (planmed!=0) {//Si a selecciona un plan medico
                                        if (tipoPlan!=0) {//si a selecciona un tipo de plan
                                            return true;
                                        }else{//Si no a selecciona un plan 
                                            alertify.error('Seleccione el tipo de atencion')
                                            $('#idtipo_plan').focus()
                                            return false   
                                        }
                                    }else{//Si no selecciona un plan medico
                                        alertify.error('Seleccione un plan medico')
                                        $('#planmedico').focus()
                                        return false   
                                    }
                                }else{//Si no a seleccionado unparemtescp
                                     alertify.error('Seleccione el grado de parentesco')
                                    $('#parentesco').focus()
                                    return false                                         
                                }
                            }else{//si el tipo de servicios no es particular
                                console.log(compania)
                                if (compania==0) {//Si no a selecciona una compania
                                    alertify.error('Seleccione la compañia a la que pertence')
                                    $('#compania').focus()
                                    return false 
                                }else{//si a seleccionado una compania
                                    if (parentesco!=0) {//Si a selecciona un nivel de parentesco
                                        if (planmed!=0) {//Si a selecciona un plan medico
                                            if (tipoPlan!=0) {//si a selecciona un tipo de plan
                                                return true;
                                            }else{//Si no a selecciona un plan 
                                                alertify.error('Seleccione el tipo de atencion')
                                                $('#idtipo_plan').focus()
                                                return false   
                                            }
                                        }else{//Si no selecciona un plan medico
                                            alertify.error('Seleccione un plan medico')
                                            $('#planmedico').focus()
                                            return false   
                                        }
                                    }else{//Si no a seleccionado unparemtescp
                                        alertify.error('Seleccione el grado de parentesco')
                                        $('#parentesco').focus()
                                        return false                                         
                                    }
                                }
                            }
                        }
                    }else{//No su cumple con seleccionar un genero
                        alertify.error('Seleccione un Genero')
                        $('#sexo').focus()
                        return false                          
                    }
                }else{//sinno cumple los requisitos para la fecha de nacimiento
                    alertify.error('Verifique la Fecha de Nacimiento')
                    $('#fecnac').focus()
                    return false   
                }
            }else{//si no hay datos en el campo dni
                alertify.error('Verifique el campo DNI')
                $('#nuevodni').focus()
                return false
            }
        }else{//Si el campo nombre no tiene datos
            alertify.error('El nombre es un campo obligatorio')
            $('#nombre').focus()
            return false
        }
}
function AgregarId(id){
    $('#idPer').val(""+id)
}
function AgregarParaConsulta(id){
    token=token=$('#token').val()
    tAtencion=$('#tipoAtencion').val()
    planMedi=$('#planmedico').val()
    if (tAtencion==0 || planMedi==0) {
        alertify.error('Seleccione los precedimientos requeridos')
    }else{
        $.ajax({
            url: "AddConsultaDia",
            type: 'POST',
            data: {
                id: id,
                tAtencion: tAtencion,
                planMedi: planMedi
            },
            headers:{'X-CSRF-TOKEN': token},
            success: function (res){  
                console.log( res) 

                if(res=="Paciente Agregado Correctamente"){
                    alertify.alert("Agregado Correctamente")

                }else{                
                    alertify.alert(res)
                }
            }, 
            error: function(res){
                console.log('no funciona:'+res)
                //alertify.error(res)
            }
        });        
    }
}
function obtenerCompania(id){
    token=$('#token').val()
    $.ajax({
        url: 'obComp',
        type: 'get',
        data: {id : id},
        headers:{'X-CSRF-TOKEN': token},
        success: function (com){            
            $("#compania").val(com[0].id_compania).change()
        }
    });
}
function cargarDatosPaciente(id){
    $('#modPaci').attr({'id':'btnRegPac','class':'btn btn-warning btn-sm'})
    token=token=$('#token').val()    
    $.ajax({
        url: 'Paciente/'+id+'/edit',
        type: 'GET',
        headers:{'X-CSRF-TOKEN': token},
        success: function (respuesta){            
            $('#registro').modal('show') 
            $('#nombre').val(respuesta.nombre)
            $('#nuevodni').val(respuesta.dni)
            $('#fecnac').val(respuesta.fecnac)
            $('#sexo').val(respuesta.sexo)
            $('#direccion').val(respuesta.direccion)
            $('#email').val(respuesta.email)
            $('#telefono').val(respuesta.telefono)
            $('#tipoServicio').val(respuesta.tipo_seguro_id)
            if(respuesta.tipo_seguro_id!=1){
                cargarCompanias(respuesta.tipo_seguro_id)
                obtenerCompania(respuesta.id)
                $('#compania').attr('disabled',false)
            }else{
                $('#compania').attr('disabled',true)
            }
            $('#parentesco').val(respuesta.parentesco)
            $('#planmedico').attr('disabled',true)
            $('#idtipo_plan').attr('disabled',true)            
            $('#btnRegPac').attr({'id':'modPaci','class':'btn btn-warning btn-sm','onclick': "modificarPaciente("+id+")"})            
        }, 
        error: function (){
            alertify.error("Ocurrio un error al cargar los datos del paciente")
        }
    });
}
function modificarPaciente(idP){
    token=token=$('#token').val()
    nombre=$('#nombre').val()
    dni=$('#nuevodni').val()
    fecnac=$('#fecnac').val()
    sexo=$('#sexo').val()
    direccion=$('#direccion').val()
    email=$('#email').val()
    telefono=$('#telefono').val()
    tiposer=$('#tipoServicio').val()    
    compania=$('#compania').val()
    parentesco=$('#parentesco').val()    
    $.ajax({
        url: 'Paciente/'+idP,
        type: 'PUT',
        headers:{'X-CSRF-TOKEN': token},
        data: {
            nombre:nombre,
            dni:dni,
            fecnac:fecnac,
            sexo:sexo,
            direccion:direccion,
            email:email,
            telefono:telefono,
            tiposer:tiposer,
            compania:compania,
            parentesco:parentesco,
        },
        success: function(resp){
            if(resp=='Datos Actualizados'){
                $('#registro').modal('hide') 
                alertify.success('Datos del Paciente modificados')
                $('#modPaci').attr({'id':'btnRegPac','class':'btn btn-success btn-sm','onclick':'registroPaciente()'})                
                $('#frmPaciente')[0].reset()
                BuscarPaciente()
            }else if(resp=='No se realizaron cambios'){
                alertify.log('No se encontraron cambios')
            }else{
                alertify.error(resp)
            }
        },
        error: function(){
            alertify.error('Ocurrio un error al Actualizar')
        }
    });
}
function consultasAnno(idP){//Funcion que devuelve la cantidad de consultas del paciente por año
token=token=$('#token').val()
$.ajax({
    url: 'ConAn/'+idP,
    type: 'GET',    
    headers:{'X-CSRF-TOKEN': token},
    success: function (resp){
        $('#AtenAnno').modal('show')
        $('#tblListaAn').empty().html(resp);
        tabla('tblAtenAnno');        
    }, 
    error: function(){
        alertify.error('Ocurrio un error en la consulta')
    }
});

}
//Funcion para agregar una compania en el modal de agregar paciente
function AgregarCompania(){
    var formData = new FormData($("#frmcomp")[0]);
    token=$('#token').val()
    $.ajax({
        url:'compania',
        type:'post',
        headers:{'X-CSRF-TOKEN': token},
        data: formData,
        contentType: false,
        processData: false,        
        success: function(re){
            alertify.success('Compañia Registrada')
            $('#modalCompa').modal('hide')  
            $('#frmcomp')[0].reset()
            $('#compania').find('option').remove();
            $('#compania').append('<option value="Seleccionar">Seleccionar</option>');            
            cargarCompanias(formData.get('Aseguradora'))                        
        }, 
        error: function (){
            alertify.error('Ocurrio un error')
        }
    });
}
function cargarCompanias(idA){

$.ajax({
    url: 'cargaCompania',
    type: 'get',
    data: {
        idA: idA
    },
    dataType: 'json',
    success: function (re){        
        $(re).each(function(i, v){ // indice, valor            
            $('#compania').append('<option value="' + v.id + '">' + v.nombre + '</option>');
        });
    }, 
    error: function(){
        alertify.error('Error al cargar las compañias')
    }
});
}
function EliminarConsulta(idc, idp){//Funcion para eliminar consultas de cada paciente
    token=$('#token').val()
    alertify.confirm("Realmente desea eliminar esta consulta", function (e) {
        if (e) {
            $.ajax({
                url: 'Consulta/'+idc,
                type: 'DELETE',
                headers:{'X-CSRF-TOKEN': token},
                success: function(r){
                    if(r.mensaje=='1'){
                        alertify.log('Consulta Eliminada')
                        $.ajax({
                            url: 'ConAn/'+idp,
                            type: 'GET',    
                            headers:{'X-CSRF-TOKEN': token},
                            success: function (resp){                        
                                $('#tblListaAn').empty().html(resp);
                                tabla('tblAtenAnno');        
                            }, 
                            error: function(){
                                alertify.error('Ocurrio un error en la consulta')
                            }
                        });                
                    }else if(r.mensaje==2){
                        alertify.error('Ocurrio un error no se puede eliminar la consulta')
                    }
                },
                error: function(){
                    alertify.error('Ocurrio un error no se puede eliminar la consulta')
                }
            });
        } else {
            alertify.error("Accion Cancelada");
        }
    });
}

function EliminarPaciente(id){//Funcion para eleiminar al paciente
    token=$('#token').val()
    alertify.confirm("Realmente desea eliminar a este paciente", function (e) {
        if (e) {
            $.ajax({
                url: 'Paciente/'+id,
                type: 'DELETE',
                headers:{'X-CSRF-TOKEN': token},
                success: function(r){
                    if(r.mensaje=='1'){
                        alertify.log('Consulta Eliminada')
                        $('#historia').empty().html()
                    }else if(r.mensaje==2){
                        alertify.error('Ocurrio un error no se puede eliminar la consulta')
                    }
                },
                error: function(){
                    alertify.error('Ocurrio un error no se puede eliminar la consulta')
                }
            });
        } else {
            alertify.error("Accion Cancelada");
        }
    });
}
//funcion para obtener la compañia del paciente
function listaCompania(id){
    $.ajax({
        url:'obComp',
        typé:'GET',
        headers:{'X-CSRF-TOKEN': token},
        data: {
            id:id
        },
        success: function(r){
            var datos = r
            return datos;
        }, 
        error: function (){
            alertify.error('Ocurrio un error al cargar la compañia')
        }

    });
}

//Funcion para actualizar los datos del pacientes 
function CargarInputs(json){
    console.log(json)
    id=json.id
    token=$('#token').val()
    if ($('#btnCargar').length) {//verifica si el boton esta en cargar o actualizar
        $('#nombre').val(json.nombre)
        $('#direccion').val(json.direccion)
        $('#fecnac').val(json.fecnac)
        $('#sexo').val(json.sexo)
        $('#telefono').val(json.telefono)
        $('#email').val(json.email)
        $('#tipoServicio').val(json.tipo_seguro_id)
        $('#tipoServicio').ready(function (){
            t=$('#tipoServicio').val()
            $('#compania').find('option').remove();            
            $('#compania').append('<option value="0">Seleccionar</option>');                    
            cargarCompanias(t);
        });
        $('#compania').val(json.idcom)
        console.log(json.idcom)
        $('#btnCargar').prop('class', "btn btn-warning btn-sm");
        $('#iedit').prop('class', 'fa fa-save')
        $('#btnCargar').prop('id', "btnUp");
        
    }else if($('#btnUp').length){
        alertify.confirm("Desea continuar con la actualizacion de datos del pacientes",function(e){
            if(e){
                nombre= $('#nombre').val()
                dni=$('#dni').val()
                direccion=$('#direccion').val()
                fecnac=$('#fecnac').val()
                sexo=$('#sexo').val()
                telefono=$('#telefono').val()
                email=$('#email').val()
                parentesco=$('#parentesco').val()
                tiposer=$('#tipoServicio').val()
                compania=$('#compania').val()
                $.ajax({
                    url: 'Paciente/'+id,
                    type: 'PUT',
                    headers:{'X-CSRF-TOKEN': token},
                    data: {
                        nombre:nombre,
                        dni:dni,
                        fecnac:fecnac,
                        sexo:sexo,
                        direccion:direccion,
                        email:email,
                        telefono:telefono,
                        tiposer:tiposer,
                        compania:compania,
                        parentesco:parentesco,
                    },
                    success: function(resp){
                        if(resp=='Datos Actualizados'){
                            $('#registro').modal('hide') 
                            alertify.success('Datos del Paciente modificados')
                            $('#modPaci').attr({'id':'btnRegPac','class':'btn btn-success btn-sm','onclick':'registroPaciente()'})                
                            
                            BuscarPaciente()
                        }else if(resp=='No se realizaron cambios'){
                            alertify.log('No se encontraron cambios')
                        }else{
                            alertify.error(resp)
                        }
                    },
                    error: function(){
                        alertify.error('Ocurrio un error al Actualizar')
                    }
                });
            }else{
                alertify.error('Accion cancelada')
                $('#frmPaciente')[0].reset()
                $('#btnUp').prop('class', "btn btn-danger btn-sm");
                $('#iedit').prop('class', 'fa fa-edit')
                $('#btnUp').prop('id', "btnCargar");
            }


        });
        
    }
}//Fin de la funcion para actualizar los datos
function eliminarPa(id){//Funcion para eliminar pacientes
    alertify.confirm("<p>Realmente desea Eliminar el paciente!, Se eliminar con el paciente las historias Registradas", function (e) {
        if (e) {
            token=$('#token').val()
            $.ajax({
                url: 'Paciente/'+id,
                type: 'DELETE',
                headers:{'X-CSRF-TOKEN': token},					
                success: function (res){
                    if(res.mensaje=="1"){
                        alertify.log('Paciente Eliminado!!!')
                        $('#seccionTabla').empty().html();
                    }else{
                        alertify.error("No se puede eliminar este paciente mientras tenga historias registradas")		
                    }
                }, 
                error: function (){
                    alertify.error("Ocurrio un error al eliminar el paciente")	
                }
            });                  
        } else { 
                    alertify.error("Accion Cancelada!");
        }
  }); 
  return false
}
function historiasAntes(id){//funcion para mostrar las historias de los pacientes
    token=$('#token').val();    
    $.ajax({
        url: "historiasAntes/"+id,
        type: "GET",
        headers: {'X-CSRF-TOKEN': token},
        success: function(dato){
            $('#tblHistorias').empty().html(dato);
            tabla('tblHistoriasAntes')
        },
        error: function(){
            alertify.error('Sucedio un error')
        }
    });      
}
function mostrarHistoria(nc,idpac){
    window.open('historia/'+nc+'/'+idpac, "Historia Clinica" , "width=765,height=970,scrollbars=NO")  
}
