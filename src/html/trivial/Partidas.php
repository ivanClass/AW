<?php
	require_once '../../includes/config.php';
	require_once '../../includes/Jugadores.php';
	require_once '../../includes/Preguntas.php';
	require_once '../../includes/Respuesta.php';
	require_once '../../includes/gestionarPartidas.php';
	
	if(isset($_SESSION['idUser'])){
		$j = new \es\ucm\fdi\aw\Jugadores($_SESSION['idUser'],10);
		$usu=$j->buscaJugador($_SESSION['idUser']);
		$preguntas = new \es\ucm\fdi\aw\Preguntas(1,"a","a");
		$respuesta = new \es\ucm\fdi\aw\Respuesta();
		$partidas = new \es\ucm\fdi\aw\gestionarPartidas("","","","");
		//session_start();
		if(!isset($_SESSION['mostrar'])){
			$_SESSION['mostrar']=FALSE;
		}
		
	}
?>
<!DOCTYPE html>
<html>
	<head>
	  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  	<title>Trivial</title>
		<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/partidas.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>
		<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
		
		
	<script  type="text/javascript">
	
	function partidaNueva(){
			var posicion=document.getElementById("test").options.selectedIndex; //posicion
			alert(document.getElementById("test").options[posicion].text); //valor
			
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
				<table  class="rankings" id="rk_trivial"> 
					<thead>
						<tr> <th colspan="5">Mis Partidas actuales</th></tr>
														
						<tr>
						<th scope="col">Mis puntos</th>
						<th scope="col">Turno</th>
						<th scope="col">Puntos rival</th>
						<th scope="col">Usuario</th>
						<th scope="col"> </th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						$partida=$partidas->obtenerPartidasM($_SESSION['idUser']);					
						foreach ($partida as $p) {  ?>
						 <form  class="estilo" method="post"    action="actualizarPartida.php" >
							<input  type="hidden" name="idPartida"  value= <?php echo $p['id_partida'];?> ></input>  
							<input  type="hidden" name="jugador1"  value= <?php echo "True";?> ></input> 					
							<tr class="nombrelista"><td><?php echo $p['puntuacion1'];?></td><td><?php if($p['turno']==$_SESSION['idUser']){echo "jugar"; $boton="submit"; }else {echo 'turno oponente'; $boton="hidden";}?></td><td> <?php echo $p['puntuacion2']; ?></td><td><?php echo $p['jugador2'];?></td><td><input type=<?php echo $boton;?> class="boton"  name="p"  value="Jugar"> </td></tr>
						 </form>
						
						<?php } ?>	
						<?php 
						$partida2=$partidas->obtenerPartidasO($_SESSION['idUser']);					
						foreach ($partida2 as $p2) { ?>
						<form  class="estilo" method="post"    action="actualizarPartida.php" >
							<input  type="hidden" name="idPartida"  value= <?php echo $p2['id_partida'];?> ></input>  
							<input  type="hidden" name="jugador1"  value= <?php echo "False";?> ></input> 		
						<tr class="nombrelista"><td><?php echo $p2['puntuacion2'];?></td><td><?php if($p2['turno']==$_SESSION['idUser']){echo "jugar"; $boton="submit";}else {echo 'turno oponente'; $boton="hidden";}?></td><td> <?php echo $p2['puntuacion1']; ?></td><td><?php echo $p2['jugador1'];?></td><td><input type=<?php echo $boton;?> class="boton"  name="p"  value="Jugar"> </td></tr>
						</form>
						
					
						
						<?php } ?>	
					</tbody>
				</table>
				<form action="crearPartida.php" method="post">
				<select  class="estilo" name="partidaNueva">
					<?php 	
					$jugadoresPosibles= $j->obtenerJugadoresPosibles($_SESSION['idUser']) ;
					foreach ($jugadoresPosibles as $j1) { ?>
					<option><?php echo $j1['nick']; ?>	</option>
				<?php } ?>	
				</select>
				<input type="submit"  name="pn" id="pn" class="botonPartida"   value="Nueva partida"></input>  
				</form>
				
				
			</div>
		 
			<div id="centro">
				<div id="contenido">
					<?php if($_SESSION['mostrar']== True){
						
						$p1=$partidas->obtenerDatosPartida($_SESSION['id_partidas']);
						
						?>
					<h1 class="estilo" ><?php  $pregunta=$preguntas->preguntaAleatoria(); echo $pregunta->enunciado(); ?></h1>
					<hr>
					  
					 
					<?php 
						$jbotones= 1;  
						$respuestas=$respuesta->respuestas($pregunta->id());
					
						shuffle($respuestas);
						
						foreach ($respuestas as $opcion) { ?>
						
						   <form  class="estilo" method="post" id=<?php echo $jbotones+5 ;?>  action="actualizarOpcionesPartida.php" >
							<input  type="hidden" name="correcta" id=<?php echo $jbotones+6 ;?> value= <?php echo $opcion['correcta'];?> ></input>  
							<input  type="hidden" name="id" id=<?php echo $jbotones+20 ;?> value= <?php echo $opcion['id_opcion'];?> ></input> 
							<input  type="submit" name="p"   id=<?php echo $jbotones ; ?>  value="<?=$opcion['texto']?>"   onclick="opcionElegida('<?php echo $opcion['correcta'];?> ','<?php echo  $jbotones ; ?>')"> </input>
						  </form> 	
						<?php $jbotones++;} ?>	
					<p class="estilo" >Rival:<?php if($_SESSION['jugador1']==True){echo $p1->jugador2();}else {echo $p1->jugador1(); }?></p>
					<p class="estilo">Resultado:</p>
					<p class="estilo" ><?php if($_SESSION['jugador1']==True){echo $p1->puntuacion1(); echo "-" ; echo $p1->puntuacion2();}else {echo $p1->puntuacion2(); echo "-"; echo $p1->puntuacion1(); }?></p>
					<?php } ?>	
				
				</div>
				<div id="sidebar-right">
				
						
         				<div id="rkPuntos">
							<table  class="rankings" id="rk_trivial"> 
								<thead>
									<tr> <th colspan="3">Mis últimas partidas</th> </tr>
																		
									 <tr>
										<th scope="col">Rival</th>
										<th scope="col">Resultado</th>
										<th scope="col">Ganador</th>
											
									</tr>
								</thead>
								<tbody>
									<?php 
									$partidaF=$partidas->obtenerPartidasFinalizadasO($_SESSION['idUser']);					
									foreach ($partidaF as $pF){
									if($pF['puntuacion1']==7){
										$ganador="perdedor";
									}else{
										$ganador="ganador";
										
									}
									 ?>
									<tr class=<?php echo $ganador;?>><td> <?php echo $pF['jugador1'];?></td><td> <?php echo $pF['puntuacion2']; echo "-" ; echo $pF['puntuacion1'];?><td class="puntos"> <?php if($ganador=="ganador"){echo $pF['jugador2'];}else {echo $pF['jugador1']; }?></td></tr>
									
									<?php } ?>	
									
									<?php 
									$partidaF=$partidas->obtenerPartidasFinalizadasM($_SESSION['idUser']);					
									foreach ($partidaF as $pF){
									if($pF['puntuacion1']==7){
										$ganador="ganador";
									}else{
										$ganador="perdedor";
										
									}
									 ?>
									<tr class=<?php echo $ganador;?>><td> <?php echo $pF['jugador2'];?></td><td> <?php echo $pF['puntuacion1']; echo "-" ; echo $pF['puntuacion2'];?><td class="puntos"> <?php if($ganador=="ganador"){echo $pF['jugador1'];}else {echo $pF['jugador2']; }?></td></tr>
									
									<?php } ?>
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