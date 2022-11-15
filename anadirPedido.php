<?php
require('sesion.php');
require('conexion.php');
$usuario=hayUsuario();
$sql="INSERT INTO pedidos(usuario, fecha) VALUES ('$usuario',current_timestamp)";
$con->query($sql);
$codPedido=$con->insert_id;
foreach($_SESSION['cesta'] as $codProducto=>$cantidad){
$sql2="INSERT INTO lineaspedido(codPedido, codProducto,cantidad,precio) 
		VALUES ('$codPedido','$codProducto','$cantidad','(SELECT precio FROM productos WHERE codProducto=$codProducto)');";
$con->query($sql2);
}
unset($_SESSION['cesta']);
header("Location:pedidoRealizado.php");
?>