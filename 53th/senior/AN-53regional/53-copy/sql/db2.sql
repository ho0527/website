-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-02-24 06:58:20
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
-- 資料庫： `db2`
--

-- --------------------------------------------------------

--
-- 資料表結構 `coffee`
--

CREATE TABLE `coffee` (
  `id` int(11) NOT NULL,
  `picture` text NOT NULL,
  `name` text NOT NULL,
  `intr` text NOT NULL,
  `link` text NOT NULL,
  `cost` text NOT NULL,
  `date` text NOT NULL,
  `product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `coffee`
--

INSERT INTO `coffee` (`id`, `picture`, `name`, `intr`, `link`, `cost`, `date`, `product`) VALUES
(1, '', 'fsah;ouguagi', 'ffsgfdfsg', 'ugiuvshusa', '1000', '2023-02-24 13:09:06', 1),
(2, '', 'sfb;uasibali', ':)', 'link', '2000', '2023-02-24 13:10:21', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `number` text NOT NULL,
  `username` text NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `premission` text NOT NULL,
  `movetime` text NOT NULL,
  `move` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `data`
--

INSERT INTO `data` (`id`, `number`, `username`, `code`, `name`, `premission`, `movetime`, `move`) VALUES
(1, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 10:07:13', '登入成功'),
(2, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 10:07:47', '登入失敗'),
(3, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 10:07:58', '登入成功'),
(4, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 11:11:55', '登出成功'),
(5, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 11:12:17', '登入成功'),
(6, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 11:25:52', '登出成功'),
(7, '0001', 'user1', '1234', 'user1', '管理者', '2023-02-24 11:26:16', '登入成功'),
(8, '0001', 'user1', '1234', 'user1', '管理者', '2023-02-24 11:26:24', '登出成功'),
(9, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 11:26:58', '登入成功'),
(10, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 11:28:35', '登出成功'),
(11, '0002', 'user2', '1234', 'user2', '一般使用者', '2023-02-24 11:28:49', '登入成功'),
(12, '0002', 'user2', '1234', 'user2', '一般使用者', '2023-02-24 11:30:22', '登出成功'),
(13, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 11:30:51', '登入成功'),
(14, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 13:10:48', '登出成功'),
(15, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 13:12:27', '登入成功'),
(16, '0000', 'admin', '1234', '超級管理者', '管理者', '2023-02-24 13:32:13', '登出成功');

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
(1, 'name', 'cost', 'picture', 'intr', '', 'date', '', 'link'),
(4, 'picture', 'name', 'intr', '', '', 'date', 'link', 'cost');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `number` text NOT NULL,
  `premission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `username`, `code`, `name`, `number`, `premission`) VALUES
(1, 'admin', '1234', '超級管理者', '0000', '管理者'),
(3, 'user', '1234', 'user2', '0002', '一般使用者');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
