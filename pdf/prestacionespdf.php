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
?>
<?php



include"../fpdf/fpdf.php";
require '../conexiones.php'; 
 $link=conectarse() ;
 
 
 $x1=$_GET['codigo'];


	$query="SELECT * FROM empleados WHERE cod='".$x1."'";
	$result=mysql_query($query,$link) or die("Error: ".mysql_error());
	 
	
	if(mysql_num_rows($result) > 0){

	while($Rs=mysql_fetch_array($result)) {
 
 $nombre = $Rs ['nombre'];
 
 
		$codigo = $Rs ['cod'];
		
	
		$apellido = $Rs['apellido'];
 
date_default_timezone_set('America/caracas');
$hora = date('H:i:s a');
$fecha = date('d-m-Y ');

class MiPDF extends FPDF {
	
	public function Header (){
		
		$this -> Setfont('Arial','B',10);
		$this -> Cell(65,10,"Sistema De Prestaciones Sociales",0,0,'C');
		$this -> Setfont('Arial','B',10);
		$this -> Cell(310,10,"sadasd:",0,0,'C');
		
		$this -> Ln (5);
		$this -> Setfont('Arial','B',8);
		$this -> Cell(190,10,"",0,0,'C');
		

		$this -> Ln (10);
		
		}
	
	
	
	}
	$cabeceraT = array("Periodo","salario base","Diario","Alicuota Utilidades","Alicuota Bono Vcacional","Salario Integral","dias","Prestaciones","Acumulado","Tasa De Interes","Total De  Dias","Interes Acumulado");
		
		
		$mipdf = new MiPDF('L','mm','A4');
		
		$mipdf -> addPage();
		
		
		for ($i = 0; $i < count($cabeceraT); $i++)
		{
			$mipdf -> SetFont('courier','B', 12);
			$mipdf -> SetFillColor(20,125,255); 
			$mipdf -> Cell ( 40, 5 , $cabeceraT[$i],0,0,'C',true);
			}
			
			
			$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(0, 191, 255);
	$mipdf -> Cell(35,11,"NOMBRE",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(0, 191, 255);
	$mipdf -> Cell(25,11,"FECHA PARTO",1,0,'C',true);
			
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(0, 191, 255);
	$mipdf -> Cell(15,11,"CRIA",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(0, 191, 255);
	$mipdf -> Cell(16,11,"NUMERO",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(0, 191, 255);
	$mipdf -> Cell(24,11,"DIAS PARIDA",1,0,'C',true);
	
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(0, 191, 255);
	$mipdf -> Cell(15,11,"AM",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(0, 191, 255);
	$mipdf -> Cell(15,11,"PM",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(0, 191, 255);
	$mipdf -> Cell(15,11,"TOTAL",1,0,'C',true);


$mipdf -> Ln (1);
$mipdf -> Ln(8);

	
$mipdf -> SetFillColor (1000,1000,255);
		$mipdf -> cell(35,5,$codigo , 0 , 0, 'R', true);
		$mipdf -> cell(110,5,$nombre , 0 , 0 ,'C', true);
		$mipdf -> cell(10,5,$apellido , 0 , 0 ,'C', true);
	
		
	
		$mipdf -> Ln(5);
		}
		}
	 }
	 

    
    



	
	
		
		
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
	
	

?>

