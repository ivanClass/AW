<?php
require_once '../../includes/config.php';

$_SESSION['id_partidas'] = $_POST['idPartida'];
$_SESSION['mostrar']= True;
$_SESSION['jugador1']= $_POST['jugador1'];

header("Location: Partidas.php");

