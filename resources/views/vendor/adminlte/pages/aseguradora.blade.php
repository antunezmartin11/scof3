@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

<style>
  li{
    cursor: pointer;    
  }
  li:hover{
    background-color: #727272;
    color: #ECECEC;
  }
</style>
@section('main-content')
	<div class="container-fluid spark-screen">
    <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Registro de Aseguradoras</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
          </div>              
        </div>
        <div class="box-body">
          <form id="frmAseguradora" name="frmAseguradora">
            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
            <div class="form-group">
              <label class="control-label col-md-2">Nombre Aseguradora:</label>
              <div class="col-md-4">
                <input type="text" class="form-control input-sm" id="nomAseguradora" name="nomAseguradora">
              </div>
              <label class="col-md-1 control-label">RUC:</label>
              <div class="col-md-5">
                <input type="text" class="form-control input-sm" id="rucAseguradora" name="rucAseguradora"><br> 
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-1">Documento:</label>
              <div class="col-md-3">
                <input type="text" class="form-control input-sm" id="tipoDocuA" name="tipoDocuA">
              </div>
              <label class="control-label col-md-1">Producto:</label>
              <div class="col-md-3">
                <input type="text" class="form-control input-sm" id="tipoProducA" name="tipoProducA">
              </div>
              <label class="control-label col-md-1">Moneda:</label>
              <div class="col-md-3">
                <input type="text" class="form-control input-sm" id="tipoMoneda" name="tipoMoneda">
              </div>
            </div><br>
            <div class="form-group">
              <a class="btn btn-success btn-sm" id="btnGuardarAse" onclick="RegistroAseguradora();"><i class="fa fa-save" id="titAse"> Guardar</i></a> &nbsp <a class="btn btn-warning btn-sm" style="display: none;" id="btnModAsegura"><i class="fa fa-edit">Modificar</i></a>
            </div>              
          </form>
        
        </div>
            <!-- /.box-header -->
            <!-- form start -->
      </div>
    </div>
    <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Aseguradoras</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Expandir">
            <i class="fa fa-plus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
          </div>              
        </div>
        <div class="box-body">
          <div id="tblAseguradora">
            
          </div>
        </div>
            <!-- /.box-header -->
            <!-- form start -->
      </div>
    </div>         
	</div>

@endsection
            
 
<script src="{{ asset('js/funcionesAseguradora.js') }}"></script>     
<script src="{{ asset('js/validar.js') }}"></script>  
<script>

</script>