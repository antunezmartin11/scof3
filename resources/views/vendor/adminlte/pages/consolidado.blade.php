@extends('adminlte::layouts.app')
<style>
  .oculto{
    display: none;
  }
</style>
@section('main-content')

  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
    <div class="container-fluid spark-screen">
        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
      <div class="row">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Generar Consolidado de atenciones</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
            </div>              
          </div>
          <div class="box-body">
            <div class="consolidado">
              <div class="">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Aseguradora</label>
                    <div class="col-sm-4">
                      <?php
                        $tiA=DB::table('tipo_seguro')->get();
                      ?>
                      <select name="tipoAseguradora" id="tipoAseguradora" class="form-control">
                      <option value="">Seleccionar</option>
                        @foreach ($tiA as $ti)
                        <option value="{{$ti->id}}">{{$ti->nombre_aseguradora}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fec1" class="col-sm-2 control-label">Desde</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="fec1" placeholder="Password">
                    </div>
                    <label for="fec2" class="col-sm-2 control-label">Hasta</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="fec2" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <a href="#" class="btn btn-success" onclick="excel()">Generar Consolidado</a>
                    </div>
                  </div>
                </form>
              </div>
              <br>

            </div>
          </div>
              <!-- /.box-header -->
              <!-- form start -->
        </div>
      </div>
        
    </div>
    <!--Modal para agregar procedimienos -->


  @else
  @include('adminlte::errors.503')
  @endif

@endsection             
<script src="{{ asset('js/funcionesPago.js') }}"></script>     
<script>
function excel(){
  var ta=$('#tipoAseguradora').val()
  var fec1=$('#fec1').val()
  var fec2=$('#fec2').val()

  if(ta.length>0 && fec1.length>9 && fec2.length>9){
    location.href="getConsolidado/"+ta+"/"+fec1+"/"+fec2
  }else{
    alert('Indique todos los parametros')
  }


  
}
</script>