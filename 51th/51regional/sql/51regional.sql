-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-04-21 17:20:04
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `51regional`
--

-- --------------------------------------------------------

--
-- 資料表結構 `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `questioncount` text NOT NULL,
  `pagelen` text NOT NULL,
  `responcount` text NOT NULL,
  `lock` text NOT NULL,
  `questioncode` text NOT NULL,
  `maxlen` text NOT NULL,
  `ps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `question`
--

INSERT INTO `question` (`id`, `title`, `questioncount`, `pagelen`, `responcount`, `lock`, `questioncode`, `maxlen`, `ps`) VALUES
(1, 'test2', '24', '', '', 'false', '', '100', '');

-- --------------------------------------------------------

--
-- 資料表結構 `questionlog`
--

CREATE TABLE `questionlog` (
  `id` int(11) NOT NULL,
  `questionid` text NOT NULL,
  `order` text NOT NULL,
  `desciption` text NOT NULL,
  `required` text NOT NULL,
  `mod` text NOT NULL,
  `opition` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `questionlog`
--

INSERT INTO `questionlog` (`id`, `questionid`, `order`, `desciption`, `required`, `mod`, `opition`) VALUES
(1, '1', '1', '', 'false', 'yesno', ''),
(2, '1', '2', '', 'false', 'single', ''),
(3, '1', '3', '', 'false', 'none', ''),
(4, '1', '4', '', 'false', 'none', ''),
(5, '1', '5', '', 'false', 'none', ''),
(6, '1', '6', '', 'false', 'none', ''),
(7, '1', '7', 'test', 'true', 'yesno', ''),
(8, '1', '8', '', 'false', 'none', ''),
(9, '1', '9', '', 'false', 'none', ''),
(10, '1', '10', '', 'false', 'none', ''),
(11, '1', '11', '', 'false', 'none', ''),
(12, '1', '12', '', 'false', 'none', ''),
(13, '1', '13', '', 'false', 'none', ''),
(14, '1', '14', '', 'false', 'none', ''),
(15, '1', '15', '', 'false', 'none', ''),
(16, '1', '16', '', 'false', 'none', ''),
(17, '1', '17', '', 'false', 'none', ''),
(18, '1', '18', '', 'false', 'none', ''),
(19, '1', '19', '', 'false', 'none', ''),
(20, '1', '20', '', 'false', 'none', ''),
(21, '1', '21', 'mult', 'false', 'multi', ''),
(22, '1', '22', '', 'false', 'single', ''),
(23, '1', '23', '', 'false', 'none', ''),
(24, '1', '24', '', 'false', 'single', '');

-- --------------------------------------------------------

--
-- 資料表結構 `selfquestioncode`
--

CREATE TABLE `selfquestioncode` (
  `id` int(11) NOT NULL,
  `questionid` text NOT NULL,
  `user` text NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `questionid` text NOT NULL,
  `questioncode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `questionid`, `questioncode`) VALUES
(1, 'admin', '1234', '', '');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `questionlog`
--
ALTER TABLE `questionlog`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `selfquestioncode`
--
ALTER TABLE `selfquestioncode`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `questionlog`
--
ALTER TABLE `questionlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `selfquestioncode`
--
ALTER TABLE `selfquestioncode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
