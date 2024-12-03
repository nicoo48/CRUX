-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla crux.configuraciones
CREATE TABLE IF NOT EXISTS `configuraciones` (
  `cfg_id` int(11) NOT NULL AUTO_INCREMENT,
  `cfg_per_id` int(11) DEFAULT NULL,
  `cfg_nombre` varchar(50) DEFAULT NULL,
  `cfg_valor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cfg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla crux.configuraciones: ~2 rows (aproximadamente)
INSERT INTO `configuraciones` (`cfg_id`, `cfg_per_id`, `cfg_nombre`, `cfg_valor`) VALUES
	(9, 1, 'sistema_fifo', '1'),
	(10, 1, 'tienda_iniciar', '1'),
	(11, 1, 'tienda_defecto', '11');

-- Volcando estructura para tabla crux.movimientos
CREATE TABLE IF NOT EXISTS `movimientos` (
  `mov_id` int(11) NOT NULL AUTO_INCREMENT,
  `mov_tnd_id` int(11) DEFAULT NULL,
  `mov_per_id` varchar(50) DEFAULT NULL,
  `mov_fecha` datetime DEFAULT NULL,
  `mov_tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mov_id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla crux.movimientos: ~28 rows (aproximadamente)
INSERT INTO `movimientos` (`mov_id`, `mov_tnd_id`, `mov_per_id`, `mov_fecha`, `mov_tipo`) VALUES
	(101, 11, '1', '2023-06-05 10:00:00', 'ENT'),
	(102, 11, '1', '2023-06-10 14:00:00', 'ENT'),
	(103, 11, '1', '2023-06-15 12:30:00', 'SAL'),
	(104, 11, '1', '2023-06-20 16:45:00', 'SAL'),
	(105, 11, '1', '2023-07-05 09:30:00', 'ENT'),
	(106, 11, '1', '2023-07-10 15:15:00', 'ENT'),
	(107, 11, '1', '2023-07-15 11:45:00', 'SAL'),
	(108, 11, '1', '2023-07-20 14:20:00', 'SAL'),
	(109, 11, '1', '2023-08-05 10:00:00', 'ENT'),
	(110, 11, '1', '2023-08-10 14:00:00', 'ENT'),
	(111, 11, '1', '2023-08-15 12:30:00', 'SAL'),
	(112, 11, '1', '2023-08-20 16:45:00', 'SAL'),
	(113, 11, '1', '2023-09-05 10:00:00', 'ENT'),
	(114, 11, '1', '2023-09-10 14:00:00', 'ENT'),
	(115, 11, '1', '2023-09-15 12:30:00', 'SAL'),
	(116, 11, '1', '2023-09-20 16:45:00', 'SAL'),
	(117, 11, '1', '2023-10-05 10:00:00', 'ENT'),
	(118, 11, '1', '2023-10-10 14:00:00', 'ENT'),
	(119, 11, '1', '2023-10-15 12:30:00', 'SAL'),
	(120, 11, '1', '2023-10-20 16:45:00', 'SAL'),
	(121, 11, '1', '2023-11-05 10:00:00', 'ENT'),
	(122, 11, '1', '2023-11-10 14:00:00', 'ENT'),
	(123, 11, '1', '2023-11-15 12:30:00', 'SAL'),
	(124, 11, '1', '2023-11-20 16:45:00', 'SAL'),
	(125, 11, '1', '2023-12-05 10:00:00', 'ENT'),
	(126, 11, '1', '2023-12-10 14:00:00', 'ENT'),
	(127, 11, '1', '2023-12-15 12:30:00', 'SAL'),
	(128, 11, '1', '2023-12-20 16:45:00', 'SAL');

-- Volcando estructura para tabla crux.movimientos_detalle
CREATE TABLE IF NOT EXISTS `movimientos_detalle` (
  `mdet_id` int(11) NOT NULL AUTO_INCREMENT,
  `mdet_mov_id` int(11) DEFAULT NULL,
  `mdet_tnd_id` int(11) NOT NULL DEFAULT 0,
  `mdet_pro_id` int(11) DEFAULT NULL,
  `mdet_cantidad` int(11) NOT NULL DEFAULT 0,
  `mdet_valor_unitario` int(11) DEFAULT NULL,
  `mdet_total` int(11) NOT NULL DEFAULT 0,
  `mdet_clase` varchar(50) DEFAULT NULL,
  `mdet_glosa` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mdet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla crux.movimientos_detalle: ~112 rows (aproximadamente)
INSERT INTO `movimientos_detalle` (`mdet_id`, `mdet_mov_id`, `mdet_tnd_id`, `mdet_pro_id`, `mdet_cantidad`, `mdet_valor_unitario`, `mdet_total`, `mdet_clase`, `mdet_glosa`) VALUES
	(201, 101, 11, 1, 150, 20, 7000, 'COM', 'Compra junio'),
	(202, 101, 11, 2, 100, 15, 1500, 'COM', 'Compra junio'),
	(203, 101, 11, 3, 200, 10, 2000, 'COM', 'Compra junio'),
	(204, 101, 11, 4, 120, 12, 1440, 'COM', 'Compra junio'),
	(205, 102, 11, 1, 180, 20, 3510, 'COM', 'Reabastecimiento junio'),
	(206, 102, 11, 2, 90, 15, 1305, 'COM', 'Reabastecimiento junio'),
	(207, 102, 11, 3, 220, 10, 2156, 'COM', 'Reabastecimiento junio'),
	(208, 102, 11, 4, 150, 13, 1980, 'COM', 'Reabastecimiento junio'),
	(209, 103, 11, 1, 100, 25, 2500, 'VNT', 'Venta junio'),
	(210, 103, 11, 2, 70, 18, 1260, 'VNT', 'Venta junio'),
	(211, 103, 11, 3, 90, 13, 1125, 'VNT', 'Venta junio'),
	(212, 103, 11, 4, 50, 14, 700, 'VNT', 'Venta junio'),
	(213, 104, 11, 1, 120, 26, 3120, 'VNT', 'Demanda alta junio'),
	(214, 104, 11, 2, 80, 19, 1480, 'VNT', 'Demanda alta junio'),
	(215, 104, 11, 3, 100, 13, 1300, 'VNT', 'Demanda alta junio'),
	(216, 104, 11, 4, 60, 15, 900, 'VNT', 'Demanda alta junio'),
	(217, 105, 11, 1, 140, 20, 2800, 'COM', 'Compra julio'),
	(218, 105, 11, 2, 110, 16, 1705, 'COM', 'Compra julio'),
	(219, 105, 11, 3, 190, 10, 1938, 'COM', 'Compra julio'),
	(220, 105, 11, 4, 130, 13, 1690, 'COM', 'Compra julio'),
	(221, 106, 11, 1, 200, 21, 4200, 'COM', 'Reabastecimiento julio'),
	(222, 106, 11, 2, 100, 15, 1500, 'COM', 'Reabastecimiento julio'),
	(223, 106, 11, 3, 230, 11, 2530, 'COM', 'Reabastecimiento julio'),
	(224, 106, 11, 4, 140, 15, 2030, 'COM', 'Reabastecimiento julio'),
	(225, 107, 11, 1, 80, 25, 2000, 'VNT', 'Venta julio'),
	(226, 107, 11, 2, 60, 18, 1080, 'VNT', 'Venta julio'),
	(227, 107, 11, 3, 100, 13, 1280, 'VNT', 'Venta julio'),
	(228, 107, 11, 4, 90, 15, 1350, 'VNT', 'Venta julio'),
	(229, 108, 11, 1, 120, 27, 3180, 'VNT', 'Demanda alta julio'),
	(230, 108, 11, 2, 70, 18, 1274, 'VNT', 'Demanda alta julio'),
	(231, 108, 11, 3, 110, 14, 1540, 'VNT', 'Demanda alta julio'),
	(232, 108, 11, 4, 100, 16, 1580, 'VNT', 'Demanda alta julio'),
	(233, 109, 11, 1, 110, 19, 2090, 'COM', 'Compra agosto'),
	(234, 109, 11, 2, 120, 16, 1860, 'COM', 'Compra agosto'),
	(235, 109, 11, 3, 140, 10, 1428, 'COM', 'Compra agosto'),
	(236, 109, 11, 4, 130, 13, 1625, 'COM', 'Compra agosto'),
	(237, 110, 11, 1, 150, 20, 3000, 'COM', 'Reabastecimiento agosto'),
	(238, 110, 11, 2, 100, 17, 1650, 'COM', 'Reabastecimiento agosto'),
	(239, 110, 11, 3, 130, 11, 1456, 'COM', 'Reabastecimiento agosto'),
	(240, 110, 11, 4, 120, 14, 1680, 'COM', 'Reabastecimiento agosto'),
	(241, 111, 11, 1, 100, 26, 2550, 'VNT', 'Venta agosto'),
	(242, 111, 11, 2, 70, 19, 1295, 'VNT', 'Venta agosto'),
	(243, 111, 11, 3, 110, 13, 1430, 'VNT', 'Venta agosto'),
	(244, 111, 11, 4, 90, 15, 1350, 'VNT', 'Venta agosto'),
	(245, 112, 11, 1, 120, 27, 3240, 'VNT', 'Demanda alta agosto'),
	(246, 112, 11, 2, 80, 19, 1520, 'VNT', 'Demanda alta agosto'),
	(247, 112, 11, 3, 100, 14, 1400, 'VNT', 'Demanda alta agosto'),
	(248, 112, 11, 4, 110, 17, 1815, 'VNT', 'Demanda alta agosto'),
	(249, 113, 11, 1, 120, 19, 2220, 'COM', 'Compra septiembre'),
	(250, 113, 11, 2, 110, 15, 1650, 'COM', 'Compra septiembre'),
	(251, 113, 11, 3, 150, 11, 1680, 'COM', 'Compra septiembre'),
	(252, 113, 11, 4, 140, 13, 1820, 'COM', 'Compra septiembre'),
	(253, 114, 11, 1, 130, 21, 2665, 'COM', 'Reabastecimiento septiembre'),
	(254, 114, 11, 2, 90, 18, 1575, 'COM', 'Reabastecimiento septiembre'),
	(255, 114, 11, 3, 140, 12, 1680, 'COM', 'Reabastecimiento septiembre'),
	(256, 114, 11, 4, 110, 15, 1595, 'COM', 'Reabastecimiento septiembre'),
	(257, 115, 11, 1, 110, 26, 2860, 'VNT', 'Venta septiembre'),
	(258, 115, 11, 2, 80, 19, 1520, 'VNT', 'Venta septiembre'),
	(259, 115, 11, 3, 90, 14, 1215, 'VNT', 'Venta septiembre'),
	(260, 115, 11, 4, 100, 16, 1600, 'VNT', 'Venta septiembre'),
	(261, 116, 11, 1, 130, 28, 3575, 'VNT', 'Demanda alta septiembre'),
	(262, 116, 11, 2, 100, 20, 2000, 'VNT', 'Demanda alta septiembre'),
	(263, 116, 11, 3, 110, 15, 1650, 'VNT', 'Demanda alta septiembre'),
	(264, 116, 11, 4, 120, 17, 2040, 'VNT', 'Demanda alta septiembre'),
	(265, 117, 11, 1, 140, 19, 2660, 'COM', 'Compra octubre'),
	(266, 117, 11, 2, 100, 16, 1600, 'COM', 'Compra octubre'),
	(267, 117, 11, 3, 160, 12, 1840, 'COM', 'Compra octubre'),
	(268, 117, 11, 4, 150, 14, 2025, 'COM', 'Compra octubre'),
	(269, 118, 11, 1, 120, 21, 2520, 'COM', 'Reabastecimiento octubre'),
	(270, 118, 11, 2, 110, 17, 1870, 'COM', 'Reabastecimiento octubre'),
	(271, 118, 11, 3, 130, 13, 1625, 'COM', 'Reabastecimiento octubre'),
	(272, 118, 11, 4, 140, 15, 2100, 'COM', 'Reabastecimiento octubre'),
	(273, 119, 11, 1, 100, 27, 2700, 'VNT', 'Venta octubre'),
	(274, 119, 11, 2, 70, 20, 1365, 'VNT', 'Venta octubre'),
	(275, 119, 11, 3, 90, 14, 1260, 'VNT', 'Venta octubre'),
	(276, 119, 11, 4, 110, 17, 1870, 'VNT', 'Venta octubre'),
	(277, 120, 11, 1, 150, 28, 4200, 'VNT', 'Demanda alta octubre'),
	(278, 120, 11, 2, 90, 20, 1800, 'VNT', 'Demanda alta octubre'),
	(279, 120, 11, 3, 100, 16, 1600, 'VNT', 'Demanda alta octubre'),
	(280, 120, 11, 4, 130, 18, 2340, 'VNT', 'Demanda alta octubre'),
	(281, 121, 11, 1, 150, 18, 2700, 'COM', 'Compra noviembre'),
	(282, 121, 11, 2, 120, 17, 1980, 'COM', 'Compra noviembre'),
	(283, 121, 11, 3, 170, 12, 2040, 'COM', 'Compra noviembre'),
	(284, 121, 11, 4, 140, 14, 1960, 'COM', 'Compra noviembre'),
	(285, 122, 11, 1, 160, 22, 3440, 'COM', 'Reabastecimiento noviembre'),
	(286, 122, 11, 2, 110, 17, 1870, 'COM', 'Reabastecimiento noviembre'),
	(287, 122, 11, 3, 140, 13, 1820, 'COM', 'Reabastecimiento noviembre'),
	(288, 122, 11, 4, 130, 15, 1950, 'COM', 'Reabastecimiento noviembre'),
	(289, 123, 11, 1, 90, 28, 2475, 'VNT', 'Venta noviembre'),
	(290, 123, 11, 2, 80, 21, 1640, 'VNT', 'Venta noviembre'),
	(291, 123, 11, 3, 110, 16, 1705, 'VNT', 'Venta noviembre'),
	(292, 123, 11, 4, 120, 18, 2160, 'VNT', 'Venta noviembre'),
	(293, 124, 11, 1, 130, 29, 3705, 'VNT', 'Demanda alta noviembre'),
	(294, 124, 11, 2, 100, 21, 2100, 'VNT', 'Demanda alta noviembre'),
	(295, 124, 11, 3, 120, 16, 1920, 'VNT', 'Demanda alta noviembre'),
	(296, 124, 11, 4, 140, 19, 2660, 'VNT', 'Demanda alta noviembre'),
	(297, 125, 11, 1, 160, 19, 3040, 'COM', 'Compra diciembre'),
	(298, 125, 11, 2, 130, 17, 2210, 'COM', 'Compra diciembre'),
	(299, 125, 11, 3, 180, 13, 2250, 'COM', 'Compra diciembre'),
	(300, 125, 11, 4, 150, 15, 2175, 'COM', 'Compra diciembre'),
	(301, 126, 11, 1, 170, 22, 3740, 'COM', 'Reabastecimiento diciembre'),
	(302, 126, 11, 2, 120, 18, 2160, 'COM', 'Reabastecimiento diciembre'),
	(303, 126, 11, 3, 150, 13, 1950, 'COM', 'Reabastecimiento diciembre'),
	(304, 126, 11, 4, 140, 16, 2240, 'COM', 'Reabastecimiento diciembre'),
	(305, 127, 11, 1, 100, 28, 2800, 'VNT', 'Venta diciembre'),
	(306, 127, 11, 2, 90, 22, 1935, 'VNT', 'Venta diciembre'),
	(307, 127, 11, 3, 120, 17, 1980, 'VNT', 'Venta diciembre'),
	(308, 127, 11, 4, 130, 19, 2405, 'VNT', 'Venta diciembre'),
	(309, 128, 11, 1, 140, 29, 4060, 'VNT', 'Demanda alta diciembre'),
	(310, 128, 11, 2, 110, 22, 2420, 'VNT', 'Demanda alta diciembre'),
	(311, 128, 11, 3, 130, 17, 2210, 'VNT', 'Demanda alta diciembre'),
	(312, 128, 11, 4, 150, 20, 2925, 'VNT', 'Demanda alta diciembre');

-- Volcando estructura para tabla crux.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `per_id` int(11) NOT NULL AUTO_INCREMENT,
  `per_clave` varchar(50) DEFAULT NULL,
  `per_usuario` varchar(50) DEFAULT NULL,
  `per_apellidos` varchar(50) DEFAULT NULL,
  `per_imagen` varchar(255) DEFAULT NULL,
  `per_telefono` varchar(50) DEFAULT NULL,
  `per_nombre` varchar(50) DEFAULT NULL,
  `per_correo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla crux.personas: ~0 rows (aproximadamente)
INSERT INTO `personas` (`per_id`, `per_clave`, `per_usuario`, `per_apellidos`, `per_imagen`, `per_telefono`, `per_nombre`, `per_correo`) VALUES
	(1, '123', 'admin', NULL, NULL, NULL, NULL, NULL);

-- Volcando estructura para tabla crux.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_tnd_id` int(11) DEFAULT NULL,
  `pro_per_id` int(11) DEFAULT NULL,
  `pro_unidad` varchar(50) DEFAULT NULL,
  `pro_codigo` varchar(255) DEFAULT NULL,
  `pro_nombre` varchar(255) DEFAULT NULL,
  `pro_descripcion` varchar(255) DEFAULT NULL,
  `pro_precio` int(11) DEFAULT NULL,
  `pro_codigo_barra` varchar(50) DEFAULT NULL,
  `pro_imagen` varchar(255) DEFAULT NULL,
  `pro_estado` int(1) DEFAULT 1,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla crux.productos: ~3 rows (aproximadamente)
INSERT INTO `productos` (`pro_id`, `pro_tnd_id`, `pro_per_id`, `pro_unidad`, `pro_codigo`, `pro_nombre`, `pro_descripcion`, `pro_precio`, `pro_codigo_barra`, `pro_imagen`, `pro_estado`) VALUES
	(1, 11, 1, '1', 'PRO1', 'producto1 ', NULL, 15000, NULL, NULL, 1),
	(2, 11, 1, '1', 'PRO2', 'producto2 ', NULL, 8000, NULL, NULL, 1),
	(3, 11, 1, '1', 'PRO3', 'producto3', NULL, 75000, NULL, NULL, 1);

-- Volcando estructura para vista crux.stock
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `stock` (
	`tienda` INT(11) NOT NULL,
	`producto` INT(11) NULL,
	`total_entradas` DECIMAL(32,0) NULL,
	`total_salidas` DECIMAL(32,0) NULL,
	`movimientos_entradas` BIGINT(21) NOT NULL,
	`movimientos_salidas` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla crux.tiendas
CREATE TABLE IF NOT EXISTS `tiendas` (
  `tnd_id` int(11) NOT NULL AUTO_INCREMENT,
  `tnd_per_id` int(11) DEFAULT NULL,
  `tnd_codigo` varchar(6) DEFAULT NULL,
  `tnd_nombre` varchar(255) DEFAULT NULL,
  `tnd_direccion` varchar(255) DEFAULT NULL,
  `tnd_meta_mensual` int(19) DEFAULT NULL,
  PRIMARY KEY (`tnd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla crux.tiendas: ~0 rows (aproximadamente)
INSERT INTO `tiendas` (`tnd_id`, `tnd_per_id`, `tnd_codigo`, `tnd_nombre`, `tnd_direccion`, `tnd_meta_mensual`) VALUES
	(11, 1, 'TND1', 'tienda 1', 'av uno 1234', 12000000);

-- Volcando estructura para tabla crux.unidad_medida
CREATE TABLE IF NOT EXISTS `unidad_medida` (
  `uni_id` int(11) NOT NULL AUTO_INCREMENT,
  `uni_codigo` varchar(50) DEFAULT NULL,
  `uni_nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`uni_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla crux.unidad_medida: ~0 rows (aproximadamente)

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `stock`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `stock` AS SELECT 
    mdet_tnd_id AS tienda,
    mdet_pro_id AS producto,
    SUM(CASE 
        WHEN mov.mov_tipo = 'ENT' THEN mdet_cantidad 
        ELSE 0 
    END) AS total_entradas,
    SUM(CASE 
        WHEN mov.mov_tipo = 'SAL' THEN mdet_cantidad 
        ELSE 0 
    END) AS total_salidas,
    COUNT(CASE 
        WHEN mov.mov_tipo = 'ENT' THEN 1 
        ELSE NULL 
    END) AS movimientos_entradas,
    COUNT(CASE 
        WHEN mov.mov_tipo = 'SAL' THEN 1 
        ELSE NULL 
    END) AS movimientos_salidas
FROM movimientos_detalle mdet
INNER JOIN movimientos mov ON mdet.mdet_mov_id = mov.mov_id
GROUP BY mdet_tnd_id, mdet_pro_id ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
