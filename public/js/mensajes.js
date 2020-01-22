function enviarmensaje(){
	let formData    = new FormData();
	let token       = $('#token').val();
 	let mensaje     = $('#mensaje').val();
 	let servicio_id = $('#servicio_id').val();
 	let attachment  = $('#attachment');
	
	formData.append('file',attachment[0].files[0]);
	formData.append('_token',token);
	formData.append('mensaje',mensaje);
	formData.append('servicio_id',servicio_id);
	
	$.ajax({
		url     :  "/mensajes",
        method    :  'POST',
        data    :   formData,
        processData: false,
		contentType: false,
		success :   function (data) {
			cargarMensajes($('#servicio_id').val());
			$('#mensaje').val('');
			$('#attachment').val('');
		},
		error   :   function(err) {
			console.log(err);
			$('#error').val('Error al enviar mensaje.')		
		}
	});
}


function abrirChat() {
	let servicio = $('#servicio_id').val();
	cargarMensajes(servicio);
	$('#chatModal').modal('show');
}

function cargarMensajes(servicio) {
	let auth = $('#auth').val();
	$.ajax({
		url     :  "/mensajes/" + servicio,
        type    :  'GET',
        dataType:  'json',
		success :   function (data) {
			let  mensajes = data.reverse();
			$("#mensajes").html('');
			$.each(mensajes, function (ind, elem) { 
	          let align = 'float-right';
	          if(elem.from == auth) {
	          	align = 'float-left';
	          }
			  $("#mensajes").append("<p class="+align+"> <strong>"+elem.de +"</strong>: " + elem.message +"</p><br>");
			});
		},
		error   :   function(err) {
			console.log(err);
		}
	});
}

function chatInbox(data) {
	let obj = JSON.parse(data);
	cargarMensajesInbox(obj.id,obj.user);
	$('#servicio_id').val(obj.id);
	$('#para').val(obj.user);
	$('#nameservico').text(obj.servicio)
	$('#chatModalInbox').modal('show');
}

function cargarMensajesInbox(servicio, user) {
	let auth = $('#auth').val();
	$.ajax({
		url     :  '/mensajes/' + servicio +'/'+ user,
        type    :  'GET',
        dataType:  'json',
		success :   function (data) {
			let  mensajes = data.reverse();
			$("#mensajes").html('');
			$.each(mensajes, function (ind, elem) {
	          let align = 'float-right';
	          if(elem.from == auth) {
	          	align = 'float-left';
	          }
			  $("#mensajes").append("<p class="+align+"> <strong>"+elem.de +"</strong>: " + elem.message +" </p><br>");
			  if (elem.file) {
			  	$("#mensajes").append(" <br> <p class="+align+"> <strong>"+elem.de +"</strong>:  <a href="+elem.file+" target='_blank'> <img class='mr-3' src="+ elem.file +"  width='50' height='50'> </a><br></p><br>");
			  }

			});
		},
		error   :   function(err) {
			console.log(err);
		}
	});
}


function responderMensajes(){
	let formData    = new FormData();
	let token       = $('#token').val();
 	let mensaje     = $('#mensaje').val();
 	let servicio_id = $('#servicio_id').val();
	let para        = $('#para').val();
	let attachment  = $('#attachment');

	formData.append('file',attachment[0].files[0]);
	formData.append('_token',token);
	formData.append('mensaje',mensaje);
	formData.append('servicio_id',servicio_id);
	formData.append('para',para);
	
	$.ajax({
		url     :  "/responder",
        method    :  'POST',
        data    :   formData,
        processData: false,
		contentType: false,
		success :   function (data) {
			cargarMensajesInbox($('#servicio_id').val(),$('#para').val())
			$('#mensaje').val('');
			$('#attachment').val('');
		},
		error   :   function(err) {
			console.log(err);
			$('#error').val('Error al enviar mensaje.')		
		}
	});





}