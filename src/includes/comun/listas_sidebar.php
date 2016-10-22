	<div id="left_sidebar">
					<ul>
						<li><a href="listas.php?type=top"> Top listas </a></li>
						<?php
							$app = es\ucm\fdi\aw\Aplicacion::getSingleton();
							if($app->usuarioLogueado()){
								echo <<<EOF

						<li><a href="listas.php?type=fav"> Mis favoritas </a></li>
						<li><a href="listas.php?type=mine"> Mis listas </a></li>			
						<li><a href="nueva.php"> Nueva lista </a></li>
EOF;
							}
						?>
					</ul>					
				</div>