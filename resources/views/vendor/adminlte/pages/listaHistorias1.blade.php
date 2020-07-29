
<table style="margin: 0 auto;"  id="tblhist">
    <thead >
        <tr style="height: 30px;">
            <th>N° H</th>
            <th>Nombre Paciente</th>            
            <th>N° Consulta</th>
            <th>Fecha</th>            
            <th>Acciones</th>
        </tr>                        
    </thead>
    <tbody>
        @foreach ($datosH as $h)
            <tr style="height: 30px;">                
                <td align="center">{{$h->idp}}</td>
                <td>{{$h->nombre}}</td>                
                <td style="text-align: center;">{{$h->nconsulta}}</td>
                <td>{{$h->fechacon}} </td>
                <td align="center">&nbsp;<a class="btn btn-warning btn-sm dbt" onclick="editH({{$h->idc}})" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>&nbsp;<a class="btn btn-info btn-sm dbt" id="btnCarA" onclick="pdfh({{$h->nconsulta}},{{$h->idp}})" data-toggle="tooltip" data-placement="top" title="Imprimir Historia"><i class="fa fa-print"></i></a>&nbsp;<a class="btn bg-olive btn-sm" data-toggle="tooltip" data-placement="top" title="Imprimir Receta" onclick="receta({{$h->idp}},{{$h->nconsulta}})"><i class="fa fa-file-o"></i></a>&nbsp;<a class="btn bg-navy btn-sm" data-toggle="tooltip" data-placement="top" title="Imprimir Refraccion" onclick="refraccion({{$h->idp}},{{$h->nconsulta}})"><i class="fa fa-file-text"></i></a>&nbsp;</td>                
            </tr>
        @endforeach

    </tbody>
</table> 
<script>
    function pdfh(nc, idpac){
        window.open('historia/'+nc+'/'+idpac, "Historia Clinica" , "width=2480,height=3508,scrollbars=NO", '_blank') 
    }
    function editH(idc){
        window.open('editHistoria/'+idc,'_blank')        
    }
    function receta(idpac, nc){
        window.open('Receta/'+idpac+'/'+nc,'ventana','location=no,directories=no,width=620,height=650,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO', '_blank')           
    }

    function refraccion(idpac, nc){
        window.open('Refraccion/'+idpac+'/'+nc,'ventana','location=no,width=595,height=420,left=240,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO','_blank')
    }
    
</script>