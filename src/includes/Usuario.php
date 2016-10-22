<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Usuario {

  public static function login($username, $password) {
    $user = self::buscaUsuario($username);

    if ($user && $user->compruebaPassword($password)) {
      /*ANTIGUO
      $app = App::getSingleton();
      
      $conn = $app->conexionBd();
      $query = sprintf("SELECT RU.rol FROM rol_usuario RU WHERE RU.usuario='%s'", $conn->real_escape_string($user->id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) { 
          $user->addRol($fila['rol']);
        }
        $rs->free();
      }
      */
      return $user;
    }
    
  
    return false;
  }

  public static function buscaUsuario($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM usuarios WHERE nick='%s'", $conn->real_escape_string($username));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Usuario($fila['nick'], $fila['correo'], $fila['password'], $fila['nombre'], $fila['puntos'], $fila['rol']);
      $rs->free();

      return $user;
    }
    return false;
  }

  public static function dameMensajesRecibidosUsuarioNick($nick){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mensajes WHERE receptor='$nick' AND delRec='0' ORDER BY fecha DESC");
      $rs = $conn->query($query);

      $response = array();

      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
            $mensaje = <<<EOF
            <tr id="${fila['id_mensaje']}"><td class="celda_titulo"> De: ${fila['emisor']} </td><td class="celda_anio">Asunto: ${fila['asunto']} </td><td class="celda_rol"> Fecha: ${fila['fecha']} </td><td class="celda_actions"><img src="{$app->resuelve('img/erase.png')}" class="delete_user" /><a href="#myModalVer" role="button" class="btn btn-custom" data-toggle="modal"><img src="{$app->resuelve('/img/edit.png')}" class="edit_user"/></td></tr></a>
EOF;
          $response[] = $mensaje;
        }
        $rs->free();
      }

      return json_encode($response); 
  }

  public static function dameMensajesEnviadosUsuarioNick($nick){
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT * FROM mensajes WHERE emisor='$nick' AND delEmi='0' ORDER BY fecha DESC");
      $rs = $conn->query($query);

      $response = array();

      if ($rs) {
        while($fila = $rs->fetch_assoc()) {
            $mensaje = <<<EOF
            <tr id="${fila['id_mensaje']}"><td class="celda_titulo"> Para: ${fila['receptor']}</td><td class="celda_anio">Asunto: ${fila['asunto']}</td><td class="celda_rol">Fecha: ${fila['fecha']}</td><td class="celda_actions"><img src="{$app->resuelve('img/erase.png')}" class="delete_user" /><a href="#myModalVer" role="button" class="btn btn-custom" data-toggle="modal"><img src="{$app->resuelve('/img/edit.png')}" class="edit_user"/></td></tr></a>
EOF;
          $response[] = $mensaje;
        }
        $rs->free();
      }

      return json_encode($response); 
  }

  public static function borrarMensaje($id){
    $app = App::getSingleton();
    $nick = $_SESSION['idUser'];
    $conn = $app->conexionBd();

    $query = sprintf("SELECT * FROM mensajes WHERE id_mensaje='%s'", $conn->real_escape_string($id));
    $rs = $conn->query($query);

    if ($rs) {
      while($fila = $rs->fetch_assoc()) {
          $emisor = $fila['emisor'];
          $receptor = $fila['receptor'];
      }
      $rs->free();
    }

    if($emisor == $nick){
      $tipoAux = "emisor";
      $tipo = "delEmi";
    }
    else if($receptor == $nick){
      $tipoAux = "receptor";
      $tipo = "delRec";
    }
    else{
      $tipoAux = "";
      $tipo = "";
    }

    $sql = sprintf("UPDATE mensajes SET ".$tipo."='1' WHERE id_mensaje='%s' AND $tipoAux='$nick'", $conn->real_escape_string($id));

    $conn->query($sql);
    
    $sql = sprintf("DELETE FROM mensajes WHERE id_mensaje='%s' AND (delEmi='1' AND delRec='1')", $conn->real_escape_string($id));
    $conn->query($sql);

  }

  public static function dameInfoMensaje($id){
    $app = App::getSingleton();
    $nick = $_SESSION['idUser'];
    $conn = $app->conexionBd();

    $query = sprintf("SELECT * FROM mensajes WHERE id_mensaje='$id' AND (emisor='$nick' OR receptor='$nick')");
    $rs = $conn->query($query);
    $response = array();

    if ($rs) {
      while($fila = $rs->fetch_assoc()) {
          $response[] = $fila['emisor'];
          $response[] = $fila['receptor'];
          $response[] = $fila['asunto'];
          $response[] = $fila['contenido'];
      }
      $rs->free();
    }

    return json_encode($response);
  }

  public static function insertaMensaje($emisor, $receptor, $asunto, $mensaje){
      $app = App::getSingleton();
      $conn = $app->conexionBd();

      $sql = sprintf("INSERT INTO mensajes (emisor, receptor, asunto, contenido) VALUES ('%s', '%s', '%s', '%s')", $conn->real_escape_string($emisor), $conn->real_escape_string($receptor), $conn->real_escape_string($asunto), $conn->real_escape_string($mensaje));
      $conn->query($sql);
      echo $conn->insert_id;
  }
  public static function sumaPuntos($id_user){
      $app = App::getSingleton();
      $conn = $app->conexionBd();

      $sql = sprintf('UPDATE usuarios SET puntos = puntos + 5 WHERE nick = "%s" ', $conn->real_escape_string($id_user));
      $conn->query($sql);
  }
  private $id;

  private $username;

  private $correo;

  private $puntos;

  private $password;

  private $roles;

  private function __construct($id, $correo, $password, $nombre, $puntos, $rol) {
    $this->id = $id;
    $this->username = $nombre;
    $this->correo = $correo;
    $this->puntos = $puntos;
    $this->password = $password;
    $this->roles = array();
    $this->addRol($rol);

  }

  public function addRol($role) {
    $this->roles[] = $role;
  }

  public function roles() {
    return $this->roles;
  }

  public function username() {
    return $this->username;
  }

  public function id() {
    return $this->id;
  }

  public function compruebaPassword($password) {
  	//$pswHashed = password_hash($password, PASSWORD_BCRYPT);

  	$ok = password_verify($password, $this->password);
  	//var_dump($pswHashed);
  	return $ok;
  }
}
?>