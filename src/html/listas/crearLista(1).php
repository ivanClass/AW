<?php
	require_once '../../includes/config.php';
	$app->doInclude('lista.php');
	echo es\ucm\fdi\aw\Lista::guardarLista($_POST['name'],$_SESSION['idUser'],$_POST['ids']);

?>