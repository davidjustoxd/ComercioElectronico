-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-11-2021 a las 21:08:29
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `carrito`
--
CREATE DATABASE `carrito` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `carrito`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `codCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`codCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`codCategoria`, `descripcion`) VALUES
(1, 'Frenos'),
(2, 'Horquillas'),
(3, 'Patillas de cambio'),
(4, 'Pulsadores de cambio'),
(5, 'Desviadores delanteros'),
(6, 'Piñoneras'),
(7, 'Discos de freno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaspedido`
--

CREATE TABLE IF NOT EXISTS `lineaspedido` (
  `codLineaPedido` int(11) NOT NULL AUTO_INCREMENT,
  `codPedido` int(11) NOT NULL,
  `codProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  PRIMARY KEY (`codLineaPedido`),
  KEY `codPedido` (`codPedido`),
  KEY `codProducto` (`codProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `lineaspedido`
--

INSERT INTO `lineaspedido` (`codLineaPedido`, `codPedido`, `codProducto`, `cantidad`, `precio`) VALUES
(1, 1, 3, 2, '0.00'),
(2, 1, 2, 1, '0.00'),
(3, 2, 1, 1, '0.00'),
(4, 2, 3, 3, '0.00'),
(5, 3, 1, 3, '0.00'),
(6, 3, 8, 2, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `codPedido` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(25) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`codPedido`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`codPedido`, `usuario`, `fecha`) VALUES
(1, 'davidjfo', '2021-11-11 11:23:02'),
(2, 'davidjfo', '2021-11-24 18:10:11'),
(3, 'davidjfo', '2021-11-24 19:49:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `codProducto` int(11) NOT NULL AUTO_INCREMENT,
  `codCategoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`codProducto`),
  KEY `codCategoria` (`codCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codProducto`, `codCategoria`, `nombre`, `precio`, `descripcion`) VALUES
(1, 1, 'Freno de disco Shimano Deore Pareja', '70.00', 'Pareja de frenos de disco Shimano Deore, el mejor equilibrio calidad-precio.'),
(2, 1, 'Freno de disco Shimano SLX Pareja', '110.00', 'Pareja de frenos Shimano SLX, con mejoras de rendimiento en frenada.'),
(3, 1, 'Freno de disco Shimano Deore XT Pareja', '160.00', 'Frenos con excelente rendimiento y peso ajustado. Gama alta'),
(8, 1, 'Freno de disco Shimano Deore XTR Pareja', '250.00', 'Lo mejor de lo mejor de Shimano. Ultraligeros, ultrapotentes y duraderos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario` varchar(25) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(50) NOT NULL,
  `esAdmin` tinyint(1) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `codigoPostal` int(11) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `password`, `email`, `esAdmin`, `Nombre`, `Apellidos`, `Direccion`, `codigoPostal`) VALUES
('davidjfo', '4E5FB359B9FD8A1C1AE85E431936D3FC80CC4C917620162D0FD1930C47BB0CD8D7424C99E6C88B6E09D406F8BE2C51B17EECF460A2FFB2CFC8C6994C9B4D90FB', 'davidjustoxd@gmail.com', 1, 'David', 'Justo Fontan', 'Chandevila, 3C', 36966),
('monicajfo', '4e5fb359b9fd8a1c1ae85e431936d3fc80cc4c917620162d0fd1930c47bb0cd8d7424c99e6c88b6e09d406f8be2c51b17eecf460a2ffb2cfc8c6994c9b4d90fb', 'monica@aasdf.com', 0, 'Mónica', 'Justo Fontán', 'Chandevila 3C', 36966),
('rodrigolf', '4E5FB359B9FD8A1C1AE85E431936D3FC80CC4C917620162D0FD1930C47BB0CD8D7424C99E6C88B6E09D406F8BE2C51B17EECF460A2FFB2CFC8C6994C9B4D90FB', 'rodrigolopezfontan@gmail.com', 0, 'Rodrigo', 'Lopez Fontan', 'Seixalvo 43', 36960);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineaspedido`
--
ALTER TABLE `lineaspedido`
  ADD CONSTRAINT `lineaspedido_ibfk_1` FOREIGN KEY (`codPedido`) REFERENCES `pedidos` (`codPedido`),
  ADD CONSTRAINT `lineaspedido_ibfk_2` FOREIGN KEY (`codProducto`) REFERENCES `productos` (`codProducto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`codCategoria`) REFERENCES `categorias` (`codCategoria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
