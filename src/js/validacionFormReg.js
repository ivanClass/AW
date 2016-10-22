function validacionRegistrarse(){
	var nick = $("#nick");
	var nombre = $("#name");
	var email = $("#email");
	var pass1 = $("#pass1");
	var pass2 = $("#pass2");

	var seguro = true;
	var error = false;
	var codigosError = new Array();
	var codigosSeguro = new Array();
	var textoError;

	recargarElementos(); //si al volver a dar a registrar se corrigen errores pero siguen habiendo otros esto quita el rojo a los corregidos

	if(nombreValido(nick.val())){
		if(nick.val().length < 4 || nick.val().length > 16) {
			nick.css("background", "red");
			nick.css("color", "white");
			codigosError.push("nick");
			error = true;
		}
	}
	else{
		nick.css("background", "yellow");
		nick.css("color", "red");
		codigosSeguro.push("nick");
		seguro = false;
	}

	if(nombreValido(nombre.val())){
		if(nombre.val().length < 4 || nombre.val().length > 30) {
			nombre.css("background", "red");
			nombre.css("color", "white");
			codigosError.push("nombre");
			error = true;
		}
	}
	else{
		nombre.css("background", "yellow");
		nombre.css("color", "red");
		codigosSeguro.push("nombre");
		seguro = false;
	}

	if(emailSeguro(email.val())){
		/*if(nombre.val().length < 4 || nombre.val().length > 16) {
			nombre.css("background", "red");
			nombre.css("color", "white");
			codigosError.push("nombre");
			error = true;
		}*/
	}
	else{
		email.css("background", "yellow");
		email.css("color", "red");
		codigosSeguro.push("email");
		seguro = false;
	}

	if(palabraSeguro(pass1.val())){
		if(pass1.val().length < 4 || pass2.val().length > 16) {
			pass1.css("background", "red");
			pass1.css("color", "white");
			codigosError.push("pass1");
			error = true;
		}
	}
	else{
		pass1.css("background", "yellow");
		pass1.css("color", "red");
		codigosSeguro.push("pass1");
		seguro = false;
	}

	if(palabraSeguro(pass2.val())){
		if(pass2.val().length < 4 || pass2.val().length > 16) {
			pass2.css("background", "red");
			pass2.css("color", "white");
			codigosError.push("pass2");
			error = true;
		}
	}
	else{
		pass2.css("background", "yellow");
		pass2.css("color", "red");
		codigosSeguro.push("pass2");
		seguro = false;
	}

	if(pass1.val() != pass2.val()){
		pass1.css("background", "red");
		pass1.css("color", "white");
		pass2.css("background", "red");
		pass2.css("color", "white");
		codigosError.push("pass");
		error = true;
	}


	if(error || !seguro){
		textoError = "Se han encontrado las siguientes incidencias: \n";
		if(error){
			if(codigosError.indexOf("nick") != -1){
				textoError += "	- El nick no tiene la longitud adecuada (4 - 16 carácteres). \n"; 
			}
			if(codigosError.indexOf("nombre") != -1){
				textoError += "	- El nombre no tiene la longitud adecuada (4 - 16 carácteres). \n"; 
			}
			if(codigosError.indexOf("pass1") != -1){
				textoError += "	- La primera contraseña no tiene la longitud adecuada (4 - 16 carácteres). \n"; 
			}
			if(codigosError.indexOf("pass2") != -1){
				textoError += "	- La segunda contraseña no tiene la longitud adecuada (4 - 16 carácteres). \n"; 
			}
			if(codigosError.indexOf("pass") != -1){
				textoError += "	- Las contraseñas no coinciden. \n"; 
			}
		}

		if(!seguro){
			if(codigosSeguro.indexOf("nick") != -1){
				textoError += "	- El nick tiene carácteres no permitidos (<>$ entre otros). \n"; 
			}
			if(codigosSeguro.indexOf("nombre") != -1){
				textoError += "	- El nombre tiene carácteres no permitidos (<>$ entre otros). \n"; 
			}
			if(codigosSeguro.indexOf("email") != -1){
				textoError += "	- El email no tiene el formato adecuado. \n"; 
			}
			if(codigosSeguro.indexOf("pass1") != -1){
				textoError += "	- La primera contraseña tiene carácteres no permitidos (<>$ entre otros). \n"; 
			}
			if(codigosSeguro.indexOf("pass2") != -1){
				textoError += "	- La segunda contraseña tiene carácteres no permitidos (<>$ entre otros). \n"; 
			}
		}

		alert(textoError);
	}

	return !error && seguro;
};
		
function recargarElementos(){
	var nick = $("#nick");
	var nombre = $("#name");
	var email = $("#email");
	var pass1 = $("#pass1");
	var pass2 = $("#pass2");
	
	nick.css("background", "white");
	nick.css("color", "grey");
	nombre.css("background", "white");
	nombre.css("color", "grey");
	email.css("background", "white");
	email.css("color", "grey");
	pass1.css("background", "white");
	pass1.css("color", "grey");
	pass2.css("background", "white");
	pass2.css("color", "grey");
};

function apodoOcupado(){
	var nick = $("#nick");
	
	nick.css("background", "yellow");
	nick.css("color", "red");
	
	alert("El apodo está ocupado. Elija otro.")
};

function palabraSeguro(palabra) {
	//return palabra.match("^[a-zA-Z0-9_ ]*$");
	return /^[a-zA-Z0-9_ ]*$/.test(palabra);
};

function descripcionSeguro (descripcion) {
	//return descripcion.match("^[a-zA-Z0-9-_,._ ]*$");
	return /^[a-zA-Z0-9-_,._ ]*$/.test(descripcion);
};

function direccionSeguro (direccion) {
	//return direccion.match("^[a-zA-Z0-9-_,._ ]*$");
	return /^[a-zA-Z0-9-_,._ ]*$/.test(direccion);
};

function horarioSeguro (horario) {
	//return direccion.match("^[0-9-]*$");
	return /^[0-9-]*$/.test(horario);
};

function telefonoSeguro (telefono) {
	//return telefono.match("^[0-9]{9}$");
	return /^[0-9]{9}$/.test(telefono);
};

function fechaSeguro (fecha) {
	//return fecha.match("^[0-9 -:]*$");
	return /^[0-9 -:]*$/.test(fecha);
};

function emailSeguro(email) {
	//return email.match("^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@" + "[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$");
	return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email);
};

function nombreValido (valor)
{
    var reg = /^([a-zA-Z0-9_ ñáéíóú ]{2,60})$/i;
    if(reg.test(valor)) 
    	return true;
    else 
    	return false;
}