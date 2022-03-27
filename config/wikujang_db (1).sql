-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 27 Mar 2022 pada 01.56
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wikujang_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `subdistrict_id` int(11) DEFAULT NULL,
  `subdistrict_name` varchar(255) NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  `district_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `email`, `username`, `fullname`, `password`) VALUES
(3, 'udin0141@gmail.com', 'udindb', 'Muhammad Sholehuddin', 'dGVzdDEyMzQ='),
(4, 'udin0142@gmail.com', 'udin', 'Muhammad Sholehuddin', 'dGVzdDEyMzQ=');

-- --------------------------------------------------------

--
-- Struktur dari tabel `district`
--

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL,
  `subdistrict_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `deleted_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `district`
--

INSERT INTO `district` (`district_id`, `subdistrict_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 350803, 'Jarit', '2022-03-18 15:49:43', '2022-03-18 15:49:43', ''),
(10, 350803, 'Jugosari', '2022-03-18 15:49:43', '2022-03-18 15:49:43', ''),
(11, 350803, 'Kloposawit', '2022-03-18 15:49:43', '2022-03-18 15:49:43', ''),
(12, 350803, 'Penanggal', '2022-03-18 15:49:43', '2022-03-18 15:49:43', ''),
(13, 350813, 'Dadapan', '2022-03-18 15:49:43', '2022-03-18 15:49:43', ''),
(14, 350813, 'Gucialit', '2022-03-18 15:49:43', '2022-03-18 15:49:43', ''),
(15, 350813, 'Jeruk', '2022-03-18 15:49:43', '2022-03-18 15:49:43', ''),
(16, 350813, 'Kenongo', '2022-03-18 15:49:43', '2022-03-18 15:49:43', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `file`
--

CREATE TABLE `file` (
  `file_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `file`
--

INSERT INTO `file` (`file_id`, `type`, `file_name`, `created_at`) VALUES
('6234473629fc8', 'profile', '6234473629f33-1647593270.png', '2022-03-18 15:47:50'),
('62352c335ea20', 'profile', '62352c335e97a-1647651891.png', '2022-03-19 08:04:51'),
('62352dc69adcc', 'product', '62352dc69ad5c-1647652294.png', '2022-03-19 08:11:34'),
('62352fbb7d0ad', 'warung', '62352fbb7d03b-1647652795.png', '2022-03-19 08:19:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `product_id` varchar(255) NOT NULL,
  `warung_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `image_id` varchar(255) NOT NULL,
  `rating` float DEFAULT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `discount_amount` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `deleted_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`product_id`, `warung_id`, `name`, `description`, `category`, `price`, `image_id`, `rating`, `discount_percentage`, `discount_amount`, `likes`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
('6235301349680', '623520f75041e', 'Product Mana Lagi 1', 'Test Product Aweeawee', 'food', 5000, '62352dc69adcc', 0, 0, 0, 0, 0, '2022-03-19 08:21:23', '2022-03-19 08:21:23', ''),
('6235302f36190', '623520f75041e', 'Product Mana Lagi 2', 'Test Product Aweeawee', 'food', 5000, '62352dc69adcc', 0, 0, 0, 0, 0, '2022-03-19 08:21:51', '2022-03-19 08:21:51', ''),
('623530322c0d5', '623520f75041e', 'Product Mana Lagi 3', 'Test Product Aweeawee', 'food', 5000, '62352dc69adcc', 0, 0, 0, 0, 0, '2022-03-19 08:21:54', '2022-03-19 08:21:54', ''),
('62353035d8b27', '623520f75041e', 'Product Mana Lagi 4', 'Test Product Aweeawee', 'food', 5000, '62352dc69adcc', 0, 0, 0, 0, 0, '2022-03-19 08:21:57', '2022-03-19 08:21:57', ''),
('6235304ed310a', '623520f75041e', 'Product Mana Lagi 5', 'Test Product Aweeawee', 'food', 5000, '62352dc69adcc', 0, 0, 0, 0, 0, '2022-03-19 08:22:22', '2022-03-19 08:22:22', ''),
('62353052074c4', '623520f75041e', 'Product Mana Lagi 6', 'Test Product Aweeawee', 'food', 5000, '62352dc69adcc', 0, 0, 0, 0, 0, '2022-03-19 08:22:26', '2022-03-19 08:22:26', ''),
('623530579e395', '623520f75041e', 'Product Mana Lagi 7', 'Test Product Aweeawee', 'food', 5000, '62352dc69adcc', 0, 0, 0, 0, 0, '2022-03-19 08:22:31', '2022-03-19 08:22:31', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subdistrict`
--

CREATE TABLE `subdistrict` (
  `subdistrict_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `deleted_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `subdistrict`
--

INSERT INTO `subdistrict` (`subdistrict_id`, `name`, `postal_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(350803, 'Candi Puro', 67373, '2022-03-18 15:49:35', '2022-03-18 15:49:35', ''),
(350813, 'Gucialit', 67353, '2022-03-18 15:49:35', '2022-03-18 15:49:35', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `token`
--

CREATE TABLE `token` (
  `token_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `access_token` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `expired_at` varchar(255) NOT NULL,
  `deleted_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `token`
--

INSERT INTO `token` (`token_id`, `user_id`, `access_token`, `created_at`, `expired_at`, `deleted_at`) VALUES
(49, 72, '8bd8a7eb538c3f9e137ac5f67f985020c9d1f3d375e1dccdbd886c04013531de', '2022-03-18 15:46:02', '2022-03-23 15:46:02', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `image_id` varchar(255) DEFAULT NULL,
  `active` varchar(10) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `deleted_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `username`, `password`, `email`, `phone`, `birthdate`, `gender`, `address_id`, `image_id`, `active`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(72, 'Sholehuddin', 'msudin', 'test1234', '', '085755621692', '1996-06-17', 'L', NULL, '6234473629fc8', 'true', 'warung', '2022-03-18 15:46:02', '2022-03-19 07:16:55', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warung`
--

CREATE TABLE `warung` (
  `warung_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_open` varchar(10) NOT NULL,
  `open_time` varchar(10) NOT NULL,
  `closed_time` varchar(10) NOT NULL,
  `rating` float NOT NULL,
  `image_id` varchar(255) NOT NULL,
  `subdistrict_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `deleted_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `warung`
--

INSERT INTO `warung` (`warung_id`, `user_id`, `name`, `username`, `description`, `is_open`, `open_time`, `closed_time`, `rating`, `image_id`, `subdistrict_id`, `district_id`, `address`, `latitude`, `longitude`, `created_at`, `updated_at`, `deleted_at`) VALUES
('623520f75041e', 72, 'Warung manalagi', 'tokoku', '', 'true', '07.00', '22.00', 0, '6234473629fc8', 0, 0, '', '', '', '2022-03-19 07:16:55', '2022-03-19 07:16:55', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indeks untuk tabel `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeks untuk tabel `subdistrict`
--
ALTER TABLE `subdistrict`
  ADD PRIMARY KEY (`subdistrict_id`);

--
-- Indeks untuk tabel `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `warung`
--
ALTER TABLE `warung`
  ADD PRIMARY KEY (`warung_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `token`
--
ALTER TABLE `token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
