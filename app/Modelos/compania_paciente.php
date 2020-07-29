<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class compania_paciente extends Model
{
    protected $table='compania_paciente';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['id_paciente','id_compania'];   
    //Funcion que recibe la informacion de la llave foranea
    public function paciente()
    {
        return $this->belongsTo('App\Modelos\paciente');
    } 
    public function compania()
    {
        return $this->belongsTo('App\Modelos\compania');
    }         
    //funcion que envia la informacion de la llave primaria
}
