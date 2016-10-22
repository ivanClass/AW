<?php
	require_once '../../includes/config.php';
	echo es\ucm\fdi\aw\Noticia::borraNoticia($_POST['id']);
?>