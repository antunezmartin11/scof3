<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class farmaco extends Model
{
    protected $table='farmaco';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['farmaco','unidad','indicaciones','consulta_id'];   
    //Funcion que recibe la informacion de la llave foranea
    public function consulta()
    {
        return $this->belongsTo('App\Modelos\consulta');
    } 
    //funcion que envia la informacion de la llave primaria
    //funcion que envia la informacion de la llave primaria
}
