-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2022 pada 11.31
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_saw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'sansudirman', '$2y$10$TR7tJBifQZWyvGpfTo4RDueN9ebAkyJG8T2kDo56yPyWZiCYh4dbe'),
(2, 'awidi', '1234');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_pemilihan` int(11) NOT NULL,
  `alternatif` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_pemilihan`, `alternatif`) VALUES
(43, 'san sudirman'),
(43, 'sabilah'),
(43, 'kusnaidi'),
(45, 'kariman'),
(45, 'anilah'),
(45, 'sahdan'),
(46, 'Alan'),
(46, 'Azwin'),
(46, 'Gilang'),
(48, 'san sudirman'),
(48, 'kariman'),
(48, 'kori');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_pemilihan` int(11) NOT NULL,
  `alternatif` varchar(255) NOT NULL,
  `v` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_pemilihan`, `alternatif`, `v`) VALUES
(43, 'san sudirman', 0.80334),
(45, 'kariman', 0.76613),
(46, 'Gilang', 0.85273),
(48, 'kori', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_pemilihan` int(11) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL,
  `c6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_pemilihan`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
(43, 50, 50, 60, 10, 15, 25),
(43, 40, 30, 40, 5, 4, 20),
(43, 20, 25, 30, 5, 10, 21),
(45, 12, 50, 40, 10, 12, 25),
(45, 31, 20, 20, 5, 15, 35),
(45, 20, 20, 20, 10, 20, 20),
(46, 12, 20, 30, 9, 20, 35),
(46, 20, 40, 50, 8, 25, 30),
(46, 55, 40, 20, 11, 15, 30),
(48, 40, 50, 60, 10, 15, 25),
(48, 50, 20, 60, 10, 15, 25),
(48, 50, 50, 60, 10, 15, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `normalisasi`
--

CREATE TABLE `normalisasi` (
  `id_pemilihan` int(11) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL,
  `c6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `normalisasi`
--

INSERT INTO `normalisasi` (`id_pemilihan`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
(43, 1, 1, 1, 0.5, 0.2667, 0.8),
(43, 0.8, 0.6, 0.6667, 1, 1, 1),
(43, 0.4, 0.5, 0.5, 1, 0.4, 0.9524),
(45, 0.3871, 1, 1, 0.5, 1, 0.8),
(45, 1, 0.4, 0.5, 1, 0.8, 0.5714),
(45, 0.6452, 0.4, 0.5, 0.5, 0.6, 1),
(46, 0.2182, 0.5, 0.6, 0.8889, 0.75, 0.8571),
(46, 0.3636, 1, 1, 1, 0.6, 1),
(46, 1, 1, 0.4, 0.7273, 1, 1),
(48, 0.8, 1, 1, 1, 1, 1),
(48, 1, 0.4, 1, 1, 1, 1),
(48, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilihan`
--

CREATE TABLE `pemilihan` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemilihan`
--

INSERT INTO `pemilihan` (`id`, `keterangan`, `tanggal`, `status`) VALUES
(43, 'pemilihan manajer 2021', '2021-01-28', 'selesai'),
(44, 'pemilihan manajer 2021', '2021-01-28', 'id'),
(45, 'pemilihan penerimaan PKH', '2021-02-04', 'selesai'),
(46, 'pemilihan penerima PKH', '2021-02-04', 'selesai'),
(47, 'program', '2021-08-01', 'id'),
(48, 'pemilihan manajer 2021', '2022-04-02', 'selesai'),
(49, 'program', '2022-04-27', 'id');


CREATE TABLE `dusun` (
`id` int(11) NOT NULL,
`nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dusun`
--

INSERT INTO `dusun` (`id`, `nama`) VALUES
(1, 'Ancak Barat'),
(2, 'Ancak Timur'),
(3, 'Dasan Baro'),
(4, 'Dasan Kopang'),
(5, 'Gol Munjid'),
(6, 'Karang Bajo'),
(7, 'Lokok Aur'),
(8, 'Pelabupati'),
(9, 'Trantapan');
-- --------------------------------------------------------

--
-- Struktur dari tabel `ranking`
--

CREATE TABLE `ranking` (
  `id_pemilihan` int(11) NOT NULL,
  `v` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ranking`
--

INSERT INTO `ranking` (`id_pemilihan`, `v`) VALUES
(43, 0.80334),
(43, 0.79334),
(43, 0.5),
(45, 0.76613),
(45, 0.74),
(45, 0.54356),
(46, 0.52435),
(46, 0.72908),
(46, 0.85273),
(48, 0.94),
(48, 0.88),
(48, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indeks untuk tabel `normalisasi`
--
ALTER TABLE `normalisasi`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indeks untuk tabel `pemilihan`
--
ALTER TABLE `pemilihan`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `dusun`
    ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ranking`
--
ALTER TABLE `ranking`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pemilihan`
--
ALTER TABLE `pemilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `normalisasi`
--
ALTER TABLE `normalisasi`
  ADD CONSTRAINT `normalisasi_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
