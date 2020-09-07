
<table  class="table table-hover" id="tblPaciente">
    <thead>
		<tr style="background-color: #289BE4; color: white;">
	        <th>N°</th>
	        <th>Nombre</th>
	        <th>DNI</th>
	        <th>Fec. Nac</th>
	        <th>Edad</th>
	        <th>Sexo</th>
	        <th>Telefono</th>
	        <th>Direccion</th>
	        <th>Tipo Servicio</th>
	        <th>Compañia</th>
            <th style="text-align: center;">Accion</th>		
		</tr>
    </thead>
    <tbody id="filas">
    	@php
            $n=0;
    	@endphp
    	@foreach($respuesta as $r)
        <tr style="background-color:white;">
            
			@php
                $n++;
                $json=json_encode($r);
			@endphp
            <td>{{$n}} </td>
            <td>{{$r->nombre}}</td>
            <td>{{$r->dni}} </td>
            <td>{{$r->fecnac}} </td>
            <td>{{$r->edad}} </td>
            <td>{{$r->sexo}} </td>
            <td>{{$r->telefono}} </td>
            <td>{{$r->direccion}} </td>
            <td>{{$r->tipo_seguro->nombre_aseguradora}}</td>

            @if ($r->tipo_seguro_id==1) 
            <td></td>
            @else
                @php
                $co=DB::table('compania_paciente')->where('id_paciente','=',$r->id)->get();
                @endphp
                @foreach ($co as $co)
                @php
                $comp=DB::table('compania')->where('id',$co->id_compania)->get();
                @endphp
                    @foreach($comp as $comp)
                    <td>{{$comp->nombre}}</td>
                    @endforeach
                
                @endforeach            
            @endif
      
              
            <td><a href="#" class="btn btn-sm btn-success" onclick="AgregarParaConsulta({{$r->id}})"><i class="glyphicon glyphicon-hand-up"></i></a>&nbsp;<a id="btnHistorias" class="btn btn-sm btn-info" data-target="#modalHistoria" data-toggle="modal" onclick="historiasAntes({{$r->id}})"><i class="fa fa-file-text"></i></a>&nbsp; <a href="#" class="btn bg-teal btn-sm"  onclick="CargarInputs({{$json}})" id="btnCargar{{$r->dni}}"><i class="fa fa-edit" id="iedit"></i></a>&nbsp;<a class="btn btn-danger btn-sm" onclick="eliminarPa({{$r->id}})"><i class="fa fa-trash"></i></a> </td>                
        </tr>
        @endforeach
    </tbody>


</table>
    

<script type="text/javascript">
    
</script>   