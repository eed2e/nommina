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

$var8="";

$var9="";

//buscar por nombre
 $cn=mysql_connect("localhost","root","1234") or die("error en conexion");
if(isset($_POST["btn1"])){
	$btn=$_POST["btn1"];
	$bus=$_POST["txtbus"];

	if($btn=="Buscar"){

$sql="select * from `prestaciones`.`administrador` where nombre='$bus'";


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

$sql="select * from `prestaciones`.`administrador` where id='$bus'";


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

$sql="select * from `prestaciones`.`administrador` where apellido='$bus'";


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

                


$cod=strtoupper($_POST["usuario"]);
$nombre=strtoupper($_POST["nombre"]);
$apellido=strtoupper($_POST["apellido"]);
$correo=strtoupper($_POST["correo"]);
$ci=strtoupper($_POST["tipo"]);
$fechai=md5($_POST["pass"]);
$sex=strtoupper($_POST["pregunta"]);
$fechas=strtoupper($_POST["respuesta"]);
$foto="avatar3.png";


 
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
 $x1=$_GET['id'];




$sql=" UPDATE administrador SET 
nombre='$nombre' ,
apellido='$apellido' ,
tipo='$ci' ,
correo='$correo' ,
usuario='$cod',
pass='$fechai',
imagen='$foto'

 where id='$x1'";

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
echo "<script> alert('se edito correctamente $cod,$nombre,$apellido,$correo,$ci,$fecha2,$fechas,$sex  ')</script>";

}
}
if($btn=="Eliminar"){

 $x1=$_GET['id'];
$cod=$_POST["cod"];


$sql="delete from administrador where id='$x1'";

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
                                    <h3 class="box-title">Registro de Administrador</h3>
                                </div>
								
								<form  name="fe" action="" method="post" >
	
		
		
				
			
				
   	<?
	
	 $x1=$_GET['id'];
	$query="SELECT * FROM administrador WHERE id='".$x1."'";
	$result=mysql_query($query,$link) or die("Error: ".mysql_error());
	 
	
	

	while($Rs=mysql_fetch_array($result)) {

		?>   
		  </form>
                                <!-- form start -->
                                <form role="form"  name="fe" action="" method="post" >
                                    <div class="box-body">
                                        <div class="form-group">
                                  
											
											
											<label for="exampleInputFile">Nombre de usuario</label>
                                            <input   type="tex"   name="usuario" class="form-control" value="<?php echo $Rs['usuario']; ?>" id="exampleInputEmail1" placeholder="Intoducir el Nombre de usuario">
											
												
											
											<label for="exampleInputFile"> Nueva Clave</label>
                                            <input   type="password"   name="pass" class="form-control"  id="exampleInputEmail1" placeholder="Intoducir clave nueva">
											
											<label for="exampleInputFile">Nombre</label>
                                            <input  required type="tex" onKeyPress="return caracteres(event)" onBlur="this.value=this.value.toUpperCase();"  name="nombre" class="form-control" value="<?php echo $Rs['nombre']; ?>" id="exampleInputEmail1" placeholder="Intoducir el Nombre">
											<label for="exampleInputFile">Apellido</label>
											<input   onkeypress="return caracteres(event)" onBlur="this.value=this.value.toUpperCase();" required type="tex" name="apellido" class="form-control" value="<?php echo $Rs['apellido']; ?>" id="exampleInputEmail1" placeholder="Apellido">
											
											
											<label for="exampleInputEmail">Nivel De Usuario:</label>
											   
											    <select  for="exampleInputEmail" class="form-control" name='tipo'>
												 <option  value="2">Seleccione un nivel</option>
     <option  value="1">Administrador</option>
     <option value="2">Usuario</option>
	
     
    
   </select>
											
											
								
											<label for="exampleInputFile">correo</label>
											<input  required type="email" name="correo" class="form-control" value="<?php echo $Rs['correo']; ?>"  placeholder="Correo">
											
                                        </div>
                                       
           <?
		   }
		   ?>                          
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									<center>
                                       
										<button name="btn1"  onClick="return confirm('Esta seguro que desea Eliminar este Registro? se perderan todos los datos');" type="submit" value="Eliminar" class="btn btn-primary">Eliminar</button>
										
								</center>	
                                    </div>
                                </form>
                            </div><!-- /.box -->



<?php




include("pie.php");

?>