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
			<th>Procedimiento</th>
			<th>Cantidad</th>
		</tr>		
	</thead>
	<tbody>	
		@php
			$nn=0;
		@endphp
		@foreach ($r as $d)
			@php
				$nn++;
			@endphp
			<tr style="background-color: white;">
				<td>{{$nn}}</td>
				<td>{{$d->procedimiento}}</td>
				<td>{{$d->cantidad}}</td>

			</tr>
		@endforeach
	</tbody>
</table>