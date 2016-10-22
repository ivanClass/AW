<?php
	require_once '../../includes/config.php';
	echo es\ucm\fdi\aw\Noticia::insertaNoticia($_POST['nombre'], $_POST['cuerpo']);
?>