@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

<style>
  li{
    cursor: pointer;    
  }

</style>
@section('main-content')
  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
    <div class="row">
        <div class="panel panel-info">
          <div class="panel-heading">
            <input type="hidden" value="Buscar" id="pagina">
            Buscar Historias
          </div>
          <div class="panel-body">
            <form  id="frmHistorias">
              <div class="form-group">
                <label class="col-md-1">DNI:</label>
                <div class="col-md-3">
                  <input type="text" class="form-control input-sm" id="dniHis" onchange="desNom()">
                </div>
                <label class="control-label col-md-1">Nombres</label>
                <div class="col-md-6">
                  <input type="text" class="form-control input-sm" id="nomH" onchange="desDNI()">
                </div>
                <a class="btn btn-primary" onclick="buscarHistoria()" id="btnH">Buscar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id="nombres">
        
      </div>
      <div id="historiasE">
        
      </div>
  @else
  @include('adminlte::errors.503')
  @endif  
<!--Incio modal de lista de pacientes -->

<!--Fin Modal de atenciones al año -->
@endsection
            
 
<script src="{{ asset('js/funcionesHistoria.js') }}"></script>     
<script src="{{ asset('js/validar.js') }}"></script>  
<script>

</script>