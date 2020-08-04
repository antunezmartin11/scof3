<style>
	#reporteD{
		background-color: white;
	}
	#cbP{
		background-color: #3E9AF9;
		color: white;
	}
</style>
<table id="resumenedades" style="margin: 0 auto; border-collapse: collapse; width: 95%;" border="1">
	<thead>
		<tr id="cbP">
			<th>N°</th>
			<th>N°H</th>			
			<th>Nombre</th>
			<th>Edad</th>
			<th>Sexo</th>			
		</tr>		
	</thead>
	<tbody>	
		@php
			$nn=0;
		@endphp
		@foreach ($ed as $d)
			@php
				$nn++;
			@endphp
			<tr style="background-color: white;">
				<td>{{$nn}}</td>
				<td>{{$d->dni}}</td>
				<td>{{$d->nombre}}</td>
				<td>{{$d->edad}}</td>			
				<td>{{$d->sexo}}</td>				
			</tr>
		@endforeach
	</tbody>
</table>