@extends('adminlte::layouts.errors')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.serviceunavailable') }}
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-red">503</h2>
        <div class="error-content">

            <h3><i class="fa fa-warning text-red"></i> <strong>Oops! No se pudo procesar tu peticion</strong></h3>
            <p> <strong>
                Puede volver al menu de <a href='{{ url('/home') }}'>Inicio</a> O intente otra de las opciones disponibles </strong>
            </p>
        </div>

    </div><!-- /.error-page -->
@endsection
