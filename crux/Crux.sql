-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.5.0.6677
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla crux.configuraciones: ~0 rows (aproximadamente)

-- Volcando estructura para tabla crux.movimientos
CREATE TABLE IF NOT EXISTS `movimientos` (
  `mov_id` int(11) NOT NULL AUTO_INCREMENT,
  `mov_tnd_id` int(11) DEFAULT NULL,
  `mov_per_id` varchar(50) DEFAULT NULL,
  `mov_fecha` datetime DEFAULT NULL,
  `mov_tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mov_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla crux.movimientos: ~4 rows (aproximadamente)
INSERT INTO `movimientos` (`mov_id`, `mov_tnd_id`, `mov_per_id`, `mov_fecha`, `mov_tipo`) VALUES
	(33, 11, '1', '2024-11-06 13:42:28', 'SAL'),
	(34, 11, '1', '2024-11-06 13:42:42', 'SAL'),
	(35, 11, '1', '2024-11-06 13:43:08', 'SAL'),
	(36, 11, '1', '2024-11-08 13:43:21', 'SAL');

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla crux.movimientos_detalle: ~4 rows (aproximadamente)
INSERT INTO `movimientos_detalle` (`mdet_id`, `mdet_mov_id`, `mdet_tnd_id`, `mdet_pro_id`, `mdet_cantidad`, `mdet_valor_unitario`, `mdet_total`, `mdet_clase`, `mdet_glosa`) VALUES
	(41, 33, 11, 1, 150, 15000, 2250000, 'COM', 'prueba'),
	(42, 34, 11, 2, 80, 7800, 624000, 'COM', ''),
	(43, 35, 11, 1, 20, 60200, 1204000, 'VNT', ''),
	(44, 36, 11, 2, 60, 7821, 469260, 'VNT', '');

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
	(1, 1, 1, '1', 'PRO1', 'producto1 ', NULL, 15000, NULL, NULL, 1),
	(2, 1, 1, '1', 'PRO2', 'producto2 ', NULL, 8000, NULL, NULL, 1),
	(3, 1, 1, '1', 'PRO3', 'producto3', NULL, 75000, NULL, NULL, 1);

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

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
