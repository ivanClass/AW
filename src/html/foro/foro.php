<?php
	require_once '../../includes/config.php';
	require_once '../../includes/gestionForo.php';
	
		
		$foro = new \es\ucm\fdi\aw\gestionForo();
		
		
		
	
?>
<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title>Foro</title>
	<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/foro.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/index.css') ?>" rel="stylesheet" type="text/css">

	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>
	<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
	
	<script>
	function actualizarTema(){
					var tema= $("#tema").val();
					
					
					$.ajax({
						url: 'validarTema.php',
						data: {tema: tema},
						type: "POST",
						error: function(){
						alert("Problemas en el envío del formulario")
						},
						success: function(data, status){
						if(data == "Incorrecto"){
							alert("No introduzca caracteres extraños");
						}else{
							alert("Tema añadido");
							 window.location.reload();
						}
						}
					})
				}
				
	</script>
</head>
	<body>
		<?php
			$app->doInclude('comun/header.php');
		?>
		<div id="contenedor">
		
	
		
		<div class="t">
			<div class="botonforo">	
			<?php if(!isset($_SESSION['idUser'])){ $boton="hidden";}else { $boton="submit";}?>	
			<a href="#modalTema ">  <input type="<?php echo $boton;?>" name="p"  value="Publicar Nuevo Tema"  > </a> 
			<div id="modalTema" class="modal">
				<div class="modal-contenido">
				<a href="#">X</a>
								 
								
				 <form  class="estil" method="post" id="formulario"    >
					<div class="row">
						<label for="tema">Nuevo tema:</label><br />
						<input id="tema" class="input" name="pregunta" type="text" value="" size="30" /><br />
					</div>
									
					<input type="button" id="submit_button"  onclick="actualizarTema()"  value="Enviar" />
				</form>				
				</div>
			</div>		
			</div>
							<table  class="tabla" border="0" cellpadding=”2″ cellspacing=”2″ id="tforo"> 
								<thead>
									<tr>
										<th scope="col">Titulo</th>
										<th scope="col">Autor</th>
										<th scope="col">Respuestas</th>
										<th scope="col">Ultimo mensaje</th>
											
									</tr>
								</thead>
								<tbody>
							
							<?php 
							$temas=$foro->temasEscritos();
							foreach ($temas as $t) { 
							$id=$t['id_tema'];
							?>
							<tr class="modo1" >
							<td><a href="TemaForo.php?id=<?=$id?>"> <?php echo $t['titulo'];?> </a></td>
							<td >Por <b><?php echo $t['creador'];?>  </b></td>
							<td > <?php $n=$foro->nMensaje($id);echo $n;?> </td>
							<td > <?php $f=$foro->fechaUltimoMensaje($id);echo $f;?> </td>
						  </tr >
						  
						 <?php } ?>
				</table>
			
		</div>
		
		
			
			

		

	

		
	
	
</div>
</div>
	<?php
		$app->doInclude('comun/footer.php');
	?>
	</div>
</body>
</html>