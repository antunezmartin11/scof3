<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class pago_procedimiento extends Model
{
    protected $table='pago_procedimiento';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['procedimiento','deducible','costo','costoProcedimiento','pago_id'];
     
    public function tipo_servicio()
    {
        return $this->belongsTo('App\Modelos\pago');
    }       
}
