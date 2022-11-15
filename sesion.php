<?php
session_name('cesta');
session_start();

function hayUsuario() {
	if (isset($_SESSION['usuario']))
		return "".$_SESSION['usuario'];
	else return null;
}
// if (isset($_SESSION['usuario']))
	// $usuario=$_SESSION['usuario'];
// else
	// header ("Location:.");
?>