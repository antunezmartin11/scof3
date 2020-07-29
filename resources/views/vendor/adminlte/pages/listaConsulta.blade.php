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
        <td><a href="#" class="btn btn-danger btn-sm" onclick="eliminarAtencion('{{$cnd->id}}')"><i class="fa fa-trash"></i></a> <a href="#" class="btn btn-success btn-sm" onclick="CargaPac('{{$cnd->dni}}','{{$cnd->atencion}}','{{$cnd->planmed}}','{{$cnd->nhistoria}}','{{$cnd->id}}')"><i class="glyphicon glyphicon-hand-up"></i></a></td>
      </tr>
    @endforeach

  </tbody>
</table>
<script>
   function tabla(tabla){//Proporciona estilos a las tablas
        $('#'+tabla).dataTable({
        "sPaginationType":"full_numbers",
        "bJqueryUI": true,        
        "language": {
                    "lengthMenu": "Mostrar _MENU_ Registros por pagina",
                    "zeroRecords": "No hay coincidencias",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No registros disponibles",
                    "infoFiltered": "(Filtrado del total de  _MAX_ registros)",
                    "sSearch": "Buscar:",               
                    "paginate":{
                    "sFirst": "Primero",
                    "sLast": "Ultimo",
                    "sNext": "Siguiente",                 
                    "sPrevious": "Anterior" 
                    }
                  }                         
        });
    }
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
            listConsulta()
            cargarDia()
          },
            error: function (){
              alertify.error('Ocurrio un error no se puede eliminar la consulta')
          }
  
      });
      }

    });
  }
  function listConsulta(){
         token=$('#token').val();    
        $.ajax({
            url: "listaConsulta",
            type: "GET",
            headers: {'X-CSRF-TOKEN': token},
            success: function(dato){
                $('#listConsulta').empty().html(dato);
              
            },
            error: function(){
                alertify.error('Sucedio un error')
            }
        });       
    }
    function cargarDia(){//Cagra la lista de pacientes del dia
        token=$('#token').val();    
        $.ajax({
            url: "listaDia",
            type: "POST",
            headers: {'X-CSRF-TOKEN': token},
            success: function(dato){
                $('#tblLista').empty().html(dato);
                tabla('tblD');
            },
            error: function(){
                alertify.error('Sucedio un error')
            }
        });
    }
</script>  
                