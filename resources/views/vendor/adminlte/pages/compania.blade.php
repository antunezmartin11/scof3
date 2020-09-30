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

  <!-- Inicio Modal para modificar   -->


  
  <div class="modal fade" tabindex="-1" role="dialog" id="modalMod">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar Compañias</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="formModal">
          <div class="form-group">
            <input type="hidden" id="idCompa">
            <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nombreCo" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">RUC</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="rucom" placeholder="RUC">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Aseguradora</label>
            <div class="col-sm-10">
              <select id="idAseguradoraM" class="form-control input-sm">
                  <option value="0">Seleccionar</option>
                  @foreach ($as as $a)
                  <option value="{{$a->id}}">{{$a->nombre_aseguradora}}</option>
                  @endforeach
                </select>            
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Copago Fijo</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="copaFM">
            </div>
            <label for="" class="col-sm-2 control-label">Copago Variable</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="covaM">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="modificarModal()">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Fin Modal para modificar   -->
@endsection
            
 
<script src="{{ asset('js/funcionescompania.js') }}"></script>     
<script src="{{ asset('js/validar.js') }}"></script>  
<script>

</script>