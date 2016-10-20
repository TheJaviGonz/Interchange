<?php

session_start();
putenv('TZ=Europe/Madrid');
$fecha1 = date("l F ");
$fecha2 = date("Y-m-d");

$inicio=$_SESSION['nombre'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Clear-Cut 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130903

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="jquery.slidertron-1.3.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">Bienvenido/a</a>&nbsp;&nbsp; <?php echo $_SESSION['nick']?></h1>
		</div>
		<div id="menu">
			<ul>
				<li class="current_page_item"><a href="#" accesskey="1" title="">Pacientes</a></li>
				<li><a href="#" accesskey="2" title="">Citas</a></li>
				<li><a href="#" accesskey="3" title="">Historial</a></li>
			</ul>
		</div>
	</div>
</div>

<div id="header-featured">
</div>
	<div id="banner-wrapper">
		<div id="banner" class="container">
			<h2><?php echo $fecha1 ?></h2>
			<span><?php echo $fecha2 ?></span>
		</div>
	</div>

<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">

<table>
<tr>
<td>

<table align='center' width='599'>
<tr>
<td>
<?php
	
// 1. Conectar con el servidor de base de datos
$conexion = mysql_connect ('localhost', 'root', '')
or die ("No se puede conectar con el servidor");
// 2. Seleccionar una base de datos
mysql_select_db ('proyecto',$conexion)
or die ("No se puede seleccionar la base de datos");
// 3. Enviar la instrucci�n SQL a la base de datos
$consulta = "select p.num_paciente, p.nombre_pa, p.apellidos_pa, m.med_num, m.nombre
			 from medicos m, pacientes p
			 where m.med_num = p.med_num
			 group by p.med_num
			 having m.nombre = ('$inicio')"; 
$resultado = mysql_query ($consulta,$conexion)
or die ("Fallo en la consulta");
// 4. Obtener y procesar los resultados
$nfilas = mysql_num_rows ($resultado);	



if ($nfilas > 0):

	echo "
		<h2>Pacientes asignados</h2>
		<h1>Lista de los pacientes</h1>
		<table cellspacing='20' >
		<tr align='center' cellspacing='20' Cellpadding>
				<td align='center'> Numero del paciente </td>
				<td align='center'> Nombre </td>
				<td align='center'> Apellidos </td>
				<td align='center'> Medico asignado </td>
		</tr>
	";

		for ($i=0; $i<$nfilas; $i++):
		$fila = mysql_fetch_array ($resultado,MYSQL_ASSOC);
	
	echo'			
		<tr align=center>
				<td>'.$fila['num_paciente'].'</td>
				<td>'.$fila['nombre_pa'].'</td>
				<td>'.$fila['apellidos_pa'].'</td>
				<td>'.$fila['med_num'].'</td>
				
		</tr>
    ';
		endfor;
		
	echo'</table>';
	
	echo "N&uacute;mero de pacientes = $nfilas <br/><br/>";
	
else:
	echo "No hay ning&aacute;n libro";
endif;
?>
</td>
</tr>
</table>

</td>	

<td>
<table align='center' width='599'>
<tr>
<td>
<?php
	
// 1. Conectar con el servidor de base de datos
$conexion = mysql_connect ('localhost', 'root', '')
or die ("No se puede conectar con el servidor");
// 2. Seleccionar una base de datos
mysql_select_db ('proyecto',$conexion)
or die ("No se puede seleccionar la base de datos");
// 3. Enviar la instrucci�n SQL a la base de datos
$consulta2 = "select * from citas
			 where fecha_cita = ('$fecha2') and nombre_medico = ('$inicio')";

$resultado2 = mysql_query ($consulta2,$conexion)
or die ("Fallo en la consulta");
// 4. Obtener y procesar los resultados
$nfilas2 = mysql_num_rows ($resultado2);	



if ($nfilas2 > 0):

	echo "
		<h2>Citas de hoy</h2>
		<h1>Pacientes pendientes</h1>
		<table cellspacing='20' >
		<tr align='center' cellspacing='20' Cellpadding>
				<td align='center'> Nombre paciente </td>
				<td align='center'> Apellidos paciente </td>
				<td align='center'> Hora </td>
				<td align='center'> Num_paciente </td>
		</tr>
	";

		for ($i=0; $i<$nfilas2; $i++):
		$fila2 = mysql_fetch_array ($resultado2,MYSQL_ASSOC);
	
	echo'			
		<tr align=center>
				<td>'.$fila2['nombre_pa'].'</td>
				<td>'.$fila2['apellidos_pa'].'</td>
				<td>'.$fila2['hora_cita'].'</td>
				<td>'.$fila2['num_paciente'].'</td>
				
		</tr>
    ';
		endfor;
		
	echo'</table>';
	
	echo "N&uacute;mero de pacientes restantes = $nfilas2 <br/><br/>";
	
else:
	echo "
		No hay pacientes por el momento
	";
endif;
?>
</td>
</tr>
</table>	

</td>
</tr>
</table>	
			
	<div id="featured-wrapper">
		<div id="featured" class="container">
			<div class="column1"> <span class="icon icon-key"></span>
				<div class="title">
					<h2>Maecenas lectus sapien</h2>
				</div>
				<p>In posuere eleifend odio. Quisque semper augue mattis wisi. Pellentesque viverra vulputate enim. Aliquam erat volutpat.</p>
			</div>
			<div class="column2"> <span class="icon icon-legal"></span>
				<div class="title">
					<h2>Praesent scelerisque</h2>
				</div>
				<p>In posuere eleifend odio. Quisque semper augue mattis wisi. Pellentesque viverra vulputate enim. Aliquam erat volutpat.</p>
			</div>
			<div class="column3"> <span class="icon icon-unlock"></span>
				<div class="title">
					<h2>Fusce ultrices fringilla</h2>
				</div>
				<p>In posuere eleifend odio. Quisque semper augue mattis wisi. Pellentesque viverra vulputate enim. Aliquam erat volutpat.</p>
			</div>
			<div class="column4"> <span class="icon icon-wrench"></span>
				<div class="title">
					<h2>Etiam posuere augue</h2>
				</div>
				<p>In posuere eleifend odio. Quisque semper augue mattis wisi. Pellentesque viverra vulputate enim. Aliquam erat volutpat.</p>
			</div>
		</div>
		<div id="extra" class="container">
			<h2>Maecenas vitae orci vitae tellus feugiat eleifend</h2>
			<span>Quisque dictum integer nisl risus, sagittis convallis, rutrum id, congue, and nibh</span>
		</div>
	</div>
</div>

</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<div id="footer-wrapper">
	<div id="footer" class="container">
		<div class="column1">
			<div class="title">
				<h2>Fusce ultrices fringilla</h2>
			</div>
			<ul class="style3">
				<li class="icon icon-ok"><a href="#">Semper egetmi dolore</a></li>
				<li class="icon icon-ok"><a href="#">Quam turpis feugiat</a></li>
				<li class="icon icon-ok"><a href="#">Amet hendrerit lectus</a></li>
				<li class="icon icon-ok"><a href="#">Consequat phasellus</a></li>
				<li class="icon icon-ok"><a href="#">Amet turpis feugiat</a></li>
			</ul>
		</div>

		<div class="column2">
			<div class="title">
				<h2>Pellentesque viverra</h2>
			</div>
			<ul class="style3">
				<li class="icon icon-ok"><a href="#">Semper egetmi dolore</a></li>
				<li class="icon icon-ok"><a href="#">Quam turpis feugiat</a></li>
				<li class="icon icon-ok"><a href="#">Amet hendrerit lectus</a></li>
				<li class="icon icon-ok"><a href="#">Consequat phasellus</a></li>
				<li class="icon icon-ok"><a href="#">Amet turpis feugiat</a></li>
			</ul>
		</div>

		<div class="column3">
			<div class="title">
				<h2>Mauris vulputate</h2>
			</div>
			<ul class="style3">
				<li class="icon icon-ok"><a href="#">Semper egetmi dolore</a></li>
				<li class="icon icon-ok"><a href="#">Quam turpis feugiat</a></li>
				<li class="icon icon-ok"><a href="#">Amet hendrerit lectus</a></li>
				<li class="icon icon-ok"><a href="#">Consequat phasellus</a></li>
				<li class="icon icon-ok"><a href="#">Amet turpis feugiat</a></li>
			</ul>
		</div>

		<div class="column4">
			<div class="title">
				<h2>Nulla luctus eleifend</h2>
			</div>
			<ul class="style3">
				<li class="icon icon-ok"><a href="#">Semper egetmi dolore</a></li>
				<li class="icon icon-ok"><a href="#">Quam turpis feugiat</a></li>
				<li class="icon icon-ok"><a href="#">Amet hendrerit lectus</a></li>
				<li class="icon icon-ok"><a href="#">Consequat phasellus</a></li>
				<li class="icon icon-ok"><a href="#">Amet turpis feugiat</a></li>
			</ul>
		</div>

	</div>
</div>
<div id="copyright" class="container">
	<p>Copyright (c) 2013 Sitename.com. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://www.freecsstemplates.org/" rel="nofollow">FreeCSSTemplates.org</a>.</p>
</div>
</body>
</html>
