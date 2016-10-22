<?php
	require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title>Nueva noticia</title>
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
					var foto = $("#uploadedfile").val();

					$.ajax({
						url: "<?= $app->resuelve('/html/noticias/addNoticia.php') ?>",
						data: {nombre: name, cuerpo: data},
						type: "POST",
						error: function(){
							alert("Problemas en el envío del formulario");
						},
						success: function(data,status){
							alert("Formulario enviado");
						    var file_data = $('#uploadedfile').prop('files')[0];
						    var form_data = new FormData();
						    var name =  data + "." +  file_data.name.split('.').pop(); 
						    form_data.append('file', file_data , name);
						    $.ajax({
				                url: 'subirFotoNoticia.php', // point to server-side PHP script 
				                dataType: 'text',  // what to expect back from the PHP script, if anything
				                cache: false,
				                contentType: false,
				                processData: false,
				                data: form_data,                        
				                type: 'post',
				                success: function(php_script_response){
				                    
				                }
						     });
						}
					});
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
		if(isset($_SESSION['nombre'])){

			if (!($app->tieneRol("EDITOR", 'Acceso Denegado', 'No tienes permisos suficientes para administrar la web.'))){
				echo  "<p id=\"warning\"> Contenido solo visible para usuarios editores </p>";
		}else{
	?>
			<h1> Nueva noticia </h1>

				<div class="row">
					<div><label for="name">Titulo:</label></div>
					<input id="name" class="input" name="name" type="text" value="" size="30" />
				</div>

				<div class="row">
					<div><label for="foto">Imagen noticia: </label></div>
				<!--form id="fotoForm" name="fotoForm" enctype="multipart/form-data" action="subirFotoNoticia.php" method="post"-->
					<label for="foto"></label>
					<input id="uploadedfile" name="uploadedfile" type="file" accept="image/*" />
				<!--/form-->
				</div>

				<div class="row">
					<div><label for="message">Cuerpo:</label></div>
					<textarea id="message" name="message"></textarea>
				</div>
				<input id="submit_button" type="submit" value="Enviar" />
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