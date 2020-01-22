<?php

namespace App\Http\Controllers;

use App\Servicio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ServicioController extends Controller
{
    public function create(){
    	return view('servicios.create');
    }

    public function store(StoreServicio $request){
        $path = '';
        if ($request->file('archivo')) {
            $img = Storage::disk('public')->put('imagen', $request->file('archivo'));
            $path = asset($img);
        }
    	$servicio =  new Servicio();
    	$servicio->name = $request->servicio;
    	$servicio->slug = Str::slug($request->servicio, '-');
    	$servicio->description = $request->description;
        $servicio->file = $path;
    	$servicio->user_id = Auth::user()->id;

    	if ($servicio->save()) {
            

    		return redirect('/home')->with('success','Servicio creado correctamente');
    	}
    	return back()->with('error','Error inesperado intentelo nuevamente');
    }

    public function show($slug){
        
        $servicio = Servicio::where('slug',$slug)->firstOrFail();
        // dd($servicio);
        return view('servicios.show', compact('servicio'));
    }
}
