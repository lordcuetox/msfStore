-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-04-2015 a las 13:47:47
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
(3, 6, 'Filosófico', 0);

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
(1, 1, 1, 17, 'Libros', 1),
(1, 1, 17, 18, 'Llaveros ', 1),
(1, 1, 3, 19, 'Anillos ', 1),
(1, 1, 17, 20, 'Relojes', 1),
(1, 1, 2, 21, 'Libros', 1),
(1, 1, 3, 22, 'Pines', 1),
(1, 1, 17, 23, 'Dijes', 1);

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
(3, 1, 5, '3506821', 1),
(3, 2, 6, 'weiss.uttab@gmail.com', 1),
(4, 1, 7, '', 1),
(4, 2, 8, 'marlon_mvp@hotmail.com', 1),
(5, 1, 9, '6261015811', 1),
(5, 2, 10, 'mario.seanez75@live.com.mx', 1);

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
(1, 2, 10, 'CCH', 0),
(2, 3, 11, 'Aprendiz', 0),
(2, 3, 12, 'Compañero', 0),
(2, 3, 13, 'Maestro', 0),
(3, 5, 14, 'Aprendiz', 0),
(3, 5, 15, 'Compañero', 0),
(3, 5, 16, 'Maestro', 0),
(1, 1, 17, 'Novedades ', 1);

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
(1, 1, 1, 17, 4, 'Liturgia del Grado de Aprendiz ', 'Liturgia del grado de aprendiz para el R:. E:. A:. y A:. Nueva Edición ', 'img/productos/4_1.jpg', NULL, NULL, NULL, 130, 0, NULL, 0, NULL, 0, 5, 1),
(1, 1, 17, 18, 5, 'Llavero Pavimento Ajedrezado ', 'Llavero metálico finamente diseñado excelente para un bonito regalo\r\n\r\nColores: Dorado y Plateado', 'img/productos/5_1.jpg', 'img/productos/5_2.jpg', NULL, NULL, 50, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 17, 18, 6, 'Llavero de Piel ', 'Llavero de piel autentica, grabada con el símbolo universal de la Masonería, la escuadra y compas', 'img/productos/6_1.jpg', NULL, NULL, NULL, 50, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 17, 18, 7, 'Llavero Aguila Bicefala ', 'Llavero doble vista, al frente el águila bicéfala del grado 33, atrás la escuadra y compas símbolo universal de la Masonería.\r\n\r\nColores: Dorado', 'img/productos/7_1.jpg', NULL, NULL, NULL, 50, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 17, 18, 8, 'Llavero Piramide del Dolar ', 'Llavero doble vista, al frente la famosa pirámide del billete de un dólar, atrás la escuadra y compas, símbolo universal de la Masonería\r\n\r\nColores: Plateado ', 'img/productos/8_1.jpg', NULL, NULL, NULL, 50, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 17, 18, 9, 'Llavero Escuadra y Compas', 'Llavero del símbolo universal de la Masonería, la escuadra y compas, al centro la letra G', 'img/productos/9_1.jpg', NULL, NULL, NULL, 50, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 3, 19, 10, 'Anillo SABED ', 'Anillo para el grado de M:. M:. con la inscripción en latín SABED y A:. L:. G:. D:. G:. A:. D:. U:. con columnas a los laterales, elaborado en plata fina de excelente calidad Ley 925.', 'img/productos/10_1.jpg', NULL, NULL, NULL, 1200, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 3, 19, 11, 'Anillo Resplandor', 'Anillo para M:. M:. con la escuadra y compas con fondo de resplandor de luz, laterales grabado de herramientas propias del grado', 'img/productos/11_1.jpg', '', '', '', 900, 0, NULL, 1, '2015-04-30 23:59:59', 810, 0, 1),
(1, 1, 1, 17, 12, '1', '1', 'img/productos/12_1.jpg', NULL, NULL, NULL, 130, 0, NULL, 0, NULL, 0, 0, 0),
(1, 1, 17, 20, 13, 'Reloj Masonico Tipo Rolex (Rojo)', 'Reloj Masónico tipo Rolex, con extensible de acero, y fechador de mes y día, cuidadosamente elaborado ', 'img/productos/13_1.jpg', '', '', '', 350, 1, '2015-10-18 23:59:59', 1, '2015-04-30 23:59:59', 297.5, 0, 1),
(1, 1, 17, 20, 14, 'Reloj Masonico Herramientas', 'Reloj Masónico con extensible de imitación de piel, caratula de herramientas en cada posición de los números, diseño exclusivo ', 'img/productos/14_1.jpg', NULL, NULL, NULL, 300, 1, '2015-10-18 23:59:59', 0, NULL, 0, 0, 1),
(1, 1, 2, 21, 15, 'Liturgia del Grado de Compañero Mason ', 'Liturgia del grado de compañero masón, nueva edición', 'img/productos/15_1.jpg', NULL, NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 17, 20, 16, 'Reloj Masonico Herramientas Ojo de Horus ', 'Reloj Masónico con extensible de imitación de piel, finamente elabora con caratula de herramientas masónicas, producto exclusivo ', 'img/productos/16_1.jpg', NULL, NULL, NULL, 300, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 17, 20, 17, 'Reloj Masonico Herramientas Pavimento de Mosaico', 'Reloj Masónico con extensible de imitación de piel, finamente elabora con caratula de herramientas masónicas, producto exclusivo ', 'img/productos/17_1.jpg', '', '', '', 300, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 3, 22, 18, 'Pin M:. M:. Escuadra y Compas', 'Pin metálico de escuadra y compas, elaborado en el grado de Maestro Mason', 'img/productos/18_1.jpg', NULL, NULL, NULL, 60, 0, NULL, 0, NULL, 0, 0, 1),
(1, 1, 17, 23, 19, 'Dije de Escuadra y Compas', 'Dije de escuadra y compas, elaborado en plata fina de excelente calidad Ley 925.', 'img/productos/19_1.jpg', '', '', '', 250, 0, NULL, 1, '2015-04-30 23:59:59', 200, 0, 1),
(1, 1, 17, 23, 20, 'Tetragrammaton ', 'Dije de Tetragrammaton elaborado finamente en plata Ley 925. ', 'img/productos/20_1.jpg', NULL, NULL, NULL, 250, 0, NULL, 1, '2015-04-30 23:59:59', 200, 0, 1);

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
(1, 'Jorge Jose', 'Jimenez', 'Del Cueto', 1, '1981-10-23 00:00:00', '2015-04-14 12:17:00', 'cuetox', '**5168940', 1),
(3, 'Roberto Eder', 'Weiss', 'Juárez', 1, '1987-04-13 00:00:00', '2015-04-13 08:56:00', 'eder.weiss87', 'marvel87', 1),
(4, 'MARLON VALENTINO', 'QUINTANILLA ', 'TELLO', 1, '1970-01-01 00:00:00', '2015-04-19 04:10:00', 'MARLONMVP', 'MAQUIAVELOMVP', 1),
(5, 'Mario', 'Seañez', 'Martinez', 1, '1975-09-27 00:00:00', '2015-04-19 04:52:00', 'mayote', '400915', 1);

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
(3, 'R.N.I.', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
