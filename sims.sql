-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2024 at 10:16 AM
-- Server version: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sims`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(6) NOT NULL,
  `nama_pengguna` char(20) NOT NULL,
  `password` char(255) NOT NULL,
  `nama_depan` char(50) DEFAULT NULL,
  `nama_belakang` char(50) DEFAULT NULL,
  `nama_lengkap` char(100) NOT NULL,
  `jk` char(1) DEFAULT NULL,
  `tempat_lahir` char(30) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` char(100) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `no_hp` char(20) DEFAULT NULL,
  `peran` int(1) NOT NULL,
  `kunci` char(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token` char(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `password`, `nama_depan`, `nama_belakang`, `nama_lengkap`, `jk`, `tempat_lahir`, `tgl_lahir`, `alamat`, `email`, `no_hp`, `peran`, `kunci`, `updated_at`, `token`) VALUES
(1, 'admin', 'a', NULL, NULL, 'Administrator', NULL, NULL, NULL, NULL, 'admin@smk.sch.id', '0818401886', -1, NULL, NULL, NULL),
(2, '', '$2y$10$gmuUGgcI/m1w1vuEqrDRTeeurrN2D0PhGklbuwAwA0Bo9HeFs8EB2', 'Endang', 'Suhendar', 'Endang Suhendar', NULL, NULL, NULL, NULL, 'ddr@smkn2.sch.id', NULL, 10, NULL, '2024-01-17 07:52:41', 'YkbB6buAozHH8Bms');

-- --------------------------------------------------------

--
-- Table structure for table `staf`
--

CREATE TABLE `staf` (
  `nama` varchar(50) DEFAULT NULL,
  `nuptk` int(11) DEFAULT NULL,
  `jk` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` varchar(50) DEFAULT NULL,
  `nik` int(11) DEFAULT NULL,
  `nip` int(11) DEFAULT NULL,
  `status_kepegawaian` varchar(50) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tugas_tambahan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
