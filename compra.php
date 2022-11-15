<?php
// implode (",",array_keys($_SESSION['cesta'])). Representa las claves del array $_SESSION['cesta'] separadas por comas en un string.

require('conexion.php');
require('sesion.php');
$selected="";
if (isset($_GET['categoria'])){
	$codigoCateg=$_GET['categoria'];
$sql="SELECT codProducto, descripcion, precio
	  FROM productos
	  WHERE codCategoria=$codigoCateg
	  ORDER BY descripcion";
$filas=$con->query($sql);
}
$tProductos=count($_SESSION['cesta']);
if ($tProductos==0)
	$tProductos='Vacía';

?>
<html> 
	<head>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
		<title> Compra <?=$bd ?>
		</title>
		</head>
	<body>	
		<h1> Categoria </h1> </br>
			
			<select type="text" name="categoria" onChange="location.href='?categoria='+this.value" class="form-control">
				<option value=''>--</option>
				<?php 			
				$sql1="select distinct descripcion, codCategoria from categorias";
				$fila=$con->query($sql1);
					while ($categorias=$fila->fetch_assoc()):
					$codCateg=$categorias['codCategoria'];
					$categoria=$categorias['descripcion'];
					if (isset ($codigoCateg)){
					if ($codCateg==$codigoCateg)
						$selected="SELECTED";
					else
						$selected="";
					}
				?>
				<option value="<?=$codCateg?>" <?=$selected?>> <?=$categoria?></option>
				<?php 
				endwhile;
				?>
				</select>
		<?php if (isset($_GET['categoria'])): ?>	
		<table border="1" class="table table-hover">
					<tr>
						<th> Nombre</th>
						<th> Precio</th>
						<th> Numero de productos seleccionados</th>
					</tr>
				<?php 
					while ($producto=$filas->fetch_assoc()):
						$codProducto=$producto['codProducto'];
						$descripcion=$producto['descripcion'];		
						$precio=$producto['precio'];	
					?>
					
					<tr>
						<td><?=$descripcion?></td>
						<td><?=$precio?></td>
						<td>
						<form action="añadirCarrito.php" method="post">
						<input type='hidden' name='categoria' value=<?=$codigoCateg?>>
						<input type='hidden' name='producto' value=<?=$codProducto?>>
						<input type="number" name="Cantidad" value=0 min=0>
						</td>
						<td>
						<input type="submit" value="Añadir al carrito" class="form-control"/>
						</td>
						</form>
						
					</tr>
						
				<?php				
					endwhile;
				 $con->close();
				?>	
		</table>
		</br>
		<?php endif;
		$mensaje="<a href='carrito.php'> Cesta($tProductos)</a>";
		?>
		<?=$mensaje?>
		<div class='d-flex justify-content-between'>
		<h6>Sesión actual: <?=$usuario?></h6>
		<a href="cerrarSesion.php?cod">Cerrar sesion</a></td>
		</div>
	</body>
</html>