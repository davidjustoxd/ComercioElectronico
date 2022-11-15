<?php
require('sesion.php');
if (isset($_POST['producto'])&& isset($_POST['Cantidad'])){
	$codProducto=$_POST['producto'];
	$cantidad=$_POST['Cantidad'];
	if ($cantidad>0)
		$_SESSION['cesta']["$codProducto"]="$cantidad";
	if (isset ($_POST['categoria'])){
		$categoria=$_POST['categoria'];
		header("Location:index.php?categoria=$categoria");
	}
	else
		header("Location:carrito.php");
}
else 
	header("Location:index.php");
?>