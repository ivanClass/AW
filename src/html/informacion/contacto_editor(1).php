<?php
	require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title>Contacto editor</title>
	<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/contacto_editor.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">

	<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
	<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>
	<script type="text/javascript" src="<?= $app->resuelve('/js/ckeditor/ckeditor.js') ?>"></script>
	<script type="text/javascript" src="<?= $app->resuelve('/js/ckeditor/adapters/jquery.js') ?>"></script>
	
		<script type="text/javascript">
			$(document).ready(function(){

				CKEDITOR.replace ("message");

				$("#submit_button").click(function(){
					var data = CKEDITOR.instances.message.getData();
					var name = $("#name").val();
					var email = $("#email").val();
					var asunto = $("#asunto").val();
					/*alert(name);
					alert(email);
					alert(asunto);
					alert(data);*/
					
					$.ajax({
						url: "<?= $app->resuelve('/includes/MensajeContactoEditorAux.php') ?>",
						data: {nombre: name  , email: email, asunto: asunto, cuerpo: data},
						type: "POST",
						error: function(){
							alert("Problemas en el envío del formulario")
						},
						success: function(data,status){
							//alert(data);
							//location.reload();

						}
					})
				});
			});


		</script>		
</head>
<body>
	<?php
		$app->doInclude('comun/header.php');
	?>
	<div id="contenedor">

		<div id="colL">
			<div id="masLeido" class="postExt">
				<h2>
					<span class="icon-star"></span>
					Lo más leído
				</h2>
				<div class="post">
					<a href="./noticia.php">
						<img src="<?= $app->resuelve('/img/aprender-en-internet.jpg')?>" class="thumbnail">
						2 sitios mas interesantes para ver películas
					</a>

				</div>
				<div class="post">
					<a href="./noticia.php">
						<img src="<?= $app->resuelve('/img/aprender-en-internet.jpg')?>" class="thumbnail">
						12 sitios mas interesantes para ver películas
					</a>

				</div>
			</div>
			<div id="destacados" class="postExt">
				<h2>
					<span class="icon-bookmarks"></span>
					Destacados
				</h2>
				<div class="post">
					<a href="./noticia.php">
						<img src="<?= $app->resuelve('/img/aprender-en-internet.jpg')?>" class="thumbnail">
						12 sitios mas interesantes para ver películas
					</a>

				</div>
				<div class="post">
					<a href="./noticia.php">
						<img src="<?= $app->resuelve('/img/aprender-en-internet.jpg')?>" class="thumbnail">
						12 sitios mas interesantes para ver películas
					</a>

				</div>
			</div>
		</div>
		
		<div id="colR">
			<h1> Contacto con el editor </h1>
			<form id="contacto" method="POST">
				<div class="row">
					<div><label for="name">Nombre:</label></div>
					<input id="name" class="input" name="name" type="text" value="" size="30" />
					</div>
				<div class="row">
					<div><label for="email">Email de contacto:</label></div>
					<input id="email" class="input" name="email" type="text" value="" size="30" />
				</div>
				<div class="row">
					<div><label for="asunto">Asunto:</label></div>
					<input id="asunto" class="input" name="asunto" type="text" value="" size="30" />
				</div>
				<div class="row">
					<div><label for="message">Mensaje:</label></div>
					<textarea id="message" name="message"></textarea>
				</div>
				<input id="submit_button" type="submit" value="Enviar" />
			</form>		
		</div>

	</div>
	<?php
		$app->doInclude('comun/footer.php');
	?>
</body>
</html>