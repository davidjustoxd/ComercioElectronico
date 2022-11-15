
<html>
	<head>
	<meta charset="UTF-8"><?php
$error='';
session_name('cesta');
session_start();

if (count($_POST) == 7) {
    foreach ($_POST as $clave=>$valor){
        if ($valor == ""){
            header ('Location:login.php?create=no');
        }
    }
	require 'conexion.php';
	$usuario=$_POST['usuario'];
	$usuario=$con->real_escape_string($usuario);
    $pwd=$_POST ['pwd'];
    $pwd=$con->real_escape_string($pwd);
	$pwd= hash( "sha512", $pwd);
    $email=$con->real_escape_string($_POST['email']);
    $nombre=$con->real_escape_string($_POST['nombre']);
    $apellidos=$con->real_escape_string($_POST['apellidos']);
    $direccion=$con->real_escape_string($_POST['direccion']);
    $codigoPostal=$con->real_escape_string($_POST['codigoPostal']);
	$sql="SELECT * FROM usuarios WHERE usuario='$usuario'";
	$filas=$con->query($sql);
	if ($fila=$filas->fetch_assoc()){
        $error="ERROR:El usuario introducido ya existe.";
	}
    else {
        $sql = "INSERT INTO USUARIOS 
                VALUES ('$usuario','$pwd','$email',0,'$nombre','$apellidos','$direccion','$codigoPostal' )";
        $filas=$con->query($sql);
        header ('Location:login.php?create=ok');
    }
	}


	?>


	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<title> Crear Usuario </title>
	</head>
	<body>
	<div class="border border-primary m-5 p-5">
	<form action="nuevoUser.php" METHOD="POST" class="form">
	Nombre de usuario<input type="text" name="usuario" class="form-control"/>
    Contraseña<input type="password" name="pwd" class="form-control"/>
	Correo electrónico<input type="text" name="email" class="form-control"/>
	Nombre<input type="text" name="nombre" class="form-control"/>
	Apellidos<input type="text" name="apellidos" class="form-control"/>
	Dirección<input type="text" name="direccion" class="form-control"/>
	Código postal<input type="number" min="0" max="99999" name="codigoPostal" class="form-control"/>
	
	</br>
	 <input type="submit" value="Crear usuario" class="form-control"/>
	 </form>
	
	 <p1> <?=$error?> </p1>
	 <div>
	 </body>
</html>