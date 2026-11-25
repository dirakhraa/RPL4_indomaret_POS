-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2026 at 12:49 PM
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
-- Database: `indomaret_rpl4`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_detail_transaksi`
--

CREATE TABLE `tabel_detail_transaksi` (
  `kode_transaksi` varchar(50) NOT NULL,
  `id_kasir` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `harga` int(10) NOT NULL,
  `kuantitas` int(20) NOT NULL,
  `diskon` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_detail_transaksi`
--

INSERT INTO `tabel_detail_transaksi` (`kode_transaksi`, `id_kasir`, `id_produk`, `harga`, `kuantitas`, `diskon`, `harga_jual`) VALUES
('TIKL-08305472', 5, 2, 7000, 1, 0, 7000),
('TIKL-08305472', 5, 6, 15000, 1, 2000, 13000),
('TIKL-08305472', 5, 14, 10000, 1, 1200, 8800),
('TIKL-08315412', 6, 3, 15000, 1, 0, 15000),
('TIKL-08315412', 6, 4, 500, 1, 500, 0),
('TIKL-11532594', 4, 1, 9000, 2, 1800, 14400),
('TIKL-11532594', 4, 2, 7000, 1, 0, 7000),
('TIKL-12125714', 2, 5, 3500, 1, 0, 3500),
('TIKL-12125714', 2, 6, 15000, 1, 2000, 13000),
('TIKL-12125714', 2, 14, 10000, 1, 1200, 8800),
('TIKL-12261157', 1, 14, 10000, 10, 1200, 88000),
('TIKL-9303608', 3, 1, 9000, 1, 1800, 26500),
('TIKL-9303608', 3, 2, 4100, 1, 0, 26500),
('TIKL-9303608', 3, 3, 15000, 1, 0, 26500),
('TIKL-9303608', 3, 4, 500, 1, 500, 26500),
('TIKL-9303609', 3, 2, 7000, 5, 0, 35000),
('TIKL-9303609', 3, 5, 3500, 1, 0, 3500),
('TIKL-9303609', 3, 8, 3500, 2, 0, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_donasi`
--

CREATE TABLE `tabel_donasi` (
  `id_donasi` int(11) NOT NULL,
  `nama_donasi` varchar(30) NOT NULL,
  `harga_donasi` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_donasi`
--

INSERT INTO `tabel_donasi` (`id_donasi`, `nama_donasi`, `harga_donasi`) VALUES
(1, 'PEDULI ANAK SEHAT', 200),
(2, 'BANTU KORBAN BENCANA', 1000),
(3, 'PEDULI ANAK YATIM', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kasir`
--

CREATE TABLE `tabel_kasir` (
  `id_kasir` int(11) NOT NULL,
  `nama_kasir` varchar(30) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_kasir`
--

INSERT INTO `tabel_kasir` (`id_kasir`, `nama_kasir`, `no_telp`, `alamat`) VALUES
(1, 'AGUNG', '0878687609', 'Jl Pasirkaliki 150, Jawa Barat'),
(2, 'SERGIO', '0897987987', 'Jl Menteng Raya 31, Dki Jakart'),
(3, 'PRICI', '0987987989', 'Jl P Diponegoro 54&104'),
(4, 'RIZKY', '0980980988', 'Kompl Ruko THD B-51'),
(5, 'WANDA', '0987654328', 'Jalan Pulau Madura'),
(6, 'JASMINE', '02983047210', 'Jalan Gajah Mada');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_produk`
--

CREATE TABLE `tabel_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `harga` float NOT NULL,
  `diskon` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_produk`
--

INSERT INTO `tabel_produk` (`id_produk`, `nama_produk`, `harga`, `diskon`) VALUES
(1, 'J/N LEMPER 2\'S', 9000, 1800),
(2, 'PISANG CAVENDISH 1\'S', 7000, 0),
(3, 'YC NASI AYAM KEMANGI', 15000, 0),
(4, 'Y/C SNDOK+GRPU PLSTK', 500, 500),
(5, 'bumbu sasa', 3500, 0),
(6, 'Kentang Mozarela', 15000, 2000),
(7, 'Ajinomoto 10g', 5000, 0),
(8, 'Ajinomoto 5g', 3500, 0),
(14, 'Susu Ultra Milk', 10000, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `table_transaksi`
--

CREATE TABLE `table_transaksi` (
  `kode_transaksi` varchar(50) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `no_order` varchar(7) NOT NULL,
  `total` float NOT NULL,
  `QRIS` float NOT NULL,
  `tunai` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `id_donasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_transaksi`
--

INSERT INTO `table_transaksi` (`kode_transaksi`, `tanggal_transaksi`, `no_order`, `total`, `QRIS`, `tunai`, `kembalian`, `id_donasi`) VALUES
('TIKL-08305472', '2025-11-24 14:25:00', 'A09', 28800, 0, 40000, 11200, 2),
('TIKL-08315412', '2022-10-21 12:30:00', 'A10', 15000, 20000, 0, 5000, 3),
('TIKL-11532594', '2025-11-25 17:34:00', 'A12', 21400, 0, 30000, 8600, 2),
('TIKL-12125714', '2024-04-11 16:54:00', 'A11', 25300, 25300, 0, 0, 1),
('TIKL-12261157', '2020-02-24 12:45:00', 'A07', 88000, 0, 100000, 12000, 3),
('TIKL-9303608', '2025-02-20 22:14:00', 'A07', 26500, 0, 30000, 3500, 1),
('TIKL-9303609', '2025-02-20 23:32:00', 'A08', 45500, 45500, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_detail_transaksi`
--
ALTER TABLE `tabel_detail_transaksi`
  ADD PRIMARY KEY (`kode_transaksi`,`id_produk`),
  ADD KEY `id_kasir` (`id_kasir`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tabel_donasi`
--
ALTER TABLE `tabel_donasi`
  ADD PRIMARY KEY (`id_donasi`);

--
-- Indexes for table `tabel_kasir`
--
ALTER TABLE `tabel_kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indexes for table `tabel_produk`
--
ALTER TABLE `tabel_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `id_donasi` (`id_donasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_donasi`
--
ALTER TABLE `tabel_donasi`
  MODIFY `id_donasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tabel_kasir`
--
ALTER TABLE `tabel_kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tabel_produk`
--
ALTER TABLE `tabel_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabel_detail_transaksi`
--
ALTER TABLE `tabel_detail_transaksi`
  ADD CONSTRAINT `tabel_kasir` FOREIGN KEY (`id_kasir`) REFERENCES `tabel_kasir` (`id_kasir`),
  ADD CONSTRAINT `tabel_produk` FOREIGN KEY (`id_produk`) REFERENCES `tabel_produk` (`id_produk`),
  ADD CONSTRAINT `table_detail_transaksi` FOREIGN KEY (`kode_transaksi`) REFERENCES `table_transaksi` (`kode_transaksi`);

--
-- Constraints for table `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD CONSTRAINT `fk_transaksi_donasi` FOREIGN KEY (`id_donasi`) REFERENCES `tabel_donasi` (`id_donasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
