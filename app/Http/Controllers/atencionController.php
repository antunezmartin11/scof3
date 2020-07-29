<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\atencion;
use App\Modelos\paciente;
use DB;
use Carbon\Carbon;
class atencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function listaCom(){//devuelvo la lista de pacientes listos para atencion
        $atencion=paciente::all();
        return response()->json($atencion);
    }


    public function listaConsulta(){//devuelvo la lista de 3 pacientes para su atencion
    $cnd=DB::table('atencion')->where([['fecha',Carbon::now()->toDateString()],['estado','pendiente'] ])->take(3)->orderBy('id','asc')->get();

    return view('vendor.adminlte.pages.listaConsulta')->with('cnd',$cnd);

    }
    public function listaConsultaPacientes(){//devuelvo la lista de 3 pacientes para su atencion
        $cnd=DB::table('atencion')->where([['fecha',Carbon::now()->toDateString()],['estado','pendiente'] ])->orderBy('id','desc')->get();
    
        return view('vendor.adminlte.pages.listaConsultaRecepcion')->with('cnd',$cnd);
    
    }
    //Funcion para eliminar pacientes para atencion
    public function eliminarAtencion($id){
        $atencion=atencion::FindOrFail($id);
        $EliCom=$atencion->delete();  
        
    }

    //Fin de funcion para eliminar pacientes
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $atencion=paciente::where('dni',$id)->get();
        return response()->json($atencion);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
