<meta charset="UTF-8">
<?php
	$conexion = $app->conexionBd();
	if ( mysqli_connect_errno() ) {
		echo "Error de conexión a la BD: ".mysqli_connect_error();
		exit();
	}
	
	$usuarioLogueado = $_SESSION['idUser'];
	$query=sprintf("SELECT * FROM usuarios WHERE nick='%s'",
					$app->conexionBd()->real_escape_string($usuarioLogueado));
	$resultado=$conexion->query($query);
	$userResultado=$resultado->fetch_assoc();
	$bloqueDatosUsuario = <<<EOF
	<ul>
		<li><strong>Nombre: </strong>$userResultado[nombre]</li>
		<li><strong>Nick: </strong>$userResultado[nick]</li>
		<li><strong>e-mail: </strong>$userResultado[correo]</li>
		<li><strong>Puntos: </strong>$userResultado[puntos]</li>
	</ul>
EOF;
	echo $bloqueDatosUsuario;
	$resultado->free();
	
?>