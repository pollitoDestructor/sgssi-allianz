-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 23-10-2025 a las 18:01:35
-- Versión del servidor: 10.8.2-MariaDB-1:10.8.2+maria~focal
-- Versión de PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `descr` text NOT NULL COMMENT 'Descripción',
  `precio` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`id`, `nombre`, `color`, `estado`, `descr`, `precio`) VALUES
(1, 'labubu', 'multicolor', 'nuevo', '24k labubu', 9.99),
(2, 'camiseta', 'negro', 'nuevo', 'camiseta labubu', 19.99),
(3, 'cuaderno', 'blanco y marrón', 'usado', 'cuaderno labubu', 7.50),
(4, 'pegatina', 'gris', 'nuevo', 'pegatina labubu', 3.25),
(5, 'taza', 'verde', 'defectuoso', 'taza labubu con asa rota', 5.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` varchar(9) NOT NULL,
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `fecha_nac` varchar(10) NOT NULL COMMENT 'Fecha de nacimiento',
  `email` varchar(100) NOT NULL,
  `telefono` int(9) NOT NULL,
  `contraseña` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `apellidos`, `fecha_nac`, `email`, `telefono`, `contraseña`) VALUES
('12345678Z', 'admin', '.', '01/01/1999', 'admin@gmail.com', 666666666, '$2y$10$w5rT8BbskJ40K2PYy7xxT.T9.3FBvziX9Duyn83hpJXmE4NFLfy2e'),
('99999999R', 'labubu', '.', '02/02/2000', 'labubu@gmail.com', 611111116, '$2y$10$SpbHFBmkFrAopdrijQAokOP3zMq6Tz8EI1ZIwFptDF0vO2LMUYzVC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
