-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2020 at 06:47 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

CREATE TABLE `detail_order` (
  `id_order` int(11) NOT NULL,
  `nama_pelanggan` varchar(30) NOT NULL,
  `produk_order` text NOT NULL,
  `qty` varchar(5) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `status` int(2) NOT NULL,
  `tanggal_order` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_order`
--

INSERT INTO `detail_order` (`id_order`, `nama_pelanggan`, `produk_order`, `qty`, `harga`, `status`, `tanggal_order`) VALUES
(2, 'fakhrur razi', 'Jaket', '2', '100000', 0, '2019-12-14 00:00:00'),
(3, 'Fakhrurrazi', 'Kaos Hijau', '1', '85000', 0, '2019-12-02 21:02:24'),
(4, 'test', 'Kaos Biru Donker', '2', '85000', 0, '2019-12-19 22:01:35'),
(6, 'Razi', 'Kaos Hijau', '1', '85000', 0, '2019-12-22 22:27:56'),
(7, 'Razi', 'Kaos Hijau', '1', '85000', 0, '2019-12-22 23:06:21'),
(8, 'Razi', 'Kaos Hijau', '1', '85000', 0, '2019-12-22 23:07:05'),
(9, 'Razi', 'Kaos Hijau', '1', '85000', 0, '2019-12-22 23:12:46'),
(10, 'Fakhrur Razi', 'Kaos Putih', '1', '85000', 0, '2019-12-24 01:47:35'),
(11, 'Fakhrur Razi', 'Kaos Merah Maroon', '1', '85000', 0, '2019-12-24 01:47:35'),
(12, 'Fakhrur Razi', 'Kaos Putih Lengan Panjang', '1', '130000', 0, '2019-12-26 01:07:35'),
(13, 'Fakhrur Razi', 'Kaos Putih Lengan Panjang', '1', '130000', 0, '2019-12-26 01:09:05'),
(14, 'Fakhrur Razi', 'Kaos Hijau', '1', '85000', 0, '2020-01-10 09:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pakaian`
--

CREATE TABLE `jenis_pakaian` (
  `id` int(11) NOT NULL,
  `jenis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_pakaian`
--

INSERT INTO `jenis_pakaian` (`id`, `jenis`) VALUES
(1, 'Kaos'),
(2, 'Hoodie'),
(3, 'CrewNeck'),
(4, 'Ringer'),
(5, 'Polo Shirt'),
(6, 'Raglan');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(10) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `ukuran_produk` varchar(5) NOT NULL,
  `stock_produk` varchar(5) NOT NULL,
  `berat_produk` varchar(5) NOT NULL,
  `ket_produk` varchar(25) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `harga_produk` varchar(10) NOT NULL,
  `notif` varchar(11) NOT NULL,
  `status_notif` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `nama_produk`, `kategori`, `ukuran_produk`, `stock_produk`, `berat_produk`, `ket_produk`, `foto_produk`, `harga_produk`, `notif`, `status_notif`) VALUES
(13, '001', 'Kaos Hijau', 'Kaos', 'L', '10', '1 kg', 'Kaos GNS', '1574086314IMG-20191116-WA0002.jpg', '85000', '0', '1'),
(15, '003', 'Kaos Hitam', 'Kaos', 'L', '10', '1 kg', 'original', '1574087370IMG-20191116-WA0004.jpg', '85000', '0', '1'),
(16, '004', 'Kaos Putih', 'Kaos', 'L', '10', '1 kg', 'original', '1574087447IMG-20191116-WA0005.jpg', '85000', '0', '1'),
(17, '005', 'Kaos Merah Maroon', 'Kaos', 'L', '10', '1 kg', 'original', '1574087514IMG-20191116-WA0006.jpg', '85000', '0', '1'),
(32, '0404', 'Kaos Putih Lengan Panjang', 'Kaos', 'L', '10', '1', 'original', '1577288223IMG-20191118-WA0001.jpg', '130000', '0', '1'),
(34, 'AI-232', 'Kaos Hitam', 'Kaos', 'L', '20', '1.5', 'original', '1577288617IMG-20191118-WA0002.jpg', '150000', '', ''),
(35, '121', 'kaos hitam lengan pendek', 'Kaos', 'L', '10', '1', 'original', '1578624007Kaos_Hitam_Lengan_Pendek.jpg', '100000', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cp`
--

CREATE TABLE `tbl_cp` (
  `id` int(11) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `email` varchar(25) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cp`
--

INSERT INTO `tbl_cp` (`id`, `no_hp`, `email`, `alamat`) VALUES
(1, '085267771585', 'test@gmail.com', 'luar mars');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_spam`
--

CREATE TABLE `tbl_spam` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `cmd` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_spam`
--

INSERT INTO `tbl_spam` (`id`, `user_id`, `cmd`, `datetime`) VALUES
(57, '542393353', '/help', '2020-01-14 12:25:49'),
(58, '542393353', '/kode_produk', '2020-01-14 12:26:00'),
(59, '542393353', '/kode_produk', '2020-01-14 12:26:25'),
(60, '542393353', '/kode_produk', '2020-01-14 12:26:45'),
(61, '542393353', '/help', '2020-01-14 12:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `upload_bukti`
--

CREATE TABLE `upload_bukti` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `bukti` varchar(100) NOT NULL,
  `ket` text NOT NULL,
  `status` int(2) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload_bukti`
--

INSERT INTO `upload_bukti` (`id`, `username`, `bukti`, `ket`, `status`, `datetime`) VALUES
(3, 'vinsmoke95', '1577033894drawing.jpg', 'sudah bayar', 1, '2019-12-22 17:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `id_tele` varchar(30) DEFAULT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_user`, `username`, `password`, `alamat`, `no_hp`, `email`, `id_tele`, `level`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '', 0),
(137, 'Riza', 'riza', '25d55ad283aa400af464c76d713c07ad', 'Lamlagang, Kota Banda Aceh', '0895600214418', 'rizaalfiadi007@gmail.com', NULL, 1),
(139, 'Fakhrur Razi', 'razi', 'cc03e747a6afbbcbf8be7668acfebee5', 'Kota Banda Aceh', '082167772416', 'fakhrurrazi667@gmail.com', '542393353', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `jenis_pakaian`
--
ALTER TABLE `jenis_pakaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `tbl_cp`
--
ALTER TABLE `tbl_cp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_spam`
--
ALTER TABLE `tbl_spam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_bukti`
--
ALTER TABLE `upload_bukti`
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
-- AUTO_INCREMENT for table `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jenis_pakaian`
--
ALTER TABLE `jenis_pakaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_cp`
--
ALTER TABLE `tbl_cp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_spam`
--
ALTER TABLE `tbl_spam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `upload_bukti`
--
ALTER TABLE `upload_bukti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
