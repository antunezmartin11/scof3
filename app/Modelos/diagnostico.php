<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class diagnostico extends Model
{
    protected $table='diagnostico';
    protected $primarykey='id';    
    public $timestamps = false;    
   	protected $fillable=['diagnostico','cie'];       
    public function consultaDi()
    {
        return $this->belongsTo('App\Modelos\consulta');
    }       
}
