<?php
	$rutaAcercaDe = RUTA_HTML.'informacion/acercade.php';
	$rutaContacto = RUTA_HTML.'informacion/contactoweb.php';
	$bloqueFooter = <<<EOF
	<div id="footer">
		<a href = "$rutaAcercaDe" class="enlFoot"> Acerca de... </a>
	</div>
EOF;
?>
<?php
	echo $bloqueFooter;
?>
