-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2025 at 01:37 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `circular2`
--

-- --------------------------------------------------------

--
-- Table structure for table `ao`
--

DROP TABLE IF EXISTS `ao`;
CREATE TABLE IF NOT EXISTS `ao` (
  `an` int NOT NULL AUTO_INCREMENT,
  `apw` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `aname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`an`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ao`
--

INSERT INTO `ao` (`an`, `apw`, `aname`) VALUES
(5, '555555', 'dil');

-- --------------------------------------------------------

--
-- Table structure for table `c_tbl`
--

DROP TABLE IF EXISTS `c_tbl`;
CREATE TABLE IF NOT EXISTS `c_tbl` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `c_sec` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `c_num` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `c_head` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `c_date` date NOT NULL,
  `c_file` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `confirm` int NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `c_tbl`
--

INSERT INTO `c_tbl` (`c_id`, `c_sec`, `c_num`, `c_head`, `c_date`, `c_file`, `confirm`) VALUES
(1, 'පාලන අංශය', 'ad/2626', 'head1', '2025-03-18', '67d9abf61a7ee.pdf', 1),
(2, 'ආයතන අංශය', 'ed/1212', 'head2', '2025-03-11', '67d9d1630f80c.pdf', 2),
(3, 'ආයතන අංශය', 'cc/4456', 'head3', '2025-03-07', '67d9d4e6e59bc.pdf', 1),
(4, 'ආයතන අංශය', 'ee44/44', 'head5', '2025-03-14', '67d9d51de2da2.pdf', 1),
(5, 'ආයතන අංශය', '5522', '5522', '2025-03-05', '67d9d694f395e.csv', 1),
(6, 'මුදල් දෙපාර්තමේන්තුව', 'M/5555', 'check karaththe', '2024-01-01', '67d9db53a2758.docx', 0),
(7, 'පිරිස් අංශය', 'ad/2628', 'topic 7', '2025-03-05', '67d9e65e6618b.csv', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`) VALUES
(4, 'chamodi', 'malshika', 'chamodimalshika4@gmail.com', '1111111'),
(5, 'mal', 'mal', 'm@gmail.com', '2222222');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
