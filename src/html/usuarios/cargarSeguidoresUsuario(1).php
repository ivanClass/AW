<meta charset="UTF-8">
<?php
	$conexion = $app->conexionBd();
	if ( mysqli_connect_errno() ) {
		echo "Error de conexión a la BD: ".mysqli_connect_error();
		exit();
	}
	
	$usuarioLogueado = $_SESSION['idUser'];
	$query = sprintf("SELECT follower FROM followers_usuario WHERE usuario='%s'",
		$app->conexionBd()->real_escape_string($usuarioLogueado));
	$resultadoSeguidores = $conexion->query($query);
	
	$bloqueSeguidores = "<ul>";
	$res = null;
	
	foreach ($resultadoSeguidores as $valor){
		$querySeguidor = sprintf("SELECT * FROM usuarios WHERE nick = '%s'",
			$app->conexionBd()->real_escape_string($valor['follower']));
		
		$res = $conexion->query($querySeguidor);
		$resultadoSeguidor = $res->fetch_assoc();
		$bloqueSeguidores .= "<li><h2>Nick: $resultadoSeguidor[nick]</h2>
			<p>Nombre: $resultadoSeguidor[nombre]</p>
			<p>Correo: $resultadoSeguidor[correo]</p>
			<p>Puntos: $resultadoSeguidor[puntos]</p>
			</li>";
	}
	
	$bloqueSeguidores .= "</ul>";
	if (($res != null) && ($res->num_rows != 0)){
		echo $bloqueSeguidores;
		$res->free();
	}
	else{
		echo "<p>El usuario no tiene seguidores</p>";
	}
?>