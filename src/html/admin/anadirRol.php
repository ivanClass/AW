<?php
		require_once '../../includes/config.php';
	use es\ucm\fdi\aw\Aplicacion as App;

	$app = App::getSingleton();
     $conn = $app->conexionBd();
	 if(isset($_GET['rol'])){
     $query = sprintf('UPDATE usuarios SET rol="%s" WHERE nick = "%s"',$conn->real_escape_string($_GET['rol']),$conn->real_escape_string($_GET['nick']));}
	 else {
		  $query = sprintf('UPDATE usuarios SET rol="REGISTRADO" WHERE nick = "%s"',$conn->real_escape_string($_GET['nick']));
		 
		 
	 }
      $rs = $conn->query($query);
	  echo $query;
	header('Location: admin_panel.php?page=users');
?>