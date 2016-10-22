<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class gestionForo {  

  

   public static function fechaUltimoMensaje($id) {
   $app = App::getSingleton();
    $conn = $app->conexionBd();
     $query = sprintf("SELECT MAX(fecha) as fecha FROM comentarios_foro WHERE id_tema='%s'  ", $conn->real_escape_string($id));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $numero = $fila['fecha'];
      $rs->free();

      return $numero;
    }
    return 0;
  }
  public static function nMensaje($id) {
   $app = App::getSingleton();
    $conn = $app->conexionBd();
     $query = sprintf("SELECT count(*) as numero FROM comentarios_foro WHERE id_tema='%s' ", $conn->real_escape_string($id));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $numero = $fila['numero'];
      $rs->free();

      return $numero;
    }
    return 0;
  }
   public static function tema($id) {
   $app = App::getSingleton();
    $conn = $app->conexionBd();
     $query = sprintf("SELECT titulo as titulo FROM foro WHERE id_tema='%s'  ", $conn->real_escape_string($id));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $numero = $fila['titulo'];
      $rs->free();

      return $numero;
    }
    return 0;
  }
  public static function  anadirTema($username, $tema){
	 $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("INSERT INTO foro (titulo,creador) values ('%s','%s') ", $conn->real_escape_string($tema),$conn->real_escape_string($username));
	 Usuario::sumaPuntos($username);
	 $rs = $conn->query($query);
	
	
}
public static function  anadirMensaje($username, $tema,$mensaje){
	 $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("INSERT INTO comentarios_foro (id_tema,comentario,autor) values ('%s','%s','%s') ", $conn->real_escape_string($tema),$conn->real_escape_string($mensaje),$conn->real_escape_string($username));
	Usuario::sumaPuntos($username);
	 $rs = $conn->query($query);
	
	
}
  public static function temasEscritos() {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM foro ");
    $rs = $conn->query($query);
	$results_array = array();
		while ($row = $rs->fetch_assoc()) {
		  $results_array[] = $row;
		}
		$rs->free();
		return $results_array;
  }
   public static function comentariosEscritos($id) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT  * FROM comentarios_foro WHERE id_tema='%s' order by  fecha asc", $conn->real_escape_string($id));
    $rs = $conn->query($query);
	$results_array = array();
		while ($row = $rs->fetch_assoc()) {
		  $results_array[] = $row;
		}
		$rs->free();
		return $results_array;
  }
	
	

  public function __construct() {
    
  } 

  

  
  
}