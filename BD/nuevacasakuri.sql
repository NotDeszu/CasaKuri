-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2024 a las 09:47:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nuevacasakuri`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `car_id` int(11) NOT NULL,
  `car_fechaC` date DEFAULT NULL,
  `car_subtotal` double(8,2) DEFAULT NULL,
  `car_total` double(8,2) DEFAULT NULL,
  `car_iva` double(8,2) DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carr_inv`
--

CREATE TABLE `carr_inv` (
  `car_id` int(11) DEFAULT NULL,
  `inv_id` int(11) DEFAULT NULL,
  `carinv_cantidad` int(11) DEFAULT NULL,
  `carinv_subtotal` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nombre` varchar(100) DEFAULT NULL,
  `cat_descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`cat_id`, `cat_nombre`, `cat_descripcion`) VALUES
(1, 'Lápices y Plumas', 'Artículos de escritura esenciales para cualquier entorno de estudio u oficina.'),
(2, 'Calculadoras', 'Dispositivos electrónicos para realizar operaciones matemáticas rápidas y precisas.'),
(3, 'Libros y Cuadernos', 'Material de lectura y escritura para tomar notas, estudiar y organizar información.'),
(4, 'Sacapuntas', 'Herramientas para mantener los lápices afilados y listos para su uso.'),
(5, 'Gomas', 'Artículos de borrado utilizados para corregir errores en lápices y algunos bolígrafos.'),
(6, 'Carpetas', 'Productos para organizar y almacenar documentos y papeles importantes.'),
(7, 'Correctores', 'Instrumentos para ocultar o corregir errores en documentos escritos.'),
(8, 'Tijeras', 'Herramientas de corte utilizadas en proyectos de manualidades y para cortar papel.'),
(9, 'Resistoles', 'Adhesivos utilizados para pegar papel, cartón y otros materiales ligeros.'),
(10, 'Reglas', 'Instrumentos de medición y dibujo, esenciales para trabajos precisos y detallados.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfdi_uso`
--

CREATE TABLE `cfdi_uso` (
  `cfdi_id` int(11) NOT NULL,
  `cfdi_clave` varchar(5) NOT NULL,
  `cfdi_descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cfdi_uso`
--

INSERT INTO `cfdi_uso` (`cfdi_id`, `cfdi_clave`, `cfdi_descripcion`) VALUES
(1, 'G01', 'Adquisición de mercancías'),
(2, 'G02', 'Devoluciones, descuentos o bonificaciones'),
(3, 'G03', 'Gastos en general'),
(4, 'I01', 'Construcciones'),
(5, 'I02', 'Mobiliario y equipo de oficina por inversiones'),
(6, 'I03', 'Equipo de transporte'),
(7, 'I04', 'Equipo de cómputo y accesorios'),
(8, 'I05', 'Dados, troqueles, moldes, matrices y herramental'),
(9, 'I06', 'Comunicaciones telefónicas'),
(10, 'I07', 'Comunicaciones satelitales'),
(11, 'I08', 'Otra maquinaria y equipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `ven_id` int(11) DEFAULT NULL,
  `inv_id` int(11) DEFAULT NULL,
  `deve_cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`ven_id`, `inv_id`, `deve_cantidad`) VALUES
(22, 59, 2),
(23, 58, 1),
(23, 57, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `est_id` int(11) NOT NULL,
  `est_nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`est_id`, `est_nombre`) VALUES
(1, 'Queretaro'),
(2, 'Guadalajara'),
(3, 'Monterrey');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `fac_id` int(11) NOT NULL,
  `fac_nombre` varchar(255) DEFAULT NULL,
  `fac_rfc` varchar(13) DEFAULT NULL,
  `fac_domicilio` varchar(255) DEFAULT NULL,
  `fac_fecha` date DEFAULT NULL,
  `ven_id` int(11) DEFAULT NULL,
  `rf_id` int(11) DEFAULT NULL,
  `cfdi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`fac_id`, `fac_nombre`, `fac_rfc`, `fac_domicilio`, `fac_fecha`, `ven_id`, `rf_id`, `cfdi_id`) VALUES
(18, 'Yeltsin', 'Y2KswagQRO', 'Rusia 103, Estputnik', '2024-08-09', 23, 7, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `inv_id` int(11) NOT NULL,
  `inv_existencia` int(11) DEFAULT NULL,
  `suc_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`inv_id`, `inv_existencia`, `suc_id`, `pro_id`) VALUES
(57, 74, 100, 53),
(58, 54, 103, 51),
(59, 28, 102, 52);

--
-- Disparadores `inventario`
--
DELIMITER $$
CREATE TRIGGER `update_product_status_insert_update` AFTER INSERT ON `inventario` FOR EACH ROW BEGIN
    DECLARE total_stock INT;
    
    SELECT SUM(inv_existencia) INTO total_stock
    FROM inventario
    WHERE pro_id = NEW.pro_id;
    
    IF total_stock > 0 THEN
        UPDATE productos SET pro_status = 1 WHERE pro_id = NEW.pro_id;
    ELSE
        UPDATE productos SET pro_status = 0 WHERE pro_id = NEW.pro_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_status_update` AFTER UPDATE ON `inventario` FOR EACH ROW BEGIN
    DECLARE total_stock INT;
    
    SELECT SUM(inv_existencia) INTO total_stock
    FROM inventario
    WHERE pro_id = NEW.pro_id;
    
    IF total_stock > 0 THEN
        UPDATE productos SET pro_status = 1 WHERE pro_id = NEW.pro_id;
    ELSE
        UPDATE productos SET pro_status = 0 WHERE pro_id = NEW.pro_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `pro_id` int(11) NOT NULL,
  `pro_Producto` varchar(100) DEFAULT NULL,
  `pro_precio` float(6,2) DEFAULT NULL,
  `pro_decripcion` varchar(100) DEFAULT NULL,
  `pro_imagen` varchar(200) DEFAULT NULL,
  `pro_status` int(11) DEFAULT 0,
  `cat_id` int(11) DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `pro_precioIVA` double(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`pro_id`, `pro_Producto`, `pro_precio`, `pro_decripcion`, `pro_imagen`, `pro_status`, `cat_id`, `usu_id`, `pro_precioIVA`) VALUES
(50, 'Resitol', 23.00, ' Para pegar hojas de papel', '../AMG/test.png', 0, 9, 18, 26.68),
(51, 'Sacapuntas de mesa', 100.00, ' Sacarle punta a tus lapices', '../AMG/sacapuntas oficina.png', 1, 4, 18, 116.00),
(52, 'Tijeras', 35.00, ' Cortar papel', '../AMG/tijeraspelikan.png', 1, 8, 18, 40.60),
(53, 'Libreta ', 20.00, 'Cuaderno para escribir apuntes', '../AMG/libretarayapelikan.png', 1, 3, 18, 23.20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regimen_fiscal`
--

CREATE TABLE `regimen_fiscal` (
  `rf_id` int(11) NOT NULL,
  `rf_clave` varchar(3) NOT NULL,
  `rf_descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `regimen_fiscal`
--

INSERT INTO `regimen_fiscal` (`rf_id`, `rf_clave`, `rf_descripcion`) VALUES
(1, '601', 'General de Ley Personas Morales'),
(2, '603', 'Personas Morales con Fines no Lucrativos'),
(3, '605', 'Sueldos y Salarios e Ingresos Asimilados a Salarios'),
(4, '606', 'Arrendamiento'),
(5, '608', 'Demás ingresos'),
(6, '609', 'Consolidación'),
(7, '610', 'Residentes en el Extranjero sin Establecimiento Permanente en México'),
(8, '611', 'Ingresos por Dividendos (socios y accionistas)'),
(9, '612', 'Personas Físicas con Actividades Empresariales y Profesionales'),
(10, '614', 'Ingresos por intereses'),
(11, '615', 'Régimen de los ingresos por obtención de premios'),
(12, '616', 'Sin obligaciones fiscales'),
(13, '620', 'Sociedades Cooperativas de Producción que optan por diferir sus ingresos'),
(14, '621', 'Incorporación Fiscal'),
(15, '622', 'Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras'),
(16, '623', 'Opcional para Grupos de Sociedades'),
(17, '624', 'Coordinados'),
(18, '625', 'Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas'),
(19, '626', 'Régimen Simplificado de Confianza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_tipo`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `suc_id` int(11) NOT NULL,
  `suc_nombre` varchar(100) DEFAULT NULL,
  `suc_direccion` varchar(100) DEFAULT NULL,
  `suc_telefono` varchar(50) DEFAULT NULL,
  `suc_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`suc_id`, `suc_nombre`, `suc_direccion`, `suc_telefono`, `suc_email`) VALUES
(100, 'Sucursal Queretaro', '5 de febrero', '442-24-42-425', 'sucQueretaro@gmail.com'),
(102, 'Sucursal Guadalajara', 'Avenida Loper Arteaga', '562-34-34-125', 'sucGuadalajara@gmail.com'),
(103, 'Sucursal Monterrey', 'Avenida Marquez', '321-64-42-409', 'sucMonterrey@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL,
  `usu_nombre` varchar(50) DEFAULT NULL,
  `usu_apellidop` varchar(50) DEFAULT NULL,
  `usu_apellidom` varchar(50) DEFAULT NULL,
  `usu_telefono` varchar(50) DEFAULT NULL,
  `usu_direccion` varchar(100) DEFAULT NULL,
  `usu_email` varchar(100) DEFAULT NULL,
  `usu_pass` varchar(50) DEFAULT NULL,
  `usu_cp` int(11) DEFAULT NULL,
  `est_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_nombre`, `usu_apellidop`, `usu_apellidom`, `usu_telefono`, `usu_direccion`, `usu_email`, `usu_pass`, `usu_cp`, `est_id`, `rol_id`) VALUES
(17, 'Yeltsin', 'Gonzales', 'Sanchez', '3356680034', 'Veracruz Centro', 'yel@yahoo.com', '32250170a0dca92d53ec9624f336ca24', 45028, 2, 2),
(18, 'felipe', 'Cruz', 'Bautista', '4424487723', 'Los Angeles, California', 'felipe@casakuri.com', '32250170a0dca92d53ec9624f336ca24', 67128, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `ven_id` int(11) NOT NULL,
  `ven_id_transaccion` varchar(100) DEFAULT NULL,
  `ven_fecha` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `ven_email` varchar(50) DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `ven_total` double(8,2) DEFAULT NULL,
  `ven_iva` double(6,2) DEFAULT NULL,
  `ven_subtotal` double(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`ven_id`, `ven_id_transaccion`, `ven_fecha`, `status`, `ven_email`, `usu_id`, `ven_total`, `ven_iva`, `ven_subtotal`) VALUES
(22, '6B330166336428812', '2024-08-09', 'COMPLETED', 'sb-6vske31968746@personal.example.com', 17, 81.20, 11.20, 70.00),
(23, '13E52614CX151330R', '2024-08-09', 'COMPLETED', 'sb-6vske31968746@personal.example.com', 17, 185.60, 9.60, 160.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `usu_id` (`usu_id`);

--
-- Indices de la tabla `carr_inv`
--
ALTER TABLE `carr_inv`
  ADD KEY `car_id` (`car_id`),
  ADD KEY `inv_id` (`inv_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `cfdi_uso`
--
ALTER TABLE `cfdi_uso`
  ADD PRIMARY KEY (`cfdi_id`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD KEY `ven_id` (`ven_id`),
  ADD KEY `inv_id` (`inv_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`est_id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`fac_id`),
  ADD KEY `ven_id` (`ven_id`),
  ADD KEY `rf_id` (`rf_id`),
  ADD KEY `cfdi_id` (`cfdi_id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`inv_id`),
  ADD KEY `suc_id` (`suc_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `usu_id` (`usu_id`);

--
-- Indices de la tabla `regimen_fiscal`
--
ALTER TABLE `regimen_fiscal`
  ADD PRIMARY KEY (`rf_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`suc_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `est_id` (`est_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`ven_id`),
  ADD KEY `usu_id` (`usu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cfdi_uso`
--
ALTER TABLE `cfdi_uso`
  MODIFY `cfdi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `regimen_fiscal`
--
ALTER TABLE `regimen_fiscal`
  MODIFY `rf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `ven_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `usuarios` (`usu_id`);

--
-- Filtros para la tabla `carr_inv`
--
ALTER TABLE `carr_inv`
  ADD CONSTRAINT `carr_inv_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `carrito` (`car_id`),
  ADD CONSTRAINT `carr_inv_ibfk_2` FOREIGN KEY (`inv_id`) REFERENCES `inventario` (`inv_id`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`ven_id`) REFERENCES `venta` (`ven_id`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`inv_id`) REFERENCES `inventario` (`inv_id`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`ven_id`) REFERENCES `venta` (`ven_id`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`rf_id`) REFERENCES `regimen_fiscal` (`rf_id`),
  ADD CONSTRAINT `facturas_ibfk_3` FOREIGN KEY (`cfdi_id`) REFERENCES `cfdi_uso` (`cfdi_id`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`suc_id`) REFERENCES `sucursal` (`suc_id`),
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `productos` (`pro_id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categoria` (`cat_id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`usu_id`) REFERENCES `usuarios` (`usu_id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `usuarios` (`usu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
