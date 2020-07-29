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
                    <!-- /.box-header -->
                    <!-- form start -->
              <form class="form-horizontal" id="formUsuario">
                  <div class="box-body">
                       <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Nombre:</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control input-sm" id="nombreU" name="nombreU" placeholder="Nombre de Usuario">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Apellidos:</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU" placeholder="Apellidos del Usuario">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2">DNI:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control input-sm" placeholder="Ingreso su N° DNI" id="dniU" name="dniU">
                        </div>
                        <label for="" class="control-label col-sm-2">E-mail</label>
                        <div class="col-sm-3">
                          <input type="email" class="form-control input-sm" placeholder="Ingrese su email" id="emailU" name="emailU">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2">Telefono:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control input-sm" placeholder="Ingrese un Telefono" id="telefonoU" name="telefonoU">
                        </div>
                        <label class="col-sm-2 control-label">Fecha Nacimiento:</label>
                        <div class="col-sm-3">
                          <input type="date" class="form-control input-sm" id="fecU" name="fecU">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2">Usuario:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control input-sm" placeholder="Ingrese su Usuario" id="usuario" name="usuario">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2">Contraseña:</label>
                        <div class="col-sm-3">
                          <input type="password" class="form-control input-sm" placeholder="Ingrese su Usuario" id="contra" name="contra">
                        </div>
                        <label class="control-label col-sm-2">Verificar Contraseña:</label>
                        <div class="col-sm-3">
                          <input type="password" class="form-control input-sm" placeholder="Vuelva a ingresar su contraseña" id="Vcontra" name="Vcontra">
                        </div>                                        
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2">Tipo Usuario:</label>
                        <div class="col-sm-4">
                          <select name="tipoU" id="tipoU" class="form-control input-sm">
                            <option value="Seleccionar">Seleccionar</option>
                            <?php 
                              $tu=DB::table('tipo_users')
                                          ->whereNotIn('id', [1])
                                          ->get();
                             ?>
                             @foreach ($tu as $tu)
                              <option value="{{$tu->id}}">{{$tu->tipo}}</option>
                             @endforeach
                          </select>
                        </div>
                      </div>
      
                  </div>
                      <!-- /.box-body -->
                  <div class="box-footer">
                        <button type="submit" class="btn btn-default">Cancel</button>
                        <a href="#" class="btn btn-success pull-right" id="btnA">Registrar</a>
                  </div>
                      <!-- /.box-footer -->
              </form>
          </div>         
        </div>
     
      </div>
    </div>
  @else
  @include('adminlte::errors.503')
  @endif
@endsection
            
 
<script src="{{ asset('js/funcionesUsuario.js') }}"></script>     
