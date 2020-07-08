-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2019 at 03:03 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id_akses` int(11) NOT NULL,
  `nama_akses` varchar(25) NOT NULL,
  `deskripsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id_akses`, `nama_akses`, `deskripsi`) VALUES
(1, 'administrator', 'sebagai  pengelola kendali penuh pada sistem aplikasi'),
(2, 'Asisten admin', 'sebagai pengelola sistem stok barang, penjualan dan laporan');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `nama_bank` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `nama_bank`) VALUES
(1, 'MANDIRI'),
(2, 'BNI'),
(3, 'BCA'),
(4, 'BRI'),
(5, 'CIMB Niaga');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `ukuran` varchar(5) NOT NULL,
  `harga` int(20) NOT NULL,
  `foto` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `id_kategori`, `ukuran`, `harga`, `foto`) VALUES
(60, 'corporate putih', 1, ' 1', 130000, '50a05ae4c648ae9f156baa2d2eccbf3d.jpg'),
(61, 'Kemeja Abu', 1, ' 1', 120000, 'ac5e9655751e25e040d62b34da48ca1c.jpg'),
(62, 'maron batik', 13, ' 1', 135000, '8af2182ab96e03ecd51d1a0d3bac8ad2.jpg'),
(63, 'pouch', 18, ' 6', 750000, 'd2c7b9f96c9f4d5be63b71d5b101c2e6.jpg'),
(64, 'net tv maron', 13, ' 1', 130000, 'cb32365e88d8bc26f45c1d20778a66b8.jpg'),
(65, 'hitam polet', 1, ' 1', 125000, 'e42b0852f75a46a76f334ca5aeb2119b.jpg'),
(66, 'lanyard biru', 4, ' 6', 90000, '87f697b2d661bd8e2459881005575df7.jpg'),
(67, 'jaket corporate ', 16, ' 1', 185000, '1efd34720f6cd9ddca2669621d304b2b.jpg'),
(68, 'pink batik', 1, '1', 135000, 'd09855212d1391c91617afd1f69dfe5b.jpg'),
(69, 'kaos agen', 20, ' 1', 65000, '0f5abf1175fb30473a143d3b3fed97f3.jpg'),
(70, 'celana pdh', 14, ' 6', 199000, '09f0aed4d156644951cf74b0e5f3b981.jpg'),
(71, 'brico', 17, ' 6', 99000, 'fdf26e9e34cce566aaf365f36f31d88a.jpg'),
(72, 'jaket biru', 11, ' 3', 90000, '32c1bb22ba2c6c1ac9424d4dc5946266.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `no_trf` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(35) NOT NULL,
  `totalpure` bigint(20) NOT NULL,
  `grand_total` bigint(20) NOT NULL,
  `diskon` int(3) NOT NULL,
  `bayar` bigint(20) NOT NULL,
  `kembalian` bigint(20) NOT NULL,
  `catatan` varchar(50) NOT NULL,
  `tgl_trf` date NOT NULL,
  `jam_trf` time NOT NULL,
  `id_pembayaran` int(2) NOT NULL,
  `no_rek` int(18) DEFAULT NULL,
  `atas_nama` varchar(35) NOT NULL,
  `id_bank` int(2) DEFAULT NULL,
  `operator` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `no_trf`, `nama_pelanggan`, `totalpure`, `grand_total`, `diskon`, `bayar`, `kembalian`, `catatan`, `tgl_trf`, `jam_trf`, `id_pembayaran`, `no_rek`, `atas_nama`, `id_bank`, `operator`) VALUES
(3, 'C20190803001', 'qerqerqwer', 1135000, 1100950, 3, 9000000, 7899050, 'qerqerqer', '2019-08-03', '02:01:12', 1, 0, '', NULL, 'admin'),
(4, 'C20190803003', 'wdsfsdgsfgf', 385000, 377300, 2, 45454545, 45077245, 'twertwetwet', '2019-08-03', '05:42:58', 1, 0, '', 0, 'admin'),
(5, 'C20190804004', 'wewewerwer', 250000, 242500, 3, 34343334, 34100834, 'asdsfasdfasdffa', '2019-08-04', '05:45:16', 1, 0, '', NULL, 'admin'),
(6, 'T20190901005', 'adwqrr', 505000, 489850, 3, 3000000, 2510150, 'asdfasdf', '2019-09-01', '19:38:54', 2, 2147483647, 'qrqerqr', 4, 'admin'),
(7, 'T20190810006', 'ljkjlkj', 1875000, 1762500, 6, 900000000, 898237500, 'hjkhkj', '2019-08-10', '23:55:13', 2, 2147483647, 'GHJHJGH', 3, 'admin'),
(8, 'C20191001007', 'qerqwer', 250000, 247500, 1, 900000, 652500, 'qqrqrqwerqer', '2019-10-01', '19:23:26', 1, 0, '', NULL, 'admin'),
(9, 'T20190813008', 'faklsdfjkaldf', 440000, 435600, 1, 9000000, 8564400, 'alsdjfkalsdjf', '2019-08-13', '17:54:04', 2, 90909090, 'QERPQOER', 2, 'admin'),
(10, 'T20190816009', 'kljkjlkjkj', 250000, 250000, 0, 40000, -210000, 'hghghghgh', '2019-08-16', '18:53:16', 2, 2147483647, 'icih', 3, 'admin'),
(11, 'T20190817010', 'sddasd', 565000, 548050, 3, 9000000, 8451950, 'asdfasdfasdf', '2019-08-17', '10:28:03', 2, 545645456, 'asdfasdfasdf', 3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, ' Kemeja pendek'),
(4, ' Nametag '),
(5, ' Kttp '),
(11, '   Celana pendek '),
(13, ' Kemeja panjang '),
(14, ' Celana panjang '),
(15, ' Rompi '),
(16, 'Jaket'),
(17, 'Topi'),
(18, ' Dompet '),
(20, 'Kaos');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id_operator` int(11) NOT NULL,
  `nama_operator` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_akses` int(3) NOT NULL,
  `last_login` date NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id_operator`, `nama_operator`, `username`, `password`, `id_akses`, `last_login`, `foto`) VALUES
(9, 'Cicih Fitria Ningsih', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2019-08-18', 'avatar3.png'),
(10, 'jeff', 'jeff', '166ee015c0e0934a8781e0c86a197c6e', 1, '0000-00-00', '13005384ce54754b3a763180f2a6c83e.png'),
(13, 'jefri', 'jefri', 'c710857e9b674843afc9b54b7ae2032d', 2, '2019-08-14', 'b0be2fdc90a3b7a0900a81ed8e466af5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_byr` int(2) NOT NULL,
  `metode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_byr`, `metode`) VALUES
(1, 'Cash'),
(2, 'Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_transaksi` int(11) NOT NULL,
  `id_dtlpen` int(5) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `harga_barang` bigint(20) NOT NULL,
  `sub_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_transaksi`, `id_dtlpen`, `id_barang`, `jumlah_stok`, `harga_barang`, `sub_total`) VALUES
(18, 3, 60, 1, 130000, 130000),
(19, 3, 61, 1, 120000, 120000),
(20, 3, 62, 1, 135000, 135000),
(21, 3, 63, 1, 750000, 750000),
(22, 4, 61, 1, 120000, 120000),
(23, 4, 62, 1, 135000, 135000),
(24, 4, 60, 1, 130000, 130000),
(25, 5, 60, 1, 130000, 130000),
(26, 5, 61, 1, 120000, 120000),
(27, 6, 61, 2, 120000, 240000),
(28, 6, 60, 1, 130000, 130000),
(29, 6, 62, 1, 135000, 135000),
(30, 7, 60, 6, 130000, 780000),
(31, 7, 61, 1, 120000, 120000),
(32, 7, 62, 1, 135000, 135000),
(33, 7, 63, 1, 750000, 750000),
(34, 7, 66, 1, 90000, 90000),
(35, 8, 60, 1, 130000, 130000),
(36, 8, 61, 1, 120000, 120000),
(37, 9, 64, 1, 130000, 130000),
(38, 9, 65, 1, 125000, 125000),
(39, 9, 67, 1, 185000, 185000),
(40, 10, 60, 1, 130000, 130000),
(41, 10, 61, 1, 120000, 120000),
(42, 11, 60, 1, 130000, 130000),
(43, 11, 61, 1, 120000, 120000),
(44, 11, 62, 1, 135000, 135000),
(45, 11, 66, 1, 90000, 90000),
(46, 11, 72, 1, 90000, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `stok_barang` int(11) NOT NULL,
  `tanggal_stok` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_barang`, `stok_barang`, `tanggal_stok`) VALUES
(43, 60, 88, '2019-08-17'),
(44, 61, 94, '2019-08-17'),
(45, 62, 95, '2019-08-17'),
(46, 63, 98, '2019-08-10'),
(47, 64, 99, '2019-08-13'),
(48, 65, 99, '2019-08-13'),
(49, 66, 98, '2019-08-17'),
(50, 67, 99, '2019-08-13'),
(51, 68, 100, '2019-08-02'),
(52, 69, 100, '2019-08-02'),
(53, 70, 90, '2019-08-03'),
(54, 71, 100, '2019-08-02'),
(55, 72, 54, '2019-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `id_ukuran` int(11) NOT NULL,
  `nama_ukuran` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`id_ukuran`, `nama_ukuran`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'XXL'),
(6, 'No Size');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id_operator`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_byr`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`id_ukuran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id_operator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_byr` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `id_ukuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
