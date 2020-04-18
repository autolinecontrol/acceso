-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2020 a las 15:53:16
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `autoline2020_teleport`
--
CREATE DATABASE IF NOT EXISTS `autoline2020_teleport` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `autoline2020_teleport`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controladoras`
--

CREATE TABLE `controladoras` (
  `idcontroladora` int(5) NOT NULL,
  `nombrecontroladora` varchar(20) DEFAULT NULL,
  `direccionipcontroladora` varchar(20) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'N',
  `grupo` tinyint(3) NOT NULL DEFAULT 1,
  `Torre` tinyint(2) NOT NULL DEFAULT 1,
  `AP` enum('SI','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `controladoras`
--

INSERT INTO `controladoras` (`idcontroladora`, `nombrecontroladora`, `direccionipcontroladora`, `estado`, `grupo`, `Torre`, `AP`) VALUES
(1, 'entrada p5', '192.168.100.1', 'N', 5, 1, 'NO'),
(2, 'entrada p5', '192.168.100.2', 'N', 5, 2, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `identificacion` varchar(11) NOT NULL,
  `foto` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `Identificacion` varchar(12) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `oficina` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 0,
  `perfil` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `Identificacion`, `nombre`, `oficina`, `email`, `password`, `hash`, `activo`, `perfil`) VALUES
(1, '1010198755', 'Julian Cardozo', '1', 'desarrolloautoline@gmail.com', 'Acceso2020', '', 5, '5'),
(2, '1013672652', 'David Cabezas', '1', 'dlcabezas2@gmail.com', '1234', '', 5, '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_acceso`
--

CREATE TABLE `grupo_acceso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `p5` tinyint(1) DEFAULT 0,
  `p6` tinyint(1) DEFAULT 0,
  `p7` tinyint(1) DEFAULT 0,
  `p8` tinyint(1) DEFAULT 0,
  `p9` tinyint(1) DEFAULT 0,
  `p10` tinyint(1) DEFAULT 0,
  `p11` tinyint(1) DEFAULT 0,
  `p12` tinyint(1) DEFAULT 0,
  `p14` tinyint(1) DEFAULT 0,
  `p15` tinyint(1) DEFAULT 0,
  `sotanos` tinyint(1) DEFAULT 0,
  `looby` tinyint(1) DEFAULT 0,
  `pv` tinyint(1) DEFAULT 0,
  `pf` tinyint(1) DEFAULT 0,
  `torre` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo_acceso`
--

INSERT INTO `grupo_acceso` (`id`, `nombre`, `p5`, `p6`, `p7`, `p8`, `p9`, `p10`, `p11`, `p12`, `p14`, `p15`, `sotanos`, `looby`, `pv`, `pf`, `torre`) VALUES
(1, 'acceso total', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_dia`
--

CREATE TABLE `grupo_dia` (
  `iddia` int(11) NOT NULL,
  `numero` tinyint(4) NOT NULL DEFAULT 1,
  `Lunes` tinyint(1) NOT NULL DEFAULT 0,
  `Martes` tinyint(1) NOT NULL DEFAULT 0,
  `Miercoles` tinyint(1) NOT NULL DEFAULT 0,
  `Jueves` tinyint(1) NOT NULL DEFAULT 0,
  `Viernes` tinyint(1) NOT NULL DEFAULT 0,
  `Sabado` tinyint(1) NOT NULL DEFAULT 0,
  `Domingo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo_dia`
--

INSERT INTO `grupo_dia` (`iddia`, `numero`, `Lunes`, `Martes`, `Miercoles`, `Jueves`, `Viernes`, `Sabado`, `Domingo`) VALUES
(1, 5, 1, 1, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_horario`
--

CREATE TABLE `grupo_horario` (
  `idhorario` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `horainicio` time NOT NULL,
  `horafin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo_horario`
--

INSERT INTO `grupo_horario` (`idhorario`, `nombre`, `horainicio`, `horafin`) VALUES
(1, '8 a 5', '08:00:00', '05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_torre`
--

CREATE TABLE `grupo_torre` (
  `idtorre` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo_torre`
--

INSERT INTO `grupo_torre` (`idtorre`, `nombre`) VALUES
(1, 'A'),
(2, 'B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `idLog` int(40) NOT NULL,
  `fechaevento` datetime(6) NOT NULL,
  `identificacion` varchar(20) NOT NULL,
  `evento` varchar(20) NOT NULL,
  `motivo` varchar(15) NOT NULL,
  `ncontroladora` int(10) NOT NULL,
  `grupo` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logregistros`
--

CREATE TABLE `logregistros` (
  `idLog` int(11) NOT NULL,
  `Administrador` varchar(50) NOT NULL,
  `idVisitante` int(12) NOT NULL,
  `idAutoriza` int(12) NOT NULL,
  `Oficina` varchar(4) NOT NULL,
  `Fechahora` timestamp NOT NULL DEFAULT current_timestamp(),
  `Fechainicio` datetime(6) NOT NULL DEFAULT '2019-01-01 00:00:00.000000',
  `Fechafin` datetime(6) NOT NULL,
  `Tipo` varchar(15) NOT NULL,
  `Accion` varchar(15) NOT NULL,
  `Vehiculo` varchar(10) NOT NULL,
  `Tipovehiculo` varchar(30) DEFAULT NULL,
  `Correo` varchar(30) NOT NULL,
  `grupoacceso` varchar(4) NOT NULL,
  `grupohorario` varchar(4) NOT NULL,
  `grupodias` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `logregistros`
--

INSERT INTO `logregistros` (`idLog`, `Administrador`, `idVisitante`, `idAutoriza`, `Oficina`, `Fechahora`, `Fechainicio`, `Fechafin`, `Tipo`, `Accion`, `Vehiculo`, `Tipovehiculo`, `Correo`, `grupoacceso`, `grupohorario`, `grupodias`) VALUES
(1, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 20:20:22', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(2, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 20:22:50', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(3, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 20:27:44', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(4, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 20:28:17', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(5, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 20:28:40', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(6, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 21:16:01', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(7, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 21:26:01', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(8, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 21:26:21', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(9, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 21:27:25', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(10, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 21:31:21', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(11, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 22:17:10', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(12, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-17 23:32:53', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(13, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-18 12:49:42', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(14, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-18 12:50:26', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(15, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-18 12:50:41', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(16, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-18 12:51:15', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(17, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-18 12:54:10', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(18, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-18 13:07:08', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(19, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-18 13:38:27', '2020-04-17 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO', 'correo@gmail.com', '1', '1', '1'),
(20, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-18 13:41:18', '2020-04-18 06:00:00.000000', '2021-04-18 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO', 'dlcabezas2@gmail.com', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficinas`
--

CREATE TABLE `oficinas` (
  `idOficina` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Ubicacion` varchar(20) NOT NULL,
  `Numero` varchar(10) NOT NULL DEFAULT '0',
  `Cupocarros` varchar(3) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `Cupoactualcarros` varchar(3) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `CupoMotos` varchar(3) NOT NULL DEFAULT '0',
  `CupoActualMotos` varchar(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oficinas`
--

INSERT INTO `oficinas` (`idOficina`, `Nombre`, `Ubicacion`, `Numero`, `Cupocarros`, `Cupoactualcarros`, `CupoMotos`, `CupoActualMotos`) VALUES
(1, 'Recepcion', '1', '1', '50', '50', '50', '50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parqueadero`
--

CREATE TABLE `parqueadero` (
  `Fechahora` datetime NOT NULL DEFAULT current_timestamp(),
  `Identificacion` varchar(12) NOT NULL,
  `Oficina` varchar(4) NOT NULL,
  `tipov` varchar(5) NOT NULL DEFAULT 'CARRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pingreso`
--

CREATE TABLE `pingreso` (
  `idpingreso` int(2) NOT NULL,
  `oficina` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `psalida`
--

CREATE TABLE `psalida` (
  `idpsalida` int(2) NOT NULL,
  `oficina` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `idtransaccion` int(20) NOT NULL,
  `identificacion` varchar(20) NOT NULL,
  `Ingreso` datetime NOT NULL,
  `Salida` datetime NOT NULL,
  `Estado` varchar(2) NOT NULL,
  `controladora` int(5) NOT NULL,
  `oficina` varchar(4) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `identificacion` bigint(20) NOT NULL,
  `fechainicio` datetime NOT NULL,
  `fechafin` datetime NOT NULL,
  `ncontroladora` varchar(4) NOT NULL,
  `estado` varchar(1) NOT NULL,
  `vehiculo` varchar(2) NOT NULL,
  `oficina` varchar(10) NOT NULL,
  `grupohorario` varchar(5) NOT NULL,
  `grupodias` varchar(5) NOT NULL DEFAULT '',
  `torre` varchar(5) NOT NULL DEFAULT 'CARRO',
  `tipovehiculo` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `identificacion`, `fechainicio`, `fechafin`, `ncontroladora`, `estado`, `vehiculo`, `oficina`, `grupohorario`, `grupodias`, `torre`, `tipovehiculo`) VALUES
(2, 1013672652, '2020-04-18 06:00:00', '2021-04-18 23:00:00', '1', 'N', 'NO', '1', '1', '1', '1', 'NO'),
(3, 1013672652, '2020-04-18 06:00:00', '2021-04-18 23:00:00', '2', 'N', 'NO', '1', '1', '1', '2', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

CREATE TABLE `visitantes` (
  `idvisitante` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 NOT NULL,
  `identificacion` varchar(12) CHARACTER SET utf8 NOT NULL,
  `codigo` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  `Oficina` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `correo` varchar(100) DEFAULT 'centralpoint@gmail.com',
  `Ingreso` datetime DEFAULT NULL,
  `Salida` datetime DEFAULT NULL,
  `ncontroladora` varchar(4) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `tipo` varchar(12) DEFAULT 'VISITANTE',
  `vehiculo` varchar(2) CHARACTER SET utf8 DEFAULT 'NO',
  `Tipovehiculo` varchar(30) DEFAULT NULL,
  `grupoacceso` varchar(2) NOT NULL DEFAULT '1',
  `grupohorario` varchar(3) NOT NULL,
  `grupodias` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`idvisitante`, `nombre`, `identificacion`, `codigo`, `Oficina`, `correo`, `Ingreso`, `Salida`, `ncontroladora`, `estado`, `tipo`, `vehiculo`, `Tipovehiculo`, `grupoacceso`, `grupohorario`, `grupodias`) VALUES
(17, 'David Leonardo ', '1013672652', NULL, '1', 'dlcabezas2@gmail.com', '2020-04-18 06:00:00', '2021-04-18 23:00:00', '1', 'N', 'FUNCIONARIO', 'NO', 'NO', '1', '1', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `controladoras`
--
ALTER TABLE `controladoras`
  ADD PRIMARY KEY (`idcontroladora`),
  ADD KEY `grupo` (`grupo`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`identificacion`);

--
-- Indices de la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo_acceso`
--
ALTER TABLE `grupo_acceso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo_dia`
--
ALTER TABLE `grupo_dia`
  ADD PRIMARY KEY (`iddia`);

--
-- Indices de la tabla `grupo_horario`
--
ALTER TABLE `grupo_horario`
  ADD PRIMARY KEY (`idhorario`);

--
-- Indices de la tabla `grupo_torre`
--
ALTER TABLE `grupo_torre`
  ADD PRIMARY KEY (`idtorre`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idLog`),
  ADD KEY `identificacion` (`identificacion`);

--
-- Indices de la tabla `logregistros`
--
ALTER TABLE `logregistros`
  ADD PRIMARY KEY (`idLog`),
  ADD KEY `idVisitante` (`idVisitante`,`idAutoriza`);

--
-- Indices de la tabla `oficinas`
--
ALTER TABLE `oficinas`
  ADD PRIMARY KEY (`Numero`),
  ADD UNIQUE KEY `idOficina` (`idOficina`) USING BTREE;

--
-- Indices de la tabla `parqueadero`
--
ALTER TABLE `parqueadero`
  ADD PRIMARY KEY (`Identificacion`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `pingreso`
--
ALTER TABLE `pingreso`
  ADD PRIMARY KEY (`idpingreso`);

--
-- Indices de la tabla `psalida`
--
ALTER TABLE `psalida`
  ADD PRIMARY KEY (`idpsalida`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`idtransaccion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`),
  ADD KEY `identificacion` (`identificacion`);

--
-- Indices de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  ADD PRIMARY KEY (`identificacion`),
  ADD UNIQUE KEY `idvisitante` (`idvisitante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `controladoras`
--
ALTER TABLE `controladoras`
  MODIFY `idcontroladora` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `grupo_acceso`
--
ALTER TABLE `grupo_acceso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `grupo_dia`
--
ALTER TABLE `grupo_dia`
  MODIFY `iddia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `grupo_horario`
--
ALTER TABLE `grupo_horario`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `grupo_torre`
--
ALTER TABLE `grupo_torre`
  MODIFY `idtorre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `idLog` int(40) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logregistros`
--
ALTER TABLE `logregistros`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `oficinas`
--
ALTER TABLE `oficinas`
  MODIFY `idOficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `idtransaccion` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `idvisitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
