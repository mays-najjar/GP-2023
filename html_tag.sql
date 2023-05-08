-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2023 at 07:08 PM
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
-- Database: `html_tag`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attribute_id` int(10) NOT NULL,
  `attribute_name` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attribute_id`, `attribute_name`) VALUES
(1, 'name'),
(2, 'width'),
(3, 'height'),
(4, 'src'),
(5, 'alt'),
(6, 'style'),
(7, 'href'),
(8, 'id'),
(9, 'value'),
(10, 'class');

-- --------------------------------------------------------

--
-- Table structure for table `element`
--

CREATE TABLE `element` (
  `element_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `content` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `children_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `element`
--

INSERT INTO `element` (`element_id`, `tag_id`, `content`, `parent_id`, `children_order`) VALUES
(1, 15, NULL, NULL, NULL),
(3, 17, NULL, 1, 1),
(4, 16, '\'My Web Page\'', 3, 1),
(5, 1, NULL, 1, 2),
(6, 9, 'para one ', 5, 1),
(7, 9, 'para two', 5, 2),
(8, 8, NULL, 5, 3),
(9, 11, 'Div1', 5, 4),
(10, 9, 'para in div', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `element_attribute`
--

CREATE TABLE `element_attribute` (
  `element_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `element_attribute`
--

INSERT INTO `element_attribute` (`element_id`, `attribute_id`, `attribute_value`) VALUES
(1, 8, '2'),
(3, 8, '1'),
(4, 8, '1'),
(5, 8, '1'),
(6, 8, '1'),
(7, 8, '2'),
(8, 2, '400'),
(8, 3, '400'),
(8, 5, 'K');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `category`) VALUES
(1, 'body', ''),
(2, 'h1', 'basic'),
(3, 'h2', 'basic'),
(4, 'h3', 'basic'),
(5, 'h4', 'basic'),
(6, 'h5', 'basic'),
(7, 'h6', 'basic'),
(8, 'img', 'basic'),
(9, 'p', 'basic'),
(10, 'a', 'basic'),
(11, 'div', 'basic'),
(12, 'footer', 'extra'),
(13, 'header', 'extra'),
(14, 'button', 'basic'),
(15, 'html', ''),
(16, 'title', 'basic'),
(17, 'head', 'basic');

-- --------------------------------------------------------

--
-- Table structure for table `tag_attribute`
--

CREATE TABLE `tag_attribute` (
  `tag_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `tag_attribute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tag_attribute`
--

INSERT INTO `tag_attribute` (`tag_id`, `attribute_id`, `tag_attribute`) VALUES
(8, 2, 1),
(8, 3, 2),
(8, 4, 3),
(8, 5, 4),
(9, 8, 5),
(11, 2, 6),
(11, 3, 7),
(11, 8, 8),
(10, 7, 9),
(15, 8, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `element`
--
ALTER TABLE `element`
  ADD PRIMARY KEY (`element_id`);

--
-- Indexes for table `element_attribute`
--
ALTER TABLE `element_attribute`
  ADD PRIMARY KEY (`element_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `tag_attribute`
--
ALTER TABLE `tag_attribute`
  ADD PRIMARY KEY (`tag_attribute`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attribute_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `element`
--
ALTER TABLE `element`
  MODIFY `element_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tag_attribute`
--
ALTER TABLE `tag_attribute`
  MODIFY `tag_attribute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `element_attribute`
--
ALTER TABLE `element_attribute`
  ADD CONSTRAINT `element_attribute_ibfk_1` FOREIGN KEY (`element_id`) REFERENCES `element` (`element_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `element_attribute_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`attribute_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
