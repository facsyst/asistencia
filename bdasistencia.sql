-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-10-2023 a las 20:16:13
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
  `idpersonal` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `horaentrada` time DEFAULT NULL,
  `horasalida` time DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`idasistencia`, `idpersonal`, `fecha`, `horaentrada`, `horasalida`, `estado`) VALUES
(1, 2, '2023-10-20', NULL, '20:00:00', 1),
(2, 1, '2023-10-10', '10:10:00', '05:05:00', 1),
(3, 1, '2023-10-19', '10:11:00', '04:55:00', 1),
(4, 1, '2023-10-11', '12:10:00', '10:10:00', 1),
(5, 2, '2023-10-20', '13:58:00', '22:58:00', 1),
(6, 2, '2023-10-20', '00:00:00', '00:00:00', 1),
(7, 2, '2023-10-20', '00:00:00', '00:00:00', 1);

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
(14, 'INDUSTRIA DE PALMA ACEITERA DE LORETO Y SAN MARTIN S.A.', '6', '20450105466', 'CAR.F.BEL.TERR-TRA.TARA.YURI. KM. 63.5 CAS.  SECTOR HUICUNGO  (A 500 MT. INICI CARR.A BARRANQUITA)  SAN MARTIN - LAMAS - CAYNARACHI', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
(2, 2, 1, 3.00, 'NIU', 3.00, 1.37, 0.00, 0.00, 9.00, 10, 1, NULL, NULL),
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
(1, '02', 'aaa', 'OPTIPLEX 3080', '4rr', 1);

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
(5, 'Clientes', 'fa-users', 'vista/clientes.php', 6, 1),
(6, 'Ventas', 'fa-cart-plus', 'vista/ventas.php', 7, 1),
(7, 'Inventario', 'fa-boxes', 'vista/inventario.php', 8, 1),
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
(1, 'd', 1, '12345', 'AD', NULL, NULL, 1),
(2, 'car', 1, '344344', 'ESTUDIANTE', '', '', 1);

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
(1, 'GASEOSA COCA COLA 1.5L', '292992929292', 3.00, 2.00, 18.00, 'NIU', 'imagenes/productos/IMG_1_cepillo_vitis_duro.jpg', 10, NULL, 10, 0, 2, 12.00),
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
(1, '03', 'B001', 151, 1),
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
('0', 'SIN DOCUMENTO', 1),
('1', 'DNI', 1),
('4', 'CARNET DE EXTRANJERIA', 1),
('6', 'RUC', 1),
('7', 'CARNET UNIVERSITARIO', 1);

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
(2, '2022-01-20', 7, '03', 'B001', 137, 9.00, 7.63, 0.00, 0.00, 1.37, 0.00, 0.00, 'C', 'PEN', '0000-00-00', '', '', 1, 1),
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
(25, '2023-02-08', 11, '03', 'B001', 151, 40.00, 33.90, 0.00, 0.00, 6.10, 0.00, 0.00, 'C', 'PEN', NULL, '', '', 1, 1);

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
  MODIFY `idasistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `idpersonal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `idusoequipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
