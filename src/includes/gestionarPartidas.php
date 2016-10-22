<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class gestionarPartidas {  

  public static function obtenerPartidasM($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM partidas WHERE jugador1='%s'and puntuacion1<>7 and puntuacion2<>7 ", $conn->real_escape_string($username));

		$rs = $conn->query($query);
		$results_array = array();
		while ($row = $rs->fetch_assoc()) {
		  $results_array[] = $row;
		}
		$rs->free();
		return $results_array;
	
		
    
  }
  public static function obtenerPartidasO($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM partidas WHERE jugador2='%s' and puntuacion1<>7 and puntuacion2<>7", $conn->real_escape_string($username));
    
		$rs = $conn->query($query);
		$results_array = array();
		while ($row = $rs->fetch_assoc()) {
		  $results_array[] = $row;
		}
		$rs->free();
		return $results_array;
	
		
    
  }
  public static function obtenerPartidasFinalizadasM($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM partidas WHERE jugador1='%s'and (puntuacion1=7 or puntuacion2=7) ", $conn->real_escape_string($username));
    
		$rs = $conn->query($query);
		$results_array = array();
		while ($row = $rs->fetch_assoc()) {
		  $results_array[] = $row;
		}
		$rs->free();
		return $results_array;
	  
	
		
    
  }
  public static function obtenerPartidasFinalizadasO($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM partidas WHERE jugador2='%s' and (puntuacion1=7 or puntuacion2=7)", $conn->real_escape_string($username));
    
		$rs = $conn->query($query);
		$results_array = array();
		while ($row = $rs->fetch_assoc()) {
		  $results_array[] = $row;
		}
		$rs->free();
		return $results_array;
		
    
  }
  public static function  crearPartida($username, $rival){
	 $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("INSERT INTO partidas (jugador1,puntuacion1,jugador2,puntuacion2,turno) values ('%s',0,'%s',0,'%s') ", $conn->real_escape_string($username),$conn->real_escape_string($rival), $conn->real_escape_string($username));
	 $rs = $conn->query($query);
	 
	
	
}
	public static function obtenerDatosPartida($id) {
   
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM partidas WHERE id_partida='%s' ", $conn->real_escape_string($id));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $partida = new gestionarPartidas($fila['jugador1'], $fila['puntuacion1'],$fila['jugador2'],$fila['puntuacion2']);
      $rs->free();

      return $partida;
    }
    
    
  }
  public static function actualizarPartida($id,$puntos,$puntuacion,$siguienteTurno) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
	
    $query = sprintf("UPDATE  partidas  SET %s=%s +'%s',turno='%s' WHERE id_partida='%s'", $conn->real_escape_string($puntuacion),$conn->real_escape_string($puntuacion),$conn->real_escape_string($puntos),$conn->real_escape_string($siguienteTurno),$conn->real_escape_string($id));
	echo $query;
    $rs = $conn->query($query);
    
  }
  


   private $jugador1;

  private $puntuacion1; 
  private $jugador2;

  private $puntuacion2;

  public function __construct($jugador1, $puntuacion1,$jugador2, $puntuacion2) {
    $this->jugador1 = $jugador1;
    $this->puntuacion1 = $puntuacion1;
	 $this->jugador2 = $jugador2;
    $this->puntuacion2 = $puntuacion2;
   
  } 
public function jugador1() {
    return $this->jugador1;
  }
	public function puntuacion1(){		
		return $this->puntuacion1;
	}
	public function jugador2() {
    return $this->jugador2;
  }
	public function puntuacion2(){		
		return $this->puntuacion2;
	}
   
   


  
}
