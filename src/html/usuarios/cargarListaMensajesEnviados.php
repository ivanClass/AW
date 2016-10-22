<?php
	require_once '../../includes/config.php';
	echo stripslashes(es\ucm\fdi\aw\Usuario::dameMensajesEnviadosUsuarioNick($_SESSION['idUser']));
?>