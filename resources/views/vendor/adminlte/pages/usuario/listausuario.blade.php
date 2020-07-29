@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
    <div class="container">
      <div class="row">
        <div class="col-sm-10">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Registro de Usuario</h3>
              </div>
              <div class="box-body with-border" id="contenido">

              </div>    
          </div>         
        </div>
      </div>
    </div>    
    <!-- Modal para editar registro de usuarios -->
    <div class="modal fade" id="editarU" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="">
              <input type="text" class="form-control input-sm" id="nombreUM" value="fdgdg">
            </form>
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Modificar Usuario</h3>
              </div>
              <div class="box-body with-border">
                <div class="container">
                  <form action="" class="form-horizontal" id="frmPersona">
                    <div class="form-group">
                      <label class="control-label col-sm-1">Nombre: </label>
                      <div class="col-sm-4">

                        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                        <input type="hidden" id="idp">
                      </div>
                    </div>
                  </form>
                </div>
              </div>    
          </div> 
          <div class="box-footer with-border">
            <div class="pull-right">
              <a class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close">&nbsp;Cancelar</i></a>
              <a href="#" class="btn btn-success" id="btnEditarP"><i class="fa fa-save">&nbsp;Guardar</i></a>
            </div>
          </div>       
        </div>
      </div>
    </div>    
    <!--Fin de modal de editar usuarios -->

    <!-- Modal para modificar la contraseña-->
    <div class="modal fade" id="modalContra" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <form action="" class="form-horizontal">
              <div class="form-group">
                <label class="control-label col-sm-2">Usuario:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control input-sm">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Nueva Contraseña:</label>
                <div class="col-md-4">
                  <input type="text" class="form-control input-sm">
                </div>
                <label class="control-label col-sm-2">Repita Contraseña:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control input-sm">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success btn-sm">Guardar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Final del modal para modificar la contraseña-->
  @else
    @include('adminlte::errors.503')
  @endif
@endsection
            
 
<script src="{{ asset('js/funcionesUsuario.js') }}"></script>     
