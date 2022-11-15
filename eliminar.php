<?php
require('sesion.php');
if (isset($_GET['codProducto'])){
	$codProducto=$_GET['codProducto'];
	unset ($_SESSION['cesta'][$codProducto]);
	header("Location:carrito.php");
}
else header("Location:index.php");
?>