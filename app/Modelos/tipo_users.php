<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class tipo_users extends Model
{
    protected $table='tipo_users';
    protected $primarykey='id';    
    public $timestamps = false;
    protected $fillable=['tipo'];   

    public function Users()
    {
        return $this->hasOne('App\Modelos\users','tipo_users_id');
    }     
}
