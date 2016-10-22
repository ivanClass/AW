<?php

function enviaMensaje($params) {
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$asunto = $_POST['asunto'];
	$cuerpo = $_POST['cuerpo'];
	$app = es\ucm\fdi\aw\Aplicacion::getSingleton();
	$conn = $app->conexionBd();
	$sql = "INSERT INTO mensajes_editor (nombre, emailContacto, asunto, mensaje) VALUES ('$nombre', '$email', '$asunto', '$cuerpo')";
	if ($conn->query($sql) === TRUE) {
	    //echo "New record created successfully";
	}
}
?>