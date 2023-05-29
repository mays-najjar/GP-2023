-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 12:36 AM
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
(62, 9, 'COLORED PRA', 5, 1),
(63, 8, 'img', 5, 1),
(64, 8, 'img', 5, 1),
(65, 8, 'img', 5, 1),
(66, 8, 'img', 5, 1),
(67, 8, 'img', 5, 1);

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
(62, 8, '1');

-- --------------------------------------------------------

--
-- Table structure for table `style`
--

CREATE TABLE `style` (
  `style_name` varchar(20) NOT NULL,
  `style_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `style`
--

INSERT INTO `style` (`style_name`, `style_id`) VALUES
('display', 1),
('border', 2),
('text-align', 3),
('padding', 4),
('padding', 5),
('margin', 6),
('background-color', 7),
('font-size', 8),
('font-family', 9),
('color', 10);

-- --------------------------------------------------------

--
-- Table structure for table `style_element`
--

CREATE TABLE `style_element` (
  `element_id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  `style_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `style_element`
--

INSERT INTO `style_element` (`element_id`, `style_id`, `style_value`) VALUES
(62, 10, 'blue'),
(62, 3, 'center');

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
-- Indexes for table `style`
--
ALTER TABLE `style`
  ADD PRIMARY KEY (`style_id`);

--
-- Indexes for table `style_element`
--
ALTER TABLE `style_element`
  ADD KEY `fk_style_element_style` (`style_id`),
  ADD KEY `fk_style_element_` (`element_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `tag_attribute`
--
ALTER TABLE `tag_attribute`
  ADD PRIMARY KEY (`tag_attribute`),
  ADD KEY `fk_tag_attribute` (`tag_id`),
  ADD KEY `fk_tag_attribute_` (`attribute_id`);

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
  MODIFY `element_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `style`
--
ALTER TABLE `style`
  MODIFY `style_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

--
-- Constraints for table `style_element`
--
ALTER TABLE `style_element`
  ADD CONSTRAINT `fk_style_element_` FOREIGN KEY (`element_id`) REFERENCES `element` (`element_id`),
  ADD CONSTRAINT `fk_style_element_style` FOREIGN KEY (`style_id`) REFERENCES `style` (`style_id`);

--
-- Constraints for table `tag_attribute`
--
ALTER TABLE `tag_attribute`
  ADD CONSTRAINT `fk_tag_attribute` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`),
  ADD CONSTRAINT `fk_tag_attribute_` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`attribute_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;