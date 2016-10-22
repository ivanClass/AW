<?php
	require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title>Acerca de</title>
	<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/acercade.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">

	<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
</head>

<body>
	
	<?php
		$app->doInclude('comun/header.php');
	?>
	<div id="contenedor">
	<h1>Miembros Moviect</h1>
	<ol>
		<li><a href="#ivan"> Iván Aguilera Calle</a></li>
		<li><a href="#julio"> Julio Galilea Moreno</a></li>
		<li><a href="#daniel"> Daniel García Moreno</a></li>
		<li><a href="#veronica"> Verónica Morante Pindado</a></li>
		<li><a href="#marcel"> Marcel Sandoval Rosales</a></li>
	</ol>
	
	<div class="items" id="ivan">
	 	<img src="<?= $app->resuelve('/img/ivan.png') ?>">
	 	<p><strong>Nombre:</strong> Iván Aguilera Calle</p>
	 	<p><strong>Correo:</strong> ivanag01@ucm.es</p>
	 	<p><strong>Descripción:</strong> Forofo de las Tecnologías, me gusta viajar a otros sitios, amante de los videojuegos, de la música y del cine. Miembro de CrackOS y participante del CoreWar.</p>	
	</div>
	<div class="items" id="julio">
	 	<img src="<?= $app->resuelve('/img/julio.png') ?>">
	 	<p><strong>Nombre:</strong> Julio Galilea Moreno</p>
	 	<p><strong>Correo:</strong> jgmoreno@ucm.es </p>
	 	<p><strong>Descripción:</strong> Soy aficionado al baloncesto, a explorar Madrid en bici, y a todo tipo de música con una batería, un bajo y una buena guitarra.</p>	
	</div>
	<div class="items" id="daniel">
	 	<img src="<?= $app->resuelve('/img/daniel.png') ?>">
	 	<p><strong>Nombre:</strong> Daniel García Moreno</p>
	 	<p><strong>Correo:</strong> daniel10@ucm.es</p>
	 	<p><strong>Descripción:</strong> Gusto por los buenos juegos y películas, mi proyector me acompaña allá donde vaya. Antiguo arquitecto de Lego, me gustan las cosas bonitas y las playas con olas.</p>	
	</div>
	
	<div class="items" id="veronica">
	 	<img src="<?= $app->resuelve('/img/veronica.png') ?>">
	 	<p><strong>Nombre:</strong> Verónica Morante Pindado</p>
	 	<p><strong>Correo:</strong> vmorante@ucm.es</p>
	 	<p><strong>Descripción:</strong>Aficionada al deporte,me encanta escuchar todo tipo de música.Fan de ver peliculas y series ,principalmente americanas</p>	
	</div>
	<div class="items" id="marcel">
	 	<img src="<?= $app->resuelve('/img/marcel.png') ?>">
	 	<p><strong>Nombre:</strong> Marcel Sandoval Rosales</p>
	 	<p><strong>Correo:</strong> marcelrs@ucm.es</p>
	 	<p><strong>Descripción:</strong> Me gusta practicar cualquier tipo de deporte en equipo, fanático de las películas y adicto a las series. Aficionado del Real Madrid aunque aprecio el buen fútbol sin importar los colores.</p>	
	</div>

	</div>
	<?php
		$app->doInclude('comun/footer.php');
	?>
</body>
</html>