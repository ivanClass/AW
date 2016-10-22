<?php
	require_once '../../includes/config.php';
	echo es\ucm\fdi\aw\Usuario::insertaMensaje($_SESSION['idUser'], $_POST['receptor'], $_POST['asunto'], $_POST['mensaje']);
?>