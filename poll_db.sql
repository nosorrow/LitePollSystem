-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10 май 2018 в 18:59
-- Версия на сървъра: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poll_db`
--

-- --------------------------------------------------------

--
-- Структура на таблица `tbl_polls`
--

CREATE TABLE `tbl_polls` (
  `id` int(11) NOT NULL,
  `poll_subject` varchar(255) NOT NULL,
  `poll_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `tbl_polls`
--

INSERT INTO `tbl_polls` (`id`, `poll_subject`, `poll_status`) VALUES
(1, 'Кой език за програмиране използвате най-често', 1),
(2, 'Кой PHP framework използвате ?', 0);

-- --------------------------------------------------------

--
-- Структура на таблица `tbl_poll_answers`
--

CREATE TABLE `tbl_poll_answers` (
  `id` int(11) NOT NULL,
  `poll_answer` varchar(255) NOT NULL,
  `poll_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Схема на данните от таблица `tbl_poll_answers`
--

INSERT INTO `tbl_poll_answers` (`id`, `poll_answer`, `poll_id`) VALUES
(1, 'PHP', 1),
(2, 'JAVA', 1),
(3, 'PYTHON', 1),
(4, 'C#', 1),
(5, 'JavaScript', 1),
(6, 'ZEND', 2),
(7, 'LARAVEL', 2),
(8, 'YII', 2),
(9, 'Code Igniter', 2);

-- --------------------------------------------------------

--
-- Структура на таблица `tbl_poll_votes`
--

CREATE TABLE `tbl_poll_votes` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `poll_answer_id` int(11) NOT NULL,
  `poll_vote` int(11) NOT NULL,
  `poll_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Схема на данните от таблица `tbl_poll_votes`
--

INSERT INTO `tbl_poll_votes` (`id`, `poll_id`, `poll_answer_id`, `poll_vote`, `poll_user`) VALUES
(1, 1, 2, 1, 'dummies'),
(2, 1, 4, 1, 'dummies-1'),
(3, 1, 1, 1, 'dummies-2'),
(4, 1, 5, 1, 'dummies-3'),
(5, 1, 5, 1, 'dummies-4'),
(6, 1, 5, 1, 'dummies-5'),
(7, 1, 2, 1, 'dummies-6'),
(8, 1, 2, 1, 'dummies-7'),
(9, 1, 5, 1, 'dummies-8'),
(10, 1, 5, 1, NULL),
(11, 2, 7, 1, NULL),
(12, 2, 7, 1, NULL),
(13, 2, 9, 1, NULL),
(14, 2, 6, 1, NULL),
(15, 2, 7, 1, NULL),
(16, 2, 8, 1, NULL),
(17, 2, 9, 1, NULL),
(18, 2, 7, 1, NULL),
(19, 2, 9, 1, NULL),
(20, 2, 6, 1, NULL),
(21, 2, 7, 1, NULL),
(22, 1, 3, 1, NULL),
(23, 1, 1, 1, NULL),
(24, 1, 2, 1, NULL),
(25, 1, 1, 1, NULL),
(26, 1, 1, 1, NULL),
(27, 1, 5, 1, NULL),
(28, 1, 5, 1, NULL),
(29, 1, 5, 1, NULL),
(30, 1, 5, 1, NULL),
(31, 1, 2, 1, NULL),
(32, 1, 5, 1, NULL),
(33, 1, 1, 1, NULL),
(34, 1, 5, 1, NULL),
(35, 1, 1, 1, NULL),
(36, 1, 5, 1, 'dummies-2'),
(37, 1, 5, 1, 'dummies-2'),
(38, 1, 1, 1, 'dummies-2'),
(39, 1, 1, 1, 'dummies-2'),
(40, 1, 5, 1, 'dummies-2'),
(41, 1, 3, 1, 'dummies-2'),
(42, 1, 5, 1, 'dummies-2'),
(43, 1, 5, 1, 'dummies-2'),
(44, 1, 5, 1, 'dummies-2'),
(45, 1, 4, 1, 'dummies-2'),
(46, 1, 4, 1, 'dummies-2'),
(47, 1, 2, 1, 'dummies-2'),
(48, 1, 3, 1, 'dummies-2'),
(49, 1, 5, 1, 'dummies-2'),
(50, 1, 5, 1, 'dummies-2');

-- --------------------------------------------------------

--
-- Структура на таблица `tbl_test`
--

CREATE TABLE `tbl_test` (
  `id` int(11) NOT NULL,
  `test_subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_polls`
--
ALTER TABLE `tbl_polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_poll_answers`
--
ALTER TABLE `tbl_poll_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_poll_votes`
--
ALTER TABLE `tbl_poll_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_test`
--
ALTER TABLE `tbl_test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_polls`
--
ALTER TABLE `tbl_polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_poll_answers`
--
ALTER TABLE `tbl_poll_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_poll_votes`
--
ALTER TABLE `tbl_poll_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `tbl_test`
--
ALTER TABLE `tbl_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
