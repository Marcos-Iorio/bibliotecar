-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-11-2021 a las 23:35:32
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
-- Base de datos: `bibliotecar5`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asuntos`
--

DROP TABLE IF EXISTS `asuntos`;
CREATE TABLE IF NOT EXISTS `asuntos` (
  `idAsunto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreAsunto` varchar(50) NOT NULL,
  PRIMARY KEY (`idAsunto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

DROP TABLE IF EXISTS `autores`;
CREATE TABLE IF NOT EXISTS `autores` (
  `idAutores` int(11) NOT NULL AUTO_INCREMENT,
  `nombreAutor` varchar(40) NOT NULL,
  PRIMARY KEY (`idAutores`,`nombreAutor`),
  UNIQUE KEY `nombreAutor_UNIQUE` (`nombreAutor`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`idAutores`, `nombreAutor`) VALUES
(156, 'desconocido'),
(166, 'Diego Maradona'),
(149, 'Ezequiel Adamovsky'),
(150, 'Felix Luna'),
(3, 'Gabriel Garcia Marquez'),
(73, 'hola'),
(169, 'Jason Cannon'),
(90, 'jere'),
(2, 'Jorge Luis Borges'),
(4, 'Julio Cotázar'),
(92, 'marcos'),
(170, 'Marley'),
(1, 'quino'),
(148, 'Raymond Chang'),
(167, 'Reinosa'),
(72, 'sa'),
(71, 'sabrina'),
(175, 'Saraza'),
(91, 'test'),
(147, 'test2'),
(168, 'Victor Beker');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(40) NOT NULL,
  PRIMARY KEY (`idCategoria`,`nombreCategoria`),
  UNIQUE KEY `nombreCategoria_UNIQUE` (`nombreCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombreCategoria`) VALUES
(3, 'Ciencias Naturales'),
(2, 'Ciencias Social'),
(160, 'desconocido'),
(90, 'dsad'),
(165, 'economia'),
(5, 'Historia'),
(148, 'informatica'),
(155, 'Ingles'),
(91, 'jere'),
(1, 'Literatura'),
(4, 'Matematicas'),
(158, 'Programacion'),
(166, 'Quimica'),
(159, 'Seguridad'),
(164, 'sistemas'),
(144, 'Suspenso'),
(156, 'uml');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_imagenes`
--

DROP TABLE IF EXISTS `categoria_imagenes`;
CREATE TABLE IF NOT EXISTS `categoria_imagenes` (
  `idCategoriaImg` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategoriaImg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria_imagenes`
--

INSERT INTO `categoria_imagenes` (`idCategoriaImg`, `descripcion`) VALUES
(1, 'tapa'),
(2, 'contratapa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_tipos`
--

DROP TABLE IF EXISTS `documento_tipos`;
CREATE TABLE IF NOT EXISTS `documento_tipos` (
  `idTipoDocumento` int(11) NOT NULL,
  `tipoDocumento` varchar(10) NOT NULL,
  PRIMARY KEY (`idTipoDocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documento_tipos`
--

INSERT INTO `documento_tipos` (`idTipoDocumento`, `tipoDocumento`) VALUES
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
  `idEditorial` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEditorial` varchar(40) NOT NULL,
  PRIMARY KEY (`idEditorial`,`nombreEditorial`),
  UNIQUE KEY `nombreEditorial_UNIQUE` (`nombreEditorial`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `editoriales`
--

INSERT INTO `editoriales` (`idEditorial`, `nombreEditorial`) VALUES
(140, 'Booket'),
(144, 'desconocido'),
(138, 'Graw'),
(63, 'hola'),
(80, 'jeremias'),
(2, 'Manzalba'),
(154, 'Nueva Luna'),
(139, 'Planetadelibros'),
(62, 'sa'),
(86, 'SABRIJEREMARCOS'),
(79, 'sadas'),
(143, 'safsafa'),
(134, 'test2'),
(1, 'Utopia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplares`
--

DROP TABLE IF EXISTS `ejemplares`;
CREATE TABLE IF NOT EXISTS `ejemplares` (
  `idEjemplar` varchar(20) NOT NULL,
  `idLibro` int(11) NOT NULL,
  `idEjemplarEstado` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fechaIngreso` date DEFAULT NULL,
  PRIMARY KEY (`idEjemplar`),
  KEY `fk_ejem_libro` (`idLibro`),
  KEY `fk_ejem_estado` (`idEjemplarEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ejemplares`
--

INSERT INTO `ejemplares` (`idEjemplar`, `idLibro`, `idEjemplarEstado`, `cantidad`, `fechaIngreso`) VALUES
('L175E1', 175, 0, NULL, '2021-10-29'),
('L175E2', 175, 0, NULL, '2021-10-29'),
('L175E3', 175, 0, NULL, '2021-10-29'),
('L175E4', 175, 0, NULL, '2021-10-29'),
('L175E5', 175, 0, NULL, '2021-10-29'),
('L176E1', 176, 0, NULL, '2021-10-24'),
('L176E10', 176, 0, NULL, '2021-10-24'),
('L176E2', 176, 0, NULL, '2021-10-24'),
('L176E3', 176, 0, NULL, '2021-10-24'),
('L176E4', 176, 0, NULL, '2021-10-24'),
('L176E5', 176, 0, NULL, '2021-10-24'),
('L176E6', 176, 0, NULL, '2021-10-24'),
('L176E7', 176, 0, NULL, '2021-10-24'),
('L176E8', 176, 0, NULL, '2021-10-24'),
('L176E9', 176, 0, NULL, '2021-10-24'),
('L177E1', 177, 0, NULL, '2021-10-25'),
('L177E2', 177, 0, NULL, '2021-10-25'),
('L177E3', 177, 0, NULL, '2021-10-25'),
('L177E4', 177, 0, NULL, '2021-10-25'),
('L177E5', 177, 0, NULL, '2021-10-25'),
('L181E1', 181, 0, NULL, '2021-10-09'),
('L181E10', 181, 0, NULL, '2021-10-09'),
('L181E2', 181, 0, NULL, '2021-10-09'),
('L181E3', 181, 0, NULL, '2021-10-09'),
('L181E4', 181, 0, NULL, '2021-10-09'),
('L181E5', 181, 0, NULL, '2021-10-09'),
('L181E6', 181, 0, NULL, '2021-10-09'),
('L181E7', 181, 0, NULL, '2021-10-09'),
('L181E8', 181, 0, NULL, '2021-10-09'),
('L181E9', 181, 0, NULL, '2021-10-09'),
('L182E1', 182, 0, NULL, '2021-11-03'),
('L182E10', 182, 0, NULL, '2021-11-03'),
('L182E2', 182, 0, NULL, '2021-11-03'),
('L182E3', 182, 0, NULL, '2021-11-03'),
('L182E4', 182, 0, NULL, '2021-11-03'),
('L182E5', 182, 0, NULL, '2021-11-03'),
('L182E6', 182, 0, NULL, '2021-11-03'),
('L182E7', 182, 0, NULL, '2021-11-03'),
('L182E8', 182, 0, NULL, '2021-11-03'),
('L182E9', 182, 0, NULL, '2021-11-03'),
('L183E1', 183, 0, NULL, '2021-11-03'),
('L183E10', 183, 0, NULL, '2021-11-03'),
('L183E11', 183, 0, NULL, '2021-11-03'),
('L183E12', 183, 0, NULL, '2021-11-03'),
('L183E13', 183, 0, NULL, '2021-11-03'),
('L183E14', 183, 0, NULL, '2021-11-03'),
('L183E15', 183, 0, NULL, '2021-11-03'),
('L183E2', 183, 0, NULL, '2021-11-03'),
('L183E3', 183, 0, NULL, '2021-11-03'),
('L183E4', 183, 0, NULL, '2021-11-03'),
('L183E5', 183, 0, NULL, '2021-11-03'),
('L183E6', 183, 0, NULL, '2021-11-03'),
('L183E7', 183, 0, NULL, '2021-11-03'),
('L183E8', 183, 0, NULL, '2021-11-03'),
('L183E9', 183, 0, NULL, '2021-11-03'),
('L184E1', 184, 0, NULL, '2021-11-03'),
('L184E10', 184, 0, NULL, '2021-11-03'),
('L184E2', 184, 0, NULL, '2021-11-03'),
('L184E3', 184, 0, NULL, '2021-11-03'),
('L184E4', 184, 0, NULL, '2021-11-03'),
('L184E5', 184, 0, NULL, '2021-11-03'),
('L184E6', 184, 0, NULL, '2021-11-03'),
('L184E7', 184, 0, NULL, '2021-11-03'),
('L184E8', 184, 0, NULL, '2021-11-03'),
('L184E9', 184, 0, NULL, '2021-11-03'),
('L185E1', 185, 0, NULL, '2021-11-03'),
('L185E2', 185, 0, NULL, '2021-11-03'),
('L185E3', 185, 0, NULL, '2021-11-03'),
('L185E4', 185, 0, NULL, '2021-11-03'),
('L185E5', 185, 0, NULL, '2021-11-03'),
('L186E1', 186, 0, NULL, '2021-11-10'),
('L186E10', 186, 0, NULL, '2021-11-10'),
('L186E2', 186, 0, NULL, '2021-11-10'),
('L186E3', 186, 0, NULL, '2021-11-10'),
('L186E4', 186, 0, NULL, '2021-11-10'),
('L186E5', 186, 0, NULL, '2021-11-10'),
('L186E6', 186, 0, NULL, '2021-11-10'),
('L186E7', 186, 0, NULL, '2021-11-10'),
('L186E8', 186, 0, NULL, '2021-11-10'),
('L186E9', 186, 0, NULL, '2021-11-10'),
('L187E1', 187, 0, NULL, '2021-11-03'),
('L187E10', 187, 0, NULL, '2021-11-03'),
('L187E11', 187, 0, NULL, '2021-11-03'),
('L187E12', 187, 0, NULL, '2021-11-03'),
('L187E13', 187, 0, NULL, '2021-11-03'),
('L187E14', 187, 0, NULL, '2021-11-03'),
('L187E15', 187, 0, NULL, '2021-11-03'),
('L187E2', 187, 0, NULL, '2021-11-03'),
('L187E3', 187, 0, NULL, '2021-11-03'),
('L187E4', 187, 0, NULL, '2021-11-03'),
('L187E5', 187, 0, NULL, '2021-11-03'),
('L187E6', 187, 0, NULL, '2021-11-03'),
('L187E7', 187, 0, NULL, '2021-11-03'),
('L187E8', 187, 0, NULL, '2021-11-03'),
('L187E9', 187, 0, NULL, '2021-11-03'),
('L188E1', 188, 0, NULL, '2021-11-03'),
('L188E2', 188, 0, NULL, '2021-11-03'),
('L188E3', 188, 0, NULL, '2021-11-03'),
('L188E4', 188, 0, NULL, '2021-11-03'),
('L188E5', 188, 0, NULL, '2021-11-03'),
('L189E1', 189, 0, NULL, '2021-11-03'),
('L189E2', 189, 0, NULL, '2021-11-03'),
('L189E3', 189, 0, NULL, '2021-11-03'),
('L189E4', 189, 0, NULL, '2021-11-03'),
('L189E5', 189, 0, NULL, '2021-11-03'),
('L191E1', 191, 0, NULL, '2021-11-03'),
('L191E2', 191, 0, NULL, '2021-11-03'),
('L191E3', 191, 0, NULL, '2021-11-03'),
('L191E4', 191, 0, NULL, '2021-11-03'),
('L191E5', 191, 0, NULL, '2021-11-03'),
('L192E1', 192, 0, NULL, '2021-11-03'),
('L192E2', 192, 0, NULL, '2021-11-03'),
('L192E3', 192, 0, NULL, '2021-11-03'),
('L192E4', 192, 0, NULL, '2021-11-03'),
('L192E5', 192, 0, NULL, '2021-11-03'),
('L193E1', 193, 0, NULL, '2021-11-04'),
('L193E2', 193, 0, NULL, '2021-11-04'),
('L193E3', 193, 0, NULL, '2021-11-04'),
('L193E4', 193, 0, NULL, '2021-11-04'),
('L193E5', 193, 0, NULL, '2021-11-04'),
('L194E1', 194, 0, NULL, '2021-11-03'),
('L194E10', 194, 0, NULL, '2021-11-03'),
('L194E11', 194, 0, NULL, '2021-11-03'),
('L194E12', 194, 0, NULL, '2021-11-03'),
('L194E13', 194, 0, NULL, '2021-11-03'),
('L194E14', 194, 0, NULL, '2021-11-03'),
('L194E15', 194, 0, NULL, '2021-11-03'),
('L194E2', 194, 0, NULL, '2021-11-03'),
('L194E3', 194, 0, NULL, '2021-11-03'),
('L194E4', 194, 0, NULL, '2021-11-03'),
('L194E5', 194, 0, NULL, '2021-11-03'),
('L194E6', 194, 0, NULL, '2021-11-03'),
('L194E7', 194, 0, NULL, '2021-11-03'),
('L194E8', 194, 0, NULL, '2021-11-03'),
('L194E9', 194, 0, NULL, '2021-11-03'),
('L196E1', 196, 0, NULL, '2021-11-05'),
('L196E10', 196, 0, NULL, '2021-11-05'),
('L196E2', 196, 0, NULL, '2021-11-05'),
('L196E3', 196, 0, NULL, '2021-11-05'),
('L196E4', 196, 0, NULL, '2021-11-05'),
('L196E5', 196, 0, NULL, '2021-11-05'),
('L196E6', 196, 0, NULL, '2021-11-05'),
('L196E7', 196, 0, NULL, '2021-11-05'),
('L196E8', 196, 0, NULL, '2021-11-05'),
('L196E9', 196, 0, NULL, '2021-11-05'),
('L197E1', 197, 0, NULL, '2021-11-05'),
('L197E10', 197, 0, NULL, '2021-11-05'),
('L197E2', 197, 0, NULL, '2021-11-05'),
('L197E3', 197, 0, NULL, '2021-11-05'),
('L197E4', 197, 0, NULL, '2021-11-05'),
('L197E5', 197, 0, NULL, '2021-11-05'),
('L197E6', 197, 0, NULL, '2021-11-05'),
('L197E7', 197, 0, NULL, '2021-11-05'),
('L197E8', 197, 0, NULL, '2021-11-05'),
('L197E9', 197, 0, NULL, '2021-11-05'),
('L198E1', 198, 0, NULL, '2021-11-05'),
('L198E2', 198, 0, NULL, '2021-11-05'),
('L198E3', 198, 0, NULL, '2021-11-05'),
('L198E4', 198, 0, NULL, '2021-11-05'),
('L198E5', 198, 0, NULL, '2021-11-05'),
('L199E1', 199, 0, NULL, '2021-11-05'),
('L199E2', 199, 0, NULL, '2021-11-05'),
('L199E3', 199, 0, NULL, '2021-11-05'),
('L199E4', 199, 0, NULL, '2021-11-05'),
('L199E5', 199, 0, NULL, '2021-11-05'),
('L200E1', 200, 0, NULL, '2021-11-05'),
('L200E2', 200, 0, NULL, '2021-11-05'),
('L200E3', 200, 0, NULL, '2021-11-05'),
('L200E4', 200, 0, NULL, '2021-11-05'),
('L200E5', 200, 0, NULL, '2021-11-05'),
('L201E1', 201, 0, NULL, '2021-11-05'),
('L201E2', 201, 0, NULL, '2021-11-05'),
('L201E3', 201, 0, NULL, '2021-11-05'),
('L201E4', 201, 0, NULL, '2021-11-05'),
('L201E5', 201, 0, NULL, '2021-11-05'),
('L202E1', 202, 0, NULL, '2021-11-05'),
('L202E2', 202, 0, NULL, '2021-11-05'),
('L202E3', 202, 0, NULL, '2021-11-05'),
('L203E1', 203, 0, NULL, '2021-11-05'),
('L203E2', 203, 0, NULL, '2021-11-05'),
('L203E3', 203, 0, NULL, '2021-11-05'),
('L203E4', 203, 0, NULL, '2021-11-05'),
('L204E1', 204, 0, NULL, '2021-11-05'),
('L204E2', 204, 0, NULL, '2021-11-05'),
('L204E3', 204, 0, NULL, '2021-11-05'),
('L204E4', 204, 0, NULL, '2021-11-05'),
('L204E5', 204, 0, NULL, '2021-11-05'),
('L205E1', 205, 0, NULL, '2021-11-05'),
('L205E2', 205, 0, NULL, '2021-11-05'),
('L205E3', 205, 0, NULL, '2021-11-05'),
('L205E4', 205, 0, NULL, '2021-11-05'),
('L206E1', 206, 0, NULL, '2021-11-05'),
('L206E2', 206, 0, NULL, '2021-11-05'),
('L206E3', 206, 0, NULL, '2021-11-05'),
('L207E1', 207, 0, NULL, '2021-11-05'),
('L207E2', 207, 0, NULL, '2021-11-05'),
('L207E3', 207, 0, NULL, '2021-11-05'),
('L207E4', 207, 0, NULL, '2021-11-05'),
('L208E1', 208, 0, NULL, '2021-11-05'),
('L208E2', 208, 0, NULL, '2021-11-05'),
('L209E1', 209, 0, NULL, '2021-11-05'),
('L209E2', 209, 0, NULL, '2021-11-05'),
('L210E1', 210, 0, NULL, '2021-11-05'),
('L210E10', 210, 0, NULL, '2021-11-05'),
('L210E2', 210, 0, NULL, '2021-11-05'),
('L210E3', 210, 0, NULL, '2021-11-05'),
('L210E4', 210, 0, NULL, '2021-11-05'),
('L210E5', 210, 0, NULL, '2021-11-05'),
('L210E6', 210, 0, NULL, '2021-11-05'),
('L210E7', 210, 0, NULL, '2021-11-05'),
('L210E8', 210, 0, NULL, '2021-11-05'),
('L210E9', 210, 0, NULL, '2021-11-05'),
('L211E1', 211, 0, NULL, '2021-11-05'),
('L211E2', 211, 0, NULL, '2021-11-05'),
('L211E3', 211, 0, NULL, '2021-11-05'),
('L211E4', 211, 0, NULL, '2021-11-05'),
('L211E5', 211, 0, NULL, '2021-11-05'),
('L212E1', 212, 0, NULL, '2021-11-05'),
('L212E2', 212, 0, NULL, '2021-11-05'),
('L212E3', 212, 0, NULL, '2021-11-05'),
('L213E1', 213, 0, NULL, '2021-11-14'),
('L213E2', 213, 0, NULL, '2021-11-14'),
('L213E3', 213, 0, NULL, '2021-11-14'),
('L213E4', 213, 0, NULL, '2021-11-14'),
('L213E5', 213, 0, NULL, '2021-11-14'),
('L214E1', 214, 0, NULL, '2021-11-14'),
('L214E2', 214, 0, NULL, '2021-11-14'),
('L214E3', 214, 0, NULL, '2021-11-14'),
('L214E4', 214, 0, NULL, '2021-11-14'),
('L214E5', 214, 0, NULL, '2021-11-14'),
('L215E1', 215, 0, NULL, '2021-11-14'),
('L215E2', 215, 0, NULL, '2021-11-14'),
('L215E3', 215, 0, NULL, '2021-11-14'),
('L215E4', 215, 0, NULL, '2021-11-14'),
('L215E5', 215, 0, NULL, '2021-11-14'),
('L216E1', 216, 0, NULL, '2021-11-14'),
('L216E2', 216, 0, NULL, '2021-11-14'),
('L216E3', 216, 0, NULL, '2021-11-14'),
('L216E4', 216, 0, NULL, '2021-11-14'),
('L216E5', 216, 0, NULL, '2021-11-14'),
('L217E1', 217, 0, NULL, '2021-11-15'),
('L217E2', 217, 0, NULL, '2021-11-15'),
('L218E1', 218, 0, NULL, '2021-11-15'),
('L218E2', 218, 0, NULL, '2021-11-15'),
('L219E1', 219, 0, NULL, '2021-11-15'),
('L219E2', 219, 0, NULL, '2021-11-15'),
('L220E1', 220, 0, NULL, '2021-11-15'),
('L220E2', 220, 0, NULL, '2021-11-15'),
('L221E1', 221, 0, NULL, '2021-11-15'),
('L221E2', 221, 0, NULL, '2021-11-15'),
('L222E1', 222, 0, NULL, '2021-11-15'),
('L222E2', 222, 0, NULL, '2021-11-15'),
('L223E1', 223, 0, NULL, '2021-11-15'),
('L223E2', 223, 0, NULL, '2021-11-15'),
('L224E1', 224, 0, NULL, '2021-11-15'),
('L224E2', 224, 0, NULL, '2021-11-15'),
('L225E1', 225, 0, NULL, '2021-11-15'),
('L225E10', 225, 0, NULL, '2021-11-15'),
('L225E2', 225, 0, NULL, '2021-11-15'),
('L225E3', 225, 0, NULL, '2021-11-15'),
('L225E4', 225, 0, NULL, '2021-11-15'),
('L225E5', 225, 0, NULL, '2021-11-15'),
('L225E6', 225, 0, NULL, '2021-11-15'),
('L225E7', 225, 0, NULL, '2021-11-15'),
('L225E8', 225, 0, NULL, '2021-11-15'),
('L225E9', 225, 0, NULL, '2021-11-15'),
('L226E1', 226, 0, NULL, '2021-11-15'),
('L226E2', 226, 0, NULL, '2021-11-15'),
('L227E1', 227, 0, NULL, '2021-11-15'),
('L227E2', 227, 0, NULL, '2021-11-15'),
('L228E1', 228, 0, NULL, '2021-11-15'),
('L228E2', 228, 0, NULL, '2021-11-15'),
('L229E1', 229, 0, NULL, '2021-11-15'),
('L229E2', 229, 0, NULL, '2021-11-15'),
('L230E1', 230, 0, NULL, '2021-11-15'),
('L230E2', 230, 0, NULL, '2021-11-15'),
('L231E1', 231, 0, NULL, '2021-11-15'),
('L231E2', 231, 0, NULL, '2021-11-15'),
('L232E1', 232, 0, NULL, '2021-11-15'),
('L232E2', 232, 0, NULL, '2021-11-15'),
('L233E1', 233, 0, NULL, '2021-11-15'),
('L233E2', 233, 0, NULL, '2021-11-15'),
('L234E1', 234, 0, NULL, '2021-11-15'),
('L234E2', 234, 0, NULL, '2021-11-15'),
('L235E1', 235, 0, NULL, '2021-11-15'),
('L235E2', 235, 0, NULL, '2021-11-15'),
('L236E1', 236, 0, NULL, '2021-11-15'),
('L236E2', 236, 0, NULL, '2021-11-15'),
('L237E1', 237, 0, NULL, '2021-11-15'),
('L237E2', 237, 0, NULL, '2021-11-15'),
('L238E1', 238, 0, NULL, '2021-11-15'),
('L238E2', 238, 0, NULL, '2021-11-15'),
('L239E1', 239, 0, NULL, '2021-11-15'),
('L239E2', 239, 0, NULL, '2021-11-15'),
('L240E1', 240, 0, NULL, '2021-11-15'),
('L240E2', 240, 0, NULL, '2021-11-15'),
('L241E1', 241, 0, NULL, '2021-11-15'),
('L241E2', 241, 0, NULL, '2021-11-15'),
('L242E1', 242, 0, NULL, '2021-11-15'),
('L242E2', 242, 0, NULL, '2021-11-15'),
('L243E1', 243, 0, NULL, '2021-11-18'),
('L243E2', 243, 0, NULL, '2021-11-18'),
('L244E1', 244, 0, NULL, '2021-11-18'),
('L244E2', 244, 0, NULL, '2021-11-18'),
('L245E1', 245, 0, NULL, '2021-11-18'),
('L246E1', 246, 0, NULL, '2021-11-18'),
('L246E2', 246, 0, NULL, '2021-11-18'),
('L247E1', 247, 0, NULL, '2021-11-18'),
('L247E2', 247, 0, NULL, '2021-11-18'),
('L247E3', 247, 0, NULL, '2021-11-18'),
('L247E4', 247, 0, NULL, '2021-11-18'),
('L247E5', 247, 0, NULL, '2021-11-18'),
('L248E1', 248, 0, NULL, '2021-11-18'),
('L248E10', 248, 0, NULL, '2021-11-18'),
('L248E2', 248, 0, NULL, '2021-11-18'),
('L248E3', 248, 0, NULL, '2021-11-18'),
('L248E4', 248, 0, NULL, '2021-11-18'),
('L248E5', 248, 0, NULL, '2021-11-18'),
('L248E6', 248, 0, NULL, '2021-11-18'),
('L248E7', 248, 0, NULL, '2021-11-18'),
('L248E8', 248, 0, NULL, '2021-11-18'),
('L248E9', 248, 0, NULL, '2021-11-18'),
('L2E1', 2, 0, NULL, '2021-10-29'),
('L2E2', 2, 0, NULL, '2021-10-29'),
('L2E3', 2, 0, NULL, '2021-10-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplar_estados`
--

DROP TABLE IF EXISTS `ejemplar_estados`;
CREATE TABLE IF NOT EXISTS `ejemplar_estados` (
  `idEjemplarEstado` int(11) NOT NULL AUTO_INCREMENT,
  `ejemplarEstado` varchar(15) NOT NULL,
  PRIMARY KEY (`idEjemplarEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_mail`
--

DROP TABLE IF EXISTS `estado_mail`;
CREATE TABLE IF NOT EXISTS `estado_mail` (
  `idEstadoMail` int(11) NOT NULL,
  `tipoEstado` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idEstadoMail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_mail`
--

INSERT INTO `estado_mail` (`idEstadoMail`, `tipoEstado`) VALUES
(0, 'No verificado'),
(1, 'Verificado');

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
-- Estructura de tabla para la tabla `imagen_libros`
--

DROP TABLE IF EXISTS `imagen_libros`;
CREATE TABLE IF NOT EXISTS `imagen_libros` (
  `idLibro` int(11) NOT NULL,
  `idImagen` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` text NOT NULL,
  `idCategoriaImg` int(11) NOT NULL,
  PRIMARY KEY (`idImagen`),
  KEY `fk_img_idx` (`idLibro`),
  KEY `fk_imgCt_idx` (`idCategoriaImg`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagen_libros`
--

INSERT INTO `imagen_libros` (`idLibro`, `idImagen`, `ruta`, `idCategoriaImg`) VALUES
(2, 1, 'assets/libros/libro-anatomia.png', 1),
(1, 2, 'assets/libros/libro-mafalda.png', 1),
(127, 3, 'assets/libros/libro-basedatos.png', 1),
(175, 4, 'assets/libros/libro-economia.png', 2),
(176, 5, 'assets/libros/libro-linux.png', 1),
(177, 6, 'assets/libros/libro-sistemas.png', 1),
(182, 9, 'assets/libros/libro-quimica.png', 1),
(184, 12, 'assets/libros/Breve historia de los argentinos.png', 1),
(186, 14, 'assets/libros/english for it.png', 1),
(187, 16, 'assets/libros/lenguaje unificado de modelado.jpg', 1),
(189, 19, 'assets/libros/pro git.jpg', 1),
(190, 20, 'assets/libros/higiene.png', 1),
(191, 21, 'assets/libros/contaduria.png', 1),
(194, 24, 'assets/libros/industrial.png', 1),
(198, 26, 'assets/libros/el-amor-en-los-tiemos-de-colera.gif', 1),
(211, 54, 'assets/libros/la_uruguaya.png', 1),
(211, 55, 'assets/libros/la_uruguaya.png', 2),
(223, 78, 'assets/libros/quimica2.jpg', 1),
(223, 79, 'assets/libros/quimica2.jpg', 2),
(244, 111, 'assets/libros/industrial.png', 1),
(245, 112, 'assets/libros/diego.png', 1),
(247, 114, 'assets/libros/lenguaje de programacion c.jpg', 1),
(248, 115, 'assets/libros/quimica2.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

DROP TABLE IF EXISTS `libros`;
CREATE TABLE IF NOT EXISTS `libros` (
  `idLibro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `pdf` text,
  `stock` int(11) NOT NULL,
  `fechaAlta` date NOT NULL,
  `imagen_libro` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idLibro`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`idLibro`, `titulo`, `descripcion`, `pdf`, `stock`, `fechaAlta`, `imagen_libro`) VALUES
(1, 'mafalda', 'humor', 'assets/libros/pdf/Toda Mafalda.pdf', 1, '2021-09-10', NULL),
(2, 'alicia', 'cuento', NULL, 0, '2021-09-10', NULL),
(127, 'Base de datos', 'Base de datos', NULL, 5, '2021-10-20', NULL),
(175, 'Economia', 'Economia', NULL, 1, '2021-10-29', NULL),
(176, 'Linux For Beginners', 'Linux ', NULL, 1, '2021-10-24', NULL),
(177, 'DatosExistentes', 'DatosExistentes', NULL, 0, '2021-10-25', NULL),
(182, 'Quimica', 'Undecima edicion', NULL, 9, '2021-11-03', NULL),
(184, 'Breve historia de los argentinos', 'Breve historia de los argentinos desde 1800 en adelante', NULL, 10, '2021-11-03', NULL),
(186, 'english for it', 'learn english', NULL, 9, '2021-11-10', NULL),
(187, 'lenguaje unificado de modelado', 'lenguaje unificado de modelado', NULL, 15, '2021-11-03', NULL),
(189, 'pro git', 'pro git', NULL, 5, '2021-11-03', NULL),
(190, 'Seguridad e higiene', 'Seguridad e higiene basico', NULL, 0, '2021-11-03', NULL),
(191, 'Contaduria', 'Contaduria2', NULL, 5, '2021-11-03', NULL),
(194, 'DiseÃ±o industrialEditar2', 'DiseÃ±o industrialEditar2', NULL, 5, '2021-11-03', NULL),
(198, 'El amor en los tiempos de colera', 'el amor en los tiempos de colera', ' ', 5, '2021-11-05', NULL),
(211, 'La uruguaya', 'La uruguaya', '', 4, '2021-11-05', NULL),
(223, 'Quimicaprueba', 'Quimicaprueba', '', 2, '2021-11-15', NULL),
(244, 'DiseÃ±o industrial 3', 'DiseÃ±o industrial 2', '', 2, '2021-11-18', NULL),
(245, 'Diego', 'Breve historia del Diego', '', 10, '2021-11-18', NULL),
(247, 'Libro prueba', 'Libro prueba', 'assets/libros/pdf/gantt.pdf', 5, '2021-11-18', NULL),
(248, 'Quimica basica', 'Breve historia', 'assets/libros/pdf/doc.pdf', 2, '2021-11-18', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_autores`
--

DROP TABLE IF EXISTS `libro_autores`;
CREATE TABLE IF NOT EXISTS `libro_autores` (
  `idAutores` int(11) NOT NULL,
  `idLibro` int(11) NOT NULL,
  PRIMARY KEY (`idLibro`),
  UNIQUE KEY `idLibro_UNIQUE` (`idLibro`),
  KEY `fk_libAut_autor` (`idAutores`),
  KEY `fk_libAut_libro` (`idLibro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro_autores`
--

INSERT INTO `libro_autores` (`idAutores`, `idLibro`) VALUES
(1, 1),
(1, 177),
(3, 198),
(4, 2),
(148, 182),
(150, 184),
(156, 186),
(156, 187),
(156, 189),
(156, 190),
(156, 191),
(156, 194),
(156, 211),
(156, 223),
(156, 244),
(156, 247),
(156, 248),
(166, 245),
(167, 127),
(168, 175),
(169, 176);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_categorias`
--

DROP TABLE IF EXISTS `libro_categorias`;
CREATE TABLE IF NOT EXISTS `libro_categorias` (
  `idCategoria` int(11) NOT NULL,
  `idLibro` int(11) NOT NULL,
  PRIMARY KEY (`idLibro`),
  UNIQUE KEY `idLibro_UNIQUE` (`idLibro`),
  KEY `fk_libCat_cat` (`idCategoria`),
  KEY `fk_libCat_libro` (`idLibro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro_categorias`
--

INSERT INTO `libro_categorias` (`idCategoria`, `idLibro`) VALUES
(1, 1),
(1, 198),
(3, 2),
(3, 194),
(3, 248),
(5, 184),
(5, 245),
(144, 177),
(148, 182),
(155, 186),
(156, 187),
(158, 189),
(159, 190),
(160, 191),
(160, 211),
(160, 223),
(160, 244),
(160, 247),
(164, 127),
(164, 176),
(165, 175);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_editoriales`
--

DROP TABLE IF EXISTS `libro_editoriales`;
CREATE TABLE IF NOT EXISTS `libro_editoriales` (
  `idLibro` int(11) NOT NULL,
  `idEditorial` int(11) NOT NULL,
  PRIMARY KEY (`idLibro`),
  UNIQUE KEY `idLibro_UNIQUE` (`idLibro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libro_editoriales`
--

INSERT INTO `libro_editoriales` (`idLibro`, `idEditorial`) VALUES
(1, 1),
(2, 2),
(127, 80),
(175, 86),
(176, 2),
(177, 1),
(182, 138),
(184, 143),
(186, 144),
(187, 144),
(189, 144),
(190, 144),
(191, 144),
(194, 140),
(198, 2),
(211, 144),
(223, 144),
(244, 144),
(245, 138),
(247, 144),
(248, 144);

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
  `nombrePais` varchar(20) NOT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

DROP TABLE IF EXISTS `provincias`;
CREATE TABLE IF NOT EXISTS `provincias` (
  `idProvincia` int(11) NOT NULL,
  `idPais` int(11) NOT NULL,
  `nombreProvincia` varchar(20) NOT NULL,
  PRIMARY KEY (`idProvincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `idReserva` varchar(20) NOT NULL,
  `idEjemplar` varchar(20) NOT NULL,
  `idReservaEstado` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaDesde` date NOT NULL,
  `fechaHasta` date NOT NULL,
  PRIMARY KEY (`idReserva`),
  KEY `fk_resEjem` (`idEjemplar`),
  KEY `fk_resUsu` (`idUsuario`),
  KEY `fk_reest` (`idReservaEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idReserva`, `idEjemplar`, `idReservaEstado`, `idUsuario`, `fechaDesde`, `fechaHasta`) VALUES
('R106752177', 'L177E1', 0, 251, '2021-10-30', '2021-11-13'),
('R123436177', 'L177E1', 0, 251, '2021-10-28', '2021-11-11'),
('R12345', 'L181E5', 0, 251, '2021-09-13', '2021-09-13'),
('R123452', 'L181E5', 0, 251, '2021-09-13', '2021-09-13'),
('R159645181', 'L181E1', 0, 251, '2021-10-28', '2021-11-11'),
('R171774181', 'L181E1', 0, 251, '2021-10-28', '2021-11-11'),
('R196957177', 'L177E1', 0, 251, '2021-10-30', '2021-11-13'),
('R238235175', 'L175E1', 0, 251, '2021-10-27', '2021-11-10'),
('R302538211', 'L211E1', 0, 254, '2021-11-05', '2021-11-19'),
('R320518175', 'L175E1', 0, 251, '2021-10-27', '2021-11-10'),
('R335273194', 'L194E1', 1, 27, '2021-11-05', '2021-11-19'),
('R346489203', 'L203E1', 0, 251, '2021-11-05', '2021-11-19'),
('R368057186', 'L186E1', 0, 251, '2021-11-03', '2021-11-17'),
('R383183194', 'L194E1', 3, 27, '2021-11-05', '2021-11-19'),
('R392292182', 'L182E1', 4, 251, '2021-11-03', '2021-11-17'),
('R4110122', 'L2E1', 0, 251, '2021-10-29', '2021-11-12'),
('R4512802', 'L2E1', 0, 251, '2021-10-29', '2021-11-12'),
('R4991092', 'L2E1', 0, 251, '2021-10-27', '2021-11-10'),
('R499767194', 'L194E1', 3, 27, '2021-11-05', '2021-11-19'),
('R6992422', 'L2E1', 0, 251, '2021-10-27', '2021-11-10'),
('R7729802', 'L2E1', 0, 251, '2021-11-03', '2021-11-17'),
('R812999177', 'L177E1', 0, 251, '2021-11-03', '2021-11-17'),
('R852393175', 'L175E1', 0, 251, '2021-10-27', '2021-11-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_estados`
--

DROP TABLE IF EXISTS `reserva_estados`;
CREATE TABLE IF NOT EXISTS `reserva_estados` (
  `idReservaEstado` int(11) NOT NULL,
  `nombreReserva` varchar(100) NOT NULL,
  PRIMARY KEY (`idReservaEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva_estados`
--

INSERT INTO `reserva_estados` (`idReservaEstado`, `nombreReserva`) VALUES
(0, 'finalizada'),
(1, 'pendiente'),
(2, 'activa'),
(3, 'expirada'),
(4, 'cancelada');

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
  `idSugerencia` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idAsunto` int(11) NOT NULL,
  `sugerencia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idSugerencia`),
  KEY `fk_sugUsu` (`idUsuario`)
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
  `ping` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `idEstado` (`idEstado`),
  KEY `idRol` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `idTipoDocumento`, `idLocalidad`, `idEstado`, `idRol`, `nombre`, `apellido`, `numeroDocumento`, `mail`, `contrasena`, `telefono`, `direccion`, `departamento`, `check_mail`, `ping`) VALUES
(20, NULL, NULL, 1, 3, 'Sabrina', NULL, NULL, 'sabrina@beltran.com', '12345', NULL, NULL, NULL, 1, '123456'),
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
(250, 0, 0, 1, 3, 'sabrina', '[value-7]', '[value-8]', 'sabrinach@beltran.com', '12345', '[value-11]', '[value-12]', '[value-13]', 1, '[value-15]'),
(251, NULL, NULL, 1, 2, 'Jeremias', NULL, NULL, 'jmontllau@gmail.com', '$2y$10$TxzvMmE1LDLJCBEasG2NgOjDMej4QYjohk2hvzfMb02p26VNlPftW', NULL, NULL, NULL, 1, '100119'),
(252, NULL, NULL, 1, 1, 'Jeremias', NULL, NULL, 'jere.m28@hotmail.com', '$2y$10$OJpxOc/H8fiBisNHLtMi5uFcN.tQXASqg7dlZytYD5DxtQ/m17eWK', NULL, NULL, NULL, 0, '399122'),
(253, NULL, NULL, 1, 1, 'saraza123', NULL, NULL, 'saraza123@beltran.com', '$2y$10$gtOj3Yp.psRySS22r3UNVenNVvKLJ4ZwxeOI3d6FuHwhzeRdxYLva', NULL, NULL, NULL, 1, '568567'),
(254, NULL, NULL, 1, 1, 'Sabrina', NULL, NULL, 'chavez.sabrina@live.com', '$2y$10$9q0I5jT1GZdZaz0YcFflA.1R2md05QMxbqjVpvAVScd4w8ncwI5Nu', NULL, NULL, NULL, 1, '762421');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_librohistorial_res`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vw_librohistorial_res`;
CREATE TABLE IF NOT EXISTS `vw_librohistorial_res` (
`titulo` varchar(200)
,`idEjemplar` varchar(20)
,`idReserva` varchar(20)
,`fechaDesde` date
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_libro_res`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vw_libro_res`;
CREATE TABLE IF NOT EXISTS `vw_libro_res` (
`titulo` varchar(200)
,`idEjemplar` varchar(20)
,`idReserva` varchar(20)
,`fechaDesde` date
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_librohistorial_res`
--
DROP TABLE IF EXISTS `vw_librohistorial_res`;

DROP VIEW IF EXISTS `vw_librohistorial_res`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_librohistorial_res`  AS  select `l`.`titulo` AS `titulo`,`e`.`idEjemplar` AS `idEjemplar`,`r`.`idReserva` AS `idReserva`,`r`.`fechaDesde` AS `fechaDesde` from ((`libros` `l` join `ejemplares` `e` on((`l`.`idLibro` = `e`.`idLibro`))) join `reservas` `r` on((`r`.`idEjemplar` = `e`.`idEjemplar`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_libro_res`
--
DROP TABLE IF EXISTS `vw_libro_res`;

DROP VIEW IF EXISTS `vw_libro_res`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_libro_res`  AS  select `l`.`titulo` AS `titulo`,`e`.`idEjemplar` AS `idEjemplar`,`r`.`idReserva` AS `idReserva`,`r`.`fechaDesde` AS `fechaDesde` from ((`libros` `l` join `ejemplares` `e` on((`l`.`idLibro` = `e`.`idLibro`))) join `reservas` `r` on((`r`.`idEjemplar` = `e`.`idEjemplar`))) where (`r`.`fechaDesde` >= (now() - interval '30' day)) ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagen_libros`
--
ALTER TABLE `imagen_libros`
  ADD CONSTRAINT `fk_img` FOREIGN KEY (`idLibro`) REFERENCES `libros` (`idLibro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_imgCt` FOREIGN KEY (`idCategoriaImg`) REFERENCES `categoria_imagenes` (`idCategoriaImg`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reest` FOREIGN KEY (`idReservaEstado`) REFERENCES `reserva_estados` (`idReservaEstado`),
  ADD CONSTRAINT `fk_resEjem` FOREIGN KEY (`idEjemplar`) REFERENCES `ejemplares` (`idEjemplar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resUsu` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  ADD CONSTRAINT `fk_sugUsu` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

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
