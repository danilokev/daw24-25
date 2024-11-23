CREATE DATABASE IF NOT EXISTS `pibd`;
USE `pibd`;

-- CREATE USER 'wwwdata'@'localhost' IDENTIFIED BY 'daw';

GRANT SELECT, INSERT, UPDATE, DELETE ON *.* TO 'wwwdata'@'localhost' IDENTIFIED BY 'daw' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

-- Tabla paises
CREATE TABLE IF NOT EXISTS `paises` (
  `idPais` INTEGER NOT NULL AUTO_INCREMENT,
  `nomPais` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idPais`)
);

-- Tabla estilos
CREATE TABLE IF NOT EXISTS `estilos` (
  `idEstilo` INTEGER NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` VARCHAR(500),
  `fichero` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idEstilo`)
);

-- Tabla Usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` INTEGER NOT NULL AUTO_INCREMENT,
  `nomUsuario` VARCHAR(15) UNIQUE NOT NULL,
  `clave` VARCHAR(15) NOT NULL,
  `email` VARCHAR(254) NOT NULL,
  `sexo` SMALLINT,
  `fNacimiento` DATE,
  `ciudad` VARCHAR(100),
  `pais` INTEGER NOT NULL,
  `foto` VARCHAR(255),
  `fRegistro` TIMESTAMP,
  `estilo` INTEGER NOT NULL,
  PRIMARY KEY (`idUsuario`),
  FOREIGN KEY (`pais`) REFERENCES `paises`(`idPais`),
  FOREIGN KEY (`estilo`) REFERENCES `estilos`(`idEstilo`)
);

-- Ejemplos de inserciones en las tablas paises, estilos y usuarios para hacer pruebas
INSERT INTO `paises` (nomPais) VALUES ('España');

INSERT INTO `estilos` (nombre, descripcion, fichero) VALUES ('Modo noche', 'Descripción del estilo', 'noche.css');

INSERT INTO `usuarios` (nomUsuario, clave, email, sexo, fNacimiento, ciudad, pais, foto, fRegistro, estilo)
VALUES ('marcos123', 'marcos123', 'marcos@correo.com', 0, '1990-01-01', 'Alicante', 1, 'foto1.jpg', NOW(), 1);

-- Tabla álbumes
CREATE TABLE IF NOT EXISTS `albumes` (
  `idAlbum` INTEGER NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(500),
  `usuario` INTEGER NOT NULL,
  PRIMARY KEY (`idAlbum`),
  FOREIGN KEY (`usuario`) REFERENCES `usuarios`(`idUsuario`)
);

-- Ejemplo de inserción en la tabla álbumes para el usuario 1 (tabla usuarios)
INSERT INTO `albumes` (`titulo`, `descripcion`, `usuario`) VALUES
('Album de Vacaciones', 'Fotos de las vacaciones de verano', 1),
('Album de Cumpleaños', 'Fotos del cumpleaños número 30', 1);

-- Tabla Fotos
CREATE TABLE IF NOT EXISTS `fotos` (
  `idFoto` INTEGER NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(500),
  `fecha` DATE,
  `pais` INTEGER NOT NULL,
  `album` INTEGER NOT NULL,
  `fichero` VARCHAR(255) NOT NULL,
  `alternativo` VARCHAR(255),
  `fRegistro` TIMESTAMP,
  PRIMARY KEY (`idFoto`),
  FOREIGN KEY (`pais`) REFERENCES `paises`(`idPais`),
  FOREIGN KEY (`album`) REFERENCES `albumes`(`idAlbum`)
);

-- Tabla Solicitudes
CREATE TABLE IF NOT EXISTS `solicitudes` (
  `idSolicitud` INTEGER NOT NULL AUTO_INCREMENT,
  `album` INTEGER NOT NULL,
  `nombre` VARCHAR(200) NOT NULL,
  `titulo` VARCHAR(200) NOT NULL,
  `descripcion` VARCHAR(500),
  `email` VARCHAR(254) NOT NULL,
  `calle` VARCHAR(255),
  `numero` INTEGER,
  `piso` INTEGER,
  `puerta` VARCHAR(10),
  `codigoPostal` INTEGER,
  `localidad` VARCHAR(255),
  `provincia` VARCHAR(255),
  `pais` INTEGER NOT NULL,
  `telefono` VARCHAR(20),
  `color` VARCHAR(255),
  `copias` INTEGER,
  `resolucion` INTEGER,
  `fecha` DATE,
  `iColor` BOOLEAN,
  `fRegistro` TIMESTAMP,
  `coste` DECIMAL(10, 2),
  PRIMARY KEY (`idSolicitud`),
  FOREIGN KEY (`album`) REFERENCES `albumes`(`idAlbum`),
  FOREIGN KEY (`pais`) REFERENCES `paises`(`idPais`)
);