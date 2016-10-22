<?php
	require_once '../../includes/config.php';
	$usu = es\ucm\fdi\aw\Usuario::buscaUsuario($_GET['nick']);
	if($usu){
		echo '1';
	}
	else{
		echo '0';
	}
?>