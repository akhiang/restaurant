-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2020 at 08:04 AM
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
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL,
  `kode_menu` varchar(4) NOT NULL,
  `nama_menu` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `jenis` enum('bakso','Minuman','mie','snack') NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `gambar` varchar(125) NOT NULL,
  `ready` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `kode_menu`, `nama_menu`, `description`, `jenis`, `harga`, `gambar`, `ready`, `deleted`) VALUES
(1, 'M001', 'Bakso Urat', 'mie kuning & mie putih', 'bakso', '15000', 'k.jpeg', 1, 0),
(2, 'M002', 'Es Cappucino', '', 'Minuman', '4000', 'menu_escappp.jpeg', 1, 0),
(3, 'M003', 'Bakso Telur', 'mie kuning & mie putih', 'bakso', '15000', 'menu_bstelur.jpeg', 1, 0),
(5, 'M005', 'Bakso Mercon', 'mie kuning & mie putih', 'bakso', '17000', 'menu_bsmercon.jpg', 1, 0),
(6, 'M006', 'Es Extra Joss', '', 'Minuman', '4000', 'menu_esxtrajoss.jpeg', 1, 0),
(7, 'M007', 'Bakso Granat', '', 'bakso', '17000', 'menu_bsgranat.jpg', 1, 0),
(8, 'M008', 'Es Nutri Sari', '', 'Minuman', '3000', 'menu_esnutri.jpeg', 1, 0),
(9, 'M009', 'Kentang Goreng', '', 'snack', '10000', 'menu_kentang.jpg', 1, 0),
(10, 'M010', 'Extra Joss Susu', '', 'Minuman', '7000', 'menu_josssusu.jpg', 1, 0),
(11, 'M011', 'Es Susu', '', 'Minuman', '4000', 'menu_essusu.jpg', 1, 0),
(12, 'M012', 'Sosis', '', 'snack', '10000', 'menu_sosis.jpg', 1, 0),
(13, 'M013', 'Es Tawar', '', 'Minuman', '1000', 'menu_estwr.jpeg', 1, 0),
(14, 'M014', 'Es Jeruk Kecil', '', 'Minuman', '3000', 'menu_esjrkkcl.jpg', 1, 0),
(15, 'M015', 'Mineral', '', 'Minuman', '3000', 'menu_mineral.jpeg', 1, 0),
(16, 'M016', 'Mie Kuning', '', 'mie', '2000', 'menu_miekuning.jpeg', 1, 0),
(17, 'M017', 'Mie Putih', '', 'mie', '3000', 'menu_mieputih.jpeg', 1, 0),
(102, 'M018', 'bakso urat', 'mie kuning', 'bakso', '30000', 'k.jpeg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` varchar(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `role`) VALUES
('1', 'admin', 'admin', 'admin'),
('2', 'kasir', 'kasir', 'kasir'),
('3', 'test', '12345', 'pelayan'),
('4', 'qwe', '12345', 'pelayan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bahan`
--

CREATE TABLE `tb_bahan` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bahan`
--

INSERT INTO `tb_bahan` (`id`, `name`, `unit`, `qty`, `deleted`) VALUES
(1, 'mie kuning', 'gram', 100, 0),
(2, 'mie putih', 'gram', 85, 0),
(3, 'nutri sari', 'pcs', 100, 0),
(4, 'bakso kecil', 'pcs', 91, 0),
(5, 'bakso urat', 'pcs', 98, 0),
(7, 'bakso mercon', 'pcs', 100, 0),
(8, 'bakso telur', 'pcs', 99, 0),
(9, 'bakso granat', 'pcs', 1000, 0),
(10, 'cappucino', 'bks', 100, 0),
(11, 'extra joss', 'bks', 1000, 0),
(12, 'nutri sari', 'bks', 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bills`
--

CREATE TABLE `tb_bills` (
  `id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bills`
--

INSERT INTO `tb_bills` (`id`, `order_number`, `date`, `time`, `total`) VALUES
(21, '00006', '2020-03-13', '10:12:59', 37400),
(22, '00007', '2020-03-13', '10:18:19', 20900),
(23, '00008', '2020-03-13', '11:41:42', 13200);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart_detail`
--

CREATE TABLE `tb_cart_detail` (
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cart_detail`
--

INSERT INTO `tb_cart_detail` (`user_id`, `menu_id`, `menu_name`, `qty`, `price`, `id`) VALUES
(3, 3, 'Bakso Telur', 1, 15000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart_detail_modifier`
--

CREATE TABLE `tb_cart_detail_modifier` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` varchar(11) NOT NULL,
  `cart_item_id` int(11) NOT NULL,
  `modifier_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cart_detail_modifier`
--

INSERT INTO `tb_cart_detail_modifier` (`id`, `user_id`, `menu_id`, `cart_item_id`, `modifier_id`, `qty`) VALUES
(17, 4, 'M001', 108, 1, 0),
(18, 4, 'M001', 109, 1, 0),
(19, 4, 'M001', 109, 2, 0);

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
(1, 'M01', 1),
(2, 'M02', 1),
(3, 'M03', 1),
(4, 'M04', 1),
(5, 'M05', 1),
(6, 'M06', 1),
(7, 'M07', 1),
(8, 'M08', 1),
(9, 'M09', 1),
(10, 'M10', 1),
(11, 'M11', 1),
(12, 'M12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu_ingredient`
--

CREATE TABLE `tb_menu_ingredient` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `use_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_menu_ingredient`
--

INSERT INTO `tb_menu_ingredient` (`id`, `menu_id`, `ingredient_id`, `use_qty`) VALUES
(1, 1, 1, 5),
(2, 1, 2, 5),
(4, 1, 4, 3),
(5, 1, 5, 1),
(7, 2, 10, 1),
(8, 3, 1, 5),
(9, 3, 2, 5),
(10, 3, 4, 3),
(11, 3, 8, 1),
(12, 6, 11, 1),
(13, 8, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_modifier`
--

CREATE TABLE `tb_modifier` (
  `id` int(11) NOT NULL,
  `group` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_modifier`
--

INSERT INTO `tb_modifier` (`id`, `group`, `name`, `price`, `stock`) VALUES
(1, 'bakso', 'mie kuning', 0, 0),
(2, 'bakso', 'mie putih', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `order_status` varchar(10) NOT NULL,
  `order_type_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `subtotal` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `order_number`, `order_status`, `order_type_id`, `table_id`, `user_id`, `date`, `time`, `subtotal`, `tax`, `total`) VALUES
(7, '00001', 'cancelled', 2, 0, 4, '2020-03-04', '11:58:34', 15000, 1500, 16500),
(8, '00002', 'cancelled', 1, 1, 4, '2020-03-13', '12:15:07', 19000, 1900, 20900),
(9, '00003', 'cancelled', 1, 1, 4, '2020-03-13', '12:24:54', 19000, 1900, 20900),
(10, '00004', 'cancelled', 1, 11, 4, '2020-03-13', '12:26:35', 19000, 1900, 20900),
(11, '00005', 'cancelled', 1, 10, 4, '2020-03-13', '12:35:04', 23000, 2300, 25300),
(12, '00006', 'paid', 1, 9, 4, '2020-03-13', '12:50:13', 34000, 3400, 37400),
(13, '00007', 'paid', 2, 0, 4, '2020-03-13', '01:03:32', 19000, 1900, 20900),
(14, '00008', 'paid', 2, 0, 4, '2020-03-13', '11:06:21', 12000, 1200, 13200);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_detail`
--

CREATE TABLE `tb_order_detail` (
  `order_number` varchar(50) NOT NULL,
  `menu_id` varchar(10) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order_detail`
--

INSERT INTO `tb_order_detail` (`order_number`, `menu_id`, `menu_name`, `qty`, `price`, `id`) VALUES
('00001', '1', 'Bakso Urat', 1, 15000, 30),
('00002', '1', 'Bakso Urat', 1, 15000, 34),
('00002', '2', 'Es Cappucino', 1, 4000, 35),
('00003', '1', 'Bakso Urat', 1, 15000, 36),
('00003', '2', 'Es Cappucino', 1, 4000, 37),
('00004', '1', 'Bakso Urat', 1, 15000, 39),
('00004', '2', 'Es Cappucino', 1, 4000, 40),
('00005', '1', 'Bakso Urat', 1, 15000, 42),
('00005', '2', 'Es Cappucino', 2, 4000, 43),
('00006', '1', 'Bakso Urat', 2, 15000, 45),
('00006', '2', 'Es Cappucino', 1, 4000, 46),
('00007', '3', 'Bakso Telur', 1, 15000, 48),
('00007', '2', 'Es Cappucino', 1, 4000, 49),
('00008', '6', 'Es Extra Joss', 1, 4000, 50),
('00008', '6', 'Es Extra Joss', 1, 4000, 51),
('00008', '6', 'Es Extra Joss', 1, 4000, 52);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_modifier`
--

CREATE TABLE `tb_order_modifier` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `modifier_id` int(11) NOT NULL,
  `modifier_name` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bahan`
--
ALTER TABLE `tb_bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bills`
--
ALTER TABLE `tb_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cart_detail`
--
ALTER TABLE `tb_cart_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cart_detail_modifier`
--
ALTER TABLE `tb_cart_detail_modifier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_meja`
--
ALTER TABLE `tb_meja`
  ADD PRIMARY KEY (`kode_meja`);

--
-- Indexes for table `tb_menu_ingredient`
--
ALTER TABLE `tb_menu_ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_modifier`
--
ALTER TABLE `tb_modifier`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tb_order_modifier`
--
ALTER TABLE `tb_order_modifier`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tb_bahan`
--
ALTER TABLE `tb_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_bills`
--
ALTER TABLE `tb_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_cart_detail`
--
ALTER TABLE `tb_cart_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_cart_detail_modifier`
--
ALTER TABLE `tb_cart_detail_modifier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_menu_ingredient`
--
ALTER TABLE `tb_menu_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_modifier`
--
ALTER TABLE `tb_modifier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tb_order_modifier`
--
ALTER TABLE `tb_order_modifier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_tipe_pesanan`
--
ALTER TABLE `tb_tipe_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
