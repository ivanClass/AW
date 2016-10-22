<?php
require_once '../../includes/config.php';
	
	require_once '../../includes/Preguntas.php';
	require_once '../../includes/Respuesta.php';
  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';
function comprobarPreguntas(){ 
      $result = array();
      $ok = TRUE;
	  
	  
      $pregunta = isset($_POST['pregunta']) ? $_POST['pregunta'] : null ;
      if ( !$pregunta  || !preg_match("/^[a-zA-Z0-9 ¿?ñáéíóú]+$/", $pregunta)) {
        $result[] = 'Pregunta incorrecta';
        $ok = FALSE;
      }

      $opcion1 = isset($_POST['opcion1']) ? $_POST['opcion1'] : null ;
      if ( ! $opcion1 || !preg_match("/^[a-zA-Z0-9_ ñáéíóú]+$/", $opcion1) ) {
        $result[] = 'Opcion incorrecta';
        $ok = FALSE;
      }
	  
      $opcion2 = isset($_POST['opcion2']) ? $_POST['opcion2'] : null ;
      if ( ! $opcion2 || !preg_match("/^[a-zA-Z0-9_ ñáéíóú]+$/", $opcion2) ) {
        $result[] = 'Opcion incorrecta';
        $ok = FALSE;
      }
	  
      $opcion3 = isset($_POST['opcion3']) ? $_POST['opcion3'] : null ;
      if ( ! $opcion3 || !preg_match("/^[a-zA-Z0-9_ ñáéíóú]+$/", $opcion3)) {
        $result[] = 'Opcion incorrecta';
        $ok = FALSE;
      }
	  
      $opcion4 = isset($_POST['opcion4']) ? $_POST['opcion4'] : null ;
      if ( ! $opcion4 || !preg_match("/^[a-zA-Z0-9_ ñáéíóú]+$/", $opcion4) ) {
        $result[] = 'Opcion incorrecta';
        $ok = FALSE;
      }
	echo $ok;
    if ( $ok ) {
      
    
         $result[] = 'Correcto';
		
		
		$preguntas = new \es\ucm\fdi\aw\Preguntas(1,"a","a");
		$preguntas->anadirPregunta($_SESSION['idUser'], $pregunta);
		$respuesta = new \es\ucm\fdi\aw\Respuesta();
		$id=$preguntas->getIdUltima();
		$respuesta-> insertarOpciones($id,$opcion1,'1');
		$respuesta-> insertarOpciones($id,$opcion2,'0');
		$respuesta-> insertarOpciones($id,$opcion3,'0');
		$respuesta-> insertarOpciones($id,$opcion4,'0');
		
		return 'Correcto';
    
    }else{
		$result[] = 'Incorrecto';
		return 'Incorrecto';

	} 
}
?>