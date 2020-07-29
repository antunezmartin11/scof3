<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class tratamiento extends Model
{
    protected $table='tratamiento';
    protected $primarykey='id';    
    public $timestamps = false;    
   	protected $fillable=['tratamiento','consulta_id'];       
    public function consultaTr()
    {
        return $this->belongsTo('App\Modelos\consulta');
    }       
}
