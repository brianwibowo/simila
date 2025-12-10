-- -------------------------------------------------------------
-- TablePlus 6.7.8(650)
--
-- https://tableplus.com/
--
-- Database: simila
-- Generation Time: 2025-12-11 00:11:31.7170
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `anggota_risets`;
CREATE TABLE `anggota_risets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_risets` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anggota_risets_id_risets_foreign` (`id_risets`),
  KEY `anggota_risets_user_id_foreign` (`user_id`),
  CONSTRAINT `anggota_risets_id_risets_foreign` FOREIGN KEY (`id_risets`) REFERENCES `risets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `anggota_risets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `beasiswa_batches`;
CREATE TABLE `beasiswa_batches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('open','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `perusahaan_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beasiswa_batches_perusahaan_id_foreign` (`perusahaan_id`),
  CONSTRAINT `beasiswa_batches_perusahaan_id_foreign` FOREIGN KEY (`perusahaan_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `beasiswas`;
CREATE TABLE `beasiswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nama_siswa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `raport` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_rekomendasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_motivasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `portofolio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('lolos','tidak lolos','proses') COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `direkomendasikan` tinyint(1) NOT NULL DEFAULT '0',
  `catatan_rekomendasi` text COLLATE utf8mb4_unicode_ci,
  `tanggal_rekomendasi` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beasiswas_batch_id_foreign` (`batch_id`),
  KEY `beasiswas_user_id_foreign` (`user_id`),
  CONSTRAINT `beasiswas_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `beasiswa_batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `beasiswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `certification_exams`;
CREATE TABLE `certification_exams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_ujian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `kompetensi_terkait` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pembuat_user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `certification_exams_pembuat_user_id_foreign` (`pembuat_user_id`),
  CONSTRAINT `certification_exams_pembuat_user_id_foreign` FOREIGN KEY (`pembuat_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `guru_tamus`;
CREATE TABLE `guru_tamus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keahlian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jadwal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_cv` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_materi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('disetujui','proses') COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_tamus_submitted_by_foreign` (`submitted_by`),
  CONSTRAINT `guru_tamus_submitted_by_foreign` FOREIGN KEY (`submitted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `kurikulums`;
CREATE TABLE `kurikulums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pengirim_id` bigint unsigned NOT NULL,
  `perusahaan_id` bigint unsigned DEFAULT NULL,
  `nama_kurikulum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_kurikulum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ajaran` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar` longtext COLLATE utf8mb4_unicode_ci,
  `validasi_sekolah` enum('disetujui','proses','tidak_disetujui') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validasi_perusahaan` enum('disetujui','proses','tidak_disetujui') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kurikulums_pengirim_id_foreign` (`pengirim_id`),
  KEY `kurikulums_perusahaan_id_foreign` (`perusahaan_id`),
  CONSTRAINT `kurikulums_pengirim_id_foreign` FOREIGN KEY (`pengirim_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kurikulums_perusahaan_id_foreign` FOREIGN KEY (`perusahaan_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `logbook_content`;
CREATE TABLE `logbook_content` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumentasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `logbook_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `logbook_content_logbook_id_foreign` (`logbook_id`),
  CONSTRAINT `logbook_content_logbook_id_foreign` FOREIGN KEY (`logbook_id`) REFERENCES `logbooks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `logbooks`;
CREATE TABLE `logbooks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `pkl_id` bigint unsigned NOT NULL,
  `status` enum('proses','disetujui','revisi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_validasi_pembimbing` enum('belum_validasi','valid','revisi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_validasi',
  `status_validasi_waka_humas` enum('belum_validasi','valid','revisi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_validasi',
  `komentar_pembimbing` text COLLATE utf8mb4_unicode_ci,
  `komentar_waka_humas` text COLLATE utf8mb4_unicode_ci,
  `tanggal_validasi_pembimbing` timestamp NULL DEFAULT NULL,
  `tanggal_validasi_waka_humas` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logbooks_siswa_id_foreign` (`siswa_id`),
  KEY `logbooks_pkl_id_foreign` (`pkl_id`),
  CONSTRAINT `logbooks_pkl_id_foreign` FOREIGN KEY (`pkl_id`) REFERENCES `pkls` (`id`) ON DELETE CASCADE,
  CONSTRAINT `logbooks_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `mooc_modules`;
CREATE TABLE `mooc_modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `module_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_modul` text COLLATE utf8mb4_unicode_ci,
  `link_materi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dokumen_materi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mooc_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mooc_modules_mooc_id_foreign` (`mooc_id`),
  CONSTRAINT `mooc_modules_mooc_id_foreign` FOREIGN KEY (`mooc_id`) REFERENCES `moocs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `mooc_reflection`;
CREATE TABLE `mooc_reflection` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `mooc_id` bigint unsigned NOT NULL,
  `reflection` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mooc_reflection_user_id_foreign` (`user_id`),
  KEY `mooc_reflection_mooc_id_foreign` (`mooc_id`),
  CONSTRAINT `mooc_reflection_mooc_id_foreign` FOREIGN KEY (`mooc_id`) REFERENCES `moocs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mooc_reflection_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `mooc_scores`;
CREATE TABLE `mooc_scores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `mooc_id` bigint unsigned NOT NULL,
  `score` int DEFAULT NULL,
  `file_sertifikat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mooc_scores_user_id_foreign` (`user_id`),
  KEY `mooc_scores_mooc_id_foreign` (`mooc_id`),
  CONSTRAINT `mooc_scores_mooc_id_foreign` FOREIGN KEY (`mooc_id`) REFERENCES `moocs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mooc_scores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `moocs`;
CREATE TABLE `moocs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul_pelatihan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `moocs_perusahaan_id_foreign` (`perusahaan_id`),
  CONSTRAINT `moocs_perusahaan_id_foreign` FOREIGN KEY (`perusahaan_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `pkls`;
CREATE TABLE `pkls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laporan_akhir` text COLLATE utf8mb4_unicode_ci,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `perusahaan_id` bigint unsigned DEFAULT NULL,
  `pembimbing_id` bigint unsigned DEFAULT NULL,
  `status_pembimbing` enum('disetujui','revisi','proses') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_waka_humas` enum('disetujui','proses','ditolak') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('proses','berjalan','selesai','ditolak') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `admin_representing` bigint unsigned DEFAULT NULL,
  `admin_representing_role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pkls_perusahaan_id_foreign` (`perusahaan_id`),
  KEY `pkls_pembimbing_id_foreign` (`pembimbing_id`),
  KEY `pkls_created_by_foreign` (`created_by`),
  KEY `pkls_admin_representing_foreign` (`admin_representing`),
  CONSTRAINT `pkls_admin_representing_foreign` FOREIGN KEY (`admin_representing`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pkls_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pkls_pembimbing_id_foreign` FOREIGN KEY (`pembimbing_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pkls_perusahaan_id_foreign` FOREIGN KEY (`perusahaan_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `perusahaan_id` bigint unsigned DEFAULT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_brief` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_laporan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_manual_upload` tinyint(1) NOT NULL DEFAULT '0',
  `upload_notes` text COLLATE utf8mb4_unicode_ci,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_perusahaan_id_foreign` (`perusahaan_id`),
  CONSTRAINT `projects_perusahaan_id_foreign` FOREIGN KEY (`perusahaan_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `risets`;
CREATE TABLE `risets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topik` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tim_riset` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_proposal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumentasi` text COLLATE utf8mb4_unicode_ci,
  `status` enum('proses','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `scouting_batches`;
CREATE TABLE `scouting_batches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `batch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('open','close') COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `scouting_batches_perusahaan_id_foreign` (`perusahaan_id`),
  CONSTRAINT `scouting_batches_perusahaan_id_foreign` FOREIGN KEY (`perusahaan_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sertifikasis`;
CREATE TABLE `sertifikasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `lsp_user_id` bigint unsigned DEFAULT NULL,
  `perusahaan_user_id` bigint unsigned DEFAULT NULL,
  `certification_exam_id` bigint unsigned NOT NULL,
  `kompetensi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_persyaratan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int DEFAULT NULL,
  `sertifikat_kelulusan` text COLLATE utf8mb4_unicode_ci,
  `status_pendaftaran_ujian` enum('terdaftar','selesai_ujian','lulus','tidak_lulus') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'terdaftar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sertifikasis_user_id_foreign` (`user_id`),
  KEY `sertifikasis_lsp_user_id_foreign` (`lsp_user_id`),
  KEY `sertifikasis_perusahaan_user_id_foreign` (`perusahaan_user_id`),
  KEY `sertifikasis_certification_exam_id_foreign` (`certification_exam_id`),
  CONSTRAINT `sertifikasis_certification_exam_id_foreign` FOREIGN KEY (`certification_exam_id`) REFERENCES `certification_exams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sertifikasis_lsp_user_id_foreign` FOREIGN KEY (`lsp_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `sertifikasis_perusahaan_user_id_foreign` FOREIGN KEY (`perusahaan_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `sertifikasis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `talent_scoutings`;
CREATE TABLE `talent_scoutings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `file_cv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_ijazah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_pernyataan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_seleksi` enum('lolos','proses','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `batch_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `talent_scoutings_user_id_foreign` (`user_id`),
  KEY `talent_scoutings_batch_id_foreign` (`batch_id`),
  CONSTRAINT `talent_scoutings_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `scouting_batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `talent_scoutings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sekolah_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_guru` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pkl_id` bigint unsigned DEFAULT NULL,
  `pkl_status` enum('disetujui','proses','tidak_disetujui','selesai') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT '0',
  `laporan_pkl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_pkl` int DEFAULT NULL,
  `nilai_mooc` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_pkl_id_foreign` (`pkl_id`),
  CONSTRAINT `users_pkl_id_foreign` FOREIGN KEY (`pkl_id`) REFERENCES `pkls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_06_03_192233_create_scouting_batches', 1),
(6, '2025_06_04_184623_create_kurikulums_table', 1),
(7, '2025_06_04_184711_create_projects_table', 1),
(8, '2025_06_04_184735_create_guru_tamus_table', 1),
(9, '2025_06_04_184757_create_pkls_table', 1),
(10, '2025_06_04_184758_create_logbooks_table', 1),
(11, '2025_06_04_184816_create_talent__scoutings_table', 1),
(12, '2025_06_04_184832_create_moocs_table', 1),
(13, '2025_06_04_184845_create_mooc_evals_table', 1),
(14, '2025_06_04_184907_create_sertifikasis_table', 1),
(15, '2025_06_04_184933_create_kuis_lsps_table', 1),
(16, '2025_06_04_184941_create_risets_table', 1),
(17, '2025_06_04_184945_create_soal_lsps_table', 1),
(18, '2025_06_04_184956_create_anggota_risets_table', 1),
(19, '2025_06_04_185016_create_beasiswas_table', 1),
(20, '2025_06_06_123351_create_permission_tables', 1),
(21, '2025_06_13_105515_add_reference_on_user_pkl_siswa', 1),
(22, '2025_06_17_173706_add_upload_fields_to_projects_table', 1),
(23, '2025_06_19_111225_create_table_logbook_content', 1),
(24, '2025_06_21_031751_add_submitted_by_to_guru_tamus_table', 1),
(25, '2025_06_21_141526_create_mooc_modules_table', 1),
(26, '2025_06_21_155840_create_beasiswa_batches_table', 1),
(27, '2025_06_21_163145_add_batch_id_to_beasiswas_table', 1),
(28, '2025_06_21_174927_add_user_id_to_beasiswas_table', 1),
(29, '2025_06_21_201458_add_rekomendasi_to_beasiswas_table', 1),
(30, '2025_06_22_000000_add_perusahaan_id_to_projects_table', 1),
(31, '2025_06_22_083005_add_sekolah_id_to_users_table', 1),
(32, '2025_06_22_220040_setup_certification_features', 1),
(33, '2025_06_22_234501_add_final_status_to_certification_exams_status', 1),
(34, '2025_06_23_143125_create_mooc_scores_table', 1),
(35, '2025_06_23_165128_create_mooc_reflection', 1),
(36, '2025_06_23_201748_revise_certification_features_schema', 1),
(37, '2025_06_24_000000_add_validation_columns_to_logbooks_table', 1),
(38, '2025_06_24_000000_update_pkl_status_enum_values', 1),
(39, '2025_06_24_103226_add_admin_columns_to_pkls_table', 1),
(40, '2025_06_24_170906_add_is_archived_to_users_table', 1),
(41, '2025_06_24_230419_clean_up_mooc_quiz_and_modules', 1),
(42, '2025_06_24_233018_change_link_materi_to_text_in_mooc_modules_table', 1);

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(4, 'App\\Models\\User', 2),
(5, 'App\\Models\\User', 3),
(5, 'App\\Models\\User', 11),
(6, 'App\\Models\\User', 6),
(7, 'App\\Models\\User', 7),
(8, 'App\\Models\\User', 8),
(9, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 2),
(9, 'App\\Models\\User', 3),
(9, 'App\\Models\\User', 4),
(9, 'App\\Models\\User', 5),
(9, 'App\\Models\\User', 6),
(9, 'App\\Models\\User', 7),
(9, 'App\\Models\\User', 8),
(9, 'App\\Models\\User', 9),
(9, 'App\\Models\\User', 10),
(9, 'App\\Models\\User', 11);

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-12-10 17:09:22', '2025-12-10 17:09:22'),
(2, 'waka_kurikulum', 'web', '2025-12-10 17:09:22', '2025-12-10 17:09:22'),
(3, 'perusahaan', 'web', '2025-12-10 17:09:22', '2025-12-10 17:09:22'),
(4, 'siswa', 'web', '2025-12-10 17:09:22', '2025-12-10 17:09:22'),
(5, 'guru', 'web', '2025-12-10 17:09:22', '2025-12-10 17:09:22'),
(6, 'waka_humas', 'web', '2025-12-10 17:09:22', '2025-12-10 17:09:22'),
(7, 'alumni', 'web', '2025-12-10 17:09:22', '2025-12-10 17:09:22'),
(8, 'lsp', 'web', '2025-12-10 17:09:22', '2025-12-10 17:09:22'),
(9, 'user', 'web', '2025-12-10 17:09:22', '2025-12-10 17:09:22');

INSERT INTO `users` (`id`, `sekolah_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `jenis_guru`, `created_at`, `updated_at`, `pkl_id`, `pkl_status`, `is_archived`, `laporan_pkl`, `nilai_pkl`, `nilai_mooc`) VALUES
(1, NULL, 'admin', 'admin@example.com', NULL, '$2y$10$/W52sypEfvntf164dO3nHuvfdD0Bx8IcnOEtraHe2F71mIIUUh84e', NULL, NULL, '2025-12-10 17:09:22', '2025-12-10 17:09:22', NULL, NULL, 0, NULL, NULL, NULL),
(2, NULL, 'siswa', 'siswa@example.com', NULL, '$2y$10$g5yCS39Pjq/8vNx3BgsuUOWx0EAKBwRswS8Dcnc9An.WBid8Pfsaq', NULL, NULL, '2025-12-10 17:09:22', '2025-12-10 17:09:22', NULL, NULL, 0, NULL, NULL, NULL),
(3, NULL, 'guru', 'guru@example.com', NULL, '$2y$10$QtFcvoQYrqdlUFbqndN4Oe5moZEdYmA6s19906hZohXa3R/3uSquK', NULL, NULL, '2025-12-10 17:09:22', '2025-12-10 17:09:22', NULL, NULL, 0, NULL, NULL, NULL),
(4, NULL, 'perusahaan', 'perusahaan@example.com', NULL, '$2y$10$AfVGnxlF3J8r05bJnCLkz.5kod7pNbkW7EZhFCbx6FlMQh6J4JoY6', NULL, NULL, '2025-12-10 17:09:22', '2025-12-10 17:09:22', NULL, NULL, 0, NULL, NULL, NULL),
(5, NULL, 'waka_kurikulum', 'waka_kurikulum@example.com', NULL, '$2y$10$ZF5JA4EIZ6F00IUSqniXK.BpAZgP2ekp8fE5gviKY3OgtjVLv6ZeK', NULL, NULL, '2025-12-10 17:09:23', '2025-12-10 17:09:23', NULL, NULL, 0, NULL, NULL, NULL),
(6, NULL, 'waka_humas', 'waka_humas@example.com', NULL, '$2y$10$TVB2aghPwdGuC9Jb88g7gOOb0aYym8oujHET7T2uDYmGk10BrgeCG', NULL, NULL, '2025-12-10 17:09:23', '2025-12-10 17:09:23', NULL, NULL, 0, NULL, NULL, NULL),
(7, NULL, 'alumni', 'alumni@example.com', NULL, '$2y$10$J6bFMlQV8.VjmI8a9GoA6uikyv5q3d/9qKsC3Ez6yZH9bDbNkNyCe', NULL, NULL, '2025-12-10 17:09:23', '2025-12-10 17:09:23', NULL, NULL, 0, NULL, NULL, NULL),
(8, NULL, 'lsp', 'lsp@example.com', NULL, '$2y$10$7RvmphEupqwc/5gAAIu3M.db2qiX4QTxORSOHEcKSnxRyjVdYsl86', NULL, NULL, '2025-12-10 17:09:23', '2025-12-10 17:09:23', NULL, NULL, 0, NULL, NULL, NULL),
(9, NULL, 'alifian', 'alifian@example.com', NULL, '$2y$10$Ir3DB1HmH6CeoT8hI3qVgOJLXNKgMmKLzWv3DpQ7Bkv7MhctZaD1.', NULL, NULL, '2025-12-10 17:09:23', '2025-12-10 17:09:23', NULL, NULL, 0, NULL, NULL, NULL),
(10, NULL, 'viantech', 'viantech@example.com', NULL, '$2y$10$ygl99MRG43erhZLmI4HwZudSDGvuvJ8QzYF4n9BSOjSOtWKfYbKBm', NULL, NULL, '2025-12-10 17:09:23', '2025-12-10 17:09:23', NULL, NULL, 0, NULL, NULL, NULL),
(11, NULL, 'guru_produktif', 'produktif@example.com', NULL, '$2y$10$cWUnZasnNVLNAwrlVl8NyOuWiVZqFOVnE42vuyhccVQy97q107KMG', NULL, 'guru-produktif', '2025-12-10 17:09:23', '2025-12-10 17:09:23', NULL, NULL, 0, NULL, NULL, NULL);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;