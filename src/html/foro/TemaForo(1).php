<?php
	require_once '../../includes/config.php';
	require_once '../../includes/gestionForo.php';
	$id = $_GET["id"];
	
		
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
	function actualizarMensajes(id){
				
					var mensaje= $("#message").val();
					
					
					
					
					
					$.ajax({
						url: 'validarMensaje.php',
						data: {mensaje: mensaje,id:id},
						type: "POST",
						error: function(){
						alert("Problemas en el envío del formulario")
						},
						success: function(data, status){
						if(data == "Incorrecto"){
							alert("No introduzca caracteres  extraños");
						}else{
							alert("mensaje añadido");
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
			<a href="#modalTema ">  <input type="<?php echo $boton;?>" name="p"  value="Añadir nuevo mensaje"  > </a> 
			<div id="modalTema" class="modal">
				<div class="modal-contenido">
				<a href="#">X</a>
								 
								
				 <form  class="estil" method="post" id="formulario"    >
					<div class="row">
						<label for="tema">Nuevo mensaje:</label><br />
						<textarea id="message" name="message"> </textarea>
					</div>
						
					<input type="submit" id="submit_button"  onclick="actualizarMensajes(<?php echo $id ?>)"  value="Enviar" />
				</form>				
				</div>
			</div>		
			</div>
			
							<table  class="tabla" border="0" cellpadding=”2″ cellspacing=”2″ id="tforo"> 
								<thead>
								<tr> <th colspan="3"><?php $c=$foro->tema($id);echo $c;?></th> </tr>
									<tr>
										
										<th scope="col">Autor</th>
										<th scope="col">Respuestas</th>
										<th scope="col">Fecha</th>
											
									</tr>
								</thead>
								<tbody>
							
							<?php 
							$comentarios=$foro->comentariosEscritos($id);
							foreach ($comentarios as $t1) { 
							?>
							<tr class="modo1" > 
							<td ><?php echo $t1['autor'];?></td>
							<td ><?php echo $t1['comentario'];?> </td>
							<td > <?php echo $t1['fecha'];?> </td>
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