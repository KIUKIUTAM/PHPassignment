-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2024 年 07 月 16 日 14:49
-- 伺服器版本： 8.0.37
-- PHP 版本： 8.2.18

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `projectdb`
--
CREATE DATABASE IF NOT EXISTS `projectdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projectdb`;

-- --------------------------------------------------------

--
-- 資料表結構 `dealer`
--

DROP TABLE IF EXISTS `dealer`;
CREATE TABLE IF NOT EXISTS `dealer` (
  `dealerID` mediumint NOT NULL AUTO_INCREMENT,
  `dealerEmail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dealerName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contactNumber` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `faxNumber` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deliveryAddress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`dealerID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `dealer`
--

TRUNCATE TABLE `dealer`;
--
-- 傾印資料表的資料 `dealer`
--

INSERT INTO `dealer` (`dealerID`, `dealerEmail`, `password`, `dealerName`, `contactNumber`, `faxNumber`, `deliveryAddress`) VALUES
(1, 'abcmotors@gmail.com', 'Aa1234567', 'ABC_Motors', '22345678', NULL, '123 Main Street, Hong Kong'),
(4, '230501558V2@vtc.com', '$2y$10$wIeevM3gG3lZ6hVYeJz/YexBl9fQ4.sttn9y/O0IHSMLh6F9vu2Jm', NULL, NULL, NULL, NULL),
(6, '230501558@vtc.com', '$2y$10$4awZTibwTPs1VUHtKQcS3.s84AlQI6BxF0FTm0b8Pc.DynBcxI9sq', 'Vincent', '852-123123123', '886-12345678', 'HOWARD FACTORY');

-- --------------------------------------------------------

--
-- 資料表結構 `orderline`
--

DROP TABLE IF EXISTS `orderline`;
CREATE TABLE IF NOT EXISTS `orderline` (
  `orderLineID` mediumint NOT NULL AUTO_INCREMENT,
  `orderID` mediumint NOT NULL,
  `sparePartNum` mediumint NOT NULL,
  `orderQty` smallint NOT NULL,
  PRIMARY KEY (`orderLineID`),
  KEY `orders` (`orderID`),
  KEY `sparePart` (`sparePartNum`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `orderline`
--

TRUNCATE TABLE `orderline`;
--
-- 傾印資料表的資料 `orderline`
--

INSERT INTO `orderline` (`orderLineID`, `orderID`, `sparePartNum`, `orderQty`) VALUES
(1, 1, 100002, 5),
(2, 1, 100003, 3),
(7, 6, 200001, 81),
(8, 7, 300002, 5),
(9, 8, 200001, 7),
(10, 8, 300005, 7),
(11, 9, 100004, 8),
(12, 10, 400003, 4),
(13, 11, 300004, 5),
(14, 12, 200002, 135),
(15, 12, 200004, 28),
(16, 12, 400001, 12),
(17, 13, 100002, 1),
(18, 13, 100003, 1),
(19, 13, 100004, 1),
(20, 13, 100005, 2),
(21, 13, 200001, 1),
(22, 13, 200002, 1),
(23, 13, 200003, 1),
(24, 13, 200004, 1),
(25, 13, 200005, 1),
(26, 13, 300001, 1),
(27, 13, 300002, 1),
(28, 13, 300003, 1),
(29, 13, 300004, 1),
(30, 13, 300005, 1),
(31, 13, 400001, 4),
(32, 13, 400002, 2),
(33, 13, 400003, 2),
(34, 13, 400004, 1),
(35, 13, 400005, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` mediumint NOT NULL AUTO_INCREMENT,
  `dealerID` mediumint NOT NULL,
  `orderStatus` tinyint NOT NULL DEFAULT '0',
  `deliveryAddress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `orderDateTime` timestamp NOT NULL,
  `deliveryDate` date DEFAULT NULL,
  `orderPrice` float DEFAULT '0',
  `salesManagerID` mediumint DEFAULT NULL,
  `requestCancelStatus` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`orderID`),
  KEY `dealer` (`dealerID`),
  KEY `salesManager` (`salesManagerID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `orders`
--

TRUNCATE TABLE `orders`;
--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`orderID`, `dealerID`, `orderStatus`, `deliveryAddress`, `orderDateTime`, `deliveryDate`, `orderPrice`, `salesManagerID`, `requestCancelStatus`) VALUES
(1, 1, 1, '123 Main Street, Hong Kong', '2024-07-08 00:00:00', '2024-07-09', 0, NULL, 0),
(6, 6, 1, 'HOWARD FACTORY BUILDING HOWARD FACTORY BUILDING, 66 TSUN YIP STREET KOWLOON KWUN TONG ', '2024-07-15 09:01:25', NULL, 26405.2, NULL, 1),
(7, 6, 1, 'HOWARD FACTORY BUILDING HOWARD FACTORY BUILDING, 66 TSUN YIP STREET KOWLOON KWUN TONG ', '2024-07-15 09:09:18', NULL, 42.45, NULL, 1),
(8, 6, 1, 'HOWARD FACTORY BUILDING HOWARD FACTORY BUILDING, 66 TSUN YIP STREET KOWLOON KWUN TONG ', '2024-07-15 09:10:23', NULL, 11024.9, NULL, 0),
(9, 6, 1, 'HOWARD FACTORY BUILDING HOWARD FACTORY BUILDING, 66 TSUN YIP STREET KOWLOON KWUN TONG ', '2024-07-15 09:17:03', NULL, 367.92, NULL, 1),
(10, 6, 1, 'HOWARD FACTORY', '2024-07-15 11:31:09', NULL, 2576, NULL, 1),
(11, 6, 1, 'HOWARD FACTORY', '2024-07-15 17:20:48', NULL, 1145, NULL, 0),
(12, 6, 1, 'HOWARD FACTORY', '2024-07-15 17:21:24', NULL, 461967, NULL, 0),
(13, 6, 1, 'HOWARD FACTORY', '2024-07-16 02:41:08', NULL, 146217, NULL, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `salesmanager`
--

DROP TABLE IF EXISTS `salesmanager`;
CREATE TABLE IF NOT EXISTS `salesmanager` (
  `salesManagerID` mediumint NOT NULL AUTO_INCREMENT,
  `managerEmail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `managerName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contactName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contactNumber` int DEFAULT NULL,
  PRIMARY KEY (`salesManagerID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `salesmanager`
--

TRUNCATE TABLE `salesmanager`;
--
-- 傾印資料表的資料 `salesmanager`
--

INSERT INTO `salesmanager` (`salesManagerID`, `managerEmail`, `password`, `managerName`, `contactName`, `contactNumber`) VALUES
(1, 'john.doe@lmc.com', '123', 'john.doe', 'john.doe', 12345678);

-- --------------------------------------------------------

--
-- 資料表結構 `sparepart`
--

DROP TABLE IF EXISTS `sparepart`;
CREATE TABLE IF NOT EXISTS `sparepart` (
  `sparePartNum` mediumint NOT NULL,
  `sparePartName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sparePartDescription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stockItemQty` smallint NOT NULL,
  `weight` float NOT NULL,
  `price` float NOT NULL,
  `discountPrice` float DEFAULT NULL,
  `sparePartImage` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`sparePartNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `sparepart`
--

TRUNCATE TABLE `sparepart`;
--
-- 傾印資料表的資料 `sparepart`
--

INSERT INTO `sparepart` (`sparePartNum`, `sparePartName`, `sparePartDescription`, `stockItemQty`, `weight`, `price`, `discountPrice`, `sparePartImage`) VALUES
(100002, 'Galvanized Steel Sheet', 'A durable galvanized steel sheet suitable for various industrial applications.', 10, 10, 25, 12, '../assets/img/100002.jpg'),
(100003, 'Aluminum Alloy Sheet', 'High-strength aluminum alloy sheet with excellent corrosion resistance.', 1000, 11, 32.49, 30, '../assets/img/100003.jpg'),
(100004, 'Cold Rolled Steel Sheet', 'Precision cold rolled steel sheet, ideal for precision components.', 1000, 13, 45.99, 44, '../assets/img/100004.jpg'),
(100005, 'Copper Sheet', 'Premium-grade copper sheet with high thermal and electrical conductivity.', 1000, 13, 38.99, NULL, '../assets/img/100005.jpg'),
(200001, 'Gearbox Assembly', 'Robust gearbox assembly designed for high-torque applications.', 1000, 12.5, 325.99, 200.4, '../assets/img/200001.jpg'),
(200002, 'Hydraulic Pump Assembly', 'Efficient hydraulic pump assembly for fluid power systems.', 1000, 8.2, 415.49, 399.2, '../assets/img/200002.jpg'),
(200003, 'Engine Block Assembly 1', 'High-quality engine block assembly, providing exceptional performance.', 1000, 14, 675.99, 499, '../assets/img/200003.jpg'),
(200004, 'Engine Block Assembly 2', 'Durable engine block assembly engineered for longevity.', 1000, 15, 300, NULL, '../assets/img/200004.jpg'),
(200005, 'Engine Block Assembly 3', 'Precision-engineered engine block assembly for high-performance vehicles.', 1000, 16, 400, NULL, '../assets/img/200005.jpg'),
(300001, 'Aluminum Castings', 'Versatile aluminum castings known for their lightweight and strength.', 1000, 55, 12.99, NULL, '../assets/img/300001.jpg'),
(300002, 'Plastic Injection Moldings', 'High-precision plastic injection moldings for complex shapes and designs.', 1000, 44, 8.49, NULL, '../assets/img/300002.jpg'),
(300003, 'Machined Brass Components 1', 'Custom machined brass components for specialized industrial use.', 1000, 33, 15.99, 15.98, '../assets/img/300003.jpg'),
(300004, 'Machined Brass Components 2', 'Precision-crafted brass components designed for durability and consistency.', 1000, 22, 229, 228, '../assets/img/300004.jpg'),
(300005, 'Machined Brass Components 3', 'High-grade machined brass components for demanding applications.', 1000, 11, 1249, NULL, '../assets/img/300005.jpg'),
(400001, 'Rubber Gaskets', 'Sealing rubber gaskets designed for leak-proof connections.', 1000, 55, 33123, NULL, '../assets/img/400001.jpg'),
(400002, 'Plastic Hoses', 'Flexible plastic hoses resistant to wear and varying temperatures.', 1000, 44, 4123, NULL, '../assets/img/400002.jpg'),
(400003, 'Adhesive Tapes 1', 'Strong adhesive tapes for secure bonding in various applications.', 1000, 33, 644, NULL, '../assets/img/400003.jpg'),
(400004, 'Adhesive Tapes 2', 'Durable adhesive tapes designed for heavy-duty adhesion.', 1000, 32, 333, NULL, '../assets/img/400004.jpg'),
(400005, 'Adhesive Tapes 3', 'Multipurpose adhesive tapes suitable for a range of industrial uses.', 1000, 31, 22, NULL, '../assets/img/400005.jpg');

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `orderline_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `orderline_ibfk_2` FOREIGN KEY (`sparePartNum`) REFERENCES `sparepart` (`sparePartNum`);

--
-- 資料表的限制式 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`dealerID`) REFERENCES `dealer` (`dealerID`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
