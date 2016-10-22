<?php
require_once '../../includes/config.php';
require_once '../../includes/Jugadores.php';
	require_once '../../includes/Preguntas.php';
	require_once '../../includes/Respuesta.php';
	$j = new \es\ucm\fdi\aw\Jugadores("pepe",10);
 $rcorrecta = $_POST['correcta'];
$id= $_POST['id'];

$respuesta = new \es\ucm\fdi\aw\Respuesta();
if($rcorrecta == 1)
{
	
	$_SESSION['puntos'] += 5;
	$_SESSION['racha'] += 1;
	$respuesta->insertarRespuesta($id,$_SESSION['idUser']);
	$j->actualizarPuntos($_SESSION['idUser']);
	
	


}else{
	$respuesta->insertarRespuesta($id,$_SESSION['idUser']);
	$_SESSION['racha'] =0;
}
	header("Location: trivial.php");