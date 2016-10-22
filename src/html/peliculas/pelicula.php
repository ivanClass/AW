<?php
	require_once '../../includes/config.php';

	$rutaValorarPeli = 'valorarPelicula.php';
	$rutaRecargarEstr = 'recargarEstrellas.php';
	$rutaComentarPeli = 'addComentarioPelicula.php';
	$rutaRecargarCom = 'recargarComentarios.php';
	$rutaAddPeliLista = 'addPeliculaALista.php';
?>
<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title>Top listas</title>
  	<link href="<?= $app->resuelve('/css/pelicula_estilo.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/estilo3col.css') ?>" rel="stylesheet" type="text/css">
	<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
	<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>

	<script type="text/javascript">
		function menuPes(v){ 
			if(v == 1){
				document.getElementById('trailer').style.display = "block";
				document.getElementById('comentarios').style.display = "none";
				document.getElementById('peliculasRelacionadas').style.display = "none";
				document.getElementById('otrosUsuarios').style.display = "none";
			}
			else if(v == 2){
				document.getElementById('trailer').style.display = "none";
				document.getElementById('comentarios').style.display = "block";
				document.getElementById('peliculasRelacionadas').style.display = "none";
				document.getElementById('otrosUsuarios').style.display = "none";
			}
			else if(v == 3){
				document.getElementById('trailer').style.display = "none";
				document.getElementById('comentarios').style.display = "none";
				document.getElementById('peliculasRelacionadas').style.display = "block";
				document.getElementById('otrosUsuarios').style.display = "none";
			}
			else if(v == 4){
				document.getElementById('trailer').style.display = "none";
				document.getElementById('comentarios').style.display = "none";
				document.getElementById('peliculasRelacionadas').style.display = "none";
				document.getElementById('otrosUsuarios').style.display = "block";
			}
		}
			
	</script>
	<script type="text/javascript">
		
		$(document).ready(function(){
			$(".botonVal").click(function(){
				var idSelec = $(this).attr("id");

				$.ajax({
					url: '<?= $rutaValorarPeli ?>',
					data: {idPeli: '<?=$_GET['data']?>', puntos: idSelec},
					type: "POST",
					error: function(){
						alert(":(")
					},
					success: function(data, status){
						var peli = '<?=$_GET['data']?>';
						$.ajax({
							url: '<?= $rutaRecargarEstr ?>',
							data: {idUsu: '<?=$_SESSION['idUser']?>', idPeli: '<?=$_GET['data']?>'},
							type: "POST",
							error: function(){
								alert(":(");
							},
							success: function(data, status){
								$('#estrellas').html(data);
							}	
						})		
					}	
				})
			});

			$("#submitC").click(function(){
				var coment = $("#messageC").val();

				$.ajax({
					url: '<?= $rutaComentarPeli ?>',
					data: {idPeli: '<?=$_GET['data']?>', comentario: coment},
					type: "POST",
					error: function(){
						alert(":(");
					},
					success: function(data, status){
						$("#messageC").val("");
						$.ajax({
							url: '<?= $rutaRecargarCom ?>',
							data: {idPeli: '<?=$_GET['data']?>'},
							type: "POST",
							error: function(){
								alert(":(");
							},
							success: function(data, status){
								$('#comentarios').html(data);
							}	
						})
								
					}	
				})
			});

			$("#addALista").click(function(){
				var combo = $("#comboPelis").val();

				$.ajax({
					url: '<?= $rutaAddPeliLista ?>',
					data: {idPeli: '<?=$_GET['data']?>', idLista: combo},
					type: "POST",
					error: function(){
						alert(":(");
					},
					success: function(data, status){
						if(data == "ok"){
							alert("La película se ha añadido satisfactoriamente a su lista -> " + $( "#comboPelis option:selected" ).text());
						}
						else{
							alert(data);
						}
								
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
	
	<div id="colLeft">
		<div id="fotoPerfilPelicula">
			<?php
				es\ucm\fdi\aw\Pelicula::imprimeFotoPelicula($_GET['data']);
			?>
		</div>
		<div id="informacionPel">
			<?php
				es\ucm\fdi\aw\Pelicula::imprimeInfoPelicula($_GET['data']);
			?>
		</div>
	<div id="colMiddle">
		<div id="sinopsis">
			<?php
				es\ucm\fdi\aw\Pelicula::imprimeDescripcionPelicula($_GET['data']);
			?>
		</div>
			
		<div id="extras">
			<div id="estrellas">
				<?php
					es\ucm\fdi\aw\Pelicula::gestionValoracion($_SESSION['idUser'], $_GET['data']);
				?>
			</div>
				
			
			<?php
				if(!isset($_SESSION['idUser'])){

				}
				else{
					$bloqueIn = <<<EOF
					<div id="listas" class="textoUsu">
EOF;
						echo $bloqueIn;
						echo "<p>Añadir película a alguna de mis listas: </p>";
						$lista = es\ucm\fdi\aw\Pelicula::imprimeListasUsu($_SESSION['idUser']);

						$num = count($lista);

						if($num == 0){
							echo "<p>No tiene listas en donde añadir<p>";
						}
						else{
							$bloqueCabecera = <<<EOF
							<select id="comboPelis">
EOF;
							echo $bloqueCabecera;
							foreach ($lista as $key => $value) {
								$bloqueOpc = <<<EOF
									<option value="${value['id']}" id="${value['id']}">${value['titulo']}</option>
EOF;
								echo $bloqueOpc;
							}
							echo "</select>";
							$bloqueFin = <<<EOF
							<button id="addALista" type="submit" class="icon-add-to-list">Añadir a mi lista</button>
EOF;
							echo $bloqueFin;
						}
						echo "</div>";
						
						
				}
			?>
				
		</div>	
		
		</div>
	</div>

	<div id="colRight">
		<div id="menuPestanas">
			<div id="pestanas">
				<ul class="pestanasM">
				  <li class="menu1" onclick="menuPes('1')">Trailer</li> |
				  <li class="menu2" onclick="menuPes('2')">Comentarios</li> |
				  <li class="menu3" onclick="menuPes('3')">Películas relacionadas</li> |
				  <li class="menu4" onclick="menuPes('4')">Otros usuarios</li>
				</ul>
			</div>
			<div id="cuerpo">
				<div id="contenidoPestanas">
					
					<div id="trailer">
						<?php
							es\ucm\fdi\aw\Pelicula::imprimeTrailerPelicula($_GET['data']);
						?>
					</div>

					<div id="comentarios">
						<?php
							es\ucm\fdi\aw\Pelicula::imprimeComentariosPelicula($_GET['data']);
						?>
					</div>

					<div id="peliculasRelacionadas">
						<?php
							es\ucm\fdi\aw\Pelicula::imprimePeliculasRelacionadas($_GET['data']);
						?>
					</div>

					<div id="otrosUsuarios">
						<?php
							es\ucm\fdi\aw\Pelicula::imprimeUsuariosConPeliEnLista($_GET['data']);
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
			if(!isset($_SESSION['idUser'])){

			}
			else{
				$bloqueComentar = <<<EOF
					<div id="formComentario">
						<label for="message">Comentario: <span class="required">*</span></label>  
						<textarea id="messageC" name="message" placeholder="Escribe aqui tu comentario" required="required"></textarea>
						<input type="submit" value="Enviar!" id="submitC" />
					</div>
EOF;
				echo $bloqueComentar;
			}
		?>
	</div>
	</div>

	<?php
		$app->doInclude('comun/footer.php');
	?>

</body>
</html>