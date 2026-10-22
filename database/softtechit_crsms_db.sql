-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2025 at 09:22 PM
-- Server version: 8.0.39
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softtechit_crsms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email_id` varchar(200) DEFAULT NULL,
  `mobile_no` varchar(200) DEFAULT NULL,
  `address` longtext,
  `service_id` varchar(200) DEFAULT NULL,
  `complaint` longtext,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=Pending,\r\n1=Done,\r\n2=Cancelled',
  `delete_flag` tinyint NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `name`, `email_id`, `mobile_no`, `address`, `service_id`, `complaint`, `status`, `delete_flag`, `created_at`) VALUES
(1, 'Test', 'test@gmail.com', '9874563210', 'test', '4,7', 'test', 0, 1, '2025-01-02 19:02:45'),
(2, 'prakash', 'softtechsolution2016@gmail.com', '9710934522', 'no 310 gangai amman Koil Street kollumedu', '6,5,1', 'sos', 2, 1, '2025-01-03 13:49:18'),
(3, 'rajesh', 'rockyhayagreeva@gmail.com', '7845131497', 'no 310 gangai amman Koil Street kollumedu', '7,5', 'sos', 1, 1, '2025-01-03 20:48:29'),
(4, 'apauto', '', '9710934522', 'kolathur', '8,8,1,1,12', ' Data Cable Not working and 2 Pc Not Powering On ', 0, 1, '2025-01-07 18:56:37'),
(5, 'Yogi', 'yogeshyogi7920@gmail.com', '07358208692', '671 PALLA STREET, VELLANUR', '4', 'test', 0, 1, '2025-01-19 20:46:19'),
(6, 'Vuji', ' Ijay@gmail.com', '94444312900', 'ChennI', '13', 'Service', 0, 1, '2025-01-20 11:23:22'),
(7, 'Indira builders', '', '7299929720', 'Guindy', '', 'pc quotation, bill delivery', 1, 1, '2025-01-23 07:44:46'),
(8, 'Aathvi Hospital', '', '9345250805', 'Pallavaram', '', 'Three camera installation, Data point checking, Service charges 1200Rs.', 1, 1, '2025-01-23 07:47:14'),
(9, 'Gopal Tea shop', '', '9444732305', 'CMBT', '', 'CCTV service', 0, 1, '2025-01-23 07:48:23'),
(10, 'Ilayabharatham', '', '9566165312', 'Ashok nagar', '', 'Networking work', 2, 1, '2025-01-23 07:49:26'),
(11, 'CMRL', '', '8122414132', 'Poonamallee', '', 'Data work', 1, 1, '2025-01-23 07:50:41'),
(12, 'Itamil', '', '8220901002', 'Annanagar', '', 'Pc check', 0, 0, '2025-01-23 07:52:35'),
(13, 'Suresh home', '', '7299235801', 'Arikambedu', '', 'CCTV work', 0, 0, '2025-01-23 07:57:01'),
(14, 'Iron shop', '', '9841566489', 'Ambattur', '', 'CCTV work', 2, 1, '2025-01-23 07:57:41'),
(15, 'Vikki', '', '6382247451', 'Kovilpathagai', '', 'CCTV -visit', 0, 1, '2025-01-23 07:59:22'),
(16, 'SAP Solutions', '', '9840457157', 'Porur', '', 'Laptop checkup', 0, 0, '2025-01-23 08:00:18'),
(17, 'Arunagiri', '', '9380870707', 'Kollumedu', '', 'CCTV camera DVR shifting', 1, 1, '2025-01-23 08:01:13'),
(18, 'Parthiban', '', '9791128150', 'Poonamallee', '', 'CCTV media convertor-quote', 0, 1, '2025-01-23 08:02:12'),
(19, 'Thilagavathi(Agfa)', '', '9790405598', 'T.Nagar', '', 'AMC visit', 1, 1, '2025-01-23 08:03:21'),
(20, 'Preethi IAS', '', '8807701333', 'Mylapore', '', 'CCTV, Networking service', 0, 1, '2025-01-23 08:04:15'),
(21, 'CVRDE CRPF', '', '8056082930', 'Avadi', '', 'Quote followup', 0, 1, '2025-01-23 08:05:13'),
(22, 'Thiyagarajan', '', '6383273308', 'kalpalayam', '', 'CCTV Visit', 0, 1, '2025-01-23 08:07:02'),
(23, 'Ap.Auto', '', '9500139800', 'Kattur', '', 'CCTV Camera Not Working And Tonner Refelling Old Tonner Billing 2 nos', 1, 1, '2025-01-24 09:13:46'),
(24, 'Kattur home', '', '9710934522', 'Kattur', '', 'CCTV camera 1 no. not working', 0, 1, '2025-01-24 22:02:34'),
(25, 'Watercan company', '', '06383736667', 'Arikambedu', '', 'quote followup', 2, 0, '2025-01-29 11:04:52'),
(26, 'Annies  Shifa Homes', '', '09940213174', 'Thousand Lightschennai-600006', '', 'quote follw up', 0, 0, '2025-01-29 11:05:31'),
(27, 'Indira Projects & Developments', '', '07299929720', 'No 116 Anna Salai,Littel mount \r\nSaidepet,\r\nchennai-600015', '', 'quote follwup', 0, 1, '2025-01-29 11:06:26'),
(28, 'Murugan industries', '', '+91 98401 09817', 'Kattur', '', 'CCTV Camera 1 not working', 0, 1, '2025-01-30 12:02:06'),
(29, 'Murugan Stores  MSSM', '', '9444143334', 'Madhuravoyal', '', 'Hard disk changing Os installaton', 1, 1, '2025-02-03 08:29:23'),
(30, 'Ilaya Bharatham', '', '9566165312', 'Ashok pillar', '', 'CCTV Camera installation ', 1, 1, '2025-02-03 08:30:30'),
(31, 'Vikki', '', '06382247451', 'Kovilpathagai', '', 'CCTV', 0, 0, '2025-02-05 08:39:05'),
(32, 'POTHUR ', '', '8015676850', 'Pothur Uprallayam', '1', 'computer Not working ', 0, 1, '2025-02-05 08:45:40'),
(33, 'Kattur A.p Auto', '', '9500139800', 'Kattur', '', 'WIFI CCTV Camera Fixing', 1, 0, '2025-02-11 08:54:23'),
(34, 'Lachmi Sai Commercial', '', '9884927736', 'Sourcepet', '', 'cctv Not working ', 1, 0, '2025-02-11 08:55:33'),
(35, 's.k Foundation ', '', '6380609714', 'Mandhevellai', '', 'CCtv Not working ', 0, 1, '2025-02-11 08:56:36'),
(36, 'sasi Thrimulloviyal', '', '9003605385', 'Thrimulloviyal', '', 'cctv Installation ', 0, 0, '2025-02-11 08:57:45'),
(37, 'Regal Fin Serrv', '', '9841040404', 'Mogapire', '', 'network Installation', 0, 0, '2025-02-11 08:59:35'),
(38, 'Danush', '', '09629590491', 'NO 1228 THANTARAI MAINROAD\r\nPARIVAKKAM,POONAMALLEE\r\nTRIVALLUR-600056', '', 'cctv visit for Camera replacment shifting ', 1, 0, '2025-02-11 09:41:12'),
(39, 'Dinesh market ', '', '+919940678558', 'Kolarhur', '', 'Barcode printing  problem', 2, 0, '2025-02-11 09:55:01'),
(40, 'S.K.Foundation', '', '6380609714', 'Mandhaveli', '', 'camera not wrking', 1, 0, '2025-02-14 09:09:37'),
(41, 'Indira Projects & Developments', '', '07299929720', 'No 116 Anna Salai,Littel mount \r\nSaidepet,\r\nchennai-600015', '', 'sathish sir sysytem os instsallation work', 1, 0, '2025-02-14 09:12:12'),
(42, 'CMRL', '', '08122414132', 'Poonamallee', '', 'Intercom quotation for 8 extn.,', 0, 0, '2025-02-14 09:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer_list`
--

CREATE TABLE `customer_list` (
  `id` int NOT NULL,
  `cus_name` varchar(200) DEFAULT NULL,
  `cus_address` text,
  `cus_mob_no` varchar(200) DEFAULT NULL,
  `cus_email_id` varchar(200) DEFAULT NULL,
  `cus_gst_no` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `delete_flag` tinyint(1) DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_list`
--

INSERT INTO `customer_list` (`id`, `cus_name`, `cus_address`, `cus_mob_no`, `cus_email_id`, `cus_gst_no`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Vignesh', '132,Dinamani Nagar,\r\nMadurai - 625018', '8695658158', 'big@gmail.com', '851475236985', 1, 1, '2024-12-28 01:07:37', '2024-12-28 01:07:37'),
(2, 'Gokul Nath', 'No.1 street, Singaravelar street, Madha kovil road,\r\nK.pudur,', '8190055500', 'india.abhisanmarketing@gmail.com', '', 1, 1, '2024-12-31 19:29:45', '2024-12-31 19:29:45'),
(3, 'A.P Auto', 'Kattur, SIPCOT, Chennai', '8190055500', '', '', 1, 0, '2025-01-01 12:23:31', '2025-01-01 12:23:31'),
(4, 'ABA Transport', 'Kolathur', '9080886592', '', '', 1, 0, '2025-01-03 22:13:51', '2025-01-03 22:13:51'),
(5, 'Indira Projects & Developments', 'No.116, Anna Salai, Little Mount, Saidapet, Chennai-600015', '7299929720', '', '33AACC15327B1Z5', 1, 0, '2025-01-09 07:20:36', '2025-01-09 07:20:36'),
(6, 'Helmier Pvt Ltd', '377,SREYAS Building\r\nOMR Perungudai\r\nNehru Nagar\r\ntamil Nadu-600096', '73639 61098', '', '33AAFCH9290R1ZS', 1, 0, '2025-01-09 07:28:26', '2025-01-09 07:28:26'),
(7, 'AGFA HEALTHCARE INDIA PRIVATE LIMITED', 'Ground Floor Plot No.15A 3rd Cros Street\r\nNehrunagar,Kottivakkam \r\nChennai-600041', '9790405598', 'thilagavathy.nagarajan@agfa.com', '33AAGCA3797D1ZR', 1, 0, '2025-01-09 07:37:59', '2025-01-09 07:37:59'),
(8, 'AKR INDUSTRIES', '8B/50 Kamaraj Nagar 1st street\r\nMunuperet\r\nChennai 600050', '9884153744', 'Akrindustriesayapakkam@gmail.com', '33BNZPK6106L1ZH', 1, 0, '2025-01-09 07:40:26', '2025-01-09 07:40:26'),
(9, 'Annies  Shifa Homes', 'Thousand Lightschennai-600006', '99402 13174', '', '', 1, 0, '2025-01-09 07:43:17', '2025-01-09 07:43:17'),
(10, 'Arun Aswariyan', 'Periyar Nagar chennai-600082', '9600074262', '', '', 1, 0, '2025-01-09 07:44:17', '2025-01-09 07:44:17'),
(11, 'Aruna Ragav Association', 'Radhakrishna 2nd Mainroad\r\nMylapore', '98845 77508', '', '', 1, 0, '2025-01-09 07:46:57', '2025-01-09 07:46:57'),
(12, 'BENOVELANCE Engennering', 'T-221 Wommens Industerial Estate Thrumullavoyal chennai-600062', ' 6374 464 514', '', '33CLQPSS72M1ZY', 1, 0, '2025-01-09 07:49:03', '2025-01-09 07:49:03'),
(13, 'Combat Vehicles Research & Development Establishme', 'Accounts Office (R&D),\r\nCVRDE, AVADI,\r\nChennai - 600 054', '80560 82930', 'acdacvrde@nic.in', '', 1, 0, '2025-01-09 08:34:03', '2025-01-09 08:34:03'),
(14, 'Ekam Ultra Farms Private Limited', 'Survey No. 9/1, Block No. 7, \r\nDoor No. 20 (130/1)\r\nMount Road, Adyar Village, Saidapet,\r\nChennai Tamil Nadu 600015', '+91 88700 08347', 'aadarsh@gourmetgarden.in', '33AAFCE2765E1ZW', 1, 0, '2025-01-09 08:36:34', '2025-01-09 08:36:34'),
(15, 'Blue ocean Personal and Allied Service Pvt Ltd', 'New No.116/old No.1Anna Salai,\r\nLittel Mount\r\nSidepet,\r\nChennai-600035', '', '', '33AAFCB1539D1Z7', 1, 0, '2025-01-09 08:37:50', '2025-01-09 08:37:50'),
(16, 'HEALTH PHARMACEUTICALS', 'First Floor No.45 Alapakkam Main Road \r\nMaduravoil\r\nchennai-600095', '', '', '33AANFH0024L1ZK', 1, 0, '2025-01-09 08:40:28', '2025-01-09 08:40:28'),
(17, 'IMPRESSION', '9/E, Ground Floor ,Aziz Mulk 7Th Street \r\nThousand lights \r\nchennai-600006', '9884041124', '', '33AHCPA8420B1Z8', 1, 0, '2025-01-09 08:41:42', '2025-01-09 08:41:42'),
(18, 'Indriya Construction', '13, 19th Street, Tansi Nagar, Velachery, \r\nChennai - 600042', '8760716917', '', '33AAEFI1974K1Z9', 1, 0, '2025-01-09 08:44:05', '2025-01-09 08:44:05'),
(19, 'Infonet Solutions', 'No.6, Kutty Street,\r\nNungambakkam,\r\nChennai-600 034', '+91- 44 - 2826 2500', '', '33AAAF12112F1Z8', 1, 0, '2025-01-09 08:45:42', '2025-01-09 08:45:42'),
(20, 'Iyyanar Auto Works', '', '+91 7397 315 455', '', '', 1, 0, '2025-01-09 08:46:36', '2025-01-09 08:46:36'),
(21, 'K PLUS Infotech Pvt Ltd', '42,1st Floor, Sarvodaya Industrial Estate,Offmahakali CavesRd,Near Paper Box,Gundavali,Andher iEast,Mumbai,maharashtra 400093', '+91 97024 29128', '', '', 1, 0, '2025-01-09 08:47:52', '2025-01-09 08:47:52'),
(22, 'Komal Enclave', ' NO 9 Appa Garden Kilpauk\r\nchennai-10', '+91 98401 06864', '', '', 1, 0, '2025-01-09 08:49:35', '2025-01-09 08:49:35'),
(23, 'Kotak Mahindra life insurance company limited', '2nd floor, sri navkar creations, 8/ 33 Gandhi Road, west Tambaram, Chennai - 45.', '', '', '', 1, 0, '2025-01-09 08:50:53', '2025-01-09 08:50:53'),
(24, 'Kotak mahindra Life insurence  company ltd', 'Doshi Towers Kilpauk\r\nchennai', '', '', '7338752132', 1, 0, '2025-01-09 08:51:55', '2025-01-09 08:51:55'),
(25, 'lakshmi sai commercials', 'George Town \r\nchennai\r\ntamil Nadu-60001', '+91 98849 27736', '', '33AJXPK0990M1ZI', 1, 0, '2025-01-09 08:55:08', '2025-01-09 08:55:08'),
(26, 'M/s. LLM Appliances Private Ltd', 'Kelambakkam-Vandalur Road\r\nKolathur Mambakkam\r\nTamil nadu-600127', '', '', '33AAACL1900F1Z9', 1, 0, '2025-01-09 08:56:17', '2025-01-09 08:56:17'),
(27, 'Murugan Stores super market', 'No.18 ranganathan nagar,\r\nAgram main road\r\nSelaiyur chennai-600073', '', '', '33ABLFM0813H1ZJ', 1, 0, '2025-01-09 08:57:38', '2025-01-09 08:57:38'),
(28, 'MUTHU ENTERPRISES', 'NO 1228 THANTARAI MAINROAD\r\nPARIVAKKAM,POONAMALLEE\r\nTRIVALLUR-600056', '9629590491', '', '33ALNPM9808L4ZE', 1, 0, '2025-01-09 08:58:45', '2025-01-09 08:58:45'),
(29, 'NS3TECHSOLUTIONS PRIVATE LIMITED', '301, B-09, 3RD FLOOR, \r\nOLD DLF, SEC-14, Gurgaon, \r\nHaryana, 122001', '8950803350', '', '06AAGCN5589A1ZF', 1, 0, '2025-01-09 09:01:45', '2025-01-09 09:01:45'),
(30, 'PRODUPAK AGRO PRIVATE LIMITED', 'NO.1 Achi Street Aynambakkam \r\nchennai-600095', '+91 94457 63630', 'info@produpak.com', '33AAMCP1060C1ZW', 1, 0, '2025-01-09 09:04:00', '2025-01-09 09:04:00'),
(31, 'QUARTILE', 'No.l5,Sindhu Apartment,\r\n7th Avenue,Anna nagar\r\nchennai-600040\r\n', '', '', '33AABFQ0619E1ZT', 1, 0, '2025-01-09 09:04:43', '2025-01-09 09:04:43'),
(32, 'R.S.M VEGETABLE SHOP', 'NO15TG ANNA NAGAR AYNAMBAKKAM MAIN ROAD \r\nAMBATHUR CHENNAI-53', '9841453141', '', '', 1, 0, '2025-01-09 09:05:53', '2025-01-09 09:05:53'),
(33, 'Rajeswari steel Traders', 'No.10 venketachalam Road Anbethker Nagar\r\nAreakembeaduchennai -600062\r\n', '9791677956', '', '33CFNPR4683C1Z7', 1, 0, '2025-01-09 09:06:44', '2025-01-09 09:06:44'),
(34, 'Rathna Stores', 'No.269A,2nd floor,MKN Road\r\nAlandur,Chennai-600016', '9884236780', 'rathanawiderangetrade@gmail.com', '33BGKPR8075H2ZW', 1, 0, '2025-01-09 09:09:48', '2025-01-09 09:09:48'),
(35, 'RDC Concrete (India) Ltd', 'Mumbai â€“ HO, 7th Floor, ThaneOne Corporate IT Park, Next to Tatvagyan Vidyapeeth, Ghodbunder Road, Thane (West), 400 610', '+91 99691 54811', 'executive7.ithelpdesk@rdcconcrete.com', ' 29AAACU0108Q1Z4', 1, 0, '2025-01-09 09:12:27', '2025-01-09 09:12:27'),
(36, 'RR Enterprices', 'No: 18, Balaji Nagar Industrial Estate, Ambattur, Chennai, Tamil Nadu 600053', '33AAAPR6067Q1Z5', '', '+91 99625 21225', 1, 0, '2025-01-09 09:14:31', '2025-01-09 09:14:31'),
(37, 'Sai Nama Tours And Traveles', 'AnnaNagar\r\nChennai-600062', '+91 70928 58000', '', '', 1, 0, '2025-01-09 09:17:15', '2025-01-09 09:17:15'),
(38, 'Santharaman.V', 'Aynavaram\r\nchennai-82', '9176000927', 'vvsantha@gmail.com', '', 1, 0, '2025-01-09 09:18:31', '2025-01-09 09:18:31'),
(39, 'SK FOUNDATIONS', 'Mandhevelai\r\nchennai-600004', '+91 98414 53846', '', '33CQFPP8711A1Z5', 1, 0, '2025-01-09 09:20:28', '2025-01-09 09:20:28'),
(40, 'SPECIAL WIRE PRODUCTS PVT LTD', 'NO 235, SIDCO INDUSTRIAL ESTATE\r\n9TH STREET, AMBATHUR,\r\nCHENNAI - 600 098.', '+91 99402 61554', '', '33AABCS0314F1Z3', 1, 0, '2025-01-09 09:25:53', '2025-01-09 09:25:53'),
(41, 'Spring Field', 'cmbt', '+91 98847 07915', '', '', 1, 0, '2025-01-09 09:26:43', '2025-01-09 09:26:43'),
(42, 'SRI THiruthunai Builders & Foundations', 'No-71/3 TNBH Colony \r\nAnnanur Road Ayapakkam \r\nchennai-600077', '+91 86089 05570', '', '', 1, 0, '2025-01-09 09:27:50', '2025-01-09 09:27:50'),
(43, 'Ugra Technical& Engineering Company', 'Pl.No-90,91,Vijya Lashmi Nagar \r\nNew Vellanor\r\nChennai-600062', '+91 88389 45095', '', '33AQDPV2945G1ZR', 1, 0, '2025-01-09 09:29:29', '2025-01-09 09:29:29'),
(44, 'V.P Techenical Solutions', 'No.203a green Park\r\nThiruverkadu\r\nchennai-600077\r\n', '', '', '33CVQPP5862A1ZE', 1, 0, '2025-01-09 09:30:29', '2025-01-09 09:30:29'),
(45, 'SVJ Lasertech', 'Plot No.90,Ishwaryam Nagar,\r\nKattur,THrimullaivoyal,\r\nChennai-600062', '+91 95431 92263', '', '33ADUFS9534N1Z3', 1, 0, '2025-01-09 09:33:15', '2025-01-09 09:33:15'),
(46, 'Hindustan Oil Exploration Company Limited,', 'Lakshmi Chambers, 192, St Maryâ€™s Road,\r\nAlwarpet Chennai â€“ 600018.', '+91 73580 47203', '', '', 1, 0, '2025-01-13 16:33:19', '2025-01-13 16:33:19'),
(47, 'Nagadeepak', 'ASHOK NAGAR', '+91 93610 31901', '', '', 1, 0, '2025-01-22 08:20:04', '2025-01-22 08:20:04'),
(48, 'Arunagiri', 'Kollumedu', '9380870707', '', '', 1, 0, '2025-01-22 08:56:18', '2025-01-22 08:56:18'),
(49, 'Parthiban', 'Poonamallee', '9791128150', '', '', 1, 0, '2025-01-22 08:57:14', '2025-01-22 08:57:14'),
(50, 'Yamuna Indira Builders', 'Guindy', '9499972493', '', '', 1, 0, '2025-01-22 16:01:35', '2025-01-22 16:01:35'),
(51, 'Sree Pavithra Industries', '26b/9, Shed no.5, 5th street, SIDCO Industrial estate, Ambattur, Chennai, TAMILNADU-600098', '9789000681', '', '33BXVPJ7456G1ZY', 1, 0, '2025-01-22 17:20:32', '2025-01-22 17:20:32'),
(52, 'IRCON INTERNATIONAL LIMITED CHENNAI METRO RAIL PROJECT', '2ND FLOOR, PLOT NO.7 (ADJACENT TO QMAX SYSTEMS) RUKMANI NAGAR, 4TH STREET, \r\nPOONAMALLEE, CHENNAI - 600056,\r\nTAMIL NADU. ', '8122414132', '', '33AAACI0684H3ZR', 1, 0, '2025-01-22 17:28:02', '2025-01-22 17:28:02'),
(53, 'Sureshkumar', 'Arikambedu, chennai', '7299235801', '', '', 1, 0, '2025-01-22 22:56:01', '2025-01-22 22:56:01'),
(54, 'Sanjana Jothi Kumar', 'Thrimullaivoyal', '8838540715', '', '', 1, 0, '2025-01-23 10:26:35', '2025-01-23 10:26:35'),
(55, 'Ilaya Bharatham', 'Ashok nagar', '9566165312', '', '', 1, 0, '2025-01-24 12:45:22', '2025-01-24 12:45:22'),
(56, 'Vicky', 'Kovilpathagai, Avadi', '06382247451', '', '', 1, 0, '2025-01-25 15:13:25', '2025-01-25 15:13:25'),
(57, 'Watercan company', 'Arikambedu', '6383736667', '', '', 1, 0, '2025-01-25 15:34:34', '2025-01-25 15:34:34'),
(58, 'Sainamam Tours Pvt Ltd ', 'Flat No.6, First Floor, Sai Krupa Flats, AC 67, 1st St, AC Block, Anna Nagar, Chennai, Tamil Nadu', '+91 70928 58000', '', '', 1, 0, '2025-01-27 11:54:24', '2025-01-27 11:54:24'),
(59, 'Surya', 'Chicken shop, Arikambedu', '8111044454', '', '', 1, 0, '2025-01-30 10:14:08', '2025-01-30 10:14:08'),
(60, 'Murugan industries', 'Kattur', '09840109817', '', '', 1, 0, '2025-01-30 12:14:52', '2025-01-30 12:14:52'),
(61, 'SASI Madam', 'Thrimulloviyal', '9003605385', '', '', 1, 0, '2025-01-31 22:37:32', '2025-01-31 22:37:32'),
(62, 'Kotak Life Insurance ', 'Ashok Nagar tamilNadu Chennai-600083', '8248534263', '', '', 1, 0, '2025-02-06 17:01:13', '2025-02-06 17:01:13'),
(63, 'Regal Finserrv  Tax Consultants', '2nd Floor, Flat No.250/Door No.42, DS EPITOME, TNHB 2nd Street, Periyar Nagar, Korattur, Chennai, Tamil Nadu, 600080', '9841040404', '', '33AUZPP6554F3ZY', 1, 0, '2025-02-08 11:23:58', '2025-02-08 11:23:58'),
(64, 'Annai Laser Tech Unit-3', '14/B  Bala Vinigiyar Koil Street Ganapathy Nagar \r\nEkattunthangal\r\nchennai-600032', '7200060396', 'annailasertech@gmail.com', '33BHSPM6643M1ZN', 1, 0, '2025-02-12 12:02:23', '2025-02-12 12:02:23'),
(65, 'Jebin castrol', 'medavakkam', '+91 89395 62246', '', '', 1, 0, '2025-02-12 17:52:52', '2025-02-12 17:52:52'),
(66, 'Nethra', 'Pothur', '8122866815', '', '', 1, 0, '2025-02-15 10:20:11', '2025-02-15 10:20:11'),
(67, 'D99 Automation', 'Ambattur', '09629590491', '', '', 1, 0, '2025-02-15 18:34:43', '2025-02-15 18:34:43'),
(68, 'Arunai Info Solutions', 'No.35, F2, SK Enclave, Shankar Nagar 2nd Street, Chrompet, Chennai - 600 044.', '09345250805', 'arunaiinfosolutions@gmail.com', '33BRTPS6128Q1ZR', 1, 0, '2025-02-18 18:44:57', '2025-02-18 18:44:57'),
(69, 'Ravichandran & Thangaraj Associates', '1St Floor, 6/1, Bharathi Apartment, Bharathi Nagar 3rd Street, T.Nagar, Chennai-600017', '+91 95001 27126', '', '', 1, 0, '2025-02-19 08:50:41', '2025-02-19 08:50:41'),
(70, 'Radhakrishnan V', 'Kollumedu, Chennai', '8608182793', '', '', 1, 0, '2025-02-20 22:01:07', '2025-02-20 22:01:07'),
(71, 'Itamil Networks', 'Annanagar', '08220901002', '', '', 1, 0, '2025-02-21 20:56:57', '2025-02-21 20:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int NOT NULL,
  `tran_id` int NOT NULL,
  `payment_date` date NOT NULL,
  `amount` float(15,2) NOT NULL DEFAULT '0.00',
  `payment_type` varchar(200) NOT NULL,
  `payment_desc` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` char(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `tran_id`, `payment_date`, `amount`, `payment_type`, `payment_desc`, `created_at`, `status`) VALUES
(1, 8, '2025-02-11', 850.00, 'Cash', '', '2025-02-11 14:13:09', '1'),
(2, 8, '2025-02-11', 6850.00, 'Net Banking', 'full Payment Done ', '2025-02-11 21:37:00', '0'),
(3, 4, '2025-02-11', 23069.00, 'Cash', 'Done', '2025-02-11 21:40:05', '0'),
(4, 5, '2025-02-07', 1000.00, 'Cash', 'half Payment', '2025-02-11 21:40:34', '0'),
(5, 5, '2025-02-11', 3130.00, 'Cash', 'paid', '2025-02-11 21:41:20', '0'),
(6, 3, '2025-02-12', 815.00, 'Cash', '', '2025-02-12 21:09:31', '1'),
(7, 9, '2025-02-12', 26550.00, 'Net Banking', 'Payment cleared', '2025-02-13 09:58:18', '0'),
(8, 13, '2025-02-13', 780.00, 'Cash', '', '2025-02-14 18:59:44', '0'),
(9, 14, '2025-02-15', 23200.00, 'Cash', '', '2025-02-20 14:52:05', '0');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `hsn_code` varchar(200) DEFAULT NULL,
  `product_code` varchar(200) DEFAULT NULL,
  `buy_price` float(15,2) NOT NULL DEFAULT '0.00',
  `price` float(15,2) NOT NULL DEFAULT '0.00',
  `image_path` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `name`, `description`, `hsn_code`, `product_code`, `buy_price`, `price`, `image_path`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'SSD Hard disk 512 GB', 'SSD', '546846', NULL, 0.00, 3500.00, 'uploads/products/1.png?v=1735712704', 1, 1, '2022-04-21 10:57:02', '2025-01-03 22:14:35'),
(2, 'SMPS 600W', '600W', '9954', NULL, 0.00, 1250.00, 'uploads/products/2.png?v=1735712762', 1, 1, '2022-04-21 10:59:46', '2025-01-03 22:14:30'),
(3, 'Product No 3', 'Product No 2 desv', 'Pro_003', NULL, 0.00, 500.00, '', 1, 1, '2024-12-28 00:43:36', '2025-01-01 11:56:07'),
(4, 'DDR 4 RAM 16GB', 'Amazon.in: Buy Crucial 64GB Kit (2x32GB) DDR4-3200 UDIMM CL22 (16Gbit) Online ', '6546984', '0245', 0.00, 5000.00, 'uploads/products/4.png?v=1735653665', 1, 1, '2024-12-31 19:31:05', '2025-01-03 22:14:26'),
(5, 'Supply of HIKVISION 2MP Eco HD 1080P Day Night Vision Bullet Outdoor Wired CCTV Camera', 'Hikvision 2 Megapixel Outdoor True Day/Night, Smart IR\r\nUp to 20m IR distance', '8525', 'Hickvison 2Mp Bullet Eco', 1250.00, 1050.00, 'uploads/products/5.png?v=1737781222', 1, 0, '2025-01-03 22:18:51', '2025-02-20 21:59:50'),
(6, '  Supply of Seagate 2TB Desktop Harddisk Model (ST2000DM005)', '3.5 Inch SATA 6Gb/s 256MB Cache Desktop HDD Internal Hard Drive 2 Year Warranty', '84717020', 'Seagate 2TB  desktop hdd', 3500.00, 4860.00, 'uploads/products/6.png?v=1735925931', 1, 0, '2025-01-03 23:08:51', '2025-02-09 21:00:23'),
(7, 'Supply and Fixing of Rack Box with all Suitable Fitting Accceries ', '40D x 40.5W x 15.5H Centimeters', ' 7326', '2U Metel Rack', 450.00, 750.00, 'uploads/products/7.png?v=1736397163', 1, 1, '2025-01-09 10:02:43', '2025-02-06 10:12:50'),
(8, 'Supply of 12V 7Ah Ups Battry  ', 'sealed Maintenence free Ups Battry For Computer', '8506', 'Ups Battry', 675.00, 1250.00, 'uploads/products/8.png?v=1736397550', 1, 0, '2025-01-09 10:09:10', '2025-01-09 19:16:48'),
(9, ' Supply of Cooler Master Hyper T20 CPU Cooler', '', '8504', 'Coller Master T-20', 1000.00, 1200.00, 'uploads/products/9.png?v=1736398051', 1, 0, '2025-01-09 10:17:31', '2025-02-06 10:06:35'),
(10, 'Windows 10 Preactivated software with basic software Installation ', '', '8523', 'win10', 1000.00, 800.00, 'uploads/products/10.png?v=1736398492', 1, 0, '2025-01-09 10:21:56', '2025-01-09 10:46:38'),
(11, 'Supply and Installation of windows 11 with Basic Software installation ', '', '8525', 'windows11', 1000.00, 800.00, 'uploads/products/11.png?v=1736398590', 1, 0, '2025-01-09 10:26:30', '2025-01-31 20:43:46'),
(12, ' Supply of HIKVISION 4CH DVR 1080P Lite H.265+ DVR Model(DS-7104HGHI-K1)', 'HDTVI/AHD/CVI/CVBS/IP video input[Support all brands cameras Upto 2MP', '8521', 'Hickvision 4CH DVR', 2500.00, 2800.00, 'uploads/products/12.png?v=1736430674', 1, 0, '2025-01-09 19:21:14', '2025-02-08 13:10:45'),
(13, ' Supply of Blue Feather 500 GB 3.5 inch SATA Internal Hard Disk', 'Drive for Desktop and Surveillance System (BFDT50S) High-Speed Data Transferring with 1 Years Warranty', '8471', 'Blue Fether 500gb', 850.00, 1800.00, 'uploads/products/13.png?v=1736430855', 1, 1, '2025-01-09 19:24:15', '2025-02-09 20:45:51'),
(14, 'Supply and Fixing of cctv Camera fitting Accessories', '', '90069', 'CCTV camera fitting Accessories', 200.00, 400.00, 'uploads/products/14.png?v=1736431026', 1, 0, '2025-01-09 19:27:06', '2025-01-30 12:16:31'),
(15, 'Supply of Seagate 1 TB Internal Hard Drive HDD 3.5 Inches (8.8 cm)', ' SATA 6 Gb/s 7200 RPM 64 MB Cache for Computer Desktop PC (ST1000DM010)', '8471', 'Seagate 1Tb Desktop Harddisk', 3100.00, 3499.00, 'uploads/products/15.png?v=1739115459', 1, 0, '2025-01-09 19:31:16', '2025-02-09 21:07:39'),
(16, 'Supply of Seagate Skyhawk 1 TB Surveillance Internal Hard Drive ', 'Security Camera System with Drive Health Management, with 3 yr Rescue Data Recovery Services (ST1000VX013)', '8471', 'Segate 1Tb survellance  Harddis', 4400.00, 3100.00, 'uploads/products/16.png?v=1736431458', 1, 0, '2025-01-09 19:34:18', '2025-01-25 09:42:40'),
(17, 'Supply of Seagate Skyhawk 2 TB Surveillance Internal Hard Drive ', 'HDD â€“ 3.5 Inch Security Camera System with Drive Health Management, with 3 yr Rescue Data Recovery Services (ST2000VX017)', '8471', 'Segate 2 TB Survellance Harddisk', 4690.00, 6100.00, 'uploads/products/17.png?v=1736431729', 1, 0, '2025-01-09 19:38:49', '2025-02-10 21:17:44'),
(18, 'Supply of Seagate Skyhawk 4 TB Surveillance Internal Hard Drive ', 'HDD â€“ 3.5 Inch Security Camera System with Drive Health Management, with 3 yr Rescue Data Recovery Services (ST4000VX013)', '8471', 'Segate 4TB', 9950.00, 9980.00, 'uploads/products/18.png?v=1736431845', 1, 1, '2025-01-09 19:40:45', '2025-01-22 23:10:51'),
(19, 'Supply of HIKVISION 8CH DVR 1080P Lite H.265Pro+ 2MP DVR-Model (DS-7108HGHI-K1)', '', '8521', 'Hickvision 8ch DVR', 3300.00, 3800.00, 'uploads/products/19.png?v=1736431974', 1, 0, '2025-01-09 19:42:54', '2025-02-08 13:20:58'),
(20, 'Supply of HIKVISION 16CH 2MP DVR 1080P Lite H.265Pro+ Model (DS-7116HGHI-K1)', '', '8521', 'Hickvision 16cH DVR', 6400.00, 7100.00, 'uploads/products/20.png?v=1736432093', 1, 0, '2025-01-09 19:44:53', '2025-02-08 13:15:30'),
(21, 'Supply of HIKVISION 16CH H.265 Ausens DVR [iDS-7116HQHI-M1/S] for CCTV Cameras', '', '8521', '16CH Hickvision Accusence DVR', 10100.00, 11500.00, 'uploads/products/21.png?v=1736432255', 1, 0, '2025-01-09 19:47:35', '2025-02-08 13:16:34'),
(22, 'Supply of HIKVISION 8 Channel H.265 AcuSense DVR [iDS-7108HQHI-M1/S]', '', '8521', 'Hickvision 8CH Accusence  DVR', 5800.00, 6200.00, 'uploads/products/22.png?v=1736432373', 1, 0, '2025-01-09 19:49:33', '2025-01-31 20:41:51'),
(23, 'Supply of Lapcare LPC2612A Toner Cartridge ', 'Compatible Model HP LaserJet 1010/1012/1015/1018/1020/1022/1022n/1022nw/3015/3020/3030/3050/3050z/3052/3055/M1319f/M1005', '8443', 'Lapcare 12A ', 450.00, 650.00, 'uploads/products/23.png?v=1736432506', 1, 0, '2025-01-09 19:51:46', '2025-01-31 21:08:19'),
(24, 'Supply of Lapcare  88A/CC388A', ' Laser Toner Printer Cartridge | for HP Laser Jet P1007/P1008', '8443', '88 A Tonner', 550.00, 650.00, 'uploads/products/24.png?v=1736432864', 1, 0, '2025-01-09 19:57:44', '2025-01-31 21:00:15'),
(25, ' Supply of FYBER 4 Channel CCTV SMPS Power Supply', '12v 5a Output, Each Port 1.25a Output\r\nInput 220v with Highly Integrated SMPS Switcher I.C Design\r\nOver Heat & Voltage Protection\r\nHighly Efficient & Consumes Low Power', '8504', 'Fyber 4ch smps', 450.00, 549.00, 'uploads/products/25.png?v=1736433012', 1, 0, '2025-01-09 20:00:12', '2025-01-25 10:24:15'),
(26, 'Supply of FYBER 8 Channel CCTV SMPS Power Supply', '', '8504', 'Fyber 8Ch Smps', 650.00, 850.00, 'uploads/products/26.png?v=1736433134', 1, 0, '2025-01-09 20:02:14', '2025-01-09 20:38:05'),
(27, 'Supply of HIKVISION 8 Channel 12V 10A Switch Power Supply', ' CCTV/SMPS DS-2FA120A-DW-IN ', '8504', 'Hickvision 10 Ams smps', 750.00, 950.00, 'uploads/products/27.png?v=1736433289', 1, 0, '2025-01-09 20:04:49', '2025-01-31 20:39:56'),
(28, 'Supply of Hickvison 20 Ams Power supply', ' DS-2FA120K-DW-IN 12V 20A CCTV Power Supply', '8504', 'Hickvision 20 Ams smps', 1500.00, 1949.00, 'uploads/products/28.png?v=1736433396', 1, 1, '2025-01-09 20:06:36', '2025-01-25 09:39:22'),
(29, ' Supply of Hick Vision 2Mp Indoor Doom 1080p Day &Night Camera Model( Ds-2CE5AD0T-Itp Eco)', 'True Day/Night, Smart IR\r\nUp to 20m IR distance', '9006', 'Hickvision 2mP Doom Eco', 850.00, 1200.00, 'uploads/products/29.png?v=1736433560', 1, 0, '2025-01-09 20:09:20', '2025-02-06 10:07:13'),
(30, 'Supply of Molex CAT 6 UTP Pure copper cable  Cable 305M Box', 'Conductor: Bare Copper Wire 23AWG\r\nCable diameter - in. (mm): 0.23 (5.8) Nom', '8544', 'molex 305 mts', 8800.00, 8950.00, 'uploads/products/30.png?v=1736783170', 1, 0, '2025-01-13 21:16:05', '2025-01-13 22:08:35'),
(31, 'Supply of Molex Dual face Plate with I/O set  ', ' Material Base, Holder, Cover: ABS UL94V-0\r\n Label protector: Transparent PCc UL94V-0', '8517', 'Molex cat6 i/o face plate ', 0.00, 480.00, 'uploads/products/31.png?v=1736783691', 1, 0, '2025-01-13 21:24:48', '2025-01-13 22:38:30'),
(32, 'Supply of molex 2mts Cat6UTP Patch cable ', ' Conductor size: 24 AWG stranded\r\n copper wire\r\n Nom. O.D.: 5.9mm\r\nSheath: PVC Bend radius: 4X O.D.Operating temperature range: -20Â°C to 60Â°C', '8544', 'Molex 2mts Patch cable ', 140.00, 180.00, 'uploads/products/32.png?v=1736783823', 1, 0, '2025-01-13 21:27:03', '2025-01-13 22:10:30'),
(33, 'Data Point numbering and Testing ', '', '', 'Numbering and testing ', 60.00, 60.00, 'uploads/products/33.png?v=1736784149', 1, 1, '2025-01-13 21:32:28', '2025-01-13 21:41:28'),
(34, 'Supply of 25mm Pvc  conduct and casing capping ', '', '', '25mm Pvc Pipe ', 22.00, 40.00, 'uploads/products/34.png?v=1736784261', 1, 0, '2025-01-13 21:34:21', '2025-02-18 20:56:56'),
(35, 'Supply of Western Digital WD Blue SN580 NVMe 1TB, Upto 4150MB/s,  PCIe Gen 4 NVMe M.2 (2280),', '', '8523', 'SSD', 5300.00, 6000.00, 'uploads/products/35.png?v=1737514633', 1, 0, '2025-01-22 08:27:13', '2025-02-07 21:16:11'),
(36, 'Supply of HDMI TO FIBER CONVERTER WITH USB PORT', 'Extends the video upto 20km through single fiber optical cable', '8517', 'HDMA MEDIA CONVERTOR', 5550.00, 7500.00, 'uploads/products/36.png?v=1737515495', 1, 0, '2025-01-22 08:41:35', '2025-01-31 20:39:20'),
(37, 'Syrotech Media Converter Single Mode Dual Fiber 10/100 20 km', '10/100Mbps auto-sensed, easily upgrade Full-duplex and half-duplex auto-sensed', '5201', 'Media Converter', 2500.00, 2400.00, 'uploads/products/37.png?v=1737516238', 1, 0, '2025-01-22 08:53:58', '2025-01-22 08:53:58'),
(38, ' Supply of 2 core single mode fibre cable', '2 Core fiber cable, 2 core ofc, DROP CABLE, fiber optical cable, FTTH CABLE, HO FIBER, internet cable, INTERNET OPTICAL FIBER CABLE, OFC', '8544', '2 Core Optical Fiber Cable', 12.00, 20.00, 'uploads/products/38.png?v=1737517243', 1, 0, '2025-01-22 09:10:43', '2025-01-31 20:34:24'),
(39, 'Supply of Single Mode SC To SC Optical Fiber Patch Cord 9/125 Jumper Cable (FSMS LC/UPC-SC/UPC) (5 Meter, 1)Single Mode LC To SC Optical Fiber Patch Cord 9/125 Jumper Cable (FSMS LC/UPC-SC/UPC) (5 Meter, 1)', 'MAKE IN INDIA Single Mode, G.657A1,LSZH, 3.0mm, Simplex, Yellow, Mechanical Specification: Connector Ferrule, Repeatability:Less than 0.02dB 200 times mating cycles, Working Temperature : â€“10Â°C ~+70Â°C, Storage Temperature : â€“20Â°C ~+70Â°C', '8544', 'SC Patch cable', 300.00, 300.00, 'uploads/products/39.png?v=1737517961', 1, 0, '2025-01-22 09:22:41', '2025-02-07 21:12:40'),
(40, ' Supply of Western Digital Blue SA510 1TB 2.5-inch SATA III Internal SSD', '1TB capacity\r\n2.5-inch SATA III, 6 Gbps\r\nUp to 560 MB/s read speed\r\nDurable, low power', '8471', 'WD Blue 1TB  SSD', 0.00, 7100.00, 'uploads/products/40.png?v=1737523159', 1, 0, '2025-01-22 10:14:36', '2025-02-07 21:14:51'),
(41, ' Supply of Western Digital WD Blue SA510 SATA 500GB,', ' Up to 560MB/s, 2.5 Inch/7 mm, 1Y Warranty, Internal Solid', '8471', 'WD 500 GB SSD', 0.00, 3400.00, 'uploads/products/41.png?v=1737524983', 1, 1, '2025-01-22 11:19:43', '2025-02-09 19:17:58'),
(42, 'Supply of GIGABYTE Lga 1150 Intel H81 Usb3.0/Sata 6Gbs Hdmi Dual Uefi Bios Matx DDR4 Motherboard Ga-H81M-H', '', '8473', 'Gigabyte H81 motherboard', 0.00, 5500.00, 'uploads/products/42.png?v=1737525296', 1, 0, '2025-01-22 11:24:56', '2025-01-31 20:37:50'),
(43, 'Supply Zebronics 450W Black Desktop SMPS', '3X SATA connectors, 2X Molex, 80mm Built-in Fan, Extra Long Cables, 1.2 Meter Power Cable and Suitable for Regular use Computers with 1 yr warranty', '8504', 'Zebronics 450W  SMPS', 0.00, 750.00, 'uploads/products/43.png?v=1737525645', 1, 0, '2025-01-22 11:30:45', '2025-01-31 20:59:13'),
(44, 'Supply of Ant Esports SX310 PRO Mid- Tower Computer Cabinet', '', '8473', '', 0.00, 1800.00, 'uploads/products/44.png?v=1737526482', 1, 0, '2025-01-22 11:44:42', '2025-01-24 12:19:13'),
(45, 'Supply of Zebronics Smash Zeb-195B Entry Level Cabinet', '', '', 'Zebronic cabinet entrey', 0.00, 1500.00, 'uploads/products/45.png?v=1737526829', 1, 0, '2025-01-22 11:50:29', '2025-02-07 21:16:56'),
(46, 'Supply of Consistent H-310 Motherboard 8th, 9th Gen i3, i5, i7, DDR4 Slots for RAM, with GMA', 'Supports 8th and 9th Gen Intel Core i3, i5, and i7 processors:', '8473', 'consisten 310 Mother Board', 0.00, 4100.00, 'uploads/products/46.png?v=1737526990', 1, 0, '2025-01-22 11:53:10', '2025-01-31 20:34:53'),
(47, 'Supply of Crucial Basics 16GB DDR4 2666Mhz Desktop RAM', 'The DDR4 RAM is rated at 1.2V and has a latency of CL19. It can operate at a max of 3200MT/s.', '8473', 'Crucial 16Gb DDR4', 0.00, 2700.00, 'uploads/products/47.png?v=1737527155', 1, 0, '2025-01-22 11:55:55', '2025-02-09 13:09:17'),
(48, 'Supply of Intel Core i5 8th Generation, 9M Cache, Processor for LGA1151 Socket with 1 Year', '', '8471', 'i5 8th gen processor', 0.00, 5800.00, 'uploads/products/48.png?v=1737527695', 1, 0, '2025-01-22 12:04:55', '2025-01-31 20:35:59'),
(49, 'Supply of TPLINK Wireless Router TL-WR850N 300 Mbps Router', 'TP Link TL-WR850N\r\nEasy wireless security encryption at a push of WPS button\r\nIP based bandwidth control allows administrators to determine how much bandwidth is allotted to each PC', '998422', 'TP Link router dual band', 930.00, 2500.00, 'uploads/products/49.png?v=1737536264', 1, 0, '2025-01-22 14:27:44', '2025-02-07 21:13:47'),
(50, 'TallyPrime 5.1 - Best Business Management Software', 'TallyPrime 5.1 Life Time  single User', '8523', 'Tally Prime 5.1', 0.00, 22500.00, 'uploads/products/50.png?v=1737539999', 1, 0, '2025-01-22 15:29:59', '2025-01-22 15:29:59'),
(51, 'Supply of WD SN740 Black 512GB M.2 2242 42mm PCIe Gen 4 x4 TLC PC NVME, for Lenovo thinkpad X1 Nano Titanium Flex E14 E15 gen 4, Ideapad Gaming Laptop Ultrabook Tablet - Internal Solid State Drive', 'With 1Year Warranty', '8471', 'M.2 Nvme ssd ', 0.00, 5800.00, 'uploads/products/51.png?v=1737541803', 1, 0, '2025-01-22 16:00:03', '2025-02-09 10:13:01'),
(52, 'Supply of Microsoft 365 is a product family of productivity software, collaboration and cloud-based services owned by Microsoft', '', '49011010', 'Ms office 365', 0.00, 3500.00, 'uploads/products/52.png?v=1737546442', 1, 0, '2025-01-22 17:17:22', '2025-01-31 20:44:13'),
(53, 'Supply of Dlink 16-Port 10/100/1000 Gigabit Network Switch Model-( DGS-1016D)', 'D-Link Green Features.\r\nMedia Interface Exchange\r\nStore-and-Forward switching method\r\nMAC Address Table\r\nSwitching Capacity', '8517', 'Dlink 16 port Gigabit switch 10/100/1000', 4720.00, 4500.00, 'uploads/products/53.png?v=1737548318', 1, 0, '2025-01-22 17:48:38', '2025-02-08 22:01:47'),
(54, 'Supply of DlinkSingle  face Plate with I/O and Backbox set', '', '8517', 'Dlink Face Plate  Combo', 180.00, 360.00, 'uploads/products/54.png?v=1737549129', 1, 0, '2025-01-22 18:02:08', '2025-02-08 10:25:38'),
(55, 'Supply of D-Link RJ45 Cat 6 Patch Cord for Modem (Grey, 2 m)', '2 meter stranded type\r\nConductor: 24 AWG\r\nSnagless cable\r\n1000base-t Ethernet transmission', '8544', 'D-line 2 mtr patch cable', 125.00, 195.00, 'uploads/products/55.png?v=1737549334', 1, 0, '2025-01-22 18:05:34', '2025-01-22 18:05:34'),
(56, 'Supply of 2U Rack - DVR/NVR/Server/Network Rack with 3 Power Socket Plug Surge Protector Metal Cabinet Box - Wall Mount Iron Wall Shelf  (Number of Shelves - 0, Grey)', '2U wall-mount Rack/Cabinet shelf or self-standing & is great for organizing your DVR-NVR-Server-Network devices. 2U rack has akey lock feature for keeping your device safe in this cabinet. This rack is made with the highest care while making it. Since making its quality, best, 6-way processed powder coating is done for long-lasting, Corrosion and Rustproof. Rack size: 40 X 40 X 15 CM. Weight: 3.70 kg. Colour: Gray.', '7326', '2U metal rack', 650.00, 750.00, 'uploads/products/56.png?v=1737549649', 1, 0, '2025-01-22 18:10:49', '2025-02-06 10:14:33'),
(57, 'Supply of Dauha 16 Channel Penta-brid 5M-N/1080P Compact 1U 1HDD WizSense Digital Video Recorder', ' H.265+/H.265 dual-stream video compression\r\nSupports Full-channel AI Coding\r\nSupports HDCVI/AHD/TVI/CVBS/IP video inputs\r\nMax 24 channels IP camera inputs, each channel up to 6MP; Max 128 Mbps incoming bandwidth\r\n\r\n Long transmission distance over coax cable\r\n Up to 16 channels video stream (analog channel) SMD Plus', '8521', 'Dauha 16CH NVR', 0.00, 19500.00, 'uploads/products/57.png?v=1737553984', 1, 0, '2025-01-22 19:23:04', '2025-01-22 20:06:00'),
(58, 'Supply of HI-FOCUS 16 Port Poe network Switch', 'Supports IEEE 802.3af / at standard, automatically detects and identifies\r\ndevices that comply with the IEEE 802.3af / at standard and supply power to it\r\nSupport Auto MDI/MDIXï¼›\r\nAdopt store-and-forward exchange methodEasy to use, with no configuration and installation needed', '8517', '16 Port Poe network Switch', 0.00, 12500.00, 'uploads/products/58.png?v=1737556753', 1, 1, '2025-01-22 19:38:09', '2025-02-08 23:00:42'),
(59, 'Supply of 9U Metal Rack With All Fitting Accessories', 'MASS RACK 9U 550X500mm Rack with PDU 6 Socket, 10\" Tray(2 Nos), Cable Organiser 1U Closed, 2 Fan & Hardware Kit - Combo Pack', '9403', '9U Metal Rack ', 0.00, 6200.00, 'uploads/products/59.png?v=1737558314', 1, 0, '2025-01-22 19:42:50', '2025-01-22 20:36:01'),
(60, 'Supply of Seagate Skyhawk 8TB Surveillance Systems Internal Hard Disk Drive (HDD) (ST8000VE001)  (Interface: SATA, Form Factor: 3.5 inch)', '', '8471', 'Segate 8Tb Surveillance internal Harddisk', 0.00, 19200.00, 'uploads/products/60.png?v=1737557300', 1, 0, '2025-01-22 19:52:37', '2025-02-08 13:26:43'),
(61, 'Supply of Eyeon 4Mp Ip Camera', 'Lens: 3.6mm\r\nResolution: 4MP\r\nFrames Per Second: 25\r\nVideo Compression: H.264 / H.265\r\nDual Stream: Yes\r\nIP Protocol: Onvif\r\nProcessor: Hisilicon/Fulhan\r\nDWDR: Yes\r\nInfrared Leds: Dual Light (Infrared / Warm Light)\r\nAl Humanoid Tracking: Yes\r\nPower: PoE/12V DC', '8525', 'Eyeon 4Mp Ip Camera', 0.00, 1450.00, 'uploads/products/61.png?v=1737557501', 1, 0, '2025-01-22 19:59:43', '2025-01-31 20:37:32'),
(62, 'Supply of Tacitine En6200-Q-15 include 1 Year Licence( Gateway security  and Tread managment and Webfiltering )', '', '8517', 'Tacitine En6200-Q-15', 0.00, 32500.00, 'uploads/products/62.png?v=1737558907', 1, 0, '2025-01-22 20:45:07', '2025-01-22 20:45:07'),
(63, 'Supply of Dell PowerEdge T150 â€“Tower Model Intel Xeon E-2314 Processor 2.8GHz 8M Cache,4C/4T,Turbo,65W,TPM 4 DIMMS 3YR Pro Support NBD 16GB Ram 2TB Hard Drive SATA( Used for File Storage and Usb Blocking and unauthorized Access)', '', '8471', ' Dell PowerEdge T150 â€“Tower ', 0.00, 96000.00, 'uploads/products/63.png?v=1737559066', 1, 0, '2025-01-22 20:47:46', '2025-01-22 20:47:46'),
(64, 'Windows server 2022 Evaluate Version', '', '8523', 'Server 2022', 0.00, 3000.00, 'uploads/products/64.png?v=1737559431', 1, 0, '2025-01-22 20:53:51', '2025-01-22 20:53:51'),
(65, 'Supply and Laying of 3 Core 1.5 Sqmm Copper Cable', '', '7413', '3 Core 1.5 Sqmm Copper Cable', 0.00, 65.00, 'uploads/products/65.png?v=1737559974', 1, 0, '2025-01-22 21:02:54', '2025-01-22 21:06:11'),
(66, 'Supply of fixing of 20 Ams Switch Box', '', '8536', '20 Ams Switch Box', 0.00, 80.00, 'uploads/products/66.png?v=1737560135', 1, 0, '2025-01-22 21:05:35', '2025-01-22 21:05:35'),
(67, 'Supply of HIKVISION 5MP Outdoor bullet Dual Light + Audio MIC + Motion Alert Wired CCTV Camera | Compatible with iDS-7_HQHI and iDS-7_HUHI Series DVR | Model: DS-2CE16K0T-LPFS with BNC/DC, White', 'Color Night vision + black & white night vision + audio mic + weatherproof', '90069', 'HIKVISION 5MP Outdoor Dual Light bullet', 0.00, 1980.00, 'uploads/products/67.png?v=1737564612', 1, 0, '2025-01-22 22:20:12', '2025-01-22 22:20:12'),
(68, 'Supply of HIKVISION 5Mp/1080p [Built-in Audio Mic | Color Night Vision] Outdoor Wired Color CCTV Camera for Dvr, Ds-2Ce70Kf0T-Pfs White', 'Hikvision 3K ColorVu Indoor Audio Fixed Turret Camera\r\nCompatible with 5 MP & aboove DVR only\r\nFor Indoor Use Only', '9006', 'HIKVISION 5Mp doom dual light', 0.00, 2050.00, 'uploads/products/68.png?v=1737564899', 1, 0, '2025-01-22 22:24:59', '2025-01-22 22:24:59'),
(69, 'Suppply of HIKVISION DS-7016/ 7216HQHI-K2 (16Ch.) Full HD1080P DVR', 'HIKVISION 7200 SERIES 7B16HQHI-M2/S OR 7216HQHI-K2 16 CH DVR WITH 2 SATA PORTS\r\nUPTO 5MP SUPPORT\r\nRECORDING RESOLUTION MAX 4M-N', '8521', 'HIKVISION  16ch DVR 5MP', 0.00, 12800.00, 'uploads/products/69.png?v=1737565098', 1, 0, '2025-01-22 22:28:18', '2025-01-22 23:10:14'),
(70, 'Supply of Hickvision 12v 20 Ams cctv power supply DS-2FA120K-DW-IN 12V 20A CCTV Power Supply', 'Stable 12V Output: Ensures consistent power for CCTV camera systems.\r\nHigh Current Capacity: With 20A, it supports multiple cameras effortlessly.\r\nReliable Performance: Durable design for long-term, uninterrupted surveillance operation.', '8504', 'Hickvision 12v 20 Ams Power Supply', 0.00, 1200.00, 'uploads/products/70.png?v=1737565301', 1, 0, '2025-01-22 22:31:41', '2025-01-25 09:39:42'),
(71, 'Supply of Seagate Skyhawk 4 TB Surveillance Internal Hard Drive HDD â€“ 3.5 Inch Security Camera System with Drive Health Management,  (ST4000VX013)', '', '8471', 'Segate 4Tb Surveillance Harddisk', 7965.00, 8100.00, 'uploads/products/71.png?v=1737565519', 1, 0, '2025-01-22 22:35:19', '2025-02-10 21:08:58'),
(72, 'Supply of HIKVISION 305 m CAT6 UTP Network Cable box', 'Full diameter 305 m CAT6 network cable\r\nCore diameter: 0.55mm\r\nExcellent transmission performance using solid copper\r\nQuality verified by Fluke test\r\nGuaranteed long PoE transmission distance\r\nGreat PVC flame resistance.', '8544', 'Hickvison cat6 Utp cable 305 mts Box', 0.00, 8500.00, 'uploads/products/72.png?v=1737565763', 1, 0, '2025-01-22 22:39:23', '2025-01-22 22:39:23'),
(73, 'Supply of 4U CCTV DVR Rack/NVR/Server/Network Rack with 4 Power Socket Plug Transparent Glass Door Metal Cabinet Box', 'Size: The Dimention Of 4U DVR rack Length x Width x Height : 45cm x 55cm x 25.5cm. Before Order, it compare this size with your DVR/NVR etc and be sure that this rack is the perfect size for your device.', '9403', '4U Metal Rack', 0.00, 1800.00, 'uploads/products/73.png?v=1737566040', 1, 0, '2025-01-22 22:44:00', '2025-01-25 09:52:02'),
(74, 'Supply and fixing of 5 Feet camera Pole', '', '8529', ' 5 Feet camera Pole', 0.00, 2100.00, 'uploads/products/74.png?v=1737566417', 1, 0, '2025-01-22 22:50:17', '2025-01-22 22:50:17'),
(75, 'Supply of Ezviz by Hikvision  4MP Outdoor Pan Tilt Wi-Fi Camera Smart Night Vision 360Â° Coverage   Auto-Tracking | AI Human Detection | Weatherproof Design |', 'MicroSD Card(64GB) wirh 3 to 2 Days Backup', '9006', 'Hickvision Wifi camera H8C Without sim', 4940.00, 6500.00, 'uploads/products/75.png?v=1737608404', 1, 0, '2025-01-23 10:30:03', '2025-02-03 22:47:48'),
(76, 'Supply of EZVIZ H8C 2304*1296 (3MP) 4G Wireless Camera with 64GB memory card 2 to 3 days backup', '2K Resolution, Ai Powered Human Detection, Color In Night, Two Way Talk, Weatherproof Design, All Sim Support', '8525', 'Hickvision EZVIZ H8C Sim wifi camera', 3325.00, 6500.00, 'uploads/products/76.png?v=1737654394', 1, 0, '2025-01-23 23:16:33', '2025-01-30 11:04:54'),
(77, 'Supply of EVM 128GB M.2 NVME PCIE  128 GB ', 'Laptop, Desktop Internal Solid State Drive (SSD) (128GB M.2 NVME PCIE SSD) ', '8471', 'EVM 128GB NVME', 925.00, 1200.00, 'uploads/products/77.png?v=1737654718', 1, 1, '2025-01-23 23:21:58', '2025-02-09 18:46:16'),
(78, 'Supply of SanDisk Ultra 64GB microSDXC UHS-I, 140MB/s R, Memory Card', '', '8471', 'SanDisk Ultra 64GB', 450.00, 650.00, 'uploads/products/78.png?v=1737655457', 1, 0, '2025-01-23 23:34:17', '2025-01-31 20:43:20'),
(79, 'Supply of MSI PRO B760-VC WiFi ProSeries Motherboard (Supports 12th/13th/14th Gen Intel Processors, LGA 1700, DDR5, PCIe 4.0, M.2, 2.5Gbps LAN, USB 3.2 Gen2, Wi-Fi 5.1, Bluetooth 5.1, ATX)', 'Supports 12th/13th Gen Intel Core, Pentium Gold and Celeron processors for LGA 1700 socket\r\nSupports DDR5 Memory, up to 6800+(OC) MHz\r\nEnhanced Power Design: 12+1 Duet Rail Power System with P-PAK, 8-pin + 4-pin CPU power connectors, Core Boost, Memory Boost', '8473', 'MSI PRO B760-VC WiFi ProSeries Motherboard', 11328.00, 14400.00, 'uploads/products/79.png?v=1737696722', 1, 0, '2025-01-24 11:02:02', '2025-02-10 21:12:20'),
(80, 'Supply of Intel Core I5-13600K 13 th gen Processor 24M Cache, Up to 5.10 Ghz, LGA 1700', '', '8473', 'Intel Core I5-13600K 13 th gen Processor ', 19588.00, 24800.00, 'uploads/products/80.png?v=1737697374', 1, 0, '2025-01-24 11:09:33', '2025-02-10 21:11:42'),
(81, 'Supply of Crucial P2 500GB 3D NAND NVMe PCIe M.2 Up to 2400MB/s - CT500P2SSD8', 'Capacity: Up to 500GB with sequential reads/writes up to 2300MB/s/940MB/s', '8523', 'Crucial 500GB NVME ', 0.00, 4780.00, 'uploads/products/81.png?v=1737698067', 1, 0, '2025-01-24 11:24:27', '2025-02-09 10:13:48'),
(82, 'Supply of CORSAIR Vengeance 32GB DDR5 5200MHz Desktop RAM', 'Powerful CORSAIR iCUE Software: Enables real-time frequency readings, onboard voltage regulation, and custom XMP profiles.', '8473', 'Corsair Vengence DDR5 5200 Mhz 32 GB Ram', 6950.00, 7475.00, 'uploads/products/82.png?v=1737698447', 1, 0, '2025-01-24 11:30:47', '2025-02-10 21:13:11'),
(83, 'Supply of Seagate 2 TB Desktop Internal Hard Disk Drive (HDD) (Interface: SATA, Form Factor: 3.5 inch)', '', '8471', 'Segate 2TB internal Harddisk', 0.00, 4860.00, 'uploads/products/83.png?v=1737699156', 1, 1, '2025-01-24 11:42:36', '2025-02-09 20:59:27'),
(84, 'Supply of Ant Esports 510 AIR Mid Tower Gaming Cabinet Computer Case Supports E-ATX, ATX, Micro-ATX, Mini-ITX Motherboard Sliding Tempered Glass Side Panel', '3x120 mm ARGB Front 1x120 mm ARGB Rear Fans, Black', '8473', 'Ant Esports 510 cabinet', 4395.00, 3100.00, 'uploads/products/84.png?v=1737699649', 1, 0, '2025-01-24 11:50:49', '2025-02-10 21:14:52'),
(85, 'Supply of GIGABYTE GP-P550B 80 Plus Bronze Power Supply', '120mm Silent Hydraulic Bearing (HYB) Fan\r\nReliable flat cable\r\nSingle +12V rail, Output Capacity - 550W\r\nOVP/OPP/SCP/UVP/OCP/OTP protection', '8504', 'GIGABYTE 550 watts SMPS', 3575.00, 5100.00, 'uploads/products/85.png?v=1737699929', 1, 0, '2025-01-24 11:55:29', '2025-02-10 21:15:59'),
(86, 'Supply of GIGABYTE pci_e_x16 GeForce RTX 3050 Gaming OC 8G Graphics Card, 3X WINDFORCE Fans, 8GB GDDR6 128-bit GDDR6, GV-N3050GAMING OC-8GD Video Card', 'Nvidia geforce video card GTX 1050TI 4GB video card\r\nNvidia CPU GTX 1050 TI GPU with ports DP+HDMI+DVI\r\nVGA CUDA Cores 768 Dual Fan Cooling\r\nCore clock speed 1290MHz\r\nVGABoostClock 1392 MHz', '8473', 'Gigabyte 3050-OC 8GB DDR6 Dual Fan Graphic Card', 19706.00, 32000.00, 'uploads/products/86.png?v=1737700218', 1, 0, '2025-01-24 12:00:18', '2025-02-10 21:14:16'),
(87, 'Supply of Deepcool LE500 240mm LED Liquid CPU Cooler/AIO', 'Support Intel LGA1700/1200/1151/1150/1155 & AMD AM5/AM4 - R-LE500-BKLNMC-G-1', '8418', 'Deepcool LE500 240mm LED Cooler', 0.00, 5100.00, 'uploads/products/87.png?v=1737700832', 1, 0, '2025-01-24 12:10:32', '2025-01-24 12:17:48'),
(88, 'Supply of  Zebronics Transformer Gaming Keyboard and Mouse Combo,Braided Cable,Durable Al body,Multimedia keys and Gaming Mouse with 6 Buttons, Multi-Color LED Lights, High-Resolution Sensor with 3200 DPI(Black)', 'Multicolor LED ( 4 modes - 3 light modes and 1 off mode ),Integrated media control Windows key Disable / Enable function\r\nAll Keys Disable / Enable function , All Keys Disable / Enable function\r\n2-steps stand design, Laser keycaps\r\nAluminum body, Backlight LED On / Off function', '8471', 'Zebronic Transfomer Keyboard Mouse Combo', 1298.00, 1350.00, 'uploads/products/88.png?v=1737701223', 1, 0, '2025-01-24 12:17:03', '2025-02-10 21:19:17'),
(89, 'Supply of Acer EB321HQ 31.5 Inch (80.01 Cm) IPS Full HD ', '(1920 x 1080) Pixels LCD Monitor with LED Backlight I 300 Nits Brightness I HDMI, VGA Ports I Eye Care Features, Blue Light Filter, Flickerless (Black)', '8528', 'Acer 32 Inch IPS Full HD Monitor', 12508.00, 15800.00, 'uploads/products/89.png?v=1737701809', 1, 0, '2025-01-24 12:26:49', '2025-02-10 21:10:51'),
(90, 'Supply of Hickvision 2Mp Bullet camera (DS-2CE10KF0T-PFS)', 'High quality imaging with 3K, 2960 Ã— 1665 resolution\r\n24/7 color imaging with F1.0 aperture\r\n2.8 mm and 3.6 mm fixed focal lens\r\nUp to 20 m white light distance for bright night imaging', '9006', 'Hickvision 2Mp Bullet', 0.00, 1180.00, 'uploads/products/90.png?v=1738336599', 1, 1, '2025-01-25 09:10:07', '2025-01-31 20:48:28'),
(91, 'Supply of Hickvision 2Mp Doom Camera 1080p Audio Supported', ' DS-2CE5ADOT-IRPF Turbo HD Night Vision Dome CCTV Camera ', '9006', 'Hickvision 2Mp Doom Camera 1080p Turbo', 0.00, 1480.00, 'uploads/products/91.png?v=1737776871', 1, 0, '2025-01-25 09:17:51', '2025-01-25 09:17:51'),
(92, 'Supply of HIKVISION Upgraded Wired HQHI-K1 Series 1920 x 1080 Resolution 8 Channel Turbo HD Mini DVR (White)', ' Hikvision Upgraded DS-7A08HQHI-K1 OR DS-7108HQHI-K1 8CH Turbo HD Mini DVR 1Pcs.', '8521', 'Hikvison 8ch Turbo', 0.00, 5800.00, 'uploads/products/92.png?v=1737778064', 1, 0, '2025-01-25 09:37:44', '2025-01-25 09:37:44'),
(93, 'Supply of D.Link Cat 6 UTP Networking Cable for Router, Outdoor, 305 metres', 'CABLE TYPE: Category 6 UTP (Unshielded Twisted Pair) networking cable designed for high-speed data transmission and outdoor use\r\nLENGTH: 305 metres of continuous cable length suitable for large-scale network installations', '8544', ' D.Link Cat 6 UTP cable', 0.00, 7200.00, 'uploads/products/93.png?v=1737778842', 1, 0, '2025-01-25 09:50:42', '2025-01-25 09:50:42'),
(94, 'Supply of Dahua 2MP Wired Outdoor Bullete with Audio Recording Camera Image Sensor with 3.6Mm Lens - 20Mtr', '2-MP 1/3.2\" CMOS image sensor, low luminance, and high definition image.\r\nOutputs max. 2 MP (1920 Ã— 1080)@30 fps.', '9006', 'Dauha 2MP Bullet camera with audio', 0.00, 1250.00, 'uploads/products/94.png?v=1738817327', 1, 0, '2025-01-25 14:32:09', '2025-02-06 10:18:47'),
(95, 'Supply of Dahua 4CH DVR-Model (DH XVR4B04-V2)', 'HDCVI Camera : 2K, 2MP, 5MP, 1080P@25/30fps, 720P@50/60fps, 720P@25/30fps\r\nDimensions : Compact 1U, 260Ã—236Ã—48mm(10.2\"Ã—9.3\"Ã—1.9\")', '8521', 'Dauha 4Ch DVR', 0.00, 2800.00, 'uploads/products/95.png?v=1737795967', 1, 0, '2025-01-25 14:36:07', '2025-02-08 13:13:15'),
(96, 'Supply of Dauha PFM344D-4CH-EN CCTV power supply', 'Surge protection: common mode: Â±4 kV, differential mode: Â±2 kV.\r\n', '8504', 'Dauha 4ch CCTV power supply', 0.00, 750.00, 'uploads/products/96.png?v=1737798609', 1, 1, '2025-01-25 14:50:12', '2025-02-08 18:10:02'),
(97, 'Supply of 500gb surveillance Skyhawk Internal harddisk', '3.5â€³ Internal Hard Drive', '8471', ' 500Gb Surveillance Harddisk', 0.00, 2500.00, 'uploads/products/97.png?v=1737797619', 1, 0, '2025-01-25 15:03:39', '2025-01-25 15:03:39'),
(98, 'Supply of ZEBRONICS Dash Pro 2.4GHz Wireless Mouse, Upto 1600 DPI, 3 Level DPI, High Precision, Power Saving Mode, Comfortable & Lightweight, for Mac | Laptop | Computer (Black)', 'Buttons: The 4 buttons- Right, Left, and Middle(scroll), dedicated DPI switch can boost your productivity.\r\nPower-saving mode: When not in use, the mouse transcends to power-saving mode.', '8471', 'Zebronics wireless mouse ', 0.00, 350.00, 'uploads/products/98.png?v=1737865607', 1, 0, '2025-01-26 09:56:46', '2025-01-26 09:56:47'),
(99, 'Supply of EXIDE INVAMASTER IMTT2000, 12V 200Ah Tall Tubular Inverter Battery for Home and Office with Warranty - 60 Months (36 FOC+24Pro Rata)', 'Battery Details- Type: Tall tubular battery Capacity: 200Ah/12V: Construction: rugged construction', '8506', 'Exide12V 200Ah Battry', 18500.00, 19600.00, 'uploads/products/99.png?v=1738131298', 1, 0, '2025-01-29 11:44:57', '2025-01-31 20:37:04'),
(100, 'Supply of Inverter cable Fitting Acceries  of 16Sqmm cable with copper leg', '', '8544', 'Inverter cable ', 400.00, 450.00, 'uploads/products/100.png?v=1738131871', 1, 0, '2025-01-29 11:54:31', '2025-01-31 20:42:39'),
(101, '', '', '', '12A Tonner Refilling ', 60.00, 350.00, 'uploads/products/101.png?v=1738147958', 1, 1, '2025-01-29 16:22:38', '2025-02-06 10:09:21'),
(102, ' Supply of Printer USB Cable 1.5 Meter USB 2.0 A Male to MINI-B 5pin Male 28/24AWG Cable with Ferrite Core', '', '8544', 'Printer usb Cable ', 60.00, 150.00, 'uploads/products/102.png?v=1738148194', 1, 0, '2025-01-29 16:26:34', '2025-01-31 20:34:01'),
(103, 'Supply of 2core 1sqmm copper cable ', '', '7413', '2 core copper cable ', 0.00, 35.00, 'uploads/products/103.png?v=1738216293', 1, 0, '2025-01-30 11:21:32', '2025-01-30 11:21:33'),
(104, ' Supply of ZEBSTER 19 Inch Led Monitor -1 year warranty', 'Hdmi- Zeb-V19Hd (Hdmi+Vga) + Big Beat Fast Charge Data Cable Comboby Maxy!, Black -Display Resolution Maximum 1366x768', '8528', 'Zebster 19 inch monitor', 0.00, 3800.00, 'uploads/products/104.png?v=1738219315', 1, 0, '2025-01-30 12:11:55', '2025-01-30 12:11:55'),
(105, 'Lapcare LPC2612A Toner Cartridge', 'Compatible Model HP LaserJet 1010/1012/1015/1018/1020/1022/1022n/1022nw/3015/3020/3030/3050/3050z/3052/3055/M1319f/M1005', '5201', 'Lapcare 12A Tonner', 0.00, 0.00, 'uploads/products/105.png?v=1738337704', 1, 1, '2025-01-31 21:05:04', '2025-01-31 21:06:55'),
(106, 'Supply of Dahua Wired 2MP 20 Mtrs HD Dome Camera DH-HAC-T1A21P', 'True Day/Night, Smart IR\r\nUp to 20m IR distance', '9066', 'Dauha 2MP Doom', 0.00, 1200.00, 'uploads/products/106.png?v=1738338544', 1, 0, '2025-01-31 21:19:04', '2025-02-07 21:08:28'),
(107, 'Supply of Hikvision 100 Mts Cat6 PVC 23 AWG Cable, 4 Pair, UTP', '', '8517', 'Hickvision 100mts UTp Cable', 0.00, 2500.00, 'uploads/products/107.png?v=1738343633', 1, 0, '2025-01-31 22:43:53', '2025-01-31 22:43:53'),
(108, 'Supply of Dell Inspiron 3410 Laptop Battery 6-month warranty', '', '8501', 'Dell Insperon 3410 battry', 0.00, 1200.00, 'uploads/products/108.png?v=1738382165', 1, 0, '2025-02-01 09:26:04', '2025-02-01 09:26:05'),
(109, 'Supply of Seagate 4TB Desktop SATA III 3.5', '4TB Storage Capacity\r\n3.5\" Form Factor\r\nSATA III 6 Gb/s Interface\r\n64MB Cache', '8471', 'Seagate 4TB desktop HDD', 0.00, 10500.00, 'uploads/products/109.png?v=1739115694', 1, 0, '2025-02-03 13:34:14', '2025-02-09 21:11:34'),
(110, 'Supply and laying of Cat6 Utp cable With Pvc Conduct per meter', '', '8544', 'laying of cat6 cable ', 0.00, 50.00, 'uploads/products/110.png?v=1738603509', 1, 0, '2025-02-03 22:55:08', '2025-02-06 18:43:36'),
(111, 'Supply and laying of cctv cable With Pvc Conduct per meter', '', '8544', 'cctv acable ', 0.00, 45.00, 'uploads/products/111.png?v=1738603706', 1, 0, '2025-02-03 22:58:26', '2025-02-03 23:00:42'),
(112, 'Supply and laying of Cctv  cable without Pvc Conduct Bare Cable ', '', '8544', 'cctv Bare cable ', 0.00, 25.00, 'uploads/products/112.png?v=1738603936', 1, 0, '2025-02-03 23:02:16', '2025-02-03 23:05:31'),
(113, 'Supply and Laying of cat6 Utp bare Cable without Pvc Conduct ', '', '8544', 'cat6 UTP Bare Cable ', 0.00, 30.00, 'uploads/products/113.png?v=1738604047', 1, 0, '2025-02-03 23:04:07', '2025-02-03 23:04:07'),
(114, 'Supply of HIKVISION 2Mp Indoor Wired Color Camera for Dvr Ds-2Ce5Ad0T-Itp Eco Bnc/Dc, White - 1080P', 'True Day/Night, Smart IR\r\nUp to 20m IR distance', '9006', 'HIKVISION 2Mp Dome camera', 0.00, 1200.00, 'uploads/products/114.png?v=1738727367', 1, 1, '2025-02-05 09:19:26', '2025-02-05 09:23:14'),
(115, 'Lan Network Card Ethernet (PCI-lan 10/100 Mbit/s)', '', '8473', 'pci lan card', 0.00, 700.00, 'uploads/products/115.png?v=1738992925', 1, 0, '2025-02-08 11:05:25', '2025-02-08 11:05:25'),
(116, 'Supply of Hikvision 2MP IP Fixed Bullet Network Camera Model-(DS-2CD1023G0E-I)', 'High quality imaging with 2 MP resolution Efficient H.265+ compression technology Clear imaging against strong back light due to DWDR technology Water and dust resistant (IP67) EXIR 2.0: advanced infrared technology with long IR range', '9006', 'Hikvision 2MP IP Camera', 0.00, 2300.00, 'uploads/products/116.png?v=1739004585', 1, 0, '2025-02-08 14:12:48', '2025-02-08 14:42:01'),
(117, 'Supply of Hick-Vision 2MP IP Network Dome Camera Model- (DS-2CD1323G0E-I)', 'High quality imaging with 2 MP resolution Efficient H.265+ compression technology Clear imaging against strong back light due to DWDR technology Water and dust resistant (IP67) EXIR 2.0: advanced infrared technology with long IR range', '9006', 'Hikvision 2MP IP Dome camera', 0.00, 2200.00, 'uploads/products/117.png?v=1739004520', 1, 0, '2025-02-08 14:18:40', '2025-02-08 14:42:14'),
(118, 'Supply of Dauha 2mp Ip Bullet Network Camera  Model(IPC-HFW1230S1P-A-S4)', '2-MP 1/2.8\" CMOS image sensor, low luminance, and high definition image.\r\n H.265 codec, high compression rate, ultra-low bit rate\r\n Outputs max. 2 MP (1920 Ã— 1080)@25/30 fps\r\n Abnormality detection: Motion detection, video tampering, network disconnection, IP conflict, audio detection and illegal access\r\n Built-in MIC.\r\n Max IR LEDs Length 30m\r\n 12V DC/PoE power support\r\n IP67', '9006', 'Dauha 2MP IP bullet', 0.00, 2300.00, 'uploads/products/118.png?v=1739017534', 1, 0, '2025-02-08 17:55:34', '2025-02-08 17:55:34'),
(119, 'Supply of Dahua 2MP IP Dome Network Camera Model-(DH-IPC-HDW1230T1P-S4)', '2MP, 1/2.7â€ CMOS image sensor, low illuminance, high image definition\r\nOutputs max. 2MP (1920 Ã— 1080) @25/30 fps\r\nH.265 codec, high compression rate, ultra-low bit rate\r\nBuilt-in IR LED, max. IR distance: 30 m\r\nROI, SMART H.264/H.265, flexible coding, applicable to various \r\nbandwidth and storage environments\r\nRotation mode, DWDR, 3D DNR, HLC, BLC, digital watermarking,     \r\napplicable to various monitoring scenes\r\nAbnormality detection: Motion detection, video tampering, network \r\ndisconnection, IP conflict, illegal access\r\n12V DC/PoE power support\r\nIP67 Protection', '9006', 'Dauha 2MP IP Dome camera', 0.00, 2100.00, 'uploads/products/119.png?v=1739017735', 1, 0, '2025-02-08 17:58:55', '2025-02-08 18:01:06'),
(120, 'Supply of HIKVISION 4Ch NVR for IP Network CCTV Cameras Model-(DS-7104NI-Q1/M)', 'Up to 40 Mbps incoming bandwidth, and 60 Mbps outgoing bandwidth\r\nH.265+/H.265/ H.264+/H.264\r\nUp to 4-ch 1080p decoding capability', '8521', 'Hikvision 4ch NVR', 0.00, 3930.00, 'uploads/products/120.png?v=1739019394', 1, 0, '2025-02-08 18:26:34', '2025-02-08 18:28:12'),
(121, 'Supply of DAHUA 4 Channel NVR Model (DHI-NVR4B04HC/E )', 'Â· Max 40Mbps/20Mpbs incoming/outgoing bandwidth\r\nÂ· Max 4/8 channel IP camera inputs\r\nÂ· Up to 6MP resolution preview&playback\r\nÂ· Up to 1ch@6MP/4ch@1080P 25fps decoding\r\nÂ· HDMI/VGA simultaneous video output', '8521', 'Dauha 4ch NVR', 0.00, 3200.00, 'uploads/products/121.png?v=1739019798', 1, 0, '2025-02-08 18:33:18', '2025-02-08 18:33:18'),
(122, 'Supply of DAHUA 4ch NVR Model-(DHI-NVR4B04HC/E)', ' Max 40Mbps/20Mpbs incoming/outgoing bandwidth\r\nÂ· Max 4/8 channel IP camera inputs\r\nÂ· Up to 6MP resolution preview&playback\r\nÂ· Up to 1ch@6MP/4ch@1080P 25fps decoding\r\nÂ· HDMI/VGA simultaneous video output', '8521', 'Dauha 4channel NVR', 0.00, 3200.00, 'uploads/products/122.png?v=1739020029', 1, 1, '2025-02-08 18:37:09', '2025-02-08 18:45:13'),
(123, 'Supply of Dahua 8Ch NVR Model-(DHI-NVR4B04HC/E )', 'Max 40Mbps/20Mpbs incoming/outgoing bandwidth\r\nÂ· Max 4/8 channel IP camera inputs\r\nÂ· Up to 6MP resolution preview&playback\r\nÂ· Up to 1ch@6MP/4ch@1080P 25fps decoding\r\nÂ· HDMI/VGA simultaneous video output', '8521', 'Dauha 8Ch NVR', 0.00, 3950.00, 'uploads/products/123.png?v=1739020401', 1, 0, '2025-02-08 18:43:21', '2025-02-08 18:45:40'),
(124, 'Supply of Hikvision 8CH NVR Model (DS-7608NI-Q1)', 'Up to 8-ch IP camera inputs\r\nH.265+/H.265/H.264+/H.264 video formats\r\nUp to 1-ch@8 MP/3-ch@4 MP/6-ch@1080p decoding capacity\r\nUp to 80 Mbps incoming bandwidth', '8521', 'Hikvision 8ch NVR', 0.00, 5000.00, 'uploads/products/124.png?v=1739020897', 1, 0, '2025-02-08 18:51:37', '2025-02-08 18:51:37'),
(125, 'Supply  of Dahua 16CH NVR Model (NVR2216A-V2)', 'Up to 8/16 cameras with 1080p realtime preview\r\nH.264 dual-stream video compression\r\nDVR2208/2216A-V2:All channel 2CIF realtime recording or up to 960H recording, HDMI/VGA/TV/Spot simultaneous video output', '8521', 'Dauha 16channel NVR', 0.00, 11300.00, 'uploads/products/125.png?v=1739021228', 1, 0, '2025-02-08 18:57:08', '2025-02-08 18:57:08'),
(126, 'Supply of Hikvision 16ch NVR Model (DS-7616NI-Q1)', 'Up to 16 Channel IP camera inputs\r\nH.265+/H.265/H.264+/H.264 video formats\r\nUp to 1-ch @ 8MP or 5-ch @ 1080P decoding capacity\r\nUp to 160 Mbps incoming bandwidth', '8521', 'Hikvision 16ch NVR', 0.00, 6600.00, 'uploads/products/126.png?v=1739021394', 1, 0, '2025-02-08 18:59:54', '2025-02-08 18:59:54'),
(127, 'Supply of Dahua 4ch NVR Model (DHI-NVR4B04HC/E)', ' Max 40Mbps/20Mpbs incoming/outgoing bandwidth\r\nÂ· Max 4/8 channel IP camera inputs\r\nÂ· Up to 6MP resolution preview&playback\r\nÂ· Up to 1ch@6MP/4ch@1080P 25fps decoding\r\nÂ· HDMI/VGA simultaneous video output', '8521', 'Dahua 4ch NVR', 0.00, 3200.00, 'uploads/products/127.png?v=1739021571', 1, 0, '2025-02-08 19:02:51', '2025-02-08 19:03:14'),
(128, 'Supply of TPLINK 16 Port 10/100/1000 Gigabit Network Switch Model (TL-SG1016DE)', ' RJ45, Rackmount, Plug and Play, Networking Monitoring, Fanless', '8517', 'Tplink 16 port Gigabit switch', 0.00, 4800.00, 'uploads/products/128.png?v=1739022781', 1, 0, '2025-02-08 19:23:01', '2025-02-08 22:17:55'),
(129, 'Supply of TPLink  24Port10/100/1000 Gigabit Network Switch Model((TL-SG1024DE))', 'RJ45 ports Unmanaged Plus | Plug and Play | Desktop/Rackmount | Energy Efficient | VLAN | Network Monitoring | Fanless', '8517', 'Tplink 16port gigabit switch', 0.00, 7200.00, 'uploads/products/129.png?v=1739022945', 1, 0, '2025-02-08 19:25:45', '2025-02-08 22:15:10'),
(130, 'Supply of Dlink 24 Port 10/100/1000 gigabit Network Switch Model ( DGS-1024C )', '24 Port 100-1000Mbps Switch\r\n48Gbps Switching Capacity\r\nDesktop or Rack Mountable Design\r\nNon-blocking Architecture', '8517', 'Dlink 24 port Gigabit switch', 0.00, 7750.00, 'uploads/products/130.png?v=1739023381', 1, 0, '2025-02-08 19:33:01', '2025-02-08 22:57:33'),
(131, 'Supply of Dlink 8 port 10/100/1000 gigabit Network Switch Model (DGS-1008A)', 'Auto-negotiates port speed to 10 Mbps, 100 Mbps, or 1000 Mbps\r\nPlug & play installation', '8517', 'Dlink 8 port gigabit switch', 0.00, 2300.00, 'uploads/products/131.png?v=1739023668', 1, 0, '2025-02-08 19:37:48', '2025-02-08 22:11:46'),
(132, 'Supply of Dlink 5 port 10/100 network switch Model (DES-1005C ) ', 'Environment: operating temperature - 0,Æ’~40,Æ’ (32,%~104,%) storage temperature -40,Æ’~70,Æ’ (-40,%~158,%)', '8517', 'Dlink 5 port network switch', 0.00, 700.00, 'uploads/products/132.png?v=1739033563', 1, 0, '2025-02-08 22:22:43', '2025-02-08 22:22:43'),
(133, 'Supply of Dlink 8 port 10/100 network switch Model (DES-1008C)', 'Uses 802.3az Energy Efficient Ethernet to reduce power usage automatically without sacrificing performance', '8517', 'Dlink 8 port network switch', 0.00, 900.00, 'uploads/products/133.png?v=1739033727', 1, 0, '2025-02-08 22:25:27', '2025-02-08 22:25:27'),
(134, 'Supply of Dlink 16 port 10/100 network switch Model (DES-1016A)', 'Auto-negotiates port speed to 10 Mbps, 100 Mbps, or 1000 Mbps\r\nPlug & play installation', '8517', 'Dlink 16 port network switch', 0.00, 2000.00, 'uploads/products/134.png?v=1739033843', 1, 0, '2025-02-08 22:27:23', '2025-02-08 22:31:17'),
(135, 'Supply of Dlink 24 port 10/100 network switch Model (DES-1024D)', 'Connect up tp 24 PCs ot other devices to your wired network', '8517', 'Dlink 24 port network switch', 0.00, 4500.00, 'uploads/products/135.png?v=1739034030', 1, 0, '2025-02-08 22:30:30', '2025-02-08 22:30:30'),
(136, 'Supply of Hikvision 16 port poe 10/100 network switch Model (DS-3E0318P-E)', 'Intelligent PoE Management. When the power supply exceeds the limit, PoE ports intelligently manage the power supply, which extends the switch lifetime.\r\nUp to 300 m Long Range PoE Transmission. The distance between IPCs and switch can reach maximum 300 meters.\r\n4/8-Core Adaptive Power Supply with Less Power Loss. 8-core power supply reduces the power loss on cables.\r\n6KV Surge Protection to Improve Reliability in Harsh Environment.', '8517', 'Hikvision 16 port poe switch', 0.00, 4500.00, 'uploads/products/136.png?v=1739034802', 1, 0, '2025-02-08 22:43:22', '2025-02-09 09:40:55'),
(137, 'Supply of Hikvision 8 port poe 10/100 network switch Model (DS-3E0310P-E/M )', '8 Ã— 10/100Mbps PoE ports, and and 2 Ã— Gigabit RJ45 port.\r\nIEEE 802.3at/af standard for PoE ports (Max. 60 W PoE output).\r\nIEEE 802.3, IEEE 802.3u, IEEE 802.3x, IEEE 802.3z and IEEE 802.3ab standard.\r\n6 KV surge protection for PoE ports. Up to 300 m long-range transmission.', '8517', 'Hikvision 8 port poe switch', 0.00, 2500.00, 'uploads/products/137.png?v=1739035230', 1, 0, '2025-02-08 22:50:30', '2025-02-09 09:41:11'),
(138, 'Supply of Hikvision 24 port poe 10/100 network switch Model (DS-3E0326P-E C)', 'Up to 300 m Long Range PoE Transmission. The distance between IPCs and switch can reach maximum 300 meters.\r\n4/8-Core Adaptive Power Supply with Less Power Loss. 8-core power supply reduces the power loss on cables.\r\n6KV Surge Protection to Improve Reliability in Harsh Environment. The built-in surge protection device protects the switch from the sudden lightning surge in harsh environment.', '8517', 'Hikvision 24 port poe switch', 0.00, 16000.00, 'uploads/products/138.png?v=1739035515', 1, 0, '2025-02-08 22:55:15', '2025-02-09 09:41:25'),
(139, 'Supply of Hikvision 8 port poe 10/100/1000 gigabit network switch Model (DS-3E0510P-E)', 'IEEE 802.3, IEEE 802.3u, IEEE 802.3x, IEEE 802.3ab, and IEEE 802.3z network standards available\r\nIEEE 802.3 af & at high PoE power supply', '8517', 'Hikvision 8 port  poe gigabit switch', 0.00, 9750.00, 'uploads/products/139.png?v=1739071414', 1, 0, '2025-02-09 08:46:11', '2025-02-09 09:44:50'),
(140, 'Supply of Hikvision 16 port poe 10/100/1000 gigabit network switch Model (DS-3E0518P-E/M)', 'IEEE 802.3at/af standard IEEE 802.3, IEEE 802.3u, and IEEE 802.3x standard\r\n6 KV surge protection for PoE ports PoE power management', '8517', 'Hikvision 16 port poe gigabit switch', 0.00, 13000.00, 'uploads/products/140.png?v=1739071552', 1, 0, '2025-02-09 08:55:52', '2025-02-09 09:42:55'),
(141, 'Supply of Hikvision 24 port poe10/100/1000 gigabit network switch Model (DS-3E0526P-E)', 'Layer 2 network switch designed for video data transmission\r\nIEEE 802.3, IEEE 802.3u, IEEE 802.3x, IEEE 802.3ab, and IEEE 802.3z network standards available\r\nIEEE 802.3 af & at high PoE power supply\r\nStore-and-forward switching\r\nSafe and reliable using 6 KV high surge protection', '8517', 'Hikvision 24 port poe gigabit switch', 0.00, 17900.00, 'uploads/products/141.png?v=1739071891', 1, 0, '2025-02-09 09:01:31', '2025-02-09 09:43:58'),
(142, 'Supply of Hifocus 8 port poe 10/100/1000 gigabit network switch Model (HF-SGMFI08-120W)', '8 Gigabit Ports: Provides 8 auto-negotiation RJ45 ports, allowing you to expand your wired network easily and efficiently.\r\nUnmanaged Switch: Operates seamlessly without the need for management, ideal for users looking for a straightforward network solution.', '8517', 'Hifocus 8 port poe gigabit switch', 0.00, 3000.00, 'uploads/products/142.png?v=1739073475', 1, 0, '2025-02-09 09:27:55', '2025-02-09 09:45:24'),
(143, 'Supply of Hifocus 16 port poe 10/100/1000 gigabit network switch Model (HF-SGFH16-300W)', 'Power budget â€“ Max 300W Single Port â€“ Max 46W\r\nSupport IEEE 802.3af / at standard, automatically detects and identifies devices that comply with the IEEE 802.3af / at standard and supply power to it\r\nSupport Auto MDI/MDIX', '8517', 'Hifocus 16 port poe gigabit switch', 0.00, 12700.00, 'uploads/products/143.png?v=1739073693', 1, 0, '2025-02-09 09:31:33', '2025-02-09 09:45:48'),
(144, 'Supply of Hifocus 24 port poe 10/100/1000 gigabit network switch Model (HF-SGMFH24-420W)', 'Product Features\r\nâ‰¥ Support AI QOS, EXTEND, VLAN, AI Power Supply\r\nâ‰¥ 24 x 10/100/1000 Mps port, all port support\r\nIEEE802.3af/atstandrad\r\nâ‰¥ 2 x Gigabit SFP Optical module\r\nâ‰¥ Layer 2 Managed AI PoE Switch\r\nâ‰¥ Upto 1-8 Port 250 Mtr PoE Supported\r\nâ‰¥ Console Port Available\r\nâ‰¥ Lightining Protection Upto 6 KV', '8517', 'Hifocus 24 port poe gigabit switch', 0.00, 23500.00, 'uploads/products/144.png?v=1739074150', 1, 0, '2025-02-09 09:39:10', '2025-02-09 09:43:32'),
(145, 'Supply of Hifocus 8 port poe 10/100 network switch Model (HF-SGGFS08-120W)', 'Using CAT.5 network patch cords support power for the wireless AP/CPE and IPcamera/PTZ\r\nNetworking standard: IEEE802.3af/at/bt\r\n6KV lightning protection, 8KV surge protection, anti-reverse connection, over-current protection, over-voltage protection, over-temperature protection, Short circuit protection', '8517', 'Hifocus 8 port poe switch', 0.00, 1800.00, 'uploads/products/145.png?v=1739080026', 1, 0, '2025-02-09 11:17:06', '2025-02-09 13:34:40'),
(146, 'Supply of Hifocus 16 port poe 10/100 network switch Model (HF-SGFH16-300W)', 'Power budget â€“ Max 300W Single Port â€“ Max 46W\r\nSupport IEEE 802.3af / at standard, automatically detects and identifies devices that comply with the IEEE 802.3af / at standard and supply power to it\r\nSupport Auto MDI/MDIX', '8517', 'Hifocus 16 port poe switch', 0.00, 12600.00, 'uploads/products/146.png?v=1739080253', 1, 0, '2025-02-09 11:20:53', '2025-02-09 11:21:59'),
(147, 'Supply of Hifocus 24 port poe 10/100 network switch Model (HF-SGFF24-420W)', 'Support AI QOS, EXTEND, VLAN, AI Power Supply\r\n24 x 10/100/1000 Mps port, all port support\r\nIEEE802.3af/atstandrad\r\n 2 x Gigabit SFP Optical module\r\n Layer 2 Managed AI PoE Switch\r\nUpto 1-8 Port 250 Mtr PoE Supported\r\n Console Port Available\r\nLightining Protection Upto 6 KV', '8517', 'Hifocus 24 port poe network switch', 0.00, 13000.00, 'uploads/products/147.png?v=1739080776', 1, 0, '2025-02-09 11:29:36', '2025-02-09 11:29:36');
INSERT INTO `product_list` (`id`, `name`, `description`, `hsn_code`, `product_code`, `buy_price`, `price`, `image_path`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(148, 'Supply of Crucial RAM 8GB DDR4 3200MHz Desktop RAM', 'ECC Type = Non-ECC, Form Factor = UDIMM, Pin Count = 288-pin, PC Speed = PC4-25600, Voltage = 12V, Rank and Configuration = 1Rx16, 1Rx8 or 2Rx8.', '8473', 'Crucial 8 GB DDR4 ', 0.00, 1300.00, 'uploads/products/148.png?v=1739084188', 1, 0, '2025-02-09 12:26:27', '2025-02-09 12:50:45'),
(149, 'Supply of crucial 4GB DDR4 1.2v 2666Mhz desktop RAM', 'The DDR4 RAM is rated at 1.2V and has a latency of CL19. It can operate at a max of 2666MT/s.', '8473', 'Crucial 4 GB DDR4 ', 0.00, 1100.00, 'uploads/products/149.png?v=1739084389', 1, 0, '2025-02-09 12:29:48', '2025-02-09 12:29:49'),
(150, 'Supply of Corsair vengeance DDR4 4GB Desktop RAM', 'Memory Type\r\n4 GB (1 x 4) 2133 MHz DDR4 DIMMS\r\nCompatible Device\r\nPC\r\nPins\r\n288-pin\r\nError Check\r\nNon-ECC\r\nModel ID\r\nCMK4GX4M1A2400C16R\r\nSeries\r\nVengeance\r\n', '8473', 'Corsair vengeance DDR4', 0.00, 3500.00, 'uploads/products/150.png?v=1739084861', 1, 1, '2025-02-09 12:37:41', '2025-02-09 12:46:41'),
(151, 'Supply of Corsair Vengeance DDR4 8GB 3200 MHz Desktop RAM', 'XMP 2.0 SUPPORT: One setting is all it takes to automatically adjust to the fastest safe speed for your VENGEANCE LPX. Tested Voltage 1.35V', '8473', 'Corsair Vengeance DDR4 8GB ', 0.00, 2350.00, 'uploads/products/151.png?v=1739085562', 1, 0, '2025-02-09 12:49:22', '2025-02-09 12:49:22'),
(152, 'Supply of Corsair Vengeance DDR4 16GB 3200MHz Desktop RAM', 'TECHNICAL SPECIFICATIONS: 16 GB of size working at 3200 Mhz Speed. SPD Voltage 1.2V. SPD Speed : 2133MHz. SPD Latency 15-15-15-36\r\nCOMPATIBLE MODELS: Intel 100 Series,Intel 200 Series,Intel 300 Series,Intel X299, Intel i7', '8473', 'Corsair Vengeance DDR4 16GB', 0.00, 2825.00, 'uploads/products/152.png?v=1739085783', 1, 0, '2025-02-09 12:53:02', '2025-02-09 12:53:03'),
(153, 'Supply of Corsair Vengeance DDR5 16GB 5200MHz Desktop Ram', 'Custom Intel XMP 3.0 Profiles: Customize and save your own XMP profiles via iCUE to tailor performance by app or task for greater efficiency.\r\nPowerful CORSAIR iCUE Software: Enables real-time frequency readings, onboard voltage regulation, and custom XMP profiles.', '8473', 'Corsair Vengeance DDR5 16GB', 0.00, 3950.00, 'uploads/products/153.png?v=1739085971', 1, 0, '2025-02-09 12:56:11', '2025-02-09 12:56:11'),
(154, 'Supply of Crucial DDR5 16GB 4800Mhz Desktop RAM', 'Harness blazing speeds at 4800MHz â€” 1.5x faster than DDR4\r\nECC Type = Non-ECC, Form Factor = UDIMM, Pin Count = 288-pin, PC Speed = PC5-38400, Voltage = 1.1V', '8473', 'Crucial DDR5 16GB RAM', 0.00, 3325.00, 'uploads/products/154.png?v=1739086440', 1, 0, '2025-02-09 13:04:00', '2025-02-09 13:04:00'),
(155, 'Supply of Crucial 32GB DDR5 4800MHz desktop RAM', 'Harness blazing speeds at 4800MHz â€” 1.5x faster than DDR4\r\nECC Type = Non-ECC, Form Factor = UDIMM, Pin Count = 288-pin, PC Speed = PC5-38400, Voltage = 1.1V', '8473', 'Crucial 32GB DDR5', 0.00, 7000.00, 'uploads/products/155.png?v=1739086618', 1, 0, '2025-02-09 13:06:58', '2025-02-09 13:06:58'),
(156, 'Supply of crucial DDR3 4GB 1600 MHz Desktop RAM', 'Type: 240-pin DDR3 SDRAM', '8473', 'Crucial 4GB DDR3', 0.00, 2600.00, 'uploads/products/156.png?v=1739087460', 1, 0, '2025-02-09 13:21:00', '2025-02-09 13:26:38'),
(157, 'Supply of Crucial DDR3 8GB 1600 MHz Desktop RAM', 'Increases system performance\r\nPremium quality memory from a trusted brand', '8473', 'Crucial DDR3 8GB RAM', 0.00, 3100.00, 'uploads/products/157.png?v=1739087736', 1, 0, '2025-02-09 13:25:36', '2025-02-09 13:25:36'),
(158, 'Supply of Consistent 8GB DDR3 1600MHz Desktop RAM', 'Product Dimensions	â€Ž1.3 x 0.3 x 0.3 cm; 30 g\r\nItem model number	â€ŽDDR3\r\nRAM Size	â€Ž8 GB\r\nMemory Technology	â€ŽSDRAM, DDR3\r\nComputer Memory Type	â€ŽDDR3 SDRAM, SDRAM\r\nVoltage	â€Ž1.5 Volts', '8473', 'Consistent 8GB DDR3', 0.00, 500.00, 'uploads/products/158.png?v=1739088042', 1, 0, '2025-02-09 13:30:42', '2025-02-09 13:30:42'),
(159, 'Supply of Consistent 4GB DDR3 1600MHz Desktop RAM', 'Product Dimensions	â€Ž11 x 3 x 1 cm; 40 g\r\nItem model number	â€Ž4GB DDR3 DT PC3 1600\r\nRAM Size	â€Ž4 GB\r\nComputer Memory Type	â€ŽDDR3 SDRAM\r\nHard Drive Size	â€Ž4 GB\r\nVoltage	â€Ž1.5 Volts', '8473', 'Consistent 4GB DDR3 RAM', 0.00, 300.00, 'uploads/products/159.png?v=1739088171', 1, 0, '2025-02-09 13:32:51', '2025-02-09 13:32:51'),
(160, 'Supply of Blue Feather 500 GB SATA Surveillance Internal Hard Disk', 'Type: HDD\r\nInterface: SATA\r\nForm Factor: 3.5 inch\r\nCapacity: 500 GB\r\nSurveillance Systems', '8471', 'Blue Feather 500 GB Surveillance Hard disk', 0.00, 1800.00, 'uploads/products/160.png?v=1739102193', 1, 0, '2025-02-09 17:26:33', '2025-02-09 20:48:06'),
(161, 'Supply of Blue Feather 1TB SATA 3.5inch Surveillance Internal Hard Disk', 'High Speed Data Transferability', '8471', 'Blue Feather 1TB Surveillance Harddisk', 0.00, 2800.00, 'uploads/products/161.png?v=1739102691', 1, 0, '2025-02-09 17:34:51', '2025-02-09 20:48:41'),
(162, 'Supply of Blue Feather 128GB SSD Hard disk', 'Storage Capacity: 128 GB\r\nForm Factor: 2.5 inch\r\nInterface: SATA\r\nCompatibility: Laptop, Desktop/PC', '8523', 'Blue Feather 128GB SSD HDD', 0.00, 1100.00, 'uploads/products/162.png?v=1739105397', 1, 0, '2025-02-09 18:19:57', '2025-02-09 18:19:57'),
(163, 'Supply of Blue Feather 256GB Internal SSD Hard Disk', 'Blue Series \r\nBFRD5SSD256MX46900\r\nSATA III 6Gb/s\r\nVoltage Power-5V-1.5A\r\n2.5 SATA Super Fast SSD', '8523', 'Blue Feather 256GB SSD HDD', 0.00, 1800.00, 'uploads/products/163.png?v=1739106111', 1, 0, '2025-02-09 18:31:51', '2025-02-09 20:47:41'),
(164, 'Supply of EVM 128GB M.2 NVME PCIE SSD Model (EVMNV-128GB)', '(1) Form Factor M.2 NVMe (2) Interface PCle Gen 3x4 (3) Shock resistance 1500G/0.5ms (4) MTBF 2,000,000 hours (5) Performance Read (max.) Sequential', '8523', 'EVM 128GB NVME HDD', 0.00, 1500.00, 'uploads/products/164.png?v=1739106939', 1, 0, '2025-02-09 18:45:39', '2025-02-09 20:50:04'),
(165, 'Supply of EVM 256GB M.2 NVMe SSD Model (EVMNV30/256GB)', 'High-Speed Performance: Sequential read speeds of up to 3000MB/s and write speeds of up to 1600MB/s ensure lightning-fast data transfer.\r\nCompact Form Factor: Designed in the M.2 NVMe 2230 form factor, perfect for ultra-slim laptops, mini PCs, and small form factor desktops.', '8523', 'EVM 256GB NVME SSD', 0.00, 1800.00, 'uploads/products/165.png?v=1739107655', 1, 0, '2025-02-09 18:52:23', '2025-02-09 20:49:45'),
(166, 'Supply of Western Digital WD Blue SA510 SATA 500GB SSD Model (WDS500G3B0A)', 'SSD Brand	WD Western Digital\r\nSSD Capacity	Capacity: 480-512GB\r\nSSD Interface	Type: 2.5\" SATA', '8523', 'WD Blue 500GB SSD', 0.00, 3400.00, 'uploads/products/166.png?v=1739108583', 1, 0, '2025-02-09 19:13:03', '2025-02-13 22:47:13'),
(167, 'Supply of Western Digital WD Blue SA510 SATA 1TB SSD Model (WDS100T3B0A)', 'SSD Capacity	Capacity: 960GB-1.2TB\r\nSSD Brand	WD Western Digital\r\nSSD Interface	Type: 2.5\" SATA', '8523', 'WD blue 1TB SSD', 0.00, 6650.00, 'uploads/products/167.png?v=1739108845', 1, 0, '2025-02-09 19:17:25', '2025-02-09 19:47:55'),
(168, 'Supply of Seagate SkyHawk 6TB Surveillance Hard Drive - SATA Model (ST6000VX0023)', '6TB Storage Capacity\r\n3.5\" Form Factor\r\nSATA III 6 Gb/s Interface\r\n256MB Cache\r\nUp to 195 MB/s Sustained Transfer Rates\r\n300,000 Load/Unload Cycles\r\n180TB per Year Workload Rating\r\n1 Million Hours MTBF\r\nDesigned for 24/7 Surveillance\r\nSupports up to 64 HD Cameras\r\nST6000VX0023', '8471', 'Seagate Skyhawk 6tb Surveillance HDD', 0.00, 14000.00, 'uploads/products/168.png?v=1739116289', 1, 0, '2025-02-09 21:21:29', '2025-02-09 21:21:29'),
(169, 'Supply of Lenovo Laptop Battery', '', '8506', 'Lenovo battery', 0.00, 1800.00, '', 1, 0, '2025-02-10 17:28:37', '2025-02-10 17:28:37'),
(170, 'Supply of Crucial BX500 500GB 2.5\" SATA SSD CT500BX500SSD1', 'SSD Capacity	Capacity: 480-512GB Being 3X faster than a standard HDD, this SATA Crucial SSD lets you feel the difference with super-fast OS boot times and application loads. It also features SSD Endurance (TBW) of 120 Terabytes.', '8523', 'Crucial 500GB SSD', 0.00, 2350.00, 'uploads/products/170.png?v=1739191190', 1, 0, '2025-02-10 18:09:50', '2025-02-10 18:12:41'),
(171, 'Supply of Crucial BX500 240GB 2.5\" SATA SSD CT240BX500SSD1', 'SSD Capacity	Capacity: 240-256GB\r\nImproves battery life because itâ€™s 45x more energy efficient than a typical hard drive and it can operate in an input voltage of 4.5V.', '8523', 'Crucial BX500 240GB SSD', 0.00, 1450.00, 'uploads/products/171.png?v=1739191626', 1, 0, '2025-02-10 18:17:05', '2025-02-10 18:17:06'),
(172, 'Supply of Crucial BX500 1TB 2.5\" SATA SSD CT1000BX500SSD1', 'SSD Capacity	Capacity: 960GB-1.2TB\r\nConstructed to Boot up faster. Load files quicker. Improve overall system responsiveness for all your computing needs with Crucial BX500.Improves battery life because itâ€™s 45x more energy efficient than a typical hard drive.', '8523', 'Crucial BX500 1TB SSD', 0.00, 4850.00, 'uploads/products/172.png?v=1739191876', 1, 0, '2025-02-10 18:21:16', '2025-02-10 18:21:16'),
(173, 'Supply of Crucial P3 PLUS 500GB NVME Gen4 SSD CT500P3PSSD8', 'Impressive read/write speeds up to 5000/4200MB/s1.\r\nSpacious storage up to 4TB2. NVMe PCIe 4.0 M.2 (2280).\r\nBackward compatibility with PCIe 3.0. Micron Advanced 3D NAND.\r\nPerforms up to 43% faster than the fastest Gen3 NVMe SSDs3', '8523', 'Crucial 500GB NVME SSD', 2773.00, 3000.00, 'uploads/products/173.png?v=1739192667', 1, 0, '2025-02-10 18:34:27', '2025-02-10 21:16:29'),
(174, 'Supply of Crucial P3 PLUS 1TB NVME SSD CT1000P3PSSD8', 'Impressive read/write speeds up to 5000/4200MB/s1.\r\nSpacious storage up to 4TB2. NVMe PCIe 4.0 M.2 (2280).\r\nBackward compatibility with PCIe 3.0. Micron Advanced 3D NAND.\r\nPerforms up to 43% faster than the fastest Gen3 NVMe SSDs3\r\n', '8523', ' Crucial 1TB NVME SSD', 0.00, 4975.00, 'uploads/products/174.png?v=1739192851', 1, 0, '2025-02-10 18:37:31', '2025-02-10 18:37:31'),
(175, 'Supply of TPLink Archer AX23 AX1800 Dual-Band Wi-Fi 6 Router', '1800 Mbps Speed Gigabit Wireless | Beamforming OFDMA | Next-Gen Platform Dual-Core CPU | One Mesh Easy Setup', '1509', 'TPLink Archer Wi-Fi 6 Router', 0.00, 3200.00, 'uploads/products/175.png?v=1739252469', 1, 0, '2025-02-11 11:11:09', '2025-02-18 19:51:14'),
(176, ' Supply of Hp ProBook 640 G5 Core I5 8th gen 8gb Ram   256 gb m.2 SSD', '', '8471', 'Hp Pro Book 640G5', 0.00, 22500.00, 'uploads/products/176.png?v=1739342170', 1, 0, '2025-02-12 12:06:09', '2025-02-12 12:07:37'),
(177, 'Supply of cofe device router Model (CF-4G903)', 'COFE Speed 300Mbps Plug & Online 4G/4G Plus Wi-Fi Router ', '8517', 'COFE ROUTER', 0.00, 2700.00, 'uploads/products/177.png?v=1739593593', 1, 0, '2025-02-15 09:56:32', '2025-02-15 09:56:33'),
(178, 'Supply of Cofe Model (CF-106 WF-DS) (Dual Sim) TravelNet 2.0 , 4G Wireless dongle with All Sim Support ', 'Just Plug & Play, Data Upto 150 Mbps , 18 Hours Battery Backup ,5G Sim Compatible , C-Port Connection', '8517', 'Cofe router battery', 0.00, 3200.00, 'uploads/products/178.png?v=1739593909', 1, 0, '2025-02-15 10:01:49', '2025-02-15 10:17:25'),
(179, 'Supply of Dell Latitude Laptop 7470 Intel Core i5 - 6300u Processor', '6th Gen, 16 GB Ram & 128 GB SSD, 14.1 Inches (Ultra Slim & Feather Light 1.59KG) Notebook Computer with original Dell Adapter', '8471', 'Dell laptop', 0.00, 20000.00, 'uploads/products/179.png?v=1739594702', 1, 0, '2025-02-15 10:15:02', '2025-02-15 10:16:48'),
(180, 'Supply of telematics pbx-308fx-a', '3 - CO line, 8 - Extension Line\r\n Caller-ID Detection[ FSK & DTMF ]\r\n Over Voltage Protection\r\n Inbuilt Lightning Arrester\r\n Attractive Metal Cabinet\r\n Flexible Mounting Option: Wall Mount / Desktop\r\n Power Failure Transfer[ 1st Trunk ]\r\n Surge Current Protection\r\n Trunk & Extension LED Monitor', '8517', 'Telematics pbx-308fx-a', 0.00, 6500.00, 'uploads/products/180.png?v=1739599670', 1, 0, '2025-02-15 11:37:50', '2025-02-15 11:37:50'),
(181, 'Supply of Beetel B11 Corded Landline Phone', 'Ringer Volume Control, LED for Ring Indication, Wall/Desk Mountable, Classic Design, Clear Call Quality, Mute/Pause/Flash/Redial Function', '8517', 'Beetel B11 Landline', 0.00, 520.00, 'uploads/products/181.png?v=1739599952', 1, 0, '2025-02-15 11:42:32', '2025-02-15 11:42:32'),
(182, 'Supply of 10 Pair Krone Box With Krone', 'Voltage 220 V', '8422', '10 Pair krone box', 0.00, 950.00, 'uploads/products/182.png?v=1739601051', 1, 0, '2025-02-15 12:00:51', '2025-02-15 12:00:51'),
(183, 'Supply of Intercom fitting accessories', '', '8517', 'Intercom accessories', 0.00, 100.00, 'uploads/products/183.png?v=1739601417', 1, 0, '2025-02-15 12:06:57', '2025-02-15 12:06:57'),
(184, 'Supply and laying of 2 pair telephone cable per meter', '', '8544', 'telephone cable', 0.00, 25.00, 'uploads/products/184.png?v=1739602428', 1, 0, '2025-02-15 12:20:27', '2025-02-15 12:23:48'),
(185, 'Supply of 100mm GI tray with enclosure and slotted rod with Thread rod', '', '7308', 'Gi tray with enclosure', 0.00, 320.00, 'uploads/products/185.png?v=1739886221', 1, 0, '2025-02-18 19:13:41', '2025-02-18 19:13:41'),
(186, 'Supply of tray 8mm bolt net', '', '7318', 'Bolt net', 0.00, 5.00, 'uploads/products/186.png?v=1739886308', 1, 0, '2025-02-18 19:15:08', '2025-02-18 19:15:08'),
(187, 'Supply of 8mm hanger fastener', '', '7326', 'Hanger fastener', 0.00, 10.00, 'uploads/products/187.png?v=1739886391', 1, 0, '2025-02-18 19:16:31', '2025-02-18 19:16:31'),
(188, 'Supply of Western Digital WD Green SATA 240GB SSD (WDS240G3G0A)', 'Up to 545MB/s, 2.5 Inch/7 mm, 3Y Warranty, Internal Solid State Drive (SSD)', '8523', 'WD green 240GB SSD', 0.00, 1800.00, 'uploads/products/188.png?v=1739893044', 1, 0, '2025-02-18 21:07:24', '2025-02-18 21:07:24'),
(189, 'Supply of Core i5 3470 Processor (3rd Generation)', '3.20 Ghz Core 4 Thread 4 for LGA 1155 Socket Desktop Processor', '8473', 'i5 3rd gen', 0.00, 2500.00, 'uploads/products/189.png?v=1739893566', 1, 0, '2025-02-18 21:15:29', '2025-02-18 21:16:06'),
(190, 'Supply of intel core i5 3rd gen 16GB DDR3 RAM, 500GB Hard disk, Consistent 61 Mother board with 128GB NVME SSD and Zebronic Cabinet set', '', '8471', 'Assembled PC i5 3rd gen 16GB', 0.00, 13000.00, 'uploads/products/190.png?v=1739893991', 1, 0, '2025-02-18 21:23:11', '2025-02-18 21:23:11'),
(191, 'Supply of Dell USB Wired Keyboard and Mouse Set (Black) KB216+MS116', '', '8471', 'Dell keyboard & Mouse', 0.00, 550.00, 'uploads/products/191.png?v=1739894141', 1, 0, '2025-02-18 21:25:41', '2025-02-18 21:25:41'),
(192, 'TP-Link Usb Wifi Adapter For Pc(Tl-Wn725N),N150 Wireless Network Adapter ', 'For Desktop-Nano Size Wifi Dongle USB WiFi Adapter —— Speedy wireless transmission at up to 150Mbps ideal for video streaming or internet callsAdvanced Security —— Supports 64/128 WEP, WPA, PA2/WPA-PSK/WPA2-PSK(TKIP/AES)', '998422', 'tp-link usb 150 mbs wifi card', 550.00, 300.00, 'uploads/products/192.png?v=1739933751', 1, 0, '2025-02-19 08:25:51', '2025-02-19 08:25:51'),
(193, 'Dell Moniter  SE2222H/SE2225H 22\" (55.88 cm) FHD Monitor 1920x1080 Pixels, Refresh Rate 60Hz, VA Panel, 2-Year warranty, Brightness 250', 'Viewing Angle: 178° (Horizontal & Vertical| Response Time: 8ms (Fast), 12ms (Typical) Gray To Gray | Refresh Rate: Hz |Image Brightness: 250 cd/m²', '8528', 'Dell 22 inch moniter', 0.00, 9100.00, 'uploads/products/193.png?v=1739934438', 1, 0, '2025-02-19 08:37:18', '2025-02-19 08:37:18'),
(194, 'Supply and installation of K7 Total Security, 1 User, 1 Year', 'PC Tuneup & optimization tools\r\n Parental control utilities\r\n Robust privacy tools\r\n Advanced webcam protection', '85238020', 'K7 total security', 180.00, 750.00, 'uploads/products/194.png?v=1739938738', 1, 0, '2025-02-19 09:48:58', '2025-02-19 09:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_list`
--

CREATE TABLE `quotation_list` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `tech_id` int DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `invoice_type` varchar(200) DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `sub_amount` float(15,2) DEFAULT '0.00',
  `dis_amt` float(15,2) DEFAULT '0.00',
  `cgst` float(15,2) DEFAULT '0.00',
  `sgst` float(15,2) DEFAULT '0.00',
  `cgst_amt` float(15,2) DEFAULT '0.00',
  `sgst_amt` float(15,2) DEFAULT '0.00',
  `amount_with_gst` float(15,2) DEFAULT '0.00',
  `amount` float(15,2) NOT NULL DEFAULT '0.00',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '\r\n0=Pending,\r\n1=On-Progress,\r\n2=Done,\r\n3=Paid,\r\n4=Cancelled',
  `invoice_id` int DEFAULT NULL,
  `inv_status` int NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quotation_list`
--

INSERT INTO `quotation_list` (`id`, `user_id`, `tech_id`, `code`, `invoice_type`, `customer_id`, `sub_amount`, `dis_amt`, `cgst`, `sgst`, `cgst_amt`, `sgst_amt`, `amount_with_gst`, `amount`, `status`, `invoice_id`, `inv_status`, `date_created`, `date_updated`) VALUES
(11, 1, 0, 'Quo-001', 'Non-GST', 68, 63120.00, 0.00, 0.00, 0.00, 0.00, 0.00, 63120.00, 63120.00, 0, NULL, 0, '2025-02-18 20:56:01', '2025-02-18 20:56:01'),
(12, 1, 0, 'Quo-002', 'Non-GST', 69, 23750.00, 0.00, 0.00, 0.00, 0.00, 0.00, 23750.00, 23750.00, 2, 16, 1, '2025-02-19 08:57:32', '2025-02-19 09:07:47'),
(13, 1, 0, 'Quo-003', 'GST', 52, 18010.00, 0.00, 9.00, 9.00, 1620.90, 1620.90, 21251.80, 18010.00, 0, NULL, 0, '2025-02-19 09:25:08', '2025-02-19 09:25:08'),
(14, 1, 0, 'Quo-004', 'GST', 14, 4400.00, 0.00, 9.00, 9.00, 396.00, 396.00, 5192.00, 4400.00, 2, 17, 1, '2025-02-19 09:26:13', '2025-02-21 19:54:53'),
(15, 1, 0, 'Quo-005', 'GST', 63, 15699.00, 0.00, 9.00, 9.00, 1412.91, 1412.91, 18524.82, 15699.00, 0, NULL, 0, '2025-02-19 09:30:11', '2025-02-19 09:30:11'),
(16, 1, 0, 'Quo-006', 'GST', 63, 17040.00, 0.00, 9.00, 9.00, 1533.60, 1533.60, 20107.20, 17040.00, 0, NULL, 0, '2025-02-19 09:32:40', '2025-02-19 09:32:40'),
(17, 1, 0, 'Quo-007', 'GST', 5, 1600.00, 0.00, 9.00, 9.00, 144.00, 144.00, 1888.00, 1600.00, 0, NULL, 0, '2025-02-19 09:40:18', '2025-02-19 09:40:18'),
(18, 1, 0, 'Quo-008', 'GST', 5, 5800.00, 0.00, 9.00, 9.00, 522.00, 522.00, 6844.00, 5800.00, 0, NULL, 0, '2025-02-19 09:41:57', '2025-02-19 09:41:57'),
(19, 1, 0, 'Quo-009', 'GST', 5, 750.00, 0.00, 9.00, 9.00, 67.50, 67.50, 885.00, 750.00, 0, NULL, 0, '2025-02-19 09:49:59', '2025-02-19 09:49:59'),
(20, 1, 0, 'Quo-0010', 'Non-GST', 70, 17600.00, 0.00, 0.00, 0.00, 0.00, 0.00, 17600.00, 17600.00, 0, NULL, 0, '2025-02-20 21:59:16', '2025-02-20 22:04:25'),
(29, 1, 0, 'Quo-0011', 'GST', 4, 6360.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6360.00, 6360.00, 0, NULL, 0, '2025-02-21 20:53:38', '2025-02-21 20:53:38'),
(31, 1, 0, 'Quo-0012', 'Non-GST', 4, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, NULL, 0, '2025-02-21 20:54:59', '2025-02-21 20:54:59'),
(32, 1, 0, 'Quo-0013', 'GST', 4, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, NULL, 0, '2025-02-21 20:55:35', '2025-02-21 20:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_products`
--

CREATE TABLE `quotation_products` (
  `quotation_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `price` float(15,2) NOT NULL DEFAULT '0.00',
  `product_dis_type` varchar(200) DEFAULT NULL,
  `product_discount` varchar(200) DEFAULT NULL,
  `product_discount_amt` float(15,2) DEFAULT '0.00',
  `product_total` float(15,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quotation_products`
--

INSERT INTO `quotation_products` (`quotation_id`, `product_id`, `qty`, `price`, `product_dis_type`, `product_discount`, `product_discount_amt`, `product_total`) VALUES
(4, 38, 1, 20.00, '', '0', 0.00, 20.00),
(5, 9, 1, 1200.00, '', '0', 0.00, 1200.00),
(6, 6, 1, 4860.00, '', '0', 0.00, 4860.00),
(7, 38, 1, 20.00, '', '0', 0.00, 20.00),
(8, 12, 1, 2800.00, '', '0', 0.00, 2800.00),
(9, 9, 1, 1200.00, '', '0', 0.00, 1200.00),
(10, 9, 1, 1200.00, '', '0', 0.00, 1200.00),
(11, 185, 45, 320.00, '', '0', 0.00, 14400.00),
(11, 186, 144, 5.00, '', '0', 0.00, 720.00),
(11, 187, 100, 10.00, '', '0', 0.00, 1000.00),
(11, 34, 40, 40.00, '', '0', 0.00, 1600.00),
(12, 190, 1, 13000.00, '', '0', 0.00, 13000.00),
(12, 193, 1, 9100.00, '', '0', 0.00, 9100.00),
(12, 191, 1, 550.00, '', '0', 0.00, 550.00),
(12, 192, 1, 300.00, '', '0', 0.00, 300.00),
(13, 180, 1, 6500.00, '', '0', 0.00, 6500.00),
(13, 181, 8, 520.00, '', '0', 0.00, 4160.00),
(13, 182, 1, 950.00, '', '0', 0.00, 950.00),
(13, 183, 9, 100.00, '', '0', 0.00, 900.00),
(13, 184, 120, 25.00, '', '0', 0.00, 3000.00),
(14, 175, 1, 3200.00, '', '0', 0.00, 3200.00),
(15, 12, 1, 2800.00, '', '0', 0.00, 2800.00),
(15, 29, 3, 1200.00, '', '0', 0.00, 3600.00),
(15, 5, 1, 1300.00, '', '0', 0.00, 1300.00),
(15, 160, 1, 1800.00, '', '0', 0.00, 1800.00),
(15, 25, 1, 549.00, '', '0', 0.00, 549.00),
(15, 14, 4, 400.00, '', '0', 0.00, 1600.00),
(15, 111, 90, 45.00, '', '0', 0.00, 4050.00),
(16, 53, 1, 4500.00, '', '0', 0.00, 4500.00),
(16, 73, 1, 1800.00, '', '0', 0.00, 1800.00),
(16, 54, 9, 360.00, '', '0', 0.00, 3240.00),
(16, 110, 100, 50.00, '', '0', 0.00, 5000.00),
(17, 11, 1, 800.00, '', '0', 0.00, 800.00),
(18, 8, 4, 1250.00, '', '0', 0.00, 5000.00),
(19, 194, 1, 750.00, '', '0', 0.00, 750.00),
(20, 12, 1, 2800.00, '', '0', 0.00, 2800.00),
(20, 160, 1, 1800.00, '', '0', 0.00, 1800.00),
(20, 56, 1, 750.00, '', '0', 0.00, 750.00),
(20, 14, 4, 400.00, '', '0', 0.00, 1600.00),
(20, 177, 1, 2700.00, '', '0', 0.00, 2700.00),
(20, 112, 90, 25.00, '', '0', 0.00, 2250.00),
(20, 5, 4, 1050.00, '', '0', 0.00, 4200.00),
(26, 6, 1, 4860.00, '', '0', 0.00, 4860.00),
(27, 25, 1, 549.00, '', '0', 0.00, 549.00),
(28, 25, 1, 549.00, '', '0', 0.00, 549.00),
(29, 6, 1, 4860.00, '', '0', 0.00, 4860.00),
(30, 38, 1, 20.00, '', '0', 0.00, 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_services`
--

CREATE TABLE `quotation_services` (
  `quotation_id` int NOT NULL,
  `service_id` int NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `price` float(15,2) NOT NULL DEFAULT '0.00',
  `service_dis_type` varchar(200) DEFAULT NULL,
  `service_discount_amt` float(15,2) DEFAULT '0.00',
  `service_discount` varchar(200) DEFAULT NULL,
  `service_total` float(15,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quotation_services`
--

INSERT INTO `quotation_services` (`quotation_id`, `service_id`, `qty`, `price`, `service_dis_type`, `service_discount_amt`, `service_discount`, `service_total`) VALUES
(4, 14, 1, 1500.00, '', 0.00, '0', 1500.00),
(5, 17, 1, 15.00, '', 0.00, '0', 15.00),
(7, 14, 1, 1500.00, '', 0.00, '0', 1500.00),
(8, 16, 1, 20.00, '', 0.00, '0', 20.00),
(9, 16, 1, 20.00, '', 0.00, '0', 20.00),
(10, 16, 1, 20.00, '', 0.00, '0', 20.00),
(11, 20, 43, 300.00, '', 0.00, '0', 12900.00),
(11, 42, 3, 400.00, '', 0.00, '0', 1200.00),
(11, 13, 8, 300.00, '', 0.00, '0', 2400.00),
(11, 43, 1, 2500.00, '', 0.00, '0', 2500.00),
(11, 18, 45, 180.00, '', 0.00, '0', 8100.00),
(11, 17, 1220, 15.00, '', 0.00, '0', 18300.00),
(12, 38, 1, 800.00, '', 0.00, '0', 800.00),
(13, 41, 1, 2500.00, '', 0.00, '0', 2500.00),
(14, 40, 1, 1200.00, '', 0.00, '0', 1200.00),
(16, 33, 1, 2500.00, '', 0.00, '0', 2500.00),
(17, 6, 1, 800.00, '', 0.00, '0', 800.00),
(18, 19, 1, 800.00, '', 0.00, '0', 800.00),
(20, 14, 1, 1500.00, '', 0.00, '0', 1500.00),
(26, 14, 1, 1500.00, '', 0.00, '0', 1500.00),
(27, 16, 1, 20.00, '', 0.00, '0', 20.00),
(28, 17, 1, 15.00, '', 0.00, '0', 15.00),
(29, 14, 1, 1500.00, '', 0.00, '0', 1500.00),
(30, 16, 1, 20.00, '', 0.00, '0', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` float(15,2) NOT NULL DEFAULT '0.00',
  `image_path` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `name`, `description`, `price`, `image_path`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Desktop service onsite visiting Charges', '', 800.00, 'uploads/services/1.png?v=1735924813', 1, 1, '2022-04-21 10:18:59', '2025-02-06 18:16:19'),
(2, 'Virus Removal', 'In this service computer technicians ensure that the virus will be removed without risking the important data or information on your computer. You can also get virus removal services online, as well as complete services that include all the steps that are required to get your computer up and running problem-free.', 150.00, '', 1, 1, '2022-04-21 10:20:06', '2025-01-03 22:57:15'),
(3, 'Hardware Repair', 'This is for physical damages that are incurred by the computer or its accessories. This includes installing new hardware, repairing or updating hardware, etc.', 350.00, '', 1, 1, '2022-04-21 10:20:43', '2025-01-03 22:50:26'),
(4, 'Cctv camera installation and service include Visiting Charges', 'Camera Service Visting Charges ', 800.00, 'uploads/services/4.png?v=1735924575', 1, 0, '2022-04-21 10:21:07', '2025-02-06 15:20:06'),
(5, 'Data Recovery and Buck-up', 'Data Backup with moving charges', 400.00, 'uploads/services/5.png?v=1735924651', 1, 0, '2022-04-21 10:21:32', '2025-01-09 09:36:34'),
(6, 'Troubleshooting and Networking Support include Visiting Charges with tally name server network mapping', '', 800.00, 'uploads/services/6.png?v=1735925228', 1, 0, '2022-04-21 10:21:52', '2025-02-08 11:21:38'),
(7, 'Computer Maintenance', 'Your home and business computers require constant updating and tune-ups. This regular maintenance will not only enhance the working speed of your computer, but it will also increase its lifetime. Maintenance service includes file cleanup, upgrading and installing new windows or programs and general inspections.', 300.00, '', 1, 1, '2022-04-21 10:22:16', '2025-01-03 22:41:32'),
(8, ' Upgradation of Laptop Desktop  include fixing charges ', '', 400.00, 'uploads/services/8.png?v=1735925055', 1, 1, '2022-04-21 10:23:42', '2025-01-31 21:54:30'),
(9, 'test', 'test', 1.00, '', 0, 1, '2022-04-21 10:23:51', '2022-04-21 10:24:30'),
(11, 'CPU Cleaning', 'Only Dust Removal', 150.00, '', 1, 1, '2024-12-31 19:31:52', '2025-01-03 22:41:38'),
(12, 'WIFI Camera Installation ( include visiting Charges)', 'Fixing of Wifi camera with suitable Fitting accceries  and mobile Configration', 800.00, 'uploads/services/12.png?v=1735924955', 1, 0, '2025-01-03 22:52:35', '2025-01-09 09:43:06'),
(13, 'Fixing of cctv camera  with all suitable fixing accessories', '', 300.00, 'uploads/services/13.png?v=1736396190', 1, 0, '2025-01-09 09:46:30', '2025-01-22 22:53:39'),
(14, ' DVR Installation and configuration Charges ', '', 1500.00, 'uploads/services/14.png?v=1736396325', 1, 0, '2025-01-09 09:48:45', '2025-01-31 21:57:27'),
(15, 'Installation and Fixing of Rack Box and DVR Configuration commissioning charges ', '', 2000.00, 'uploads/services/15.png?v=1736434249', 1, 0, '2025-01-09 09:51:08', '2025-01-13 22:39:52'),
(16, ' Laying of cable with PVC conduct with suitable fitting Acceries  Per meter', '', 20.00, 'uploads/services/16.png?v=1736396687', 1, 0, '2025-01-09 09:54:47', '2025-02-03 22:53:20'),
(17, ' Laying of cable without PVC conduct with suitable fitting Acceries  Per meter', '', 15.00, 'uploads/services/17.png?v=1736396732', 1, 0, '2025-01-09 09:55:32', '2025-02-03 22:53:37'),
(18, 'Running of GI Cable Tray with All suitable Fitting Accessories', '', 180.00, 'uploads/services/18.png?v=1736396862', 1, 0, '2025-01-09 09:57:42', '2025-02-18 21:00:17'),
(19, 'Ups Battry Installation', 'Ups Battry Installation And Fixing Charges', 800.00, 'uploads/services/19.png?v=1738997190', 1, 0, '2025-01-09 10:10:51', '2025-02-08 12:16:30'),
(20, 'Termination Network cable and fixing and commissioning of Information Outlet End to End ', '', 300.00, 'uploads/services/20.png?v=1736784592', 1, 0, '2025-01-13 21:39:52', '2025-02-08 10:23:37'),
(21, 'Numbering of Network cable testing of Network Point Rack Side and User side both End', '', 80.00, 'uploads/services/21.png?v=1736784796', 1, 0, '2025-01-13 21:43:16', '2025-01-13 22:34:06'),
(22, 'Mother board service H81', 'H81 Mother board service with 3 month service warranty', 2000.00, 'uploads/services/22.png?v=1737529046', 1, 0, '2025-01-22 12:27:26', '2025-02-06 18:08:23'),
(23, 'Desktop service ', 'Desktop service include all over service charge', 800.00, 'uploads/services/23.png?v=1737530653', 1, 1, '2025-01-22 12:54:13', '2025-01-31 21:53:10'),
(24, 'Tally Support', 'Installation And Product Activation Support', 1200.00, 'uploads/services/24.png?v=1737540111', 1, 0, '2025-01-22 15:31:51', '2025-01-22 15:31:51'),
(25, 'All Over Service Charge Include Installation Testing And commissioning ', '', 800.00, 'uploads/services/25.png?v=1737540324', 1, 1, '2025-01-22 15:35:24', '2025-01-31 21:53:39'),
(26, 'Supply and Laying of cat6 Utp cable With Pvc Conduct per meter', '', 45.00, 'uploads/services/26.png?v=1737549765', 1, 1, '2025-01-22 18:12:45', '2025-01-31 22:04:59'),
(27, 'Nvr Installation Charges', 'Fixing of Nvr Installation and configration Charges', 3000.00, 'uploads/services/27.png?v=1737557828', 1, 1, '2025-01-22 20:27:08', '2025-01-31 21:59:39'),
(28, 'Firewall Installation and commissioning Charges', 'for 30 users', 5500.00, 'uploads/services/28.png?v=1737559216', 1, 0, '2025-01-22 20:50:16', '2025-01-22 20:50:16'),
(29, 'Server configuration charges', 'Dell server active directory management and group policy management and access privilege systems', 4500.00, 'uploads/services/29.png?v=1737559305', 1, 0, '2025-01-22 20:51:45', '2025-01-22 20:51:45'),
(30, 'Electrical installation and commissioning charges', '', 800.00, 'uploads/services/30.png?v=1737560302', 1, 0, '2025-01-22 21:08:22', '2025-01-22 21:08:22'),
(31, 'System assembling and installation charges', '', 1500.00, 'uploads/services/31.png?v=1737702705', 1, 0, '2025-01-24 12:31:53', '2025-01-24 12:41:45'),
(32, 'Wifi Fixing charges', '', 300.00, 'uploads/services/32.png?v=1737779187', 1, 1, '2025-01-25 09:56:27', '2025-01-31 22:05:41'),
(33, 'Networking cabling and Crimping of Rj-45 connecter Testing and Fixing Charges ', '', 2500.00, 'uploads/services/33.png?v=1737779291', 1, 0, '2025-01-25 09:58:09', '2025-01-31 22:01:23'),
(34, 'Fixing of CCTV camera installation and configuration charges', '', 2500.00, 'uploads/services/34.png?v=1737799022', 1, 1, '2025-01-25 15:27:02', '2025-01-31 21:56:32'),
(35, 'Computer Troubleshooting and visiting charges', '', 600.00, 'uploads/services/35.png?v=1737958736', 1, 1, '2025-01-27 11:48:55', '2025-01-31 21:54:59'),
(36, 'Inverter  Battry Installation', 'Fixing of Inverter Battry installation and Commsioning Charges ', 1200.00, 'uploads/services/36.png?v=1738131705', 1, 0, '2025-01-29 11:51:44', '2025-01-29 11:51:45'),
(37, 'Tonner Refelling', 'Supply And Filling Of Ink Power  Refilling  and All over service  charges ', 350.00, '', 1, 0, '2025-02-06 10:10:04', '2025-02-06 10:10:04'),
(38, 'Desktop service include  windows installation all over service Charge ', '', 800.00, 'uploads/services/38.png?v=1738846487', 1, 0, '2025-02-06 18:24:46', '2025-02-12 12:41:07'),
(39, 'Laptop Hinges service', 'Servicing and rework of LCD Screen Hinges', 900.00, 'uploads/services/39.png?v=1739188968', 1, 0, '2025-02-10 17:31:00', '2025-02-10 17:32:48'),
(40, 'Network installation and configuration commissioning charges', '', 1200.00, 'uploads/services/40.png?v=1739252696', 1, 0, '2025-02-11 11:14:56', '2025-02-11 11:14:56'),
(41, 'Intercom Installation and Configuration charges', '', 2500.00, 'uploads/services/41.png?v=1739601851', 1, 0, '2025-02-15 12:14:11', '2025-02-15 12:15:18'),
(42, 'Fixing and commissioning of wireless access point over sealing with all suitable fitting accessories (only fixing, configuration will not done)', '', 400.00, 'uploads/services/42.png?v=1739884745', 1, 0, '2025-02-18 18:49:05', '2025-02-18 18:49:05'),
(43, 'Fixing of Door access with EM lock, Biometric installation with RFID card reader and configuration charges', '', 2500.00, 'uploads/services/43.png?v=1739884825', 1, 0, '2025-02-18 18:50:25', '2025-02-18 18:50:25'),
(44, 'Desktop Assembling', 'Desktop assembling and windows installation charges', 800.00, 'uploads/services/44.png?v=1739933237', 1, 0, '2025-02-19 08:17:17', '2025-02-19 08:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'SOFTTECH IT SERVICES'),
(6, 'short_name', ''),
(11, 'logo', 'uploads/logo.png?v=1739263518'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1650507137'),
(15, 'email_id', 'softtechsolution2016@gmail.com'),
(16, 'mobile_no', '+91-9710934522'),
(17, 'address', 'No-16,Venkatachala Nagar, Thirumullaivoyal Main Road\r\nChennai, Tamil Nadu, India, 600062.'),
(18, 'gst_no', '33GKGPM4227K1ZZ');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_list`
--

CREATE TABLE `transaction_list` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `tech_id` int DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `invoice_type` varchar(200) DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `sub_amount` float(15,2) DEFAULT '0.00',
  `dis_amt` float(15,2) DEFAULT '0.00',
  `cgst` float(15,2) DEFAULT '0.00',
  `sgst` float(15,2) DEFAULT '0.00',
  `cgst_amt` float(15,2) DEFAULT '0.00',
  `sgst_amt` float(15,2) DEFAULT '0.00',
  `amount_with_gst` float(15,2) DEFAULT '0.00',
  `amount` float(15,2) NOT NULL DEFAULT '0.00',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '\r\n0=Pending,\r\n1=On-Progress,\r\n2=Done,\r\n3=Paid,\r\n4=Cancelled',
  `quotation_id` int DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_list`
--

INSERT INTO `transaction_list` (`id`, `user_id`, `tech_id`, `code`, `invoice_type`, `customer_id`, `sub_amount`, `dis_amt`, `cgst`, `sgst`, `cgst_amt`, `sgst_amt`, `amount_with_gst`, `amount`, `status`, `quotation_id`, `date_created`, `date_updated`) VALUES
(1, 1, 6, 'IN1707', 'GST', 5, 13300.00, 0.00, 9.00, 9.00, 1197.00, 1197.00, 15694.00, 13300.00, 2, NULL, '2025-02-08 10:18:48', '2025-02-10 22:07:25'),
(2, 1, 6, 'IN1708', 'GST', 5, 2800.00, 0.00, 9.00, 9.00, 252.00, 252.00, 3304.00, 2800.00, 2, NULL, '2025-02-08 10:20:08', '2025-02-10 22:07:58'),
(3, 1, 6, 'IN1709', 'GST', 3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4, NULL, '2025-02-08 10:20:37', '2025-02-13 09:18:38'),
(4, 1, 6, 'IN1710', 'GST', 52, 19550.00, 0.00, 9.00, 9.00, 1759.50, 1759.50, 23069.00, 19550.00, 2, NULL, '2025-02-08 10:28:33', '2025-02-10 22:08:26'),
(5, 1, 6, 'IN1711', 'GST', 51, 3500.00, 0.00, 9.00, 9.00, 315.00, 315.00, 4130.00, 3500.00, 2, NULL, '2025-02-08 10:29:49', '2025-02-10 22:09:05'),
(6, 1, 9, 'IN1712', 'GST', 63, 7500.00, 0.00, 9.00, 9.00, 675.00, 675.00, 8850.00, 7500.00, 2, 75, '2025-02-10 17:48:17', '2025-02-10 22:09:29'),
(8, 1, NULL, 'SOFT-001', 'Non-GST', 3, 6850.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6850.00, 6850.00, 2, NULL, '2025-02-10 21:18:32', '2025-02-11 22:10:10'),
(9, 1, 9, 'IN1713', 'GST', 64, 22500.00, 0.00, 9.00, 9.00, 2025.00, 2025.00, 26550.00, 22500.00, 2, NULL, '2025-02-12 12:07:04', '2025-02-13 09:57:19'),
(10, 1, 7, 'IN1714', 'GST', 5, 3550.00, 0.00, 9.00, 9.00, 319.50, 319.50, 4189.00, 3550.00, 2, 69, '2025-02-12 12:36:13', '2025-02-14 08:56:34'),
(11, 1, 6, 'IN1715', 'GST', 5, 4200.00, 0.00, 9.00, 9.00, 378.00, 378.00, 4956.00, 4200.00, 2, 67, '2025-02-12 12:38:40', '2025-02-14 08:57:40'),
(12, 1, 6, 'IN1716', 'GST', 5, 800.00, 0.00, 9.00, 9.00, 72.00, 72.00, 944.00, 800.00, 2, NULL, '2025-02-12 12:41:46', '2025-02-14 18:48:53'),
(13, 1, NULL, 'SOFT-002', 'Non-GST', 3, 4860.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4860.00, 4860.00, 0, NULL, '2025-02-14 18:53:04', '2025-02-14 19:05:07'),
(14, 1, 6, 'SOFT-003', 'Non-GST', 66, 23200.00, 0.00, 0.00, 0.00, 0.00, 0.00, 23200.00, 23200.00, 2, 81, '2025-02-15 10:21:27', '2025-02-15 16:48:42'),
(15, 1, 6, 'SOFT-004', 'Non-GST', 67, 4700.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4700.00, 4700.00, 2, 2, '2025-02-18 18:39:40', '2025-02-18 18:40:00'),
(16, 1, 6, 'SOFT-005', 'Non-GST', 69, 23750.00, 0.00, 0.00, 0.00, 0.00, 0.00, 23750.00, 23750.00, 0, 12, '2025-02-19 09:07:47', '2025-02-19 09:07:47'),
(17, 1, 6, 'IN1717', 'GST', 14, 4400.00, 0.00, 9.00, 9.00, 396.00, 396.00, 5192.00, 4400.00, 0, 14, '2025-02-21 19:54:53', '2025-02-21 19:54:53'),
(21, 1, 6, 'SOFT-006', 'Non-GST', 71, 800.00, 0.00, 0.00, 0.00, 0.00, 0.00, 800.00, 800.00, 0, NULL, '2025-02-21 20:58:08', '2025-02-21 20:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_products`
--

CREATE TABLE `transaction_products` (
  `transaction_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `price` float(15,2) NOT NULL DEFAULT '0.00',
  `product_dis_type` varchar(200) DEFAULT NULL,
  `product_discount` varchar(200) DEFAULT NULL,
  `product_discount_amt` float(15,2) DEFAULT '0.00',
  `product_total` float(15,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_products`
--

INSERT INTO `transaction_products` (`transaction_id`, `product_id`, `qty`, `price`, `product_dis_type`, `product_discount`, `product_discount_amt`, `product_total`) VALUES
(1, 8, 10, 1250.00, '', '0', 0.00, 12500.00),
(2, 9, 1, 1200.00, '', '0', 0.00, 1200.00),
(2, 10, 2, 800.00, '', '0', 0.00, 1600.00),
(4, 110, 100, 50.00, '', '0', 0.00, 5000.00),
(4, 53, 1, 4500.00, '', '0', 0.00, 4500.00),
(4, 54, 10, 360.00, '', '0', 0.00, 3600.00),
(4, 55, 10, 195.00, '', '0', 0.00, 1950.00),
(4, 56, 2, 750.00, '', '0', 0.00, 1500.00),
(5, 52, 1, 3500.00, '', '0', 0.00, 3500.00),
(6, 10, 6, 800.00, '', '0', 0.00, 4800.00),
(6, 169, 1, 1800.00, '', '0', 0.00, 1800.00),
(8, 75, 1, 6500.00, '', '0', 0.00, 6500.00),
(8, 103, 10, 35.00, '', '0', 0.00, 350.00),
(9, 176, 1, 22500.00, '', '0', 0.00, 22500.00),
(10, 43, 1, 750.00, '', '0', 0.00, 750.00),
(3, 12, 1, 2800.00, '', '0', 0.00, 2800.00),
(11, 10, 1, 800.00, '', '0', 0.00, 800.00),
(11, 166, 1, 3400.00, '', '0', 0.00, 3400.00),
(13, 6, 1, 4860.00, '', '0', 0.00, 4860.00),
(14, 179, 1, 20000.00, '', '0', 0.00, 20000.00),
(14, 178, 1, 3200.00, '', '0', 0.00, 3200.00),
(15, 94, 1, 1250.00, '', '0', 0.00, 1250.00),
(15, 112, 30, 25.00, '', '0', 0.00, 750.00),
(16, 190, 1, 13000.00, '', '0', 0.00, 13000.00),
(16, 193, 1, 9100.00, '', '0', 0.00, 9100.00),
(16, 191, 1, 550.00, '', '0', 0.00, 550.00),
(16, 192, 1, 300.00, '', '0', 0.00, 300.00),
(17, 175, 1, 3200.00, '', '0', 0.00, 3200.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_services`
--

CREATE TABLE `transaction_services` (
  `transaction_id` int NOT NULL,
  `service_id` int NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `price` float(15,2) NOT NULL DEFAULT '0.00',
  `service_dis_type` varchar(200) DEFAULT NULL,
  `service_discount_amt` float(15,2) DEFAULT '0.00',
  `service_discount` varchar(200) DEFAULT NULL,
  `service_total` float(15,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_services`
--

INSERT INTO `transaction_services` (`transaction_id`, `service_id`, `qty`, `price`, `service_dis_type`, `service_discount_amt`, `service_discount`, `service_total`) VALUES
(1, 19, 1, 800.00, '', 0.00, '0', 800.00),
(4, 20, 10, 300.00, '', 0.00, '0', 3000.00),
(6, 39, 1, 900.00, '', 0.00, '0', 900.00),
(8, 16, 1, 20.00, '', 0.00, '0', 20.00),
(10, 22, 1, 2000.00, '', 0.00, '0', 2000.00),
(10, 38, 1, 800.00, '', 0.00, '0', 800.00),
(3, 17, 1, 15.00, '', 0.00, '0', 15.00),
(12, 38, 1, 800.00, '', 0.00, '0', 800.00),
(13, 14, 1, 1500.00, '', 0.00, '0', 1500.00),
(15, 13, 4, 300.00, '', 0.00, '0', 1200.00),
(15, 14, 1, 1500.00, '', 0.00, '0', 1500.00),
(16, 38, 1, 800.00, '', 0.00, '0', 800.00),
(17, 40, 1, 1200.00, '', 0.00, '0', 1200.00),
(21, 38, 1, 800.00, '', 0.00, '0', 800.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-04-13 15:24:24'),
(6, 'Prakash', 'M', 'Prakash', '73803249c6667c5af2d51c0dedfae487', NULL, NULL, 3, '2025-02-07 21:36:42', '2025-02-21 20:42:09'),
(7, 'Ganesh', 'K', 'Ganesh', 'fa1d87bc7f85769ea9dee2e4957321ae', NULL, NULL, 3, '2025-02-07 21:37:11', '2025-02-21 20:37:10'),
(8, 'Mythilipriya', 'J', 'Priya', '0b1c8bc395a9588a79cd3c191c22a6b4', NULL, NULL, 2, '2025-02-07 21:37:40', '2025-02-21 20:36:54'),
(9, 'Abu', 'bakar', 'Abu', '34d71b97c471931334f385b4e7b7379c', NULL, NULL, 3, '2025-02-07 21:38:19', '2025-02-21 20:37:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_list`
--
ALTER TABLE `customer_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_list`
--
ALTER TABLE `quotation_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tech_id` (`tech_id`);

--
-- Indexes for table `quotation_products`
--
ALTER TABLE `quotation_products`
  ADD KEY `quotation_id` (`quotation_id`),
  ADD KEY `service_id` (`product_id`);

--
-- Indexes for table `quotation_services`
--
ALTER TABLE `quotation_services`
  ADD KEY `quotation_id` (`quotation_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_list`
--
ALTER TABLE `transaction_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tech_id` (`tech_id`);

--
-- Indexes for table `transaction_products`
--
ALTER TABLE `transaction_products`
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `service_id` (`product_id`);

--
-- Indexes for table `transaction_services`
--
ALTER TABLE `transaction_services`
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `customer_list`
--
ALTER TABLE `customer_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `quotation_list`
--
ALTER TABLE `quotation_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction_list`
--
ALTER TABLE `transaction_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction_list`
--
ALTER TABLE `transaction_list`
  ADD CONSTRAINT `tech_id_fk_tl` FOREIGN KEY (`tech_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_tl` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_products`
--
ALTER TABLE `transaction_products`
  ADD CONSTRAINT `product_id_fk_tp` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_id_fk_tp` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_services`
--
ALTER TABLE `transaction_services`
  ADD CONSTRAINT `service_id_fk_ts` FOREIGN KEY (`service_id`) REFERENCES `service_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_id_fk_ts` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
