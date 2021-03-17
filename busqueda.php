<?php 

require_once "BD/conexion.php";
$tabla="";
$consulta=" SELECT * FROM empleados LIMIT 0";
$termino= "";
if(isset($_POST['productos']))
{
	$termino=$mysqli->real_escape_string($_POST['productos']);
	$consulta="SELECT * FROM empleados WHERE 
	Id_Empleado LIKE '%".$termino."%' OR
	Nombre LIKE '%".$termino."%'";
}
$consultaBD=$mysqli->query($consulta);
if($consultaBD->num_rows>=1){
	echo "
	<table class='responsive-table table table-hover table-bordered'>
	<thead>
	<tr>
	<th class='bg-info' scope='col'>MEDIDA</th>
	<th class='bg-info' scope='col'>PRODUCTO</th>
	<th class='bg-info' scope='col'>COD_BARRA</th>
	<th class='bg-info' scope='col'>P_COSTO</th>
	<th class='bg-info' scope='col'>PRECIO_A</th>
	<th class='bg-info' scope='col'>PRECIO_B</th>
	<th class='bg-info' scope='col'>PRECIO_C</th>
	<th class='bg-info' scope='col'>MARCA</th>
	</tr>
	</thead><br>
	<tbody>";
	while($fila=$consultaBD->fetch_array(MYSQLI_ASSOC)){
		echo "<tr>
		<td>".$fila['Id_Empleado']."</td>	
		<td>".$fila['Nombre']."</td>
		<td>".$fila['Apellido Materno']."</td>
		<td>$ ".$fila['Apellido Paterno']."</td>
		<td>$ ".$fila['Sueldo']."</td>
		<td>$ ".$fila['Departamento']."</td>	
		<td>$ ".$fila['Frecuencia de pago']."</td>
		<td>".$fila['Salario Diario']."</td>
		</tr>";
	}
	echo "</tbody>
	</table>";
}else{
	echo "<center><h4>No hemos encotrado ningun registro con la palabra "."<strong class='text-uppercase'>".$termino."</strong><h4><center>";
}
?>