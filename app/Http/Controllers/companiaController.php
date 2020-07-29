<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\tipo_seguro;
use App\Modelos\compania;
use App\Modelos\costo_compania;
use App\Modelos\costobase;
use DB;
class companiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.adminlte.pages.compania');
    }
    public function VAseguradora(){
        return view('vendor.adminlte.pages.aseguradora');
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
    public function cargarAseguradoras(Request $request){
        $tp=new tipo_seguro;
        if ($request->ajax()) {
            $id=$request->idA;
            $datos=$tp->where('id','=',$id)->get();
            return response()->json($datos);
        }else{
            echo "No se recibieron datos";
        }
    }
    public function cargarCompania(){
        $lista=compania::all();
        return view('vendor.adminlte.pages.listaCompania', compact('lista'));
    }    
    public function modificarAseguradora(Request $request){        
        $tp=new tipo_seguro;
        if($request->ajax()){
            $upt=DB::table('tipo_seguro')->where('id',$request->id)
                    ->update(['nombre_aseguradora'=>$request->nombreA,'ruc'=>$request->rucA,'tipodoc'=>$request->docum,'producto'=>$request->produc,'numcomp'=>$request->moneda]);
            if($upt){
                echo "Actualizado";
            }else{
                echo "Ocurrio un error";
            }
        }else{
            echo "No se recibieron datos";
        }
    }
    public function EliminarAseguradora(Request $request){
        
        if($request->ajax()){
            $id=$request->idA;
            $eli=tipo_seguro::FindOrFail($id);
            $eliA=$eli->delete();
            if($eliA){
                echo "Eliminado";
            }else{
                echo "Error";
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
            $Comp= new compania;
            $Comp->nombre=$request->nombreC;
            $Comp->ruc=$request->rucCo;
            $Comp->tipo_seguro_id=$request->Aseguradora;    
            $RegC=$Comp->save();
            if($RegC){
                $idC=compania::all()->last();
                $CosCom=new costo_compania;
                $CosCom->copagoFijo=$request->coFi;
                $CosCom->copagoVariable=$request->coVa;
                $CosCom->id_compania=$idC->id;
                $RegCosCom=$CosCom->save();
                if($RegCosCom){
                    echo "Compania Registrada";
                }else{
                    echo "Ocurrio un error registrando los costos";
                }
            }else{
                echo "No se pudo registrar la compañia";
            }
        }else{
            echo "No se recibieron datos";
        }
    }
    public function RegistroAseguradora(Request $request){
        if($request->ajax()){
            $tp= new tipo_seguro;
            $tp->nombre_aseguradora=$request->nombreA;
            $tp->ruc=$request->rucA;
            $tp->tipodoc=$request->docum;
            $tp->producto=$request->produc;
            $tp->numcomp=$request->moneda;
            $tp->save();
            if($tp){
                echo "Registrado";
            }else{
                echo "Error";
            }
        }else{
            echo "No llegaron datos al servidor";
        }        
    }
    public function listaAseguradora(){
        $lista=DB::table('tipo_seguro')->get();
        return view('vendor.adminlte.pages.listaAseguradora', compact('lista'));
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
        $lista=DB::select('select c.nombre, c.ruc, c.tipo_seguro_id, cc.copagoFijo, cc.copagoVariable from compania c, costo_compania cc, tipo_seguro ts where c.id=cc.id_compania and ts.id=c.tipo_seguro_id and c.id=:id',['id'=>$id]);
        return response()->json($lista);
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
        if ($request->ajax()) {
            $ActuComp=compania::where('id',$id)->update([
                'nombre'=>$request->nombreC,'ruc'=>$request->rucCo,'tipo_seguro_id'=>$request->Aseguradora]);
            $ActuCostosCo=costo_compania::where('id_compania',$id)->update(['copagoFijo'=>$request->coFi,'copagoVariable'=>$request->coVa]);
            if($ActuComp){
                if($ActuCostosCo){
                    echo "Actualizado";    
                }else{
                    echo "Actualizado";
                }                
            }else{
                if($ActuCostosCo){
                    echo "Actualizado";
                }else{
                    echo "No se encontraron cambios";
                }
            }
        }else{
            echo "No se recibieron datos";
        }
    }
    //Controlador que devuelve los datos de las companias por aseguradoras
    public function cargarCompania1(Request $request){
        $c=compania::where('tipo_seguro_id','=',$request->idA)->get();
        return response()->json($c);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $EliCosto=DB::table('costo_compania')->where('id_compania','=',$id)->delete();
        if($EliCosto){
            $BusCom=compania::FindOrFail($id);
            $EliCom=$BusCom->delete();         
            if ($EliCom) {
                echo "Eliminado";                 
            }else{
                echo "Ocurrio un error";
            }                       
        }else{
            echo "Ocurrio un error eliminado los costos";
        }        
    }
    public function MostrarCosto(){
        $dat=costobase::all();
        return view('vendor.adminlte.pages.costosConsulta')->with('dat',$dat);
    }
    public function actualizarCostos($id, $cos){
        $actC=costobase::where('id',$id)
                        ->update(['costo'=>$cos]);
        if($actC){
            $dat=costobase::all();
            return response()->json($dat);
            
        }else{
            echo "Error";
        }
        
    }
}
