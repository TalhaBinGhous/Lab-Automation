-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2024 at 10:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `aname` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aname`, `fname`, `lname`, `email`, `pass`) VALUES
(1, 'haider', 'haider', 'mobin', 'muhammadhaidermobin@gmail.com', 'haider'),
(2, 'haiderr', 'haider', 'mobin', 'muhammadhaidermobin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `service` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `csid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `name`, `email`, `mobile`, `service`, `message`, `csid`) VALUES
(4, 'Haider', 'muhammadhaidermobin@gmail.com', '03339796668', 'Biochemistry Tests', 'hiiiiii', 9),
(6, 'Haider', 'muhammadhaidermobin@gmail.com', '03339796668', 'Microbiology Tests', 'hello', 9),
(7, 'Haider', 'muhammadhaidermobin@gmail.com', '03339796668', 'Pathology Testing', 'hello', 9);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `pid` int(11) NOT NULL,
  `csid` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `pimage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`pid`, `csid`, `price`, `qty`, `subtotal`, `pimage`) VALUES
(11, 10, 500.00, 1, 500.00, NULL),
(12, 10, 500.00, 1, 500.00, NULL),
(38, 9, 520.00, 1, 520.00, 'download (17).jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `cname` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `cname`) VALUES
(12, 'Measuring Devices'),
(13, 'Nebolizer '),
(14, 'Medicines'),
(15, 'Cyrups'),
(16, 'Loations'),
(17, 'Balms'),
(18, 'Cream'),
(19, 'Milk'),
(20, 'Masks'),
(21, 'Eye Drops');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `csid` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`csid`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Haider', '123@gmail.com', 'test reports', 'abshufkyuabyucbiyds'),
(2, 'Haider', 'mn350702@gmail.com', 'test reports', '122rew'),
(3, 'ali', '123@gmail.com', 'hello', 'whoooooo'),
(4, 'ahmad', '1@gmail.com', 'dszfdfddf', 'radf');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `csid` int(11) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `uname` varchar(250) NOT NULL,
  `email` varchar(225) NOT NULL,
  `pass` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`csid`, `fname`, `lname`, `uname`, `email`, `pass`) VALUES
(6, 'haider', 'khan', 'haiderr', 'muhammadhaidermobin@gmail.com', '123'),
(7, 'haider', 'khan', 'haiderr', 'muhammadhaidermobin@gmail.com', '123'),
(8, 'haider', 'khan', 'hello', '123@gmail.com', '$2y$10$71SuE/CljFOf/9eLar4mc.HW/Bjviswxr2gXoFNqanLyD3vNq44kO'),
(9, 'haider', 'khan', 'hello', '123@gmail.com', '123'),
(10, 'haider', 'mobin', 'hello', '123@gmail.com', '321');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `name`, `phone`, `email`, `address`, `country`, `total`) VALUES
(14, 'Haider', 2147483647, 'muhammadhaidermobin@gmail.com', 'A375', 'pakistan', 1623);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `pid` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pname` varchar(250) NOT NULL,
  `pprice` varchar(250) NOT NULL,
  `pcategory` varchar(250) NOT NULL,
  `pimage` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pprice`, `pcategory`, `pimage`) VALUES
(11, '', '', '', ''),
(12, '', '', '', ''),
(14, 'Thermometer', '350', '12', 'pexels-maksgelatin-5995206.jpg'),
(15, 'Manual Blood Pressure Machine', '800', '12', 'images (3).jpeg'),
(16, 'Digital Blood Pressure Machine', '1600', '12', 'images (4).jpeg'),
(17, 'Air Jet Nebolizer', '1800', '13', 'download.jpeg'),
(18, 'Ultrasonic Nebolizer', '2200', '13', 'download (1).jpeg'),
(19, 'Panadol Tablet', '30', '14', 'download (2).jpeg'),
(20, 'Panadol Extra Tablet', '40', '14', 'download (3).jpeg'),
(21, 'Panadol Cyrup', '200', '15', 'download (4).jpeg'),
(22, 'Heartbeat checking Device', '1000', '12', 'stethoscopes-rubber-tubing-sounds-patient-ears-physician.webp'),
(23, 'Digital Heartbeat Monitor', '1300', '12', 'download (5).jpeg'),
(24, 'Blood Glucose Monitoring Device', '800', '12', '41r0QJCn3fL._AC_UL600_SR600,600_.jpg'),
(25, 'Gold Bond Loation', '1500', '16', 'download (6).jpeg'),
(26, 'Image Loation', '1400', '16', 'download (7).jpeg'),
(27, 'Dalacin T Loation', '350', '16', 'download (8).jpeg'),
(28, 'Vicks Balm', '220', '17', 'download (9).jpeg'),
(29, 'Zandu Balm', '250', '17', 'download (10).jpeg'),
(30, 'Mycitracin Cream', '190', '18', 'download (11).jpeg'),
(31, 'Fusimax-B Cream', '400', '18', 'download (12).jpeg'),
(32, 'PediaSure', '3300', '19', 'download (13).jpeg'),
(33, 'Ensure ', '3500', '19', 'download (14).jpeg'),
(34, 'Medicated Mask', '20', '20', '51XkK7ESFkL._SL500_.jpg'),
(36, 'Nebolizer Mask', '330', '20', 'download (15).jpeg'),
(37, 'Nebra Eye Drops', '480', '21', 'download (16).jpeg'),
(38, 'Femicon', '520', '21', 'download (17).jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `csid` (`csid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`pid`,`csid`),
  ADD KEY `csid` (`csid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`csid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`csid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `csid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `csid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `csid` FOREIGN KEY (`csid`) REFERENCES `customer` (`csid`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`csid`) REFERENCES `customer` (`csid`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
