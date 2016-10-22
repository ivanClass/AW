<?php
	require_once '../../includes/config.php';

	$comentarioValidado = htmlentities($_POST['comentario'], ENT_SUBSTITUTE, "UTF-8");

	es\ucm\fdi\aw\Pelicula::addComentarioPelicula($_POST['idPeli'], $comentarioValidado);

?>