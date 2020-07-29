<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class compania extends Model
{
    protected $table='compania';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['nombre','ruc','tipo_seguro_id'];      

    public function tipo_servicio()
    {
         return $this->belongsTo('App\Modelos\tipo_seguro','id');
    }
}
