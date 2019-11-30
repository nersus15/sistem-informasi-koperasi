-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2019 at 04:31 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `nik` varchar(13) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tanggal_lahir` varchar(25) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `ktp` varchar(50) NOT NULL,
  `account` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`nik`, `nama_lengkap`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `ktp`, `account`) VALUES
('123', 'afa', 'fafa', '1577116800', 'Perempuan', 'ktp123.jpeg', '@123'),
('1710530203', 'Fathurrahman', 'Lotim', '935424000', 'Laki-laki', 'ktp1710530203.jpeg', '@1710530203');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `nomer_transaksi` int(5) NOT NULL,
  `pinjaman` int(5) DEFAULT NULL,
  `anggota` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penarikan`
--

CREATE TABLE `penarikan` (
  `nomer_transaksi` int(5) NOT NULL,
  `anggota` varchar(13) CHARACTER SET latin1 DEFAULT NULL,
  `tgl_penarikan` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `jumlah` int(15) DEFAULT NULL,
  `status` varchar(25) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `nomer_transaksi` int(5) NOT NULL,
  `anggota` varchar(13) DEFAULT NULL,
  `jumlah` int(15) DEFAULT NULL,
  `tgl_pinjam` varchar(25) DEFAULT NULL,
  `tenggat` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `simpanan_sukarela`
--

CREATE TABLE `simpanan_sukarela` (
  `nomer_transaksi` int(5) NOT NULL,
  `anggota` varchar(13) CHARACTER SET latin1 DEFAULT NULL,
  `tgl_nabung` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `jumlah` int(15) DEFAULT NULL,
  `saldo_sebelumnya` int(15) NOT NULL,
  `saldo` int(15) DEFAULT NULL,
  `status` varchar(25) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simpanan_sukarela`
--

INSERT INTO `simpanan_sukarela` (`nomer_transaksi`, `anggota`, `tgl_nabung`, `jumlah`, `saldo_sebelumnya`, `saldo`, `status`) VALUES
(26, '123', '1575084572', 10000, 0, 10000, 'Menunggu Konfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `img` varchar(50) NOT NULL,
  `role` int(2) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `img`, `role`, `status`) VALUES
('@123', 'm@mail.com', '$2y$10$Lc9EI/4YpRDcbbbTE5iGPOMTHG4Lf8XxrEq24b4wcjyYmbXwAHg36', 'defaultP.jpg', 2, 1),
('@1710530203', 'fathur.pashter15@gmail.com', '$2y$10$di.QnhJpcy77usx93zpANu.5iBAj.qs2xd0Gfj5EfZNLhjjm.tnTe', 'defaultL.jpg', 2, 1),
('fathur', 'fathur.ashter15@gmail.com', '$2y$10$rONYvHAqcnptthrIJztb6eYhYQcWf86iA3S2Z1sFxEiVph76Dn/xC', '5d97f51bc7295.png', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `account` (`account`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`nomer_transaksi`);

--
-- Indexes for table `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`nomer_transaksi`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`nomer_transaksi`);

--
-- Indexes for table `simpanan_sukarela`
--
ALTER TABLE `simpanan_sukarela`
  ADD PRIMARY KEY (`nomer_transaksi`),
  ADD KEY `anggota` (`anggota`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `nomer_transaksi` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `nomer_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `nomer_transaksi` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `simpanan_sukarela`
--
ALTER TABLE `simpanan_sukarela`
  MODIFY `nomer_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`account`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simpanan_sukarela`
--
ALTER TABLE `simpanan_sukarela`
  ADD CONSTRAINT `simpanan_sukarela_ibfk_1` FOREIGN KEY (`anggota`) REFERENCES `member` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
