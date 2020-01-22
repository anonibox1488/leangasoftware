@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
        @if ($message = Session::get('error'))
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            {{ $message }}
          </div>
        @endif
        Crear Servicio
        </div>
        <div class="card-body">
          <form action="{{url('servicios')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="servicio">Nombre</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" name="servicio" id="servicio" placeholder="Nombre del servicio">
              @error('servicio')
              <span style="color: red" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="description">Descripcion </label>
              <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              @error('description')
              <span style="color: red" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="archivo">Imagen</label>
              <input type="file" class="form-control-file" id="archivo" name="archivo">
              @error('archivo')
              <span style="color: red" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <button type="sutmit" class="btn btn-primary btn-lg btn-block">Guardar</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
</div>
@endsection
