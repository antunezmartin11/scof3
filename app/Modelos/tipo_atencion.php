<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class tipo_atencion extends Model
{
    protected $table='tipo_atencion';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['tipo'];   

    public function consulta()
    {
        return $this->hasOne('App\Modelos\consulta','tipo_atencion_id');
    }       
}
