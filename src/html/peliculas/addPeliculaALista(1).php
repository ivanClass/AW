<?php
	require_once '../../includes/config.php';

	if($_SESSION['idUser'] == es\ucm\fdi\aw\lista::dameAutorLista($_POST['idLista'])){
		if($_POST['idPeli'] == es\ucm\fdi\aw\lista::comprobarExistenciaEnLista($_POST['idLista'], $_POST['idPeli'])){
			echo "La lista ya contenía la película en cuestión";
		}
		else{
			es\ucm\fdi\aw\lista::anadirPelicula($_POST['idLista'], $_POST['idPeli']);
			echo "ok";
		}
	}
	else{
		echo "No eres el propietario de la lista o esta no existe";
	}

	

?>