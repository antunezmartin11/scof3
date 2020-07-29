<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class costo_compania extends Model
{
    protected $table='costo_compania';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['copagoFijo','copagoVariable','id_compania'];   
    //Funcion que recibe la informacion de la llave foranea
    public function compania()
    {
        return $this->belongsTo('App\Modelos\compania');
    } 
    /*
    public function compania()
    {
        return $this->belongsTo('App\Modelos\compania');
    } */        
    //funcion que envia la informacion de la llave primaria    
}
