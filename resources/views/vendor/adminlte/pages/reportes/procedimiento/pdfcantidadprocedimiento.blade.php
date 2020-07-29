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
  <br>
  <div class="content">
    <p>Cantidad de procedimientos del: <strong>{{$fi}}</strong> Hasta: <strong>{{$ff}}</strong></p> 

    <table border="1" style="margin: 0 auto; border-collapse: collapse; width: 100%;">
      <thead>
        <tr style="background-color: #3E9AF9; color: white; font-size: 12px;">
          <th style="width: 2%;">N°</th>         
          <th style="width: 30%;">Procedimiento</th>
          <th style="text-align: center; width: 5%;">Cantidad</th>              
        </tr>    
      </thead>
      <tbody>
        @php
          $nn=0;
        @endphp
        @foreach ($r as $d)
          @php
          $nn++;
          @endphp
          <tr style="font-size: 10px;">
            <td style="text-align: center;">{{$nn}}</td>
            <td>{{$d->procedimiento}}</td>
            <td style="text-align: center;">{{$d->cantidad}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>