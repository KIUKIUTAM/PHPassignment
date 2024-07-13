-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024 年 07 月 04 日 07:56
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `lmc_system`
--
CREATE DATABASE IF NOT EXISTS `php_lmc_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `php_lmc_system`;

-- --------------------------------------------------------

--
-- 資料表結構 `dealer`
--
-- 建立時間： 2024 年 07 月 04 日 05:33
-- 最後更新： 2024 年 07 月 04 日 05:33
--

CREATE TABLE `dealer` (
  `Dealer_ID` varchar(15) NOT NULL,
  `Company_Name` varchar(100) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Contact` varchar(20) DEFAULT NULL,
  `Wallet` mediumint(9) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `dealer`
--

TRUNCATE TABLE `dealer`;
--
-- 傾印資料表的資料 `dealer`
--

INSERT INTO `dealer` (`Dealer_ID`, `Company_Name`, `Address`, `Email`, `Contact`, `Wallet`) VALUES
('D00001', 'ABC_Motors', '123 Main Street, Hong Kong', 'abcmotors@gmail.com', '22345678', 0),
('D00002', 'XYZ_Spares', '456 Oak Avenue, Hong Kong', 'xyzspares@gmail.com', '23456789', 0),
('D00003', 'Midwest_Automotive', '789 Elm Road, Hong Kong', 'midwestautomotive@gmail.com', '34567890', 0),
('D00004', 'Capital_Auto_Parts', '321 Pine Lane, Hong Kong', 'capitalautoparts@gmail.com', '25678901', 0),
('D00005', 'Midstate_Mechanics', '654 Maple Drive, Hong Kong', 'midstatemechanics@gmail.com', '26789012', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `dealer_account`
--
-- 建立時間： 2024 年 07 月 04 日 05:33
-- 最後更新： 2024 年 07 月 04 日 05:33
--

CREATE TABLE `dealer_account` (
  `Dealer_ID` varchar(6) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `freezeAC` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `dealer_account`
--

TRUNCATE TABLE `dealer_account`;
--
-- 傾印資料表的資料 `dealer_account`
--

INSERT INTO `dealer_account` (`Dealer_ID`, `Password`, `freezeAC`) VALUES
('D00001', '123', 0),
('D00002', '123', 0),
('D00003', '123', 0),
('D00004', '123', 0),
('D00005', '123', 0);


--
-- 資料表結構 `orderline`
--
-- 建立時間： 2024 年 07 月 04 日 05:33
-- 最後更新： 2024 年 07 月 04 日 05:33
--

CREATE TABLE `orderline` (
  `OrderLine_Id` mediumint(9) NOT NULL,
  `Order_ID` varchar(15) NOT NULL,
  `Product_ID` mediumint(9) NOT NULL,
  `Quantity` smallint(6) DEFAULT NULL,
  `Status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `orderline`
--

TRUNCATE TABLE `orderline`;
--
-- 傾印資料表的資料 `orderline`
--

INSERT INTO `orderline` (`OrderLine_Id`, `Order_ID`, `Product_ID`, `Quantity`, `Status`) VALUES
(1, 'Or10001/0', 100002, 5, '1'),
(2, 'Or10002/0', 100003, 3, '1'),
(3, 'Or10003/0', 100004, 8, '1'),
(4, 'Or10004/0', 100005, 2, '1'),
(5, 'Or10005/0', 200001, 6, '1'),
(6, 'Or10001/0', 100002, 8, '1'),
(7, 'Or10002/0', 100002, 2, '1'),
(8, 'Or10003/0', 100002, 6, '1'),
(9, 'Or10004/0', 100002, 10, '1'),
(10, 'Or10006/0', 100003, 5, '0'),
(11, 'Or10006/0', 100004, 4, '0'),
(12, 'Or10006/0', 100005, 9, '0'),
(13, 'Or10007/0', 200001, 15, '0'),
(14, 'Or10007/0', 100005, 12, '0'),
(15, 'Or10007/0', 100004, 13, '0');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--
-- 建立時間： 2024 年 07 月 04 日 05:33
-- 最後更新： 2024 年 07 月 04 日 05:33
--

CREATE TABLE `orders` (
  `Order_ID` varchar(15) NOT NULL,
  `Dealer_ID` varchar(15) NOT NULL,
  `Status` char(1) DEFAULT NULL,
  `Delivery_Method` varchar(10) DEFAULT NULL,
  `Create_Date` date DEFAULT NULL,
  `Due_Date` date DEFAULT NULL,
  `Price` float DEFAULT 0,
  `CancelRequest` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `orders`
--

TRUNCATE TABLE `orders`;
--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`Order_ID`, `Dealer_ID`, `Status`, `Delivery_Method`, `Create_Date`, `Due_Date`, `Price`, `CancelRequest`) VALUES
('Or10001/0', 'D00001', '3', 'Express', '2023-04-15', '2023-04-30', 0, '0'),
('Or10002/0', 'D00001', '4', 'Express', '2023-04-20', '2023-05-05', 0, '0'),
('Or10003/0', 'D00001', '5', 'Standard', '2023-04-22', '2023-05-07', 0, '0'),
('Or10004/0', 'D00001', '3', 'Overnight', '2023-04-25', '2023-05-10', 0, '0'),
('Or10005/0', 'D00001', '5', 'Courier', '2023-04-30', '2023-05-15', 0, '0'),
('Or10006/0', 'D00001', '3', 'Standard', '2023-05-15', '2023-05-20', 0, '0'),
('Or10007/0', 'D00001', '3', 'Standard', '2023-05-17', '2023-05-22', 0, '0');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--
-- 建立時間： 2024 年 07 月 04 日 05:33
-- 最後更新： 2024 年 07 月 04 日 05:33
--

CREATE TABLE `product` (
  `Product_ID` mediumint(9) NOT NULL,
  `Product_Name` varchar(50) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `Stock_Level` char(1) NOT NULL,
  `Quantity` smallint(6) NOT NULL,
  `Weight` float NOT NULL,
  `Price` float NOT NULL,
  `imgRef` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `product`
--

TRUNCATE TABLE `product`;
--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name` , `Category`, `Stock_Level`, `Quantity`, `Weight`, `Price`, `imgRef`) VALUES
(100002, 'Galvanized Steel Sheet', 'Sheet Metal', 'H', 301, 2.5, 25.99, '../asserts/img/100002.jpg'),
(100003, 'Aluminum Alloy Sheet', 'Sheet Metal', 'M', 302, 1.8, 32.49, '../asserts/img/100002.jpg'),
(100004, 'Cold Rolled Steel Sheet', 'Sheet Metal', 'L', 303, 3.1, 45.99, '../asserts/img/100002.jpg'),
(100005, 'Copper Sheet', 'Sheet Metal', 'H', 304, 1.5, 38.99, '../asserts/img/100002.jpg'),
(200001, 'Gearbox Assembly', 'Major Assemblies', 'M', 301, 12.5, 325.99, '../asserts/img/100002.jpg'),
(200002, 'Hydraulic Pump Assembly', 'Major Assemblies', 'M', 301, 8.2, 415.49, '../asserts/img/100002.jpg'),
(200003, 'Engine Block Assembly', 'Major Assemblies', 'M', 301, 25.1, 675.99, '../asserts/img/100002.jpg'),
(300001, 'Aluminum Castings', 'Light Components', 'M', 301, 0.8, 12.99, '../asserts/img/100002.jpg'),
(300002, 'Plastic Injection Moldings', 'Light Components', 'M', 302, 0.4, 8.49, '../asserts/img/100002.jpg'),
(300003, 'Machined Brass Components', 'Light Components', 'M', 303, 0.6, 15.99, '../asserts/img/100002.jpg'),
(400001, 'Rubber Gaskets', 'Accessories', 'M', 301, 0.3, 3.99, '../asserts/img/100002.jpg'),
(400002, 'Plastic Hoses', 'Accessories', 'M', 302, 0.1, 4.99, '../asserts/img/100002.jpg'),
(400003, 'Adhesive Tapes', 'Accessories', 'M', 303, 0.2, 6.49, '../asserts/img/100002.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `staff`
--
-- 建立時間： 2024 年 07 月 04 日 05:33
-- 最後更新： 2024 年 07 月 04 日 05:33
--

CREATE TABLE `staff` (
  `Staff_ID` varchar(20) NOT NULL,
  `First_Name` varchar(20) DEFAULT NULL,
  `Last_Name` varchar(20) DEFAULT NULL,
  `Phone_Number` int(11) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Staff_Position` varchar(4) DEFAULT NULL,
  `Permission` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `staff`
--

TRUNCATE TABLE `staff`;
--
-- 傾印資料表的資料 `staff`
--

INSERT INTO `staff` (`Staff_ID`, `First_Name`, `Last_Name`, `Phone_Number`, `Email`, `Staff_Position`, `Permission`) VALUES
('S0001', 'John', 'Doe', 81234567, 'john.doe@lmc.com', 'MGMT', 'A'),
('S0002', 'Jane', 'Smith', 82345678, 'jane.smith@lmc.com', 'SALE', 'U'),
('S0003', 'Michael', 'Johnson', 83456789, 'michael.johnson@lmc.com', 'TECH', 'A'),
('S0004', 'Emily', 'Brown', 84567890, 'emily.brown@lmc.com', 'SALE', 'U'),
('S0005', 'David', 'Wilson', 85678901, 'david.wilson@lmc.com', 'TECH', 'A');

-- --------------------------------------------------------

--
-- 資料表結構 `staff_account`
--
-- 建立時間： 2024 年 07 月 04 日 05:33
-- 最後更新： 2024 年 07 月 04 日 05:33
--

CREATE TABLE `staff_account` (
  `Username` varchar(20) NOT NULL,
  `Staff_ID` varchar(15) NOT NULL,
  `Password` varchar(60) DEFAULT NULL,
  `freezeAC` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 資料表新增資料前，先清除舊資料 `staff_account`
--

TRUNCATE TABLE `staff_account`;
--
-- 傾印資料表的資料 `staff_account`
--

INSERT INTO `staff_account` (`Username`, `Staff_ID`, `Password`, `freezeAC`) VALUES
('david.wilson', 'S0005', '123', 0),
('emily.brown', 'S0004', '123', 0),
('jane.smith', 'S0002', '123', 0),
('john.doe', 'S0001', '123', 0),
('michael.johnson', 'S0003', '123', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`Dealer_ID`);

--
-- 資料表索引 `dealer_account`
--
ALTER TABLE `dealer_account`
  ADD PRIMARY KEY (`Dealer_ID`);


--
-- 資料表索引 `orderline`
--
ALTER TABLE `orderline`
  ADD PRIMARY KEY (`OrderLine_Id`),
  ADD KEY `orderline_ibfk_1` (`Product_ID`),
  ADD KEY `orderline_ibfk_2` (`Order_ID`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `orders_ibfk_1` (`Dealer_ID`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`);

--
-- 資料表索引 `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- 資料表索引 `staff_account`
--
ALTER TABLE `staff_account`
  ADD PRIMARY KEY (`Username`),
  ADD KEY `staff_account_ibfk_1` (`Staff_ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orderline`
--
ALTER TABLE `orderline`
  MODIFY `OrderLine_Id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 已傾印資料表的限制式
--


--
-- 資料表的限制式 `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `orderline_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`Product_ID`),
  ADD CONSTRAINT `orderline_ibfk_2` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`Order_ID`);

--
-- 資料表的限制式 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Dealer_ID`) REFERENCES `dealer` (`Dealer_ID`);

--
-- 資料表的限制式 `staff_account`
--
ALTER TABLE `staff_account`
  ADD CONSTRAINT `staff_account_ibfk_1` FOREIGN KEY (`Staff_ID`) REFERENCES `staff` (`Staff_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
