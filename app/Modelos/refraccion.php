<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class refraccion extends Model
{
    protected $table='refraccion';
    protected $primarykey='id';    
    public $timestamps = false;    
   	protected $fillable=['odesfera','odcilindro','odeje','odav','oddip','oiesfera','oicilindro','oieje','oiav','oidip','lecturaesfera','lecturacilindro','lecturaeje','lecturaav','lecturadip','consulta_id'];       
    public function consultaRf()
    {
        return $this->belongsTo('App\Modelos\consulta');
    }       
}
