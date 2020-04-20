-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2020 at 08:03 PM
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
  `grupo` varchar(3) NOT NULL DEFAULT '1',
  `Torre` varchar(3) NOT NULL DEFAULT '1',
  `AP` enum('SI','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `controladoras`
--

INSERT INTO `controladoras` (`idcontroladora`, `nombrecontroladora`, `direccionipcontroladora`, `estado`, `grupo`, `Torre`, `AP`) VALUES
(4, 'lobby salida pasillo', '192.168.0.11', 'O', '4', '1', 'NO'),
(13, 'lobby ingreso pasill', '192.168.0.10', 'I', '4', '1', 'NO'),
(14, 'lobby ingreso pasill', '192.168.0.12', 'I', '4', '1', 'NO'),
(15, 'lobby salida pasillo', '192.168.0.14', 'O', '4', '1', 'NO'),
(16, 'lobby ingreso pasill', '192.168.0.15', 'I', '4', '1', 'NO'),
(17, 'lobby salida pasillo', '192.168.0.16', 'O', '4', '1', 'NO'),
(18, 'lobby ingreso pasill', '192.168.0.17', 'I', '4', '1', 'NO'),
(19, 'lobby salida pasillo', '192.168.0.18', 'O', '4', '1', 'NO'),
(21, 'Piso 5 TA', '192.168.0.20', 'O', '5', '1', 'NO'),
(22, 'Piso 6 TA', '192.168.0.21', 'O', '6', '1', 'NO'),
(23, 'Piso 7 TA', '192.168.0.22', 'O', '7', '1', 'NO'),
(24, 'Piso 8 TA', '192.168.0.23', 'O', '8', '1', 'NO'),
(25, 'Piso 9 TA', '192.168.0.24', 'O', '9', '1', 'NO'),
(26, 'Piso 10 TA', '192.168.0.25', 'O', '10', '1', 'NO'),
(27, 'Piso 11 TA', '192.168.0.26', 'O', '11', '1', 'NO'),
(28, 'Piso 12 TA', '192.168.0.27', 'O', '12', '1', 'NO'),
(29, 'Piso 14 TA', '192.168.0.28', 'O', '14', '1', 'NO'),
(30, 'Piso 15 TA', '192.168.0.29', 'O', '15', '1', 'NO'),
(31, 'Sotano TA', '192.168.0.30', 'O', '1', '1', 'NO'),
(32, 'lobby ingreso pasill', '192.168.0.31', 'I', '4', '2', 'NO'),
(33, 'lobby salida pasillo', '192.168.0.32', 'O', '4', '2', 'NO'),
(34, 'lobby ingreso pasill', '192.168.0.33', 'I', '4', '2', 'NO'),
(35, 'lobby salida pasillo', '192.168.0.34', 'O', '4', '2', 'NO'),
(36, 'lobby ingreso pasill', '192.168.0.35', 'I', '4', '2', 'NO'),
(37, 'lobby salida pasillo', '192.168.0.36', 'O', '4', '2', 'NO'),
(38, 'lobby ingreso pasill', '192.168.0.37', 'I', '4', '2', 'NO'),
(39, 'lobby salida pasillo', '192.168.0.38', 'O', '4', '2', 'NO'),
(40, 'Piso 5 TB', '192.168.0.39', 'O', '5', '2', 'NO'),
(41, 'Piso 6 TB', '192.168.0.40', 'O', '6', '2', 'NO'),
(42, 'Piso 7 TB', '192.168.0.41', 'O', '7', '2', 'NO'),
(43, 'Piso 8 TB', '192.168.0.42', 'O', '8', '2', 'NO'),
(44, 'Piso 9 TB', '192.168.0.43', 'O', '9', '2', 'NO'),
(45, 'Piso 10 TB', '192.168.0.44', 'O', '10', '2', 'NO'),
(46, 'Piso 11 TB', '192.168.0.45', 'O', '11', '2', 'NO'),
(47, 'Piso 12 TB', '192.168.0.46', 'O', '12', '2', 'NO'),
(48, 'Piso 14 TB', '192.168.0.47', 'O', '14', '2', 'NO'),
(49, 'Piso 15 TB', '192.168.0.48', 'O', '15', '2', 'NO'),
(50, 'Sotano TB', '192.168.0.49', 'O', '1', '2', 'NO'),
(51, 'Parq ingreso vis TA', '192.168.0.50', 'I', '2', '1', 'NO'),
(52, 'Parq salida vis TA', '192.168.0.51', 'O', '2', '1', 'NO'),
(53, 'Parq ingreso fun TA', '192.168.0.52', 'I', '3', '1', 'NO'),
(54, 'Parq salida fun TA', '192.168.0.53', 'O', '3', '1', 'NO'),
(55, 'Parq ingreso vis TB', '192.168.0.54', 'I', '2', '2', 'NO'),
(56, 'Parq salida vis TB', '192.168.0.55', 'O', '2', '2', 'NO'),
(57, 'Parq ingreso fun TB', '192.168.0.56', 'I', '3', '2', 'NO'),
(58, 'Parq salida fun TB', '192.168.0.57', 'O', '3', '2', 'NO');

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
-- Dumping data for table `grupo_acceso`
--

INSERT INTO `grupo_acceso` (`id`, `nombre`, `p5`, `p6`, `p7`, `p8`, `p9`, `p10`, `p11`, `p12`, `p14`, `p15`, `sotanos`, `looby`, `pv`, `pf`, `torre`) VALUES
(1, 'acceso total', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `grupo_dia`
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
-- Dumping data for table `grupo_dia`
--

INSERT INTO `grupo_dia` (`iddia`, `numero`, `Lunes`, `Martes`, `Miercoles`, `Jueves`, `Viernes`, `Sabado`, `Domingo`) VALUES
(1, 5, 1, 1, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `grupo_horario`
--

CREATE TABLE `grupo_horario` (
  `idhorario` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `horainicio` time NOT NULL,
  `horafin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupo_horario`
--

INSERT INTO `grupo_horario` (`idhorario`, `nombre`, `horainicio`, `horafin`) VALUES
(1, 'jornada laboral 8 a 5', '08:00:00', '17:00:00');

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
  `Correo` varchar(30) NOT NULL,
  `grupohorario` tinyint(4) NOT NULL,
  `grupoacceso` tinyint(4) NOT NULL,
  `grupodias` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logregistros`
--

INSERT INTO `logregistros` (`idLog`, `Administrador`, `idVisitante`, `idAutoriza`, `Oficina`, `Fechahora`, `Fechainicio`, `Fechafin`, `Tipo`, `Accion`, `Vehiculo`, `Tipovehiculo`, `Correo`, `grupohorario`, `grupoacceso`, `grupodias`) VALUES
(1, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-16 18:32:01', '2020-04-16 06:00:00.000000', '2020-04-17 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO', 'dlcabezas2@gmail.com', 0, 0, 0),
(2, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-16 19:48:27', '2020-04-16 06:00:00.000000', '2020-04-16 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO', 'dlcabezas2@gmail.com', 0, 0, 0),
(3, 'David Cabezas', 1013672652, 0, '1', '2020-04-20 16:04:50', '2020-04-20 06:00:00.000000', '2020-04-25 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO ', 'dlcabezas2@gmail.com', 1, 1, 1),
(4, 'David Cabezas', 1013672652, 0, '1', '2020-04-20 16:07:15', '2020-04-20 06:00:00.000000', '2020-04-25 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(5, 'David Cabezas', 1013672652, 0, '1', '2020-04-20 16:12:45', '2020-04-20 06:00:00.000000', '2020-04-25 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(6, 'David Cabezas', 1013672652, 0, '1', '2020-04-20 16:12:54', '2020-04-20 06:00:00.000000', '2020-04-25 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(7, 'David Cabezas', 1013672652, 0, '1', '2020-04-20 16:13:16', '2020-04-20 06:00:00.000000', '2020-04-25 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(8, 'David Cabezas', 1013672652, 0, '1', '2020-04-20 16:13:31', '2020-04-20 06:00:00.000000', '2020-04-25 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(9, 'David Cabezas', 1013672652, 0, '1', '2020-04-20 16:14:09', '2020-04-20 06:00:00.000000', '2020-04-25 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(10, 'David Cabezas', 1013672652, 0, '1', '2020-04-20 16:14:43', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(11, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:16:06', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(12, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:16:26', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(13, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:17:03', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO ', 'dlcabezas2@gmail.com', 1, 1, 1),
(14, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:18:01', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(15, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:20:25', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(16, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:21:15', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(17, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:25:53', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', '', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(18, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:26:35', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(19, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:27:47', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(20, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:28:06', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(21, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:28:28', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(22, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:30:23', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(23, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:30:49', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(24, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:31:05', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(25, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:31:20', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(26, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:31:30', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(27, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:34:07', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'CARRO', 'dlcabezas2@gmail.com', 1, 1, 1),
(28, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 16:47:39', '2020-04-20 06:00:00.000000', '2021-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'SI', 'MOTO\r\n', 'dlcabezas2@gmail.com', 1, 1, 1),
(29, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 17:07:26', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO', 'dlcabezas2@gmail.com', 1, 1, 1),
(30, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 17:18:47', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO', 'dlcabezas2@gmail.com', 1, 1, 1),
(31, 'David Cabezas', 1013672652, 1013672652, '1', '2020-04-20 17:19:49', '2020-04-20 06:00:00.000000', '2020-04-20 23:00:00.000000', 'FUNCIONARIO', 'REGISTRADO', 'NO', 'NO', 'dlcabezas2@gmail.com', 1, 1, 1);

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

--
-- Dumping data for table `oficinas`
--

INSERT INTO `oficinas` (`idOficina`, `Nombre`, `Ubicacion`, `Numero`, `Cupocarros`, `Cupoactualcarros`, `CupoMotos`, `CupoActualMotos`) VALUES
(1, 'Recepcion', '1', '1', '50', '50', '50', '50');

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
-- Table structure for table `ubicacion`
--

CREATE TABLE `ubicacion` (
  `idubicacion` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `grupo` varchar(2) NOT NULL,
  `grupohorario` varchar(5) NOT NULL,
  `grupodias` varchar(5) NOT NULL DEFAULT '',
  `torre` varchar(5) NOT NULL DEFAULT 'CARRO',
  `tipovehiculo` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `identificacion`, `fechainicio`, `fechafin`, `ncontroladora`, `estado`, `vehiculo`, `oficina`, `grupo`, `grupohorario`, `grupodias`, `torre`, `tipovehiculo`) VALUES
(1, 0, '2020-04-20 06:00:00', '2020-04-25 23:00:00', '1', 'N', 'NO', '1', '', '1', '1', '1', 'NO\r\n'),
(2, 0, '2020-04-20 06:00:00', '2020-04-25 23:00:00', '2', 'N', 'NO', '1', '', '1', '1', '2', 'NO\r\n'),
(63, 1013672652, '2020-04-20 06:00:00', '2020-04-20 23:00:00', '2', 'N', 'NO', '1', '5', '1', '1', '2', 'NO'),
(62, 1013672652, '2020-04-20 06:00:00', '2020-04-20 23:00:00', '1', 'N', 'NO', '1', '5', '1', '1', '1', 'NO');

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
  `grupoacceso` varchar(2) NOT NULL DEFAULT '1',
  `grupohorario` varchar(3) NOT NULL,
  `grupodias` varchar(3) NOT NULL,
  `torre` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitantes`
--

INSERT INTO `visitantes` (`idvisitante`, `nombre`, `identificacion`, `codigo`, `Oficina`, `correo`, `Ingreso`, `Salida`, `ncontroladora`, `estado`, `tipo`, `vehiculo`, `Tipovehiculo`, `grupoacceso`, `grupohorario`, `grupodias`, `torre`) VALUES
(18, 'David Leonardo Cabezas', '1013672652', NULL, '1', 'dlcabezas2@gmail.com', '2020-04-20 06:00:00', '2020-04-20 23:00:00', '1', 'N', 'FUNCIONARIO', 'NO', 'NO', '1', '1', '1', '');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Identificacion` (`Identificacion`);

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
-- Indexes for table `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`idubicacion`);

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
-- AUTO_INCREMENT for table `controladoras`
--
ALTER TABLE `controladoras`
  MODIFY `idcontroladora` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grupo_acceso`
--
ALTER TABLE `grupo_acceso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grupo_dia`
--
ALTER TABLE `grupo_dia`
  MODIFY `iddia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grupo_horario`
--
ALTER TABLE `grupo_horario`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `oficinas`
--
ALTER TABLE `oficinas`
  MODIFY `idOficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `idubicacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `idvisitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
