              <table class="table table-bordered  tpp" id="tblListaPago">
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
                    $t1f=0; 
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
                        <a href="#" class="btn btn-danger center-block ac"  onclick="VerPago({{$a->idconsulta}});" ><i class="fa fa-file-text"> Ver</i><input type="hidden" value="{{$a->idc}}" id="idcos"></a>
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
        