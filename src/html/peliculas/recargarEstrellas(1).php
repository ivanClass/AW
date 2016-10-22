<?php
	require_once '../../includes/config.php';

	echo es\ucm\fdi\aw\Pelicula::gestionValoracion($_SESSION['idUser'], $_POST['idPeli']);

?>