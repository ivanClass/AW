<?php
	require_once '../../includes/config.php';

	es\ucm\fdi\aw\Pelicula::addComentarioPelicula($_POST['idPeli'], $_POST['comentario']);

?>