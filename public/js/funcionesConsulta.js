window.addEventListener('load', function(){
	$(document).keydown(function (e){
		guardart(e)
    });
    
    cargarfarmaco()
    cargarUnidad()
    cargarIndicacion()
    cargarDia()//carga los pacientes registrados para atencion en el dia
    listConsulta()
    cargarCie1()
    //cargarfarmaco()
    $('#talla').change(function(e){//Ejecuta la funcion para clcular el IMC
        IMC()
    })
    
 
    //Funcion para cargar las histrias
    $('#hp').click(function(){
        idp=$('#nhis').val();
        token=$('#token').val();         
        if(idp==''){
            alertify.error('Seleccion primero un paciente')
        }else{
            $('#historiaPaciente').modal('show')
            $.ajax({
                url: 'listaHistoriaP',
                data: {idp:idp},
                type: 'post',
                headers: {'X-CSRF-TOKEN': token},
                success: function(dato){
                    $('#listaHistoria').empty().html(dato);                                    
                    tabla('tblhist')
                }, 
                error: function(){
                    alertify.error('Error cargando las historias')
                }       
            });
        }
    });
    function cargarUnidad(){//Funciona para cargar las sugerencias de unidades
        token=$('#token').val(); 
        var un = new Array();
        $.ajax({
            url:'unidad',
            type:'GET',
            headers: {'X-CSRF-TOKEN': token},
            success: function(data){
                for (let i = 0; i < data.length; i++) {
                    if(data[i].unidad==null){
                        un.push(' ')
                    }else{
                        un.push(data[i].unidad);
                    }
                }

                $('#unid1').autocomplete({
                    source:un,
                    minLength: 2
                }) 
                $('#unid2').autocomplete({
                    source:un,
                    minLength: 2
                }) 
                $('#unid3').autocomplete({
                    source:un,
                    minLength: 2
                }) 
                $('#unid4').autocomplete({
                    source:un,
                    minLength: 2                
                }) 
            }, 
            error: function(error){
                alertify.error('Error cargando los farmacos')
                console.log(error)
            }    
        })
    }

    function cargarIndicacion(){//Funciona para cargar las sugerencias de indicaciones
        token=$('#token').val(); 
        var ind = new Array();
        $.ajax({
            url:'indicacion',
            type:'GET',
            headers: {'X-CSRF-TOKEN': token},
            success: function(data){
                for (let i = 0; i < data.length; i++) {
                    if(data[i].indicaciones==null){
                        ind.push(' ')
                    }else{
                        ind.push(data[i].indicaciones);
                    }
                }
                $('#ind1').autocomplete({
                    source:ind,
                    minLength: 3
                }) 
                $('#ind2').autocomplete({
                    source:ind,
                    minLength: 3
                }) 
                $('#ind3').autocomplete({
                    source:ind, 
                    minLength: 3
                }) 
                $('#ind4').autocomplete({
                    source:ind,
                    minLength: 3
                }) 
            }, 
            error: function(error){
                alertify.error('Error cargando los farmacos')
                console.log(error)
            }    
        })
    }
    function cargarfarmaco(){//Funciona para cargar las sugerencias de farmacos
        token=$('#token').val();  
        var f = new Array();
        $.ajax({
            url:'farmaco',
            type:'GET',
            headers: {'X-CSRF-TOKEN': token},
            success: function(data){
                for (let i = 0; i < data.length; i++) {
                    if(data[i].farmaco==null){
                        f.push(' ')
                    }else{
                        f.push(data[i].farmaco);
                    }
                }
                $('#far1').autocomplete({
                    source:f,
                    minLength: 3
                })  
                $('#far2').autocomplete({
                    source:f,
                    minLength: 3
                }) 
                $('#far3').autocomplete({
                    source:f,
                    minLength: 3
                }) 
                $('#far4').autocomplete({
                    source:f,
                    minLength: 3
                }) 
            }, 
            error: function(error){
                alertify.error('Error cargando los farmacos')
                console.log(error)
            }    
        })
    }
    //Fin de la funcion para cargar las historias
    //Funcion para actualizar la lista de pacinetes para atencion
    $('#refrescar').click(function(){
        listConsulta()
        cargarDia()
    });
    $('#btnGu').click(function(){
        guardarEvCl()
    });
    //Fin de la funcion para actualizar los pacientes para atencion
 
    //Funcion para el tab de la fila OD
    pasartab('odsc','oisc')
    pasartab('odcc','oicc')
    pasartab('odca','odsc')
    pasartab('oisc','odcc')
    pasartab('oicc','odca')

    //Funcion para el tab de la fila OD
    pasartab('odesfera','odesferaC')
    pasartab('odcilindro','odcilindroC')
    pasartab('odeje','odejeC')
    pasartab('odav','odavC')
    pasartab('oddip','odesfera')
    //Funcion para el tab de la fila OI
    pasartab('oiesfera','odcilindro')
    pasartab('oicilindro','odeje')
    pasartab('oieje','odav')
    pasartab('oiav','oddip')
    pasartab('oidip','oiesfera')
    //Funcion para el tab de a fila OD Cerca
    pasartab('odesferaC','oicilindro')
    pasartab('odcilindroC','oieje')
    pasartab('odejeC','oiav')
    pasartab('odavC','oidip')
    
    pasartab('oddipC','btnGu') 
    //Funcion para el tab de la fila OI Cerca
        
    pasartab('oiesferaC','odcilindroC')
    pasartab('oicilindroC','odejeC')
    pasartab('oiejeC','odavC')
    pasartab('oiavC','oddipC')
    pasartab('oidipC','btnGu') 
    //Pasar con tab para los farmacos, unidades y indicaciones
    pasartab('far1','far4')
    pasartab('unid1','unid4')

    pasartab('ind1','far1')
    pasartab('far2','unid1')
    pasartab('unid2','ind1')

    pasartab('ind2','far2')
    pasartab('far3','unid2')
    pasartab('unid3','ind2')
    pasartab('ind3','far3')
    pasartab('far4','unid3')
    pasartab('unid4','ind3')
    //Pasar al cie
    pasartab('txtoi','txtoi')
 }, false);
   function pasartab(inI, inD){
        $('#'+inI).keydown(function (e){
            if(e.which==9){
                $('#'+inD).focus()                
            }
        });    
   }
   //Funcion para confirmar si guardar el registros con enter
function guardart(event) {

    
    if(event.keyCode===13){
           
        var opcion = confirm("Desea guardar la consulta");
        if (opcion) {
            registroConsulta()
        }else{
            alertify.success('Continue registrando los datos')
        }   
    }
};
//Fin de funcion para guardar el registro con enter
//Funcion para confirmar si guardar el registros con click
function guardarEvCl(){
    var opcion= confirm("Desea guardar la consulta");
    if(opcion){
        registroConsulta()
    }else{
        alertify.success('Continue registrando los cambios')
    }
}
//Fin de funcion para guardar el registro con click

function asignarConsulta(id){
    $.ajax({
        url: '',

    });

}
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
    function cargarDia(){//Carga la lista de pacientes del dia
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
    function agregarAtencion(id){//agregar paciente para su consulta
        token = $('#token').val()
        $.ajax({
            url: "Atencion/"+id+"/edit",
            type: 'GET',
            headers:{'X-CSRF-TOKEN': token},
            success: function(data){
                //$('#idan').val(ida)
                $('#nombrePaciente').val(data[0].nombre)
                $('#nhis').val(data[0].dni)
                $('#parentescoP').val(data[0].parentesco)
                $('#edadP').val(data[0].edad)
                $('#Taten').val(data[0].tipo_seguro_id)
                $('#sexoP').val(data[0].sexo)
                $('#telefonoP').val(data[0].telefono)
                $('#direccionP').val(data[0].direccion)
                $('#emailP').val(data[0].email)       
                cantidadConsulta(data[0].id)

            },
            error: function(){
                alertify.error('Ocurrio un error')
            }
        });
    }
    function cargarAtencion(){//Cagra la lista de pacientes del dia
        token=$('#token').val();    
        $.ajax({
            url: "listaAtencion",
            type: "POST",
            headers: {'X-CSRF-TOKEN': token},
            success: function(dato){
                $('#tblListaA').empty().html(dato);
                    
            },
            error: function(){
                alertify.error('Sucedio un error')
            }
        });
    }    
    function CargaPac(id,at,p,nh,ida){       
        token=$('#token').val()
        tAte=$('#Atencio').val(at)
        $('#planMe').val(p)
        if(p=='MEDIDA DE LA VISTA'){
            $('#anm1').val('DEFICIT VISUAL. ACUDE PARA MEDIRSE LA VISTA')
            $('#FonOjo').attr('disabled',true)
            $('#chkTono').attr('disabled',true)
            $('#chkECE').attr('disabled',true)
            $('#EEO').attr('disabled',true)
            $('#chkBlef').attr('disabled',true)
            $('#chkSchirmer').attr('disabled',true)
            $('#chkRefra').attr('checked',true)
            $('#far1').val('CORRECTORES')
        }else{
            $('#anm1').val('')
            $('#FonOjo').attr('disabled',false)
            $('#chkTono').attr('disabled',false)
            $('#chkECE').attr('disabled',false)
            $('#EEO').attr('disabled',false)
            $('#chkBlef').attr('disabled',false)
            $('#chkSchirmer').attr('disabled',false)
            $('#chkRefra').attr('checked',false)            
        }
 
        $.ajax({
            url: "Atencion/"+id+"/edit",
            type: 'GET',
            headers:{'X-CSRF-TOKEN': token},
            success: function(data){

                $('#nombrePaciente').val(data[0].nombre)
                $('#idPaci').val(data[0].id)
                $('#idan').val(ida)
                $('#nhis').val(data[0].dni)
                $('#parentescoP').val(data[0].parentesco)
                $('#edadP').val(data[0].edad)
                $('#Taten').val(at)
                $('#sexoP').val(data[0].sexo)
                $('#telefonoP').val(data[0].telefono)
                $('#direccionP').val(data[0].direccion)
                $('#emailP').val(data[0].email)       
                cantidadConsulta(data[0].id) 
                if(data[0].tipo_seguro_id!=1){
                    verificarTipo(nh) 
                }
                historiasAntes(data[0].id)
            },
            error: function(){
                alertify.error('Ocurrio un error')
            }
        });
    }
    function cantidadConsulta(id){
        $.ajax({
            url: 'cantidadC',
            type: 'get',
            data: {
                id:id
            }, 
            success: function(r){
                $('#hcP').val(r)
            },
            error: function(){
                alertify.error('Error al verificar las consultas')
            }
        });
    }
    //verifica si es particular o rimac
    function verificarTipo(id){
        $.ajax({
            url: "carcomp",
            type: 'get',
            data: {
                id: id                
            },
            success: function(data){
                $('#companiaT').val(data[0].nombre)
            }
        });
    }
    function cargarpdf(nc, idp){
        $.ajax({
            url: 'Consultapdf/'+nc+'/'+idp,
            type: 'get',
            success: function(){
                 
            }
        });
    }
    function listConsulta(){
         token=$('#token').val();    
        $.ajax({
            url: "listaConsulta",
            type: "GET",
            headers: {'X-CSRF-TOKEN': token},
            success: function(dato){
                $('#listConsulta').empty().html(dato);
              
            },
            error: function(){
                alertify.error('Sucedio un error')
            }
        });       
    }
    function registroConsulta(){        
        nc=$('#hcP').val()//Numero de consultas
        ta=$('#Taten').val()//tipo de atencion
        idpac=$('#idPaci').val()//idpaciente
        ida=$('#idan').val()//id de atencion
        //para la tabla datoprevio
        fechaC=$('#fechaC').val()
        te=$('#txtte').val()
        anm1=$('#anm1').val()
        anm2=$('#anm2').val()
        anm3=$('#anm3').val()
        anm4=$('#anm4').val()
        //Para obtener los datos de los signos vitales
        presart=$('#presart').val()
        frecar=$('#frecar').val()
        tempcorp=$('#tempcorp').val()
        peso=$('#peso').val()
        talla=$('#talla').val()
        imc=$('#imc').val()
        //Para obtener los anteces
        antece=$('#antecedente1').val()
        antece1=$('#antecedente2').val()  
        usLen=$('#usLen').val()    
        if(te.length==0){
            te=''
        }else{
            te=te
        }
        if(anm1.length==0){
            anm1=''
        }else{
            anm1=anm1
        }
        if(anm2.length==0){
            anm2=''
        }else{
            anm2=anm2
        }
        if(anm3.length==0){
            anm3=''
        }else{
            anm3=anm3
        }
        if(anm4.length==0){
            anm4=''
        }else{
            anm4=anm4
        }  
        if(antece.length==0){
            antece=''
        }else{
            antece=antece
        }   
        if(antece1.length==0){
            antece1=''
        }else{
            antece1=antece1
        }                                                
        //para la tabla examen1
        odsc=$('#odsc').val()
        oisc=$('#oisc').val()
        odcc=$('#odcc').val()
        oicc=$('#oicc').val()
        odca=$('#odca').val()
        oica=$('#oica').val()
        if(odsc.length==0){
            odsc=''
        }else{
            odsc=odsc
        }        
        if(oisc.length==0){
            oisc=''
        }else{
            oisc=oisc
        }        
        if(odcc.length==0){
            odcc=''
        }else{
            odcc=odcc
        }        
        if(oicc.length==0){
            oicc=''
        }else{
            oicc=oicc
        }        
        if(odca.length==0){
            odca=''
        }else{
            odca=odca
        }        
        if(oica.length==0){
            oica=''
        }else{
            oica=oica
        }                                                        
        //para la tabla examen2
        orbPar=$('#orbPar').val()
        orbPar1=$('#orbPar1').val()
        aparLagr=$('#aparLagr').val()
        conjEsc=$('#conjEsc').val()
        conjEsc1=$('#conjEsc1').val()
        cornea=$('#cornea').val()
        cornea1=$('#cornea1').val()
        camaraAnt=$('#camaraAnt').val()
        irPup=$('#irPup').val()
        campoVi=$('#campoVi').val()
        cristalino=$('#cristalino').val()
        cristalino1=$('#cristalino1').val()
        vitreo=$('#vitreo').val()
        tonometria=$('#tonometria').val()
        od=$('#txtod').val()
        oi=$('#txtoi').val()
        motOcu=$('#motOcu').val()
        motOcu1=$('#motOcu1').val()
        schirmer=$('#schirmer').val()
        but=$('#but').val()
        covertest=$('#covertest').val()
        oftal1=$('#oftal1').val()
        oftal2=$('#oftal2').val()
        oftal3=$('#oftal3').val()
        oftal4=$('#oftal4').val()
        if(orbPar.length==0){
            orbPar=''
        }else{
            orbPar=orbPar
        } 
        if(orbPar1.length==0){
            orbPar1=''
        }else{
            orbPar1=orbPar1
        } 
        if(aparLagr.length==0){
            aparLagr=''
        }else{
            aparLagr=aparLagr
        } 
        if(conjEsc.length==0){
            conjEsc=''
        }else{
            conjEsc=conjEsc
        } 
        if(conjEsc1.length==0){
            conjEsc1=''
        }else{
            conjEsc1=conjEsc1
        } 
        if(cornea.length==0){
            cornea=''
        }else{
            cornea=cornea
        } 
        if(cornea1.length==0){
            cornea1=''
        }else{
            cornea1=cornea1
        } 
        if(camaraAnt.length==0){
            camaraAnt=''
        }else{
            camaraAnt=camaraAnt
        } 
        if(irPup.length==0){
            irPup=''
        }else{
            irPup=irPup
        } 
        if(campoVi.length==0){
            campoVi=''
        }else{
            campoVi=campoVi
        } 
        if(cristalino.length==0){
            cristalino=''
        }else{
            cristalino=cristalino
        } 
        if(cristalino1.length==0){
            cristalino1=''
        }else{
            cristalino1=cristalino1
        } 
        if(vitreo.length==0){
            vitreo=''
        }else{
            vitreo=vitreo
        }        
        if(tonometria.length==0){
            tonometria=''
        }else{
            tonometria=tonometria
        }  
        if(od.length==0){
            od=''
        }else{
            od=od
        }  
        if(oi.length==0){
            oi=''
        }else{
            oi=oi
        }  
        if(motOcu.length==0){
            motOcu=''
        }else{
            motOcu=motOcu
        }  
        if(motOcu1.length==0){
            motOcu1=''
        }else{
            motOcu1=motOcu1
        }     
        if(schirmer.length==0){
            schirmer=''
        }else{
            schirmer=schirmer
        } 
        if(but.length==0){
            but=''
        }else{
            but=but
        } 
        if(covertest.length==0){
            covertest=''
        }else{
            covertest=covertest
        } 
        if(oftal1.length==0){
            oftal1=''
        }else{
            oftal1=oftal1
        } 
        if(oftal2.length==0){
            oftal2=''
        }else{
            oftal2=oftal2
        }  
        if(oftal3.length==0){
            oftal3=''
        }else{
            oftal3=oftal3
        }
        if(oftal4.length==0){
            oftal4=''
        }else{
            oftal4=oftal4
        }                                                                                                                                                                                     
        //para la tabla de diagnostico
        diag1=$('#diag1').val()
        diag2=$('#diag2').val()
        diag3=$('#diag3').val()
        diag4=$('#diag4').val()
        cie1=$('#cie1').val()
        cie2=$('#cie2').val()
        cie3=$('#cie3').val()
        cie4=$('#cie4').val()
        if(diag1=='Seleccionar'){
            diag1=''
        }else{
            diag1=diag1
        }        
        if(diag2=='Seleccionar'){
            diag2=''
        }else{
            diag2=diag2
        }   
        if(diag3=='Seleccionar'){
            diag3=''
        }else{
            diag3=diag3
        }   
        if(diag4=='Seleccionar'){
            diag4=''
        }else{
            diag4=diag4
        }     
        if(cie1=='Seleccionar'){
            cie1=''
        }else{
            cie1=cie1
        }  
        if(cie2=='Seleccionar'){
            cie2=''
        }else{
            cie2=cie2
        }  
        if(cie3=='Seleccionar'){
            cie3=''
        }else{
            cie3=cie3
        }  
        if(cie4=='Seleccionar'){
            cie4=''
        }else{
            cie4=cie4
        }                                                        
        //para la tabla de farmaco
        far1=$('#far1').val()
        far2=$('#far2').val()
        far3=$('#far3').val()
        far4=$('#far4').val()
        if(far1.length==0){
            far1=''
        }else{
            far1=far1
        }     
        if(far2.length==0){
            far2=''
        }else{
            far2=far2
        }     
        if(far3.length==0){
            far3=''
        }else{
            far3=far3
        }     
        if(far4.length==0){
            far4=''
        }else{
            far4=far4
        }
        //para la tabla unidades
        uni1=$('#unid1').val()
        uni2=$('#unid2').val()
        uni3=$('#unid3').val()
        uni4=$('#unid4').val()
        if(uni1.length==0){
            uni1=''
        }else{
            uni1=uni1
        }     
        if(uni2.length==0){
            uni2=''
        }else{
            funi=uni2
        }     
        if(uni3.length==0){
            uni3=''
        }else{
            uni3=uni3
        }     
        if(uni4.length==0){
            uni4=''
        }else{
            uni4=uni4
        } 
        //Para la tabla indicaciones
        ind1=$('#ind1').val()
        ind2=$('#ind2').val()
        ind3=$('#ind3').val()
        ind4=$('#ind4').val()
        if(ind1.length==0){
            ind1=''
        }else{
            ind1=ind1
        }     
        if(ind2.length==0){
            ind2=''
        }else{
            ind2=ind2
        }     
        if(ind3.length==0){
            ind3=''
        }else{
            ind3=ind3
        }     
        if(ind4.length==0){
            ind4=''
        }else{
            ind4=ind4
        }    
        //para la tabla plan medico
        planMe=$('#planMe').val()
        if(planMe.length==0){
            planMe=''
        }else{
            planMe=planMe
        }         
        //para la tabla de refraccion
        odesfera=$('#odesfera').val()
        oiesfera=$('#oiesfera').val()
        odesferaC=$('#odesferaC').val()
        oiesferaC=$('#oiesferaC').val()
        odcilindro=$('#odcilindro').val()
        oicilindro=$('#oicilindro').val()
        odcilindroC=$('#odcilindroC').val()        
        oicilindroC=$('#oicilindroC').val()  
        odeje=$('#odeje').val()
        oieje=$('#oieje').val()
        odejeC=$('#odejeC').val()
        oiejeC=$('#oiejeC').val()
        odav=$('#odav').val()
        oiav=$('#oiav').val()
        odavC=$('#odavC').val()
        oiavC=$('#oiavC').val()
        oddip=$('#oddip').val()
        oidip=$('#oidip').val()
        oddipC=$('#oddipC').val()
        oidipC=$('#oidipC').val()
        procedimientotxt=$('#procedimientotxt').val()
        if(odesfera.length==0){
            odesfera=''
        }else{
            odesfera=odesfera
        }    
        if(oiesfera.length==0){
            oiesfera=''
        }else{
            oiesfera=oiesfera
        }    
        if(odesferaC.length==0){
            odesferaC=''
        }else{
            odesferaC=odesferaC
        }            
        if(odcilindro.length==0){
            odcilindro=''
        }else{
            odcilindro=odcilindro
        }    
        if(oicilindro.length==0){
            oicilindro=''
        }else{
            oicilindro=oicilindro
        }    
        if(odcilindroC.length==0){
            odcilindroC=''
        }else{
            odcilindroC=odcilindroC
        }             
        if(odeje.length==0){
            odeje=''
        }else{
            odeje=odeje
        }    
        if(oieje.length==0){
            oieje=''
        }else{
            oieje=oieje
        }    
        if(odejeC.length==0){
            odejeC=''
        }else{
            odejeC=odejeC
        }           
        if(odav.length==0){
            odav=''
        }else{
            odav=odav
        }    
        if(oiav.length==0){
            oiav=''
        }else{
            oiav=oiav
        }    
        if(odavC.length==0){
            odavC=''
        }else{
            odavC=odavC
        }           
        if(oddip.length==0){
            oddip=''
        }else{
            oddip=oddip
        }  
        if(oidip.length==0){
            oidip=''
        }else{
            oidip=oidip
        }  
        if(oddipC.length==0){
            oddipC=''
        }else{
            oddipC=oddipC
        }                                                                                                                          
        //para la tabla de procedimientos
        if( $('#FonOjo').prop('checked')) {
            FonOjo=$('#FonOjo').val()    
        }else{
            FonOjo=''
        }
        if( $('#chkTono').prop('checked') ) {
            chkTono=$('#chkTono').val()   
        }else{
            chkTono=''
        }     
        if( $('#chkECE').prop('checked') ) {
            chkECE=$('#chkECE').val()   
        }else{
            chkECE=''
        }
        if( $('#EEO').prop('checked') ) {
            EEO=$('#EEO').val()
        }else{
            EEO=''
        }
        if( $('#chkBlef').prop('checked') ) {
            chkBlef=$('#chkBlef').val()
        }else{
            chkBlef=''
        }
        if( $('#chkRefra').prop('checked') ) {
            chkRefra=$('#chkRefra').val()   
        }else{
            chkRefra=''
        }
        if( $('#chkSchirmer').prop('checked') ) {
            chkSchirmer=$('#chkSchirmer').val()  
        }else{
            chkSchirmer=''
        }                                                   
        if(nc.length>0){
            $.ajax({
                url: 'RegistroConsulta',
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                data:{
                    nc:nc,
                    ta:ta,
                    ida:ida,
                    idpac:idpac,
                    //para la tabla datoprevio
                    fechaC:fechaC,
                    te:te,
                    anm1:anm1,
                    anm2:anm2,
                    anm3:anm3,                    
                    anm4:anm4,
                    antece:antece,
                    antece1:antece1,
                    usLen:usLen,
                    //para la tabla signosvitales
                    presart:presart,
                    frecar:frecar,
                    tempcorp:tempcorp,
                    peso:peso,
                    talla:talla,
                    imc:imc,
                    //para la tabla examen1
                    odsc:odsc,
                    oisc:oisc,
                    odcc:odcc,
                    oicc:oicc,
                    odca:odca,
                    oica:oica,
                    //para la tabla examen2
                    orbPar:orbPar,
                    orbPar1:orbPar1,
                    aparLagr:aparLagr,
                    conjEsc:conjEsc,
                    conjEsc1:conjEsc1,
                    cornea:cornea,
                    cornea1:cornea1,
                    camaraAnt:camaraAnt,
                    irPup:irPup,
                    campoVi:campoVi,
                    cristalino:cristalino,
                    cristalino1:cristalino1,
                    vitreo:vitreo,
                    tonometria:tonometria,
                    od:od,
                    oi:oi,
                    motOcu:motOcu,
                    motOcu1:motOcu1,
                    schirmer:schirmer,
                    but:but,
                    covertest:covertest,
                    oftal1:oftal1,
                    oftal2:oftal2,
                    oftal3:oftal3,
                    oftal4:oftal4,
                    //para la tabla de diagnostico
                    diag1:diag1,
                    diag2:diag2,
                    diag3:diag3,
                    diag4:diag4,
                    cie1:cie1,
                    cie2:cie2,
                    cie3:cie3,
                    cie4:cie4,
                    //Procedimientos
                    procedimientotxt:procedimientotxt,
                    //para la tabla de tratamiento
                    far1:far1,
                    far2:far2,
                    far3:far3,
                    far4:far4,
                    //Para la tabla unidades
                    uni1: uni1,
                    uni2: uni2,
                    uni3: uni3,
                    uni4: uni4,
                    //para la tabla indicaciones
                    ind1: ind1,
                    ind2: ind2,
                    ind3: ind3,
                    ind4: ind4,
                    //para la tabla plan medico
                    planMe:planMe,
                    //para la tabla de refraccion
                    odesfera:odesfera,
                    oiesfera:oiesfera,
                    odesferaC:odesferaC,             
                    odcilindro:odcilindro,
                    oicilindro:oicilindro,
                    odcilindroC:odcilindroC,          
                    odeje:odeje,
                    oieje:oieje,
                    odejeC:odejeC,            
                    odav:odav,
                    oiav:oiav,
                    odavC:odavC,
                    oiavC:oiavC,
                    oddip:oddip,
                    oidip:oidip,
                    oddipC:oddipC,
                    //para la tabla de procedimientos
                    FonOjo:FonOjo,
                    chkTono:chkTono,
                    chkECE:chkECE,
                    EEO:EEO,
                    chkBlef:chkBlef,
                    chkRefra:chkRefra,
                    chkSchirmer:chkSchirmer
                },                
                success: function(r){
                    if(r=='Consulta registrada'){
                        alertify.success('Consulta Registrada')
                        $('#frmDato')[0].reset()
                        $('#frmConsulta')[0].reset()                        
                        $('#cie1').val('')
                        $('#diag1').val('')
                        $('#cie2').val('')
                        $('#diag2').val('')                        
                        $('#cie3').val('')
                        $('#diag3').val('')                        
                        $('#cie4').val('')
                        $('#diag4').val('')
                        cargarDia() 

                        //Esta es una opcion
                        window.open('historia/'+nc+'/'+idpac, "Historia Clinica" , "width=750,height=990,scrollbars=NO")                         
                        //window.open('Consultapdf/'+nc+'/'+idpac, '_blank');
                        window.open('Receta/'+idpac+'/'+nc,'Receta de Paciente','location=no, directories=no,width=950,height=800,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');
                        window.open('Refraccion/'+idpac+'/'+nc,'Refraccion del Paciente',' location=no, directories=no,width=950,height=800,left=240,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');       
                        listConsulta()                                                                                     
                    }else{
                        alertify.error('Ocurrio un error en el registro')
                    }
                }, 
                error: function(){
                    alertify.error('Ocurrio un error al registrar la consulta')
                }
            });
        }else{
            alertify.error('No se puede registrar la consulta')            
        }
    }
//Realizar el llenado de acuerdo a la opcion
  function cambiocie(numc){    
    diag=$('#diag'+numc).val() 
    if(diag!='Seleccionar'){
        $.ajax({
          url: 'cambio',
          data:{
            diag: diag,        
          },
          type: 'GET',
          success: function(red){        
            c=$("#cie"+numc).val()
            if(c==red[0].cod_cie){            
            }else{
                $("#cie"+numc).val(red[0].cod_cie).change()
            }        
          }  
        });  
    }
  }
  function cambiodesc(numc){    
    diag=$('#cie'+numc).val()
    if(diag!='Seleccionar'){
        $.ajax({
          url: 'cambio1',
          data:{
            diag: diag,        
          },
          type: 'GET',
          success: function(red){
            
            d=$("#diag"+numc).val()
            if(d==red[0].desc_enf){            
            }else{
                $("#diag"+numc).val(red[0].desc_enf).change()                    
            }
          }
        }); 
    }       
  }
//Funcion que permite capturar la ultima palabra y colocarla en el siguinete input
  function pasarInput(cantidad,inicial, siguiente){
    vl=$('#'+inicial).val();
    c=vl.length
    if(c==cantidad){
        cadena=vl.split(" ")
        $('#'+siguiente).val(cadena.pop())
        $('#'+siguiente).focus()
        nuevo=cadena.join(' ')
        $('#'+inicial).val(nuevo)
        $('#')
    }
  }
//funciona para cargar las historias de cada paciente
function historiasAntes(id){
        token=$('#token').val();    
        $.ajax({
            url: "historiasAntes/"+id,
            type: "GET",
            headers: {'X-CSRF-TOKEN': token},
            success: function(dato){
                $('#campoHistorias').empty().html(dato);
              
            },
            error: function(){
                alertify.error('Sucedio un error')
            }
        });      
}
//Mostrar las historias  "width=595,height=842
function mostrarHistoria(nc,idpac){
    window.open('historia/'+nc+'/'+idpac, "Historia Clinica" , "width=765,height=970,scrollbars=NO")  
}
//Funcion para eliminar pacientes de atencion
function eliminarAtencion(id){
    token=$('#token').val()
    alertify.confirm('Desea quitar este paciente para atencion', function (e){
      if(e){
          $.ajax({
            url:'eliminarAtencion/'+id,
            type:'DELETE',
            headers:{'X-CSRF-TOKEN': token},
            success: function(){
            alertify.error('Paciente retirado para consulta')
            cargarDia()
          },
            error: function (){
              alertify.error('Ocurrio un error no se puede eliminar la consulta')
          }
  
      });
      }
  
    });
  }
  function cambioCie1(v){
    var c=$('#cie'+v).val()
    $.ajax({
            url:'cie1.json',
            method:'get',
            datatype:'json',
            success: function (res){
                for (let i = 0; i < res.length; i++) {
                    //var cad={"num":res[i].num,"codigo":res[i].cod_cie,'nombre':res[i].desc_enf} 
                    if(res[i].cod_cie==c){
                        $('#diag'+v).val(res[i].desc_enf)
                    }
                }

                },
                error: function(re){
                    console.log(re)
                }
            });        
}
function cambioNombre1(v){
    var c=$('#diag'+v).val()
    $.ajax({
            url:'cie1.json',
            method:'get',
            datatype:'json',
            success: function (res){
                for (let i = 0; i < res.length; i++) {
                    //var cad={"num":res[i].num,"codigo":res[i].cod_cie,'nombre':res[i].desc_enf} 
                    if(res[i].desc_enf==c){
                        $('#cie'+v).val(res[i].cod_cie)
                    }
                }

                },
                error: function(re){
                    console.log(re)
                }
            });        
}
  function cargarCie1(){ 
    var cod = new Array()
    var nom = new Array()
        $.ajax({
            url:'cie1.json',
            method:'get',
            datatype:'json',
            success: function (res){
                for (let i = 0; i < res.length; i++) {
                    var cad={"num":res[i].num,"codigo":res[i].cod_cie,'nombre':res[i].desc_enf}
                    cod.push(res[i].cod_cie)
                    nom.push(res[i].desc_enf)   
                    }
                $('#cie1').autocomplete({
                    source: cod,
                    minLength: 2
                })
                $('#cie2').autocomplete({
                    source: cod,
                    minLength: 2
                })
                $('#cie3').autocomplete({
                    source: cod,
                    minLength: 2
                })
                $('#cie4').autocomplete({
                    source: cod,
                    minLength: 2
                })
                $('#diag1').autocomplete({
                    source: nom,
                    minLength: 2
                })
                $('#diag2').autocomplete({
                    source: nom,
                    minLength: 2
                })
                $('#diag3').autocomplete({
                    source: nom,
                    minLength: 2
                })
                $('#diag4').autocomplete({
                    source: nom,
                    minLength: 2
                })
            },
            error: function(re){
                console.log(re)
            }
        });
}

//Funcion para calcular el indice de masa corporal

function IMC(){
    let peso, talla,imc
    peso = $('#peso').val()
    talla= $('#talla').val()

    imc=peso/Math.pow(talla,2)
    var imcd=imc.toFixed(1)
    $('#imc').val(imcd)
}


//Fin de funcion para elininar pacientes de atencion