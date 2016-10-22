<meta charset="UTF-8">
<?php
	$conexion = $app->conexionBd();
	if ( mysqli_connect_errno() ) {
		echo "Error de conexión a la BD: ".mysqli_connect_error();
		exit();
	}
	
	$usuarioLogueado = $_SESSION['idUser'];
	
	$queryComForo = sprintf("SELECT * FROM comentarios_foro WHERE autor='%s'",
		$app->conexionBd()->real_escape_string($usuarioLogueado));
	$resultado = $conexion->query($queryComForo);
	
	$bloqueComForo = "<ul><h3>Comentarios en los foros:</h3>";
	if (($resultado->num_rows != 0) && ($resultado != null)){
		
		foreach ($resultado as $valor){
			$queryTema = sprintf("SELECT titulo FROM foro WHERE id_tema='%s'",
				$app->conexionBd()->real_escape_string($valor['id_tema']));
			$tema = $conexion->query($queryTema)->fetch_assoc();
			$bloqueComForo .= "<li><h3>Tema: $tema[titulo]</h3>
			<p>$valor[comentario].</p>
			<p>Fecha: $valor[fecha]</p>
			</li>";
		}
		$resultado->free();
	}
	else{
		$bloqueComForo .= "<p>El usuario no ha comentado en el foro.</p>";
	}
	$bloqueComForo .= "</ul>";
	
	
	$queryComPelis = sprintf("SELECT * FROM comentarios_peliculas WHERE nick='%s'",
		$app->conexionBd()->real_escape_string($usuarioLogueado));
	$resultado = $conexion->query($queryComPelis);
	
	$bloqueComPelis = "<ul><h3>Comentarios sobre las peliculas:</h3>";
	if (($resultado->num_rows != 0) && ($resultado != null)){
		
		foreach ($resultado as $valor){
			$queryPeli = sprintf("SELECT titulo FROM peliculas WHERE ID='%s'",
				$app->conexionBd()->real_escape_string($valor['id_pelicula']));
			$peli = $conexion->query($queryPeli)->fetch_assoc();
			$bloqueComPelis .= "<li><h3>Película: $peli[titulo]</h3>
			<p>Usuario: $valor[nick]</p>
			<p>$valor[comentario].</p>
			<p>Fecha: $valor[fecha]</p>
			</li>";
		}
		$resultado->free();
	}
	else{
		$bloqueComPelis .= "<p>El usuario no ha hecho comentarios sobre las películas.</p>";
	}
	$bloqueComPelis .= "</ul>";
	
	
	$queryComNoticias = sprintf("SELECT * FROM comentarios_noticias WHERE autor='%s'",
		$app->conexionBd()->real_escape_string($usuarioLogueado));
	$resultado = $conexion->query($queryComNoticias);
	
	$bloqueComNoticias = "<ul><h3>Comentarios sobre las noticias:</h3>";
	if (($resultado->num_rows != 0) && ($resultado != null)){
		
		foreach ($resultado as $valor){
			$queryNoticia = sprintf("SELECT titulo FROM noticias WHERE id_noticia='%s'",
				$app->conexionBd()->real_escape_string($valor['id_noticia']));
			$noticia = $conexion->query($queryNoticia)->fetch_assoc();
			$bloqueComNoticias .= "<li><h3>Noticia: $noticia[titulo]</h3>
			<p>Usuario: $valor[autor]</p>
			<p>$valor[comentario].</p>
			<p>Fecha: $valor[fecha]</p>
			</li>";
		}
		$resultado->free();
	}
	else{
		$bloqueComNoticias .= "<p>El usuario no ha hecho comentarios sobre las noticias.</p>";
	}
	$bloqueComNoticias .= "</ul>";
	
	
	echo $bloqueComForo;
	echo $bloqueComPelis;
	echo $bloqueComNoticias;
?>