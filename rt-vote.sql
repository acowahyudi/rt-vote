/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100316
 Source Host           : localhost:3306
 Source Schema         : rt-vote

 Target Server Type    : MySQL
 Target Server Version : 100316
 File Encoding         : 65001

 Date: 09/08/2021 19:20:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hasil_voting
-- ----------------------------
DROP TABLE IF EXISTS `hasil_voting`;
CREATE TABLE `hasil_voting`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periode_id` int(11) NOT NULL,
  `kandidat_id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_hasil_voting_periode1_idx`(`periode_id`) USING BTREE,
  INDEX `fk_hasil_voting_kandidat1_idx`(`kandidat_id`) USING BTREE,
  INDEX `fk_hasil_voting_users1_idx`(`users_id`) USING BTREE,
  CONSTRAINT `fk_hasil_voting_kandidat1` FOREIGN KEY (`kandidat_id`) REFERENCES `kandidat` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_hasil_voting_periode1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_hasil_voting_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hasil_voting
-- ----------------------------
INSERT INTO `hasil_voting` VALUES (1, 1, 1, 9, '2021-07-28 06:58:07', '2021-07-28 06:58:07', NULL);

-- ----------------------------
-- Table structure for kandidat
-- ----------------------------
DROP TABLE IF EXISTS `kandidat`;
CREATE TABLE `kandidat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_calon` int(11) NULL DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `visi` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `periode_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_kandidat_users1_idx`(`users_id`) USING BTREE,
  INDEX `fk_kandidat_periode`(`periode_id`) USING BTREE,
  CONSTRAINT `fk_kandidat_periode` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kandidat_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kandidat
-- ----------------------------
INSERT INTO `kandidat` VALUES (1, 1, 4, 'storage/kandidat/5.jpg', 'Membentuk kerukunan warga RT 08 dan memelihara lingkungan yang aman, nyaman, tentram, bersih, sehat, cerdas dan kreatif serta membangun kerjasama lingkungan yang harmonis dengan pelaksanaanya yang bertanggung jawab.', 1, '2021-07-28 06:16:53', '2021-07-28 06:17:22', NULL);
INSERT INTO `kandidat` VALUES (2, 2, 11, 'storage/kandidat/6.jpg', 'Terwujudnya kerukunan hidup antar warga yang dilandasi dengan akhlaq mulia dan toleransi kebersamaan yang harmonis, aman, damai dan sejahtera', 1, '2021-07-28 06:22:02', '2021-07-28 06:22:03', NULL);

-- ----------------------------
-- Table structure for kegiatan_rt
-- ----------------------------
DROP TABLE IF EXISTS `kegiatan_rt`;
CREATE TABLE `kegiatan_rt`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rukun_tetangga_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_kegiatan_rt_rukun_tetangga1_idx`(`rukun_tetangga_id`) USING BTREE,
  CONSTRAINT `fk_kegiatan_rt_rukun_tetangga1` FOREIGN KEY (`rukun_tetangga_id`) REFERENCES `rukun_tetangga` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kegiatan_rt
-- ----------------------------
INSERT INTO `kegiatan_rt` VALUES (1, 'Vaksinasi masal rt 08', 'storage/kegiatanRT/1.png', 2, '2021-07-27 09:59:42', '2021-07-28 06:28:21', '2021-07-28 06:28:21');
INSERT INTO `kegiatan_rt` VALUES (2, 'Kegiatan Gotong royong', 'storage/kegiatanRT/2.jpg', 2, '2021-07-28 06:26:16', '2021-07-28 06:29:37', NULL);
INSERT INTO `kegiatan_rt` VALUES (3, 'Lomba HUT RI 17 Agustus', 'storage/kegiatanRT/3.jpg', 2, '2021-07-28 06:33:24', '2021-07-28 06:33:24', NULL);

-- ----------------------------
-- Table structure for kelurahan
-- ----------------------------
DROP TABLE IF EXISTS `kelurahan`;
CREATE TABLE `kelurahan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelurahan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kecamatan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kelurahan
-- ----------------------------
INSERT INTO `kelurahan` VALUES (1, 'Sungai Nangka', 'Balikpapan Selatan', '2021-07-26 04:00:02', '2021-08-08 07:50:14', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for periode
-- ----------------------------
DROP TABLE IF EXISTS `periode`;
CREATE TABLE `periode`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mulai_vote` date NULL DEFAULT NULL,
  `selesai_vote` date NULL DEFAULT NULL,
  `rukun_tetangga_id` int(11) NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_periode_rukun_tetangga1_idx`(`rukun_tetangga_id`) USING BTREE,
  CONSTRAINT `fk_periode_rukun_tetangga1` FOREIGN KEY (`rukun_tetangga_id`) REFERENCES `rukun_tetangga` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of periode
-- ----------------------------
INSERT INTO `periode` VALUES (1, '2021-07-27', '2021-08-31', 2, '2021-2022', '2021-07-26 04:07:10', '2021-07-28 06:40:08', NULL);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'super admin', '2021-07-24 13:19:11', '2021-07-24 13:19:14', NULL);
INSERT INTO `roles` VALUES (2, 'penduduk', '2021-07-24 13:19:23', '2021-07-24 13:19:25', NULL);
INSERT INTO `roles` VALUES (3, 'admin RT', '2021-07-24 13:19:34', '2021-07-24 13:19:39', NULL);

-- ----------------------------
-- Table structure for rukun_tetangga
-- ----------------------------
DROP TABLE IF EXISTS `rukun_tetangga`;
CREATE TABLE `rukun_tetangga`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rt` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kelurahan_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_data_rt_kelurahan1_idx`(`kelurahan_id`) USING BTREE,
  CONSTRAINT `fk_data_rt_kelurahan1` FOREIGN KEY (`kelurahan_id`) REFERENCES `kelurahan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rukun_tetangga
-- ----------------------------
INSERT INTO `rukun_tetangga` VALUES (2, '08', 1, '2021-07-26 04:00:28', '2021-07-26 04:00:28', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rukun_tetangga_id` int(11) NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `roles_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_users_rukun_tetangga1_idx`(`rukun_tetangga_id`) USING BTREE,
  INDEX `fk_users_roles1_idx`(`roles_id`) USING BTREE,
  CONSTRAINT `fk_users_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_rukun_tetangga1` FOREIGN KEY (`rukun_tetangga_id`) REFERENCES `rukun_tetangga` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Super Admin', '64730001', NULL, 'admin@gmail.com', NULL, '$2y$10$nV99.pZVSgbz1prlxbgvjOLYbNIpq4XEPBSMNj90He3uEg7W8u4xe', NULL, 1, '2021-07-24 05:21:34', '2021-07-24 05:21:34');
INSERT INTO `users` VALUES (2, 'Gemmy Eldora Kiding', '6471046406990003', 2, 'gemmy@gmail.com', NULL, '$2y$10$oOGV0Ug2e3ZiikPCrkItBOUD6HCr9bVybe83ik6EVIOx3vRIEw3vG', NULL, 3, '2021-07-28 05:52:52', '2021-07-28 05:52:52');
INSERT INTO `users` VALUES (4, 'Tresnawati', '1605205205940001', 2, 'tresna@gmail.com', NULL, '$2y$10$lyAWrN.kUoIC3lSBQjaLH.p41pE1aHxM9RUQA.0fEwWx9uBIe9jrO', NULL, 2, '2021-07-28 05:57:18', '2021-07-28 05:57:18');
INSERT INTO `users` VALUES (5, 'Rudi Hariyanto', '647105220870006', 2, 'rudi@gmail.com', NULL, '$2y$10$SNZOd63fMQ0I80QJl1M2I.E4Bul7bDOdYk8x5UA1zLBQQoU.FA/hu', NULL, 2, '2021-07-28 05:58:29', '2021-07-28 05:58:29');
INSERT INTO `users` VALUES (6, 'Adip Purnomo', '6471041711800006', 2, 'adip@gmail.com', NULL, '$2y$10$hqvQ5Z3frSij16854w10gO8f13.BulPCyZlPs6b1GKb4mYotD7FGu', NULL, 2, '2021-07-28 05:59:22', '2021-07-28 05:59:22');
INSERT INTO `users` VALUES (7, 'Sriyanti', '6471056007810005', 2, 'sriyanti@gmail.com', NULL, '$2y$10$5znmIBYBeLa3UZEk/s4KsOUHzT/Ar/MIBWaeDYfMFUR3GMj3w7u7a', NULL, 2, '2021-07-28 06:00:05', '2021-07-28 06:00:05');
INSERT INTO `users` VALUES (8, 'Sariman', '6474020504580003', 2, 'sariman@gmail.com', NULL, '$2y$10$11gLka./vNQkKxTW.a9vj.oefrhcDmAQUUd.VFA5EDX0EFX3.uGNO', NULL, 2, '2021-07-28 06:00:57', '2021-07-28 06:00:57');
INSERT INTO `users` VALUES (9, 'Hana Kartina', '6474025010680013', 2, 'hana@gmail.com', NULL, '$2y$10$OyAOh7Fij5kcHj8lwAPIiutp.CfqyxDpERBHzgPXcq7SBzeAnhfna', NULL, 2, '2021-07-28 06:02:15', '2021-07-28 06:02:15');
INSERT INTO `users` VALUES (10, 'Suryati', '6471054209640005', 2, 'suryati@gmail.com', NULL, '$2y$10$Sqfx0YeeciU8gTBSbBVEk.ETzMeIxQgju7qJ7e6.I.bNxBtqA8cgy', NULL, 2, '2021-07-28 06:03:08', '2021-07-28 06:03:08');
INSERT INTO `users` VALUES (11, 'Amir', '6471040910720002', 2, 'amir@gmail.com', NULL, '$2y$10$Nckp6WLnkiJjTVZ2nDUbMee0vFrFjRPOO.74PUdEvhPJyUvrUtO7K', NULL, 2, '2021-07-28 06:04:21', '2021-07-28 06:04:21');
INSERT INTO `users` VALUES (12, 'Sulaiman', '6471052708840006', 2, 'sulaiman@gmail.com', NULL, '$2y$10$ru0Lk68XGFVBi6WD9SSsFOaV7ct.X0wdJAtY2IjTvz6fxEwjoHdgC', NULL, 2, '2021-07-28 06:05:39', '2021-07-28 06:05:39');
INSERT INTO `users` VALUES (13, 'Rahma Harasia', '6471054607890004', 2, 'rahma@gmail.com', NULL, '$2y$10$0N1q9pPiLRlcPoO/j5ByreWuIrnECg/9lWxM.vvr8Pz/V8cBYaOoa', NULL, 2, '2021-07-28 06:06:37', '2021-07-28 06:06:37');
INSERT INTO `users` VALUES (14, 'Leni', '6402135612930001', 2, 'leni@gmail.com', NULL, '$2y$10$22ctXbiIaqZeGTc7te9qFOPpRIUjUHHUHGFkqRGSMtTxiTdncXCYa', NULL, 2, '2021-07-28 06:07:42', '2021-07-28 06:07:42');

SET FOREIGN_KEY_CHECKS = 1;
