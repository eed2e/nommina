-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2021 a las 18:24:33
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nommina`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_EmpleadoBuscar` (`prmTextoBuscar` NVARCHAR(50))  begin
 select e.Id_Empleados, e.Nombre, e.Apellido_Paterno, e.Apellido_Materno, e.Fecha_Ingreso, e.fecha_Egreso, e.Sueldo, e. Departamento, e.Frecuencia_pago, e.Salario_Diario
    from empleados e
    where concat(e.Id_Empleados,' ', e.Nombre) like concat('%', prmTextoBuscar, '%');
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `Id_Empleado` int(10) NOT NULL,
  `Nombre` text NOT NULL,
  `Apellido_Paterno` text NOT NULL,
  `Apellido_Materno` text NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Fecha_Egreso` date DEFAULT NULL,
  `Sueldo` int(20) NOT NULL,
  `Departamento` varchar(20) NOT NULL,
  `Frecuencia_pago` varchar(20) NOT NULL,
  `Salario_Diario` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`Id_Empleado`, `Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `Fecha_Ingreso`, `Fecha_Egreso`, `Sueldo`, `Departamento`, `Frecuencia_pago`, `Salario_Diario`) VALUES
(1, 'Daniel', 'Lopez', 'Guerrero', '2021-03-10', NULL, 15000, 'Sistemas', 'Catorcenal', 300),
(2, 'Juanito', 'Campos', 'Camacho', '2020-01-15', NULL, 15000, 'Sistemas', 'Catorcenal', 300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `Id_Vacaciones` int(99) NOT NULL,
  `Id_Empleado` varchar(10) NOT NULL,
  `I_Vacaciones` date NOT NULL,
  `F_Vacaciones` date NOT NULL,
  `T_Vacaciones` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`Id_Empleado`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`Id_Vacaciones`),
  ADD KEY `Id_Empleado` (`Id_Empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `Id_Empleado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `Id_Vacaciones` int(99) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
