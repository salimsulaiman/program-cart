-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Okt 2022 pada 07.35
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cart`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `nm_product` varchar(50) NOT NULL,
  `img_product` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `stat` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `id_product`, `nm_product`, `img_product`, `qty`, `weight`, `stat`, `price`) VALUES
(1, 6, 4, 'Logitech K480', 'logitech_k480.png', 5, '4100', 1, 3500000),
(2, 2, 6, 'ROG Zephyrus G14', 'rog_zephyrus_g14.png', 1, '1651', 1, 15000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `nama_produk` text NOT NULL,
  `total_hrg` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `ekspedisi` varchar(25) NOT NULL,
  `estimasi` varchar(25) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `tgl_order` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id_order`, `nama_user`, `nama_produk`, `total_hrg`, `alamat`, `ekspedisi`, `estimasi`, `ongkir`, `tgl_order`) VALUES
(1, 'Salim Sulaiman', 'Logitech K480, ', 3500000, 'Semarang, 50135, Jawa Tengah', 'jne', '1-2', 44000, '2022-07-20 14:10:51'),
(2, 'User', 'ROG Zephyrus G14, ', 15000000, 'Tegal, 52419, Jawa Tengah', 'jne', '3-6', 12000, '2022-10-27 12:29:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `nm_product` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `img_product` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `weight` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `nm_product`, `description`, `img_product`, `price`, `qty`, `weight`) VALUES
(1, 'Mouse Logitech G403', 'Logitech G403 cheap price', 'logitech_g403.png', 500000, 3, '87.5'),
(2, 'Mouse Logitech G102', 'Logitech G102 Best mouse for gaming with cheap many feature', 'logitech_g102.png', 250000, 8, '85'),
(4, 'Logitech K480', 'Best bluetooth keyboard', 'logitech_k480.png', 700000, 4, '820'),
(5, 'Fantech Sonata MH90', 'Best Gaming Headset', 'sonata_mh90.png', 600000, 4, '266'),
(6, 'ROG Zephyrus G14', 'Laptop Gaming 14 Inc', 'rog_zephyrus_g14.png', 15000000, 5, '1651');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 0),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'User', 1),
(6, 'salim75', '261ec66edc9f53c71e3fdba42c7c8a50', 'Salim Sulaiman', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
