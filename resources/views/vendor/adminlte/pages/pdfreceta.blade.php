<style>
	*{
		color: red;
	}
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
		 height: 22px;
		 border-bottom:1px solid black;
		 border-top: 1px solid black;
		 border-left: 1px solid black;
		 border-right: 1px solid black;
	}	
	.rect{
		 color: blue;
		 width: 500px;
		 height: 700px;

	}
	.tb{
		width: 500px;
	}
	.di{
		height: 5px;
	}
</style>
  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)

	@foreach ($con as $c)
		<?php 
			$idc=$c->idcon;
			$diag=DB::table('diagnostico')->where('consulta_id','=',$idc)->get();
			$tra=DB::table('farmaco')->where('consulta_id','=',$idc)->get();			
			/*$tra=DB::select("select substring(tratamiento,1,locate('-',tratamiento)-1) as farmaco, substring(substring(tratamiento, locate('-',tratamiento)+1),1, locate('-',substring(tratamiento, locate('-',tratamiento)+1))-1) as unidad, substring(substring(tratamiento, locate('-',tratamiento)+1),locate('-',substring(tratamiento, locate('-',tratamiento)+1))+1,length(substring(tratamiento, locate('-',tratamiento)+1))) as indicaciones from tratamiento where consulta_id=:idc",['idc'=>$idc])*/
		 ?>
		@if($c->tipo_seguro_id!=1)
		<br>
		<br>
		<br>
		<br>
		<br>
			<h3 id="nombre">{{$c->nombre}} </h3>	
			<input type="text" value="{{$c->fechacon}}" id="fe">
			<br>	
			
			 @foreach($diag as $d)		
				<input type="text" value="{{$d->diagnostico}}" class="di"> <input type="text" value="{{$d->cie}}" class="ci">  <br>
			
			 @endforeach
			<br>
			<br>
			<br>
			<br>
			@foreach($tra as $t)
			<input type="text" value="{{$t->farmaco}}" class="farmaco"> <input type="text" value="{{$t->unidad}} " class="unidad"> <input type="text" value="{{$t->indicaciones}} " class="indicacion"><br>

			@endforeach
			 <br>
		@else
			
			<div class="rect">
				<table class="tb">
					<thead>
					<tr>
						<td style="text-align: center;">Bernardo Gamarra Benites</td>
					</tr>
					<tr>
						<td style="text-align: center;">MEDICO CIRUJANO</td>		
					</tr>
					<tr>
						<td style="text-align: center;">OFTALMOLOGO</td>					
					</tr>
					<tr>
						<td style="text-align: center;">C.M.P. 26802 - R.N.E. 15639</td>
					</tr>					
					</thead>

				</table>


				<table class="tb" style="margin: 0 auto; border-collapse: collapse;">				
					<tbody>
						<tr class="r" style="width: 400px;">
							<td style="text-align: center;">APELLIDOS Y NOMBRES</td>
						</tr>
						<tr class="r">
							<td>{{$c->nombre}} </td>
						</tr>						
					</tbody>			
				</table>
				<br>
				<table class="tb" style="margin: 0 auto; border-collapse: collapse;">
					<thead>
						<tr class="r">
							<td style="width: 370px; text-align: center;">Diagnostico</td>
							<td style="text-align: center;">CIE 10</td>
						</tr>
					</thead>
					<tbody>
						@foreach($diag as $d)		
						<tr class="r">
							<td style="height: 20px;">{{$d->diagnostico}}</td>
							<td style="height: 20px;">{{$d->cie}}</td>
						</tr>
						@endforeach
					</tbody>
				</table><br>
				<label>RP.-</label>
				<table style="margin: 0 auto; border-collapse: collapse;" class="tb">
					<thead>
						<tr class="r">
							<td>FARMACO</td>
							<td>UNIDADES</td>
							<td>INDICACIONES</td>
						</tr>
					</thead>
					<tbody>
						@foreach($tra as $t)
						<tr class="r">
							<td>{{$t->farmaco}}</td>
							<td>{{$t->unidad}}</td>
							<td>{{$t->indicaciones}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@endif
	@endforeach
  @else
	@include('adminlte::errors.503')
  @endif
