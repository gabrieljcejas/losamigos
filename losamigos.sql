-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2016 a las 04:05:33
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `losamigos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `domicilio` varchar(120) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `gps` varchar(60) DEFAULT NULL,
  `obs` varchar(120) DEFAULT NULL,
  `dni` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `domicilio`, `telefono`, `gps`, `obs`, `dni`) VALUES
(1, 'Consumidor Final', '-', '-', NULL, '-', 0),
(2, 'Cejas Gabriel', 'Don Bosco 1234', '4357478', NULL, '', 31724990),
(3, 'JuanCho', 'pirulin 4545', '4358978', NULL, '', 33130295),
(4, 'Marianela', 'Misiones 1188', '43358877', NULL, 'perra', 33070103);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `forma_pago` int(11) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `obs` varchar(120) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_detalle`
--

CREATE TABLE IF NOT EXISTS `compras_detalle` (
  `id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `cant` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `detalle` varchar(120) NOT NULL,
  `precio_lista` decimal(15,2) NOT NULL,
  `precio_venta` decimal(15,2) NOT NULL,
  `nombre_foto` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `stock_minimo` int(11) NOT NULL DEFAULT '10'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `detalle`, `precio_lista`, `precio_venta`, `nombre_foto`, `stock`, `stock_minimo`) VALUES
(1, 'Pollo + Papa', 'Promo', '170.00', '190.00', 'promo.jpg', 0, 0),
(3, 'Pollo', '', '70.00', '170.00', 'pollo.jpg', 78, 20),
(4, 'Medio Pollo', '', '35.00', '95.00', 'mediopollo.png', 160, 20),
(5, 'Pata Muslo', '', '0.00', '40.00', 'patamuslo.jpg', 0, 20),
(6, 'Papas Fritas', '', '10.00', '30.00', 'papasfritas.jpg', 58, 100),
(7, 'Ensalada', '', '25.00', '40.00', 'ensalada.gif', 5, 5),
(9, 'EMPANADAS DOCENA', 'DOCENA', '60.00', '130.00', 'empandas.jpg', 0, 0),
(10, 'EMPANADAS MEDIA DOCENA', 'MEDIA DOCENA', '30.00', '80.00', '6empandas.jpg', 0, 0),
(11, 'Tarta', '', '60.00', '100.00', 'tarta.jpg', 0, 0),
(12, 'PEPSI', '1,5 LTS', '20.00', '27.00', 'pepsi.png', 0, 0),
(13, '7up', '1.5 lts', '20.00', '27.00', 'sevenup.png', 0, 0),
(14, 'Paso de los Toros', '1.5 lts', '20.00', '27.00', 'pasodelostoros.jpg', 0, 0),
(15, 'Levite', '1.5 lts', '18.00', '25.00', 'levite.png', 0, 0),
(16, 'Quilmes', '1lt', '20.00', '28.00', 'quilmes.png', 0, 0),
(17, 'Budweiser', '1lt', '21.00', '30.00', 'budweiser.jpg', 0, 0),
(18, 'SCHNEIDER', '1LT', '20.00', '27.00', 'schneider.jpg', 0, 0),
(19, 'Stella Artois', '1lt', '25.00', '35.00', 'stellaartois.png', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `domicilio` varchar(120) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `cuit` varchar(30) DEFAULT NULL,
  `obs` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `forma_pago` int(11) NOT NULL DEFAULT '1',
  `obs` varchar(120) NOT NULL,
  `envio_domicilio` int(11) DEFAULT NULL,
  `retira` int(11) DEFAULT NULL,
  `fecha_encargue` date DEFAULT NULL,
  `hora_encargue` varchar(10) DEFAULT NULL,
  `total` decimal(15,2) NOT NULL,
  `paga` decimal(15,2) DEFAULT NULL,
  `vuelto` decimal(15,2) DEFAULT NULL,
  `entregado` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `cliente_id`, `forma_pago`, `obs`, `envio_domicilio`, `retira`, `fecha_encargue`, `hora_encargue`, `total`, `paga`, `vuelto`, `entregado`, `usuario_id`) VALUES
(4, '2016-04-06 17:56:45', 2, 1, '', NULL, NULL, NULL, NULL, '200.00', '200.00', '0.00', 1, NULL),
(5, '2016-04-06 18:04:21', 3, 1, '', 1, NULL, NULL, NULL, '110.00', '200.00', '90.00', 1, NULL),
(6, '2016-04-07 00:32:18', 4, 1, '', 1, NULL, NULL, NULL, '200.00', '200.00', '0.00', 1, NULL),
(7, '2016-04-07 01:03:16', 4, 1, '', 1, NULL, NULL, NULL, '370.00', '400.00', '30.00', 1, NULL),
(8, '2016-04-07 03:48:59', 1, 1, 'PAsa a buscar ', NULL, NULL, NULL, NULL, '220.00', '300.00', '80.00', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE IF NOT EXISTS `ventas_detalle` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `cant` int(11) NOT NULL,
  `precio` decimal(15,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id`, `venta_id`, `prod_id`, `cant`, `precio`) VALUES
(5, 4, 3, 1, '170.00'),
(6, 4, 6, 1, '30.00'),
(7, 5, 6, 1, '30.00'),
(8, 5, 5, 2, '40.00'),
(9, 6, 3, 1, '170.00'),
(10, 6, 6, 1, '30.00'),
(11, 7, 3, 2, '170.00'),
(12, 7, 6, 1, '30.00'),
(13, 8, 1, 1, '190.00'),
(14, 8, 6, 1, '30.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
