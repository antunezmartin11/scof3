<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class tipo_seguro extends Model
{
    protected $table='tipo_seguro';
    protected $primarykey='id';  
    public $timestamps = false;      
    protected $fillable=['nombre_aseguradora','ruc','tipodoc','producto','numcomp'];  

    public function compania()
    {
        return $this->hasOne('App\Modelos\compania');
    }      
    public function paciente()
    {
        return $this->hasMany('App\Modelos\paciente');
    }          
}
