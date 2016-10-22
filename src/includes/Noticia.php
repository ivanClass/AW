<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Noticia {

	private $id_noticia;
	private $titulo;
	private $contenido;
	private $fecha;
	private $autor;

  public static function imprimeNoticias() {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM noticias");
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
          $id = $fila['id_noticia'];
          $dir = DIR_FOTOS_NOT;
  			$bloqueNoticia = <<<EOF
  			 	<div class="noticia" id="${fila['id_noticia']}" >
  				<img src="{$app->resuelve($dir.$id)}" class="fotoNoticia">
  				<h3> ${fila['titulo']} </h3>
  				<p> Redactado por: ${fila['autor']}</p>
  				<p> Fecha: ${fila['fecha']}</p>
  				<div id="botones">
  				<button id="ed${fila['id_noticia']}" name="ed${fila['id_noticia']}" class="editarNoticia">
            <a href="{$app->resuelve('/html/editor/editNoticia.php')}?data=${fila['id_noticia']}">Editar</a>
          </button>
  				<button id="el${fila['id_noticia']}" name="el${fila['id_noticia']}" class="eliminarNoticia">Eliminar</button>
  				</div>
  			</div>
EOF;
          echo $bloqueNoticia;
        }

        $rs->free();
      }
  }

  public static function incrementaVisitas($id){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("UPDATE noticias SET leido = leido + 1 WHERE id_noticia='%s'", $conn->real_escape_string($id));
      $conn->query($query);
  }

  public static function insertaNoticia($titulo, $cuerpo){
      $app = App::getSingleton();
      $conn = $app->conexionBd();

      $query = sprintf("INSERT INTO noticias (titulo, contenido, autor) VALUES ('%s', '%s', '${_SESSION['idUser']}')", $conn->real_escape_string($titulo), $conn->real_escape_string($cuerpo));
      $conn->query($query);
      echo $conn->insert_id;
  }

  public static function dameTitulo($id){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT titulo FROM noticias WHERE id_noticia='%s'", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
      $titulo = <<<EOF
        <input id="name" class="input" name="name" type="text" value="${fila['titulo']}" size="30" />             
EOF;
          echo $titulo;
        }
        $rs->free();
      }
  }

  public static function borraNoticia($id){
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $sql = sprintf("DELETE FROM noticias WHERE id_noticia='%s'", $conn->real_escape_string($id));
    $conn->query($sql);

    //borramos la imagen del fichero del servidor
    $file_pattern = $app->resuelvePath(DIR_FOTOS_NOT.$id.'.*');
    array_map( "unlink", glob( $file_pattern ) );
  }

  public static function updateNoticia($id, $titulo, $cuerpo){
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $sql = sprintf("UPDATE noticias SET titulo='%s', contenido='%s' WHERE id_noticia='%s'", $conn->real_escape_string($titulo), $conn->real_escape_string($cuerpo), $conn->real_escape_string($id));
    $conn->query($sql);
  }

  public static function dameTextoNoticia($id){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $dir = DIR_FOTOS_NOT;
      $query = sprintf("SELECT * FROM noticias WHERE id_noticia='$id'", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      if ($rs) {
      while($fila = $rs->fetch_assoc()) {
      $bloqueArticulo = <<<EOF
          <article>
          <img src="{$app->resuelve($dir.$id)}" class="imgNoticia">
            <header>
              <h2><a href="./noticia.php?data=${fila['id_noticia']}">${fila['titulo']}</a></h2>
            </header>
            <p class="parrafo"> Escrito por: <span id="autorNot">${fila['autor']}</span> Fecha: ${fila['fecha']} </p>

          </article>
EOF;

          echo $bloqueArticulo;
          echo $fila['contenido'];
        }
        $rs->free();
      }
  }

  public static function dameContenidoNoticia($id){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM noticias WHERE id_noticia='$id'", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
          echo $fila['contenido'];
        }
        $rs->free();
      }
  }

  public static function insertaComentario($idNoticia, $comentario){
      $app = App::getSingleton();
      $conn = $app->conexionBd();

      $sql = sprintf("INSERT INTO comentarios_noticias (id_noticia, autor, comentario) VALUES ('%s', '${_SESSION['idUser']}', '%s')",$conn->real_escape_string($idNoticia), $conn->real_escape_string($comentario));
      $conn->query($sql);
      Usuario::sumaPuntos($_SESSION['idUser']);
      echo $conn->insert_id;
  }

  public static function dameComentariosNoticia($id){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM comentarios_noticias WHERE id_noticia='$id' ORDER BY fecha", $conn->real_escape_string($id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
          $id = $fila['id_noticia'];
          $dir = DIR_FOTOS_USU;
$bloqueComentario = <<<EOF
          <div id="c${fila['id_noticia']}" class="comentario">
            <div class="imgComent">
              <img class="resize" src="{$app->resuelve($dir.$fila['autor'])}" height="70" width="70"></img>
            </div>
            <div class="datosComent">
              <p>${fila['autor']}</p>
              <p><span style="color:grey">Enviado el </span> <span style="color:blue">${fila['fecha']}</span></p>
            </div>
            <div class="textoComent">
              <p>
                  ${fila['comentario']}
              </p>  
            </div>
          </div>
EOF;
          echo $bloqueComentario;
        }

        $rs->free();
      }
  }

  public static function dameMasLeidos(){
    $app = App::getSingleton();
    $conn = App::getSingleton()->conexionBd();
    $dir = DIR_FOTOS_NOT;
    $query_services = sprintf("SELECT * FROM noticias ORDER BY leido DESC LIMIT 2");
    $query_services = $conn->query($query_services);
    while ($row_services = $query_services->fetch_assoc()) {
      $id = $row_services['id_noticia'];
      $bloqueArticulo = <<<EOF
        <div class="post">
          <a href="./noticia.php?data=${row_services['id_noticia']}">
          <img src="{$app->resuelve($dir.$id)}" class="thumbnail">
            ${row_services['titulo']}
          </a>

        </div>

EOF;
      echo $bloqueArticulo;
    }
  }
  
  public static function dameMasComentados(){
    $app = App::getSingleton();
    $conn = App::getSingleton()->conexionBd();
    $dir = DIR_FOTOS_NOT;
    $query_services = sprintf("SELECT n.id_noticia,titulo, COUNT(c.id_noticia) c FROM noticias n LEFT JOIN comentarios_noticias c ON n.id_noticia=c.id_noticia GROUP BY n.id_noticia ORDER BY c DESC LIMIT 2");
    $query_services = $conn->query($query_services);
    while ($row_services = $query_services->fetch_assoc()) {
      $id = $row_services['id_noticia'];
      $bloqueArticulo = <<<EOF
        <div class="post">
          <a href="./noticia.php?data=${row_services['id_noticia']}">
          <img src="{$app->resuelve($dir.$id)}" class="thumbnail">
            ${row_services['titulo']}
          </a>

        </div>

EOF;
      echo $bloqueArticulo;
    }
  } 

   public static function ultimaNoticia(){
	   
	   $app = App::getSingleton();
      $conn = $app->conexionBd();
	  $result = Array();
      $query = sprintf("SELECT * from noticias ORDER BY id_noticia DESC LIMIT 1");
      $rs = $conn->query($query);
	 while ($fila = $rs->fetch_assoc()) {
			$result[]=$fila;
		}
		$rs->free();
      return $result[0];
	   
   }
  public static function paginameNoticias($page){
    $app = App::getSingleton();
    $conn = App::getSingleton()->conexionBd();
    $query = sprintf("SELECT COUNT(*) AS c FROM noticias");
    $query_num_services = $conn->query($query);
    $dir = DIR_FOTOS_NOT;
    $num_total_registros = 0;
      if ($query_num_services) {
        $fila = $query_num_services->fetch_assoc();
        $num_total_registros = $fila['c'];
      }

    //Si hay registros
     if ($num_total_registros > 0) {
        //numero de registros por página
        $rowsPerPage = 4;

        //por defecto mostramos la página 1
        $pageNum = 1;

        // si $_GET['page'] esta definido, usamos este número de página
        if(isset($page)) {
            //sleep(1);
            $pageNum = $page;
        }

        //contando el desplazamiento
        $offset = ($pageNum - 1) * $rowsPerPage;
        $total_paginas = ceil($num_total_registros / $rowsPerPage);

        $query_services = sprintf("SELECT * FROM noticias ORDER BY fecha DESC LIMIT $offset, $rowsPerPage");
        $query_services = $conn->query($query_services);
        while ($row_services = $query_services->fetch_assoc()) {
          $contenido = $row_services['contenido'];
          $id = $row_services['id_noticia'];
          $resumen = substr($contenido, 0, 700);
      $bloqueArticulo = <<<EOF
          <article>
            <header>
              <h2><a href="./noticia.php?data=${row_services['id_noticia']}">${row_services['titulo']}</a></h2>
            </header>
            <p class="parrafo"> Escrito por: ${row_services['autor']} ▪ Fecha: ${row_services['fecha']} </p>
            <div>
              <img src="{$app->resuelve($dir.$id)}" class ="imgNoti">
              <p class="resumen">
                {$resumen}...
              </p>        
            </div>
            <a href="./noticia.php?data=${row_services['id_noticia']}" class="enlNot">Seguir leyendo</a>


          </article>
EOF;

      echo $bloqueArticulo;

        }

      if ($total_paginas > 1) {
          echo '<div class="pagination pagination-centered">';
          echo '<ul>';
          if ($pageNum != 1)
              echo '<li><a class="pag" data="'.($pageNum-1).'">Anterior</a></li>';
              for ($i=1;$i<=$total_paginas;$i++) {
                  if ($pageNum == $i)
                      //si muestro el índice de la página actual, no coloco enlace
                      echo '<li><a>'.$i.'</a></li>';
                  else
                      //si el índice no corresponde con la página mostrada actualmente,
                      //coloco el enlace para ir a esa página
                      echo '<li><a class="pag" data="'.$i.'">'.$i.'</a></li>';
               }
               if ($pageNum != $total_paginas)
                   echo '<li><a class="pag" data="'.($pageNum+1).'">Siguiente</a></li>';
               echo '</ul>';
               echo '</div>';
          }
      }
  }
}
?>
