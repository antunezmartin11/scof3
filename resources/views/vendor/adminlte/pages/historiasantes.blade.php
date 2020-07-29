<table border="1 solid" id="tblHistoriasAntes" class="table table-bordered table-hover">
	<thead>
		<tr style="background-color: #289BE4; color: white;">
			<th>N°</th>
			<th>Fecha</th>
			<th>Ver</th>
		</tr>
	</thead>
	@php
		$n=0;
	@endphp
	@foreach($r as $r)
		@php
			$n++;
		@endphp
	<tbody>
		<tr >
			<td>{{$n}} </td>
			<td>{{$r->fechaCon}}</td>
			<td ><a href="#" class="btn btn-sm btn-success" onclick="mostrarHistoria('{{$r->nconsulta}}','{{$r->paciente_id}}')"><i class="fa fa-file-text" style="color: white;"></i></a></td>
		</tr>		
	</tbody>

	@endforeach
</table>		
