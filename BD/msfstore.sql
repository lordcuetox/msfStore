-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-05-2015 a las 06:23:56
-- Versión del servidor: 5.5.41-cll-lve
-- Versión de PHP: 5.4.23

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
  `CVE_RITO` int(11) NOT NULL,
  `CVE_CLASIFICACION` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CVE_CLASIFICACION`,`CVE_RITO`),
  KEY `INDEX_1` (`CVE_RITO`,`CVE_CLASIFICACION`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='se clasifican en dos simbolicay filosofica';

--
-- Volcado de datos para la tabla `clasificaciones`
--

INSERT INTO `clasificaciones` (`CVE_RITO`, `CVE_CLASIFICACION`, `DESCRIPCION`, `ACTIVO`) VALUES
(1, 1, 'Simbólico', 1),
(1, 2, 'Filosófico', 1),
(2, 3, 'Simbólico', 0),
(2, 4, 'Filosófico', 0),
(3, 5, 'Simbólico', 0),
(3, 6, 'Filosófico', 0),
(4, 7, 'A.J.E.F', 1);

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
  `ACTIVO` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`),
  KEY `INDEX_1` (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`),
  KEY `FK_REFERENCE_3` (`CVE_CLASIFICACION`,`CVE_RITO`,`CVE_GRADO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clasificaciones_productos`
--

INSERT INTO `clasificaciones_productos` (`CVE_RITO`, `CVE_CLASIFICACION`, `CVE_GRADO`, `CVE_CLAS_PRODUCTO`, `DESCRIPCION`, `ACTIVO`) VALUES
(1, 1, 1, 1, 'Arreos', 1),
(1, 1, 2, 2, 'Arreos', 1),
(1, 1, 3, 3, 'Arreos', 1),
(1, 2, 4, 4, 'Arreos', 1),
(1, 2, 5, 5, 'Arreos', 1),
(1, 2, 6, 6, 'Arreos', 1),
(1, 2, 7, 7, 'Arreos', 1),
(1, 2, 8, 8, 'Arreos', 1),
(1, 2, 9, 9, 'Arreos', 1),
(2, 3, 11, 10, 'Arreos', 0),
(2, 3, 12, 11, 'Arreos', 0),
(2, 3, 13, 12, 'Arreos', 0),
(3, 5, 14, 13, 'Arreos', 0),
(3, 5, 15, 14, 'Arreos', 0),
(3, 5, 16, 15, 'Arreos', 0),
(1, 1, 3, 16, 'Varios', 0),
(1, 1, 1, 17, 'Libros', 0),
(1, 1, 17, 18, 'Llaveros ', 0),
(1, 1, 3, 19, 'Anillos ', 1),
(1, 1, 17, 20, 'Relojes', 0),
(1, 1, 2, 21, 'Libros', 0),
(1, 1, 3, 22, 'Pines', 1),
(1, 1, 17, 23, 'Dijes', 0),
(1, 1, 18, 24, 'Arreos ', 1),
(1, 1, 18, 25, 'Pines', 0),
(1, 1, 18, 26, 'Joyas', 0),
(1, 1, 18, 27, 'Anillos', 1),
(1, 1, 19, 28, 'Relojes', 1),
(1, 1, 19, 29, 'Dijes', 1),
(1, 1, 1, 30, 'Anillos', 1),
(1, 1, 1, 31, 'Libros ', 0),
(1, 1, 1, 32, 'Pines', 1),
(1, 1, 1, 33, 'Libros', 1),
(1, 1, 2, 34, 'Anillos', 1),
(1, 1, 2, 35, 'Pines', 1),
(1, 1, 2, 36, 'Libros', 1),
(1, 1, 3, 37, 'Libros', 1),
(1, 1, 18, 38, 'Pines', 1),
(1, 1, 18, 39, 'Joyas', 1),
(1, 1, 19, 40, 'Llaveros', 1),
(4, 7, 20, 41, 'Bandas y Collarines', 1),
(4, 7, 20, 42, 'Joyas', 1),
(4, 7, 20, 43, 'Anillos', 1),
(4, 7, 20, 44, 'Dijes', 1),
(4, 7, 20, 45, 'Pines', 1),
(4, 7, 20, 46, 'Libros', 1),
(1, 2, 4, 47, 'Anillos', 1),
(1, 2, 4, 48, 'Joyas', 1),
(1, 2, 4, 49, 'Pines', 1),
(1, 2, 4, 50, 'Libros', 1),
(1, 2, 5, 51, 'Anillos', 1),
(1, 2, 5, 52, 'Joyas', 1),
(1, 2, 5, 53, 'Pines', 1),
(1, 2, 5, 54, 'Libros', 1),
(1, 1, 21, 55, 'Simbolismo', 1),
(1, 2, 6, 56, 'Anillos', 1),
(1, 2, 6, 57, 'Joyas', 1),
(1, 2, 6, 58, 'Pines', 1),
(1, 2, 6, 59, 'Libros', 1),
(1, 1, 19, 60, 'Accesorios de Piel ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunicaciones_clientes`
--

CREATE TABLE IF NOT EXISTS `comunicaciones_clientes` (
  `CVE_CLIENTE` int(11) NOT NULL,
  `CVE_COMUNICACION` int(11) NOT NULL,
  `CONSECUTIVO_COMUNICACION` int(11) NOT NULL,
  `DATO` varchar(50) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CVE_CLIENTE`,`CVE_COMUNICACION`,`CONSECUTIVO_COMUNICACION`),
  KEY `INDEX_1` (`CVE_CLIENTE`,`CVE_COMUNICACION`),
  KEY `FK_REFERENCE_6` (`CVE_COMUNICACION`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comunicaciones_clientes`
--

INSERT INTO `comunicaciones_clientes` (`CVE_CLIENTE`, `CVE_COMUNICACION`, `CONSECUTIVO_COMUNICACION`, `DATO`, `ACTIVO`) VALUES
(1, 2, 2, 'delcueto@gmail.com', 1),
(1, 1, 1, '9931838051', 1),
(6, 2, 12, 'roxyd8a@hotmail.com', 1),
(6, 1, 11, '686 5677245', 1),
(3, 1, 5, '3506821', 1),
(3, 2, 6, 'weiss.uttab@gmail.com', 1),
(4, 1, 7, '', 1),
(4, 2, 8, 'marlon_mvp@hotmail.com', 1),
(5, 1, 9, '6261015811', 1),
(5, 2, 10, 'mario.seanez75@live.com.mx', 1),
(7, 1, 13, '7751149488', 1),
(7, 2, 14, 'crc11865@live.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `CVE_CLIENTE` int(11) NOT NULL,
  `CVE_PEDIDO` int(11) NOT NULL,
  `CVE_RITO` int(11) NOT NULL,
  `CVE_CLASIFICACION` int(11) NOT NULL,
  `CVE_GRADO` int(11) NOT NULL,
  `CVE_CLAS_PRODUCTO` int(11) NOT NULL,
  `CVE_PRODUCTO` int(11) NOT NULL,
  `etiqueta_producto` varchar(100) DEFAULT NULL,
  `CANTIDAD` int(11) DEFAULT NULL,
  `PRECIO_UNITARIO` float DEFAULT NULL,
  `DESCUENTO` tinyint(1) DEFAULT NULL,
  `PRECIO_UNITARIO_DESC` float DEFAULT NULL,
  `MONTO_TOTAL_PAGAR` float DEFAULT NULL,
  PRIMARY KEY (`CVE_CLIENTE`,`CVE_PEDIDO`,`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`,`CVE_PRODUCTO`),
  KEY `INDEX_1` (`CVE_CLIENTE`,`CVE_PEDIDO`,`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`),
  KEY `FK_REFERENCE_9` (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`,`CVE_PRODUCTO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `el_reaton`
--

CREATE TABLE IF NOT EXISTS `el_reaton` (
  `CVE_REATA` int(11) NOT NULL,
  `HABILITADO` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `FRESITA` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`CVE_REATA`),
  KEY `INDEX_1` (`CVE_REATA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `el_reaton`
--

INSERT INTO `el_reaton` (`CVE_REATA`, `HABILITADO`, `FRESITA`) VALUES
(1, 'diegoAdmin2015', 'cambiar'),
(2, 'cuetox', '5168940'),
(3, 'eder.weiss87', 'marvel87');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE IF NOT EXISTS `grados` (
  `CVE_RITO` int(11) NOT NULL,
  `CVE_CLASIFICACION` int(11) NOT NULL,
  `CVE_GRADO` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CVE_CLASIFICACION`,`CVE_RITO`,`CVE_GRADO`),
  KEY `INDEX_1` (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='grados de los ritos por clasificacion';

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`CVE_RITO`, `CVE_CLASIFICACION`, `CVE_GRADO`, `DESCRIPCION`, `ACTIVO`) VALUES
(1, 1, 1, 'Aprendiz', 1),
(1, 1, 2, 'Compañero', 1),
(1, 1, 3, 'Maestro', 1),
(1, 2, 4, 'Grado 4', 1),
(1, 2, 5, 'Grado 14', 1),
(1, 2, 6, 'Grado 18', 1),
(1, 2, 7, 'Grado 30', 1),
(1, 2, 8, 'Grado 32', 1),
(1, 2, 9, 'Grado 33', 1),
(1, 1, 21, 'Articulos de Logia', 1),
(4, 7, 20, 'Grado Unico', 1),
(1, 1, 19, 'Novedades', 1),
(1, 1, 22, 'Accesorios de Piel ', 0),
(1, 1, 17, 'Novedades ', 0),
(1, 1, 18, 'Past Master', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medios_comunicacion`
--

CREATE TABLE IF NOT EXISTS `medios_comunicacion` (
  `CVE_COMUNICACION` int(11) NOT NULL,
  `DESCRIPCION` varchar(100) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CVE_COMUNICACION`),
  KEY `INDEX_1` (`CVE_COMUNICACION`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medios_comunicacion`
--

INSERT INTO `medios_comunicacion` (`CVE_COMUNICACION`, `DESCRIPCION`, `ACTIVO`) VALUES
(1, 'Teléfono', 1),
(2, 'Correo electrónico', 1);

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
  `DESCRIPCION_GUIA` varchar(250) DEFAULT NULL,
  `DIRECCION_ENVIO` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`CVE_CLIENTE`,`CVE_PEDIDO`),
  KEY `INDEX_1` (`CVE_CLIENTE`,`CVE_PEDIDO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `CVE_RITO` int(11) NOT NULL,
  `CVE_CLASIFICACION` int(11) NOT NULL,
  `CVE_GRADO` int(11) NOT NULL,
  `CVE_CLAS_PRODUCTO` int(11) NOT NULL,
  `CVE_PRODUCTO` int(11) NOT NULL,
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
  `ACTIVO` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`,`CVE_PRODUCTO`),
  KEY `INDEX_1` (`CVE_RITO`,`CVE_CLASIFICACION`,`CVE_GRADO`,`CVE_CLAS_PRODUCTO`,`CVE_PRODUCTO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`CVE_RITO`, `CVE_CLASIFICACION`, `CVE_GRADO`, `CVE_CLAS_PRODUCTO`, `CVE_PRODUCTO`, `NOMBRE`, `DESCRIPCION`, `RUTA_IMAGEN1`, `RUTA_IMAGEN2`, `RUTA_IMAGEN3`, `RUTA_IMAGEN4`, `PRECIO`, `NOVEDAD`, `FECHA_NOVEDAD`, `OFERTA`, `FECHA_OFERTA`, `PRECIO_OFERTA`, `EXISTENCIAS`, `ACTIVO`) VALUES
(1, 1, 3, 16, 1, 'Encendedor', 'Acabado mate, en color dorado, poco peso.', 'img/productos/1_1.jpg', 'img/productos/1_2.jpg', 'img/productos/1_3.jpg', 'img/productos/1_4.jpg', 900, 1, '2015-04-02 23:59:59', 1, '2015-04-02 23:59:59', 900, 0, 0),
(1, 1, 3, 16, 2, 'Pin de M:. M:.', 'Pin en alpaca', 'img/productos/2_1.jpg', '', '', '', 500, 1, '2015-04-02 23:59:59', 1, '2015-04-02 23:59:59', 500, 10, 0),
(1, 1, 3, 16, 3, 'mandil', 'mandill bordado de maestro', 'img/productos/3_1.jpg', NULL, NULL, NULL, 100, 1, '2015-04-02 23:59:59', 1, '2015-04-02 23:59:59', 90, 1, 0),
(1, 1, 1, 17, 4, 'Liturgia del Grado de Aprendiz ', 'Liturgia del grado de aprendiz para el R:. E:. A:. y A:. Nueva Edición ', 'img/productos/4_1.jpg', 'img/productos/4_2.jpg', NULL, NULL, 130, 0, NULL, 0, NULL, 0, 5, 0),
(1, 1, 17, 18, 5, 'Llavero Pavimento Ajedrezado ', 'Llavero metálico finamente diseñado excelente para un bonito regalo\r\n\r\nColores: Dorado y Plateado', 'img/productos/5_1.jpg', 'img/productos/5_2.jpg', 'img/productos/5_3.jpg', NULL, 50, 0, NULL, 0, NULL, 0, 0, 0),
(1, 1, 17, 18, 6, 'Llavero de Piel ', 'Llavero de piel autentica, grabada con el símbolo universal de la Masonería, la escuadra y compas', 'img/productos/6_1.jpg', 'img/productos/6_2.jpg', NULL, NULL, 50, 0, NULL, 0, NULL, 0, 0, 0),
(1, 1, 17, 18, 7, 'Llavero Aguila Bicefala ', 'Llavero doble vista, al frente el águila bicéfala del grado 33, atrás la escuadra y compas símbolo universal de la Masonería.\r\n\r\nColores: Dorado', 'img/productos/7_1.jpg', 'img/productos/7_2.jpg', 'img/productos/7_3.jpg', NULL, 50, 0, NULL, 0, NULL, 0, 0, 0),
(1, 1, 17, 18, 8, 'Llavero Piramide del Dolar ', 'Llavero doble vista, al frente la famosa pirámide del billete de un dólar, atrás la escuadra y compas, símbolo universal de la Masonería\r\n\r\nColores: Plateado ', 'img/productos/8_1.jpg', 'img/productos/8_2.jpg', 'img/productos/8_3.jpg', NULL, 50, 0, NULL, 0, NULL, 0, 0, 0),
(1, 1, 17, 18, 9, 'Llavero Escuadra y Compas', 'Llavero del símbolo universal de la Masonería, la escuadra y compas, al centro la letra G', 'img/productos/9_1.jpg', 'img/productos/9_2.jpg', NULL, NULL, 50, 0, NULL, 0, NULL, 0, 0, 0),
(1, 1, 3, 19, 10, 'Anillo SABED ', 'Anillo para el grado de M:. M:. con la inscripción en latín SABED y A:. L:. G:. D:. G:. A:. D:. U:. con columnas a los laterales, elaborado en plata fina de excelente calidad Ley 925.', 'img/productos/10_1.jpg', 'img/productos/10_2.jpg', 'img/productos/10_3.jpg', 'img/productos/10_4.jpg', 1200, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 3, 19, 11, 'Anillo Resplandor', 'Anillo para M:. M:. con la escuadra y compas con fondo de resplandor de luz, laterales grabado de herramientas propias del grado', 'img/productos/11_1.jpg', 'img/productos/11_2.jpg', 'img/productos/11_3.jpg', 'img/productos/11_4.jpg', 900, 0, NULL, 1, '2015-04-30 23:59:59', 810, 0, 1),
(1, 1, 1, 33, 22, 'Liturgia del Grado de Aprendiz', 'Liturgia para el grado de aprendiz, nueva edición', 'img/productos/22_1.jpg', 'img/productos/22_2.jpg', NULL, NULL, 130, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 17, 20, 13, 'Reloj Masonico Tipo Rolex (Rojo)', 'Reloj Masónico tipo Rolex, con extensible de acero, y fechador de mes y día, cuidadosamente elaborado ', 'img/productos/13_1.jpg', '', '', '', 350, 1, '2015-10-18 23:59:59', 1, '2015-04-30 23:59:59', 297.5, 0, 0),
(1, 1, 17, 20, 14, 'Reloj Masonico Herramientas', 'Reloj Masónico con extensible de imitación de piel, caratula de herramientas en cada posición de los números, diseño exclusivo ', 'img/productos/14_1.jpg', NULL, NULL, NULL, 300, 1, '2015-10-18 23:59:59', 0, NULL, 0, 0, 0),
(1, 1, 2, 21, 15, 'Liturgia del Grado de Compañero Mason ', 'Liturgia del grado de compañero masón, nueva edición', 'img/productos/15_1.jpg', 'img/productos/15_2.jpg', NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 0),
(1, 1, 17, 20, 16, 'Reloj Masonico Herramientas Ojo de Horus ', 'Reloj Masónico con extensible de imitación de piel, finamente elabora con caratula de herramientas masónicas, producto exclusivo ', 'img/productos/16_1.jpg', NULL, NULL, NULL, 300, 0, NULL, 0, NULL, 0, 0, 0),
(1, 1, 17, 20, 17, 'Reloj Masonico Herramientas Pavimento de Mosaico', 'Reloj Masónico con extensible de imitación de piel, finamente elabora con caratula de herramientas masónicas, producto exclusivo ', 'img/productos/17_1.jpg', '', '', '', 300, 0, NULL, 0, NULL, 0, 0, 0),
(1, 1, 3, 22, 18, 'Pin M:. M:. Escuadra y Compas', 'Pin metálico de escuadra y compas, elaborado en el grado de Maestro Mason', 'img/productos/18_1.jpg', 'img/productos/18_2.jpg', NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 17, 23, 19, 'Dije de Escuadra y Compas', 'Dije de escuadra y compas, elaborado en plata fina de excelente calidad Ley 925.', 'img/productos/19_1.jpg', 'img/productos/19_2.jpg', '', '', 250, 0, NULL, 1, '2015-04-30 23:59:59', 200, 0, 0),
(1, 1, 17, 23, 20, 'Tetragrammaton ', 'Dije de Tetragrammaton elaborado finamente en plata Ley 925. ', 'img/productos/20_1.jpg', 'img/productos/20_2.jpg', NULL, NULL, 250, 0, NULL, 1, '2015-04-30 23:59:59', 200, 0, 0),
(1, 1, 17, 23, 21, 'Ojo de Horus', 'Dije del Ojo de Horus Egipcio, poderoso talismán para la suerte y la salud, elaborado en plata fina de excelente calidad, Ley 925.', 'img/productos/21_1.jpg', 'img/productos/21_2.jpg', NULL, NULL, 320, 0, NULL, 1, '2015-04-30 23:59:59', 272, 0, 0),
(1, 1, 2, 36, 23, 'Liturgia del Grado de Compañero', 'Liturgia para el grado de compañero, nueva edición', 'img/productos/23_1.jpg', 'img/productos/23_2.jpg', NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 3, 37, 24, 'Liturgia del Grado de Maestro ', 'Liturgia para el grado de Maestro Mason, nueva edición ', 'img/productos/24_1.jpg', 'img/productos/24_2.jpg', NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 3, 36, 25, 'Liturgia del Grado de Maestro Mason ', 'Liturgia para el sublime grado de Maestro Mason, nueva edición ', NULL, NULL, NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 18, 38, 26, 'Pin de Past Mater ', 'Pin metálico, para Past Master ', 'img/productos/26_1.jpg', 'img/productos/26_2.jpg', NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 18, 27, 27, 'Anillo Past Master', 'Anillo masónico, para Past Master, finamente elaborado en plata fina Ley 925, grabado de tu nombre totalmente gratis en el interior', 'img/productos/27_1.jpg', 'img/productos/27_2.jpg', 'img/productos/27_3.jpg', 'img/productos/27_4.jpg', 900, 0, NULL, 1, '2015-04-30 23:59:59', 810, 0, 1),
(1, 1, 19, 29, 28, 'Escuadra y Compas ', 'Dije de escuadra y compas, finamente elaborada en plata fina Ley 925, (3 cm)', 'img/productos/28_1.jpg', 'img/productos/28_2.jpg', NULL, NULL, 250, 0, NULL, 1, '2015-04-30 23:59:59', 200, 0, 1),
(1, 1, 19, 29, 29, 'Escuadra y Compas Pulido ', 'Dije de escuadra y compas, elaborado en plata fina Ley 925, pulido para dar una apariencia brillante, (3 cm)', 'img/productos/29_1.jpg', 'img/productos/29_2.jpg', NULL, NULL, 350, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 19, 29, 30, 'Ojo de Horus', 'Dije del ojo de Horus, poderoso talismán para la buena suerte y la salud, elaborado en plata fina de excelente calidad Ley 925 (3 cm)', 'img/productos/30_1.jpg', 'img/productos/30_2.jpg', '', '', 320, 0, NULL, 1, '2015-04-30 23:59:59', 288, 0, 1),
(1, 1, 19, 29, 31, 'Tetragrammaton ', 'Dije de Tetragrammaton calado, elaborado en plata fina Ley 925. (3 cm)', 'img/productos/31_1.jpg', 'img/productos/31_2.jpg', NULL, NULL, 250, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 19, 28, 32, 'Reloj Herramientas Masonicas', 'Reloj con caratula de herramientas de los diferentes grados de la masonería, marca genérica, finamente diseñado', 'img/productos/32_1.jpg', 'img/productos/32_2.jpg', NULL, NULL, 300, 1, '2015-10-18 23:59:59', 0, NULL, 0, 0, 1),
(1, 1, 19, 28, 33, 'Reloj Herramientas y Pavimento Mosaico', 'Reloj con caratula de las diferentes herramientas masónicas, al centro el pavimento de mosaico, extensible de imitación de piel, marca genérica', 'img/productos/33_1.jpg', 'img/productos/33_2.jpg', NULL, NULL, 300, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 19, 28, 34, 'Reloj Herramientas Ojo de Horus', 'Reloj con las herramientas de los diferentes grados masónicos, al centro el místico ojo de Horus, poderoso talismán de protección, extensible de imitación de piel, marca genérica.', 'img/productos/34_1.jpg', 'img/productos/34_2.jpg', 'img/productos/34_3.jpg', NULL, 300, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 19, 28, 35, 'Reloj Masonico', 'Reloj masónico tipo Rolex, con el símbolo universal de la Masonería al frente, la escuadra y el compas en fondo rojo, marca genérica, fechador de día y mes, extensible metálico', 'img/productos/35_1.jpg', 'img/productos/35_2.jpg', 'img/productos/35_3.jpg', '', 350, 0, NULL, 1, '2015-05-31 23:59:59', 298, 0, 1),
(1, 1, 19, 40, 36, 'Llavero Escuadra y Compas', 'Llavero metálico de escuadra y compas, excelente para regalo', 'img/productos/36_1.jpg', 'img/productos/36_2.jpg', NULL, NULL, 50, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 19, 40, 37, 'Llavero Columnas y Pavimento de Mosaico', 'Llavero de una sola vista, con las columnas del templo y el pavimento de mosaico, excelente para regalo', 'img/productos/37_1.jpg', 'img/productos/37_2.jpg', 'img/productos/37_3.jpg', NULL, 50, 1, '2015-10-18 23:59:59', 0, NULL, 0, 0, 1),
(1, 1, 19, 40, 38, 'Llavero Piramide Dolar', 'Llavero doble vista con la famosa pirámide illuminati del billete de un dólar, al reverso la escuadra y el compas, excelente para regalo ', 'img/productos/38_1.jpg', 'img/productos/38_2.jpg', 'img/productos/38_3.jpg', NULL, 50, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 19, 40, 39, 'Llavero Aguila Bicefala', 'Llavero doble vista con el águila bicéfala del grado 33 al frente, atrás la escuadra y el compas, excelente para regalo ', 'img/productos/39_1.jpg', 'img/productos/39_2.jpg', 'img/productos/39_3.jpg', NULL, 50, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 19, 40, 40, 'Llavero Piel ', 'Llavero elaborado en piel autentica, termo grabado con el símbolo universal de la masonería, la escuadra y el compas', 'img/productos/40_1.jpg', 'img/productos/40_2.jpg', NULL, NULL, 50, 0, NULL, 0, NULL, 0, 0, 1),
(4, 7, 20, 46, 41, 'Liturgia del Grado Unico AJEF', 'Liturgia para el grado único AJEF, nueva edición ', 'img/productos/41_1.jpg', 'img/productos/41_2.jpg', '', '', 50, 0, NULL, 1, '2015-05-31 23:59:59', 50, 0, 1),
(4, 7, 20, 43, 42, 'Anillo AJEF ', 'Anillo con la simbología AJEF, cuidadosamente diseñado y elaborado en plata fina de excelente calidad, grabamos tu nombre sin costo adicional en el interior', 'img/productos/42_1.jpg', 'img/productos/42_2.jpg', 'img/productos/42_3.jpg', NULL, 650, 1, '2015-10-18 23:59:59', 1, '2015-04-30 23:59:59', 585, 0, 1),
(4, 7, 20, 44, 43, 'Dije AJEF ', 'Dije de imitación de oro cromado, elaborado con el símbolo AJEF, cuidadosamente diseñado', 'img/productos/43_1.jpg', 'img/productos/43_2.jpg', NULL, NULL, 220, 1, '2015-10-18 23:59:59', 0, NULL, 0, 0, 1),
(1, 2, 5, 52, 44, 'Medalla Past Sapientisimo Maestro ', 'Medalla para Past Sapientísimo Maestro, elaborada en latón dorado, incluye grabado del nombre y periodo totalmente gratis (7 cm)', 'img/productos/44_1.jpg', 'img/productos/44_2.jpg', NULL, NULL, 900, 1, '2015-10-18 23:59:59', 1, '2015-04-30 23:59:59', 810, 0, 1),
(1, 1, 2, 35, 45, 'Pin Estrella de 5 Puntas', 'Pin metálico para el grado de compañero, la estrella de 5 puntas con la letra G al centro ', 'img/productos/45_1.jpg', 'img/productos/45_2.jpg', NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 3, 22, 46, 'Pin Escuadra y Compas Calado ', 'Pin calado de escuadra y compas con resplandor, metálico, para el grado de Maestro Mason ', 'img/productos/46_1.jpg', 'img/productos/46_2.jpg', NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 3, 22, 47, 'Pin Acacia ', 'Pin de rama de acacia para el Sublime grado de Maestro Masón, ', 'img/productos/47_1.jpg', 'img/productos/47_2.jpg', NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 3, 22, 48, 'Pin sol y luna ', 'Pin para el Sublime Grado de Maestro Mason con los símbolos del sol y la luna además del ojo de Horus al centro ', 'img/productos/48_1.jpg', 'img/productos/48_2.jpg', NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 3, 22, 49, 'Pin Resplandor Circular', 'Pin circular de escuadra y compas para el Sublime Grado de Maestro Mason con resplandor y ramas de olivo', 'img/productos/49_1.jpg', 'img/productos/49_2.jpg', NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 21, 55, 50, 'Escuadra y Compas para el Ara en Madera', 'Escuadra y compas elaborada en madera, grabados exclusivamente diseñados para un fino acabado, cadena para entrelazar los 3 diferentes grados de la Masonería simbólica', 'img/productos/50_1.jpg', 'img/productos/50_2.jpg', 'img/productos/50_3.jpg', '', 250, 0, NULL, 1, '2015-05-31 23:59:59', 250, 0, 1),
(1, 1, 1, 1, 51, 'Mandil para el Grado de Aprendiz en Razo', 'Mandil para aprendiz de masón, cuidadosamente elaborado en tela de razo, elige el reverso entre blanco o negro con calavera bordada, nos adecuamos a tus necesidades', 'img/productos/51_1.jpg', '', '', '', 150, 1, '2015-10-18 23:59:59', 1, '2015-04-30 23:59:59', 150, 0, 1),
(1, 1, 1, 1, 52, 'Mandil para Aprendiz Linea Illuminati ', 'Mandil para Aprendiz de Masón, marca Illuminati, elaborado cuidadosamente en tacto piel, orilla de satén, y broche de plástico, acabado de lujo, puedes elegir el reverso entre blanco o negro con calavera bordada a maquina.', 'img/productos/52_1.jpg', NULL, NULL, NULL, 250, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 2, 2, 53, 'Mandil para el Grado de Compañero en Razo ', 'Mandil para compañero masón elaborado en tela de razo, bordado a maquina con la simbología cuidadosamente diseñada, reverso en negro con la calavera bordada', NULL, NULL, NULL, NULL, 250, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 2, 2, 54, 'Mandil para Compañero Linea Illuminati ', 'Mandil de compañero masón, elaborado en tacto piel y bordado a maquina, bordes de satén, diseño exclusivo, reverso en negro con la calavera bordada y broche de plástico ', 'img/productos/54_1.jpg', NULL, NULL, NULL, 350, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 1, 1, 55, 'Mandil Aprendiz Piel Autentica Linea Illuminati', 'Mandil para aprendiz de masón, solo para los mas exigentes, elaborado en piel autentica, con bordes en satén, broche de plástico, puedes elegir el reverso en blanco o negro con calavera bordada a maquina', 'img/productos/55_1.jpg', NULL, NULL, NULL, 450, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 2, 2, 56, 'Mandil Compañero Piel Autentica Linea Illuminati', 'Mandil para compañero masón, solo para los mas exigentes, elaborado en piel autentica, bordado cuidadosamente a maquina, bordes de satén, broche de plástico, reverso en negro con calavera bordada ', 'img/productos/56_1.jpg', NULL, NULL, NULL, 550, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 18, 39, 57, 'Medalla Past Master Calada', 'Medalla para Past Master calada, elaborada en imitación de oro, con las figuras del sextante sobre las dos columnas del templo, gramos tu nombre y el periodo de la veneratura totalmente Gratis', 'img/productos/57_1.jpg', NULL, NULL, NULL, 900, 0, NULL, 1, '2015-05-31 23:59:59', 810, 0, 1),
(1, 1, 18, 39, 58, 'Medalla Past Master Teorema de Pitagoras', 'Medalla para Past Master, elaborada en imitación de oro, con el teorema de Pitágoras, grabamos tu nombre y el periodo de la veneratura totalmente Gratis', 'img/productos/58_1.jpg', NULL, NULL, NULL, 900, 0, NULL, 1, '2015-06-15 23:59:59', 810, 0, 1),
(1, 1, 18, 39, 59, 'Medalla Past Master A:. L:. G:. D:. G:. A:. D:. U:.', 'Medalla para Past Master, elaborada en imitación de oro, con la leyenda A:. L:. G:. D:. G:. A:. D:. U:. y el sextante, grabamos tu nombre y periodo de la veneratura totalmente Gratis', 'img/productos/59_1.jpg', NULL, NULL, NULL, 900, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 18, 39, 60, 'Medalla Past Master Economica', 'Medalla para Past Master, versión económica, elaborada en imitación de plata, grabamos tu nombre y el periodo de la veneratura totalmente Gratis ', 'img/productos/60_1.jpg', NULL, NULL, NULL, 500, 0, NULL, 1, '2015-06-15 23:59:59', 450, 0, 1),
(1, 1, 1, 1, 61, 'Corbata para Aprendiz', 'Corbata elaborada para el grado de aprendiz de masón, finamente bordada a maquina, colores brillantes, Azul y Rojo', 'img/productos/61_1.jpg', '', '', '', 135, 0, NULL, 1, '2015-06-15 23:59:59', 135, 0, 1),
(1, 1, 2, 2, 62, 'Corbata para Compañero Mason ', 'Corbata elabora con simbología para compañero masón, bordada finamente a maquina, colores brillantes, disponible en Azul y Rojo ', 'img/productos/62_1.jpg', NULL, NULL, NULL, 150, 0, NULL, 1, '2015-06-15 23:59:59', 135, 0, 1),
(1, 1, 19, 60, 63, 'Billetera Masonica', 'Billetera elaborada en piel autentica, termo grabada con el símbolo de la escuadra y el compas', 'img/productos/63_1.jpg', NULL, NULL, NULL, 250, 0, NULL, 1, '2015-06-15 23:59:59', 225, 0, 1);

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
  `FRESITA` varchar(20) DEFAULT NULL COMMENT 'campo que guardara la contrase�a del usuario',
  `ACTIVO` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CVE_CLIENTE`),
  KEY `INDEX_1` (`CVE_CLIENTE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prospectos`
--

INSERT INTO `prospectos` (`CVE_CLIENTE`, `NOMBRE`, `APELLIDO_PAT`, `APELLIDO_MAT`, `SEXO`, `FECHA_NAC`, `FECHA_REGISTRO`, `HABILITADO`, `FRESITA`, `ACTIVO`) VALUES
(1, 'Jorge José', 'Jiménez', 'Del Cueto', 1, '1981-10-23 00:00:00', '2015-04-20 10:22:00', 'cuetox', '**5168940', 1),
(3, 'Roberto Eder', 'Weiss', 'Juárez', 1, '1987-04-13 00:00:00', '2015-04-13 08:56:00', 'eder.weiss87', 'marvel87', 1),
(6, 'ana rosa', 'Bernal', 'Vega', 0, '1970-10-13 00:00:00', '2015-04-21 12:48:00', 'rosy', 'fifi', 1),
(4, 'MARLON VALENTINO', 'QUINTANILLA ', 'TELLO', 1, '1970-01-01 00:00:00', '2015-04-19 04:10:00', 'MARLONMVP', 'MAQUIAVELOMVP', 1),
(5, 'Mario', 'Seañez', 'Martinez', 1, '1975-09-27 00:00:00', '2015-04-19 04:52:00', 'mayote', '400915', 1),
(7, 'Carlos', 'Riveros', 'Campos', 1, '1966-08-11 00:00:00', '2015-04-21 04:28:00', 'Carlos', 'mason666', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ritos`
--

CREATE TABLE IF NOT EXISTS `ritos` (
  `CVE_RITO` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) DEFAULT NULL,
  `ACTIVO` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CVE_RITO`),
  KEY `INDEX_1` (`CVE_RITO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='CATALOGOS DE RITOS';

--
-- Volcado de datos para la tabla `ritos`
--

INSERT INTO `ritos` (`CVE_RITO`, `DESCRIPCION`, `ACTIVO`) VALUES
(1, 'R.E.A.Y.A.', 1),
(2, 'R.N.M.', 0),
(3, 'R.N.I.', 0),
(4, 'A.J.E.F.', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
