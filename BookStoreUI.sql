-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 02:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookID` int(11) NOT NULL,
  `BookName` varchar(100) NOT NULL,
  `BookPrice` float NOT NULL,
  `BookDetail` text NOT NULL,
  `BookImage` varchar(200) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookID`, `BookName`, `BookPrice`, `BookDetail`, `BookImage`, `CategoryID`, `Quantity`) VALUES
(35, 'Nhà giả kim', 20000, 'Nhà giả kim', '1.jpg', 20, 0),
(37, 'Quản lý tài chính', 100000, 'Quản lý tài chính', '2.jpeg', 20, 0),
(38, 'Những chú bé đần', 200000, 'Chú bé đần', '3.webp', 14, 0),
(39, 'Chú bé đần độn', 400000, 'Chú bé đần', '4.jpg', 15, 0),
(40, 'Ăn nhiều không mập', 56000, 'Ăn nhiều không mập', '5.jpg', 25, 0),
(41, 'Ăn ít bị béo nhé', 56000, 'Ăn ít bị béo', '6.webp', 14, 0),
(42, 'Cách lập trình', 405000, 'Cách code giỏi', '7.jpg', 16, 0),
(43, 'Cách có tiền không cần làm', 45000, 'Đi làm không mệt', '8.webp', 17, 0),
(45, 'Không ăn không mập', 30000, 'Không ăn không mập', '9.webp', 25, 0),
(46, 'Luật trí não', 45000, 'Luật trí não', '10.webp', 22, 0),
(201, 'Cuộc sống nhàn hạ', 20000, 'Sống không lo gì cả', '11.webp', 22, 0),
(202, 'Quay về trái đất', 52000, 'Quay về trái đất', '12.webp', 15, 62),
(203, 'Chiến hay chạy', 950000, 'Chiến hay chạy', '13.webp', 17, 62),
(204, 'Thây ma không gian', 324000, 'Thây ma không gian', '14.webp', 17, 6533),
(205, 'Nghệ thuật đường phố', 620000, 'Nghệ thuật đường phố', '15.webp', 15, 966),
(206, 'Ống kính cuộc sống', 234000, 'Ống kính cuộc sống', '16.webp', 14, 653),
(207, 'Kẻ mang tội', 62000, 'Kẻ mang tội', '17.webp', 28, 62),
(208, 'Nghệ thuật ngày mới', 62000, 'Nghệ thuật ngày mới', '18.webp', 18, 6533),
(209, 'Kiến trúc châu âu', 63000, 'Kiến trúc châu âu', '19.webp', 16, 633),
(210, 'Học chụp ảnh', 63000, 'Học chụp ảnh', '19.webp', 15, 96000),
(211, 'Nhìn ra thế giới', 63000, 'Nhìn ra thế giới', '21.webp', 14, 6325000),
(212, 'Chúng ta lạc lối', 96000, 'Chúng ta lạc lối', '22.webp', 18, 961),
(213, 'Du lịch châu âu', 96000, 'Du lịch châu âu', '24.webp', 18, 965),
(214, 'Bay khinh khí cầu', 89000, 'Bay khinh khí cầu', '25.webp', 21, 635),
(215, 'Đề xuất tài trợ', 870000, 'Đề xuất tài trợ', '26.webp', 16, 9654),
(216, 'Hãy nhớ tên anh ấy', 95000, 'Hãy nhớ tên anh ấy', '27.webp', 16, 633),
(217, 'Ai cũng nên học thiết kế', 7800000, 'Ai cũng nên học thiết kế', '28.webp', 19, 6325000),
(218, 'Nhà bếp', 780000, 'Nhà bếp', '29.webp', 22, 635);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `OrderNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `UserID`, `BookID`, `OrderNumber`) VALUES
(3, 4, 38, 1),
(5, 1, 43, 1),
(6, 1, 45, 1),
(9, 1, 37, 1),
(10, 1, 39, 1),
(12, 1, 37, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(13, 'Arts & Music & Spot'),
(14, 'Biographies'),
(15, 'Business'),
(16, 'Comics'),
(17, 'Computers & Tech'),
(18, 'Cooking'),
(19, 'Edu & Reference'),
(20, 'Entertainment'),
(21, 'Health & Fitness'),
(22, 'History'),
(25, ''),
(28, 'spot');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `CartID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Address` text NOT NULL,
  `TotalPrice` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `CartID`, `UserID`, `Address`, `TotalPrice`) VALUES
(1, 10, 2, 'asdadad', '575000'),
(2, 10, 2, 'asdadad', '575000'),
(3, 9, 2, 'adadad', '175000'),
(4, 12, 2, 'asdad', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserFullName` varchar(100) NOT NULL,
  `UserPassword` varchar(100) NOT NULL,
  `UserRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `UserFullName`, `UserPassword`, `UserRole`) VALUES
(1, 'admin', 'ADMIN', '123', 1),
(2, 'tung', 'Tung1', '123', 0),
(3, 'tung1', 'Tung', '123', 0),
(4, 'duc', 'Tung', '123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `FK_Category_ID` (`CategoryID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `FK_Book_ID` (`BookID`),
  ADD KEY `FK_User_ID` (`UserID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryID` (`CategoryID`,`CategoryName`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK_1` (`CartID`),
  ADD KEY `FK_2` (`UserID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK_Category_ID` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_Book_ID` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`),
  ADD CONSTRAINT `FK_User_ID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
