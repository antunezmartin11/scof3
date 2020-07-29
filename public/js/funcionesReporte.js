window.addEventListener('load', function(){
    cargarDia()
    //imprime los resultados
    $('#printR').click(function(){
        t=$('#tipo').val()
        if(t=='Seleccionar'){
            window.open('ReporteDiaPDF', '_blank');
        }else{
            fi=$('#fecIni').val()
            ff=$('#fecFin').val()
            window.open('ReporteDiaFechaG/'+fi+'/'+ff+'/'+t,'_blank');
        }
    });
    $('#btnBus').click(function(){
        ts=$('#tipo').val()        
        DiaxFechas(ts)            
    });
    //Para los reportes de diagnostico
    $('#btnBusRD').click(function (){
        reporteGenDg()
        $('#tpR').val('1')
        $('#frmDiagRCa')[0].reset()
        $('#frmFrec')[0].reset()
    });
    $('#btnBusRDF').click(function (){
        reporteResFeD()
        $('#tpR').val('2')
        $('#frmDiagR')[0].reset() 
        $('#frmFrec')[0].reset()
    });
    $('#btnBusFre').click(function (){
        reporteFrecuente()
        $('#tpR').val('3')        
        $('#frmDiagRCa')[0].reset() 
        $('#frmDiagR')[0].reset() 
    });        
    $('#printRD').click(function (){
        t=$('#tpR').val()
        if(t==1){
           fi=$('#fecIniD').val()
           ff=$('#fecFinD').val()
           if(fi.length>9){
                if(ff.length>9){
                    if(ff<fi){
                        alertify.error('La fecha final no puede ser antes de la inicial')
                    }else{
                        window.open('printRPD/'+fi+'/'+ff,'_blank')
                    }
                }else{
                    alertify.error('Tiene que indicar una fecha de fin')
                }
           }else{
            alertify.error('Tiene que indicar una fecha de Inicio')
           }            
        }else if(t==2){
           fi=$('#fecIniDR').val()
           ff=$('#fecFinDR').val()
           if(fi.length>9){
                if(ff.length>9){
                    if(ff<fi){
                        alertify.error('La fecha final no puede ser antes de la inicial')
                    }else{
                        window.open('ResumenDiagPDF/'+fi+'/'+ff,'_blank')
                    }
                }else{
                    alertify.error('Tiene que indicar una fecha de fin')
                }
           }else{
            alertify.error('Tiene que indicar una fecha de Inicio')
           }
        }else if(t==3){
           fi=$('#fecIniDF').val()
           ff=$('#fecFinDF').val()
           if(fi.length>9){
                if(ff.length>9){
                    if(ff<fi){
                        alertify.error('La fecha final no puede ser antes de la inicial')
                    }else{
                        window.open('PDFrecuente/'+fi+'/'+ff,'_blank')
                    }
                }else{
                    alertify.error('Tiene que indicar una fecha de fin')
                }
           }else{
            alertify.error('Tiene que indicar una fecha de Inicio')
           }
        }else{
            alertify.error('Primero indique los parametros de busqueda')
        }
    });
    //Para el reporte de procedimiento
    $('#btnBusRP').click( function (){
        ResumenProcedimiento()
        $('#tpP').val('1')
        $('#frmProCan')[0].reset()
    });
    $('#btnBusPr').click(function (){
        procedimientoFechas()
        $('#tpP').val('2')
        $('#frmProcRes')[0].reset()
    });
    //Generar el PDF del reporte por procedimiento
    $('#printRP').click(function(){
        t=$('#tpP').val()
        if(t==1){
           fi=$('#fecIniP').val()
           ff=$('#fecFinP').val()
           if(fi.length>9){
                if(ff.length>9){
                    if(ff<fi){
                        alertify.error('La fecha final no puede ser antes de la inicial')
                    }else{
                        window.open('PDFProcedimiento/'+fi+'/'+ff,'_blank')
                    }
                }else{
                    alertify.error('Tiene que indicar una fecha de fin')
                }
           }else{
            alertify.error('Tiene que indicar una fecha de Inicio')
           }
        }else if(t==2){
           fi=$('#fecIniPR').val()
           ff=$('#fecFinPR').val()
           if(fi.length>9){
                if(ff.length>9){
                    if(ff<fi){
                        alertify.error('La fecha final no puede ser antes de la inicial')
                    }else{
                        window.open('PDFProcedimientoCantidad/'+fi+'/'+ff,'_blank')
                    }
                }else{
                    alertify.error('Tiene que indicar una fecha de fin')
                }
           }else{
            alertify.error('Tiene que indicar una fecha de Inicio')
           }
        }else{
            alertify.error('Primero indique los parametros de busqueda')            
        }
    });
//Para las funciones de reporte por edades
    $('#btnEdadDe').click(function (){        
        EdadesDetalle()
    });

}, false);
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
function cargarDia(){
    $.ajax({
        url:'ReporteDia',
        type:'get',
        success: function (info){
            $('#reporte').empty().html(info);
            tabla('reporteD')
        },
        error: function (){
            alertify.error('Ocurrio un error al cargar la lista')
        }
    });
}
//Generar el reporte para un rango de fechas y un tipo de busqueda
function DiaxFechas(t){
    fi=$('#fecIni').val()
    ff=$('#fecFin').val()
    if (fi.length>9) {
        if(ff.length>9){
            if (t=='Seleccionar') {
                alertify.error('Tiene que seleccionar un tipo')        
            }else{
                $.ajax({
                    url: 'ReporteDiaFecha',
                    type: 'GET',
                    data: {
                        fi: fi,
                        ff: ff,
                        t:t
                    },
                    success: function (re){
                        $('#reporte').empty().html(re)
                        tabla('reporteD')
                    }, 
                    error: function(){
                        alertify.error('Ocurrio un error')
                    }
                });
            }
        }else{
            alertify.error('Indique una fecha de fin')    
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }
}
// Funciones para generar reporte de diagnisticos

//Report resumen por fechas
function reporteGenDg(){
fi=$('#fecIniD').val()
ff=$('#fecFinD').val()
    if(fi.length>9){
        if(ff.length>9){
            if(ff<fi){
                alertify.error('La fecha final no puede ser antes de la fecha inicial')
            }else{
               $.ajax({
                url: 'ReporteDiagnosticoF',
                type: 'GET',
                data: {
                    fi: fi,
                    ff:ff
                }, 
                success: function (r){
                    $('#reporteDiagnostico').empty().html(r)
                    tabla('reporteD')
                }, 
                error: function(){
                    alertify.error('Ocurrio un error')
                }
               });
            }
        }else{
            alertify.error('Indique una fecha de fin')
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }
}
//Reporte resumen de diagnosticos por fechas
function reporteResFeD(){
    fi=$('#fecIniDR').val()
    ff=$('#fecFinDR').val()
    if(fi.length>9){
        if(ff.length>9){
            if(ff<fi){
                alertify.error('La fecha final no puede ser antes de la fecha inicial')
            }else{
               $.ajax({
                url: 'ResumenDiag',
                type: 'GET',
                data: {
                    fi: fi,
                    ff:ff
                }, 
                success: function (r){
                    $('#reporteDiagnostico').empty().html(r)
                    tabla('resumenDiag')
                }, 
                error: function(){
                    alertify.error('Ocurrio un error')
                }
               });
            }
        }else{
            alertify.error('Indique una fecha de fin')
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }    
}
//reporte con los diagnosticos mas frecuentes
function reporteFrecuente(){
    fi=$('#fecIniDF').val()
    ff=$('#fecFinDF').val()
    if(fi.length>9){
        if(ff.length>9){
            if(ff<fi){
                alertify.error('La fecha final no puede ser antes de la fecha inicial')
            }else{
               $.ajax({
                url: 'DiagnosticoFrecuente',
                type: 'GET',
                data: {
                    fi: fi,
                    ff:ff
                }, 
                success: function (r){
                    $('#reporteDiagnostico').empty().html(r)
                    tabla('DiagFrecuente')
                }, 
                error: function(){
                    alertify.error('Ocurrio un error')
                }
               });
            }
        }else{
            alertify.error('Indique una fecha de fin')
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }    
}

//Funciones para generar los reportes por procedimientos

//Generar el reporte general de procedimientos
function ResumenProcedimiento(){
    fi=$('#fecIniP').val()
    ff=$('#fecFinP').val()
    if(fi.length>9){
        if(ff.length>9){
            if(ff<fi){
                alertify.error('La fecha final no puede ser antes de la fecha inicial')
            }else{
               $.ajax({
                url: 'ProcedimientoGeneral',
                type: 'GET',
                data: {
                    fi: fi,
                    ff:ff
                }, 
                success: function (r){
                    $('#reporteProcedimiento').empty().html(r)
                    tabla('resumenPro')
                }, 
                error: function(){
                    alertify.error('Ocurrio un error')
                }
               });
            }
        }else{
            alertify.error('Indique una fecha de fin')
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }  
}

//Generar reporte resumen por fechas
function procedimientoFechas(){
    fi=$('#fecIniPR').val()
    ff=$('#fecFinPR').val()
    if(fi.length>9){
        if(ff.length>9){
            if(ff<fi){
                alertify.error('La fecha final no puede ser antes de la fecha inicial')
            }else{
               $.ajax({
                url: 'ProcedimientoCantidad',
                type: 'GET',
                data: {
                    fi: fi,
                    ff:ff
                }, 
                success: function (r){
                    $('#reporteProcedimiento').empty().html(r)
                    tabla('resumenPro')
                }, 
                error: function(){
                    alertify.error('Ocurrio un error')
                }
               });
            }
        }else{
            alertify.error('Indique una fecha de fin')
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }  
}

//Funciones para generar reportes por edaes

//Funcion para el primero reporte de detalle por edades

function EdadesDetalle(){
    fi=$('#fecIniED').val()
    ff=$('#fecFinED').val()
    ei=""
    ef=""
    r=$('#EdadesDet').val()
    switch(r){
        case '1':
            ei=-1
            ef=6
            break;
        case '2':
            ei="6"
            ef="10"
            break;
        case '3':
            ei="11"
            ef="15"
            break;
        case '4':
            ei="16"
            ef="20"
            break;
        case '5':
            ei="21"
            ef="25"
            break;
        case '6':
            ei="26"
            ef="30"
            break;
        case '7':
            ei="31"
            ef="35"
            break;
        case '8':
            ei="36"
            ef="40"
            break;
        case '9':
            ei="41"
            ef="45"
            break;
        case '10':
            ei="46"
            ef="50"
            break;
        case '11':
            ei="51"
            ef="55"
            break;
        case '12':
            ei="56"
            ef="60"
            break;
        case '13':
            ei="61"
            ef="65"
            break;
        case '14':
            ei="66"
            ef='70'
            break;
        case '15':
            ei="71"
            ef="75"
            break;
        case '16':
            ei="76"
            ef="80"
            break;
        case '17':
            ei="81"
            ef="85"
            break;
        case '18':
            ei="86"
            ef="90"
            break;
        case '19':
            ei="91"
            ef="300"
            break;
        case 'Seleccionar':
            ei="Seleccionar"      
            break;             
    }           
    if(fi.length>9){
        if(ff.length>9){
            if(ff<fi){
                alertify.error('La fecha final no puede ser antes de la fecha inicial')
            }else{
                if(ei!='Seleccionar'){
                   $.ajax({
                    url: 'ReporteGeneralEdad',
                    type: 'GET',
                    data: {
                        fi: fi,
                        ff:ff,
                        ei: ei,
                        ef: ef
                    }, 
                    success: function (r){
                        $('#reporteEdades').empty().html(r)
                        tabla('resumenedades')
                        console.log(ei)
                        console.log(ef)
                    }, 
                    error: function(){
                        alertify.error('Ocurrio un error')
                    }
                   });
                }else{
                    alertify.error('Tiene que indicar un rango de edad')
                }
            }
        }else{
            alertify.error('Indique una fecha de fin')
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }      
}

//Funcion para genear el reporte de diagnostico por edades
function DiagnosticoEdades(){

}
//Funciones para generar el reporte por diagnosticos por edades detallado
function DiagnosticoEdadesDetalle(){

}