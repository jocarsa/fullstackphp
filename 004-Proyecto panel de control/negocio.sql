-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2024 a las 13:32:30
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `negocio`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CalculaTotales` (IN `idpedido` INT)   BEGIN
    SELECT 
        SUM(productos.precio * lineaspedido.cantidad) AS subtotal,
        ROUND(SUM(productos.precio * lineaspedido.cantidad)*0.21,2) AS impuesto,
        ROUND(SUM(productos.precio * lineaspedido.cantidad)*1.21,2) AS total
    FROM lineaspedido
    LEFT JOIN pedidos ON lineaspedido.pedidos_fecha = pedidos.Identificador
    LEFT JOIN productos ON lineaspedido.productos_nombre = productos.Identificador
    WHERE pedidos.Identificador = idpedido;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DameDetallesPedido` (IN `idpedido` INT)   BEGIN
    SELECT 
        pedidos.Identificador AS Identificador,
        lineaspedido.cantidad AS cantidad,
        productos.nombre AS nombre,
        productos.precio AS precio,
        productos.precio * lineaspedido.cantidad AS subtotal
    FROM 
        lineaspedido
    LEFT JOIN 
        pedidos ON lineaspedido.pedidos_fecha = pedidos.Identificador
    LEFT JOIN 
        productos ON lineaspedido.productos_nombre = productos.Identificador
    WHERE 
        pedidos.Identificador = idpedido;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `Identificador` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`Identificador`, `titulo`, `texto`, `fecha`, `imagen`) VALUES
(1, 'Cómo empezar un negocio en línea', 'Iniciar un negocio en línea es una excelente manera de generar ingresos pasivos...', '2024-01-15', 'negocio_online.jpg'),
(2, 'Las mejores estrategias de marketing digital', 'El marketing digital es clave para llegar a tu público objetivo...', '2024-02-10', 'marketing_digital.jpg'),
(3, 'Cómo monetizar un blog', 'Monetizar un blog requiere tiempo y esfuerzo, pero es posible a través de anuncios, marketing de afiliados...', '2024-03-05', 'monetizar_blog.jpg'),
(4, 'Consejos para mejorar tu productividad', 'La productividad personal es clave para gestionar tu tiempo y proyectos de manera eficiente...', '2024-04-12', 'productividad.jpg'),
(5, 'Tendencias tecnológicas para emprendedores', 'Las nuevas tecnologías como la IA y el blockchain ofrecen grandes oportunidades para emprendedores...', '2024-05-18', 'tendencias_tecnologicas.jpg'),
(6, 'Cómo crear contenido de valor para tus seguidores', 'Crear contenido que aporte valor a tus seguidores es crucial para mantener su lealtad...', '2024-06-22', 'contenido_valor.jpg'),
(7, 'Errores comunes al iniciar un negocio', 'Empezar un negocio puede ser complicado, aquí te mostramos los errores más comunes y cómo evitarlos...', '2024-07-09', 'errores_negocio.jpg'),
(8, 'Cómo gestionar tus finanzas personales', 'Gestionar bien tus finanzas personales es esencial para tener éxito a largo plazo en los negocios...', '2024-08-16', 'finanzas_personales.jpg'),
(9, 'Guía para optimizar tu tienda en línea', 'Optimizar tu tienda en línea es clave para aumentar las conversiones y las ventas...', '2024-09-20', 'optimizar_tienda_online.jpg'),
(10, 'Cómo utilizar SEO para mejorar tu visibilidad', 'El SEO es fundamental para aumentar la visibilidad de tu sitio web y atraer más tráfico...', '2024-10-01', 'seo_visibilidad.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Identificador` int(10) NOT NULL,
  `razonsocial` varchar(100) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `cp` varchar(50) DEFAULT NULL,
  `poblacion` varchar(100) DEFAULT NULL,
  `identificacionfiscal` varchar(100) DEFAULT NULL,
  `email` varchar(15) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Identificador`, `razonsocial`, `direccion`, `cp`, `poblacion`, `identificacionfiscal`, `email`, `telefono`) VALUES
(1, 'Comercial Martínez S.A.', 'Calle Mayor 123456', '28013', 'Madrid', 'B12345678', 'info@martinez.c', '912345678'),
(2, 'Distribuciones Pérez S.L.', 'Avenida Andalucía 45', '41001', 'Sevilla', 'B87654321', 'contacto@perez.', '954123456'),
(3, 'Electrodomésticos López S.A.', 'Calle Sol 98', '29010', 'Málaga', 'A12398745', 'ventas@lopez.co', '952987654'),
(4, 'Hermanos García S.L.', 'Avenida del Parque 12', '03002', 'Alicante', 'B11223344', 'info@garcia.com', '965456789'),
(5, 'Inversiones Rodríguez S.A.', 'Calle de la Paz 5', '46001', 'Valencia', 'A55667788', 'rodriguez@inver', '961234567'),
(6, 'Construcciones Torres S.L.', 'Calle Luna 17', '50004', 'Zaragoza', 'B33445566', 'torres@construc', '976654321'),
(7, 'Muebles Fernández S.A.', 'Calle Jardines 34', '08002', 'Barcelona', 'A11225533', 'fernandez@muebl', '934567890'),
(12, 'Almacenes Ortega S.L.', 'Avenida Libertad 67', '39010', 'Santander', 'B88990011', 'contacto@ortega', '942345678'),
(13, 'Calzados Gutiérrez S.A.', 'Calle Florida 25', '20001', 'San Sebastián', 'A99887766', 'gutierrez@calza', '943456789'),
(14, 'Textiles Vargas S.L.', 'Calle Alameda 75', '47001', 'Valladolid', 'B55667788', 'vargas@textiles', '983654321'),
(15, 'Ferretería Ramos S.A.', 'Calle Castelar 99', '14001', 'Córdoba', 'A33447755', 'ramos@ferreteri', '957456789'),
(16, 'Transportes Castro S.L.', 'Avenida del Río 43', '35002', 'Las Palmas', 'B99887766', 'castro@transpor', '928123456'),
(17, 'Frutas y Verduras González S.A.', 'Calle Feria 12', '29012', 'Málaga', 'A12344321', 'gonzalez@frutas', '952765432'),
(18, 'Supermercados Moreno S.L.', 'Calle Central 81', '15001', 'A Coruña', 'B23456789', 'moreno@supermer', '981234567'),
(19, 'Imprenta Gómez S.A.', 'Calle Azul 29', '50002', 'Zaragoza', 'A45678901', 'gomez@imprenta.', '976123987'),
(20, 'Cafetería Navarro S.L.', 'Calle Blanca 14', '08010', 'Barcelona', 'B32109876', 'navarro@cafeter', '934123456'),
(21, 'aaa', 'aa', 'aaa', 'aaa', 'aaa', 'aaa', 'aaa'),
(22, 'bbb', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb', 'bbb'),
(23, 'rrrr', 'rrrr', 'rrrr', 'rr', 'rrr', 'rrr', 'rrrr'),
(24, 'gasdfg', 'afds', 'fsad', 'fdsf', 'fasdf', 'asdf', 'sdfsdf'),
(25, 'fasd', 'fasd', 'fs', 'sdfa', 'fas', 'fsad', 'fs'),
(26, 'fasdf', 'sdf', 'asdf', 'asdf', 'dsaf', 'sadfs', 'fas'),
(27, 'fsadf', 'sadf', 'safd', 'asdf', 'asdf', 'sdfasdf', 'fsdaf'),
(28, 'fasdf', 'sadfs', 'adfsa', 'fasf', 'sdf', '', ''),
(29, 'fasdf', 'sdaf', 'sdaf', 'sadf', '', '', ''),
(30, '', '', '', '', '', '', ''),
(31, '', '', '', '', '', '', ''),
(32, '', '', '', '', '', '', ''),
(33, 'fsdaf', 'sdf', 'sadf', 'sadf', 'sadf', 'asdf', 'asdf'),
(34, 'sdfas', 'fasd', 'fsdf', 'sadfs', 'df', 'asdfasdf', 'fasdfs'),
(35, 'asd', 'dsf', 'asdf', 'sadf', 'sdaf', 'sdf', 'dasf'),
(36, 'fsadf', 'sdf', 'fasdf', 'sdf', 'sdafsdf', 'sadf', 'fsadf'),
(37, 're', 'rewt', 'ewtr', 'tewrtew', 'rtewrt', 'ewrt', 'erwter'),
(38, 'gdsfgd', '', 'gfdsfg', '', 'gdsfg', '', ''),
(39, 'fasdf', 'fsadf', '', '', '', '', ''),
(40, 'Jose Vicente', 'Jose Vicente', 'Jose Vicente', 'Jose Vicente', 'Jose Vicente', 'Jose Vicente', 'Jose Vicente'),
(41, 'fasdf', 'fsd', 'fasd', 'fsd', 'fds', 'fsadf', 'sdaf'),
(42, 'sdf', 'sdf', 'sdf', 'dsaf', 'dsf', 'sad', 'fasdf'),
(43, 'gfs', 'fsad', 'fsd', 'fasd', 'fasd', 'dsfa', 'dasf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaspedido`
--

CREATE TABLE `lineaspedido` (
  `Identificador` int(10) NOT NULL,
  `pedidos_fecha` int(10) DEFAULT NULL,
  `productos_nombre` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lineaspedido`
--

INSERT INTO `lineaspedido` (`Identificador`, `pedidos_fecha`, `productos_nombre`, `cantidad`) VALUES
(1, 1, 1, 3),
(2, 1, 2, 5),
(3, 2, 4, 3),
(4, 2, 6, 4),
(5, 1, 2, 5),
(6, 1, 1, 3),
(7, 1, 2, 5),
(8, 2, 4, 3),
(9, 6, 1, 1),
(10, 7, 1, 1),
(11, 8, 1, 1),
(12, 9, 2, 1),
(13, 14, 9, 1),
(14, 15, 9, 1),
(15, 15, 9, 1),
(16, 16, 18, 1),
(17, 17, 18, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `Identificador` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `clientes_razonsocial` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`Identificador`, `fecha`, `clientes_razonsocial`) VALUES
(1, '2024-10-14', 1),
(2, '2024-10-15', 2),
(3, '2024-10-16', 33),
(4, '2024-10-16', 34),
(5, '2024-10-16', 35),
(6, '2024-10-16', 36),
(7, '2024-10-16', 37),
(8, '2024-10-16', 38),
(9, '2024-10-16', 39),
(11, '2024-10-16', NULL),
(12, '2024-10-16', NULL),
(13, '0000-00-00', 1),
(14, '2024-10-17', 40),
(15, '2024-10-17', 41),
(16, '2024-10-17', 42),
(17, '2024-10-17', 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Identificador` int(10) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='En esa tabla guardamos los productos';

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Identificador`, `nombre`, `descripcion`, `precio`) VALUES
(1, 'Refresco Burbuja Cola', 'Refresco sabor cola de 355ml', 12.50),
(2, 'Refresco Brisa Tropical', 'Refresco sabor tropical de 355ml', 12.00),
(3, 'Refresco Citrus Splash', 'Refresco sabor cítrico de 355ml', 11.50),
(4, 'Refresco Naranja Viva', 'Refresco sabor naranja de 355ml', 11.00),
(5, 'Refresco Fresa Fusión', 'Refresco sabor fresa de 355ml', 11.00),
(6, 'Refresco Lima Twist', 'Refresco sabor lima-limón de 355ml', 11.50),
(7, 'Refresco Energía Verde', 'Refresco sabor cítrico energizante de 355ml', 12.00),
(8, 'Refresco Cola Fuerte', 'Refresco sabor cola intenso de 355ml', 13.00),
(9, 'Refresco Sabor Tamarindo', 'Refresco sabor tamarindo de 355ml', 10.50),
(10, 'Refresco Mandarina Dulce', 'Refresco sabor mandarina de 355ml', 10.50),
(11, 'Refresco Manzana Espuma', 'Refresco sabor manzana de 355ml', 11.50),
(12, 'Refresco Sidra Fresca', 'Refresco sabor manzana fermentada de 355ml', 11.50),
(13, 'Refresco Toronja Light', 'Refresco sabor toronja de 355ml', 11.00),
(14, 'Refresco Cola Ligera', 'Refresco sabor cola sin azúcar de 355ml', 12.50),
(15, 'Refresco Tropical Light', 'Refresco sabor tropical sin azúcar de 355ml', 12.00),
(16, 'Refresco Cola Zero Plus', 'Refresco sabor cola sin calorías de 355ml', 12.50),
(17, 'Refresco Citrus Zero', 'Refresco sabor cítrico sin calorías de 355ml', 12.00),
(18, 'Refresco Espuma Rosada', 'Refresco sabor frutos rojos de 355ml', 11.00),
(19, 'Refresco Piña Brillante', 'Refresco sabor piña de 355ml', 10.50),
(20, 'Refresco Guayaba Dulce', 'Refresco sabor guayaba de 355ml', 10.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Identificador` int(255) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `nombrecompleto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Identificador`, `usuario`, `contrasena`, `nombrecompleto`) VALUES
(1, 'jocarsa', 'jocarsa', 'Jose Vicente Carratala');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistalineaspedido`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistalineaspedido` (
`Identificador` int(10)
,`cantidad` int(10)
,`nombre` varchar(100)
,`precio` decimal(10,2)
,`subtotal` decimal(20,2)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vistalineaspedido`
--
DROP TABLE IF EXISTS `vistalineaspedido`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistalineaspedido`  AS SELECT `pedidos`.`Identificador` AS `Identificador`, `lineaspedido`.`cantidad` AS `cantidad`, `productos`.`nombre` AS `nombre`, `productos`.`precio` AS `precio`, `productos`.`precio`* `lineaspedido`.`cantidad` AS `subtotal` FROM ((`lineaspedido` left join `pedidos` on(`lineaspedido`.`pedidos_fecha` = `pedidos`.`Identificador`)) left join `productos` on(`lineaspedido`.`productos_nombre` = `productos`.`Identificador`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `lineaspedido`
--
ALTER TABLE `lineaspedido`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `lineaspedidoaproductos` (`productos_nombre`),
  ADD KEY `lineaspedidoapedidos` (`pedidos_fecha`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`Identificador`),
  ADD KEY `pedidosaclientes` (`clientes_razonsocial`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Identificador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `Identificador` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `lineaspedido`
--
ALTER TABLE `lineaspedido`
  MODIFY `Identificador` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Identificador` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Identificador` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Identificador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineaspedido`
--
ALTER TABLE `lineaspedido`
  ADD CONSTRAINT `lineaspedidoapedidos` FOREIGN KEY (`pedidos_fecha`) REFERENCES `pedidos` (`Identificador`),
  ADD CONSTRAINT `lineaspedidoaproductos` FOREIGN KEY (`productos_nombre`) REFERENCES `productos` (`Identificador`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidosaclientes` FOREIGN KEY (`clientes_razonsocial`) REFERENCES `clientes` (`Identificador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
