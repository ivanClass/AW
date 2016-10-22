<?php
	require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html>
	<head>
	  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  	<title>Acerca de</title>
		<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/noticia.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">

		<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
	</head>
	<body>
		<?php
			$app->doInclude('comun/header.php');
		?>
		<div id="contenedor">

			<div id="formComentario">
				<form>

					<label for="nombre">Nombre: <span class="required">*</span></label>  
					<input type="text" id="name" name="name" value="" placeholder="Nombre" required="required" /> 

					<label for="email">Email: <span class="required">*</span></label>  
					<input type="email" id="email" name="email" value="" placeholder="example@email.com" required="required" />

					<label for="message">Comentario: <span class="required">*</span></label>  
					<textarea id="message" name="message" placeholder="Escribe aqui tu comentario" required="required"></textarea>  

					<input type="submit" value="Enviar!" id="submit" />
				</form>
			</div>
		</div>
		<?php
			$app->doInclude('comun/footer.php');
		?>
	</body>
</html>