-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2017 at 01:54 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `id_good` int(11) NOT NULL,
  `good_title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `good_preview` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `good_content` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`id_good`, `good_title`, `good_preview`, `good_content`) VALUES
(1, 'Товар номер раз', 'товар как товар', 'товар как товар, но такое себе...'),
(2, 'Товар номер два', 'товар как товар два', 'товар как товар, но получше'),
(3, 'Товар номер 3', 'товар как товар два но 3', 'товар как товар, но еще получше'),
(4, 'Товар номер 4', 'товар как товар два но 3, хоть 4', 'товар ?'),
(5, 'Товар номер 5', 'еще товар как товар', 'товар!');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_body` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `feedback_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_body`, `feedback_user`, `id`) VALUES
('2342342', '234234', 1),
('234234', '23423423', 2),
('234234234234234234', '234234', 3),
('4444444444444444444444444444444', '34534534534534534534', 4),
('444', '123', 5),
('6767', '67', 6),
('sdsdsd', 'sfd', 7),
('sdsdsd', 'sfd', 8),
('вап', 'вам', 9),
('вап', 'вап', 10),
('fy', '22', 11);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id_news` int(11) NOT NULL,
  `news_title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `news_preview` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `news_content` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_news`, `news_title`, `news_preview`, `news_content`) VALUES
(0, 'номер раз', 'про что то там', 'ОГОГО!'),
(1, 'номер два', 'про что то там еще', 'ОГОГО СЕБЕ!');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_last_action` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `user_login`, `user_password`, `user_last_action`) VALUES
(1, 'admin', 'admin', '$2a$08$MzI5NzFmOTcwMTllYWU0Zez.VNltkYcJOBsmX/39yeZ9PKumLOuPe', '0000-00-00'),
(2, 'Konstantin', 'donner', '$2a$08$MzI5NzFmOTcwMTllYWU0Zez.VNltkYcJOBsmX/39yeZ9PKumLOuPe', '0000-00-00'),
(3, 'qwert', 'qwert', '$2a$08$NzZkYTgzM2EzMzQ3MjE3YOT6FeiUNjMgYvAiTksrzJFDp.TRYui66', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id_good`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_news`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_login` (`user_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id_good` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
