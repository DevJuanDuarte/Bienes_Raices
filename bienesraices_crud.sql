-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2023 a las 17:28:22
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bienesraices_crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(60) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext DEFAULT NULL,
  `habitaciones` int(1) DEFAULT NULL,
  `wc` int(1) DEFAULT NULL,
  `estacionamiento` int(1) DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedorId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(1) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` char(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendedorId_idx` (`vendedorId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `vendedorId` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
