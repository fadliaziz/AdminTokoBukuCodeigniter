-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2019 at 04:02 PM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freeapp_tokobuku`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `idbuku` varchar(10) NOT NULL,
  `iddistributor` varchar(10) NOT NULL,
  `judul` varchar(90) DEFAULT NULL,
  `noisbn` varchar(15) DEFAULT NULL,
  `penulis` varchar(65) DEFAULT NULL,
  `penerbit` varchar(65) DEFAULT NULL,
  `tahun` datetime DEFAULT NULL,
  `stok` tinyint(4) DEFAULT NULL,
  `harga_pokok` int(3) DEFAULT NULL,
  `harga_jual` int(3) DEFAULT NULL,
  `ppn` decimal(3,1) DEFAULT '0.0',
  `diskon` decimal(3,1) DEFAULT '0.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`idbuku`, `iddistributor`, `judul`, `noisbn`, `penulis`, `penerbit`, `tahun`, `stok`, `harga_pokok`, `harga_jual`, `ppn`, `diskon`) VALUES
('A1BAC2DACA', 'A1ABB12B31', 'buku baru dari kantornya', '234-123', 'raga mulia', 'erlanggan', '2019-03-10 15:41:35', 96, 2000, 2000000, '5.0', '50.0'),
('AAB1BAC1A5', 'A11213BAC1', 'buku 1', '4567-323', 'raga', 'erlanggan', '2019-03-10 15:41:08', 0, 1000000, 2000000, '5.0', '50.0');

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `iddistributor` varchar(10) NOT NULL,
  `namadistributor` varchar(65) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`iddistributor`, `namadistributor`, `alamat`, `telepon`) VALUES
('A11213BAC1', 'ragamulia', 'jalan utama gang cipta', '0853632164'),
('A11ABAB4B3', 'tuti desiwati', 'jalan utama gang cipta', '08536651746'),
('A1ABB12B31', 'kiko', 'jalan utama gna cipta', '08536123'),
('A1BBA2CA31', 'satria', 'jalan utama gang cipta', '086123'),
('AAB123ADD1', 'tuti sikampret', 'jalan ssssssss', '085366555'),
('AAB1BC2A12', 'bima sakti', 'jalan utama gang cipta tenayan raya', '085363211');

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `nama` varchar(65) DEFAULT NULL,
  `username` varchar(65) NOT NULL,
  `password` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`nama`, `username`, `password`) VALUES
('Raga mulia kusuma', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `pasok`
--

CREATE TABLE `pasok` (
  `idpasok` int(11) NOT NULL,
  `idbuku` varchar(10) DEFAULT NULL,
  `iddistributor` varchar(10) DEFAULT NULL,
  `jumlah` tinyint(4) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pasok`
--

INSERT INTO `pasok` (`idpasok`, `idbuku`, `iddistributor`, `jumlah`, `tanggal`) VALUES
(37, 'AAB1BAC1A5', 'A11213BAC1', 1, '2019-03-10 15:41:08'),
(38, 'A1BAC2DACA', 'A1ABB12B31', 50, '2019-03-10 15:41:35');

--
-- Triggers `pasok`
--
DELIMITER $$
CREATE TRIGGER `after_insert_pasok` AFTER INSERT ON `pasok` FOR EACH ROW UPDATE buku SET
buku.stok = buku.stok + new.jumlah
WHERE buku.idbuku = new.idbuku
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `idpenjualan` int(11) NOT NULL,
  `idbuku` varchar(10) DEFAULT NULL,
  `idkasir` varchar(65) DEFAULT NULL,
  `jumlah` tinyint(4) DEFAULT NULL,
  `total` int(3) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`idpenjualan`, `idbuku`, `idkasir`, `jumlah`, `total`, `tanggal`) VALUES
(3, 'A1BAC2DACA', 'admin', 2, 2200000, '2019-03-10 15:51:02'),
(4, 'AAB1BAC1A5', 'admin', 2, 2200000, '2019-03-10 15:51:02'),
(5, 'A1BAC2DACA', 'admin', 2, 1100000, '2019-03-10 15:52:00'),
(6, 'A1BAC2DACA', 'admin', 2, 2200000, '2019-03-10 15:53:24'),
(7, 'AAB1BAC1A5', 'admin', 2, 2200000, '2019-03-10 15:53:24'),
(8, 'A1BAC2DACA', 'admin', 2, 2200000, '2019-03-10 15:56:16'),
(9, 'A1BAC2DACA', 'admin', 2, 2200000, '2019-03-10 15:57:59'),
(10, 'AAB1BAC1A5', 'admin', 2, 2200000, '2019-03-10 15:59:54');

--
-- Triggers `penjualan`
--
DELIMITER $$
CREATE TRIGGER `after_insert_penjualan` AFTER INSERT ON `penjualan` FOR EACH ROW UPDATE buku SET
buku.stok =  buku.stok - new.jumlah
WHERE buku.idbuku = new.idbuku
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_grafik_penjualan`
--
CREATE TABLE `v_grafik_penjualan` (
`jumlah` decimal(25,0)
,`bulan` int(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pasok`
--
CREATE TABLE `v_pasok` (
`idpasok` int(11)
,`idbuku` varchar(10)
,`iddistributor` varchar(10)
,`jumlah` tinyint(4)
,`tanggal` datetime
,`stok` tinyint(4)
,`diskon` decimal(3,1)
,`ppn` decimal(3,1)
,`harga_pokok` int(3)
,`harga_jual` int(3)
,`judul` varchar(90)
,`namadistributor` varchar(65)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penjualan`
--
CREATE TABLE `v_penjualan` (
`idpenjualan` int(11)
,`idbuku` varchar(10)
,`idkasir` varchar(65)
,`jumlah` tinyint(4)
,`total` int(3)
,`tanggal` datetime
,`judul` varchar(90)
,`nama` varchar(65)
);

-- --------------------------------------------------------

--
-- Structure for view `v_grafik_penjualan`
--
DROP TABLE IF EXISTS `v_grafik_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_grafik_penjualan`  AS  select sum(`pasok`.`jumlah`) AS `jumlah`,month(`pasok`.`tanggal`) AS `bulan` from `pasok` where (year(`pasok`.`tanggal`) = year(`pasok`.`tanggal`)) group by month(`pasok`.`tanggal`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_pasok`
--
DROP TABLE IF EXISTS `v_pasok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pasok`  AS  select `pasok`.`idpasok` AS `idpasok`,`pasok`.`idbuku` AS `idbuku`,`pasok`.`iddistributor` AS `iddistributor`,`pasok`.`jumlah` AS `jumlah`,`pasok`.`tanggal` AS `tanggal`,`buku`.`stok` AS `stok`,`buku`.`diskon` AS `diskon`,`buku`.`ppn` AS `ppn`,`buku`.`harga_pokok` AS `harga_pokok`,`buku`.`harga_jual` AS `harga_jual`,`buku`.`judul` AS `judul`,`distributor`.`namadistributor` AS `namadistributor` from ((`pasok` join `buku` on((`buku`.`idbuku` = `pasok`.`idbuku`))) join `distributor` on((`distributor`.`iddistributor` = `pasok`.`iddistributor`))) order by `buku`.`judul` ;

-- --------------------------------------------------------

--
-- Structure for view `v_penjualan`
--
DROP TABLE IF EXISTS `v_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualan`  AS  select `penjualan`.`idpenjualan` AS `idpenjualan`,`penjualan`.`idbuku` AS `idbuku`,`penjualan`.`idkasir` AS `idkasir`,`penjualan`.`jumlah` AS `jumlah`,`penjualan`.`total` AS `total`,`penjualan`.`tanggal` AS `tanggal`,`buku`.`judul` AS `judul`,`kasir`.`nama` AS `nama` from ((`penjualan` join `buku` on((`buku`.`idbuku` = `penjualan`.`idbuku`))) join `kasir` on((`kasir`.`username` = `penjualan`.`idkasir`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`idbuku`),
  ADD KEY `iddistributor` (`iddistributor`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`iddistributor`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pasok`
--
ALTER TABLE `pasok`
  ADD PRIMARY KEY (`idpasok`),
  ADD KEY `fk_pasok_distributor_idx` (`iddistributor`),
  ADD KEY `fk_pasok_buku1_idx` (`idbuku`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idpenjualan`),
  ADD KEY `fk_penjualan_kasir1_idx` (`idkasir`),
  ADD KEY `fk_penjualan_buku1_idx` (`idbuku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasok`
--
ALTER TABLE `pasok`
  MODIFY `idpasok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `idpenjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`iddistributor`) REFERENCES `distributor` (`iddistributor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pasok`
--
ALTER TABLE `pasok`
  ADD CONSTRAINT `fk_pasok_buku1` FOREIGN KEY (`idbuku`) REFERENCES `buku` (`idbuku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pasok_distributor` FOREIGN KEY (`iddistributor`) REFERENCES `distributor` (`iddistributor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `fk_penjualan_buku1` FOREIGN KEY (`idbuku`) REFERENCES `buku` (`idbuku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_penjualan_kasir1` FOREIGN KEY (`idkasir`) REFERENCES `kasir` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
