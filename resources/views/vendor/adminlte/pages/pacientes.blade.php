@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

	@if (Auth::user())
<div class="container-fluid ">
        <h1 style="text-align: center; color: #12A0D5">REGISTRO DE PACIENTES PARA CONSULTA</h1>
          <div class="row">
              <div class="col-md-12">
                <form id="frmPaciente">
                  <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Nombres:</label>
                      <input type="text" class="form-control" placeholder="Ingrese su nombre" id="nombre" name="nombre">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Direccion:</label>
                      <input type="text" class="form-control" placeholder="Ingrese su direccion" name="direccion" id="direccion">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="inputPassword4">DNI</label>
                      <input type="text" class="form-control" placeholder="Ingrese su DNI" id="dni" name="dni" >
                    </div>
                    <div class="form-group col-md-1">
                      <label>Buscar:</label>
                      <a href="#" class="btn btn-info" id="btnBuscarPaciente">Buscar</a>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputEmail4">Fec. Nac:</label>
                      <input type="date" class="form-control" name="fecnac" id="fecnac">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="">Sexo:</label>
                      <select class="form-control" name="sexo" id="sexo" >
                        <option value="0" selected>Seleccionar</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="inputEmail4">Telefono:</label>
                      <input type="text" class="form-control" placeholder="Ingrese el numero de telefono" name="telefono" id="telefono">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="inputPassword4">E-mail:</label>
                      <input type="email" name="email" class="form-control" placeholder="Ingrese su correo electronico" id="email">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="inputCity">Tipo de Servicio</label>
                      <select class="form-control" name="tipoServicio" id="tipoServicio">
                        <option value="0">Seleccionar</option>
                        <option value="1">PARTICULAR</option>
                        <option value="2">RIMAC SEGUROS</option>
                        <option value="3">RIMAC EPS</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label >Compañia</label>
                      <select id="compania" class="form-control" name="compania">
                        <option value="Seleccionar">Seleccione</option>
                        
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Parentesco</label>
                      <select class="form-control" name="parentesco" id="parentesco">
                        <option value="0">Seleccionar</option>  
                        <option selected value="TItular">Titular</option>
                        <option value="Conyuge">Conyuge</option>
                        <option value="Hijo(a)">Hijo(a)</option>
                        <option value="Madre">Madre</option>
                        <option value="Padre">Padre</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label>Plan Medico</label>
                      <select class="form-control" name="planmedico" id="planmedico">
                        <option value="0">Seleccionar</option>
                        <option value="CONSULTA" selected>Consulta</option>
                        <option value="MEDIDA DE LA VISTA">Medida de la vista</option>
                        <option value="SCTR">SCTR</option>
                        <option value="EVALUACION PREVENTIVA">Medida de la vista</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Tipo de Atencion</label>
                      <select class="form-control" name="tipoAtencion" id="tipoAtencion">
                        <option value="0" >Seleccionar</option>
                        <option value="AMBULATORIO" selected>AMBULATORIO</option>
                        <option value="PREVENTIVO">PREVENTIVO</option>
                        <option value="EMERGENCIA">EMERGENCIA</option>
                        <option value="DOMICILIARIA">DOMICILIARIA</option>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
          </div>
          <div id="upload-img" style="display: none;"></div>
          </div>
          <a href="#" class="btn btn-success" id="btnAgregarPaciente" >Agregar</a>
          &nbsp; <a href="#" class="btn btn-info" id="btnLimpiar" >Limpar Campos</a>
          &nbsp; <a href="#" class="btn btn-warning" id="btnListaP">Pacientes del dia</a>
          <div class="row" id="seccionTabla">

          </div>
      </div>
  
        <!-- Modal de registro-->


    <!--Fin de modal de lista de pacientes -->
    <!--Incio modal de Complemento -->

    <!--Fin de modal de complemento-->
    <!--Inicio Modal de atenciones al año -->

    <!--Fin Modal de atenciones al año -->

    <!--Modal para agregar una compania -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pacientes registrados hoy</h4>
      </div>
      <div class="modal-body">
        <div class="box-body" id="listaPaciente">

        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalHistoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pacientes registrados hoy</h4>
      </div>
      <div class="modal-body">
        <div class="box-body" id="tblHistorias">

        </div>
      </div>
    </div>
  </div>
</div>
  @else
    @include('adminlte::errors.503')

  @endif
  

@endsection
            
 
<script src="{{ asset('js/funcionesPaciente.js') }}"></script>     
<script src="{{ asset('js/validar.js') }}">


</script>  
<script>

window.addEventListener('load', function(){  
//Funcion para cargar los pacientes del dia

//Fin de funcion para cargar los pacientes del dia
 $('#btnListaP').click(function(){
  $('#myModal').modal('show');
  listConsulta()
 });
 $('#btnHistorias').click(function(){
   $('#modalHistoria').modal('show');
 });
 }, false);  
 function listConsulta(){
         token=$('#token').val();    
        $.ajax({
            url: "listaPacientesDiaRecepcion",
            type: "GET",
            headers: {'X-CSRF-TOKEN': token},
            success: function(dato){
                $('#listaPaciente').empty().html(dato);
              
            },
            error: function(){
                alertify.error('Ocurrie un error')
            }
        });       
    }
</script>