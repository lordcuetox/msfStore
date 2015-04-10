ALTER TABLE `detalle_pedido` ADD `etiqueta_producto` VARCHAR(100) NULL AFTER `CVE_PRODUCTO`;
ALTER TABLE `detalle_pedido` CHANGE `etiqueta_producto` `etiqueta_producto` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
