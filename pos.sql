-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jan 2023 pada 13.13
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

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
-- Struktur dari tabel `dt_penjualan`
--

CREATE TABLE `dt_penjualan` (
  `id_dt_penjualan` int(11) NOT NULL,
  `id_t_penjualan` varchar(255) NOT NULL,
  `id_barang` varchar(255) DEFAULT NULL,
  `qty_penjualan` varchar(255) DEFAULT NULL,
  `total_penjualan` varchar(255) DEFAULT NULL,
  `no_meja` varchar(255) DEFAULT NULL,
  `no_nota` varchar(255) NOT NULL,
  `tgl_transaksi_penjualan` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dt_penjualan`
--

INSERT INTO `dt_penjualan` (`id_dt_penjualan`, `id_t_penjualan`, `id_barang`, `qty_penjualan`, `total_penjualan`, `no_meja`, `no_nota`, `tgl_transaksi_penjualan`, `deleted_at`) VALUES
(1, '1', '1', '3', '15000', NULL, '26.01.001', '2023-01-26', NULL),
(2, '2', '2', '2', '30000', NULL, '26.01.002', '2023-01-26', NULL),
(3, '3', '6', '1', '20000', '1', '26.01.003', '2023-01-26', '2023-01-28 22:59:31'),
(4, '3', '2', '2', '30000', '1', '26.01.003', '2023-01-26', '2023-01-28 22:59:58'),
(5, '4', '6', '4', '80000', NULL, '26.01.004', '2023-01-26', NULL),
(6, '5', '3', '3', '45000', NULL, '26.01.005', '2023-01-26', NULL),
(7, '6', '5', '3', '10000', NULL, '26.01.006', '2023-01-26', NULL),
(8, '7', '5', '4', '20000', NULL, '26.01.007', '2023-01-26', NULL),
(9, '8', '4', '1', '10000', NULL, '26.01.008', '2023-01-26', NULL),
(10, '9', '4', '1', '10000', NULL, '26.01.009', '2023-01-26', NULL),
(11, '10', '6', '3', '60000', NULL, '29.01.001', '2023-01-29', '2023-01-28 23:37:37'),
(12, '11', '5', '5', '20000', NULL, '29.01.002', '2023-01-29', NULL),
(13, '12', '3', '9', '135000', NULL, '29.01.003', '2023-01-29', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2023_01_20_021936_create_t_penjualan_table', 1),
(3, '2023_01_20_022636_add_id_t_penjualan_to_users_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_barang`
--

CREATE TABLE `m_barang` (
  `id_barang` int(255) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `id_rekanan` varchar(255) DEFAULT NULL,
  `harga_barang` varchar(255) DEFAULT NULL,
  `tgl_edit_barang` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_barang`
--

INSERT INTO `m_barang` (`id_barang`, `nama_barang`, `id_rekanan`, `harga_barang`, `tgl_edit_barang`, `deleted_at`) VALUES
(1, 'bakso', '1', '5000', '2023-01-21', NULL),
(2, 'mie', '4', '15000', '2023-01-20', NULL),
(3, 'cuci mobil Sedan', '1', '15000', '2023-01-24', NULL),
(4, 'cuci motor Matic', '1', '10000', '2023-01-24', NULL),
(5, 'cuci mobil elf', '1', '5000', '2023-01-24', NULL),
(6, 'cuci mobil truk', '4', '20000', '2023-01-24', NULL),
(7, 'es', '4', '5000', '2023-01-21', NULL),
(8, 'cuci motor sport', '4', '15000', '2023-01-24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_harga`
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
-- Dumping data untuk tabel `m_harga`
--

INSERT INTO `m_harga` (`id_harga`, `harga_satuan`, `id_barang`, `tgl_edit_harga`, `status_harga`, `id_rekanan`) VALUES
(3, '10000', '1', '2023-01-21', '0', '1'),
(8, '1000', '2', '2023-01-20', '0', '1'),
(9, '15000', '3', '2023-01-24', '0', NULL),
(10, '15000', '3', '2023-01-24', '0', '1'),
(11, '15000', '2', '2023-01-20', '0', NULL),
(12, '15000', '2', '2023-01-20', '1', '1'),
(13, '5000', '1', '2023-01-21', '1', NULL),
(14, '15000', '3', '2023-01-24', '1', NULL),
(15, '10000', '4', '2023-01-24', '1', NULL),
(16, '5000', '5', '2023-01-24', '1', NULL),
(17, '20000', '6', '2023-01-24', '1', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_pelanggan`
--

CREATE TABLE `m_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `alamat_pelanggan` varchar(255) DEFAULT NULL,
  `jumlah_cucian` varchar(255) DEFAULT NULL,
  `no_telepon_pelanggan` varchar(255) DEFAULT NULL,
  `status_pelanggan` varchar(255) DEFAULT NULL,
  `tgl_add_pelanggan` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_pelanggan`
--

INSERT INTO `m_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `jumlah_cucian`, `no_telepon_pelanggan`, `status_pelanggan`, `tgl_add_pelanggan`, `deleted_at`) VALUES
(1, 'dicky', 'lamongan', '2', '12345678', '1', NULL, NULL),
(5, 'ali', 'lamongan', NULL, '8998989110129', '1', NULL, NULL),
(6, 'iuo', 'oui', NULL, '2552', '1', NULL, NULL),
(7, 'timboel', 'graha', NULL, '082139708089', '1', NULL, NULL),
(8, 'ffgf', 'fgd', NULL, '654645', '1', '2023-01-20', '2023-01-28 22:41:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_rekanan`
--

CREATE TABLE `m_rekanan` (
  `id_rekanan` int(11) NOT NULL,
  `nama_rekanan` varchar(255) DEFAULT NULL,
  `alamat_rekanan` varchar(255) DEFAULT NULL,
  `no_telepon_rekanan` varchar(255) DEFAULT NULL,
  `email_rekanan` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_rekanan`
--

INSERT INTO `m_rekanan` (`id_rekanan`, `nama_rekanan`, `alamat_rekanan`, `no_telepon_rekanan`, `email_rekanan`, `deleted_at`) VALUES
(1, 'dimas', 'lamongan', '08123456789', 'dimas@dimas.com', NULL),
(4, 'dicky', 'lamongan', '546546', 'yytyt@frt.com', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_user`
--

CREATE TABLE `m_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `password_user` varchar(255) DEFAULT NULL,
  `level_user` varchar(255) DEFAULT NULL,
  `tgl_edit_user` varchar(255) DEFAULT NULL,
  `status_user` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_user`
--

INSERT INTO `m_user` (`id_user`, `nama_user`, `password_user`, `level_user`, `tgl_edit_user`, `status_user`, `deleted_at`) VALUES
(2, 'dicky', '0192023a7bbd73250516f069df18b500', 'administrator', '2023-01-21', '1', NULL),
(3, 'dimas', '145353cd147486f9635429afdf8b922c', 'kasir', '2023-01-21', '1', NULL),
(4, 'timboel', 'bd1670d992fc1696b47e800a41d38299', 'rekanan', '2023-01-21', '1', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_cuci`
--

CREATE TABLE `t_cuci` (
  `id_cuci` int(11) NOT NULL,
  `id_pelanggan` varchar(255) DEFAULT NULL,
  `tgl_cuci` date DEFAULT NULL,
  `id_barang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_cuci`
--

INSERT INTO `t_cuci` (`id_cuci`, `id_pelanggan`, `tgl_cuci`, `id_barang`) VALUES
(13, '1', '2023-01-19', '2'),
(14, '1', '2023-01-19', '1'),
(16, '7', '2023-01-20', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kas`
--

CREATE TABLE `t_kas` (
  `id_kas` int(255) NOT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `kredit` varchar(255) DEFAULT NULL,
  `tgl_kas` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_rekanan` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_kas`
--

INSERT INTO `t_kas` (`id_kas`, `debit`, `kredit`, `tgl_kas`, `keterangan`, `id_rekanan`, `deleted_at`) VALUES
(1, '0', NULL, '2023-01-21', 'Kas Masuk', NULL, NULL),
(2, '1250', NULL, '2023-01-21', 'Kas Masuk', NULL, NULL),
(3, '1000', NULL, '2023-01-22', 'Kas Masuk', NULL, NULL),
(4, '250', NULL, '2023-01-22', 'Kas Masuk', NULL, NULL),
(5, '8500', NULL, '2023-01-23', 'Kas Masuk', NULL, NULL),
(11, NULL, '2000', '2023-01-23', 'Kas Keluar', '1', NULL),
(12, '7000', NULL, '2023-01-23', 'Kas Masuk', NULL, NULL),
(13, '0', NULL, '2023-01-23', 'Kas Masuk', NULL, NULL),
(14, '4000', NULL, '2023-01-23', 'Tambah', '1', NULL),
(15, NULL, '10000', '2023-01-23', 'Kurangi', '4', NULL),
(17, '0', NULL, '2023-01-29', 'Kas Masuk', NULL, NULL),
(18, '2250', NULL, '2023-01-29', 'Kas Masuk', NULL, NULL),
(19, '1000', NULL, '2023-01-29', 'Kas Masuk', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `id_penjualan` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_meja` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_closing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `t_penjualan`
--

INSERT INTO `t_penjualan` (`id_penjualan`, `id_pelanggan`, `no_nota`, `no_meja`, `status_closing`, `created_at`, `updated_at`) VALUES
(1, '1', '26.01.001', NULL, '1', '2023-01-26 04:27:00', '2023-01-28 23:32:15'),
(2, '1', '26.01.002', NULL, '1', '2023-01-26 04:27:10', '2023-01-28 23:32:15'),
(3, '1', '26.01.003', '1', '0', '2023-01-27 04:27:31', '2023-01-26 04:27:31'),
(4, '1', '26.01.004', NULL, '0', '2023-01-27 04:29:39', '2023-01-28 23:21:35'),
(5, '1', '26.01.005', NULL, '0', '2023-01-27 04:29:55', '2023-01-28 23:21:35'),
(6, '1', '26.01.006', NULL, '0', '2023-01-28 04:31:54', '2023-01-28 23:21:35'),
(7, '1', '26.01.007', NULL, '0', '2023-01-28 05:03:46', '2023-01-28 23:21:35'),
(8, '1', '26.01.008', NULL, '1', '2023-01-29 13:43:35', '2023-01-28 23:32:29'),
(9, '1', '26.01.009', NULL, '1', '2023-01-29 13:43:44', '2023-01-28 23:32:29'),
(10, '1', '29.01.001', NULL, '0', '2023-01-28 23:36:00', '2023-01-28 23:36:00'),
(11, '1', '29.01.002', NULL, '0', '2023-01-28 23:38:21', '2023-01-28 23:38:21'),
(12, '5', '29.01.003', NULL, '0', '2023-01-29 09:31:11', '2023-01-29 09:31:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_penjualan123`
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
-- Dumping data untuk tabel `t_penjualan123`
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
-- Indeks untuk tabel `dt_penjualan`
--
ALTER TABLE `dt_penjualan`
  ADD PRIMARY KEY (`id_dt_penjualan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `m_harga`
--
ALTER TABLE `m_harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indeks untuk tabel `m_pelanggan`
--
ALTER TABLE `m_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `m_rekanan`
--
ALTER TABLE `m_rekanan`
  ADD PRIMARY KEY (`id_rekanan`);

--
-- Indeks untuk tabel `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `t_cuci`
--
ALTER TABLE `t_cuci`
  ADD PRIMARY KEY (`id_cuci`);

--
-- Indeks untuk tabel `t_kas`
--
ALTER TABLE `t_kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indeks untuk tabel `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `t_penjualan123`
--
ALTER TABLE `t_penjualan123`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dt_penjualan`
--
ALTER TABLE `dt_penjualan`
  MODIFY `id_dt_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `id_barang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `m_harga`
--
ALTER TABLE `m_harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `m_pelanggan`
--
ALTER TABLE `m_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `m_rekanan`
--
ALTER TABLE `m_rekanan`
  MODIFY `id_rekanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `t_cuci`
--
ALTER TABLE `t_cuci`
  MODIFY `id_cuci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `t_kas`
--
ALTER TABLE `t_kas`
  MODIFY `id_kas` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `id_penjualan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `t_penjualan123`
--
ALTER TABLE `t_penjualan123`
  MODIFY `id_penjualan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
