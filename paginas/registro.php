<?php 

include("cabecera.php");

/*codigo php*/
 require ('../config.php'); 
  require ('validarnum.php'); 

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

if($btn=="Agregar Nuevo"){

$sql="select count(cod),Max(cod)  from `prestaciones`.`empleados` ";
$cs=mysql_query($sql,$cn);
while($resul=mysql_fetch_array($cs)){
	$count=$resul[0];
	$max=$resul[1];

		}
		if($count==0){
		$var="A0001";
		}	
	else{
		$var="A".substr((substr($max,1)+10001),1);
		}
}

	
	if($btn=="Agregar"){

                


$cod=strtoupper($_POST["cod"]);
$nombre=strtoupper($_POST["nombre"]);
$apellido=strtoupper($_POST["apellido"]);
$correo=strtoupper($_POST["correo"]);
$ci=strtoupper($_POST["ci"]);
$fechai=strtoupper($_POST["fechai"]);

$fechas=strtoupper($_POST["$fechas"]);



 $fecha1= $fechai;
$fecha2=date("Y-m-d",strtotime($fecha1)); 


//$sql="insert into empleados (cod,nombre,apellido,correo,ci,fechai,sex)values('$cod','$nombre','$apellido','$correo','$ci','$fecha','$sex')";

$sql=" INSERT INTO `prestaciones`.`empleados` (
`cedula` ,
`nombre` ,
`apellido` ,
`correo` ,
`fechai` ,
`cod` 

)
VALUES (
 '$ci', '$nombre', '$apellido', '$correo', '$fecha2', '$cod'
)";




$cs=mysql_query($sql,$cn);
echo "<script> alert('se inserto correctamente $cod,$nombre,$apellido,$correo,$ci,$fecha2,$sex  ')</script>";
		}
		

?>
</br>
<div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Empleados</h3>
                                </div>
								
								<form  name="fe" action="" method="post" >
	
		
	<? echo $nameimagen ?> 			
			
				
			
				
      <div class="box-body">
                                        <div class="form-group">
		
          <input type="text" placeholder="A0000............" name="txtbus"/>
          <input type="submit" class="btn btn-primary" name="btn1" value="Buscar" />
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input class="btn btn-primary" name="btn1" type="submit" value="Agregar Nuevo">
		  
		  </div>
		  </div>
		   
		  </form>
                                <!-- form start -->
                                <form role="form"  name="fe" action="" method="post" >
                                    <div class="box-body">
                                        <div class="form-group">
                                           <center>
											   <label for="exampleInputEmail">Fecha De Entrada:</label>
											   	<input  required type="text" placeholder="<?php echo $fecha ?>" name="fechai" class="tcal" value="<?php echo $var5?>" />											   
	   <label for="exampleInputEmail1">CODIGO:</label><input type="text"  border "1 px" placeholder="..............................." name="cod"  size="10" maxlength="10"  required value="<?php echo $var?>"/></center>
											
											
											
											<label for="exampleInputFile">Nombre</label>
                                            <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="tex" name="nombre" class="form-control" value="<?php echo $var2 ?>" id="exampleInputEmail1" placeholder="Intoducir el Nombre">
											<label for="exampleInputFile">Apellido</label>
											<input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" required type="tex" name="apellido" class="form-control" value="<?php echo $var3 ?>" id="exampleInputEmail1" placeholder="Apellido">
											<label for="exampleInputFile">cedula</label>
                                            <input onkeydown="return enteros(this, event)" required type="text" name="ci" class="form-control" value="<?php echo $var1 ?>" id="exampleInputEmail1" placeholder="Cedula">
											<label for="exampleInputFile">correo</label>
											<input  required type="email" name="correo" class="form-control" value="<?php echo $var4 ?>"  placeholder="Correo">
											
                                           
											
  
                                        </div>
                                       
                                     
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button name="btn1" type="submit" value="Agregar" class="btn btn-primary">Agregar</button>
										
									
                                    </div>
                                </form>
                            </div><!-- /.box -->



<?php




include("pie.php");

?>