<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Servicio extends Model
{
    protected $primaryKey = 'id';
    protected $table ="servicios";
    protected $fillable = [
        'id','name','slug','description','file','user_id','created_at', 'updated_at'
    ];

    //Obtener un extrato de la descripcion 
    //los primeros 70 caracteres.
	public function getExtractoAttribute(){
		return substr($this->attributes['description'], 0,70) ."...";
	}

	//Modificar la fecha de creacion para mostrarla al usuario
	public function getFechaAttribute(){
		$fecha = Carbon::create($this->attributes['created_at']);
		return $fecha->isoFormat('MMM Do YYYY');
	}
	
	//Realacion de muchos a 1 con usuarios
	public function user(){
        return $this->belongsTo('App\User');
    }
}
