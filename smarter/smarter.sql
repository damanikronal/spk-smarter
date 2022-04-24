-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 01. Februari 2014 jam 18:24
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smarter`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE IF NOT EXISTS `hasil` (
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `bobot_hasil` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`username`, `bobot_hasil`) VALUES
('agus', 5.57515),
('lenny', 6.3249),
('kevin', 6.80823);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(3) NOT NULL,
  `nama_kriteria` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `prioritas_k` int(3) NOT NULL,
  `bobot_kriteria` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `prioritas_k`, `bobot_kriteria`) VALUES
(1, 'Nilai Akademik', 1, 0.75),
(2, 'Prestasi', 2, 0.25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `status` enum('admin','user') COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `aktif` enum('y','n') COLLATE latin1_general_ci NOT NULL,
  `urutan` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu`, `link`, `status`, `aktif`, `urutan`) VALUES
('Data Pengguna', '?modul=pengguna', 'admin', 'y', 1),
('Kriteria', '?modul=kriteria', 'admin', 'y', 2),
('Bobot', '?modul=bobot', 'admin', 'y', 4),
('Laporan', '?modul=evaluasi', 'user', 'y', 6),
('Siswa', '?modul=siswa', 'admin', 'y', 5),
('Sub Kriteria', '?modul=subkriteria', 'admin', 'y', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_siswa`
--

CREATE TABLE IF NOT EXISTS `nilai_siswa` (
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `n_idk` int(3) NOT NULL,
  `n_ids` int(3) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `nilai_siswa`
--

INSERT INTO `nilai_siswa` (`username`, `n_idk`, `n_ids`, `nilai`) VALUES
('agus', 1, 3, 6.5),
('agus', 1, 2, 7.8),
('agus', 1, 1, 7.3),
('agus', 2, 4, 0),
('agus', 2, 5, 1),
('lenny', 1, 1, 8.3),
('lenny', 1, 2, 7.8),
('lenny', 1, 3, 8.5),
('lenny', 2, 4, 1),
('lenny', 2, 5, 0),
('kevin', 1, 1, 9.1),
('kevin', 1, 2, 8.1),
('kevin', 1, 3, 8.4),
('kevin', 2, 4, 1),
('kevin', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1),
('root', 1, 1, 7.3),
('root', 1, 2, 7.8),
('root', 1, 3, 6.5),
('root', 2, 4, 0),
('root', 2, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `level` enum('admin','user') COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `level`) VALUES
('karen', 'ba952731f97fb058035aa399b1cb3d5c', 'admin'),
('kevin', '9d5e3ecdeb4cdb7acfd63075ae046672', 'user'),
('lenny', 'a5835fc6854dd0313b32b12af6aadd3d', 'user'),
('agus', 'fdf169558242ee051cca1479770ebac3', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int(3) NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `nm_siswa` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `sekolah_asal` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `username`, `nm_siswa`, `sekolah_asal`) VALUES
(2, 'lenny', 'Lenny Octavia', 'SMP N 18'),
(1, 'agus', 'Agus Setiawan', 'SMP N 147'),
(3, 'kevin', 'Kevin Julio', 'SMP N 12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE IF NOT EXISTS `subkriteria` (
  `id_kriteria` int(3) NOT NULL,
  `id_subkriteria` int(3) NOT NULL,
  `nm_subkriteria` varchar(100) NOT NULL,
  `prioritas_s` int(3) NOT NULL,
  `bobot_subkriteria` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`id_kriteria`, `id_subkriteria`, `nm_subkriteria`, `prioritas_s`, `bobot_subkriteria`) VALUES
(2, 5, 'Prestasi Non Akademik', 2, 0.25),
(2, 4, 'Prestasi Akademik', 1, 0.75),
(1, 3, 'Bahasa Inggris', 3, 0.111),
(1, 2, 'Bahasa Indonesia', 2, 0.278),
(1, 1, 'Matematika', 1, 0.611);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
