<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class tipo_servicio extends Model
{
    protected $table='tipo_servicio';
    protected $primarykey='id';    
    public $timestamps = false;    
    protected $fillable=['nombre_servicio'];  


    public function paciente()
    {
        return $this->hasOne('App\Modelos\paciente');
    }

    public function compania()
    {
        return $this->hasMany('App\Modelos\compania','tipo_servicio_id');
    }
}
