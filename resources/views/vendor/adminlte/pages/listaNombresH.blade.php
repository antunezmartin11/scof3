<style>
    table{
        background: white;
    }
</style>
<h3><span>Lista de Pacientes Encontrados</span></h3>
<table class="table table-bordered table-hover" id="tblD" border="4">
    <thead>
        <tr>
            <th>N° H</th>
            <th>Nombre Paciente</th>
            <th style="text-align: center">DNI</th>
            <th style="text-align: center;">Edad</th>  
            <th style="text-align: center;">Ver Historias</th>
        </tr>                        
    </thead>
    <tbody>
        @foreach ($datosN as $h)
            <tr>                
                <td align="center">{{$h->id}}</td>
                <td>{{$h->nombre}}</td>
                <td>{{$h->dni}}</td>
                <td>{{$h->edad}} </td>
                <td align="center"><a class="btn btn-warning btn-sm dbt" onclick="searchDNI({{$h->dni}})"><i class="fa fa-search-plus"></i></td>              
            </tr>
        @endforeach

    </tbody>
</table> 