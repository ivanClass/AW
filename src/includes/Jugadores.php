<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Jugadores {  

  public static function buscaJugador($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM jugadores WHERE nick='%s'", $conn->real_escape_string($username));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $jugador = new Jugadores($fila['nick'], $fila['puntuacion']);
      $rs->free();

      return $jugador;
    }
	else{
		  $query = sprintf("INSERT INTO jugadores (nick,puntuacion) VALUES('%s',0)", $conn->real_escape_string($username));
         $rs = $conn->query($query);
		

		return  $jugador = new Jugadores($username, 0);
	}
		
    
  }
	public static function obtenerJugadores() {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM jugadores order by jugadores.puntuacion desc LIMIT 5");
    $rs = $conn->query($query);
	$results_array = array();
		while ($row = $rs->fetch_assoc()) {
		  $results_array[] = $row;
		}
		$rs->free();
		return $results_array;
    
    
  }
  
	
	public static function obtenerJugadoresPosibles($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM jugadores where nick<>'%s'",$conn->real_escape_string($username));
    
		$rs = $conn->query($query);
		$results_array = array();
		while ($row = $rs->fetch_assoc()) {
		  $results_array[] = $row;
		}
		$rs->free();
		return $results_array;
    
    
  }
  public static function actualizarPuntos($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("UPDATE  jugadores  SET puntuacion=puntuacion +5 WHERE nick='%s'", $conn->real_escape_string($username));
    $rs = $conn->query($query);
    
  }
  private $nick;

  private $puntuacion=60; 

  public function __construct($nick, $puntuacion) {
    $this->nick = $nick;
    $this->puntuacion = $puntuacion;
   
  } 
   

  public function username() {
    return $this->username;
  }
	public function puntos(){		
		return $this->puntuacion;
	}
  
}
