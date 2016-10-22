<?php
	require_once '../../includes/config.php';
	require_once '../../includes/comun/FormularioFoto.php';

	// Solo se pueden definir arrays como constantes en PHP >= 5.6
	global $EXTENSIONES_PERMITIDAS;

	$result = array();
	$ok = count($_FILES) == 1 && $_FILES['file']['error'] == UPLOAD_ERR_OK;

	if ( $ok ) {
		$archivo = $_FILES['file'];
		$nombre = $_FILES['file']['name'];
		$dir = DIR_FOTOS_NOT;
		$ok = check_file_uploaded_name($nombre) && check_file_uploaded_length($nombre) && in_array(pathinfo($nombre, PATHINFO_EXTENSION), $EXTENSIONES_PERMITIDAS);
		if ( $ok ) {
			$tmp_name = $_FILES['file']['tmp_name'];
			if ( !move_uploaded_file($tmp_name, $app->resuelvePath($dir.$nombre))) {
				$result[] = 'Error al mover el archivo';
			}
			return "index.php#img=".urlencode(RAIZ_APP.'/img/'.$nombre); //??
		}else {
			$result[] = 'El archivo tiene un nombre o tipo no soportado';
		}
	} else {
		$result[] = 'Error al subir el archivo.';
	}

	echo $result[0];
?>