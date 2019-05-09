-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-05-2019 a las 21:46:24
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbcorte3adi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `idhabitacion` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `piso` tinyint(4) NOT NULL,
  `max_personas` tinyint(4) NOT NULL,
  `costo` decimal(12,2) NOT NULL,
  `tiene_cama_bebe` tinyint(4) NOT NULL,
  `descripcion` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`idhabitacion`, `numero`, `piso`, `max_personas`, `costo`, `tiene_cama_bebe`, `descripcion`) VALUES
(1, '101', 1, 2, '70000.00', 1, 'Alguna descripción.'),
(4, '104', 1, 2, '40000.00', 1, 'Alguna descripción'),
(5, '103', 1, 2, '30000.00', 1, 'Alguna descripción'),
(6, '105', 1, 2, '20000.00', 1, 'Alguna descripción'),
(7, '102', 1, 2, '40000.00', 0, 'Alguna descripción'),
(8, '106', 1, 3, '70000.00', 0, 'Alguna descripción'),
(9, '108', 1, 2, '60000.00', 1, 'Alguna descripción'),
(10, '107', 1, 4, '100000.00', 1, 'Alguna descripción'),
(11, '109', 1, 2, '60000.00', 1, 'Alguna descripción'),
(12, '110', 1, 2, '50000.00', 1, 'Alguna descripción'),
(13, '201', 2, 2, '50000.00', 0, 'Alguna descripción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huesped`
--

CREATE TABLE `huesped` (
  `idhuesped` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `huesped`
--

INSERT INTO `huesped` (`idhuesped`, `nombre`, `cedula`, `telefono`, `email`, `direccion`) VALUES
(2, 'Cristóbal Olano Chávez', '116341074', '3203879626', 'wilfredoc-olanoc@unilibre.edu.co', 'Cra: 56 #9-210 Prados de Guadalupe 2 Calí Valle del Cauca'),
(3, 'Kelvin Olano Chávez', '76790124', '3203470529', 'kel@gmail.com', 'Av: 57 #17-18 pimentel chiclayo - Lambayeque Perú');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idreserva` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `comentario` tinytext,
  `idhabitacion` int(11) NOT NULL,
  `idhuesped` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idreserva`, `fecha_inicio`, `fecha_fin`, `estado`, `comentario`, `idhabitacion`, `idhuesped`) VALUES
(1, '2019-05-10 10:00:00', '2019-05-14 10:00:00', 1, 'Algún comentario', 1, 2),
(2, '2019-05-04 00:00:00', '2019-05-10 00:00:00', 1, 'Todo ok', 4, 2),
(3, '2019-05-18 00:00:00', '2019-05-22 00:00:00', 0, 'Algo ...', 13, 2),
(4, '2019-05-26 00:00:00', '2019-05-30 00:00:00', 1, 'Algún comentario', 11, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`idhabitacion`),
  ADD UNIQUE KEY `numero_UNIQUE` (`numero`);

--
-- Indices de la tabla `huesped`
--
ALTER TABLE `huesped`
  ADD PRIMARY KEY (`idhuesped`),
  ADD UNIQUE KEY `cedula_UNIQUE` (`cedula`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idreserva`),
  ADD KEY `fk_reserva_habitacion_id` (`idhabitacion`),
  ADD KEY `fk_reserva_huesped_id` (`idhuesped`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `idhabitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `huesped`
--
ALTER TABLE `huesped`
  MODIFY `idhuesped` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idreserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_reserva_habitacion` FOREIGN KEY (`idhabitacion`) REFERENCES `habitacion` (`idhabitacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reserva_huesped` FOREIGN KEY (`idhuesped`) REFERENCES `huesped` (`idhuesped`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
