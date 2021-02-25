<?php 

include("cabecera.php");

/*codigo php*/
 require ('../config.php'); 

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

$nombre=strtoupper($_POST["nombre"]);
$apellido=strtoupper($_POST["apellido"]);

$email=($_POST["email"]);
$usuario=($_POST["usuario"]);
$pw=md5($_POST["pw"]);
$pregunta=strtoupper($_POST["pregunta"]);
$respuesta=strtoupper($_POST["respuesta"]);
$tipo=strtoupper($_POST["nivel"]);




 
 
  

//$sql="insert into empleados (cod,nombre,apellido,correo,ci,fechai,sex)values('$cod','$nombre','$apellido','$correo','$ci','$fecha','$sex')";

$consulta="select * from `prestaciones`.`administrador` where nombre='$nombre' and apellido='$apellido'";
$resultado=mysql_query($consulta,$cn) or die (mysql_error());
if (mysql_num_rows($resultado)>0)
{
echo "<script> alert('ya existe este registro  por favor intentalo de nuevo con un nombre diferente ')</script>";
} else {





$imagen="avatar3.png";

$sql=" INSERT INTO `prestaciones`.`administrador` (
`nombre` ,
`apellido` ,
`correo` ,
`usuario` ,
`pass` ,
`pregunta` ,
`respuesta`,
`tipo`,
`imagen`

)
VALUES (
 '$nombre', '$apellido', '$email', '$usuario', '$pw', '$pregunta', '$respuesta','$tipo', '$imagen'
)";




$cs=mysql_query($sql,$cn);
echo "<script> alert('se inserto correctamente  '$nombre', '$apellido', '$email', '$usuario', '$pw', '$pregunta', '$respuesta', '$imagen' ')</script>";
		}
	}

?>
</br>
<div class="col-md-7">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Registro De Nuevo Administrador </h3>
                                </div>
								
								
                                <!-- form start -->
                                <form role="form"  name="fe" action="" method="post" >
                                    <div class="box-body">
                                        <div class="form-group">
                                     
											   <label for="exampleInputEmail">Nombre:</label>
											   
											    
     <input  required   type="text" name="nombre" onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" class="form-control" value="<?php echo $var1 ?>" id="exampleInputEmail1" placeholder="Nombre del administrador">
	 
	   <label for="exampleInputEmail">Apellido:</label>
											   
											    
     <input  required   type="text" name="apellido" onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" class="form-control" value="<?php echo $var2 ?>" id="exampleInputEmail1" placeholder="Apellido del administrador">
	 
	   <label for="exampleInputEmail">Correo:</label>
											   
											    
     <input  required   type="text" name="email" class="form-control" value="<?php echo $var3 ?>" id="exampleInputEmail1" placeholder="correo del administrador">
	 
	 
	   <label for="exampleInputEmail">Nombre De Usuario:</label>
											   
											    
     <input  required   type="text" name="usuario"  class="form-control" value="<?php echo $var4 ?>" id="exampleInputEmail1" placeholder="Nombre de usuario  ">
	 
	 			
				<label for="exampleInputEmail">Nivel de usuario:</label>
											   
											    <select  for="exampleInputEmail" class="form-control" name='nivel'>
     <option  value="1">Administrador</option>
     <option value="2">Usuario Invitado</option>
	 
	
     
    
   </select>
				
				
				
				 <label for="exampleInputEmail">clave:</label>
											   
											    
     <input  required   type="password" name="pw"  class="form-control" value="<?php echo $var5 ?>" id="exampleInputEmail1" placeholder="password de seguridad  ">
	 
	 
	     <label for="exampleInputEmail">Pregunta de seguridad:</label>
											   
											    <select  for="exampleInputEmail" class="form-control" name='pregunta'>
     <option  value="Apellido de soltera de mi madre">Apellido de soltera de mi madre</option>
     <option value="Segundo nombre de mi padre">Segundo nombre de mi padre</option>
	 <option value="Heroe De La Infancia">Heroe De La Infancia</option>
	
     
    
   </select>
	 
     <label for="exampleInputFile">Respues  de seguridad</label>
                                          <input   required   id="decimal"  type="text" name="respuesta" class="form-control" value="<?php echo $var6 ?>" id="exampleInputEmail1" placeholder="Respuesta a la pregunta de seguridad">
											
       
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									<center>
                                        <button name="btn1" type="submit" value="Agregar" class="btn btn-primary">Agregar</button>
										
									</center>
                                    </div>
                                </form>
                            </div><!-- /.box -->



<?php




include("pie.php");

?>