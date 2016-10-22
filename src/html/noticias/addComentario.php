<?php
	require_once '../../includes/config.php';
	echo es\ucm\fdi\aw\Noticia::insertaComentario($_POST['noticia'], $_POST['cuerpo']);
?>