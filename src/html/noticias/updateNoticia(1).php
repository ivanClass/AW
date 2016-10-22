<?php
	require_once '../../includes/config.php';
	es\ucm\fdi\aw\Noticia::updateNoticia($_POST['idNoticia'], $_POST['nombre'], $_POST['cuerpo']);
?>