-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2026 at 06:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_surat`
--
CREATE DATABASE IF NOT EXISTS `db_surat` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_surat`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `semester` tinyint(1) DEFAULT NULL,
  `nama_kelas` char(2) DEFAULT NULL,
  `jadwal` enum('Pagi','Malam') DEFAULT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `prodi_id`, `semester`, `nama_kelas`, `jadwal`, `nama_dosen`, `created_at`, `updated_at`) VALUES
(37, 1, 1, 'A', 'Malam', 'Dosen Andi', '2025-11-24 03:20:17', '2025-11-25 12:37:01'),
(38, 1, 1, 'B', 'Pagi', 'Dosen Budi', '2025-11-24 03:20:17', '2025-11-24 03:20:17'),
(39, 1, 1, 'C', 'Malam', 'Dosen Sari', '2025-11-24 03:20:17', '2025-11-24 03:20:17'),
(40, 1, 1, 'D', 'Pagi', 'Dosen Rina', '2025-11-24 03:20:17', '2025-11-24 03:20:17'),
(41, 1, 1, 'E', 'Malam', 'Dosen Joko', '2025-11-24 03:20:17', '2025-11-24 03:20:17'),
(42, 1, 1, 'F', 'Pagi', 'Dosen Fitri', '2025-11-24 03:20:17', '2025-11-24 03:20:17'),
(43, 1, 1, 'G', 'Malam', 'Dosen Hendra', '2025-11-24 03:20:17', '2025-11-24 03:20:17'),
(44, 1, 1, 'H', 'Pagi', 'Dosen Lestari', '2025-11-24 03:20:17', '2025-11-24 03:20:17'),
(45, 1, 1, 'I', 'Malam', 'Dosen Putra', '2025-11-24 03:20:17', '2025-11-24 03:20:17'),
(59, 1, 1, 'J', 'Pagi', 'Dosen Joko', '2025-11-30 11:21:40', '2025-11-30 11:21:40'),
(61, 1, 1, 'A', 'Pagi', 'Dosen Kelvin', '2025-11-30 11:25:04', '2025-12-10 04:59:41'),
(62, 1, 3, 'D', 'Pagi', 'Rusyda', '2025-12-08 01:13:25', '2025-12-08 01:13:25'),
(63, 3, 3, 'A', 'Pagi', 'Dosen Mahalini', '2025-12-09 12:22:07', '2025-12-09 12:37:57'),
(64, 6, 1, 'A', 'Pagi', 'Dosen Anonymus', '2025-12-09 12:38:17', '2025-12-09 12:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggaran`
--

CREATE TABLE `tb_pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `jenis_sp` enum('SP 1','SP 2','SP 3') DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pelanggaran`
--

INSERT INTO `tb_pelanggaran` (`id_pelanggaran`, `mahasiswa_id`, `jenis_sp`, `keterangan`, `tanggal`, `updated_at`) VALUES
(17, 12, 'SP 1', 'fsafafasfaf', '2025-12-10 05:11:40', '2025-12-10 05:11:40'),
(18, 12, 'SP 2', 'fsafsafasfas', '2025-12-10 05:14:09', '2025-12-10 05:14:09'),
(19, 10, 'SP 1', 'Data kehadiran alpha melebihi 5%', '2025-12-29 07:47:28', '2025-12-29 07:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `id_prodi` int(11) NOT NULL,
  `kode_prodi` char(5) DEFAULT NULL,
  `nama_prodi` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_prodi`
--

INSERT INTO `tb_prodi` (`id_prodi`, `kode_prodi`, `nama_prodi`, `created_at`, `updated_at`) VALUES
(1, 'IF', 'Teknik Informatika', '2025-11-21 01:07:41', '2025-11-21 01:07:41'),
(2, 'GM', 'Teknik Geomatika', '2025-11-21 01:07:41', '2025-11-21 01:07:41'),
(3, 'TRM', 'Teknik Rekayasa Multimedia', '2025-11-21 01:08:12', '2025-11-21 01:08:12'),
(4, 'AN', 'Animasi', '2025-11-21 01:08:12', '2025-11-21 01:08:12'),
(5, 'TRPL', 'Teknik Rekayasa Perangkat Lunak', '2025-11-21 01:08:49', '2025-11-21 01:08:49'),
(6, 'RKS', 'Rekayasa Keamanan Siber', '2025-11-21 01:08:49', '2025-11-21 01:08:49'),
(7, 'TP', 'Teknik Permainan', '2025-11-21 01:09:18', '2025-11-21 01:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nim` bigint(20) DEFAULT NULL,
  `nik` bigint(20) DEFAULT NULL,
  `nama_user` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `profile` blob DEFAULT NULL,
  `role` enum('Mahasiswa','Staf') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nim`, `nik`, `nama_user`, `email`, `password`, `prodi_id`, `kelas_id`, `profile`, `role`, `created_at`, `updated_at`) VALUES
(3, NULL, 12345678, 'Admin', 'admin@gmail.com', '87654321', NULL, NULL, 0x466f746f204b752e6a7067, 'Staf', '2025-11-24 02:32:34', '2025-12-08 01:16:23'),
(10, 3312501015, NULL, 'Gilang Ramdhan', 'test@gmail.com', '12345678', 1, 38, 0x466f746f204b752e6a7067, 'Mahasiswa', '2025-11-25 12:28:29', '2025-12-10 03:42:16'),
(12, 2025001, NULL, 'Andi Saputra', 'andi.saputra@example.com', 'hash1234', 3, 37, NULL, 'Mahasiswa', '2025-11-30 11:28:53', '2025-12-01 00:20:50'),
(13, 2025002, NULL, 'Budi Hartono', 'budi.hartono@example.com', 'hash123', 1, 38, NULL, 'Mahasiswa', '2025-11-30 11:28:53', '2025-11-30 11:28:53'),
(14, 2025003, NULL, 'Citra Dewi', 'citra.dewi@example.com', 'hash123', 5, 39, NULL, 'Mahasiswa', '2025-11-30 11:28:53', '2025-11-30 11:28:53'),
(15, 2025004, NULL, 'Dian Permata', 'dian.permata@example.com', 'hash123', 7, 40, NULL, 'Mahasiswa', '2025-11-30 11:28:53', '2025-11-30 11:28:53'),
(16, 2025005, NULL, 'Eko Prasetyo', 'eko.prasetyo@example.com', 'hash123', 2, 41, NULL, 'Mahasiswa', '2025-11-30 11:28:53', '2025-11-30 11:28:53'),
(17, 2025006, NULL, 'Fajar Nugroho', 'fajar.nugroho@example.com', 'hash123', 4, 42, NULL, 'Mahasiswa', '2025-11-30 11:28:53', '2025-11-30 11:28:53'),
(18, 2025007, NULL, 'Gita Rahmadani', 'gita.rahmadani@example.com', 'hash123', 6, 43, NULL, 'Mahasiswa', '2025-11-30 11:28:53', '2025-11-30 11:28:53'),
(19, 2025008, NULL, 'Hadi Santoso', 'hadi.santoso@example.com', 'hash123', 1, 44, NULL, 'Mahasiswa', '2025-11-30 11:28:53', '2025-11-30 11:28:53'),
(47, 3312501017, NULL, 'Karen', 'franklinchang0129@gmail.com', NULL, 1, 37, '', 'Mahasiswa', '2025-12-15 03:01:28', '2025-12-15 03:01:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- Indexes for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD UNIQUE KEY `kode_prodi` (`kode_prodi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `prodi_id` (`prodi_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD CONSTRAINT `tb_kelas_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `tb_prodi` (`id_prodi`);

--
-- Constraints for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  ADD CONSTRAINT `tb_pelanggaran_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `tb_prodi` (`id_prodi`),
  ADD CONSTRAINT `tb_user_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `tb_kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
