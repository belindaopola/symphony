-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 05, 2024 at 01:05 PM
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
-- Database: `symphony`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(12, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(13, 'Kiran Kumar', 'kiran', 'b1a5b64256e27fa5ae76d62b95209ab3'),
(14, 'Bethuel Ongesa', 'bongesa', '738f8991edfcedde8ca16de25065028a');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(150) DEFAULT NULL,
  `customer_contact` varchar(20) DEFAULT NULL,
  `customer_email` varchar(150) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`, `featured`, `active`) VALUES
(1, 'Africa Datacenter', 'John Doe', 'john.doe@xyz.com', 'Africa Datacenter', 'Yes', 'Yes'),
(2, 'Africa Direct international Ltd', 'John Doe', 'john.doe@xyz.com', 'Africa Direct international Ltd', 'Yes', 'Yes'),
(3, 'ALBA HOTEL', 'John Doe', 'john.doe@xyz.com', 'ALBA HOTEL', 'Yes', 'Yes'),
(4, 'ALMASI BOTTLERS LIMITED', 'John Doe', 'john.doe@xyz.com', 'ALMASI BOTTLERS LIMITED', 'Yes', 'Yes'),
(5, 'BAKHRESA FOOD PRODUCT LTD', 'John Doe', 'john.doe@xyz.com', 'BAKHRESA FOOD PRODUCT LTD', 'Yes', 'Yes'),
(6, 'BIDCO AFRICA LTD', 'John Doe', 'john.doe@xyz.com', 'BIDCO AFRICA LTD', 'Yes', 'Yes'),
(7, 'BLUE QUADRANT LIMITED', 'John Doe', 'john.doe@xyz.com', 'BLUE QUADRANT LIMITED', 'Yes', 'Yes'),
(8, 'BRITAM HOLDINGS', 'John Doe', 'john.doe@xyz.com', 'BRITAM HOLDINGS', 'Yes', 'Yes'),
(9, 'Britam Life Assurance Co (K) Ltd', 'John Doe', 'john.doe@xyz.com', 'Britam Life Assurance Co (K) Ltd', 'Yes', 'Yes'),
(10, 'Central Bank of Kenya', 'John Doe', 'john.doe@xyz.com', 'Central Bank of Kenya', 'Yes', 'Yes'),
(11, 'CI GROUP LTD', 'John Doe', 'john.doe@xyz.com', 'CI GROUP LTD', 'Yes', 'Yes'),
(12, 'Coca Cola Beverages Africa', 'John Doe', 'john.doe@xyz.com', 'Coca Cola Beverages Africa', 'Yes', 'Yes'),
(13, 'COUNTY GOVERNMENT OF KWALE', 'John Doe', 'john.doe@xyz.com', 'COUNTY GOVERNMENT OF KWALE', 'Yes', 'Yes'),
(14, 'DEL MONTE KENYA LTD', 'John Doe', 'john.doe@xyz.com', 'DEL MONTE KENYA LTD', 'Yes', 'Yes'),
(15, 'DELTA BEVERAGES', 'John Doe', 'john.doe@xyz.com', 'DELTA BEVERAGES', 'Yes', 'Yes'),
(16, 'ESP INTERNATIONAL', 'John Doe', 'john.doe@xyz.com', 'ESP INTERNATIONAL', 'Yes', 'Yes'),
(17, 'EXCEL CHEMICALS', 'John Doe', 'john.doe@xyz.com', 'EXCEL CHEMICALS', 'Yes', 'Yes'),
(18, 'FAIRTRADE AFRICA', 'John Doe', 'john.doe@xyz.com', 'FAIRTRADE AFRICA', 'Yes', 'Yes'),
(19, 'GE HEALTHCARE', 'John Doe', 'john.doe@xyz.com', 'GE HEALTHCARE', 'Yes', 'Yes'),
(20, 'Guaranty Trust Bank (K) Ltd', 'John Doe', 'john.doe@xyz.com', 'Guaranty Trust Bank (K) Ltd', 'Yes', 'Yes'),
(21, 'HURRICANE GLOBAL FM KENYA LTD', 'John Doe', 'john.doe@xyz.com', 'HURRICANE GLOBAL FM KENYA LTD', 'Yes', 'Yes'),
(22, 'ISUZU EA', 'John Doe', 'john.doe@xyz.com', 'ISUZU EA', 'Yes', 'Yes'),
(23, 'JAMBO FOOD PRODUCT', 'John Doe', 'john.doe@xyz.com', 'JAMBO FOOD PRODUCT', 'Yes', 'Yes'),
(24, 'Jetlak Foods Ltd', 'John Doe', 'john.doe@xyz.com', 'Jetlak Foods Ltd', 'Yes', 'Yes'),
(25, 'Kenya Airways', 'John Doe', 'john.doe@xyz.com', 'Kenya Airways', 'Yes', 'Yes'),
(26, 'KENYA COMMERCIAL BANK', 'John Doe', 'john.doe@xyz.com', 'KENYA COMMERCIAL BANK', 'Yes', 'Yes'),
(27, 'Kenya Education Network Trust', 'John Doe', 'john.doe@xyz.com', 'Kenya Education Network Trust', 'Yes', 'Yes'),
(28, 'KENYA REVENUE AUTHORITY', 'John Doe', 'john.doe@xyz.com', 'KENYA REVENUE AUTHORITY', 'Yes', 'Yes'),
(29, 'KENYA WINE AGENCIES LTD', 'John Doe', 'john.doe@xyz.com', 'KENYA WINE AGENCIES LTD', 'Yes', 'Yes'),
(30, 'KINANGOP DAIRY LTD', 'John Doe', 'john.doe@xyz.com', 'KINANGOP DAIRY LTD', 'Yes', 'Yes'),
(31, 'KRONES LCS CENTRE EAST AFRICA', 'John Doe', 'john.doe@xyz.com', 'KRONES LCS CENTRE EAST AFRICA', 'Yes', 'Yes'),
(32, 'MATER HOSPITAL', 'John Doe', 'john.doe@xyz.com', 'MATER HOSPITAL', 'Yes', 'Yes'),
(33, 'Metropol Corporation', 'John Doe', 'john.doe@xyz.com', 'Metropol Corporation', 'Yes', 'Yes'),
(34, 'MP SHAH HOSPITAL', 'John Doe', 'john.doe@xyz.com', 'MP SHAH HOSPITAL', 'Yes', 'Yes'),
(35, 'OLA ENERGY LTD', 'John Doe', 'john.doe@xyz.com', 'OLA ENERGY LTD', 'Yes', 'Yes'),
(36, 'PAWA IT', 'John Doe', 'john.doe@xyz.com', 'PAWA IT', 'Yes', 'Yes'),
(37, 'SOUTHERN STAR SACCO', 'John Doe', 'john.doe@xyz.com', 'SOUTHERN STAR SACCO', 'Yes', 'Yes'),
(38, 'SQUARE PHARMACEUTICALS EPZ', 'John Doe', 'john.doe@xyz.com', 'SQUARE PHARMACEUTICALS EPZ', 'Yes', 'Yes'),
(39, 'ST MATIA MULUMBA', 'John Doe', 'john.doe@xyz.com', 'ST MATIA MULUMBA', 'Yes', 'Yes'),
(40, 'THE SOCIAL HOUSE', 'John Doe', 'john.doe@xyz.com', 'THE SOCIAL HOUSE', 'Yes', 'Yes'),
(41, 'TOTAL ENERGIES LTD', 'John Doe', 'john.doe@xyz.com', 'TOTAL ENERGIES LTD', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_it_request`
--

CREATE TABLE `tbl_it_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_name` varchar(150) NOT NULL,
  `quotation` varchar(255) NOT NULL,
  `customer_po` varchar(255) NOT NULL,
  `costing_sheet` varchar(255) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `vat` decimal(10,0) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `sales_person` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_it_request`
--

INSERT INTO `tbl_it_request` (`id`, `request_date`, `customer_name`, `quotation`, `customer_po`, `costing_sheet`, `currency`, `price`, `vat`, `total`, `status`, `sales_person`, `description`, `title`) VALUES
(1, '2024-01-25 12:57:49', '2', 'none', 'none', 'none', 'KES', 13920.00, 0, 13920.00, 'Invoiced', '4', 'APDI SSD 512 Hard Drive with Installation Charges', '1'),
(2, '2024-02-12 12:58:43', '32', 'none', 'none', 'none', 'USD', 2649.48, 0, 2649.48, 'Oder Placement', '2', 'MATER RED HART ENTERPRICE SERVER,STANDARD', '2'),
(3, '2024-02-16 12:59:02', '9', 'none', 'none', 'none', 'KES', 105237.04, 0, 105237.04, 'Oder Placement', '2', 'Britam INFRA IBM Server Hard Drives', '1'),
(4, '2024-02-23 12:59:11', '37', 'none', 'none', 'none', 'KES', 5527758.93, 0, 5527758.93, 'Oder Placement', '2', 'SOUTHERN STAR SACCO SERVER SUPPLY', '2'),
(5, '2024-03-01 12:59:22', '36', 'none', 'none', 'none', 'KES', 13717.00, 0, 13717.00, 'Invoiced', '4', 'PAWA IT LENOVO KEYBOARD REPLACEMENT', '7'),
(6, '2024-03-04 12:59:38', '16', 'none', 'none', 'none', 'USD', 243.60, 0, 243.60, 'Oder Placement', '5', 'ESP SDWAN INSTALLATION', '7'),
(7, '2024-03-27 12:59:45', '29', 'none', 'none', 'none', 'KES', 378862.96, 0, 378862.96, 'Oder Placement', '2', 'KWAL SAGE LICENSE RENEWAL 2024', '9'),
(8, '2024-03-28 12:59:50', '32', 'none', 'none', 'none', 'USD', 29294.26, 0, 29294.26, 'Oder Placement', '2', 'MATER SUPPLY & CONFG OF ADDITIONAL NODE', '2'),
(9, '2024-04-04 12:59:57', '6', 'none', 'none', 'none', 'KES', 77952.00, 0, 77952.00, 'Oder Placement', '5', 'BIDCO SAS HDD REPLACEMENT', '7'),
(10, '2024-04-22 13:00:02', '28', 'none', 'none', 'none', 'USD', 41625.00, 0, 41625.00, 'Oder Placement', '2', 'KRA HCL ADDITIONAL LICENSES', '9'),
(11, '2024-04-25 13:00:09', '18', 'none', 'none', 'none', 'KES', 19488.00, 0, 19488.00, 'Paid', '4', 'FAIRTRADE DESKTOP MAT AND LAPTOP STAND', '1'),
(12, '2024-05-07 13:00:16', '9', 'none', 'none', 'none', 'KES', 165917.72, 0, 165917.72, 'Oder Placement', '2', 'BRITAM FLASH DRIVE AND SAS FLASH', '9'),
(13, '2024-05-23 13:00:22', '25', 'none', 'none', 'none', 'KES', 8327856.22, 0, 8327856.22, 'Oder Placement', '2', 'KQSUPPLY & INSTALLATION OF STRUCTURED CABLING', '9'),
(14, '2024-05-23 13:00:29', '10', 'none', 'none', 'none', 'KES', 2672640.00, 0, 2672640.00, 'Oder Placement', '5', 'CBK SUPPLY OF IBM TAPE MEDIA LIBRARIES WITH LABELS', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `title`, `section_id`, `featured`, `active`) VALUES
(1, 'PC Parts (Memory, Memory,Keyboard, Hard disk)', 8, 'Yes', 'Yes'),
(2, 'PCs and Laptops (Lenovo, HP)', 8, 'Yes', 'Yes'),
(3, 'UPS Parts (Capacitors, Power interface board, inverter driver, rectifier, Graphic dispaly)', 5, 'Yes', 'Yes'),
(4, 'UPS (ABB, GE, APC)', 5, 'Yes', 'Yes'),
(5, 'Batteries (12V 7Ah, 12V 18Ah, 12V 40Ah, 12V 100Ah, 12V 200Ah )', 5, 'Yes', 'Yes'),
(6, 'Preventive Maintenance - IT', 6, 'Yes', 'Yes'),
(7, 'Repair Maintenance - IT', 6, 'Yes', 'Yes'),
(8, 'Server Configuration (Installation)', 6, 'Yes', 'Yes'),
(9, 'Upgrade Service (System & Software Upgrade)', 6, 'Yes', 'Yes'),
(10, 'Preventive Maintenance - CP', 4, 'Yes', 'Yes'),
(11, 'Repair Maintenance - CP', 4, 'Yes', 'Yes'),
(12, 'UPS Commissioning ', 4, 'Yes', 'Yes'),
(13, 'Battery Installation ', 4, 'Yes', 'Yes'),
(14, 'Customer surveys - IT', 9, 'Yes', 'Yes'),
(15, 'Customer surveys - CP', 9, 'Yes', 'Yes'),
(16, 'Manufacturer\'s warranty - CP', 10, 'Yes', 'Yes'),
(17, 'Extended warranty - CP', 10, 'Yes', 'Yes'),
(18, 'AMC -CP', 10, 'Yes', 'Yes'),
(19, 'Manufacturer\'s warranty - IT', 11, 'Yes', 'Yes'),
(20, 'Extended warranty - IT', 11, 'Yes', 'Yes'),
(21, 'AMC - IT', 11, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_name` varchar(150) NOT NULL,
  `quotation` varchar(255) NOT NULL,
  `customer_po` varchar(255) NOT NULL,
  `costing_sheet` varchar(255) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `vat` decimal(10,0) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `sales_person` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`id`, `request_date`, `customer_name`, `quotation`, `customer_po`, `costing_sheet`, `currency`, `price`, `vat`, `total`, `status`, `sales_person`, `description`, `title`) VALUES
(1, '2024-01-08 13:03:18', '29', '', '', '', 'USD', 25438.00, 4070, 29508.08, 'Order Placement', '2', 'KWAL DAMAGED UPS REPAIR:SPARES & LABOR', '11'),
(2, '2024-01-08 13:03:32', '34', '', '', '', 'KES', 80000.00, 12800, 92800.00, 'Invoiced', '3', 'MP SHAH POWER LOGGING', '11'),
(3, '2024-01-09 13:03:38', '22', '', '', '', 'KES', 220403.00, 106408, 326810.86, 'Paid', '3', 'ISUZU EA QUARTERLY SERVICE(JAN-MARCH)', '10'),
(4, '2024-01-12 13:03:45', '1', '', '', '', 'USD', 6000.00, 960, 6960.00, 'Invoiced', '1', 'ADC SMALL DISTRIBUTION BOX', '3'),
(5, '2024-01-16 13:03:52', '27', '', '', '', 'KES', 224000.00, 35840, 259840.00, 'Invoiced', '3', 'KENET QUARTERLY SERVICE', '10'),
(6, '2024-01-17 13:03:58', '4', '', '', '', 'KES', 380328.00, 12552, 392880.00, 'Invoiced', '3', 'ALMASI ELDORET BATTERY REPLACEMENT', '13'),
(7, '2024-01-22 13:04:05', '38', '', '', '', 'KES', 251200.00, 0, 251200.00, 'Invoiced', '3', 'EPZ BI-ANNUAL UPS MAINTENANCE', '10'),
(8, '2024-01-29 13:04:11', '26', '', '', '', 'KES', 6629.99, 1061, 7690.79, 'Invoiced', '4', 'KCB KERARAPON KAREN ATM CHECK METER REPLACEMENT', '11'),
(9, '2024-02-01 13:04:29', '20', '', '', '', 'KES', 90000.00, 14400, 104400.00, 'Invoiced', '4', 'GT BANK SKYPARK RENTAL UPS FOR THE MONTH OF JANUARY', '11'),
(10, '2024-02-08 13:04:44', '19', '', '', '', 'USD', 2607.98, 417, 3025.26, 'Invoiced', '1', 'GE KUTTRRH PET 1,160KVA UPS SPARES', '3'),
(11, '2024-02-12 13:04:50', '19', '', '', '', 'USD', 2607.98, 417, 3025.26, 'Invoiced', '1', 'GE KUTTRRH PET 2 ,160KVA UPS SPARES', '3'),
(12, '2024-02-12 13:04:55', '19', '', '', '', 'USD', 2607.98, 417, 3025.26, 'Invoiced', '1', 'GE KUTTRRH CYCLOTRON 160KVA UPS SPARES', '3'),
(13, '2024-02-12 13:05:01', '19', '', '', '', 'USD', 5812.72, 930, 6742.75, 'Invoiced', '1', 'GE KUTTRRH SPECT CT UPS', '3'),
(14, '2024-02-12 13:05:07', '19', '', '', '', 'USD', 6293.88, 1007, 7300.90, 'Invoiced', '1', 'GE KUTTRRH MRI AND CT UPS SAPARES', '3'),
(15, '2024-02-13 13:05:15', '11', '', '', '', 'USD', 1000.00, 0, 1000.00, 'Order Placement', '3', 'CI GROUP LP 30KVA UPS SPARE', '3'),
(16, '2024-02-14 13:05:21', '5', '', '', '', 'USD', 5085.00, 0, 5085.00, 'Paid', '3', 'BAKHRESA JUICE DIVISION 2PCS ABB 30KVA UPS SPARES', '3'),
(17, '2024-02-16 13:05:28', '20', '', '', '', 'KES', 81959.48, 13114, 95073.00, 'Invoiced', '4', 'GT BANK NANYUKI BATTERY REPLACEMENT', '13'),
(18, '2024-02-16 13:05:36', '20', '', '', '', 'KES', 62879.31, 10061, 72940.00, 'Invoiced', '4', 'GT BANK THIKA BATTERIES AND FANS REPLACEMENT', '11'),
(19, '2024-02-29 13:05:42', '26', '', '', '', 'KSH', 25000.00, 4000, 29000.00, 'Order Placement', '4', 'KCB KENCOM POWER MEASUREMENT FOR 27 RACKS', '11'),
(20, '2024-03-04 13:05:47', '20', '', '', '', 'KES', 90000.00, 14400, 104400.00, 'Invoiced', '4', 'GT BANK SKYPARK RENTAL UPS FOR THE MONTH OF JANUARY', '11'),
(21, '2024-03-07 13:05:53', '23', '', '', '', 'USD', 2665.00, 0, 2665.00, 'Paid', '3', 'JAMBO FOOD 30KVA UPS SERVICE', '11'),
(22, '2024-03-13 13:05:59', '17', '', '', '', 'KSH', 100200.00, 16032, 116232.00, 'Invoiced', '3', 'EXCELCHEMICALS 160KVA UPS PM', '10'),
(23, '2024-03-19 13:06:08', '12', '', '', '', 'KSH', 40000.00, 6400, 46400.00, 'Invoiced', '4', 'CCBA NAIROBI BOTTLERS LINE 9 UPS DIAGNOSIS', '11'),
(24, '2024-03-22 13:06:16', '33', '', '', '', 'KSH', 254288.00, 40686, 294974.08, 'Invoiced', '4', 'METROPOL BATTERY REPLACEMENT', '13'),
(25, '2024-03-27 13:07:14', '34', '', '', '', 'USD', 48487.02, 7758, 56244.94, 'Invoiced', '1', 'MP SHAH ABB 30KVA UPS AND INSTALLATION', '12'),
(26, '2024-04-02 13:08:59', '20', '', '', '', 'KES', 90000.00, 14400, 104400.00, 'Invoiced', '4', 'GT BANK SKYPARK RENTAL UPS FOR THE MONTH OF MARCH', '11'),
(27, '2024-04-03 13:09:14', '3', '', '', '', 'KES', 47096.00, 27184, 74280.00, 'Paid', '3', 'ALBA HOTEL 6KVA UPS REPAIR', '11'),
(28, '2024-04-03 13:09:38', '19', '', '', '', 'USD', 2651.00, 424, 3075.16, 'Invoiced', '4', 'GE TANZANIA COMMISSIONING OF ABB UPS', '12'),
(29, '2024-04-05 13:09:47', '20', '', '', '', 'KES', 22500.00, 3600, 26100.00, 'Invoiced', '4', 'GT BANK RENTAL UPS FOR THE 1ST WEEK OF APRIL', '11'),
(30, '2024-04-05 13:09:52', '35', '', '', '', 'KES', 20000.00, 3200, 23200.00, 'Invoiced', '4', 'OLA 10KVA UPS DIAGNOSIS', '11'),
(31, '2024-04-05 13:10:03', '19', '', '', '', 'USD', 600.00, 96, 696.00, 'Invoiced', '4', 'GE AGA KHAN 160KVA UPS DIAGNOSIS', '11'),
(32, '2024-04-12 13:10:08', '1', '', '', '', 'KSH', 850424.00, 136068, 986491.84, 'Invoiced', '1', 'ADC TSEBO ONE-OFF PREVENTIVE MAINTENANCE', '10'),
(33, '2024-04-15 13:10:14', '14', '', '', '', 'USD', 7898.00, 0, 7898.00, 'Paid', '3', 'DELTA BEVERAGES ZIMBABWE 30KVA UPS SPARES', '3'),
(34, '2024-04-16 13:10:19', '30', '', '', '', 'KES', 150000.00, 24000, 174000.00, 'Invoiced', '3', 'KINANGOP DAIRY ONE OFF PM(FEB-JUNE)', '10'),
(35, '2024-04-17 13:10:25', '14', '', '', '', 'KES', 33250.00, 5320, 38570.00, 'Invoiced', '4', 'DEL MONTE 20KVA UPS DIAGNOSIS', '11'),
(36, '2024-04-17 13:10:32', '22', '', '', '', 'KES', 220403.00, 35264, 255667.48, 'Order Placement', '3', 'ISUZU EA QUARTERLY (Q2) SERVICE(APRIL-JUNE)', '10'),
(37, '2024-04-22 13:10:37', '34', '', '', '', 'KES', 194238.00, 31078, 225316.08, 'Order Placement', '4', 'MP SHAH 20KVA UPS BATTERY REPLACEMENT', '13'),
(38, '2024-04-22 13:10:43', '34', '', '', '', 'KES', 15000.00, 2400, 17400.00, 'Order Placement', '4', 'MP SHAH 20KVA UPS DIAGNOSIS', '11'),
(39, '2024-04-29 13:10:50', '21', '', '', '', 'KES', 43500.00, 6960, 50460.00, 'Order Placement', '4', 'GE COURTYARD 10KVA UPS SERVICE', '10'),
(40, '2024-04-30 13:10:56', '31', '', '', '', 'KES', 163500.00, 26160, 189660.00, 'Invoiced', '4', 'KRONES RWANDA GE UPS DIAGNOSIS', '11'),
(41, '2024-05-02 13:11:03', '34', '', '', '', 'KES', 40000.00, 6400, 46400.00, 'Order Placement', '4', 'MP SHAH POWER LOGGER FOR 2 DAYS', '11'),
(42, '2024-05-02 13:11:08', '27', '', '', '', 'KES', 224000.00, 35840, 259840.00, 'Order Placement', '3', 'KENET QUARTERLY SERVICE', '10'),
(43, '2024-05-06 13:11:15', '12', '', '', '', 'KES', 97000.00, 15520, 112520.00, 'Invoiced', '4', 'EQUATOR BOTTLERS UPS RELOCATION', '11'),
(44, '2024-05-06 13:11:32', '40', '', '', '', 'KES', 93312.00, 14930, 108241.92, 'Order Placement', '3', 'SOCIAL HOUCE BATTERIES', '13'),
(45, '2024-05-08 13:11:39', '41', '', '', '', 'KES', 68675.00, 10988, 79663.00, 'Order Placement', '4', 'TOTAL LPG 5KVA UPS RELOCATION', '11'),
(46, '2024-05-09 13:11:45', '41', '', '', '', 'KES', 435990.00, 69758, 505748.40, 'Order Placement', '3', 'TOTAL QUARTERLY SERVICE FOR 80KVA UPS AND AVR', '10'),
(47, '2024-05-13 13:12:00', '33', '', '', '', 'KES', 34482.76, 5517, 40000.00, 'Paid', '4', 'METROPOL 20KVA UPS DIAGNOSIS', '11'),
(48, '2024-05-13 13:12:05', '19', '', '', '', 'USD', 4937.05, 790, 5726.98, 'Order Placement', '4', 'GE AGA KHAN 160KVA UPS SPARES', '3'),
(49, '2024-05-14 13:12:11', '24', '', '', '', 'KES', 280000.00, 44800, 324800.00, 'Order Placement', '3', 'JETLAK BI-ANNUAL UPS MAINTENANCE', '10'),
(50, '2024-05-17 13:12:16', '41', '', '', '', 'KES', 121825.00, 19492, 141317.00, 'Order Placement', '4', 'TOTAL WILSON AIRPORT CSB BATTERY REPLACEMENT', '13'),
(51, '2024-05-27 13:12:21', '14', '', '', '', 'KES', 215000.00, 34000, 249000.00, 'Order Placement', '3', 'DEL MONTE AVR 630KVA SERVICING', '10'),
(52, '2024-05-28 13:12:31', '39', '', '', '', 'KES', 61000.00, 9760, 70760.00, 'Invoiced', '4', 'UPS DIAGNOSIS AND REPORTING', '11'),
(53, '2024-05-29 13:12:36', '41', '', '', '', 'KES', 90000.00, 14400, 104400.00, 'Invoiced', '4', 'TOTAL WILSON BATTERIES REPLACEMENT', '13'),
(54, '2024-05-31 13:12:43', '9', '', '', '', 'KES', 52260.00, 8362, 60621.60, 'Order Placement', '3', 'BRITAM MURANG\'A UPS REPAIR', '11'),
(55, '2024-06-03 13:12:48', '13', '', '', '', 'KES', 340000.00, 54000, 394000.00, 'Order Placement', '3', 'KWALE PROPOSED MAINTENANCE OF POWER BACKUP SYSTEM', '11'),
(56, '2024-06-03 13:12:52', '7', '', '', '', 'USD', 14000.00, 2240, 16240.00, 'Order Placement', '1', 'BQ AVR RADAR CONFIGURATION', '11'),
(57, '2024-06-05 13:13:08', '12', '', '', '', 'USD', 2345.00, 0, 2345.00, 'Order Placement', '4', 'CCBA UGANDA UPS DIAGNOSIS AND REPORTING', '11'),
(58, '2024-06-10 13:13:13', '12', '', '', '', 'KES', 568611.00, 90978, 659588.76, 'Order Placement', '3', 'CCBA NAIROBI BOTTLERS LINE 3 UPS SPARES AND REPAIR', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

CREATE TABLE `tbl_section` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(4, 'Critical Power Maintenance', 'product_section_561.png', 'Yes', 'Yes'),
(5, 'Critical Power Sales', 'product_section_64.jpg', 'Yes', 'Yes'),
(6, 'IT Maintenance', 'product_section_93.jpg', 'Yes', 'Yes'),
(8, 'IT  Sales', 'product_section_142.png', 'Yes', 'Yes'),
(9, 'Technical Presales', 'product_section_608.png', 'Yes', 'Yes'),
(10, 'Critical Power Warranty', 'product_section_744.jpg', 'Yes', 'Yes'),
(11, 'IT Warranty', 'product_section_106.png', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(30) NOT NULL,
  `department` enum('IT','TS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user_name`, `email`, `role`, `department`) VALUES
(1, 'Kirannnn', 'kiran@gmail.commmm', 'sales', 'IT'),
(2, 'Benjaaa', 'benjamin@gmail.com', 'sales', 'IT'),
(3, 'Fridahhhh', 'fridah@gmail.com', 'sales', 'IT'),
(4, 'Bethuel Ongesa', 'bethuel@gmail.com', 'sales', 'TS'),
(5, 'Sherpard Muzuva', 'sherpard@gmail.com', 'sales', 'IT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_it_request`
--
ALTER TABLE `tbl_it_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_section`
--
ALTER TABLE `tbl_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_it_request`
--
ALTER TABLE `tbl_it_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_section`
--
ALTER TABLE `tbl_section`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
