-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 03:43 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `dt_penjualan`
--

CREATE TABLE `dt_penjualan` (
  `id_dt_penjualan` int(11) NOT NULL,
  `id_t_penjualan` varchar(255) NOT NULL,
  `id_barang` varchar(255) DEFAULT NULL,
  `qty_penjualan` varchar(255) DEFAULT NULL,
  `total_penjualan` varchar(255) DEFAULT NULL,
  `no_meja` varchar(255) DEFAULT NULL,
  `no_nota` varchar(255) NOT NULL,
  `tgl_transaksi_penjualan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dt_penjualan`
--

INSERT INTO `dt_penjualan` (`id_dt_penjualan`, `id_t_penjualan`, `id_barang`, `qty_penjualan`, `total_penjualan`, `no_meja`, `no_nota`, `tgl_transaksi_penjualan`) VALUES
(16, '13', '1', '1', '5000', '1', '01.22.002', '2023-01-22'),
(17, '13', '2', '1', '15000', '1', '01.22.002', '2023-01-22'),
(18, '14', '3', '1', '0', '1', '01.22.002', '2023-01-22'),
(19, '14', '1', '1', '5000', '1', '01.22.002', '2023-01-22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2023_01_20_021936_create_t_penjualan_table', 1),
(3, '2023_01_20_022636_add_id_t_penjualan_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `id_barang` int(255) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `id_rekanan` varchar(255) DEFAULT NULL,
  `harga_barang` varchar(255) DEFAULT NULL,
  `tgl_edit_barang` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`id_barang`, `nama_barang`, `id_rekanan`, `harga_barang`, `tgl_edit_barang`) VALUES
(1, 'bakso', '1', '5000', '2023-01-21'),
(2, 'mie', '1', '15000', '2023-01-20'),
(3, 'cuci mobil', '1', '15000', '2023-01-20'),
(4, 'cuci motor', '1', '10000', '2023-01-20'),
(5, 'cuci elf', '1', '5000', '2023-01-20'),
(6, 'cucui truk', '1', '20000', '2023-01-20'),
(7, 'es', '4', '5000', '2023-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `m_harga`
--

CREATE TABLE `m_harga` (
  `id_harga` int(11) NOT NULL,
  `harga_satuan` varchar(255) DEFAULT NULL,
  `id_barang` varchar(255) DEFAULT NULL,
  `tgl_edit_harga` date DEFAULT NULL,
  `status_harga` varchar(255) DEFAULT NULL,
  `id_rekanan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_harga`
--

INSERT INTO `m_harga` (`id_harga`, `harga_satuan`, `id_barang`, `tgl_edit_harga`, `status_harga`, `id_rekanan`) VALUES
(3, '10000', '1', '2023-01-21', '0', '1'),
(7, '5000', '2', '2023-01-20', '0', '1'),
(8, '1000', '2', '2023-01-20', '0', '1'),
(9, '15000', '3', '2023-01-20', '0', NULL),
(10, '15000', '3', '2023-01-20', '1', '1'),
(11, '15000', '2', '2023-01-20', '0', NULL),
(12, '15000', '2', '2023-01-20', '1', '1'),
(13, '5000', '1', '2023-01-21', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_pelanggan`
--

CREATE TABLE `m_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `alamat_pelanggan` varchar(255) DEFAULT NULL,
  `jumlah_cucian` varchar(255) DEFAULT NULL,
  `no_telepon_pelanggan` varchar(255) DEFAULT NULL,
  `status_pelanggan` varchar(255) DEFAULT NULL,
  `tgl_add_pelanggan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_pelanggan`
--

INSERT INTO `m_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `jumlah_cucian`, `no_telepon_pelanggan`, `status_pelanggan`, `tgl_add_pelanggan`) VALUES
(1, 'dicky', 'lamongan', '2', '12345678', '1', NULL),
(5, 'ali', 'lamongan', NULL, '8998989110129', '1', NULL),
(6, 'iuo', 'oui', NULL, '2552', '1', NULL),
(7, 'timboel', 'graha', NULL, '082139708089', '1', NULL),
(8, 'ffgf', 'fgd', NULL, '654645', '1', '2023-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `m_rekanan`
--

CREATE TABLE `m_rekanan` (
  `id_rekanan` int(11) NOT NULL,
  `nama_rekanan` varchar(255) DEFAULT NULL,
  `alamat_rekanan` varchar(255) DEFAULT NULL,
  `no_telepon_rekanan` varchar(255) DEFAULT NULL,
  `email_rekanan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_rekanan`
--

INSERT INTO `m_rekanan` (`id_rekanan`, `nama_rekanan`, `alamat_rekanan`, `no_telepon_rekanan`, `email_rekanan`) VALUES
(1, 'dimas', 'lamongan', '08123456789', 'dimas@dimas.com'),
(4, 'dicky', 'lamongan', '546546', 'yytyt@frt.com');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `password_user` varchar(255) DEFAULT NULL,
  `level_user` varchar(255) DEFAULT NULL,
  `tgl_edit_user` varchar(255) DEFAULT NULL,
  `status_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id_user`, `nama_user`, `password_user`, `level_user`, `tgl_edit_user`, `status_user`) VALUES
(2, 'dicky', '145353cd147486f9635429afdf8b922c', 'administrator', '2023-01-21', '1'),
(3, 'dimas', '145353cd147486f9635429afdf8b922c', 'kasir', '2023-01-21', '1'),
(4, 'timboel', 'bd1670d992fc1696b47e800a41d38299', 'rekanan', '2023-01-21', '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_cuci`
--

CREATE TABLE `t_cuci` (
  `id_cuci` int(11) NOT NULL,
  `id_pelanggan` varchar(255) DEFAULT NULL,
  `tgl_cuci` date DEFAULT NULL,
  `id_barang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_cuci`
--

INSERT INTO `t_cuci` (`id_cuci`, `id_pelanggan`, `tgl_cuci`, `id_barang`) VALUES
(13, '1', '2023-01-19', '2'),
(14, '1', '2023-01-19', '1'),
(16, '7', '2023-01-20', '3');

-- --------------------------------------------------------

--
-- Table structure for table `t_kas`
--

CREATE TABLE `t_kas` (
  `id_kas` int(255) NOT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `kredit` varchar(255) DEFAULT NULL,
  `tgl_kas` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_rekanan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kas`
--

INSERT INTO `t_kas` (`id_kas`, `debit`, `kredit`, `tgl_kas`, `keterangan`, `id_rekanan`) VALUES
(1, '0', NULL, '2023-01-21', 'Kas Masuk', NULL),
(2, '1250', NULL, '2023-01-21', 'Kas Masuk', NULL),
(3, '1000', NULL, '2023-01-22', 'Kas Masuk', NULL),
(4, '250', NULL, '2023-01-22', 'Kas Masuk', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `id_penjualan` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_closing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`id_penjualan`, `id_pelanggan`, `status_closing`, `created_at`, `updated_at`) VALUES
(13, NULL, '1', '2023-01-22 14:36:43', '2023-01-22 14:36:43'),
(14, '1', '1', '2023-01-22 14:38:43', '2023-01-22 14:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan123`
--

CREATE TABLE `t_penjualan123` (
  `id_penjualan` int(255) NOT NULL,
  `id_barang` varchar(255) DEFAULT NULL,
  `total_penjualan` varchar(255) DEFAULT NULL,
  `qty_penjualan` varchar(255) DEFAULT NULL,
  `tgl_transaksi_penjualan` date DEFAULT NULL,
  `status_closing` varchar(255) DEFAULT '0' COMMENT '0  aktif, 1 close',
  `id_pelanggan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penjualan123`
--

INSERT INTO `t_penjualan123` (`id_penjualan`, `id_barang`, `total_penjualan`, `qty_penjualan`, `tgl_transaksi_penjualan`, `status_closing`, `id_pelanggan`) VALUES
(7, '2', '1000', '1', '2023-01-19', '0', NULL),
(8, '2', '20000', '2', '2023-01-19', '0', NULL),
(9, '2', '2000', '2', '2023-01-19', '0', NULL),
(10, '2', '5000', '5', '2023-01-19', '0', NULL),
(11, '2', '1000', '1', '2023-01-19', '0', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dt_penjualan`
--
ALTER TABLE `dt_penjualan`
  ADD PRIMARY KEY (`id_dt_penjualan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `m_harga`
--
ALTER TABLE `m_harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `m_pelanggan`
--
ALTER TABLE `m_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `m_rekanan`
--
ALTER TABLE `m_rekanan`
  ADD PRIMARY KEY (`id_rekanan`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `t_cuci`
--
ALTER TABLE `t_cuci`
  ADD PRIMARY KEY (`id_cuci`);

--
-- Indexes for table `t_kas`
--
ALTER TABLE `t_kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `t_penjualan123`
--
ALTER TABLE `t_penjualan123`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dt_penjualan`
--
ALTER TABLE `dt_penjualan`
  MODIFY `id_dt_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `id_barang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_harga`
--
ALTER TABLE `m_harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `m_pelanggan`
--
ALTER TABLE `m_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_rekanan`
--
ALTER TABLE `m_rekanan`
  MODIFY `id_rekanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_cuci`
--
ALTER TABLE `t_cuci`
  MODIFY `id_cuci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t_kas`
--
ALTER TABLE `t_kas`
  MODIFY `id_kas` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `id_penjualan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_penjualan123`
--
ALTER TABLE `t_penjualan123`
  MODIFY `id_penjualan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
