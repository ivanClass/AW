<meta charset="UTF-8">
<?php
	$conexion = $app->conexionBd();
	if ( mysqli_connect_errno() ) {
		echo "Error de conexión a la BD: ".mysqli_connect_error();
		exit();
	}

	$usuarioLogueado = $_SESSION['idUser'];

	$queryRecibidos = sprintf("SELECT * FROM mensajes WHERE receptor='%s'",
		$app->conexionBd()->real_escape_string($usuarioLogueado));
	$resultado = $conexion->query($queryRecibidos);

	$bloqueMensajesRecibidos = "<ul><h3>Mensajes recibidos:</h3>";
	if (($resultado != null) && ($resultado->num_rows != 0)){
		foreach ($resultado as $valor){
			$bloqueMensajesRecibidos .= "<li><h3>De: $valor[emisor]</h3>
			<p>Asunto: $valor[asunto]. Fecha: $valor[fecha]</p>
			<p>$valor[contenido]</p>
			</li>";
		}
		$resultado->free();
	}
	else{
		$bloqueMensajesRecibidos .=  "<p>El usuario no ha recibido mensajes</p>";
	}
	$bloqueMensajesRecibidos .= "</ul>";


	$queryEnviados = sprintf("SELECT * FROM mensajes WHERE emisor='%s'",
		$app->conexionBd()->real_escape_string($usuarioLogueado));

	$resultado = $conexion->query($queryEnviados);

	$bloqueMensajesEnviados = "<ul><h3>Mensajes enviados:</h3>";
	if (($resultado != null) && ($resultado->num_rows != 0)){
		foreach ($resultado as $valor){
			$bloqueMensajesEnviados .= "<li><h3>Para: $valor[receptor]</h3>
			<p>Asunto: $valor[asunto]. Fecha: $valor[fecha]</p>
			<p>$valor[contenido]</p>
			</li>";
		}
		$resultado->free();
	}
	else{
		$bloqueMensajesEnviados .= "<p>El usuario no ha enviado mensajes</p>";
	}
	$bloqueMensajesEnviados .= "</ul>";

	echo $bloqueMensajesRecibidos;
	echo $bloqueMensajesEnviados;
?>