-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2020 at 03:19 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_order`
--

CREATE TABLE `tbl_detail_order` (
  `no_transaksi` varchar(4) NOT NULL,
  `no_meja` int(2) NOT NULL,
  `username` int(6) NOT NULL,
  `nama_menu` varchar(128) NOT NULL,
  `qty` int(8) NOT NULL,
  `total_harga` int(10) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_detail_order`
--

INSERT INTO `tbl_detail_order` (`no_transaksi`, `no_meja`, `username`, `nama_menu`, `qty`, `total_harga`, `tgl`) VALUES
('0001', 2, 123456, 'Bakso Granat', 3, 51000, '2019-10-11'),
('0001', 2, 123456, '> Mie Putih', 3, 9000, '2019-10-11'),
('0002', 1, 123456, 'Bakso Urat', 3, 45000, '2019-10-11'),
('0002', 1, 123456, 'Bakso Mercon', 4, 68000, '2019-10-11'),
('0003', 1, 123457, 'Bakso Urat', 1, 15000, '2019-11-03'),
('0003', 1, 123457, 'Bakso Telur', 1, 15000, '2019-11-03'),
('0004', 1, 0, 'Sosis', 1, 10000, '2019-11-03'),
('0006', 2, 0, 'Bakso Urat', 2, 30000, '2019-11-03'),
('0007', 1, 0, 'Bakso Urat', 1, 15000, '2019-11-03'),
('0007', 1, 0, 'Bakso Telur', 1, 15000, '2019-11-03'),
('0008', 1, 0, 'Bakso Urat', 1, 15000, '2019-11-03'),
('0008', 1, 0, 'Bakso Telur', 1, 15000, '2019-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL,
  `kode_menu` varchar(4) NOT NULL,
  `nama_menu` varchar(30) NOT NULL,
  `jenis` enum('Makanan','Minuman') NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `kode_menu`, `nama_menu`, `jenis`, `harga`, `stok`, `gambar`) VALUES
(1, 'M001', 'Bakso Urat', 'Makanan', '15000', 0, 'k.jpeg'),
(2, 'M002', 'Es Cappucino', 'Minuman', '4000', 0, 'menu_escappp.jpeg'),
(3, 'M003', 'Bakso Telur', 'Makanan', '15000', 0, 'menu_bstelur.jpeg'),
(4, 'M004', 'Teh Es', 'Minuman', '3000', 0, 'menu_tehes.jpg'),
(5, 'M005', 'Bakso Mercon', 'Makanan', '17000', 0, 'menu_bsmercon.jpg'),
(6, 'M006', 'Es Extra Joss', 'Minuman', '4000', 0, 'menu_esxtrajoss.jpeg'),
(7, 'M007', 'Bakso Granat', 'Makanan', '17000', 0, 'menu_bsgranat.jpg'),
(8, 'M008', 'Es Nutri Sari', 'Minuman', '3000', 0, 'menu_esnutri.jpeg'),
(9, 'M009', 'Kentang Goreng', 'Makanan', '10000', 0, 'menu_kentang.jpg'),
(10, 'M010', 'Extra Joss Susu', 'Minuman', '7000', 0, 'menu_josssusu.jpg'),
(11, 'M011', 'Es Susu', 'Minuman', '4000', 0, 'menu_essusu.jpg'),
(12, 'M012', 'Sosis', 'Makanan', '10000', 0, 'menu_sosis.jpg'),
(13, 'M013', 'Es Tawar', 'Minuman', '1000', 0, 'menu_estwr.jpeg'),
(14, 'M014', 'Es Jeruk Kecil', 'Minuman', '3000', 0, 'menu_esjrkkcl.jpg'),
(15, 'M015', 'Mineral', 'Minuman', '3000', 0, 'menu_mineral.jpeg'),
(16, 'M016', 'Mie Kuning', 'Makanan', '2000', 0, 'menu_miekuning.jpeg'),
(17, 'M017', 'Mie Putih', 'Makanan', '3000', 0, 'menu_mieputih.jpeg'),
(100, 'M018', 'Test', 'Makanan', '30000', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(10) NOT NULL,
  `no_meja` int(2) NOT NULL,
  `username` varchar(6) NOT NULL,
  `harga` int(10) NOT NULL,
  `tgl` date NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id`, `no_transaksi`, `no_meja`, `username`, `harga`, `tgl`, `status`) VALUES
(12, '0001', 2, '123456', 60000, '2019-10-11', 'Lunas'),
(13, '0002', 1, '123456', 113000, '2019-10-11', 'Lunas'),
(14, '0003', 1, '123457', 30000, '2019-11-03', 'Lunas'),
(15, '0004', 1, 'user', 10000, '2019-11-03', 'Lunas'),
(16, '0005', 3, 'user', 0, '2019-11-03', 'Lunas'),
(17, '0006', 2, 'user', 30000, '2019-11-03', 'Lunas'),
(18, '0007', 1, 'admin', 30000, '2019-11-03', 'Lunas'),
(19, '0008', 1, 'admin', 30000, '2019-11-03', 'Lunas'),
(20, '0009', 1, 'admin', 0, '2019-11-05', 'Belum'),
(21, '0010', 1, 'admin', 0, '2019-11-05', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` varchar(5) NOT NULL,
  `username` varchar(6) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `role`) VALUES
('1', 'admin', 'admin', 'admin'),
('2', 'kasir', 'kasir', 'kasir'),
('3', 'test1', '12345', 'pelayan'),
('4', 'test', '12345', 'pelayan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bills`
--

CREATE TABLE `tb_bills` (
  `id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `waktu` time NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `id` int(11) NOT NULL,
  `tipe_pesanan_id` int(11) NOT NULL,
  `kode_meja` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `waktu` time NOT NULL,
  `subtotal` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart_detail`
--

CREATE TABLE `tb_cart_detail` (
  `user_id` int(11) NOT NULL,
  `kode_menu` varchar(4) NOT NULL,
  `nama_menu` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cart_detail`
--

INSERT INTO `tb_cart_detail` (`user_id`, `kode_menu`, `nama_menu`, `qty`, `harga`, `id`) VALUES
(3, 'M001', 'Bakso Urat', 1, 15000, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tb_meja`
--

CREATE TABLE `tb_meja` (
  `kode_meja` int(11) NOT NULL,
  `nama_meja` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_meja`
--

INSERT INTO `tb_meja` (`kode_meja`, `nama_meja`, `status`) VALUES
(1, 'M01', 0),
(2, 'M02', 1),
(3, 'M03', 1),
(4, 'M04', 1),
(5, 'M05', 1),
(6, 'M06', 1),
(7, 'M07', 1),
(8, 'M08', 1),
(9, 'M09', 1),
(10, 'M10', 1),
(11, 'M11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `tipe_pesanan_id` int(11) NOT NULL,
  `kode_meja` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `waktu` time NOT NULL,
  `subtotal` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `order_number`, `paid`, `tipe_pesanan_id`, `kode_meja`, `user_id`, `tgl`, `waktu`, `subtotal`, `tax`, `total`, `deleted`) VALUES
(52, '00001', 0, 2, 0, 4, '2020-01-15', '11:45:25', 19000, 1900, 20900, 0),
(53, '00002', 0, 1, 1, 4, '2020-01-16', '01:30:07', 21000, 2100, 23100, 0),
(54, '00003', 0, 2, 0, 4, '2020-01-16', '03:43:43', 40000, 4000, 44000, 0),
(55, '00004', 0, 2, 0, 4, '2020-01-16', '03:45:03', 17000, 1700, 18700, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_detail`
--

CREATE TABLE `tb_order_detail` (
  `order_number` varchar(50) NOT NULL,
  `kode_menu` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_detail_temp`
--

CREATE TABLE `tb_order_detail_temp` (
  `order_number` varchar(50) NOT NULL,
  `kode_menu` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order_detail_temp`
--

INSERT INTO `tb_order_detail_temp` (`order_number`, `kode_menu`, `qty`, `harga`, `id`) VALUES
('00001', 'M001', 1, 15000, 61),
('00001', 'M002', 1, 4000, 62),
('00002', 'M006', 1, 4000, 64),
('00002', 'M005', 1, 17000, 65),
('00003', 'M007', 1, 17000, 66),
('00003', 'M008', 1, 3000, 67),
('00003', 'M008', 1, 3000, 69),
('00003', 'M007', 1, 17000, 70),
('00004', 'M010', 1, 7000, 72),
('00004', 'M012', 1, 10000, 73);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tipe_pesanan`
--

CREATE TABLE `tb_tipe_pesanan` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tipe_pesanan`
--

INSERT INTO `tb_tipe_pesanan` (`id`, `name`) VALUES
(1, 'dine in'),
(2, 'take away');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bills`
--
ALTER TABLE `tb_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cart_detail`
--
ALTER TABLE `tb_cart_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_meja`
--
ALTER TABLE `tb_meja`
  ADD PRIMARY KEY (`kode_meja`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_order_detail_temp`
--
ALTER TABLE `tb_order_detail_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tipe_pesanan`
--
ALTER TABLE `tb_tipe_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_bills`
--
ALTER TABLE `tb_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_cart_detail`
--
ALTER TABLE `tb_cart_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_order_detail_temp`
--
ALTER TABLE `tb_order_detail_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tb_tipe_pesanan`
--
ALTER TABLE `tb_tipe_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
