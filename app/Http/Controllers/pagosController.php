<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Modelos\procedimientos;
use App\Modelos\tratamiento;
use App\Modelos\pago;
use App\Modelos\pago_procedimiento;
use App\Exports\consolidado;
use App\Modelos\costobase;
use App\Modelos\costo_compania;
use App\Modelos\compania;
use Maatwebsite\Excel\Facades\Excel;

class pagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a=DB::select('select p.id, p.nombre, c.nconsulta,c.id as idc, c.fechacon, ts.nombre_aseguradora, pm.planmedico, co.nombre as nombreco, c.estadoPago as estado, c.id as idconsulta
            from paciente p, consulta c, datoprevio dt, planmedico pm, tipo_seguro ts, compania co, compania_paciente cop 
            where ts.id=p.tipo_seguro_id and p.id=c.paciente_id and p.id=cop.id_paciente and co.id=cop.id_compania and c.id=dt.consulta_id and c.id=pm.consulta_id and c.fechacon=:fec and p.tipo_seguro_id!="1"',['fec'=>Carbon::now()->toDateString()]);            
        return view('vendor.adminlte.pages.pagos', compact('a'));
    }
    public function pagosporDia($fecha){//Funcion que devuelve los registro de pago por dias especificos
        $a=DB::select('select p.id, p.nombre, co.id as idcompania, c.nconsulta,c.id as idc, c.fechacon, ts.nombre_aseguradora, pm.planmedico, co.nombre as nombreco, c.estadoPago as estado, c.id as idconsulta
        from paciente p, consulta c, datoprevio dt, planmedico pm, tipo_seguro ts, compania co, compania_paciente cop 
        where ts.id=p.tipo_seguro_id 
        and p.id=c.paciente_id 
        and p.id=cop.id_paciente 
        and co.id=cop.id_compania 
        and c.id=dt.consulta_id 
        and c.id=pm.consulta_id 
        and c.fechacon=:fec
        and p.tipo_seguro_id!="1"',['fec'=>$fecha]);
        return view('vendor.adminlte.pages.listaPagos', compact('a'));
    } 
    public function listaPagos(){
     $a=DB::select('select p.id, p.nombre, c.nconsulta,c.id as idc, c.fechacon, ts.nombre_aseguradora, pm.planmedico, co.nombre as nombreco, c.estadoPago as estado, c.id as idconsulta
        from paciente p, consulta c, datoprevio dt, planmedico pm, tipo_seguro ts, compania co, compania_paciente cop 
        where ts.id=p.tipo_seguro_id 
        and p.id=c.paciente_id 
        and p.id=cop.id_paciente 
        and co.id=cop.id_compania 
        and c.id=dt.consulta_id 
        and c.id=pm.consulta_id 
        and c.fechacon=:fec
        and p.tipo_seguro_id!="1"',['fec'=>Carbon::now()->toDateString()]);
        return view('vendor.adminlte.pages.listaPagos', compact('a'));
    }
    //Funcion para registrar pagos por procedimientos
    public function RegistroPagos(Request $request){
        $pr=procedimientos::where('consulta_id','=',$request->idc)->get();                
        foreach ($pr as $pr) {
            if($pr->procedimiento=='Refraccion'){
                $cc=DB::table('costobase')->where('procedimiento','=',$pr->procedimiento)->get();
                foreach ($cc as $cc) {
                    $cfv=DB::select('select * from costo_compania cco, compania c where c.id=cco.id_compania and c.nombre=:nombre',['nombre'=>$request->compania]);
                    foreach ($cfv as $cfv) {
                        $de=0;
                        $cop=0;
                        $idpago=pago::all()->last();
                        //Ejecuta el insert
                        $inProp=DB::table('pago_procedimiento')->insert([
                            ['procedimiento'=>$pr->procedimiento,'deducible'=>$de,'costo'=>$cc->costo,'costoProcedimiento'=>$cop,'pago_id'=>$idpago->id]
                        ]);       
      
                    }                         
                }
            }else{
                $cc=DB::table('costobase')->where('procedimiento','=',$pr->procedimiento)->get();
                foreach ($cc as $cc) {
                    $cfv=DB::select('select * from costo_compania cco, compania c where c.id=cco.id_compania and c.nombre=:nombre',['nombre'=>$request->compania]);
                    foreach ($cfv as $cfv) {
                        $de=$cc->costo-($cc->costo*($cfv->copagoVariable/100));
                        $cop=$cc->costo*($cfv->copagoVariable/100);
                        $idpago=pago::all()->last();
                        //Ejecuta el insert
                        $inProp=DB::table('pago_procedimiento')->insert([
                            ['procedimiento'=>$pr->procedimiento,'deducible'=>$de,'costo'=>$cc->costo,'costoProcedimiento'=>$cop,'pago_id'=>$idpago->id]
                        ]);       
      
                    }                         
                }
            }

        }

    }
    public function preliquidacion($fecha){
        $pagos=pago::where('fechaC','=',$fecha)->get();
        return view('vendor.adminlte.pages.imprimir.preliquidacion',compact('pagos'));
        /*$pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($pre);
        return $pdf->stream('preliquidacion');*/
    }

    public function reportePago($idc){
        $pagos=pago::where('consulta_id','=',$idc)->get();
        return view('vendor.adminlte.pages.imprimir.preliquidacionI',compact('pagos'));       
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
        if($request->ajax()){
            $pago=new pago;
            $pago->tipo=$request->tipo;
            $pago->compania=$request->compania;
            $pago->plan=$request->plan;
            $pago->totalConsulta=$request->total;
            $pago->fechaC=$request->fecha;
            $pago->consulta_id=$request->consultaid;
            $pago->pagototal=$request->pagototal;
            $rPago=$pago->save();
            if($rPago){                
                $actCon=DB::table('consulta')->where('id','=',$request->consultaid)->update(['estadoPago'=>'Registrado']);
                $cntPro=procedimientos::where('consulta_id','=',$request->consultaid)->count();
                if($actCon){
                    return response()->json([
                        'mensaje'=>'Registrado', 
                        'cantidadP'=>$cntPro,
                    ]);
                }else{
                    return response()->json('No se actualizo');
                }
            }else{
                return response()->json('No se registro');
            }
            
        }else{
            return response()->json('No se recibieron datos');
        }
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
        //
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
        //
    }

    public function mostrarProcedimiento($idc){
        $pp=DB::table('procedimientos')->where('consulta_id','=',$idc)->get();
        return response()->json($pp);
    }
    public function quitarProcedimiento($idp){
        $pro=procedimientos::where('id','=',$idp)->first();//obtengo los valores de la columna de procedimientos
        $bp=procedimientos::FindOrFail($idp);
        $elP=$bp->delete();
        if($elP){
            $cnpago=pago::where('consulta_id','=',$pro['consulta_id'])->get();//verifico que hay un registro de pago con ese id de consulta
            if($cnpago!=null){//verifico q devuelva resultados
                $idPP=0;
                foreach($cnpago as $cnpago){
                    //consulta para obtener los valores del pago en la tabla pago_procedimiento
                    $paPro=pago_procedimiento::where([['pago_id','=',$cnpago['id']],
                    ['procedimiento','=',$pro['procedimiento']]])->first(); 
                    $idPP=$paPro['id'];
                }
                $delPP=pago_procedimiento::FindOrFail($idPP);//verifica la existencia del registro
                $elPP=$delPP->delete();//elimino el registro
                if($elPP){//verifico si elimna dentro de la condicion de haber un registor de pago
                    echo 'Eliminado';
                }
            }else{//si no hay registro de pago elimina los procedimientos
                echo 'Eliminado';
            } 
        }else{
            echo 'Error al eliminar procedimiento';
        }
    }
    public function agregarProcedimiento(Request $request){
        if($request->ajax()){
            $pro=$request->pro;
            $idc=$request->idc;
            $pr = new procedimientos;
            $pr->procedimiento=$pro;
            $pr->consulta_id=$idc;
            $rpr=$pr->save();//Registra los datos en la tabla procedimiento
            if($rpr){
                //verifico si hay un registor para la tabla pago con el numero de consulta
                $cnpago=pago::where('consulta_id','=',$request->idc)->exists();
                $cpago=pago::where('consulta_id','=',$idc)->first();
                if($cnpago){//Si hay un registro de pago
                    $pp= new pago_procedimiento;
                    $pp->procedimiento=$pro;
                    $tipo=$cpago;
                    $idpago=0;
                    $copv=0;
                    foreach ($cpago as $cpago) {
                        $compania=$tipo['compania'];
                        $idpago=$tipo['id'];//asigna el valor del id de pago a la variable
                        //consulta para obtener los valores de la tabla compania
                        $idcompaniaF=compania::where('nombre','=',$compania)->first();
                        //consulta para obtener los valores del copavariable
                        $vem=costo_compania::where('id_compania','=',$idcompaniaF['id'])->first();
                        $copv=$vem['copagoVariable'];
                    }
                    

                    //Obtener el costo de los procedimientos
                    $cb=costobase::where('procedimiento','=',$request->pro)->first();
                    //obtengo los valores para operaciones de acuerdo a la empresa
    
                    $deducible=$cb['costo']-($cb['costo']*($copv/100));//formula para obtener el valor del deducible
                    $costoProcedimiento=($cb['costo']*($copv/100));//formula para obtener el valor del procedimiento 
                    //asignacion de variables al modelo pago_procedimiento
                    $pp->deducible=$deducible;
                    $pp->costo=$cb['costo'];
                    $pp->costoProcedimiento=$costoProcedimiento;
                    $pp->pago_id=$idpago;
                    $rpp=$pp->save();
                    if($rpp){
                        echo'Agregado';
                    }else{
                        echo 'error';
                    }   
                }


            }else{
                echo "No se agrego";
            }
        }else{
            echo "No se recibieron datos";
        }
    }

    public function Consolidado(){
        return view('vendor.adminlte.pages.consolidado');
    } 

    public function getConsolidado($id,$fec1,$fec2){

        $c=new consolidado($id,$fec1,$fec2);
        return Excel::download($c, 'Consolidado'.$id.'.xlsx');
    }
}
