-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 09:34 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlnhansu`
--

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `maCV` char(15) NOT NULL,
  `tenCV` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`maCV`, `tenCV`) VALUES
('BV', 'Bảo Vệ'),
('GV', 'Giáo Viên'),
('HT', 'Hiệu Trưởng'),
('LC', 'Lao Công'),
('PHT', 'Phó Hiệu Trưởng'),
('QL', 'Quản lý'),
('TN', 'Thu Ngân'),
('VS', 'Vệ Sinh');

-- --------------------------------------------------------

--
-- Table structure for table `luong`
--

CREATE TABLE `luong` (
  `id` int(6) NOT NULL,
  `heSoLuong` float UNSIGNED DEFAULT NULL,
  `maCV` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `luong`
--

INSERT INTO `luong` (`id`, `heSoLuong`, `maCV`) VALUES
(1, 6.2, 'LC'),
(2, 6.56, 'BV'),
(3, 6.92, 'GV'),
(4, 7.28, 'PHT'),
(5, 7.64, 'HT'),
(6, 7, 'TN'),
(7, 7, 'QL'),
(8, 6.5, 'VS');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `msnv` int(6) UNSIGNED NOT NULL,
  `hoten` varchar(45) DEFAULT NULL,
  `gioiTinh` char(3) DEFAULT NULL,
  `ngaySinh` date DEFAULT NULL,
  `noiSinh` varchar(40) DEFAULT NULL,
  `diaChi` varchar(100) DEFAULT NULL,
  `sdt` text DEFAULT NULL,
  `maCV` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`msnv`, `hoten`, `gioiTinh`, `ngaySinh`, `noiSinh`, `diaChi`, `sdt`, `maCV`) VALUES
(100001, 'Nguyễn Văn A', 'Nam', '2001-12-07', 'Bạc Liêu', '232, Nguyễn Văn Khéo, Q. Ninh Kiều, TPCT', '0123456787', 'HT'),
(100002, 'Nguyễn Văn B', 'Nữ', '2001-01-20', 'Cần Thơ', '232, Nguyễn Văn Khéo, Q. Ninh Kiều, TPCT', '0123456789', 'PHT'),
(100003, 'Nguyễn Văn C', 'Nữ', '2001-07-01', 'Cần Thơ', '02, Đại lộ Hòa Bình, Q. Ninh Kiều, TPCT', '0123456789', 'GV'),
(100004, 'Trần Văn A', 'Nữ', '2002-05-25', 'Sóc Trăng', '343, Đường 30/4, Q/ Ninh Kiều, TPCT', '0123456789', 'GV'),
(100005, 'Trần Văn B', 'Nữ', '2002-03-02', 'Cần Thơ', '123, Trần Hưng Đạo, Q. Ninh Kiều, TPCT', '0123456789', 'GV'),
(100006, 'Trần Văn C', 'Nam', '2001-11-05', 'Vĩnh Long', '232, Nguyễn Văn Khéo, Q. Ninh Kiều, TPCT', '0123456789', 'BV'),
(100007, 'Nguyễn Thị A', 'Nam', '2003-05-10', 'Kiên Giang', '232, Nguyễn Văn Khéo, Q. Ninh Kiều, TPCT', '123456789', 'LC'),
(100008, 'Nguyễn Thị B', 'Nữ', '2003-10-20', 'Kiên Giang', '177, Đường 3/2, Q. Ninh Kiều, TPCT', '123456788', 'LC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`maCV`);

--
-- Indexes for table `luong`
--
ALTER TABLE `luong`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maCV` (`maCV`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`msnv`),
  ADD KEY `maCV` (`maCV`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `luong`
--
ALTER TABLE `luong`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `msnv` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100013;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `luong`
--
ALTER TABLE `luong`
  ADD CONSTRAINT `luong_ibfk_1` FOREIGN KEY (`maCV`) REFERENCES `chucvu` (`maCV`);

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`maCV`) REFERENCES `chucvu` (`maCV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
