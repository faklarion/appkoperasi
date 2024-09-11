-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Sep 2024 pada 03.40
-- Versi server: 8.0.30
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appkoperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int NOT NULL,
  `id_user_level` int NOT NULL,
  `id_menu` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(31, 1, 2),
(32, 1, 10),
(33, 1, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 'y'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 'y'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 'y'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 'y'),
(10, 'data pengajuan', 'tbl_pengajuan', 'fa fa-archive', 0, 'y'),
(11, 'data survey', 'tbl_survey', 'fa fa-check', 0, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengajuan`
--

CREATE TABLE `tbl_pengajuan` (
  `id_pengajuan` int NOT NULL,
  `no_pengajuan` varchar(255) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `penghasilan` int NOT NULL,
  `jaminan` varchar(100) NOT NULL,
  `total_pinjaman` int NOT NULL,
  `tenor` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_pengajuan`
--

INSERT INTO `tbl_pengajuan` (`id_pengajuan`, `no_pengajuan`, `nama`, `alamat`, `penghasilan`, `jaminan`, `total_pinjaman`, `tenor`, `status`) VALUES
(1, '010', 'Faisal', 'Jl. Mangga III', 3000000, 'BPKB', 20000000, 5, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_survey`
--

CREATE TABLE `tbl_survey` (
  `id_survey` int NOT NULL,
  `id_pengajuan` int NOT NULL,
  `foto_rumah` text NOT NULL,
  `foto_jaminan` text NOT NULL,
  `tempat_kerja` varchar(200) NOT NULL,
  `catatan` text NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_survey`
--

INSERT INTO `tbl_survey` (`id_survey`, `id_pengajuan`, `foto_rumah`, `foto_jaminan`, `tempat_kerja`, `catatan`, `status`) VALUES
(5, 1, 'Untitled.png', ',1724653169952.jpg,1724653169962.jpg', 'PT Siperindo', 'sss', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(1, 'Nuris Akbar M.Kom', 'admin@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 1, 'y'),
(3, 'Muhammad hafidz Muzaki', 'hafid@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', '7.png', 2, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'Pimpinan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indeks untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tbl_survey`
--
ALTER TABLE `tbl_survey`
  ADD PRIMARY KEY (`id_survey`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeks untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  MODIFY `id_pengajuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_survey`
--
ALTER TABLE `tbl_survey`
  MODIFY `id_survey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
