-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2024 a las 12:53:03
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
  `edad` int(11) NOT NULL,
  `gruposanguineo` varchar(10) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `carrera_id` int(11) DEFAULT NULL,
  `estado` varchar(80) DEFAULT NULL COMMENT 'Activo, Inactivo',
  `observacion` varchar(100) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `edad`, `gruposanguineo`, `persona_id`, `carrera_id`, `estado`, `observacion`, `fecha_ingreso`) VALUES
(1, 1, 'rh+', 1, 1, 'Activo', 'aportes', '2024-04-15'),
(12, 3, '3', 36, 1, 'Activo', 'prueba', '2024-04-14'),
(14, 18, 'rh+', 2, 2, 'Activo', 'inscirpcion', '2024-04-15');

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
  `fecha_pago` date DEFAULT NULL,
  `detalle` varchar(60) DEFAULT NULL COMMENT 'Inscripcion - CuotaNº'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumno_carrera_cuotas`
--

INSERT INTO `alumno_carrera_cuotas` (`id`, `alumno_id`, `carrera_id`, `cuota_numero`, `monto`, `estado`, `fecha_vencimiento`, `fecha_pago`, `detalle`) VALUES
(16, 12, 1, 0, 222.00, 'PAGADO', '0001-01-01', '2024-04-18', 'Inscripción'),
(17, 12, 1, 1, 20000.00, 'PAGADO', '0001-01-01', '2024-04-21', 'Cuota Nº 1'),
(18, 12, 1, 2, 20000.00, 'PAGADO', '0001-01-01', '2024-04-21', 'Cuota Nº 2'),
(19, 12, 1, 3, 20000.00, 'PAGADO', '0001-01-01', '2024-04-21', 'Cuota Nº 3'),
(20, 12, 1, 4, 20000.00, 'PAGADO', '0001-01-01', '2024-04-21', 'Cuota Nº 4'),
(21, 12, 1, 5, 20000.00, 'PAGADO', '0001-01-01', '2024-04-21', 'Cuota Nº 5'),
(22, 12, 1, 6, 20000.00, 'PAGADO', '0001-01-01', '2024-04-25', 'Cuota Nº 6'),
(23, 12, 1, 7, 20000.00, 'PAGADO', '0001-01-01', '2024-04-25', 'Cuota Nº 7'),
(24, 12, 1, 8, 20000.00, 'PAGADO', '0001-01-01', '2024-04-25', 'Cuota Nº 8'),
(25, 12, 1, 9, 20000.00, 'PAGADO', '0001-01-01', '2024-04-25', 'Cuota Nº 9'),
(26, 12, 1, 10, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 10'),
(27, 13, 1, 0, 222.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Inscripción'),
(28, 13, 1, 1, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 1'),
(29, 13, 1, 2, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 2'),
(30, 13, 1, 3, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 3'),
(31, 13, 1, 4, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 4'),
(32, 13, 1, 5, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 5'),
(33, 13, 1, 6, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 6'),
(34, 13, 1, 7, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 7'),
(35, 13, 1, 8, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 8'),
(36, 13, 1, 9, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 9'),
(37, 13, 1, 10, 20000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 10'),
(38, 14, 2, 0, 333.00, 'PAGADO', '0001-01-01', '2024-04-18', 'Inscripción'),
(39, 14, 2, 1, 25000.00, 'PAGADO', '0001-01-01', '2024-04-18', 'Cuota Nº 1'),
(40, 14, 2, 2, 25000.00, 'PAGADO', '0001-01-01', '2024-04-18', 'Cuota Nº 2'),
(41, 14, 2, 3, 25000.00, 'PAGADO', '0001-01-01', '2024-04-18', 'Cuota Nº 3'),
(42, 14, 2, 4, 25000.00, 'PAGADO', '0001-01-01', '2024-04-18', 'Cuota Nº 4'),
(43, 14, 2, 5, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 5'),
(44, 14, 2, 6, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 6'),
(45, 14, 2, 7, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 7'),
(46, 14, 2, 8, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 8'),
(47, 14, 2, 9, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 9'),
(48, 14, 2, 10, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 10'),
(49, 14, 2, 11, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 11'),
(50, 14, 2, 12, 25000.00, 'IMPAGA', '0001-01-01', '0001-01-01', 'Cuota Nº 12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `fecha_apertura` datetime DEFAULT NULL,
  `ingreso_total` decimal(8,2) DEFAULT NULL,
  `egreso_total` decimal(8,2) DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL COMMENT 'Abierto o Cerrado',
  `saldo` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `fecha_apertura`, `ingreso_total`, `egreso_total`, `fecha_cierre`, `estado`, `saldo`) VALUES
(1, '2024-04-01 04:57:22', 1563.00, 0.00, '2024-01-01 00:00:00', 'Abierta', 1563.00);

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
  `inscripcion` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`, `cantidad_cuotas`, `costo_carrera`, `inscripcion`) VALUES
(1, 'Asistente ', 10, 200000.00, 222.00),
(2, 'Tecnico', 12, 300000.00, 333.00),
(3, 'Farmacia', 10, 100000.00, 444.00);

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
(23, 1, 1);

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
(4, 1000.00, '2024-04-21 03:18:08', 1, 1, 2);

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
  `usuario_id` int(11) DEFAULT NULL,
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
(30, 1600.00, '2024-04-23 00:40:49', 1, 1, 1, 1, 'DEBITO', 0.00, 0.00, 'Socios', ''),
(31, 63.29, '2024-04-23 00:41:07', 1, 1, 2, 14, 'DEBITO', 0.00, 0.00, 'Alumno', ''),
(32, 20000.00, '2024-04-25 00:00:00', 1, 999, 6, 12, 'CONTADO', 0.00, 0.00, 'Alumno', 'Cuota Nº 6'),
(33, 20000.00, '2024-04-25 00:00:00', 1, 999, 6, 12, 'CONTADO', 0.00, 0.00, 'Alumno', 'Cuota Nº 7'),
(34, 20000.00, '2024-04-25 00:00:00', 1, 999, 6, 12, 'CONTADO', 0.00, 0.00, 'Alumno', 'Cuota Nº 8'),
(35, 20000.00, '2024-04-25 00:00:00', 1, 999, 6, 12, 'CONTADO', 0.00, 0.00, 'Alumno', 'Cuota Nº 9');

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
(2, 'Otros Ingresos'),
(6, 'Cuotas');

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
(2, 'PERSONAS'),
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
(36, 'alumno nuevo', 22705503, 'sdfsdf', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `rela_persona` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '0 inactivo y 1 activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `rela_persona`, `usuario`, `pass`, `estado`) VALUES
(1, 21, 'admin', '202cb962ac59075b964b07152d234b70', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `relapersona` (`persona_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `alumno_carrera_cuotas`
--
ALTER TABLE `alumno_carrera_cuotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `caja_operacion`
--
ALTER TABLE `caja_operacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `carrera_precios`
--
ALTER TABLE `carrera_precios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_permiso`
--
ALTER TABLE `detalle_permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `egreso`
--
ALTER TABLE `egreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `egreso_tipo`
--
ALTER TABLE `egreso_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `ingreso_tipo`
--
ALTER TABLE `ingreso_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
