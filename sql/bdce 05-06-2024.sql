-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2024 a las 14:23:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `gruposanguineo` varchar(10) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `carrera_id` int(11) DEFAULT NULL,
  `estado` varchar(80) DEFAULT NULL COMMENT 'Activo, Inactivo',
  `observacion` varchar(100) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `redes_sociales` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `fecha_nacimiento`, `gruposanguineo`, `persona_id`, `carrera_id`, `estado`, `observacion`, `fecha_ingreso`, `redes_sociales`) VALUES
(20, '0000-00-00', 'rh+', 2, 1, 'Activo', 'curso de asistente', '2024-05-29', ''),
(21, '0000-00-00', 'rh+', 21, 3, 'Activo', '', '2024-05-30', ''),
(22, '0000-00-00', 'rh+', 21, 2, 'Activo', '', '2024-05-30', ''),
(25, '2007-06-03', 'rh+', 37, 1, 'Activo', '', '2024-06-04', 'asdasdasd@facebook'),
(29, '2024-06-03', 'rh+', 38, 4, 'Activo', '', '2024-06-04', 'asdasdasd@facebook');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_carrera_cuotas`
--

CREATE TABLE `alumno_carrera_cuotas` (
  `id` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `carrera_id` int(11) DEFAULT NULL,
  `cuota_numero` int(11) DEFAULT NULL,
  `monto` decimal(18,2) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL COMMENT 'Pagado - Impago',
  `fecha_vencimiento` date DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `detalle` varchar(60) DEFAULT NULL COMMENT 'Inscripcion - CuotaNº',
  `usuario` varchar(30) DEFAULT NULL COMMENT 'nombre de usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumno_carrera_cuotas`
--

INSERT INTO `alumno_carrera_cuotas` (`id`, `alumno_id`, `carrera_id`, `cuota_numero`, `monto`, `estado`, `fecha_vencimiento`, `fecha_pago`, `detalle`, `usuario`) VALUES
(1, 20, 1, 0, 222.00, 'PAGADO', '0001-01-01', '0001-01-01 00:00:00', 'Inscripción', NULL),
(2, 20, 1, 1, 20000.00, 'PAGADO', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 1', NULL),
(3, 20, 1, 2, 20000.00, 'PAGADO', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 2', NULL),
(4, 20, 1, 3, 20000.00, 'PAGADO', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 3', NULL),
(5, 20, 1, 4, 20000.00, 'PAGADO', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 4', NULL),
(6, 20, 1, 5, 20000.00, 'PAGADO', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 5', NULL),
(7, 20, 1, 6, 20000.00, 'PAGADO', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 6', NULL),
(8, 20, 1, 7, 20000.00, 'PAGADO', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 7', NULL),
(9, 20, 1, 8, 20000.00, 'PAGADO', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 8', NULL),
(10, 20, 1, 9, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 9', NULL),
(11, 20, 1, 10, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 10', NULL),
(12, 21, 3, 0, 444.00, 'PAGADO', '0001-01-01', '0001-01-01 00:00:00', 'Inscripción', NULL),
(13, 21, 3, 1, 10000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 1', NULL),
(14, 21, 3, 2, 10000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 2', NULL),
(15, 21, 3, 3, 10000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 3', NULL),
(16, 21, 3, 4, 10000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 4', NULL),
(17, 21, 3, 5, 10000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 5', NULL),
(18, 21, 3, 6, 10000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 6', NULL),
(19, 21, 3, 7, 10000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 7', NULL),
(20, 21, 3, 8, 10000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 8', NULL),
(21, 21, 3, 9, 10000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 9', NULL),
(22, 21, 3, 10, 10000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 10', NULL),
(23, 22, 2, 0, 333.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Inscripción', NULL),
(24, 22, 2, 1, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 1', NULL),
(25, 22, 2, 2, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 2', NULL),
(26, 22, 2, 3, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 3', NULL),
(27, 22, 2, 4, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 4', NULL),
(28, 22, 2, 5, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 5', NULL),
(29, 22, 2, 6, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 6', NULL),
(30, 22, 2, 7, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 7', NULL),
(31, 22, 2, 8, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 8', NULL),
(32, 22, 2, 9, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 9', NULL),
(33, 22, 2, 10, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 10', NULL),
(34, 22, 2, 11, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 11', NULL),
(35, 22, 2, 12, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01 00:00:00', 'Cuota Nº 12', NULL),
(58, 25, 1, 0, 250.00, 'IMPAGA', '0001-01-01', NULL, 'Inscripción', NULL),
(59, 25, 1, 1, 20000.00, 'IMPAGA', '0001-01-01', NULL, 'Cuota Nro 1', NULL),
(60, 25, 1, 2, 20000.00, 'IMPAGA', '0001-01-01', NULL, 'Cuota Nro 2', NULL),
(61, 25, 1, 3, 20000.00, 'IMPAGA', '0001-01-01', NULL, 'Cuota Nro 3', NULL),
(62, 25, 1, 4, 20000.00, 'IMPAGA', '0001-01-01', NULL, 'Cuota Nro 4', NULL),
(63, 25, 1, 5, 20000.00, 'IMPAGA', '0001-01-01', NULL, 'Cuota Nro 5', NULL),
(64, 25, 1, 6, 20000.00, 'IMPAGA', '0001-01-01', NULL, 'Cuota Nro 6', NULL),
(65, 25, 1, 7, 20000.00, 'IMPAGA', '0001-01-01', NULL, 'Cuota Nro 7', NULL),
(66, 25, 1, 8, 20000.00, 'IMPAGA', '0001-01-01', NULL, 'Cuota Nro 8', NULL),
(67, 25, 1, 9, 20000.00, 'IMPAGA', '0001-01-01', NULL, 'Cuota Nro 9', NULL),
(68, 25, 1, 10, 20000.00, 'IMPAGA', '0001-01-01', NULL, 'Cuota Nro 10', NULL),
(70, 29, 4, 0, 1500.00, 'PAGADO', '2024-06-04', NULL, 'Inscripción', NULL),
(71, 29, 4, 1, 20000.00, 'IMPAGA', '2024-07-04', NULL, 'Cuota Nro 1', NULL),
(72, 29, 4, 2, 20000.00, 'IMPAGA', '2024-08-04', NULL, 'Cuota Nro 2', NULL),
(73, 29, 4, 3, 20000.00, 'IMPAGA', '2024-09-04', NULL, 'Cuota Nro 3', NULL),
(74, 29, 4, 4, 20000.00, 'IMPAGA', '2024-10-04', NULL, 'Cuota Nro 4', NULL),
(75, 29, 4, 5, 20000.00, 'IMPAGA', '2024-11-04', NULL, 'Cuota Nro 5', NULL),
(76, 29, 4, 6, 20000.00, 'IMPAGA', '2024-12-04', NULL, 'Cuota Nro 6', NULL),
(77, 29, 4, 7, 20000.00, 'IMPAGA', '2025-01-04', NULL, 'Cuota Nro 7', NULL),
(78, 29, 4, 8, 20000.00, 'IMPAGA', '2025-02-04', NULL, 'Cuota Nro 8', NULL),
(79, 29, 4, 9, 20000.00, 'IMPAGA', '2025-03-04', NULL, 'Cuota Nro 9', NULL),
(80, 29, 4, 10, 20000.00, 'IMPAGA', '2025-04-04', NULL, 'Cuota Nro 10', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `fecha_apertura` datetime DEFAULT NULL,
  `ingreso_total` decimal(16,2) DEFAULT NULL,
  `egreso_total` decimal(16,2) DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL COMMENT 'Abierto o Cerrado',
  `saldo` decimal(16,2) DEFAULT NULL,
  `saldo_efectivo` decimal(16,2) DEFAULT NULL,
  `saldo_virtual` decimal(16,2) DEFAULT NULL,
  `dep_caja_fuerte` decimal(16,2) DEFAULT NULL,
  `dep_banco` decimal(16,2) DEFAULT NULL,
  `dep_mp` decimal(16,2) DEFAULT NULL,
  `dep_proxima_caja` decimal(16,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `fecha_apertura`, `ingreso_total`, `egreso_total`, `fecha_cierre`, `estado`, `saldo`, `saldo_efectivo`, `saldo_virtual`, `dep_caja_fuerte`, `dep_banco`, `dep_mp`, `dep_proxima_caja`) VALUES
(1, '2024-04-01 04:57:22', 6506.33, 1160.00, '2024-01-01 00:00:00', 'Abierta', 5346.33, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_operacion`
--

CREATE TABLE `caja_operacion` (
  `id` int(11) NOT NULL,
  `caja_id` int(11) DEFAULT NULL,
  `operacion` varchar(30) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `monto` decimal(8,2) DEFAULT NULL,
  `fechahora` datetime DEFAULT NULL,
  `detalle` varchar(60) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` int(11) NOT NULL,
  `nombre` varchar(90) DEFAULT NULL,
  `cantidad_cuotas` int(11) DEFAULT NULL,
  `costo_carrera` decimal(18,2) DEFAULT NULL,
  `inscripcion` decimal(18,2) DEFAULT NULL,
  `detalles` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`, `cantidad_cuotas`, `costo_carrera`, `inscripcion`, `detalles`) VALUES
(1, 'Asistente Grupo 1', 10, 200000.00, 250.00, 'de 8 a 13'),
(2, 'Tecnico Grupo 3', 12, 300000.00, 333.00, 'de 13 a 14'),
(3, 'Farmacia Grupo 2', 10, 100000.00, 444.00, 'De 17 a 18'),
(4, 'Higiene y Seguridad Grupo 1', 10, 200000.00, 1500.00, 'De 19 a 20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera_precios`
--

CREATE TABLE `carrera_precios` (
  `id` int(11) NOT NULL,
  `carrera_id` int(11) DEFAULT NULL,
  `detalle` varchar(90) DEFAULT NULL,
  `costo` decimal(18,2) DEFAULT NULL,
  `observacion` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrera_precios`
--

INSERT INTO `carrera_precios` (`id`, `carrera_id`, `detalle`, `costo`, `observacion`) VALUES
(1, 1, 'Inscripcion', 5000.00, NULL),
(2, 1, 'Cuota Mensual', 18000.00, NULL),
(3, 1, 'Certificado', 18000.00, NULL),
(4, 1, 'Otros Costos', 0.00, NULL),
(5, 2, 'Inscripcion', 300.00, NULL),
(6, 2, 'Cuota Mensual', 5000.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_permiso`
--

CREATE TABLE `detalle_permiso` (
  `id` int(11) NOT NULL,
  `rela_permiso` int(11) NOT NULL,
  `rela_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_permiso`
--

INSERT INTO `detalle_permiso` (`id`, `rela_permiso`, `rela_usuario`) VALUES
(29, 4, 1),
(30, 6, 1),
(31, 7, 1),
(32, 1, 1),
(50, 6, 2),
(51, 7, 2),
(52, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id` int(11) NOT NULL,
  `rela_persona` int(11) NOT NULL,
  `edad` int(11) NOT NULL,
  `titulacion` varchar(200) NOT NULL,
  `materias` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egreso`
--

CREATE TABLE `egreso` (
  `id` int(11) NOT NULL,
  `monto` decimal(18,2) DEFAULT NULL,
  `fecha_egreso` datetime DEFAULT NULL,
  `caja_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `egreso_tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `egreso`
--

INSERT INTO `egreso` (`id`, `monto`, `fecha_egreso`, `caja_id`, `usuario_id`, `egreso_tipo`) VALUES
(1, 1000.00, '2024-04-21 00:36:37', 1, 1, 2),
(2, 1500.00, '2024-04-21 00:37:17', 1, 1, 1),
(3, 1000.00, '2024-04-21 01:01:11', 1, 1, 3),
(4, 1500.00, '2024-04-21 03:18:08', 1, 1, 2),
(5, 660.00, '2024-05-15 13:13:16', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egreso_tipo`
--

CREATE TABLE `egreso_tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `egreso_tipo`
--

INSERT INTO `egreso_tipo` (`id`, `nombre`) VALUES
(1, 'Alquiler'),
(2, 'Pago de propagandas'),
(3, 'pago sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `id` int(11) NOT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  `fecha_ingreso` datetime DEFAULT NULL,
  `caja_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL COMMENT 'nombre del usuario',
  `ingreso_tipo_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `tipo_pago` varchar(20) DEFAULT NULL COMMENT 'Efectivo - Debito',
  `descuento` decimal(10,2) DEFAULT NULL COMMENT 'por pago efectivo y',
  `recargo` decimal(10,2) DEFAULT NULL COMMENT 'pago despues del 10',
  `origen` varchar(50) DEFAULT NULL COMMENT 'Alumno - Propio',
  `detalle` varchar(100) DEFAULT NULL COMMENT 'detalle del pago'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`id`, `monto`, `fecha_ingreso`, `caja_id`, `usuario_id`, `ingreso_tipo_id`, `alumno_id`, `tipo_pago`, `descuento`, `recargo`, `origen`, `detalle`) VALUES
(40, 0.00, '2024-05-14 00:00:00', 1, 1, 6, 12, 'EFECTIVO', 3800.00, 0.00, 'Alumno', 'Cuota Nï¿½ 1'),
(41, 16200.00, '2024-05-14 00:00:00', 1, 1, 6, 12, 'EFECTIVO', 3800.00, 0.00, 'Alumno', 'Cuota Nï¿½ 2'),
(42, 16200.00, '2024-05-14 00:00:00', 1, 1, 6, 12, 'EFECTIVO', 3800.00, 0.00, 'Alumno', 'Cuota Nï¿½ 3-Alumno'),
(43, 16200.00, '2024-05-14 00:00:00', 1, 1, 6, 12, 'EFECTIVO', 3800.00, 0.00, 'Alumno', 'Cuota Nï¿½ 4-Alumno'),
(44, 16200.00, '2024-05-14 00:00:00', 1, 1, 6, 12, 'EFECTIVO', 3800.00, 0.00, 'Alumno', 'Cuota Nï¿½ 5'),
(45, 16200.00, '2024-05-14 00:00:00', 1, 1, 6, 12, 'EFECTIVO', 3800.00, 0.00, 'Alumno', 'Cuota Nï¿½ 6'),
(46, 359.64, '2024-05-15 00:00:00', 1, 1, 6, 16, 'EFECTIVO', 84.36, 0.00, 'Alumno', 'Inscripción'),
(47, 1588.00, '2024-05-15 13:07:44', 1, 1, 1, 1, 'EFECTIVO', 0.00, 0.00, 'Socios', 'prueba de id'),
(48, 899.00, '2024-05-15 13:11:42', 1, 1, 7, 14, 'VIRTUAL', 0.00, 0.00, 'Alumno', ''),
(49, 9000.00, '2024-05-15 00:00:00', 1, 0, 6, 16, 'VIRTUAL', 1000.00, 0.00, 'Alumno', 'Cuota Nº 1'),
(50, 8100.00, '2024-05-15 00:00:00', 1, 0, 6, 16, 'EFECTIVO', 1900.00, 0.00, 'Alumno', 'Cuota Nº 3'),
(51, 10000.00, '2024-05-15 00:00:00', 1, 0, 6, 16, 'VIRTUAL', 0.00, 0.00, 'Alumno', 'Cuota Nº 5'),
(52, 9000.00, '2024-05-15 00:00:00', 1, 0, 6, 16, 'EFECTIVO', 1000.00, 0.00, 'Alumno', 'Cuota Nº 6'),
(53, 10000.00, '2024-05-15 00:00:00', 1, 0, 6, 16, 'VIRTUAL', 0.00, 0.00, 'Alumno', 'Cuota Nº 7'),
(54, 9000.00, '2024-05-15 00:00:00', 1, 0, 6, 16, 'EFECTIVO', 1000.00, 0.00, 'Alumno', 'Cuota Nº 10'),
(55, 18000.00, '2024-05-15 00:00:00', 1, 0, 6, 12, 'VIRTUAL', 2000.00, 0.00, 'Alumno', 'Cuota Nº 8'),
(56, 18000.00, '2024-05-15 00:00:00', 1, 0, 6, 12, 'VIRTUAL', 2000.00, 0.00, 'Alumno', 'Cuota Nº 9'),
(57, 20250.00, '2024-05-20 00:00:00', 1, 0, 6, 14, '', 4750.00, 0.00, 'Alumno', 'Cuota Nº 7'),
(58, 20250.00, '2024-05-20 00:00:00', 1, 0, 6, 14, '', 4750.00, 0.00, 'Alumno', 'Cuota Nº 8'),
(59, 225.50, '2024-05-20 00:00:00', 1, 0, 7, 14, 'EFECTIVO', 4750.00, 0.00, 'Alumno', 'Cuota Nº 9'),
(60, 20250.00, '2024-05-27 00:00:00', 1, 1, 6, 14, 'EFECTIVO', 4750.00, 0.00, 'Alumno', 'Cuota Nº 10'),
(61, 20250.00, '2024-05-27 00:00:00', 1, 1, 6, 14, 'EFECTIVO', 4750.00, 0.00, 'Alumno', 'Cuota Nº 11'),
(62, 20000.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 0.00, 0.00, 'Alumno', 'Cuota Nº 1'),
(63, 18000.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'EFECTIVO', 2000.00, 0.00, 'Alumno', 'Cuota Nº 2'),
(64, 10000.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 0.00, 0.00, 'Alumno', 'Cuota Nº 3'),
(65, 10000.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 0.00, 0.00, 'Alumno', 'Cuota Nº 3'),
(66, 5000.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 0.00, 0.00, 'Alumno', 'Cuota Nº 4'),
(67, 16000.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 0.00, 0.00, 'Alumno', 'Cuota Nº 4'),
(68, 15000.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 0.00, 0.00, 'Alumno', 'Cuota Nº 5'),
(69, 5000.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 0.00, 0.00, 'Alumno', 'Cuota Nº 5'),
(70, 13500.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'EFECTIVO', 1500.00, 0.00, 'Alumno', 'Cuota Nº 6'),
(71, 4050.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'EFECTIVO', 950.00, 0.00, 'Alumno', 'Cuota Nº 6'),
(72, 9000.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'EFECTIVO', 1000.00, 0.00, 'Alumno', 'Cuota Nº 7'),
(73, 9000.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 1000.00, 0.00, 'Alumno', 'Cuota Nº 7'),
(74, 10800.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 1200.00, 0.00, 'Alumno', 'Cuota Nº 8'),
(75, 4050.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'EFECTIVO', 950.00, 0.00, 'Alumno', 'Cuota Nº 8'),
(76, 2250.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'EFECTIVO', 250.00, 0.00, 'Alumno', 'Cuota Nº 8'),
(77, 90.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 10.00, 0.00, 'Alumno', 'Cuota Nº 8'),
(78, 300.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 0.00, 0.00, 'Alumno', 'Cuota Nº 8'),
(79, 40.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'EFECTIVO', 10.00, 0.00, 'Alumno', 'Cuota Nº 8'),
(80, 180.00, '2024-05-30 00:00:00', 1, 1, 6, 21, 'VIRTUAL', 20.00, 0.00, 'Alumno', 'Inscripción'),
(81, 198.00, '2024-05-30 00:00:00', 1, 1, 6, 21, 'EFECTIVO', 46.00, 0.00, 'Alumno', 'Inscripción'),
(82, 1000.00, '2024-05-30 16:54:14', 1, 1, 2, 20, 'EFECTIVO', 0.00, 0.00, 'Alumno', 'Pago a cuenta Certificado'),
(83, 50.00, '2024-05-30 00:00:00', 1, 1, 6, 20, 'VIRTUAL', 0.00, 0.00, 'Alumno', 'Cuota Nº 8'),
(84, 1350.00, '2024-06-04 00:00:00', 1, 1, 6, 29, 'EFECTIVO', 150.00, 0.00, 'Alumno', 'Inscripción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_tipo`
--

CREATE TABLE `ingreso_tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingreso_tipo`
--

INSERT INTO `ingreso_tipo` (`id`, `nombre`) VALUES
(1, 'Aporte externo de socios'),
(2, 'Certificado'),
(6, 'Varios'),
(7, 'Recargo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_parciales`
--

CREATE TABLE `pagos_parciales` (
  `id` int(13) NOT NULL,
  `rela_cuota` int(11) NOT NULL,
  `descuento_tp` decimal(18,2) NOT NULL,
  `descuento_a10` decimal(18,2) NOT NULL,
  `pago` decimal(18,2) NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos_parciales`
--

INSERT INTO `pagos_parciales` (`id`, `rela_cuota`, `descuento_tp`, `descuento_a10`, `pago`, `fecha_pago`, `usuario`) VALUES
(1, 1, 0.00, 0.00, 222.00, '2024-05-30 02:00:09', '1'),
(2, 2, 0.00, 0.00, 20000.00, '2024-05-30 02:02:22', '1'),
(3, 3, 2000.00, 0.00, 18000.00, '2024-05-30 02:03:59', '1'),
(4, 4, 0.00, 0.00, 10000.00, '2024-05-30 02:05:15', '1'),
(5, 4, 0.00, 0.00, 10000.00, '2024-05-30 02:06:57', '1'),
(6, 5, 0.00, 0.00, 5000.00, '2024-05-30 02:18:46', '1'),
(7, 5, 0.00, 0.00, 15000.00, '2024-05-30 02:19:31', '1'),
(8, 6, 0.00, 0.00, 15000.00, '2024-05-30 02:23:30', '1'),
(9, 6, 0.00, 0.00, 5000.00, '2024-05-30 02:24:33', '1'),
(10, 7, 1500.00, 0.00, 13500.00, '2024-05-30 02:25:17', '1'),
(11, 7, 500.00, 450.00, 4050.00, '2024-05-30 02:27:54', '1'),
(12, 8, 1000.00, 0.00, 9000.00, '2024-05-30 02:34:52', '1'),
(13, 8, 0.00, 1000.00, 9000.00, '2024-05-30 02:35:21', '1'),
(14, 9, 0.00, 1200.00, 10800.00, '2024-05-30 02:43:47', '1'),
(15, 9, 500.00, 450.00, 4050.00, '2024-05-30 02:44:17', '1'),
(16, 9, 250.00, 0.00, 2250.00, '2024-05-30 13:18:33', '1'),
(17, 9, 0.00, 10.00, 90.00, '2024-05-30 13:19:11', '1'),
(18, 9, 0.00, 0.00, 300.00, '2024-05-30 13:22:13', '1'),
(19, 9, 5.00, 5.00, 40.00, '2024-05-30 13:57:55', '1'),
(20, 12, 0.00, 20.00, 180.00, '2024-05-30 14:05:07', '1'),
(21, 12, 24.00, 22.00, 198.00, '2024-05-30 14:05:24', '1'),
(22, 9, 0.00, 0.00, 50.00, '2024-05-30 17:03:44', '1'),
(23, 70, 150.00, 0.00, 1350.00, '2024-06-04 00:32:07', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `nombre`) VALUES
(3, 'ALUMNOS'),
(4, 'CAJA'),
(6, 'CURSOS'),
(7, 'EGRESOS'),
(5, 'OTROS INGRESOS'),
(2, 'PERSONAS'),
(8, 'TIPOS EGRESOS'),
(1, 'USUARIOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `apellidonombre` varchar(30) NOT NULL,
  `dni` int(11) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `cel1` varchar(11) NOT NULL,
  `cel2` varchar(11) NOT NULL,
  `mail` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `apellidonombre`, `dni`, `domicilio`, `cel1`, `cel2`, `mail`) VALUES
(1, 'Instituto CE', 999, 'mendoza', '', '', ''),
(2, 'perez jose', 22705502, 'sdfdsf', '324234324', '11', 'gfdg@sdasd'),
(20, 'Yalardo Juan', 22708505, 'san juan- rivadavia', '24646546556', '', ''),
(21, 'yanzon mauricio', 22705501, 'b ucc', '2645056361', '5555555', 'mauricioyan@hotmail.com'),
(34, 'asdasdewrewr', 227055088, 'asdsad', '', '', ''),
(36, 'alumno nuevo', 22705503, 'sdfsdf', '', '', ''),
(37, 'Yornet Adolfo', 22705505, 'b uccatolica sdfsdf', '2648895623', '', ''),
(38, 'Josefa', 2270508, 'no lo se todavia', '', '', ''),
(39, 'fgfdgdfg', 22705509, 'dfgdfgdfgfdg', '', '', ''),
(40, 'si anda', 22705506, 'no lo se', '', '', ''),
(41, 'perez toadeo', 123456, 'sdfsdfsdfsdf', '', '', ''),
(42, 'perz danilo', 22705508, 'sdfsdfsdfsd', '', '', ''),
(43, 'josefa fff', 21705501, 'dfgfdgdfgfdg', '', '', ''),
(44, 'Antonia', 47903403, 'rivadavia', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `rela_persona` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '0 inactivo y 1 activo',
  `fechaingreso` datetime NOT NULL DEFAULT '2024-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `rela_persona`, `usuario`, `pass`, `estado`, `fechaingreso`) VALUES
(1, 21, 'admin', '202cb962ac59075b964b07152d234b70', 1, '2024-01-01 00:00:00'),
(2, 44, 'venta', '81d0d58d3b7e35bc6a6f3ad7fc5563af', 1, '2024-06-05 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `relapersonacurso` (`persona_id`,`carrera_id`) USING BTREE;

--
-- Indices de la tabla `alumno_carrera_cuotas`
--
ALTER TABLE `alumno_carrera_cuotas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_operacion`
--
ALTER TABLE `caja_operacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrera_precios`
--
ALTER TABLE `carrera_precios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_permiso`
--
ALTER TABLE `detalle_permiso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relapermiso` (`rela_permiso`),
  ADD KEY `relausuario` (`rela_usuario`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `relapersona` (`rela_persona`);

--
-- Indices de la tabla `egreso`
--
ALTER TABLE `egreso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `egreso_tipo`
--
ALTER TABLE `egreso_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingreso_tipo`
--
ALTER TABLE `ingreso_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_parciales`
--
ALTER TABLE `pagos_parciales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_permiso` (`nombre`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apellidonombre` (`apellidonombre`) USING BTREE,
  ADD UNIQUE KEY `dniunico` (`dni`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rela_persona` (`rela_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `alumno_carrera_cuotas`
--
ALTER TABLE `alumno_carrera_cuotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `caja_operacion`
--
ALTER TABLE `caja_operacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `carrera_precios`
--
ALTER TABLE `carrera_precios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_permiso`
--
ALTER TABLE `detalle_permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `egreso`
--
ALTER TABLE `egreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `egreso_tipo`
--
ALTER TABLE `egreso_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `ingreso_tipo`
--
ALTER TABLE `ingreso_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pagos_parciales`
--
ALTER TABLE `pagos_parciales`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_permiso`
--
ALTER TABLE `detalle_permiso`
  ADD CONSTRAINT `detalle_permiso_ibfk_1` FOREIGN KEY (`rela_permiso`) REFERENCES `permiso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_permiso_ibfk_2` FOREIGN KEY (`rela_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`rela_persona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rela_persona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
