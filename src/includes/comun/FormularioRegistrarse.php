<?php

const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

	function apodoOcupado($params){
		$nick = isset($params['nick']) ? $params['nick'] : null ;
		$result = array();
		$ok = TRUE;

		if ( !$nick || !preg_match("/^[a-zA-Z0-9_ ñáéíóú]+$/", $nick)) { 
			$result[] = 'nicknovalido';
			$ok = FALSE;
		}

		if ( $ok ) {
      
			$user = es\ucm\fdi\aw\Usuario::buscaUsuario($nick);
			if ( $user ) {
				$result[] = 'existe';
			}else {
				$result[] = 'noexiste';
			}
    	}

    	return $result[0];
	}


    function procesaFormularioRegistro($params) {
    	$nick = isset($params['nick']) ? $params['nick'] : null ;
    	$nombre = isset($params['nombre']) ? $params['nombre'] : null ;
    	$email = isset($params['email']) ? $params['email'] : null ;
    	$pass1 = isset($params['contra1']) ? $params['contra1'] : null ;
    	$pass2 = isset($params['contra2']) ? $params['contra2'] : null ;

    	$ok = TRUE;

    	if ( !$nick || !preg_match("/^[a-zA-Z0-9_ ñáéíóú]+$/", $nick) || strlen($nick) < 4 || strlen($nick) > 16) { 
			$ok = FALSE;
		}

		if ( !$nombre || !preg_match("/^[a-zA-Z0-9_ ñáéíóú]+$/", $nombre) || strlen($nick) < 4 || strlen($nick) > 30) { 
			$ok = FALSE;
		}

		if ( !$email || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($nick) < 4 || strlen($nick) > 16) { 
			$ok = FALSE;
		}

		if ( !$pass1 || !preg_match("/^[a-zA-Z0-9_ ñáéíóú]+$/", $pass1) || strlen($nick) < 4 || strlen($nick) > 16) { 
			$ok = FALSE;
		}

		if ( !$pass2 || !preg_match("/^[a-zA-Z0-9_ ñáéíóú]+$/", $pass1) || strlen($nick) < 4 || strlen($nick) > 16) { 
			$ok = FALSE;
		}

		if($pass1 != $pass2){
			$ok = FALSE;
		}


		if($ok){
			$pswHashed = password_hash($pass1, PASSWORD_BCRYPT);
			$_SESSION['pswAux'] = $pswHashed;
			$app = es\ucm\fdi\aw\Aplicacion::getSingleton();
		    $conn = $app->conexionBd();
		    $query = sprintf("INSERT INTO usuarios VALUES ('%s', '%s', '%s', '%s', '%d', '%s', 'Hey there, I am using moviect')", $conn->real_escape_string($nick), $conn->real_escape_string($email), $pswHashed, $conn->real_escape_string($nombre), 0, "REGISTRADO");
		    $rs = $conn->query($query);
	   	}

	   	return $ok;
	}
?>