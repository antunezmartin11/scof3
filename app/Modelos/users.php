<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table='users';
    protected $primarykey='id';        
    protected $fillable=['username','password','email','tipo_users_id','persona_id','remember_token','created_at','updated_at'];   

    
    public function tipo_user()
    {
        return $this->belongsTo('App\Modelos\tipo_users');
    }
    public function persona()
    {
        return $this->belongsTo('App\Modelos\persona');
    }    
}
