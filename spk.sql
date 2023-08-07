-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2023 at 04:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `saw_alternatif`
--

CREATE TABLE `saw_alternatif` (
  `id` int(11) NOT NULL,
  `nama_alternatif` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saw_alternatif`
--

INSERT INTO `saw_alternatif` (`id`, `nama_alternatif`) VALUES
(10, 'wardah'),
(13, 'emina'),
(18, 'erha');

-- --------------------------------------------------------

--
-- Table structure for table `saw_hasil`
--

CREATE TABLE `saw_hasil` (
  `id` int(10) NOT NULL,
  `tanggal_penghitungan` date DEFAULT NULL,
  `alternatif_terpilih` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saw_hasil`
--

INSERT INTO `saw_hasil` (`id`, `tanggal_penghitungan`, `alternatif_terpilih`) VALUES
(2, '2023-07-23', 'Body Shop'),
(4, '2023-07-24', 'Kahf'),
(5, '2023-07-24', 'Somethic'),
(9, '2023-07-24', 'wardah'),
(10, '2023-07-25', 'wardah'),
(12, '2023-07-27', 'Kahf'),
(13, '2023-07-29', 'wardah'),
(14, '2023-07-31', 'Sabun'),
(15, '2023-08-01', 'Make Over'),
(16, '2023-08-01', 'Make Over'),
(17, '2023-08-05', 'skintific'),
(18, '2023-08-05', 'emina');

-- --------------------------------------------------------

--
-- Table structure for table `saw_kriteria`
--

CREATE TABLE `saw_kriteria` (
  `id` int(20) NOT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `penjelasan_kriteria` varchar(100) DEFAULT NULL,
  `bobot_kriteria` varchar(10) DEFAULT NULL,
  `kategori_bobot` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saw_kriteria`
--

INSERT INTO `saw_kriteria` (`id`, `nama_kriteria`, `penjelasan_kriteria`, `bobot_kriteria`, `kategori_bobot`) VALUES
(3, 'Review Influlencer', 'Semakin banyak rewiewn dan bagus hasil reviewnya semakin tertarik unutk beli', '0.2', 'Benefit'),
(5, 'Manfaat', 'Harus sesuai dengan manfaat yang tertera di produk', '0.25', 'Benefit'),
(6, 'Harga', 'Semakin murah semakin mau dibeli', '0.15', 'Cost');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saw_alternatif`
--
ALTER TABLE `saw_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saw_hasil`
--
ALTER TABLE `saw_hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saw_kriteria`
--
ALTER TABLE `saw_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saw_alternatif`
--
ALTER TABLE `saw_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `saw_hasil`
--
ALTER TABLE `saw_hasil`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `saw_kriteria`
--
ALTER TABLE `saw_kriteria`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
