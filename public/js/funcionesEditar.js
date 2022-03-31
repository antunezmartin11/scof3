window.addEventListener('load', function(){
    $(document).keydown(function (e){        
            pg=$('#pagina').val()
            if(pg=='Buscar'){
                buscarHtr(e)
            }else if(pg=='Editar'){
                guardart(e)
            }
    }); 
    cargarCie1()
}, false)
function guardart(event) {//ejecutar la funciona de editar con enter
    if(event.keyCode===13){
        nc=$('#hcP').val()   
        idpac=$('#nhis').val() 
        editarHistoria()                       
    }   
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
    procedimiento=$('#procedimientotxt').val()
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
    if(procedimiento.length==0){
        procedimientotxt=''
    }else{
        procedimiento=procedimiento
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
    odcilindro=$('#odcilindro').val()
    oicilindro=$('#oicilindro').val()
    odcilindroC=$('#odcilindroC').val()        
    odeje=$('#odeje').val()
    oieje=$('#oieje').val()
    odejeC=$('#odejeC').val()
    odav=$('#odav').val()
    oiav=$('#oiav').val()
    odavC=$('#odavC').val()
    oddip=$('#oddip').val()
    oidip=$('#oidip').val()
    oddipC=$('#oddipC').val()
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
                procedimiento: procedimiento,
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
                oddip:oddip,
                oidip:oidip,
                oddipC:oddipC,
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

                        }else{
                            //console.log('No se actualizo el diagnostico')

                        }
                        
                    });     
                    UpTra(function(re){
                        if(re=='Actualizado'){

                        }
                    }) 
                    swal('Actualizado','Se Guardaron los cambios','success')
                        
                    c=window.open('../historia/'+nc+'/'+idpac, "Historia Clinica" , "width=750,height=990,scrollbars=NO")
                    a=window.open('../Receta/'+idpac+'/'+nc,'Receta de Paciente','location=no, directories=no,width=950,height=800,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');
                    b=window.open('../Refraccion/'+idpac+'/'+nc,'Refraccion del Paciente',' location=no, directories=no,width=950,height=800,left=240,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');                     
                }else{
                    editarDiagnostico(function (re1){
                        if(re1=='Actualizado'){
                                UpTra(function(re){
                                    if(re=='Actualizado'){
                                        swal('Actualizado','Se Guardaron los cambios','success')
                                        c=window.open('../historia/'+nc+'/'+idpac, "Historia Clinica" , "width=750,height=990,scrollbars=NO")
                                        a=window.open('../Receta/'+idpac+'/'+nc,'Receta de Paciente','location=no, directories=no,width=950,height=800,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');
                                        b=window.open('../Refraccion/'+idpac+'/'+nc,'Refraccion del Paciente',' location=no, directories=no,width=950,height=800,left=240,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');     
                                    }else{
                                        swal('Actualizado','Se Guardaron los cambios','success')
                                        c=window.open('../historia/'+nc+'/'+idpac, "Historia Clinica" , "width=750,height=990,scrollbars=NO")
                                        a=window.open('../Receta/'+idpac+'/'+nc,'Receta de Paciente','location=no, directories=no,width=950,height=800,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');
                                        b=window.open('../Refraccion/'+idpac+'/'+nc,'Refraccion del Paciente',' location=no, directories=no,width=950,height=800,left=240,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');    
                                    }
                                })                    
                        }else{
                            UpTra(function(re){
                                if(re=='Actualizado'){
                                    swal('Actualizado','Se Guardaron los cambios','success')
                                    c=window.open('../historia/'+nc+'/'+idpac, "Historia Clinica" , "width=750,height=990,scrollbars=NO")
                                    a=window.open('../Receta/'+idpac+'/'+nc,'Receta de Paciente','location=no, directories=no,width=950,height=800,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');
                                    b=window.open('../Refraccion/'+idpac+'/'+nc,'Refraccion del Paciente',' location=no, directories=no,width=950,height=800,left=240,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');     
                                }else{
                                    alertify.error('No se registraron cambios')
                                }
                            })                               
                            
                        }
                    });  
                    
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
function cargarCie1(){ 
    var cod = new Array()
    var nom = new Array()
        $.ajax({
            url:'/json/cie1.json',
            method:'get',
            datatype:'json',
            success: function (res){
                for (let i = 0; i < res.length; i++) {
                    var cad={"num":res[i].num,"codigo":res[i].cod_cie,'nombre':res[i].desc_enf}
                    cod.push(res[i].cod_cie)
                    nom.push(res[i].desc_enf)   
                    }
                    console.log(res)
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