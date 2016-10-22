<?php
	require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title>Editor noticias</title>
	<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/editorNoticias.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/pelicula_estilo.css') ?>" rel="stylesheet" type="text/css">

	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>
	<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">

	<script type="text/javascript">
	$(document).ready(function(){
		function btnElimNoticia(){
				var noticia = $(this).parent().parent().attr("id");
				$.ajax({
					url: "<?= $app->resuelve('/html/noticias/deleteNoticia.php') ?>",
					type: "POST",
					data: {id: noticia},
					error: function(){
						alert("Problemas en el envío del formulario")
					},
					success: function(data,status){
						$("#"+noticia).remove();
					}
				});
		};
		$("body").on("click", ".eliminarNoticia", null, btnElimNoticia);

		jQuery.expr[':'].Contains = function(a,i,m){
      		return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
  		};

		var input = $("input");
	    $(input)
	      .change( function () {
	        var filter = $(this).val();
	        if(filter) {
	 	  
			  $matches = $("#noticiasEditor").find('h3:Contains(' + filter + ')').parent();
			  $('.noticia', "#noticiasEditor").not($matches).slideUp();
			  $matches.slideDown();
			}
	        else{
	        	$("#noticiasEditor").find("div").slideDown();
	        }
	        return false;
	      })
	    .keyup( function () {
	        // fire the above change event after every letter
	        $(this).change();
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
		<div id="colL" class="col">

			<div id="divfoto">
				<img id="foto" src="<?=$app->resuelve(DIR_FOTOS_USU.$_SESSION['nombre'])?>" height="100" width="100">
				<div id = "datosUsu" style="text-align: center;">
					<h3>
						Bienvenido, <?php echo $_SESSION['nombre']?>
					</h3>
				</div>
			</div>
		</div>
		
		<div id="colR">
			<div id="menuPestanas">
				<div id="pestanas">
					<ul class="pestanasM">
					  <li class="menu1">Gestionar Noticias</li> |
					  <!--li class="menu2" onclick="menuPes('2')">Editar datos</li-->
					</ul>
				</div>
				<div id="cuerpo">
					<div id="contenidoPestanas">
						<input type="text"></input>
						<button id="addNoticia" onclick="location.href='<?= $app->resuelve('/html/editor/addNoticia.php') ?>'">Añadir nueva noticia</button>
						<div id="noticiasEditor">
							<?php
								es\ucm\fdi\aw\Noticia::imprimeNoticias();
							?>
						</div>

					</div>
				</div>
			</div>		
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