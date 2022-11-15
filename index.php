<?php
require('conexion.php');
require('sesion.php');

if (isset($_GET['categoria']) && is_numeric($_GET['categoria'])){
	$codigoCateg=$_GET['categoria'];
$sql="SELECT codProducto, nombre, precio
	  FROM productos
	  WHERE codCategoria=$codigoCateg
	  ORDER BY nombre";
$filas=$con->query($sql);
}
$tProductos='Vacía';
if(!empty ($_SESSION['cesta']))
	$tProductos=count($_SESSION['cesta']);
?>
<html> 
	<head>
	<meta charset="UTF-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
		<title> Compra <?=$bd ?></title>
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
							<a href="login.php">Iniciar sesion</a>
						<?php } ?>
					</div>
					<div class="basket">
						<img src="../img/shopping-cart.png" alt="Logo Tienda">
						<?php
						$mensaje="<a href='carrito.php'> Cesta($tProductos)</a>";
						?>
						<?=$mensaje?>
					</div>
				</div>

			</div>
		</header>

		<!-- Categoria-->
		<div class="content">
			<div class="container">
			<ul class="categories">
					<?php 			
					$sql1="select distinct descripcion, codCategoria from categorias";
					$fila=$con->query($sql1);
						while ($categorias=$fila->fetch_assoc()):
						$codCateg=$categorias['codCategoria'];
						$categoria=$categorias['descripcion'];
						
					?>
					<li><a href=index.php?categoria=<?=$codCateg?>><?=$categoria?></a></li>
					<?php 
					endwhile;
					?>
					</ul>
				<?php if (isset($_GET['categoria'])&& is_numeric($_GET['categoria'])): ?>	
					<ul class="product-list">
					<?php 
						while ($producto=$filas->fetch_assoc()):
							$codProducto=$producto['codProducto'];
							$nombre=$producto['nombre'];		
							$precio=$producto['precio'];	
						?>
						
						<li>
							<img src=img/productos/<?=$codigoCateg?>/<?=$codProducto?>.jpg alt=<?=$nombre?>/>
							<div class="description">
								<div class="link">
									<a href=producto.php?codProducto=<?=$codProducto?>><?=$nombre?></a>
									<span><?=$precio?> €</span>
							</div>
							<form action="anadirCarrito.php" method="post">
							<input type='hidden' name='categoria' value=<?=$codigoCateg?>>
							<input type='hidden' name='producto' value=<?=$codProducto?>>
							<input type="number" name="Cantidad" value=0 min=0>
							<input type="submit" value="Añadir al carrito" />
							</form>	
						</li>
							
					<?php				
						endwhile;
						$con->close();
					?>	

				<?php endif;?>
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
	</body>
</html>