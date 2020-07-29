<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class datoprevio extends Model
{
    protected $table='datoprevio';
    protected $primarykey='id';    
    public $timestamps = false;    
   	protected $fillable=['fechacon','te','anamnesis1','anamnesis2','anamnesis3','anamnesis4','antecedentes1','antecedentes2','usalentes','atencion','consulta_id'];       
    public function consultaDP()
    {
        return $this->belongsTo('App\Modelos\consulta');
    }       
}
