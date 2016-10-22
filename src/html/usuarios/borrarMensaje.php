<?php
	require_once '../../includes/config.php';
	echo es\ucm\fdi\aw\Usuario::borrarMensaje($_POST['id']);
?>