-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-03-10 02:08:06
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
-- 資料庫： `db12`
--

-- --------------------------------------------------------

--
-- 資料表結構 `coffee`
--

CREATE TABLE `coffee` (
  `id` int(11) NOT NULL,
  `picture` text COLLATE utf8mb4_bin NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `cost` int(11) NOT NULL,
  `link` text COLLATE utf8mb4_bin NOT NULL,
  `date` text COLLATE utf8mb4_bin NOT NULL,
  `intr` text COLLATE utf8mb4_bin NOT NULL,
  `val` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `coffee`
--

INSERT INTO `coffee` (`id`, `picture`, `name`, `cost`, `link`, `date`, `intr`, `val`) VALUES
(1, 'image/png_IMG_0174.png', 'test', 1000, 'link', '2023-03-10 08:50:58', 'intr', '1');

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
  `movetime` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `data`
--

INSERT INTO `data` (`id`, `number`, `username`, `code`, `name`, `permission`, `move`, `movetime`) VALUES
(1, '0000', 'admin', '1234', '超級管理者', '管理者', '登入成功', '2023-03-09 08:29:16'),
(2, '0000', 'admin', '1234', '超級管理者', '管理者', '登出成功', '2023-03-09 11:12:48'),
(3, '0000', 'admin', '1234', '超級管理者', '管理者', '登入成功', '2023-03-09 11:13:50'),
(4, '0000', 'admin', '1234', '超級管理者', '管理者', '登出成功', '2023-03-10 09:07:29');

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
(1, '0000', 'admin', '1234', '超級管理者', '管理者'),
(3, '0002', 'user', '1234', 'test', '一般使用者');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
