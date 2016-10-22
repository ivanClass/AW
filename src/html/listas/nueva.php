<?php
	require_once '../../includes/config.php';

?>
<!DOCTYPE html>
<html>
	<head>
	  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  	<title>Trivial</title>
		<link href="<?= $app->resuelve('/css/estilo2col.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/nueva.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/listas_sidebar.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/lista_peliculas.css') ?>" rel="stylesheet" type="text/css">

		<link href="<?= $app->resuelve('/css/header.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/footer.css') ?>" rel="stylesheet" type="text/css">
		<link href="<?= $app->resuelve('/css/icomoon/style.css') ?>" rel="stylesheet" type="text/css">

		<link rel="icon" href="<?= $app->resuelve('/img/icon.png') ?>">
		<script type="text/javascript" src="<?= $app->resuelve('/js/jquery-2.2.3.min.js') ?>"></script>
		<script type="text/javascript">
			$(document).ready(function() {
		
				$("#search").click(function(){
					var	url="http://www.omdbapi.com/?s="+$("#search_text").val()+"&y=&plot=short&r=json";
					var tabla = $("#table_body");
					tabla.empty();
						$.get(url,function(data,status){
								if(status == "success"){
								var resultados = data['Search'];
								for(var i=0; i < resultados.length; i++){
								var imagen;
								if($("#peliculas").find("#"+resultados[i]['imdbID']).length) imagen = "<?= $app->resuelve('/img/check.png') ?>";
								else imagen = "<?= $app->resuelve('/img/add2.png') ?>";
								tabla.append('<tr id="'+resultados[i]['imdbID']+'" >' +
								'<td class="poster_imdb"><img  src="'+resultados[i]['Poster']+'" /> </td>'+
								'<td class="titulo_busqueda"><h2>'+resultados[i]['Title']+"<h2></td>"+
								'<td class="year_busqueda"><h3>'+resultados[i]['Year']+"</h3></td>"+
								'<td class="celda_botones">'+
												'<img class="addToList" src="'+imagen+'"/>'+
										'</td>'+
								"</tr>");
								
								}

																							
						}
							$(".addToList").click(function(){	
								var peli = $(this).parent().parent();
								$("#peliculas").append('<div class="pelicula" id="'+peli.attr("id")+'">'+
														'<table class="cuadro_pelicula">'+
															'<tbody>'+
																'<tr>'+
																
																	'<td class="celda_foto">'+ peli.find(".poster_imdb").html()+'</td>'+
																	'<td class="celda_titulo">'+ peli.find(".titulo_busqueda").html()+'</td>'+
																		'<td class="celda_anio"> '+ peli.find(".year_busqueda").html()+'</td>'+
																		'<td class="celda_puntuacion"> 7.8 </td>'+
																	'<td class="celda delete"> '+
																	'<img class="delete" src="<?= $app->resuelve('/img/delete.png') ?>" />'+
																		'</form>	</td> </tr></tbody></table></div>');
																		
																		
								$(this).attr("src","<?= $app->resuelve('/img/check.png') ?>");		
								$(this).unbind("click");
								
								$(".delete").click(function(){
									
									$(this).parent().parent().parent().parent().parent().remove();
									
								})		;								
																		
																		
							});
						
						})	;
				});
				
				
				$("#guardar").click(function(){
					var idArray = new Array();
					var nombre = $("#nombre_lista").val();
					$(".pelicula").each(function(){
						
						idArray.push($(this).attr("id"));
						
					});
					$.ajax({
						type: "POST",
						url: '<?= $app->resuelve('/html/listas/crearLista.php') ?>',
						data: {name: nombre,ids: idArray},
						success: function(response){
							location.replace("lista.php?id="+response+"&name="+nombre);
						},
						error: function(xhr,ajaxOptions,thrownError){
							alert("esto no va");
						}
					
					
					
					});
				});
			});




</script>
	</head>
	<body>
		<?php
			$app->doInclude('comun/header.php');
		?>
		<div id="contenedor">
		<?php
			$app->doInclude('/comun/listas_sidebar.php');
		?>
			
				<div id = "listas">
					<div id="barra_superior">
					<form id="titulo">
						<input type="text" id="nombre_lista" name="titulo" value= "Nueva Lista">
					</form>
					<a href="#openModal" id ="anadir">
						<img src="<?= $app->resuelve('/img/add.png') ?>">
					</a>
					</div>
					<div id="peliculas">
					
					
					
					
					</div>
				
					
					
						<button id="guardar"> Guardar </button>

				</div>
			

		</div>
		<?php
			$app->doInclude('comun/footer.php');
		?>
		<div id="openModal" class="modalDialog">
					<div id="modalContent">
						<a href="#close" title="Close" class="close">X</a>
						<div id="content">
							<h1>IMDb Information</h1>
							<input type="text" name="enter" class="enter" value="" id="search_text"/>
							<input type="button" value="Buscar" id="search" />
							<table class="table table-hover" id="addinfo">
								<thead>
									<tr>
										<th id="poster_header">Poster</th>
										<th >Title</th>
										<th >Year</th>
					
										<th id="celda_vacia"></th>
									</tr>
								</thead>
								<tbody id="table_body">
							
								</tbody>
							</table>
							
						</div>
						
					</div>
			</div>
	</body>
</html>