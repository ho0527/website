-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-02-27 16:40:08
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
-- 資料庫： `db04`
--

-- --------------------------------------------------------

--
-- 資料表結構 `coffee`
--

CREATE TABLE `coffee` (
  `id` int(11) NOT NULL,
  `picture` text NOT NULL,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `cost` int(11) NOT NULL,
  `date` text NOT NULL,
  `intr` text NOT NULL,
  `product` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `coffee`
--

INSERT INTO `coffee` (`id`, `picture`, `name`, `link`, `cost`, `date`, `intr`, `product`) VALUES
(1, 'image/image.jpg', 'name', 'link', 1000, '2023-02-27 23:06:06', 'hfuidhiasudhb', '1'),
(2, 'image/png_IMG_0174.png', 'test2', 'link2', 2000, '2023-02-27 23:25:27', 'ufiywgicgsdauiyg', '1');

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
  `move` text NOT NULL,
  `movetime` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `data`
--

INSERT INTO `data` (`id`, `number`, `username`, `password`, `name`, `permission`, `move`, `movetime`) VALUES
(1, '未知', '', '', '', '', '登入失敗', '2023-02-27 09:28:13'),
(2, '0000', 'admin', '1234', '管理者', '超級管理者', '登入失敗', '2023-02-27 09:28:42'),
(3, '0000', 'admin', '1234', '管理者', '超級管理者', '登入成功', '2023-02-27 09:30:10'),
(4, '0000', 'admin', '1234', '管理者', '超級管理者', '登出成功', '2023-02-27 17:29:53'),
(5, '0000', 'admin', '1234', '管理者', '超級管理者', '登入成功', '2023-02-27 17:30:57'),
(6, '0000', 'admin', '1234', '管理者', '超級管理者', '登出成功', '2023-02-27 20:14:33'),
(7, '0000', 'admin', '1234', '管理者', '超級管理者', '登入成功', '2023-02-27 20:16:11');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `number` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `number`, `username`, `password`, `name`, `permission`) VALUES
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
