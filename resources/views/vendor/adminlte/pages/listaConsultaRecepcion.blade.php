<table border="1" class="table table-hover" id="tblConsulta">
  <thead>
    <tr style="background-color: #12A4B5; color: white;">
      <th>DNI</th>
      <th>Nombres</th>
      <th>Tipo Atencion</th>
      <th>Plan Med</th>
      <th>N° Con</th>
      <th>Accion</th>
    </tr>
  </thead>
  <tbody>
    @php
    @endphp
    @foreach($cnd as $cnd)
    <tr style="font-size: 11px;">
      <td>{{$cnd->dni}} </td>
      <td>{{$cnd->nombre}}</td>
      <td >{{$cnd->tipo}} </td>
      <td>{{$cnd->planmed}} </td>
      <td>{{$cnd->nconsulta}}</td>
      <td><a href="#" class="btn btn-danger btn-sm" onclick="eliminarAtencion({{$cnd->id}})"><i class="fa fa-trash"></i></a></td>
    </tr>
      
    @endforeach
  </tbody>
</table>
<script>
function eliminarAtencion(id){
  token=$('#token').val()
  alertify.confirm('Desea quitar este paciente para atencion', function (e){
    if(e){
        $.ajax({
          url:'eliminarAtencion/'+id,
          type:'DELETE',
          headers:{'X-CSRF-TOKEN': token},
          success: function(){
          alertify.error('Paciente retirado para consulta')
        },
          error: function (){
            alertify.error('Ocurrio un error no se puede eliminar la consulta')
        }

    });
    }

  });
}
</script>