<?php 

include("cabecera.php");
 require ('validarnum.php'); 
/*codigo php*/
 require ('../config.php'); 
include_once('../conexiones.php');

  $link=conectarse() ;
$var1="";
$var2="";
$var3="";
$var4="";
$var5="";
$var6="";
$var7="";


//buscar por nombre
 $cn=mysql_connect("localhost","root","1234") or die("error en conexion");
if(isset($_POST["btn1"])){
	$btn=$_POST["btn1"];
	$bus=$_POST["txtbus"];

	if($btn=="Buscar"){

$sql="select * from `prestaciones`.`empleados` where nombre='$bus'";


$cs=mysql_query($sql);
while($resul=mysql_fetch_array($cs)){
	$var6=$resul[0];
	$var1=$resul[1];
	$var2=$resul[2];
	$var3=$resul[3];
	$var4=$resul[4];
	$var5=$resul[5];
	$var=$resul[6];
	$var7=$resul[7];

}
	if($var7=="M"){
		$var7="selected";
		}
	}
	
	}
	//ejemplo 2
	
	//buscar por codigo
 
if(isset($_POST["btn1"])){
	$btn=$_POST["btn1"];
	$bus=$_POST["txtbus"];

	if($btn=="Buscar"){

$sql="select * from `prestaciones`.`empleados` where cod='$bus'";


$cs=mysql_query($sql,$cn);
while($resul=mysql_fetch_array($cs)){
	$var6=$resul[0];
	$var1=$resul[1];
	$var2=$resul[2];
	$var3=$resul[3];
	$var4=$resul[4];
	$var5=$resul[5];
	$var=$resul[6];
	$var7=$resul[7];

}
	if($var7=="M"){
		$var7="selected";
		}
	}
	
	}
	///aqui corta
	//buscar por codigo
 
if(isset($_POST["btn1"])){
	$btn=$_POST["btn1"];
	$bus=$_POST["txtbus"];

	if($btn=="Buscar"){

$sql="select * from `prestaciones`.`empleados` where apellido='$bus'";


$cs=mysql_query($sql,$cn);
while($resul=mysql_fetch_array($cs)){
	$var6=$resul[0];
	$var1=$resul[1];
	$var2=$resul[2];
	$var3=$resul[3];
	$var4=$resul[4];
	$var5=$resul[5];
	$var=$resul[6];
	$var7=$resul[7];

}
	
	}

}



	
	if($btn=="Editar"){

                


$cod=strtoupper($_POST["cod"]);
$nombre=strtoupper($_POST["nombre"]);
$apellido=strtoupper($_POST["apellido"]);
$correo=strtoupper($_POST["correo"]);
$ci=strtoupper($_POST["ci"]);
$fechai=strtoupper($_POST["fechai"]);
$sex=strtoupper($_POST["sex"]);
$fechas=strtoupper($_POST["$fechas"]);



 $fecha1= $fechai;
$fecha2=date("Y-m-d",strtotime($fecha1)); 
if( $nombre=="" )
				{
				
					echo "
   <script> alert('campos vacios')</script>
   ";
					echo "<br>";
					
				}
		else
		   {

//$sql="insert into empleados (cod,nombre,apellido,correo,ci,fechai,sex)values('$cod','$nombre','$apellido','$correo','$ci','$fecha','$sex')";
//update pacientep set p_nom='$nom',
 $x1=$_GET['codigo'];


$sql=" UPDATE empleados SET 
nombre='$nombre' ,
apellido='$apellido' ,
cedula='$ci' ,
correo='$correo' ,
fechai='$fecha2' where cod='$x1'";

/*$sql= "UPDATE empleados SET 
nombre = '$nombre'
apellido = '$apellido'
correo = '$correo'
fechai = '$fecha2'
estado = '$estado'
WHERE cedula ='$cedula'
";


	*/


$cs=mysql_query($sql,$link)or die("Error: ".mysql_error());
echo "<script> alert('se edito correctamente $cod,$nombre,$apellido,$correo,$ci,$fecha2  ')</script>";

}
}
if($btn=="Eliminar"){

 $x1=$_GET['codigo'];
$cod=$_POST["cod"];


$sql="delete from empleados where cod='$x1'";

$cs=mysql_query($sql,$link)or die("Error: ".mysql_error());;
$sql2="delete from liquidacion where codigo='$x1'";
$cs1=mysql_query($sql2,$link)or die("Error: ".mysql_error());;
echo "<script> alert('se ELIMINO correctamente ')</script>";
		}

		

?>
</br>
<div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Empleados</h3>
                                </div>
								
								<form  name="fe" action="" method="post" >
	
		
		
				
			
				
   	<?
	
	 $x1=$_GET['codigo'];
	$query="SELECT * FROM empleados WHERE cod='".$x1."'";
	$result=mysql_query($query,$link) or die("Error: ".mysql_error());
	 
	
	

	while($Rs=mysql_fetch_array($result)) {
		?>   
		  </form>
                                <!-- form start -->
                                <form role="form"  name="fe" action="" method="post" >
                                    <div class="box-body">
                                        <div class="form-group">
                                           <center>
											   <label for="exampleInputEmail">Fecha De Entrada:</label>
											   	<input  required type="text" placeholder="<?php echo $fecha ?>" name="fechai" class="tcal" value="<?php echo $Rs['fechai']; ?>" />											   
	   </center>
											
											
											
											<label for="exampleInputFile">Nombre</label>
                                            <input  required type="tex" onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();"  name="nombre" class="form-control" value="<?php echo $Rs['nombre']; ?>" id="exampleInputEmail1" placeholder="Intoducir el Nombre">
											<label for="exampleInputFile">Apellido</label>
											<input   onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" required type="tex" name="apellido" class="form-control" value="<?php echo $Rs['apellido']; ?>" id="exampleInputEmail1" placeholder="Apellido">
											<label for="exampleInputFile">cedula</label>
                                            <input  onkeydown="return enteros(this, event)" required type="text" name="ci" class="form-control" value="<?php echo $Rs['cedula']; ?>" id="exampleInputEmail1" placeholder="Cedula">
											<label for="exampleInputFile">correo</label>
											<input  required type="email" name="correo" class="form-control" value="<?php echo $Rs['correo']; ?>"  placeholder="Correo">
											
                                        </div>
                                       
           <?
		   }
		   ?>                          
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									<center>
                                        <button name="btn1"  onClick="return confirm('Esta seguro que desea Editar este Registro?');" type="submit" value="Editar" class="btn btn-primary">Editar</button>
										<button name="btn1"  onClick="return confirm('Esta seguro que desea Eliminar este Registro? se perderan todos los datos');" type="submit" value="Eliminar" class="btn btn-primary">Eliminar</button>
										
								</center>	
                                    </div>
                                </form>
                            </div><!-- /.box -->



<?php




include("pie.php");

?>