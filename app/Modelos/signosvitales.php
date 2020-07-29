<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class signosvitales extends Model
{
    protected $table='signosvitales';
    protected $primarykey='id';    
    public $timestamps = false;    
   	protected $fillable=['presart','frecar','tempcorp','peso','talla','imc','consulta_id'];       
    public function signosvitales()
    {
        return $this->belongsTo('App\Modelos\consulta');
    }    
}
