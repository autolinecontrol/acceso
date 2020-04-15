-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2020 at 12:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autoline2020_teleport`
--
CREATE DATABASE IF NOT EXISTS `autoline2020_teleport` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `autoline2020_teleport`;

-- --------------------------------------------------------

--
-- Table structure for table `controladoras`
--

CREATE TABLE `controladoras` (
  `idcontroladora` int(5) NOT NULL,
  `nombrecontroladora` varchar(20) DEFAULT NULL,
  `direccionipcontroladora` varchar(20) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'N',
  `Grupoacceso` varchar(3) NOT NULL DEFAULT '1',
  `Grupohorario` varchar(3) NOT NULL DEFAULT '1',
  `Grupodias` varchar(3) NOT NULL DEFAULT '1',
  `Torre` varchar(3) NOT NULL DEFAULT '1',
  `AP` enum('SI','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

CREATE TABLE `fotos` (
  `identificacion` varchar(11) NOT NULL,
  `foto` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `funcionarios`
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
-- Dumping data for table `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `Identificacion`, `nombre`, `oficina`, `email`, `password`, `hash`, `activo`, `perfil`) VALUES
(1, '1010198755', 'Julian Cardozo', '1', 'desarrolloautoline@gmail.com', 'Acceso2020', '', 5, '5'),
(2, '1013672652', 'David Cabezas', '1', 'dlcabezas2@gmail.com', '1234', '', 5, '5');

-- --------------------------------------------------------

--
-- Table structure for table `grupo_acceso`
--

CREATE TABLE `grupo_acceso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `p5` varchar(2) DEFAULT NULL,
  `p6` varchar(2) DEFAULT NULL,
  `p7` varchar(2) DEFAULT NULL,
  `p8` varchar(2) DEFAULT NULL,
  `p9` varchar(2) DEFAULT NULL,
  `p10` varchar(2) DEFAULT NULL,
  `p11` varchar(2) DEFAULT NULL,
  `p12` varchar(2) DEFAULT NULL,
  `p14` varchar(2) DEFAULT NULL,
  `p15` varchar(2) DEFAULT NULL,
  `sotanos` varchar(2) DEFAULT NULL,
  `looby` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupo_acceso`
--

INSERT INTO `grupo_acceso` (`id`, `nombre`, `p5`, `p6`, `p7`, `p8`, `p9`, `p10`, `p11`, `p12`, `p14`, `p15`, `sotanos`, `looby`) VALUES
(1, 'seguridad', 'SI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'sdf', NULL, 'SI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'algo', 'SI', 'SI', 'SI', 'SI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'acceso total', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI');

-- --------------------------------------------------------

--
-- Table structure for table `grupo_dia`
--

CREATE TABLE `grupo_dia` (
  `iddia` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `Lunes` varchar(2) NOT NULL,
  `Martes` varchar(2) NOT NULL,
  `Miercoles` varchar(2) NOT NULL,
  `Jueves` varchar(2) NOT NULL,
  `Viernes` varchar(2) NOT NULL,
  `Sabado` varchar(2) NOT NULL,
  `Domingo` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grupo_horario`
--

CREATE TABLE `grupo_horario` (
  `idhorario` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `horainicio` datetime NOT NULL,
  `horafin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grupo_torre`
--

CREATE TABLE `grupo_torre` (
  `idtorre` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupo_torre`
--

INSERT INTO `grupo_torre` (`idtorre`, `nombre`) VALUES
(1, 'A'),
(2, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `log`
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
-- Table structure for table `logregistros`
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
  `Correo` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oficinas`
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

-- --------------------------------------------------------

--
-- Table structure for table `parqueadero`
--

CREATE TABLE `parqueadero` (
  `Fechahora` datetime NOT NULL DEFAULT current_timestamp(),
  `Identificacion` varchar(12) NOT NULL,
  `Oficina` varchar(4) NOT NULL,
  `tipov` varchar(5) NOT NULL DEFAULT 'CARRO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

CREATE TABLE `personas` (
  `usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pingreso`
--

CREATE TABLE `pingreso` (
  `idpingreso` int(2) NOT NULL,
  `oficina` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `psalida`
--

CREATE TABLE `psalida` (
  `idpsalida` int(2) NOT NULL,
  `oficina` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transacciones`
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
-- Table structure for table `usuarios`
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
  `grupoacceso` varchar(2) NOT NULL,
  `grupohorario` varchar(5) NOT NULL,
  `grupodias` varchar(5) NOT NULL DEFAULT '',
  `torre` varchar(5) NOT NULL DEFAULT 'CARRO',
  `tipovehiculo` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visitantes`
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
  `grupo` varchar(2) NOT NULL DEFAULT '1',
  `grupohorario` varchar(3) NOT NULL,
  `grupodias` varchar(3) NOT NULL,
  `torre` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `controladoras`
--
ALTER TABLE `controladoras`
  ADD PRIMARY KEY (`idcontroladora`);

--
-- Indexes for table `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`identificacion`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupo_acceso`
--
ALTER TABLE `grupo_acceso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupo_dia`
--
ALTER TABLE `grupo_dia`
  ADD PRIMARY KEY (`iddia`);

--
-- Indexes for table `grupo_horario`
--
ALTER TABLE `grupo_horario`
  ADD PRIMARY KEY (`idhorario`);

--
-- Indexes for table `grupo_torre`
--
ALTER TABLE `grupo_torre`
  ADD PRIMARY KEY (`idtorre`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idLog`),
  ADD KEY `identificacion` (`identificacion`);

--
-- Indexes for table `logregistros`
--
ALTER TABLE `logregistros`
  ADD PRIMARY KEY (`idLog`),
  ADD KEY `idVisitante` (`idVisitante`,`idAutoriza`);

--
-- Indexes for table `oficinas`
--
ALTER TABLE `oficinas`
  ADD PRIMARY KEY (`Numero`),
  ADD UNIQUE KEY `idOficina` (`idOficina`) USING BTREE;

--
-- Indexes for table `parqueadero`
--
ALTER TABLE `parqueadero`
  ADD PRIMARY KEY (`Identificacion`);

--
-- Indexes for table `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`usuario`);

--
-- Indexes for table `pingreso`
--
ALTER TABLE `pingreso`
  ADD PRIMARY KEY (`idpingreso`);

--
-- Indexes for table `psalida`
--
ALTER TABLE `psalida`
  ADD PRIMARY KEY (`idpsalida`);

--
-- Indexes for table `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`idtransaccion`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`),
  ADD KEY `identificacion` (`identificacion`);

--
-- Indexes for table `visitantes`
--
ALTER TABLE `visitantes`
  ADD PRIMARY KEY (`identificacion`),
  ADD UNIQUE KEY `idvisitante` (`idvisitante`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grupo_acceso`
--
ALTER TABLE `grupo_acceso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grupo_torre`
--
ALTER TABLE `grupo_torre`
  MODIFY `idtorre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `idLog` int(40) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logregistros`
--
ALTER TABLE `logregistros`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oficinas`
--
ALTER TABLE `oficinas`
  MODIFY `idOficina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personas`
--
ALTER TABLE `personas`
  MODIFY `usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `idtransaccion` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `idvisitante` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;