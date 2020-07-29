  <style>
    #header{       
       top: 0px;
    }       
    #content: {      
      top: 15%;      
    }
    .cbr{
      width: 730px;
    }
    .tbRef{
      width: 730px;
    }
    #res{
      width: 200px;
    }
    #resP{
      width: 450px;
    }
  </style>
  <div id="header">
    <div class="cbr">
      <table class="tbRef" style="margin: 0 auto;">
        <thead>
          <tr>
            <td style="text-align: center; font-size: 25px; font-family: 'Brush Script MT'; font-style: oblique; letter-spacing: 1px; height: 10px;"><strong>Bernardo Gamarra Benites</strong></td>
          </tr>
          <tr>
            <td style="text-align: center; letter-spacing: 1px; font-size: 15px; height: 10px;">MEDICO - CIRUJANO</td>    
          </tr>
          <tr>
            <td style="text-align: center; letter-spacing: 1px; font-size: 15px;">OFTALMOLOGO</td>          
          </tr>
          <tr>
            <td style="text-align: center; letter-spacing: 1px; font-size: 15px;">C.M.P. 26802 - R.N.E. 15639</td>
          </tr> 
          <tr>
            <td style="border-bottom: 5px solid black; border-top: 1px solid black; height: 8px;"></td>
          </tr>       
        </thead>        
      </table>  
    </div>      
  </div>
   <?php 
    $fechaConsulta=Carbon\Carbon::now()->toDateString();  
    ?>

    <div id="content">
        @if(empty($ff))
          <p>Reporte de Pacientes del dia: <strong>{{$fechaConsulta}}</strong></p>          
        @else
          <p>Reporte de Pacientes del: <strong>{{$fi}}</strong> Hasta: <strong>{{$ff}}</strong></p> 
        @endif      
        <table border="1" style="margin: 0 auto;  border-collapse: collapse; width: 100%;" id="reporteD" >
          <thead>
              <tr style="height: 40px; background-color: #079BD2; color: white; font-size: 10px;">
                <th style="width: 2%;">N°</th>
                <th style="width: 3%; text-align: center;">HC</th>
                <th style="width: 2%;">NC</th>
                <th style="width: 35%;">Nombre</th>
                <th style="width: 6%; text-align: center;">Sexo</th>
                <th style="width: 1%;">Edad</th>
                <th style="width: 10%; text-align: center;">Plan M.</th>
                <th style="width: 7%; text-align: center;">Fecha</th> 
                <th style="width: 23%; text-align: center;">Tipo</th>        
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

            <tr style="background-color: white; font-size: 10px;">
                <td style="text-align: center;">{{$n}}</td>
                <td style="text-align: center;">{{$l->idp}}</td>
                <td style="text-align: center;">{{$l->nconsulta}}</td>
                <td>{{$l->nombre}}</td>
                <td style="text-align: center;">{{$l->sexo}}</td>
                <td style="text-align: center;">{{$l->edad}}</td>
                <td style="text-align: center;">{{$l->planmedico}}</td> 
                <td style="text-align: center;">{{$l->fechacon}}</td>  
                <td style="text-align: center;">{{$l->nombre_aseguradora}}</td>        
            </tr>
            @endforeach
          </tbody>
        </table>       
    </div>
    <br>
    <div id="resumen">
      <table id="res">
        <thead>
            @php
              $cm=0;
              $cf=0;
              $co=0;
              $mv=0;
              $sctr=0;
              $ep=0;              
            @endphp
          @foreach ($li as $li)
            @if($li->sexo=='Masculino')
              @php
                $cm++;
              @endphp              
            @elseif($li->sexo=='Femenino')
              @php
                $cf++;
              @endphp
            @endif

            @if($li->planmedico=='CONSULTA')
              @php
                $co++;
              @endphp
            @elseif($li->planmedico=='MEDIDA DE LA VISTA')
              @php
                $mv++;
              @endphp
            @elseif($li->planmedico=='SCTR')
              @php
                $sctr++;
              @endphp
            @elseif($li->planmedico=='EVALUACION PREVENTIVA')
              @php
                $ep++;
              @endphp
            @endif            
          @endforeach              
          <tr>          
            <th colspan="2" style="border-top: 3px solid black; border-bottom: 1px solid black;">
              Resumen de Pacientes
            </th>          
          </tr>
          <tr>
            <th>
              <pre>Hombres :</pre>
            </th>
            <th style="text-align: center;">
              <strong>{{$cm}}</strong>
            </th>
          </tr>
          <tr>
            <th>
              <pre>Mujeres :</pre>
            </th>
            <th style="text-align: center;">
              {{$cf}}
            </th>
          </tr>          
        </thead>
      </table>
    </div>
      <table id="resP">
        <thead>
          <tr>
            <th colspan="4" style="border-top: 3px solid black; border-bottom: 1px solid black;">Resumen de Consultas</th>
          </tr>
          <tr>

            <th><pre>Consulta :</pre></th>
            <th style="text-align: center;">{{$co}}</th>
            <th><pre>&nbsp;&nbsp;Medida de la vista     :</pre></th>
            <th style="text-align: center;">{{$mv}}</th>
          </tr>
          <tr>
            <th><pre>SCTR     :</pre></th>
            <th style="text-align: center;">{{$sctr}}</th>
            <th><pre>&nbsp;&nbsp;Evaluacion Preventiva  :</pre></th>
            <th style="text-align: center;">
              {{$ep}}
            </th>
          </tr>
        </thead>
        
      </table>    
