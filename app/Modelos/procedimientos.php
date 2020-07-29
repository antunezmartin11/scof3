<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class procedimientos extends Model
{
    protected $table='procedimientos';
    protected $primarykey='id';    
    public $timestamps = false;    
   	protected $fillable=['procedimientos','consulta_id'];       
   	
    public function consultaPr()
    {
        return $this->belongsTo('App\Modelos\consulta');
    }       
}
