<?php 

require_once "conexion.php";

$tabla="";
$consulta=" SELECT * FROM empleados LIMIT 0";
$termino= "";

if(isset($_POST['empleados']))
{
	$termino=$mysqli->real_escape_string($_POST['empleados']);
	$consulta="SELECT * FROM empleados WHERE 
	id_empleado LIKE '%".$termino."%' OR
	Nombre LIKE '%".$termino."%' OR
	Apellido Materno LIKE '%".$termino."%' OR
	Apellido Paterno LIKE '%".$termino."%' OR
	Fecha Egreso LIKE '%".$termino."%'";
}
$consultaBD=$mysqli->query($consulta);

if($consultaBD->num_rows>=1){
	echo "
	<table class='responsive-table table table-hover table-bordered'>
	<thead>
	<tr>
	<th class='bg-info' scope='col'>Id Empleado</th>
	<th class='bg-info' scope='col'>Nombre</th>
	<th class='bg-info' scope='col'>Apellido Materno</th>
	<th class='bg-info' scope='col'>Apellido Paterno</th>
	<th class='bg-info' scope='col'>Fecha de Ingreso</th>
	<th class='bg-info' scope='col'>Fecha Egreso</th>
	<th class='bg-info' scope='col'>Sueldo</th>
	<th class='bg-info' scope='col'>Departamento</th>
	<th class='bg-info' scope='col'>Frecuencia de Pago</th>
	<th class='bg-info' scope='col'>Salario diario</th>
	</tr>
	</thead><br>
	<tbody>";
	while($fila=$consultaBD->fetch_array(MYSQLI_ASSOC)){
		echo "<tr>
		<td>".$fila['Id_empleado']."</td>	
		<td>".$fila['Nombre']."</td>
		<td>".$fila['Apellido Materno']."</td>
		<td>$ ".$fila['Apellido Paterno']."</td>
		<td>$ ".$fila['Fecha Ingreso']."</td>
		<td>$ ".$fila['Fecha Egreso']."</td>	
		<td>$ ".$fila['Sueldo']."</td>
		<td>".$fila['Departamento']."</td>
		<td>".$fila['Frecuencia de Pago']."</td>
		<td>".$fila['Salario diario']."</td>
		</tr>";
	}
	echo "</tbody>
	</table>";
}else{
	echo "<center><h4>No hemos encotrado ningun registro con la palabra "."<strong class='text-uppercase'>".$termino."</strong><h4><center>";
}
?>