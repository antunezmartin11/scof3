<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\persona;
use App\Modelos\users;
use Carbon\Carbon;
use DB;

class usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.adminlte.pages.usuario.usuario');
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
            $per= new persona;
            $per->nombre=$request->nombreU;
            $per->apellido=$request->apellidoU;
            $per->dni=$request->dniU;
            $per->telefono=$request->telefonoU;
            $per->fecnac=$request->fecU;
            //Obtenemos las fechas para calcular la edad
                $fecha=$request->fecU;
                $an=substr($fecha,0,4);
                $mes=substr($fecha,5,2);
                $dia=substr($fecha,8,2);
                $edad = Carbon::createFromDate($an,$mes,$dia)->age;            
            $per->edad=$edad;
            $per->save();
            if($per){
                $p=persona::all()->last();
                $us=new users;

                $us->username=$request['usuario'];
                $us->password=bcrypt($request['contra']);
                $us->email=$request['emailU'];
                $us->tipo_users_id=$request['tipoU'];
                $us->persona_id=$p->id;                           
                $us->save();
                if ($us) {
                    return Response()->json(['message'=>'Registrado']);
                }
            }
        }else{
            return Response()->json(['message'=>'No se recibieron Datos']);
        }
    }
    //Funcion para retornar la lista de usuarios
    public function UsuariosLista(){
        $usu=DB::table('persona')
                ->join('users','persona.id','=','users.persona_id')
                ->select('persona.*','users.username','users.id as idu','users.email','users.tipo_users_id')
                ->whereNotIn('users.id', [1])
                ->get();
        //return Response()->json($usu);
        return view('vendor.adminlte.pages.usuario.usuarios',compact('usu'));
    }

    public function ListaU(){
        return view('vendor.adminlte.pages.usuario.usuarioM');
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
        $datosP=DB::select('select p.*, u.email, u.id as idu from persona p, users u where p.id=u.persona_id and p.id=:idp',['idp'=>$id]);
        return Response()->json($datosP);
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
            $nac=$request->fec; 
            $an=substr($nac,0,4);
            $mes=substr($nac,5,2);
            $dia=substr($nac,8,2);
            $edad = Carbon::createFromDate($an,$mes,$dia)->age; 
            $up=DB::table('persona')
                    ->where('id',$id)
                    ->update(['nombre'=>$request->nombre,'apellido'=>$request->apellido,'dni'=>$request->dni,'telefono'=>$request->telefono,'fecnac'=>$request->fec,'edad'=>$edad]);
            $upe=DB::table('users')
                    ->where('id',$request->idu)
                    ->update(['email'=>$request->email]);                    
            if ($up) {
                return Response()->json(['mensaje'=>'Datos Actualizados']);
            }else{
                if($upe){
                    return Response()->json(['mensaje'=>'Datos Actualizados']);
                }else{
                    return Response()->json(['mensaje'=>'No se encontraron modificaciones']);
                }            
            }
        }else{
            return Response()->json(['mensaje'=>'No se recibieron datos']);
        }            
    }

    public function updateContra(Request $request){
        if($request->ajax()){
            if ($request->tp==1) {
                $nuevo=str_random(8);
                $upAu=DB::table('users')
                            ->where('id',$request->idu)
                            ->update(['password'=>bcrypt($nuevo)]);
                if($upAu){
                    return Response()->json(['mensaje'=>'Generado','nuevo'=>$nuevo]);
                }else{
                    return Response()->json(['mensaje'=>'No se pudo actualizar']);
                }
            }else if($request->tp==2){
                $nueva=$request->con;
                    $upMn=DB::table('users')
                            ->where('id',$request->idu)
                            ->update(['password'=>bcrypt($nueva)]);
                    if($upMn){
                        return Response()->json(['mensaje'=>'Se actualizo la contraseña']);
                    }else{
                        return Response()->json(['mensaje'=>'No se pudo actualizar']);                        
                    }              
            }else if($request->tp==3){
                $newUsu=DB::table('users')
                            ->where('id',$request->idu)
                            ->update(['username'=>$request->u]);
                if ($newUsu) {
                    return Response()->json(['mensaje'=>'Usuario Modificado']);
                }else{
                    return Response()->json(['mensaje'=>'No se pudo modificar']);
                }
            }
        }else{
            return Response()->json(['mensaje'=>'No se recibieron datos']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $us=users::FindOrFail($id);
        $idp=$us->persona_id;
        $eus=$us->delete(); 
        if($eus){
            $p=persona::FindOrFail($idp);
            $ep=$p->delete();
            if($ep){
                return Response()->json(['mensaje'=>'Usuario Eliminado']);
            }else{
                return Response()->json(['mensaje'=>'Verifique la operacion']);
            }
        }else{
            return Response()->json(['mensaje'=>'Ocurrio un error']);
        }    
    }
}
