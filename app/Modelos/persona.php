<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class persona extends Model
{
    protected $table='persona';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['nombre','apellido','dni','telefono','fecnac','edad'];   

    public function Users()
    {
        return $this->hasOne('App\Modelos\users','persona_id');
    }       
} 
