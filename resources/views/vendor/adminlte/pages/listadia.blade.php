<style>
    
</style>
<table class="table table-bordered" id="tblD">
    <thead style="background-color: #289BE4; color: #FFFFFF;">
        <tr>
            <th>N°</th>
            <th>N°C</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Edad</th>
            <th>T. Servicio</th>
            <th>Fecha</th>
            <th>Plan Medico</th>            
            <th>Estado</th>
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
            @if($r->estado=='Pendiente')
            <tr style="font-size: 15px; background-color: #F85B5B; color: white;">
                <td>{{$no}}</td>
                <td>{{$r->nconsulta}}</td>
                <td>{{$r->nombre}}</td>
                <td>{{$r->dni}}</td>
                <td style="text-align: center;">{{$r->edad}}</td>
                <td>{{$r->tipo}} </td>
                <td>{{$r->fecha}} </td>
                <td style="text-align: center;">{{$r->planmed}} </td>            
                <td>{{$r->estado}} </td>
            </tr>
            @else
            <tr style="font-size: 15px; background-color:#33A468; color: white;">
                <td>{{$no}}</td>
                <td>{{$r->nconsulta}}</td>
                <td>{{$r->nombre}}</td>
                <td>{{$r->dni}}</td>
                <td style="text-align: center;">{{$r->edad}}</td>
                <td>{{$r->tipo}} </td>
                <td>{{$r->fecha}} </td>
                <td style="text-align: center;">{{$r->planmed}} </td>            
                <td>{{$r->estado}} </td>
            </tr>            
            @endif

        @endforeach

    </tbody>
</table> 
