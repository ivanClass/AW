<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Respuesta{  

 
  public static function respuestas($id_pregunta) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM opciones WHERE id_pregunta = '%s' ", $conn->real_escape_string($id_pregunta));
	
    $rs = $conn->query($query);
	$results_array = array();
		while ($row = $rs->fetch_assoc()) {
		  $results_array[] = $row;
		}
		$rs->free();
		return $results_array;
     

      
    
  }
   public static function insertarOpciones($id,$opcion1,$correcta){
	   $app = App::getSingleton();
       $conn = $app->conexionBd();
	   $query = sprintf("INSERT INTO opciones (texto,id_pregunta,correcta) values ('%s','%s','%s') ", $conn->real_escape_string($opcion1),$conn->real_escape_string($id),$correcta);
	   $rs = $conn->query($query);
	   

   }
   public static function insertarRespuesta($id,$name){
	   $app = App::getSingleton();
       $conn = $app->conexionBd();
	   $query = sprintf("INSERT INTO contesta_preguntas (opcion,nick) values ('%s','%s') ", $conn->real_escape_string($id),$conn->real_escape_string($name));
	   $rs = $conn->query($query);
	   

   }
  public static function respuestasCorrectas($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT COUNT(*) as numero FROM contesta_preguntas   join opciones WHERE nick='%s' and correcta= '1' and id_opcion=opcion ", $conn->real_escape_string($username));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $numero = $fila['numero'];
      $rs->free();

      return $numero;
    }
    return 0;
  }
	

  public function __construct() {
   
   
  } 
   

  
  
}