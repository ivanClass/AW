<meta charset="UTF-8">
<?php
	$conexion = $app->conexionBd();
	if ( mysqli_connect_errno() ) {
		echo "Error de conexión a la BD: ".mysqli_connect_error();
		exit();
	}
	
	$usuarioLogueado = $_SESSION['idUser'];
	$query = sprintf("SELECT descripcion FROM usuarios WHERE nick='%s'",
		$app->conexionBd()->real_escape_string($usuarioLogueado));
	$res = $conexion->query($query);
	$resultado = $res->fetch_assoc();
	if (($res != null) && ($res->num_rows != 0) && ($resultado['descripcion'] != "")){
		echo $resultado['descripcion'];
		$res->free();
	}
	else{
		echo "<p>El usuario no tiene descripción</p>";
	}
	
?>