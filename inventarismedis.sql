-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2019 at 08:10 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventarismedis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `foto_admin` text NOT NULL,
  `password_admin` text NOT NULL,
  `username_admin` varchar(50) NOT NULL,
  `role` enum('Admin','User','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `foto_admin`, `password_admin`, `username_admin`, `role`) VALUES
(6, 'user', 'marcophoenix.jpg', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'User'),
(8, 'admin', 'sanji.jpg', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Admin'),
(9, 'Indra', 'Screenshot_(4).png ', 'e24f6e3ce19ee0728ff1c443e4ff488d', 'indra', 'User'),
(10, 'dea', 'Screenshot_(6).png', '96991368fec63c8a1bfc48a70010f84a', 'dea', 'Admin'),
(11, 'Putri', 'Screenshot_(10).png', '4093fed663717c843bea100d17fb67c8', 'putri', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `alat_medis`
--

CREATE TABLE `alat_medis` (
  `id_alat` int(11) NOT NULL,
  `nama_alat` varchar(50) NOT NULL,
  `foto_alat` text NOT NULL,
  `jumlah` int(20) NOT NULL,
  `tanggal_alat_medis` date NOT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `id_puskesmas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat_medis`
--

INSERT INTO `alat_medis` (`id_alat`, `nama_alat`, `foto_alat`, `jumlah`, `tanggal_alat_medis`, `id_jenis`, `id_puskesmas`) VALUES
(7, 'suntikan', 'marcophoenix.jpg', 10, '2019-08-15', 1, 1),
(9, 'tisu', 'ussop.jpg', 5, '2019-08-14', 1, 1),
(13, 'Paluindah', '1bln.PNG', 21, '2019-08-05', 2, 1),
(14, 'Panda', 'Screenshot_(7).png', 121, '2019-08-14', 1, 1),
(15, 'Keset', 'Screenshot_(8).png', 12, '2019-08-15', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_alat`
--

CREATE TABLE `detail_alat` (
  `id_detail_alat` int(11) NOT NULL,
  `id_alat` int(11) DEFAULT NULL,
  `id_kondisi` int(11) DEFAULT NULL,
  `jumlah_kondisi` int(11) NOT NULL,
  `tanggal_kondisi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_alat`
--

INSERT INTO `detail_alat` (`id_detail_alat`, `id_alat`, `id_kondisi`, `jumlah_kondisi`, `tanggal_kondisi`) VALUES
(6, 9, 1, 12, '2019-08-17'),
(7, 7, 2, 12, '2019-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Metal'),
(2, 'Non Metal');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi`
--

CREATE TABLE `kondisi` (
  `id_kondisi` int(11) NOT NULL,
  `nama_kondisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kondisi`
--

INSERT INTO `kondisi` (`id_kondisi`, `nama_kondisi`) VALUES
(1, 'baik'),
(2, 'rusak');

-- --------------------------------------------------------

--
-- Table structure for table `puskesmas`
--

CREATE TABLE `puskesmas` (
  `id_puskesmas` int(11) NOT NULL,
  `nama_puskesmas` varchar(255) NOT NULL,
  `keterangan_puskesmas` varchar(255) NOT NULL,
  `alamat_puskesmas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `puskesmas`
--

INSERT INTO `puskesmas` (`id_puskesmas`, `nama_puskesmas`, `keterangan_puskesmas`, `alamat_puskesmas`) VALUES
(1, 'jebres', 'Ini adalah nama puskesmas', 'jalan raya jebres no 25'),
(2, 'Solo Raya', 'we lern wi can do anything', 'Jalan Raya Solo Raya 55'),
(5, 'Kota Surakarta', 'membuat data-data yang berkaitan', 'jalan surakarta no20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username_admin` (`username_admin`);

--
-- Indexes for table `alat_medis`
--
ALTER TABLE `alat_medis`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_puskesmas` (`id_puskesmas`);

--
-- Indexes for table `detail_alat`
--
ALTER TABLE `detail_alat`
  ADD PRIMARY KEY (`id_detail_alat`),
  ADD KEY `id_alat` (`id_alat`),
  ADD KEY `id_kondisi` (`id_kondisi`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indexes for table `puskesmas`
--
ALTER TABLE `puskesmas`
  ADD PRIMARY KEY (`id_puskesmas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `alat_medis`
--
ALTER TABLE `alat_medis`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detail_alat`
--
ALTER TABLE `detail_alat`
  MODIFY `id_detail_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `puskesmas`
--
ALTER TABLE `puskesmas`
  MODIFY `id_puskesmas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat_medis`
--
ALTER TABLE `alat_medis`
  ADD CONSTRAINT `alat_medis_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `alat_medis_ibfk_2` FOREIGN KEY (`id_puskesmas`) REFERENCES `puskesmas` (`id_puskesmas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_alat`
--
ALTER TABLE `detail_alat`
  ADD CONSTRAINT `detail_alat_ibfk_1` FOREIGN KEY (`id_alat`) REFERENCES `alat_medis` (`id_alat`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_alat_ibfk_2` FOREIGN KEY (`id_kondisi`) REFERENCES `kondisi` (`id_kondisi`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
