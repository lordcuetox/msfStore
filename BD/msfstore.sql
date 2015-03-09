-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2015 a las 16:12:07
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `msfstore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificaciones`
--

CREATE TABLE IF NOT EXISTS `clasificaciones` (
  `CVE_CLASIFICACION` int(11) NOT NULL,
  `CVE_RITO` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='se clasifican en dos simbolicay filosofica';

--
-- Volcado de datos para la tabla `clasificaciones`
--

INSERT INTO `clasificaciones` (`CVE_CLASIFICACION`, `CVE_RITO`, `DESCRIPCION`, `ACTIVO`) VALUES
(1, 1, 'SIMBOLICO', 1),
(2, 1, 'FILOSOFICO', 1),
(3, 3, 'SIMBOLICO', 1),
(4, 2, 'SIMBOLICO', 1),
(5, 2, 'FILOSOFICO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificaciones_productos`
--

CREATE TABLE IF NOT EXISTS `clasificaciones_productos` (
  `CVE_RITO` int(11) NOT NULL,
  `CVE_CLASIFICACION` int(11) NOT NULL,
  `CVE_GRADO` int(11) NOT NULL,
  `CVE_CLAS_PRODUCTO` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clasificaciones_productos`
--

INSERT INTO `clasificaciones_productos` (`CVE_RITO`, `CVE_CLASIFICACION`, `CVE_GRADO`, `CVE_CLAS_PRODUCTO`, `DESCRIPCION`, `ACTIVO`) VALUES
(1, 1, 1, 1, 'ARREOS', 1),
(1, 1, 1, 10, 'LIBROS', 1),
(1, 1, 1, 11, 'JOYAS', 1),
(1, 1, 1, 12, 'dfdfsdfs', 1),
(1, 1, 2, 2, 'JOYAS', 1),
(1, 1, 2, 7, 'ARREO', 1),
(1, 1, 4, 4, 'Libros', 1),
(1, 2, 5, 3, 'Arreos', 1),
(1, 2, 5, 8, 'JOYAS', 1),
(1, 2, 6, 5, 'ARREOS', 1),
(1, 2, 6, 6, 'LIBROS', 1),
(3, 3, 9, 9, 'ARREOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunicaciones_clientes`
--

CREATE TABLE IF NOT EXISTS `comunicaciones_clientes` (
  `CVE_CLIENTE` int(11) NOT NULL,
  `CVE_COMUNICACION` int(11) NOT NULL,
  `CONSECUTIVO_COMUNICACION` int(11) NOT NULL,
  `DATO` varchar(50) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedidos`
--

CREATE TABLE IF NOT EXISTS `detalles_pedidos` (
  `CVE_CLIENTE` int(11) NOT NULL,
  `CVE_PEDIDO` int(11) NOT NULL,
  `CVE_RITO` int(11) NOT NULL,
  `CVE_CLASIFICACION` int(11) NOT NULL,
  `CVE_GRADO` int(11) NOT NULL,
  `CVE_CLAS_PRODUCTO` int(11) NOT NULL,
  `CANTIDAD` int(11) DEFAULT NULL,
  `PRECIO_UNITARIO` float DEFAULT NULL,
  `DESCUENTO` tinyint(1) DEFAULT NULL,
  `PRECIO_UNITARIO_DESC` float DEFAULT NULL,
  `MONTO_TOTAL_PAGAR` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `el_reaton`
--

CREATE TABLE IF NOT EXISTS `el_reaton` (
  `CVE_REATA` int(11) NOT NULL,
  `HABILITADO` varchar(50) DEFAULT NULL,
  `FRESITA` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `el_reaton`
--

INSERT INTO `el_reaton` (`CVE_REATA`, `HABILITADO`, `FRESITA`) VALUES
(1, 'DIEGO2', 'ACTUALIZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE IF NOT EXISTS `grados` (
  `CVE_RITO` int(11) NOT NULL,
  `CVE_CLASIFICACION` int(11) NOT NULL,
  `CVE_GRADO` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='grados de los ritos por clasificacion';

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`CVE_RITO`, `CVE_CLASIFICACION`, `CVE_GRADO`, `DESCRIPCION`, `ACTIVO`) VALUES
(1, 1, 1, 'APRENDIZ', 1),
(1, 1, 2, 'COMPAÃ‘ERO', 1),
(1, 1, 3, 'MAESTRO', 1),
(1, 1, 4, 'PASTMASTER', 1),
(1, 1, 8, 'VENERABLE', 1),
(1, 2, 5, 'GRADO 14', 1),
(1, 2, 6, 'GRADO 30', 1),
(1, 2, 7, 'GRADO 18', 1),
(3, 3, 9, 'APRENDIZ', 1),
(2, 4, 10, 'COMPAÃ‘ERO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medios_comunicacion`
--

CREATE TABLE IF NOT EXISTS `medios_comunicacion` (
  `CVE_COMUNICACION` int(11) NOT NULL,
  `DESCRIPCION` varchar(100) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `CVE_CLIENTE` int(11) NOT NULL,
  `CVE_PEDIDO` int(11) NOT NULL,
  `REFERENCIA` varchar(20) DEFAULT NULL,
  `FECHA` datetime DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `MONTO_TOTAL` float DEFAULT NULL,
  `FECHA_ACTUALIZACION` datetime DEFAULT NULL,
  `NUMERO_GUIA` varchar(50) DEFAULT NULL,
  `DESCRIPCION_GUIA` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `CVE_RITO` int(11) NOT NULL,
  `CVE_CLASIFICACION` int(11) NOT NULL,
  `CVE_GRADO` int(11) NOT NULL,
  `CVE_CLAS_PRODUCTO` int(11) NOT NULL,
  `CVE_PRODUCTO` int(11) NOT NULL DEFAULT '0',
  `NOMBRE` varchar(100) DEFAULT NULL,
  `DESCRIPCION` varchar(300) DEFAULT NULL,
  `RUTA_IMAGEN1` varchar(50) DEFAULT NULL,
  `RUTA_IMAGEN2` varchar(50) DEFAULT NULL,
  `RUTA_IMAGEN3` varchar(50) DEFAULT NULL,
  `RUTA_IMAGEN4` varchar(50) DEFAULT NULL,
  `PRECIO` float DEFAULT NULL,
  `NOVEDAD` tinyint(1) DEFAULT NULL,
  `FECHA_NOVEDAD` datetime DEFAULT NULL,
  `OFERTA` tinyint(1) DEFAULT NULL,
  `FECHA_OFERTA` datetime DEFAULT NULL,
  `PRECIO_OFERTA` float DEFAULT NULL,
  `EXISTENCIAS` int(11) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`CVE_RITO`, `CVE_CLASIFICACION`, `CVE_GRADO`, `CVE_CLAS_PRODUCTO`, `CVE_PRODUCTO`, `NOMBRE`, `DESCRIPCION`, `RUTA_IMAGEN1`, `RUTA_IMAGEN2`, `RUTA_IMAGEN3`, `RUTA_IMAGEN4`, `PRECIO`, `NOVEDAD`, `FECHA_NOVEDAD`, `OFERTA`, `FECHA_OFERTA`, `PRECIO_OFERTA`, `EXISTENCIAS`, `ACTIVO`) VALUES
(1, 1, 1, 1, 1, 'MANDIL DE APRENDIZ', 'Mandil de aprendiz, hecho en tela lisa de tergal, color blanco, ribeteado en azul, con cordones de algodón.', 'img/productos/1.jpg', NULL, NULL, NULL, 110, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 95, 12, 1),
(1, 1, 1, 1, 2, 'MANDIL DE APRENDIZ PIEL', 'Mandil de aprendiz, hecho en tela lisa de tergal, color blanco, ribeteado en azul, con cordones de algodón.', 'img/productos/2.jpg', NULL, NULL, NULL, 110, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 95, 12, 1),
(1, 1, 1, 1, 3, 'MANDIL DE APRENDIZ ALGODÓN', 'Mandil de aprendiz, hecho en tela lisa de tergal, color blanco, ribeteado en azul, con cordones de algodón.', 'img/productos/3.jpg', NULL, NULL, NULL, 110, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 95, 12, 1),
(1, 1, 1, 1, 4, 'MANDIL DE APRENDIZ TACTO PIEL', 'Mandil de aprendiz, hecho en tela lisa de tergal, color blanco, ribeteado en azul, con cordones de algodón.', 'img/productos/4.jpg', NULL, NULL, NULL, 110, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 95, 12, 1),
(1, 1, 1, 1, 6, 'xcvx', 'cvxcv', NULL, NULL, NULL, NULL, 12, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 2, 25, 1),
(1, 1, 1, 1, 7, 'fgfdgd', 'dfgdfg', NULL, NULL, NULL, NULL, 8, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 3, 67, 1),
(1, 1, 1, 1, 8, 'cvxxcv', 'erdfbcv', NULL, NULL, NULL, NULL, 12, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 23, 34, 1),
(1, 1, 1, 1, 9, 'Pin', 'wdasfadf', NULL, NULL, NULL, NULL, 100, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 85, 125, 1),
(1, 1, 2, 2, 5, 'pin', 'descripciÃ³n', NULL, NULL, NULL, NULL, 12, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 8, 25, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prospectos`
--

CREATE TABLE IF NOT EXISTS `prospectos` (
  `CVE_CLIENTE` int(11) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `APELLIDO_PAT` varchar(50) DEFAULT NULL,
  `APELLIDO_MAT` varchar(50) DEFAULT NULL,
  `SEXO` tinyint(1) DEFAULT NULL,
  `FECHA_NAC` datetime DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `HABILITADO` varchar(20) DEFAULT NULL COMMENT 'campo que guarda el usuario del cliente',
  `FRESITA` varchar(20) DEFAULT NULL COMMENT 'campo que guardara la contraseña del usuario',
  `ACTIVO` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ritos`
--

CREATE TABLE IF NOT EXISTS `ritos` (
  `CVE_RITO` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CATALOGOS DE RITOS';

--
-- Volcado de datos para la tabla `ritos`
--

INSERT INTO `ritos` (`CVE_RITO`, `DESCRIPCION`, `ACTIVO`) VALUES
(1, 'R.E.A.Y.A.', 1),
(2, 'MEMPHIS', 1),
(3, 'R.N.I.', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clasificaciones`
--
ALTER TABLE `clasificaciones`
 ADD PRIMARY KEY (`CVE_CLASIFICACION`,`CVE_RITO`), ADD KEY `INDEX_1` (`CVE_RITO`,`CVE_CLASIFICACION`);

--
-- Indices de la tabla `clasificaciones_productos`
--
ALTER TABLE `clasificaciones_productos`
 ADD PRIMARY KEY (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`), ADD KEY `INDEX_1` (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`), ADD KEY `FK_REFERENCE_3` (`CVE_CLASIFICACION`,`CVE_RITO`,`CVE_GRADO`);

--
-- Indices de la tabla `comunicaciones_clientes`
--
ALTER TABLE `comunicaciones_clientes`
 ADD PRIMARY KEY (`CVE_CLIENTE`,`CVE_COMUNICACION`,`CONSECUTIVO_COMUNICACION`), ADD KEY `INDEX_1` (`CVE_CLIENTE`,`CVE_COMUNICACION`), ADD KEY `FK_REFERENCE_6` (`CVE_COMUNICACION`);

--
-- Indices de la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
 ADD PRIMARY KEY (`CVE_CLIENTE`,`CVE_PEDIDO`,`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`), ADD KEY `INDEX_1` (`CVE_CLIENTE`,`CVE_PEDIDO`,`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`), ADD KEY `FK_REFERENCE_9` (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`);

--
-- Indices de la tabla `el_reaton`
--
ALTER TABLE `el_reaton`
 ADD PRIMARY KEY (`CVE_REATA`), ADD KEY `INDEX_1` (`CVE_REATA`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
 ADD PRIMARY KEY (`CVE_CLASIFICACION`,`CVE_RITO`,`CVE_GRADO`), ADD KEY `INDEX_1` (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`);

--
-- Indices de la tabla `medios_comunicacion`
--
ALTER TABLE `medios_comunicacion`
 ADD PRIMARY KEY (`CVE_COMUNICACION`), ADD KEY `INDEX_1` (`CVE_COMUNICACION`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
 ADD PRIMARY KEY (`CVE_CLIENTE`,`CVE_PEDIDO`), ADD KEY `INDEX_1` (`CVE_CLIENTE`,`CVE_PEDIDO`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
 ADD PRIMARY KEY (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`,`CVE_PRODUCTO`), ADD KEY `INDEX_1` (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`,`CVE_PRODUCTO`);

--
-- Indices de la tabla `prospectos`
--
ALTER TABLE `prospectos`
 ADD PRIMARY KEY (`CVE_CLIENTE`), ADD KEY `INDEX_1` (`CVE_CLIENTE`);

--
-- Indices de la tabla `ritos`
--
ALTER TABLE `ritos`
 ADD PRIMARY KEY (`CVE_RITO`), ADD KEY `INDEX_1` (`CVE_RITO`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clasificaciones`
--
ALTER TABLE `clasificaciones`
ADD CONSTRAINT `FK_REFERENCE_1` FOREIGN KEY (`CVE_RITO`) REFERENCES `ritos` (`CVE_RITO`);

--
-- Filtros para la tabla `clasificaciones_productos`
--
ALTER TABLE `clasificaciones_productos`
ADD CONSTRAINT `FK_REFERENCE_3` FOREIGN KEY (`CVE_CLASIFICACION`, `CVE_RITO`, `CVE_GRADO`) REFERENCES `grados` (`CVE_CLASIFICACION`, `CVE_RITO`, `CVE_GRADO`);

--
-- Filtros para la tabla `comunicaciones_clientes`
--
ALTER TABLE `comunicaciones_clientes`
ADD CONSTRAINT `FK_REFERENCE_5` FOREIGN KEY (`CVE_CLIENTE`) REFERENCES `prospectos` (`CVE_CLIENTE`),
ADD CONSTRAINT `FK_REFERENCE_6` FOREIGN KEY (`CVE_COMUNICACION`) REFERENCES `medios_comunicacion` (`CVE_COMUNICACION`);

--
-- Filtros para la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
ADD CONSTRAINT `FK_REFERENCE_8` FOREIGN KEY (`CVE_CLIENTE`, `CVE_PEDIDO`) REFERENCES `pedidos` (`CVE_CLIENTE`, `CVE_PEDIDO`),
ADD CONSTRAINT `FK_REFERENCE_9` FOREIGN KEY (`CVE_RITO`, `CVE_CLASIFICACION`, `CVE_GRADO`, `CVE_CLAS_PRODUCTO`) REFERENCES `productos` (`CVE_RITO`, `CVE_CLASIFICACION`, `CVE_GRADO`, `CVE_CLAS_PRODUCTO`);

--
-- Filtros para la tabla `grados`
--
ALTER TABLE `grados`
ADD CONSTRAINT `FK_REFERENCE_2` FOREIGN KEY (`CVE_CLASIFICACION`, `CVE_RITO`) REFERENCES `clasificaciones` (`CVE_CLASIFICACION`, `CVE_RITO`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
ADD CONSTRAINT `FK_REFERENCE_7` FOREIGN KEY (`CVE_CLIENTE`) REFERENCES `prospectos` (`CVE_CLIENTE`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
ADD CONSTRAINT `FK_REFERENCE_4` FOREIGN KEY (`CVE_RITO`, `CVE_CLASIFICACION`, `CVE_GRADO`, `CVE_CLAS_PRODUCTO`) REFERENCES `clasificaciones_productos` (`CVE_RITO`, `CVE_CLASIFICACION`, `CVE_GRADO`, `CVE_CLAS_PRODUCTO`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
