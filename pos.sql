-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2023 at 02:59 PM
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
(1, 'bakso', '1', '10000', '2023-01-18'),
(2, 'mie', '1', '5000', '2023-01-18');

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
(3, '10000', '1', '2023-01-18', '1', '1');

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
  `status_pelanggan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_pelanggan`
--

INSERT INTO `m_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `jumlah_cucian`, `no_telepon_pelanggan`, `status_pelanggan`) VALUES
(1, 'dicky', 'lamongan', '2', '12345678', '1');

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
(1, 'dimas', 'lamongan', '08123456789', 'dimas@dimas.com');

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
(2, 'dicky', 'ganda', 'Admin', '2023-01-18', '1');

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

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `id_penjualan` int(255) NOT NULL,
  `id_barang` varchar(255) DEFAULT NULL,
  `id_pelanggan` varchar(255) DEFAULT NULL,
  `total_penjualan` varchar(255) DEFAULT NULL,
  `qty_penjualan` varchar(255) DEFAULT NULL,
  `tgl_transaksi_penjualan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`id_penjualan`, `id_barang`, `id_pelanggan`, `total_penjualan`, `qty_penjualan`, `tgl_transaksi_penjualan`) VALUES
(1, '1', '1', '10000', '1', '2023-01-18');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `id_barang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_harga`
--
ALTER TABLE `m_harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_pelanggan`
--
ALTER TABLE `m_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_rekanan`
--
ALTER TABLE `m_rekanan`
  MODIFY `id_rekanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_kas`
--
ALTER TABLE `t_kas`
  MODIFY `id_kas` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `id_penjualan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
