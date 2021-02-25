<?php
//include 'cors.php';
class Servidor_Base_Datos
{
	private $servidor;
	private $usuario;
	private $pass;
	private $base_datos;
	private $descriptor;
	function __construct($servidor,$usuario,$pass,$base_datos)
	{
		$this->servidor = $servidor;
		$this->usuario = $usuario;
		$this->pass = $pass;
		$this->base_datos = $base_datos;
		$this->conectar_base_datos();
	}
	private function conectar_base_datos()
	{
		$this->descriptor = mysql_connect($this->servidor,$this->usuario,$this->pass);
		mysql_select_db($this->base_datos,$this->descriptor);
	}
	
	public function consulta($consulta)
	{
		$this->resultado = mysql_query($consulta,$this->descriptor);
	}
	public function extraer_registro()
	{
		if ($fila = mysql_fetch_array($this->resultado,MYSQL_ASSOC)){
			return $fila;
		} 	else {
			return false;
		}
	}
	public function extraer_registro_ultimo()
	{
		if ($fila = mysql_fetch_row($this->resultado)){
			$idmax = $fila[0];
			return $idmax;
		} 	else {
			return false;
		}
	}
}


$servidor = "localhost";
$usuario = "root";
$pass = "";
$base_datos = "prestaciones";

$lagrita = new 
Servidor_Base_Datos($servidor,$usuario,$pass,$base_datos);

?>