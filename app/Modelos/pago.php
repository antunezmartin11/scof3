<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class pago extends Model
{
    protected $table='pago';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['tipo','plan','totalConsulta','fecnaC','pagototal','consulta_id'];   

    public function consultaP()
    {
        return $this->hasOne('App\Modelos\pago_procedimiento','pago_id');
    } 
    
    public function tipo_servicio()
    {
        return $this->belongsTo('App\Modelos\consulta');
    }    
}
