<?php
	//require_once '../config.php';

	function procesarSubidaImagen($params, $nick, $app){
		global $EXTENSIONES_PERMITIDAS;

		$result = array();
		$ok = $params['error'] == UPLOAD_ERR_OK;

		if ( $ok ) {
			$nombre = $params['name'];
			$dir = DIR_FOTOS_USU;
			$ok = check_file_uploaded_name($nombre) && check_file_uploaded_length($nombre) && pathinfo($nombre, PATHINFO_EXTENSION);
			$dep = pathinfo($nombre, PATHINFO_EXTENSION);
			if ( $ok ) {
				$tmp_name = $params['tmp_name'];

				//if ( !move_uploaded_file($tmp_name, '/var/www/html/data/users/'.$nick.'.'.$dep) ){
				if( !move_uploaded_file($tmp_name, $app->resuelvePath($dir.$nick).'.'.$dep)){
					return "mal";
				}
				return "ok";
			}
			else {
				return "El archivo tiene un nombre o tipo no soportado";
			}
		} 
		else {
			return "mal";	
		}

		return "ok";
	}

	function check_file_uploaded_name ($filename) {
    	return (bool) ((preg_match('/^[0-9A-Z-_\. ]+$/i', $filename) === 1) ? true : false );
	}

	function check_file_uploaded_length ($filename) {
    	return (bool) ((mb_strlen($filename,'UTF-8') < 250) ? true : false);
	}
?>