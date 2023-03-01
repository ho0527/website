-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-03-01 01:11:46
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db06`
--

-- --------------------------------------------------------

--
-- 資料表結構 `coffee`
--

CREATE TABLE `coffee` (
  `id` int(11) NOT NULL,
  `picture` text COLLATE utf8mb4_bin NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `cost` text COLLATE utf8mb4_bin NOT NULL,
  `link` text COLLATE utf8mb4_bin NOT NULL,
  `date` text COLLATE utf8mb4_bin NOT NULL,
  `intr` text COLLATE utf8mb4_bin NOT NULL,
  `val` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `coffee`
--

INSERT INTO `coffee` (`id`, `picture`, `name`, `cost`, `link`, `date`, `intr`, `val`) VALUES
(3, 'image/png_IMG_0174.png', 'tests', '1000', 'links', '2023-03-01 07:42:20', 'hfduowihuodsighboiua', '1');

-- --------------------------------------------------------

--
-- 資料表結構 `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `number` text COLLATE utf8mb4_bin NOT NULL,
  `username` text COLLATE utf8mb4_bin NOT NULL,
  `code` text COLLATE utf8mb4_bin NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `permission` text COLLATE utf8mb4_bin NOT NULL,
  `move` text COLLATE utf8mb4_bin NOT NULL,
  `movertime` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `data`
--

INSERT INTO `data` (`id`, `number`, `username`, `code`, `name`, `permission`, `move`, `movertime`) VALUES
(1, '未知', '', '', '', '', '登入失敗', '2023-02-28 14:07:25'),
(2, '0000', 'admin', '1234', '超級管理者', '管理者', '登入成功', '2023-02-28 14:09:13'),
(3, '0000', 'admin', '1234', '超級管理者', '管理者', '登出成功', '2023-02-28 17:37:43'),
(4, '0000', 'admin', '1234', '超級管理者', '管理者', '登入成功', '2023-02-28 17:38:09'),
(5, '0000', 'admin', '1234', '超級管理者', '管理者', '登出成功', '2023-02-28 19:55:48'),
(6, '0000', 'admin', '1234', '超級管理者', '管理者', '登入成功', '2023-02-28 20:50:14');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `1` text COLLATE utf8mb4_bin NOT NULL,
  `2` text COLLATE utf8mb4_bin NOT NULL,
  `3` text COLLATE utf8mb4_bin NOT NULL,
  `4` text COLLATE utf8mb4_bin NOT NULL,
  `5` text COLLATE utf8mb4_bin NOT NULL,
  `6` text COLLATE utf8mb4_bin NOT NULL,
  `7` text COLLATE utf8mb4_bin NOT NULL,
  `8` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`) VALUES
(1, 'name', 'cost', 'picture', 'intr', '', 'date', '', 'link'),
(2, 'picture', 'name', '', 'intr', '', 'date', 'link', 'cost');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `number` text COLLATE utf8mb4_bin NOT NULL,
  `username` text COLLATE utf8mb4_bin NOT NULL,
  `code` text COLLATE utf8mb4_bin NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `permission` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `number`, `username`, `code`, `name`, `permission`) VALUES
(1, '0000', 'admin', '1234', '超級管理者', '管理者');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
