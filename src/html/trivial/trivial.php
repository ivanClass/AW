<?php
	require_once '../../includes/config.php';
	require_once '../../includes/Jugadores.php';
	require_once '../../includes/Preguntas.php';
	require_once '../../includes/Respuesta.php';
	
	
	if(isset($_SESSION['idUser'])){
		$j = new \es\ucm\fdi\aw\Jugadores($_SESSION['idUser'],10);
		$usu=$j->buscaJugador($_SESSION['idUser']);
		$preguntas = new \es\ucm\fdi\aw\Preguntas(1,"a","a");
		$respuesta = new \es\ucm\fdi\aw\Respuesta();
		
		
		if(!isset($_SESSION['puntos'])){
			$_SESSION['puntos']=0;
		}
		if(!isset($_SESSION['racha'])){
			$_SESSION['racha']=0;
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
	  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  	<title>Trivial</title>
		<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/trivial.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>


		<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
	
	
	<script>
	
		
				function actualizarPregunta(){
					var pregunta = $("#pregunta").val();
					var o1 = $("#opcion1").val();
					var o2 = $("#opcion2").val();
					var o3 = $("#opcion3").val();
					var o4 = $("#opcion4").val();
					
					$.ajax({
						url: 'validarPregunta.php',
						data: {pregunta: pregunta, opcion1:o1, opcion2:o2, opcion3:o3, opcion4:o4},
						type: "POST",
						error: function(){
						alert("Problemas en el envío del formulario")
						},
						success: function(data, status){
						if(data == "Incorrecto"){
							alert("Rellene todos los campos");
						}else{
							alert("Pregunta añadida");
							 window.location.reload();
						}
						}
					})
				}
		
		function cambiar(pregunta,opcion,n,p){
			
			$("#nombrePregunta").text(pregunta);
			$("#respuesta").text("Mi respuesta: " + opcion);
			$("#nC").text("Número de veces contestada: " + n);
			$("#porcentaje").text("Media aciertos: " + p+ "%");
			
			
		}
		function ventanaSecundaria(url) { 
			open(url,'','top=300,left=300,width=300,height=300') ; 
		} 
		
		function opcionElegida(correcta,n){
			if(correcta==1){
				 document.getElementById(n).style.backgroundColor = "green"; 
				
				alert('Respuesta correcta','Alert Dialog');
				
				
					
			}
			else{
				 document.getElementById(n).style.backgroundColor = "red"; 
				alert("Respuesta incorrecta")
				  window.setInterval("cargar()",4000);
				 
				 
			}
			  
			
		
		}
		function cargar(){
			  window.location.reload(); 
			 
		}
		
		function elegirMenu(opcion){ 
			if(opcion == 1){
				document.getElementById('opciones').style.display = "block";
				document.getElementById('opcionesRespuestas').style.display = "none";
				document.getElementById('rkPuntos').style.display = "none";
				
			}
			else if(opcion == 2){
				document.getElementById('opciones').style.display = "none";
				document.getElementById('opcionesRespuestas').style.display = "block";
				document.getElementById('rkPuntos').style.display = "none";
				
			}
			else if(opcion == 3){
				document.getElementById('opciones').style.display = "none";
				document.getElementById('opcionesRespuestas').style.display = "none";
				document.getElementById('rkPuntos').style.display = "block";
				
			}
			
		}
			
	</script>
	</head>
	<body>
		<?php
			$app->doInclude('comun/header.php');
			
			
		?>
		<div id="contenedor">
		<?php
		if(!isset($_SESSION['idUser'])){
			echo  "<p id=\"warning\"> Contenido solo visible para usuarios registrados </p>";
		}else{
		?>
			<div id="sidebar-left">
				<h1 class="estilo">Bienvenido al trivial de Moviect:</h1>
				<hr>
				<p class="estilo" >Preguntas respondidas:</p>
				<p class="estilo"> <?php  $respondidas=$preguntas->preguntasRespondidas($_SESSION['idUser']); echo $respondidas; ?></p>
				<p class="estilo" >Preguntas enviadas:</p>
				<p class="estilo"> <?php $enviadas=$preguntas->preguntasEnviadas($_SESSION['idUser']); echo $enviadas; ?></p>
				<p class="estilo">Aciertos:</p>
				<p class="estilo"><?php $aciertos=$respuesta->respuestasCorrectas($_SESSION['idUser']); echo $aciertos; ?></p>
				<p class="estilo">Mis puntos:</p>
				<p class="estilo"><?php  $puntos=$usu->puntos(); echo $puntos; ?> </p>
				<a href=" ./Partidas.php" target="_self" ><input type="button"  class="boton"  name="p"  value="Ir a mis partidas"/></a>
			</div>
		 
			<div id="centro">
				<div id="contenido">
					<h1 class="estilo" ><?php  $pregunta=$preguntas->preguntaAleatoria(); echo $pregunta->enunciado(); ?></h1>
					<hr>
					  
					 
					<?php 
						$jbotones= 1;  
						$respuestas=$respuesta->respuestas($pregunta->id());
						
						shuffle($respuestas);
						
						foreach ($respuestas as $opcion) { ?>
						
						   <form  class="estilo" method="post" id=<?php echo $jbotones+5 ;?>  action="actualizar.php" >
							<input  type="hidden" name="correcta" id=<?php echo $jbotones+6 ;?> value= <?php echo $opcion['correcta'];?> ></input>  
							<input  type="hidden" name="id" id=<?php echo $jbotones+20 ;?> value= <?php echo $opcion['id_opcion'];?> ></input> 
							<input  type="submit" name="p"   id=<?php echo $jbotones ;?>  value="<?=$opcion['texto']?>"   onclick="opcionElegida('<?php echo $opcion['correcta'];?> ','<?php echo  $jbotones ; ?>')"> </input>
						  </form> 	
						<?php $jbotones++;} ?>	
						 
					
					
					 <p class="estilo">Racha de preguntas correctas : <?php echo $_SESSION['racha'];?></p> 
					
					<p  class="estilo" id=puntuacion>Puntos :  <?php echo $_SESSION['puntos'];?>  </p>
					
				</div>
				<div id="sidebar-right">
				<div id="preguntas">
					 <ul id=”menu”>
					
						<li onclick="elegirMenu('1')"><a >Mis preguntas</a></li>						
						<li onclick="elegirMenu('2')"><a >Mis respuestas</a></li>
						<li onclick="elegirMenu('3')"><a >Ranking</a></li>
						
					 </ul> 
					</div>
						
							<div id="opciones">
								<ol>
								<?php 
									$lista=$preguntas->listaPreguntas($_SESSION['idUser']);
									foreach ($lista as $l) { ?>
									<li   ><?php echo $l['enunciado'];?></li>									
									
								<?php } ?>		
								</ol>
								<a href="#modalPregunta ">  <input type="button" name="p"  value="Añadir pregunta"  > </a> 	 
								<div id="modalPregunta" class="modal">
								 <div class="modal-contenido">
									<a href="#">X</a>
								 
								<h2> Introducir respuesta correcta en primer lugar </h2>
									 <form  class="estil" method="post" id="formulario"    >
										<div class="row">
											<label for="pregunta">Pregunta:</label><br />
											<input id="pregunta" class="input" name="pregunta" type="text" value="" size="30" /><br />
											</div>
										<div class="row">
											<label for="opcion1">Opcion1 :</label><br />
											<input id="opcion1" class="input" name="opcion1" type="text" value="" size="30" /><br />
										</div>
										<div class="row">
											<label for="opcion2">Opcion 2</label><br />
											<input id="opcion2" class="input" name="opcion2" type="text" value="" size="30" /><br />
										</div>
										<div class="row">
											<label for="opcion3">Opcion 3</label><br />
											<input id="opcion3" class="input" name="opcion3" type="text" value="" size="30" /><br />
										</div>
										<div class="row">
											<label for="opcion4">Opcion4:</label><br />
											<input id="opcion4" class="input" name="opcion4" type="text" value="" size="30" /><br />
										</div>
										<input type="button" id="submit_button"  onclick="actualizarPregunta()"  value="Enviar" />
									</form>				
								</div>
								</div>						
							
							</div>
								<div id="opcionesRespuestas">
									<ol>
									<?php 
									$listaRespondidas=$preguntas->misRespuestas($_SESSION['idUser']);
									foreach ($listaRespondidas as $lr) { 
									$nVecesContestada=$preguntas->nContestada($lr['id_pregunta']);
									$nVecesContestadaCorrecta=$preguntas->respuestasCorrectasPregunta($lr['id_pregunta']);
									$porcentaje=$nVecesContestadaCorrecta/$nVecesContestada*100;
									?>
										<li  onclick="cambiar('<?php echo $lr['enunciado'];?> ','<?php echo $lr['texto'];?>','<?php echo $nVecesContestada;?> ','<?php echo $porcentaje;?> ')"><a href="#modalRespuesta" > <?php echo $lr['enunciado'];?></a> </li>	
										
										
									<?php } ?>
									</ol>
								<div id="modalRespuesta" class="modal">
								 <div class="modal-contenido">
									<a href="#">X</a>
								<h1 class="estilo" id="nombrePregunta" >¿En qué año nació Marilyn Monroe?</h1>
								<hr>
								<p class="estilo"  id="respuesta"> Mi respuesta : 2002 </p>
								<p class="estilo" id="porcentaje"> Media aciertos: 45 % </p>
								<p class="estilo" id="nC"> Número de veces contestada : 20  </p>			
								</div>
								</div>				
							
						</div>
						
         				<div id="rkPuntos">
							<table  class="rankings" id="rk_trivial"> 
								<thead>
									<tr> <th colspan="3">Ranking Moviect Trivial</th></tr>
									<tr> <th>Mi posición : 2</th></tr>										
									 <tr>
										<th scope="col">Posición</th>
										<th scope="col">Usuario</th>
										<th scope="col">Puntos</th>
											
									</tr>
								</thead>
								<tbody>
									<?php 
									$i = 1;
									$listaUsuarios=$j->obtenerJugadores();
									foreach ($listaUsuarios as $lu) { ?>
									<tr class="nombrelista"><td> <?php echo $i;?> </td><td> <?php echo $lu['nick'];?></td><td class="puntos"> <?php echo $lu['puntuacion'];?></td></tr>
									
									<?php $i++;} ?>
								</tbody>
							</table>	 
							
														
						</div>			
				</div>
		    </div>
			<?php
		};
			
			
		?>
		</div>
		<?php
			$app->doInclude('comun/footer.php');
		?>
	</body>
</html>