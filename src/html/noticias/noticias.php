<?php
	require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title>Noticias</title>
	<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/noticias.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>
	<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
	<script type="text/javascript">
		$(document).ready(function() {    
		   $('body').on('click', 'a.pag', function() {
		        var page = $(this).attr('data');        
		        var dataString = 'page='+page;

		        $.ajax({
		            type: "GET",
		            url: "PaginarNoticias.php",
		            data: dataString,
					error: function(){
						alert("Problemas en el envío del formulario");
					},
		            success: function(data) {
		                $('section').fadeIn(1000).html(data);
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

		<div id="colL">
			<div id="masLeido" class="postExt">
				<h2>
					<span class="icon-star"></span>
					Lo más leído
				</h2>
				<?php
					es\ucm\fdi\aw\Noticia::dameMasLeidos();
				?>				
			</div>
			<div id="destacados" class="postExt">
				<h2>
					<span class="icon-bookmarks"></span>
					Destacados
				</h2>
				<?php
					es\ucm\fdi\aw\Noticia::dameMasComentados();
				?>					
			</div>
		</div>
		
		<div id="colR">
			<section>
				<?php
					es\ucm\fdi\aw\Noticia::paginameNoticias(null);

				?>
			</section> 
		</div>

	</div>
	<?php
		$app->doInclude('comun/footer.php');
	?>
</body>
</html>