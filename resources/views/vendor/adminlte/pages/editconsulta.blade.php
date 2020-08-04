@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection
<style>
  .ctr{
    text-align: center;
    
  }
  #ocultoex{
    border-top: 0px;
    border-left: 0px;
    border-right: 0px;
  }
  #ocultore{
    border-top: 0px;
    border-left: 0px;
    border-right: 0px;
  }  
</style>


@section('main-content')
  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
  <input type="hidden" value="Editar" id="pagina">
    <div class="container-fluid spark-screen">
          <div class="row">
              <div class="col-md-12">
                   <a class="btn btn-danger btn-sm"><i class="fa fa-save" onclick="editarHistoria()"> Guardar</i></a>
              </div>
          </div>
      <div class="row">
        <div class="col-md-12">
    @foreach($historia as $h)
      
    @endforeach      
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar Consultas</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <form action="" class="form-horizontal" id="frmDato">
              <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
              <input type="hidden" id="idconsulta" value="{{$h->idc}}">
                <div class="form-group">
                  <label class="col-md-1">Nombre:</label>
                  <div class="col-md-5">
                      <input type="text" class="form-control input-sm" disabled id="nombrePaciente" style="text-transform:uppercase;" value="{{$h->nombre}} ">
                  </div>
                  <label class="col-md-1">Parentesco</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm ctr" disabled id="parentescoP" style="text-transform:uppercase;" value="{{$h->parentesco}} ">
                  </div>
                  <label class="col-md-1">HC:</label>
                  <div class="col-md-1">
                    <input type="text" class="form-control input-sm ctr" disabled id="nhis" style="text-transform:uppercase;" value="{{$h->idp}} ">                  
                  </div>

                </div>
                <div class="form-group">
                  <label class="control-label col-md-1">Atencion</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" disabled id="Taten" style="text-transform:uppercase;" value="{{$h->atencion}} ">
                  </div>
                  <label class="control-label col-md-1">Sexo</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm ctr" disabled id="sexoP" style="text-transform:uppercase;" value="{{$h->sexo}} ">
                  </div>
                  <label class="control-label col-md-1">Edad</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm ctr" disabled id="edadP" value="{{$h->edad}} ">
                  </div>
                  <label class="control-label col-md-1">Telefono:</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm ctr" disabled id="telefonoP" value="{{$h->telefono}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-1">Direccion:</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control input-sm ctr" disabled  style="text-transform:uppercase;" id="direccionP" value="{{$h->direccion}}">              
                  </div>
                  <label  class="control-label col-md-1">Compañia</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm ctr" disabled style="text-transform:uppercase;" id="companiaT">
                  </div>
                  <label  class="control-label col-md-1">E-mail</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control input-sm ctr" disabled id="emailP" style="text-transform:uppercase;" value="{{$h->email}}">
                  </div>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Examen Clinico del Paciente</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <form action="" class="form-horizontal" id="frmConsulta">
                <div class="form-group">
                  <label class="control-label col-md-1">N°Consulta</label>
                  <div class="col-md-1">
                    <input type="text" class="form-control input-sm ctr" disabled id="hcP" value="{{$h->nconsulta}} ">
                  </div>
                  <label  class="control-label col-md-1">Fecha</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm ctr" value="{{$h->fechacon}}" id="fechaC">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-1">T.E:</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" id="txtte" name="txtte" style="text-transform:uppercase;" value="{{$h->te}} " maxlength="120">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-1">Anamnesis</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" id="anm1" name="anm1" style="text-transform:uppercase;" value="{{$h->anamnesis1}} " maxlength="108" onkeyup="pasarInput(108,'anm1','anm2')">
                    <input type="text" class="form-control input-sm" id="anm2" name="anm2" style="text-transform:uppercase;" value="{{$h->anamnesis2}} " maxlength="120" onkeyup="pasarInput(120,'anm2','anm3')">   
                    <input type="text" class="form-control input-sm" id="anm3" name="anm3" style="text-transform:uppercase;" value="{{$h->anamnesis3}}" maxlength="120" onkeyup="pasarInput(120,'anm3','anm4')">
                    <input type="text" class="form-control input-sm" id="anm4" name="anm4" style="text-transform:uppercase;" value="{{$h->anamnesis4}}" maxlength="120">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-1">Antecedentes:</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" id="antecedente1" name="antecedente1" style="text-transform:uppercase;" value="{{$h->antecedentes1}} " maxlength="105" onkeyup="pasarInput(105,'antecedente1','antecedente2')">
                    <input type="text" class="form-control input-sm" id="antecedente2" name="antecedente2" style="text-transform:uppercase;" value="{{$h->antecedentes2}} " maxlength="90">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-1">P. Medico</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="planMe" name="planMe" disabled value="{{$h->planmedico}}">
                  </div>
                  <label class="control-label col-md-1">Usa Lente</label>
                  <div class="col-md-1">
                    <input type="hidden" id="usl" value="{{$h->usalentes}}">
                    <select  class="form-control input-sm" id="usLen" name="usLen">
                      <option value="SI">Si</option>
                      <option value="NO">No</option>
                    </select>
                  </div>
                </div>  
                <div class="form-group">
                  <label  class="control-label col-md-1">Procedimiento</label>
                  <div class="col-md-1">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="Fondo de Ojo" id="FonOjo" name="FonOjo">
                        Fondo de Ojo
                      </label>
                    </div>                   
                  </div>
                  <div class="col-md-1">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="Tonometria" id="chkTono" name="chkTono">
                        Tonometria
                      </label>
                    </div>                       
                  </div>
                  <div class="col-md-1">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="Extraccion CE" id="chkECE" name="chkECE">
                        Extraccion CE
                      </label>
                    </div>                       
                  </div>
                  <div class="col-md-2">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="Examen Externo del Ojo" id="EEO" name="EEO">
                        Examen Externo del Ojo
                      </label>
                    </div>                       
                  </div>
                  <div class="col-md-1">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="Blefaratomia" id="chkBlef" name="chkBlef">
                        Blefaratomia
                      </label>
                    </div>                       
                  </div>
                  <div class="col-md-1">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="Refraccion" id="chkRefra" name="chkRefra">
                        Refraccion
                      </label>
                    </div>                       
                  </div>
                  <div class="col-md-1">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="Test de Schirmer" id="chkSchirmer">
                        Schirmer
                      </label>
                    </div>                       
                  </div>                                
                </div>
                <div class="form-group">
                  <label class="control-label col-md-1">Examen</label>
                  <div class="col-md-8">
                    <div class="col-md-3">
                      <input type="text" class="form-control input-sm" id="ocultoex" disabled >  
                      <input type="text" class="form-control input-sm" style="text-transform:uppercase; text-align: center;" disabled value="OJO DERECHO">
                      <input type="text" class="form-control input-sm" style="text-transform:uppercase; text-align: center;" disabled value="OJO IZQUIERDO">
                    </div>
                    <div class="col-md-2">
                      <input type="text" class="form-control input-sm" style="text-transform:uppercase; text-align: center;" disabled value="SC">  
                      <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="odsc" name="odsc" value="{{$h->odsc}} ">
                      <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="oisc" name="oisc" value="{{$h->oisc}} ">
                    </div>    
                    <div class="col-md-2">
                      <input type="text" class="form-control input-sm" style="text-transform:uppercase; text-align: center;" disabled value="CC">  
                      <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="odcc" value="{{$h->odcc}} ">
                      <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="oicc" value="{{$h->oicc}}">
                    </div>
                    <div class="col-md-2">
                      <input type="text" class="form-control input-sm" style="text-transform:uppercase; text-align: center;" disabled value="CA">  
                      <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="odca" value="{{$h->odca}} ">
                      <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="oica" value="{{$h->oica}} ">
                    </div>                  
                  </div>
                </div>   
                <div class="form-group">
                  <label class="control-label col-md-1">Orbitas y Parpados</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="orbPar" name="orbPar" value="{{$h->orbitasparpados}}" maxlength="100" onkeyup="pasarInput(100,'orbPar','orbPar1')">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="orbPar1" name="orbPar1" value="{{$h->orbitasparpados1}} " maxlength="120">
                  </div>
                </div>    
                <div class="form-group">
                  <label class="control-label col-md-1">Aparato Lagrimal</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="aparLagr" name="aparLagr" value="{{$h->aparatolagrimal}} " maxlength="103">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-1">Conjuntiva y Esclera</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="conjEsc" name="conjEsc" value="{{$h->conjuntivaesclera}}" maxlength="95" onkeyup="pasarInput(95,'conjEsc','conjEsc1')">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="conjEsc1" name="conjEsc1" value="{{$h->conjuntivaesclera1}} " maxlength="120">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-1">Cornea</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="cornea" name="cornea" value="{{$h->cornea}} " maxlength="110" onkeyup="pasarInput(110,'cornea','cornea1')">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="cornea1" name="cornea1" value="{{$h->cornea1}} " maxlength="120">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-1">Camara</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="camaraAnt" name="camaraAnt" value="{{$h->camaraanterior}} " maxlength="110">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-1">Iris y Pupila</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="irPup" name="irPup" value="{{$h->irispupila}}" maxlength="105">
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-md-1">Cristalino</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="cristalino" name="cristalino" value="{{$h->cristalino}} " maxlength="108" onkeyup="pasarInput(108,'cristalino','cristalino1')">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="cristalino1" name="cristalino1" value="{{$h->cristalino1}} " maxlength="120">
                  </div>
                </div>   
                <div class="form-group">
                  <label class="control-label col-md-1">Vitreo</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="vitreo" name="vitreo" value="{{$h->vitreo}} " maxlength="112">
                  </div>
                </div>  
                <div class="form-group">
                  <label class="control-label col-md-1">Motilidad Ocular</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="motOcu" name="motOcu" value="{{$h->motilidadocular}} " maxlength="103" onkeyup="pasarInput(103,'motOcu','motOcu1')">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="motOcu1" name="motOcu1" value="{{$h->motilidadocular1}} " maxlength="120">
                  </div>
                </div>   
                <div class="form-group">
                  <label class="control-label col-md-1">Schirmer</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="schirmer" name="schirmer" value="{{$h->testschirmer}} ">
                  </div>
                  <label class="control-label col-md-1">B.U.T</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="but" name="but" value="{{$h->but}} ">
                  </div>                
                  <label class="control-label col-md-1">Cover Test</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="covertest" name="covertest" value="{{$h->covertest}} " maxlength="80">
                  </div>                
                </div>   
                <div class="form-group">
                  <label class="control-label col-md-1">Oftalmoscopia</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="oftal1" name="oftal1" value="{{$h->oftalmoscopia1}}" maxlength="105" onkeyup="pasarInput(105,'oftal1','oftal2')">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="oftal2" name="oftal2" value="{{$h->oftalmoscopia2}}" maxlength="120" onkeyup="pasarInput(120,'oftal2','oftal3')">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="oftal3" name="oftal3" value="{{$h->oftalmoscopia3}}" maxlength="120" onkeyup="pasarInput(120,'oftal3','oftal4')">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="oftal4" name="oftal4" value="{{$h->oftalmoscopia4}}" maxlength="120">
                  </div>
                </div>    
                <div class="form-group">
                  <label class="control-label col-md-1">Campo Visual</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="campoVi" name="campoVi" value="{{$h->campovisual}} " maxlength="103">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-1">Tonometria</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="tonometria" name="tonometria" value="{{$h->tonometria}} ">
                  </div>
                  <label class="control-label col-md-1">OD</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="txtod" name="txtod" value="{{$h->od}} ">
                  </div>
                  <label class="control-label col-md-1">OI</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="txtoi" name="txtoi" value="{{$h->oi}} "> 
                  </div>                                
                </div>    
                <div class="form-group">
                  <label class="control-label col-md-1">Diagnostico</label>
                  <div class="col-md-7">
                    <?php 
                     $cie=DB::table('cie')->where('cod_cat','like','%h%')->get();

                     $di=DB::select('SELECT (@rownum:=@rownum+1) AS rownum, d.* from (SELECT @rownum:=0) r, diagnostico d where d.consulta_id=:idc',['idc'=>$h->idc]);
                     $tr=DB::select('SELECT (@rownum:=@rownum+1) AS rownumt, t.* from (SELECT @rownum:=0) r, farmaco t where t.consulta_id=:idc',['idc'=>$h->idc]);   
                     $pc=DB::select('SELECT (@rownum:=@rownum+1) AS rownump, pc.* from (SELECT @rownum:=0) r, procedimientos pc where pc.consulta_id=:idc',['idc'=>$h->idc]);                
                     ?>
                     @foreach ($di as $g)
                      <input type="hidden" value="{{$g->cie}}" id="c{{$g->rownum}}">
                      <input type="hidden" value="{{$g->id}}" id="idcie{{$g->rownum}}">
                     @endforeach
                     @foreach ($tr as $tr)
                      <input type="hidden" value="{{$tr->farmaco}}" id="fr{{$tr->rownumt}}">
                      <input type="hidden" value="{{$tr->unidad}}" id="un{{$tr->rownumt}}">
                      <input type="hidden" value="{{$tr->indicaciones}}" id="in{{$tr->rownumt}}">
                      <input type="hidden" value="{{$tr->id}}" id="idt{{$tr->rownumt}}">
                     @endforeach
                     @foreach ($pc as $pc)
                      <input type="hidden" value="{{$pc->procedimiento}}" id="pc{{$pc->rownump}}">
                     @endforeach
                     <select name="diag1" id="diag1" class="form-control select2" style="width: 100%;" onchange="cambiocieH(1);">
                      <option value="Seleccionar">Seleccionar</option>
                     @foreach($cie as $c)                  
                      <option value="{{$c->desc_enf}}">{{$c->desc_enf}}</option>                  
                    @endforeach
                    </select>
                     <select name="diag2" id="diag2" class="form-control select2" style="width: 100%;" onchange="cambiocieH(2);">
                      <option value="Seleccionar">Seleccionar</option>
                     @foreach($cie as $c)                  
                      <option value="{{$c->desc_enf}}">{{$c->desc_enf}}</option>                  
                    @endforeach
                    </select>                  
                     <select name="diag3" id="diag3" class="form-control select2" style="width: 100%;" onchange="cambiocieH(3);">
                      <option value="Seleccionar">Seleccionar</option>
                     @foreach($cie as $c)                  
                      <option value="{{$c->desc_enf}}">{{$c->desc_enf}}</option>                  
                    @endforeach
                    </select>
                     <select name="diag4" id="diag4" class="form-control select2" style="width: 100%;" onchange="cambiocieH(4);">
                      <option value="Seleccionar">Seleccionar</option>
                     @foreach($cie as $c)                  
                      <option value="{{$c->desc_enf}}">{{$c->desc_enf}}</option>                  
                    @endforeach
                    </select>                                                                        
                  </div>
                  <label class="control-label col-md-1">CIE</label>
                  <div class="col-md-2">
                     <select name="cie1" id="cie1" class="form-control select2" style="width: 100%;" onchange="cambiodescH(1);">
                      <option value="Seleccionar">Seleccionar</option>
                     @foreach($cie as $c)                  
                      <option value="{{$c->cod_cie}}">{{$c->cod_cie}}</option>                  
                    @endforeach
                    </select>  
                     <select name="cie2" id="cie2" class="form-control select2" style="width: 100%;" onchange="cambiodescH(2);">
                      <option value="Seleccionar">Seleccionar</option>
                     @foreach($cie as $c)                  
                      <option value="{{$c->cod_cie}}">{{$c->cod_cie}}</option>                  
                    @endforeach
                    </select>  
                     <select name="cie3" id="cie3" class="form-control select2" style="width: 100%;" onchange="cambiodescH(3);">
                      <option value="Seleccionar">Seleccionar</option>
                     @foreach($cie as $c)                  
                      <option value="{{$c->cod_cie}}">{{$c->cod_cie}}</option>                  
                    @endforeach
                    </select>  
                     <select name="cie4" id="cie4" class="form-control select2" style="width: 100%;" onchange="cambiodescH(4);">
                      <option value="Seleccionar">Seleccionar</option>
                     @foreach($cie as $c)                  
                      <option value="{{$c->cod_cie}}">{{$c->cod_cie}}</option>                  
                    @endforeach
                    </select>                                                                           
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-md-1">Farmaco</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="far1" name="far1" autocomplete="on">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="far2" name="far2" autocomplete="on">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="far3" name="far3" autocomplete="on">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="far4" name="far4" autocomplete="on">
                  </div>
                  <label class="control-label col-md-1">Unidades</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="uni1" name="uni1" autocomplete="on">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="uni2" name="uni2">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="uni3" name="uni3">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="uni4" name="uni4">
                  </div>
                  <label class="control-label col-md-1">Indicaciones</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="ind1" name="ind1" autocomplete="on">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="ind2" name="ind2">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="ind3" name="ind3">
                    <input type="text" class="form-control input-sm" style="text-transform:uppercase;" id="ind4" name="ind4">
                  </div>

                </div>  
                <div class="form-group">
                  <label for="" class="control-label col-md-1">Refraccion</label>
                  <div class="col-md-1">
                    <input type="text" class="form-control input-sm " id="ocultore" disabled>        
                    <input type="text" class="form-control input-sm" disabled value="OD" style="text-align: center;" >
                    <input type="text" class="form-control input-sm" disabled value="OI" style="text-align: center;">
                    <input type="text" class="form-control input-sm" disabled value="OD Cerca">
                    <input type="text" class="form-control input-sm" disabled value="OI Cerca">                                     
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" disabled value="ESFERA" style="text-align: center;">
                    <input type="text" class="form-control input-sm" id="odesfera" name="odesfera" value="{{$h->odesfera}} ">
                    <input type="text" class="form-control input-sm" id="oiesfera" name="oiesfera" value="{{$h->oiesfera}}">
                    <input type="text" class="form-control input-sm" id="odesferaC" name="odesferaC" value="{{$h->odesferaC}}">
                    <input type="text" class="form-control input-sm" id="oiesferaC" name="oiesferaC" value="{{$h->oiesferaC}}">                             
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" disabled value="CILINDRO" style="text-align: center;">
                    <input type="text" class="form-control input-sm" id="odcilindro" name="odcilindro" value="{{$h->odcilindro}} ">
                    <input type="text" class="form-control input-sm" id="oicilindro" name="oicilindro" value="{{$h->oicilindro}} " >
                    <input type="text" class="form-control input-sm" id="odcilindroC" name="odcilindroC" value="{{$h->odcilindroC}} ">
                    <input type="text" class="form-control input-sm" id="oicilindroC" name="oicilindroC" value="{{$h->oicilindroC}} ">                             
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" disabled value="EJE" style="text-align: center;">
                    <input type="text" class="form-control input-sm" id="odeje" name="odeje" value="{{$h->odeje}}">
                    <input type="text" class="form-control input-sm" id="oieje" name="oieje" value="{{$h->oieje}}">
                    <input type="text" class="form-control input-sm" id="odejeC" name="odejeC" value="{{$h->odejeC}}">
                    <input type="text" class="form-control input-sm" id="oiejeC" name="oiejeC" value="{{$h->oiejeC}}">                   
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" disabled value="AV" style="text-align: center;">
                    <input type="text" class="form-control input-sm" id="odav" name="odav" value="{{$h->odav}}">
                    <input type="text" class="form-control input-sm" id="oiav" name="oiav" value="{{$h->oiav}}">
                    <input type="text" class="form-control input-sm" id="odavC" name="odavC" value="{{$h->odavC}}">
                    <input type="text" class="form-control input-sm" id="oiavC" name="oiavC" value="{{$h->oiavC}}">                             
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" disabled value="DIP" style="text-align: center;">
                    <input type="text" class="form-control input-sm" id="oddip" name="oddip" value="{{$h->oddip}}">
                    <input type="text" class="form-control input-sm" id="oidip" name="oidip" value="{{$h->oidip}}">
                    <input type="text" class="form-control input-sm" id="oddipC" name="oddipC" value="{{$h->oddipC}}">
                    <input type="text" class="form-control input-sm" id="oidipC" name="oidipC" value="{{$h->oidipC}}">                             
                  </div>                                
                </div>            
              </form>
            </div>
            <!-- /.box-body -->
          </div>     
       
          <!-- /.box -->
        <div id="upload-img" style="display: none;"></div>
        </div>
      </div>
      <div class="row">
        <div id="historia">
          
        </div>
      </div>
    </div>
  @else
    @include('adminlte::errors.503')
  @endif  
<!--Incio modal de Lista de Paciente para antencion -->

@endsection
<script src="{{ asset('js/funcionesHistoria.js') }}"></script>  
<script src="{{ asset('js/validar.js') }}"></script> 

<script>



</script>