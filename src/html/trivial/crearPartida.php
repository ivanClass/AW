<?php
require_once '../../includes/config.php';

	require_once '../../includes/gestionarPartidas.php';
	
	$partidas = new \es\ucm\fdi\aw\gestionarPartidas("","","","");	
	
	
	$partidas-> crearPartida($_SESSION['idUser'],$_POST['partidaNueva']);
	
	
	header("Location: Partidas.php");
