<?php 

include("cabecera.php");

/*codigo php*/
 require ('../config.php'); 

require '../conectar.php'; 
include_once('../conexiones.php');
?>
</br>
<div class="col-md-10">
                            <!-- general form elements -->
      <?php                   
$con = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);

$consulta_noticias = "SELECT * FROM administrador";
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
	$consulta1 = "SELECT id, usuario, nombre, apellido FROM administrador";
	
	
	$consulta = "SELECT id, usuario, nombre, apellido FROM administrador ORDER BY id ASC LIMIT ".$inicio."," . $TAMANO_PAGINA;
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
                                    <h3> <center>Lista De Usuarios Y Administradores </center></h3>                                    
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
	  <td width="10%" scope="col">Opciones</td>
	 
    </tr>
 
<?php     

 while ($row = mysql_fetch_array($rs)) {
 
echo "<tr>".
      "<td>".$row["usuario"]."</td>".
      "<td>".$row["nombre"]."</td>".
	   "<td>".$row["apellido"]."</td>".
    
      // Establecemos un hipervínculo para cada fila de datos si lo hubiera
      // que apunte al archivo modificar.php, pasando el número de cédula en su
      // dirección a través de la variable Cedula
      "<td>";
	  	    
if($a==1){
								echo "
	  <a  href=editaradmin.php?id=".$row["id"]."><img src='../img/editar.png' width='25' alt='Edicion' title='EDITAR LOS DATOS DE ".$row["nombre"]."'></a> 
	  <a   href=eliminaradmin.php?id=".$row["id"]."><img src='../img/elimina.png'  width='25' alt='Edicion' title='ELIMINAR A ".$row["nombre"]."'></a>
	  ";}
	echo " </td>".
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
	echo '<a style="color: #660099"> Numero de  registros: '.$num_total_registros .'</a>';
echo "</center>";	
	
?>			
				
	</center>	
                            </div>
							</div>
							</div>
							
							
							<!-- /.box -->
 	<?php    
if($a==1){
								echo '
 
  <div class="col-md-3">
  <div class="box">
                                <div class="box-header">
								<div class="box-header">
                                    <h3> <center>Agregar Admin o Usuario Nuevo <a href="#" class="alert-link">Nuevos</a></center></h3>                                    
                                </div>
						<center>		
							<form  name="fe" action="administrador.php" method="post" id="ContactForm">
	

  
    
    <br>
 <input title="AGREGAR UN NUEVO EMPLEADO" name="btn1"  class="btn btn-primary"type="submit" value="Agregar Nuevo">

    
    
  </form>
  </center>
								</div>
							</div>
							</div>	
							'; }?>
						</br>		
								
 
								</div>
								</div>


<?php




include("pie.php");

?>