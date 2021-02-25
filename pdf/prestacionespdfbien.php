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
	
	
	$cabeceraT = array("Periodo ");
		
		
		$mipdf = new MiPDF('L','mm','A4');
		
		$mipdf -> addPage();
		
		
		
			$query="SELECT * FROM empleados WHERE cod='".$x1."'";
	$result=mysql_query($query,$link) or die("Error: ".mysql_error());
	
if(mysql_num_rows($result) > 0){

while($Rs=mysql_fetch_array($result)) {
		
		
		$nombree= $Rs['nombre'];
		$apellido= $Rs['apellido'];
		$cedula= $Rs['cedula'];
		$fechaii= $Rs['fechai'];
		$fechafinal= $Rs['ultimal'];
		$estado= $Rs['estado'];
		
		$mipdf -> Setfont('Arial','B',10);
		$mipdf -> Cell(280,10,"Prestaciones Sociales  de $nombree el dia $fecha",0,0,'C');
		$mipdf -> Ln (10);
		$mipdf -> Setfont('Arial','B',10);
		$mipdf -> Cell(28,5,"Nombre:",1,0,'C');
		$mipdf -> Cell(50,5,"$nombree",1,0,'C');
		$mipdf -> Cell(120,5,"",0,0,'C');
		$mipdf -> Cell(30,5,"Cedula:",1,0,'C');
		$mipdf -> Cell(50,5,"$cedula",1,0,'C');

		$mipdf -> Ln (5);
		$mipdf -> Setfont('Arial','B',10);
		$mipdf -> Cell(28,5,"Apellido:",1,0,'C');
		$mipdf -> Cell(50,5,"$apellido",1,0,'C');
			$mipdf -> Cell(120,5,"",0,0,'C');
		$mipdf -> Cell(30,5,"Fecha Inicio:",1,0,'C');
		$mipdf -> Cell(50,5,"$fechaii",1,0,'C');
		if($estado=='V'){
		  $estado='VIGENTE';
		  }else{
		  
		  $estado='LIQUIDADO';
		  }
		
			$mipdf -> Ln (5);
		$mipdf -> Setfont('Arial','B',10);
		$mipdf -> Cell(28,5,"Estado:",1,0,'C');
		$mipdf -> Cell(50,5,"$estado",1,0,'C');
			$mipdf -> Cell(120,5,"",0,0,'C');
		$mipdf -> Cell(30,5,"Fecha Salidad:",1,0,'C');
		
		
		$mipdf -> Cell(50,5,"$fechafinal",1,0,'C');
		$mipdf -> Ln (10);
		
		
		}
		}
		
		
		$mipdf -> Cell(5,12,"N°",0,0,'C');
		for ($i = 0; $i < count($cabeceraT); $i++)
		{
			
		
			$mipdf -> SetFont('ARIAL','B', 9);
			$mipdf -> SetFillColor(2,157,116);
			$mipdf -> Cell ( 20, 11 , $cabeceraT[$i],1,0,'C',true);
		}
		
			
			
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(18,11,"Salario/Bse",1,0,'C',true);
	
	
				
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(12,11,"Diario",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(30,11,"Alicuota Utilidades",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(33,11,"A Bono Vacacional",1,0,'C',true);
	
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(25,11,"Salario Integral",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(15,11,"Dias",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(22,11,"Prestaciones",1,0,'C',true);
	$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(19,11,"Acumulado",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(24,11,"Taza De Interes",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(22,11,"Total De Dias",1,0,'C',true);
		$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(29,11,"Interes Acumulado",1,0,'C',true);

			
			$mipdf -> Ln (1);
		
		//$mipdf -> Image("../webcam/fotos/$imagen",10,43,30,"JPG");
		
		
	
		

	$fechaf="select ultimal,fechai from empleados where cod='".$x1."'";
//$suma2 = $conexion->query($fechaf)
$suma2=mysql_query($fechaf,$link) or die("Error: ".mysql_error());

if (!$suma2) {
    echo 'No se pudo ejecutar la consulta: ';
    exit;
}



$fila = mysql_fetch_row($suma2);
$fechaff = $fila[0]; // el valor que quiero 
$fechaii = $fila[1]; // 


	if($fechaff==""){
	$fechaff=$fecha;
	}
	
	
	 $fecha111= $fechaff;
$fecha222=date("Y-m-d",strtotime($fecha111)); 
	
	

	
	$mipdf -> Ln(10);
	
$sql="SELECT * FROM empleados,salario WHERE cod='".$x1."' and  fechai and fechaf BETWEEN '$fechaii' AND '$fecha222' order by id";
	//$consulta=mysql_query($conexion,$sql); 
	$consulta=mysql_query($sql,$link) or die("Error: ".mysql_error());
	
	//$fecha55=$fecha7dias;
	//$consulta55=mysql_query($conexion,$fecha55); 
	//$result=mysql_query($fecha55,$link) or die("Error: ".mysql_error());
$oye=0;

$num = 0; 


$ali=16/12; //alicuota bono vacacional

 $var = 0;
 $var1 = 0;
 $var2 = 0;
 $var3 = 0;
 $var4 = 0;
 $var5 = 0;
 $var6 = 0;
 $var7 = 0;
  $var8 = 0;
   $var9 = 0;
	while ( $datos = mysql_fetch_array ($consulta))
	{
	
	
		$num;
		
 $a= $datos["salario"]; //salario base
 $b=$a/30;  //diario
 $c=$b*2.50; //alicuota
 $d=$b*$ali; //alicuota bono
 $e=$a+$c+$d; //salario integral
 $f=$e/30*$datos["dias"];//prestaciones sociales
 $g=$f+$g;//acumulado
 $h=($g*$datos["interes"]/100)/360*$datos["totaldias"];
 
  // ...
        $var += $datos['salario'];
		 $var1 += $b;
		 $var2 += $c;
		 $var3 += $d;
		 $var4 += $e;
		 $var5 += $datos['dias'];
		 $var6 += $f;
		$var7 +=$datos['interes'];
		$var8 +=$datos['totaldias'];
		$var9 += $h;
		

		$nombremes= $datos ['nombremes'];
		
		$ali2= round($c,2);
		 $prestaciones= round($f,2);
		 
		 $diario= round($b,2);
		 $bonov= round($d,2);
		  $interesa= round($h,2);
		 $sintegral= round($e,2);
		  $acumulado= round($g,2);
		$diass= $datos['dias'];
		 $totaldiass=$datos['totaldias'];
		$salario = $datos ['salario'];
		$interes=$datos['interes'];
		
		$sexo = $datos ['correo'];
		$parto = $datos ['fechai'];
		$am = $datos ['cod'];
		$pm = $datos ['ultimal'];
		
	
		$cria = $datos ['estado'];
		
		$fec=date('d-m-y',$fechai);
		$d=date('d',$fec);
		$m=date('m',$fec);
		$y=date('Y',$fec);
		
$dia=date(d);
$mes=date(m);
$ano=date(Y);



//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

if (($mesnaz == $mes) && ($dianaz > $dia)) {
$ano=($ano-1); }

//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

if ($mesnaz > $mes) {
$ano=($ano-1);}

//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

$edad=($ano-$anonaz);

		$fec=strtotime($parto);
		$fec=date('d-m-Y ',$fec);
		$d=date('d',$fec);
		$m=date('m',$fec);
		$y=date('Y',$fec);
		
		
		
		$cabeceraS = array("$periodo");
		

 
  $num++;  

	   $mipdf -> Cell(5,5,"$num",1,0,'C');
		for ($i = 0; $i < count($cabeceraS); $i++)
		{
			$mipdf -> SetFont('ARIAL','B', 9);
			$mipdf -> SetFillColor(2,157,116); 
			
			}
			

			
		
		 $mipdf -> Cell(20,5,"$nombremes",1,0,'C');
			
			  $mipdf -> Cell(18,5,"$salario",1,0,'C');
		$mipdf -> Cell(12,5,"$diario",1,0,'C');	
		  $mipdf -> Cell(30,5,"$ali2",1,0,'C');
		  $mipdf -> Cell(33,5,"$bonov",1,0,'C');
		  $mipdf -> Cell(25,5,"$sintegral",1,0,'C');
		$mipdf -> Cell(15,5,"$diass",1,0,'C');	
		  $mipdf -> Cell(22,5,"$prestaciones",1,0,'C');
		  $mipdf -> Cell(19,5,"$acumulado",1,0,'C');
		  $mipdf -> Cell(24,5,"$interes",1,0,'C');
		  $mipdf -> Cell(22,5,"$totaldiass",1,0,'C');
		  $mipdf -> Cell(29,5,"$interesa",1,0,'C');
			
			
			
		
	
		$mipdf -> Ln(5);
		}
		
		
	
	/* $mipdf -> Cell(140,5,"",0,0,'C');
	$regu="select sum(horalec)+sum(potelec)-0.5
  from dlec";
$regu2=mysql_query($conexion,$regu);
$fila3 = mysqli_fetch_row($regu2);
$regu3 = $fila3[0];

$r="SELECT  count(horalec) FROM dlec";
$re=mysqli_query($conexion,$r);
$fil = mysqli_fetch_row($re);
$reg = $fil[0];


$pro=$reg/$oye;
*/	
$pro=888888;

$var111= round($var1,2);
 $var222= round($var2,2);
  $var333= round($var3,2);
   $var444= round($var4,2);
    $var555= round($var5,2);
	 $var666= round($var6,2);
	  $var777= round($var7,2);
	   $var888= round($var8,2);
	    $var999= round($var9,2);
 
 
$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(25,7,"TOTAL  :",1,0,'C',true);
	$mipdf -> Cell(18,7,"$var",1,0,'C',true);
	$mipdf -> Cell(12,7,"$var111",1,0,'C',true);
	$mipdf -> Cell(30,7,"$var222",1,0,'C',true);
	$mipdf -> Cell(33,7,"$var333",1,0,'C',true);
	$mipdf -> Cell(25,7,"$var444",1,0,'C',true);
	$mipdf -> Cell(15,7,"$var555",1,0,'C',true);
	$mipdf -> Cell(22,7,"$var666",1,0,'C',true);
	$mipdf -> Cell(19,7,"$acumulado",1,0,'C',true);
	$mipdf -> Cell(24,7,"$var777",1,0,'C',true);
	$mipdf -> Cell(22,7,"$var888",1,0,'C',true);
	$mipdf -> Cell(29,7,"$var999",1,0,'C',true);
	
	
	
	 	 $mipdf -> Ln(10); 

	 
	  $mipdf -> Cell(200,5,"",0,0,'C');

$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);


if ( $var6 == 0 ){
$utilidad=0 ;
}else {
$query2 ="SELECT id,salario FROM salario ORDER BY id ASC LIMIT 10"; 

$sqll=mysql_query($query2,$link) or die("Error: ".mysql_error());
$a = 0;

$cant = mysql_num_rows($sqll);
while($row = mysql_fetch_array($sqll)){
    $a++;
	
   if($a == $cant){ 
         $utilidad=$row['salario'];
    } else {
       ' '.$row['nick'].' ';
    }
	
}
		}					
					



	$mipdf -> Cell(30,7,"Utilidad  :",1,0,'C',true);
	$mipdf -> Cell(25,7,"$utilidad",1,0,'C');
	
	 $mipdf -> Ln(7); 
	 $mipdf -> Cell(200,5,"",0,0,'C');
	$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);

if($var6==0){ 

$aa= 0;
}else{
$sql = mysql_query("SELECT id,salario FROM salario ORDER BY id ASC LIMIT 10"); 
$a = 0;
$cant = mysql_num_rows($sql);
while($row = mysql_fetch_array($sql)){
    $a++;
	
   if($a == $cant){ 
        '<font color="red"> '.$aa=$row['salario'].'</font> ';
    } else {
        ' '.$row['nick'].' ';
    }
	
}
}
							$aaa=$aa/30; //total vacaciones
						$vacaciones=	19* round($aaa,2) 	; 
		
 $prestaciones2= round($var6,2);
  $interes2= round($var9,2);
  
  $var10= $var9+$var6+$vacaciones+$vacaciones+$utilidad;
  
  $totalfinal= round($var10,2);
  
	$mipdf -> Cell(30,7,"Vacaciones  :",1,0,'C',true);
	$mipdf -> Cell(25,7,"$vacaciones",1,0,'C');
	 $mipdf -> Ln(7); 
	 
	 
	 
	 $mipdf -> Cell(200,5,"",0,0,'C');
	$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(30,7,"Bono Vacional  :",1,0,'C',true);
	$mipdf -> Cell(25,7,"$vacaciones",1,0,'C');
	 $mipdf -> Ln(7); 
	 $mipdf -> Cell(200,5,"",0,0,'C');
	$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(30,7,"Prestaciones  :",1,0,'C',true);
	$mipdf -> Cell(25,7,"$prestaciones2",1,0,'C');
	$mipdf -> Ln(7); 
	 $mipdf -> Cell(200,5,"",0,0,'C');
	$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(30,7,"Interes :",1,0,'C',true);
	$mipdf -> Cell(25,7,"$interes2",1,0,'C');
	$mipdf -> Ln(7); 
	 $mipdf -> Cell(200,5,"",0,0,'C');
	$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(2,157,116);
	$mipdf -> Cell(30,7,"Total a Pagar  :",1,0,'C',true);
	$mipdf -> Cell(25,7,"$totalfinal",1,0,'C');
	

	
		
		$mipdf -> Ln(10);
		 $mipdf -> Cell(140,5,"",0,0,'C');
		$mipdf -> cell(0,5,"fecha : $fecha" , 0 , 10, true);
		$mipdf -> cell(0,1,"hora : $hora" , 0 , 10, true);
		

		
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
