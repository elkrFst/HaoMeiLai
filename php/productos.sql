-- Tabla de productos para Hao Mei Lai
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `categoria` varchar(40) NOT NULL,
  `stock` int(5) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
