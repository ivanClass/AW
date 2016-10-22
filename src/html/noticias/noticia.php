<?php
	require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title>Noticias</title>
	<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">

	<link href="<?= $app->resuelve('/css/misMensajes.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/noticia.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">

	<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
	<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#submit").click(function(){
				var data = $("#message").val();
				var noticia = <?=$_GET['data']?>;  
				$.ajax({
					url: "<?= $app->resuelve('/html/noticias/addComentario.php') ?>",
					data: {noticia: noticia, cuerpo: data},
					type: "POST",
					error: function(){
						alert("Problemas en el envío del formulario");
					},
					success: function(data,status){
						alert("Comentario enviado!");
						var data='id=<?=$_GET['data']?>;';
				        $.ajax({
				            type: "GET",
				            url: "<?= $app->resuelve('/html/noticias/dameListaComentariosNoticias.php') ?>",
				            data: data,
							error: function(){
								alert("Problemas en el envío del formulario");
							},
				            success: function(data) {
				        		$('#comentarios').html(data);
				            }
				        });	
					}
				})
				
			});
			$('#asunto').val('Ticket titulo_noticia:');
			$('#send_btn').click(function(){
				var receptor = $('#autorNot').text();
				var asunto = $('#asunto').val();
				var mensaje = $('#mensaje').val();
				$.ajax({
					url: "<?= $app->resuelve('/html/usuarios/enviarMensaje.php') ?>",
					data: {receptor: receptor, asunto: asunto, mensaje: mensaje},
					type: "POST",
					error: function(){
						alert("Problemas en el envío del formulario");
					},
					success: function(data,status){
				 		alert("Mensaje enviado al editor!");
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
	<!-- EL SERVIDOR MURIÓ
	<nav class="navbar navbar-inverse navbar-fixed-top"" style=>
	  <div class="container-fluid">
	    <div class="navbar-header">
	    	<a href="#" class="navbar-left"><img src="<?= $app->resuelve('/img/LOGO.png')?>" alt="Moviect" height="50" width="auto"></a>
	    </div>
	    <ul class="nav navbar-nav">
            <li class="menu"><a href="#">Listas</a></li>
            <li class="menu"><a href="#about">Noticias</a></li>
            <li class="menu"><a href="#contact">Trivial</a></li>
            <li class="menu"><a href="#contact">Foro</a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	      <li class="menu"><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
	      <li class="menu"><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	    </ul>
	  </div>
	</nav>
	-->
	<div id="contenedor" class="container">
		<div id="colR">
			<article>
			<?php
				es\ucm\fdi\aw\Noticia::incrementaVisitas($_GET['data']);
				es\ucm\fdi\aw\Noticia::dameTextoNoticia($_GET['data']);
			?>
			</article>
			<?php
				if(isset($_SESSION['idUser'])){
			?>
			<a href="#myModal" role="button" class="btn btn-custom" data-toggle="modal">Informar al editor</a>
			<?php
				}
			?>
			<div>
				<div id="comentarios">
				<?php
					es\ucm\fdi\aw\Noticia::dameComentariosNoticia($_GET['data']);
				?>
				</div>
				<?php
					if(isset($_SESSION['idUser'])){
				?>
				<div id="formComentario">
						<label for="message">Comentario: <span class="required">*</span></label>  
						<textarea id="message" name="message" placeholder="Escribe aqui tu comentario" required="required"></textarea>  
						<input type="submit" value="Enviar!" id="submit" />
				</div>
				<?php
					};
				?>
			</div>
		</div>
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
		 <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		        <div class="modal-dialog">
		        <div class="modal-content">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		            <h4 class="modal-title">Enviar al editor</h4>
		        </div>
		        <div class="modal-body" id="modal-body">
		                <div class="form-group">
		                    <label class="control-label col-md-2" for="asunto">Asunto</label>
		                    <div class="col-md-10 input-group">
		                        <input type="text" class="form-control" id="asunto" name="asunto" placeholder="asunto"/>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="contrl-label col-md-2" for="mensaje">Mensaje</label>
		                    <div class="col-md-10 input-group">
		                        <textarea rows="10" class="form-control" id="mensaje" name="mensaje" placeholder="Mensaje"></textarea>
		                    </div>
		                </div>
		                <div class="form-group text-center">
		                	<div class="col-md-2">
		                	</div>
		                    <div class="col-md-10">
		                        <button type="submit" value="Submit" class="btn btn-custom text-center" id="send_btn">Enviar</button>
		                    </div>
		                </div>
		        </div><!-- End of Modal body -->
		        </div><!-- End of Modal content -->
		        </div><!-- End of Modal dialog -->
		    </div><!-- End of Modal -->
	</div>
	<?php
		$app->doInclude('comun/footer.php');
	?>
	<!-- EL SERVIDOR MURIÓ
	<nav class="navbar navbar-inverse navbar-fixed-bottom"" style=>
	  <div class="container-fluid">
	    <div class="navbar-header">
	    </div>
	    <ul class="nav navbar-nav">
            <li class="menu"><a href="#">El equipo</a></li>
            <li class="menu"><a href="#about">Contacto</a></li>
	    </ul>
	  </div>
	</nav>
	-->
</body>
</html>