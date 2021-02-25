<?php
function conectarse()
	{
	$bd_host = "localhost";
	$bd_usuario = "root";	
	$bd_password = "";
	$bd_base = "prestaciones";
	$con = mysql_connect ($bd_host, $bd_usuario, $bd_password);
	if(!$con)
		{
			mysql_error();
		}
		else
		{
		@mysql_query("SET NAMES 'utf8'");
			mysql_select_db($bd_base,$con);
		}
	return $con;
	}
?>
