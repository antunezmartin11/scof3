@extends('adminlte::layouts.app')
<style>
  .oculto{
    display: none;
  }
</style>
@section('main-content')

  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
    <div class="container-fluid spark-screen">
        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
      <div class="row">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Verificacion de Pagos</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
            </div>              
          </div>
          <div class="box-body">
            <div class="Pagos">
              <div class="pull-right">
                <?php 
                $fechaConsulta=Carbon\Carbon::now()->toDateString();
                $t1f=0;
                 ?>
                <a onclick="mostrarpre('{{$fechaConsulta}}')" class="btn btn-info">Generar Pre-Liquidacion</a>

              </div>
              <div class="pull-left">
                <input type="date" id="fechaPR" class="form-control" value="<?php echo $fechaConsulta; ?>">
              </div>
              <div class="pull-left">
                <?php 
                $fechaConsulta=Carbon\Carbon::now()->toDateString();
                $t1f=0;
                 ?>
                 
                <a onclick="cargarporfecha()" class="btn btn-info">Cargar Datos</a>
  
              </div>
              <br>
              <table class="table table-bordered  tpp reemplazo" id="tblListaPago">
                <thead>
                  <tr>
                    <th>N°H</th>
                    <th>Nombres</th>                     
                    <th>Compania</th>
                    <th>Plan </th>
                    <th class="oculto">F.</th>
                    <th>Ded. Fi</th>
                    <th>Costo</th>                  
                    <th>Procedimiento</th>
                    <th>Ded. Var</th>                  
                    <th>Costo Pro</th>
                    <th>Costo Total</th>                  
                    <th>Guardar</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($a as $a)
                  <tr>                  
                    <td>{{$a->id}} </td>
                    <td>{{$a->nombre}}</td>        
                    <td>{{$a->nombreco}}</td>
                    <td>{{$a->planmedico}}</td>
                    @if($a->planmedico=='MEDIDA DE LA VISTA')
                    <td class="oculto">{{$a->fechacon}}</td>
                    <?php  
                      $cco=DB::select("select * from costo_compania where id_compania=(select id_compania from compania_paciente where id_paciente=:idp)",['idp'=>$a->id]);
                     ?>
                    <td>
                        0
                    </td>                     
                    <td>
                      <?php 
                      $cc=DB::table('costobase')->where('procedimiento','=',$a->planmedico)->get();
                      $totalP=0;
                     ?> 
                     @foreach ($cc as $c2)
                      @foreach ($cco as $c1)
                        @php
                          $totalP=$c2->costo;
                        @endphp
                        {{$c2->costo}}
                      @endforeach
                     @endforeach                                   
                    </td>               
                    <?php 
                    $b=DB::table('procedimientos')->where('consulta_id','=',$a->idc)->get();    
                     ?>
                    <td style="width: 200px;">
                      @foreach ($b as $b)
                                              
                        {{$b->procedimiento}} &nbsp; <a href="#" class="btn btn-sm pull-right" onclick="quitarProcedimiento({{$b->id}})"><i class="fa fa-minus-square" style="background-color: white; color: red;"></i></a> <br>
                      @endforeach
                      <a href="#" class="btn btn-sm center-block" style="color: green; background-color: white;" id="addPro" data-toggle="modal" data-target="#ModalProcedimiento"><i class="fa fa-plus-square" onclick="MostrarProcedimiento({{$a->idc}})"> </i></a>
                    </td>
                    <?php 
                    $b1=DB::table('procedimientos')->where('consulta_id','=',$a->idc)->get();
                     ?>                                    
                    <td>   
                        0
                    </td>                  
                    <td>              
                        0
                    </td>   
                    <td>
                      <?php
                        $tot=$totalP;
                        
                      ?>
                      {{$tot}}
                    </td>     
                        
                    @if($a->estado=="Registrado")  
                      <td>
                        <a href="#" class="btn btn-danger center-block ac"  onclick="VerPago({{$a->idconsulta}})" ><i class="fa fa-file-text"> Ver</i><input type="hidden" value="{{$a->idc}}" id="idcos"></a>
                      </td>
                      @else
                      <td>
                        <a href="#" class="btn btn-success center-block ac"  onclick="RegistroPago('{{$a->nombre_aseguradora}}','{{$a->nombreco}}','{{$a->planmedico}}','{{$totalP}}','{{$a->fechacon}}','{{$a->idc}}','{{$tot}}');" ><i class="fa fa-save"> Guardar</i><input type="hidden" value="{{$a->idc}}" id="idcos"></a>                      
                      </td>
                      @endif
                    @else <!--Fin de condicion si -->
                    <td class="oculto">{{$a->fechacon}}</td>
                    <?php  
                      $cco=DB::select("select * from costo_compania where id_compania=(select id_compania from compania_paciente where id_paciente=:idp)",['idp'=>$a->id]);
                     ?>
                    <td>
                      @foreach ($cco as $c1)
                        {{$c1->copagoFijo}}
                      @endforeach
                    </td>                     
                    <td>
                      <?php 
                      $cc=DB::table('costobase')->where('procedimiento','=',$a->planmedico)->get();
                      $totalP=0;
                     ?> 
                     @foreach ($cc as $c2)
                      @foreach ($cco as $c1)
                        @php
                          $totalP=$c2->costo - $c1->copagoFijo;
                        @endphp
                        {{$c2->costo - $c1->copagoFijo}}
                      @endforeach
                     @endforeach                                   
                    </td>               
                    <?php 
                    $b=DB::table('procedimientos')->where('consulta_id','=',$a->idc)->get();    
                     ?>
                    <td style="width: 200px;">
                      @foreach ($b as $b)
                                              
                        {{$b->procedimiento}} &nbsp; <a href="#" class="btn btn-sm pull-right" onclick="quitarProcedimiento({{$b->id}})"><i class="fa fa-minus-square" style="background-color: white; color: red;"></i></a> <br>
                      @endforeach
                      <a href="#" class="btn btn-sm center-block" style="color: green; background-color: white;" id="addPro" data-toggle="modal" data-target="#ModalProcedimiento"><i class="fa fa-plus-square" onclick="MostrarProcedimiento({{$a->idc}})"> </i></a>
                    </td>
                    <?php 
                    $b1=DB::table('procedimientos')->where('consulta_id','=',$a->idc)->get();
                     ?>                                    
                    <td>   
                      @foreach ($b1 as $b2)
                        <?php 
                        $cp=DB::table('costobase')->where('procedimiento','=',$b2->procedimiento)->get();                
                         $t1=0;
                         $t=0;
                         ?>
                         @foreach($cp as $cp)
                          @foreach ($cco as $ccp)             
                            @php
                              $t=$cp->costo * $ccp->copagoVariable/100;
                              $t1=$t1+$t;
                              $t1f=$t1;
                            @endphp
                          {{$cp->costo * $ccp->copagoVariable/100}} <br>
                          @endforeach
                         @endforeach
                      @endforeach
                    </td>                  
                    <td>  
                       @foreach ($b1 as $b2)
                        <?php 
                        $cp=DB::table('costobase')->where('procedimiento','=',$b2->procedimiento)->get();                
                         ?>
                         @foreach($cp as $cp)
                            @foreach ($cco as $ccp)    
                            {{ $cp->costo - ($cp->costo * $ccp->copagoVariable/100)}} <br>      
                            @endforeach
                          @endforeach                      
                      @endforeach                  
                      
                    </td>   
                    <td id="valorFi">
                      <?php
                        $tot=$totalP + $t1f;
                      ?>
                      {{$tot}}
                    </td>               
                      @if($a->estado=="Registrado")   
                      <td>
                        <a href="#" class="btn btn-danger center-block ac"  onclick="VerPago({{$a->idconsulta}})" ><i class="fa fa-file-text"> Ver</i><input type="hidden" value="{{$a->idc}}" id="idcos"></a>
                      </td>
                      @else
                      <td>
                        <a href="#" class="btn btn-success center-block ac"  onclick="RegistroPago('{{$a->nombre_aseguradora}}','{{$a->nombreco}}','{{$a->planmedico}}','{{$totalP}}','{{$a->fechacon}}','{{$a->idc}}','{{$tot}}');" ><i class="fa fa-save"> Guardar</i><input type="hidden" value="{{$a->idc}}" id="idcos"></a>                      
                      </td>
                      @endif

                    @endif

                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
              <!-- /.box-header -->
              <!-- form start -->
        </div>
      </div>
        
    </div>
    <!--Modal para agregar procedimienos -->
    <div class="modal fade" id="ModalProcedimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Agregar Procedimientos</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4"><input type="hidden" id="i"></div>
            <div class="col-md-4">
              <form action="" id="frmProce">
                <div id="fo">
                  <label for="">Fondo de Ojo</label> <a href="#" class="pull-right" style="background-color: white; color: #2D8CC3;" onclick="AgregarProcedimiento('Fondo de Ojo')"><i class="fa fa-plus-square"></i></a> 
                </div>
                <div id="tonometria">
                  <label for="">Tonometria</label><a href="#" class="pull-right" style="background-color: white; color: #2D8CC3;" onclick="AgregarProcedimiento('Tonometria')"><i class="fa fa-plus-square"></i></a>
                </div>
                <div id="blefaratomia">
                  <label for="">Blefaratomia</label><a href="#" class="pull-right" style="background-color: white; color: #2D8CC3;" onclick="AgregarProcedimiento('Blefaratomia')"><i class="fa fa-plus-square"></i></a>
                </div>
                <div id="schirmer">
                  <label for="">Test de Schirmer</label><a href="#" class="pull-right" style="background-color: white; color: #2D8CC3;" onclick="AgregarProcedimiento('Test de Schirmer')"><i class="fa fa-plus-square"></i></a>              
                </div>
                <div id="exo">
                  <label for="">Examen Externo del Ojo</label> <a href="#" class="pull-right" style="background-color: white; color: #2D8CC3;" onclick="AgregarProcedimiento('Examen Externo del Ojo')"><i class="fa fa-plus-square"></i></a> 
                </div>            
                <div id="extraCE">
                  <label for="">Extraccion CE</label><a href="#" class="  pull-right" style="background-color: white; color: #2D8CC3;" onclick="AgregarProcedimiento('Extraccion CE')"><i class="fa fa-plus-square"></i></a>   
                </div>
                <div id="refraccion">
                  <label for="">Refraccion</label><a href="#" class="pull-right" style="background-color: white; color: #2D8CC3;" onclick="AgregarProcedimiento('Refraccion')"><i class="fa fa-plus-square"></i></a>              
                </div>            
              </form>
            </div>

            <div class="col-md-4"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  @else
  @include('adminlte::errors.503')
  @endif

@endsection             
<script src="{{ asset('js/funcionesPago.js') }}"></script>     
</script>