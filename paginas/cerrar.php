<?php
	require_once("../sesion.class.php");
	
	$sesion = new sesion();
	$usuario = $sesion->get("usuario_dq");	
	if( $usuario == false )
	{	
		header("Location: index.php");
	}
	else 
	{
		$usuario = $sesion->get("usuario_dq");	
		$sesion->termina_sesion();	
		header("location: ../index.php");
	}
?>