-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2020 at 09:18 AM
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
  `gambar` varchar(255) NOT NULL,
  `ready` tinyint(1) NOT NULL,
  `sequence` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `kode_menu`, `nama_menu`, `description`, `jenis`, `harga`, `gambar`, `ready`, `sequence`, `deleted`) VALUES
(1, 'M001', 'bakso urat', 'mie kuning & mie putih', 'bakso', '13636', 'menu_bsurat.jpeg', 1, 1, 0),
(2, 'M002', 'Es Cappucino', '---', 'Minuman', '3636', 'menu_escappp.jpeg', 1, 4, 0),
(3, 'M003', 'Bakso Telur', 'mie kuning & mie putih', 'bakso', '13636', 'menu_bstelur.jpeg', 1, 2, 0),
(5, 'M005', 'Bakso Mercon', 'mie kuning & mie putih', 'bakso', '17000', 'menu_bsmercon.jpg', 1, 3, 0),
(6, 'M006', 'Es Extra Joss', '---', 'Minuman', '3636', 'menu_esxtrajoss.jpeg', 1, 4, 0),
(7, 'M007', 'Bakso Granat', '', 'bakso', '17000', 'menu_bsgranat.jpg', 1, 3, 1),
(8, 'M008', 'Es Nutri Sari', '', 'Minuman', '3000', 'menu_esnutri.jpeg', 1, 3, 0),
(9, 'M009', 'Kentang Goreng', '', 'snack', '10000', 'menu_kentang.jpg', 1, 3, 0),
(10, 'M010', 'Extra Joss Susu', '', 'Minuman', '7000', 'menu_josssusu.jpg', 1, 3, 0),
(11, 'M011', 'Es Susu', '', 'Minuman', '4000', 'menu_essusu.jpg', 1, 3, 0),
(12, 'M012', 'Sosis', '', 'snack', '10000', 'menu_sosis.jpg', 1, 3, 0),
(13, 'M013', 'Es Tawar', '', 'Minuman', '1000', 'menu_estwr.jpeg', 1, 3, 0),
(14, 'M014', 'Es Jeruk Kecil', '', 'Minuman', '3000', 'menu_esjrkkcl.jpg', 1, 3, 0),
(15, 'M015', 'Mineral', '---', 'Minuman', '3000', 'menu_mineral.jpeg', 1, 3, 0),
(16, 'M016', 'Mie Kuning', '', 'mie', '2000', 'menu_miekuning.jpeg', 1, 3, 1),
(17, 'M017', 'Mie Putih', '', 'mie', '3000', 'menu_mieputih.jpeg', 1, 3, 1),
(102, 'M018', 'bakso urat', 'mie kuning', 'bakso', '13636', 'menu_bsurat.jpeg', 1, 1, 0),
(113, 'M019', 'asd', '', 'bakso', '14', '2.jpg', 1, 9, 1),
(114, 'M020', 'bakso urat', 'mie putih', 'bakso', '13636', 'menu_bsurat.jpeg', 1, 1, 0),
(115, 'M021', 'bakso telur', 'mie putih', 'bakso', '13636', 'menu_bstelur.jpeg', 1, 2, 0),
(116, 'M022', 'bakso telur', 'mie kuning', 'bakso', '13636', 'menu_bstelur.jpeg', 1, 2, 0);

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
(1, 'mie kuning', 'gram', 15, 0),
(2, 'mie putih', 'gram', 34, 0),
(3, 'nutri sari', 'pcs', 100, 0),
(4, 'bakso kecil', 'pcs', 15, 0),
(5, 'bakso urat', 'pcs', 66, 0),
(7, 'bakso mercon', 'pcs', 100, 0),
(8, 'bakso telur', 'pcs', 50, 0),
(9, 'bakso granat', 'pcs', 1000, 1),
(10, 'cappucino', 'bks', 100, 0),
(11, 'extra joss', 'bks', 50, 0),
(12, 'nutri sari', 'bks', 94, 0),
(13, 'teh es', 'gelas ', 30, 0),
(14, 'es jeruk kecil', 'gelas', 50, 0),
(15, 'es tawar', 'gelas', 27, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bills`
--

CREATE TABLE `tb_bills` (
  `id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `total` int(11) NOT NULL,
  `pay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bills`
--

INSERT INTO `tb_bills` (`id`, `order_number`, `date`, `time`, `total`, `pay`) VALUES
(21, '00006', '2020-03-13', '10:12:59', 37400, 0),
(22, '00007', '2020-03-13', '10:18:19', 20900, 0),
(23, '00008', '2020-03-13', '11:41:42', 13200, 0),
(24, '00009', '2020-03-27', '12:56:32', 3300, 5),
(25, '00010', '2020-03-27', '01:49:47', 33000, 33),
(26, '00011', '2020-03-27', '01:50:48', 4400, 0),
(27, '00012', '2020-03-27', '01:52:12', 4400, 5000),
(28, '00014', '2020-03-31', '01:57:28', 49500, 5),
(29, '00015', '2020-04-09', '08:52:12', 33000, 4),
(30, '000001', '2020-05-14', '07:58:25', 80300, 10),
(31, '000002', '2020-05-15', '01:03:33', 33000, 4),
(32, '000005', '2020-05-15', '01:20:08', 15000, 2),
(33, '000006', '2020-05-15', '02:02:24', 18300, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart_detail`
--

CREATE TABLE `tb_cart_detail` (
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `note` text NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 1, 2, 4),
(4, 1, 4, 3),
(5, 1, 5, 1),
(7, 2, 10, 1),
(8, 3, 1, 5),
(9, 3, 2, 4),
(10, 3, 4, 3),
(11, 3, 8, 1),
(12, 6, 11, 1),
(13, 8, 12, 1),
(14, 102, 1, 10),
(15, 102, 4, 3),
(16, 102, 5, 1),
(17, 114, 2, 8),
(18, 114, 5, 1),
(19, 114, 4, 4),
(20, 15, 15, 1);

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
  `customer_name` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `subtotal` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `order_number`, `order_status`, `order_type_id`, `table_id`, `user_id`, `customer_name`, `date`, `time`, `subtotal`, `tax`, `total`) VALUES
(5, '000001', 'paid', 1, 1, 4, 'Test', '2020-05-14', '03:54:19', 73000, 7300, 80300),
(6, '000002', 'paid', 2, 0, 4, 'Test2', '2020-05-14', '04:07:35', 30000, 3000, 33000),
(7, '000003', 'cancelled', 2, 0, 4, 'Test3', '2020-05-15', '03:29:28', 46000, 4600, 50600),
(8, '000004', 'cancelled', 1, 1, 4, 'Test4', '2020-05-15', '11:25:26', 105000, 10500, 115500),
(9, '000005', 'paid', 1, 1, 4, 'pia', '2020-05-15', '01:19:14', 13636, 1364, 15000),
(10, '000006', 'paid', 1, 1, 4, 'test', '2020-05-15', '01:57:11', 16636, 1664, 18300),
(11, '000007', 'cancelled', 2, 0, 4, 're', '2020-05-15', '02:07:39', 13636, 1364, 15000),
(12, '000008', 'unpaid', 2, 0, 4, '19', '2020-05-19', '01:06:56', 13636, 1364, 15000),
(13, '000009', 'unpaid', 1, 1, 4, '19/05', '2020-05-19', '01:56:38', 30272, 3027, 33299),
(14, '000010', 'unpaid', 2, 0, 4, 'sd', '2020-05-19', '02:15:48', 3000, 300, 3300);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_detail`
--

CREATE TABLE `tb_order_detail` (
  `id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `menu_id` varchar(10) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `note` text NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `cancel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order_detail`
--

INSERT INTO `tb_order_detail` (`id`, `order_number`, `menu_id`, `menu_name`, `note`, `qty`, `price`, `cancel`) VALUES
(14, '000001', '7', 'Bakso Granat', '', 2, 17000, 1),
(15, '000001', '9', 'Kentang Goreng', '', 4, 10000, 0),
(17, '000001', '8', 'Es Nutri Sari', '', 5, 3000, 1),
(18, '000001', '1', 'Bakso Urat', '', 5, 15000, 0),
(19, '000001', '8', 'Es Nutri Sari', '', 4, 3000, 0),
(20, '000002', '1', 'Bakso Urat', '', 4, 15000, 0),
(21, '000002', '3', 'Bakso Telur', '', 3, 15000, 0),
(23, '000002', '2', 'Es Cappucino', '', 1, 4000, 1),
(24, '000002', '6', 'Es Extra Joss', '', 4, 4000, 1),
(25, '000002', '17', 'Mie Putih', '', 1, 3000, 1),
(26, '000002', '17', 'Mie Putih', '', 2, 3000, 1),
(27, '000003', '1', 'Bakso Urat', '', 4, 15000, 1),
(28, '000003', '3', 'Bakso Telur', '', 3, 15000, 1),
(29, '000003', '2', 'Es Cappucino', '', 1, 4000, 1),
(30, '000003', '6', 'Es Extra Joss', '', 5, 4000, 1),
(31, '000003', '8', 'Es Nutri Sari', '', 4, 3000, 1),
(34, '000003', '2', 'Es Cappucino', '', 2, 4000, 1),
(35, '000003', '6', 'Es Extra Joss', '', 4, 4000, 1),
(36, '000003', '102', 'bakso urat', '', 2, 15000, 1),
(37, '000003', '6', 'Es Extra Joss', '', 4, 4000, 0),
(38, '000003', '2', 'Es Cappucino', '', 1, 4000, 1),
(39, '000003', '2', 'Es Cappucino', '', 1, 4000, 1),
(40, '000003', '2', 'Es Cappucino', '', 1, 4000, 1),
(41, '000003', '1', 'Bakso Urat', '', 1, 15000, 0),
(42, '000003', '3', 'Bakso Telur', '', 1, 15000, 0),
(43, '000004', '1', 'Bakso Urat', '', 7, 15000, 0),
(44, '000005', '1', 'bakso urat', '', 1, 13636, 0),
(45, '000006', '102', 'bakso urat', '', 1, 13636, 0),
(46, '000006', '15', 'Mineral', '', 1, 3000, 0),
(48, '000007', '102', 'bakso urat', '', 1, 13636, 0),
(49, '000008', '1', 'bakso urat', 'bykin kuah bang\n', 1, 13636, 0),
(50, '000008', '102', 'bakso urat', 'skuyy', 0, 13636, 0),
(51, '000008', '8', 'Es Nutri Sari', 'lbh manis', 0, 3000, 0),
(52, '000009', '1', 'bakso urat', '2 porsi jumbo', 2, 13636, 0),
(53, '000009', '15', 'Mineral', '', 1, 3000, 0),
(54, '000010', '15', 'Mineral', 'dingin', 1, 3000, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tb_bahan`
--
ALTER TABLE `tb_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_bills`
--
ALTER TABLE `tb_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_cart_detail`
--
ALTER TABLE `tb_cart_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `tb_menu_ingredient`
--
ALTER TABLE `tb_menu_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tb_tipe_pesanan`
--
ALTER TABLE `tb_tipe_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
