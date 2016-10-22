<?php
	require_once '../../includes/config.php';

	echo es\ucm\fdi\aw\Pelicula::imprimeComentariosPelicula($_POST['idPeli']);

?>