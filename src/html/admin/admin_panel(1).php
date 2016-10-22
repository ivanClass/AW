<?php
	require_once '../../includes/config.php';
	$app->doInclude('admin.php');
	$app->doInclude('lista.php');
	if(!($app->usuarioLogueado())) header('Location: http://container.fdi.ucm.es:20047');
?>
<!DOCTYPE html>
<html>
	<head>
	  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  	<title>Administracion</title>
	  	<link href="<?= $app->resuelve('/css/admin_panel.css') ?>" rel="stylesheet" type="text/css">
	  	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
		<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
		<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".delete_user").click(function(){
					
					if(confirm("¿Desea eliminar este usuario?")){
						var nick = $(this).parent().parent().attr('id');
						$.ajax({
							url: "<?= $app->resuelve('/html/admin/gestionarAdmin.php') ?>",
							type: "POST",
							data: {id_user: nick},
							complete: function(data,status){
								location.reload();
							}	
						});
					}
				});
				$(".delete_trivial").click(function(){
					
					if(confirm("¿Desea eliminar esta pregunta del trivial?")){
						var pregunta = $(this).parent().parent().attr('id');
						$.ajax({
							url: "<?= $app->resuelve('/html/admin/gestionarAdmin.php') ?>",
							type: "POST",
							  dataType:'json',
							data: {id_trivial: pregunta},
							complete: function(data,status){
								location.reload();
							}
						});
					}
				});
				$(".delete_foro").click(function(){
					
					if(confirm("¿Desea eliminar esta tema del foro?")){
						var tema = $(this).parent().parent().attr('id');
						$.ajax({
							url: "<?= $app->resuelve('/html/admin/gestionarAdmin.php') ?>",
							type: "POST",
							 dataType:'json',
							data: {id_foro: tema},
							complete: function(data,status){
								location.reload();
							}	
						});
					}
				});
				$(".delete_lista").click(function(){
					
					if(confirm("¿Desea eliminar esta lista?")){
						var lista = $(this).parent().parent().attr('id');
						$.ajax({
							url: "<?= $app->resuelve('/html/admin/gestionarAdmin.php') ?>",
							type: "POST",
							  dataType:'json',
							data: {id_lista: lista},
							complete: function(data,status){
								location.reload();
							}	
						});
					}
				});
				$(".delete_pelicula").click(function(){
					
					if(confirm("¿Desea eliminar esta pelicula?")){
						var pelicula = $(this).parent().parent().attr('id');
						$.ajax({
							url: "<?= $app->resuelve('/html/admin/gestionarAdmin.php') ?>",
							type: "POST",
							  dataType:'json',
							data: {id_pelicula: pelicula},
							complete: function(data,status){
								location.reload();
							}	
						});
					}
				});
				var modal = document.getElementById('myModal');
				var span = document.getElementsByClassName("close")[0];

				$(".edit_user").click(function(){
						modal.style.display = "block";
						var usuario = $(this).parent().parent();
						var rol = usuario.find('.celda_rol').text();
						$("#nick").attr("value",usuario.attr("id"));

				});
				$(".edit_movie").click(function(){
						modal.style.display = "block";
						var pelicula = $(this).parent().parent();
						$("#id").attr("value",pelicula.attr("id"));

				});			
					span.onclick = function() {
						modal.style.display = "none";
					}

					window.onclick = function(event) {
						if (event.target == modal) {
							modal.style.display = "none";
						}
					}
					$("#busqueda").keyup(function(){
							var value = $(this).val();
					$(".elementos").each(function() {
							var titulo = $(this).find(".celda_titulo").html();
							if (titulo.toLowerCase().indexOf(value) >= 0) {
								$(this).show();
							}
							else {
								$(this).hide();
							}
						
					});
						
						
						
					})

			});



</script>
	</head>
	<body>

		<?php
			$app->doInclude('comun/header.php');
		?>
		<div id="contenedor">

			<div id="left_sidebar">
				<table id="menu">
				<?php
						$page = $_GET['page'];
						if($page == "users")
							echo <<<EOF
						<tr class="categoria" ><td id="pulsada"><a href="./admin_panel.php?page=users"> Usuarios </a></td></tr>
EOF;
						else
							echo <<<EOF
							<tr class="categoria" ><td><a href="./admin_panel.php?page=users"> Usuarios </a></td></tr>
EOF;
						if($page == "list")
							echo <<<EOF
							<tr class="categoria"><td id="pulsada"><a href="./admin_panel.php?page=list"> Listas</a></td></tr>
EOF;
						else
							echo <<<EOF
							<tr class="categoria"><td><a href="./admin_panel.php?page=list"> Listas</a></td></tr>
EOF;
						if($page == "peliculas")
							echo <<<EOF
							<tr class="categoria"><td id="pulsada"><a href="./admin_panel.php?page=peliculas"> Peliculas </a></td></tr>
EOF;
						else
							echo <<<EOF
							<tr class="categoria"><td><a href="./admin_panel.php?page=peliculas"> Peliculas </a></td></tr>
EOF;
						if($page == "foro")
							echo <<<EOF
							<tr class="categoria"><td id="pulsada"><a href="./admin_panel.php?page=foro"> Foro </a></td></tr>
EOF;
						else
							echo <<<EOF
							<tr class="categoria"><td><a href="./admin_panel.php?page=foro"> Foro </a></td></tr>
EOF;
						if($page == "trivial")
							echo <<<EOF
							<tr class="categoria"><td id="pulsada"><a href="./admin_panel.php?page=trivial"> Trivial </a></td></tr>
EOF;
						else
							echo <<<EOF
							<tr class="categoria"><td><a href="./admin_panel.php?page=trivial"> Trivial </a></td></tr>
EOF;
					?>
				</table>					
			</div>
			
			<div id = "content">
					<div id = "listas">
					<?php
						if($page == "users")
						echo "<h1> Usuarios </h1> ";
						else if($page == "list")
						echo "<h1> Listas </h1>";
						else if($page == "peliculas")
						echo "<h1> Peliculas </h1>";
						else if($page == "trivial")
						echo "<h1> Preguntas del trivial </h1>";
					else if($page == "foro")
						echo "<h1> Foro </h1>"
					?>
					
					<form id ="buscar">
						<input type="text" name="search" id="busqueda">
					</form>
					<div id="elementos">
					<table >
					<?php
				$admin = new es\ucm\fdi\aw\Admin();
									$lista = new es\ucm\fdi\aw\Lista();

						if($page=="users"){
						$data = $admin-> cargarUsuarios();
						foreach ($data as $elemento){
						echo <<<EOF
						<tr class="elementos" id="{$elemento['nick']}">
						
							<td class="celda_foto"> <img class="poster" src="{$app->resuelve(DIR_FOTOS_USU.$elemento['nick'])}"/> </td>
							<td class="celda_titulo"> {$elemento['nick']} </td>
							<td class="celda_anio"> {$elemento['nombre']} </td>
							<td class="celda_rol">{$elemento['rol']} </td>
							<td class="celda_actions"> 
								<img src="{$app->resuelve('/img/edit.png')}" class="edit_user"/>
								<img src="{$app->resuelve('img/erase.png')}" class="delete_user" />
								
							</td>

						</tr>
						
						
						
						
EOF;
						}
						}
					else if($page=="list"){
						$data = $admin-> cargarListas();
						foreach ($data as $elemento){
						$imagen = $lista -> imagenLista($elemento['id_lista']);

						echo <<<EOF
						<tr class="elementos" id="{$elemento['id_lista']}" >
						
							<td class="celda_foto"> <img class="poster" src="{$imagen['imagen']}"/> </td>
							<td class="celda_titulo"> {$elemento['titulo']} </td>
							<td class="celda_anio"> {$elemento['autor']} </td>
							<td class="celda_puntuacion">{$elemento['followers']} </td>
							<td class="celda_actions"> 
							<img src="{$app->resuelve('img/erase.png')}" class="delete_lista"/>	
							</td>
						</tr>						
EOF;
						}
		
					}
					else if($page=="peliculas"){
						$data = $admin-> cargarPeliculas();
						foreach ($data as $elemento){
						echo <<<EOF
						<tr class="elementos" id="{$elemento['ID']}">
						
							<td class="celda_foto"> <img class="poster" src="{$elemento['imagen']}"/> </td>
							<td class="celda_titulo"> {$elemento['titulo']} </td>
							<td class="celda_anio"> {$elemento['year']} </td>
							<td class="celda puntuacion"> </td>
							<td class="celda_actions"> 
								<img src="{$app->resuelve('/img/edit.png')}" class="edit_movie"/>

								<img src="{$app->resuelve('img/erase.png')}" class="delete_pelicula"/>	
							</td>
						</tr>						
EOF;
						}
		
					}
					else if($page=="trivial"){
						$data = $admin-> cargarPreguntas();
						foreach ($data as $elemento){
						$pregunta = substr($elemento['enunciado'],0,40);
						echo <<<EOF
						<tr class="elementos" id= "{$elemento['id_pregunta']}">
						
							<td> {$elemento['id_pregunta']} </td>

							<td class="celda_titulo"> {$pregunta} </td>
							<td class="celda_anio"> {$elemento['autor']} </td>
							<td class="celda_actions"> 
									<img src="{$app->resuelve('img/erase.png')}" class="delete_trivial"/>

							</td>
						</tr>						
EOF;
						}
		
					}
					else if($page=="foro"){
						$data = $admin-> cargarForo();
						foreach ($data as $elemento){
						$titulo = substr($elemento['titulo'],0,40);
						echo <<<EOF
						<tr class="elementos" id="{$elemento['id_tema']}">
						
							
							<td class="celda_titulo"> {$titulo} </td>
							<td class="celda_anio"> {$elemento['creador']} </td>
							<td class="celda_actions"> 
									
									<img src="{$app->resuelve('img/erase.png')}" class="delete_foro"/>			
							</td>
						</tr>						
EOF;
						}
		
					}
					?>
					
					</table>
				</div>
					
				</div>
			</div>
			
			
						
			<div id="myModal" class="modal">

						
						  <div class="modal-content">
							
							<span class="close">x</span>
							<?php 
								if( $page =='users'){
									echo <<<EOF
						<form action="{$app->resuelve('/html/admin/anadirRol.php')}" id="edit_form">
								<fieldset>
								<legend> Editar rol de usuario </legend>
								<input type="radio" name="rol" id="editor" value="EDITOR"> Editor
								<input type="radio" name="rol" id="admin" value="ADMINISTRADOR">
								Administrador
								<input type="hidden" id="nick" name="nick" value="">

								</fieldset>
								<input  type="submit" value="Guardar"/>
							</form>
EOF;
}
								else if ($page =='peliculas'){
									echo <<<EOF
									<form action="{$app->resuelve('/html/admin/anadirTrailer.php')}" id="edit_form">
								<fieldset>
								<legend> Añadir trailer </legend>
								<label for="enlace">Enlace al video: </label>
								<input type="text" name="enlace" id="trailer" >
								<input type="hidden" id="id" name="id" value="">

								</fieldset>
								<input  type="submit" value="Guardar"/>
							</form>
									
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