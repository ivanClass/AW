<?php
	$ruta = RUTA_APP;
	$rutaRegistro = RUTA_HTML.'registro.php';
	$rutaPerfil = RUTA_HTML.'perfil_usuario.php';
	$rutaLoginPhp = RUTA_INCLUDES.'login.php';
	$rutaLogoutPhp = RUTA_INCLUDES.'logout.php';
	$rutaImagenLogo = RUTA_IMGS.'LOGO.png';
	$rutaLoginScript = RUTA_JS.'login.js';
	$rutaJquery = RUTA_JS.'jquery-2.2.3.min.js';
	$app = es\ucm\fdi\aw\Aplicacion::getSingleton();
	$bloqueComunInicio = <<<EOF
	<div id="header">
		<script type="text/javascript" src="$rutaLoginScript"></script>
		<script type="text/javascript" src="$rutaJquery"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#iniciarsesion").click(function(){
					var usu = $("#username").val();
					var psw = $("#password").val();
					$.ajax({
						url: '$rutaLoginPhp',
						data: {usuario: usu  , contrasena: psw},
						type: "POST",
						error: function(){
							alert("Problemas en el envío del formulario")
						},
						success: function(data,status){
							jQuery.each(data, function(i, val) {
								alert(data);
							});
							
							location.reload();

						}
					})
				});
				$("#logout").click(function(){
					$.ajax({
						url: '$rutaLogoutPhp',
						type: "POST",
						error: function(){
							alert("Problemas en el envío del formulario")
						},
						success: function(data,status){
							location.reload();

						}
					});
				});
				$("#registro").click(function(){
					location.replace("{$app->resuelve('/html/usuarios/registro.php')}");
				});
			})	
		</script>
	

		<div id="menuHeader">
			<ul class="dropdown">
				<a href="$ruta"><img id="logo" src="$rutaImagenLogo" alt="Moviect" height="60" width="auto"/></a>
				<li class="menu"><a href="{$app->resuelve('/html/listas/listas.php')}?type=novedades">Listas</a></li>
				<li class="menu"><a href="{$app->resuelve('/html/noticias/noticias.php')}">Noticias</a></li>
				<li class="menu">
				<a href="{$app->resuelve('/html/trivial/trivial.php')}">Trivial</a>

				</li>
				<li class="menu">
				<a href="{$app->resuelve('/html/foro/foro.php')}">Foro</a>
				</li>
EOF;

	$bloqueEspecificoAdmin = <<<EOF
				<li class="menu">
					<a href="{$app->resuelve('/html/admin/admin_panel.php')}?page=users">Administración</a>
				</li>
EOF;

	$bloqueEspecificoEditorNoticias = <<<EOF
				<li class="menu">
					<a href="{$app->resuelve('/html/editor/editorNoticias.php')}">Administración</a>
				</li>
EOF;

	$bloqueComunFinal = <<<EOF
				<li id="menu5" class="menu" onclick="mostrarLogin()">Login
				</li>
			</ul>
		</div>
		<div id="login" class="dialogo">
		
		<button id="bttnX" onclick="esconderLogin()">X</button>
		
		
		<div class="bordesInteriores">
			<div class="cabecera">
				<span class="titulo">Iniciar sesión </span>
			</div>
		
			<div class="cuerpo">
				<div class = "divSesionIzq">
						<p class="pSesion"> Usuario</p>
						<p class="pSesion"> Contraseña</p>
				</div>
				<div class = "divSesionDer">
					<form method="POST" id="formularioLogin" name="formularioLogin" onsubmit="return false;">
						<input type="text" class="inputRedondeados"
							id="username"
							placeholder="Nombre de usuario">
						 <input type="password" class="inputRedondeados"
						id="password" placeholder="Contraseña">						
						<div class="checkbox">	
							<button  id="iniciarsesion" class="bttnLogin">Iniciar sesión</button>
							<button  id="registro" class="bttnLogin">Registro</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div id="oscurecer" class="oscurecer"></div>
</div>
EOF;

	$bloquePerfil = <<<EOF
				<li id="perfil" class="menu"> Mi Perfil
					<ul class="dropdown-content">
						<li class="liMe"><a href="{$app->resuelve('/html/usuarios/perfil_usuario.php')}">· Mi Perfil </a></li>
						<li class="liMe"><a href="{$app->resuelve('/html/usuarios/misMensajes.php')}">· Mis mensajes</a></li>
					</ul>
				</li>
			
		
	

EOF;

	$bloqueLogout = <<<EOF
				<li id="logout" class="menu">Logout
				</li>
			</ul>
		</div>
	</div>
</div>
EOF;



?>

<?php
	echo $bloqueComunInicio;


	if(es\ucm\fdi\aw\Aplicacion::getSingleton()->usuarioLogueado()){
		echo $bloquePerfil;
		if(es\ucm\fdi\aw\Aplicacion::getSingleton()->tieneRol('ADMINISTRADOR')){
			echo $bloqueEspecificoAdmin;
		}
		else{
			if(es\ucm\fdi\aw\Aplicacion::getSingleton()->tieneRol('EDITOR')){
					echo $bloqueEspecificoEditorNoticias;
			}

		}

		echo $bloqueLogout;

	}
	else{
		echo $bloqueComunFinal;	
		//eclipse pdt --depurar php
	}
?>	