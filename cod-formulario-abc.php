<?php

/**
 * Description of class
 *
 * @author tyrodeveloper
 */
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", "1");
date_default_timezone_set("America/Mexico_City");
spl_autoload_register(function( $NombreClase ) {
    require_once $NombreClase . '.php';
});

class Empleados {

    public $Id_Empleado = 0;
    public $Nombre = "";
    public $Apellido_Paterno = "";
    public $Apellido_Materno = 0;
    public $Fecha_Ingreso = 0;

        $mysql = new Connection();
        $cnn = $mysql->getConnection();
        $retorno = array();
        $query = $cnn->prepare("call proc_EmpleadoBuscar (?)");
        $query->bind_param("s", $textoBuscar);
        $query->execute();
        $empleado = new Empleados(); //Variable
        $query->bind_result(
                $Id_Empleado, $Nombre, $Apellido_Paterno, $Apellido_Materno, $Fecha_Ingreso
        );
        while ($query->fetch()) {
            $empleado = new Empleados();
            $empleado->Id_Empleado = $Id_Empleado;
            $empleado->Nombre = $Nombre;
            $empleado->Apellido_Paterno = $Apellido_Paterno;
            $empleado->Apellido_Materno = $Apellido_Materno;
            $empleado->Fecha_Ingreso = $Fecha_Ingreso;
            array_push($retorno, $empleado);
        }
        $query->close();
        $cnn->close();
        return $retorno;
    }
    function ArrayMessage($status, $message) {
       $retorno = array("status" => $status, "message" => $message, "date" => date("Y-m-d H:i:s"));
       return $retorno;
    }
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET["functionToCall"]) && !empty($_GET["functionToCall"])) {
    $functionToCall = $_GET["functionToCall"];
    $json_data = json_decode(file_get_contents('php://input'));
    switch ($functionToCall) {
        case "buscar_empleado":
            $empleado = new Empleados();
            echo json_encode($empleado->Buscar(utf8_decode($json_data->textoBuscar)));
            break;
    }
}