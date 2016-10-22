<!DOCTYPE html>
<html>
	<head>
		<title>Ranking de pel&iacuteculas</title>
		<link rel="stylesheet" type="text/css" href="../css/ranking_peliculas.css">
		<link href="../css/header.css" rel="stylesheet" type="text/css">
		<link href="../css/footer.css" rel="stylesheet" type="text/css">
		<link href="../css/estilo2col.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<?php
		include('header.php');
	?>
	<div id="contenedor">

		<div id="colFiltros">
			<!-- copiar código comboBox o hacer un include del archivo-->
			<h4>Género: 
			<select>
				<option value="Acción">Acción</option>
				<option value="Suspense">Suspense</option>
				<option value="Terror">Terror</option>
				<option value="Comedia">Comedia</option>
				<option value="Drama">Drama</option>
			</select>
			</h4>
			<h4>Director: 
			<select>
				<option value="Tarantino">Quentin Tarantino</option>
				<option value="Abrams">J.J Abrams</option>
				<option value="Cameron">James Cameron</option>
			</select>
			</h4>
			<h4>Año: 
			<select>
				<option value="2000">2000</option>
				<option value="2001">2001</option>
				<option value="2002">2002</option>
				<option value="2003">2003</option>
				<option value="2004">2004</option>
			</select>
			</h4>
			<h4>Puntuación: 
			<select>
				<option value="10">10</option>
				<option value="9">9</option>
				<option value="8">8</option>
				<option value="7">7</option>
				<option value="6">6</option>
				<option value="5">5</option>
				<option value="4">4</option>
				<option value="3">3</option>
				<option value="2">2</option>
				<option value="1">1</option>
			</select>
			</h4>
		</div>
		<div id="colPeliculas">
			<ol>
				<li><!-- falta poner aqui direccion de la vista para cada peli-->
					<a href="">Titulo: Del Revés</a>
					<img class="imgPeli" src="../img/delreves.jpg"/>
					<p>pequeña sinopsis</p>
					<p>Puntuación: 9/10</p>
				</li>
				<li><!-- falta poner aqui direccion de la vista para cada peli-->
					<a href="">Titulo: Pulp Fiction</a>
					<img class="imgPeli" src="../img/delreves.jpg"/>
					<p>pequeña sinopsis</p>
					<p>Puntuación: 9/10</p>
				</li>
				<li><!-- falta poner aqui direccion de la vista para cada peli-->
					<a href="">Titulo: Avatar</a>
					<img class="imgPeli" src="../img/delreves.jpg"/>
					<p>pequeña sinopsis</p>
					<p>Puntuación: 9/10</p>
				</li>
				<li><!-- falta poner aqui direccion de la vista para cada peli-->
					<a href="">Titulo: Star Wars VII</a>
					<img class="imgPeli" src="../img/starwarsvii.jpg"/>
					<p>pequeña sinopsis</p>
					<p>Puntuación: 9/10</p>
				</li>
			</ol>
		</div>
	</div>
	<?php
		include('footer.php');
	?>
	</body>
</html>