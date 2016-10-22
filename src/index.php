<?php
	require_once __DIR__.'/includes/config.php';
	require_once 'includes/Preguntas.php';
	require_once 'includes/Respuesta.php';
	require_once 'includes/lista.php';
	require_once 'includes/admin.php';
	require_once 'includes/Noticia.php';
	
	
	$noticias = new \es\ucm\fdi\aw\Noticia();
	$admin = new \es\ucm\fdi\aw\Admin();
	$lista = new \es\ucm\fdi\aw\Lista();
	$preguntas = new \es\ucm\fdi\aw\Preguntas(1,"a","a");
	$respuesta = new \es\ucm\fdi\aw\Respuesta();
		
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="<?= $app->resuelve('/css/index.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
	<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
	<title> Moviect </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script type="text/javascript">
				$(document).ready(function(){
					$(".lista").click(function(){
						var name =$(this).find("td").text();
						document.location.href = "<?= $app->resuelve('/html/listas/lista.php')?>?id="+$(this).attr("id")+"&name="+name;
						
						
						
					})
				});
		</script>
	</head>
	<body>
		<?php
			$app->doInclude('comun/header.php');
		?>
		<div id="contenedor">

			<div id="central">
				<div id="noticias">
				<?php
					$noticia = $noticias->ultimaNoticia();
					
					echo <<<EOF
					<a href="{$app->resuelve('/html/noticias/noticia.php')}?data={$noticia['id_noticia']}"
					<img src="{$app->resuelve(DIR_FOTOS_NOT.$noticia['id_noticia'])}" width="100%" height="100%">
				<h1> {$noticia['titulo']} <h1>
				</a>
					
EOF;
				
				?>
				</div>
				<div id="listas">
						<table  class="rankings" id="rk_listas" 
							<thead>
							<tr> <th> TOP Listas de peliculas </th></tr>
							</thead>
							<tbody>
							<?php
								$listas = $lista->cargarTop();
								for($i=0; $i<5; ++$i){
									echo '<tr class="lista" id="'. $listas[$i]['id_lista'] . '"><td>' . $listas[$i]['titulo'] . '</td></tr>';
								} 
							?>
							</tbody>
						</table>
				
					<table  class="rankings" id="rk_users"> 
							<thead>
							<tr> <th colspan="2">TOP USUARIOS</th></tr>
							
							 <tr>
								<th scope="col">Usuario</th>
								<th scope="col">Puntos</th>
								
							</tr
														</thead>

							<tbody>
							<?php
								$usuarios = $admin->cargarUsuarios();
								for($i=0; $i<5; ++$i){
								echo '<tr class="usuario" id="'. $usuarios[$i]['nick'] . '"><td>' . $usuarios[$i]['nick'] . '</td><td>' . $usuarios[$i]['puntos'] . '</td></tr>';
								} 
							?>
	
							</tbody>
						</table>
				</div>
			</div>
			<div id="trivial">
				<h1>Atrévete con nuestro trivial!</h1>
				<p><?php  $pregunta=$preguntas->preguntaAleatoria(); echo $pregunta->enunciado(); ?></p>
				
				
				<form action="./html/trivial/trivial.php">
				<?php 
						
						$respuestas=$respuesta->respuestas($pregunta->id());
						
						shuffle($respuestas);
						
						foreach ($respuestas as $opcion) { ?>
					 <input type="radio"  value="<?php=$opcion['texto']?>"> <?php echo $opcion['texto']?>  </br>
					 <?php } ?>	
					 
					 <input id="jugar" type="submit" value="Entra a jugar" />
				</form>
			</div>
		

		</div>
		<?php
			$app->doInclude('comun/footer.php');
		?>
	</body>
</html>