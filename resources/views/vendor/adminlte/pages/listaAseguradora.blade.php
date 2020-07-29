<style>
    table{
        background: #B7FDC9;
    }
</style>
<table class="table table-striped table-bordered table-hover" id="tblD">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nombre Aseguradora</th>
            <th>RUC</th>
            <th>Documento</th>
            <th>Producto</th>
            <th>Moneda</th>
            <th>Acciones</th>
        </tr>                        
    </thead>
    <tbody>
        @foreach ($lista as $r)
            <tr>
                <td></td>
                <td>{{$r->nombre_aseguradora}}</td>
                <td>{{$r->ruc}}</td>
                <td>{{$r->tipodoc}}</td>
                <td>{{$r->producto}}</td>
                <td>{{$r->numcomp}} </td>
                <td align="center"><a class="btn btn-danger btn-sm dbt" onclick='eliminarAseguradora("{{$r->id}}");' ><i class="fa fa-trash"></i></a>&nbsp<a class="btn btn-info btn-sm dbt" onclick='CargarAseguradora("{{$r->id}}")' id="btnCarA"><i class="fa fa-edit"></i></a></td>                
            </tr>
        @endforeach

    </tbody>
</table> 