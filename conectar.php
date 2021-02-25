<?php
$host="localhost";
$user="root";
$pw="";
$db="prestaciones";

mysql_connect("localhost", "root", "") OR DIE("error al conectarse con la tabla");
@mysql_query("SET NAMES 'utf8'"); //solucion caracteres especiales como la �
mysql_select_db("prestaciones")OR DIE("No ha sido posible conectar a la Base de Datos");
?>
