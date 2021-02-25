<?php 

include("cabecera.php");

/*codigo php*/
 require ('../config.php'); 
 
   include_once('../conexion.php');
    include_once('../conexiones.php');

  $link=conectarse() ;

if(isset($_POST["submit"])){

	$query = "UPDATE empleado SET nombre='".$_POST["cod"]."'";
	$result=mysql_query($query,$link) or die("Error: ".mysql_error());
	echo"</br>";
	echo"</br>";
	echo"<center>";
	echo "Se ha modificado el producto con exito ".$x1;
	 echo"</center>";

}else{

$x1=$_GET['codigo'];


	$query="SELECT * FROM empleados WHERE cod='".$x1."'";
	$result=mysql_query($query,$link) or die("Error: ".mysql_error());
	 
	
	if(mysql_num_rows($result) > 0){

	while($Rs=mysql_fetch_array($result)) {
	
	
 ?>
 
 </br>
 
 
 <section class="content">
  <div class="row">

<div class="col-md-9">

<?php 

}

$fechaf="select ultimal,fechai from empleados where cod='".$x1."'";
$suma2 = $conexion->query($fechaf);

if (!$suma2) {
    echo 'No se pudo ejecutar la consulta: ';
    exit;
}
$fila = $suma2-> fetch_row();
$fechaff = $fila[0]; // el valor que quiero 
$fechaii = $fila[1]; // 



date_default_timezone_set('America/caracas');
$hora = date('Y-m-d');
$fecha = date('d-m-Y ');



 $salario="SELECT * FROM empleados,salario WHERE cod='".$x1."' and  fechai and fechaf BETWEEN '$fechaii' AND '$hora' order by id";



//$salario="SELECT * FROM salario order by id";

$result2=mysql_query($salario,$link) or die("Error: ".mysql_error());

?>
 <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Historial Completo de Prestaciones Sociales</h3>                                    
                                </div>
								<!-- /.box-header -->
                                <div class="box-body table-responsive">
<table id="example1" class="table table-bordered table-striped">

  <tr >
    <th width="10%" scope="col">Periodo</th>
    <th scope="col">Salario Base</th>
    <th scope="col">Diario</th>
    <th scope="col">Alicuota Utilidades</th>
    <th scope="col">Alicuota Bono Vacacional</th>
    <th scope="col">Salario Integral</th>
    <th width="5%" scope="col">Dias</th>
    <th scope="col">Prestaciones Sociales</th>
    <th scope="col">Acumulado</th>
    <th scope="col">Tasa De Interes</th>
    <th scope="col">Total De Dias</th>
    <th scope="col">Interes Acumulado Por Pagar</th>
  </tr>

    
<?php     

echo $f;
$ali=16/12; //alicuota bono vacacional

 $var = 0;
 $var1 = 0;
 $var2 = 0;
 $var3 = 0;
 $var4 = 0;
 $var5 = 0;
 $var6 = 0;
 $var7 = 0;
  $var8 = 0;
   $var9 = 0;
 while ($row=mysql_fetch_array($result2)) {
 $a= $row["salario"]; //salario base
 $b=$a/30;  //diario
 $c=$b*2.50; //alicuota
 $d=$b*$ali; //alicuota bono
 $e=$a+$c+$d; //salario integral
 $f=$e/30*$row["dias"];//prestaciones sociales
 $g=$f+$g;//acumulado
 $h=($g*$row["interes"]/100)/360*$row["totaldias"];
 
    
		
		   
    // ...
        $var += $row['salario'];
		 $var1 += $b;
		 $var2 += $c;
		 $var3 += $d;
		 $var4 += $e;
		 $var5 += $row['dias'];
		 $var6 += $f;
		$var7 +=$row['interes'];
		$var8 +=$row['totaldias'];
		$var9 += $h;
    //...
     
   
 
echo "<tr>".
      "<td>".$row["nombremes"]."</td>".
      "<td>".$row["salario"]."</td>".
	  "<td>".round($b,2)."</td>".
	   "<td>".round($c,2)."</td>".
	    "<td>".round($d,2)."</td>".
		"<td>".round($e,2)."</td>".
		 "<td>".$row["dias"]."</td>".
		 "<td>".round($f,2)."</td>".
		 "<td>".round($g,2)."</td>".
		  "<td>".$row["interes"]."</td>".
		  "<td>".$row["totaldias"]."</td>".
		  "<td>".round($h)."</td>".
		  
	 
    
      
     
    "</tr>";
 
} 
 
?>
 <tfoot  bgcolor="#66CC99">
                                            <tr>
                                                <th>Total</th>
                                                <th><?php echo round( $var,2) ?></th>
                                                <th><?php echo round( $var1,2) ?></th>
												<th><?php echo round( $var2,2) ?></th>
												<th><?php echo round( $var3,2) ?></th>
												<th><?php echo round( $var4,2) ?></th>
												<th><?php echo round( $var5,2) ?></th>
												<th><?php echo round( $var6,2) ?></th>
												<th><?php echo round( $g,2) ?></th>
                                                <th><?php echo round( $var7,2) ?></th>
												 <th><?php echo round( $var8,2) ?></th>
												  <th><?php echo round( $var9,2) ?></th>
                                               
                                            </tr>
                                        </tfoot>
	</table>
	
	</br>
	<center> <a href="<?php echo "prestacion2.php?codigo=".$x1.""; ?>" ><img src="../img/historial.png"  width='50' height='50'  title="Historial Completo" alt="">
<a> </a><a href=""><img src="../img/impresora.png"  width='50' height='50'  title="Imprimir" alt=""></a>
</center>

<?php

	   
	}else{
		
		echo"<center>";
	    echo "No fué posible realizar la operación solicitada  ".$x1;
		echo"</center>";
	
	  echo"<center>";
  echo"<div class='button black'><a href='modificar.php'>Intentar nuevamente</a></div>";
   echo"</center>";
	}
}

?>

</div>
</div>
</div>
<?php 
$x1=$_GET['codigo'];


	$query="SELECT * FROM empleados WHERE cod='".$x1."'";
	$result=mysql_query($query,$link) or die("Error: ".mysql_error());
	 
	
	if(mysql_num_rows($result) > 0){

	while($Rs=mysql_fetch_array($result)) {
	
	
 ?>
 
 
 
 
 <section class="content">
                    <div class="row">
 <div class="col-xs-3">
 
  <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">Datos Personales</h4>
                                </div>

 <div class="box-body">
 <table id="example1" class="table table-bordered table-striped" >
 <tr>
 <td>
	<label for="exampleInputFile">Nombre</label>
	</td>
	<td>
	
<?php echo $Rs['nombre']; ?> </br>
	</td>
	</tr>
	<tr>
	<td><label for="exampleInputFile">Apellido</label>
	</td><td>
<?php echo $Rs['apellido']; ?>
</td>
</tr>
<tr>
<td>
	<label for="exampleInputFile">Cedula</label>
	</td>
	<td>
<?php echo $Rs['cedula']; 
?>
</td>
</tr>
<tr>
<td>
	<label for="exampleInputFile">Correo</label>

</td>
<td><?php echo $Rs['correo']; 
?>
</td>
</tr>
<tr>
<td>
	<label for="exampleInputFile">Fecha De Ingreso</label>
</td>
<td><?php $fe= $Rs['fechai']; 
$fecha22=date("d-m-Y",strtotime($fe)); 


 echo $fecha22; 

?></td>

</tr>
<tr>
<td>
	<label for="exampleInputFile">Fecha De Salida</label>
	</td>
	<?php
	if($Rs['ultimal']==""){
	$Rs['ultimal']=$fecha;
	}
	?>
	<td>
<?php



 $fecha1= $Rs['ultimal'];
$fecha2=date("d-m-Y",strtotime($fecha1)); 


 echo $fecha2; 
echo '</td></tr></table>';
}
}
?>
</div>



</div>



                            <!-- Success box -->
                           <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Total De Prestaciones </h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                      
                                    </div>
                                </div>
                                
                                    <div class="box-body">
									<table id="example1" class="table table-bordered table-striped" >
									<tr>
									<td>
	<label for="exampleInputFile">Utilidad</label>
	</td>
	<td>
	
	<?php

$sql = mysql_query("SELECT id,salario FROM salario ORDER BY id ASC LIMIT 10"); 
$a = 0;
$cant = mysql_num_rows($sql);
while($row = mysql_fetch_array($sql)){
    $a++;
	
   if($a == $cant){ 
        echo $utilidad=$row['salario'];
    } else {
        echo' '.$row['nick'].' ';
    }
	
}
							
								?> 

</td>
</tr>
<tr>
<td>
	
	<label for="exampleInputFile">Vacaciones</label>
	</td>
	<td>
	<?php

$sql = mysql_query("SELECT id,salario FROM salario ORDER BY id ASC LIMIT 10"); 
$a = 0;
$cant = mysql_num_rows($sql);
while($row = mysql_fetch_array($sql)){
    $a++;
	
   if($a == $cant){ 
        '<font color="red"> '.$aa=$row['salario'].'</font> ';
    } else {
        echo' '.$row['nick'].' ';
    }
	
}

							$aaa=$aa/30; //total vacaciones
						$vacaciones=	19* round($aaa,2) 	; 
	echo 	$vacaciones;
                                 ?>  
								 
								</td>
</tr>
<tr>
<td>

							
	<label for="exampleInputFile">Bono Vacacional</label>
	</td>
	<td>
	<?php echo 	$vacaciones; ?>							
	</td>
	</tr>
	<tr>
	<td>
	<label for="exampleInputFile">Prestaciones</label>	
	</td>
	<td> 
								<?php echo round( $var6,2) ?> 
                               
				</td>
				</tr>
				<tr>
				<td>
								
		 
	<label for="exampleInputFile">Interes</label>	 
	</td>
	<td>
	<?php echo round( $var9,2) ?>
	</td>
	</tr>
	<tr>
	<td>
	<label for="exampleInputFile">Total a Pagar</label>	 
	</td>
	<td>
	<?php $var10= $var9+$var6+$vacaciones+$vacaciones+$utilidad; //total a pagar
	
	 echo '<font color="red">'  .round( $var10,2).' </font>'; ?>
	</td>
	</tr>
	</table>
 </div><!-- /.box-body -->
                            </div><!-- /.box -->


</div>

</div>



<?php



include("pie.php");

?>