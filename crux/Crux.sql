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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crux.movimientos
CREATE TABLE IF NOT EXISTS `movimientos` (
  `mov_id` int(11) NOT NULL AUTO_INCREMENT,
  `mov_clase` varchar(50) DEFAULT NULL,
  `mov_tienda` varchar(50) DEFAULT NULL,
  `mov_responsable` varchar(50) DEFAULT NULL,
  `mov_glosa` varchar(50) DEFAULT NULL,
  `mov_fecha` datetime DEFAULT NULL,
  `mov_tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mov_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crux.movimientos_detalle
CREATE TABLE IF NOT EXISTS `movimientos_detalle` (
  `mdet_id` int(11) NOT NULL AUTO_INCREMENT,
  `mdet_mov_id` int(11) DEFAULT NULL,
  `mdet_cantidad` int(11) NOT NULL DEFAULT 0,
  `mdet_producto` int(11) DEFAULT NULL,
  `mdet_tienda` int(11) NOT NULL DEFAULT 0,
  `mdet_total` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`mdet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crux.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_unidad` varchar(50) DEFAULT NULL,
  `pro_responsable` int(11) DEFAULT NULL,
  `pro_codigo` varchar(255) DEFAULT NULL,
  `pro_nombre` varchar(255) DEFAULT NULL,
  `pro_descripcion` varchar(255) DEFAULT NULL,
  `pro_precio` int(11) DEFAULT NULL,
  `pro_codigo_barra` varchar(50) DEFAULT NULL,
  `pro_imagen` varchar(50) DEFAULT NULL,
  `pro_estado` int(1) DEFAULT 1,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crux.tiendas
CREATE TABLE IF NOT EXISTS `tiendas` (
  `tnd_id` int(11) NOT NULL AUTO_INCREMENT,
  `tnd_per_id` int(11) DEFAULT NULL,
  `tnd_codigo` varchar(6) DEFAULT NULL,
  `tnd_nombre` varchar(255) DEFAULT NULL,
  `tnd_direccion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tnd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crux.unidad_medida
CREATE TABLE IF NOT EXISTS `unidad_medida` (
  `uni_id` int(11) NOT NULL AUTO_INCREMENT,
  `uni_codigo` varchar(50) DEFAULT NULL,
  `uni_nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`uni_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
