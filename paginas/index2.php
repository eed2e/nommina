<?php

	require_once("../sesion.class.php");
	
	$sesion = new sesion();
	$usuario = $sesion->get("usuario_dq");
	
	if( $usuario == false )
	{	
		header("Location: ../index.php");		
	}
	else 
	{
	
	date_default_timezone_set('America/caracas');
$hora = date('H:i:s a');
$fecha = date('d-m-Y ');
$hh = '10';

 include_once("../config.php");
 

require '../conectar.php'; 
include_once('../conexiones.php');
		
		$consulta = "select usuario,tipo,nombre,apellido,correo,imagen from administrador where usuario = '$usuario';";
		
		$result = $conexion->query($consulta);
		
		if($result->num_rows > 0)
		{
			$fila = $result->fetch_assoc();
			
			 $a=$fila["tipo"];
			
		  $b=$fila["nombre"];
			
			$c=$fila["apellido"];
			$d=$fila["correo"];
			$imagen=$fila["imagen"];

				
				if ($a == 1)
				{
				$tipo= "Adminitrador";
				}else {
				$tipo="Usuario";
				}
		}


	?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Prestaciones </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
		

        <script src="../js/calendario/jquery-ui.min.js" type="text/javascript" ></script>
        <script src="../js/tipo_alimen.js"></script>
        <script src="../js/validarfrom.js"></script>
        <!--<script src="cordova.js"></script>-->

        <script>
        $(function() {
            $( "[data-role='navbar']" ).navbar();
            $( "[data-role='header'], [data-role='footer']" ).toolbar();
        });
        // Update the contents of the toolbars
        $( document ).on( "pagecontainerchange", function() {
            // Each of the four pages in this demo has a data-title attribute
            // which value is equal to the text of the nav button
            // For example, on first page: <div data-role="page" data-title="Info">
            var current = $( ".ui-page-active" ).jqmData( "title" );
            // Change the heading
            $( "[data-role='header'] h1" ).text( current );
            // Remove active class from nav buttons
            $( "[data-role='navbar'] a.ui-btn-active" ).removeClass( "ui-btn-active" );
            // Add active class to current nav button
            $( "[data-role='navbar'] a" ).each(function() {
                if ( $( this ).text() === current ) {
                    $( this ).addClass( "ui-btn-active" );
                }
            });
        });
    </script>
        
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="#" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Prestaciones Sociales
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                          
                            
                        <!-- Notifications: style can be found in dropdown.less -->
                        
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                           
                           
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span> <?php echo $b;  ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
								
								
                                    <img src="../img/<?php echo $imagen; ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $b;  ?>, <?php echo $c; ?> 
                                        <small><?php echo $d; ?></small>
										<small><?php echo $tipo; ?></small>
										
                                    </p></br>
                                </li>
                                <!-- Menu Body -->
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    
                                    <div class="pull-right">
                                        <a href="cerrar.php"  id="closed"  class="btn btn-default btn-flat" data-id="info" data-ajax="false">Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>hola, <?php echo $usuario;  ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
                        </div>
                    </div>
                    <!-- search form -->
                   
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                                        <ul class="sidebar-menu">
                        
                        <li class="active">
                            <a href="index2.php" data-ajax="false">
                                <i class="fa fa-th"></i> <span>Principal</span> 
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="index2.php" data-ajax="false">
                               
                                <span>Registro De Empleado</span>
                               <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                
                                <li><a href="empleadoslista.php" data-ajax="false"><i class="fa fa-angle-double-right"></i>Lista de Empleados </a></li>
								
                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                
                                <span>Prestaciones</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="empleadoslista.php" data-ajax="false"><i class="fa fa-angle-double-right"></i>Consultar Prestacion</a></li>
                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                 <span>Salarios & Intereses</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="meses.php" data-ajax="false"><i class="fa fa-angle-double-right"></i>Consultar Salarios</a></li>
                       
                            </ul>
                        </li>
                       
                       <li class="treeview">
                            <a href="categorias.php?cate=5" data-ajax="false">
                              <i class="fa fa-angle-left pull-right"></i> <span>Liquidacion </span>
                            </a>
                            <ul class="treeview-menu">
                     <li><a href="liquidacionlista2.php" data-ajax="false"><i class="fa fa-angle-double-right"></i> Liquidados</a></li>
                              
                            </ul>
                        </li>
                             <li class="treeview">
                            <a href="administrador.php">
                                 <i class="fa fa-angle-left pull-right"></i> <span>Administrador</span>
                            </a>
                            <ul class="treeview-menu">
                  
                     
                                  
								  <li><a href="administradores.php" data-ajax="false"><i class="fa fa-angle-double-right"></i>Lista De Usuarios </a></li>
                                
								<li><a href="respaldo.php" data-ajax="false"><i class="fa fa-angle-double-right"></i>Respaldar Base De Datos</a></li>
                            </ul>
                        </li>
                        
						   
                    </ul>

					
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Prestaciones Sociales
                        <small>& liquidaciones </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> INICIO</a></li>
                        <li class="active">Categoria Principales</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <h4 class="page-header">
                        OPCIONES PRINCIPALES PARA REGISTRO Y MANTENIMIENTO DE LAS PRESTACIONES SOCIALES<small>seleccione la opcion que desea editar o Consultar <code>!seleccione correctamente¡</code><code></code></small>
                   </h4>
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                         Empleados
                                    </h3>
                                    <p>
                                        agregar o editar Empleados
                                    </p>
                                </div>
								
                                <div class="icon"><a href="empleadoslista.php"  id="alimen" data-icon="custom" data-transition="slide" data-prefetch="true" data-id="alimen" class="small-box-footer"><img src="../css/images/empleado2.png"  width='50' height='50'  alt="">
                                    
                                </div>
                                
                                    MAS INFORMACION <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
						
						<!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                       Prestaciones<sup style="font-size: 20px"></sup>
                                    </h3>
                                    <p>
                                       Prestaciones Sociales
                                    </p>
                                </div>
                                <div class="icon">
                                    <a href="empleadoslista.php" class="small-box-footer"><img src="../css/images/prestacion2.png"  width='50' height='50'  alt="">
                                </div>
                                <a href="empleadoslista.php" class="small-box-footer">
                                    MAS INFORMACION <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>Liquidacion </h3>
                                    <p>
                                        Planillas de Liquidacion
                                    </p>
                                </div>
                                <div class="icon">
                                    <a href="liquidacionlista2.php" class="small-box-footer"><img src="../css/images/liquida.png"  width='50' height='50'  alt="">
                                </div>
                                <a href="liquidacionlista2.php" class="small-box-footer">
                                    MAS INFORMACION <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                       Salarios 
                                    </h3>
                                    <p>
                                        Salarios & Intereses.
                                    </p>
                                </div>
                                <div class="icon">
                                     <a href="meses.php" class="small-box-footer"><img src="../css/images/liquidacion2.png"  width='50' height='50'  alt="">
                                </div>
                                <a href="meses.php" class="small-box-footer">
                                    MAS INFORMACION <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- Small boxes (Stat box) -->
                 
                    <!-- Widgets as boxes -->
                  

                   
                        <!-- START ACCORDION & CAROUSEL-->
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Opciónes de Administrador</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                      <?php                   
$con = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);

$consulta_noticias = "SELECT * FROM empleados";
$rs_noticias = mysql_query($consulta_noticias, $con);
$num_total_registros = mysql_num_rows($rs_noticias);
//Si hay registros
if ($num_total_registros > 0) {
	//Limito la busqueda
	$TAMANO_PAGINA = 5;
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
	  <td width="10%" scope="col">Opciones</td>
	 
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
	  
	
	  
      "<td>
	 
	  <a target='_blank'  href=../pdf/prestacionespdfbien.php?codigo=".$row["cod"]."><img src='../img/impresora.png'  width='25' alt='Edicion' title='Imprimir lIQUIDACION DE   ".$row["nombre"]."'></a>
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
                                          
                            
                        <!-- ./col -->
                    <!-- /.row -->
												
                                        
                                   
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                       <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Ultimos Meses Registrados</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                        <?php                   
$con = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);

$consulta_noticias = "SELECT * FROM salario";
$rs_noticias = mysql_query($consulta_noticias, $con);
$num_total_registros = mysql_num_rows($rs_noticias);
//Si hay registros
if ($num_total_registros > 0) {
	//Limito la busqueda
	$TAMANO_PAGINA = 5;
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
	$consulta1 = "SELECT id, fechac, salario FROM salario";
	
	
	$consulta = "SELECT  id, fechac,fechaf, salario,nombremes,dias,interes,totaldias FROM salario ORDER BY fechac DESC LIMIT ".$inicio."," . $TAMANO_PAGINA;
	$rs = mysql_query($consulta, $con);
	

$hora = date('H:i:s a');
$fecha = date('d-m-Y ');
$aaaa= date('Y');
?>

	

 
<? 
echo '<center>';
echo '<p>Mostrando la pagina '.$pagina.' de ' .$total_paginas.' paginas.</h3>'; ?>

</center>
<table id="example1" class="table  table-bordered table-striped">

  <tbody>
    <tr style="background:#6666666;">
      <td bgcolor="#CCCCCC" >Fecha Inicio</td>
      <td bgcolor="#CCCCCC">Fecha Fin</td>
      <td bgcolor="#CCCCCC">Salario</td>
	  <td bgcolor="#CCCCCC">Interes</td>
	  <td bgcolor="#CCCCCC">Dias Libres</td>
	  <td width="10%" scope="col">Opciones</td>
	 
    </tr>
 
<?php     

 while ($row = mysql_fetch_array($rs)) {
 
 $fecha111= $row['fechac'];
$fecha222=date("d-m-Y",strtotime($fecha111)); 

$fecha1111= $row['fechaf'];
$fecha2222=date("d-m-Y",strtotime($fecha1111)); 
 
 
    
echo "<tr>".


      "<td>".$fecha222."</td>".
      "<td>".$fecha2222."</td>".
	   "<td>".$row["salario"]."</td>".
	     "<td>".$row["interes"]."</td>".
		   "<td>".$row["dias"]."</td>".
    
      // Establecemos un hipervínculo para cada fila de datos si lo hubiera
      // que apunte al archivo modificar.php, pasando el número de cédula en su
      // dirección a través de la variable Cedula
      "<td>
	  
	   <a target='_blank'  href=../pdf/prestacionespdfbien.php?codigo=".$row["id"]."><img src='../img/impresora.png'  width='25' alt='Edicion' title='Imprimir reporte de prestaciones de  ".$row["nombre"]."'></a>
	 
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
									
									
							

                      
                        </div><!-- /.col -->
                    <!-- END ACCORDION & CAROUSEL-->


        <!-- jQuery 2.0.2 -->
            <script src="../js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="../js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="../js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="../js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="../js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="../js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../js/AdminLTE/dashboard.js" type="text/javascript"></script>  

    </body>
</html>
<?php
}
?>
