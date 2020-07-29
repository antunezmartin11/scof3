window.addEventListener('load', function(){
    $('#btnA').click(function (){
        if(validarFormulario()){
            agregarUsuario();       
        }         
    });
    cargarU()
    tabla('usuarios')
    $('#btnEditarP').click(function (){
        EditarUsuario()
    });    
}, false);

//Funcion para aplicar las funciones del datatables
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
//Funcion para cargar las lista
function cargarU(){
    $.ajax({
        url: 'Lista',
        type: 'get',
        success: function(re){
            $('#contenido').empty().html(re);
        },
        error: function(){
            alertify.error('No se pudo cargar a los usuarios')
        }
    });
}

//Funcion para agregar un nuevo usuario
function agregarUsuario(){
    var formData = new FormData($("#formUsuario")[0]);
    token=$('#token').val()
    $.ajax({
        url: 'Usuario',
        type:'post',
        data: formData,
        headers:{'X-CSRF-TOKEN': token},
        contentType: false,
        processData: false,    
        success: function(re){
            alertify.success(re.message)
            $('#formUsuario')[0].reset()
        },
        error: function (re){
            alertify.error(re.message)
        }
    });
}
//Funcion par mejorar -- nivel principante 
function validarFormulario(){
    nombre=$('#nombreU').val();
    apellido=$('#apellidoU').val()
    dni=$('#dniU').val()
    fec=$('#fecU').val()
    usuario=$('#usuario').val()
    contra=$('#contra').val()
    contra1=$('#Vcontra').val()
    tipo=$('#tipoU').val()
    if(nombre.length>0){
        if(apellido.length>0){
            if(dni.length>=8){
                if(fec.length>9){
                    if(usuario.length>1){
                        if(contra.length>6){
                            if(contra==contra1){
                                if(tipo.length>0){
                                    if(tipo!='Seleccionar'){
                                        return true;
                                    }else{
                                        alertify.error('Seleccione un opcion valida')                                        
                                        return false;                                           
                                    }
                                }else{
                                    alertify.error('Seleccione un tipo de usuario')                                    
                                    return false;                                       
                                }
                            }else{
                                alertify.error('Los campos no coinciden')
                                $('#contra').focus();
                                return false;                                   
                            }
                        }else{
                            alertify.error('Su contraseña debe tener 6 digitos minimo')
                            $('#contra').focus();
                            return false;                              
                        }
                    }else{
                        alertify.error('Ingrese un usuario')
                        $('#usuario').focus();
                        return false;                          
                    }
                }else{
                    alertify.error('Ingrese una fecha de nacimiento')
                    $('#fecU').focus();
                    return false;                       
                }
            }else{
                alertify.error('Verifique el campo del DNI')
                $('#dniU').focus();
                return false;                   
            }
        }else{
            alertify.error('Los apellidos son obligatorios')
            $('#apellidoU').focus();
            return false;            
        }
    }else{
        alertify.error('El nombre es un campo obligatorio')
        $('#nombreU').focus();
        return false;
    }
}
function verificarPersona(){
    nombre=$('#nombreUM').val()
    apellido=$('#apellidoUM').val()
    dni=$('#dniUM').val()
    fecha=$('#fecUM').val()
    if(nombre.length>0){
        if(apellido.length>0){
            if(dni.length>=8){
                if(fecha.length>9){
                    return true;
                }else{
                    alertify.error('Ingrese una fecha de nacimiento valida')
                    $('#fecUM').focus()
                    return false;                        
                }
            }else{
                alertify.error('Verifique el campo DNI')
                $('#dniUM').focus()
                return false;                
            }
        }else{
            alertify.error('El campo de Apellidos no puede quedar vacio')
            $('#apellidoU').focus()
            return false;
        }
    }else{
        alertify.error('El campo del nombre no puede quedar vacio')
        $('#nombreU').focus()
        return false;
    }


}
function cargarDatosPersona(idp){
    token=$('#token').val()                
    $.ajax({
        url: 'Usuario/'+idp+'/edit',
        type: 'get',        
        headers:{'X-CSRF-TOKEN': token},        
        success: function (respuesta){
            $('#idp').val(respuesta[0].id)
            $('#idu').val(respuesta[0].idu)
            $('#nombreUM').val(respuesta[0].nombre)
            $('#apellidoUM').val(respuesta[0].apellido)
            $('#dniUM').val(respuesta[0].dni)
            $('#emailUM').val(respuesta[0].email)
            $('#fecUM').val(respuesta[0].fecnac)     
            $('#telefonoUM').val(respuesta[0].telefono)
        }, 
        error: function (){
            alertify.error('Ocurrio un error al cargar los datos del usuario')
        }
    });            
}


function EditarUsuario(){
token=$('#token').val()    
idp=$('#idp').val()
nombre=$('#nombreUM').val()
apellido=$('#apellidoUM').val()
dni=$('#dniUM').val()
telefono=$('#telefonoUM').val()
fec=$('#fecUM').val()
idu=$('#idu').val()
email=$('#emailUM').val()
        $.ajax({
            type:'PUT',             
            url:'Usuario/'+idp,
            data: {
                nombre: nombre,
                apellido: apellido,
                dni: dni,
                fec: fec,
                telefono: telefono,
                idu: idu,
                email: email,
            },       
            headers:{'X-CSRF-TOKEN': token},                         
            success: function(r){
                if(r.mensaje=='Datos Actualizados'){
                    alertify.success('Datos Actualizados')
                    $('#editarU').modal('hide')
                    $('#frmPersona')[0].reset()
                    cargarU()
                    tabla('usuarios')
                }else if(r.mensaje=='No se encontraron modificaciones'){
                    alertify.log('No se encontraron cambios')
                }else{
                    alertify.error('El servidor no recibio los datos')
                }

            }, 
            error: function(r){                
                alertify.error('Ocurrio un error al actualizar')
            }
        });
} 
function cargarIdC(idu,u){//Funcion para cargar el id de usuario para modificar la contrasñea
    $('#idus').val(idu)
    $('#ncont').val('')
    $('#rncont').val('')
    $('#musuario').val(u)
}
function modificarContraseña(tp){
token=$('#token').val()  
idu=$('#idus').val()
con=$('#ncont').val()
rcon=$('#rncont').val()
    if(tp==1){
        $.ajax({
            url: 'MPassword',
            type: 'POST',
            headers:{'X-CSRF-TOKEN': token},   
            data:{
                idu: idu,
                tp:tp,
            },
            success: function(r){
                if(r.mensaje=="Generado"){
                    $('#nuevaP').val(r.nuevo)
                    $('#editarC').modal('hide')
                }else if(r.mensaje=="No se pudo actualizar"){
                    alertify.error('Ocurrio un error')
                }
            }, 
            error: function(){
                alertify.error('No se puede actualizar')
            }
        });
    }else if(tp==2){
        if(con.length>5){
            if(con==rcon){
            $.ajax({
                url: 'MPassword',
                type: 'POST',
                headers:{'X-CSRF-TOKEN': token},   
                data:{
                    idu: idu,
                    con: con,  
                    tp: tp,                  
                },
                success: function(r){
                    if(r.mensaje=='Se actualizo la contraseña'){
                        alertify.success('Contraseña Modificada')
                        $('#editarC').modal('hide')
                    }else{
                        alertify.error('No se pudo actualizar')
                    }
                }, 
                error: function(){
                    alertify.error('No se puede actualizar')
                }
            });
            }else{
                $('#ncont').focus()
                alertify.error('Las contraseña no coinciden')
            }
        }else{
            alertify.error('La nueva contraseña debe tener minimo 6 digitos')
            $('#ncont').focus()
        }
    }else if(tp==3){
        u=$('#musuario').val()
        if(u.length>4){
            $.ajax({
                url: 'MPassword',
                type: 'POST',
                headers:{'X-CSRF-TOKEN': token},   
                data: {
                    idu: idu,
                    u: u,
                    tp: tp
                }, 
                success: function(r){
                    alertify.success(r.mensaje)
                    cargarU()
                    tabla('usuarios')    
                    $('#editarC').modal('hide')
                }, 
                error: function(){
                    alertify.error('No se pudo modificar el usuario')
                }
            });
        }else{
            alertify.error('Nombre de usuario muy corto o el campo esta vacio')
        }
    }
}

//Funcion para eliminar usuarios
function eliminarU(idu){
    token=$('#token').val()  
    alertify.confirm("Realmente desea eliminar el usuario", function (e) {
            if (e) {
                $.ajax({
                    url: 'Usuario/'+idu,
                    type: 'DELETE',
                    headers:{'X-CSRF-TOKEN': token}, 
                    success: function(r){
                        alertify.log(r.mensaje)
                        cargarU()
                        tabla('usuarios')                          
                    },
                    error: function(){
                        alertify.error('Ocurrio un error')
                    }
                });
            } else {
                alertify.error("Accion Cancelada");
            }
        });
}