<?php
	require_once '../../includes/config.php';
	$app->doInclude('admin.php');
	if(isset($_POST['id_user']))
		echo es\ucm\fdi\aw\Admin::borrarUsuario($_POST['id_user']);
	else if (isset($_POST['id_trivial'])){
				echo "eliminando pregunta";

		echo es\ucm\fdi\aw\Admin::borrarPregunta($_POST['id_trivial']);
	}
	else if (isset($_POST['id_pelicula'])){
		echo "eliminando pelicula";
		echo es\ucm\fdi\aw\Admin::borrarPelicula($_POST['id_pelicula']);
		
	}
	else if (isset($_POST['id_lista'])){
				echo "eliminando lista";

		echo es\ucm\fdi\aw\Admin::borrarLista($_POST['id_lista']);
	}
else if (isset($_POST['id_foro'])){
			echo "eliminando tema";

		echo es\ucm\fdi\aw\Admin::borrarForo($_POST['id_foro']);
}

?>