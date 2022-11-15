<?php
require('sesion.php');
?>
<html>
<head>
<meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Ha ido todo bien!</title>
</head>
<body>
<h1>Su pedido ha sido enviado correctamente </h1>
</br>
<a href="index.php"> Seguir Comprando </a>
</br>
	<?php
		$usuario=hayUsuario();
		if (!is_null($usuario)){ ?>
		<div class='d-flex justify-content-between'>
		<h6>Sesión actual: <?=$usuario?></h6>
		<a href="cerrarSesion.php">Cerrar sesion</a></td>
		</div>
		<?php } else { ?>
			<a href="login.php">Iniciar sesion</a>
		<?php } ?>
</div>
</body>
</html>

