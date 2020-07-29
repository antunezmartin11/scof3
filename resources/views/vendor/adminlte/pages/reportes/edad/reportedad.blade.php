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
        <div class="col-md-12">
          <div class="box box-warning collapsed-box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Resumen detallado por edades</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">                  
              <form  id="frmEdadesDetalle">
                <div class="form-group">
                  <label class="col-sm-1">Desde:</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control input-sm" id="fecIniED">
                  </div>
                  <label class="control-label col-sm-1">Hasta:</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control input-sm" id="fecFinED">
                  </div>
                  <label class="control-label col-sm-1">Rango</label>
                  <div class="col-sm-2">
                    <select name="EdadesDet" id="EdadesDet" class="form-control input-sm">
                      <option value="Seleccionar">Seleccionar</option>
                      <option value="1">0 - 5 años</option>
                      <option value="2">6 - 10 años</option>
                      <option value="3">11 - 15 años</option>
                      <option value="4">16 - 20 años</option>
                      <option value="5">21 - 25 años</option>
                      <option value="6">26 - 30 años</option>
                      <option value="7">31 - 35 años</option>
                      <option value="8">36 - 40 años</option>
                      <option value="9">41 - 45 años</option>
                      <option value="10">46 - 50 años</option>
                      <option value="11">51 - 55 años</option>
                      <option value="12"> 56 - 60 años</option>
                      <option value="13">61 - 65 años</option>
                      <option value="14">66 - 70 años</option>
                      <option value="15">71 - 75 años</option>
                      <option value="16">76 - 80 años</option>
                      <option value="17">81 - 85 años</option>
                      <option value="18">86 - 90 años</option>
                      <option value="19">91 años - ></option>
                    </select>
                  </div>
                  <a class="btn btn-success btn-sm" id="btnEdadDe">Generar</a>
                </div>
              </form>                  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>      
        <!-- Expandible resumen-->
        <div class="col-md-12">
          <div class="box box-info collapsed-box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Cantidad por edades</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">                  
              <form  id="frmProCan">
                <div class="form-group">
                  <label class="col-sm-1">Desde:</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control input-sm" id="fecIniPR">
                  </div>
                  <label class="control-label col-sm-1">Hasta:</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control input-sm" id="fecFinPR">
                  </div>
                  <label class="control-label col-sm-1">Rango</label>
                  <div class="col-sm-2">
                    <select name="" id="" class="form-control input-sm">
                      <option value="Seleccionar">Seleccionar</option>
                      <option value="1">0 - 5 años</option>
                      <option value="2">6 - 10 años</option>
                      <option value="3">11 - 15 años</option>
                      <option value="4">16 - 20 años</option>
                      <option value="5">21 - 25 años</option>
                      <option value="6">26 - 30 años</option>
                      <option value="7">31 - 35 años</option>
                      <option value="8">36 - 40 años</option>
                      <option value="9">41 - 45 años</option>
                      <option value="10">46 - 50 años</option>
                      <option value="11">51 - 55 años</option>
                      <option value="12"> 56 - 60 años</option>
                      <option value="13">61 - 65 años</option>
                      <option value="14">66 - 70 años</option>
                      <option value="15">71 - 75 años</option>
                      <option value="16">76 - 80 años</option>
                      <option value="17">81 - 85 años</option>
                      <option value="18">86 - 90 años</option>
                      <option value="19">91 años - ></option>
                    </select>
                  </div>                  
                  <a class="btn btn-success btn-sm" id="btnBusPr">Generar</a>
                </div>
              </form>                  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>  
        <!-- Expandible mas frecuente-->        
        <div class="col-md-12">
          <div class="box box-danger collapsed-box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Diagnosticos por edades</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">                  
              <form  id="frmProCan">
                <div class="form-group">
                  <label class="col-sm-1">Desde:</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control input-sm" id="fecIniPR">
                  </div>
                  <label class="control-label col-sm-1">Hasta:</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control input-sm" id="fecFinPR">
                  </div>
                  <label class="control-label col-sm-1">Rango</label>
                  <div class="col-sm-2">
                    <select name="" id="" class="form-control input-sm">
                      <option value="Seleccionar">Seleccionar</option>
                      <option value="1">0 - 5 años</option>
                      <option value="2">6 - 10 años</option>
                      <option value="3">11 - 15 años</option>
                      <option value="4">16 - 20 años</option>
                      <option value="5">21 - 25 años</option>
                      <option value="6">26 - 30 años</option>
                      <option value="7">31 - 35 años</option>
                      <option value="8">36 - 40 años</option>
                      <option value="9">41 - 45 años</option>
                      <option value="10">46 - 50 años</option>
                      <option value="11">51 - 55 años</option>
                      <option value="12"> 56 - 60 años</option>
                      <option value="13">61 - 65 años</option>
                      <option value="14">66 - 70 años</option>
                      <option value="15">71 - 75 años</option>
                      <option value="16">76 - 80 años</option>
                      <option value="17">81 - 85 años</option>
                      <option value="18">86 - 90 años</option>
                      <option value="19">91 años - ></option>
                    </select>
                  </div>                  
                  <a class="btn btn-success btn-sm" id="btnBusPr">Generar</a>
                </div>
              </form>                  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>                  
      </div>
      <div class="row">
        <a href="#" class="btn btn-info" id="printRP"><i class="fa fa-print">Imprimir</i></a>
        <input type="hidden" id="tpP">
      </div>
      <div id="reporteEdades">
        
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