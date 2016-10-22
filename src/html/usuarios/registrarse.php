<?php
	require_once '../../includes/config.php';
	require_once $app->resuelvePath(RUTA_COMUN.'FormularioRegistrarse.php');

	$comprobarApodo = isset($_POST['apodo']) ? $_POST['apodo'] : "nada" ;

	if($comprobarApodo == "true"){
		echo apodoOcupado($_POST);
	}
	if($comprobarApodo == "false"){
		$ok = procesaFormularioRegistro($_POST);

		if( $ok ){
			isset($_POST['nick']) ? $_POST['nick'] : null ;
			isset($_POST['contra2']) ? $_POST['contra2'] : null ;
			$_SESSION['nickAux'] = $_POST['nick'];
			$_SESSION['passAux'] = $_POST['contra2'];
		}
		
		echo $ok;
	}
?>