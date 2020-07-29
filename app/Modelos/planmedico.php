<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class planmedico extends Model
{
    protected $table='planmedico';
    protected $primarykey='id';    
    public $timestamps = false;    
   	protected $fillable=['planmedico','consulta_id'];       
    public function consultaPM()
    {
        return $this->belongsTo('App\Modelos\consulta');
    }   	
}
