-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2024 年 07 月 23 日 00:08
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
(7, 'root@vtc.com', '$2y$10$Uail/0i.ux1VzT336jPqfuEwa7gRqUByH4pF6hkYxLYy74y/w/i.O', 'Vincent', '86-12312123123123', '86-12312312312', 'asdasd');

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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(63, 34, 300001, 2),
(64, 36, 400003, 3),
(65, 37, 200003, 15),
(66, 38, 100003, 1),
(67, 38, 100004, 1),
(68, 38, 100005, 1),
(69, 38, 200001, 1),
(70, 38, 200002, 1),
(71, 38, 200003, 1),
(72, 38, 200004, 1),
(73, 38, 200005, 2),
(74, 38, 300001, 1),
(75, 38, 300002, 1),
(76, 38, 300003, 1),
(77, 38, 300004, 1),
(78, 38, 300005, 1),
(79, 38, 400001, 1),
(80, 38, 400002, 1),
(81, 38, 400003, 1),
(82, 38, 400004, 1),
(83, 38, 400005, 1),
(84, 39, 400004, 1),
(85, 40, 400003, 1),
(86, 41, 100004, 1);

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
  `deliveryDate` timestamp NULL DEFAULT NULL,
  `orderPrice` float DEFAULT '0',
  `salesManagerID` mediumint DEFAULT NULL,
  PRIMARY KEY (`orderID`),
  KEY `dealer` (`dealerID`),
  KEY `salesManager` (`salesManagerID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `orders`
--

TRUNCATE TABLE `orders`;
--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`orderID`, `dealerID`, `orderStatus`, `deliveryAddress`, `orderDateTime`, `deliveryDate`, `orderPrice`, `salesManagerID`) VALUES
(15, 7, 2, 'aaa', '2024-07-21 04:56:13', '2024-07-23 16:00:00', 168820, 1),
(16, 7, 1, 'aaa', '2024-07-21 04:56:24', NULL, 1915.99, 1),
(17, 7, 1, 'aaa', '2024-07-21 04:56:18', NULL, 1450, 1),
(18, 7, 1, 'aaa', '2024-07-21 04:56:27', NULL, 1450, 1),
(19, 7, 1, 'aaa', '2024-07-21 04:56:30', NULL, 1450, 1),
(20, 7, 1, 'aaa', '2024-07-17 05:24:18', NULL, 1450, 1),
(21, 7, 1, 'aaa', '2024-07-17 05:24:21', NULL, 1450, 1),
(22, 7, 1, 'aaa', '2024-07-17 05:24:50', NULL, 832.49, 1),
(23, 7, 1, 'aaa', '2024-07-20 16:25:29', NULL, 424.98, 1),
(24, 7, 1, 'aaa', '2024-07-17 15:37:37', NULL, 1190.98, 1),
(25, 7, 1, 'aaa', '2024-07-17 15:37:41', NULL, 975.99, NULL),
(26, 7, 1, 'aaa', '2024-07-17 15:37:44', NULL, 312.99, 1),
(27, 7, 1, 'aaa', '2024-07-17 15:37:46', NULL, 308.49, 1),
(28, 7, 1, 'aaa', '2024-07-17 15:37:49', NULL, 315.99, 1),
(29, 7, 1, 'aaa', '2024-07-20 16:25:36', NULL, 529, 1),
(30, 7, 1, 'aaa', '2024-07-17 15:38:12', NULL, 2049, NULL),
(31, 7, 1, 'aaa', '2024-07-17 15:38:20', NULL, 14320, 1),
(32, 7, 2, 'aaa', '2024-07-19 03:06:01', NULL, 7280, 1),
(33, 7, 2, 'aaa', '2024-07-19 03:15:29', NULL, 1396, 1),
(34, 7, 2, 'asdasd', '2024-07-19 07:57:45', NULL, 6573.84, 1),
(35, 7, 2, 'aaa', '2024-07-20 16:25:33', NULL, 308.49, 1),
(36, 7, 2, 'asdasd', '2024-07-21 05:47:23', '2024-07-23 09:00:00', 2352, 1),
(37, 7, 2, 'asdasd', '2024-07-22 12:20:52', '2024-07-23 09:00:00', 11279.8, 1),
(38, 7, 2, 'asdasd', '2024-07-22 13:09:10', '2024-07-24 01:00:00', 43775.4, 1),
(39, 7, 6, 'asdasd', '2024-07-22 13:39:12', NULL, 2183, 1),
(40, 7, 1, 'asdasd', '2024-07-22 13:39:31', NULL, 2544, 1),
(41, 7, 2, 'asdasd', '2024-07-22 13:44:23', NULL, 945.99, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `salesmanager`
--

DROP TABLE IF EXISTS `salesmanager`;
CREATE TABLE IF NOT EXISTS `salesmanager` (
  `salesManagerID` mediumint NOT NULL AUTO_INCREMENT,
  `managerEmail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `managerName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contactName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contactNumber` int DEFAULT NULL,
  PRIMARY KEY (`salesManagerID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `salesmanager`
--

TRUNCATE TABLE `salesmanager`;
--
-- 傾印資料表的資料 `salesmanager`
--

INSERT INTO `salesmanager` ( `managerEmail`, `password`, `managerName`, `contactName`, `contactNumber`) VALUES
('john.doe@lmc.com', '$2y$10$Uail/0i.ux1VzT336jPqfuEwa7gRqUByH4pF6hkYxLYy74y/w/i.O', 'john.doe', 'john.doe', 12345678),
('vincent.tam@lmc.com', '$2y$10$Uail/0i.ux1VzT336jPqfuEwa7gRqUByH4pF6hkYxLYy74y/w/i.O', 'vincent.tam', 'vincent.tam', 11111111),
('ken.lau@lmc.com', '$2y$10$Uail/0i.ux1VzT336jPqfuEwa7gRqUByH4pF6hkYxLYy74y/w/i.O', 'ken.lau', 'ken.lau', 22222222),
('navis.chan@lmc.com', '$2y$10$Uail/0i.ux1VzT336jPqfuEwa7gRqUByH4pF6hkYxLYy74y/w/i.O', 'navis.chan', 'navis.chan', 22222222);


-- --------------------------------------------------------
DROP TABLE IF EXISTS `managerhead`;
CREATE TABLE IF NOT EXISTS `managerhead` (
  `salesManagerID` mediumint NOT NULL,
  `headPermission` tinyint DEFAULT NULL,
  PRIMARY KEY (`salesManagerID`),
  KEY `salesmanager` (`salesManagerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE TABLE `managerhead`;
--
-- 傾印資料表的資料 `salesmanager`
--

INSERT INTO `managerhead` (salesManagerID,headPermission ) VALUES
(1,1),
(2,1);

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
(100002, 'Galvanized Steel Sheet', 'A durable galvanized steel sheet suitable for various industrial applications.', 1000, 10, 25, 12, '../assets/img/100002.jpg'),
(100003, 'Aluminum Alloy Sheet', 'High-strength aluminum alloy sheet with excellent corrosion resistance.', 993, 11, 32.49, 30, '../assets/img/100003.jpg'),
(100004, 'Cold Rolled Steel Sheet', 'Precision cold rolled steel sheet, ideal for precision components.', 996, 13, 45.99, 44, '../assets/img/100004.jpg'),
(100005, 'Copper Sheet', 'Premium-grade copper sheet with high thermal and electrical conductivity.', 994, 13, 38.99, NULL, '../assets/img/100005.jpg'),
(200001, 'Gearbox Assembly', 'Robust gearbox assembly designed for high-torque applications.', 999, 12.5, 325.99, 200.4, '../assets/img/200001.jpg'),
(200002, 'Hydraulic Pump Assembly', 'Efficient hydraulic pump assembly for fluid power systems.', 999, 8.2, 415.49, 399.2, '../assets/img/200002.jpg'),
(200003, 'Engine Block Assembly 1', 'High-quality engine block assembly, providing exceptional performance.', 984, 14, 675.99, 499, '../assets/img/200003.jpg'),
(200004, 'Engine Block Assembly 2', 'Durable engine block assembly engineered for longevity.', 992, 15, 300, NULL, '../assets/img/200004.jpg'),
(200005, 'Engine Block Assembly 3', 'Precision-engineered engine block assembly for high-performance vehicles.', 993, 16, 400, NULL, '../assets/img/200005.jpg'),
(300001, 'Aluminum Castings', 'Versatile aluminum castings known for their lightweight and strength.', 997, 55, 12.99, NULL, '../assets/img/300001.jpg'),
(300002, 'Plastic Injection Moldings', 'High-precision plastic injection moldings for complex shapes and designs.', 999, 44, 8.49, NULL, '../assets/img/300002.jpg'),
(300003, 'Machined Brass Components 1', 'Custom machined brass components for specialized industrial use.', 999, 33, 15.99, 15.98, '../assets/img/300003.jpg'),
(300004, 'Machined Brass Components 2', 'Precision-crafted brass components designed for durability and consistency.', 999, 22, 229, 228, '../assets/img/300004.jpg'),
(300005, 'Machined Brass Components 3', 'High-grade machined brass components for demanding applications.', 999, 11, 1249, NULL, '../assets/img/300005.jpg'),
(400001, 'Rubber Gaskets', 'Sealing rubber gaskets designed for leak-proof connections.', 999, 55, 33123, NULL, '../assets/img/400001.jpg'),
(400002, 'Plastic Hoses', 'Flexible plastic hoses resistant to wear and varying temperatures.', 999, 44, 4123, NULL, '../assets/img/400002.jpg'),
(400003, 'Adhesive Tapes 1', 'Strong adhesive tapes for secure bonding in various applications.', 996, 33, 644, NULL, '../assets/img/400003.jpg'),
(400004, 'Adhesive Tapes 2', 'Durable adhesive tapes designed for heavy-duty adhesion.', 999, 32, 333, NULL, '../assets/img/400004.jpg'),
(400005, 'Adhesive Tapes 3', 'Multipurpose adhesive tapes suitable for a range of industrial uses.', 999, 31, 22, NULL, '../assets/img/400005.jpg');

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
