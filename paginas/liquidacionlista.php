<?php 

include("cabecera.php");

/*codigo php*/
 require ('../config.php'); 

require '../conectar.php'; 
include_once('../conexiones.php');


echo $x1;

$cn=mysql_connect("localhost","root","1234") or die("error en conexion");
	///aqui corta
	//buscar por codigo
 
if(isset($_POST["btn1"])){
	$btn=$_POST["btn1"];
	$bus=$_POST["txtbus"];

	if($btn=="Anular"){

	 $x1=$_GET['codigo'];


//$cod=strtoupper($_POST["cod"]);

 $x11=$_POST["cedula"];
$estado=$_POST["estado"];




//$sql="insert into empleados (cod,nombre,apellido,correo,ci,fechai,sex)values('$cod','$nombre','$apellido','$correo','$ci','$fecha','$sex')";
//update pacientep set p_nom='$nom',

$ultimal2=date("Y-m-d",strtotime($ultimal)); 
$fechai2=date("Y-m-d",strtotime($fechai)); 


$sql="UPDATE `prestaciones`.`empleados` SET `estado` = '' WHERE `empleados`.`cedula` ='".$x11."'";

/*$sql=" UPDATE empleados SET 
estado='$estado' where cod='".$x11."'";
*/


$cs=mysql_query($sql,$cn)or die("Error: ".mysql_error());
echo "<script> alert('Se anulo la liquidacion correctamente')</script>";

}
}

		

?>




</br>
<div class="col-md-10">
                            <!-- general form elements -->
      <?php                   
$con = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);

$consulta_noticias = "SELECT * FROM empleados";
$rs_noticias = mysql_query($consulta_noticias, $con);
$num_total_registros = mysql_num_rows($rs_noticias);
//Si hay registros
if ($num_total_registros > 0) {
	//Limito la busqueda
	$TAMANO_PAGINA = 9;
        $pagina = false;

	//examino la pagina a mostrar y el inicio del registro a mostrar
        if (isset($_GET["pagina"]))
            $pagina = $_GET["pagina"];
        
	if (!$pagina) {
		$inicio = 0;
		$pagina = 1;
	}
	else {
		$inicio = ($pagina - 1) * $TAMANO_PAGINA;
	}
	//calculo el total de paginas
	$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

	

	//oreder by fecha 
	$consulta1 = "SELECT cod, nombre, apellido FROM empleados";
	
	
	$consulta = "SELECT cod, nombre, apellido,estado FROM empleados ORDER BY cod ASC LIMIT ".$inicio."," . $TAMANO_PAGINA;
	$rs = mysql_query($consulta, $con);
	

$hora = date('H:i:s a');
$fecha = date('d-m-Y ');
$aaaa= date('Y');
?>

	
  
  							 <section class="content">
  <div class="row">
  <div class="col-md-9">
  <div class="box">
                                <div class="box-header">
                                    <h3> <center>Lista De Empleados  <a href="#" class="alert-link">/Menu Liquidacion</a></center></h3>                                    
                                </div>
   <div class="box-body table-responsive">
     

   
<? 
echo '<center>';
echo '<p>Mostrando la pagina '.$pagina.' de ' .$total_paginas.' paginas.</h3>'; ?>

</center>
<table id="example1" class="table  table-bordered table-striped">

  <tbody>
    <tr style="background:#6666666;">
      <td bgcolor="#CCCCCC" >Codigo</td>
      <td bgcolor="#CCCCCC">Nombre</td>
      <td bgcolor="#CCCCCC">Apellido</td>
	   <td bgcolor="#CCCCCC">Estado</td>
	  <td width="20%" scope="col">Opciones</td>
	 
    </tr>
 
<?php     

 while ($row = mysql_fetch_array($rs)) {
 $estado=$row["estado"];
 if($estado=='V'){
 $estado='VIGENTE';
 }
  if($estado=='L'){
 $estado='LIQUIDADO';
 }
  if($estado==''){
 $estado='S/N';
 }
 

echo "<tr>".
      "<td>".$row["cod"]."</td>".
      "<td>".$row["nombre"]."</td>".
	   "<td>".$row["apellido"]."</td>".
	     "<td>".$estado."</td>".
    
      // Establecemos un hipervínculo para cada fila de datos si lo hubiera
      // que apunte al archivo modificar.php, pasando el número de cédula en su
      // dirección a través de la variable Cedula
	  
	
	  
      "<td><a  href=agregarli.php?codigo=".$row["cod"]."><img src='../img/consul.png' width='25' alt='Edicion' title=' Realizar Liquidacion De  ".$row["nombre"]."'></a>
	 
	  <a  href=liquidacion.php?codigo=".$row["cod"]."><img src='../img/editar.png' width='25' alt='Edicion' title='EDITAR LIQUIDACION DE ".$row["nombre"]."'></a> <a target='_blank'  href=../pdf/liquidacionpdf.php?codigo=".$row["cod"]."><img src='../img/impresora.png'  width='25' alt='Edicion' title='Imprimir lIQUIDACION DE   ".$row["nombre"]."'></a>
	 </td>".
    "</tr>";
	
 
}
?>
 </tbody>
	</table>
<?
	}
	echo '<p>';
echo '<center>';
	if ($total_paginas > 1) {
		if ($pagina != 1)
			echo '<a href="'.$url.'?pagina='.($pagina-1).'"><img src="../img/flecha.png"  width="25" border="0"></a>';
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pagina == $i)
				//si muestro el ï¿½ndice de la pï¿½gina actual, no coloco enlace
				echo $pagina;
			else
				//si el ï¿½ndice no corresponde con la pï¿½gina mostrada actualmente,
				//coloco el enlace para ir a esa pï¿½gina
				echo '  <a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
		}
		if ($pagina != $total_paginas)
			echo '<a href="'.$url.'?pagina='.($pagina+1).'"><img src="../img/flechad.png"  width="25" border="0"></a>';
	}
	
	echo '</p>';
echo '</center>';
echo '<center>';
	//pongo el nï¿½mero de registros total, el tamaï¿½o de pï¿½gina y la pï¿½gina que se muestra
	echo '<a style="color: #660099"> Numero de Empleados registrados: '.$num_total_registros .'</a>';
echo "</center>";	
	
?>			
				
	</center>	
                            </div>
							</div>
							</div>
							
							
							<!-- /.box -->
 
 
  <div class="col-md-3">
  <div class="box">
                                <div class="box-header">
								<div class="box-header">
                                    <h3> <center>Buscar Empleados<a href="#" class="alert-link"></a></center></h3>                                    
                                </div>
						<center>		
							<form  name="fe" action="registro.php" method="post" id="ContactForm">
	

  
    <input title="ESCRIBA EL NOMBRE O CODIGO DEL EMPLEADO QUE QUIERE BUSCAR" name="txtbus" type=text   placeholder='Buscar Empleado.....'>
    <br></br>


    <input  class="btn btn-primary"title="Aqui Buscar el Empleado Por CODIGO,NOMBRE,APELLIDO,ETC" name="btn1" type="submit" value="Buscar">
    
  </form>
  </center>
								</div>
							</div>
							</div>	
						</br>		
								
  <div class="col-md-3">
  <div class="box">
                                <div class="box-header">
								<center>
								<div class="box-header">
								   <h3> <center>Imprimir Lista De Empleados</a></center></h3>                                    
                                </div>
								
								
								 <a target='_blank'  href=../pdf/listaderegistros.php><img src='../img/impresora.png'  width='50' alt='Edicion' title='Imprimir lista de Registro De empleados'></a>
								</center>
								</div>
								</div>
								</div>


<?php




include("pie.php");

?>