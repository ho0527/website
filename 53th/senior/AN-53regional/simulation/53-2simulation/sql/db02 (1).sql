-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-03-16 10:52:04
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db02`
--

-- --------------------------------------------------------

--
-- 資料表結構 `coffee`
--

CREATE TABLE `coffee` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `cost` int(11) NOT NULL,
  `link` text NOT NULL,
  `date` text NOT NULL,
  `intr` text NOT NULL,
  `picture` text NOT NULL,
  `val` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `coffee`
--

INSERT INTO `coffee` (`id`, `name`, `cost`, `link`, `date`, `intr`, `picture`, `val`) VALUES
(1, 'test12345', 10900, 'link', '2023-03-16 05:26:30', 'intrintr', '', '1'),
(2, 'hihihihi:)', 5000, 'link', '2023-03-16 05:30:06', 'intitnitntin', '', '2');

-- --------------------------------------------------------

--
-- 資料表結構 `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `number` text NOT NULL,
  `move` text NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `data`
--

INSERT INTO `data` (`id`, `number`, `move`, `time`) VALUES
(1, '0000', '登入失敗', '2023-03-16 15:18:26'),
(2, '0000', '登入成功', '2023-03-16 15:18:46'),
(4, '0000', '登入成功', '2023-03-16 15:35:34'),
(6, '0000', '登入成功', '2023-03-16 16:18:13'),
(7, '0000', '登出成功', '2023-03-16 16:18:36'),
(8, '0000', '登入成功', '2023-03-16 16:18:45'),
(9, '0000', '登出成功', '2023-03-16 16:33:53'),
(10, '0000', '登入成功', '2023-03-16 16:35:10'),
(11, '0000', '登出成功', '2023-03-16 16:42:33'),
(12, '0000', '登入成功', '2023-03-16 16:43:15'),
(13, '0000', '登出成功', '2023-03-16 17:39:18'),
(14, '未知', '登入失敗', '2023-03-16 17:42:38'),
(15, '未知', '登入失敗', '2023-03-16 17:42:53'),
(16, '未知', '登入失敗', '2023-03-16 17:43:00'),
(17, '0000', '登入成功', '2023-03-16 17:43:12'),
(18, '0000', '登出成功', '2023-03-16 17:44:20'),
(19, '0001', '登入成功', '2023-03-16 17:44:31'),
(20, '0001', '登出成功', '2023-03-16 17:45:50'),
(21, '0000', '登入成功', '2023-03-16 17:46:25'),
(22, '0000', '登出成功', '2023-03-16 17:46:45'),
(23, '0000', '登入成功', '2023-03-16 17:50:49'),
(24, '0000', '登出成功', '2023-03-16 17:51:42');

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
(1, 'name', 'cost', 'picture', 'intr', 'picture', 'date', 'picture', 'link'),
(2, 'picture', 'name', 'picture', 'intr', 'picture', 'date', 'link', 'cost');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `number` text NOT NULL,
  `username` text NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `permission` text NOT NULL,
  `timer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `number`, `username`, `code`, `name`, `permission`, `timer`) VALUES
(1, '0000', 'admin', '1234', '超級管理者', '管理者', 60),
(2, '0001', 'user', '1234', 'test', '一般使用者', 60),
(4, '0003', 'user2', '5678', 'test2', '一般使用者', 60),
(5, '0004', 'user5678', '123456', 'hi', '管理者', 60);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
