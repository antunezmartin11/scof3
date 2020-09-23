@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


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
          <div class="col-md-2">
                <input type="text" class="form-control" id="cod_cie" onchange="cambio()">
          </div>
          <div class="col-md-10">
                <input type="text" class="form-control" id="desc_enf">
            </div>
          </form>
        </div>
            <!-- /.box-header -->
            <!-- form start -->
            <button class="btn btn-primary" onclick="cargarValor()">Traer datos</button>
      </div>
    </div>    
        
	</div>

@endsection
            
 
<script src="{{ asset('js/funcionescompania.js') }}"></script>     

<script>
window.addEventListener('load', function(){
    
    cargarValor()

})
    function cargarValor(){ 
        var cod = new Array()
        var nom = new Array()
        
                $.ajax({
                    url:'cie1.json',
                    method:'get',
                    datatype:'json',
                    success: function (res){
                        for (let i = 0; i < res.length; i++) {
                            var cad={"num":res[i].num,"codigo":res[i].cod_cie,'nombre':res[i].desc_enf}
                            cod.push(res[i].cod_cie)
                            nom.push(res[i].desc_enf)   
                        }
                        $('#cod_cie').autocomplete({
                            source: cod,
                            minLength: 2
                        })
                        $('#desc_enf').autocomplete({
                            source: nom,
                            minLength: 2
                        })
                    },
                    error: function(re){
                        console.log(re)
                    }
                });

    }

    function cambio(){
        var c=$('#cod_cie').val()
        $.ajax({
                url:'cie1.json',
                method:'get',
                datatype:'json',
                success: function (res){
                    for (let i = 0; i < res.length; i++) {
                        //var cad={"num":res[i].num,"codigo":res[i].cod_cie,'nombre':res[i].desc_enf} 
                        if(res[i].cod_cie==c){
                            $('#desc_enf').val(res[i].desc_enf)
                        }
                    }

                    },
                    error: function(re){
                        console.log(re)
                    }
                });        
    }

</script>