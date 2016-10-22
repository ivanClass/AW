<?php

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';
    function procesaFormulario($params) {
      $result = array();
      $ok = TRUE;

      $user = isset($params['usuario']) ? $params['usuario'] : null ;
      if ( !$user || !preg_match("/^[a-zA-Z0-9]+$/", $user)) {
        //$result[] = 'El nombre de usuario no es válido';
        $result[] = 'El nombre de usuario no es válido';
        $ok = FALSE;
      }

      $pass = isset($params['contrasena']) ? $params['contrasena'] : null ;
      if ( ! $pass ||  strlen($pass) < 4  || !preg_match("/^[a-zA-Z0-9]+$/", $pass) ) {
        $result[] = 'La contraseña no es válida';
        $ok = FALSE;
      }

    if ( $ok ) {
      
      $user = es\ucm\fdi\aw\Usuario::login($user, $pass);
      if ( $user ) {
        // SEGURIDAD: Forzamos que se genere una nueva cookie de sesión por si la han capturado antes de hacer login
        session_regenerate_id(true);
        es\ucm\fdi\aw\Aplicacion::getSingleton()->login($user);

      }else {
        $result[] = 'El usuario o la contraseña es incorrecta';
      }
    
    }
    	header('Content-Type: application/json');

      	return json_encode($result);
    }
?>