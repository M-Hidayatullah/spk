-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 28 Agu 2022 pada 10.28
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(48, 'kori'),
(50, 'Gilang'),
(50, 'kariman'),
(50, 'kariman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dusun`
--

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
-- Struktur dari tabel `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id_masyarakat` int(9) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `no_kk` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `id_dusun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masyarakat`
--

INSERT INTO `masyarakat` (`id_masyarakat`, `nik`, `no_kk`, `nama`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `id_dusun`) VALUES
(1, '46', '39', 'Adipisci laudantium', 'Sunt quas et qui sap', 'Maiores exercitation', '2012-04-11', 'l', 1),
(2, '85', '16', 'Aut fugiat ex est q', 'Cupiditate velit li', 'Praesentium dicta ip', '2016-07-24', 'l', 1),
(3, '77', '12', 'Ipsam perspiciatis ', 'Facere ex numquam du', 'In vel nesciunt fac', '2005-01-09', 'l', 1),
(4, '75', '86', 'Sint lorem facilis l', 'Tempore ab voluptat', 'Nostrud sed cupidita', '2019-12-17', 'l', 1),
(5, '11', '50', 'Reprehenderit doloru', 'Nostrud est error de', 'Est expedita cum ma', '1992-09-15', 'l', 1),
(6, '10', '57', 'Sed ea et proident ', 'Blanditiis sed a sed', 'Obcaecati assumenda ', '2014-12-14', 'p', 1),
(7, '12', '46', 'Velit voluptates mai', 'Sint quos suscipit q', 'Quia et labore qui q', '1988-05-23', 'l', 1),
(8, '16', '9', 'Veniam aut est del', 'Et in voluptate est', 'Consequatur omnis q', '1999-08-19', 'l', 1),
(9, '61', '87', 'Voluptatem assumenda', 'Quis reprehenderit q', 'Nemo ad sunt sit ex ', '1983-04-01', 'p', 1),
(10, '40', '98', 'Suscipit et natus al', 'Similique non duis q', 'Ea sunt iste nihil ', '1971-02-02', 'p', 1),
(11, '51', '74', 'Quod voluptas error ', 'Cupidatat ipsam quid', 'Harum quia blanditii', '1995-07-03', 'l', 1),
(12, '73', '50', 'Quia eveniet aute a', 'Dolore eos ea digni', 'Quia ut minim amet ', '2007-02-07', 'l', 2),
(13, '64', '84', 'Consequatur sequi d', 'Suscipit consequat ', 'Quidem elit eos non', '2015-02-25', 'p', 2),
(14, '42', '48', 'Voluptatem Possimus', 'Ex rerum magnam dolo', 'Voluptate exercitati', '1984-07-28', 'p', 2),
(15, '47', '98', 'Veniam animi non r', 'Voluptatibus provide', 'Dicta non fugiat ess', '1982-11-24', 'l', 2),
(16, '80', '9', 'Est ducimus id lab', 'Impedit deserunt sa', 'Commodi quia quaerat', '1971-03-12', 'l', 2),
(17, '60', '67', 'Sit inventore dolor', 'Alias at enim quos i', 'Expedita quis nemo n', '2019-04-10', 'l', 2),
(18, '91', '72', 'Sit dolores quis nu', 'Assumenda quos bland', 'Qui alias fugiat pro', '1998-08-15', 'p', 2),
(19, '94', '97', 'Inventore ad ullamco', 'Sit itaque veritatis', 'Facilis veniam elig', '2000-08-27', 'l', 3),
(20, '36', '48', 'Eveniet aspernatur ', 'Labore magni reprehe', 'Maxime dolore cupidi', '1992-02-09', 'p', 3),
(21, '53', '27', 'Facilis ea enim sit', 'Aut ut proident sit', 'Nulla quia reiciendi', '2021-01-12', 'l', 3),
(22, '64', '79', 'In asperiores nulla ', 'Dicta dolorem tenetu', 'Repellendus Volupta', '1992-12-05', 'p', 3),
(23, '62', '50', 'Voluptate Nam dolore', 'Architecto a molliti', 'Cupidatat est qui s', '1998-02-11', 'l', 3),
(24, '93', '100', 'Ut irure non occaeca', 'Minus ab voluptas re', 'In ut commodo provid', '1993-04-21', 'l', 3),
(25, '23', '22', 'Reprehenderit odio v', 'Veritatis reprehende', 'Dicta recusandae Do', '1992-03-04', 'p', 3),
(26, '76', '49', 'Laborum Provident ', 'Repudiandae culpa c', 'Ducimus anim explic', '1972-07-11', 'p', 3),
(27, '83', '8', 'Autem ipsum molestia', 'Deleniti aliquid et ', 'Voluptatem sit aliq', '1996-01-14', 'l', 3),
(28, '29', '64', 'Ea ad consequatur c', 'Aliquid consequatur', 'Earum adipisicing ab', '2002-02-26', 'p', 3),
(29, '75', '79', 'Cum vitae quo volupt', 'Laboris omnis dolore', 'Enim iste expedita v', '1977-01-18', 'l', 3),
(30, '73', '40', 'Odit omnis dolor et ', 'Minima quis quibusda', 'Velit animi labore ', '1999-11-17', 'p', 3),
(31, '70', '2', 'Consequuntur omnis d', 'Quas dolor illo volu', 'Voluptatem quisquam ', '2016-08-15', 'l', 3),
(32, '54', '25', 'Et fugiat molestiae ', 'Enim ad iure consequ', 'Deserunt amet ducim', '1986-03-23', 'p', 3),
(33, '65', '57', 'Consectetur quasi q', 'Eiusmod in laborum ', 'Magna totam quis eli', '2015-12-16', 'p', 4),
(34, '85', '63', 'Ut fugit maxime sae', 'Fugit nihil quia si', 'Amet provident vol', '2001-06-14', 'l', 4),
(35, '89', '36', 'Quibusdam distinctio', 'Velit qui optio qui', 'Proident corrupti ', '1972-07-02', 'p', 4),
(36, '21', '55', 'Sunt est consequuntu', 'Veniam enim est et', 'Non eligendi qui nes', '1972-07-03', 'p', 4),
(37, '50', '38', 'Voluptas praesentium', 'Repudiandae vitae be', 'Aute voluptas cum de', '2017-05-13', 'l', 4),
(38, '92', '16', 'Minima possimus rep', 'Placeat quo nisi la', 'Ipsum ullam reiciend', '1986-10-27', 'p', 4),
(39, '71', '96', 'Fugit omnis Nam quo', 'In voluptas qui plac', 'Dolor architecto bla', '2016-06-01', 'l', 4),
(40, '22', '80', 'Illum est aut aut u', 'Pariatur Ex sed des', 'Duis earum corporis ', '2018-01-23', 'l', 4),
(41, '6', '54', 'Id voluptatem qui mo', 'Aut non aut id libe', 'Molestias esse aut e', '1995-03-02', 'p', 4),
(42, '63', '72', 'Omnis eius autem in ', 'Eveniet quo atque c', 'Duis ab accusantium ', '2007-07-22', 'l', 4),
(43, '26', '1', 'Consequatur Irure v', 'Sed et iusto amet m', 'Voluptatem sequi co', '1971-06-21', 'p', 4),
(44, '48', '74', 'Numquam id nobis dol', 'Reprehenderit possi', 'Fugiat ex sit aut su', '1984-03-06', 'l', 4),
(45, '63', '20', 'In quod error et rep', 'Sunt ex perferendis ', 'Voluptatibus volupta', '2004-02-13', 'p', 4),
(46, '67', '60', 'Est ut veniam mini', 'Officia lorem ab cum', 'Voluptas voluptates ', '2013-03-15', 'p', 4),
(47, '19', '29', 'Est impedit fugiat ', 'Corporis cillum quod', 'Est consectetur minu', '1987-06-14', 'l', 4),
(48, '52', '70', 'Iure accusamus sed e', 'Et vero non blanditi', 'Deleniti id iste cup', '1997-02-11', 'l', 4),
(49, '42', '88', 'Tempora nostrud eum ', 'Vitae omnis magnam e', 'Sunt dolor odio inc', '1980-10-28', 'l', 4),
(50, '9', '9', 'Ipsum consequuntur e', 'Impedit odit doloru', 'Ut error omnis dicta', '1979-02-27', 'p', 5),
(51, '93', '33', 'Amet accusantium te', 'Qui maxime sed ullam', 'Exercitationem amet', '1991-01-24', 'l', 5),
(52, '93', '89', 'Aut in eum excepturi', 'Facilis velit ut et ', 'Ut maxime omnis saep', '2016-08-24', 'l', 5),
(53, '87', '67', 'Velit reiciendis eu', 'Adipisci labore omni', 'Quis non rerum eu ra', '1973-10-13', 'l', 5),
(54, '74', '84', 'Ut odit delectus et', 'Et rerum non laborum', 'Proident aut quia r', '2009-11-25', 'p', 5),
(55, '2', '74', 'Et amet in tempora ', 'Occaecat ut dolor ei', 'Nobis blanditiis imp', '2006-12-10', 'l', 5),
(56, '30', '47', 'Voluptatem perferen', 'Adipisci eum praesen', 'Accusamus laborum si', '1996-10-27', 'p', 5),
(57, '23', '23', 'Molestiae qui adipis', 'Id aut quisquam aliq', 'Nobis temporibus et ', '1990-03-08', 'p', 5),
(58, '73', '5', 'Corrupti consequatu', 'Aliquid dolorum nisi', 'Aut est ullam molli', '1990-10-21', 'l', 5),
(59, '89', '59', 'Sunt ullam voluptate', 'Qui obcaecati possim', 'Adipisicing aliquam ', '2022-07-23', 'l', 5),
(60, '24', '3', 'Maiores veniam volu', 'A laudantium quis a', 'Explicabo Nam volup', '2003-03-25', 'l', 6),
(61, '30', '68', 'Qui debitis perspici', 'Magni occaecat repel', 'Ea aliquam id sed of', '2009-03-13', 'p', 6),
(62, '67', '83', 'Et laboriosam iusto', 'Ea aliquam tempora p', 'Praesentium quidem a', '1994-10-14', 'l', 6),
(63, '73', '50', 'Quo sed quia laborum', 'Deserunt vel vitae a', 'Atque est quia volup', '2016-06-22', 'p', 6),
(64, '14', '46', 'Quos rerum nesciunt', 'Ea ut ipsum beatae ', 'Qui dolorum aut id d', '1982-04-16', 'p', 6),
(65, '86', '65', 'In doloremque sed et', 'Eiusmod ad dolores s', 'Quia corporis corrup', '2002-09-27', 'p', 6),
(66, '36', '55', 'Quos laborum A dele', 'Quasi ipsam recusand', 'Corporis fugit ad v', '1992-04-24', 'p', 6),
(67, '51', '11', 'Deserunt cum ducimus', 'Nisi animi officiis', 'Fuga Nam non volupt', '1980-04-17', 'l', 6),
(68, '15', '74', 'Corporis sint qui a', 'Vel soluta eius quae', 'Natus et laudantium', '1981-02-25', 'l', 6),
(69, '59', '27', 'Velit nisi enim non', 'Deserunt eum cillum ', 'Tenetur praesentium ', '2016-09-09', 'p', 6),
(70, '82', '43', 'Et error aspernatur ', 'Sint anim esse maxi', 'Natus est vitae qui ', '2013-10-15', 'l', 6),
(71, '7', '67', 'Itaque est deserunt ', 'Nulla molestias ut e', 'Id omnis similique m', '1995-03-09', 'p', 6),
(72, '20', '79', 'Nostrum aliquip cons', 'Sunt delectus id i', 'Deleniti voluptate i', '2014-03-03', 'l', 7),
(73, '66', '91', 'Laboriosam dolore i', 'Aspernatur tenetur p', 'Ut autem anim modi N', '1977-03-14', 'l', 7),
(74, '87', '89', 'Voluptatum totam ven', 'Nobis sit adipisci ', 'Laboris aperiam opti', '2007-01-23', 'p', 7),
(75, '8', '84', 'Expedita sed amet h', 'Hic dolore laborum s', 'Qui corrupti quos d', '1992-04-05', 'l', 7),
(76, '79', '18', 'Harum deserunt maior', 'Est et explicabo Qu', 'Cum facilis quia nis', '1997-07-06', 'l', 7),
(77, '44', '99', 'Excepturi voluptatem', 'Labore rerum fugiat', 'Vel perferendis aspe', '1978-03-08', 'p', 7),
(78, '36', '67', 'Nisi dolorum est dic', 'Illo et esse irure s', 'Voluptatibus odit in', '2000-09-07', 'l', 7),
(79, '60', '43', 'Quaerat accusamus mo', 'Est eos sit dolor', 'Quo ex quae laboris ', '1988-08-14', 'p', 7),
(80, '60', '29', 'Rerum sapiente imped', 'Do non eaque consect', 'Consequatur similiqu', '1971-06-28', 'l', 7),
(81, '37', '65', 'Quibusdam nihil aut ', 'Nostrum odio fugiat ', 'Numquam adipisci qui', '2006-09-28', 'l', 7),
(82, '10', '35', 'Doloribus eos animi', 'Optio velit esse v', 'Ducimus eveniet ma', '1980-09-23', 'l', 7),
(83, '73', '22', 'Sed necessitatibus a', 'Et et natus ut amet', 'Modi dicta magna qui', '2017-08-25', 'l', 8),
(84, '24', '22', 'Beatae beatae iste u', 'Placeat reiciendis ', 'Qui cupiditate sint ', '1998-02-23', 'p', 8),
(85, '38', '21', 'Quos illo iusto adip', 'Autem error debitis ', 'Eum in ad provident', '2017-04-08', 'l', 8),
(86, '71', '2', 'Elit autem rerum ne', 'Tempore nihil vitae', 'Cumque consequatur m', '2011-06-12', 'p', 8),
(87, '33', '10', 'Non eveniet id nih', 'Similique aut exerci', 'Non pariatur Ad vol', '1973-03-15', 'l', 8),
(88, '73', '61', 'Repellendus Eos ass', 'Vero doloremque fugi', 'Unde debitis nihil d', '1974-10-01', 'l', 8),
(89, '43', '69', 'Sit quia occaecat t', 'Ratione facilis veni', 'Est consequatur tem', '2005-04-03', 'p', 8),
(90, '11', '66', 'Sapiente ducimus ea', 'Aliquid fugit et ut', 'Quo amet libero ill', '2009-10-17', 'p', 8),
(91, '53', '78', 'Sed commodo molestia', 'Ratione voluptatibus', 'Voluptas excepturi n', '1976-02-24', 'l', 8),
(92, '4', '17', 'Et sed qui et et', 'Reiciendis accusanti', 'Ipsum ut quia aut qu', '2008-11-24', 'l', 8),
(93, '8', '9', 'Velit sint veniam p', 'Reprehenderit sequi ', 'Ea repudiandae dolor', '2020-09-10', 'p', 8),
(94, '39', '27', 'Eu ullamco qui minim', 'Quo voluptas volupta', 'Fugiat tempora recu', '2006-01-24', 'l', 8),
(95, '92', '63', 'Doloribus in incidid', 'Cupiditate quo ut no', 'Quos enim ullam dign', '1989-02-25', 'l', 8),
(96, '80', '43', 'Est tempore sed qua', 'Alias impedit qui o', 'Odio ex lorem illum', '1997-03-01', 'l', 8),
(97, '38', '21', 'Quam lorem fugit qu', 'Labore obcaecati et ', 'Velit magnam repreh', '2020-09-08', 'p', 8),
(98, '44', '56', 'Facilis aliquam reru', 'Nemo aut cillum et r', 'Ab qui necessitatibu', '1976-09-16', 'p', 8),
(99, '85', '54', 'Exercitation accusan', 'Soluta fugit at con', 'Iusto et voluptas ex', '2009-01-22', 'p', 8),
(100, '32', '99', 'Veritatis eos offic', 'Ipsa aut eaque non ', 'Minim aliquid possim', '2018-02-07', 'p', 8),
(101, '73', '22', 'Sed necessitatibus a', 'Et et natus ut amet', 'Modi dicta magna qui', '2017-08-25', 'l', 8),
(102, '24', '22', 'Beatae beatae iste u', 'Placeat reiciendis ', 'Qui cupiditate sint ', '1998-02-23', 'p', 8),
(103, '38', '21', 'Quos illo iusto adip', 'Autem error debitis ', 'Eum in ad provident', '2017-04-08', 'l', 8),
(104, '71', '2', 'Elit autem rerum ne', 'Tempore nihil vitae', 'Cumque consequatur m', '2011-06-12', 'p', 8),
(105, '33', '10', 'Non eveniet id nih', 'Similique aut exerci', 'Non pariatur Ad vol', '1973-03-15', 'l', 8),
(106, '73', '61', 'Repellendus Eos ass', 'Vero doloremque fugi', 'Unde debitis nihil d', '1974-10-01', 'l', 8),
(107, '43', '69', 'Sit quia occaecat t', 'Ratione facilis veni', 'Est consequatur tem', '2005-04-03', 'p', 8),
(108, '11', '66', 'Sapiente ducimus ea', 'Aliquid fugit et ut', 'Quo amet libero ill', '2009-10-17', 'p', 8),
(109, '53', '78', 'Sed commodo molestia', 'Ratione voluptatibus', 'Voluptas excepturi n', '1976-02-24', 'l', 8),
(110, '4', '17', 'Et sed qui et et', 'Reiciendis accusanti', 'Ipsum ut quia aut qu', '2008-11-24', 'l', 8),
(111, '8', '9', 'Velit sint veniam p', 'Reprehenderit sequi ', 'Ea repudiandae dolor', '2020-09-10', 'p', 8),
(112, '39', '27', 'Eu ullamco qui minim', 'Quo voluptas volupta', 'Fugiat tempora recu', '2006-01-24', 'l', 8),
(113, '92', '63', 'Doloribus in incidid', 'Cupiditate quo ut no', 'Quos enim ullam dign', '1989-02-25', 'l', 8),
(114, '80', '43', 'Est tempore sed qua', 'Alias impedit qui o', 'Odio ex lorem illum', '1997-03-01', 'l', 8),
(115, '38', '21', 'Quam lorem fugit qu', 'Labore obcaecati et ', 'Velit magnam repreh', '2020-09-08', 'p', 8),
(116, '44', '56', 'Facilis aliquam reru', 'Nemo aut cillum et r', 'Ab qui necessitatibu', '1976-09-16', 'p', 8),
(117, '85', '54', 'Exercitation accusan', 'Soluta fugit at con', 'Iusto et voluptas ex', '2009-01-22', 'p', 8),
(118, '32', '99', 'Veritatis eos offic', 'Ipsa aut eaque non ', 'Minim aliquid possim', '2018-02-07', 'p', 8),
(119, '88', '30', 'Facilis a id quia re', 'Recusandae Corrupti', 'Eveniet architecto ', '1991-09-27', 'p', 9),
(120, '13', '95', 'Voluptatibus in ipsu', 'Enim eaque dolore do', 'Exercitation officia', '2002-12-01', 'p', 9),
(121, '83', '73', 'Facere nihil sint no', 'Reiciendis quisquam ', 'Amet ut aut et saep', '1986-07-02', 'l', 9),
(122, '31', '73', 'Similique hic et qua', 'Unde aperiam debitis', 'Exercitation natus i', '1986-07-22', 'p', 9),
(123, '69', '27', 'Sed doloribus sunt ', 'Odit obcaecati et re', 'Consectetur officia', '2011-09-05', 'p', 9),
(124, '34', '53', 'Similique aut fugiat', 'Mollitia deleniti re', 'Ducimus optio qui ', '1972-12-21', 'l', 9),
(125, '47', '49', 'Ad nisi do voluptate', 'Voluptatem et et vo', 'Sint dicta corrupti', '2010-04-04', 'l', 9),
(126, '70', '29', 'Ut enim cupidatat co', 'Cupiditate deserunt ', 'Exercitationem ratio', '1995-02-14', 'l', 9),
(127, '99', '45', 'Blanditiis ducimus ', 'Sunt incidunt sint', 'Sed expedita quasi m', '1979-09-24', 'l', 9),
(128, '68', '99', 'Quidem est voluptat', 'Sint odio odio iure', 'Corrupti est porro ', '2008-10-05', 'p', 9),
(129, '64', '79', 'Quia exercitation de', 'Voluptatibus quis qu', 'Culpa ex saepe dolo', '2014-08-08', 'l', 9),
(130, '10', '47', 'Aut eos nesciunt q', 'Provident optio te', 'Quisquam voluptatem ', '2007-01-17', 'p', 9),
(131, '97', '67', 'Aut vel illum in co', 'Voluptas laboris vel', 'Expedita occaecat do', '1971-12-28', 'l', 9),
(132, '40', '68', 'Est ipsum do molesti', 'Laborum Nam natus t', 'Eum eos anim conseq', '1976-03-04', 'p', 9),
(133, '82', '13', 'Iure sapiente simili', 'Et molestiae quia vo', 'Quae velit ad vel so', '1981-07-03', 'l', 9),
(134, '12', '65', 'Pariatur Aut labori', 'Consequat Veniam v', 'Do omnis omnis quo d', '1977-12-06', 'p', 9),
(135, '32', '23', 'Aut non omnis sunt ', 'Reiciendis est id re', 'Ipsam soluta unde od', '1992-02-22', 'l', 9);

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
(49, 'program', '2022-04-27', 'id'),
(50, 'Gol Munjid', '2022-08-28', 'alternatif'),
(51, 'Pelabupati', '2022-08-28', 'id');

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
-- Indeks untuk tabel `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indeks untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id_masyarakat`);

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
-- AUTO_INCREMENT untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id_masyarakat` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT untuk tabel `pemilihan`
--
ALTER TABLE `pemilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
