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
              <h3 class="box-title">Resumen general de procedimientos por fechas</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">                  
              <form  id="frmProcRes">
                <div class="form-group">
                  <label class="col-sm-1">Desde:</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control input-sm" id="fecIniP">
                  </div>
                  <label class="control-label col-sm-1">Hasta:</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control input-sm" id="fecFinP">
                  </div>
                  <a class="btn btn-success btn-sm" id="btnBusRP">Generar</a>
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
              <h3 class="box-title">Resumen de procedimientos por fechas</h3>

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
                  <a class="btn btn-success btn-sm" id="btnBusPr">Generar</a>
                </div>
              </form>                  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>  
        <!-- Expandible mas frecuente-->        
                
      </div>
      <div class="row">
        <a href="#" class="btn btn-info" id="printRP"><i class="fa fa-print">Imprimir</i></a>
        <input type="hidden" id="tpP">
      </div>
      <div id="reporteProcedimiento">
        
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