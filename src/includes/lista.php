<?php
namespace es\ucm\fdi\aw;


use es\ucm\fdi\aw\Aplicacion as App;
class Lista {

	public function cargarListas($usuario){
		$app = App::getSingleton();
      $cont = 0;
      $conn = $app->conexionBd();
      $query = sprintf("SELECT titulo,autor,id_lista,count(nick) as followers FROM listas natural left join followers_listas WHERE autor='%s' GROUP BY id_lista", $conn->real_escape_string($usuario));
      $rs = $conn->query($query);
	while ($fila = $rs->fetch_assoc()) {
			$result[]=$fila;
		}
		$rs->free();
      return $result;
	}
	
	public function cargarPeliculas($id_lista){
	$app = App::getSingleton();
      $cont = 0;
      $conn = $app->conexionBd();
	  $result = Array();
      $query = sprintf("SELECT p.ID, p.titulo,p.director,p.year,p.imagen FROM peliculas_listas AS pl, peliculas as p WHERE pl.id_pelicula= p.ID AND id_lista= %d",$id_lista);
      $rs = $conn->query($query);
	 while ($fila = $rs->fetch_assoc()) {
			$result[]=$fila;
		}
		$rs->free();
      return $result;	
	}
	public function cargarTop(){
		$app = App::getSingleton();
      $cont = 0;
      $conn = $app->conexionBd();
      $query = sprintf("SELECT titulo,autor,id_lista, count(nick) as followers FROM listas natural left join followers_listas GROUP BY id_lista ORDER BY followers DESC");
      $rs = $conn->query($query);
	while ($fila = $rs->fetch_assoc()) {
			$result[]=$fila;
		}
		$rs->free();
      return $result;
	}
	public function cargarFavs($usuario){
		$app = App::getSingleton();
      $cont = 0;
      $conn = $app->conexionBd();
      $query = sprintf("SELECT titulo,autor,id_lista, count(nick) as followers FROM listas natural left join followers_listas WHERE nick='%s' GROUP BY id_lista", $conn->real_escape_string($usuario));
      $rs = $conn->query($query);
	while ($fila = $rs->fetch_assoc()) {
			$result[]=$fila;
		}
		$rs->free();
      return $result;
	}
	public function cargarNovedades(){
	$app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT titulo,autor,id_lista, count(nick) as followers FROM listas natural left join followers_listas GROUP BY listas.id_lista DESC");
      $rs = $conn->query($query);
	  while ($fila = $rs->fetch_assoc()) {
			$result[]=$fila;
		}
		$rs->free();
      return $result;
		
	}
	public function guardarLista($nombreLista,$user,$peliculas){
		$app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf('INSERT INTO listas (titulo,autor) VALUES ("%s","%s")',$conn->real_escape_string($nombreLista),$conn->real_escape_string($user));
      $conn->query($query);
	  $id_lista = $conn->insert_id;
	  foreach($peliculas as $id_pelicula){
		  Lista::guardarPelicula($id_pelicula,$id_lista,$user);
	  }
	 Usuario::sumaPuntos($user);
	  
		return $id_lista;
		
		
		
	}
	
	public function guardarPelicula($id,$lista_id,$user){
		$url = file_get_contents("http://www.omdbapi.com/?i=$id&plot=full");
		$json = json_decode($url, true);
		$movie_title = $json['Title'];
		$movie_year = $json['Year'];
		$movie_runtime= $json['Runtime'];
		$movie_director=$json['Director'];
		$movie_plot=$json['Plot'];
		$movie_poster=$json['Poster'];
		$movie_rating=$json['imdbRating'];
		$movie_country=$json['Country'];
		$movie_genre=explode(",",$json['Genre']);
		$app = App::getSingleton();
      $conn = $app->conexionBd();
      $query1 = sprintf('INSERT INTO peliculas (ID,titulo,duracion,year,director,sinopsis,imagen,valoracion,pais) VALUES ("%s","%s",%d,%d,"%s","%s","%s",%d,"%s")',$conn->real_escape_string($id),$conn->real_escape_string($movie_title),$movie_runtime,$movie_year,$conn->real_escape_string($movie_director),$conn->real_escape_string($movie_plot),$conn->real_escape_string($movie_poster),$movie_rating,$conn->real_escape_string($movie_country));

	  $conn->query($query1);
	  foreach($movie_genre as $genre){
			Lista:: guardarGenero($id,$genre);
		}
		Lista::anadirPelicula($lista_id,$id);
	 Usuario::sumaPuntos($user);

	}
	public function followLista($id_lista,$id_usuario){
		$app = App::getSingleton();
      $conn = $app->conexionBd();
	  $query= sprintf('INSERT INTO followers_listas (id_lista,nick) VALUES (%d,"%s")',$id_lista,$conn->real_escape_string($id_usuario));
	  $conn->query($query);	
		
	}
	public function unfollowLista($id_lista,$id_usuario){
		$app = App::getSingleton();
      $conn = $app->conexionBd();
	  $query= sprintf('DELETE  FROM followers_listas WHERE id_lista = %d AND nick = "%s"',$id_lista,$conn->real_escape_string($id_usuario));
	  $conn->query($query);
		
	}
	public function guardarGenero($id,$genero){
		$app = App::getSingleton();
      $conn = $app->conexionBd();
      $query1 = sprintf('INSERT INTO tiene_genero (id_pelicula,genero) VALUES ("%s","%s")',$conn->real_escape_string($id),$conn->real_escape_string($genero));
	  $conn->query($query1);

	}
	
	public function following($id_lista,$id_usuario){
		$app = App::getSingleton();
      $conn = $app->conexionBd();
      $query1 = sprintf('SELECT * FROM followers_listas WHERE id_lista=%d AND nick="%s"',$id_lista,$conn->real_escape_string($id_usuario));
	  $rs = $conn->query($query1);
	  $resultados = $rs->num_rows;
	  $rs->free();
	  return $resultados;
	}
	
	public function imagenLista($id_lista){
		$app = App::getSingleton();
      $conn = $app->conexionBd();
	  $result = Array();
      $query = sprintf("SELECT p.imagen FROM peliculas_listas AS pl, peliculas as p WHERE pl.id_pelicula= p.ID AND id_lista= %d LIMIT 1",$id_lista);
      $rs = $conn->query($query);
	 while ($fila = $rs->fetch_assoc()) {
			$result[]=$fila;
		}
		$rs->free();
      return $result[0];	
		
		
		
	}
	public function anadirPelicula($id_lista,$id_pelicula){
			$app = App::getSingleton();
      $conn = $app->conexionBd();
	  $query2= sprintf('INSERT INTO peliculas_listas (id_lista,id_pelicula) VALUES (%d,"%s")',$id_lista,$conn->real_escape_string($id_pelicula));
	  $conn->query($query2);

	}

	
	 public function __construct(){
		 
	 }
}

?>