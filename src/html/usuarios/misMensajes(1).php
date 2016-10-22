<?php
	require_once '../../includes/config.php';
?>
<!DOCTYPE html>
<html>
	<head>
	  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  	<title>Mis mensajes</title>
	  	<link href="<?= $app->resuelve('/css/misMensajes.css') ?>" rel="stylesheet" type="text/css">
	  	<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/pelicula_estilo.css') ?>" rel="stylesheet" type="text/css">


		<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
		<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(window).on('hashchange', function() {
				  	var hash = location.hash;
					  $("#menu a").each(function() {
					  	var that = $( this );
					  	var parent = that.parent();

					  	if(that.attr( "href" ) === hash){
					  		parent.css("background-color", "#A374CD");
					  	}
					  	else{
					  		parent.css("background-color", "transparent");
					  	}
					  });

					  
					  if(hash === "#recibidos"){
					        $.ajax({
					            type: "GET",
					            url: "<?= $app->resuelve('/html/usuarios/cargarListaMensajesRecibidos.php') ?>",
								error: function(){
									alert("Problemas en el envío del formulario");
								},
					            success: function(data) {
					            	$("#tableMensajes tr").remove();
					            	if(data != "[]"){
						            	$("#tableMensajes").append(data);
						            }
					            }
					        });
					  }

					  if(hash==="#enviados"){
					        $.ajax({
					            type: "GET",
					            url: "<?= $app->resuelve('/html/usuarios/cargarListaMensajesEnviados.php') ?>",
								error: function(){
									alert("Problemas en el envío del formulario");
								},
					            success: function(data) {
					            	$("#tableMensajes tr").remove();
					            	if(data != "[]"){
						            	$("#tableMensajes").append(data);
						            }
					            }
					        });
					  }
					  
				});

				$('#tableMensajes').on('click', '.edit_user', function(){
    				var that = $( this );
    				var parent = that.parent().parent().parent();
    				var mensaje = 'id='+parent.attr("id");

			        $.ajax({
			            type: "GET",
			            url: "<?= $app->resuelve('/html/usuarios/dameInfoMensaje.php') ?>",
			            data: mensaje,
						error: function(){
							alert("Problemas en el envío del formulario");
						},
			            success: function(data) {
			            	var json = JSON.parse(data);
			            	$('#emisorv').val(json[0]);
			            	$('#receptorv').val(json[1]);
			            	$('#asuntov').val(json[2]);
			            	$('#mensajev').val(json[3]);
			            	$("#emisorv").change();
			            	$("#receptorv").change();
			            }
			        });
				});

				$('#tableMensajes').on('click', '.delete_user', function(){
    				var that = $( this );
    				var parent = that.parent().parent();
    				var mensaje = parent.attr("id");

					$.ajax({
						url: "<?= $app->resuelve('/html/usuarios/borrarMensaje.php') ?>",
						type: "POST",
						data: {id: mensaje},
						error: function(){
							alert("Problemas en el envío del formulario")
						},
						success: function(data,status){
							parent.remove();
						}
					});
				});

				$('#send_btn').click(function(){
					var receptor = $('#receptor').val();
					var asunto = $('#asunto').val();
					var mensaje = $('#mensaje').val();
					if(existeUsuario!=false){
						$.ajax({
							url: "<?= $app->resuelve('/html/usuarios/enviarMensaje.php') ?>",
							data: {receptor: receptor, asunto: asunto, mensaje: mensaje},
							type: "POST",
							error: function(){
								alert("Problemas en el envío del formulario");
							},
							success: function(data,status){
						 		
						        $.ajax({
						            type: "GET",
						            url: "<?= $app->resuelve('/html/usuarios/cargarListaMensajesEnviados.php') ?>",
									error: function(){
										alert("Problemas en el envío del formulario");
									},
						            success: function(data) {
						            	alert("Mensaje enviado!");
										//CERRAR EL MODAL SI TODO VA BIEN ->$('.modal.in').modal('hide') 
										var hash = location.hash;
										if(hash==="#enviados"){
							            	$("#tableMensajes tr").remove();
							            	if(data != "[]"){
								            	$("#tableMensajes").append(data);
								            }
								        }

						            }
						        });
							}
						});
					}
					else{
						alert("El usuario no existe...")
					}
				});

				$('#send_btnv').click(function(){
					var receptor = $('#receptorv').val();
					var asunto = $('#asuntov').val();
					var mensaje = $('#mensajev').val();
					if(existeUsuarioRec!=false){
						$.ajax({
							url: "<?= $app->resuelve('/html/usuarios/enviarMensaje.php') ?>",
							data: {receptor: receptor, asunto: asunto, mensaje: mensaje},
							type: "POST",
							error: function(){
								alert("Problemas en el envío del formulario");
							},
							success: function(data,status){
						 		
						        $.ajax({
						            type: "GET",
						            url: "<?= $app->resuelve('/html/usuarios/cargarListaMensajesEnviados.php') ?>",
									error: function(){
										alert("Problemas en el envío del formulario");
									},
						            success: function(data) {
						            	alert("Mensaje enviado!");
										//CERRAR EL MODAL SI TODO VA BIEN ->$('.modal.in').modal('hide')
										var hash = location.hash;
										if(hash==="#enviados"){
							            	$("#tableMensajes tr").remove();
							            	if(data != "[]"){
								            	$("#tableMensajes").append(data);
								            }
								        }

						            }
						        });
							}
						});
					}
					else{
						alert("El receptor no existe...")
					}
				});
				jQuery.expr[':'].Contains = function(a,i,m){
		      		return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
		  		};

				var input = $("#search");
			    $(input)
			      .change( function () {
			        var filter = $(this).val();
			        if(filter) {
			 	  
					  $matches = $("#tableMensajes").find('td:Contains(' + filter + ')').parent();
					  $('tr', "#tableMensajes").not($matches).slideUp();
					  $matches.slideDown();
					}
			        else{
			        	$("#tableMensajes").find("tr").slideDown();
			        }
			        return false;
			      })
			    .keyup( function () {
			        // fire the above change event after every letter
			        $(this).change();
			    });

				var inputReceptor = $("#receptor");
			    $(inputReceptor)
			      .change( function () {
			        var receptor = 'nick='+$(this).val();
					$.ajax({
						url: "<?= $app->resuelve('/html/usuarios/existeUsuario.php') ?>",
						type: "GET",
						data: receptor,
						error: function(){
							alert("Problemas en el envío del formulario")
						},
						success: function(data,status){
							if(data=='1'){
								existeUsuario=true;
								$( "#recIcon" ).removeClass( "glyphicon glyphicon-remove-sign" ).addClass( "glyphicon glyphicon-ok-sign");
							}
							else{
								existeUsuario=false;
								$( "#recIcon" ).removeClass( "glyphicon glyphicon-ok-sign" ).addClass( "glyphicon glyphicon-remove-sign");
							}
						}
					});
			      })
			    .keyup( function () {
			        // fire the above change event after every letter
			        $(this).change();
			    });
		
				var inputEmisorVer = $("#emisorv");
			    $(inputEmisorVer)
			      .change( function () {
			        var receptor = 'nick='+$(this).val();
					$.ajax({
						url: "<?= $app->resuelve('/html/usuarios/existeUsuario.php') ?>",
						type: "GET",
						data: receptor,
						error: function(){
							alert("Problemas en el envío del formulario")
						},
						success: function(data,status){
							if(data=='1'){
								$( "#emiIconVer" ).removeClass( "glyphicon glyphicon-remove-sign" ).addClass( "glyphicon glyphicon-ok-sign");
							}
							else{
								$( "#emiIconVer" ).removeClass( "glyphicon glyphicon-ok-sign" ).addClass( "glyphicon glyphicon-remove-sign");
							}
						}
					});
			      })
			    .keyup( function () {
			        // fire the above change event after every letter
			        $(this).change();
			    });

				var inputReceptorVer = $("#receptorv");
			    $(inputReceptorVer)
			      .change( function () {
			        var receptor = 'nick='+$(this).val();
					$.ajax({
						url: "<?= $app->resuelve('/html/usuarios/existeUsuario.php') ?>",
						type: "GET",
						data: receptor,
						error: function(){
							alert("Problemas en el envío del formulario")
						},
						success: function(data,status){
							if(data=='1'){
								existeUsuarioRec=true;
								$( "#recIconVer" ).removeClass( "glyphicon glyphicon-remove-sign" ).addClass( "glyphicon glyphicon-ok-sign");
							}
							else{
								existeUsuarioRec=false;
								$( "#recIconVer" ).removeClass( "glyphicon glyphicon-ok-sign" ).addClass( "glyphicon glyphicon-remove-sign");
							}
						}
					});
			      })
			    .keyup( function () {
			        // fire the above change event after every letter
			        $(this).change();
			    });

				location.hash="#recibidos";
			});
</script>

	</head>
	<body>

		<?php
			$app->doInclude('comun/header.php');
		?>


		<div id="contenedor">
			<?php
			if(!isset($_SESSION['idUser'])){
				echo  "<p id=\"warning\"> Registrate o identificate por favor :) </p>";
			}else{
			?>
				<div id="left_sidebar">
					<table id="menu">
						<tr class="categoria" ><td><a href="#myModal" role="button" class="btn btn-custom" data-toggle="modal">Redactar</a></td></tr>
					<?php
						echo <<<EOF
						<tr class="categoria" ><td id="pulsada"><a href="#recibidos" id="recBtn"> Recibidos </a></td></tr>
EOF;
						echo <<<EOF
						<tr class="categoria"><td><a href="#enviados" id="enviBtn"> Enviados </a></td></tr>
EOF;
					?>
					</table>					
				</div>
			
				<div id = "content">
				<div id = "listas">
					<form id = "buscar">
						<input type="text" name="search" id="search">
					</form>
			<div id="table-wrapper">
				<div id="table-scroll">
					<table id="tableMensajes">
					</table>
				</div>
			</div>			
				</div>
				</div>
		</div>
		 <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		        <div class="modal-dialog">
		        <div class="modal-content">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		            <h4 class="modal-title">Redactar</h4>
		        </div>
		        <div class="modal-body" id="modal-body">
		                <div class="form-group">
		                    <label class="control-label col-md-2" for="receptor">Receptor</label>
		                    <div class="col-md-10 input-group">
		                    	<input type="text" class="form-control" id="receptor" name="receptor" placeholder="destinatario"/>
					            <span class="input-group-addon">
					                <i id="recIcon" class="glyphicon glyphicon-remove-sign"></i>
					            </span>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2" for="asunto">Asunto</label>
		                    <div class="col-md-10 input-group">
		                        <input type="text" class="form-control" id="asunto" name="asunto" placeholder="asunto"/>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="contrl-label col-md-2" for="mensaje">Mensaje</label>
		                    <div class="col-md-10 input-group">
		                        <textarea rows="10" class="form-control" id="mensaje" name="mensaje" placeholder="Mensaje"></textarea>
		                    </div>
		                </div>
		                <div class="form-group text-center">
		                	<div class="col-md-2">
		                	</div>
		                    <div class="col-md-10">
		                        <button type="submit" value="Submit" class="btn btn-custom text-center" id="send_btn">Enviar</button>
		                    </div>
		                </div>
		        </div><!-- End of Modal body -->
		        </div><!-- End of Modal content -->
		        </div><!-- End of Modal dialog -->
		    </div><!-- End of Modal -->
		 <div id="myModalVer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		        <div class="modal-dialog">
		        <div class="modal-content">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		            <h4 class="modal-title">Ver correo</h4>
		        </div>
		        <div class="modal-body" id="modal-body">
		                <div class="form-group">
		                    <label class="control-label col-md-2" for="emisor">Emisor</label>
		                    <div class="col-md-10 input-group">
		                    	<input type="text" class="form-control" id="emisorv" name="emisorv" placeholder="emisor"/>
					            <span class="input-group-addon">
					                <i id="emiIconVer" class="glyphicon glyphicon-remove-sign"></i>
					            </span>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2" for="receptor">Receptor</label>
		                    <div class="col-md-10 input-group">
		                    	<input type="text" class="form-control" id="receptorv" name="receptorv" placeholder="destinatario"/>
					            <span class="input-group-addon">
					                <i id="recIconVer" class="glyphicon glyphicon-remove-sign"></i>
					            </span>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-md-2" for="asunto">Asunto</label>
		                    <div class="col-md-10 input-group">
		                        <input type="text" class="form-control" id="asuntov" name="asuntov" placeholder="asunto"/>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="contrl-label col-md-2" for="mensaje">Mensaje</label>
		                    <div class="col-md-10 input-group">
		                        <textarea rows="10" class="form-control" id="mensajev" name="mensajev" placeholder="Mensaje"></textarea>
		                    </div>
		                </div>
		                <div class="form-group text-center">
		                	<div class="col-md-2">
		                	</div>
		                    <div class="col-md-10 input-group">
		                        <button type="submit" value="Submit" class="btn btn-custom text-center" id="send_btnv">Enviar</button>
		                    </div>
		                </div>
		        </div><!-- End of Modal body -->
		        </div><!-- End of Modal content -->
		        </div><!-- End of Modal dialog -->
		    </div><!-- End of Modal -->
		<?php
			}
			echo '</div>';
		?>		
	<?php
		$app->doInclude('comun/footer.php');
	?>
	</body>

</html>