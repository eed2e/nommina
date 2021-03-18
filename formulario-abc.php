<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<!--
 * Description of Productos
 *
 * @author tyrodeveloper
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario A-B-C</title>
        <!--Referencias CSS-->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="ng-empleado-lista" ng-app="appCatalogos" ng-controller="cEmpleados">
        <!--PONER AQUÍ EL CÓDIGO HTML-->
        <div class="container-fluid">
            <h1>Formulario A-B-C</h1>
            <hr />
            <a href="#" class="btn btn-primary" ><i class="glyphicon glyphicon-plus"></i> Agregar nuevo producto</a>
            <br /><br />
            <div class ="row">
                <div class="col-sm-6">
                    <div class="form-group input-group">
                    <input type="text" class="form-control" ng-keyup="$event.keyCode == 13 ? BuscarEmpleado() : null" id="txtTextoBuscar" placeholder="Id ó Nombre del Empleado" />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    </div>
                </div>
            </div>

            <div class ="row">
            <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th colspan="6" class="text-center">Listado de Empleados</th>
        </tr>
        <tr>
            <th class="text-center"><i class="glyphicon glyphicon-pencil"></i></th>
            <th class="text-center"><i class="glyphicon glyphicon-trash"></i></th>
            <th>Id Empleado</th>
            <th>Nombre</th>
            <th class="text-right">Apellido Paterno</th>
            <th class="text-right">Apellido Materno</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="empleado in listaEmpleados">
            <td class="text-center"><a href="#" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-pencil"></i></a></td>
            <td class="text-center"><a href="#" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>
            <td>{{empleado.Id_Empleado}}</td>
            <td>{{empleado.Nombre}}</td>
            <td class="text-right">{{empleado.Apellido_Paterno}}</td>
            <td class="text-right">{{empleado.Apellido_Materno}}</td>
        </tr>
    </tbody>
</table>
            <div class="row text-center">
                
            </div>
        </div>
        <!--Referencias Javascript-->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            //Código Javascript
            var myApp = angular.module('appCatalogos', []);
            
            myApp.controller('cEmpleados', function ($scope, $http) {
    var myData = {textoBuscar: ''};
    $scope.empleado = {Id_Empleado: 0, Nombre: "", Apellido_Paterno: "", Apellido_Materno: "", Fecha_Ingreso: ""};
    $http({
        method: "POST",
        url: 'cod-formulario-abc.php?functionToCall=buscar_empleado',
        data: myData}).then(function (response) {
        $scope.listaEmpleados = response.data;
    });
    $scope.BuscarEmpleado = function () {
        var myData = {textoBuscar: String($("#txtTextoBuscar").val())};
        $http({
            method: "POST",
            url: 'cod-formulario-abc.php?functionToCall=buscar_empleado',
            data: myData}).then(function (response) {
            $scope.listaEmpleados = response.data;
        });
    };
});
        </script>
    </body>
</html>