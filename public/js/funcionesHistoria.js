window.addEventListener('load', function(){
$(document).keydown(function (e){        
        pg=$('#pagina').val()
        if(pg=='Buscar'){
            buscarHtr(e)
        }else if(pg=='Editar'){
            guardart(e)
        }
});     
  cargaruslen()
  cargarCieH(1);
  cargarCieH(2);
  cargarCieH(3);
  cargarCieH(4);
  cargarFarmaco(1)
  cargarFarmaco(2)
  cargarFarmaco(3)
  cargarFarmaco(4)
  cargarUnidad(1)
  cargarUnidad(2)
  cargarUnidad(3)
  cargarUnidad(4)
  cargarIndicacion(1)
  cargarIndicacion(2)
  cargarIndicacion(3)
  cargarIndicacion(4)
  cargarProcess(1)
  cargarProcess(2)
  cargarProcess(3)
  cargarProcess(4)
  cargarProcess(5)
  cargarProcess(6)
  cargarProcess(7)  
 }, false);

function cargaruslen(){
  vl=$('#usl').val();  
  $('#usLen').val(vl).change()
}
function cargarCieH(num){//Funcion que devuelve el cie registrado para la historia
	ci=$('#c'+num).val()
	if(ci!=null){
		$('#cie'+num).val(ci).change()	
	}	
}
function cargarTratamiento(num){//funcion que carga el contenido de un tramatiemto si existe
	tr=$('#tr'+num).val()
	if(tr!=null){
		$('#tra'+num).val(tr)
	}		
}
function cargarFarmaco(num){//funcion que carga si existe un farmaco
	tr=$('#fr'+num).val()
	if(tr!=null){
		$('#far'+num).val(tr)
	}		
}
function cargarUnidad(num){//funcion que carga si existe un farmaco
	tr=$('#un'+num).val()
	if(tr!=null){
		$('#uni'+num).val(tr)
	}		
}
function cargarIndicacion(num){//funcion que carga si existe un farmaco
	tr=$('#in'+num).val()
	if(tr!=null){
		$('#ind'+num).val(tr)
	}		
}
function guardart(event) {//ejecutar la funciona de editar con enter
    if(event.keyCode===13){
        nc=$('#hcP').val()   
        idpac=$('#nhis').val() 
        editarHistoria()      
        c=window.open('../historia/'+nc+'/'+idpac, "Historia Clinica" , "width=750,height=1008,scrollbars=NO")
        a=window.open('../Receta/'+idpac+'/'+nc,'Receta de Paciente','location=no, directories=no,width=620,height=650,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');
        b=window.open('../Refraccion/'+idpac+'/'+nc,'Refraccion del Paciente',' location=no, directories=no,width=595,height=420,left=240,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');                        
    }   
};
function buscarHtr(e){//Ejecuatr la funciona de buscar paciente con enter
    if(e.keyCode===13){
        buscarHistoria()              
    }     
}
function cargarProcess(num){	
	pr=$('#pc'+num).val()
	if(pr!=null){
		switch(pr){
		case 'Fondo de Ojo':			
			$("#FonOjo").prop("checked", true);			
		break
		case 'Tonometria':
			$("#chkTono").prop("checked", true);			
		break
		case 'Extraccion CE':
			$("#chkECE").prop("checked", true);			
		break
		case 'Examen Externo del Ojo':
			$("#EEO").prop("checked", true);			
		break
		case 'Blefaratomia':
			$("#chkBlef").prop("checked", true);			
		break
		case 'Refraccion':
			$("#chkRefra").prop("checked", true);			
		break
		case 'Test de Schirmer':
			$("#chkSchirmer").prop("checked", true);			
		break											
		}		
	}
}
function searchDNI(ndni){
	$.ajax({
		url: 'HistoriaD',
		type:'get',
		data:{
			dni: ndni
		},
		success: function(resp){

			$('#historiasE').empty().html(resp);			
		}, 
		error: function (){
			swal('Ocurrio un error','Metodo de busca por DNI','error')
		}
	});	
}
function buscarHistoria(){
	dni=$('#dniHis').val()
	nomh=$('#nomH').val()
	if(dni.length>=8){
		$('#nombres').empty()
		searchDNI(dni);
	}
	if(nomh.length>1){
		$.ajax({
			url: 'HistoriaN',
			type: 'GET',
			data: {
				nomh: nomh
			},
			success: function(noms){			
                
                $('#nombres').empty().html(noms)
                $('#historiasE').empty()
			},
			error: function (){
				swal('Ocurrio un error','Metodo de busca por Nombres','error')	
			}
		});
	}  
}
function desNom(){  //Desahabilita el campo de nombre cuando esta en el campo DNI
    dni=$('#dniHis').val()
    if(dni.length>1){
        $('#nomH').prop('disabled', true)
    }else{
        $('#nomH').prop('disabled', false)
    }
}
function desDNI(){//Deshabilita el campo DNI cuanto esta en el campo nombre
    nom=$('#nomH').val()
    if(nom.length>1){
        $('#dniHis').prop('disabled', true)
    }else{
        $('#dniHis').prop('disabled', false)
    }
} 
  function cambiocieH(numc){    
    diag=$('#diag'+numc).val()
    $.ajax({
      url: '../cambio',
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
  function cambiodescH(numc){    
    diag=$('#cie'+numc).val()
    $.ajax({
      url: '../cambio1',
      data:{
        diag: diag,        
      },
      type: 'GET',
      success: function(red){
        
        d=$("#diag"+numc).val()
        if(d==red[0].desc_enf){
            console.log('Ya se cambio ')
        }else{
            $("#diag"+numc).val(red[0].desc_enf).change()                    
        }
      }
    });        
  }
function REdit(iDr,diag, n, respActu){
	if(iDr!=null){//verifica la existencia de un registro
	    if(diag!='Seleccionar'){//Verifica que se aya seleccionado un diagnostico
	      idDiag=$('#idcie'+n).val()
	      coCie=$('#cie'+n).val()   
	      	ejecutarActualizacion(diag,coCie,idDiag,function (re){
	      		respActu(re)	      		
	      	});	      	
	    }else{//Si l opcion es seleccionar se tiene que eleiminar el registro
	    	idDiag=$('#idcie'+n).val()   
	    	eliminarDiagnostico(idDiag, function (re3){
	    		respActu(re3)	    		
	    	});
	    }
	}else{//Si no hay registro de diagnostico
		if(diag!='Seleccionar'){//Si se a seleccionado un diagnostico se agrega a la bd			
			idDiag=$('#cie'+n).val()
			idcon=$('#idconsulta').val()
			agregarDiagnostico(diag, idDiag,idcon, function (ag){
				respActu(ag)				
			});
		}
	}
}
function editarDiagnostico(respActu){//Ejecutar la actualizacion de los diagnosticos	
    diag1=$('#diag1').val()
    diag2=$('#diag2').val()
    diag3=$('#diag3').val()
    diag4=$('#diag4').val()
    iR1=$('#idcie1').val()
	iR2=$('#idcie2').val()
    iR3=$('#idcie3').val()
    iR4=$('#idcie4').val()
    REdit(iR1,diag1,1, function(r){ respActu(r)});  
    REdit(iR2,diag2,2, function(r){ respActu(r)});
    REdit(iR3,diag3,3, function(r){ respActu(r)});
    REdit(iR4,diag4,4, function(r){ respActu(r)});
}  

function eliminarDiagnostico(cc, callback){//Elimina el diagnostico
	token=$('#token').val()
	$.ajax({
		url: '../eliminarDiagnostico',
		type: 'POST',
		headers: {'X-CSRF-TOKEN': token},
		data: {
			cc: cc,
		},
		success: function (respuesta){
			callback(respuesta)
		},
		error: function (){
			alertify.error('Ocurrio un error')
		}
	});
}
//Agregar diagnostico en el caso que no se aya registrado anterioemente
function agregarDiagnostico(diag, cie, idc, callback){
	token=$('#token').val()
	$.ajax({
		url: '../AgregarDiagnostico',
		type: 'POST',
		headers: {'X-CSRF-TOKEN': token},
		data: {
			diag: diag,
			cie: cie, 
			idc: idc,
		},
		success: function (respuesta){
			callback(respuesta)
		},
		error: function (){
			alertify.error('Ocurrio un error')
		}
	});
}
//Ejecuta la actualiazcion de acada diagnostico
function ejecutarActualizacion(diag, cie, idcie, callback){    
	
    token=$('#token').val()
	$.ajax({
	    url: '/ActualizarDiagnostico',
	    type: 'POST',
	    headers: {'X-CSRF-TOKEN': token},
	    data:{
	        diag: diag,
	        cie: cie,
	        idcie: idcie,
	    }, 
	    success: function (respt) {    	    	
	    	callback(respt)
	    },
	    error: function () {
	        console.log('el error esta aca')
	    }
	});

}  
//Funcion de actualizar los tratamientos
function ActualizarTratamiento(idt,fr,un,i){
    token=$('#token').val()
	$.ajax({
	    url: '/ActualizarTratamiento',
	    type: 'POST',
	    headers: {'X-CSRF-TOKEN': token},
	    data:{
            fr: fr,
            un:un,
            i:i,
	        idt: idt
	    }, 
	    success: function (respt) {    	    	
	    	console.log(respt.mensaje)
	    },
	    error: function () {
	        console.log('el error esta aca')
	    }
	});	
}
function EliminarTratamiento(idt){ 
    token=$('#token').val()
	$.ajax({
	    url: '/EliminarTratamiento',
	    type: 'POST',
	    headers: {'X-CSRF-TOKEN': token},
	    data:{
	        idt:idt
	    }, 
	    success: function (respt) {    	    	
	    	console.log(respt.mensaje)
	    },
	    error: function () {
	        console.log('el error esta aca')
	    }
	});	
}
function AgregarTratamiento(tra, idc){
    token=$('#token').val()
	$.ajax({
	    url: '/AgregarTratamiento',
	    type: 'POST',
	    headers: {'X-CSRF-TOKEN': token},
	    data:{
	        tra: tra, 
	        idc: idc
	    }, 
	    success: function (respt) {    	    	
	    	console.log(respt.mensaje)
	    },
	    error: function () {
	        console.log('el error esta aca')
	    }
	});	
}
//Determina que accion tomar
function UpdateTratamientos(idt,fr,un,i){   
	if(idt!=null){
		if(fr.length>1){			
            ActualizarTratamiento(idt,fr, un,i)
		}else{
			EliminarTratamiento(idt)
		} 
	}else{
		if(fr.length>1){
			idcon=$('#idconsulta').val()
			AgregarTratamiento(fr,idcon)
		}
	}
}
function UpTra(){//enlace para enviar los parametros y verificar que acciones tomar
	idt1=$('#idt1').val()
	idt2=$('#idt2').val()
	idt3=$('#idt3').val()
	idt4=$('#idt4').val()
	fr1=$('#far1').val()
	fr2=$('#far2').val()
	fr3=$('#far3').val()
    fr4=$('#far4').val()    
    un1=$('#uni1').val()
    un2=$('#uni2').val()
    un3=$('#uni3').val()
    un4=$('#uni4').val()
    in1=$('#ind1').val()
    in2=$('#ind2').val()
    in3=$('#ind3').val()
    in4=$('#ind4').val()
    UpdateTratamientos(idt1,fr1,un1,in1)
    UpdateTratamientos(idt2,fr2,un2,in2)
    UpdateTratamientos(idt3,fr3,un3,in3)
    UpdateTratamientos(idt4,fr4,un4,in4)			
}
function editarHistoria(){
		token=$('#token').val()
		idcon=$('#idconsulta').val()
        nc=$('#hcP').val()        
        ta=$('#Atencio').val()
        idpac=$('#nhis').val()
        ida=$('#ida').val()
        //para la tabla datoprevio
        fechaC=$('#fechaC').val()
        te=$('#txtte').val()
        anm1=$('#anm1').val()
        anm2=$('#anm2').val()
        anm3=$('#anm3').val()
        anm4=$('#anm4').val()
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
        //para la tabla de tratamiento                                     
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
        if(oiesferaC.length==0){
            oiesferaC=''
        }else{
            oiesferaC=oiesferaC
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
        if(oicilindroC.length==0){
            oicilindroC=''
        }else{
            oicilindroC=oicilindroC
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
        if(oiejeC.length==0){
            oiejeC=''
        }else{
            oiejeC=oiejeC
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
        if(oiavC.length==0){
            oiavC=''
        }else{
            oiavC=oiavC
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
        if(oidipC.length==0){
            oidipC=''
        }else{
            oidipC=oidipC
        }     
//incio del ajax
            $.ajax({
                url: '../editHistoria',
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                data:{
                	idcon: idcon,
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
                    //para la tabla plan medico
                    planMe:planMe,
                    //para la tabla de refraccion
                    odesfera:odesfera,
                    oiesfera:oiesfera,
                    odesferaC:odesferaC,
                    oiesferaC:oiesferaC,
                    odcilindro:odcilindro,
                    oicilindro:oicilindro,
                    odcilindroC:odcilindroC,
                    oicilindroC:oicilindroC,
                    odeje:odeje,
                    oieje:oieje,
                    odejeC:odejeC,
                    oiejeC:oiejeC,
                    odav:odav,
                    oiav:oiav,
                    odavC:odavC,
                    oiavC:oiavC,
                    oddip:oddip,
                    oidip:oidip,
                    oddipC:oddipC,
                    oidipC:oidipC
                    //para la tabla de procedimientos
                },                
                success: function(r){
                	if(r=='Actualizado'){
                		editarDiagnostico(function (re1){
                			if(re1=='Actualizado'){
                               /* UpTra(function (r0){
                                    if(r0=='Actualizado'){
                                        swal('Actualizado','Tratamiento Actualizado','success')         
                                    }
                                });   */  
                                
                                swal('Actualizado','Se Guardaron los cambios','success')
                			}else{
                                console.log('No se actualizo el diagnostico')
                                swal('Actualizado','Se Guardaron los cambios','success')
                            }
                		});      
                        UpTra()                   
                	}else{
                		editarDiagnostico(function (re1){
                			if(re1=='Actualizado'){
                				swal('Actualizado','Los cambios se guardaron','success')			
                			}else{
                                alertify.error('No se registraron cambios en el diagnostico')
                            }
                		});  
                        UpTra()
						/*UpTra(function (r0){
							if(r0=='Actualizado'){
								swal('Actualizado','Tratamiento Actualizado','success')			
							}
						}); */                		
                	}
                }, 
                error: function(){
                	swal('Ocurrio un error','Al intentar modificar la historia','error')
                }
            });
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
    }
  }
