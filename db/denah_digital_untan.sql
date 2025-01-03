-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jan 2025 pada 19.33
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `denah_digital_untan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `ruangan` varchar(10) NOT NULL,
  `luas_ruangan` varchar(20) NOT NULL,
  `kursi_dan_meja` varchar(20) NOT NULL,
  `papan_tulis` varchar(20) NOT NULL,
  `spidol` varchar(20) NOT NULL,
  `penghapus` varchar(20) NOT NULL,
  `lcd` varchar(20) NOT NULL,
  `kipas` varchar(20) NOT NULL,
  `ac` varchar(20) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `virtual_tour` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`ruangan`, `luas_ruangan`, `kursi_dan_meja`, `papan_tulis`, `spidol`, `penghapus`, `lcd`, `kipas`, `ac`, `lokasi`, `virtual_tour`, `id`) VALUES
('D03', '10', '20 ', '1', '3', '1', '1', '4', '0', '-', '-', 1),
('D04', '12', '25 ', '2', '2', '1', '1', '3', '0', '-', '-', 3),
('D05', '14', '30 ', '2', '3', '1', '1', '4', '0', '-', '-', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelaporan`
--

CREATE TABLE `pelaporan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fasilitas_id` int(11) DEFAULT NULL,
  `deskripsi_masalah` text DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `proses` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelaporan`
--

INSERT INTO `pelaporan` (`id`, `user_id`, `fasilitas_id`, `deskripsi_masalah`, `bukti`, `proses`, `created_at`) VALUES
(2, NULL, 1, 'Lcd rusak', '677803172afc5.png', 'selesai', '2025-01-03 22:32:39'),
(3, NULL, 3, 'Kursi kurang satu', '6778038ea95eb.png', 'diproses', '2025-01-03 22:34:38'),
(4, NULL, 4, 'penghapus hilang', '677803d42a1ce.png', '', '2025-01-03 22:35:48'),
(5, NULL, 3, 'Kipas mati', '6778040352acb.png', 'selesai', '2025-01-03 22:36:35'),
(6, NULL, 3, 'Atap bocor', '', '', '2025-01-03 22:37:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `created_at`) VALUES
(1, 'd1041221077@student.untan.ac.id', 'aryoaw', 'Aryo Aji Wibisono', '2025-01-03 18:33:48'),
(2, 'admin', 'admin', 'admin', '2025-01-03 18:33:48');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fasilitas_id` (`fasilitas_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pelaporan`
--
ALTER TABLE `pelaporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD CONSTRAINT `pelaporan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `pelaporan_ibfk_2` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
