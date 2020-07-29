<style>

</style>
<table class="table table-striped table-bordered table-hover" id="tblAtenAnno">
    <thead>
        <tr>
            <th>N°Historia</th>
            <th>Nombre</th>
            <th>N°Consulta</th>            
            <th>Fecha</th>
            <th>Plan Medico</th>
            <th>Eliminar</th>
        </tr>                        
    </thead>
    <tbody>
        @foreach ($respuesta as $r)
            <tr>                
                <td>{{$r->id}}</td>
                <td>{{$r->nombre}}</td>
                <td>{{$r->nconsulta}}</td>
                <td>{{$r->fechacon}}</td>
                <td>{{$r->planmedico}} </td>          
                <td class="text-center"><a class="btn btn-danger btn-sm" onclick="EliminarConsulta('{{$r->idc}}','{{$r->id}}')"><i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table> 