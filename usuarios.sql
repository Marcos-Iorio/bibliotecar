-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-08-2021 a las 23:08:40
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
  `ping` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `idEstado` (`idEstado`),
  KEY `idRol` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `idTipoDocumento`, `idLocalidad`, `idEstado`, `idRol`, `nombre`, `apellido`, `numeroDocumento`, `mail`, `contrasena`, `telefono`, `direccion`, `departamento`, `check_mail`, `ping`) VALUES
(20, NULL, NULL, 1, 2, 'Sabrina', NULL, NULL, 'sabrina@beltran.com', '$2y$10$4/DO.F7r01ogaFfHIIlXtuDTuw/0dTjTYpgKlQkW5g1ZPyvGZ0ZV6', NULL, NULL, NULL, 1, '123456'),
(21, NULL, NULL, 1, 3, 'marcos', NULL, NULL, 'marcos@beltran.com', '$2y$10$.MvjY0i6MI9Xfloww/RnqOJVFwnWidhUIraXa08K8AAjf0/mr4S3i', NULL, NULL, NULL, 1, NULL),
(22, NULL, NULL, 1, 1, 'David', NULL, NULL, 'david@beltran.com', '$2y$10$qcsSXOfRGt/x2aaOYnXmmufwZbkKwS/2Mi6s5FEZGi7iQ9lgjXw.W', NULL, NULL, NULL, 1, NULL),
(23, NULL, NULL, 1, 1, 'marcos', NULL, NULL, 'marcos2@ibeltran.com', '$2y$10$3hfo5KdI8uNV0t7rtOD2Iu4/8eDzR3bYXlSvG0z7E634kRuZ6Sg36', NULL, NULL, NULL, 1, NULL),
(24, NULL, NULL, 1, 1, 'jere', NULL, NULL, 'jere2@beltran.com', '$2y$10$7IBokRD3Tz9yLEeJiJUfFuPaLXKlYZfTY9k9pHNZkbj8gZmqgQJr.', NULL, NULL, NULL, 1, NULL),
(25, NULL, NULL, 1, 1, 'marcos3', NULL, NULL, 'jere3@beltran.com', '$2y$10$yr1r47Dfgk2x/sH2o0AX4.kcZQz05Kp5yfN/McGMwl9ArTDW5cDpG', NULL, NULL, NULL, 1, NULL),
(26, NULL, NULL, 1, 1, 'jere', NULL, NULL, 'jere4@beltran.com', '$2y$10$L7Vad0OuRCkvUs3zhLuZueidMI95DE0UR37IFOw87XivF0rc.LDoK', NULL, NULL, NULL, 1, NULL),
(27, NULL, NULL, 1, 3, 'Jeremias', NULL, NULL, 'jere@beltran.com', '$2y$10$wdPnDqhVy3nMlyOiOFtKS.MLdQxxnl9hmKXuTAb4En9JIsBduiRqW', NULL, NULL, NULL, 1, NULL),
(28, NULL, NULL, 1, 1, 'asdf', NULL, NULL, 'asdf@beltran.com', '$2y$10$Lx4WKAvxdJR3jpBF1k1Umu.CaPdh8r7xBsuj49FprXpmXxEEuvksG', NULL, NULL, NULL, 1, NULL),
(29, NULL, NULL, 1, 1, 'jere5', NULL, NULL, 'jere5@beltran.com', '$2y$10$0p0Lcr4rn03i6LRL2G3Oeu.aSVEigvXMvYpH2S592sVbrnmoQOZwm', NULL, NULL, NULL, 1, NULL),
(30, NULL, NULL, 1, 1, 'Gabriel', NULL, NULL, 'gabriel@beltran.com', '$2y$10$sOHGIViyiOIhh89kro5c1eHLsF20Rhc8iO/5U2Cnpcbh9.UxAtZ26', NULL, NULL, NULL, 1, NULL),
(31, NULL, NULL, 1, 1, 'Gabriel', NULL, NULL, 'gabi2@gmail.com', '$2y$10$qTqNfT5skTBQja4HlQXiF.iw6tuQyCy1oSoUgCEaLe6w8O/7Q0rT6', NULL, NULL, NULL, 1, NULL),
(32, NULL, NULL, 1, 1, 'jere', NULL, NULL, 'jere8@gmail.com', '$2y$10$iVbkC5hqfhJXOXyJF8s3aObWyukeAZbqsOj7PnPZUtNlmXGaaInxa', NULL, NULL, NULL, 1, NULL),
(33, NULL, NULL, 1, 1, 'Gerardo', NULL, NULL, 'gerardo@beltran.com', '$2y$10$ra5UoFg1t201pxglHEPFN.YvYOBWoqsQKQ6D.1B3wB89EAr7u/fcS', NULL, NULL, NULL, 0, NULL),
(37, NULL, NULL, 1, 1, 'matias', NULL, NULL, 'matias@beltran.com', '$2y$10$hHXb7tUIFvJK/lO60.sjiutLqxo/rChy48Jl1rOmJXxFX7gPqhjWq', NULL, NULL, NULL, 0, NULL),
(38, NULL, NULL, 1, 1, 'Marcelo', NULL, NULL, 'gallardo@beltran.com', '$2y$10$MgckYx8SCQNNpaTdNGI12uUj6hJDrm5zITM3kY3B.k5AvpV7M.egO', NULL, NULL, NULL, 1, NULL),
(39, NULL, NULL, 1, 1, 'Jera', NULL, NULL, 'jera@beltran.com', '$2y$10$dqwIMSHleU9Wz1fwCyInleEktR2RxFkbkRkuFnc6XnmOJS6fBcEcK', NULL, NULL, NULL, 0, NULL),
(40, NULL, NULL, 1, 1, 'marcos3', NULL, NULL, 'safasf@beltran.com', '$2y$10$AZbk2O.K3LndOLPDH9GzDelUcl8KEknOpUZjEix0dFiZKw0szTR.i', NULL, NULL, NULL, 0, NULL),
(41, NULL, NULL, 1, 1, 'jere', NULL, NULL, 'asfas@beltran.com', '$2y$10$wAXdmcCd6UiHxIKuFx0ul.L3/n08vtVIqJD6iVDrE7klhq655VbOG', NULL, NULL, NULL, 0, NULL),
(42, NULL, NULL, 1, 1, 'marcos3', NULL, NULL, 'jere123@beltran.com', '$2y$10$WOf4wT20PA/XG8PguTzwd.jDogX6lvQtrpmDBBhif11GxE34zDmWC', NULL, NULL, NULL, 0, NULL),
(43, NULL, NULL, 1, 1, 'marcos3', NULL, NULL, 'jere12@beltran.com', '$2y$10$KBG/z/O7Hj6fqhCFfSpcn.l7rwyTJ5BQ2rqynksbS4ekc7pnWU0AC', NULL, NULL, NULL, 0, NULL),
(246, NULL, NULL, 1, 1, 'jere', NULL, NULL, 'jere444@beltran.com', '$2y$10$xR2YsrTi1yg1bb9aiZdZbOB95RnEJDjc0zZlauF.J4gRfMqp5Mq7.', NULL, NULL, NULL, 0, '128466'),
(247, NULL, NULL, 1, 1, 'jere', NULL, NULL, 'jere1234@beltran.com', '$2y$10$3LXQHrXiwzEB6rUFQUAbvumH5xOVhs..sUszEQ8BIuwpImSy6aD6a', NULL, NULL, NULL, 0, '478082'),
(248, NULL, NULL, 1, 1, 'Jeremias', NULL, NULL, 'jmontllau@gmail.com', '$2y$10$bg9jCH5Pngsby4Pp.6boPO9nTblrNm1rAxPXNfmYvD4uFqkKHz0JG', NULL, NULL, NULL, 1, '881830');

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
