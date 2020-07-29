<style>
	#reporteD{
		background-color: white;
	}
	#cbP{
		background-color: #3E9AF9;
		color: white;
	}
</style>
<table id="reporteD" style="margin: 0 auto; border-collapse: collapse; width: 95%;" border="1">
	<thead>
		<tr id="cbP">
			<th>N°</th>
			<th>N° H</th>
			<th>N° C</th>
			<th>Nombre</th>
			<th>Plan Medico</th>
			<th>Fecha C</th>
			<th>Diagnostico</th>
			<th>CIE</th>
		</tr>		
	</thead>
	<tbody>
		@php
			$nn=0;
		@endphp
		@foreach ($ddg as $d)
			@php
				$nn++;
			@endphp
			<tr>
				<td>{{$nn}}</td>
				<td>{{$d->id}}</td>
				<td>{{$d->nconsulta}}</td>
				<td>{{$d->nombre}}</td>
				<td>{{$d->planmedico}}</td>
				<td>{{$d->fechacon}}</td>
				<td>{{$d->diagnostico}}</td>
				<td>{{$d->cie}}</td>
			</tr>
		@endforeach
	</tbody>
</table>