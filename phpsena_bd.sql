-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 13-05-2025 a las 17:39:58
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
-- Base de datos: `phpsena_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `pk_id_persona` int(11) NOT NULL,
  `pers_nombre` varchar(40) NOT NULL,
  `pers_telefono` varchar(15) NOT NULL,
  `pers_correo` varchar(50) NOT NULL,
  `pers_clave` varchar(255) NOT NULL,
  `pers_fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `fk_id_rol` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`pk_id_persona`, `pers_nombre`, `pers_telefono`, `pers_correo`, `pers_clave`, `pers_fecha_registro`, `fk_id_rol`) VALUES
(8, 'Germain', '3123456789', 'germainbarrera@gmail.com', '$2y$10$Yh9sbSvkob3KcsYBxXuIo./RR8JxxtOi14enZQll69j2Y8o2XtW0y', '2025-05-13 00:08:57', 3),
(9, 'Carlos', '3106067414', 'cabarrientos@sena.edu.co', '$2y$10$UmQzFTvgHz9Ka4HsPkJk.e/tuxgDDTKqCTovBoYOJUn2D2RnWHZ6a', '2025-05-13 00:38:50', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `pk_id_iproducto` int(11) NOT NULL,
  `prod_nombre` varchar(20) NOT NULL,
  `prod_cantidad` int(10) NOT NULL,
  `prod_precio` float NOT NULL,
  `prod_fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`pk_id_iproducto`, `prod_nombre`, `prod_cantidad`, `prod_precio`, `prod_fecha_registro`) VALUES
(1, 'Play', 1000, 1000000, '2025-05-05 18:37:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL COMMENT 'Ej: administrador, editor, invitado',
  `descripcion` varchar(255) DEFAULT NULL COMMENT 'Breve descripción del rol',
  `estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=activo, 0=inactivo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'administrador', 'Acceso total', 1, '2025-05-13 07:00:50', '2025-05-13 07:00:50'),
(2, 'editor', 'Puede crear y editar', 1, '2025-05-13 07:00:50', '2025-05-13 07:00:50'),
(3, 'invitado', 'Solo lectura', 1, '2025-05-13 07:00:50', '2025-05-13 07:00:50');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`pk_id_persona`),
  ADD KEY `fk_personas_rol` (`fk_id_rol`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`pk_id_iproducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `pk_id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `pk_id_iproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_personas_rol` FOREIGN KEY (`fk_id_rol`) REFERENCES `rol` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
