CREATE DATABASE IF NOT EXISTS `daw`;
USE `daw`;

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
  `fichero` VARCHAR(255),
  PRIMARY KEY (`idEstilo`)
);

-- Tabla Usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` INTEGER NOT NULL AUTO_INCREMENT,
  `nomUsuario` VARCHAR(15) UNIQUE NOT NULL,
  `clave` VARCHAR(15) NOT NULL,
  `email` VARCHAR(254) NOT NULL,
  `sexo` SMALLINT,
  `fNacimiento` DATETIME,
  `ciudad` VARCHAR(100),
  `pais` INTEGER NOT NULL,
  `foto` VARCHAR(255),
  `fRegistro` TIMESTAMP,
  `estilo` INTEGER,
  PRIMARY KEY (`idUsuario`),
  FOREIGN KEY (`pais`) REFERENCES `paises`(`idPais`),
  FOREIGN KEY (`estilo`) REFERENCES `estilos`(`idEstilo`)
);

-- Tabla álbumes
CREATE TABLE IF NOT EXISTS `albumes` (
  `idAlbum` INTEGER NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(500),
  `usuario` INTEGER NOT NULL,
  PRIMARY KEY (`idAlbum`),
  FOREIGN KEY (`usuario`) REFERENCES `usuarios`(`idUsuario`)
);

-- Tabla Fotos
CREATE TABLE IF NOT EXISTS `fotos` (
  `idFoto` INTEGER NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(500),
  `fecha` DATETIME,
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
  `fecha` DATETIME,
  `iColor` BOOLEAN,
  `fRegistro` TIMESTAMP,
  `coste` DECIMAL(10, 2),
  PRIMARY KEY (`idSolicitud`),
  FOREIGN KEY (`album`) REFERENCES `albumes`(`idAlbum`),
  FOREIGN KEY (`pais`) REFERENCES `paises`(`idPais`)
);