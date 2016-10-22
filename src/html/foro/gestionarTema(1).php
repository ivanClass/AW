<?php
require_once '../../includes/config.php';
	
	require_once '../../includes/gestionForo.php';
	
  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';
function comprobarTema(){ 
      $result = array();
      $ok = TRUE;
	  
	  
      $tema = isset($_POST['tema']) ? $_POST['tema'] : null ;
      if ( !$tema  || !preg_match("/^[a-zA-Z0-9 ¿?ñáéíóú]+$/", $tema)) {
        $result[] = 'temaIncorrecto';
        $ok = FALSE;
      }

   
    if ( $ok ) {
      
    
         $result[] = 'Correcto';
		
		
		$foro = new \es\ucm\fdi\aw\gestionForo();
		$foro -> anadirTema($_SESSION['idUser'],$tema);
		return 'Correcto';
    
    }else{
		$result[] = 'Incorrecto';
		return 'Incorrecto';

	} 
}

function comprobarMensaje(){ 
      $result = array();
      $ok = TRUE;
	  $tema=$_POST['id'];
	  
      $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : null ;
      if ( !$mensaje  || !preg_match("/^[a-zA-Z0-9 ¿?ñáéíóú]+$/", $mensaje)) {
        $result[] = 'temaIncorrecto';
        $ok = FALSE;
      }

   
    if ( $ok ) {
      
    
         $result[] = 'Correcto';
		
		
		$foro = new \es\ucm\fdi\aw\gestionForo();
		$foro -> anadirMensaje($_SESSION['idUser'],$tema,$mensaje);
		return 'Correcto';
    
    }else{
		$result[] = 'Incorrecto';
		return 'Incorrecto';

	} 
}
?>