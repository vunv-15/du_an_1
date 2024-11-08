-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2024 at 02:22 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `du_an_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `binh_luans`
--

CREATE TABLE `binh_luans` (
  `ma_binh_luan` int NOT NULL,
  `ma_nguoi_dung` int NOT NULL,
  `ma_sach` int NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_tao` timestamp NOT NULL,
  `ngay_cap_nhat` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `ma_ban_ghi` int NOT NULL,
  `ma_don_hang` int NOT NULL,
  `ma_sach` int NOT NULL,
  `so_luong` int NOT NULL,
  `gia_thoi_diem_dat_hang` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_gio_hangs`
--

CREATE TABLE `chi_tiet_gio_hangs` (
  `ma_chi_tiet_gio_hang` int NOT NULL,
  `gio_hang` int NOT NULL,
  `ma_sach` int NOT NULL,
  `so_luong_gio_hang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `ma_danh_muc` int NOT NULL,
  `ten_danh_muc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `don_hangs`
--

CREATE TABLE `don_hangs` (
  `ma_don_hang` int NOT NULL,
  `ma_nguoi_dung` int NOT NULL,
  `ngay_dat_hang` timestamp NOT NULL,
  `tong_gia_tri` decimal(10,2) NOT NULL,
  `trang_thai_giao` enum('pending','shipped','delivered','returned') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dia_chi_giao_hang` text,
  `ngay_tao` timestamp NOT NULL,
  `ngay_cap_nhat` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gio_hangs`
--

CREATE TABLE `gio_hangs` (
  `ma_gio_hang` int NOT NULL,
  `ma_nguoi_dung` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khach_hangs`
--

CREATE TABLE `khach_hangs` (
  `ma_nguoi_dung` int NOT NULL,
  `ten_dang_nhap` varchar(50) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `ho_ten` varchar(255) DEFAULT NULL,
  `dia_chi_email` varchar(255) NOT NULL,
  `dia_chi_nguoi_dung` varchar(255) DEFAULT NULL,
  `sdt_nguoi_dung` varchar(20) DEFAULT NULL,
  `phan_quyen` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sachs`
--

CREATE TABLE `sachs` (
  `ma_sach` int NOT NULL,
  `ten_sach` varchar(255) NOT NULL,
  `anh` varchar(255) NOT NULL,
  `nha_xuat_ban` varchar(255) NOT NULL,
  `gia_sach` decimal(10,0) NOT NULL,
  `trong_luong` varchar(255) NOT NULL,
  `kich_thuoc` varchar(255) NOT NULL,
  `so_trang` int NOT NULL,
  `so_luong_ton_kho` int NOT NULL,
  `ngay_xuat_ban` date NOT NULL,
  `mo_ta` text NOT NULL,
  `id_tac_gia` int NOT NULL,
  `id_the_loai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tac_gias`
--

CREATE TABLE `tac_gias` (
  `ma_tac_gia` int NOT NULL,
  `ten_tac_gia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `the_loais`
--

CREATE TABLE `the_loais` (
  `ma_the_loai` int NOT NULL,
  `ten_the_loai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trang_thais`
--

CREATE TABLE `trang_thais` (
  `ma_trang_thai` int NOT NULL,
  `ten_trang_thai` varchar(50) NOT NULL,
  `mo_ta_trang_thai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD PRIMARY KEY (`ma_binh_luan`);

--
-- Indexes for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`ma_ban_ghi`);

--
-- Indexes for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD PRIMARY KEY (`ma_chi_tiet_gio_hang`);

--
-- Indexes for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`ma_danh_muc`);

--
-- Indexes for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`ma_don_hang`);

--
-- Indexes for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD PRIMARY KEY (`ma_gio_hang`);

--
-- Indexes for table `khach_hangs`
--
ALTER TABLE `khach_hangs`
  ADD PRIMARY KEY (`ma_nguoi_dung`),
  ADD UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`),
  ADD UNIQUE KEY `dia_chi_email` (`dia_chi_email`);

--
-- Indexes for table `sachs`
--
ALTER TABLE `sachs`
  ADD PRIMARY KEY (`ma_sach`);

--
-- Indexes for table `tac_gias`
--
ALTER TABLE `tac_gias`
  ADD PRIMARY KEY (`ma_tac_gia`);

--
-- Indexes for table `the_loais`
--
ALTER TABLE `the_loais`
  ADD UNIQUE KEY `ten_the_loai` (`ten_the_loai`);

--
-- Indexes for table `trang_thais`
--
ALTER TABLE `trang_thais`
  ADD PRIMARY KEY (`ma_trang_thai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binh_luans`
--
ALTER TABLE `binh_luans`
  MODIFY `ma_binh_luan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `ma_ban_ghi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `ma_chi_tiet_gio_hang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `ma_danh_muc` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `ma_don_hang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `ma_gio_hang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khach_hangs`
--
ALTER TABLE `khach_hangs`
  MODIFY `ma_nguoi_dung` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sachs`
--
ALTER TABLE `sachs`
  MODIFY `ma_sach` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tac_gias`
--
ALTER TABLE `tac_gias`
  MODIFY `ma_tac_gia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trang_thais`
--
ALTER TABLE `trang_thais`
  MODIFY `ma_trang_thai` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
