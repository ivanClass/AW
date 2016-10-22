<?php
	require_once '../../includes/config.php';
	$app->doInclude('lista.php');
?>
<!DOCTYPE html>
<html>
	<head>
	  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  	<title>Top listas</title>
	  	<link href="<?= $app->resuelve('/css/top_listas.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/lista_peliculas.css') ?>" rel="stylesheet" type="text/css">
	  	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
		<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				$(".cuadro_pelicula").click(function(){
					
					document.location.href = "<?= $app->resuelve('/html/peliculas/pelicula.php') ?>" + "?data="+$(this).attr("id");
					}
					
				);	
				$("#follow-button").click(function(){
					
					$.ajax({
						type: "POST",
						url: '<?= $app->resuelve('/html/listas/followLista.php') ?>',
						data: {id_lista: "<?=$_GET['id']?>"},
						success: function(response){
							location.replace("lista.php?id="+"<?=$_GET['id']?>"+"&name="+"<?=$_GET['name']?>");
						},
						error: function(xhr,ajaxOptions,thrownError){
							alert("esto no va");
						}
				});
				});
				$("#unfollow-button").click(function(){
					
					$.ajax({
						type: "POST",
						url: '<?= $app->resuelve('/html/listas/followLista.php') ?>',
						data: {id_lista: "<?=$_GET['id']?>",follow: false},
						success: function(response){
							location.replace("lista.php?id="+"<?=$_GET['id']?>"+"&name="+"<?=$_GET['name']?>");
						},
						error: function(xhr,ajaxOptions,thrownError){
							alert("esto no va");
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
			$app->doInclude('/comun/listas_sidebar.php');
			$lista = new es\ucm\fdi\aw\Lista();

		?>
		
						<div id = "listas">

							<h1 id="titulo"> <?php echo $_GET['name'] ?> </h1>
		 				
							<?php 
							if($app->usuarioLogueado()){
								 if($lista->following($_GET['id'],$_SESSION['idUser'])){							
									echo '<img id="unfollow-button" src="../../img/following_button.jpg" />';							
								}
								else{
									echo '<img id="follow-button" src="../../img/follow_button.jpg" />';
								}
							}
							?> 
						<div id="peliculas">
						<div class ="pelicula">
										<table class="cuadro_pelicula">
											<tbody>
												<tr>
												
													<td class="celda_foto">Poster </td>
														<td class="celda_titulo"> Titulo </td>
														<td class="celda_director"> Director </td>
														<td class="celda_anio"> Año</td>
													</td>
												</tr>
											</tbody>
										</table>
						</div>
					<?php
								$data = $lista->cargarPeliculas($_GET['id']);
								foreach ($data as $elemento){
									
									echo <<<EOF
									<div class="pelicula">
										<table class="cuadro_pelicula" id="{$elemento['ID']}">
											<tbody>
												<tr>
												
													<td class="celda_foto"><img src="{$elemento['imagen']}" /></td>
														<td class="celda_titulo"> {$elemento['titulo']} </td>
														<td class="celda_director"> {$elemento['director']} </td>
														<td class="celda_anio"> {$elemento['year']} </td>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
EOF;
								}
					?>
					</div>
				</div>
				
			

		</div>
		<?php
			$app->doInclude('comun/footer.php');
		?>
	
	</body>
</html>