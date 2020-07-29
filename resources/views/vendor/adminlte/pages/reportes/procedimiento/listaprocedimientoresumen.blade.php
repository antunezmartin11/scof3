<style>
	#reporteD{
		background-color: white;
	}
	#cbP{
		background-color: #3E9AF9;
		color: white;
	}
</style>
<table id="resumenPro" style="margin: 0 auto; border-collapse: collapse; width: 95%;" border="1">
	<thead>
		<tr id="cbP">
			<th>N°</th>
			<th>N°H</th>
			<th>N°C</th>
			<th>Nombre</th>
			<th>Edad</th>
			<th>Sexo</th>
			<th>Procedimiento</th>
		</tr>		
	</thead>
	<tbody>	
		@php
			$nn=0;
		@endphp
		@foreach ($rp as $d)
			@php
				$nn++;
			@endphp
			<tr style="background-color: white;">
				<td>{{$nn}}</td>
				<td>{{$d->id}}</td>
				<td>{{$d->nconsulta}}</td>
				<td>{{$d->nombre}}</td>
				<td>{{$d->edad}}</td>
				<td>{{$d->sexo}}</td>
				<td>{{$d->procedimiento}}</td>
			</tr>
		@endforeach
	</tbody>
</table>