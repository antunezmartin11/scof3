@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">  
	@if (Auth::user())
    <div class="container">
      <div class="row">
        <div class="col-sm-10">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Lista de Usuarios</h3>
              </div>
              <div class="box-body with-border" id="contenido">

              </div>    
          </div>         
        </div>
      </div>
    </div>  
<!--Inicio de Modal para modificar datos de personas- -->
   <div class="modal fade" id="editarU" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Modificar Usuario</h3>
              </div>
              <div class="box-body with-border">
                <div class="container">
                  <form action="" method="post" class="form-horizontal" id="frmPersona">
                    <div class="form-group">
                      <label class="control-label col-sm-1">Nombre: </label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control input-sm" id="nombreUM" name="nombreUM">
                        <input type="hidden" id="idp" name="idp">
                        <input type="hidden" id="idu" name="idu">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-1">Apellido:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control input-sm" id="apellidoUM" name="apellidoUM">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-1">DNI:</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control input-sm" id="dniUM" name="dniUM">
                      </div>
                      <label class="control-label col-sm-1">E-mail</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control input-sm" id="emailUM">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-1">Fec. Nac</label>
                      <div class="col-sm-2">
                        <input type="date" class="form-control input-sm" id="fecUM">
                      </div>
                      <label class="control-label col-sm-1">Telefono</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control input-sm" id="telefonoUM">
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
<!--Fin de modal para modificar datos de personas-->

<!--Inicio de Modal para modificar Contraseña- -->
   <div class="modal fade" id="editarC" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Cambiar datos de Acceso</h3>
              </div>
              <div class="box-body with-border">
                <div class="container">
                  <form action="" id="frmusu">
                    <label class="control-label col-sm-1">Usuario: </label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control input-sm" id="musuario">
                    </div>
                    <div class="col-sm-1">
                      <a class="btn btn-primary btn-sm" onclick="modificarContraseña(3)"><i class="fa fa-save"> Guardar</i></a>
                    </div>
                  </form>
                </div>
                <div class="container">
                  <form action="" method="post" id="frmContraseña">
                    <input type="hidden" id="idus">
                    <div class="col-sm-3">
                      <h4>Generar contraseña Automatica</h4><br>
                      <a href="#" class="btn btn-info btn-sm" onclick="modificarContraseña(1)">Generar</a>
                      <div class="col-sm-10" style="padding-top: 10px;">
                        <input type="text" class="form-control input-sm" enabled="false" id="nuevaP">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <h4>Generar contraseña Manual</h4>
                      <div class="form-group">
                        <label class="control-label col-sm-8">Nueva Contraseña</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control input-sm" id="ncont">
                        </div>                        
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-8">Repita la Contraseña</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control input-sm" id="rncont">
                        </div>
                      </div>
                      
                      <div class="form-group">     
                        <div class="col-sm-12" style="padding-top: 10px;">
                          <div class="pull-right">
                            <a class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close">&nbsp;Cancelar</i></a>
                            <a href="#" class="btn btn-success btn-sm" onclick="modificarContraseña(2)"><i class="fa fa-save">&nbsp;Guardar</i></a>
                          </div>                           
                        </div>         
                       
                      </div>                      
                    </div>                        
                  </form>

                </div>
              </div>    
          </div> 
     
        </div>
      </div>
    </div>
<!--Fin de modal para modificar contraseña-->
  @else
    @include('adminlte::errors.503')

  @endif
  

@endsection
            
 
<script src="{{ asset('js/funcionesUsuario.js') }}"></script>     
