
<table class="table table-hover"  id="tblD">
    <thead>
        <tr style="background-color: #289BE4; color: white;">
            <th>N°</th>
            <th>N°H</th>
            <th>N°C</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Edad</th>
            <th>T. Servicio</th>
            <th>Fecha</th>
            <th>Plan Medico</th>
            <th>T.Atencion</th>            

        </tr>                        
    </thead>
    <tbody>
        @php 
            $no=0;
        @endphp
        @foreach ($respuesta as $r)
            @php
                $no++;
            @endphp

            <tr style="background-color: white;">
                <td>{{$no}}</td>
                <td>{{$r->nhistoria}}</td>
                <td>{{$r->nconsulta}}</td>
                <td>{{$r->dni}} </td>
                <td>{{$r->nombre}}</td>
                <td>{{$r->edad}}</td>
                <td>{{$r->tipo}} </td>
                <td>{{$r->fecha}} </td>
                <td>{{$r->planmed}} </td>
                <td>{{$r->atencion}} </td>                
            </tr>
        @endforeach

    </tbody>
</table> 