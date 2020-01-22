@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row"> 
            <div class="col-md-12">
              <h3>{{$servicio->name}}</h3>
            </div>
            <div class="col-md-4">
              <img src="{{ $servicio->file == null ? asset('img/default.png') : $servicio->file }} " alt="imagen" width="100%" height="250">
            </div>
            <div class="col-md-8">
              {{$servicio->description}}
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              @if($servicio->user_id != Auth::user()->id)
              <button class="btn btn-primary btn-lg btn-block" onclick="abrirChat()">Chat</button>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="cahtModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title float-left">{{$servicio->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Mensajes -->
        <div id="mensajes">
        
        </div>
        <!-- Fin de mensajes -->
        <form action="" enctype="multipart/form-data">
          <br>
          <div class="form-group">
            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
            <input id="auth" type="hidden" name="auth" value="{{ Auth::user()->id }}">
            <input type="hidden" class="form-control" id="servicio_id" name="servicio_id" value="{{$servicio->id}}">
            <input type="text" class="form-control" id="mensaje" name="mensaje">
            <input type="file" name="attachment" id="attachment">
            <p id="error"></p>
          </div>
          <div class="form-group">
            <button type="button" onclick="enviarmensaje()" class="btn btn-primary btn-lg btn-block">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
  <script src="{{ asset('js/mensajes.js') }}"></script>
@endsection
