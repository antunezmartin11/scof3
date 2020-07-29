<style>
	.page-break>#idPaMed{		
		width: 500px;
		border: 1px solid #FFFFFF;
		padding-left: 110px;				
		font-size: larger;
		top: -15px;
	}

	.tblRefH{
		border: 0px;
		padding-left: 120px;
	}

	.tblRefH th, .tblRefH td{		
		border: 0px;		
		font-size: 20px; 		
		text-align: center;
	}
	.fH{
		border: 0px;
	}
	#diaC{
		width: 40px;
	}
	#anC{
		width: 45px;
		text-align: right;
	}
	#mesC{
		width: 145px;
		text-align: center;
	}	
</style>
  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
	<div class="page-break ">
	<br>
	<br>
	<br>
	<br>
	<br>
	<div style="height: 10px;"></div>
	@foreach($datos as $d1)	
		<input type="text" id="idPaMed" value="{{$d1->nombre}}" class="form-control input-sm" style="top: -10px;">			
		<br>	
		<br>
		<div style="height: 14px;"></div>
		<br style="padding-bottom: 10px;">	
			<table class="tblRefH">
				<tbody>
					<tr class="conRefr">					
						<td style="width: 120px;">{{$d1->odesfera}} </td>
						<td style="width: 120px;">{{$d1->odcilindro}} </td>
						<td style="width: 70px;">{{$d1->odeje}} </td>				
						<td style="width: 70px;">{{$d1->oddip}} </td>
					</tr>
					<tr class="conRefr">						
						<td style="width: 120px;">{{$d1->oiesfera}} </td>
						<td style="width: 120px;">{{$d1->oicilindro}} </td>
						<td style="width: 70px;">{{$d1->oieje}} </td>				
						<td style="width: 70px;">{{$d1->oidip}} </td>					
					</tr>					
				</tbody>
			</table>	
			<br>	
			<br>	
		    <br>
			<div style="height: 25px;"></div>
			<table class="tblRefH">
				<tbody>
					<tr class="conRefr" >					
						<td style="width: 120px;">{{$d1->odesferaC}} </td>
						<td style="width: 120px;">{{$d1->odcilindroC}} </td>
						<td style="width: 70px;">{{$d1->odejeC}} </td>				
						<td style="width: 70px;">{{$d1->oddipC}} </td>
					</tr>
					<tr class="conRefr">						
						<td style="width: 120px;">{{$d1->oiesferaC}} </td>
						<td style="width: 120px;">{{$d1->oicilindroC}} </td>
						<td style="width: 70px;">{{$d1->oiejeC}} </td>				
						<td style="width: 70px;">{{$d1->oidipC}} </td>					
					</tr>					
				</tbody>
			</table>	
			<br>		
			<div style="height: 13px;"></div>
			<?php 
			$fch=$d1->fechacon;
			$dia=substr($fch,8,9);
			$mes=substr($fch,5,2);
			$mesF="";
			$an=substr($fch, 2,2);
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
			<input type="text" style="padding-left: 265px;" id="diaC" class="fH" value="<?php echo $dia; ?>"> &nbsp; &nbsp; &nbsp; 
			<input type="text" id="mesC" class="fH" value="<?php echo $mesF; ?>"> &nbsp;
			<input type="text" id="anC" class="fH" value="<?php echo $an; ?>">
	@endforeach
	</div>
  @else
	@include('adminlte::errors.503')
  @endif
