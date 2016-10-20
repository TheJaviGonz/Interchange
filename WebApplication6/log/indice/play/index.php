<!DOCTYPE HTML>
<!--
	Strata by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php

session_start();
putenv('TZ=Europe/Madrid');
$fecha1 = date("l F ");
$fecha2 = date("Y-m-d");

$inicio=$_SESSION['nick'];

?>
<html>
	<head>
		<title>Strata by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->

		<link rel="shortcut icon" href="../favicon.ico">		
		<link rel="stylesheet" type="text/css" href="css/set1.css" />
	</head>
	<body id="top">

		<!-- Header -->
			<header id="header">
				<a href="#" class="image avatar"><img src="images/OnDJPNG.png" alt="" /></a>
				<h1>Bienvenido,<strong> <?php echo $_SESSION['nick'];  ?></strong><br />
				al entorno para DJ's<br />
				</h1>
			</header>

		<!-- Main -->
			<div id="main">

				<!-- One -->
					<section id="one">
						<header class="major">
							<h2>Aqui se mostrara que has puesto ya para que todos tus clientes lo vean</h2>
						</header>
						
					</section>
					


				<!-- Two -->
				<section id="two">

						<table align='center' width='599'>
<tr>
<td>
<?php

$nom=$_SESSION['nick'];	


/*"select c.nombre, c.artista, c.estilo, p.n_peticiones
			 from canciones c, peticion p
			 GROUP BY p.cod_pet
			 having  p.nick =  '$nom' "; */

// 1. Conectar con el servidor de base de datos
$conexion = mysql_connect ('localhost', 'root', '')
or die ("No se puede conectar con el servidor");
// 2. Seleccionar una base de datos
mysql_select_db ('ondj',$conexion)
or die ("No se puede seleccionar la base de datos");
// 3. Enviar la instrucci�n SQL a la base de datos
$consulta = "select c.nombre, c.artista, c.estilo
			 from canciones c, play p
			 where c.cod_cancion =  p.cod_cancion and p.nick = '$nom' and p.fecha_peticion = '$fecha2'
			 order by  p.cod_play ASC

"; 
$resultado = mysql_query ($consulta,$conexion)
or die ("Fallo en la consulta");
// 4. Obtener y procesar los resultados
$nfilas = mysql_num_rows ($resultado);	

/*group by p.med_num
			 having m.nombre = ('$inicio')*/

if ($nfilas > 0):

	echo "
		<font size = 8><I><B>Tus canciones:</i></b></font>
		<table>
		<tr align='center'>

				<td ><font size = 5><B><I> Nombre</font> </b></i></td>
				<td ><font size = 5><B><I>Artistas </font> </b></i></td>
				<td ><font size = 5><B><I>Estilo</font> </b></i></td>
				
		</tr>
	";

		for ($i=0; $i<$nfilas; $i++):
		$fila = mysql_fetch_array ($resultado,MYSQL_ASSOC);
	
	echo'			
		<tr align=center>

				<td>'.$fila['nombre'].'</td>
				<td>'.$fila['artista'].'</td>
				<td>'.$fila['estilo'].'</td>
				
	
				
		</tr>
    ';
		endfor;
//$med_num=$fila['med_num'];
	echo'</table>';
	
	echo "N&uacute;mero de canciones: $nfilas <br/><br/>";
	
else:
	echo "Hoy todavia no se han echo peticiones";
endif;
?>
</td>
</tr>
</table>
		

	
						
						
					
							
			
		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a href="https://twitter.com/OnDJ_Inc" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="https://www.facebook.com/ondjapp?fref=ts" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
				</ul>
				<ul class="copyright">
							<li>&copy; OnDJ 2015</li><li>Todos los derechos reservados</li>
							<li>Universidad de Alcalá</li>
				</ul>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>