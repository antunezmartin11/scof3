<style>

	#nombre{		
		
	}
	.di{
		position: static;
		width: 340px;		
		height: 13px;
		text-align: left;
		left: -20px;
		border: 0px;
	}
	.ci{
		
		height: 13px;
		width: 115px;
		text-align: center;
		border: 0px;
	}
	.farmaco{
		border: 0px;
		width: 180px;
		height: 70px;
	}
	.unidad{
		border: 0px;
		width: 70px;
		height: 60px;
		text-align: center;
	}
	.indicacion{
		border: 0px;
		width: 200px;
		height: 70px;
	}
	#fe{		
		position: absolute;
		bottom: 330px;
		border: 0px;
	}
	tr.r td{
		 height: 20px;
		 font-size: 14px;
		 border-bottom:1px solid black;
		 border-top: 1px solid black;
		 border-left: 1px solid black;
		 border-right: 1px solid black;
	}	
	.rect{
		 
		 width: 500px;
		 height: 700px;	
		 font-size: 24px;	
	}
	.tb{
		width: 900px;
	}
	.di{
		height: 5px;
	}
	#fecha{
		position: absolute;
		top: 41%;
		left: 12%;
	}
	#etFecha{
		position: absolute;
		top: 43%;
		left: 10%;
		text-align: center;
		width: 110px;
		border-right: 0px;
		border-left: 0px;
		border-bottom: 0px;
		border-top: 1px dashed black;
		font-weight: bold;
	}	
	#sello{
		position: absolute;
		top: 43%;
		left: 50%;
		text-align: center;
		width: 320px;
		border-right: 0px;
		border-left: 0px;
		border-bottom: 0px;
		border-top: 1px dashed black;
		font-weight: bold;			
	}
	#linea{
		border-bottom-style: double solid black;
		border-top-style: double;
		border-top: 5px;
		border-right: 0px;
		border-left: 0px;
		height: 10px;

	}
	#footr{
		position: absolute;
		top: 45%;
	}
	#lineaF{

	}
	#imgfirma{
		top:470px;
		position: absolute;
		left: 520px;
		height: 100px;
		width: 250px; 
	}
</style>
  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
	@foreach ($con as $c)
		<?php 
			$idc=$c->idcon;
			$diag=DB::table('diagnostico')->where('consulta_id','=',$idc)->get();
			$tra=DB::table('farmaco')->where('consulta_id','=',$idc)->get();
		 ?>
			<div class="rect">
				
				<table class="tb" style="margin: 0 auto; ">
					<thead>
					<tr>
						<td style="text-align: center; font-size: 40px; font-family: 'Brush Script MT'; font-style: oblique; letter-spacing: 1px;"><strong>Bernardo Gamarra Benites</strong></td>
					</tr>
					<tr>
						<td style="text-align: center; letter-spacing: 1px;">MEDICO - CIRUJANO</td>		
					</tr>
					<tr>
						<td style="text-align: center; letter-spacing: 1px;">OFTALMOLOGO</td>					
					</tr>
					<tr>
						<td style="text-align: center; letter-spacing: 1px;">C.M.P. 26802 - R.N.E. 15639</td>
					</tr>	
					<tr>
						<td style="border-bottom: 5px solid black; border-top: 1px solid black; height: 8px;"></td>
					</tr>				
					</thead>				
				</table>


				<table class="tb" style="margin: 0 auto; border-collapse: collapse;">				
					<tbody>
						<tr class="r" style="width: 400px;">
							<td style="text-align: center; font-size:14px;"><strong>APELLIDOS Y NOMBRES</strong></td>
						</tr>
						<tr class="r">
							<td style="text-align: center;">{{$c->nombre}} </td>
						</tr>						
					</tbody>			
				</table>
				<table class="tb" style="margin: 0 auto; border-collapse: collapse; margin-top:5px;">
					<thead>
						<tr class="r">
							<td style="width: 80%; text-align: center;"><strong>DIAGNOSTICO</strong></td>
							<td style="text-align: center;"><strong>CIE 10</strong></td>
						</tr>
					</thead>
					<tbody>
						@foreach($diag as $d)		
						<tr class="r">
							<td style="height: 20px;">{{$d->diagnostico}}</td>
							<td style="height: 20px; text-align: center;">{{$d->cie}}</td>
						</tr>
						@endforeach
					</tbody>
				</table><br>
				<label style="font-size: 20px;"><strong>RP.-</strong></label>
				<table style="margin: 0 auto; border-collapse: collapse;" class="tb">
					<thead>
						<tr class="r">
							<td style="text-align: center; width: 50%;"><strong>FARMACO</strong></td>
							<td style="text-align: center; width: 10%;"><strong>UNIDADES</strong></td>
							<td style="text-align: center; width: 30%;"><strong>INDICACIONES</strong></td>
						</tr>
					</thead>
					<tbody>
						@foreach($tra as $t)
						<tr class="r">
							<td>{{$t->farmaco}}</td>
							<td style="text-align: center;">{{$t->unidad}}</td>
							<td>{{$t->indicaciones}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>	
			<img src="{{asset('img/firma.jpg')}}" alt="" id="imgfirma">

			<label id="fecha" style="font-size: 16px;">{{$c->fechacon}}</label><br>
			<input type="text" value="FECHA" id="etFecha" style="font-size: 16px">
			<input type="text" value="FIRMA Y SELLO DEL MEDICO" id="sello" style="font-size: 16x;">
			<table id="footr" style="border-collapse: collapse; margin: 0 auto; width: 100%;">
					<tr>
						<td id="lineaF" style="border-top: 1px solid black; border-bottom: 2px solid black; height: 4px;"></td>
					</tr>
					<tr class="f">
						<td style="text-align: center; font-size: 9px;">ATENCION MEDICA ESPECIALIZADA</td>
					</tr>
					<tr class="f">
						<td style="text-align: center; font-size: 9px;">Medida de la vista - Enfermedades de los ojos - Microcirujia Ocular</td>
					</tr>
					<tr class="f">
						<td style="text-align: center; font-size: 8px; font-weight: bold;">Lunes a Viernes: 04:30pm. - 8:00 p.m. - Jr. Federico Sal y Rosas 582 - Belen - Telf.: 426403 - 943531172	</td>
					</tr>
				
			</table>		
	@endforeach
  @else
	@include('adminlte::errors.503')
  @endif
