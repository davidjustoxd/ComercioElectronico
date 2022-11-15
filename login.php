<?php
$error='';
if(isset($_GET['create'])){
	if($_GET['create'] == "ok"){
		$error="Usuario creado correctamente";
	}
	else {
		$error = "ERROR. No se ha podido crear el usuario. Por favor, rellena todos los campos";
	}
}
session_name('cesta');
session_start();

if (isset ($_POST['usuario'], $_POST ['pwd'])) {
	require 'conexion.php';
	$usuario=$_POST['usuario'];
	$pwd=$_POST ['pwd'];
	$usuario=$con->real_escape_string($usuario);
	$pwd=$con->real_escape_string($pwd);
	$pwd= strtoupper(hash( "sha512", $pwd));
	$sql="SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$pwd'";
	$filas=$con->query($sql);
	if ($fila=$filas->fetch_assoc()){
		$_SESSION['usuario']=$fila['usuario'];
		$_SESSION['esAdmin']=$fila['esAdmin'];
		header ('Location:index.php');
	}
	else $error="No existe la combinación introducida";
	}
	?>

<html>
	<head>
	<meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<title> Login </title>
	</head>
	<body>
	<div class="border border-primary m-5 p-5">
	<form action="login.php" METHOD="POST" class="form">
	Nombre de usuario<input type="text" name="usuario" class="form-control"/>
	Contraseña<input type="password" name="pwd" class="form-control"/>
	</br>
	 <input type="submit" value="Entrar" class="form-control"/>
	 </form>
	 <p1>No estás registrado? <a href=nuevoUser.php>Crear usuario </a></p1></br>
	 <p1> <strong><?=$error?> </strong></p1>
	 <div>
	 </body>
</html>