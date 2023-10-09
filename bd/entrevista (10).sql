-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2019 a las 20:51:20
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `entrevista`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignados`
--

CREATE TABLE `asignados` (
  `id_asig` int(11) NOT NULL,
  `id_agente` int(11) DEFAULT NULL,
  `id_gerente` int(11) DEFAULT NULL,
  `folio` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asignados`
--

INSERT INTO `asignados` (`id_asig`, `id_agente`, `id_gerente`, `folio`) VALUES
(0, NULL, NULL, '-Seleccionar-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidades`
--

CREATE TABLE `cantidades` (
  `id_cantidad` int(11) NOT NULL,
  `cantidad` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cantidades`
--

INSERT INTO `cantidades` (`id_cantidad`, `cantidad`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colchon`
--

CREATE TABLE `colchon` (
  `id_colchon` int(11) NOT NULL,
  `colchon` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `colchon`
--

INSERT INTO `colchon` (`id_colchon`, `colchon`) VALUES
(1, 'NINGUNO'),
(2, '1 MES'),
(3, '2 MESES'),
(4, '3 MESES'),
(5, 'MAS DE 3 MESES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conexion`
--

CREATE TABLE `conexion` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `conexion`
--

INSERT INTO `conexion` (`id`, `resultado`) VALUES
(1, 'SI, EMPLEADO'),
(2, 'SI, DEFINITIVO'),
(3, 'DECLINÓ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cubre_perfil`
--

CREATE TABLE `cubre_perfil` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cubre_perfil`
--

INSERT INTO `cubre_perfil` (`id`, `resultado`) VALUES
(1, 'SI'),
(2, 'ESTUDIOS NO COMPROBABLES'),
(3, 'INCONSISTENCIA EN DOCUMENTACIO'),
(4, 'IMAGEN'),
(5, 'NO COMPETENCIA'),
(6, 'NO FACTORES VITALES'),
(7, 'NO POR DISTANCIA'),
(8, 'NO COLCHON ECONOMICO'),
(9, 'FACTORES KNOW-OUT'),
(10, 'OTRO'),
(11, 'SOLTERO'),
(12, 'CASADO/UNION LIBRE'),
(13, 'DIVORCIADO'),
(14, 'VIUDO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `decision`
--

CREATE TABLE `decision` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `decision`
--

INSERT INTO `decision` (`id`, `resultado`) VALUES
(1, 'Si'),
(2, 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `id` int(11) NOT NULL,
  `resultado` varchar(35) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id`, `resultado`) VALUES
(1, 'Otro'),
(2, 'Alvaro Obregón'),
(3, 'Azcapotzalco'),
(4, 'Benito Juarez'),
(5, 'Coyoacán'),
(6, 'Cuajimalpa de Morelos'),
(7, 'Cuauhtémoc'),
(8, 'Gustavo A. Madero'),
(9, 'Iztacalco'),
(10, 'Iztapalapa'),
(11, 'Magdalena Contreras'),
(12, 'Miguel Hidalgo'),
(13, 'Milpa Alta'),
(14, 'Tláhuac'),
(15, 'Tlalpan'),
(16, 'Venustiano Carranza'),
(17, 'Xochimilco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edat`
--

CREATE TABLE `edat` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `edat`
--

INSERT INTO `edat` (`id`, `nombre`) VALUES
(1, 'Alan Soto '),
(2, 'Paloma Razo'),
(3, 'Virsayit Rocha'),
(4, 'alexis'),
(5, 'ignacio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edo_civil`
--

CREATE TABLE `edo_civil` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `edo_civil`
--

INSERT INTO `edo_civil` (`id`, `resultado`) VALUES
(1, 'SOLTERO'),
(2, 'CASADO/UNION LIBRE'),
(3, 'DIVORCIADO'),
(4, 'VIUDO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escolaridad`
--

CREATE TABLE `escolaridad` (
  `id` int(11) NOT NULL,
  `resultado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `escolaridad`
--

INSERT INTO `escolaridad` (`id`, `resultado`) VALUES
(1, 'BACHILLERATO CONCLUIDO'),
(2, 'LINCENCIATURA TRUNCA más del 70%'),
(3, 'LINCENCIATURA TRUNCA menos del 70%'),
(4, 'LICENCIATURA CONCLUIDA'),
(5, 'MAESTRIA'),
(6, 'DOCTORADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `resultado`) VALUES
(1, 'ARRANQUE'),
(2, 'PENDIENTE'),
(3, 'DECLINO'),
(4, 'DOCUMENTOS INCOMPLETOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilo_venta`
--

CREATE TABLE `estilo_venta` (
  `id` int(11) NOT NULL,
  `estilo` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estilo_venta`
--

INSERT INTO `estilo_venta` (`id`, `estilo`) VALUES
(1, 'Analitico'),
(2, 'Dinamico'),
(3, 'Interpersonal'),
(4, 'Analitico / Dinamico'),
(5, 'Analitico / Interpersonal'),
(6, 'Dinamico / Interpersonal'),
(7, 'No determinado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia`
--

CREATE TABLE `experiencia` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `experiencia`
--

INSERT INTO `experiencia` (`id`, `resultado`) VALUES
(1, 'SIN EXPERIENCIA'),
(2, '1 ANO EN VENTAS'),
(3, '2 ANOS O MAS EN VENTAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuente`
--

CREATE TABLE `fuente` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fuente`
--

INSERT INTO `fuente` (`id`, `resultado`) VALUES
(1, 'OCC'),
(2, 'BUMERAN'),
(3, 'VINCUVENTAS'),
(4, 'BOLSA ROSA'),
(5, 'AGENTE'),
(6, 'TALENTECA'),
(7, 'INTERCAMBIO DE CARTERA'),
(8, 'OTRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `resultado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `resultado`) VALUES
(1, 'M'),
(2, 'F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gerentes`
--

CREATE TABLE `gerentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gerentes`
--

INSERT INTO `gerentes` (`id`, `nombre`) VALUES
(1, 'Martin Galvan Sanchez'),
(2, 'Roberto rodriguez Arzate'),
(3, 'Sandra Viquez Garcia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interesado`
--

CREATE TABLE `interesado` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `interesado`
--

INSERT INTO `interesado` (`id`, `resultado`) VALUES
(1, 'SI'),
(2, 'LO VA A PENSAR'),
(3, 'NO QUIERE SEGUROS'),
(4, 'NO POR TIEMPO'),
(5, 'NO POR SU SUELDO BASE'),
(6, 'NO VENTA DE CAMPO'),
(7, 'OTRO'),
(8, 'QUIERE PRESTACIONES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `knowout`
--

CREATE TABLE `knowout` (
  `id` int(11) NOT NULL,
  `factor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `knowout`
--

INSERT INTO `knowout` (`id`, `factor`) VALUES
(1, '1 Factor=Preocupante.'),
(2, '2 Factores=Menos del 50% de probabilidad de exito.'),
(3, '3 Factores=No continuar.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llenado`
--

CREATE TABLE `llenado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `a_paterno` varchar(20) NOT NULL,
  `a_materno` varchar(20) DEFAULT NULL,
  `telefono` int(12) DEFAULT NULL,
  `correo` varchar(20) DEFAULT NULL,
  `fuente` int(11) DEFAULT NULL,
  `refiere` varchar(20) DEFAULT NULL,
  `resul_llamada` int(11) DEFAULT NULL,
  `fecha_cita` date DEFAULT NULL,
  `hora_cita` time DEFAULT NULL,
  `acudio_cita` int(11) DEFAULT NULL,
  `cubre_perfil` int(11) DEFAULT NULL,
  `delegacion` varchar(20) DEFAULT NULL,
  `edo_civil` int(11) DEFAULT NULL,
  `edad` int(2) DEFAULT NULL,
  `escolaridad` int(11) DEFAULT NULL,
  `institucion` varchar(50) DEFAULT NULL,
  `carrera` varchar(50) DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `exp` int(11) DEFAULT NULL,
  `colchon` int(11) DEFAULT NULL,
  `transporte` int(11) DEFAULT NULL,
  `t_disponible` int(11) DEFAULT NULL,
  `credito` int(11) DEFAULT NULL,
  `pago_credit` int(11) DEFAULT NULL,
  `buro` int(11) DEFAULT NULL,
  `monto` int(11) DEFAULT NULL,
  `imagen` int(11) DEFAULT NULL,
  `usuario_seguro` int(11) DEFAULT NULL,
  `interesado` int(11) DEFAULT NULL,
  `psp` int(11) DEFAULT NULL,
  `logro` int(11) DEFAULT NULL,
  `energia` int(11) DEFAULT NULL,
  `adaptable` int(11) DEFAULT NULL,
  `persistente` int(11) DEFAULT NULL,
  `tolerante` int(11) DEFAULT NULL,
  `sociable` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `estilo` int(11) DEFAULT NULL,
  `ind_rendimiento` int(11) DEFAULT NULL,
  `validez` int(11) DEFAULT NULL,
  `gte_asignado` int(11) DEFAULT NULL,
  `res_entrevista` int(11) DEFAULT NULL,
  `motivo_rechazo` varchar(50) DEFAULT NULL,
  `pp200` int(11) DEFAULT NULL,
  `estatus` int(11) DEFAULT NULL,
  `conexion` int(11) DEFAULT NULL,
  `oberservaciones` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llenado_formulario`
--

CREATE TABLE `llenado_formulario` (
  `id` int(11) NOT NULL,
  `folio` varchar(15) DEFAULT NULL,
  `fechareg` date DEFAULT NULL,
  `edat` varchar(50) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `a_paterno` varchar(20) DEFAULT NULL,
  `a_materno` varchar(20) DEFAULT NULL,
  `edad` varchar(10) DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `edo_civil` varchar(50) DEFAULT NULL,
  `dependientes` varchar(5) DEFAULT NULL,
  `ocupacion` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `transporte` varchar(30) DEFAULT NULL,
  `escolaridad` varchar(50) DEFAULT NULL,
  `institucion` varchar(50) DEFAULT NULL,
  `carrera` varchar(50) DEFAULT NULL,
  `ingreso` int(11) NOT NULL,
  `interesado` varchar(50) DEFAULT NULL,
  `usuario_seguro` varchar(10) DEFAULT NULL,
  `fuente` varchar(50) DEFAULT NULL,
  `referido` varchar(50) DEFAULT NULL,
  `resul_llamada` varchar(30) DEFAULT NULL,
  `fecha_cita` date DEFAULT NULL,
  `hora_cita` time DEFAULT NULL,
  `acudio_entrevista` varchar(10) DEFAULT NULL,
  `cubre_perfil` varchar(50) DEFAULT NULL,
  `exp` varchar(30) DEFAULT NULL,
  `colchon` varchar(15) DEFAULT NULL,
  `t_disponible` varchar(15) DEFAULT NULL,
  `caracter` int(11) NOT NULL,
  `sentido` int(11) NOT NULL,
  `orientacion` int(11) NOT NULL,
  `motivacion` int(11) NOT NULL,
  `perseverancia` int(11) NOT NULL,
  `suma_vitales` int(11) NOT NULL,
  `credito` varchar(15) DEFAULT NULL,
  `pago_credito` int(15) DEFAULT NULL,
  `buro` varchar(15) DEFAULT NULL,
  `monto` int(15) DEFAULT NULL,
  `psp` varchar(15) DEFAULT NULL,
  `imagen` int(5) DEFAULT NULL,
  `logro` int(5) DEFAULT NULL,
  `energia` int(5) DEFAULT NULL,
  `adaptable` int(5) DEFAULT NULL,
  `persistente` int(5) DEFAULT NULL,
  `tolerante` int(5) DEFAULT NULL,
  `sociable` int(5) DEFAULT NULL,
  `puntos` int(5) DEFAULT NULL,
  `res_puntos` varchar(15) DEFAULT NULL,
  `patron` varchar(255) NOT NULL,
  `precision_venta` varchar(50) NOT NULL,
  `estilo_venta` varchar(30) DEFAULT NULL,
  `validez` varchar(30) DEFAULT NULL,
  `res_gdd` varchar(20) DEFAULT NULL,
  `cita_venta` varchar(5) NOT NULL,
  `res_cita_venta` varchar(25) NOT NULL,
  `fecha_cita_venta` date NOT NULL,
  `motivo` varchar(300) DEFAULT NULL,
  `pp200` varchar(10) DEFAULT NULL,
  `estatus` varchar(30) DEFAULT NULL,
  `conexion` varchar(30) DEFAULT NULL,
  `fecha_conexion` date DEFAULT NULL,
  `pp200_observaciones` varchar(300) DEFAULT NULL,
  `rendimiento_venta` varchar(30) DEFAULT NULL,
  `res_primer_contacto` char(5) DEFAULT NULL,
  `documentacion` varchar(255) DEFAULT NULL,
  `fecha_induccion` date DEFAULT NULL,
  `arranque` varchar(25) DEFAULT NULL,
  `gerente` varchar(30) DEFAULT NULL,
  `razon` varchar(30) DEFAULT NULL,
  `comentarios_gdd` varchar(255) NOT NULL,
  `sumapotencial` int(11) NOT NULL,
  `mensajepotencial` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `llenado_formulario`
--

INSERT INTO `llenado_formulario` (`id`, `folio`, `fechareg`, `edat`, `nombre`, `a_paterno`, `a_materno`, `edad`, `genero`, `direccion`, `edo_civil`, `dependientes`, `ocupacion`, `celular`, `correo`, `transporte`, `escolaridad`, `institucion`, `carrera`, `ingreso`, `interesado`, `usuario_seguro`, `fuente`, `referido`, `resul_llamada`, `fecha_cita`, `hora_cita`, `acudio_entrevista`, `cubre_perfil`, `exp`, `colchon`, `t_disponible`, `caracter`, `sentido`, `orientacion`, `motivacion`, `perseverancia`, `suma_vitales`, `credito`, `pago_credito`, `buro`, `monto`, `psp`, `imagen`, `logro`, `energia`, `adaptable`, `persistente`, `tolerante`, `sociable`, `puntos`, `res_puntos`, `patron`, `precision_venta`, `estilo_venta`, `validez`, `res_gdd`, `cita_venta`, `res_cita_venta`, `fecha_cita_venta`, `motivo`, `pp200`, `estatus`, `conexion`, `fecha_conexion`, `pp200_observaciones`, `rendimiento_venta`, `res_primer_contacto`, `documentacion`, `fecha_induccion`, `arranque`, `gerente`, `razon`, `comentarios_gdd`, `sumapotencial`, `mensajepotencial`) VALUES
(40, NULL, '2019-01-14', 'Alan Soto', 'JOANNA HELENA PRIETO SILLER', '', NULL, '37', NULL, 'Benito Juarez', 'SOLTERO', '1', 'encargada de area', '5513789565', '', 'Auto', 'LICENCIATURA CONCLUIDA', 'unam', 'lae', 37000, NULL, NULL, 'AGENTE', 'ALFREDO PIEDRA', 'CITA', '2019-01-08', '07:30:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 8, 8, 0, 6, 9, 0, NULL, NULL, NULL, NULL, NULL, 7, 10, 10, NULL, NULL, NULL, NULL, 51, NULL, 'Colchon', 'Exagerado', 'Dinamico', NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 'Superior al Promedio', NULL, NULL, NULL, NULL, NULL, NULL, '', 105, 'Superior'),
(41, NULL, '2019-01-14', 'Alan Soto', 'TONATIUH HERRERA LUNA', '', NULL, '32', NULL, 'Venustiano Carranza', 'SOLTERO', '1', 'APODERADO LEGAL', '5566268101', '', 'Auto', 'LICENCIATURA CONCLUIDA', 'UNAM', 'DERECHO', 17000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-08', '01:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 7, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(42, NULL, '2019-01-14', 'Alan Soto', 'GERSON URIEL GONZALEZ SANDOVAL', '', NULL, '24', NULL, 'CoyoacÃ¡n', 'SOLTERO', '0', 'GERENTE ADMINISTRATIVO ', '5588041745', '', 'Auto', 'LINCENCIATURA TRUNCA menos del 70%', 'UVM', 'ARQUITECTURA', 20000, NULL, NULL, 'OCC', 'ALFREDO PIEDRA', 'CITA', '2019-01-08', '00:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 8, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(43, NULL, '2019-01-14', 'Alan Soto', 'MARIA ABIGAIL ZANDOVAL FLORES', '', NULL, '36', NULL, 'CuauhtÃ©moc', 'SOLTERO', '2', 'GERENTE SR DE AUDITORIA DE CALIDAD Y TI', '5585319787', '', 'Auto', 'LICENCIATURA CONCLUIDA', 'IPN', 'INGENIERO EN COMUNICACIONES Y ELECTRÃ“NICA ', 60000, NULL, NULL, 'OCC', 'ALFREDO PIEDRA', 'CITA', '2019-01-08', '11:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(44, NULL, '2019-01-14', 'Alan Soto', 'NATALIA CARVAJAL MUIï¿½O', '', NULL, '46', NULL, 'Cuajimalpa de Morelos', 'SOLTERO', '2', 'DIRECTORA RETAIL MEXICO ', '5580093001', '', 'Auto', 'BACHILLERATO CONCLUIDO', 'UNED', '', 167000, NULL, NULL, 'BOLSA ROSA', 'ALFREDO PIEDRA', 'CITA', '2019-01-09', '10:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(45, NULL, '2019-01-14', 'Alan Soto', 'LADIS BERMUDEZ HERNANDEZ', '', NULL, '30', NULL, 'CuauhtÃ©moc', 'SOLTERO', '2', 'COORDINADORA DE PRESIDENCIA ', '9381200725', '', 'Auto', 'LICENCIATURA CONCLUIDA', 'EAN', 'EAN DE BOGOTA', 29998, NULL, NULL, 'OCC', 'ALFREDO PIEDRA', 'CITA', '2019-01-09', '11:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(46, NULL, '2019-01-14', 'Alan Soto', 'ILIANA GOMEZ ', '', NULL, '29', NULL, 'Gustavo A. Madero', 'SOLTERO', '1', 'PROJECT MANAGER ', '5534555897', '', 'Auto', 'LICENCIATURA CONCLUIDA', 'UVM', 'DISEÃ‘O GRAFICO', 30000, NULL, NULL, 'OCC', 'ALFREDO PIEDRA', 'CITA', '2019-01-09', '00:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(47, NULL, '2019-01-14', 'Alan Soto', 'ALEJANDRA GARCIA ', '', NULL, '', NULL, 'null', 'null', '', '', '5580345920', '', '0', 'null', '', '', 0, NULL, NULL, 'OCC', 'ALFREDO PIEDRA', 'CITA', '2019-01-10', '10:00:00', 'Si', NULL, NULL, NULL, 'null', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(48, NULL, '2019-01-14', 'Alan Soto', 'BRENDA BERNAL ', '', NULL, '', NULL, 'null', 'null', '', '', '5580345920', '', '0', 'null', '', '', 0, NULL, NULL, 'BOLSA ROSA', 'ALFREDO PIEDRA', 'CITA', '2019-01-11', '11:00:00', 'Si', NULL, NULL, NULL, 'null', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(50, NULL, '2019-01-14', 'Alan Soto', 'Fernanda Ortiz', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5580061298', 'ferog96@hotmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-15', '16:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(51, NULL, '2019-01-14', 'Alan Soto', 'Elisa Gomez Fong', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '6121369242', 'elisa.gomezfong@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-15', '15:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(52, NULL, '2019-01-14', 'Alan Soto', 'Gina Muro', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5529118386', 'trebol__G@hotmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-15', '13:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(53, NULL, '2019-01-14', 'Alan Soto', 'MARICELA BASTIDA', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'marbastidacultura@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-15', '12:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(54, NULL, '2019-01-14', 'Paloma Razo', 'Anaï¿½Ocampo Lopez', '', NULL, '27', NULL, 'Otro', 'SOLTERO', '', 'ASESOR VENTAS', '5518041040', 'abol_08@hotmail.com', 'Auto', 'LICENCIATURA CONCLUIDA', 'UNIVERSIDAD DE CUATITLAN IZCALLI', 'MERCADOTECNIA', 17000, NULL, NULL, 'VINCUVENTAS', '', 'CITA', '2019-01-07', '13:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 9, 9, 0, 8, 8, 0, NULL, NULL, NULL, NULL, NULL, 8, 8, 9, NULL, NULL, NULL, NULL, 51, NULL, '', 'Seguridad', 'Analitico', NULL, 'Si', '', '', '0000-00-00', NULL, 'null', NULL, NULL, NULL, '', 'Superior al Promedio', NULL, NULL, NULL, NULL, 'Martin', '', '', 90, 'Aceptable'),
(56, NULL, '2019-01-14', 'Paloma Razo', 'ITZEL REYES HERNANDEZ', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5535894546', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-06', '11:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(57, NULL, '2019-01-14', 'Paloma Razo', 'Jesica Martinez Tapia', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5584027998', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-06', '12:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(58, NULL, '2019-01-14', 'Paloma Razo', 'Angelo Raziel Ramirez Zuï¿½iga', '', NULL, '28', NULL, 'Alvaro ObregÃ³n', 'SOLTERO', '0', 'SIN TRABAJO', '5586168088', 'angelo18.ramirez@gmail.com', '0', 'LICENCIATURA CONCLUIDA', 'UNAM', 'ADMINISTRACIÃ“N', 15000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-07', '15:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(59, NULL, '2019-01-14', 'Paloma Razo', 'CARMEN EUGENIA BENITEZ ALONSO', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '7225763415', 'rbtycb@hotmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-08', '11:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(60, NULL, '2019-01-14', 'Paloma Razo', 'Ana Primavera Carreï¿½o Rodrï¿', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5543671198', 'nanishka21@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-08', '09:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(61, NULL, '2019-01-14', 'Paloma Razo', 'Laura Garcia MANZO', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5543671198', 'laura_g1904@yahoo.com.mx', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-08', '10:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(62, NULL, '2019-01-14', 'Paloma Razo', 'IVONNE NAYELI ANGELES DIAZ', '', NULL, '28', NULL, 'Magdalena Contreras', 'SOLTERO', '0', 'SIN EMPLEO', '5519164268', 'ivo_naandi@hotmail.com', 'Auto', 'LICENCIATURA CONCLUIDA', 'UVM', 'ADMINISTRACIÃ“N DE EMPRESAS', 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-08', '00:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(63, NULL, '2019-01-14', 'Paloma Razo', 'Carlos AlbertoÂ De LeÃ³n Torre', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5518339831', 'Â carlos.deleon271293@outlook.es', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'VINCUVENTAS', '', 'CITA', '2019-01-08', '13:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(65, NULL, '2019-01-14', 'Paloma Razo', 'Fausto Ivan Baeza Ortiz', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5586866965', 'ivan12234@hotmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-08', '15:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(66, NULL, '2019-01-14', 'Paloma Razo', 'Juan Carlos Rosas Morales', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5513058110', 'juan_crlsrm@hotmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-09', '11:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(67, NULL, '2019-01-14', 'Paloma Razo', 'Juan Eduardo Morales', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5512638882', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-09', '08:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(68, NULL, '2019-01-14', 'Paloma Razo', 'Osvaldo Oscar Ramos GarcÃ­a', '', NULL, '28', NULL, 'Otro', 'SOLTERO', '0', 'SIN TRABAJO', '5516965178', 'ramo.osvaldo90@gmail.com', 'Auto', 'LINCENCIATURA TRUNCA mÃ¡s del 70%', 'UNAM', 'CIENCIAS POLITICAS', 25000, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-09', '12:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(69, NULL, '2019-01-14', 'Paloma Razo', 'LuceroÂ Hernandez Medellin', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5580340173', 'ceromedellin@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'VINCUVENTAS', '', 'CITA', '2019-01-09', '13:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(70, NULL, '2019-01-14', 'Paloma Razo', 'Karen Gama Fomperosa', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5563185626', 'gama.karen94@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-09', '09:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(71, NULL, '2019-01-14', 'Paloma Razo', 'Carlos Alberto Jaramillo Herna', '', NULL, '22', NULL, 'Otro', 'SOLTERO', '0', 'PONENTE', '7222917486', 'jaramillohernandezcarlos@gmail.com', 'Auto', 'LINCENCIATURA TRUNCA mÃ¡s del 70%', 'EBC', 'FINANZAS Y BANCA', 10000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-09', '15:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(72, NULL, '2019-01-14', 'Paloma Razo', 'Abigail Franco Zamudio', '', NULL, '24', NULL, 'Otro', 'SOLTERO', '0', 'ANALISTA DE RIESGOQ', '7224969563', 'act_afranco@outlook.com', 'Auto', 'LINCENCIATURA TRUNCA mÃ¡s del 70%', 'ANAHUAC', 'CONTADURIA', 20000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-09', '10:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(73, NULL, '2019-01-14', 'Paloma Razo', 'Raul Jair Sanchez', '', NULL, '27', NULL, 'Otro', 'SOLTERO', '0', 'SIN TRABAJO', '5548284687', 'rauljairsanchezm@gmail.com', 'Auto', 'MAESTRIA', 'UNAM', 'ECONOMIA', 45000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-10', '08:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(74, NULL, '2019-01-14', 'Paloma Razo', 'BRENDA MEJï¿½A VALADEZ', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5577632566', 'brendavaladez@outlook.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-10', '09:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(75, NULL, '2019-01-14', 'Paloma Razo', 'MIRIAM ROJAS RODRï¿½GUE', '', NULL, '29', NULL, 'Otro', 'CASADO/UNION LIBRE', '1', 'FUNDADORA', '5536500433Â Â ', 'mnoemi.rojasro@gmail.comï¿½ï¿½', '0', 'LICENCIATURA CONCLUIDA', 'UNAM', 'TRABAJO SOCIAL', 8000, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-10', '09:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(76, NULL, '2019-01-14', 'Paloma Razo', 'Alfonso Luna GonzÃ¡lez', '', NULL, '30', NULL, 'Azcapotzalco', 'SOLTERO', '0', 'ANALISTA DE TRANSFORMACIÃ“N', '5518212843', 'alfonssoluna@gmail.com', 'Auto', 'LINCENCIATURA TRUNCA menos del 70%', 'UNAM', 'ACTUARIA', 17000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-10', '11:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 8, 8, 0, 8, 8, 0, NULL, NULL, NULL, NULL, NULL, 7, 7, 7, NULL, NULL, NULL, NULL, 46, NULL, '', 'Seguridad', 'Analitico', NULL, 'Si', '', '', '0000-00-00', NULL, 'null', NULL, NULL, NULL, '', 'Superior al Promedio', NULL, NULL, NULL, NULL, 'Roberto', '', '', 80, 'Aceptable'),
(77, NULL, '2019-01-14', 'Paloma Razo', 'Francisco Javier Hernandez Rey', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5518212843', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-10', '15:00:00', NULL, NULL, NULL, NULL, NULL, 8, 8, 0, 8, 8, 0, NULL, NULL, NULL, NULL, NULL, NULL, 8, 7, NULL, NULL, NULL, NULL, 47, NULL, '', 'Seguridad', 'Analitico', NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 'Superior al Promedio', NULL, NULL, NULL, NULL, NULL, NULL, '', 82, 'Aceptable'),
(78, NULL, '2019-01-14', 'Paloma Razo', 'ERIKAÂ ESPONDA EZQUERRO', '', NULL, '37', NULL, 'Otro', 'CASADO/UNION LIBRE', '2', 'COACH', '5536136097', 'erikaesponda@hotmail.comÂ Â ', 'Auto', 'LICENCIATURA CONCLUIDA', 'IBERO', 'DERECHO', 15000, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-11', '10:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 9, 8, 0, 9, 8, 0, NULL, NULL, NULL, NULL, NULL, 7, 9, 9, NULL, NULL, NULL, NULL, 52, NULL, '', 'Seguridad', 'Analitico', NULL, 'Si', '', '', '0000-00-00', NULL, 'null', NULL, NULL, NULL, '', 'Promedio', NULL, NULL, NULL, NULL, 'Martin', '', '', 97, 'Aceptable'),
(79, NULL, '2019-01-14', 'Paloma Razo', 'Francisca de Paula ZuÃ±iga Luc', '', NULL, '27', NULL, 'CoyoacÃ¡n', 'SOLTERO', '0', 'SIN TRABAJO', '9531155641', 'paula-lucero2@hotmail.com', '0', 'LICENCIATURA CONCLUIDA', 'TECNOLOGICO NACIONAL DE MEXICO', 'INGENIERIA EN GESTION EMPRESARIAL', 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-11', '10:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(80, NULL, '2019-01-14', 'Paloma Razo', 'Gerhard Erick Martinez Contrer', '', NULL, '28', NULL, 'Otro', 'SOLTERO', '0', 'AGENTE DE SEGUROS', '5554777590', 'gerharderick@hotmail.com', '0', 'LINCENCIATURA TRUNCA mÃ¡s del 70%', 'INSTITUTO LEONARDO BRAVO', 'ADMINISTRACIÃ“N DE EMPRESAS', 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-10', '14:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(81, NULL, '2019-01-14', 'Paloma Razo', 'MARÃA DEL PILARÂ GARCÃA PORR', '', NULL, '25', NULL, 'Azcapotzalco', 'SOLTERO', '0', 'NUTRIOLA', '5531088504', 'pili.garcia.porrero@gmail.comÂ Â ', 'Auto', 'MAESTRIA', 'PANAMERICANA', 'GESTION Y OPERACIÃ“N', 20000, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-14', '10:30:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(82, NULL, '2019-01-14', 'Paloma Razo', 'AarÃ³n Vilchis ChÃ¡vez ', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '33317988216', 'aaronvilchischavez@hotmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-14', '15:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(83, NULL, '2019-01-14', 'Paloma Razo', 'Alicia Romero', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5554576334', 'alirom84@hotmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-14', '12:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(84, NULL, '2019-01-14', 'Alan Soto', 'VERONICA ROMERO BUSTOS', '', NULL, '', NULL, 'null', 'null', '', '', '5523162408', '', 'Auto', 'null', '', '', 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-15', '09:00:00', 'Si', NULL, NULL, NULL, 'null', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(85, NULL, '2019-01-14', 'Paloma Razo', 'Aaron Vilchis Chavez', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '33317988216', 'aaronvilchischavez@hotmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-14', '15:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(86, NULL, '2019-01-16', 'Paloma Razo', 'DANIELAÂ REYES LARA', '', NULL, '33', NULL, 'Venustiano Carranza', 'SOLTERO', '0', 'SIN EMPLEO', '5585341152', 'danreyeslara@gmail.comÂ Â ', 'Auto', 'MAESTRIA', 'UAM', 'ANTROPOLOGIA', 59000, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-15', '12:30:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(87, NULL, '2019-01-16', 'Paloma Razo', 'MariA Gabriela Morales Gutierr', '', NULL, '40', NULL, 'Tlalpan', 'SOLTERO', '1', 'CONSULTOR DO', '5519385689', 'mariagabriela.moralesg@gmail.com', 'Auto', 'LICENCIATURA CONCLUIDA', 'UNIVERSIDAD MEXICANA', 'PEDAGOFIA', 35000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-16', '08:30:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(88, NULL, '2019-01-16', 'Paloma Razo', 'Erika Jaqueline Mendez Serrano', '', NULL, '25', NULL, 'CuauhtÃ©moc', 'SOLTERO', '0', 'FREELANCE', '5566941532', 'jaq.mendez1@gmail.com', '0', 'LICENCIATURA CONCLUIDA', 'UNIVERSIDAD MEXICANA', 'PSICOLOGIA SOCIAL', 25000, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-16', '10:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(89, NULL, '2019-01-16', 'Paloma Razo', 'Andres Clarke Estrada', '', NULL, '31', NULL, 'CoyoacÃ¡n', 'SOLTERO', '0', 'SIN EMPLEO', '5538835195', 'anclarke27@hotmail.com', '0', 'MAESTRIA', 'UNIVERSITY OF BATH', 'CIENCIA INTERNACIONAL', 25000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-16', '12:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 8, 9, 0, 9, 9, 0, NULL, NULL, NULL, NULL, NULL, 8, 9, 8, NULL, NULL, NULL, NULL, 52, NULL, '', 'Seguridad', 'Interpersonal', NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 'Promedio', NULL, NULL, NULL, NULL, NULL, NULL, '', 100, 'Superior'),
(90, NULL, '2019-01-16', 'Paloma Razo', 'ABRIL BEZEC', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5516951659', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'VINCUVENTAS', '', 'CITA', '2019-01-16', '13:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(91, NULL, '2019-01-16', 'Paloma Razo', 'Alejandro MaximilianoÂ Ronquil', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5585344704', 'Â max_ronquillo1997@hotmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'VINCUVENTAS', '', 'CITA', '2019-01-16', '15:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(92, NULL, '2019-01-17', 'Alan Soto', 'Ariana Yareli Fuentes Vazquez', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '552569455', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-16', '09:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(93, NULL, '2019-01-17', 'Alan Soto', 'BALDERAS ROSADO PARIS IVAN', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '556359513', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-16', '10:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(95, NULL, '2019-01-17', 'Alan Soto', 'Sandra Cervantes Islas', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5533991659', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-16', '11:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(96, NULL, '2019-01-17', 'Alan Soto', 'Edna Belen Torres Piedras', '', NULL, '36', NULL, 'Otro', 'SOLTERO', '1', 'EMPLEADA ', '5542503456', '', 'Auto', 'LICENCIATURA CONCLUIDA', 'UNIVERSIDAD DE LONDRES', 'LAE', 35000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-16', '00:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 8, 6, 0, 7, 8, 0, NULL, NULL, NULL, NULL, NULL, 7, 7, 7, NULL, NULL, NULL, NULL, 43, NULL, 'Movilidad', 'Seguridad', 'Analitico', NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 'Promedio', NULL, NULL, NULL, NULL, NULL, NULL, '', 102, 'Superior'),
(97, NULL, '2019-01-17', 'Alan Soto', 'Niria YaÃ±ez Morales', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '558418330', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-17', '11:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(98, NULL, '2019-01-17', 'Alan Soto', 'ANGELICA HITA REYES', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5523254743', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-17', '00:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(99, NULL, '2019-01-17', 'Alan Soto', 'Medellin Cisneros Alejandra Pa', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5568020464', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-17', '10:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(100, NULL, '2019-01-17', 'Alan Soto', ' Varinka Areli', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5532532238', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-17', '01:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(101, NULL, '2019-01-17', 'Alan Soto', 'Ilse Espinosa', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5611235653', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-17', '04:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(104, NULL, '2019-01-17', 'Alan Soto', 'ANA PATSY MORA LINARES', '', NULL, '', NULL, 'null', 'null', '', '', '5511386688', '', '0', 'null', '', '', 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-16', '04:00:00', 'Si', NULL, NULL, NULL, 'null', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(105, NULL, '2019-01-17', 'Alan Soto', 'TREBOL MURO CONTRERAS', '', NULL, '', NULL, 'null', 'null', '', '', '5529118386', '', '0', 'null', '', '', 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-15', '14:00:00', 'Si', NULL, NULL, NULL, 'null', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(110, NULL, '2019-01-18', 'Paloma Razo', 'YAZMIN ALBA MARTINEZ', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5540368021', 'yazalbam@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-17', '09:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(111, NULL, '0000-00-00', 'Paloma Razo', 'TANIAÂ GUTIERREZ', '', NULL, '31', NULL, 'Tlalpan', 'CASADO/UNION LIBRE', '0', 'REDES DE MERCADEO', '5535571238', 'tanis.jan.go@gmail.comÂ ', '0', 'LICENCIATURA CONCLUIDA', 'IPN', 'INGENIERIA EN COMUNICACIONES', 30000, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-17', '10:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 9, 9, 0, 9, 8, 0, NULL, NULL, NULL, NULL, NULL, 7, 9, 8, NULL, NULL, NULL, NULL, 52, NULL, '', 'Seguridad', 'Analitico', NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 'Promedio', NULL, NULL, NULL, NULL, NULL, NULL, '', 95, 'Aceptable'),
(115, NULL, '2019-01-21', 'Paloma Razo', 'JESUS BERNARDO ZACARIAS GALIND', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5540287708', 'jesuszacarias.g@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-17', '11:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(116, NULL, '2019-01-21', 'Paloma Razo', 'MADELEINEÂ ZETINA', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5565044764', 'zetinamade@gmail.comÂ Â ', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-17', '12:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(117, NULL, '0000-00-00', 'Paloma Razo', 'Susan Pamela Constantino Mendo', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5582277776', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-18', '10:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(118, NULL, '0000-00-00', 'Paloma Razo', 'Arturo Ivan Zamora Resendiz', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5529723997', 'arturoi115@hotmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BUMERAN', '', 'CITA', '2019-01-18', '11:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(119, NULL, '0000-00-00', 'Paloma Razo', 'ESTEFANY OCHOA', '', NULL, '24', NULL, 'Otro', 'SOLTERO', '0', 'SIN TRABAJO', '5526764878', 'dayiiz94@icloud.com', 'Auto', 'MAESTRIA', 'UNIVDEP', 'PLANEACIÃ“N FINANCIERA', 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-18', '12:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(120, NULL, '0000-00-00', 'Paloma Razo', 'Carlos Andres Caminos Chaine', '', NULL, '28', NULL, 'Xochimilco', 'SOLTERO', '0', 'VALUADOR', '5552142533', 'caminos.cacc4@gmail.com', 'Auto', 'MAESTRIA', 'MARISTA', 'INGENIERIA PROYECTOS', 20000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-18', '13:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(121, NULL, '2019-01-22', 'Paloma Razo', 'Glenda Flor Orozco Araujo', '', NULL, '36', NULL, 'Alvaro ObregÃ³n', 'SOLTERO', '0', 'SIN TRABAJO', '7224262981', 'orozco.glenda@gmail.com', 'Auto', 'MAESTRIA', 'UNID', 'TECNOLOGIA DE LA INFORMACIÃ“N', 32000, NULL, NULL, 'OTRO', '', 'CITA', '2019-01-21', '11:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 9, 8, 0, 8, 8, 0, NULL, NULL, NULL, NULL, NULL, 7, 8, 8, NULL, NULL, NULL, NULL, 49, NULL, '', 'Seguridad', 'Analitico', NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 'Promedio', NULL, NULL, NULL, NULL, NULL, NULL, '', 100, 'Superior'),
(122, NULL, '2019-01-22', 'Paloma Razo', 'Alejandro GÃ³mez Caballero', '', NULL, '26', NULL, 'TlÃ¡huac', 'SOLTERO', '0', 'ANALISTA DE RESERVAS', '5564637178', 'alejandro-gomez15@hotmail.com', 'Auto', 'LINCENCIATURA TRUNCA mÃ¡s del 70%', 'UNAM', 'ACTUARIA', 13000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-22', '08:00:00', 'Si', NULL, NULL, NULL, 'Menos de 6 hora', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(123, NULL, '2019-01-17', 'Alan Soto', 'Miguel Angel Alcantar Ortiz', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5543526656', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-23', '09:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(124, NULL, '2019-01-17', 'Alan Soto', 'Eder GonzÃ¡lez landin', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-23', '10:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(125, NULL, '2019-01-22', 'Alan Soto', 'ANDREA VILLARROEL', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-23', '13:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(126, NULL, '2019-01-22', 'Alan Soto', 'EDNA ESTELA DALIT HERNÃNDEZ S', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5515076515', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-23', '11:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(127, NULL, '2019-01-22', 'Alan Soto', 'MARÃA FERNANDA GUTIÃ‰RREZ RUI', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5525200764', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-23', '12:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(128, NULL, '2019-01-22', 'Alan Soto', 'VARINIA LOPEZ RIQUELME', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-23', '15:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, 'Aceptado', 'Si', 'Aceptado', '2019-01-31', NULL, 'Si', NULL, NULL, NULL, 'Si llego', NULL, NULL, NULL, NULL, NULL, 'Martin', 'Es bueno', 'U lala seÃ±or frances', 0, ''),
(129, NULL, '2019-01-20', 'Alan Soto', 'SANDRA PATRICIA DIAZ DELGADO', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-21', '10:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(130, NULL, '2019-01-20', 'Alan Soto', 'MILDRED JUAREZ', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-21', '03:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(131, NULL, '2019-01-20', 'Alan Soto', 'ALEJANDRA RIVERA', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-21', '10:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(132, NULL, '2019-01-20', 'Alan Soto', 'EMMA NAVARRO', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-21', '00:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(133, NULL, '2019-01-20', 'Alan Soto', 'LIZETH ISIDRO ', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-21', '04:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(135, NULL, '2019-01-22', 'Paloma Razo', 'Alejandra Rivera', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5537364989', 'alexa_lamb_rivera@yahoo.com.mx', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'BOLSA ROSA', '', 'CITA', '2019-01-22', '10:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(136, NULL, '2019-01-22', 'Paloma Razo', 'Nancy Cecilia Gutierrez Estrad', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '5525927022', 'ncycge@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-22', '11:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(137, NULL, '0000-00-00', 'Paloma Razo', 'Ricardo Alexis Lopez Jurado', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'ricardo_lopez94@hotmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'OCC', '', 'CITA', '2019-01-22', '12:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(138, NULL, '0000-00-00', 'Paloma Razo', 'Ricardo JosÃ© Hinojosa Martine', '', NULL, '27', NULL, 'Cuajimalpa de Morelos', 'SOLTERO', '0', 'EN BUSQUEDA', '9981300371', 'r_jhm@hotmail.com', 'Auto', 'LINCENCIATURA TRUNCA mÃ¡s del 70%', 'ANAHUAC', 'AMINISTRACIÃ“N DE EMPRESAS', 19000, NULL, NULL, 'OCC', '', 'CITA', '2019-01-22', '01:00:00', 'Si', NULL, NULL, NULL, 'Mas de 6 horas', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(139, NULL, '0000-00-00', 'Paloma Razo', 'Nancy LizethÂ Garcia Moreno', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '7223740190', 'nancylizeth80@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'VINCUVENTAS', '', 'CITA', '2019-01-22', '15:00:00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `user`, `password`, `tipo`) VALUES
(12, 'Alan Soto', '$2y$10$AOBsbvGWO9sJ6JU/C8q0fuR7DZyCybmXlPVKIE3QTs/E4ORzDyGrO', '2'),
(13, 'Paloma Razo', '$2y$10$92WHS0mcKadIYtuDDO/EQuRKsuDAbZAXONUjRj8Z.N94f0kLIGLIK', '2'),
(14, 'Virsayit Rocha', '$2y$10$6dHUfi2lwnhW5klGE8SIbeLs/VdyjwqzBvUIKPrI3FR0bq51ZR6ae', '2'),
(15, 'Miguel Garcia', '$2y$10$zXqeqY9617BRS3P6iAI3xu1yF7/2d2Fy2KLtWLEFg0JNt/OEyD/gq', '1'),
(35, 'Alexis Martinez', '$2y$10$XWzTTEE0Ik2SwMj8aiIwLeuv9bQKNcqxV2t4FS8Yenzv3HgFccqxW', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metas`
--

CREATE TABLE `metas` (
  `nombre` varchar(20) NOT NULL,
  `contactos_meta_mensual` int(11) NOT NULL,
  `contactos_meta_trimestral` int(11) NOT NULL,
  `contactos_meta_anual` int(11) NOT NULL,
  `citas_meta_mensual` int(11) DEFAULT NULL,
  `citas_meta_trimestral` int(11) NOT NULL,
  `citas_meta_anual` int(11) NOT NULL,
  `venta_meta_mensual` int(11) NOT NULL,
  `venta_meta_trimestral` int(11) NOT NULL,
  `venta_meta_anual` int(11) NOT NULL,
  `arranques_meta_mensual` int(11) NOT NULL,
  `arranques_meta_trimestral` int(11) NOT NULL,
  `arranques_meta_anual` int(11) NOT NULL,
  `conexion_meta_mensual` int(11) NOT NULL,
  `conexion_meta_trimestral` int(11) NOT NULL,
  `conexion_meta_anual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `metas`
--

INSERT INTO `metas` (`nombre`, `contactos_meta_mensual`, `contactos_meta_trimestral`, `contactos_meta_anual`, `citas_meta_mensual`, `citas_meta_trimestral`, `citas_meta_anual`, `venta_meta_mensual`, `venta_meta_trimestral`, `venta_meta_anual`, `arranques_meta_mensual`, `arranques_meta_trimestral`, `arranques_meta_anual`, `conexion_meta_mensual`, `conexion_meta_trimestral`, `conexion_meta_anual`) VALUES
('Todos', 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80),
('Alan Soto', 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80),
('Paloma Razo', 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80),
('', 0, 0, 0, 0, 0, 0, 80, 80, 80, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metas1`
--

CREATE TABLE `metas1` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `contactos_meta_mensual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `metas1`
--

INSERT INTO `metas1` (`id`, `nombre`, `contactos_meta_mensual`) VALUES
(0, 'Todos', 5),
(1, 'Todos', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pp200`
--

CREATE TABLE `pp200` (
  `id` int(11) NOT NULL,
  `resultado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pp200`
--

INSERT INTO `pp200` (`id`, `resultado`) VALUES
(1, '>200'),
(2, '<200'),
(3, '200');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntuacion`
--

CREATE TABLE `puntuacion` (
  `id_puntuacion` int(11) NOT NULL,
  `puntuacion` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puntuacion`
--

INSERT INTO `puntuacion` (`id_puntuacion`, `puntuacion`) VALUES
(1, '0'),
(2, '1'),
(3, '2'),
(4, '3'),
(5, '4'),
(6, '5'),
(7, '6'),
(8, '7'),
(9, '8'),
(10, '9'),
(11, '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rendimiento`
--

CREATE TABLE `rendimiento` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rendimiento`
--

INSERT INTO `rendimiento` (`id`, `resultado`) VALUES
(1, 'INFERIOR AL PROMEDIO'),
(2, 'PROMEDIO'),
(3, 'SUPERIOR AL PROMEDIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado_gerente`
--

CREATE TABLE `resultado_gerente` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `resultado_gerente`
--

INSERT INTO `resultado_gerente` (`id`, `resultado`) VALUES
(1, 'ACEPTADO'),
(2, 'RECHAZADO'),
(3, 'NO LLEGO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resul_llamada`
--

CREATE TABLE `resul_llamada` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `resul_llamada`
--

INSERT INTO `resul_llamada` (`id`, `resultado`) VALUES
(1, 'CITA'),
(2, 'EXTRANJERO'),
(3, 'LABORANDO'),
(4, 'LE LLAMÓ OTRO EDAT'),
(5, 'NO LE INTERESA'),
(6, 'NO CUBRE EDAD'),
(7, 'NO CUBRE ESCOLARIDAD'),
(8, 'SUELDO BASE'),
(9, 'QUIERE PRESTACIONES'),
(10, 'OTROS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiempo_disp`
--

CREATE TABLE `tiempo_disp` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiempo_disp`
--

INSERT INTO `tiempo_disp` (`id`, `resultado`) VALUES
(1, '+ 6 horas'),
(2, '- 6 horas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE `transporte` (
  `id` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transporte`
--

INSERT INTO `transporte` (`id`, `resultado`) VALUES
(1, 'AUTO'),
(2, 'MOTO'),
(3, 'TRANSPORTE PUBLICO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validez`
--

CREATE TABLE `validez` (
  `id` int(11) NOT NULL,
  `validez` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `validez`
--

INSERT INTO `validez` (`id`, `validez`) VALUES
(1, 'Seguro'),
(2, 'Precavido'),
(3, 'Exagerado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignados`
--
ALTER TABLE `asignados`
  ADD PRIMARY KEY (`id_asig`),
  ADD KEY `id_agente` (`id_agente`),
  ADD KEY `id_gerente` (`id_gerente`);

--
-- Indices de la tabla `cantidades`
--
ALTER TABLE `cantidades`
  ADD PRIMARY KEY (`id_cantidad`);

--
-- Indices de la tabla `colchon`
--
ALTER TABLE `colchon`
  ADD PRIMARY KEY (`id_colchon`);

--
-- Indices de la tabla `conexion`
--
ALTER TABLE `conexion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cubre_perfil`
--
ALTER TABLE `cubre_perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `decision`
--
ALTER TABLE `decision`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `edat`
--
ALTER TABLE `edat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `edo_civil`
--
ALTER TABLE `edo_civil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escolaridad`
--
ALTER TABLE `escolaridad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estilo_venta`
--
ALTER TABLE `estilo_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `experiencia`
--
ALTER TABLE `experiencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fuente`
--
ALTER TABLE `fuente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gerentes`
--
ALTER TABLE `gerentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `interesado`
--
ALTER TABLE `interesado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `knowout`
--
ALTER TABLE `knowout`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `llenado`
--
ALTER TABLE `llenado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `llenado_formulario`
--
ALTER TABLE `llenado_formulario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metas1`
--
ALTER TABLE `metas1`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pp200`
--
ALTER TABLE `pp200`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  ADD PRIMARY KEY (`id_puntuacion`);

--
-- Indices de la tabla `rendimiento`
--
ALTER TABLE `rendimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resultado_gerente`
--
ALTER TABLE `resultado_gerente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resul_llamada`
--
ALTER TABLE `resul_llamada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tiempo_disp`
--
ALTER TABLE `tiempo_disp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `validez`
--
ALTER TABLE `validez`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cantidades`
--
ALTER TABLE `cantidades`
  MODIFY `id_cantidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `colchon`
--
ALTER TABLE `colchon`
  MODIFY `id_colchon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `conexion`
--
ALTER TABLE `conexion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cubre_perfil`
--
ALTER TABLE `cubre_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `decision`
--
ALTER TABLE `decision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `edat`
--
ALTER TABLE `edat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `edo_civil`
--
ALTER TABLE `edo_civil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `escolaridad`
--
ALTER TABLE `escolaridad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estilo_venta`
--
ALTER TABLE `estilo_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `experiencia`
--
ALTER TABLE `experiencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fuente`
--
ALTER TABLE `fuente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gerentes`
--
ALTER TABLE `gerentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `interesado`
--
ALTER TABLE `interesado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `llenado`
--
ALTER TABLE `llenado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `llenado_formulario`
--
ALTER TABLE `llenado_formulario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `pp200`
--
ALTER TABLE `pp200`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  MODIFY `id_puntuacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rendimiento`
--
ALTER TABLE `rendimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `resultado_gerente`
--
ALTER TABLE `resultado_gerente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `resul_llamada`
--
ALTER TABLE `resul_llamada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tiempo_disp`
--
ALTER TABLE `tiempo_disp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `transporte`
--
ALTER TABLE `transporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `validez`
--
ALTER TABLE `validez`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignados`
--
ALTER TABLE `asignados`
  ADD CONSTRAINT `asignados_ibfk_1` FOREIGN KEY (`id_agente`) REFERENCES `edat` (`id`),
  ADD CONSTRAINT `asignados_ibfk_2` FOREIGN KEY (`id_gerente`) REFERENCES `gerentes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
