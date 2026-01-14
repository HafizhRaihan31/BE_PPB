-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2026 at 03:22 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blangkis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailjual`
--

CREATE TABLE `detailjual` (
  `id` int(11) NOT NULL,
  `jual_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `ongkir` double DEFAULT NULL,
  `bukti` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `harga` double DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`) VALUES
(4, 'Blangkis premium', 'Blangkis premium bro', 200000, 'gambar1.jpeg'),
(5, 'Blangkis anak', 'Blangkis kece untuk anak ', 140000, 'blangkisanak.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `paket` varchar(50) DEFAULT NULL,
  `kota_asal` varchar(100) DEFAULT NULL,
  `kota_tujuan` varchar(100) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `detail` text,
  `bukti` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `user_id`, `total`, `paket`, `kota_asal`, `kota_tujuan`, `tanggal`, `detail`, `bukti`) VALUES
(22, 8, 215000, 'MIDTRANS', 'PURBALINGGA KIDUL, PURBALINGGA, PURBALINGGA, JAWA TENGAH, 53313', 'KALIRANDU, PETARUKAN, PEMALANG, JAWA TENGAH, 52362', '2026-01-12 12:40:10', '{\"Blangkis premium\":1}', 'bukti/bukti_1768221610.png'),
(23, 8, 215000, 'MIDTRANS', 'SUTI SEMARANG, SUTI SEMARANG, BENGKAYANG, KALIMANTAN BARAT, 79283', 'BALUNGBANG JAYA, BOGOR BARAT - KOTA, BOGOR, JAWA BARAT, 16116', '2026-01-12 12:52:54', '{\"Blangkis premium\":1}', 'bukti/bukti_1768222374.png'),
(24, 8, 895000, 'MIDTRANS', 'BALAPULANG KULON, BALAPULANG, TEGAL, JAWA TENGAH, 52464', 'BREBES, BREBES, BREBES, JAWA TENGAH, 52212', '2026-01-12 12:55:52', '{\"Blangkis premium\":3,\"Blangkis anak\":2}', 'bukti/bukti_1768222552.png'),
(25, 9, 215000, 'MIDTRANS', 'SOLO, BOAWAE, NAGEKEO, NUSA TENGGARA TIMUR (NTT), 86462', 'BANGO, DEMAK, DEMAK, JAWA TENGAH, 59517', '2026-01-12 13:09:06', '{\"Blangkis premium\":1}', 'bukti/bukti_1768223346.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firebase_uid` varchar(128) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firebase_uid`, `username`, `password`, `email`, `role`) VALUES
(1, NULL, 'yayan', 'ok', 'yyn@gmail.com', 'admin'),
(7, NULL, 'kaconk', '123', 'kaconk@gmail.com', 'user'),
(8, 'p6o9lAG7rGYjLetirHsm7BebmhF3', 'Yayan ganteng', '123', 'yayanrifan45@gmail.com', 'user'),
(9, 'YGOkOF0leVSUJ4sbByvfp19QXfF2', 'YAYAN RIF\'AN A.', NULL, '111202315067@mhs.dinus.ac.id', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailjual`
--
ALTER TABLE `detailjual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jual_id` (`jual_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailjual`
--
ALTER TABLE `detailjual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jual`
--
ALTER TABLE `jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailjual`
--
ALTER TABLE `detailjual`
  ADD CONSTRAINT `detailjual_ibfk_1` FOREIGN KEY (`jual_id`) REFERENCES `jual` (`id`),
  ADD CONSTRAINT `detailjual_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `jual`
--
ALTER TABLE `jual`
  ADD CONSTRAINT `jual_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
