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

date_default_timezone_set('America/caracas');
$hora = date('H:i:s a');
$fecha = date('d-m-Y ');
$fecha7dias = date('d-m-Y', strtotime('-1 week')) ; // resta 1 semana




class MiPDF extends FPDF {
	
		public function Header (){
}
	
	
}
	
	
	$cabeceraT = array("Periodo");
		
		
		$mipdf = new MiPDF();
		
		$mipdf -> addPage();
		
		
		
											
$x1=$_GET['codigo'];


	$query="SELECT * FROM empleados,liquidacion WHERE cod='".$x1."' and codigo='".$x1."'";
	$result=mysql_query($query,$link) or die("Error: ".mysql_error());
	
if(mysql_num_rows($result) > 0){

while($Rs=mysql_fetch_array($result)) {
		
		
		$nombree= $Rs['nombre'];
		$apellido= $Rs['apellido'];
		$cedula= $Rs['cedula'];
		$fechaii= $Rs['fechai'];
		$fechafinal= $Rs['ultimal'];
		$estado= $Rs['estado'];
		$correo= $Rs['correo'];
		$cargo= $Rs['cargo'];
		$departamento= $Rs['departamento'];
		$causa= $Rs['causa'];
		$sueldo= $Rs['sueldo'];
		$meses= $Rs['tiempo'];
			$mipdf -> Ln (5);
		$mipdf -> Setfont('Arial','B',10);
		$mipdf -> Cell(200,10,"Liquidacion de $nombree $apellido el dia $fecha",0,0,'C');
		$mipdf -> Ln (20);
		$mipdf -> Setfont('Arial','B',10);
		$mipdf -> Cell(28,5,"Nombre:",1,0,'C');
		$mipdf -> Cell(50,5,"$nombree",1,0,'C');
		$mipdf -> Cell(30,5,"",0,0,'C');
		$mipdf -> Cell(30,5,"Cedula:",1,0,'C');
		$mipdf -> Cell(50,5,"$cedula",1,0,'C');

		$mipdf -> Ln (5);
		$mipdf -> Setfont('Arial','B',10);
		$mipdf -> Cell(28,5,"Apellido:",1,0,'C');
		$mipdf -> Cell(50,5,"$apellido",1,0,'C');
			$mipdf -> Cell(30,5,"",0,0,'C');
		$mipdf -> Cell(30,5,"Cargo:",1,0,'C');
		$mipdf -> Cell(50,5,"$cargo",1,0,'C');
		if($estado=='V'){
		  $estado='VIGENTE';
		  }else{
		  
		  $estado='LIQUIDADO';
		  }
		
			$mipdf -> Ln (5);
		$mipdf -> Setfont('Arial','B',10);
		$mipdf -> Cell(28,5,"Departamento:",1,0,'C');
		$mipdf -> Cell(50,5,"$departamento",1,0,'C');
			$mipdf -> Cell(30,5,"",0,0,'C');
			
			$fechaii2=date("d-m-Y",strtotime($fechaii)); 

		$mipdf -> Cell(30,5,"Fecha Inicio:",1,0,'C');
		
		
		$mipdf -> Cell(50,5,"$fechaii2",1,0,'C');
		$mipdf -> Ln (5);
		$mipdf -> Setfont('Arial','B',10);
		$mipdf -> Cell(28,5,"causa:",1,0,'C');
		$mipdf -> Cell(50,5,"$causa",1,0,'C');
		$mipdf -> Cell(30,5,"",0,0,'C');
		
		$fechafinal2=date("d-m-Y",strtotime($fechafinal)); 
		$mipdf -> Cell(30,5,"Fecha Salida:",1,0,'C');
		$mipdf -> Cell(50,5,"$fechafinal2",1,0,'C');
		$mipdf -> Ln (8);
		$mipdf -> Cell(30,5,"",0,0,'C');
		$mipdf -> Cell(63,5,"Antiguedad laboral:",1,0,'C');
		$mipdf -> Cell(50,5,"$meses Meses",1,0,'C');
		$mipdf -> Ln (10);
		
		}
		}
		
	
	
			
			
			
		
	$mipdf -> Cell(10,11,"",0,0,'C');
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(18,11,"DIAS",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(25,11,"Bs.",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(100,11,"Descripcion",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(25,11,"Bs.",1,0,'C',true);
	
		$mipdf -> Ln (11);
	
	
	
	$mipdf -> Cell(10,11,"",0,0,'C');
		
	$mipdf -> Cell(18,5,"",1,0,'C');

	$mipdf -> Cell(25,5,"",1,0,'C');

	$mipdf -> Cell(100,5,"Prestación de Antigüedad (Art 142 L.O.T.T.T)",1,0,'C');
		
	$mipdf -> Cell(25,5,"",1,0,'C');
	

		$dia1= 15/12*$meses;
		$bs1= $sueldo/30;
		
		$bs1 =round( $bs1,2);
		
		$bs2= $dia1*$bs1;
	$bs2= round( $bs2,2);
			
			$mipdf -> Ln (5);
$mipdf -> Cell(10,11,"",0,0,'C');
		
	$mipdf -> Cell(18,5,"$dia1",1,0,'C');

	$mipdf -> Cell(25,5,"$bs1",1,0,'C');

	$mipdf -> Cell(100,5,"Vacaciones Fraccionadas (Art 196 L.O.T.T.T)",1,0,'C');
		
	$mipdf -> Cell(25,5,"$bs2",1,0,'C');


$dia2= 30/12*$meses;
	$dia2= round( $dia2,2);
	
	$bs3= $sueldo/30;
	$bs3= round( $bs3,2);
	
	$bs4= $dia2*$bs3;
	$bs4= round( $bs4,2);
	
			$mipdf -> Ln (5);
$mipdf -> Cell(10,11,"",0,0,'C');
		
	$mipdf -> Cell(18,5,"$dia2",1,0,'C');

	$mipdf -> Cell(25,5,"$bs3",1,0,'C');

	$mipdf -> Cell(100,5,"Bono de Fin de Año",1,0,'C');
		
	$mipdf -> Cell(25,5,"$bs4",1,0,'C');

$dia3= 15/12*$meses;
	$dia3= round( $dia3,2);
	
	
$bs5= $dia3*$bs3;
	$bs5= round( $bs5,2);
			$mipdf -> Ln (5);
$mipdf -> Cell(10,11,"",0,0,'C');
		
	$mipdf -> Cell(18,5,"$dia3",1,0,'C');

	$mipdf -> Cell(25,5,"$bs3",1,0,'C');

	$mipdf -> Cell(100,5,"Bono Vacacional Fraccionado (Art 196 L.O.T.T.T)",1,0,'C');
		
	$mipdf -> Cell(25,5,"$bs5",1,0,'C');


			$mipdf -> Ln (5);
$mipdf -> Cell(10,11,"",0,0,'C');
		
	$mipdf -> Cell(18,5,"",1,0,'C');

	$mipdf -> Cell(25,5,"",1,0,'C');

	$mipdf -> Cell(100,5,"Intereses sobre Prestaciones Sociales (Art 143 L.O.T.T.T)",1,0,'C');
		
	$mipdf -> Cell(25,5,"",1,0,'C');
	
		$mipdf -> Ln (5);
$mipdf -> Cell(10,11,"",0,0,'C');
		
	$mipdf -> Cell(18,5,"",0,0,'C');

	$mipdf -> Cell(75,5,"",0,0,'C');

	$mipdf -> Cell(50,10,"total",1,0,'C',true);
	$total= $bs5+$bs4+$bs2;
$total= round( $total,2);
	
		
	$mipdf -> Cell(25,10,"$total",1,0,'C');
		
		//$mipdf -> Image("../webcam/fotos/$imagen",10,43,30,"JPG");
		
		
	
		

			$mipdf -> Ln (30);
			
$mipdf -> Cell(10,11,"",0,0,'C');
		
	$mipdf -> Cell(168,5,"HAGO CONSTAR QUE HE RECIBIDO DEL INSTITUTO EMISOR DE ESTE DOCUMENTO QUE QUEDA 
",0,0,'C');


			$mipdf -> Ln (5);
			
$mipdf -> Cell(10,11,",  ",0,0,'C');
		$mipdf -> Cell(168,5,"A MI ENTERA SATISFACCION, LA CANTIDAD ARRIBA MENCIONADA Y QUE NADA TENGO QUE RECLAMAR",0,0,'C');
		
		
			$mipdf -> Ln (5);
			
$mipdf -> Cell(10,11,"",0,0,'C');
			$mipdf -> Cell(168,5,"POR CONCEPTO DE PRESTACIONES SOCIALES, NI POR NINGUN OTRO CONCEPTO. 
",0,0,'C');

	
	

	$mipdf -> Ln (10);
$mipdf -> Cell(10,11,"",0,0,'C');
		
	$mipdf -> Cell(25,5,"Elaborado por",1,0,'C');

	$mipdf -> Cell(70,5,"",1,0,'C');

	$mipdf -> Cell(50,5,"Fecha",1,0,'C');
		
	$mipdf -> Cell(25,5,"$fecha",1,0,'C');
	
	
	
	$mipdf -> Ln (20);
$mipdf -> Cell(40,11,"",0,0,'C');
		
	$mipdf -> Cell(25,5,"__________________",0,0,'C');

	$mipdf -> Cell(50,5,"",0,0,'C');

	$mipdf -> Cell(50,5,"__________________",0,0,'C');
		
	$mipdf -> Cell(25,5,"",0,0,'C');
	
	$mipdf -> Ln (5);
$mipdf -> Cell(40,11,"",0,0,'C');
		
	$mipdf -> Cell(25,5,"Revisado por",0,0,'C');

	$mipdf -> Cell(50,5,"",0,0,'C');

	$mipdf -> Cell(50,5,"Aprovado por",0,0,'C');
		
	$mipdf -> Cell(25,5,"",0,0,'C');
		

	
$mipdf -> Ln (10);
$mipdf -> Cell(35,11,"",0,0,'C');
		
	$mipdf -> Cell(50,5,"",0,0,'C');

	$mipdf -> Cell(25,5,"___________________",0,0,'C');

	
	
	$mipdf -> Ln (5);
$mipdf -> Cell(35,11,"",0,0,'C');
		
	$mipdf -> Cell(50,5,"",0,0,'C');

	$mipdf -> Cell(25,5,"Firma Del Empleado",0,0,'C');

	
	
		
		$mipdf -> Ln(10);
		

		
		$mipdf -> Output();
		class PDF extends FPDF
{
function Footer()
{
    // Go to 1.5 cm from bottom
   $this->SetY(-15);

$this->SetFont('Arial','I',8);

$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

}
}
	
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
//Aquí escribimos lo que deseamos mostrar
$pdf->Output();	
?>
