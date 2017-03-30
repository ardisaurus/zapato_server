-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2016 at 04:33 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zapato`
--

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE IF NOT EXISTS `gudang` (
  `id_gudang` int(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_gudang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `nama`, `alamat`) VALUES
(1, 'Alpha Subs', 'Jl Pegangsaan Timur no. 56, Jakarta'),
(4, 'Delta Subs', 'Jl Tengku Umar no 66 Tangerang');

-- --------------------------------------------------------

--
-- Table structure for table `sepatu`
--

CREATE TABLE IF NOT EXISTS `sepatu` (
  `id_sepatu` int(15) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `harga` varchar(10) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id_sepatu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sepatu`
--

INSERT INTO `sepatu` (`id_sepatu`, `brand`, `model`, `harga`, `kategori`) VALUES
(5, 'New Balance', 'MX608v4', '815000', 'Man - Sepatu Olahraga'),
(6, 'The North Face', 'Thermoball Versa', '1860000', 'Man - Boots'),
(7, 'Mizuno', 'Wive Inspire 13', '1716000', 'Man - Sepatu Olahraga'),
(8, 'Dr. Schools', 'Work Hiro', '858000', 'Man - Sepatu Formal'),
(9, 'Flyer', 'Premium Rumbler Hi', '1573000', 'Man - Sneaker & Skate'),
(10, 'Summit', 'Scarlet', '3134000', 'Woman - Heels'),
(11, 'FYRE', 'Cara', '5409000', 'Woman - Boots'),
(12, 'Puma', 'Suende Classic Core WNS', '929000', 'Woman - Flats & Balerina');

-- --------------------------------------------------------

--
-- Table structure for table `stok_gudang`
--

CREATE TABLE IF NOT EXISTS `stok_gudang` (
  `id_stok_gudang` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` varchar(11) NOT NULL,
  `id_sepatu` varchar(11) NOT NULL,
  `ukuran` varchar(11) NOT NULL,
  `stok` varchar(11) NOT NULL,
  PRIMARY KEY (`id_stok_gudang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `stok_gudang`
--

INSERT INTO `stok_gudang` (`id_stok_gudang`, `id_gudang`, `id_sepatu`, `ukuran`, `stok`) VALUES
(1, '1', '12', '40', '10'),
(17, '1', '5', '44', '185'),
(20, '1', '11', '38', '100'),
(25, '4', '9', '44', '10'),
(26, '1', '8', '38', '70'),
(27, '4', '12', '37', '10');

-- --------------------------------------------------------

--
-- Table structure for table `stok_outlet`
--

CREATE TABLE IF NOT EXISTS `stok_outlet` (
  `id_stok_outlet` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `id_sepatu` int(15) NOT NULL,
  `ukuran` varchar(11) NOT NULL,
  `stok` int(10) NOT NULL,
  PRIMARY KEY (`id_stok_outlet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(10) NOT NULL AUTO_INCREMENT,
  `id_gudang` int(20) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `id_sepatu` varchar(11) NOT NULL,
  `ukuran` varchar(11) NOT NULL,
  `jml` int(4) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_gudang`, `user_id`, `id_sepatu`, `ukuran`, `jml`, `status`) VALUES
(14, 4, 'onodera', '9', '44', 11, 'Menunggu Konfirmasi'),
(15, 1, 'onodera', '5', '44', 24, 'Terkirim'),
(16, 1, 'onodera', '11', '38', 90, 'Menunggu Konfirmasi'),
(17, 4, 'onodera', '9', '44', 5, 'Menunggu Konfirmasi'),
(18, 1, 'onodera', '11', '38', 12, 'Dikonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(6) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama`, `password`, `level`, `telepon`, `alamat`) VALUES
('blue66', 'Blue', '1be49aa89a83537aa59bc6fe8b80f255', 'outlet', '085333333388', '5th Goldblum st. Denver'),
('box123', 'Box123', 'a05d9276024118488d39e8a1156183bd', 'outlet', '085333333388', '3th Blakely st. Forks'),
('garuda8', 'Garuda', '4e75e5fc14b1344c03d691da29474e63', 'admin', '085333333318', 'Jl Pegangsaan Timur no. 56 Jakarta'),
('hermes4', 'Hermes Four', '4bbb5830df86e5a680ed5ada83c04260', 'outlet', '085333333388', '6th Caribean st. Texas'),
('ibiza8', 'Ibiza', '8f93059039031175247ca8614543b07d', 'admin', '085333333318', '9th Blue Ocean st. Ibiza'),
('ichijo', 'Raku Ichijo', '0192023a7bbd73250516f069df18b500', 'admin', '085333333318', '90th Konyaku st. Okinawa.'),
('milan3', 'Milan', 'e2dfbe7f8a8db5f080ed10d54e81cf4e', 'admin', '085333333318', '81st Salami Pizza st. Milan'),
('onodera', 'Kosaki Onodera', 'a510166163833c79aa703646f59c04bb', 'outlet', '085333333318', '7th Ohana st. Okinawa'),
('panda7', 'Panda', '6f04b332e07a36a4210a79cd1a2d1419', 'admin', '085333333318', '7th Dim Sum st. Shanghai'),
('pink77', 'Pink Seven', '2107153a93ccf46d9dc6221127ac0b59', 'outlet', '085333333388', '5th Haloween st. Boston'),
('santa3', 'Santa', 'f31879fd2e9f1198b9193869bc2fef30', 'admin', '085333333318', '12th Arctic Circle st, Arctic'),
('star88', 'Star', '869458f478303af72a58ca10ca2b4803', 'outlet', '085333333388', '9th Crimson st. San Francisco');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
