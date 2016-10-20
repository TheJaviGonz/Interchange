<html><head><meta charset="utf-8"> </head><body>
<?php


$conexion=mysql_connect("localhost","root","");
mysql_select_db("ondj",$conexion);

$username = $_POST['username'];
$password = $_POST['password'];
$lugar = $_POST['lugar'];
$comment = $_POST['comment'];


$consulta = "INSERT INTO usuario_dj values ('$username','$password','$comment','$lugar')";
$resultado = mysql_query($consulta,$conexion) or die ("Fallo en la conexion");

		
header ("Location: ./bienvenido.html");	


	
?>
</body>
</html>




