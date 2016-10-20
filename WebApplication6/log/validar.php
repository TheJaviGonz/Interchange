

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

mysql_connect("localhost","root","");
mysql_select_db("ondj");

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username != "" and $password != ""){
	$sql = mysql_query("select * from usuario_dj where nick='$username'");
	if($f = mysql_fetch_array($sql)){
		if ($password == $f['contrasenna']){
		
		$_SESSION['nombre'] = $f['nombre'];
		$_SESSION['nick'] = $f['nick'];
		$_SESSION['apellidos'] = $f['apellidos'];
		header ("Location: ./indice/index.php");
		
		}else{
		
		
			header ("Location: ./index.html");

		
;
		

		}
		
		}else{
		
				header ("Location: ./index.html");
		
		}
	
	
	}else{
	
			header ("Location: ./index.html");
	}

?>