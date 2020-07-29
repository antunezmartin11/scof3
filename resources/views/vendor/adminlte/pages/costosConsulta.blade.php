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

  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
    <div class="container-fluid sspark-screen">    
        <div class="row">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">   
              Actualizacion de Costos
            </div>
            <div class="panel-body">
              <form  class="form-horizontal">
                @foreach ($dat as $d)
                <div class="form-group">
                  <label class="control-label col-md-3">{{$d->procedimiento}} </label>
                  <div class="col-md-2">
                    <input type="text" class="form-control" value="{{$d->costo}}" id="costo{{$d->id}}">
                  </div>
                  <div class="col-md-2">
                    <a class="btn btn-warning" onclick="actualizarCostos({{$d->id}})">Actualizar</a>
                  </div>
                </div>
                @endforeach
                              
              </form>
            </div>
          </div>
        </div>            
      </div>
  @else
      @include('adminlte::errors.503')
  @endif
	
@endsection
<script src="{{ asset('js/funcionescompania.js') }}"></script>     
<script src="{{ asset('js/validar.js') }}"></script>  
<script>

</script>