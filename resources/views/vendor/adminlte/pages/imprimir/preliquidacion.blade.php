<style>
	.p1{
		height: 480px;
		border-bottom: 1px solid black;
		border-top: 1px solid black;
		border-left: 1px solid black;
		border-right: 1px solid black;
		margin-bottom: 30px;
	}
	.p{
		height: 25px;
		border-top: 1px solid #0B0B0B;
		border-left: 1px solid #0B0B0B;
		border-right: 1px solid #0B0B0B;
		border-bottom: 1px solid #0B0B0B;		
	}
	#pli{	
		width: 600px;
		text-align: center;	
		height: 20px;
		border-color: #010101;
	}
	.ayuda{
		width: 45px;
		border-top: 0px;
		border-left: 0px;
		border-bottom: 0px;
		border-right: 0px;
	}
	.ayuda1{
		width: 60px;
		border-top: 0px;
		border-left: 0px;
		border-bottom: 0px;
		border-right: 0px;
	}	
	.aseguradora{
		height: 20px;
		width: 295px;		
		border-color: #010101;
	}
	tr.t td{
		 height: 22px;
		 border-bottom:1px solid black;
		 border-top: 1px solid black;
		 border-left: 1px solid black;
		 border-right: 1px solid black;
	}
	tr.tm td{
		 height: 50px;		 		 
		 border-left: 1px solid black;
		 border-right: 1px solid black;		
	}
	tr#fn td{
		border-bottom: 1px solid black;
	}
	#mf{		
		margin: 0 auto;
		width: 650px;
		text-align: right;
		border-top: 0px;
		border-left: 0px;
		border-right: 0px;
		border-bottom: 0px;		
		height: 20px;	
		left: 50px;
	}
	#ttp{
		border-left: 0px;
		border-bottom: 0px;
		text-align: center;
	}
	#tit{
		width: 650px;
	}
	#trt{
		text-align: center;
	}
	tr.t1 td{
		height: 22px;
		border-left: 1px solid black;
		border-right: 1px solid black;		
	}
	tr.t3 td{
		border-bottom: 1px solid black;
	}
	#hpl{
		font-size: 20px;
		height: 40px;
	}
</style>
	
  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
  
@foreach ($pagos as $p)
	<div class="p1">	
	<br>
	<br>
		<input type="text" class="ayuda">
	<label style="font-family: sans-serif; font-size: 18px;"><strong>BERNARDO GAMARRA BENITES</strong></label><br>
	<input type="text" class="ayuda1"><label style="font-size: 18px; font-family: 'Arial', serif; margin-top: 3px; "><strong>Medico Cirujano - Oftalmologo</strong></label>
	<br>
	<br>
	<table style="margin: 0 auto; border-collapse: collapse;" id="tit">
		
		<tbody>
			<?php 
			$cb=DB::table('costobase')->where('procedimiento','=',$p->plan)->get();
			$cxc=DB::select('select * from compania c, costo_compania cc where cc.id_compania=c.id and c.nombre=:com',['com'=>$p->compania]);			
				$cf=0;
				$cv=0;
				$cppp=0;
			 ?>
			<thead>
				<tr class="t">
					<td colspan="5" style="text-align: center;" id="hpl"><strong>HOJA DE PRE-LIQUIDACION</strong></td>
				</tr>
				<tr class="t">
				<?php 
					$compa=DB::select('select t.nombre_aseguradora, t.ruc from compania c, tipo_seguro t  where c.tipo_seguro_id=t.id and c.nombre=:compania',['compania'=>$p->compania]);
				 ?>	
				 @foreach ($compa as $compa)		
					<td colspan="2" style="text-align: center; width: 180px;">{{$compa->nombre_aseguradora}} </td> 
					<td colspan="3" style="text-align: center;"><strong>RUC:</strong> {{$compa->ruc}}</td>
				 @endforeach		
				</tr>
				<tr class="t">
				<?php 
				$nm=DB::select('select p.nombre from consulta c, paciente p where p.id=c.paciente_id and c.id=:id',['id'=>$p->consulta_id]);
				 ?>
				 	<td colspan="2" style="text-align: center;">{{$p->compania}}</td>
				 	@foreach ($nm as $n)			
					<td colspan="3" style="text-align: center;">{{$n->nombre}}</td>
				 	@endforeach
				</tr>
			</thead>			
			@if($p->plan=='MEDIDA DE LA VISTA')
				<tbody>
				<tr class="t">
					<td style="text-align: center;" colspan="2"></td>
					<td style="text-align: center;" colspan="3"><strong>TOTAL</strong></td>
				</tr>		
				<?php 
					$ccon=0;
					$pgcon=0;
				?>		
				@foreach ($cxc as $cxc)
					@php
						$cf=$cxc->copagoFijo;
						$cv=$cxc->copagoVariable/100;
					@endphp
				@endforeach		
				
					<tr class="t1">
						<td style="width: 250px;" colspan="2" id="trt">
						@if ($p->plan=='CONSULTA')
							CONSULTA AMBULATORIA
						@else
							{{$p->plan}}
						@endif				
						</td>
						@foreach ($cb as $cb)
							@php
								$ccon=$cb->costo;
								$pgcon=$ccon-$cf;
							@endphp		
						@endforeach			
						<td style="text-align:center; width: 20px; " colspan="3">
						S/. {{$ccon}}
						</td>	
					</tr>		
					<tr class="t1">
						<td colspan="2" style="text-align:center;">DEDUCIBLE:</td>
						<td style="text-align:center;" colspan="3">S/. - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<?php 
					$pro=DB::table('procedimientos')->where('consulta_id','=',$p->consulta_id)->get();
					?>			
					<tr class="t1 t3" >
						<?php 
						$pgs=DB::table('pago')->where('consulta_id',$p->consulta_id)->get();
						?>
						@foreach ($pgs as $pgs)
						
						<td colspan="2" id="ttp" class="ttamv" style=" border-bottom: 1px solid black; border-left:1px solid black;"><strong>TOTAL</strong></td>
						<td style="text-align: center; border-top: 1px solid black;" colspan="3">S/. {{$pgs->totalConsulta}} </td>
						@endforeach
					</tr>			
				</tbody>			
			@else
				<tbody>
				<tr class="t">
					<td ></td>
					<td style="text-align: center;"><strong>PRECIO</strong></td>
					<td style="text-align: center;"><strong>DEDUCIBLE</strong></td>
					<td style="text-align: center;"><strong>COASEGURO</strong></td>
					<td style="text-align: center;"><strong>TOTAL</strong></td>
				</tr>		
				<?php 
					$ccon=0;
					$pgcon=0;
				?>		
				@foreach ($cxc as $cxc)
					@php
						$cf=$cxc->copagoFijo;
						$cv=$cxc->copagoVariable/100;
					@endphp
				@endforeach		
				
					<tr class="t">
						<td style="width: 250px;">
						@if ($p->plan=='CONSULTA')
							CONSULTA AMBULATORIA
						@else
							{{$p->plan}}
						@endif				
						</td>
						@foreach ($cb as $cb)
							@php
								$ccon=$cb->costo;
								$pgcon=$ccon-$cf;
							@endphp		
						@endforeach			
						<td style="width: 20px; text-align: center;">
						S/. {{$ccon}}
						</td>		
						<td style="text-align: center;">S/. -{{$cf}}</td>	
						<td style="text-align: center;"></td>
						<td >&nbsp;&nbsp;&nbsp;&nbsp;S/. {{$pgcon}}</td>
					</tr>		
					<tr class="t">
						<td colspan="5" style="background-color: #E9E5E5">PROCEDIMIENTO:</td>
					</tr>
					<?php 
					$pro=DB::table('procedimientos')->where('consulta_id','=',$p->consulta_id)->get();
					?>			
					@foreach ($pro as $pro)
						<?php 
						$cpp=DB::table('costobase')->where('procedimiento','=',$pro->procedimiento)->get();
						?>		 
					<tr class="t">
						@foreach($cpp as $cpp)
						<td>{{$pro->procedimiento}}</td>
						<td>&nbsp;&nbsp;S/. {{$cpp->costo}}</td>
						<td></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S/. -{{$cpp->costo-($cpp->costo*$cv)}} </td>
						<td>&nbsp;&nbsp;S/. {{$cpp->costo*$cv}}</td>
						@endforeach
					</tr>
					@endforeach
					<tr class="t">
						<?php 
						$pgs=DB::select('select sum(deducible) as deducible, sum(costoProcedimiento) as costoPro FROM pago_procedimiento WHERE pago_id=:idc', ['idc'=>$p->id]);
						?>
						@foreach ($pgs as $pgs)
						
						<td colspan="2" id="ttp"><strong>TOTAL A PAGAR</strong></td>
						<td style="color:#7A7878; text-align:center; ">S/. {{$cf}}</td>
						<td style="color: #7A7878; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S/. {{$pgs->deducible}}
						</td>
						<td >&nbsp;&nbsp;S/. {{$pgs->costoPro+$pgcon}} </td>
						@endforeach
					</tr>			
				</tbody>

			@endif
	
	</table><br>
	<?php 
	$anio = substr($p->fechaC, -10, 4);
	$mes = substr($p->fechaC, -5, 2);
	$dia = substr($p->fechaC, -2, 2);
	$mesE='';
	switch ($mes) {
		case '01':
			$mesE='enero';
			break;
		case '02':
			$mesE='febrero';
			break;		
		case '03':
			$mesE='marzo';
			break;
		case '04':
			$mesE='abril';
			break;
		case '05':
			$mesE='mayo';
			break;
		case '06':
			$mesE='junio';
			break;
		case '07':
			$mesE='julio';
			break;
		case '08':
			$mesE='agosto';
			break;									
		case '09':
			$mesE='setiembre';
			break;							
		case '10':
			$mesE='octubre';
			break;
		case '11':
			$mesE='noviembre';
			break;								
		case '12':
			$mesE='diciembre';
			break;			
	}
	$fe='Huaraz, '.$dia.' de '.$mesE.' del '.$anio;
	 ?>
	<input type="text" class="" id="mf" value="{{$fe}}">
	
	</div><br>
	@endforeach
  @else
	<h2>Usuario incorrecto para esta operacion</h2>
  @endif
	