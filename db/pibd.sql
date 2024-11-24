-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2024 a las 17:33:29
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
-- Base de datos: `pibd`
--
CREATE DATABASE IF NOT EXISTS `pibd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pibd`;

CREATE USER 'wwwdata'@'localhost' IDENTIFIED BY 'daw';

GRANT SELECT, INSERT, UPDATE, DELETE ON *.* TO 'wwwdata'@'localhost' IDENTIFIED BY 'daw' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE `albumes` (
  `idAlbum` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`idAlbum`, `titulo`, `descripcion`, `usuario`) VALUES
(1, 'Album de Vacaciones', 'Fotos de las vacaciones de verano', 1),
(2, 'Album de Cumpleaños', 'Fotos del cumpleaños número 30', 1),
(3, 'Lindos gatitos', 'Álbum de gatitos', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE `estilos` (
  `idEstilo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fichero` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estilos`
--

INSERT INTO `estilos` (`idEstilo`, `nombre`, `descripcion`, `fichero`) VALUES
(1, 'Modo noche', 'Aplica el modo noche al sitio web', 'noche.css'),
(2, 'Modo letra grande', 'Aplica el estilo para una letra grande', 'big.css'),
(3, 'Modo alto contraste', 'Estilos para el modo de alto contraste', 'contrast.css'),
(4, 'Modo alto contraste y letra grande', 'Estilos para el modo de alto contraste con un tipo de letra mayor', 'contrast-big.css');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `idFoto` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `pais` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `fichero` varchar(255) NOT NULL,
  `alternativo` varchar(255) DEFAULT NULL,
  `fRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`idFoto`, `titulo`, `descripcion`, `fecha`, `pais`, `album`, `fichero`, `alternativo`, `fRegistro`) VALUES
(1, 'Bosque', 'Frondoso y bello bosque', '2024-11-23', 2, 1, 'foto2.jpg', 'Atardecer en el bosque', '2024-11-23 18:13:59'),
(2, 'Abeja', 'Las abejas forman parte importante de la diversidad de especies', '2024-11-23', 1, 2, 'foto1.jpg', 'Abeja posada sobre un girasol', '2024-11-23 18:16:03'),
(3, 'Atardecer el bosque', 'Un bello atardecer', '2024-11-17', 1, 2, 'foto3.webp', 'Árbol con un hermoso paisaje de fondo', '2024-11-23 18:18:18'),
(4, 'Flores Blancas', 'Lindas Flores', '2024-11-10', 2, 1, 'foto4.webp', 'campo lleno de flores blancas', '2024-11-23 18:21:03'),
(5, 'Lindo minino', 'Espectacular felino', '2024-11-16', 1, 1, 'foto5.jpeg', 'felino descansando sobre un tronco', '2024-11-23 18:20:40'),
(6, 'Gato blanco', 'Raza de gato muy interesante', '2024-11-09', 2, 3, 'gato1.jpg', 'Gato mirando hacia algo que le interesa', '2024-11-24 16:22:08'),
(7, 'Gato descansando', 'Gato descansando plácidamente', '2024-11-24', 2, 3, 'gato2.jpg', 'Gato marrón reposado sobre el suelo', '2024-11-24 16:24:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `idPais` int(11) NOT NULL,
  `nomPais` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`idPais`, `nomPais`) VALUES
(1, 'España'),
(2, 'Argentina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `idSolicitud` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `piso` int(11) DEFAULT NULL,
  `puerta` varchar(10) DEFAULT NULL,
  `codigoPostal` int(11) DEFAULT NULL,
  `localidad` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `pais` int(11) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `copias` int(11) DEFAULT NULL,
  `resolucion` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `iColor` tinyint(1) DEFAULT NULL,
  `fRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `coste` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nomUsuario` varchar(15) NOT NULL,
  `clave` varchar(15) NOT NULL,
  `email` varchar(254) NOT NULL,
  `sexo` smallint(6) DEFAULT NULL,
  `fNacimiento` date DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `pais` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `fRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estilo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nomUsuario`, `clave`, `email`, `sexo`, `fNacimiento`, `ciudad`, `pais`, `foto`, `fRegistro`, `estilo`) VALUES
(1, 'marcos123', 'marcos123', 'marcos@correo.com', 0, '1990-01-01', 'Alicante', 1, 'foto1.jpg', '2024-11-23 11:20:37', 1),
(2, 'usuario1', 'usuario1', 'usuario1@ua.es', 0, '2004-11-01', 'Valencia', 1, 'foto5.jpeg', '2024-11-23 19:17:39', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`idAlbum`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`idEstilo`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`idFoto`),
  ADD KEY `pais` (`pais`),
  ADD KEY `album` (`album`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`idPais`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`idSolicitud`),
  ADD KEY `album` (`album`),
  ADD KEY `pais` (`pais`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `nomUsuario` (`nomUsuario`),
  ADD KEY `pais` (`pais`),
  ADD KEY `estilo` (`estilo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `idAlbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `idEstilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `idPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `idSolicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD CONSTRAINT `albumes_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`pais`) REFERENCES `paises` (`idPais`),
  ADD CONSTRAINT `fotos_ibfk_2` FOREIGN KEY (`album`) REFERENCES `albumes` (`idAlbum`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`album`) REFERENCES `albumes` (`idAlbum`),
  ADD CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`pais`) REFERENCES `paises` (`idPais`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`pais`) REFERENCES `paises` (`idPais`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`estilo`) REFERENCES `estilos` (`idEstilo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
