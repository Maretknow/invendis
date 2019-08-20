-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Agu 2019 pada 13.41
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

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
-- Struktur dari tabel `admin`
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
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `foto_admin`, `password_admin`, `username_admin`, `role`) VALUES
(6, 'user', 'marcophoenix.jpg', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'User'),
(8, 'admin', 'sanji.jpg', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat_medis`
--

CREATE TABLE `alat_medis` (
  `id_alat` int(11) NOT NULL,
  `nama_alat` varchar(50) NOT NULL,
  `foto_alat` text NOT NULL,
  `jumlah` int(20) NOT NULL,
  `tanggal_alat_medis` date NOT NULL,
  `id_jenis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alat_medis`
--

INSERT INTO `alat_medis` (`id_alat`, `nama_alat`, `foto_alat`, `jumlah`, `tanggal_alat_medis`, `id_jenis`) VALUES
(7, 'suntikan', 'marcophoenix.jpg', 10, '2019-08-15', 1),
(9, 'tisu', 'ussop.jpg', 5, '2019-08-14', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_alat`
--

CREATE TABLE `detail_alat` (
  `id_detail_alat` int(11) NOT NULL,
  `id_alat` int(11) DEFAULT NULL,
  `id_kondisi` int(11) DEFAULT NULL,
  `jumlah_kondisi` int(11) NOT NULL,
  `tanggal_kondisi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_alat`
--

INSERT INTO `detail_alat` (`id_detail_alat`, `id_alat`, `id_kondisi`, `jumlah_kondisi`, `tanggal_kondisi`) VALUES
(6, 9, 1, 12, '2019-08-17'),
(7, 7, 2, 12, '2019-08-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Metal'),
(2, 'Non Metal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi`
--

CREATE TABLE `kondisi` (
  `id_kondisi` int(11) NOT NULL,
  `nama_kondisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kondisi`
--

INSERT INTO `kondisi` (`id_kondisi`, `nama_kondisi`) VALUES
(1, 'baik'),
(2, 'rusak');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username_admin` (`username_admin`);

--
-- Indeks untuk tabel `alat_medis`
--
ALTER TABLE `alat_medis`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indeks untuk tabel `detail_alat`
--
ALTER TABLE `detail_alat`
  ADD PRIMARY KEY (`id_detail_alat`),
  ADD KEY `id_alat` (`id_alat`),
  ADD KEY `id_kondisi` (`id_kondisi`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `alat_medis`
--
ALTER TABLE `alat_medis`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `detail_alat`
--
ALTER TABLE `detail_alat`
  MODIFY `id_detail_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alat_medis`
--
ALTER TABLE `alat_medis`
  ADD CONSTRAINT `alat_medis_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_alat`
--
ALTER TABLE `detail_alat`
  ADD CONSTRAINT `detail_alat_ibfk_1` FOREIGN KEY (`id_alat`) REFERENCES `alat_medis` (`id_alat`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_alat_ibfk_2` FOREIGN KEY (`id_kondisi`) REFERENCES `kondisi` (`id_kondisi`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
