<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class paciente extends Model
{
    protected $table='paciente';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['nombre','dni','direccion','fecnac','sexo','telefono','edad','email','parentesco','tipo_seguro_id'];   

    public function consultaP()
    {
        return $this->hasOne('App\Modelos\consulta','paciente_id');
    } 
    
    public function tipo_seguro()
    {
        return $this->belongsTo('App\Modelos\tipo_seguro');
    }
}
