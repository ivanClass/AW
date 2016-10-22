<?php
	require_once '../../includes/config.php';
	$app->doInclude('lista.php');
	if(isset($_POST['follow'])){
			echo es\ucm\fdi\aw\Lista::unfollowLista($_POST['id_lista'],$_SESSION['idUser']);
	}
	else {
	echo es\ucm\fdi\aw\Lista::followLista($_POST['id_lista'],$_SESSION['idUser']);
	}
	


?>