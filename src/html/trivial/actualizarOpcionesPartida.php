<?php
require_once '../../includes/config.php';
require_once '../../includes/Jugadores.php';
	require_once '../../includes/Preguntas.php';
	require_once '../../includes/gestionarPartidas.php';
	require_once '../../includes/Respuesta.php';
	$j = new \es\ucm\fdi\aw\Jugadores("pepe",10);
	$partidas = new \es\ucm\fdi\aw\gestionarPartidas("","","","");
 $rcorrecta = $_POST['correcta'];
$id= $_POST['id'];
$_SESSION['mostrar']=False;
$respuesta = new \es\ucm\fdi\aw\Respuesta();
if($rcorrecta == 1)
{
	
	$p1=$partidas->obtenerDatosPartida($_SESSION['id_partidas']);
	 if($_SESSION['jugador1']=="True"){
		
		$partidas->actualizarPartida($_SESSION['id_partidas'],1,"puntuacion1",$p1->jugador2());
		 
	}else {
		
			$partidas->actualizarPartida($_SESSION['id_partidas'],1,"puntuacion2",$p1->jugador1());
		 
		}
	
	header("Location: Partidas.php");

}else{
	$p1=$partidas->obtenerDatosPartida($_SESSION['id_partidas']);
	 if($_SESSION['jugador1']=="True"){
		 
		$partidas->actualizarPartida($_SESSION['id_partidas'],0,"puntuacion1",$p1->jugador2());
	}else {
		$partidas->actualizarPartida($_SESSION['id_partidas'],0,"puntuacion2",$p1->jugador1());
		}
	header("Location: Partidas.php");
}