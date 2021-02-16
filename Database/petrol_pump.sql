-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2021 at 06:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petrol_pump`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow_payment`
--

CREATE TABLE `borrow_payment` (
  `id` int(11) NOT NULL,
  `p_amount` float NOT NULL,
  `date` date NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow_payment`
--

INSERT INTO `borrow_payment` (`id`, `p_amount`, `date`, `cid`) VALUES
(12, 200, '2021-01-02', 12),
(13, 100, '2021-01-02', 13),
(14, 4400, '2020-12-28', 12),
(18, 2000, '2021-01-18', 13),
(20, 200, '2021-01-18', 13),
(21, 200, '2021-01-18', 13);

-- --------------------------------------------------------

--
-- Table structure for table `cash_hand`
--

CREATE TABLE `cash_hand` (
  `id` int(11) NOT NULL,
  `cash` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_hand`
--

INSERT INTO `cash_hand` (`id`, `cash`, `date`) VALUES
(18, 15600, '2021-01-01'),
(19, 8464.95, '2021-01-08'),
(20, 8548, '2021-01-05'),
(21, 19830, '2021-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `cash_payment`
--

CREATE TABLE `cash_payment` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_payment`
--

INSERT INTO `cash_payment` (`id`, `amount`, `descr`, `date`) VALUES
(8, 1200, NULL, '2021-01-08');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phoneno` varchar(30) NOT NULL,
  `cnic` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `c_type` varchar(30) DEFAULT NULL,
  `b_amount` double NOT NULL,
  `a_amount` float NOT NULL,
  `refer_by` varchar(20) DEFAULT NULL,
  `raddress` varchar(30) DEFAULT NULL,
  `rcnic` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phoneno`, `cnic`, `address`, `c_type`, `b_amount`, `a_amount`, `refer_by`, `raddress`, `rcnic`) VALUES
(12, 'Ali Ahmad', '03123456789', '3850293235339', 'Farid Twon sahiwal pakistan', 'long term', 50, 0, 'Yaqoob', 'Street No 3 Marquee town lpk', '3456789089789'),
(13, 'Bilal Shafiq', '03123456799', '0123456789012', 'Farid Twon sahiwal pakistan', 'long term', 0, 130, 'Yaqoob', 'Street No 3 Marquee town lpk', '3456789089789'),
(14, 'Qadeer raza', '03091290121', '0123456789012', 'Lahore punjab pakistan', 'long term', 0, 300, 'Yaqoob', 'Street No 3 Marquee town lpk', '3456789089789');

-- --------------------------------------------------------

--
-- Table structure for table `customer_borrow`
--

CREATE TABLE `customer_borrow` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `p_type` varchar(30) NOT NULL,
  `quantity` float NOT NULL,
  `pr_lt` float NOT NULL,
  `tamount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_borrow`
--

INSERT INTO `customer_borrow` (`id`, `cid`, `p_type`, `quantity`, `pr_lt`, `tamount`, `date`) VALUES
(1, 12, 'petrol', 12, 120, 1440, '2021-01-02'),
(2, 12, 'tyres', 5, 122, 610, '2021-01-01'),
(3, 13, 'petrol', 15, 110, 1650, '2021-01-02'),
(4, 14, 'petrol', 5, 100, 500, '2021-01-15'),
(5, 14, 'petrol', 5, 200, 1000, '2021-01-14'),
(6, 12, 'tyres', 3, 100, 300, '2021-01-15'),
(7, 14, 'tyres', 2, 100, 200, '2021-01-13'),
(8, 14, 'petrol', 3, 100, 300, '2021-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phoneno` varchar(30) NOT NULL,
  `cnic` varchar(30) NOT NULL,
  `jdate` date NOT NULL,
  `role` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `phoneno`, `cnic`, `jdate`, `role`) VALUES
(11, 'Bilal Shafiq', '03091290121', '0123456789012', '2020-12-24', 'worker'),
(12, 'Yasir Khan', '03123456799', '3850293235339', '2021-01-15', 'worker');

-- --------------------------------------------------------

--
-- Table structure for table `employee_sale`
--

CREATE TABLE `employee_sale` (
  `id` int(11) NOT NULL,
  `meterno` float NOT NULL,
  `meter_reading` float NOT NULL,
  `liters` float NOT NULL,
  `petrol_type` varchar(30) NOT NULL,
  `pr_lt` float NOT NULL,
  `t_amount` float NOT NULL,
  `b_amount` float NOT NULL,
  `cash_hand` float NOT NULL,
  `date` date NOT NULL,
  `e_id` int(11) NOT NULL,
  `e_salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_sale`
--

INSERT INTO `employee_sale` (`id`, `meterno`, `meter_reading`, `liters`, `petrol_type`, `pr_lt`, `t_amount`, `b_amount`, `cash_hand`, `date`, `e_id`, `e_salary`) VALUES
(30, 4, 40, 400, 'petrol', 81.54, 4480, 550, 3930, '2021-01-02', 11, 500),
(32, 5, 44, 60, 'diesel', 112, 4928, 654, 4274, '2021-01-05', 11, 345),
(33, 5, 44, 120, 'diesel', 88, 4928, 654, 4274, '2021-01-05', 11, 345),
(34, 1, 200, 140, 'petrol', 111, 15540, 22, 15518, '2021-01-03', 11, 1222),
(35, 5, 56, 12, 'diesel', 112, 1344, 23, 1321, '2021-01-04', 11, 34),
(36, 1, 230.5, 30.5, 'petrol', 113.4, 3458.7, 0, 3458.7, '2021-01-08', 11, 0),
(37, 5, 100.5, 44.5, 'diesel', 112.5, 5006.25, 0, 5006.25, '2021-01-08', 11, 0),
(38, 5, 120.55, 20.05, 'diesel', 122.4, 2454.12, 550, 1904.12, '2021-01-01', 11, 122),
(39, 5, 150.56, 30.01, 'diesel', 123, 3691.23, 550, 3141.23, '2021-01-08', 11, 123);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title`, `description`, `amount`, `date`) VALUES
(5, 'Mobile Header', 'For Repairing personal car', 12.56, '2021-01-08');

-- --------------------------------------------------------

--
-- Table structure for table `meters`
--

CREATE TABLE `meters` (
  `id` int(11) NOT NULL,
  `meterno` float NOT NULL,
  `ptrol_type` varchar(30) NOT NULL,
  `c_reading` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meters`
--

INSERT INTO `meters` (`id`, `meterno`, `ptrol_type`, `c_reading`) VALUES
(9, 1, 'petrol', 230.5),
(10, 3, 'petrol', 0),
(11, 4, 'petrol', 40),
(12, 2, 'petrol', 0),
(13, 5, 'diesel', 150.56),
(14, 6, 'diesel', 0),
(15, 7, 'diesel', 0),
(16, 8, 'diesel', 0);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phoneno` varchar(20) NOT NULL,
  `cnic` varchar(20) NOT NULL,
  `b_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `name`, `phoneno`, `cnic`, `b_amount`) VALUES
(1, 'Hafiz Moazan', '323454378', '392901890', 5030),
(2, 'Zubair', '03147483647', '2147483647789', 2900),
(4, 'Bilal Shafiq', '03123456789', '3850293235339', 200);

-- --------------------------------------------------------

--
-- Table structure for table `owner_payment`
--

CREATE TABLE `owner_payment` (
  `id` int(11) NOT NULL,
  `p_amount` float NOT NULL,
  `oid` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner_payment`
--

INSERT INTO `owner_payment` (`id`, `p_amount`, `oid`, `date`) VALUES
(1, 2000, 4, '2020-11-04'),
(2, 100, 1, '2021-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `owner_withdraw`
--

CREATE TABLE `owner_withdraw` (
  `id` int(11) NOT NULL,
  `purpose` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `date` date NOT NULL,
  `oid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner_withdraw`
--

INSERT INTO `owner_withdraw` (`id`, `purpose`, `description`, `amount`, `date`, `oid`) VALUES
(7, 'Car Expense', 'For Repairing personal car', '1200', '2021-01-16', 2),
(8, 'Personal', 'Dresses of workers', '500', '2021-01-15', 2),
(9, 'Personal', 'Personal car fuel', '800', '2021-01-09', 2),
(10, 'Car Expense', 'Dresses of workers', '5000', '2021-01-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `petrol_type` varchar(30) NOT NULL,
  `dip` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `petrol_type`, `dip`) VALUES
(4, 'petrol', 49.5),
(5, 'diesel', 149.44);

-- --------------------------------------------------------

--
-- Table structure for table `stock2`
--

CREATE TABLE `stock2` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `quantity` float NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock2`
--

INSERT INTO `stock2` (`id`, `name`, `quantity`, `amount`) VALUES
(4, 'Tyres', 51, 1200),
(5, 'mobile  oil', 3.5, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `stock_purchase`
--

CREATE TABLE `stock_purchase` (
  `id` int(11) NOT NULL,
  `p_type` varchar(30) NOT NULL,
  `pr_lt` float NOT NULL,
  `dip` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_purchase`
--

INSERT INTO `stock_purchase` (`id`, `p_type`, `pr_lt`, `dip`, `date`) VALUES
(2, 'diesel', 112, 200, '2020-12-29'),
(3, 'petrol', 110, 120, '2021-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `stock_sale`
--

CREATE TABLE `stock_sale` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `tamount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_sale`
--

INSERT INTO `stock_sale` (`id`, `sid`, `quantity`, `tamount`, `date`) VALUES
(6, 4, 125, 1200, '2021-01-06'),
(7, 5, 100, 12333, '2021-01-05'),
(8, 5, 12.5, 122.45, '2021-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phoneno` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phoneno`, `password`, `role`) VALUES
(6, 'Moazan Admin', '03123456789', 'admin123', 'admin'),
(8, 'Ali Ahmad', '03091290121', 'ahmad123', 'assistant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow_payment`
--
ALTER TABLE `borrow_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_hand`
--
ALTER TABLE `cash_hand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_payment`
--
ALTER TABLE `cash_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_borrow`
--
ALTER TABLE `customer_borrow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cust` (`cid`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_sale`
--
ALTER TABLE `employee_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eid` (`e_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters`
--
ALTER TABLE `meters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner_payment`
--
ALTER TABLE `owner_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `o_id` (`oid`);

--
-- Indexes for table `owner_withdraw`
--
ALTER TABLE `owner_withdraw`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock2`
--
ALTER TABLE `stock2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_purchase`
--
ALTER TABLE `stock_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_sale`
--
ALTER TABLE `stock_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stockid` (`sid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow_payment`
--
ALTER TABLE `borrow_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cash_hand`
--
ALTER TABLE `cash_hand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cash_payment`
--
ALTER TABLE `cash_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer_borrow`
--
ALTER TABLE `customer_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee_sale`
--
ALTER TABLE `employee_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meters`
--
ALTER TABLE `meters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `owner_payment`
--
ALTER TABLE `owner_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `owner_withdraw`
--
ALTER TABLE `owner_withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock2`
--
ALTER TABLE `stock2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_purchase`
--
ALTER TABLE `stock_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_sale`
--
ALTER TABLE `stock_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_borrow`
--
ALTER TABLE `customer_borrow`
  ADD CONSTRAINT `cust` FOREIGN KEY (`cid`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_sale`
--
ALTER TABLE `employee_sale`
  ADD CONSTRAINT `eid` FOREIGN KEY (`e_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `owner_payment`
--
ALTER TABLE `owner_payment`
  ADD CONSTRAINT `o_id` FOREIGN KEY (`oid`) REFERENCES `owners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owner_withdraw`
--
ALTER TABLE `owner_withdraw`
  ADD CONSTRAINT `oid` FOREIGN KEY (`oid`) REFERENCES `owners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_sale`
--
ALTER TABLE `stock_sale`
  ADD CONSTRAINT `stockid` FOREIGN KEY (`sid`) REFERENCES `stock2` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
