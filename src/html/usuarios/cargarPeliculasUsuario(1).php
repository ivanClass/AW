<meta charset="UTF-8">
<?php
	$conexion = $app->conexionBd();
	if ( mysqli_connect_errno() ) {
		echo "Error de conexión a la BD: ".mysqli_connect_error();
		exit();
	}
	
	$usuarioLogueado = $_SESSION['idUser'];
	$queryIdLista = sprintf("SELECT id_lista FROM listas WHERE autor='%s'",
		$app->conexionbd()->real_escape_string($usuarioLogueado));
	$res = $conexion->query($queryIdLista);
	$resultadoIdLista = $res->fetch_assoc();
	$queryIdPeliculas = sprintf("SELECT id_pelicula FROM peliculas_listas WHERE 
		id_lista = '%s'",
		$resultadoIdLista['id_lista']);
	$resultadoIdPeliculas = $conexion->query($queryIdPeliculas);
	
	$bloquePeliculas = "<ul>";
	$res = null;
	
	foreach ($resultadoIdPeliculas as $valor){
		$queryPeliculas = sprintf("SELECT * FROM peliculas WHERE ID = '%s'",
			$app->conexionbd()->real_escape_string($valor['id_pelicula']));
		
		$res = $conexion->query($queryPeliculas);
		$resultadoPeliculas = $res->fetch_assoc();
		$bloquePeliculas .= "<li><h2>$resultadoPeliculas[titulo]</h2>
			<p>Año: $resultadoPeliculas[year]</p>
			<p>Director: $resultadoPeliculas[director]</p>
			<p>Duración: $resultadoPeliculas[duracion]</p>
			<p>Valoración: $resultadoPeliculas[valoracion]</p>
			</li>";
	}
	
	$bloquePeliculas .= "</ul>";
	
	if (($res == null) || ($res->num_rows == 0)){
		echo "<p>El usuario no tiene lista de películas</p>";
	}
	else{
		echo $bloquePeliculas;
		$res->free();
		$resultadoIdPeliculas->free();
	}
?>