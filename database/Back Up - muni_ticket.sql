-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2024 a las 04:06:10
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `muni_ticket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Informática', 'Área encargada de Tecnologías de la Información'),
(2, 'Personal', 'Área encargada de los Recursos Humanos'),
(3, 'Asesoria Legal', 'Área que se encarga de  los temas legales de la municipalidad'),
(4, 'Urbanistica', 'Área que se encarga del desarrollo del distrito'),
(5, 'Logistica', 'Área encargada de proveer a la municipalidad'),
(6, 'Mantenimiento y Limpieza', 'Área encargada del mantenimiento infraestructural y limpieza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, '0-User', 'Categoría de todo usuario que no es \"EMPLEADO\".'),
(14, 'Software', 'Atiende problemas con respecto a programas, S.O, etc(parte lógica).'),
(15, 'Hardware', 'Atiende problemas físicos, repuestos, etc.'),
(16, 'Redes', 'Atiende problemas de conexión dentro de la municipalidad.'),
(43, '1-Admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(255) NOT NULL,
  `id_ticket` int(255) DEFAULT NULL,
  `id_usuario` int(255) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_ticket`, `id_usuario`, `mensaje`, `fecha`, `hora`) VALUES
(1, 1, 2, 'Requiero la atención de este incidente lo mas antes posible.', '2023-11-23', '13:14:58'),
(2, 1, 3, 'Recibido, se atenderá su solicitud en breve.', '2023-11-23', '13:15:20'),
(61, 1, 22, 'se procedió a cerrar este ticket debido a que fue atendido en su momento.', '2024-01-29', '22:16:26'),
(63, 1, 3, 'Queda por cerrado el ticket', '2024-02-02', '22:24:01'),
(64, 2, 69, 'Su ticket fue atendido, favor de confirmar la solución.', '2024-02-02', '23:07:52'),
(65, 18, 69, 'Se atenderá este Ticket lo más antes posible.', '2024-02-02', '23:08:22'),
(66, 3, 56, 'Atender este soporte lo antes posible.', '2024-02-02', '23:17:37'),
(67, 4, 2, 'atender el siguiente soporte.', '2024-02-02', '23:18:10'),
(68, 18, 68, 'Estaré pendiente de la pronta solución.', '2024-02-02', '23:19:06'),
(73, 4, 22, 'Se informara con respecto a este problema', '2024-02-07', '18:35:16'),
(74, 2, 22, 'De no confirmar la solución las próximas 24 horas, se dará por entendido que ya se soluciono el incidente y se procederá a cerrar el ticket', '2024-02-07', '18:38:48'),
(75, 38, 2, 'Atender lo más pronto posible, gracias.', '2024-02-09', '01:38:15'),
(76, 38, 69, 'Empezare a resolver esto, le iré informando.', '2024-02-09', '01:39:41'),
(77, 38, 22, 'Atender lo más pronto posible, estaré pendiente del avance.', '2024-02-09', '01:49:14'),
(78, 38, 69, 'Problema Solucionado, favor de comprobar todo el sistema.\r\nInformar después de la comprobación a fin de cerrar el ticket.', '2024-02-09', '01:51:39'),
(79, 38, 2, 'Ya me anda normal el sistema, muchas gracias.', '2024-02-09', '02:03:05'),
(80, 38, 22, 'Alejandro, favor de proceder a cerrar el Ticket.', '2024-02-09', '02:03:49'),
(81, 38, 69, 'Debido a que se logro la solución, queda \"Cerrado\" este Soporte.', '2024-02-09', '02:04:30'),
(82, 18, 3, 'Debido a la Carga de Alejandro Pérez, mi persona se hará cargo de este Ticket, le Iré informando', '2024-02-09', '02:10:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(255) NOT NULL,
  `id_usuario` int(255) NOT NULL,
  `id_upersonal` int(255) DEFAULT NULL,
  `id_categoria` int(255) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `prioridad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `id_usuario`, `id_upersonal`, `id_categoria`, `asunto`, `descripcion`, `estado`, `fecha_ini`, `fecha_fin`, `prioridad`) VALUES
(1, 2, 3, 14, 'No abre Microsoft Word', 'Quiero redactar un informe y no se puede abrir el word.', 'CERRADO', '2024-01-12', '2024-02-09', NULL),
(2, 22, 69, 14, 'Prueba 01', 'Prueba 01 de registro de tickets', 'ATENDIDO', '2024-01-13', '2024-02-07', NULL),
(3, 56, 23, 15, 'Monitor no enciende', 'No enciende el monitor', 'PROCESO', '2024-01-19', '2024-02-07', NULL),
(4, 2, 83, 16, 'Sin acceso a internet', 'No puedo abrir la pagina de la municipalidad en mi ordenador', 'PROCESO', '2024-01-19', '2024-02-07', NULL),
(18, 68, 3, 14, 'No puedo abrir el Power Point', 'No puedo abrir el power point, lo necesito pronto para hacer una presentación para gerencia.', 'PROCESO', '2024-01-21', '2024-02-09', NULL),
(38, 2, 69, 14, 'Errores con el sistema de soporte', 'No cargan los estilos y se tienen problemas con el aplicativo!!!', 'CERRADO', '2024-02-09', '2024-02-09', NULL),
(55, 22, 83, 16, 'prueba10', 'Prueba10, prueba para la mejora del sistema, ahora no se podrá eliminar  en seguimiento', 'PENDIENTE', '2024-02-26', '2024-02-26', NULL),
(57, 2, 3, 14, 'Problemas al Generar el reporte', 'No puedo generar el reporte en pdf', 'PENDIENTE', '2024-03-16', '2024-03-16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `id_area` int(255) DEFAULT NULL,
  `id_categoria` int(255) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_area`, `id_categoria`, `nombre`, `apellidos`, `email`, `password`, `tipo`, `imagen`) VALUES
(2, 2, 1, 'Juan', 'Osorio', 'juan@osorio.com', '$2y$04$xS5i.COYxhQmQDc3JVbrTOJ9UrqjkwtAfTWcIyf4pGVith/vUnbmq', 'user', NULL),
(3, 1, 14, 'Pedro', 'Cruz', 'pedro@cruz.com', '$2y$04$TOJ.56X76WZu82cA.zXKfORGy3fRb6Sq/5y4URPi85GcrORoGzoO2', 'employed', 'ajio.jpg'),
(22, 1, 43, 'Victor', 'Poma', 'victor@poma.com', '$2y$04$KQj98cmYll.VqvwBjXl72OSCUk9Yp/gkt6on/0kF2ng/lhPvnXChq', 'admin', 'Elena(no).jpg'),
(23, 1, 15, 'Juan', 'Lopez', 'juan@lopez.com', '$2y$04$aRyRM9hhkVPIkSl6YcXY/.QDfJYY5.Re1bIJPtpB/edEEMrL.rKp6', 'employed', NULL),
(24, 3, 1, 'Meliton', 'Gonzales', 'meliton@gonzales.com', '$2y$04$BSff5izw8k4RKTYf76a7g.u.xs2lZ2RvO7cryHW7g/iJopMbSw.fC', 'user', NULL),
(56, 3, 1, 'Ramon', 'Osorio', 'ramon@osorio.com', '$2y$04$7jFK37powXyqh3qBSZ09aekWpAOiNqcP842VToH8K3KgtT0Mv75.6', 'user', NULL),
(57, 1, 15, 'Samuel', 'Etoo', 'samuel@etoo.com', '$2y$04$suQu4NQ8NvJb4idJPNlt2.SPgS4cLtuuAT7x3gJO7mIx4LDwVNJQa', 'employed', NULL),
(58, 4, 1, 'Aquiles', 'Rujo', 'aquiles@rujo.com', '$2y$04$2Mwoui6UDiZR4F4naQyn9.hUCU2ZBMOB35RR/56GpLWg7bbvgT.ua', 'user', NULL),
(68, 4, 1, 'David', 'Delgadillo', 'david@delgadillo.com', '$2y$04$J0JBbgCrJGKRTYoQPBkw4eaM0IoLQunAyLgugeBBxXuVbZQ5sanoO', 'user', NULL),
(69, 1, 14, 'Alejandro', 'Perez', 'alejandro@perez.com', '$2y$04$iE88URy0QMTILOUolNeqj.xWObdZHN1ozmHBlIfCApjoMWfxM7q46', 'employed', NULL),
(83, 1, 16, 'Yoni', 'Pacheco', 'yoni@pacheco.com', '$2y$04$Uq3.FRGV2PxkFuLXjzMOj.QJRuR8IZFmO0Th5gULi6/d4BDdifstO', 'employed', '80cb5151867a0aa10534d43bcaaf196b.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comentario_ticket` (`id_ticket`),
  ADD KEY `fk_comentario_usuario` (`id_usuario`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ticket_usuario` (`id_usuario`),
  ADD KEY `fk_ticket_userpersnl` (`id_upersonal`),
  ADD KEY `fk_ticket_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`),
  ADD KEY `fk_usuario_area` (`id_area`),
  ADD KEY `fk_usuario_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentario_ticket` FOREIGN KEY (`id_ticket`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_ticket_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_ticket_userpersnl` FOREIGN KEY (`id_upersonal`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `fk_ticket_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_area` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `fk_usuario_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;