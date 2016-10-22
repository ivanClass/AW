<?php
	require_once '../../includes/config.php';
	echo stripslashes(es\ucm\fdi\aw\Usuario::dameMensajesRecibidosUsuarioNick($_SESSION['idUser']));
?>