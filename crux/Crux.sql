-- Volcando estructura para tabla crux.configuraciones
CREATE TABLE IF NOT EXISTS `configuraciones` (
  `cfg_id` int(11) NOT NULL AUTO_INCREMENT,
  `cfg_per_id` int(11) DEFAULT NULL,
  `cfg_nombre` varchar(50) DEFAULT NULL,
  `cfg_valor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cfg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla crux.movimientos
CREATE TABLE IF NOT EXISTS `movimientos` (
  `mov_id` int(11) NOT NULL AUTO_INCREMENT,
  `mov_tnd_id` int(11) DEFAULT NULL,
  `mov_per_id` varchar(50) DEFAULT NULL,
  `mov_fecha` datetime DEFAULT NULL,
  `mov_tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mov_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
