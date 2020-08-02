@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

  @if (Auth::user()->tipo_users_id==1)
    <div class="container-fluid spark-screen">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-user-plus"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pacientes</span>
                  <span class="info-box-number"><?php $cp=DB::table('paciente')->count(); echo $cp; ?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                      <span class="progress-description">
                        <a href="Paciente" style="color: white">Agregar a consulta</a>
                      </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-user-md"></i></span>

                <div class="info-box-content">

                  <span class="info-box-text">Consulta</span>
                  <span class="info-box-number"><?php $cc=DB::table('atencion')->where('fecha','=',Carbon\Carbon::now()->toDateString())->where('estado','=','Pendiente')->count(); echo $cc; ?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                      <span class="progress-description">
                        <a href="Consulta" style="color: white;">Pacientes en espera</a>
                      </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa  fa-hospital-o"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Historias Clinicas</span>
                  <span class="info-box-number"><?php $ch=DB::table('consulta')->count(); echo $ch; ?> </span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                      <span class="progress-description">
                        <a href="" style="color: white;">Ver/Buscar Historias</a>
                      </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-file-code-o"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Reportes</span>
                  <span class="info-box-number">Generar</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                      <span class="progress-description">
                        
                        <a href="" style="color: white;">Ver Opciones</a>
                      </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
      </div>  
      <br>
  @elseif(Auth::user()->tipo_users_id==2)
  <div class="container-fluid spark-screen">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-user-plus"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pacientes</span>
                <span class="info-box-number"><?php $cp=DB::table('paciente')->count(); echo $cp; ?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      <a href="Paciente" style="color: white">Agregar a consulta</a>
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-user-md"></i></span>

              <div class="info-box-content">

                <span class="info-box-text">Consulta</span>
                <span class="info-box-number"><?php $cc=DB::table('atencion')->where('fecha','=',Carbon\Carbon::now()->toDateString())->where('estado','=','Pendiente')->count(); echo $cc; ?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      <a href="Consulta" style="color: white;">Pacientes en espera</a>
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="fa  fa-hospital-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Historias Clinicas</span>
                <span class="info-box-number"><?php $ch=DB::table('consulta')->count(); echo $ch; ?> </span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      <a href="{{url('Historia')}}" style="color: white;">Ver/Buscar Historias</a>
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
              <span class="info-box-icon"><i class="fa fa-file-code-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Reportes</span>
                <span class="info-box-number">Generar</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      
                      <a href="{{url('ParteDiario')}}" style="color: white;">Ver Opciones</a>
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
    </div>  
    <br>
  @else
    <div class="container-fluid spark-screen">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-user-plus"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pacientes</span>
                  <span class="info-box-number"><?php $cp=DB::table('paciente')->count(); echo $cp; ?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                      <span class="progress-description">
                        <a href="Paciente" style="color: white">Agregar a consulta</a>
                      </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>                                    
            <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
              <span class="info-box-icon"><i class="fa fa-file-code-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Compañias</span>
                <span class="info-box-number">0</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      
                      <a href="compania" style="color: white;">Registrar</a>
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>            
          </div>
      </div>  
      <br>
  @endif  
	
@endsection

