     <table border="1" style="margin: 0 auto;  border-collapse: collapse; width: 95%;" id="reporteD" >
              <thead>
                <tr style="height: 40px; background-color: #079BD2; color: white;">
                  <th>N°</th>
                  <th>N°HC</th>
                  <th>N°C</th>
                  <th>Nombre</th>
                  <th>Sexo</th>
                  <th>Edad</th>
                  <th>T.Atencion</th>
                  <th>Fecha</th> 
                  <th>Tipo</th>                 
                </tr>
              </thead>
              <tbody>
                @php
                  $n=0;
                @endphp
                @foreach ($li as $l)
                @php
                  $n++;
                @endphp
                <tr style="background-color: white;">
                   <td>{{$n}}</td>
                   <td>{{$l->idp}}</td>
                   <td>{{$l->nconsulta}}</td>
                   <td>{{$l->nombre}}</td>
                   <td>{{$l->sexo}}</td>
                   <td>{{$l->edad}}</td>
                   <td>{{$l->planmedico}}</td>
                   <td>{{$l->nombre_aseguradora}}</td>
                   <td>{{$l->fechacon}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
