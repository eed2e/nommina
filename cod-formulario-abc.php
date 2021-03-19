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

class Productos {

    public $id_empleado = 0;
    public $codigo_empleado = "";
    public $nombre = "";
    public $sMensual = 0;
    public $sDiario = 0;

    function Eliminar($idEmpleado) {
        $mysql = new Connection();
        $cnn = $mysql->getConnection();
        $retorno = $this->ArrayMessage("0", "No se ha realizado ninguna acción.");
        $query = $cnn->prepare("call proc_ProductoEliminar (?)");
        $query->bind_param("i", $idEmpleado);
        $query->execute();
        $query->store_result();
        if (mysqli_stmt_error($query) != "") {
            $retorno = $this->ArrayMessage("0", mysqli_stmt_error($query));
        }
        //Verificar si se obtubieron resultados
        if ($query->num_rows != 0) {
            $query->bind_result($this->id_empleado);
            if ($query->fetch()) {
                if (is_null($this->id_empleado)) {
                    $retorno = $this->ArrayMessage("0", "No se ha realizado ninguna acción. El error se desconoce.");
                } else {
                    $retorno = $this->ArrayMessage("1", "El producto ha sido eliminado.");
                }
            }
        }
        $query->close();
        $cnn->close();
        return $retorno;
    }


    function Grabar() {
        $mysql = new Connection();
        $cnn = $mysql->getConnection();
        $retorno = $this->ArrayMessage("0", "No se ha realizado ninguna acción.");
        $query = $cnn->prepare("call proc_ProductoGrabar (?,?,?,?,?)");
        $query->bind_param("issdd", $this->id_empleado, $this->codigo_empleado, $this->nombre, $this->sMensual, $this->sDiario);
        $query->execute();
        $query->store_result();
        if (mysqli_stmt_error($query) != "") {
            $retorno = $this->ArrayMessage("0", mysqli_stmt_error($query));
        }
        //Verificar si se obtubieron resultados
        if ($query->num_rows != 0) {
            $query->bind_result($this->id_empleado);
            if ($query->fetch()) {
                if (is_null($this->id_empleado)) {
                    $retorno = $this->ArrayMessage("0", "No se ha realizado ninguna acción. El error se desconoce.");
                } else {
                    $retorno = $this->ArrayMessage("1", "El producto ha sido grabado correctamente.");
                }
            }
        }
        $query->close();
        $cnn->close();
        return $retorno;
    }

   


    function Buscar($textoBuscar) {
        $mysql = new Connection();
        $cnn = $mysql->getConnection();
        $retorno = array();
        $query = $cnn->prepare("call proc_ProductoBuscar (?)");
        $query->bind_param("s", $textoBuscar);
        $query->execute();
        $producto = new Productos(); //Variable
        $query->bind_result(
                $id_empleado, $codigo_empleado, $nombre, $sMensual, $sDiario
        );
        while ($query->fetch()) {
            $producto = new Productos();
            $producto->id_empleado = $id_empleado;
            $producto->codigo_empleado = $codigo_empleado;
            $producto->nombre = $nombre;
            $producto->sMensual = $sMensual;
            $producto->sDiario = $sDiario;
            array_push($retorno, $producto);
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
        case "buscar_producto":
            $producto = new Productos();
            echo json_encode($producto->Buscar(utf8_decode($json_data->textoBuscar)));
            break;
        
        case "grabar_producto":
            $producto = new Productos();
            $producto->id_empleado = $json_data->id_empleado;
            $producto->codigo_empleado = $json_data->codigo_empleado;
            $producto->nombre = $json_data->nombre;
            $producto->sMensual = $json_data->sMensual;
            $producto->sDiario = $json_data->sDiario;
            echo json_encode($producto->Grabar());
            break;
        
        case "eliminar_producto":
            $producto = new Productos();
            echo json_encode($producto->Eliminar($json_data->id_producto));
            break;
    }
} 
 