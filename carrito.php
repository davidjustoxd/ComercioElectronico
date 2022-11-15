<?php
require('sesion.php');
require('conexion.php');
if(!isset($_SESSION['cesta']))
	header("Location:index.php");
if (count($_SESSION['cesta'])==0)
	header("Location:index.php");
$CodProducto=implode (",",array_keys($_SESSION['cesta']));
$sql="SELECT codProducto, nombre, precio FROM productos where codProducto in ($CodProducto)";
$filas=$con->query($sql);
$precioTotal=0;
?>
<html>
<head>
	<meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Cesta</title>
</head>
<body>
<h1>Cesta</h1>
	<table border="1" class="table table-hover">
		<tr>
			<th> Nombre</th>
			<th> Precio Unitario</th>
			<th> Cantidad</th>
			<th> Precio Global</th>
			<th> Eliminar </th>
		</tr>
<?php
while ($producto=$filas->fetch_assoc()):
	$codProducto=$producto['codProducto'];
	$nombre=$producto['nombre'];
	$precio=$producto['precio'];
	$cantidad=$_SESSION['cesta'][$codProducto];
?>
		<tr>
			<td> <?=$nombre?></th>
			<td> <?=$precio?></th>
			<td> 
				<form action="anadirCarrito.php" method="post">
					<input type='hidden' name='producto' value=<?=$codProducto?>>
					<input type="number" name="Cantidad" value=<?=$cantidad?> min=0>
					<input type="submit" value="Modificar la cantidad"/>
				</form>
			</td>
			<td> <?php $precioGlobal=$cantidad * $precio;
					echo $precioGlobal;
					$precioTotal=$precioTotal+$precioGlobal ;?>
			</td>
			<td>
			<a href="eliminar.php?codProducto=<?=$codProducto?>"> Eliminar producto </a>
			</td>

<?php endwhile ?>
		</tr>
	</table>
<h4>Precio total: <?=$precioTotal?> €</h4> </br>
<div>
	<a href="index.php"> Añadir productos </a> </br>
	<?php 
		$usuario=hayUsuario();
		if (is_null($usuario)){ ?>
			<p> Inicie sesión para poder comprar </p>
		<?php } else { ?>
			<a href="anadirPedido.php"> Comprar </a>
		<?php } ?>
<div>
</br>
	<?php
		
		if (!is_null($usuario)){ ?>
		<div class='d-flex justify-content-between'>
		<h6>Sesión actual: <?=$usuario?></h6>
		<a href="cerrarSesion.php">Cerrar sesion</a></td>
		</div>
		<?php } else { ?>
			<a href="login.php">Iniciar sesion</a>
		<?php } ?>
</body>
</html>
