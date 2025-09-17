-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Sep 2025 pada 11.37
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gns`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1758030909),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1758030909;', 1758030909);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `chatbots`
--

CREATE TABLE `chatbots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `response` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `chatbots`
--

INSERT INTO `chatbots` (`id`, `keywords`, `response`, `created_at`, `updated_at`) VALUES
(1, 'Area, Jangkauan, Kota, Wilayah, Daerah', 'Sementara ini, layanan kami telah menjangkau wilayah Sumatra Utara dan Jawa timur. Untuk informasi lebih lanjut bisa Anda lihat di halaman Produk & Harga paling bawah', '2025-09-15 00:47:24', '2025-09-15 00:47:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Ivan', 'ivan@gmail.com', 'Pasang Perangkat Internet Baru', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque doloremque eum doloribus officiis, eveniet ex minus iure, harum ullam totam odio at repellat! Maiores mollitia, esse quas obcaecati nemo omnis!\r\n\r\n\r\nHormat Saya,\r\n\r\nShandiar Ivan', 0, '2025-09-15 20:43:17', '2025-09-15 20:43:17'),
(2, 'Ifal', 'ifal@gmail.com', 'Pasang Perangkat Baru di Kota Magetan', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque doloremque eum doloribus officiis, eveniet ex minus iure, harum ullam totam odio at repellat! Maiores mollitia, esse quas obcaecati nemo omnis!\r\n\r\nHormat saya,\r\n\r\nKholiliya', 0, '2025-09-15 20:44:38', '2025-09-15 20:44:38'),
(3, 'Lopez', 'amodyalutfi@gmail.com', 'Pasang Perangkat Di Blitar', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque doloremque eum doloribus officiis, eveniet ex minus iure, harum ullam totam odio at repellat! Maiores mollitia, esse quas obcaecati nemo omnis!\r\n\r\nHormat saya,\r\n\r\n\r\nLopez Intermezzo', 0, '2025-09-15 20:46:31', '2025-09-15 20:46:31'),
(4, 'Sutres', 'Sutres@gmail.com', 'Komplain Jaringan', 'Dengan menggunakan ->middleware(\'throttle:1,720\') pada rute Anda, Anda menerapkan aturan:\r\n\r\nSatu alamat IP hanya bisa mengirimkan formulir tersebut satu kali dalam kurun waktu 720 menit (12 jam).\r\n\r\nJika alamat IP yang sama mencoba mengirimkan pesan untuk kedua kalinya sebelum 12 jam berlalu, Laravel akan secara otomatis memblokir permintaan tersebut dan menampilkan halaman error 429 Too Many Requests.\r\n\r\nPoin Penting: IP vs. Perangkat\r\nPenting untuk diingat bahwa pembatasan ini didasarkan pada alamat IP, bukan perangkat (device) itu sendiri.\r\n\r\nSatu Jaringan Wi-Fi, Satu Batas: Jika ada beberapa orang (beberapa perangkat) yang terhubung ke jaringan Wi-Fi yang sama di sebuah rumah atau kantor, mereka semua akan berbagi alamat IP publik yang sama. Artinya, jika satu orang sudah mengirim pesan, orang lain di jaringan yang sama harus menunggu 12 jam.\r\n\r\nGanti Jaringan, Batas Baru: Sebaliknya, jika satu orang mengirim pesan menggunakan Wi-Fi, lalu ia mematikan Wi-Fi dan beralih ke data seluler, ia akan mendapatkan alamat IP yang baru. Dengan IP baru tersebut, ia bisa mengirim pesan lagi tanpa harus menunggu.\r\n\r\nMeskipun begitu, untuk formulir kontak publik, throttling berdasarkan IP adalah metode yang sangat efektif dan standar industri untuk mencegah spam dasar dan pengiriman berulang.\r\n\r\nHormat saya,\r\n\r\n\r\nSutres', 0, '2025-09-15 23:57:38', '2025-09-15 23:57:38'),
(5, 'Alan', 'alan@gmail.com', 'Berhenti Berlanggan', 'Dengan menggunakan ->middleware(\'throttle:1,720\') pada rute Anda, Anda menerapkan aturan:\r\n\r\nSatu alamat IP hanya bisa mengirimkan formulir tersebut satu kali dalam kurun waktu 720 menit (12 jam).\r\n\r\nJika alamat IP yang sama mencoba mengirimkan pesan untuk kedua kalinya sebelum 12 jam berlalu, Laravel akan secara otomatis memblokir permintaan tersebut dan menampilkan halaman error 429 Too Many Requests.\r\n\r\nHormat saya,\r\n\r\n\r\nAlan Walker', 0, '2025-09-16 00:03:40', '2025-09-16 00:03:40'),
(7, 'Ojak', 'ojak@gmail.com', 'Pasang Perangkat Baru', 'Poin Penting: IP vs. Perangkat\r\nPenting untuk diingat bahwa pembatasan ini didasarkan pada alamat IP, bukan perangkat (device) itu sendiri.', 0, '2025-09-16 00:55:09', '2025-09-16 00:55:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_09_031333_create_settings_table', 1),
(5, '2025_09_09_032513_create_promos_table', 1),
(6, '2025_09_10_020132_create_packages_table', 1),
(7, '2025_09_10_040215_add_type_to_packages_table', 1),
(8, '2025_09_10_062804_add_is_published_to_packages_table', 1),
(9, '2025_09_10_080332_create_product_summaries_table', 1),
(10, '2025_09_11_024056_create_posts_table', 1),
(11, '2025_09_11_074620_add_published_at_to_posts_table', 1),
(12, '2025_09_12_035742_create_comments_table', 1),
(13, '2025_09_12_064712_create_messages_table', 1),
(14, '2025_09_15_014209_create_chatbots_table', 1),
(15, '2025_09_08_021332_add_role_to_users_table', 2),
(16, '2025_09_15_072808_add_role_column_to_users_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'gnet',
  `name` varchar(255) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `benefits` text NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `packages`
--

INSERT INTO `packages` (`id`, `type`, `name`, `tagline`, `price`, `benefits`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'martabe', 'Home Internet', 'Untuk Kebutuhan Harian', '250K', 'Streaming & Browsing, Kuota Tanpa Batas,  Sosial Media Lancar', 1, '2025-09-15 00:38:20', '2025-09-15 01:04:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `image1`, `image2`, `image3`, `is_published`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Acara Pertemuan', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam possimus delectus incidunt deleniti maiores temporibus. Excepturi cum ut voluptate illum suscipit! Maiores quia accusantium rerum ab? Facere, mollitia ducimus?,     Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam possimus delectus incidunt deleniti maiores temporibus. Excepturi cum ut voluptate illum suscipit! Maiores quia accusantium rerum ab? Facere, mollitia ducimus?,     Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam possimus delectus incidunt deleniti maiores temporibus. Excepturi cum ut voluptate illum suscipit! Maiores quia accusantium rerum ab? Facere, mollitia ducimus?', 'blog_images/3ijJHeQ26GOMjm4xC8Le9K129RcnCO4hg67B7gWq.jpg', 'blog_images/k2iJIfMLlf4voreIo1HyilNXQiHxtvq5dz1Bk5kv.jpg', 'blog_images/QXOcrHXJ3OZnYOTZP68YOwm5xnl5zwvQHnIIuLDT.jpg', 1, '2025-08-13 17:00:00', '2025-09-15 01:08:02', '2025-09-15 01:08:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_summaries`
--

CREATE TABLE `product_summaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `price_prefix` varchar(255) NOT NULL DEFAULT 'Mulai dari',
  `price` varchar(255) NOT NULL,
  `price_suffix` varchar(255) NOT NULL DEFAULT '/ bulan',
  `features` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_summaries`
--

INSERT INTO `product_summaries` (`id`, `type`, `title`, `tagline`, `price_prefix`, `price`, `price_suffix`, `features`, `created_at`, `updated_at`) VALUES
(1, 'gnet', 'G-NET', 'Koneksi Stabil', 'Mulai dari', '250K', '/ bulan', '100% Fiber Optik\r\nInternet Unlimited Tanpa FUP\r\nInternet Unlimited Tanpa FUP\r\nInternet Unlimited Tanpa FUP', '2025-09-15 00:36:01', '2025-09-15 00:46:17'),
(2, 'martabe', 'Martabe', 'Kecepatan Tinggi', 'Mulai dari', '450K', '/ bulan', '100% Fiber Optik\r\nKecepatan Simetris\r\nKecepatan Simetris\r\nKecepatan Simetris', '2025-09-15 00:36:01', '2025-09-15 00:46:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `promos`
--

CREATE TABLE `promos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `promos`
--

INSERT INTO `promos` (`id`, `image_path`, `description`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'promo_images/E0EGd2nAEtj1h1DEsdDKpVcXa0bgvtio0ngYocXX.jpg', 'Promo Terbaru Bulan Agustus-September', 1, '2025-09-15 00:48:58', '2025-09-15 00:48:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ddaSbxqr8i41j4BOTV5oMj6g5RykmAnyh9nkmIoe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHZpd29OZ0tBNVFzUldVbm9rQ3Iwbkprd1Jtd3NvbTh6dVFPOHFEMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly93ZWJzaXRlLWducy50ZXN0L2NvbnRhY3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758015173),
('U9HLTzDntTvhKzaRBmxEQkrej8SpTPf0Qz2CTbWZ', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQng0TlY1SGNManNWeGlzcTFocDlJMUMwZndkdjFEZ3RUeXQzUFF6MyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjgwOiJodHRwOi8vYWRtaW4tZ25zLnRlc3Qvc3RvcmFnZS9ibG9ncy8zaWpKSGVRMjZHT01qbTR4QzhMZTlLMTI5UmNuQ080aGc2N0I3Z1dxLmpwZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1758009992),
('v7Aep5HDO3xkwbgSxlfcPgGXRSxMAyCyiXQWX2VM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYm42MU1SVnQ3TW9Jc2RqTGFJTkhDU2lOZExZQ1VKYTdORXp2QnVnYSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovL3N1cGVyLWFkbWluLWducy50ZXN0L2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vc3VwZXItYWRtaW4tZ25zLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758005911);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'jumlah_kota', '20', '2025-09-15 00:49:16', '2025-09-15 00:49:16'),
(2, 'jumlah_kelurahan', '150', '2025-09-15 00:49:16', '2025-09-15 00:49:16'),
(3, 'jumlah_pelanggan', '5000', '2025-09-15 00:49:16', '2025-09-15 00:49:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Super Lopez', 'superadmin@gns', NULL, '$2y$12$NrdbOVnLZF43X7B6xnZ/K.zu217nxHvSVeF1tR/cdbxE9Wcf1REi.', NULL, '2025-09-15 00:24:39', '2025-09-15 01:13:24', 'superadmin'),
(2, 'Admin Company', 'admin@gns', NULL, '$2y$12$FcT0MhmKIIIT3luQpKNJiOj9oGz4tw8agcg7cr8ID8jJ698x7l6F2', NULL, '2025-09-15 00:31:21', '2025-09-15 00:31:21', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `chatbots`
--
ALTER TABLE `chatbots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chatbots_keywords_unique` (`keywords`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_summaries`
--
ALTER TABLE `product_summaries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_summaries_type_unique` (`type`);

--
-- Indeks untuk tabel `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `chatbots`
--
ALTER TABLE `chatbots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `product_summaries`
--
ALTER TABLE `product_summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
