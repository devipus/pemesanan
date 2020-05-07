-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 5.7.19 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk pesanan
CREATE DATABASE IF NOT EXISTS `pesanan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pesanan`;

-- membuang struktur untuk table pesanan.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel pesanan.admins: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- membuang struktur untuk table pesanan.karyawans
CREATE TABLE IF NOT EXISTS `karyawans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_unitkerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_kuota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel pesanan.karyawans: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `karyawans` DISABLE KEYS */;
INSERT INTO `karyawans` (`id`, `id_unitkerja`, `kegiatan_id`, `jumlah_kuota`, `created_at`, `updated_at`) VALUES
	(1, '3', '1', '8', '2019-03-27 07:37:03', '2019-03-27 07:37:03'),
	(2, '5', '1', '20', '2019-03-27 07:37:40', '2019-03-27 07:37:40');
/*!40000 ALTER TABLE `karyawans` ENABLE KEYS */;

-- membuang struktur untuk table pesanan.kegiatans
CREATE TABLE IF NOT EXISTS `kegiatans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tglmulai` date NOT NULL,
  `tglselesai` date NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel pesanan.kegiatans: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `kegiatans` DISABLE KEYS */;
INSERT INTO `kegiatans` (`id`, `kegiatan`, `tglmulai`, `tglselesai`, `note`, `created_at`, `updated_at`) VALUES
	(1, 'Turn Around', '2019-03-28', '2019-04-28', 'Tidak ada', '2019-03-27 07:08:44', '2019-03-27 07:08:44');
/*!40000 ALTER TABLE `kegiatans` ENABLE KEYS */;

-- membuang struktur untuk table pesanan.meals
CREATE TABLE IF NOT EXISTS `meals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `kegiatan_id` int(10) unsigned NOT NULL,
  `ns_siang` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tkno_siang` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tamu_siang` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ss_malam` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ns_malam` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tkno_malam` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tamu_malam` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ss_lembur` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ns_lembur` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tkno_lembur` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tamu_lembur` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meals_user_id_foreign` (`user_id`),
  KEY `meals_kegiatan_id_foreign` (`kegiatan_id`),
  CONSTRAINT `meals_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `meals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel pesanan.meals: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `meals` DISABLE KEYS */;
INSERT INTO `meals` (`id`, `tanggal`, `user_id`, `kegiatan_id`, `ns_siang`, `tkno_siang`, `tamu_siang`, `ss_malam`, `ns_malam`, `tkno_malam`, `tamu_malam`, `ss_lembur`, `ns_lembur`, `tkno_lembur`, `tamu_lembur`, `created_at`, `updated_at`) VALUES
	(1, '2019-03-27', 3, 1, '2', '5', '1', '4', '1', '3', '0', '4', '1', '3', '0', '2019-03-27 07:40:28', '2019-03-27 07:40:28'),
	(2, '2019-03-27', 5, 1, '7', '7', '6', '7', '7', '4', '2', '7', '6', '4', '3', '2019-03-27 07:46:10', '2019-03-27 07:46:10');
/*!40000 ALTER TABLE `meals` ENABLE KEYS */;

-- membuang struktur untuk table pesanan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel pesanan.migrations: ~7 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(8, '2014_10_12_000000_create_users_table', 1),
	(9, '2014_10_12_100000_create_password_resets_table', 1),
	(10, '2018_08_09_025352_create_admins_table', 1),
	(11, '2018_08_09_075710_create_kegiatans_table', 1),
	(12, '2018_08_13_021816_create_meals_table', 1),
	(13, '2018_08_15_065702_create_snacks_table', 1),
	(14, '2018_08_16_080033_create_karyawans_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- membuang struktur untuk table pesanan.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel pesanan.password_resets: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- membuang struktur untuk table pesanan.snacks
CREATE TABLE IF NOT EXISTS `snacks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `kegiatan_id` int(10) unsigned NOT NULL,
  `ns_siang` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tkno_siang` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tamu_siang` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ss_malam` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ns_malam` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tkno_malam` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tamu_malam` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `snacks_user_id_foreign` (`user_id`),
  KEY `snacks_kegiatan_id_foreign` (`kegiatan_id`),
  CONSTRAINT `snacks_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `snacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel pesanan.snacks: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `snacks` DISABLE KEYS */;
INSERT INTO `snacks` (`id`, `tanggal`, `user_id`, `kegiatan_id`, `ns_siang`, `tkno_siang`, `tamu_siang`, `ss_malam`, `ns_malam`, `tkno_malam`, `tamu_malam`, `created_at`, `updated_at`) VALUES
	(1, '2019-03-27', 3, 1, '2', '5', '1', '1', '4', '3', '0', '2019-03-27 07:42:42', '2019-03-27 07:42:42'),
	(2, '2019-03-27', 5, 1, '7', '7', '6', '7', '7', '4', '2', '2019-03-27 07:47:17', '2019-03-27 07:47:17');
/*!40000 ALTER TABLE `snacks` ENABLE KEYS */;

-- membuang struktur untuk table pesanan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel pesanan.users: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
	(3, 'TI', 'ti', '$2y$10$SLndD6vjdrUCn4aeJDP/Ne8SxP/4ScZnOPw6aUqqbTikcZ79CvwF2', 0, 'SxXz9gbqaTkvClAISnuOYJTpKQAvtXagtKKXeITixjMZxFpbiDlbAWweeREV', '2019-03-27 07:27:54', '2019-03-27 07:27:54'),
	(5, 'Rendal Pemeliharaan', 'rendalpemel', '$2y$10$6epUNj9nPe9pK1s8lKnNE.uEF299zA2uhZ6kbygIzDhRWAVXtmlXC', 1, 'tQZThkfwxRkMODElDZVe2Gbq51DfF2XsXJO1763e4FL4socj77pNuNcK4Hr6', '2019-03-27 07:33:10', '2019-03-27 07:33:10'),
	(6, 'devi', 'devi', '$2y$10$AusU3C4I327hn6eYBdSyUeII/278OeIKwQy6Hl5OvL0rYErjVLMEq', 0, '8fgMplLyzxXBo71l15QhCk1QLQM6VkpFHgMuvEOpXfFURYz1LCMW6aATkAzc', '2020-02-12 19:38:46', '2020-02-12 19:38:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
