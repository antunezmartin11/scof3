<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class tipo_plan extends Model
{
    protected $table='tipo_plan';
    protected $primarykey='id';  
    public $timestamps = false;      
    protected $fillable=['nombre','dni','direccion','fecnac','sexo','telefono','edad','email','parentesco','idtipo_plan'];      
}
