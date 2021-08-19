-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-08-2021 a las 18:54:16
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bibliotecar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asuntos`
--

DROP TABLE IF EXISTS `asuntos`;
CREATE TABLE IF NOT EXISTS `asuntos` (
  `idAsunto` int(11) NOT NULL,
  `nombreAsunto` varchar(50) NOT NULL,
  PRIMARY KEY (`idAsunto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

DROP TABLE IF EXISTS `autores`;
CREATE TABLE IF NOT EXISTS `autores` (
  `idAutores` int(11) NOT NULL,
  `nombreAutor` varchar(25) NOT NULL,
  PRIMARY KEY (`idAutores`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`idAutores`, `nombreAutor`) VALUES
(10, 'Quino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombreCategoria` varchar(15) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombreCategoria`) VALUES
(1, 'humor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentotipos`
--

DROP TABLE IF EXISTS `documentotipos`;
CREATE TABLE IF NOT EXISTS `documentotipos` (
  `idTipoDocumento` int(11) NOT NULL,
  `tipoDocumento` varchar(10) NOT NULL,
  PRIMARY KEY (`idTipoDocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentotipos`
--

INSERT INTO `documentotipos` (`idTipoDocumento`, `tipoDocumento`) VALUES
(0, 'Dni'),
(1, 'LibretaCiv'),
(2, 'LibretaEnr'),
(3, 'Pasaporte'),
(4, 'CedulaIden');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

DROP TABLE IF EXISTS `editoriales`;
CREATE TABLE IF NOT EXISTS `editoriales` (
  `idEditorial` int(11) NOT NULL,
  `nombreEditorial` varchar(25) NOT NULL,
  PRIMARY KEY (`idEditorial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplares`
--

DROP TABLE IF EXISTS `ejemplares`;
CREATE TABLE IF NOT EXISTS `ejemplares` (
  `idEjemplar` int(11) NOT NULL,
  `idLibro` int(11) NOT NULL,
  `idEjemplarEstado` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fechaIngreso` date NOT NULL,
  PRIMARY KEY (`idEjemplar`),
  KEY `fk_ejem_libro` (`idLibro`),
  KEY `fk_ejem_estado` (`idEjemplarEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplar_estados`
--

DROP TABLE IF EXISTS `ejemplar_estados`;
CREATE TABLE IF NOT EXISTS `ejemplar_estados` (
  `idEjemplarEstado` int(11) NOT NULL,
  `ejemplarEstado` varchar(15) NOT NULL,
  PRIMARY KEY (`idEjemplarEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadousuario`
--

DROP TABLE IF EXISTS `estadousuario`;
CREATE TABLE IF NOT EXISTS `estadousuario` (
  `idEstado` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estadousuario`
--

INSERT INTO `estadousuario` (`idEstado`, `estado`) VALUES
(1, 'Activo'),
(2, 'Eliminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_usuarios`
--

DROP TABLE IF EXISTS `estado_usuarios`;
CREATE TABLE IF NOT EXISTS `estado_usuarios` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(20) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_usuarios`
--

INSERT INTO `estado_usuarios` (`idEstado`, `estado`) VALUES
(1, 'Activo'),
(2, 'Eliminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

DROP TABLE IF EXISTS `libros`;
CREATE TABLE IF NOT EXISTS `libros` (
  `idLibro` int(11) NOT NULL,
  `titulo` varchar(25) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `pdf` varchar(30) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `fechaAlta` date NOT NULL,
  `imagen_libro` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idLibro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`idLibro`, `titulo`, `descripcion`, `pdf`, `stock`, `fechaAlta`, `imagen_libro`) VALUES
(1, 'Toda Mafalda', 'De quino ', '0', 0, '0000-00-00', '../assets/libros/libro-mafalda.png'),
(2, 'libro 2', 'descripcion 2', '0', 0, '2020-04-04', '../assets/libros/libro-mafalda.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_autores`
--

DROP TABLE IF EXISTS `libro_autores`;
CREATE TABLE IF NOT EXISTS `libro_autores` (
  `idAutores` int(11) NOT NULL,
  `idLibro` int(11) NOT NULL,
  KEY `fk_libAut_autor` (`idAutores`),
  KEY `fk_libAut_libro` (`idLibro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro_autores`
--

INSERT INTO `libro_autores` (`idAutores`, `idLibro`) VALUES
(10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_categoria`
--

DROP TABLE IF EXISTS `libro_categoria`;
CREATE TABLE IF NOT EXISTS `libro_categoria` (
  `idCategoria` int(11) NOT NULL,
  `idLibro` int(11) NOT NULL,
  KEY `fk_libCat_cat` (`idCategoria`),
  KEY `fk_libCat_libro` (`idLibro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro_categoria`
--

INSERT INTO `libro_categoria` (`idCategoria`, `idLibro`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_editoriales`
--

DROP TABLE IF EXISTS `libro_editoriales`;
CREATE TABLE IF NOT EXISTS `libro_editoriales` (
  `idLibro` int(11) NOT NULL,
  `idEditorial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

DROP TABLE IF EXISTS `localidades`;
CREATE TABLE IF NOT EXISTS `localidades` (
  `idLocalidad` int(11) NOT NULL,
  `idProvincia` int(11) NOT NULL,
  `nombreLocalidad` varchar(20) NOT NULL,
  `codigoPostal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE IF NOT EXISTS `paises` (
  `idPais` int(11) NOT NULL,
  `nombrePais` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

DROP TABLE IF EXISTS `provincias`;
CREATE TABLE IF NOT EXISTS `provincias` (
  `idProvincia` int(11) NOT NULL,
  `idPais` int(11) NOT NULL,
  `nombreProvincia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `idReserva` int(11) NOT NULL,
  `idEjemplar` int(11) NOT NULL,
  `idReservaEstado` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaDesde` date NOT NULL,
  `fechaHasta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_estados`
--

DROP TABLE IF EXISTS `reserva_estados`;
CREATE TABLE IF NOT EXISTS `reserva_estados` (
  `idReservaEstado` int(11) NOT NULL,
  `idEjemplarEstado` int(11) NOT NULL,
  `estadoReserva` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(20) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombreRol`) VALUES
(1, 'Usuario'),
(2, 'Colaborador'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerencias`
--

DROP TABLE IF EXISTS `sugerencias`;
CREATE TABLE IF NOT EXISTS `sugerencias` (
  `idSugerencia` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idAsunto` int(11) NOT NULL,
  `sugerencia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `idTipoDocumento` int(11) DEFAULT NULL,
  `idLocalidad` int(11) DEFAULT NULL,
  `idEstado` int(11) NOT NULL,
  `idRol` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) DEFAULT NULL,
  `numeroDocumento` varchar(9) DEFAULT NULL,
  `mail` varchar(50) NOT NULL,
  `contrasena` text NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `departamento` varchar(10) DEFAULT NULL,
  `check_mail` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuario`),
  KEY `idEstado` (`idEstado`),
  KEY `idRol` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `idTipoDocumento`, `idLocalidad`, `idEstado`, `idRol`, `nombre`, `apellido`, `numeroDocumento`, `mail`, `contrasena`, `telefono`, `direccion`, `departamento`, `check_mail`) VALUES
(20, NULL, NULL, 1, 2, 'Sabrina', NULL, NULL, 'sabrina@beltran.com', '$2y$10$4/DO.F7r01ogaFfHIIlXtuDTuw/0dTjTYpgKlQkW5g1ZPyvGZ0ZV6', NULL, NULL, NULL, 1),
(21, NULL, NULL, 1, 3, 'marcos', NULL, NULL, 'marcos@beltran.com', '$2y$10$.MvjY0i6MI9Xfloww/RnqOJVFwnWidhUIraXa08K8AAjf0/mr4S3i', NULL, NULL, NULL, 1),
(22, NULL, NULL, 1, 1, 'David', NULL, NULL, 'david@beltran.com', '$2y$10$qcsSXOfRGt/x2aaOYnXmmufwZbkKwS/2Mi6s5FEZGi7iQ9lgjXw.W', NULL, NULL, NULL, 1),
(23, NULL, NULL, 1, 1, 'marcos', NULL, NULL, 'marcos2@ibeltran.com', '$2y$10$3hfo5KdI8uNV0t7rtOD2Iu4/8eDzR3bYXlSvG0z7E634kRuZ6Sg36', NULL, NULL, NULL, 1),
(24, NULL, NULL, 1, 1, 'jere', NULL, NULL, 'jere2@beltran.com', '$2y$10$7IBokRD3Tz9yLEeJiJUfFuPaLXKlYZfTY9k9pHNZkbj8gZmqgQJr.', NULL, NULL, NULL, 1),
(25, NULL, NULL, 1, 1, 'marcos3', NULL, NULL, 'jere3@beltran.com', '$2y$10$yr1r47Dfgk2x/sH2o0AX4.kcZQz05Kp5yfN/McGMwl9ArTDW5cDpG', NULL, NULL, NULL, 1),
(26, NULL, NULL, 1, 1, 'jere', NULL, NULL, 'jere4@beltran.com', '$2y$10$L7Vad0OuRCkvUs3zhLuZueidMI95DE0UR37IFOw87XivF0rc.LDoK', NULL, NULL, NULL, 1),
(27, NULL, NULL, 1, 3, 'Jeremias', NULL, NULL, 'jere@beltran.com', '$2y$10$wdPnDqhVy3nMlyOiOFtKS.MLdQxxnl9hmKXuTAb4En9JIsBduiRqW', NULL, NULL, NULL, 1),
(28, NULL, NULL, 1, 1, 'asdf', NULL, NULL, 'asdf@beltran.com', '$2y$10$Lx4WKAvxdJR3jpBF1k1Umu.CaPdh8r7xBsuj49FprXpmXxEEuvksG', NULL, NULL, NULL, 1),
(29, NULL, NULL, 1, 1, 'jere5', NULL, NULL, 'jere5@beltran.com', '$2y$10$0p0Lcr4rn03i6LRL2G3Oeu.aSVEigvXMvYpH2S592sVbrnmoQOZwm', NULL, NULL, NULL, 1),
(30, NULL, NULL, 1, 1, 'Gabriel', NULL, NULL, 'gabriel@beltran.com', '$2y$10$sOHGIViyiOIhh89kro5c1eHLsF20Rhc8iO/5U2Cnpcbh9.UxAtZ26', NULL, NULL, NULL, 1),
(31, NULL, NULL, 1, 1, 'Gabriel', NULL, NULL, 'gabi2@gmail.com', '$2y$10$qTqNfT5skTBQja4HlQXiF.iw6tuQyCy1oSoUgCEaLe6w8O/7Q0rT6', NULL, NULL, NULL, 1),
(32, NULL, NULL, 1, 1, 'jere', NULL, NULL, 'jere8@gmail.com', '$2y$10$iVbkC5hqfhJXOXyJF8s3aObWyukeAZbqsOj7PnPZUtNlmXGaaInxa', NULL, NULL, NULL, 1),
(33, NULL, NULL, 1, 1, 'Gerardo', NULL, NULL, 'gerardo@beltran.com', '$2y$10$ra5UoFg1t201pxglHEPFN.YvYOBWoqsQKQ6D.1B3wB89EAr7u/fcS', NULL, NULL, NULL, 0),
(37, NULL, NULL, 1, 1, 'matias', NULL, NULL, 'matias@beltran.com', '$2y$10$hHXb7tUIFvJK/lO60.sjiutLqxo/rChy48Jl1rOmJXxFX7gPqhjWq', NULL, NULL, NULL, 0),
(38, NULL, NULL, 1, 1, 'Marcelo', NULL, NULL, 'gallardo@beltran.com', '$2y$10$MgckYx8SCQNNpaTdNGI12uUj6hJDrm5zITM3kY3B.k5AvpV7M.egO', NULL, NULL, NULL, 1),
(39, NULL, NULL, 1, 1, 'Jera', NULL, NULL, 'jera@beltran.com', '$2y$10$dqwIMSHleU9Wz1fwCyInleEktR2RxFkbkRkuFnc6XnmOJS6fBcEcK', NULL, NULL, NULL, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estado_usuarios` (`idEstado`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
