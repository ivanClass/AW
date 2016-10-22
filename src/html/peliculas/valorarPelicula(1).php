<?php
	require_once '../../includes/config.php';

	echo es\ucm\fdi\aw\Pelicula::valorarPelicula($_POST['puntos'], $_POST['idPeli']);

?>