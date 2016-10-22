<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Pelicula {

  private $ID;
  private $titulo;
  private $duracion;
  private $year;
  private $director;
  private $sinopsis;
  private $trailer;
  private $valoracion;

  public static function imprimeFotoPelicula($id) {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT imagen FROM peliculas WHERE ID = '$id'");
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
        $bloqueInfoPeli = <<<EOF
          <img class="resize" src="${fila['imagen']}" alt="Si ve este texto es porque por problemas con IMBD la foto no se ha cargado. Recargue la página hasta que la foto aparezca correctamente"></img>
EOF;
          echo $bloqueInfoPeli;
        }

        $rs->free();
      }
  }

  public static function imprimeInfoPelicula($id) {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT titulo, director, pais, year, duracion FROM peliculas WHERE ID = '$id'");
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
        $bloqueInfoPeli = <<<EOF
          <p><span id="tit"> Título: </span>${fila['titulo']}</p>
          <p><span id="tit"> Director: </span>${fila['director']}</p>
          <p><span id="tit"> País: </span>${fila['pais']}</p>
          <p><span id="tit"> Año: </span>${fila['year']}</p>
          <p><span id="tit"> Duración: </span>${fila['duracion']} minutos</p>
EOF;
          echo $bloqueInfoPeli;
        }

        $rs->free();
      }
    

  }

  public static function imprimeDescripcionPelicula($id) {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT sinopsis FROM peliculas WHERE ID = '%s'", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
        $bloqueDescripcionPeli = <<<EOF
          <p>${fila['sinopsis']}</p>
EOF;
          echo $bloqueDescripcionPeli;
        }

        $rs->free();
      }
    
  
  }

  public static function imprimeTrailerPelicula($id) {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT trailer FROM peliculas WHERE ID = '%s'", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
        $bloqueTrailerPeli = <<<EOF
          <iframe class="youtube-player" type="text/html" src="http://www.youtube.com/embed/${fila['trailer']}" height="600px" width="100%" frameborder="0" allowfullscreen></iframe>
EOF;
          echo $bloqueTrailerPeli;
        }

        $rs->free();
      }
  }

  public static function imprimeComentariosPelicula($id) {
      $dir = DIR_FOTOS_USU;
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT usuarios.nick, correo, fecha, comentario FROM peliculas, comentarios_peliculas, usuarios WHERE ID = '%s' AND id_pelicula = ID AND comentarios_peliculas.nick = usuarios.nick", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      if ($rs) {
        $numCom = 0;
        while($fila = $rs->fetch_assoc()) {
        $numCom = $numCom + 1;
        $bloqueComentarioPeli = <<<EOF
          <div id="comentario${numCom}" class="pelicula">
              <div class="imgUsu">
                <img class="resize" src="{$app->resuelve($dir.$fila['nick'])}" alt="${fila['nick']}" height="70" width="70"></img>
              </div>
              <div class="datosUsu">
                <p id="nombreU">${fila['nick']}</p>
                <!--<p id="correoU">${fila['correo']}</p>-->
              </div>
              <div class="datosEnvioUsu">
                <p><span style="color:grey">Enviado</span> <span style="color:blue">el ${fila['fecha']}</span></p>
              </div>
              <div class="textoUsu">
                <p>${fila['comentario']}</p>  
              </div>
          </div>
EOF;
          echo $bloqueComentarioPeli;
        }

        $rs->free();
      }   
  }

  public static function imprimePeliculasRelacionadas($id) {
      $dir = DIR_FOTOS_PEL;
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT pel.ID AS id, pel.titulo AS titulo, pel.sinopsis AS sinopsis, COUNT( tg2.id_pelicula ) AS numGen, pel.imagen
                        FROM tiene_genero tg1 JOIN tiene_genero tg2 JOIN peliculas pel
                        WHERE tg1.id_pelicula =  '%s' AND tg1.id_pelicula != tg2.id_pelicula AND tg1.genero = tg2.genero AND pel.ID = tg2.id_pelicula AND pel.ID != tg1.id_pelicula
                        GROUP BY tg2.id_pelicula
                        ORDER BY numGen DESC", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      if ($rs) {
        $numCom = 0;
        while(($fila = $rs->fetch_assoc()) && $numCom < 11) {
        $numCom = $numCom + 1;
        $texto = substr($fila['sinopsis'], 0, 265);
        
        $bloquePeliRelacionada = <<<EOF
          <div id="pelicula${numCom}" class="pelicula">
              <div class="imgPel">
                <img class="resize" src="${fila['imagen']}" alt="Problemas con IMBD. Foto no cargada :(" height="150" width="100"></img>
              </div>
              <div class="datosPel">
                <p>${fila['titulo']}</p>
              </div>
              
              <div class="textoPel">
                {$texto} ...
                <a href="{$app->resuelve('/html/peliculas/pelicula.php')}?data=${fila['id']}">Seguir leyendo</a>
              </div>
          </div>
EOF;

          echo $bloquePeliRelacionada;
        }

        $rs->free();
      }
  }

  public static function obtenerMediaValoracion($id){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $media = 0;
      $query = sprintf("SELECT AVG(val.valoracion) AS media FROM peliculas pel JOIN valoracion val
                        WHERE pel.ID = '%s' AND val.id_pelicula = pel.ID
                        GROUP BY pel.ID", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
          $media = $fila['media'];
        }

        $rs->free();
        return $media;
      }
  }

  public static function obtenerValoracionUsuarioPeli($idPeli, $nick){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT val.valoracion FROM valoracion val WHERE val.id_pelicula = '%s' AND val.nick = '%s'", $conn->real_escape_string($idPeli), $conn->real_escape_string($nick));
      $rs = $conn->query($query);
      $valoracion = 0;
      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
        
          $valoracion = $fila['valoracion'];

        }

        $rs->free();
        
      }
      return $valoracion;
  }

  public static function obtenerValoracionExterna($id){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT pel.valoracion FROM peliculas pel WHERE pel.ID = '%s'", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      $valoracion = 0;
      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
        
          $valoracion = $fila['valoracion'];

        }

        $rs->free();
      
      }
      return $valoracion;
  }

  public static function gestionValoracion($idUsu, $idPeli){
      $valoracionExterna = self::obtenerValoracionExterna($idPeli);
      $valoracionPersonal = self::obtenerValoracionUsuarioPeli($idPeli, $idUsu);
      $valoracionMedia = self::obtenerMediaValoracion($idPeli);
      $text  = self::dameEstrellasValoracion($valoracionMedia, false);
      
      $bloqueValoEx = <<<EOF
        <div class="textoUsu">
            <p>La valoración media de la película por expertos es de: ${valoracionExterna}/10</p>
        </div> 
        <div class="textoUsu">
              <p>La valoración media de la película por parte de nuestros usuarios es de: ${text}</p>
        </div>
EOF;

      if(!isset($_SESSION['idUser'])){
        echo $bloqueValoEx;
      }
      else{
        echo $bloqueValoEx;

        if($valoracionPersonal === 0){
          $bloqueBotones = <<<EOF
            <div class="textoUsu">
              <div><p>Evalue la película: </p></div>
              <button id="e1" type="submit" class="icon-star-outlined botonVal"></button>
              <button id="e2" type="submit" class="icon-star-outlined botonVal"></button>
              <button id="e3" type="submit" class="icon-star-outlined botonVal"></button>
              <button id="e4" type="submit" class="icon-star-outlined botonVal"></button>
              <button id="e5" type="submit" class="icon-star-outlined botonVal"></button>
            </div>
EOF;
          echo $bloqueBotones;
        }
        else{
          $text2 = self::dameEstrellasValoracion($valoracionPersonal, true);

          $bloqueInfoVal = <<<EOF
            <div class="textoUsu">
              <p>Su valoración fue de : ${text2}</p>
            </div>
EOF;

          echo $bloqueInfoVal;
        }
      }
  }


  public static function imprimeUsuariosConPeliEnLista($id) {
      $dir = DIR_FOTOS_USU;
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT lis.autor, val.valoracion
                        FROM listas lis JOIN peliculas_listas pelLis LEFT JOIN valoracion val
                        ON val.id_pelicula = pelLis.id_pelicula  AND lis.autor = val.nick 
                        WHERE lis.id_lista = pelLis.id_lista AND pelLis.id_pelicula = '%s'", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      if ($rs) {
        $numCom = 0;
        while($fila = $rs->fetch_assoc()) {
        $numCom = $numCom + 1;
        $text = self::dameEstrellasValoracion($fila['valoracion'], false);

        $bloqueUsuPeliLista = <<<EOF
          <div id="usuario${numCom}" class="usuario">
              <div class="imgUsu">
                <img class="resize" src="{$app->resuelve($dir.$fila['autor'])}" alt="${fila['autor']}" height="70" width="70"></img>
              </div>
              <div class="datosUsu">
                <p>${fila['autor']}</p>
              </div>
              <div class="textoUsu">
                <p id="nombre">La valoración de ${fila['autor']} es de: </p> ${text}
              </div>
            </div>
EOF;
          echo $bloqueUsuPeliLista;
        }

        $rs->free();
      }
  }

  public static function dameEstrellasValoracion($valor, $ceroEstrellas){

    $bloque1 = <<<EOF
      <p class="icon-star"></p><p class="icon-star-outlined"></p><p class="icon-star-outlined"></p><p class="icon-star-outlined"></p><p class="icon-star-outlined"></p>
EOF;

    $bloque2 = <<<EOF
      <p class="icon-star"></p><p class="icon-star"></p><p class="icon-star-outlined"></p><p class="icon-star-outlined"></p><p class="icon-star-outlined"></p>
EOF;

    $bloque3 = <<<EOF
      <p class="icon-star"></p><p class="icon-star"></p><p class="icon-star"></p><p class="icon-star-outlined"></p><p class="icon-star-outlined"></p>
EOF;

    $bloque4 = <<<EOF
      <p class="icon-star"></p><p class="icon-star"></p><p class="icon-star"></p><p class="icon-star"></p><p class="icon-star-outlined"></p>
EOF;

    $bloque5 = <<<EOF
      <p class="icon-star"></p><p class="icon-star"></p><p class="icon-star"></p><p class="icon-star"></p><p class="icon-star"></p>
EOF;

    $bloqueNull = <<<EOF
      <p> no hay valoración :(</p>
EOF;

    $bloque0 = <<<EOF
      <p class="icon-star-outlined"></p><p class="icon-star-outlined"></p><p class="icon-star-outlined"></p><p class="icon-star-outlined"></p><p class="icon-star-outlined"></p>
EOF;

    if(($valor >= 1.0) && ($valor <= 1.999)){
      return $bloque1;
    }
    else if(($valor >= 2.0) && ($valor <= 2.999)){
      return $bloque2;
    }
    else if(($valor >= 3.0) && ($valor <= 3.999)){
      return $bloque3;
    }
    else if(($valor >= 4.0) && ($valor <= 4.999)){
      return $bloque4;
    }
    else if($valor >= 5.0){
      return $bloque5;
    }
    else if(($valor <= 0) || $valor == null){
      if($ceroEstrellas){
        return $bloque0;
      }
      else{
         return  $bloqueNull;
      }
    }
  }

  public static function valorarPelicula($puntos, $idPeli){
    $valor = -1;

    switch ($puntos) {
      case 'e1':
          $valor = 1;
          break;
      case 'e2':
          $valor = 2;
          break;
      case 'e3':
          $valor = 3;
          break;
      case 'e4':
          $valor = 4;
          break;
      case 'e5':
          $valor = 5;
          break;
    }
    if($valor != -1){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("INSERT INTO valoracion VALUES ('%s', '{$_SESSION['idUser']}', ${valor})", $conn->real_escape_string($idPeli));
      $conn->query($query);

      $result[] = 'valoracion insertada';
	    Usuario::sumaPuntos($_SESSION['idUser']);
      
    }
    else{
      $result[] = 'error';
    }

    return json_encode($result);
  }

  public static function addComentarioPelicula($idPeli, $comentario){
      $app = App::getSingleton();
      $conn = $app->conexionBd();

      //$sql = "INSERT INTO comentarios_peliculas (id_pelicula, nick, comentario) VALUES ('$idPeli', '${_SESSION['idUser']}', '$comentario')";
       $query = sprintf("INSERT INTO comentarios_peliculas (id_pelicula, nick, comentario) VALUES ('%s', '${_SESSION['idUser']}', '%s')", $conn->real_escape_string($idPeli), $conn->real_escape_string($comentario));
      $conn->query($query);
	    Usuario::sumaPuntos($_SESSION['idUser']);
      return $conn->insert_id;
  }

  public static function imprimeListasUsu($idUsu){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT l.titulo, l.id_lista FROM listas l WHERE l.autor = '%s'", $conn->real_escape_string($idUsu));
      $rs = $conn->query($query);
      $result = null;
      if ($rs) {
        $i = 0;
        while($fila = $rs->fetch_assoc()) {
          $aux['titulo'] = $fila['titulo'];
          $aux['id'] = $fila['id_lista'];
          $result[$i] = $aux;
          $i++;

        }

        $rs->free();
        
      }

       return $result;
  }
}

?>