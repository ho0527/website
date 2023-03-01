-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-02-18 15:19:28
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
-- 資料庫： `53regional`
--

-- --------------------------------------------------------

--
-- 資料表結構 `coffee`
--

CREATE TABLE `coffee` (
  `id` int(11) NOT NULL,
  `picture` text NOT NULL,
  `name` text NOT NULL,
  `introduction` text NOT NULL,
  `cost` text NOT NULL,
  `date` text NOT NULL,
  `link` text NOT NULL,
  `version` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `coffee`
--

INSERT INTO `coffee` (`id`, `picture`, `name`, `introduction`, `cost`, `date`, `link`, `version`) VALUES
(2, 'image/jpg_IMG_0174.jpg', 'ifehiowehi', 'isnii', '12345678', '2023-02-11 14:24:36', 'fijeiorjipog', '2'),
(3, '', '嗨嗨嗨', ':)', '527', '2023-02-11 14:59:55', 'https://1234.com/index.php', '1');

-- --------------------------------------------------------

--
-- 資料表結構 `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `number` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `permission` text NOT NULL,
  `time` text NOT NULL,
  `move` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `data`
--

INSERT INTO `data` (`id`, `number`, `username`, `password`, `name`, `permission`, `time`, `move`) VALUES
(1, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 19:01:32', '登入失敗'),
(2, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 19:01:48', '登入成功'),
(5, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 19:23:30', '登入成功'),
(7, '0001', 'admin2', '1234', '', '管理者', '2023-02-10 19:26:26', '登入成功'),
(9, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 19:27:34', '登入成功'),
(11, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 20:53:21', '登入成功'),
(12, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 20:53:52', '登入成功'),
(13, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 20:54:23', '登入成功'),
(15, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 21:20:45', '登入成功'),
(19, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 21:21:54', '登入成功'),
(21, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 21:52:03', '登入成功'),
(23, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 22:34:11', '登入成功'),
(24, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 22:43:28', '登入成功'),
(25, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 22:44:30', '登入成功'),
(26, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 23:01:46', '登出成功'),
(27, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 23:05:55', '登入成功'),
(28, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-10 23:24:14', '登出成功'),
(29, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-11 08:04:29', '登入成功'),
(30, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-11 08:20:22', '登入成功'),
(31, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-11 08:21:39', '登出成功'),
(32, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-11 08:22:22', '登入成功'),
(33, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-11 09:26:07', '登出成功'),
(34, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-11 09:27:08', '登入成功'),
(35, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-11 09:36:37', '登出成功'),
(36, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-11 09:41:35', '登入成功'),
(37, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-11 11:52:38', '登出成功'),
(38, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-11 11:53:03', '登入成功'),
(39, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-11 15:46:27', '登出成功'),
(40, '0002', 'user', '1234', '', '一般使用者', '2023-02-11 15:46:59', '登入成功'),
(41, '0002', 'user', '1234', '', '一般使用者', '2023-02-15 14:00:29', '登出成功'),
(42, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-15 14:00:54', '登入成功'),
(43, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-16 09:52:09', '登出成功'),
(44, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-17 17:07:32', '登入成功'),
(45, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-17 17:07:45', '登出成功'),
(46, '0000', 'admin', '1234', '超級管理者', '管理者', '', '登入成功'),
(47, '0000', 'admin', '1234', '超級管理者', '管理者', '', '登出成功'),
(48, 'admin', '1234', '超級管理者', '0000', '管理者', '2023-02-18 19:15:42', '登入失敗'),
(49, 'admin', '1234', '超級管理者', '0000', '管理者', '2023-02-18 19:18:00', '登入失敗'),
(50, 'admin', '1234', '超級管理者', '0000', '管理者', '2023-02-18 19:19:52', '登入失敗'),
(51, 'admin', '1234', '超級管理者', '0000', '管理者', '2023-02-18 19:26:03', '登入成功'),
(52, '未知', '', '', '', '', '', '登出成功'),
(53, 'admin', '1234', '超級管理者', '0000', '管理者', '2023-02-18 20:54:01', '登入成功'),
(54, '未知', '', '', '', '', '', '登出成功'),
(55, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-18 20:55:31', '登入成功'),
(56, '未知', '', '', '', '', '', '登出成功'),
(57, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-18 20:58:16', '登入成功'),
(58, 'admin', '1234', '超級管理者', '0000', '管理者', '2023-02-18 21:48:27', '登出成功'),
(59, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-18 21:48:41', '登入成功'),
(60, 'admin', '1234', '超級管理者', '0000', '管理者', '2023-02-18 22:17:21', '登出成功');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `1` text NOT NULL,
  `2` text NOT NULL,
  `3` text NOT NULL,
  `4` text NOT NULL,
  `5` text NOT NULL,
  `6` text NOT NULL,
  `7` text NOT NULL,
  `8` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`) VALUES
(1, 'name', 'cost', 'picture', 'introduction', '', 'date', '', 'link'),
(2, 'picture', 'name', '', 'introduction', '', 'date', 'link', 'cost');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `number` text NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `number`, `permission`) VALUES
(1, 'admin', '1234', '超級管理者', '0000', '管理者'),
(4, 'todo', '1234', 'Test bot', '0003', '管理者'),
(5, 'user1213', '1234', '1234', '0004', '一般使用者');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `coffee`
--
ALTER TABLE `coffee`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
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
-- 使用資料表自動遞增(AUTO_INCREMENT) `coffee`
--
ALTER TABLE `coffee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
