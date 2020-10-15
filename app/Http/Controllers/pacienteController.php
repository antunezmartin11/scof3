<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\paciente;
use DB;
use Carbon\Carbon;
use App\Modelos\atencion;
use App\Modelos\consulta;
use App\Modelos\compania_paciente;

class pacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.adminlte.pages.pacientes');
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
    public function Datos($datos){

        $res=DB::table('paciente')->where('dni','=',$datos)
                                ->orWhere('nombre','like',"%$datos%")
                                ->count();
        $respuesta=paciente::where('dni','=',$datos)->orWhere('nombre', 'like', "%$datos%")->get();
        /*$respuesta=DB::table('paciente')
                    ->join('compania_paciente','compania_paciente.id_paciente','=','paciente.id')
                    ->join('compania','compania_paciente.id_compania','=','compania.id')
                    ->join('tipo_seguro','tipo_seguro.id','=','compania.tipo_seguro_id')
                    ->select('paciente.*','compania.id as idcom','compania.nombre as nombrec', 'tipo_seguro.id as ids','tipo_seguro.nombre_aseguradora as nombrea')
                    ->where('paciente.dni','=',$datos)
                    ->orWhere('paciente.nombre', 'like', "%$datos%")->get();*/

        if($res>=1){
            return view('vendor.adminlte.pages.listapacientes')->with('respuesta',$respuesta);    
        }else{
            echo "No hay datos";
        }
    }
    public function listaDia(){        
        $respuesta=atencion::where('fecha','=',Carbon::now()->toDateString())->orderBy('id','desc')->get();
        return view('vendor.adminlte.pages.listadia')->with('respuesta',$respuesta);
    }
    public function listaAtencion(){        
        $respuesta=atencion::where('fecha','=',Carbon::now()->toDateString())
        ->where('estado','=','Pendiente')->get();
        return view('vendor.adminlte.pages.listaAtencion')->with('respuesta',$respuesta);
    }    

    public function AddConsultaDia(Request $request){//Funcion para agregar pacientes a la consuta el dia
        $paciente=paciente::where('id','=',$request->id)->get();
        $ncons=consulta::where('paciente_id','=',$request->id)->get();
        $ulc=$ncons->last();
        $consulta=0;
        if ($ulc) {
            $consulta=$ulc->nconsulta;
        }else{
            $consuta=0;
        }
        $atencion= new atencion;
        $nombre="";
        $tipo="";
        $edad=" ";
        $dni="";
        $fecnac="";
        $idpaciente="";
        foreach ($paciente as $p) {
            $idpaciente=$p->id;
            $nombre= $p->nombre;
            $tipo=$p->tipo_seguro->nombre_aseguradora;
            $edad=$p->edad;
            $dni=$p->dni;
            $fecnac=$p->fecnac;
        }
        $edadActual=Carbon::parse($fecnac)->age;
        $upAge=$actualizar=DB::table('paciente')->where('id',$idpaciente)->update(['edad'=>$edadActual]);
        if($tipo=="PARTICULAR"){
            $planM=$request->planMedi;
            $tipoA=$request->tAtencion;
            $atencion->nhistoria=$request->id;
            $atencion->nconsulta=$consulta+1;
            $atencion->dni=$dni;
            $atencion->nombre=$nombre;
            $atencion->tipo=$tipo;
            $atencion->fecha=Carbon::now()->toDateString();
            $atencion->planmed=$planM;
            $atencion->atencion=$tipoA;
            $atencion->edad=$edad;
            $atencion->estado="Pendiente";
            $atencion->save();      
            if($atencion){
                return response()->json("Paciente Agregado Correctamente");
            }else{
                return response()->json("no funciona");

            }                  
        }else{
            if($request->planMedi=='MEDIDA DE LA VISTA'){
                $an=Carbon::now()->format('Y');
                $fe=DB::select('select count(c.id) as cantidad from paciente p, consulta c, datoprevio dp, planmedico pm where p.id=c.paciente_id and c.id=dp.consulta_id and c.id=pm.consulta_id and pm.planmedico="MEDIDA DE LA VISTA" and substring(c.fechacon,1,4)=:an and p.id=:idp',['an'=>$an,'idp'=>$request->id]);
                foreach ($fe as $fc) {
                    $f=$fc->cantidad;
                }
                if($f=='1'){
                    echo "Ya se realizado una Medida de la vista este año";
                }else{
                    $planM=$request->planMedi;
                    $tipoA=$request->tAtencion;
                    $atencion->nhistoria=$request->id;
                    $atencion->nconsulta=$consulta+1;
                    $atencion->dni=$dni;
                    $atencion->nombre=$nombre;
                    $atencion->tipo=$tipo;
                    $atencion->fecha=Carbon::now()->toDateString();
                    $atencion->planmed=$planM;
                    $atencion->atencion=$tipoA;
                    $atencion->edad=$edad;
                    $atencion->estado="Pendiente";
                    $atencion->save();      
                    if($atencion){
                        echo("Paciente Agregado Correctamentes");
                    }else{
                        echo("Ocurrio un error");
                    }  
                }
            }else{
                $planM=$request->planMedi;
                $tipoA=$request->tAtencion;
                $atencion->nhistoria=$request->id;
                $atencion->nconsulta=$consulta+1;
                $atencion->dni=$dni;
                $atencion->nombre=$nombre;
                $atencion->tipo=$tipo;
                $atencion->fecha=Carbon::now()->toDateString();
                $atencion->planmed=$planM;
                $atencion->atencion=$tipoA;
                $atencion->edad=$edad;
                $atencion->estado="Pendiente";
                $atencion->save();      
                if($atencion){
                    echo("Paciente Agregado Correctamente");
                }else{
                    echo("Ocurrio un error");
                }                                  
            }
        }   
    }    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $res=DB::table('paciente')->where('dni','=',$request->dni)->count();
            if($res>0){
                return response()->json('El paciente ya esta registrado');  
               // $respuesta=paciente::where('dni','=',$request->dni)->get();
                //return view('vendor.adminlte.pages.listapacientes')->with('respuesta',$respuesta);           
            }else{
                $paciente = new paciente;  
                $nac=$request->fecnac; 
                $an=substr($nac,0,4);
                $mes=substr($nac,5,2);
                $dia=substr($nac,8,2);
                $date = Carbon::createFromDate($an,$mes,$dia)->age;
                //Salvamos los datos del modelo
                $paciente->nombre = $request->nombre;
                $paciente->dni = $request->dni;
                $paciente->direccion=$request->direccion;
                $paciente->fecnac=$request->fecnac;
                $paciente->sexo=$request->sexo;
                $paciente->telefono=$request->telefono;
                $paciente->edad=$date;
                $paciente->email=$request->email;
                $paciente->parentesco=$request->parentesco;
                $paciente->tipo_seguro_id=$request->tipoServicio;
                $paciente->save();  
                if($paciente){  
                    $tipos="";
                    $tipoa="";
                    $respuesta=paciente::where('dni','=',$request->dni)->get();
                    //Regristo de la tabla compañia_paciente
                    $compac=new compania_paciente;       
                    $atencion= new atencion;
                    if($request->tipoServicio!=1){//verifico si es una consulta particular o no
                        foreach ($respuesta as $r) {          
                            $compac->id_paciente=$r->id;
                        }                         
                        $compac->id_compania=$request->compania;
                        $compac->save();
                    }
                    foreach ($respuesta as $r) {
                        $atencion->nhistoria=$r->id;          
                    }       
                    $atencion->nconsulta="1";
                    $atencion->dni=$request->dni;
                    $atencion->nombre=$request->nombre;
                    $tps=DB::table('tipo_seguro')->where('id','=',$request->tipoServicio)->get();
                    foreach ($tps as $tps) {
                        $tipos=$tps->nombre_aseguradora;
                    }                    
                    /*
                    PENDIENTE PARA MEJORAR
                    switch ($request->tipo_servicio_id) {
                        case '1':
                            $tipos="PARTICULAR";
                            break;
                        case '2':
                            $tipos="RIMAC";
                            break;
                        default:
                            # code...
                            break;
                    }*/
                    $atencion->tipo=$tipos;      
                    $atencion->fecha=Carbon::now()->toDateString();
                    $atencion->planmed=$request->planmedico;
                    /*switch ($request->idtipo_plan) {
                        case '1':
                            $tipoa="AMBULATORIO";
                            break;
                        case '2':
                            $tipoa="EMERGENCIA";
                            break;
                        case '3':
                            $tipoa="PREVENTIVA";
                            break;
                        case '4':
                            $tipoa="DOMICILIARIA";
                            break;
                        default:
                            # code...
                            break;
                    }*/
                    $atencion->atencion=$request->tipoAtencion;
                    $atencion->edad=$date;
                    $atencion->estado="Pendiente";
                    $atencion->save();      
                    $vwPac= view('vendor.adminlte.pages.listapacientes')->with('respuesta',$respuesta);               
                    return response()->json(['mensaje'=>'registrado','datos'=>$vwPac]);

                }else{
                    echo("ocurrio un error");
                }                          
            }                     
        }else{
            echo("No se recibieron Datos");
        }    
    }
    public function consultaAnno($idP){
        $anno=Carbon::now()->format('Y');
        $respuesta=DB::select('select p.id, p.nombre,c.id as idc, c.nconsulta, dp.fechacon, pm.planmedico  FROM paciente p, consulta c, planmedico pm, datoprevio dp where p.id=c.paciente_id and c.id=pm.consulta_id and c.id=dp.consulta_id and p.id=:idp and substring(dp.fechacon,1,4)=:anno',['idp'=>$idP, 'anno'=>$anno]);
        return view('vendor.adminlte.pages.listaAtencionAn')->with('respuesta',$respuesta);
    }
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
        $paci=Paciente::where('dni','=',$id)->get();
        return response()->json($paci);
    }
    public function ObtenerCompania(Request $request){
        $obc=DB::table('compania_paciente')
                ->join('compania','compania_paciente.id_compania','=','compania.id')
                ->select('compania_paciente.*','compania.nombre')        
                ->where('compania_paciente.id_paciente','=',$request->id)->get();
        return response()->json($obc);
        
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
        if($request->ajax()){
            $nac=$request->fecnac; 
            $an=substr($nac,0,4);
            $mes=substr($nac,5,2);
            $dia=substr($nac,8,2);
            $nombre=$request->nombre." ";
            $edad = Carbon::createFromDate($an,$mes,$dia)->age;            
            $actualizar=DB::table('paciente')->where('id',$id)->update(['nombre'=>$nombre,'dni'=>$request->dni,'direccion'=>$request->direccion,'fecnac'=>$request->fecnac,'sexo'=>$request->sexo,'telefono'=>$request->telefono,'edad'=>$edad,'email'=>$request->email,'parentesco'=>$request->parentesco,'tipo_seguro_id'=> $request->tiposer]);
            if($actualizar){//si se ejecuta la actualizacion
                $verReg=DB::table('compania_paciente')->where('id_paciente',$id)->count();
                if($request->tiposer!="1"){//Verifica el tipo de servicio
                    if($verReg==0){//
                        $regCom=new compania_paciente;
                        $regCom->id_paciente=$id;
                        $regCom->id_compania=$request->compania;
                        $regCom->save();
                        if($regCom){
                            echo "Datos Actualizados";
                        }else{
                            echo "Ocurrio un error registrando la compania";
                        }
                    }elseif($verReg==1){//Se reaiiza la actualizacion
                        $actualizarComp=DB::table('compania_paciente')
                        ->where('id_paciente',$id)
                        ->update(['id_compania'=>$request->compania]);
                        if($actualizarComp){
                            echo "Datos Actualizados";
                        }else{
                            echo "No se pudo actualizar la compania";
                        }                        
                    }
                }else{
                    if($verReg==0){
                        echo "Datos Actualizados";
                    }elseif($verReg==1){                        
                        $eliCo=DB::table('compania_paciente')->where('id_paciente','=',$id)->delete();
                        if($eliCo){
                            echo "Datos Actualizados";
                        }else{
                            echo "Ocurrio un error eliminado la compania";
                        }
                    }                    
                }                
            }else{
                $verReg=DB::table('compania_paciente')->where('id_paciente',$id)->count();
                if($request->tiposer!="1"){//Verifica el tipo de servicio
                    if($verReg==0){//
                        $regCom=new compania_paciente;
                        $regCom->id_paciente=$id;
                        $regCom->id_compania=$request->compania;
                        $regCom->save();
                        if($regCom){
                            echo "Datos Actualizados";
                        }else{
                            echo "Ocurrio un error registrando la compania";
                        }
                    }elseif($verReg==1){//Se reaiiza la actualizacion
                        $actualizarComp=DB::table('compania_paciente')
                        ->where('id_paciente',$id)
                        ->update(['id_compania'=>$request->compania]);
                        if($actualizarComp){
                            echo "Datos Actualizados";
                        }else{
                            echo "No se pudo actualizar la compania";
                        }                        
                    }
                }else{
                    if($verReg==0){
                        echo "Datos Actualizados";
                    }elseif($verReg==1){                        
                        $eliCo=DB::table('compania_paciente')->where('id_paciente','=',$id)->delete();
                        if($eliCo){
                            echo "Datos Actualizados";
                        }else{
                            echo "Ocurrio un error eliminado la compania";
                        }
                    }                    
                }                  
            }
        }else{
            echo "No se recibieron Datos";
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//funcion para ele,inar registro de un paciente
    {
        $pac=paciente::where('id',$id)->get();
        $idp=$pac[0]->id;
        $epa=$epa=DB::table('paciente')->where('id',$idp)->delete();
        if($epa){
            return Response()->json(['mensaje'=>'1']);
        }else{
            return Response()->json(['mensaje'=>'2']);
        }
        /*$econ=$con->delete();
        if($econ){
            return Response()->json(['mensaje'=>'1']);
        }else{
            return Response()->json(['mensaje'=>'2']);
        }*/
    }
}
