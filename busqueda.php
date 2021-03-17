<?php 

require_once "BD/conexion.php";
$tabla="";
$consulta=" SELECT * FROM empleados LIMIT 0";
$termino= "";
if(isset($_POST['empleados']))
{
	$termino=$mysqli->real_escape_string($_POST['empleados']);
	$consulta="SELECT * FROM empleados WHERE 
	Nombre LIKE '%".$termino."%' OR
	Apellido Paterno LIKE '%".$termino."%' OR
	Apellido Materno LIKE '%".$termino."%' OR
	Departamento LIKE '%".$termino."%'";
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
		<td>".$fila['unidad_medida']."</td>	
		<td>".$fila['nombre_producto']."</td>
		<td>".$fila['codigo_barra']."</td>
		<td>$ ".$fila['precio_costo']."</td>
		<td>$ ".$fila['precio_A']."</td>
		<td>$ ".$fila['precio_B']."</td>	
		<td>$ ".$fila['precio_C']."</td>
		<td>".$fila['marca']."</td>
		</tr>";
	}
	echo "</tbody>
	</table>";
}else{
	echo "<center><h4>No hemos encotrado ningun registro con la palabra "."<strong class='text-uppercase'>".$termino."</strong><h4><center>";
}
?>