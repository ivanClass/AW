<?php
	require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html>
	<head>
	  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  	<title>Perfil de usuario</title>
	  	<link href="<?= $app->resuelve('/css/perfil_usuario.css') ?>" rel="stylesheet" type="text/css">
	  	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
		<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
		<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">

	</head>
	<body>
	<?php
		$app->doInclude('comun/header.php');
		if (!isset($_SESSION['idUser'])){
			header("Location: ../../index.php");
		}
	?>
	<div id="contenedor">
		<div id="colIzq" class="col">
			<div style="text-align:center">
			<?php
				$imagen = $_SESSION['idUser'];
				$rutaImagen = $app->resuelve(DIR_FOTOS_USU.$imagen);
				$etiquetaImagen = <<<EOF
				<img id="foto" src="$rutaImagen">;
EOF;

				echo $etiquetaImagen;
				
			?>
			</div>
			<?php
				require 'cargarDatosUsuario.php';
			?>
		</div>
		<div id="colCen" class="col">
			<h1 style="text-align:center">Descripción</h1>
			<?php
				require 'cargarDescripcionUsuario.php';
			?>
		</div>
		<div id="colDer" class="col">
			<ul class="botones">
				<li><button type="button" onclick="mostrarPeliculas()">Mis películas </button></li>
				<li><button type="button" onclick="editarPerfil()">Editar perfil </button></li>
				<li><button type="button" onclick="mostrarMensajes()">Mensajes </button></li>
				<li><button type="button" onclick="mostrarSeguidores()">Seguidores </button></li>
				<li><button type="button" onclick="mostrarComentarios()">Comentarios </button></li>
				<li><button type="button" onclick="mostrarRespuestas()">Mis respuestas </button></li>
			</ul>
			<div id="peliculas" class="contenidoDerecho">
				<fieldset id="fieldset">
				<?php
					require 'cargarPeliculasUsuario.php';
				?>
				</fieldset>
			</div>
			<div id="formPerfil" class="contenidoDerecho">
				<fieldset id="fieldset">
					<form action="editarUsuario.php" method="post">
						<legend>Introduce los nuevos datos:</legend>
						<div style="text-align:center">
							<ul id="listaCamposForm">
							<li class="item">Nombre: <br><input type="text" name="nombre" class="textFieldEditar"><br></li>
							<li class="item">Correo: <br><input type="text" name="correo" class="textFieldEditar"><br></li>
							<li class="item">Descripción: <br><textarea type="text" name="descripcion" id="textAreaDescripcion"></textarea><br></li>
							<li class="item"><input type="submit" value="Guardar cambios"></li>
							</ul>
						</div>
					</form>
				</fieldset>
			</div>
			<div id="seguidores" class="contenidoDerecho">
				<fieldset id="fieldset">
				<?php
					require 'cargarSeguidoresUsuario.php';
				?>
				</fieldset>
			</div>
			<div id="mensajes" class="contenidoDerecho">
				<fieldset id="fieldset">
				<?php
					require 'cargarMensajesUsuario.php';
				?>
				</fieldset>
			</div>
			<div id="comentarios" class="contenidoDerecho">
				<fieldset id="fieldset">
				<?php
					require 'cargarComentariosUsuario.php';
				?>
				</fieldset>
			</div>
			<div id="respuestas" class="contenidoDerecho">
				<fieldset id="fieldset">
				<?php
					require 'cargarRespuestasUsuario.php';
				?>
				</fieldset>
			</div>
		</div>
	</div>
	<?php
		$app->doInclude('comun/footer.php');
	?>
	</body>
	<script type="text/javascript" src="../../js/scriptsPerfilUsuario.js"></script>
</html>