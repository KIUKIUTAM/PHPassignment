-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2024 年 07 月 20 日 08:25
-- 伺服器版本： 8.0.37
-- PHP 版本： 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 'root@vtc.com', '$2y$10$Uail/0i.ux1VzT336jPqfuEwa7gRqUByH4pF6hkYxLYy74y/w/i.O', 'v', '86-12312123123123', '86-12312312312', 'asdasd');

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `orderline`
--

TRUNCATE TABLE `orderline`;
--
-- 傾印資料表的資料 `orderline`
--

INSERT INTO `orderline` (`orderLineID`, `orderID`, `sparePartNum`, `orderQty`) VALUES
(37, 15, 200005, 5),
(38, 15, 300001, 5),
(39, 15, 400001, 5),
(40, 16, 300003, 1),
(41, 17, 200005, 1),
(42, 18, 200005, 1),
(43, 19, 200005, 1),
(44, 20, 200005, 1),
(45, 21, 200005, 1),
(46, 22, 100003, 1),
(47, 23, 100003, 2),
(48, 24, 200002, 2),
(49, 25, 200003, 1),
(50, 26, 300001, 1),
(51, 27, 300002, 1),
(52, 28, 300003, 1),
(53, 29, 300004, 1),
(54, 30, 300005, 1),
(55, 31, 400003, 20),
(56, 32, 400003, 10),
(57, 33, 300004, 4),
(58, 34, 100003, 6),
(59, 34, 100004, 3),
(60, 34, 100005, 5),
(61, 34, 200004, 7),
(62, 34, 200005, 5),
(63, 34, 300001, 2);

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
  PRIMARY KEY (`orderID`),
  KEY `dealer` (`dealerID`),
  KEY `salesManager` (`salesManagerID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `orders`
--

TRUNCATE TABLE `orders`;
--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`orderID`, `dealerID`, `orderStatus`, `deliveryAddress`, `orderDateTime`, `deliveryDate`, `orderPrice`, `salesManagerID`) VALUES
(15, 7, 1, 'aaa', '2024-07-17 05:21:14', NULL, 168820, NULL),
(16, 7, 2, 'aaa', '2024-07-18 12:41:15', NULL, 1915.99, NULL),
(17, 7, 3, 'aaa', '2024-07-18 12:41:22', NULL, 1450, NULL),
(18, 7, 1, 'aaa', '2024-07-17 05:24:15', NULL, 1450, NULL),
(19, 7, 4, 'aaa', '2024-07-18 12:41:24', NULL, 1450, NULL),
(20, 7, 1, 'aaa', '2024-07-17 05:24:18', NULL, 1450, NULL),
(21, 7, 1, 'aaa', '2024-07-17 05:24:21', NULL, 1450, NULL),
(22, 7, 1, 'aaa', '2024-07-17 05:24:50', NULL, 832.49, NULL),
(23, 7, 1, 'aaa', '2024-07-17 15:37:32', NULL, 424.98, NULL),
(24, 7, 1, 'aaa', '2024-07-17 15:37:37', NULL, 1190.98, NULL),
(25, 7, 1, 'aaa', '2024-07-17 15:37:41', NULL, 975.99, NULL),
(26, 7, 1, 'aaa', '2024-07-17 15:37:44', NULL, 312.99, NULL),
(27, 7, 1, 'aaa', '2024-07-17 15:37:46', NULL, 308.49, NULL),
(28, 7, 1, 'aaa', '2024-07-17 15:37:49', NULL, 315.99, NULL),
(29, 7, 1, 'aaa', '2024-07-17 15:37:52', NULL, 529, NULL),
(30, 7, 1, 'aaa', '2024-07-17 15:38:12', NULL, 2049, NULL),
(31, 7, 1, 'aaa', '2024-07-17 15:38:20', NULL, 14320, NULL),
(32, 7, 1, 'aaa', '2024-07-19 03:06:01', NULL, 7280, NULL),
(33, 7, 1, 'aaa', '2024-07-19 03:15:29', NULL, 1396, NULL),
(34, 7, 1, 'asdasd', '2024-07-19 07:57:45', NULL, 6573.84, NULL);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
