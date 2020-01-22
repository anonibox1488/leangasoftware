@extends('layouts.app')

@section('content')
<div class="container">

	<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
    <img class="mr-3" src="{{asset('img/inbox.jpg')}}" alt="" width="48" height="48">
    <div class="lh-100" style="color: black">
      <h6> <strong>Mis Mensajes</strong> </h6>
      <small>{{Auth::user()->name}}</small>
    </div>
  </div>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Mensajes Recientes</h6>
    @foreach ($mensajes as $mensaje)
    <div class="media text-muted pt-3" onclick="chatInbox('{{$mensaje}}');">
		<img class="mr-3" src="{{asset('img/images.png')}}" alt="" width="38" height="38">
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <strong class="d-block text-gray-dark">{{$mensaje->name}}</strong>
        {{$mensaje->servicio}}
      </p>
    </div>
    @endforeach
  </div>
</main>
</div>

<div class="modal fade"  id="chatModalInbox" tabindex="-1" role="dialog" aria-labelledby="cahtModalLabel" aria-hidden="true">
  <div class="modal-dialog"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title float-left" id="nameservico"></h5>
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
            <input type="hidden" class="form-control" id="servicio_id" name="servicio_id" value="">
            <input type="hidden" class="form-control" id="para" name="para" value="">
            <input type="text" class="form-control" id="mensaje" name="mensaje">
            <input type="file" name="attachment" id="attachment">
            <p id="error"></p>
          </div>
          <div class="form-group">
            <button type="button" onclick="responderMensajes()" class="btn btn-primary btn-lg btn-block">Enviar</button>
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