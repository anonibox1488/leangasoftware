<?php

namespace App\Http\Controllers;


use App\Servicio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $servicios = Servicio::orderBy('created_at', 'desc')->paginate(25);    
        return view('home', compact(['servicios']));    
    }
}
