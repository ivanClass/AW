<?php
	require_once '../../includes/config.php';
	$app->doInclude('Pelicula.php');
	use es\ucm\fdi\aw\Aplicacion as App;

	echo es\ucm\fdi\aw\Pelicula::addTrailer($_GET['id'],$_GET['enlace']);

	 header('Location:  admin_panel.php?page=peliculas');
?>