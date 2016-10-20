

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->


<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
	<form id="form1" name="form1" method="post" action="validar.php">
		<title>OnDJ</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		
				<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
		<link href="default.css" rel="stylesheet" type="text/css" media="all" />
		<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
	</head>
	<body>


<?php

$codigo = $_POST['codigo'];


// 1. Conectar con el servidor de base de datos
$conexion = mysql_connect ('localhost', 'root', '')
or die ("No se puede conectar con el servidor");
// 2. Seleccionar una base de datos
mysql_select_db ('ondj',$conexion)
or die ("No se puede seleccionar la base de datos");
// 3. Enviar la instrucci�n SQL a la base de datos
$consulta = "INSERT INTO play (nick,cod_cancion,fecha_peticion)
SELECT nick,cod_cancion,fecha_peticion FROM peticion
where cod_pet=$codigo";			 
			 

$resultado = mysql_query ($consulta,$conexion)
or die ("Fallo en la consulta");



// 1. Conectar con el servidor de base de datos
$conexion = mysql_connect ('localhost', 'root', '')
or die ("No se puede conectar con el servidor");
// 2. Seleccionar una base de datos
mysql_select_db ('ondj',$conexion)
or die ("No se puede seleccionar la base de datos");
// 3. Enviar la instrucci�n SQL a la base de datos
$consulta = "delete from peticion where cod_pet=$codigo";			 
			 
$resultado = mysql_query ($consulta,$conexion)
or die ("Fallo en la consulta");


header ("Location: ./index.php");

		

?>