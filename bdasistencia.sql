-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-11-2023 a las 14:58:21
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdasistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `idperfil` int(11) NOT NULL,
  `idopcion` int(11) NOT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`idperfil`, `idopcion`, `estado`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(1, 7, 1),
(1, 8, 1),
(1, 9, 1),
(2, 5, 1),
(2, 6, 1),
(3, 5, 1),
(3, 6, 1),
(3, 9, 1),
(4, 1, 1),
(4, 2, 1),
(4, 6, 0),
(4, 7, 1),
(6, 1, 1),
(6, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afectacion`
--

CREATE TABLE `afectacion` (
  `idafectacion` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `afectacion`
--

INSERT INTO `afectacion` (`idafectacion`, `descripcion`) VALUES
(10, 'GRAVADAS'),
(20, 'EXONERADAS'),
(30, 'INAFECTAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idasistencia` int(11) NOT NULL,
  `iddocente` int(11) NOT NULL,
  `idcurso` int(11) DEFAULT NULL,
  `semestre` varchar(10) NOT NULL,
  `ciclo` varchar(5) DEFAULT NULL,
  `fecha` date NOT NULL,
  `horaentrada` time DEFAULT NULL,
  `horasalida` time DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`idasistencia`, `iddocente`, `idcurso`, `semestre`, `ciclo`, `fecha`, `horaentrada`, `horasalida`, `estado`) VALUES
(1, 137, NULL, '', NULL, '2023-11-02', '01:00:00', '06:00:00', 1),
(2, 160, NULL, '', NULL, '2023-10-03', '00:00:00', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `idcarrera` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `estado`) VALUES
(1, 'METALES', 2),
(2, 'CHOCOLATES', 2),
(3, 'UTILES DE LIMPIEZA', 2),
(4, 'UTILES DE ASEO', 2),
(5, 'LACTEOS ABC', 2),
(6, 'FRUTAS', 2),
(7, 'VERDURAS', 0),
(8, 'POSTRES', 1),
(9, 'CARNES', 1),
(10, 'GASEOSAS', 1),
(11, 'DULCES', 1),
(12, 'GOLOSINAS', 1),
(13, 'REPUESTOS', 1),
(14, 'MENESTRAS', 1),
(15, 'GALLETAS', 1),
(16, 'GALLETAS2', 2),
(17, 'LACTEOS', 1),
(18, 'LACTEOS X', 2),
(19, 'LACTEOS X', 2),
(20, 'GALLETAS X', 1),
(21, 'GALLETAS Z', 1),
(22, 'CATEGORIA ABC', 1),
(23, 'CATEGORIA XYZ', 1),
(24, 'PASTILLAS', 1),
(25, 'CATEGORIA Z', 1),
(26, 'CATEGORIA POS02', 2),
(27, 'CATEGORIA POS02', 2),
(28, 'CATEGORIA POS02', 2),
(29, 'CATEGORIA POS02', 2),
(30, 'CATEGORIA POS02', 1),
(31, 'CATEGORIA POS02', 2),
(32, 'CATEGORIA POS02', 2),
(33, 'CATEGORIA POS02', 2),
(34, 'CATEGORIA POS02', 2),
(35, 'PRUEBA Z', 1),
(36, 'BARBERIA', 1),
(37, 'BEBIDAS FRIAS', 1),
(38, 'lacteos abcd', 1),
(39, 'frutas secas', 1),
(40, 'CATEGORIA AZB', 1),
(41, 'ab', 1),
(42, 'PARACETAMOL 500MG', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo`
--

CREATE TABLE `ciclo` (
  `idciclo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `idtipodocumento` char(1) DEFAULT NULL,
  `nrodocumento` varchar(20) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `idtipodocumento`, `nrodocumento`, `direccion`, `estado`) VALUES
(1, 'JUAN PEREZ', '1', '12345699', 'MANUEL NRO 123 - CERCADO DE LIMA', 1),
(2, 'TAQINI TECHNOLOGY S.A.C.', '6', '20602814425', 'CAL.JUAN CUGLIEVAN NRO. 216 CERCADO DE CHICLAYO  (OFICINA NRO. 301)  LAMBAYEQUE - CHICLAYO - CHICLAYO', 1),
(3, 'JUNTA DE USUARIOS DEL SECTOR HIDRAULICO MENOR SAN LORENZO', '6', '20161500292', 'AV.REFORMA AGRARIA NRO. S N CRUCETA  (EX DRENAJE)  PIURA - PIURA - TAMBO GRANDE', 1),
(4, 'EUSEBIO KELVIN RIVADENEIRA FABIAN', '1', '75123787', 'Aguaytia - UCAYALI', 1),
(5, 'ELVIS ENRIQUE VALENTIN MALDONADO', '1', '46874321', 'PISCO', 1),
(6, 'ESWIN YASMANI MORALES VINCES', '1', '41981450', 'TUMBES', 1),
(7, 'CARLOS', '1', '12345695', 'PERU', 1),
(8, 'ASSEL', '1', '12345678', 'PERU', 1),
(9, 'CHAVITO', '1', '44332211', 'PERU', 1),
(10, 'JOSE PEREZ', '1', '12312333', 'CHICLAYO', 2),
(11, 'ALUMNO ISITO', '1', '46189137', 'ATEX', 1),
(12, 'WILSON WALTER REVILLA SUAREZ', '1', '43499283', 'PERU', 1),
(13, 'ICLOUDFLEX E.I.R.L.X', '6', '20606144459', 'JR.TRUJILLO NRO. 888 URB.  ORRANTIA DEL MAR  LIMA - LIMA - MAGDALENA DEL MAR', 1),
(14, 'INDUSTRIA DE PALMA ACEITERA DE LORETO Y SAN MARTIN S.A.', '6', '20450105466', 'CAR.F.BEL.TERR-TRA.TARA.YURI. KM. 63.5 CAS.  SECTOR HUICUNGO  (A 500 MT. INICI CARR.A BARRANQUITA)  SAN MARTIN - LAMAS - CAYNARACHI', 1),
(15, '', '1', '55555', '', 1),
(16, 'FRANKLIN ALEXIS CRUZ DIAZ', '1', '47691071', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idcurso`, `codigo`, `nombre`, `estado`) VALUES
(1, 'ME-26', 'MÉTODOS NUMÉRICOS ', 1),
(2, 'ME-44', 'AUTOMATIZACIÓN INDUSTRIAL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `iddetalle` int(11) NOT NULL,
  `idventa` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `cantidad` decimal(15,2) DEFAULT NULL,
  `unidad` char(3) DEFAULT NULL,
  `pventa` decimal(15,2) DEFAULT NULL,
  `igv` decimal(15,2) DEFAULT NULL,
  `icbper` decimal(15,2) DEFAULT NULL,
  `descuento` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `idafectacion` int(11) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `fhregistro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`iddetalle`, `idventa`, `idproducto`, `cantidad`, `unidad`, `pventa`, `igv`, `icbper`, `descuento`, `total`, `idafectacion`, `estado`, `idusuario`, `fhregistro`) VALUES
(1, 1, 8, 1.00, 'NIU', 10.00, 1.53, 0.00, 0.00, 10.00, 10, 1, NULL, NULL),
(2, 2, 1, 3.00, 'NIU', 3.00, 1.37, 0.00, 0.00, 9.00, 10, 2, NULL, NULL),
(3, 3, 1, 1.00, 'NIU', 3.00, 0.46, 0.00, 0.00, 3.00, 10, 1, NULL, NULL),
(4, 3, 9, 1.00, 'NIU', 15.00, 2.29, 0.00, 0.00, 15.00, 10, 1, NULL, NULL),
(5, 4, 6, 2.00, 'NIU', 6.00, 1.83, 0.00, 0.00, 12.00, 10, 1, NULL, NULL),
(6, 5, 1, 7.00, 'NIU', 3.00, 3.20, 0.00, 0.00, 21.00, 10, 1, NULL, NULL),
(7, 6, 3, 2.00, 'NIU', 0.60, 0.18, 0.00, 0.00, 1.20, 10, 1, NULL, NULL),
(8, 6, 6, 3.00, 'NIU', 6.00, 2.75, 0.00, 0.00, 18.00, 10, 1, NULL, NULL),
(9, 7, 8, 4.00, 'NIU', 10.00, 6.10, 0.00, 0.00, 40.00, 10, 1, NULL, NULL),
(10, 8, 6, 3.00, 'NIU', 6.00, 2.75, 0.00, 0.00, 18.00, 10, 1, NULL, NULL),
(11, 9, 9, 7.00, 'NIU', 15.00, 16.02, 0.00, 0.00, 105.00, 10, 1, NULL, NULL),
(12, 10, 9, 3.00, 'NIU', 15.00, 6.86, 0.00, 0.00, 45.00, 10, 1, NULL, NULL),
(13, 10, 6, 2.00, 'NIU', 6.00, 1.83, 0.00, 0.00, 12.00, 10, 1, NULL, NULL),
(14, 10, 8, 1.00, 'NIU', 10.00, 1.53, 0.00, 0.00, 10.00, 10, 1, NULL, NULL),
(15, 11, 8, 1.00, 'NIU', 10.00, 1.53, 0.00, 0.00, 10.00, 10, 1, NULL, NULL),
(16, 11, 9, 2.00, 'NIU', 15.00, 4.58, 0.00, 0.00, 30.00, 10, 1, NULL, NULL),
(17, 11, 6, 1.00, 'NIU', 6.00, 0.92, 0.00, 0.00, 6.00, 10, 1, NULL, NULL),
(18, 12, 8, 1.00, 'NIU', 10.00, 1.53, 0.00, 0.00, 10.00, 10, 1, NULL, NULL),
(19, 12, 9, 1.00, 'NIU', 15.00, 2.29, 0.00, 0.00, 15.00, 10, 1, NULL, NULL),
(20, 13, 8, 1.00, 'NIU', 10.00, 1.53, 0.00, 0.00, 10.00, 10, 1, NULL, NULL),
(21, 13, 9, 2.00, 'NIU', 15.00, 4.58, 0.00, 0.00, 30.00, 10, 1, NULL, NULL),
(22, 14, 9, 1.00, 'NIU', 15.00, 2.29, 0.00, 0.00, 15.00, 10, 1, NULL, NULL),
(23, 15, 9, 1.00, 'NIU', 15.00, 2.29, 0.00, 0.00, 15.00, 10, 1, NULL, NULL),
(24, 16, 9, 2.00, 'NIU', 15.00, 4.58, 0.00, 0.00, 30.00, 10, 1, NULL, NULL),
(25, 18, 10, 1.00, 'NIU', 4.00, 0.61, 0.00, 0.00, 4.00, 10, 2, 1, 2147483647),
(26, 18, 12, 1.00, 'NIU', 10.00, 1.53, 0.00, 0.00, 10.00, 10, 2, 1, 2147483647),
(27, 18, 13, 1.00, 'NIU', 20.00, 3.05, 0.00, 0.00, 20.00, 10, 2, 1, 2147483647),
(28, 19, 10, 4.00, 'NIU', 4.00, 2.44, 0.00, 0.00, 16.00, 10, 2, 1, 2147483647),
(29, 19, 12, 5.00, 'NIU', 10.00, 7.63, 0.00, 0.00, 50.00, 10, 2, 1, 2147483647),
(30, 19, 13, 2.00, 'NIU', 20.00, 6.10, 0.00, 0.00, 40.00, 10, 2, 1, 2147483647),
(31, 20, 9, 1.00, 'NIU', 15.00, 2.29, 0.00, 0.00, 15.00, 10, 1, 1, 2147483647),
(32, 19, 10, 4.00, 'NIU', 4.00, 2.44, 0.00, 0.00, 16.00, 10, 2, 1, 2147483647),
(33, 19, 12, 5.00, 'NIU', 10.00, 7.63, 0.00, 0.00, 50.00, 10, 2, 1, 2147483647),
(34, 19, 13, 2.00, 'NIU', 20.00, 6.10, 0.00, 0.00, 40.00, 10, 2, 1, 2147483647),
(35, 19, 10, 4.00, 'NIU', 4.00, 2.44, 0.00, 0.00, 16.00, 10, 2, 1, 2147483647),
(36, 19, 12, 5.00, 'NIU', 10.00, 7.63, 0.00, 0.00, 50.00, 10, 2, 1, 2147483647),
(37, 19, 13, 2.00, 'NIU', 20.00, 6.10, 0.00, 0.00, 40.00, 10, 2, 1, 2147483647),
(38, 19, 10, 4.00, 'NIU', 4.00, 2.44, 0.00, 0.00, 16.00, 10, 2, 1, 2147483647),
(39, 19, 12, 5.00, 'NIU', 10.00, 7.63, 0.00, 0.00, 50.00, 10, 2, 1, 2147483647),
(40, 19, 13, 2.00, 'NIU', 20.00, 6.10, 0.00, 0.00, 40.00, 10, 2, 1, 2147483647),
(41, 19, 10, 4.00, 'NIU', 4.00, 2.44, 0.00, 0.00, 16.00, 10, 1, 1, 2147483647),
(42, 19, 12, 5.00, 'NIU', 10.00, 7.63, 0.00, 0.00, 50.00, 10, 1, 1, 2147483647),
(43, 19, 13, 2.00, 'NIU', 20.00, 6.10, 0.00, 0.00, 40.00, 10, 1, 1, 2147483647),
(44, 21, 12, 1.00, 'NIU', 10.00, 1.53, 0.00, 0.00, 10.00, 10, 1, 1, 2147483647),
(45, 21, 8, 1.00, 'NIU', 10.00, 1.53, 0.00, 0.00, 10.00, 10, 1, 1, 2147483647),
(46, 21, 9, 1.00, 'NIU', 15.00, 2.29, 0.00, 0.00, 15.00, 10, 1, 1, 2147483647),
(47, 22, 8, 1.00, 'NIU', 10.00, 1.53, 0.00, 0.00, 10.00, 10, 1, 1, 2147483647),
(48, 22, 13, 1.00, 'NIU', 20.00, 3.05, 0.00, 0.00, 20.00, 10, 1, 1, 2147483647),
(49, 23, 10, 4.00, 'NIU', 4.00, 2.44, 0.00, 0.00, 16.00, 10, 1, 1, 2147483647),
(50, 24, 7, 2.00, 'NIU', 5.00, 1.53, 0.00, 0.00, 10.00, 10, 1, 1, 2147483647),
(51, 25, 7, 1.00, 'NIU', 5.00, 0.76, 0.00, 0.00, 5.00, 10, 1, 1, 2147483647),
(52, 25, 13, 1.00, 'NIU', 20.00, 3.05, 0.00, 0.00, 20.00, 10, 1, 1, 2147483647),
(53, 25, 9, 1.00, 'NIU', 15.00, 2.29, 0.00, 0.00, 15.00, 10, 1, 1, 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleasistencia`
--

CREATE TABLE `detalleasistencia` (
  `iddetalle` int(11) NOT NULL,
  `idasistencia` int(11) NOT NULL,
  `idpersonal` int(11) NOT NULL,
  `pcserie` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `iddocente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idtipodocumento` int(11) NOT NULL,
  `nrodocumento` varchar(20) NOT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`iddocente`, `nombre`, `idtipodocumento`, `nrodocumento`, `celular`, `email`, `estado`) VALUES
(1, 'QUIÑONES HUATANGARI LENIN', 2, '00001573', '', '', 1),
(2, 'NÚÑEZ PINTADO LENIN FRANCHESCOLETH', 2, '00002987', '', '', 1),
(3, 'LLAUCE SANTAMARIA ROSARIO', 2, '00003704', '', '', 1),
(4, 'MONTENEGRO JUAREZ JANNIER', 2, '00003733', '', '', 1),
(5, 'GARCÍA CAMPOS DEIBI ERIC', 2, '00003722', '', '', 1),
(6, 'FUENTES MAZA FRANS', 2, '00003449', '', '', 1),
(7, 'PEREZ SILVA MARCO LUIS', 2, '00010566', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idequipo` int(11) NOT NULL,
  `nro` varchar(45) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `serie` varchar(45) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idequipo`, `nro`, `marca`, `modelo`, `serie`, `estado`) VALUES
(1, '01', 'DELL', 'OPTIPLEX 3080', '4DV0XM3', 1),
(2, '02', 'DELL', 'OPTIPLEX 3080', '5121XM3', 1),
(3, '03', 'DELL', 'OPTIPLEX 3080', 'F021XM3', 1),
(4, '04', 'DELL', 'OPTIPLEX 3080', 'J021XM3', 1),
(5, '05', 'DELL', 'OPTIPLEX 3080', 'B551XM3', 1),
(6, '06', 'DELL', 'OPTIPLEX 3080', '95R0XM3', 1),
(7, '07', 'DELL', 'OPTIPLEX 3080', '26R0XM3', 1),
(8, '08', 'DELL', 'OPTIPLEX 3080', 'JCV0XM3', 1),
(9, '09', 'DELL', 'OPTIPLEX 3080', '74R0XM3', 1),
(10, '10', 'DELL', 'OPTIPLEX 3080', '2651XM3', 1),
(11, '11', 'DELL', 'OPTIPLEX 3080', '5651XM3', 1),
(12, '12', 'DELL', 'OPTIPLEX 3080', '8121XM3', 1),
(13, '13', 'DELL', 'OPTIPLEX 3080', '35R0XM3', 1),
(14, '14', 'DELL', 'OPTIPLEX 3080', 'B221XM3', 1),
(15, '15', 'DELL', 'OPTIPLEX 3080', '8221XM3', 1),
(16, '16', 'DELL', 'OPTIPLEX 3080', 'C9V0XM3', 1),
(17, '17', 'DELL', 'OPTIPLEX 3080', '1FV0XM3', 1),
(18, '18', 'DELL', 'OPTIPLEX 3080', '7021XM3', 1),
(19, '19', 'DELL', 'OPTIPLEX 3080', '57R0XM3', 1),
(20, '20', 'DELL', 'OPTIPLEX 3080', 'H121XM3', 1),
(21, '21', 'DELL', 'OPTIPLEX 3080', '29V0XM3', 1),
(22, '22', 'DELL', 'OPTIPLEX 3080', '3FV0XM3', 1),
(23, 'PRINCIPAL', 'DELL', 'OPTIPLEX 3080', 'H9V0XM3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `idmoneda` char(3) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`idmoneda`, `nombre`, `estado`) VALUES
('PEN', 'SOLES', 1),
('USD', 'DOLARES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcion`
--

CREATE TABLE `opcion` (
  `idopcion` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `icono` varchar(20) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `opcion`
--

INSERT INTO `opcion` (`idopcion`, `descripcion`, `icono`, `url`, `orden`, `estado`) VALUES
(1, 'Personal', 'fa-users', 'vista/personal.php', 1, 1),
(2, 'Asistencia', 'fa-list', 'vista/asistencias.php', 3, 1),
(3, 'Perfiles', 'fa-user-lock', 'vista/perfiles.php', 4, 1),
(4, 'Usuarios', 'fa-user-circle', 'vista/usuarios.php', 5, 1),
(5, 'Docente', 'fa-users', 'vista/docentes.php', 6, 1),
(6, 'Ventas', 'fa-cart-plus', 'vista/ventas.php', 7, 1),
(7, 'Cliente', 'fa-boxes', 'vista/clientes.php', 8, 1),
(8, 'Reportes', 'fa-chart-bar', 'vista/reportes.php', 9, 1),
(9, 'Equipo', 'fa-list', 'vista/equipos.php', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idperfil` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL COMMENT '0 -> INACTIVO \n1 -> ACTIVO\n2 -> ELIMINADO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idperfil`, `nombre`, `estado`) VALUES
(1, 'ADMINISTRADOR', 1),
(2, 'VENDEDOR', 1),
(3, 'CAJERO', 1),
(4, 'ALMACENERO', 0),
(5, 'PRUEBA', 2),
(6, 'PERFIL PRUEBA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `idpersonal` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idtipodocumento` int(11) NOT NULL,
  `nrodocumento` varchar(20) NOT NULL,
  `tipopersonal` varchar(50) NOT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`idpersonal`, `nombre`, `idtipodocumento`, `nrodocumento`, `tipopersonal`, `celular`, `email`, `estado`) VALUES
(1, 'AGUIRRE PEÑA JOHRDAN HELI', 2, '2021110041', 'ESTUDIANTE', '', '', 1),
(2, 'ARAUJO LOLI ROBINSON EDWIN', 2, '2021230023', 'ESTUDIANTE', '', '', 1),
(3, 'BOCANEGRA GARCIA ERIC BRAYAN', 2, '2021210049', 'ESTUDIANTE', '', '', 1),
(4, 'CABRERA QUISPE ALEX', 2, '2021210058', 'ESTUDIANTE', '', '', 1),
(5, 'CAJUSOL RUIZ CARLOS MANUEL', 2, '2019121292', 'ESTUDIANTE', '', '', 1),
(6, 'CAMPOS GUERRERO LUIS FERNANDO', 2, '2019210135', 'ESTUDIANTE', '', '', 1),
(7, 'CARLOS CAJO IVAN', 2, '2021210052', 'ESTUDIANTE', '', '', 1),
(8, 'CARRANZA VILLANUEVA JOSE LUIS', 2, '2018110038', 'ESTUDIANTE', '', '', 1),
(9, 'CHILCON ALDANA BRANDON', 2, '2021230018', 'ESTUDIANTE', '', '', 1),
(10, 'COTRINA DÍAZ PERCY JHULINIO', 2, '2021230022', 'ESTUDIANTE', '', '', 1),
(11, 'DAVILA FERNANDEZ JHORDIN ALDAIR', 2, '2020210105', 'ESTUDIANTE', '', '', 1),
(12, 'DELGADO TORRES JOSE ALFONSO', 2, '2018230686', 'ESTUDIANTE', '', '', 1),
(13, 'DUEÑAS PÉREZ KARINA DEL PILAR', 2, '2021210057', 'ESTUDIANTE', '', '', 1),
(14, 'ESTELA ROJAS DILBER HARWIN', 2, '2021110106', 'ESTUDIANTE', '', '', 1),
(15, 'FERNANDEZ BERMEO JHONATAN', 2, '2021110028', 'ESTUDIANTE', '', '', 1),
(16, 'FERNANDEZ PEREZ VANY YOEL', 2, '2018210056', 'ESTUDIANTE', '', '', 1),
(17, 'GARCIA RAMOS FERNANDO JAVIER', 2, '2021110229', 'ESTUDIANTE', '', '', 1),
(18, 'GARCIA SALVADOR MARLOM', 2, '2021110039', 'ESTUDIANTE', '', '', 1),
(19, 'HERRERA RUFASTO HAXEL REY', 2, '2021230017', 'ESTUDIANTE', '', '', 1),
(20, 'HUAMÁN VILLALOBOS ANGEL JHAIR', 2, '2020210023', 'ESTUDIANTE', '', '', 1),
(21, 'IZQUIERDO TARRILLO ANGEL FABRIZIO', 2, '2021210047', 'ESTUDIANTE', '', '', 1),
(22, 'JULCA CARRASCO EMANUEL', 2, '2020210036', 'ESTUDIANTE', '', '', 1),
(23, 'LLUNCOR RIVERA DIEGO BRYAN', 2, '2016211165', 'ESTUDIANTE', '', '', 1),
(24, 'LOPEZ HERRERA ANAEL', 2, '2021210060', 'ESTUDIANTE', '', '', 1),
(25, 'MANCHAY CASTILLO YESTON YEMERSON', 2, '2021110037', 'ESTUDIANTE', '', '', 1),
(26, 'MAÑAK IRENE YENER CRISTOBAL', 2, '2016221146', 'ESTUDIANTE', '', '', 1),
(27, 'OBLITAS GALLARDO CHARLES FRANKLIN', 2, '2021130019', 'ESTUDIANTE', '', '', 1),
(28, 'OCAÑA ROMAN MARCO ANTONIO', 2, '2021210061', 'ESTUDIANTE', '', '', 1),
(29, 'OLIVERA OBLITAS YONN FRANCIS', 2, '2021110029', 'ESTUDIANTE', '', '', 1),
(30, 'PACHECO CIEZA PIERO ANDERSON', 2, '2021210042', 'ESTUDIANTE', '', '', 1),
(31, 'PASAPERA SALVADOR ALBERTH JOSEPH', 2, '2020210139', 'ESTUDIANTE', '', '', 1),
(32, 'PEREZ GUELAC JHOEL', 2, '2021110225', 'ESTUDIANTE', '', '', 1),
(33, 'RAMIREZ GARCIA RICHARD MAXIMILIANO', 2, '2020210035', 'ESTUDIANTE', '', '', 1),
(34, 'RAMIREZ PÉREZ NILTON DANIEL', 2, '2020110145', 'ESTUDIANTE', '', '', 1),
(35, 'RODRIGUEZ LALANGUI CLEYBER STALIN', 2, '2021130022', 'ESTUDIANTE', '', '', 1),
(36, 'SEMBRERA CASTILLO JIMMY ORLANDO', 2, '2021210059', 'ESTUDIANTE', '', '', 1),
(37, 'TAPIA MEDINA MARCOS GUILLEN', 2, '2018210681', 'ESTUDIANTE', '', '', 1),
(38, 'VASQUEZ OBLITAS JORGE LUIS', 2, '2020210062', 'ESTUDIANTE', '', '', 1),
(39, 'VILLANUEVA VILCARROMERO ALEX JHAIR', 2, '2021110030', 'ESTUDIANTE', '', '', 1),
(40, 'YLANZO TELLO ANGELICA MERCEDES', 2, '2021230021', 'ESTUDIANTE', '', '', 1),
(41, 'ALBERCA GARCÍA JULINHO', 2, '2020110060', 'ESTUDIANTE', '', '', 1),
(42, 'ALDANA QUILLA YAJAIRA LUCERO', 2, '2020110075', 'ESTUDIANTE', '', '', 1),
(43, 'ALEJANDRIA VENEL RONNY LEODAN', 2, '2020110106', 'ESTUDIANTE', '', '', 1),
(44, 'ALVERCA ORREGO JHORDY PAUL', 2, '2014210683', 'ESTUDIANTE', '', '', 1),
(45, 'BERMEO ZURITA JHANNER JOEL', 2, '2019111326', 'ESTUDIANTE', '', '', 1),
(46, 'BRAVO QUISPE EDINSON RAUL', 2, '2020110027', 'ESTUDIANTE', '', '', 1),
(47, 'BUSTAMANTE HERRERA CRISTHIAN', 2, '2019210145', 'ESTUDIANTE', '', '', 1),
(48, 'CAMPOS DELGADO ERIKSSON SMITH', 2, '2018230069', 'ESTUDIANTE', '', '', 1),
(49, 'CUBAS QUEVEDO SALOMÓN', 2, '2014230659', 'ESTUDIANTE', '', '', 1),
(50, 'CULQUIPOMA SANTA CRUZ DIOMER', 2, '2019210064', 'ESTUDIANTE', '', '', 1),
(51, 'DIAZ REYES ANTHONY ISMAEL', 2, '2016111098', 'ESTUDIANTE', '', '', 1),
(52, 'ESPINOZA DELGADO YEYNERTH ANTHONY', 2, '2013210653', 'ESTUDIANTE', '', '', 1),
(53, 'GUEVARA REQUEJO LUIS FERNANDO', 2, '2020110171', 'ESTUDIANTE', '', '', 1),
(54, 'IDROGO JULÓN NEYSER NOÉ', 2, '2021120018', 'ESTUDIANTE', '', '', 1),
(55, 'MAÑAK IRENE YAUN NAYCER', 2, '2013220660', 'ESTUDIANTE', '', '', 1),
(56, 'MENDOZA MONTENEGRO LINDBERGH', 2, '2020110022', 'ESTUDIANTE', '', '', 1),
(57, 'MIRES GONZALES JOSE WILBERT', 2, '2017110304', 'ESTUDIANTE', '', '', 1),
(58, 'PELAEZ VIGO EMERSON JHOSE', 2, '2020110115', 'ESTUDIANTE', '', '', 1),
(59, 'PEREZ SALAZAR JOSMER', 2, '2018210696', 'ESTUDIANTE', '', '', 1),
(60, 'RAMOS GUTIERREZ JOSE OMAR', 2, '2019111340', 'ESTUDIANTE', '', '', 1),
(61, 'RINZA YAJAHUANCA KELVIN ALEXANDER', 2, '2020110061', 'ESTUDIANTE', '', '', 1),
(62, 'SÁNCHEZ OCAÑA EDINSON ESTAY', 2, '2019210127', 'ESTUDIANTE', '', '', 1),
(63, 'VÁSQUEZ FERNÁNDEZ ISAC ALDAIR', 2, '2020110168', 'ESTUDIANTE', '', '', 1),
(64, 'VILLALOBOS ROMERO FRAY LUIS', 2, '2018110024', 'ESTUDIANTE', '', '', 1),
(65, 'VILLALOBOS VASQUEZ JHERALD JHIMMY', 2, '2019111339', 'ESTUDIANTE', '', '', 1),
(66, 'YAHUARA CUBAS RICHAR GEYSER', 2, '2019210110', 'ESTUDIANTE', '', '', 1),
(67, 'ZAPATA DÍAZ JOSÉ FERNANDO', 2, '2020130003', 'ESTUDIANTE', '', '', 1),
(68, 'ALBERCA CIEZA JOSELITO', 2, '2019131383', 'ESTUDIANTE', '', '', 1),
(69, 'ALTAMIRANO RAMON CARLOS DANIEL', 2, '2019210088', 'ESTUDIANTE', '', '', 1),
(70, 'ASENCIO TIQUILLAHUANCA NIXON', 2, '2019131463', 'ESTUDIANTE', '', '', 1),
(71, 'BERNA CALVAY ALEX JHUÑOR', 2, '2019210138', 'ESTUDIANTE', '', '', 1),
(72, 'CABRERA SILVA JERICK', 2, '2019210163', 'ESTUDIANTE', '', '', 1),
(73, 'CASTILLO JIMÉNEZ FRANKLIN JEFFERSON', 2, '2019230021', 'ESTUDIANTE', '', '', 1),
(74, 'CONCHA SANTOS CARLOS ENRIQUE', 2, '2019210199', 'ESTUDIANTE', '', '', 1),
(75, 'CORDOVA SUAREZ YONATAN', 2, '2019210085', 'ESTUDIANTE', '', '', 1),
(76, 'CORONADO CIEZA ANDERSON MIGUEL', 2, '2019230013', 'ESTUDIANTE', '', '', 1),
(77, 'DÁVILA FERNÁNDEZ NILSON RONNY', 2, '2019210157', 'ESTUDIANTE', '', '', 1),
(78, 'DÍAZ QUINTOS JHON ANDERSON', 2, '2019111451', 'ESTUDIANTE', '', '', 1),
(79, 'DIAZ RUIZ MARIA ESTHER DEL CARMEN', 2, '2019230012', 'ESTUDIANTE', '', '', 1),
(80, 'FLORES BECERRA ANGEL ANDRÉS', 2, '2019210148', 'ESTUDIANTE', '', '', 1),
(81, 'GUEVARA ARRIETA JORDAN CRISTOPHER', 2, '2016111161', 'ESTUDIANTE', '', '', 1),
(82, 'LABAN CHUQUIPOMA JUAN EDUARDO', 2, '2016111135', 'ESTUDIANTE', '', '', 1),
(83, 'LOZADA CRUZADO JOSE DENILSON', 2, '2019111418', 'ESTUDIANTE', '', '', 1),
(84, 'MARTINEZ HUACHES JHAN MARCOS', 2, '2018210081', 'ESTUDIANTE', '', '', 1),
(85, 'MATTA DIAZ MARTIN MIGUEL', 2, '2019111455', 'ESTUDIANTE', '', '', 1),
(86, 'MONTENEGRO PAICO RONALDINHO', 2, '2019210178', 'ESTUDIANTE', '', '', 1),
(87, 'OLIVERA SALAZAR RENZO', 2, '2018230688', 'ESTUDIANTE', '', '', 1),
(88, 'OLIVOS REQUEJO YOLMER', 2, '2019111335', 'ESTUDIANTE', '', '', 1),
(89, 'RUIZ RAMIREZ CHRISTIAN ADRIAN', 2, '2019111465', 'ESTUDIANTE', '', '', 1),
(90, 'TIRADO URTEAGA JESUS EDWIN', 2, '2019111336', 'ESTUDIANTE', '', '', 1),
(91, 'CIEZA SEGURA JOSE YERSSON', 2, '2021210053', 'ESTUDIANTE', '', '', 1),
(92, 'CORCUERA CÓRDOVA JACK ANDERSON', 2, '2022110084', 'ESTUDIANTE', '', '', 1),
(93, 'DIAZ RODRIGUEZ JHON ROYSER', 2, '2022120022', 'ESTUDIANTE', '', '', 1),
(94, 'GAPURA ALARCON CARLOS ANTONIO', 2, '2022230018', 'ESTUDIANTE', '', '', 1),
(95, 'HUAMAN TISNADO BRAYAN RAFAEL', 2, '2022210060', 'ESTUDIANTE', '', '', 1),
(96, 'HURTADO GUERRERO RONAL', 2, '2022110087', 'ESTUDIANTE', '', '', 1),
(97, 'INGA ALEJANDRÍA RENATO JAVIER', 2, '2022210109', 'ESTUDIANTE', '', '', 1),
(98, 'MERA PEREZ JARLIN BRAYAN', 2, '2022210058', 'ESTUDIANTE', '', '', 1),
(99, 'NEYRA ALVAREZ MAY TAYZON', 2, '2022110021', 'ESTUDIANTE', '', '', 1),
(100, 'OLANO RUBIO EDINSON', 2, '2022210106', 'ESTUDIANTE', '', '', 1),
(101, 'OLIVERA CRUZADO MILTON JOEL', 2, '2018210152', 'ESTUDIANTE', '', '', 1),
(102, 'PAREDES GUERRERO FRANK EMERSON', 2, '2022220008', 'ESTUDIANTE', '', '', 1),
(103, 'PELTROCHE ROMERO ANDERSON JHOSEP', 2, '2022110017', 'ESTUDIANTE', '', '', 1),
(104, 'QUISPE GUEVARA JHORDAN BRAYAN', 2, '2021110231', 'ESTUDIANTE', '', '', 1),
(105, 'REQUEJO DELGADO JOSÉ PAÚL', 2, '2022110127', 'ESTUDIANTE', '', '', 1),
(106, 'RUEDA CHUGDEN DIÑO JHIMER', 2, '2021130021', 'ESTUDIANTE', '', '', 1),
(107, 'RUEDA CHUGDEN JHONATAN', 2, '2021130020', 'ESTUDIANTE', '', '', 1),
(108, 'SILVA RODRIGUEZ YORDY JHULINIO', 2, '2022210107', 'ESTUDIANTE', '', '', 1),
(109, 'SILVA ROMERO JHON ANTHONI', 2, '2022210059', 'ESTUDIANTE', '', '', 1),
(110, 'SOTO DÍAZ HANSEN JHOSSEP', 2, '2022210018', 'ESTUDIANTE', '', '', 1),
(111, 'UMBO FERNANDEZ DAVID', 2, '2021110238', 'ESTUDIANTE', '', '', 1),
(112, 'VARGAS NAVARRO ANTHONY ALEXIS', 2, '2022230024', 'ESTUDIANTE', '', '', 1),
(113, 'VASQUEZ GUEVARA AILTON DEL PIERO', 2, '2022210053', 'ESTUDIANTE', '', '', 1),
(114, 'DE LA CRUZ DELGADO ADRIAN EMERSON', 2, '2019131299', 'ESTUDIANTE', '', '', 1),
(115, 'DIAZ LLAMO JESUS ALEXANDER', 2, '2019111389', 'ESTUDIANTE', '', '', 1),
(116, 'FARCEQUE FARCEQUE LEIZER', 2, '2018210018', 'ESTUDIANTE', '', '', 1),
(117, 'GARCIA ZURITA RUDY CHARLES', 2, '2019111484', 'ESTUDIANTE', '', '', 1),
(118, 'GIL TAPIA FRANK ROOSVELT', 2, '2019121324', 'ESTUDIANTE', '', '', 1),
(119, 'GUEVARA SANCHEZ CARLOS ENRIQUE', 2, '2019121432', 'ESTUDIANTE', '', '', 1),
(120, 'HERRERA PEREZ ALDO STALYN', 2, '2015110066', 'ESTUDIANTE', '', '', 1),
(121, 'HUAYAMA MONTOYA ERICK YAIR', 2, '2018210135', 'ESTUDIANTE', '', '', 1),
(122, 'JIMENEZ LOPEZ BAIRON ELEAN', 2, '2019111347', 'ESTUDIANTE', '', '', 1),
(123, 'MENDOZA BECERRA EDGAR RENATO', 2, '2019111472', 'ESTUDIANTE', '', '', 1),
(124, 'MENDOZA REYES JHEFERSON', 2, '2019111424', 'ESTUDIANTE', '', '', 1),
(125, 'MERA HERRERA HOWARD WILL', 2, '2019131302', 'ESTUDIANTE', '', '', 1),
(126, 'OBLITAS LARREATIGUE DANTE YHOEL', 2, '2017210045', 'ESTUDIANTE', '', '', 1),
(127, 'OLIVA ALEJANDRIA JEAN JORLY', 2, '2019220017', 'ESTUDIANTE', '', '', 1),
(128, 'PEÑA MEJIA WILTONG NOE', 2, '2017210063', 'ESTUDIANTE', '', '', 1),
(129, 'PEREZ GUEVARA MIGUEL EDUARDO', 2, '2018111109', 'ESTUDIANTE', '', '', 1),
(130, 'SANDOVAL DE LA CRUZ JOSE WILLY', 2, '2019111390', 'ESTUDIANTE', '', '', 1),
(131, 'SANTA CRUZ ROMERO JHON EULER', 2, '2018210023', 'ESTUDIANTE', '', '', 1),
(132, 'SEMPERTEGUI SANTOS GHINO ALESSANDRO', 2, '2019111471', 'ESTUDIANTE', '', '', 1),
(133, 'SIMON DANDUCHO GERZON ANTHONY', 2, '2018120035', 'ESTUDIANTE', '', '', 1),
(134, 'SOZA ALBERCA REYNER', 2, '2016111093', 'ESTUDIANTE', '', '', 1),
(135, 'TINEO MEDINA DEYWIN JHONY', 2, '2019131331', 'ESTUDIANTE', '', '', 1),
(136, 'TORO CRUZ BAGNER OMAR', 2, '2017110350', 'ESTUDIANTE', '', '', 1),
(137, 'ACOSTA JIMENEZ DANTE SMITH', 2, '2022210057', 'ESTUDIANTE', '', '', 1),
(138, 'ALVAREZ BECERRA JHORDAN SMITH', 2, '2022230019', 'ESTUDIANTE', '', '', 1),
(139, 'CIEZA DELGADO JHON CARLOS', 2, '2022210019', 'ESTUDIANTE', '', '', 1),
(140, 'ESTELA DELGADO RONY WILSON', 2, '2017230076', 'ESTUDIANTE', '', '', 1),
(141, 'ESTELA LLATAS JESUS MANUEL', 2, '2022210017', 'ESTUDIANTE', '', '', 1),
(142, 'FARCEQUE BERMEO FREDY FERNANDEZ', 2, '2022230022', 'ESTUDIANTE', '', '', 1),
(143, 'FERNÁNDEZ VÁSQUEZ LUIZ ANGEL', 2, '2022210054', 'ESTUDIANTE', '', '', 1),
(144, 'GUERRERO HUAYAMA FRANK STEVIN', 2, '2022110086', 'ESTUDIANTE', '', '', 1),
(145, 'HUAMAN CUEVA ISAIAS', 2, '2021110223', 'ESTUDIANTE', '', '', 1),
(146, 'JIMÉNEZ BARRERA CARLOS FABIAN', 2, '2022230020', 'ESTUDIANTE', '', '', 1),
(147, 'MONTEZA FERNANDEZ MANUEL', 2, '2022220010', 'ESTUDIANTE', '', '', 1),
(148, 'MONTEZA VASQUEZ YEISON', 2, '2022210108', 'ESTUDIANTE', '', '', 1),
(149, 'MUÑOZ MUÑOZ JOSÉ ALBERTO', 2, '2022210111', 'ESTUDIANTE', '', '', 1),
(150, 'QUINDE CHOCÁN AMILKAR NELSON', 2, '2022210113', 'ESTUDIANTE', '', '', 1),
(151, 'RAMIREZ CRUZ WILBERT ROBERT', 2, '2022210110', 'ESTUDIANTE', '', '', 1),
(152, 'RAMON TINEO RUBEN JAMIR', 2, '2019210133', 'ESTUDIANTE', '', '', 1),
(153, 'RAMOS VASQUEZ WINSTON BLADIMIR', 2, '2022210112', 'ESTUDIANTE', '', '', 1),
(154, 'RIMARACHIN RUIZ OSCAR ALEXIS', 2, '2022210062', 'ESTUDIANTE', '', '', 1),
(155, 'RIVERA ACUÑA LUIS HIERRY', 2, '2022210105', 'ESTUDIANTE', '', '', 1),
(156, 'RODRIGO CAMPOS KEVIN YOEL', 2, '2022230021', 'ESTUDIANTE', '', '', 1),
(157, 'SÁNCHEZ LEYVA DILBER', 2, '2022210104', 'ESTUDIANTE', '', '', 1),
(158, 'ZAMORA PÉREZ YHEISON ARTURO', 2, '2022210064', 'ESTUDIANTE', '', '', 1),
(159, 'ACHA HUAMÁN LUIS MAICOL', 2, '2023110011', 'ESTUDIANTE', '', '', 1),
(160, 'ACUÑA DÍAZ YOSEPH JHONEL', 2, '2023130023', 'ESTUDIANTE', '', '', 1),
(161, 'AGUILAR DELGADO HÉCTOR', 2, '2023110083', 'ESTUDIANTE', '', '', 1),
(162, 'BARCO GRANDA CIRO EDU', 2, '2023110014', 'ESTUDIANTE', '', '', 1),
(163, 'BECERRA TESÉN NILSON JUNIOR', 2, '2023130017', 'ESTUDIANTE', '', '', 1),
(164, 'CAJO PARIACURI ISEÑO DILTHER', 2, '2023110072', 'ESTUDIANTE', '', '', 1),
(165, 'CASTILLO CARRILLO MILLER DANIEL', 2, '2023130021', 'ESTUDIANTE', '', '', 1),
(166, 'CHÁVEZ MALQUI JHÁLIMBER MAYCOL', 2, '2023110085', 'ESTUDIANTE', '', '', 1),
(167, 'CHOQUECOTA GARCIA DIEGO ANTONIO', 2, '2023110015', 'ESTUDIANTE', '', '', 1),
(168, 'CHUMACERO JAIMES ESTEINER', 2, '2023110077', 'ESTUDIANTE', '', '', 1),
(169, 'CIEZA OLIVERA YAN CARLOS', 2, '2022110092', 'ESTUDIANTE', '', '', 1),
(170, 'CÓRDOVA MONTALVÁN ALEXIS', 2, '2020110193', 'ESTUDIANTE', '', '', 1),
(171, 'COTRINA MONSALVE EVER JULIO', 2, '2023110078', 'ESTUDIANTE', '', '', 1),
(172, 'CUBAS CORONEL JHAYR ANDRE', 2, '2023130019', 'ESTUDIANTE', '', '', 1),
(173, 'DE LA CRUZ RODRIGUEZ EDER BRAYAN', 2, '2023110086', 'ESTUDIANTE', '', '', 1),
(174, 'DÍAZ SAUCEDO JHON ANTONY', 2, '2023110082', 'ESTUDIANTE', '', '', 1),
(175, 'GUEVARA GARCÍA EYNER YONER', 2, '2023110073', 'ESTUDIANTE', '', '', 1),
(176, 'HUAMÁN CALDERÓN ALEXIS JAIR', 2, '2023120024', 'ESTUDIANTE', '', '', 1),
(177, 'LOZADA DAVILA WAGNER SMITH', 2, '2023110081', 'ESTUDIANTE', '', '', 1),
(178, 'MANCHAY CRUZ RONALDINIO AIMAR', 2, '2023110079', 'ESTUDIANTE', '', '', 1),
(179, 'NEIRA LOYAGA NATHALY PAOLA', 2, '2023110013', 'ESTUDIANTE', '', '', 1),
(180, 'NEYRA MENDOZA ELVIS ALBERTO', 2, '2023110069', 'ESTUDIANTE', '', '', 1),
(181, 'NÚÑEZ CARDENAS ELVIS GIAN PIER', 2, '2023120026', 'ESTUDIANTE', '', '', 1),
(182, 'NUÑEZ MUÑOZ ALESSANDRO JOEL', 2, '2023110076', 'ESTUDIANTE', '', '', 1),
(183, 'PEÑA MEJÍA SIÁLER DEIVIN', 2, '2023110012', 'ESTUDIANTE', '', '', 1),
(184, 'QUÍROZ RAMÍREZ JORGE SERGIO', 2, '2023110084', 'ESTUDIANTE', '', '', 1),
(185, 'RIMAPA FLORES FREDIL', 2, '2023130020', 'ESTUDIANTE', '', '', 1),
(186, 'RIOS CALLE EDINSON', 2, '2022210056', 'ESTUDIANTE', '', '', 1),
(187, 'RIVASPLATA RIMARACHE JAIME ENRIQUE', 2, '2023130018', 'ESTUDIANTE', '', '', 1),
(188, 'RODRIGUEZ NEYRA KLEIVER PASTOR', 2, '2023130022', 'ESTUDIANTE', '', '', 1),
(189, 'RODRIGUEZ PEÑA ALEX BRAYAN', 2, '2023110075', 'ESTUDIANTE', '', '', 1),
(190, 'SALAS CAMPOS JOSE RICHARD', 2, '2019111380', 'ESTUDIANTE', '', '', 1),
(191, 'SANDOVAL COLLAZOS TINO ALEJANDRO', 2, '2023110070', 'ESTUDIANTE', '', '', 1),
(192, 'SANDOVAL MORI ROYSER', 2, '2023120023', 'ESTUDIANTE', '', '', 1),
(193, 'SANTOS NOLASCO FRANKLIN', 2, '2023110074', 'ESTUDIANTE', '', '', 1),
(194, 'SOBRADO MARTIN JORGE LUIS FERNANDO', 2, '2023110068', 'ESTUDIANTE', '', '', 1),
(195, 'TARRILLO MARRUFO JOB RAÚL', 2, '2023120025', 'ESTUDIANTE', '', '', 1),
(196, 'TORRES ENEQUE JESÚS ENRRIQUE', 2, '2023110071', 'ESTUDIANTE', '', '', 1),
(197, 'VÁSQUEZ CARRANZA JHEISON STIVEN', 2, '2023110121', 'ESTUDIANTE', '', '', 1),
(198, 'VILLA CASTILLO NEYSER IVAN', 2, '2023130024', 'ESTUDIANTE', '', '', 1),
(199, 'ZEÑA DÁVALOS JOHNNY ANGELLO', 2, '2023110080', 'ESTUDIANTE', '', '', 1),
(200, 'CATON TANTALEÁN LEHI JOHN', 2, '2022120016', 'ESTUDIANTE', '', '', 1),
(201, 'CHUQUICAHUA ALVARADO ALEX', 2, '2017110312', 'ESTUDIANTE', '', '', 1),
(202, 'GARCIA DELGADO JHAYR ALLYSSON', 2, '2022130015', 'ESTUDIANTE', '', '', 1),
(203, 'GONZALES GUTIERREZ GIANELLA GIMENA', 2, '2021110241', 'ESTUDIANTE', '', '', 1),
(204, 'MUÑOZ LOZADA LUIS STALIN', 2, '2022110013', 'ESTUDIANTE', '', '', 1),
(205, 'NUÑEZ ALBERCA ALEJANDRO', 2, '2022110088', 'ESTUDIANTE', '', '', 1),
(206, 'SIESQUEN CASTILLO JHANCARLOS', 2, '2021110107', 'ESTUDIANTE', '', '', 1),
(207, 'ADRIANZEN RUIZ CARLOS ALBERTO', 2, '2021210062', 'ESTUDIANTE', '', '', 1),
(208, 'CRUZ RAMIREZ JESÚS ADRIAN', 2, '2020210055', 'ESTUDIANTE', '', '', 1),
(209, 'CUBAS FERNANDEZ DEYMER', 2, '2021210045', 'ESTUDIANTE', '', '', 1),
(210, 'DÍAZ DÍAZ NIMPER HANANI', 2, '2021210051', 'ESTUDIANTE', '', '', 1),
(211, 'GARCIA MARTINEZ GIAN PIER', 2, '2021130018', 'ESTUDIANTE', '', '', 1),
(212, 'GONZÁLES VÁSQUEZ JORGE SMITH', 2, '2020210001', 'ESTUDIANTE', '', '', 1),
(213, 'MARTINEZ ROMERO ANDERSON', 2, '2021120016', 'ESTUDIANTE', '', '', 1),
(214, 'RAFAEL SÁNCHEZ EINSTEN RIVALDO', 2, '2019220023', 'ESTUDIANTE', '', '', 1),
(215, 'RODRIGUEZ BANCES MAX LEONARD', 2, '2016111050', 'ESTUDIANTE', '', '', 1),
(216, 'SAMANIEGO ADRIANZEN JOSE BENJAMIN', 2, '2019111379', 'ESTUDIANTE', '', '', 1),
(217, 'SÁNCHEZ CÓRDOVA EISNER JAIR', 2, '2020210065', 'ESTUDIANTE', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `codigobarra` varchar(100) DEFAULT NULL,
  `pventa` decimal(15,2) DEFAULT NULL,
  `pcompra` decimal(15,2) DEFAULT NULL,
  `stock` decimal(15,2) DEFAULT NULL,
  `idunidad` char(3) DEFAULT NULL,
  `urlimagen` varchar(200) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `idsubcategoria` int(11) DEFAULT NULL,
  `idafectacion` int(11) DEFAULT NULL,
  `afectoicbper` smallint(6) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL,
  `stockseguridad` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `nombre`, `codigobarra`, `pventa`, `pcompra`, `stock`, `idunidad`, `urlimagen`, `idcategoria`, `idsubcategoria`, `idafectacion`, `afectoicbper`, `estado`, `stockseguridad`) VALUES
(1, 'GASEOSA COCA COLA 1.5L', '292992929292', 3.00, 2.00, 21.00, 'NIU', 'imagenes/productos/IMG_1_cepillo_vitis_duro.jpg', 10, NULL, 10, 0, 2, 12.00),
(2, 'GASEOSA INKA KOLA 1L', '9099393993', 5.00, 4.00, 24.00, 'NIU', NULL, 10, NULL, 10, NULL, 2, NULL),
(3, 'GALLETA RELLENITA DE CHOCOLATE', '98238489234', 0.60, 0.40, 4.00, 'NIU', 'imagenes/productos/IMG_3_rellenita.jpg', 15, NULL, 10, 0, 2, NULL),
(4, 'GALLETITAS DE ANIMALITOS', '98238489231', 1.00, 0.80, 0.00, 'NIU', 'imagenes/productos/IMG_4_animalitos.jpg', 15, NULL, 10, 0, 0, NULL),
(5, 'BOLSA PLASTICA1', 'B9999', 0.80, 0.60, 10.00, 'NIU', 'imagenes/productos/IMG_5_pastilla01.jpg', 13, NULL, 10, 1, 1, 50.00),
(6, 'PILSEN CALLAO 620', '', 6.00, 5.00, 4.00, 'NIU', '', 10, 0, 10, 0, 1, 0.00),
(7, 'INKA COLA 1L', '11111111', 5.00, 4.00, 5.00, 'NIU', '', 10, 0, 10, 0, 1, 12.00),
(8, 'CONCORDIA 2L MARACUYA', 'C0000111', 10.00, 9.00, 3.00, 'NIU', NULL, 10, NULL, 10, 0, 1, NULL),
(9, 'MARTILLO', '98899888', 15.00, 10.00, 26.00, 'NIU', NULL, 0, NULL, 10, 0, 1, 20.00),
(10, 'PARACETAMOL 400G', '345345345', 4.00, 1.00, 92.00, 'NIU', '', 24, 13, 10, 0, 1, 10.00),
(11, 'PANADOL FORTE 500G', '7867546646456', 0.00, 0.00, 0.00, 'NIU', 'imagenes/productos/IMG_11_pastilla01.jpg', 24, 14, 10, 0, 1, 0.00),
(12, 'DEXTROMETOFANO 500', 'P00005', 10.00, 5.00, 14.00, 'NIU', 'imagenes/productos/IMG_11_jarabe01.jpg', 24, 12, 10, 0, 1, 10.00),
(13, 'IBUPROFENO', 'P007', 20.00, 10.00, 8.00, 'NIU', '', 24, 13, 10, 0, 1, 6.00),
(14, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serie`
--

CREATE TABLE `serie` (
  `idserie` int(11) NOT NULL,
  `idtipocomprobante` char(2) DEFAULT NULL,
  `serie` varchar(6) DEFAULT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `serie`
--

INSERT INTO `serie` (`idserie`, `idtipocomprobante`, `serie`, `correlativo`, `estado`) VALUES
(1, '03', 'B001', 172, 1),
(2, '03', 'B002', 90, 1),
(3, '01', 'F001', 38, 1),
(4, '01', 'F002', 45, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `idsubcategoria` int(11) NOT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`idsubcategoria`, `idcategoria`, `nombre`, `estado`) VALUES
(1, 23, 'CARNES FRITAS', 1),
(2, 36, 'SUBCATEGORIA Z', 1),
(3, 11, 'SUBCATEGORIA Y', 1),
(4, 36, 'CREMAS DE BARBERIA', 1),
(5, 36, 'PEINES DE BARBERIA', 1),
(6, 0, 'CORTES DE BARBERIA', 1),
(7, 9, 'ABC DEL PERU', 1),
(8, 0, 'ABC DE AMERICA', 1),
(9, 9, 'ABC DE LIMA', 1),
(10, 9, 'ABC DE CHICLAYO', 1),
(11, 9, 'ABC DEL PERU 2', 1),
(12, 24, 'PASTILLAS GENERICAS', 1),
(13, 24, 'PASTILLAS DE MARCA', 1),
(14, 24, 'ANTIGRIPALES', 1),
(15, 24, 'DOLORES ESTOMACALES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocomprobante`
--

CREATE TABLE `tipocomprobante` (
  `idtipocomprobante` char(2) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tipocomprobante`
--

INSERT INTO `tipocomprobante` (`idtipocomprobante`, `nombre`, `estado`) VALUES
('01', 'FACTURA', 1),
('03', 'BOLETA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `idtipodocumento` char(1) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`idtipodocumento`, `nombre`, `estado`) VALUES
('1', 'DNI', 1),
('2', 'CÓDIGO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `idunidad` char(3) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`idunidad`, `descripcion`, `estado`) VALUES
('BOX', 'CAJA', 1),
('KGM', 'KILOGRAMO', 1),
('NIU', 'UNIDAD', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usoequipo`
--

CREATE TABLE `usoequipo` (
  `idusoequipo` int(11) NOT NULL,
  `idasistencia` int(11) NOT NULL,
  `idequipo` int(11) NOT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usoequipo`
--

INSERT INTO `usoequipo` (`idusoequipo`, `idasistencia`, `idequipo`, `estado`) VALUES
(1, 1, 1, 1),
(2, 2, 3, 1),
(3, 2, 4, 1),
(4, 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `clave` text DEFAULT NULL,
  `idperfil` int(11) NOT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `usuario`, `clave`, `idperfil`, `estado`) VALUES
(1, 'ISITO', 'admin', 'fd11c806cb284ae7f4a13ab15f88945c63c9b3f3', 1, 1),
(2, 'CARLOS ALBERTO', 'carlosalbertox', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, 1),
(3, 'Pedro Perez', 'pedrito', '945c444acc4e489a3a193bf1ec2a0ae14b79279b', 4, 1),
(4, 'prueba', 'prueba', '123456', 1, 1),
(5, 'JUAN PEREZ', 'juanperez', '273a0c7bd3c679ba9a6f5d99078e36e85d02b952', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `idtipocomprobante` char(2) DEFAULT NULL,
  `serie` varchar(6) DEFAULT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `total_gravado` decimal(15,2) DEFAULT NULL,
  `total_exonerado` decimal(15,2) DEFAULT NULL,
  `total_inafecto` decimal(15,2) DEFAULT NULL,
  `total_igv` decimal(15,2) DEFAULT NULL,
  `total_icbper` decimal(15,2) DEFAULT NULL,
  `total_descuento` decimal(15,2) DEFAULT NULL,
  `formapago` char(1) DEFAULT NULL,
  `idmoneda` char(3) DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `guiaremision` varchar(20) DEFAULT NULL,
  `ordencompra` varchar(20) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `fecha`, `idcliente`, `idtipocomprobante`, `serie`, `correlativo`, `total`, `total_gravado`, `total_exonerado`, `total_inafecto`, `total_igv`, `total_icbper`, `total_descuento`, `formapago`, `idmoneda`, `vencimiento`, `guiaremision`, `ordencompra`, `idusuario`, `estado`) VALUES
(1, '2022-01-05', 7, '03', 'B001', 136, 10.00, 8.47, 0.00, 0.00, 1.53, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(2, '2022-01-20', 7, '03', 'B001', 137, 29.00, 24.58, 0.00, 0.00, 4.42, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(3, '2022-02-16', 1, '03', 'B001', 138, 18.00, 15.25, 0.00, 0.00, 2.75, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(4, '2022-03-24', 7, '03', 'B001', 139, 12.00, 10.17, 0.00, 0.00, 1.83, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(5, '2022-04-20', 7, '03', 'B001', 140, 21.00, 17.80, 0.00, 0.00, 3.20, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(6, '2022-05-26', 7, '03', 'B001', 141, 19.20, 16.27, 0.00, 0.00, 2.93, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(7, '2022-06-23', 7, '03', 'B001', 142, 40.00, 33.90, 0.00, 0.00, 6.10, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(8, '2022-07-19', 7, '03', 'B001', 143, 18.00, 15.25, 0.00, 0.00, 2.75, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(9, '2022-11-30', 7, '03', 'B001', 144, 105.00, 88.98, 0.00, 0.00, 16.02, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(10, '2022-08-24', 7, '03', 'B001', 145, 67.00, 56.78, 0.00, 0.00, 10.22, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(11, '2022-09-22', 2, '03', 'B001', 146, 46.00, 38.97, 0.00, 0.00, 7.03, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(12, '2022-10-25', 2, '01', 'F001', 31, 25.00, 21.18, 0.00, 0.00, 3.82, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(13, '2022-11-30', 2, '01', 'F001', 32, 40.00, 33.89, 0.00, 0.00, 6.11, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(14, '2022-01-01', 2, '01', 'F001', 33, 15.00, 12.71, 0.00, 0.00, 2.29, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(15, '2021-01-01', 2, '01', 'F001', 34, 15.00, 12.71, 0.00, 0.00, 2.29, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(16, '2022-11-15', 2, '01', 'F001', 35, 30.00, 25.42, 0.00, 0.00, 4.58, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
(18, '2023-02-06', 2, '01', 'F001', 36, 34.00, 28.81, 0.00, 0.00, 5.19, 0.00, 0.00, 'C', 'PEN', NULL, 't001-23', 'oc3453', 1, 2),
(19, '2023-02-06', 13, '01', 'F001', 37, 106.00, 89.83, 0.00, 0.00, 16.17, 0.00, 0.00, 'C', 'PEN', NULL, 'T001-90', 'OC4-088', 1, 1),
(20, '2023-02-08', 2, '01', 'F001', 38, 15.00, 12.71, 0.00, 0.00, 2.29, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(21, '2023-02-08', 11, '03', 'B001', 147, 35.00, 29.65, 0.00, 0.00, 5.35, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(22, '2023-02-08', 11, '03', 'B001', 148, 30.00, 25.42, 0.00, 0.00, 4.58, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(23, '2023-02-08', 11, '03', 'B001', 149, 16.00, 13.56, 0.00, 0.00, 2.44, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(24, '2023-02-08', 1, '03', 'B001', 150, 10.00, 8.47, 0.00, 0.00, 1.53, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(25, '2023-02-08', 11, '03', 'B001', 151, 40.00, 33.90, 0.00, 0.00, 6.10, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(26, '2023-10-27', 15, '03', 'B001', 152, 10.80, 8.72, 0.00, 0.00, 1.58, 0.50, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(27, '2023-10-27', 16, '03', 'B001', 153, 10.80, 8.72, 0.00, 0.00, 1.58, 0.50, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(28, '2023-11-03', 16, '03', 'B001', 154, 74.00, 62.71, 0.00, 0.00, 11.29, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(29, '2023-11-03', 16, '03', 'B001', 155, 74.00, 62.71, 0.00, 0.00, 11.29, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(30, '2023-11-03', 16, '03', 'B001', 156, 85.80, 72.28, 0.00, 0.00, 13.02, 0.50, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(31, '2023-11-06', 16, '03', 'B001', 157, 24.00, 20.34, 0.00, 0.00, 3.66, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(32, '2023-11-06', 16, '03', 'B001', 158, 24.00, 20.34, 0.00, 0.00, 3.66, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(33, '2023-11-06', 16, '03', 'B001', 159, 44.00, 37.28, 0.00, 0.00, 6.72, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(34, '2023-11-06', 16, '03', 'B001', 160, 24.00, 20.34, 0.00, 0.00, 3.66, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(35, '2023-11-06', 16, '03', 'B001', 161, 19.00, 16.10, 0.00, 0.00, 2.90, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(36, '2023-11-06', 16, '03', 'B001', 162, 4.00, 3.39, 0.00, 0.00, 0.61, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(37, '2023-11-06', 16, '03', 'B001', 163, 4.00, 3.39, 0.00, 0.00, 0.61, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(38, '2023-11-06', 16, '03', 'B001', 164, 4.00, 3.39, 0.00, 0.00, 0.61, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(39, '2023-11-06', 16, '03', 'B001', 165, 6.80, 5.42, 0.00, 0.00, 0.98, 0.40, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(40, '2023-11-08', 1, '03', 'B001', 166, 39.00, 33.05, 0.00, 0.00, 5.95, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1),
(41, '2023-11-08', 1, '03', 'B001', 167, 39.00, 33.05, 0.00, 0.00, 5.95, 0.00, 0.00, 'C', 'PEN', NULL, '02', '02', 1, 1),
(42, '2023-11-08', 1, '03', 'B001', 168, 20.00, 16.95, 0.00, 0.00, 3.05, 0.00, 0.00, 'C', 'PEN', NULL, '02', '02', 1, 1),
(43, '2023-11-08', 1, '03', 'B001', 169, 20.00, 16.95, 0.00, 0.00, 3.05, 0.00, 0.00, 'C', 'PEN', NULL, '02', '02', 1, 1),
(44, '2023-11-08', 1, '03', 'B001', 170, 20.00, 16.95, 0.00, 0.00, 3.05, 0.00, 0.00, 'C', 'PEN', NULL, '02', '02', 1, 1),
(45, '2023-11-08', 1, '03', 'B001', 171, 20.00, 16.95, 0.00, 0.00, 3.05, 0.00, 0.00, 'C', 'PEN', NULL, '02', '02', 1, 1),
(46, '2023-11-08', 1, '03', 'B001', 172, 20.00, 16.95, 0.00, 0.00, 3.05, 0.00, 0.00, 'C', 'PEN', NULL, '02', '02', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`idperfil`,`idopcion`) USING BTREE;

--
-- Indices de la tabla `afectacion`
--
ALTER TABLE `afectacion`
  ADD PRIMARY KEY (`idafectacion`) USING BTREE;

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idasistencia`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`idcarrera`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`) USING BTREE;

--
-- Indices de la tabla `ciclo`
--
ALTER TABLE `ciclo`
  ADD PRIMARY KEY (`idciclo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`) USING BTREE;

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`iddetalle`) USING BTREE;

--
-- Indices de la tabla `detalleasistencia`
--
ALTER TABLE `detalleasistencia`
  ADD PRIMARY KEY (`iddetalle`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`iddocente`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idequipo`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`idmoneda`) USING BTREE;

--
-- Indices de la tabla `opcion`
--
ALTER TABLE `opcion`
  ADD PRIMARY KEY (`idopcion`) USING BTREE;

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idperfil`) USING BTREE;

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`idpersonal`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`) USING BTREE;

--
-- Indices de la tabla `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`idserie`) USING BTREE;

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`idsubcategoria`) USING BTREE;

--
-- Indices de la tabla `tipocomprobante`
--
ALTER TABLE `tipocomprobante`
  ADD PRIMARY KEY (`idtipocomprobante`) USING BTREE;

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`idtipodocumento`) USING BTREE;

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`idunidad`) USING BTREE;

--
-- Indices de la tabla `usoequipo`
--
ALTER TABLE `usoequipo`
  ADD PRIMARY KEY (`idusoequipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`) USING BTREE;

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`) USING BTREE,
  ADD UNIQUE KEY `INDEX_VALIDACION_CORRELATIVO` (`idtipocomprobante`,`serie`,`correlativo`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idasistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `idcarrera` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `ciclo`
--
ALTER TABLE `ciclo`
  MODIFY `idciclo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `detalleasistencia`
--
ALTER TABLE `detalleasistencia`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `iddocente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `opcion`
--
ALTER TABLE `opcion`
  MODIFY `idopcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idperfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `idpersonal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `serie`
--
ALTER TABLE `serie`
  MODIFY `idserie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `idsubcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usoequipo`
--
ALTER TABLE `usoequipo`
  MODIFY `idusoequipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
