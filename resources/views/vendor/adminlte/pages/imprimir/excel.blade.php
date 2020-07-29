<table>
    <thead>
        <tr>
            <th colspan="13" style="font-size:15px; text-align:center"><strong>RECIBOS POR HONORARIOS ELECTRONICOS PENDIENTES DE PAGO</strong></th>
        </tr>
        <tr style="heigth: 20px;">
            <th style="width:5px;"></th>
            <th style="width:5px;"><strong>Compania</strong></th>
            <th><strong>RUC Entidad Vinculada</strong></th>
            <th><strong>Fecha Envio Conciliacion</strong></th>
            <th style="font-size: 12px; text-align: center; color:red;"><strong>Tipo Documento</strong></th>
            <th><strong>Numero de Serie</strong></th>
            <th><strong>Numero de Documento</strong></th>
            <th><strong>Fecha de Emision</strong></th>
            <th><strong>Total Factura</strong></th>
            <th><strong>Producto</strong></th>
            <th><strong>Fecha de Envio</strong></th>
            <th><strong>Moneda</strong></th>
            <th><strong>Fecha de Atencion</strong></th>
        </tr>
    </thead>
    <tbody>
    
        @php
            $num=1;
            $fecha=Carbon\Carbon::now()->toDateString();
        @endphp
    @foreach($pago as $p)
        @php
        $num++;
        @endphp
        <tr>
            <td>{{$num}}</td>
            <td>0{{$p->codigoCompania}}</td>
            <td>10316310562</td>
            <td>{{$fecha}}</td>
            <td>02</td>
            <td>E001</td>
            <td></td>
            <td>{{$p->fechaC}}</td>
            <td>{{$p->pagototal}}</td>
            <td>{{$p->producto}}</td>
            <td>{{$fecha}}</td>
            <td>01</td>
            <td>{{$p->fechaC}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
