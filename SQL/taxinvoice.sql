-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 08:50 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxinvoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoicelist`
--

CREATE TABLE `invoicelist` (
  `id` int(10) NOT NULL,
  `invoiceId` varchar(100) NOT NULL,
  `invoiceName` varchar(255) NOT NULL,
  `itemName` text NOT NULL,
  `itemQuantity` text NOT NULL,
  `itemUnitPrice` text NOT NULL,
  `itemTotalPrice` text NOT NULL,
  `taxPercentage` int(10) NOT NULL,
  `taxAmount` varchar(100) NOT NULL,
  `subTotalWithoutTax` double NOT NULL,
  `subTotalWithTax` double NOT NULL,
  `discount` double NOT NULL,
  `grandTotal` double NOT NULL,
  `createdDate` datetime NOT NULL,
  `invoiceStatus` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicelist`
--

INSERT INTO `invoicelist` (`id`, `invoiceId`, `invoiceName`, `itemName`, `itemQuantity`, `itemUnitPrice`, `itemTotalPrice`, `taxPercentage`, `taxAmount`, `subTotalWithoutTax`, `subTotalWithTax`, `discount`, `grandTotal`, `createdDate`, `invoiceStatus`) VALUES
(1, 'Invoice_20220707071201', 'Aravinth Sample Testing Invoice', 'Item 1|Item 2|Item 3|Item 4|Item 5', '3|4|4|3|6', '100|50|75|100|25', '300|200|300|300|150', 5, '62.5', 1250, 1312.5, 15, 1297.5, '2022-07-07 07:12:01', 1),
(3, 'Invoice_20220707073706', 'New Sample Checking', 'Sample 1|Sample 2', '2|3', '200|100', '400|300', 5, '35', 700, 735, 36.75, 698.25, '2022-07-07 07:37:06', 1),
(4, 'Invoice_20220707074239', 'Flow Checking new', 'Testing 1|Testing 2', '5|3', '100|50', '500|150', 5, '32.5', 650, 682.5, 5, 677.5, '2022-07-07 07:42:39', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoicelist`
--
ALTER TABLE `invoicelist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoicelist`
--
ALTER TABLE `invoicelist`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
