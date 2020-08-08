<style>
	#idPaMed{
		border-left: 0px;
		border-right: 0px;
		border-top: 0px;
		border-bottom: 1px dashed black;
		width: 80%;
	}
	.fH{
		border: 0px;
	}
	#diaC{
		width: 40px;
	}
	#anC{
		width: 40px;
		text-align: left;
	}
	#mesC{
		width: 150px;
		text-align: center;
	}	
	.tbRef{
		width: 900px;
	}
	.cbr{
		width: 600px;
	}
	.tblRefH{
		width: 500px;
	}
	tr.conRefr td{
		border-right: 1px solid black;
		border-bottom: 1px solid black;
		border-left: 1px solid black;
		border-top: 1px solid black;
	}
	#observaciones{
				
		border-top: 0px;
		border-right: 0px;
		border-left: 0px;
		border-bottom: 1px dashed black;
		width: 80%;
	}
	.fechaCon{
		padding-top: 10px;
	}
	.pie{
		position: static;
		padding-top: 15%;
		width: 900px;
	}
	.img, .img1{
		position: absolute;
		height: 80px;		
		width: 700px;
		
	}
	.img img{
		position: absolute;
		max-width: 20%;		
		left: 105%;
	}	
	.img1 img{
		position: absolute;
		max-width: 20%;		
		left: 1%;
	}
	#imgfirma{
		height:150px;
		width:250px;
		position: absolute;
		top: 220px;
		left: 550px;
	}	
</style>
  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
	<div class="img1">
		<img src="{{ asset('img/lenteI.png') }}">		
	</div>
	<div class="img">
		<img src="{{ asset('img/lente.png') }}">		
	</div>
	<div class="cbr">
		<table class="tbRef" style="margin: 0 auto;">
			<thead>
				<tr>
					<td style="text-align: center; font-size: 25px; font-family: 'Brush Script MT'; font-style: oblique; letter-spacing: 1px; height: 10px;"><strong>Bernardo Gamarra Benites</strong></td>
				</tr>
				<tr>
					<td style="text-align: center; letter-spacing: 1px; font-size: 15px; height: 10px;">MEDICO - CIRUJANO</td>		
				</tr>
				<tr>
					<td style="text-align: center; letter-spacing: 1px; font-size: 15px;">OFTALMOLOGO</td>					
				</tr>
				<tr>
					<td style="text-align: center; letter-spacing: 1px; font-size: 15px;">C.M.P. 26802 - R.N.E. 15639</td>
				</tr>	
				<tr>
					<td style="border-bottom: 5px solid black; border-top: 1px solid black; height: 8px;"></td>
				</tr>				
			</thead>				
		</table>	
	</div>
@foreach($datos as $d1)	
	@php
		
		$paciente=$d1->nombre;
		$odesfera=$d1->odesfera;
		$odcilindro=$d1->odcilindro;
		$odeje=$d1->odeje;
		$oddip=$d1->oddip;
		$oiesfera=$d1->oiesfera;
		$oicilindro=$d1->oicilindro;
		$oieje=$d1->oieje;
		
		$odesferaC=$d1->odesferaC;
		$odcilinfroC=$d1->odcilindroC;
		$odejeC=$d1->odejeC;
		$oddipC=$d1->oddipC;
		$oiesferaC=$d1->oiesferaC;
		$oicilindroC=$d1->oicilindroC;
		$oiejeC=$d1->oiejeC;		

	@endphp

		<?php 
		$fch=$d1->fechaCon;
		$dia=substr($fch,8,9);
		$mes=substr($fch,5,2);
		$mesF="";
		$an=substr($fch, 0,4);
		switch ($mes) {
			case '01':
				$mesF='Enero';
				break;
			case '02':
				$mesF='Febero';
				break;
			case '03':
				$mesF='Marzo';
				break;
			case '04':
				$mesF='Abril';
				break;
			case '05':
				$mesF='Mayo';
				break;
			case '06':
				$mesF='Junio';
				break;
			case '07':
				$mesF='Julio';
				break;
			case '08':
				$mesF='Agosto';
				break;
			case '09':
				$mesF='Setiembre';
				break;
			case '10':
				$mesF='Octubre';
				break;
			case '11':
				$mesF='Noviembre';
				break;
			case '12':
				$mesF='Diciembre';
				break;
			default:
				# code...
				break;
		}
		 ?>

@endforeach
<div class="cuerpo">
	<br>
	<label ><strong>Paciente:</strong></label>
		<input type="text" id="idPaMed" value="{{$paciente}}">		
		<div style="height: 14px;"></div>	
			<table class="tblRefH" style="border-collapse: collapse;">
				<thead>
					<tr class="conRefr">
						<td colspan="5" style="text-align: center; font-weight: bold;">LENTES PARA LEJOS</td>
					</tr>	
					<tr class="conRefr">
						<td></td>
						<td style="text-align: center; font-weight: bold;">Esfera</td>
						<td style="text-align: center; font-weight: bold;">Cilindro</td>
						<td style="text-align: center; font-weight: bold;">Eje</td>
						<td style="text-align: center; font-weight: bold">DIP</td>
					</tr>			
				</thead>
				<tbody>
					<tr class="conRefr">
						<td style="width: 50px; text-align: center; font-weight: bold;">OD</td>
						<td style="width: 120px; text-align: center;">{{$odesfera}}</td>
						<td style="width: 120px; text-align: center;">{{$odcilindro}}</td>
						<td style="width: 70px; text-align: center;">{{$odeje}}</td>				
						<td style="width: 70px; text-align: center;" rowspan="2">{{$oddip}}</td>
					</tr>
					<tr class="conRefr">
						<td style="width: 50px; text-align: center; font-weight: bold;">OI</td>		
						<td style="width: 120px; text-align: center;">{{$oiesfera}}</td>
						<td style="width: 120px; text-align: center;">{{$oicilindro}}</td>
						<td style="width: 70px; text-align: center;">{{$oieje}}</td>						
					</tr>					
				</tbody>
			</table><br>
			<table class="tblRefH" style="border-collapse: collapse;">
				<thead>
					<tr class="conRefr">
						<td colspan="5" style="text-align: center; font-weight: bold;">LENTES PARA CERCA</td>
					</tr>	
					<tr class="conRefr">
						<td></td>
						<td style="text-align: center; font-weight: bold;">Esfera</td>
						<td style="text-align: center; font-weight: bold;">Cilindro</td>
						<td style="text-align: center; font-weight: bold;">Eje</td>
						<td style="text-align: center; font-weight: bold">DIP</td>
					</tr>			
				</thead>
				<tbody>
					<tr class="conRefr">
						<td style="width: 50px; text-align: center; font-weight: bold;">OD</td>
						<td style="width: 120px; text-align: center;">{{$odesferaC}}</td>
						<td style="width: 120px; text-align: center;">{{$odcilinfroC}}</td>
						<td style="width: 70px; text-align: center;">{{$odejeC}}</td>				
						<td style="width: 70px; text-align: center;" rowspan="2">{{$oddipC}}</td>
					</tr>
					<tr class="conRefr">
						<td style="width: 50px; text-align: center; font-weight: bold;">OI</td>		
						<td style="width: 120px; text-align: center;">{{$oiesferaC}}</td>
						<td style="width: 120px; text-align: center;">{{$oicilindroC}}</td>
						<td style="width: 70px; text-align: center;">{{$oiejeC}}</td>									
					</tr>					
				</tbody>
			</table>	
			<br>
			<label>Observaciones:</label><input type="text" id="observaciones" value="">
			<div class="fechaCon">
				<label style="padding-left: 200px;">Huaraz,</label>
				<input type="text" style="padding-left: 10px;" id="diaC" class="fH" value="<?php echo $dia; ?>"><label for=""> de </label>
				<input type="text" id="mesC" class="fH" value="<?php echo $mesF; ?>"> &nbsp; <label > del </label>
				<input type="text" id="anC" class="fH" value="<?php echo $an; ?>">				
			</div>
	</div>
	<img src="{{asset('img/firma.jpg')}}" alt="Firma" id="imgfirma">
	<div class="pie">
		<table id="footr" style="border-collapse: collapse; margin: 0 auto; width: 80%;">
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
	</div>
  @else
	@include('adminlte::errors.503')
  @endif
