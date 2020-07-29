<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class examen1 extends Model
{
    protected $table='examen1';
    protected $primarykey='id';    
    public $timestamps = false;    
   	protected $fillable=['odsc','odcc','odca','oisc','oicc','oica'];       
    public function consulta1()
    {
        return $this->belongsTo('App\Modelos\consulta');
    }       
}
