<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Preguntas {  

  public static function preguntasEnviadas($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT COUNT(*) as numero FROM preguntas WHERE autor='%s'", $conn->real_escape_string($username));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $numero = $fila['numero'];
      $rs->free();

      return $numero;
    }
    return false;
  }
public static function  anadirPregunta($username, $pregunta){
	 $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("INSERT INTO preguntas (enunciado,autor) values ('%s','%s') ", $conn->real_escape_string($pregunta),$conn->real_escape_string($username));
	 $rs = $conn->query($query);
	
	
}



public static function getIdUltima(){
	 $app = App::getSingleton();
    $conn = $app->conexionBd();
	$query = sprintf("SELECT MAX(id_pregunta) AS id FROM preguntas");
	 $rs = $conn->query($query);
	 $fila = $rs->fetch_assoc();
	$id=$fila['id'];
	 $rs->free();

      return $id;
}
  public static function preguntasRespondidas($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
     $query = sprintf("SELECT COUNT(*) as numero FROM contesta_preguntas as c,preguntas as p ,opciones as o  WHERE c.nick='%s' and o.id_opcion=c.opcion and p.id_pregunta=o.id_pregunta limit 8", $conn->real_escape_string($username));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $numero = $fila['numero'];
      $rs->free();

      return $numero;
    }
    return 0;
  }
  public static function nContestada($pregunta) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
     $query = sprintf("SELECT COUNT(*) as numero FROM contesta_preguntas as c,preguntas as p ,opciones as o  WHERE p.id_pregunta='%s' and o.id_opcion=c.opcion and p.id_pregunta=o.id_pregunta ", $conn->real_escape_string($pregunta));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $numero = $fila['numero'];
      $rs->free();

      return $numero;
    }
    return 0;
  }
   public static function respuestasCorrectasPregunta($id) {
   $app = App::getSingleton();
    $conn = $app->conexionBd();
     $query = sprintf("SELECT COUNT(*) as numero FROM contesta_preguntas as c,preguntas as p ,opciones as o  WHERE p.id_pregunta='%s' and o.correcta='1' and o.id_opcion=c.opcion and p.id_pregunta=o.id_pregunta ", $conn->real_escape_string($id));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $numero = $fila['numero'];
      $rs->free();

      return $numero;
    }
    return 0;
  }
  
  public static function listaPreguntas($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM  preguntas WHERE autor='%s' LIMIT 8", $conn->real_escape_string($username));
    $rs = $conn->query($query);
	 $results_array = array();
		while ($row = $rs->fetch_assoc()) {
		  $results_array[] = $row;
		}
		$rs->free();
		return $results_array;
	 
  }
   public static function misRespuestas($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT   p.enunciado, o.texto,p.id_pregunta FROM contesta_preguntas as c join opciones as o join preguntas as p WHERE nick='%s'and o.id_opcion=c.opcion and p.id_pregunta=o.id_pregunta LIMIT 8", $conn->real_escape_string($username));
    $rs = $conn->query($query);
	$results_array = array();
		while ($row = $rs->fetch_assoc()) {
		  $results_array[] = $row;
		}
		$rs->free();
		return $results_array;
  }
	public static function preguntaAleatoria() {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM  preguntas order by rand() LIMIT 1" );
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $pregunta = new Preguntas($fila['id_pregunta'], $fila['enunciado'],$fila['autor']);
      $rs->free();

      return $pregunta;
    }
    return new Preguntas(" ", " "," ");
  }
	private $id;

  private $enunciado; 
  private $autor; 

  public function __construct($id, $enunciado,$autor) {
    $this->id = $id;
    $this->enunciado = $enunciado;
	$this->autor = $autor;
  } 

  

  public function id() {
    return $this->id;
  }
	public function enunciado(){		
		return $this->enunciado;
	}
  
}