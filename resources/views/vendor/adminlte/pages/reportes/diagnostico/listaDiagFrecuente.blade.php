<style>
	#reporteD{
		background-color: white;
	}
	#cbP{
		background-color: #3E9AF9;
		color: white;
	}
</style>
<table id="DiagFrecuente" style="margin: 0 auto; border-collapse: collapse; width: 95%;" border="1">
	<thead>
		<tr id="cbP">
			<th>N°</th>
			<th>Diagnostico</th>
			<th>Cantidad</th>
		</tr>		
	</thead>
	<tbody>
		@php
			$nn=0;
		@endphp
		@foreach ($f as $d)
			@php
				$nn++;
			@endphp
			<tr>
				<td>{{$nn}}</td>
				<td>{{$d->diagnostico}}</td>
				<td>{{$d->cantidad}}</td>
			</tr>
		@endforeach
	</tbody>
</table>