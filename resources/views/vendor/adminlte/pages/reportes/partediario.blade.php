@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

<style>
  li{
    cursor: pointer;    
  }
  li:hover{
    
  }
</style>
@section('main-content')
  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
    <div class="row">
        <div class="panel panel-success">
          <div class="panel-heading">
            Reporte de parte diario
          </div>
          <div class="panel-body">
            <form  id="frmDiario">
              <div class="form-group">
                <label class="col-sm-1">Desde:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control input-sm" id="fecIni">
                </div>
                <label class="control-label col-sm-1">Hasta:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control input-sm" id="fecFin">
                </div>
                <label class="control-label col-sm-1">Tipo:</label>
                <div class="col-sm-2"
                >
                  <select name="tipo" id="tipo" class="form-control input-sm">
                    <option value="Seleccionar">Seleccionar</option>
                    <option value="0">GENERAL</option>
                    <?php 
                      $t=DB::table('tipo_seguro')->get();
                     ?>
                    @foreach ($t as $t)
                      <option value="{{$t->id}}">{{$t->nombre_aseguradora}}</option>
                    @endforeach
                  </select>
                </div>
                <a class="btn btn-success btn-sm" id="btnBus">Generar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <a href="#" class="btn btn-info" id="printR"><i class="fa fa-print">Imprimir</i></a>
      </div>
      <div id="reporte">
        
      </div>
  @else
  @include('adminlte::errors.503')
  @endif  
<!--Incio modal de lista de pacientes -->

<!--Fin Modal de atenciones al año -->
@endsection
            
 
<script src="{{ asset('js/funcionesReporte.js') }}"></script>     
<script src="{{ asset('js/validar.js') }}"></script>  
<script>

</script>