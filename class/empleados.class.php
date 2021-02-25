
<?php

 class empleados extends Model{
 
 	function add_empleado($ci,$nombre, $apellido, $correo, $fecha, $cod, $sex){
		$query="INSERT INTO `prestaciones`.`empleados` (`cedula` ,`nombre` ,`apellido` ,`correo` ,`fechai` ,`cod` ,`sex`)
				VALUES ( '$ci', '$nombre', '$apellido', '$correo', '$fecha', '$cod', '$sex')";
		return $this->_SQL_tool($this->INSERT, __METHOD__, $query);
	}
 
 }


?>