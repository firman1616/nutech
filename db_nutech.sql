/*
 Navicat Premium Data Transfer

 Source Server         : laragon
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : db_nutech

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 29/04/2022 16:35:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_barang
-- ----------------------------
DROP TABLE IF EXISTS `tbl_barang`;
CREATE TABLE `tbl_barang`  (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kd_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_beli` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_jual` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stock` int(11) NULL DEFAULT NULL,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `flag` double(255, 0) NULL DEFAULT 0,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_barang
-- ----------------------------
INSERT INTO `tbl_barang` VALUES (1, 'BR00001', 'Barang 1', '200', '200', 160, 'BR_29042022022119.jpg', 0);
INSERT INTO `tbl_barang` VALUES (2, 'BR00002', 'barang 2', '100', '200', 300, 'BR_29042022022502.jpg', 0);
INSERT INTO `tbl_barang` VALUES (3, 'BR00003', 'Barang 3', '150', '150', 200, 'BR_29042022023142.jpg', 0);
INSERT INTO `tbl_barang` VALUES (4, 'BR00004', 'Barang', '1', '1', 1, '', 0);

-- ----------------------------
-- Table structure for tbl_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_transaksi`;
CREATE TABLE `tbl_transaksi`  (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `kd_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kd_barang` int(255) NULL DEFAULT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qty_beli` int(11) NULL DEFAULT NULL,
  `sub_total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_transaksi
-- ----------------------------
INSERT INTO `tbl_transaksi` VALUES (1, 'TR00001', 1, 'Barang 1', '200', 10, '2000');
INSERT INTO `tbl_transaksi` VALUES (2, 'TR00002', 2, 'barang 2', '200', 30, '6000');
INSERT INTO `tbl_transaksi` VALUES (3, 'TR00003', 1, 'Barang 1', '200', 100, '20000');
INSERT INTO `tbl_transaksi` VALUES (7, 'TR00004', 1, 'Barang 1', '200', 10, '2000');
INSERT INTO `tbl_transaksi` VALUES (8, 'TR00008', 1, 'Barang 1', '200', 10, '2000');

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `id_user` int(255) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `level` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (1, 'Moch. Firman Firdaus', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1);

-- ----------------------------
-- Triggers structure for table tbl_transaksi
-- ----------------------------
DROP TRIGGER IF EXISTS `stock_add`;
delimiter ;;
CREATE TRIGGER `stock_add` AFTER INSERT ON `tbl_transaksi` FOR EACH ROW BEGIN
UPDATE tbl_barang SET stock=stock-new.qty_beli
WHERE id_barang = new.kd_barang;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tbl_transaksi
-- ----------------------------
DROP TRIGGER IF EXISTS `stock_update`;
delimiter ;;
CREATE TRIGGER `stock_update` AFTER UPDATE ON `tbl_transaksi` FOR EACH ROW BEGIN
UPDATE tbl_barang
SET stock=tbl_barang.stock-new.qty_beli
WHERE id_barang = new.kd_barang;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tbl_transaksi
-- ----------------------------
DROP TRIGGER IF EXISTS `stock_delete`;
delimiter ;;
CREATE TRIGGER `stock_delete` AFTER DELETE ON `tbl_transaksi` FOR EACH ROW BEGIN
UPDATE tbl_barang 
SET stock=stock+old.qty_beli
WHERE id_barang = old.kd_barang;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
