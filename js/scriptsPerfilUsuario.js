function mostrarPeliculas(){
	esconderContenidoDerecho();
	document.getElementById("peliculas").style.display="block";
}
function editarPerfil(){
	esconderContenidoDerecho();
	document.getElementById("formPerfil").style.display="block";
}
function mostrarMensajes(){
	esconderContenidoDerecho();
	document.getElementById("mensajes").style.display="block";
}
function mostrarSeguidores(){
	esconderContenidoDerecho();
	document.getElementById("seguidores").style.display="block";
}
function mostrarComentarios(){
	esconderContenidoDerecho();
	document.getElementById("comentarios").style.display="block";
}
function mostrarRespuestas() {
	esconderContenidoDerecho();
	document.getElementById("respuestas").style.display="block";
}
function esconderContenidoDerecho(){
	var arrayContenidos = document.getElementsByClassName("contenidoDerecho");
	for (i = 0; i < arrayContenidos.length; i++) {
		arrayContenidos[i].style.display="none";
	}
}