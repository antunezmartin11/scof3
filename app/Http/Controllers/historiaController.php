<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Modelos\diagnostico;
use App\Modelos\tratamiento;
use App\Modelos\procedimientos;
use App\Modelos\consulta;
use App\Modelos\datoprevio;
use App\Modelos\planmedico;
use App\Modelos\refraccion;
use App\Modelos\atencion;
use App\Modelos\examen1;
use App\Modelos\examen2;
use App\Modelos\paciente;

class historiaController extends Controller
{
	//Funcion que devuelve la vista del blade historias
    public function Principal(){
    	return view('vendor.adminlte.pages.historias');
    }
    //Funcion para buscar las historias por el DNI
    public function BuscarDni(Request $request){
    	if($request->ajax()){
    		$datosH=DB::select('select p.id as idp, p.nombre, p.dni, c.nconsulta, c.id as idc, c.fechacon from paciente p, consulta c, datoprevio dp, examen1 e1, examen2 e2, planmedico pm, refraccion rf
				where p.id=c.paciente_id and c.id=dp.consulta_id and c.id=e1.consulta_id and c.id=e2.consulta_id and c.id=pm.consulta_id and c.id=rf.consulta_id and 
					p.dni=:dnipaciente',['dnipaciente'=>$request->dni]);
    		return view('vendor.adminlte.pages.listaHistorias',compact('datosH'));
    	}else{
    		echo "No se recibieron datos";
    	}
    }
    //Funcion para buscar las historias por el nombre
    public function BuscarNombre(Request $request){
       /* $datosN=DB::table('paciente')
                    ->join('consulta','paciente.id','=','consulta.paciente_id')
                    ->join('datoprevio','consulta.id','=','datoprevio.consulta_id')
                    ->get();*/
        $datosN=DB::table('paciente')->where('nombre','like','%'.$request->nomh.'%')->get();
        return view('vendor.adminlte.pages.listaNombresH', compact('datosN'));
    }

    //Funcion para obtener todos los datos de una determinada historia
    public function CargarHistoria($idc){
		$historia=DB::select('select *,p.id as idp, c.id as idc, c.fechacon from paciente p, consulta c, datoprevio dp, examen1 e1, examen2 e2, planmedico pm, refraccion rf
			where p.id=c.paciente_id and c.id=dp.consulta_id and c.id=e1.consulta_id and c.id=e2.consulta_id and c.id=pm.consulta_id and c.id=rf.consulta_id and c.id=:idc',['idc'=>$idc]);    	
		return view('vendor.adminlte.pages.editconsulta',compact('historia'));
    }

    //Funcion que devuelve los valores de procedimientos, diagnosticos y tratamientos de una consulta
    public function cargarHCD($idc){
        $diagnosticos=diagnostico::all()->where('consulta_id','=',$idc);
        $tratamiento=tratamiento::all()->where('consulta_id','=',$idc);
        $procedimientos=procedimientos::all()->where('consulta_id','=',$idc);
        $dt=array($diagnosticos,$tratamiento,$procedimientos);
        return response()->json($diagnosticos);
    }

    public function EditarHistoria(Request $request){
        if($request->ajax()){
            $idc=$request->idcon;
            //Actualizar la tabla de datoprevio
            $acDatoPrevio=DB::table('datoprevio')->where('consulta_id','=',$idc)->update(['te'=>$request->te, 'anamnesis1'=>$request->anm1, 'anamnesis2'=>$request->anm2,'anamnesis3'=>$request->anm3,'anamnesis4'=>$request->anm4,'antecedentes1'=>$request->antece,'antecedentes2'=>$request->antece1,'usaLentes'=>$request->usLen]);
            //Actualizar la tabla examen1
            $acExamen1=DB::table('examen1')->where('consulta_id','=',$idc)->update(['odsc'=>$request->odsc,'odcc'=>$request->odcc,'odca'=>$request->odca,'oisc'=>$request->oisc,'oicc'=>$request->oicc,'oica'=>$request->oica]);
            //Actualizar la tabla examen2
            $acExamen2=DB::table('examen2')->where('consulta_id','=',$idc)->update(['orbitasparpados'=>$request->orbPar,'orbitasparpados1'=>$request->orbPar1,'aparatolagrimal'=>$request->aparLagr,'conjuntivaesclera'=>$request->conjEsc,'conjuntivaesclera1'=>$request->conjEsc1,'cornea'=>$request->cornea,'cornea1'=>$request->cornea1,'camaraanterior'=>$request->camaraAnt,'irispupila'=>$request->irPup,'campovisual'=>$request->campoVi,'cristalino'=>$request->cristalino,'cristalino1'=>$request->cristalino1,'vitreo'=>$request->vitreo,'tonometria'=>$request->tonometria,'od'=>$request->od,'oi'=>$request->oi,'motilidadocular'=>$request->motOcu,'motilidadocular1'=>$request->motOcu1,'testschirmer'=>$request->schirmer,'but'=>$request->but, 'covertest'=>$request->covertest,'oftalmoscopia1'=>$request->oftal1,'oftalmoscopia2'=>$request->oftal2,'oftalmoscopia3'=>$request->oftal3,'oftalmoscopia4'=>$request->oftal4]);
            //Actuaizar la tabla planMedico
            $acPlanMedico=DB::table('planmedico')->where('consulta_id','=',$idc)->update(['planmedico'=>$request->planMe]);
            //Actualizar la tabla refraccion
            $acRefraccion=DB::table('refraccion')->where('consulta_id','=',$idc)
            ->update(['odesfera'=>$request->odesfera,
                    'odcilindro'=>$request->odcilindro,
                    'odeje'=>$request->odeje,
                    'oddip'=>$request->oddip,
                    'oiesfera'=>$request->oiesfera,
                    'oicilindro'=>$request->oicilindro,
                    'oieje'=>$request->oieje,
                    'oiav'=>$request->oiav,
                    'oidip'=>$request->oidip,
                    'odesferaC'=>$request->odesferaC,
                    'odcilindroC'=>$request->odcilindroC,
                    'odejeC'=>$request->odejeC,
                    'odavC'=>$request->odavC,
                    'oddipC'=>$request->oddipC,
                    'oiesferaC'=>$request->oiesferaC,
                    'oicilindroC'=>$request->oicilindroC,
                    'oiejeC'=>$request->oiejeC,
                    'oiavC'=>$request->oiavC,
                    'oidipC'=>$request->oidipC]);
                if($acDatoPrevio || $acExamen1 || $acExamen2 || $acPlanMedico || $acRefraccion){
                    echo "Actualizado";
                }else{
                    echo "No se encontraron cambios";
                }
        }else{
            echo "No se recibieron datos";
        }
    }
    public function ActualizarDiagnostico(Request $request){            
        $diagnostico=DB::table('diagnostico')->where('id','=',$request->idcie)->update(['diagnostico'=>$request->diag,'cie'=>$request->cie]);
        if($diagnostico){
            echo "Actualizado";
        }else{
            echo 'Error';
        }
    }
    public function AgregarDiagnostico(Request $request){
        $Ad= new diagnostico;
        $Ad->diagnostico=$request->diag;
        $Ad->cie=$request->cie;
        $Ad->consulta_id=$request->idc;
        $Ad->save();
        if($Ad){
            echo "Actualizado";
        }else{
            echo "Error agregando el diagnostico";
        }
    }

    public function eliminarDiagnostico(Request $request){
        $eliDi=diagnostico::FindOrFail($request->cc);
        $ejEli=$eliDi->delete();
        if($ejEli){
            echo "Actualizado";
        }else{
            echo "Ocurrio un error eliminado el diagnostico";
        }
    }
    public function actualizarTratamiento(Request $request){
        $t=DB::table('farmaco')->where('id','=',$request->idt)->update(['farmaco'=>$request->fr],['unidad'=>$request->un],['indicaciones'=>$request->i]);
        if($t){
            return Response()->json(['mensaje'=>'Actualizado']);     
        }else{
            return Response()->json(['mensaje'=>'Error']);     
        }        
    }

    public function eliminarTratamiento(Request $request){
        $et=tratamiento::FindOrFail($request->idt);
        $elt=$et->delete();
        if ($elt) {
            return Response()->json(['mensaje'=>'Actualizado']);
        }else{
            return Response()->json(['mensaje'=>'Error']);
        }
        
    }

    public function agregarTratamiento(Request $request){
        $at= new tratamiento;
        $at->tratamiento=$request->tra;
        $at->consulta_id=$request->idc;
        $at->save();
        return Response()->json(['mensaje'=>'Actualizado']);
    }
    public function hisPac(Request $request){
        $datosH=DB::select('select p.id as idp, c.id as idc, p.nombre, c.nconsulta, c.fechacon from consulta c, paciente p, datoprevio dp where p.id=c.paciente_id and c.id=dp.consulta_id and p.id=:id',['id'=>$request->idp]);
            return view('vendor.adminlte.pages.listaHistorias1',compact('datosH'));        
    }
}
