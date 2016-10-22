<?php
	require_once '../../includes/config.php';
	require_once 'registrarse.php';
	require_once 'subirFoto.php';

	$rutaRegistrarsePhp = 'registrarse.php';
	$rutaSubirFotoPhp = 'subirFoto.php';
?>

<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title>Registro</title>
	<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/noticia.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">

	<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">

	<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>
	<script type="text/javascript" src="<?= $app->resuelve('/js/validacionFormReg.js') ?>"></script>

	<script type="text/javascript">
			

			$(document).ready(function(){
				$("#submit").click(function(){
					var nick = $("#nick").val();
					var nombre = $("#name").val();
					var email = $("#email").val();
					var pass1 = $("#pass1").val();
					var pass2 = $("#pass2").val();
					var foto = $("#uploadedfile").val();

					var ok = validacionRegistrarse(); //funcion contenida en validacionFormReg.js (carpeta js)
					if(ok){
						$.ajax({
							url: '<?= $rutaRegistrarsePhp ?>',
							data: {nick: nick, apodo: true},
							type: "POST",
							error: function(){
								alert("Problemas en el envío del formulario")
							},
							success: function(data, status){
								if(data != "noexiste"){
									alert(data);
									apodoOcupado(); //funcion contenida en validacionFormReg.js (carpeta js)
								}
								else{
									$.ajax({
										url: '<?= $rutaRegistrarsePhp ?>',
										data: {nick: nick, nombre: nombre, email: email, contra1: pass1, contra2: pass2, apodo: false},
										type: "POST",
										error: function(){
											alert("Problemas en el envío del formulario")
										},
										success: function(data, status){
											if(data != "FALSE"){
											
												//$("#fotoForm").submit();
												var file_data = $('#uploadedfile').prop('files')[0];
												var form_data = new FormData(); 
												if(typeof file_data !== 'undefined'){    
												    var name = 'foto' + "." +  file_data.name.split('.').pop();
												}
												else{
													var name = 'foto' + ".png";
												}               
												    

												form_data.append('file', file_data , name);
												$.ajax({
												    url: '<?= $rutaSubirFotoPhp ?>', 
												    dataType: 'text',
												    cache: false,
												    contentType: false,
												    processData: false,
												    data: form_data,                        
												    type: 'post',
												    success: function(){
												        location.href ='/';
												    }
												});	
											}
										}
									});
								}
							}	
						})
					}
				});
			})	
		</script>
</head>
<body>
	<?php
		$app->doInclude('comun/header.php');
	?>
	<div id="contenedor">

		<div id="formComentario">
			<label for="nick">Nick: <span class="required">*</span></label>  
			<input type="text" id="nick" name="nick" value="" placeholder="Nick" required="required" />

			<label for="nombre">Nombre: <span class="required">*</span></label>  
			<input type="text" id="name" name="name" value="" placeholder="Nombre" required="required" /> 

			<label for="email">Correo electrónico: <span class="required">*</span></label>  
			<input type="email" id="email" name="email" value="" placeholder="example@email.com" required="required" />
			<label for="password">Contraseña: <span class="required">*</span></label>
			<input type="password" class="inputRedondeados"
				id="pass1" placeholder="Contraseña">
			<label for="password2">Repita la contraseña: <span class="required">*</span></label>
			<input type="password" class="inputRedondeados"
				id="pass2" placeholder="Contraseña">

				
			<label for="foto">Elija fotografía de perfil: </label>
			<input id="uploadedfile" name="uploadedfile" type="file" accept="image/*" />

			<button  id="submit">Registrarse!</button>
		</div>
	</div>
	<?php
		$app->doInclude('comun/footer.php');
	?>
</body>
</html>