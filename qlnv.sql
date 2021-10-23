-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2021 lúc 10:47 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlnv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loainv`
--

CREATE TABLE `loainv` (
  `MALOAINV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TENLOAINV` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loainv`
--

INSERT INTO `loainv` (`MALOAINV`, `TENLOAINV`) VALUES
('LNV01', 'Giám đốc'),
('LNV02', 'Thư ký'),
('LNV03', 'Nhân viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MANV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `HO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `TEN` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `NGAYSINH` date NOT NULL,
  `GIOITINH` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `DIACHI` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ANH` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `MALOAINV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MAPHONG` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MANV`, `HO`, `TEN`, `NGAYSINH`, `GIOITINH`, `DIACHI`, `ANH`, `MALOAINV`, `MAPHONG`) VALUES
('NV01', 'Tôn', 'A', '2003-01-01', 'Nam', 'VN', '', 'LNV01', 'PB01'),
('NV02', 'Tôn', 'B', '2003-02-02', 'Nam', 'VN', '', 'LNV02', 'PB02'),
('NV03', 'Tôn', 'C', '1999-04-04', 'Nam', 'VN', '', 'LNV03', 'PB03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongban`
--

CREATE TABLE `phongban` (
  `MAPHONG` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TENPHONG` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phongban`
--

INSERT INTO `phongban` (`MAPHONG`, `TENPHONG`) VALUES
('PB01', 'Coder'),
('PB02', 'Tester'),
('PB03', 'Looter');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `loainv`
--
ALTER TABLE `loainv`
  ADD PRIMARY KEY (`MALOAINV`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MANV`),
  ADD KEY `fk_NV_LNV_1` (`MALOAINV`),
  ADD KEY `fk_NV_PB_1` (`MAPHONG`);

--
-- Chỉ mục cho bảng `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`MAPHONG`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `fk_NV_LNV_1` FOREIGN KEY (`MALOAINV`) REFERENCES `loainv` (`MALOAINV`),
  ADD CONSTRAINT `fk_NV_PB_1` FOREIGN KEY (`MAPHONG`) REFERENCES `phongban` (`MAPHONG`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
