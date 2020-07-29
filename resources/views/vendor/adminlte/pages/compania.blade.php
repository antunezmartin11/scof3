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
          <h3 class="box-title">Registro de Compañias</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
          </div>              
        </div>
        <div class="box-body">
          <form id="frmCompaniaC">
            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">            
            <div class="form-group">
              <label class="control-label col-md-1">Nombre:</label>
              <div class="col-md-5">
                <input type="text" class="form-control input-sm" id="nomCompania" name="nomCompania">
              </div>
              <label class="control-label col-md-1">RUC:</label>
              <div class="col-md-5">
                <input type="text" class="form-control input-sm" id="rucCompania" name="rucCompania"><br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-1">Aseguradora:</label>
              <div class="col-md-5">
                <?php 
                  $as=DB::table('tipo_seguro')->get();
                 ?>
                <select name="idAseguradora" id="idAseguradora" class="form-control input-sm">
                  <option value="">Seleccionar</option>
                  @foreach ($as as $a)
                  <option value="{{$a->id}}">{{$a->nombre_aseguradora}}</option>
                  @endforeach
                </select>
              </div>

            </div>               
            <div class="col-md-12">
              <div class="box-header with-border">
                <h3 class="box-title">Registro Costos</h3>
              </div>                
            </div>                  
            <div class="form-group">
              <label class="control-label col-md-1">Copago Fijo</label>
              <div class="col-md-5">                
                <input type="text" class="form-control input-sm" id="copagoFijo">
              </div>    
              <label class="control-label col-md-1">Copago Variable</label>        
              <div class="col-md-5">
                <input type="text" class="form-control input-sm" id="copagoVariable" >
              </div>  
            </div>
            <!-- /.box-header -->
            <!-- form start -->
               
            <div class="col-md-12">              
              <a class="btn btn-success btn-sm" id="btnCompania" onclick="RegistroCompania()">&nbsp<i class="fa fa-save" id="titCom">Guardar</i></a>
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
          <h3 class="box-title">Lista de Compañias</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Expandir">
            <i class="fa fa-plus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
          </div>              
        </div>
        <div class="box-body">
          <div id="tblCompania">
            
          </div>
        </div>
            <!-- /.box-header -->
            <!-- form start -->
      </div>
    </div>         
	</div>

@endsection
            
 
<script src="{{ asset('js/funcionescompania.js') }}"></script>     
<script src="{{ asset('js/validar.js') }}"></script>  
<script>

</script>