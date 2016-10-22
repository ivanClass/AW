<?php
	require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title>Editar noticia</title>
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
					var id = $("#submit_button").attr("data-id-noticia");					
					
					$.ajax({
						url: "<?= $app->resuelve('/html/noticias/updateNoticia.php') ?>",
						data: {idNoticia: id, nombre: name, cuerpo: data},
						type: "POST",
						error: function(){
							alert("Problemas en el envío del formulario");
						},
						success: function(data,status){
							alert("Noticia actualizada!");
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
	<?php
		if(isset($_SESSION['idUser'])){

			if (!($app->tieneRol("EDITOR", 'Acceso Denegado', 'No tienes permisos suficientes para administrar la web.'))){
				echo  "<p id=\"warning\"> Contenido solo visible para usuarios editores </p>";
		}else{
	?>
			<h1> Editar noticia </h1>
			<!--form id="contacto" method="POST"-->
				<div class="row">
					<div><label for="name">Titulo:</label></div>
					<?php
						es\ucm\fdi\aw\Noticia::dameTitulo($_GET['data']);
					?>
					</div>

				<div class="row">
					<div><label for="message">Cuerpo:</label></div>
					<textarea id="message" name="message">
						<?= es\ucm\fdi\aw\Noticia::dameContenidoNoticia($_GET['data']);?>	
					</textarea>
				</div>
				<input id="submit_button" type="submit" value="Enviar" data-id-noticia="<?= $_GET['data']?>" />
			<!--/form-->		
		</div>
	<?php
		}
	}
	else {
		echo  "<p id=\"warning\"> Contenido solo visible para usuarios registrados </p>";
	}
	?>

	</div>
	<?php
		$app->doInclude('comun/footer.php');
	?>
</body>
</html>