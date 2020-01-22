<?php

namespace App\Http\Controllers;

use App\Mensaje;
use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MensajeController extends Controller
{
    /**
     * Crear mensajes desde el chat de un servicio
     * @param  Request $request 
     * @return status 200|500
     */
    public function store(Request $request){
    	$servicio = Servicio::find($request->servicio_id);
    	$mensaje = new Mensaje();
        if ($request->file('file')) {
            $file = Storage::disk('public')->put('archivos', $request->file('file'));
            $mensaje->file = asset($file);
        }
    	$mensaje->from = Auth::user()->id;
    	$mensaje->to = $servicio->user_id;
    	$mensaje->message = $request->mensaje;
    	$mensaje->servicio_id = $request->servicio_id;
    	if ($mensaje->save()) {
    		return response()->json('ok', 200);
    	}

    	return response()->json('err', 500);
    }

    /**
     * Crear mensajes desde el chat mis mensjes
     * @param  Request $request 
     * @return status 200|500
     */
    public function responder(Request $request){
        $mensaje = new Mensaje();
        if ($request->file('file')) {
            $file = Storage::disk('public')->put('archivos', $request->file('file'));
            $mensaje->file = asset($file);
        }
        $mensaje->from = Auth::user()->id;
        $mensaje->to = $request->para;
        $mensaje->message = $request->mensaje;
        $mensaje->servicio_id = $request->servicio_id;
        
        if ($mensaje->save()) {
            return response()->json('ok', 200);
        }
        return response()->json('err', 500);   
    }

    /**
     * Obtener los mensajes para el modal del chat de servicio
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getMensajesModal($id){
    	$mensajes = Mensaje::from('mensajes as m')
        ->select( 'm.id','m.from','m.to', 'm.servicio_id', 'm.message','m.file','m.created_at', 'f.email as de', 't.email as para')
        ->join('users as f', 'f.id','m.from')
        ->join('users as t','t.id','m.to')
        ->where('m.servicio_id',$id)
    	->where(function ($q) {
		    $q->where('m.from', Auth::user()->id)
		    ->orWhere('m.to', Auth::user()->id);
		})
		->limit(15)
		->orderBy('m.created_at', 'desc')
    	->get();
    	return response()->json($mensajes, 200);
    }

    /**
     * OBtener los distintos chat por publicaciones
     * @return [type] [description]
     */
    public function index(){
        $mensajes = Mensaje::from('mensajes as m')
        ->select('f.id as user','f.name', 's.name as servicio', 's.id')
        ->join('servicios as s', 's.id','m.servicio_id')
        ->join('users as f', 'f.id','m.from')
        ->where('s.user_id', Auth::user()->id)
        ->where('m.to', Auth::user()->id)
        ->distinct('m.from', 'servicio', 's.id', 'user')
        ->get();
        return view('mensajes.index', compact('mensajes'));
    }

    /**
     * Obtener los mensajes para el modal de mis mensajes
     * @param  [type] $servicio [description]
     * @param  [type] $user     [description]
     * @return [type]           [description]
     */
    public function getMensajesInbox($servicio, $user){
        $mensajes = Mensaje::from('mensajes as m')
        ->select( 'm.id','m.from','m.to', 'm.servicio_id', 'm.message','m.file','m.created_at', 'f.email as de', 't.email as para')
        ->join('users as f', 'f.id','m.from')
        ->join('users as t','t.id','m.to')
        ->where('m.servicio_id',$servicio)
        ->where(function ($q) use($user) {
            $q->where(function ($query) use($user) {
                $query->where('m.from', Auth::user()->id)
                ->where('m.to',$user);
            })
            ->orWhere(function ($q) use($user) {
                $q->where('m.from', $user)
                ->where('m.to',  Auth::user()->id);
            });
        })
        ->limit(15)
        ->orderBy('m.created_at', 'desc')
        ->get();
        // ->toSql();
        return response()->json($mensajes, 200);
    }


}

