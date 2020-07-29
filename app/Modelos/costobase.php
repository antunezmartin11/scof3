<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class costobase extends Model
{
    protected $table='costobase';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['procedimiento','costo'];   
    /*
    //Funcion que recibe la informacion de la llave foranea
    public function paciente()
    {
        return $this->belongsTo('App\Modelos\paciente');
    } 
    public function compania()
    {
        return $this->belongsTo('App\Modelos\compania');
    } */        
    //funcion que envia la informacion de la llave primaria    
}
