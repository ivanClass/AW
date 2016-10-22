<meta charset="UTF-8">
<?php

require_once '../../includes/config.php';

header("Location: perfil_usuario.php");


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nombre = escapar($_POST["nombre"]);
		$correo = escapar($_POST["correo"]);
		$descripcion = escapar($_POST["descripcion"]);

    	$conexion = $app->conexionBd();
    	$updateDatos = "UPDATE usuarios";
    	$updateCorreo = "";
    	$updateNombre = "";
    	$updateDescripcion = "";
    	$hayColumnasCambiadas = FALSE;
    	
    	if (!empty($correo)){
    		$updateCorreo = sprintf("correo='%s' ", $conexion->real_escape_string($correo));
    		$hayColumnasCambiadas = TRUE;
    	}
    	if (!empty($nombre)){
    		if ($hayColumnasCambiadas)
    			$updateNombre = sprintf(", nombre='%s' ", $conexion->real_escape_string($nombre));
    		else
    			$updateNombre = sprintf("nombre='%s' ", $conexion->real_escape_string($nombre));
    		$hayColumnasCambiadas = TRUE;
    	}
    	if (!empty($descripcion)){
    		if ($hayColumnasCambiadas)
    			$updateDescripcion = sprintf(", descripcion='%s'", $conexion->real_escape_string($descripcion));
    		else
    			$updateDescripcion = sprintf("descripcion='%s'", $conexion->real_escape_string($descripcion));
    		$hayColumnasCambiadas = TRUE;
    	}
    	$where = sprintf(" WHERE nick='%s'", $_SESSION['idUser']);
    	$updateDatos = $updateDatos . " SET " . $updateCorreo . $updateNombre . $updateDescripcion . $where;

        $conexion->query("$updateDatos");

	}


function escapar($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>