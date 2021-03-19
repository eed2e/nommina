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
    <body id="ng-producto-lista" ng-app="appCatalogos" ng-controller="cProductos">
        <!--PONER AQUÍ EL CÓDIGO HTML-->
        <!-- Modal Eliminar-->
<div id="modalProductoEliminar" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="color:red;">¿Realmente desea eliminar al Empleado?</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Código del Empleado:</label>
                        <div class="form-group input-group">

                            <input type="text" ng-model="producto.codigo_empleado" readonly="true" class="form-control" />-->
                            <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nombre del Empleado:</label>
                            <input type="text" ng-model="producto.nombre" readonly="true" class="form-control" />
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" ng-click="Eliminar()" class="btn btn-danger" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Eliminar-->
        <!-- Modal Producto -->
<div id="modalProducto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Empleado</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Código del Empleado:</label>
                        <div class="form-group input-group">

                            <input type="text" id="txtCodigoBarras" ng-model="producto.codigo_empleado" class="form-control" />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nombre del Empleado:</label>
                            <input type="text" id="txtNombreProducto" ng-model="producto.nombre" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Salario Mensual:</label>
                        <div class="form-group input-group">
                            <input type="text" id="txtStock" ng-model="producto.sMensual" class="form-control" />
                            <span class="input-group-addon">0.00</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Salario Diario:</label>
                        <div class="form-group input-group">

                            <input type="text" id="txtStock" ng-model="producto.sDiario" class="form-control" />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" ng-click="Grabar()" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-disk"></i> Grabar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cancelar</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal Producto -->
        <div class="container-fluid">
            <h1 class = "text-center"> DigitalNet</h1>
            <hr />
            <a href="#" class="btn btn-primary" ng-click="AbrirNuevo();"><i class="glyphicon glyphicon-plus"></i> Agregar Empleado</a>
            <br /><br />
            <div class ="row">
                <div class="col-sm-6">
                    <div class="form-group input-group">
                    <input type="text" class="form-control" ng-keyup="$event.keyCode == 13 ? BuscarProducto() : null" id="txtTextoBuscar" placeholder="Código de Empleado o nombre del Empleado" />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    </div>
                </div>
            </div>

            <div class ="row">
                <div class="col-sm-12">
                <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th colspan="6" class="text-center">Listado de Empleados</th>
        </tr>
        <tr>
            <th class="text-center"><i class="glyphicon glyphicon-pencil"></i></th>
            <th class="text-center"><i class="glyphicon glyphicon-trash"></i></th>
            <th>Código del Empleado</th>
            <th>Nombre</th>
            <th class="text-right">Suldo Mensual</th>
            <th class="text-right">Sueldo Diario</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="producto in listaProductos">
            <td class="text-center"><a href="#" ng-click="AbrirEditar(this.producto);" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-pencil"></i></a></td>
            <td class="text-center"><a href="#" ng-click="AbrirEliminar(this.producto);" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>
            <td>{{producto.codigo_empleado}}</td>
            <td>{{producto.nombre}}</td>
            <td class="text-right">{{producto.sMensual|number:2}}</td>
            <td class="text-right">{{producto.sDiario| number:2}}</td>
        </tr>
    </tbody>
</table>
                </div>
            </div>
         
        <!--Referencias Javascript-->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            //Código Javascript
            var myApp = angular.module('appCatalogos', []);
            myApp.controller('cProductos', function ($scope, $http) {
                $scope.AbrirEliminar = function (item) {
                    $scope.producto = item;
                    $("#modalProductoEliminar").modal();
                };
                $scope.Eliminar = function () {
                    $http({
                        method: "POST",
                        url: 'cod-formulario-abc.php?functionToCall=eliminar_producto',
                        data: $scope.producto}).then(function (response) {
                            if (response.data.status === "1") {
                                alert(response.data.message);
                                $scope.BuscarProducto();
                                $("#modalProductoEliminar").modal("hide");
                            } else {
                                alert(response.data.message);
                            }
                        });
                };
                $scope.AbrirEditar = function (item) {
                    $scope.AbrirEliminar = function (item) {
                    $scope.producto = item;
                    $("#modalProductoEliminar").modal();
                    };
                    $scope.Eliminar = function () {
                    $http({
                        method: "POST",
                        url: 'cod-formulario-abc.php?functionToCall=eliminar_producto',
                        data: $scope.producto}).then(function (response) {
                            if (response.data.status === "1") {
                                alert(response.data.message);
                                $scope.BuscarProducto();
                                $("#modalProductoEliminar").modal("hide");
                            } else {
                                alert(response.data.message);
                            }
                        });
                    };
                    $scope.producto = item;
                    $("#modalProducto").modal();
                };
                $scope.AbrirNuevo = function () {
                    $scope.producto = {id_producto: 0, codigo_barras: "", nombre_producto: "", stock: 0, precio_venta: 0};
                    $("#modalProducto").modal();
                };
                $scope.Grabar = function () {
                    $http({
                        method: "POST",
                        url: 'cod-formulario-abc.php?functionToCall=grabar_producto',
                        data: $scope.producto}).then(function (response) {
                        if (response.data.status === "1") {
                            alert(response.data.message);
                            $scope.BuscarProducto();
                            $("#modalProducto").modal("hide");
                        } else {
                            alert(response.data.message);
                        }
                    });
                };
                var myData = {textoBuscar: ''};
                $scope.producto = {id_producto: 0, codigo_barras: "", nombre_producto: "", stock: 0, precio_venta: 0};
                $http({
                    method: "POST",
                    url: 'cod-formulario-abc.php?functionToCall=buscar_producto',
                    data: myData}).then(function (response) {
                    $scope.listaProductos = response.data;
                });
                $scope.BuscarProducto = function () {
                    var myData = {textoBuscar: String($("#txtTextoBuscar").val())};
                    $http({
                        method: "POST",
                        url: 'cod-formulario-abc.php?functionToCall=buscar_producto',
                        data: myData}).then(function (response) {
                        $scope.listaProductos = response.data;
                    });
                };
            });

        </script>
    </body>
</html>