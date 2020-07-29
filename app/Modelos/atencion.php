<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class atencion extends Model
{
    protected $table='atencion';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['nhistoria','nconsulta','dni','nombre','tipo','fecha','planmed','atencion','edad','estado'];
}
