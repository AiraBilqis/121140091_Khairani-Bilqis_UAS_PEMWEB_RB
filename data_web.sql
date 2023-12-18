-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Des 15, 2023 at 04:22 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data-web`
--
-- Memilih atau membuat basis data phpdasar jika belum ada
CREATE DATABASE IF NOT EXISTS data_web;
USE data_web;
-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL, 
  `jenkel` varchar(12) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nim` int(9) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `semester` int(2) NOT NULL,
  `statusk` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `jenkel`, `tgl_lahir`, `nim`, `prodi`, `semester`, `statusk`, `email`) VALUES
(1, 'Khairani Bilqis', 'Perempuan', '2003-01-11', 121140091, 'Teknik Informatika', 5, 'Aktif', 'khairani.121140091@student.itera.ac.id'),
(2, 'Adib Raihan Mudzaky', 'Laki-Laki', '2001-10-06', 121140210, 'Teknik Informatika', 5, 'Aktif', 'adib.121140210@student.itera.ac.id'),
(3, 'Hasna Dhiya Azizah', 'Perempuan', '2003-04-20', 121140029, 'Teknik Informatika', 5, 'Aktif', 'hasna.121140029@student.itera.ac.id'),
(4, 'Andreyan Renaldi', 'Laki-Laki', '2003-04-08', 121140186, 'Teknik Informatika', 5, 'Aktif', 'andreyan.121140186@student.itera.ac.id'),
(5, 'Umy Afifah', 'Perempuan', '2003-10-26', 121140087, 'Teknik Informatika', 5, 'Aktif', 'umy.121140087@student.itera.ac.id');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `pengguna` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `pengguna` (`username`, `password`) VALUES
('Khairani', '1101-2003');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
