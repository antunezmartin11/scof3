<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class consulta extends Model
{
    protected $table='consulta';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['nconsulta','fechaCon','estadoPago','tipo_atencion_id','paciente_id'];   
    //Llave que recibe la informacion
    public function tipo_atencion()
    {
        return $this->belongsTo('App\Modelos\tipo_atencion');
    } 
    public function paciente()
    {
        return $this->belongsTo('App\Modelos\paciente');
    }     
    //Llave que entrega la informacion
    public function planMedico()
    {
        return $this->hasOne('App\Modelos\planmedico','consulta_id');
    }

    public function procedimientos()
    {
        return $this->hasMany('App\Modelos\procedimientos','consulta_id');
    }    
    public function tratamiento()
    {
        return $this->hasMany('App\Modelos\tratamiento','consulta_id');
    }  
    public function examen1()
    {
        return $this->hasOne('App\Modelos\examen1','consulta_id');
    }       
    public function examen2()
    {
        return $this->hasOne('App\Modelos\examen2','consulta_id');
    } 
    public function diagnostico()
    {
        return $this->hasMany('App\Modelos\diagnostico','consulta_id');
    }  
    public function refraccion()
    {
        return $this->hasOne('App\Modelos\refraccion','consulta_id');
    }  
    public function datoprevio()
    {
        return $this->hasOne('App\Modelos\datoprevio','consulta_id');
    }    
    public function signosvitales()
    {
        return $this->hasOne('App\Modelos\signosvitales','consulta_id');
    }                 
}
