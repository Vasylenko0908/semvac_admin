-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 08:05 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_article`
--

CREATE TABLE `tbl_article` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(256) CHARACTER SET utf8 NOT NULL,
  `description` varchar(2048) NOT NULL,
  `images` varchar(2048) CHARACTER SET utf8 NOT NULL,
  `date` varchar(256) CHARACTER SET utf8 NOT NULL,
  `favors` int(10) UNSIGNED NOT NULL,
  `opens` int(10) UNSIGNED NOT NULL,
  `shares` int(10) UNSIGNED NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `deleted` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_article`
--

INSERT INTO `tbl_article` (`id`, `title`, `description`, `images`, `date`, `favors`, `opens`, `shares`, `created`, `deleted`) VALUES
(2, 'New Article-Covid-19', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', '123.jpg', '2018/02/21 15:30:32', 41, 1, 2, 923628782, 0),
(11, 'Viet Article-Covid-19', 'Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.\nhttp://google.com', 'download (3).png,EYO Money Logo.png', '2021/05/05 17:44:17', 49, 2, 0, 1620229457, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `text` varchar(2048) NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `date` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`id`, `article_id`, `text`, `created`, `date`) VALUES
(4, 23, '', 1620796954, '2021/05/12 07:22:34'),
(5, 24, '', 1620797185, '2021/05/12 07:26:25'),
(6, 25, '', 1620797329, '2021/05/12 07:28:49'),
(7, 26, '', 1620797615, '2021/05/12 07:33:35'),
(8, 27, '', 1620797913, '2021/05/12 07:38:33'),
(9, 28, '', 1620798110, '2021/05/12 07:41:50'),
(10, 29, '', 1620798112, '2021/05/12 07:41:52'),
(11, 30, '', 1620798291, '2021/05/12 07:44:51'),
(12, 31, '', 1620798308, '2021/05/12 07:45:08'),
(13, 32, '', 1620798311, '2021/05/12 07:45:11'),
(14, 33, '', 1620798312, '2021/05/12 07:45:12'),
(15, 34, '', 1620798314, '2021/05/12 07:45:14'),
(16, 35, '', 1620798398, '2021/05/12 07:46:38'),
(17, 11, 'aaaa', 1620799344, '2021/05/12 08:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` varchar(256) CHARACTER SET utf8 NOT NULL,
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 NOT NULL,
  `type` varchar(256) CHARACTER SET utf8 NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `deleted` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `userid`, `name`, `password`, `type`, `created`, `deleted`) VALUES
(1, 'admin', 'ADMINISTRATOR', '111', 'ADMIN', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_article`
--
ALTER TABLE `tbl_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
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
-- AUTO_INCREMENT for table `tbl_article`
--
ALTER TABLE `tbl_article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
