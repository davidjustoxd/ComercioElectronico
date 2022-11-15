<?php
require('conexion.php');
require('sesion.php');
$selected = "";
$totalFactura="";
?>

<html> 
	<head>
	<meta charset="UTF-8">
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
		<title> Pedidos</title>
		<link href="../css/Styles.css" rel="stylesheet" >
		<link href="../css/Styles.css" rel="stylesheet" >
	</head>
	<body>

		<!-- Header-->
		<header class="header-main">
			<div class="container">
				<div class="Logo-tienda">
					<img class="logo-main" src="../img/100x60.png" alt="Logo Tienda">
				</div>
				<div class="title-main">
					<h1>Saramajos BikeStore</h1>
					<p>Contigo desde 2021</p>
				</div>
				<div class="basket-session">
					<div class="session">
						<img src="../img/user.png" alt="Logo User">
						<?php 
						$usuario=hayUsuario();
						if (!is_null($usuario)){ ?>
						<div class="user">
							<h6>Sesión actual: <?=$usuario?></h6>
							<a class="close" href="cerrarSesion.php">Cerrar sesion</a>
							<?php if ($_SESSION['esAdmin']){ ?>
							<a href='panelAdmin.php'>Ver pedidos</a>
							<?php } ?>
						</div>
						<?php } else { ?>
							<a header ("Location:.");</a>
						<?php } ?>
					</div>
				</div>

			</div>
		</header>
		
		<div class="panel-admin">
			<div class="container">
			<h2>Filtrar por usuario</h2>
			<select type="text" name="usuario" onChange="location.href='?usuario='+this.value" class="form-control">
						<option value='' >--</option>
						<?php 			
						$sql1="select usuario from usuarios";
						$fila=$con->query($sql1);
							while ($usuarios=$fila->fetch_assoc()):
							$usuario=$usuarios['usuario'];
							if (isset($_GET['usuario']) && $_GET['usuario'] == $usuario){
								$selected = "selected";
							}
						?>
						<option value="<?=$usuario?>" <?=$selected?> > <?=$usuario?></option>
						<?php 
						$selected="";
						endwhile;
						?>
					</select>

				<?php if (isset($_GET['usuario'])){
					$usuario = $_GET['usuario'];
					?>
					<ul class="panel-list">
					<?php $sql1="SELECT codPedido, fecha FROM pedidos WHERE usuario = '$usuario' ";
					$fila=$con->query($sql1);
					while ($pedidos=$fila->fetch_assoc()):	
					$pedido = $pedidos['codPedido'];
					$fecha = $pedidos['fecha']; ?>
					<li> 
						<p><strong>Código de pedido:</strong> <?=$pedido?></p>
						<p><strong>Fecha de pedido:</strong><?=$fecha?></p>
						<a href=panelAdmin.php?pedido=<?=$pedido?>>Ver detalles del pedido</a>
					<?php endwhile;
					echo "</ul>";
				} 
				
				if (isset($_GET['pedido'])){
					$pedido = $_GET['pedido']; ?>
					<table class="table-list">
						<tr>
							<th>Nombre artículo </th>
							<th>Cantidad	</th>
							<th>Importe unitario</th>
							<th> Importe total </th>
						</tr>	

				<?php	$sql1="SELECT p.nombre, l.cantidad, p.precio 
					FROM productos p  INNER JOIN lineaspedido l
					ON p.codProducto = l.codProducto
					WHERE l.codPedido = '$pedido'";
					$totalFactura = 0;
					$fila=$con->query($sql1);
					while ($lineas=$fila->fetch_assoc()):
						$nombre = $lineas['nombre'];
						$cantidad = $lineas['cantidad'];
						$precio = $lineas ['precio'];
						$precioTotal = $cantidad * $precio ;
						$totalFactura+=$precioTotal;
						?>
					<tr>
						<td><?=$nombre?></td>
						<td><?=$cantidad?></td>
						<td><?=$precio?></td>
						<td><?=$precioTotal?></td>
					</tr>
					<?php endwhile;
				} ?>
					</table>
					<?php if (isset($_GET['pedido'])) { ?>
					<div class="total">
						<p>Total de la factura:<strong> <?=$totalFactura?> €</strong></p> 
					</div>
					<?php } ?>
				</div>
			</div>

        <!-- Footer Main -->
		<footer class="bottom-footer">
			<section id="footer-main" class="footer-main">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 section-logo-main">
							<a href="https://www.google.es/" target="_blank">
							<img class="logo-main" src="../img/100x60.png" alt="Logo Tienda">
							</a>
						</div>
						<div class="col-lg-6 col-sm-12 text-center my-auto section-menu">
						<div class="copyright">
							@BikeStore Saramajos. Todos los derechos reservados <br>
						</div>
						<div class="menu">
							<a alt="Quiénes somos" href="https://www.xunta.gal/sistema-integrado-de-atencion-a-cidadania" target="_blank"> Quiénes somos </a> |
							<a alt="Donde encontrarnos" href="accesibilidad.html">Donde encontrarnos</a> |
							<a alt="Aviso Legal " href="aviso_legal.html"> Aviso Legal </a>
						</div>
						</div>
						<div class="col-lg-3 section-logo-bh">
							<a href="https://www.google.es/" target="_blank">
								<img class="logo-sec" src="../img/logo-bh-head.png" style="text-align: end;" alt="Logo Marca">
							</a>
						</div>
					</div>
				</div>
			</section>
		</footer>