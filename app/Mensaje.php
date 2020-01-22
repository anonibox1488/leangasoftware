<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $primaryKey = 'id';
    protected $table ="mensajes";
    protected $fillable = [
        'id','from','to', 'servicio_id', 'message','file','created_at' ,'updated_at' 
    ];

    //Realacion de muchos a 1 con usuarios (from)
	public function de(){
        return $this->belongsTo('App\User', 'from');
    }

    //Realacion de muchos a 1 con usuarios (to)
	public function para(){
        return $this->belongsTo('App\User', 'to');
    }

    public function servicio(){
        return $this->belongsTo('App\Servicio');
    }



}


