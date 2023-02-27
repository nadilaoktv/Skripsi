-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Nov 2022 pada 14.02
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cluster`
--

CREATE TABLE `cluster` (
  `id_cluster` int(11) NOT NULL,
  `id_covid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `covid`
--

CREATE TABLE `covid` (
  `id_covid` int(11) NOT NULL,
  `id_marker` int(11) NOT NULL,
  `positif` varchar(100) NOT NULL,
  `sembuh` varchar(100) NOT NULL,
  `meninggal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `covid`
--

INSERT INTO `covid` (`id_covid`, `id_marker`, `positif`, `sembuh`, `meninggal`) VALUES
(11, 1, '55', '53', '2'),
(12, 2, '1', '2', '12'),
(13, 8, '55', '53', '2'),
(14, 4, '55', '53', '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `marker`
--

CREATE TABLE `marker` (
  `id_marker` int(11) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `marker`
--

INSERT INTO `marker` (`id_marker`, `kecamatan`, `latitude`, `longitude`) VALUES
(1, 'Samarinda Utara', '-0.4401314144865473', '117.19442479731482'),
(2, 'Samarinda Ulu', '-0.4840279409668509', '117.12759003811806'),
(3, 'Samarinda Kota', '-0.49605329132571574', '117.15701868520085'),
(4, 'Samarinda Seberang', '-0.5098368018743032', '117.1383200819702'),
(6, 'Sungai Kunjang', '-0.514530673577901', '117.09214596847868'),
(8, 'Loa Janan Ilir', '-0.5756092166366052', '117.11370998384594'),
(9, 'Sungai Pinang', '-0.4599852023029347', '117.18044865709692'),
(10, 'Samarinda Ilir', '-0.4938509015103137', '117.16179631175945'),
(11, 'Sambutan', '-0.5064353224931246', '117.16947793973807'),
(12, 'Palaran', '-0.5794241601232462', '117.19118719641823'),
(13, 'Balikpapan Barat', '-1.2339637775325911', '116.82044755409183'),
(14, 'Balikpapan Selatan', '-1.2433138676589506', '116.89793091176273'),
(15, 'Balikpapan Timur', '-1.2240262449667578', '116.96439648107965'),
(16, 'Balikpapan Utara', '-1.2048222316773507', '116.86200378107954');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'dila', '35862fcf105f1aaa0b4f29ca71b96236');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cluster`
--
ALTER TABLE `cluster`
  ADD PRIMARY KEY (`id_cluster`),
  ADD UNIQUE KEY `id_covid` (`id_covid`);

--
-- Indeks untuk tabel `covid`
--
ALTER TABLE `covid`
  ADD PRIMARY KEY (`id_covid`),
  ADD UNIQUE KEY `id_marker` (`id_marker`);

--
-- Indeks untuk tabel `marker`
--
ALTER TABLE `marker`
  ADD PRIMARY KEY (`id_marker`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cluster`
--
ALTER TABLE `cluster`
  MODIFY `id_cluster` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `covid`
--
ALTER TABLE `covid`
  MODIFY `id_covid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `marker`
--
ALTER TABLE `marker`
  MODIFY `id_marker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
