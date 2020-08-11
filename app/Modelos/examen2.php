<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class examen2 extends Model
{
    protected $table='examen2';
    protected $primarykey='id';    
    public $timestamps = false;    
   	protected $fillable=['orbitasparpados','orbitasparpados1','aparatolagrimal','conjuntivaesclera','conjuntivaesclera1','cornea','cornea1','camaraanterior','irispupila','campovisual','cristalino','cristalino1','vitreo','tonometria','od','oi','motilidadocular','motilidadocular1','testschirmer','but','covertest','oftalmoscopia1','oftalmoscopia2','oftalmoscopia3','oftalmoscopia4','procedimiento','consulta_id'];       
    public function consulta2()
    {
        return $this->belongsTo('App\Modelos\consulta');
    }       
}
