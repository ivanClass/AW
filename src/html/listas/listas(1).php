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
		<link href="<?= $app->resuelve('/css/listas_sidebar.css') ?>" rel="stylesheet" type="text/css">
	  	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
		<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script type="text/javascript">
				$(document).ready(function(){
					var listas = document.getElementsByClassName("cuadro_lista");
					for(var i=0; i< listas.length; i++){
						var table = listas[i];
						table.onclick = function(){
							
							document.location.href = "lista.php?name="+ $(this).find(".titulo_lista h2").text()+"&id="+$(this).attr("id");
						}
						
					}		
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
		?>			
				<div id = "listas">
				<?php
					$type = $_GET['type'];
					if(!($app->usuarioLogueado()) && $type!="top" && $type!="novedades") $type = "novedades";
					$data = null;
					$lista = new es\ucm\fdi\aw\Lista();
					if($type=="top"){
					echo "<h1 id=\"titulo\"> Lo más seguido </h1>";
					$data = $lista-> cargarTop();
					}
					else if($type == "mine"){

						echo "<h1 id=\"titulo\"> Mis listas </h1>";
						$data = $lista->cargarListas($_SESSION['idUser']);
					}
					else if($type == "fav"){
						echo "<h1 id=\"titulo\"> Favoritas </h1>";
						$data = $lista->cargarFavs($_SESSION['idUser']);
					}
					else if($type == "novedades"){
						echo "<h1 id=\"titulo\"> Ultimas novedades </h1>";
						$data = $lista->cargarNovedades();
					}
					foreach ($data as $elemento){
					$imagen = $lista -> imagenLista($elemento['id_lista']);

					echo <<<EOF
					<div class ="lista">
										<table class="cuadro_lista" id ="{$elemento['id_lista']}">
											<tbody>
												<tr>
												
													<td class="img_lista">
													
														<img src="{$imagen['imagen']}"/>
													</td>
													<td class ="titulo_lista">
														<h2> {$elemento['titulo']}</h2>
													</td>
													<td class="info_lista">
														<ul>
															<li> Autor: {$elemento['autor']} </li>
															<li> Seguidores: {$elemento['followers']} </li>
														</ul>
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
		
		<?php
			$app->doInclude('comun/footer.php');
		?>
	
	</body>
</html>