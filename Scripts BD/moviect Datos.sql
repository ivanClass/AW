-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2016 a las 21:53:13
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `moviect`
--

--
-- Volcado de datos para la tabla `comentarios_foro`
--


INSERT INTO `usuarios` (`nick`, `correo`, `password`, `nombre`, `puntos`, `rol`, `descripcion`) VALUES
('admin', 'admin@ucm.es', '$2y$10$i0DuBcc3Fzep3u4Lfvm3t.9oJMbZEUrtQVuCifaUTbdbbkurqDCXy', 'admin', 25, 'ADMINISTRADOR', 'Es el administrador de la web'),
('editor', 'editor@ucm.es', '$2y$10$n3KS5xBr8Cp0UsAE7JV1lOmJ66oIg81qjAO7DiGZjf12Hk83n8dnC', 'editor', 5, 'EDITOR', 'Editor de noticas de la aplicación'),
('ivanafggg', 'sdfsd@gmail.com', '$2y$10$HEEq4VoHURWfFYIacQDLluSxmJ0sPMD92X0pnvcCM13/ufrLGd.Rm', 'ivaaaan', 0, 'ADMINISTRADOR', ''),
('marcel', 'marcel@ucm.es', '$2y$10$bhjzkl1si6G5U21PeMs0SuKw5dkmAA/O7utXx6H6m7gXXpgOgxgZq', 'marcel', 10, 'REGISTRADO', ''),
('RTRYY', 'tyry@ucm.es', '$2y$10$yX92pSvNO/i8NBsBvwATduvW7qhoSr4rWoZLoCT3u6pK9bgcuV.N6', 'RTYRT', 0, 'EDITOR', ''),
('usuario3', 'usuario3@ucm.es', '$2y$10$jc9o3HJaQOXL4UX3ea2ryuYjZfMoV3dpQIG7JoaBIJQ0CooifJ4wy', 'Usuario', 0, 'EDITOR', ''),
('vero', 'v@ucm.com', '$2y$10$vJwZIy5MBOhg48Sf9oSWhOcxkrsJJjDsUj4CfQXogiRHGdfjOjmQ2', 'vero', 0, 'REGISTRADO', ''),
('yoli78', 'yolig@ucm.es', '$2y$10$6Ftf72.NnYLIz5DUaIoW1OffuOuPTwKa44VvHxIJfYD2Zg0nUTV.O', 'Yolanda', 0, 'REGISTRADO', '');

INSERT INTO `foro` (`id_tema`, `titulo`, `creador`) VALUES
(1, 'peliculas', 'usuario3'),
(2, 'series', 'usuario3'),
(3, 'últimos estrenos', 'usuario3');

INSERT INTO `preguntas` (`id_pregunta`, `enunciado`, `autor`) VALUES
(1, '¿En qué año nació Marilyn Monroe?', 'usuario3'),
(2, '¿Quién fue la película ganadora de los Oscars 2016?', 'usuario3'),
(3, '¿De qué origen es la película Guerra y Paz, catalogada como la más cara del siglo XX?', 'yoli78'),
(12, '¿Cuál es el filme que causó mayor terror en la historia de este género?', 'usuario3'),
(13, '¿Cuál ha sido la película más larga del cine mundial?', 'vero'),
(15, '¿cuál es la segunda película más taquillera de la historia?', 'vero'),
(16, '¿Cuál ha sido la película menos exitosa en taquilla en la historia del cine hollywoodense?', 'yoli78'),
(17, '¿Cuál ha sido el filme en el que participó mayor cantidad de extras en la historia del cine mundial?', 'editor'),
(18, '¿Cuál es la saga cinematográfica más exitosa en recaudación?', 'vero'),
(19, '¿Cuál ha sido la película con mayor cantidad de palabras censuradas del cine?', 'vero');

INSERT INTO `noticias` (`id_noticia`, `titulo`, `contenido`, `fecha`, `autor`, `leido`) VALUES
(163, '''Star Wars'': ¿Rechazó Ben Affleck dirigir ''El despertar de la Fuerza''?', '<p><a href="http://www.sensacine.com/actores/actor-1193/">Ben Affleck</a>&nbsp;se ha convertido en noticia recientemente y no precisamente por su interpretaci&oacute;n de Batman en el&nbsp;<strong>Universo Cinem&aacute;tico de DC</strong>. El actor y director ha sido uno de los &uacute;ltimos invitados al programa de Bill Simmons llamado&nbsp;<em>Any Given Wednesday</em>&nbsp;en el que ha hablado de diferentes temas y tambi&eacute;n ha contado el&nbsp;<a href="http://www.sensacine.com/noticias/cine/noticia-18543364/">momento m&aacute;s duro de su carrera y c&oacute;mo logr&oacute; superarlo</a>. Sin embargo, tambi&eacute;n ha dejado unas declaraciones que han hecho a algunos pensar que podr&iacute;a haber sido uno de los candidatos para colocarse detr&aacute;s de las c&aacute;maras en&nbsp;<em><a href="http://www.sensacine.com/peliculas/pelicula-215097/">Star Wars: El despertar de la Fuerza</a></em>.&nbsp;<br />\n<br />\nSimmons le ha preguntado a Affleck si Lucasfilm le quer&iacute;a como director del<em>Episodio VII</em>&nbsp;de&nbsp;<em>La Guerra de las Galaxias</em>&nbsp;antes que a&nbsp;<strong>J.J. Abrams</strong>, a lo que el actor ha respondido de manera esquiva. &quot;Bueno, no ser&iacute;a capaz de dec&iacute;rtelo&quot;, comienza. &quot;<strong>No ser&iacute;a educado hablar de los trabajos que has rechazado</strong>. Pero tuve muchas ofertas&quot;, concluye.</p>\n\n<p>De ser cierto y de haber aceptado el importante trabajo como director de la nueva entrega de&nbsp;<em>Star Wars</em>, el Universo CInem&aacute;tico de DC ser&iacute;a muy diferente a lo que conocemos. Probablemente, Affleck no ser&iacute;a el encargado de dar vida a la nueva versi&oacute;n de Bruyce Wayne y su lugar lo podr&iacute;a haber ocupado&nbsp;<strong>Jeffrey Dean Morgan</strong>, quien fue uno de los rumoreados para dar vida al Caballero Oscuro en<em>Batman v Superman: El amanecer de la justicia</em>&nbsp;antes de que Affleck fichase por el papel. Adem&aacute;s, tiene sentido que le ofreciesen la direcci&oacute;n de<em>&nbsp;El despertar de la Fuerza</em>&nbsp;teniendo en cuenta que en 2013 -a&ntilde;o en el que se anunci&oacute; a J.J. Abrams como director del&nbsp;<em>Episodio VII</em>-, Affleck estaba recibiendo muy&nbsp;<strong>buenas &nbsp;criticas</strong>&nbsp;por su trabajo como realizador en&nbsp;<em><a href="http://www.sensacine.com/peliculas/pelicula-190267/">Argo</a></em>.</p>\n\n<p>Tras el estreno de&nbsp;<em>El despertar de la Fuerza</em>, ahora le toca el turno al primer &#39;spin-off&#39; de&nbsp;<em>La Guerra de las Galaxias</em>&nbsp;titulado&nbsp;<em>Rogue One: Una historia de Star Wars</em>. La pel&iacute;cula,&nbsp;dirigida por&nbsp;<strong>Gareth Edwards</strong>, est&aacute; situado entre el&nbsp;<em>Episodio III</em>&nbsp;de la saga,<em>&nbsp;La Venganza de los Sith</em>,&nbsp;y el&nbsp;<em>Episodio IV</em>,&nbsp;<em>Una nueva esperanza</em>,&nbsp;y&nbsp;sigue&nbsp;a un grupo de rebeldes que se unen para cumplir la&nbsp;misi&oacute;n de&nbsp;<strong>robar los planos de la Estrella de la Muerte</strong>&nbsp;y llevar una nueva esperanza a la Galaxia. El reparto est&aacute; encabezado por Felicity Jones (Jyn Erso), Mads Mikkelsen (Galen Erso), Orson Krennic (Ben Mendelson), Alan Tudyk (K-2S0) y Diego Luna (Cassian Andor). La pel&iacute;cula llega a las salas de cine el&nbsp;<strong>16 de diciembre</strong>. A continuaci&oacute;n, echa un vistazo al tr&aacute;iler.</p>\n', '2016-06-26 17:04:12', 'editor', 2),
(164, 'RUMOR: 20th Century Fox está considerando un acuerdo con Marvel', '<p>Spider-Man ha conseguido formar parte del&nbsp;<strong>Universo Cinem&aacute;tico de Marvel</strong>gracias a un complicado acuerdo entre&nbsp;<strong>Sony</strong>&nbsp;y La Casa de las Ideas, pero puede que no sea la &uacute;nica uni&oacute;n que consiga el estudio que ha hecho posible pel&iacute;culas como&nbsp;<em>Capit&aacute;n Am&eacute;rica: Civil War</em>. Seg&uacute;n afirma&nbsp;<strong>Matt Key</strong>, el productor del podcast&nbsp;<em>Fatman on Batman</em>&nbsp;de Kevin Smith (v&iacute;a&nbsp;<em>Collider</em>),&nbsp;<strong>20th Century Fox</strong>podr&iacute;a estar pensando negociar un contrato con Marvel tras la aclamada versi&oacute;n que &eacute;stos han conseguido del nuevo Hombre Ara&ntilde;a interpretado por&nbsp;<a href="http://www.sensacine.com/actores/actor-588862/">Tom Holland</a>.&nbsp;<br />\n<br />\n&quot;He escuchado de boca de algunas de mis fuentes, mis pajaritos, que&nbsp;<strong>Fox y Marvel han... hablado un poco</strong>&quot;, afirma Key. &quot;Parece que hay inter&eacute;s por parte de Fox, en plan, &#39;Oh, sabes, lo que hicieron con Sony y Spider-Man es muy bueno, as&iacute; que, quiz&aacute;...&#39; Estamos a a&ntilde;os de que eso ocurra... pero creo que eso es lo que pasar&aacute;... Fox uniendo manos con Marvel&quot;, a&ntilde;ade.&nbsp;<br />\n<br />\nEn realidad, las declaraciones de Key son bastante escuetas en detalles y, por el momento, es preferible tomar estas palabras con precauci&oacute;n y considerarlas como una mera especulaci&oacute;n. Hace tiempo aparecieron ciertos rumores que indicaban que Fox iba a dejar en manos de Marvel los derechos de los&nbsp;<em><a href="http://www.sensacine.com/peliculas/pelicula-180999/">Cuatro Fant&aacute;sticos</a></em>&nbsp;tras las malas cr&iacute;ticas del &#39;reboot&#39; protagonziado por Kate Mara y Miles Teller. Posteriormente,&nbsp;<a href="http://www.sensacine.com/noticias/cine/noticia-18532703/">se confirm&oacute; que La Primera Familia de Marvel segu&iacute; estando en manos de Fox</a>. &iquest;Habr&aacute; cambiado el estudio de idea y veremos en un futuro un &#39;crossover&#39; entre Los Vengadores y los Cuatro Fant&aacute;sticos o los X-Men?&nbsp;</p>\n\n<p>Por el momento, el estudio ya est&aacute; planeando una nueva entrega del Universo de la Patrulla X con&nbsp;<em><a href="http://www.sensacine.com/peliculas/pelicula-237864/">The New Mutants</a></em>. Este proyecto es un &#39;spin-off&#39; que&nbsp;sigue a un grupo de nuevos mutantes que se inscriben en el colegio del profesor Charles Xavier para J&oacute;venes Talentos.&nbsp;<strong>Maisie Williams</strong>, Arya Stark en&nbsp;<em>Juego de Tronos</em>, podr&iacute;a ser una de las actrices que fiche por la pel&iacute;cula en el papel de Wolfsbane.&nbsp;Mientras se conocen m&aacute;s detalles de este posible accuerdo, echa un vistazo al tr&aacute;iler de&nbsp;<em>Deadpool</em>, cuya secuela comenzar&aacute; a rodarse a&nbsp;<strong>comienzos de 2017</strong>.</p>\n', '2016-06-26 17:06:24', 'editor', 1),
(165, 'Michael Herr, guionista de ''La chaqueta metálica'', muere a los 76 años', '<p><a href="http://www.sensacine.com/actores/actor-64507/">Michael Herr</a>&nbsp;ha fallecido este viernes en el New York Hospital, seg&uacute;n ha informado su publicista, Alfred A. Knopf. Herr era un periodista de guerra que se hizo muy conocido por su novela&nbsp;<strong><em>Dispatches</em></strong>&nbsp;sobre la guerra de Vietnam.&nbsp;</p>\n\n<p>Tras esto, y gracias a sus conocimientos en guerras, ayud&oacute; a Francis Ford Coppola con el guion de&nbsp;<a href="http://www.sensacine.com/peliculas/pelicula-27061/">Apocalypse Now</a>. Cinta que le valdr&iacute;a tambi&eacute;n el reconocimiento y la fama de los que a&uacute;n no conoc&iacute;an sus escritos, y que le pic&oacute; la curiosidad por el cine. Gracias a ella continu&oacute; muy ligado al s&eacute;ptimo arte con proyectos como&nbsp;<em>Leg&iacute;tima defensa, de John Grisham&nbsp;</em>o&nbsp;<a href="http://www.sensacine.com/peliculas/pelicula-2749/">La chaqueta met&aacute;lica</a><em>&nbsp;</em>-en esta &uacute;ltima figura como el guionista junto a Stanley Kubrick-.</p>\n\n<p>Herr deja a sus dos hijas, Catherine y Claudia y a dos hermanos, Steven Herr y Judy Bleyer -su esposa, Valerie falleci&oacute; hace tiempo-.</p>\n', '2016-06-26 17:08:23', 'editor', 0),
(166, '''Once Upon A Time'': Simbad y Scheherazade aparecerán en la sexta temporada', '<p><a href="http://www.sensacine.com/series/serie-9430/"><em>Once Upon a Time</em></a>&nbsp;est&aacute; comenzando a reclutar a los habitantes de&nbsp;<strong>la Tierra de las Historias No Contadas</strong>&nbsp;y lo hace con dos grandes personajes.</p>\n\n<p>Seg&uacute;n informa&nbsp;<em>TVLine</em>, la serie est&aacute; buscando ya a los actores que interpreten a<strong>Simbad y a Scheherazade</strong>&nbsp;en la sexta temporada que reci&eacute;n han llegado a Storybrooke gracias a un acuerdo de Mr. Hyde con Rumplestiltskin.</p>\n\n<p>La sexta temporada de<em>&nbsp;Once Upon a Time</em>&nbsp;explorar&aacute; m&aacute;s famosos personajes de la literatura como&nbsp;<a href="http://www.sensacine.com/noticias/series/noticia-18542133/" target="_blank">podr&iacute;a ser Don Quijote</a>. Mientras tanto, recuerda que los creadores de la serie de ABC tiene pendiente de estreno&nbsp;<em>Dead of Summer</em>, la serie de terror de Freeform que se estrenar&aacute;&nbsp;<strong>el pr&oacute;ximo 28 de junio</strong>.</p>\n', '2016-06-26 17:15:10', 'editor', 0),
(167, '''Juego de Tronos'': ''The Winds of Winter'' (6x10) contará con la aparición de casi todos los protagonistas', '<p>El final de la sexta temporada de&nbsp;<a href="http://www.sensacine.com/series/serie-7157/">Juego de Tronos</a>&nbsp;est&aacute; a la vuelta de la esquina con un episodio que durar&aacute; nada menos que 69 minutos donde al parecer habr&aacute; tiempo de contar con&nbsp;<strong>varios de sus protagonistas.</strong></p>\n\n<p>Seg&uacute;n informa&nbsp;<em>EW</em>, el &uacute;ltimo cap&iacute;tulo de la exitosa serie de HBO&nbsp;<strong>&lsquo;The Winds of Winter&rsquo; (6x10)</strong>&nbsp;seguir&aacute; estando lleno de acci&oacute;n como &lsquo;Battle of the Bastards&rsquo; (6x09):</p>\n\n<p>&nbsp;</p>\n\n<blockquote>A diferencia de algunos de los episodios finales de Juego de Tronos que se emitieron despu&eacute;s de cap&iacute;tulos llenos de acci&oacute;n, este final de temporada definitivamente no ralentiza el ritmo. Contar&aacute; con casi todos los personajes principales para hacer una aparici&oacute;n con el juicio de Loras y Cersei como centro de la historia que adem&aacute;s cambiar&aacute; la pol&iacute;tica de Desembarco del Rey el pr&oacute;ximo a&ntilde;o. Pero la verdadera pregunta es si Bran volver&aacute; a la Torre de la Alegr&iacute;a.</blockquote>\n\n<p>&nbsp;</p>\n\n<p>Para verlo, habr&aacute; que esperar al&nbsp;<strong>pr&oacute;ximo 26 de junio</strong>&nbsp;que se estrenar&aacute; el esperado episodio &lsquo;The Winds of Winter&rsquo; (6x10) simult&aacute;neamente en Estados Unidos y en Espa&ntilde;a de la mano de Movistar +.</p>\n', '2016-06-26 17:17:23', 'editor', 2);


INSERT INTO `comentarios_foro` (`id_comentario`, `id_tema`, `autor`, `comentario`, `fecha`) VALUES
(1, 1, 'usuario3', 'Cuál es vuestra película preferida?', '2016-06-14 22:07:33'),
(2, 1, 'editor', 'Jumanji', '2016-06-14 22:08:10'),
(3, 1, 'usuario3', ' Avatar', '2016-06-23 17:11:14'),
(4, 1, 'usuario3', ' Avatar', '2016-06-23 17:11:33'),
(5, 3, 'usuario3', ' A', '2016-06-23 17:17:56'),
(6, 3, 'usuario3', ' ultima pelicula vista', '2016-06-23 17:25:03'),
(7, 3, 'usuario3', ' ¿que os parece buscando a dory?', '2016-06-23 17:30:46'),
(8, 3, 'admin', ' hola', '2016-06-23 20:59:14'),
(11, 1, 'admin', 's ', '2016-06-24 18:09:58'),
(12, 2, 'editor', ' Me encanta juego de tronos', '2016-06-26 18:58:45'),
(13, 3, 'marcel', ' A ver si estrenan ya escuadron suicida', '2016-06-26 19:01:35'),
(14, 2, 'marcel', ' Miraos una que se llama Peaky Blinders', '2016-06-26 19:02:07');

--
-- Volcado de datos para la tabla `comentarios_peliculas`
--



--
-- Volcado de datos para la tabla `foro`
--



--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`nick`, `puntuacion`) VALUES
('admin', 25),
('editor', 15),
('usuario3', 45),
('vero', 0);

--
-- Volcado de datos para la tabla `listas`
--

INSERT INTO `listas` (`id_lista`, `titulo`, `autor`) VALUES
(2, 'Las mejores', 'usuario3'),
(3, 'Muy buenas', 'marcel'),
(30, 'Lord Of The Rings', 'admin'),
(31, 'Harry Potter', 'admin'),
(33, 'The Hobbit', 'admin'),
(34, 'Esta es mi lista', 'ivanafggg'),
(35, 'Spider', 'ivanafggg'),
(36, 'Los Juegos del Hambre', 'admin');

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `emisor`, `receptor`, `asunto`, `contenido`, `fecha`, `delEmi`, `delRec`) VALUES
(127, 'admin', 'editor', 'Hola editor', 'Hola editor q', '2016-06-25 22:28:57', 0, 0),
(128, 'admin', 'editor', 'Hola editor', 'Hola editor quetal', '2016-06-25 22:29:21', 0, 0),
(131, 'admin', 'editor', 'hola otra vez', 'gola', '2016-06-26 08:00:43', 0, 0);

--
-- Volcado de datos para la tabla `mensajes_editor`
--

INSERT INTO `mensajes_editor` (`nombre`, `emailContacto`, `asunto`, `mensaje`) VALUES
('a', 'b', 'c', 'd'),
('erter', 'erter', 'ert', '<p>ertert</p>\n'),
('', '', '', ''),
('ertert', 'ertrete', 'erteter', '<p>ertertertetert</p>\n'),
('erter', 'ertert', 'ertert', '<p>retert</p>\n'),
('retert', 'ertert', 'ertert', '<p>ertertret</p>\n'),
('hola', 'hola', 'hgola', '<p>1234</p>\n'),
('Daniel', 'daniel10@ucm.es', 'No me depura el eclipse!!!!', '<p>Que no me depura el eclipse :(</p>\n');

--
-- Volcado de datos para la tabla `noticias`
--


--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id_opcion`, `texto`, `id_pregunta`, `correcta`) VALUES
(1, '1926', 1, 1),
(2, '1930', 1, 0),
(3, '1928', 1, 0),
(4, '1929', 1, 0),
(5, 'The revenant', 2, 0),
(6, 'The martian', 2, 0),
(7, 'Spotlight', 2, 1),
(8, 'Room', 2, 0),
(45, 'Rusia', 3, 1),
(46, 'Alemania', 3, 0),
(47, 'Estados Unidos', 3, 0),
(48, 'China', 3, 0),
(49, 'El exorcista', 12, 0),
(50, 'El esplandor', 12, 1),
(51, 'La matanza de Texas', 12, 0),
(52, 'Actividad Paranormal', 12, 0),
(53, 'Lo que el viento se llevo', 13, 0),
(54, 'Titanic', 13, 0),
(55, 'La cura para el insomnio', 13, 0),
(56, 'Cinematon', 13, 1),
(65, 'Titanic', 15, 1),
(66, 'El señor de los anilos', 15, 0),
(67, 'Avatar', 15, 0),
(68, 'Harry Potter', 15, 0),
(69, 'La delgada linea roja', 16, 0),
(70, 'La isla de las cabezas cortadas', 16, 1),
(71, 'Las ballenas de Agosto', 16, 0),
(72, 'La primera version de Ben Hur', 16, 0),
(73, 'Guerra y Paz', 17, 0),
(74, 'Espartaco', 17, 0),
(75, 'Metropolis', 17, 0),
(76, 'Ghandi', 17, 1),
(77, 'El señor de los anillos', 18, 0),
(78, 'James Bond', 18, 1),
(79, 'Star Wars', 18, 0),
(80, 'Crepusculo', 18, 0),
(81, 'El precio del poder', 19, 1),
(82, 'El padrino ', 19, 0),
(83, 'Milla 8', 19, 0),
(84, 'Dia de entrenamiento', 19, 0);

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id_partida`, `jugador1`, `jugador2`, `puntuacion1`, `puntuacion2`, `turno`) VALUES
(4, 'usuario3', 'editor', 0, 0, 'editor'),
(5, 'admin', 'usuario3', 7, 1, 'admin'),
(6, 'admin', 'usuario3', 6, 7, 'admin'),
(7, 'admin', 'editor', 4, 4, 'editor'),
(8, 'admin', 'editor', 1, 0, 'editor'),
(9, 'usuario3', 'editor', 1, 0, 'editor'),
(10, 'admin', 'usuario3', 2, 2, 'admin'),
(11, 'admin', 'editor', 0, 0, 'editor'),
(21, 'admin', 'usuario3', 1, 1, 'admin'),
(22, 'vero', 'usuario3', 2, 1, 'usuario3'),
(23, 'usuario3', 'editor', 0, 0, 'usuario3');

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`ID`, `titulo`, `duracion`, `year`, `director`, `sinopsis`, `trailer`, `pais`, `imagen`, `valoracion`) VALUES
('10', 'Jumnaji', 104, 1995, 'Joe Johnston', 'Después de 25 años atrapado en el juego de Jumanji, Alan se ve liberado. Pero ahí no acaban sus desventuras, dado que tendrá que seguir luchando para salvar a sus amigos, su casa y su ciudad de las horribles criaturas que salen del juego.', 'V7dbLKgQlN0', 'Estados Unidos', 'http://www.impawards.com/1995/posters/jumanji_ver2.jpg', '0'),
('tt0120737', 'The Lord of the Rings: The Fellowship of the Ring', 178, 2001, 'Peter Jackson', 'An ancient Ring thought lost for centuries has been found, and through a strange twist in fate has been given to a small Hobbit named Frodo. When Gandalf discovers the Ring is in fact the One Ring of the Dark Lord Sauron, Frodo must make an epic quest to the Cracks of Doom in order to destroy it! However he does not go alone. He is joined by Gandalf, Legolas the elf, Gimli the Dwarf, Aragorn, Boromir and his three Hobbit friends Merry, Pippin and Samwise. Through mountains, snow, darkness, forests, rivers and plains, facing evil and danger at every corner the Fellowship of the Ring must go. Their quest to destroy the One Ring is the only hope for the end of the Dark Lords reign!', 'https://www.youtube.com/watch?v=V75dMMIW2B4', 'New Zealand, USA', 'http://ia.media-imdb.com/images/M/MV5BNTEyMjAwMDU1OV5BMl5BanBnXkFtZTcwNDQyNTkxMw@@._V1_SX300.jpg', '8'),
('tt0167260', 'The Lord of the Rings: The Return of the King', 201, 2003, 'Peter Jackson', 'Gandalf and Aragorn lead the World of Men against Sauron''s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.', 'r5X-hFf6Bwo', 'USA, New Zealand', 'http://ia.media-imdb.com/images/M/MV5BMjE4MjA1NTAyMV5BMl5BanBnXkFtZTcwNzM1NDQyMQ@@._V1_SX300.jpg', '8'),
('tt0167261', 'The Lord of the Rings: The Two Towers', 179, 2002, 'Peter Jackson', 'While Frodo and Sam, now accompanied by a new guide, continue their hopeless journey towards the land of shadow to destroy the One Ring, each member of the broken fellowship plays their part in the battle against the evil wizard Saruman and his armies of Isengard.', 'LbfMDwc4azU', 'USA, New Zealand', 'http://ia.media-imdb.com/images/M/MV5BMTAyNDU0NjY4NTheQTJeQWpwZ15BbWU2MDk4MTY2Nw@@._V1_SX300.jpg', '8'),
('tt0241527', 'Harry Potter and the Sorcerer''s Stone', 152, 2001, 'Chris Columbus', 'This is the tale of Harry Potter, an ordinary 11-year-old boy serving as a sort of slave for his aunt and uncle who learns that he is actually a wizard and has been invited to attend the Hogwarts School for Witchcraft and Wizardry. Harry is snatched away from his mundane existence by Hagrid, the grounds keeper for Hogwarts, and quickly thrown into a world completely foreign to both him and the viewer. Famous for an incident that happened at his birth, Harry makes friends easily at his new school. He soon finds, however, that the wizarding world is far more dangerous for him than he would have imagined, and he quickly learns that not all wizards are ones to be trusted.', 'VyHV0BRtdxo', 'UK, USA', 'http://ia.media-imdb.com/images/M/MV5BMTYwNTM5NDkzNV5BMl5BanBnXkFtZTYwODQ4MzY5._V1_SX300.jpg', '7'),
('tt0295297', 'Harry Potter and the Chamber of Secrets', 161, 2002, 'Chris Columbus', 'Harry ignores warnings not to return to Hogwarts, only to find the school plagued by a series of mysterious attacks and a strange voice haunting him.', '1bq0qff4iF8', 'UK, USA, Germany', 'http://ia.media-imdb.com/images/M/MV5BMTcxODgwMDkxNV5BMl5BanBnXkFtZTYwMDk2MDg3._V1_SX300.jpg', '7'),
('tt0304141', 'Harry Potter and the Prisoner of Azkaban', 142, 2004, 'Alfonso Cuarón', 'Harry Potter is having a tough time with his relatives (yet again). He runs away after using magic to inflate Uncle Vernon''s sister Marge who was being offensive towards Harry''s parents. Initially scared for using magic outside the school, he is pleasantly surprised that he won''t be penalized after all. However, he soon learns that a dangerous criminal and Voldemort''s trusted aide Sirius Black has escaped from the Azkaban prison and wants to kill Harry to avenge the Dark Lord. To worsen the conditions for Harry, vile creatures called Dementors are appointed to guard the school gates and inexplicably happen to have the most horrible effect on him. Little does Harry know that by the end of this year, many holes in his past (whatever he knows of it) will be filled up and he will have a clearer vision of what the future has in store...', 'lAxgztbYDbs', 'UK, USA', 'http://ia.media-imdb.com/images/M/MV5BMTY4NTIwODg0N15BMl5BanBnXkFtZTcwOTc0MjEzMw@@._V1_SX300.jpg', '7'),
('tt0330373', 'Harry Potter and the Goblet of Fire', 157, 2005, 'Mike Newell', 'Harry''s fourth year at Hogwarts is about to start and he is enjoying the summer vacation with his friends. They get the tickets to The Quidditch World Cup Final but after the match is over, people dressed like Lord Voldemort''s ''Death Eaters'' set a fire to all the visitors'' tents, coupled with the appearance of Voldemort''s symbol, the ''Dark Mark'' in the sky, which causes a frenzy across the magical community. That same year, Hogwarts is hosting ''The Triwizard Tournament'', a magical tournament between three well-known schools of magic : Hogwarts, Beauxbatons and Durmstrang. The contestants have to be above the age of 17, and are chosen by a magical object called Goblet of Fire. On the night of selection, however, the Goblet spews out four names instead of the usual three, with Harry unwittingly being selected as the Fourth Champion. Since the magic cannot be reversed, Harry is forced to go with it and brave three exceedingly difficult tasks.', 'PFWAOnvMd1Q', 'UK, USA', 'http://ia.media-imdb.com/images/M/MV5BMTI1NDMyMjExOF5BMl5BanBnXkFtZTcwOTc4MjQzMQ@@._V1_SX300.jpg', '7'),
('tt0330994', 'Titanic: The Legend Goes On...', 90, 2000, 'Camillo Teti', 'An animated retelling of the worst passenger ship disaster in history. In this version, love blossoms between the upper-class Sir William and the blue-collar Angelica, who is hoping to find romance in America. At the same time, there are also a number of animal passengers, including talking dogs, cats and mice, who are also looking forward to arriving in the New World.', 'qvfU5gzAmHg', 'Italy', 'http://ia.media-imdb.com/images/M/MV5BMTg5MjcxODAwMV5BMl5BanBnXkFtZTcwMTk4OTMwMg@@._V1_SX300.jpg', '2'),
('tt0373889', 'Harry Potter and the Order of the Phoenix', 138, 2007, 'David Yates', 'After a lonely summer on Privet Drive, Harry returns to a Hogwarts full of ill-fortune. Few of students and parents believe him or Dumbledore that Voldemort is really back. The ministry had decided to step in by appointing a new Defence Against the Dark Arts teacher that proves to be the nastiest person Harry has ever encountered. Harry also can''t help stealing glances with the beautiful Cho Chang. To top it off are dreams that Harry can''t explain, and a mystery behind something Voldemort is searching for. With these many things Harry begins one of his toughest years at Hogwarts School of Witchcraft and Wizardry.', 'E9alT_nulIM', 'UK, USA', 'http://ia.media-imdb.com/images/M/MV5BMTM0NTczMTUzOV5BMl5BanBnXkFtZTYwMzIxNTg3._V1_SX300.jpg', '7'),
('tt0417741', 'Harry Potter and the Half-Blood Prince', 153, 2009, 'David Yates', 'In the sixth year at Hogwarts School of Witchcraft, and in both wizard and muggle worlds Lord Voldemort and his henchmen are increasingly active. With vacancies to fill at Hogwarts, Professor Dumbledore persuades Horace Slughorn, back from retirement to become the potions teacher, while Professor Snape receives long awaited news. Harry Potter, together with Dumbledore, must face treacherous tasks to defeat his evil nemesis.', 'jpCPvHJ6p90', 'UK, USA', 'http://ia.media-imdb.com/images/M/MV5BNzU3NDg4NTAyNV5BMl5BanBnXkFtZTcwOTg2ODg1Mg@@._V1_SX300.jpg', '7'),
('tt0903624', 'The Hobbit: An Unexpected Journey', 169, 2012, 'Peter Jackson', 'Bilbo Baggins is swept into a quest to reclaim the lost Dwarf Kingdom of Erebor from the fearsome dragon Smaug. Approached out of the blue by the wizard Gandalf the Grey, Bilbo finds himself joining a company of thirteen dwarves led by the legendary warrior, Thorin Oakenshield. Their journey will take them into the Wild; through treacherous lands swarming with Goblins and Orcs, deadly Wargs and Giant Spiders, Shapeshifters and Sorcerers. Although their goal lies to the East and the wastelands of the Lonely Mountain first they must escape the goblin tunnels, where Bilbo meets the creature that will change his life forever ... Gollum. Here, alone with Gollum, on the shores of an underground lake, the unassuming Bilbo Baggins not only discovers depths of guile and courage that surprise even him, he also gains possession of Gollum''s "precious" ring that holds unexpected and useful qualities ... A simple, gold ring that is tied to the fate of all Middle-earth in ways Bilbo cannot begin to know.', '9PSXjr1gbjc', 'USA, New Zealand', 'http://ia.media-imdb.com/images/M/MV5BMTcwNTE4MTUxMl5BMl5BanBnXkFtZTcwMDIyODM4OA@@._V1_SX300.jpg', '7'),
('tt0926084', 'Harry Potter and the Deathly Hallows: Part 1', 146, 2010, 'David Yates', 'Voldemort''s power is growing stronger. He now has control over the Ministry of Magic and Hogwarts. Harry, Ron, and Hermione decide to finish Dumbledore''s work and find the rest of the Horcruxes to defeat the Dark Lord. But little hope remains for the Trio, and the rest of the Wizarding World, so everything they do must go as planned.', 'Su1LOpjvdZ4', 'UK, USA', 'http://ia.media-imdb.com/images/M/MV5BMTQ2OTE1Mjk0N15BMl5BanBnXkFtZTcwODE3MDAwNA@@._V1_SX300.jpg', '7'),
('tt1132238', 'Fighting, Flying and Driving: The Stunts of Spider', 19, 2007, 'N/A', 'N/A', '', 'USA', 'N/A', '6'),
('tt1170358', 'The Hobbit: The Desolation of Smaug', 161, 2013, 'Peter Jackson', 'After successfully crossing over (and under) the Misty Mountains, Thorin and Company must seek aid from a powerful stranger before taking on the dangers of Mirkwood Forest--without their Wizard. If they reach the human settlement of Lake-town it will be time for the hobbit Bilbo Baggins to fulfill his contract with the dwarves. The party must complete the journey to Lonely Mountain and burglar Baggins must seek out the Secret Door that will give them access to the hoard of the dragon Smaug. And, where has Gandalf got off to? And what is his secret business to the south?', 'fnaojlfdUbs', 'USA, New Zealand', 'http://ia.media-imdb.com/images/M/MV5BMzU0NDY0NDEzNV5BMl5BanBnXkFtZTgwOTIxNDU1MDE@._V1_SX300.jpg', '7'),
('tt1201607', 'Harry Potter and the Deathly Hallows: Part 2', 130, 2011, 'David Yates', 'Harry, Ron and Hermione search for Voldemort''s remaining Horcruxes in their effort to destroy the Dark Lord as the final battle rages on at Hogwarts.', 'mObK5XD8udk', 'USA, UK', 'http://ia.media-imdb.com/images/M/MV5BMTY2MTk3MDQ1N15BMl5BanBnXkFtZTcwMzI4NzA2NQ@@._V1_SX300.jpg', '8'),
('tt1392170', 'The Hunger Games', 142, 2012, 'Gary Ross', 'In a dystopian future, the totalitarian nation of Panem is divided into 12 districts and the Capitol. Each year two young representatives from each district are selected by lottery to participate in The Hunger Games. Part entertainment, part brutal retribution for a past rebellion, the televised games are broadcast throughout Panem. The 24 participants are forced to eliminate their competitors while the citizens of Panem are required to watch. When 16-year-old Katniss'' young sister, Prim, is selected as District 12''s female representative, Katniss volunteers to take her place. She and her male counterpart, Peeta, are pitted against bigger, stronger representatives, some of whom have trained for this their whole lives.', 'mfmrPu43DF8', 'USA', 'http://ia.media-imdb.com/images/M/MV5BMjA4NDg3NzYxMF5BMl5BanBnXkFtZTcwNTgyNzkyNw@@._V1_SX300.jpg', '7'),
('tt1640571', 'Titanic II', 90, 2010, 'Shane Van Dyke', 'On the 100th anniversary of the original voyage, a modern luxury liner christened "Titanic 2," follows the path of its namesake. But when a tsunami hurls an ice berg into the new ship''s path, the passengers and crew must fight to avoid a similar fate.', '', 'USA', 'http://ia.media-imdb.com/images/M/MV5BMTMxMjQ1MjA5Ml5BMl5BanBnXkFtZTcwNjIzNjg1Mw@@._V1_SX300.jpg', '1'),
('tt1951264', 'The Hunger Games: Catching Fire', 146, 2013, 'Francis Lawrence', 'Katniss Everdeen and Peeta Mellark become targets of the Capitol after their victory in the 74th Hunger Games sparks a rebellion in the Districts of Panem.', 'EAzGXqJSDJ8', 'USA', 'http://ia.media-imdb.com/images/M/MV5BMTAyMjQ3OTAxMzNeQTJeQWpwZ15BbWU4MDU0NzA1MzAx._V1_SX300.jpg', '7'),
('tt1951265', 'The Hunger Games: Mockingjay - Part 1', 123, 2014, 'Francis Lawrence', 'Katniss Everdeen is in District 13 after she shatters the games forever. Under the leadership of President Coin and the advice of her trusted friends, Katniss spreads her wings as she fights to save Peeta and a nation moved by her courage.', '3PkkHsuMrho', 'USA', 'http://ia.media-imdb.com/images/M/MV5BMTcxNDI2NDAzNl5BMl5BanBnXkFtZTgwODM3MTc2MjE@._V1_SX300.jpg', '6'),
('tt1951266', 'The Hunger Games: Mockingjay - Part 2', 137, 2015, 'Francis Lawrence', 'After young Katniss Everdeen agrees to be the symbol of rebellion, the Mockingjay, she tries to return Peeta to his normal state, tries to get to the Capitol, and tries to deal with the battles coming her way...but all for her main goal; assassinating President Snow and returning peace to the Districts of Panem. As her squad starts to get smaller and smaller, will she make it to the Capitol? Will she get revenge on Snow? Or will her target change? Will she be with her "Star-Crossed Lover", Peeta? Or her long time friend, Gale? Deaths, Bombs, Bows and Arrows, A Love Triangle, Hope. What will happen?', 'n-7K_OjsDCQ', 'USA, Germany', 'http://ia.media-imdb.com/images/M/MV5BNjQzNDI2NTU1Ml5BMl5BanBnXkFtZTgwNTAyMDQ5NjE@._V1_SX300.jpg', '6'),
('tt2310332', 'The Hobbit: The Battle of the Five Armies', 144, 2014, 'Peter Jackson', 'After the Dragon leaves the Lonely Mountain, the people of Lake-town see a threat coming. Orcs, dwarves, elves and people prepare for war. Bilbo sees Thorin going mad and tries to help. Meanwhile, Gandalf is rescued from the Necromancer''s prison and his rescuers realize who the Necromancer is.', 'iVAgTiBrrDA', 'New Zealand, USA', 'http://ia.media-imdb.com/images/M/MV5BODAzMDgxMDc1MF5BMl5BanBnXkFtZTgwMTI0OTAzMjE@._V1_SX300.jpg', '7');

--
-- Volcado de datos para la tabla `peliculas_listas`
--

INSERT INTO `peliculas_listas` (`id_lista`, `id_pelicula`) VALUES
(2, '10'),
(3, '10'),
(30, 'tt0120737'),
(30, 'tt0167260'),
(30, 'tt0167261'),
(31, 'tt0241527'),
(31, 'tt0295297'),
(31, 'tt0304141'),
(31, 'tt0330373'),
(31, 'tt0373889'),
(31, 'tt0417741'),
(31, 'tt0926084'),
(31, 'tt1201607'),
(33, 'tt0903624'),
(33, 'tt1170358'),
(33, 'tt2310332'),
(34, '10'),
(35, '10'),
(35, 'tt1132238'),
(36, 'tt1392170'),
(36, 'tt1951264'),
(36, 'tt1951265'),
(36, 'tt1951266');

--
-- Volcado de datos para la tabla `preguntas`
--


--
-- Volcado de datos para la tabla `tiene_genero`
--

INSERT INTO `tiene_genero` (`id_pelicula`, `genero`) VALUES
('tt0120737', ' Drama'),
('tt0120737', ' Fantasy'),
('tt0120737', 'Adventure'),
('tt0167260', ' Drama'),
('tt0167260', ' Fantasy'),
('tt0167260', 'Adventure'),
('tt0167261', ' Adventure'),
('tt0167261', ' Drama'),
('tt0167261', 'Action'),
('tt0241527', ' Family'),
('tt0241527', ' Fantasy'),
('tt0241527', 'Adventure'),
('tt0295297', ' Family'),
('tt0295297', ' Fantasy'),
('tt0295297', 'Adventure'),
('tt0304141', ' Family'),
('tt0304141', ' Fantasy'),
('tt0304141', 'Adventure'),
('tt0330373', ' Family'),
('tt0330373', ' Fantasy'),
('tt0330373', 'Adventure'),
('tt0330994', ' Family'),
('tt0330994', 'Animation'),
('tt0373889', ' Family'),
('tt0373889', ' Fantasy'),
('tt0373889', 'Adventure'),
('tt0417741', ' Family'),
('tt0417741', ' Fantasy'),
('tt0417741', 'Adventure'),
('tt0903624', ' Fantasy'),
('tt0903624', 'Adventure'),
('tt0926084', ' Family'),
('tt0926084', ' Fantasy'),
('tt0926084', 'Adventure'),
('tt1132238', ' Short'),
('tt1132238', 'Documentary'),
('tt1170358', ' Fantasy'),
('tt1170358', 'Adventure'),
('tt1201607', ' Drama'),
('tt1201607', ' Fantasy'),
('tt1201607', 'Adventure'),
('tt1392170', ' Drama'),
('tt1392170', ' Sci-Fi'),
('tt1392170', 'Adventure'),
('tt1640571', ' Adventure'),
('tt1640571', 'Action'),
('tt1951264', ' Sci-Fi'),
('tt1951264', ' Thriller'),
('tt1951264', 'Adventure'),
('tt1951265', ' Sci-Fi'),
('tt1951265', ' Thriller'),
('tt1951265', 'Adventure'),
('tt1951266', ' Sci-Fi'),
('tt1951266', 'Adventure'),
('tt2310332', ' Fantasy'),
('tt2310332', 'Adventure');

--
-- Volcado de datos para la tabla `usuarios`
--



--
-- Volcado de datos para la tabla `valoracion`
--

INSERT INTO `valoracion` (`id_pelicula`, `nick`, `valoracion`) VALUES
('10', 'admin', '5'),
('10', 'ivanafggg', '4'),
('10', 'usuario3', '1'),
('10', 'yoli78', '4'),
('tt0120737', 'admin', '4'),
('tt0120737', 'editor', '3'),
('tt0167261', 'admin', '5'),
('tt0241527', 'admin', '3'),
('tt0295297', 'admin', '1'),
('tt0304141', 'admin', '4'),
('tt0903624', 'admin', '3'),
('tt1132238', 'ivanafggg', '2');

INSERT INTO `comentarios_peliculas` (`id_comentario`, `id_pelicula`, `nick`, `comentario`, `fecha`) VALUES
(1, '10', 'yoli78', 'Me encantó esta película.', '2016-06-16 18:14:42'),
(23, 'tt0903624', 'admin', ' ', '2016-06-25 20:53:08'),
(24, 'tt0903624', 'admin', ' ', '2016-06-25 20:53:16'),
(25, 'tt0903624', 'admin', ' ', '2016-06-25 20:53:21'),
(26, 'tt0903624', 'admin', 'pepe', '2016-06-25 20:53:43'),
(27, 'tt0903624', 'admin', 'z??&lt;', '2016-06-25 20:55:48'),
(28, 'tt0120737', 'editor', 'pepeeeee', '2016-06-25 22:43:34'),
(29, 'tt0120737', 'editor', 'Me gust&oacute; mucho la pel&iacute;cula', '2016-06-25 22:43:53'),
(30, '10', 'ivanafggg', 'Pel&iacute;cula cuanto m&aacute;s, curiosa!', '2016-06-26 08:25:20'),
(31, 'tt1392170', 'ivanafggg', 'Que buena esta jennifer lawrence', '2016-06-26 18:59:46'),
(32, 'tt2310332', 'ivanafggg', 'Que peli tan mala, con lo que molaba el libro...', '2016-06-26 19:00:08');

--
-- Volcado de datos para la tabla `contesta_preguntas`
--

INSERT INTO `contesta_preguntas` (`opcion`, `nick`) VALUES
(1, 'admin'),
(1, 'usuario3'),
(2, 'admin'),
(2, 'editor'),
(2, 'usuario3'),
(5, 'admin'),
(5, 'vero'),
(6, 'editor'),
(6, 'usuario3'),
(7, 'usuario3'),
(8, 'admin'),
(8, 'editor');

--
-- Volcado de datos para la tabla `followers_listas`
--

INSERT INTO `followers_listas` (`id_lista`, `nick`) VALUES
(2, 'admin'),
(31, 'admin'),
(33, 'usuario3');

--
-- Volcado de datos para la tabla `followers_usuario`
--

INSERT INTO `followers_usuario` (`usuario`, `follower`) VALUES
('admin', 'editor'),
('admin', 'marcel'),
('admin', 'usuario3'),
('admin', 'yoli78');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
