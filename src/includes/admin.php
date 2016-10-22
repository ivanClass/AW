<?php

namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\Lista as Lista;
class Admin{
	public function cargarUsuarios(){
		
		$app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT nick,puntos,nombre,rol FROM usuarios ORDER BY puntos DESC");
	        $result = Array();

      $rs = $conn->query($query);
		while ($fila = $rs->fetch_assoc()) {
			$result[]=$fila;
		}
		$rs->free();
      return $result;
		
		
	}

	public function cargarListas(){
		$lista = new Lista();
		return $lista-> cargarNovedades();
	}
	
	public function cargarPeliculas(){
		
		$app = App::getSingleton();
      $cont = 0;
      $conn = $app->conexionBd();
      $query = sprintf("SELECT ID,titulo,imagen,year FROM peliculas");
            $result = Array();

      $rs = $conn->query($query);
		while ($fila = $rs->fetch_assoc()) {
			$result[]=$fila;
		}
		$rs->free();
      return $result;
		
		
		
	}
	
	public function cargarPreguntas(){
		
		$app = App::getSingleton();
      $cont = 0;
      $conn = $app->conexionBd();
      $query = sprintf("SELECT enunciado,id_pregunta, autor FROM preguntas");
            $result = Array();

      $rs = $conn->query($query);
		while ($fila = $rs->fetch_assoc()) {
			$result[]=$fila;
		}
		$rs->free();
      return $result;
		
		
	}
	
	public function cargarForo(){
		$app = App::getSingleton();
      $cont = 0;
      $conn = $app->conexionBd();
      $query = sprintf("SELECT id_tema,titulo,creador FROM foro");
             $result = Array();

      $rs = $conn->query($query);
		while ($fila = $rs->fetch_assoc()) {
			$result[]=$fila;
		}
		$rs->free();
      return $result;
		
		
	}
	public static function borrarUsuario($id){
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $sql = "DELETE FROM usuarios WHERE nick=\"$id\"";
    $conn->query($sql);
		echo $sql;

  }
  public static function borrarPregunta($id){
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $sql = "DELETE FROM preguntas WHERE id_pregunta=$id ";
    $conn->query($sql);
		echo $sql;

	}
	public static function borrarPelicula($id){
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $sql = "DELETE FROM peliculas WHERE ID=\"$id\" ";
    $conn->query($sql);
		echo $sql;

	}
	public static function borrarLista($id){
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $sql = "DELETE FROM listas WHERE id_lista=$id ";
    $conn->query($sql);
		echo $sql;

	}
	public static function borrarForo($id){
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $sql = "DELETE FROM foro WHERE id_tema=$id ";
    $conn->query($sql);
		echo $sql;

	}
	
	
	 public function __construct(){
		 
	 }
}

?>