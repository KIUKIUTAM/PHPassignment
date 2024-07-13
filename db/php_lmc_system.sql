-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2024 年 07 月 07 日 07:12
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
-- 資料庫： `php_lmc_system`
--
CREATE DATABASE IF NOT EXISTS `php_lmc_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `php_lmc_system`;

-- --------------------------------------------------------

--
-- 資料表結構 `dealer`
--

DROP TABLE IF EXISTS `dealer`;
CREATE TABLE IF NOT EXISTS `dealer` (
  `dealerID` mediumint NOT NULL AUTO_INCREMENT,
  `dealerEmail` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `dealerName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contactName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contactNumber` integer(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `faxNumber` mediumint COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deliveryAddress` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`dealerID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `dealer`
--

TRUNCATE TABLE `dealer`;
--
-- 傾印資料表的資料 `dealer`
--

INSERT INTO `dealer` ( `dealerEmail`,`password`, `dealerName`, `contactName`, `contactNumber`, `faxNumber`, `deliveryAddress`) VALUES
('abcmotors@gmail.com', 'A1234567', 'ABC_Motors','Ken Lau',  '22345678',  NULL, '123 Main Street, Hong Kong');


-- --------------------------------------------------------

--
-- 資料表結構 `salesManager`
--

DROP TABLE IF EXISTS `salesManager`;
CREATE TABLE IF NOT EXISTS `salesManager` (
  `salesManagerID` mediumint NOT NULL AUTO_INCREMENT,
  `managerEmail` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `managerName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contactName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contactNumber` mediumint COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`salesManagerID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `salesManager`
--

TRUNCATE TABLE `salesManager`;
--
-- 傾印資料表的資料 `salesManager`
--

INSERT INTO `salesManager` (`managerEmail`,  `password`, `managerName`, `contactName`, `contactNumber`) VALUES
('john.doe@lmc.com' ,'123', 'john.doe', 'john.doe', 'john.doe');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` mediumint NOT NULL AUTO_INCREMENT,
  `dealerID` mediumint NOT NULL,
  `orderStatus` tinyint NOT NULL DEFAULT '0',
  `deliveryAddress` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `orderDateTime` timestamp NOT NULL,
  `deliveryDate` date DEFAULT NULL,
  `orderPrice` float DEFAULT '0',
  PRIMARY KEY (`orderID`),
  KEY `dealer` (`dealerID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `orders`
--

TRUNCATE TABLE `orders`;
--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` ( `dealerID`, `orderStatus`, `deliveryAddress`, `orderDateTime`, `deliveryDate`,`orderPrice`) VALUES
( 1, 1, '123 Main Street, Hong Kong','20240708000000','20240709', 0);




-- --------------------------------------------------------

--
-- 資料表結構 `sparePart`
--

DROP TABLE IF EXISTS `sparePart`;
CREATE TABLE IF NOT EXISTS `sparePart` (
  `sparePartNum` mediumint NOT NULL,
  `sparePartName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sparePartDescription` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `stockItemQty` smallint NOT NULL,
  `weight` float NOT NULL,
  `price` float NOT NULL,
  `discountPrice` float NULL DEFAULT NULL,
  `sparePartImage` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`sparePartNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `sparePart`
--

TRUNCATE TABLE `sparePart`;
--
-- 傾印資料表的資料 `sparePart`
--

INSERT INTO `sparePart` (`sparePartNum`, `sparePartName`,`sparePartDescription`, `stockItemQty`, `weight`, `price`,`discountPrice`, `sparePartImage`) VALUES
(100002, 'Galvanized Steel Sheet','A durable galvanized steel sheet suitable for various industrial applications.', 1000, 10, 25,12, '../asserts/img/100002.jpg'),
(100003, 'Aluminum Alloy Sheet','High-strength aluminum alloy sheet with excellent corrosion resistance.', 1000, 11, 32.49,30, '../asserts/img/100003.jpg'),
(100004, 'Cold Rolled Steel Sheet','Precision cold rolled steel sheet, ideal for precision components.', 1000, 13, 45.99,44, '../asserts/img/100004.jpg'),
(100005, 'Copper Sheet','Premium-grade copper sheet with high thermal and electrical conductivity.', 1000, 13, 38.99,NULL, '../asserts/img/100005.jpg'),
(200001, 'Gearbox Assembly','Robust gearbox assembly designed for high-torque applications.', 1000, 12.5, 325.99,200.4, '../asserts/img/200001.jpg'),
(200002, 'Hydraulic Pump Assembly','Efficient hydraulic pump assembly for fluid power systems.', 1000, 8.2, 415.49,399.2, '../asserts/img/200002.jpg'),
(200003, 'Engine Block Assembly 1','High-quality engine block assembly, providing exceptional performance.', 1000, 14, 675.99,499.00, '../asserts/img/200003.jpg'),
(200004, 'Engine Block Assembly 2','Durable engine block assembly engineered for longevity.', 1000, 15, 300,NULL, '../asserts/img/200004.jpg'),
(200005, 'Engine Block Assembly 3','Precision-engineered engine block assembly for high-performance vehicles.', 1000, 16, 400,NULL, '../asserts/img/200005.jpg'),
(300001, 'Aluminum Castings','Versatile aluminum castings known for their lightweight and strength.', 1000, 55, 12.99,NULL, '../asserts/img/300001.jpg'),
(300002, 'Plastic Injection Moldings','High-precision plastic injection moldings for complex shapes and designs.', 1000, 44, 8.49,NULL, '../asserts/img/300002.jpg'),
(300003, 'Machined Brass Components 1','Custom machined brass components for specialized industrial use.', 1000, 33, 15.99,15.98, '../asserts/img/300003.jpg'),
(300004, 'Machined Brass Components 2','Precision-crafted brass components designed for durability and consistency.', 1000, 22, 229,228, '../asserts/img/300004.jpg'),
(300005, 'Machined Brass Components 3','High-grade machined brass components for demanding applications.', 1000, 11, 1249,NULL, '../asserts/img/300005.jpg'),
(400001, 'Rubber Gaskets','Sealing rubber gaskets designed for leak-proof connections.', 1000, 55, 33123,NULL, '../asserts/img/400001.jpg'),
(400002, 'Plastic Hoses','Flexible plastic hoses resistant to wear and varying temperatures.', 1000, 44, 4123,NULL, '../asserts/img/400002.jpg'),
(400003, 'Adhesive Tapes 1','Strong adhesive tapes for secure bonding in various applications.', 1000, 33, 644,NULL, '../asserts/img/400003.jpg'),
(400004, 'Adhesive Tapes 2','Durable adhesive tapes designed for heavy-duty adhesion.', 1000, 32, 333,NULL, '../asserts/img/400004.jpg'),
(400005, 'Adhesive Tapes 3','Multipurpose adhesive tapes suitable for a range of industrial uses.', 1000, 31, 22,NULL, '../asserts/img/400005.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `orderline`
--

TRUNCATE TABLE `orderline`;
--
-- 傾印資料表的資料 `orderline`
--

INSERT INTO `orderline` (`orderLineID`, `orderID`, `sparePartNum`, `orderQty`) VALUES
(1, 1, 100002, 5),
(2, 1, 100003, 3);

-- --------------------------------------------------------
--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `orderline_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `orderline_ibfk_2` FOREIGN KEY (`sparePartNum`) REFERENCES `sparePart` (`sparePartNum`);

--
-- 資料表的限制式 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`dealerID`) REFERENCES `dealer` (`dealerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;