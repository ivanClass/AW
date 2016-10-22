<?php
	require_once '../../includes/config.php';
	require_once $app->resuelvePath(RUTA_COMUN.'FormularioFoto.php');
	require_once $app->resuelvePath(RUTA_COMUN.'FormularioRegistrarse.php');

	$comprobarFoto = isset($_FILES['file']) ? $_FILES['file'] : null ;

	$ok1 = isset($_SESSION['nickAux']) ? $_SESSION['nickAux'] : null ;
	$ok2 = isset($_SESSION["passAux"]) ? $_SESSION["passAux"] : null ;

	if($ok1 && $ok2){

		if($comprobarFoto && count($_FILES) == 1){
			$ok = procesarSubidaImagen($comprobarFoto , $_SESSION['nickAux'], $app);
			if($ok === "ok"){
				inicioSesion($_SESSION['nickAux'], $_SESSION["passAux"]);
				return ;
			}
			else{
				$imagen = "user.png";
				$im1 = $app->resuelvePath(DIR_FOTO_SIN_PERFIL.$imagen);
				$im2 = $app->resuelvePath(DIR_FOTOS_USU.$_SESSION['nickAux'].'.png');

				copy($im1, $im2);

				inicioSesion($_SESSION['nickAux'], $_SESSION["passAux"]);	
			}
		}
		if(count($_FILES) >= 0){
			$imagen = "user.png";
			$im1 = $app->resuelvePath(DIR_FOTO_SIN_PERFIL.$imagen);
			$im2 = $app->resuelvePath(DIR_FOTOS_USU.$_SESSION['nickAux'].'.png');

			copy($im1, $im2);

			inicioSesion($_SESSION['nickAux'], $_SESSION["passAux"]);
		}

		return;
	}
?>

<?php
	function inicioSesion($na, $pass){
		$user = es\ucm\fdi\aw\Usuario::login($_SESSION['nickAux'], $_SESSION["passAux"]);
		if ( $user ) {
			// SEGURIDAD: Forzamos que se genere una nueva cookie de sesiÃ³n por si la han capturado antes de hacer login
			session_regenerate_id(true);
			es\ucm\fdi\aw\Aplicacion::getSingleton()->login($user);
		}
		unset($_SESSION["nickAux"]);
		unset($_SESSION["passAux"]);
				
		$r_app = RUTA_APP;
				
		//header('Location: '.$r_app);
	}
?>