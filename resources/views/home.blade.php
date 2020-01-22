@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
      <div class="col-md-12 px-0">
        <h1 class="display-4 font-italic">Soluciones online</h1>
        <p class="lead my-1">Listado de servicios disponibles.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mb-2"> 
        <a href="{{url('servicios')}}" class="btn btn-primary btn-lg btn-block">Crear Servicio</a> 
      </div>
      <div class="col-12 mb-2"> 
        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            {{ $message }}
          </div>
        @endif      
      </div>
      @foreach ($servicios as $servicio)
      <div class="col-sm-12 col-md-6">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">{{$servicio->user->name}}</strong>
            <h3 class="mb-0">{{$servicio->name}}</h3>
            <div class="mb-1 text-muted">{{$servicio->fecha}}</div>
            <p class="card-text mb-auto">{{$servicio->extracto}}</p>
            <a href="/servicios/{{$servicio->slug}}" class="stretched-link">Ver mas</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img src="{{ $servicio->file == null ? asset('img/default.png') : $servicio->file }} " alt="imagen" width="200" height="250">
          </div>
        </div>
      </div>
      @endforeach 
      <div class="col-12">
        {{ $servicios->links() }}  
      </div>
      
    </div>
</div>
@endsection
