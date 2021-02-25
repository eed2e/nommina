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

$mes=strtoupper($_POST["mes"]);
$ano=strtoupper($_POST["ano"]);
//diciembre enero
if ($mes=='-01-01'){
$nombredia='Enero 15';
$ndias=31;
$mes2='-01-14'; 
}
//enero febrero
if ($mes=='-01-15'){
$nombredia='Febrero 15';
$ndias=31;
$mes2='-02-14'; 
}
//febrero marzo
if ($mes=='-02-15'){
$nombredia='Marzo 15';
$dias=15;
$ndias=31;
$mes2='-03-14'; 
}
//marzo abril
if ($mes=='-03-15'){
$nombredia='Abril 15';
$ndias=30;
$mes2='-04-14'; 
}

//abril mayo
if ($mes=='-04-15'){
$nombredia='Mayo 15';
$ndias=31;
$mes2='-05-14'; 
}
// mayo junio
if ($mes=='-05-15'){
$nombredia='Junio 15';
$dias=15;
$ndias=30;
$mes2='-06-14'; 
}
//  junio julio
if ($mes=='-06-15'){
$nombredia='Julio 15';

$ndias=31;
$mes2='-07-14'; 
}
//  julio / agosto
if ($mes=='-07-15'){
$nombredia='Agosto 15';
$ndias=31;
$mes2='-08-14'; 
}
//  agosto /septiembre
if ($mes=='-08-15'){
$nombredia='Septiembre 15';
$ndias=30;
$mes2='-09-14'; 
}
//  septiembre/octubre
if ($mes=='-09-15'){
$nombredia='Octubre 15';
$dias=15;
$ndias=31;
$mes2='-10-14'; 
}
// octubre/noviembre
if ($mes=='-10-15'){
$nombredia='Noviembre 15';
$ndias=30;
$mes2='-11-14'; 
}
//  noviembre/diciembre
if ($mes=='-11-15'){
$nombredia='Diciembre 15';
$dias=21;
$ndias=31;
$mes2='-12-14'; 
}

$fecha2=date("$ano"."$mes"); 
$fechaf=date("$ano"."$mes2");





$salario=strtoupper($_POST["salario"]);
$interes=strtoupper($_POST["interes"]);




 
 
  

//$sql="insert into empleados (cod,nombre,apellido,correo,ci,fechai,sex)values('$cod','$nombre','$apellido','$correo','$ci','$fecha','$sex')";

$consulta="select * from `prestaciones`.`salario` where fechac='$fecha2'";
$resultado=mysql_query($consulta,$cn) or die (mysql_error());
if (mysql_num_rows($resultado)>0)
{
echo "<script> alert('ya existe este registro  por favor intentalo de nuevo con una fecha diferente ')</script>";
} else {







$sql=" INSERT INTO `prestaciones`.`salario` (
`fechac` ,
`fechaf` ,
`salario` ,
`nombremes` ,
`dias` ,
`interes` ,
`totaldias`
)
VALUES (
 '$fecha2', '$fechaf', '$salario', '$nombredia', '$dias', '$interes', '$ndias'
)";




$cs=mysql_query($sql,$cn);
echo "<script> alert('se inserto correctamente $fecha2, $fechaf, $salario, $nombredia, $dias, $interes, $ndias  ')</script>";
		}
	}

?>
</br>
<div class="col-md-7">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Registro De Nuevo Mes</h3>
                                </div>
								
								
                                <!-- form start -->
                                <form role="form"  name="fe" action="" method="post" >
                                    <div class="box-body">
                                        <div class="form-group">
                                     
											   <label for="exampleInputEmail">Fecha De Inicio:</label>
											   
											    <select  for="exampleInputEmail" class="form-control" name='mes'>
     <option  value="-01-01">Enero</option>
     <option value="-01-15">Febrero</option>
	 <option value="-02-15">Marzo</option>
	  <option value="-03-15">Abril</option>
     <option value="-04-15">Mayo</option>
     <option value="-05-15">Junio</option>
	 <option value="-06-15">Julio</option>
     <option value="-07-15">Agosto</option>
	  <option value="-08-15">Septiembre</option>
	  <option value="-09-15">Octubre</option>
	 <option value="-10-15">Noviembre</option>
	 <option value="-11-15">Diciembre</option>
     
    
   </select>
    <input   onkeydown="return enteros(this, event)" id="entero" required type="number" name="ano" class="form-control" value="<?php echo $var1 ?>" id=
	 "exampleInputEmail1" max="9999" placeholder="Intoducir el a&ntilde;o">
											   
											   
						
					 
						
											
											
											<label for="exampleInputFile">Salario</label>
                                            <input  onkeydown="return decimales(this, event)" required   id="decimal"  type="text" name="salario" class="form-control" value="<?php echo $var2 ?>" id="exampleInputEmail1" placeholder="Intoducir el Salario Nuevo">
											<label for="exampleInputFile">Interes</label>
											
											
											<input  onkeydown="return decimales(this, event)" id="decimal"  required type="text" name="interes" class="form-control" value="<?php echo $var3 ?>" id="exampleInputEmail1" placeholder="intereses">
											
											
								  </div>
                                       
                                     
                                        
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