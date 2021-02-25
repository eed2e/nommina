<?php

include"../fpdf/fpdf.php";
require '../config.php'; 
include_once('../conexiones.php');
date_default_timezone_set('America/caracas');
$hora = date('H:i:s a');
$fecha = date('d-m-Y ');





class MiPDF extends FPDF {
	
		public function Header (){
		//$this -> Image("../assets/img/logo.png",10,10,30,20);
		$this -> Setfont('Arial','B',10);
		$this -> Cell(200,10,"Sistema De Prestaciones Sociales",0,0,'C');
		$this -> Ln (5);
		$this -> Setfont('Arial','B',6);
		$this -> Cell(200,10,"Lidacion",0,0,'C');
		
		$this -> Ln (20);
		$this -> Setfont('Arial','B',10);
		$this -> Cell(200,10,"Prestaciones sociales ",0,0,'C');
		$this -> Ln (10);
		
		}
	
	
	
	}
	
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



//$rango="SELECT * FROM empleados,salario WHERE fechai BETWEEN '2014-01-1 13:40:41' AND '2016-04-06 13:40:41'"; //buscar lista por fecha

$salario="SELECT * FROM empleados,salario WHERE cod='".$x1."' and  fechai and fechaf BETWEEN '$fechaii' AND '$fechaff' order by id";
$result2=mysql_query($salario,$link) or die("Error: ".mysql_error());


}


	
	
	
	$cabeceraT = array("Periodo","Salario Base","Diario","Alicuota Utilidades","Slario Integral","Dias","Prestaciones Sociales","Acumulado","Tasa De Interes","Total De Dias","Interes Acumulado");
		
		
		$mipdf = new MiPDF();
		$mipdf -> addPage();
		
		$mipdf -> Cell(10,12,"N°",0,0,'C');
		for ($i = 0; $i < count($cabeceraT); $i++)
		{
			
		
			$mipdf -> SetFont('ARIAL','B', 9);
			$mipdf -> SetFillColor(20,125,255); 
			$mipdf -> Cell ( 20, 12 , $cabeceraT[$i],1,0,'C',true);
			
			
			
			}
			
			
			$mipdf -> Ln (1);
		
		//$mipdf -> Image("../webcam/fotos/$imagen",10,43,30,"JPG");
		
$mipdf -> Ln(10);
	$sql="select * from salarios";
	$consulta=mysqli_query($conexion,$sql); 
	


	

		
		
		
	
		
	$mipdf -> Cell(67,5,"",0,0,'C');
	
	
$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(20,125,255); 
	$mipdf -> Cell(57,7,"TOTAL :",1,0,'C',true);
	$mipdf -> Cell(57,7,"$num",1,0,'C');
	 


		
		$mipdf -> Ln(10);
		$mipdf -> cell(178,5,"fecha : $fecha" , 0 , 10, true);
		$mipdf -> cell(178,1,"hora : $hora" , 0 , 10, true);
		
		$mipdf -> Output();
		class PDF extends FPDF
{
function Footer()
{
    // Go to 1.5 cm from bottom
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Arial','I',8);
    // Print centered page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
}
	
	}

?>

