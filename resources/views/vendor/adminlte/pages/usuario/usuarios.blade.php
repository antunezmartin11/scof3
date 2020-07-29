          <table border="1" style="margin: 0 auto;  border-collapse: collapse; width: 95%;" id="usuarios" >
              <thead>
                <tr style="height: 40px; background-color: #079BD2; color: white;">
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>DNI</th>
                  <th>Nacimiento</th>
                  <th>Edad</th>
                  <th>Username</th>
                  <th>Tipo</th>
                  <th>Acciones</th>                  
                </tr>
              </thead>
              <tbody>
                @foreach ($usu as $u)
                <tr>
                   
                  <td>{{$u->nombre}}</td>
                  <td>{{$u->apellido}}</td>
                  <td>{{$u->dni}}</td>
                  <td>{{$u->fecnac}} </td>
                  <td>{{$u->edad}}</td>
                  <td>{{$u->username}}</td>
                  <td>ADMINISTRADOR</td>
                  <td style="text-align: center;"><a data-toggle="modal" data-target="#editarU" class="btn btn-warning btn-sm" onclick="cargarDatosPersona('{{$u->id}}')"><i class="fa fa-edit"></i></a> &nbsp; <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editarC" onclick="cargarIdC('{{$u->idu}}','{{$u->username}}')"><i class="fa fa-asterisk"></i></a>&nbsp; <a onclick="eliminarU('{{$u->idu}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                  
                </tr>
                @endforeach
              </tbody>
            </table>


<!-- Modal -->            
