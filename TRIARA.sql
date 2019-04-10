-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2019 a las 19:30:47
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
-- Base de datos: `TRIARA`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CONTACTO`
--

CREATE TABLE `CONTACTO` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(256) NOT NULL,
  `APELLIDO_PATERNO` varchar(256) NOT NULL,
  `APELLIDO_MATERNO` varchar(256) NOT NULL,
  `FECHA_NACIMIENTO` date NOT NULL,
  `ALIAS` varchar(256) DEFAULT NULL,
  `IMAGEN` varchar(256) DEFAULT NULL,
  `FECHA_CREACION` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `CONTACTO`
--

INSERT INTO `CONTACTO` (`ID`, `NOMBRE`, `APELLIDO_PATERNO`, `APELLIDO_MATERNO`, `FECHA_NACIMIENTO`, `ALIAS`, `IMAGEN`, `FECHA_CREACION`) VALUES
(1, 'DANIEL1', 'Herrera1', 'CABRERA1', '1988-05-15', 'Danny', 'contactos/KKOsGsHqdxPMJu2cIq5mkK14RFKoqoa69VFtDBgp.png', '2019-04-06'),
(21, 'sadfsadf', 'sadfsadf', 'asdf', '2019-04-02', 'sadf', NULL, '2019-04-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CORREOS`
--

CREATE TABLE `CORREOS` (
  `ID` int(11) NOT NULL,
  `ID_CONTACTO` int(11) NOT NULL,
  `CORREO` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `CORREOS`
--

INSERT INTO `CORREOS` (`ID`, `ID_CONTACTO`, `CORREO`) VALUES
(3, 1, 'ghghdf@sdf.com'),
(14, 21, 'sadfsafd@sdf.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DIRECCIONES`
--

CREATE TABLE `DIRECCIONES` (
  `ID` int(11) NOT NULL,
  `ID_CONTACTO` int(11) NOT NULL,
  `DIRECCION` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `DIRECCIONES`
--

INSERT INTO `DIRECCIONES` (`ID`, `ID_CONTACTO`, `DIRECCION`) VALUES
(2, 1, 'asdfasdfsadf'),
(4, 21, 'sdfsadf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TELEFONOS`
--

CREATE TABLE `TELEFONOS` (
  `ID` int(11) NOT NULL,
  `ID_CONTACTO` int(11) NOT NULL,
  `ETIQUETA` varchar(256) NOT NULL,
  `TELEFONO` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `TELEFONOS`
--

INSERT INTO `TELEFONOS` (`ID`, `ID_CONTACTO`, `ETIQUETA`, `TELEFONO`) VALUES
(1, 1, 'Casa', '0123456789'),
(13, 21, 'sadfsadf', '3453453453');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CONTACTO`
--
ALTER TABLE `CONTACTO`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `CORREOS`
--
ALTER TABLE `CORREOS`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `index_CORREOS_ID_CONTACTO` (`ID_CONTACTO`);

--
-- Indices de la tabla `DIRECCIONES`
--
ALTER TABLE `DIRECCIONES`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_CONTACTO` (`ID_CONTACTO`);

--
-- Indices de la tabla `TELEFONOS`
--
ALTER TABLE `TELEFONOS`
  ADD PRIMARY KEY (`ID`) USING HASH,
  ADD KEY `index_TELEFONOS_ID_CONTACTO` (`ID_CONTACTO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `CONTACTO`
--
ALTER TABLE `CONTACTO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `CORREOS`
--
ALTER TABLE `CORREOS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `DIRECCIONES`
--
ALTER TABLE `DIRECCIONES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `TELEFONOS`
--
ALTER TABLE `TELEFONOS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `CORREOS`
--
ALTER TABLE `CORREOS`
  ADD CONSTRAINT `FK_CONTACTO_CORREOS` FOREIGN KEY (`ID_CONTACTO`) REFERENCES `CONTACTO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `DIRECCIONES`
--
ALTER TABLE `DIRECCIONES`
  ADD CONSTRAINT `FK_CONTACTOS_DIRECCIONES` FOREIGN KEY (`ID_CONTACTO`) REFERENCES `CONTACTO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `TELEFONOS`
--
ALTER TABLE `TELEFONOS`
  ADD CONSTRAINT `FK_CONTACTO_TELEFONOS` FOREIGN KEY (`ID_CONTACTO`) REFERENCES `CONTACTO` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
