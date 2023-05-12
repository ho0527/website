-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-05-12 14:11:49
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.4

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
-- 資料表結構 `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `move` text NOT NULL,
  `movetime` text NOT NULL,
  `ps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `log`
--

INSERT INTO `log` (`id`, `username`, `move`, `movetime`, `ps`) VALUES
(1, 'admin', '鎖定問卷', '2023-05-09 22:13:27', 'qid=1'),
(2, 'admin', '解鎖問卷', '2023-05-09 22:13:27', 'qid=1'),
(3, 'admin', '鎖定問卷', '2023-05-09 22:13:27', 'qid=1'),
(4, 'admin', '解鎖問卷', '2023-05-09 22:13:28', 'qid=1'),
(5, 'admin', '鎖定問卷', '2023-05-09 22:13:28', 'qid=1'),
(6, 'admin', '解鎖問卷', '2023-05-09 22:13:28', 'qid=1'),
(7, 'admin', '填寫問卷', '2023-05-09 22:14:08', 'qid=1'),
(8, 'admin', '複製問卷(question)', '2023-05-09 22:14:18', 'qid=2'),
(9, 'admin', '複製問卷(all)', '2023-05-09 22:14:23', 'qid=1'),
(10, 'admin', '登出系統', '2023-05-10 19:27:42', ''),
(11, 'admin', '登入系統', '2023-05-10 19:39:51', ''),
(12, 'admin', '編輯問卷', '2023-05-10 19:39:57', 'qid=1'),
(13, 'admin', '儲存問卷成功', '2023-05-10 19:41:30', 'qid=1'),
(14, 'admin', '編輯問卷', '2023-05-10 19:42:51', 'qid=1'),
(15, 'admin', '複製問卷(all)', '2023-05-10 19:43:06', 'qid=8'),
(16, 'admin', '編輯問卷', '2023-05-10 19:43:10', 'qid=20'),
(17, 'admin', '儲存問卷成功', '2023-05-10 19:43:27', 'qid=20'),
(18, 'admin', '儲存問卷成功', '2023-05-10 19:43:51', 'qid=20'),
(19, 'admin', '複製問卷(all)', '2023-05-10 19:44:43', 'qid=20'),
(20, 'admin', '編輯問卷', '2023-05-10 19:44:48', 'qid=21'),
(21, 'admin', '編輯問卷', '2023-05-10 19:44:58', 'qid=17'),
(22, 'admin', '複製問卷(all)', '2023-05-10 19:45:05', 'qid=17'),
(23, 'admin', '編輯問卷', '2023-05-10 19:45:09', 'qid=22'),
(24, 'admin', '儲存問卷成功', '2023-05-10 19:45:11', 'qid=22'),
(25, 'admin', '儲存問卷成功', '2023-05-10 19:45:23', 'qid=22'),
(26, 'admin', '儲存問卷成功', '2023-05-10 19:46:31', 'qid=22'),
(27, 'admin', '儲存問卷成功', '2023-05-10 19:46:37', 'qid=22'),
(28, 'admin', '儲存問卷成功', '2023-05-10 19:46:43', 'qid=22'),
(29, 'admin', '刪除問卷', '2023-05-10 19:46:51', 'qid=1'),
(30, 'admin', '刪除問卷', '2023-05-10 19:46:58', 'qid=21'),
(31, 'admin', '刪除問卷', '2023-05-10 19:47:01', 'qid=22'),
(32, 'admin', '編輯問卷', '2023-05-10 19:47:04', 'qid=19'),
(33, 'admin', '編輯問卷', '2023-05-10 19:47:08', 'qid=20'),
(34, 'admin', '編輯問卷', '2023-05-10 19:47:11', 'qid=20'),
(35, 'admin', '刪除問卷', '2023-05-10 19:47:15', 'qid=20'),
(36, 'admin', '編輯問卷', '2023-05-10 19:47:20', 'qid=19'),
(37, 'admin', '編輯問卷', '2023-05-10 19:48:04', 'qid=19'),
(38, 'admin', '儲存問卷成功', '2023-05-10 19:48:16', 'qid=19'),
(39, 'admin', '編輯問卷', '2023-05-10 20:05:53', 'qid=19'),
(40, 'admin', '編輯問卷', '2023-05-10 20:08:34', 'qid=19'),
(41, 'admin', '編輯問卷', '2023-05-10 20:10:47', 'qid=19'),
(42, 'admin', '編輯問卷', '2023-05-10 20:12:25', 'qid=19'),
(43, 'admin', '編輯問卷', '2023-05-10 20:12:32', 'qid=17'),
(44, 'admin', '編輯問卷', '2023-05-10 20:16:30', 'qid=19'),
(45, 'admin', '填寫問卷', '2023-05-10 20:17:07', ''),
(46, 'admin', '登出系統', '2023-05-10 21:11:47', ''),
(47, 'admin', '登入系統', '2023-05-11 18:43:10', ''),
(48, 'admin', '編輯問卷', '2023-05-11 18:43:17', 'qid=19'),
(49, 'admin', '編輯問卷', '2023-05-11 18:43:25', 'qid=19'),
(50, 'admin', '儲存問卷成功', '2023-05-11 18:48:05', 'qid=19'),
(51, 'admin', '儲存問卷成功', '2023-05-11 18:48:15', 'qid=19'),
(52, 'admin', '儲存問卷成功', '2023-05-11 18:48:21', 'qid=19'),
(53, 'admin', '編輯問卷', '2023-05-11 18:48:30', 'qid=19'),
(54, 'admin', '編輯問卷', '2023-05-11 20:33:22', 'qid=19'),
(55, 'admin', '登出系統', '2023-05-11 21:05:48', ''),
(56, 'admin', '登入系統', '2023-05-11 21:30:18', ''),
(57, 'admin', '編輯問卷', '2023-05-11 21:59:52', 'qid=19'),
(58, 'admin', '編輯問卷', '2023-05-11 22:02:47', 'qid=19'),
(59, 'admin', '填寫問卷', '2023-05-11 22:02:51', 'qid=19'),
(60, 'admin', '登出系統', '2023-05-11 22:03:08', ''),
(61, 'admin', '登入系統', '2023-05-12 13:09:26', ''),
(62, 'admin', '登出系統', '2023-05-12 13:13:46', ''),
(63, 'admin', '登入系統', '2023-05-12 18:46:11', ''),
(64, 'admin', '填寫問卷', '2023-05-12 19:22:59', 'qid=17'),
(65, 'admin', '填寫問卷', '2023-05-12 19:42:49', 'qid=19'),
(66, 'admin', '填寫問卷', '2023-05-12 19:43:01', 'qid=17');

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
  `maxlen` text NOT NULL,
  `ps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `question`
--

INSERT INTO `question` (`id`, `title`, `questioncount`, `pagelen`, `responcount`, `lock`, `maxlen`, `ps`) VALUES
(1, 'test2', '24', '', '0', 'false', '', 'del'),
(2, 'test', '20', '', '0', 'true', '', ''),
(8, 'test2 copy', '24', '', '0', 'true', '', ''),
(9, 'test copy', '20', '', '0', 'false', '', 'del'),
(10, 'test copy copy', '20', '', '0', 'false', '', 'del'),
(12, 'test copy copy copy copy', '20', '', '0', 'false', '', 'del'),
(13, 'copy test', '20', '', '0', 'false', '', ''),
(14, 'copy copy test', '20', '', '0', 'false', '', ''),
(15, 'copy copy copy test', '20', '', '0', 'true', '', ''),
(16, 'copy copy copy copy test', '20', '', '0', 'false', '', ''),
(17, 'test2 copy copy', '24', '', '1', 'false', '100', ''),
(18, 'copy copy copy copy copy test', '20', '', '0', 'false', '', ''),
(19, 'admin', '24', '', '0', 'false', '', ''),
(20, 'test2 copy copy copy copy', '24', '', '0', 'false', '', 'del'),
(21, 'test2 copy copy copy copy copy', '24', '', '0', 'false', '', 'del'),
(22, 'test2 copy copy copy copy copy copy', '24', '', '0', 'false', '100', 'del');

-- --------------------------------------------------------

--
-- 資料表結構 `questioncode`
--

CREATE TABLE `questioncode` (
  `id` int(11) NOT NULL,
  `questionid` text NOT NULL,
  `user` text NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `questioncode`
--

INSERT INTO `questioncode` (`id`, `questionid`, `user`, `code`) VALUES
(2, '2', '', '123456789'),
(5, '15', '', '2123456789'),
(6, '17', '', '9877654323456'),
(14, '1', 'admin', '235531243234452413251'),
(15, '1', 'user', '235531143433251'),
(21, '19', 'admin', 'chris44343242133423578987'),
(22, '19', 'user', '5365335636523256352');

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
  `opition` text NOT NULL,
  `showmultimorerespond` text NOT NULL,
  `ps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `questionlog`
--

INSERT INTO `questionlog` (`id`, `questionid`, `order`, `desciption`, `required`, `mod`, `opition`, `showmultimorerespond`, `ps`) VALUES
(25, '2', '1', '', 'false', 'none', '', '', ''),
(26, '2', '2', '', 'false', 'none', '', '', ''),
(27, '2', '3', '', 'false', 'none', '', '', ''),
(28, '2', '4', '', 'false', 'none', '', '', ''),
(29, '2', '5', '', 'false', 'none', '', '', ''),
(30, '2', '6', '', 'false', 'none', '', '', ''),
(31, '2', '7', '', 'false', 'none', '', '', ''),
(32, '2', '8', '', 'false', 'none', '', '', ''),
(33, '2', '9', '', 'false', 'none', '', '', ''),
(34, '2', '10', '', 'false', 'none', '', '', ''),
(35, '2', '11', '', 'false', 'none', '', '', ''),
(36, '2', '12', '', 'false', 'none', '', '', ''),
(37, '2', '13', '', 'false', 'none', '', '', ''),
(38, '2', '14', '', 'false', 'none', '', '', ''),
(39, '2', '15', '', 'false', 'none', '', '', ''),
(40, '2', '16', '', 'false', 'none', '', '', ''),
(41, '2', '17', '', 'false', 'none', '', '', ''),
(42, '2', '18', '', 'false', 'none', '', '', ''),
(43, '2', '19', '', 'false', 'none', '', '', ''),
(44, '2', '20', '', 'false', 'none', '', '', ''),
(69, '8', '1', '', 'false', 'yesno', '', '', ''),
(70, '8', '2', '', 'false', 'single', '1|&|2|&|3 ', '', ''),
(71, '8', '3', '', 'false', 'none', '', '', ''),
(72, '8', '4', '', 'false', 'none', '', '', ''),
(73, '8', '5', '', 'false', 'none', '', '', ''),
(74, '8', '6', '', 'false', 'none', '', '', ''),
(75, '8', '7', 'test', 'true', 'yesno', '', '', ''),
(76, '8', '8', '', 'false', 'single', '', '', ''),
(77, '8', '9', '', 'false', 'multi', '', '', ''),
(78, '8', '10', '', 'true', 'qa', '', '', ''),
(79, '8', '11', '', 'false', 'multi', '', '', ''),
(80, '8', '12', '', 'false', 'single', '', '', ''),
(81, '8', '13', '', 'false', 'yesno', '', '', ''),
(82, '8', '14', '', 'false', 'single', '', '', ''),
(83, '8', '15', '', 'false', 'multi', 'eweqwqewweq wefqfwq wqeqwfwqeqwf qewweqewfq qwefqweewq 5tt5435 ', '', ''),
(84, '8', '16', '', 'false', 'qa', '', '', ''),
(85, '8', '17', '', 'false', 'multi', '', '', ''),
(86, '8', '18', '', 'false', 'single', '', '', ''),
(87, '8', '19', 'yesno', 'false', 'yesno', '', '', ''),
(88, '8', '20', '', 'false', 'single', '', '', ''),
(89, '8', '21', 'mult', 'false', 'multi', '', '', ''),
(90, '8', '22', '', 'true', 'single', '', '', ''),
(91, '8', '23', '', 'false', 'yesno', '', '', ''),
(92, '8', '24', '', 'false', 'single', '', '', ''),
(93, '10', '1', '', '', 'none', '', '', ''),
(94, '10', '2', '', '', 'none', '', '', ''),
(95, '10', '3', '', '', 'none', '', '', ''),
(96, '10', '4', '', '', 'none', '', '', ''),
(97, '10', '5', '', '', 'none', '', '', ''),
(98, '10', '6', '', '', 'none', '', '', ''),
(99, '10', '7', '', '', 'none', '', '', ''),
(100, '10', '8', '', '', 'none', '', '', ''),
(101, '10', '9', '', '', 'none', '', '', ''),
(102, '10', '10', '', '', 'none', '', '', ''),
(103, '10', '11', '', '', 'none', '', '', ''),
(104, '10', '12', '', '', 'none', '', '', ''),
(105, '10', '13', '', '', 'none', '', '', ''),
(106, '10', '14', '', '', 'none', '', '', ''),
(107, '10', '15', '', '', 'none', '', '', ''),
(108, '10', '16', '', '', 'none', '', '', ''),
(109, '10', '17', '', '', 'none', '', '', ''),
(110, '10', '18', '', '', 'none', '', '', ''),
(111, '10', '19', '', '', 'none', '', '', ''),
(112, '10', '20', '', '', 'none', '', '', ''),
(113, '12', '1', '', 'false', 'none', '', '', ''),
(114, '12', '2', '', 'false', 'none', '', '', ''),
(115, '12', '3', '', 'false', 'none', '', '', ''),
(116, '12', '4', '', 'false', 'none', '', '', ''),
(117, '12', '5', '', 'false', 'none', '', '', ''),
(118, '12', '6', '', 'false', 'none', '', '', ''),
(119, '12', '7', '', 'false', 'none', '', '', ''),
(120, '12', '8', '', 'false', 'none', '', '', ''),
(121, '12', '9', '', 'false', 'none', '', '', ''),
(122, '12', '10', '', 'false', 'none', '', '', ''),
(123, '12', '11', '', 'false', 'none', '', '', ''),
(124, '12', '12', '', 'false', 'none', '', '', ''),
(125, '12', '13', '', 'false', 'none', '', '', ''),
(126, '12', '14', '', 'false', 'none', '', '', ''),
(127, '12', '15', '', 'false', 'none', '', '', ''),
(128, '12', '16', '', 'false', 'none', '', '', ''),
(129, '12', '17', '', 'false', 'none', '', '', ''),
(130, '12', '18', '', 'false', 'none', '', '', ''),
(131, '12', '19', '', 'false', 'none', '', '', ''),
(132, '12', '20', '', 'false', 'none', '', '', ''),
(133, '13', '1', '', 'false', 'none', '', '', ''),
(134, '13', '2', '', 'false', 'none', '', '', ''),
(135, '13', '3', '', 'false', 'none', '', '', ''),
(136, '13', '4', '', 'false', 'none', '', '', ''),
(137, '13', '5', '', 'false', 'none', '', '', ''),
(138, '13', '6', '', 'false', 'none', '', '', ''),
(139, '13', '7', '', 'false', 'none', '', '', ''),
(140, '13', '8', '', 'false', 'none', '', '', ''),
(141, '13', '9', '', 'false', 'none', '', '', ''),
(142, '13', '10', '', 'false', 'none', '', '', ''),
(143, '13', '11', '', 'false', 'none', '', '', ''),
(144, '13', '12', '', 'false', 'none', '', '', ''),
(145, '13', '13', '', 'false', 'none', '', '', ''),
(146, '13', '14', '', 'false', 'none', '', '', ''),
(147, '13', '15', '', 'false', 'none', '', '', ''),
(148, '13', '16', '', 'false', 'none', '', '', ''),
(149, '13', '17', '', 'false', 'none', '', '', ''),
(150, '13', '18', '', 'false', 'none', '', '', ''),
(151, '13', '19', '', 'false', 'none', '', '', ''),
(152, '13', '20', '', 'false', 'none', '', '', ''),
(153, '14', '1', '', 'false', 'none', '', '', ''),
(154, '14', '2', '', 'false', 'none', '', '', ''),
(155, '14', '3', '', 'false', 'none', '', '', ''),
(156, '14', '4', '', 'false', 'none', '', '', ''),
(157, '14', '5', '', 'false', 'none', '', '', ''),
(158, '14', '6', '', 'false', 'none', '', '', ''),
(159, '14', '7', '', 'false', 'none', '', '', ''),
(160, '14', '8', '', 'false', 'none', '', '', ''),
(161, '14', '9', '', 'false', 'none', '', '', ''),
(162, '14', '10', '', 'false', 'none', '', '', ''),
(163, '14', '11', '', 'false', 'none', '', '', ''),
(164, '14', '12', '', 'false', 'none', '', '', ''),
(165, '14', '13', '', 'false', 'none', '', '', ''),
(166, '14', '14', '', 'false', 'none', '', '', ''),
(167, '14', '15', '', 'false', 'none', '', '', ''),
(168, '14', '16', '', 'false', 'none', '', '', ''),
(169, '14', '17', '', 'false', 'none', '', '', ''),
(170, '14', '18', '', 'false', 'none', '', '', ''),
(171, '14', '19', '', 'false', 'none', '', '', ''),
(172, '14', '20', '', 'false', 'none', '', '', ''),
(173, '15', '1', '', 'false', 'none', '', '', ''),
(174, '15', '2', '', 'false', 'none', '', '', ''),
(175, '15', '3', '', 'false', 'none', '', '', ''),
(176, '15', '4', '', 'false', 'none', '', '', ''),
(177, '15', '5', '', 'false', 'none', '', '', ''),
(178, '15', '6', '', 'false', 'none', '', '', ''),
(179, '15', '7', '', 'false', 'none', '', '', ''),
(180, '15', '8', '', 'false', 'none', '', '', ''),
(181, '15', '9', '', 'false', 'none', '', '', ''),
(182, '15', '10', '', 'false', 'none', '', '', ''),
(183, '15', '11', '', 'false', 'none', '', '', ''),
(184, '15', '12', '', 'false', 'none', '', '', ''),
(185, '15', '13', '', 'false', 'none', '', '', ''),
(186, '15', '14', '', 'false', 'none', '', '', ''),
(187, '15', '15', '', 'false', 'none', '', '', ''),
(188, '15', '16', '', 'false', 'none', '', '', ''),
(189, '15', '17', '', 'false', 'none', '', '', ''),
(190, '15', '18', '', 'false', 'none', '', '', ''),
(191, '15', '19', '', 'false', 'none', '', '', ''),
(192, '15', '20', '', 'false', 'none', '', '', ''),
(193, '16', '1', '', 'false', 'none', '', '', ''),
(194, '16', '2', '', 'false', 'none', '', '', ''),
(195, '16', '3', '', 'false', 'none', '', '', ''),
(196, '16', '4', '', 'false', 'none', '', '', ''),
(197, '16', '5', '', 'false', 'none', '', '', ''),
(198, '16', '6', '', 'false', 'none', '', '', ''),
(199, '16', '7', '', 'false', 'none', '', '', ''),
(200, '16', '8', '', 'false', 'none', '', '', ''),
(201, '16', '9', '', 'false', 'none', '', '', ''),
(202, '16', '10', '', 'false', 'none', '', '', ''),
(203, '16', '11', '', 'false', 'none', '', '', ''),
(204, '16', '12', '', 'false', 'none', '', '', ''),
(205, '16', '13', '', 'false', 'none', '', '', ''),
(206, '16', '14', '', 'false', 'none', '', '', ''),
(207, '16', '15', '', 'false', 'none', '', '', ''),
(208, '16', '16', '', 'false', 'none', '', '', ''),
(209, '16', '17', '', 'false', 'none', '', '', ''),
(210, '16', '18', '', 'false', 'none', '', '', ''),
(211, '16', '19', '', 'false', 'none', '', '', ''),
(212, '16', '20', '', 'false', 'none', '', '', ''),
(213, '17', '1', '', 'false', 'yesno', '', '', ''),
(214, '17', '2', '', 'false', 'single', '1|&|2|&|3|&|', '', ''),
(215, '17', '3', '', 'false', 'yesno', '', '', ''),
(216, '17', '4', '', 'false', 'single', '111|&|442132143|&|', '', ''),
(217, '17', '5', '', 'false', 'yesno', '', '', ''),
(218, '17', '6', '', 'false', 'single', '', '', ''),
(219, '17', '7', 'test', 'true', 'yesno', '', '', ''),
(220, '17', '8', '', 'false', 'single', '', '', ''),
(221, '17', '9', '', 'false', 'multi', '', '', ''),
(222, '17', '10', '', 'true', 'qa', '', '', ''),
(223, '17', '11', '', 'false', 'multi', '', '', ''),
(224, '17', '12', '', 'false', 'single', '', '', ''),
(225, '17', '13', '', 'false', 'yesno', '', '', ''),
(226, '17', '14', '', 'false', 'single', '', '', ''),
(227, '17', '15', '', 'false', 'multi', 'eweqwqewweq|&|wefqfwq|&|wqeqwfwqeqwf|&|qewweqewfq|&|qwefqweewq|&|5tt54353|&|', '', ''),
(228, '17', '16', '', 'false', 'qa', '', '', ''),
(229, '17', '17', '', 'false', 'multi', '', '', ''),
(230, '17', '18', '', 'false', 'single', '', '', ''),
(231, '17', '19', 'yesno', 'false', 'yesno', '', '', ''),
(232, '17', '20', '', 'false', 'single', '', '', ''),
(233, '17', '21', 'mult', 'false', 'multi', '', '', ''),
(234, '17', '22', '', 'true', 'single', '254363789|&|', '', ''),
(235, '17', '23', '', 'false', 'yesno', '', '', ''),
(236, '17', '24', '', 'false', 'single', '', '', ''),
(237, '18', '1', '', 'false', 'none', '', '', ''),
(238, '18', '2', '', 'false', 'none', '', '', ''),
(239, '18', '3', '', 'false', 'none', '', '', ''),
(240, '18', '4', '', 'false', 'none', '', '', ''),
(241, '18', '5', '', 'false', 'none', '', '', ''),
(242, '18', '6', '', 'false', 'none', '', '', ''),
(243, '18', '7', '', 'false', 'none', '', '', ''),
(244, '18', '8', '', 'false', 'none', '', '', ''),
(245, '18', '9', '', 'false', 'none', '', '', ''),
(246, '18', '10', '', 'false', 'none', '', '', ''),
(247, '18', '11', '', 'false', 'none', '', '', ''),
(248, '18', '12', '', 'false', 'none', '', '', ''),
(249, '18', '13', '', 'false', 'none', '', '', ''),
(250, '18', '14', '', 'false', 'none', '', '', ''),
(251, '18', '15', '', 'false', 'none', '', '', ''),
(252, '18', '16', '', 'false', 'none', '', '', ''),
(253, '18', '17', '', 'false', 'none', '', '', ''),
(254, '18', '18', '', 'false', 'none', '', '', ''),
(255, '18', '19', '', 'false', 'none', '', '', ''),
(256, '18', '20', '', 'false', 'none', '', '', ''),
(304, '1', '24', '431tr424424', 'true', 'qa', '', 'false', ''),
(376, '20', '24', '', 'false', 'single', '', 'false', ''),
(377, '21', '24', '', 'false', 'single', '', '', ''),
(498, '22', '1', '', 'false', 'yesno', '', 'false', ''),
(499, '22', '2', '4242424t5245', 'false', 'single', '1|&|2|&|3|&|233434t34t54|&|', 'false', ''),
(500, '22', '3', '', 'false', 'yesno', '', 'false', ''),
(501, '22', '4', '', 'false', 'single', '111|&|442132143|&|tt6yrjytrtyjrty|&|', 'false', ''),
(502, '22', '5', '', 'false', 'yesno', '', 'false', ''),
(503, '22', '6', '', 'false', 'single', 'thrrtetehwwetw|&|', 'false', ''),
(504, '22', '7', 'test', 'true', 'yesno', '', 'false', ''),
(505, '22', '8', '', 'false', 'single', '', 'false', ''),
(506, '22', '9', 'erwerwerw', 'true', 'multi', 'yreyjyhrjtereyry|&|tgeewrew|&|', 'true', ''),
(507, '22', '10', '', 'true', 'qa', '', 'false', ''),
(508, '22', '11', '', 'false', 'multi', '', 'true', ''),
(509, '22', '12', '', 'false', 'single', '', 'false', ''),
(510, '22', '13', '', 'false', 'yesno', '', 'false', ''),
(511, '22', '14', '', 'false', 'single', '', 'false', ''),
(512, '22', '15', '', 'false', 'multi', 'eweqwqewweq|&|wefqfwq|&|wqeqwfwqeqwf|&|qewweqewfq|&|qwefqweewq|&|5tt54353|&|', 'true', ''),
(513, '22', '16', '', 'false', 'qa', '', 'false', ''),
(514, '22', '17', '', 'false', 'multi', '', 'true', ''),
(515, '22', '18', '', 'false', 'single', '', 'false', ''),
(516, '22', '19', 'yesno', 'false', 'yesno', '', 'false', ''),
(517, '22', '20', '', 'false', 'single', '', 'false', ''),
(518, '22', '21', 'mult', 'false', 'multi', '', 'true', ''),
(519, '22', '22', '', 'true', 'single', '254363789|&|', 'false', ''),
(520, '22', '23', '', 'false', 'yesno', '', 'false', ''),
(521, '22', '24', '', 'false', 'single', '', 'false', ''),
(594, '19', '1', 'yesno', 'false', 'yesno', '', 'false', ''),
(595, '19', '2', 'test2', 'false', 'single', '1|&|2|&|3|&|', 'false', ''),
(596, '19', '3', 'ewrfrwr', 'false', 'yesno', '', 'false', ''),
(597, '19', '4', 'tyhrhyjnhgnhgf', 'false', 'single', 'ererwewgr|&|gerwrgewgewgrgw|&|egrewewrerw|&|', 'false', ''),
(598, '19', '5', 'ewwerrewgegrer', 'false', 'yesno', '', 'false', ''),
(599, '19', '6', 'wergewrewrew', 'false', 'single', 'weegrwewr|&|erwggrwe|&|wergrwerew|&|', 'false', ''),
(600, '19', '7', 'test', 'true', 'yesno', '', 'false', ''),
(601, '19', '8', 'wregewgrew', 'false', 'single', 'wergwgrerew|&|werweregwgrew|&|wrg|&|rergerwgergw|&|', 'false', ''),
(602, '19', '9', 'ewrggergermuyj', 'false', 'multi', 'wergwgrerew|&|werweregwgrew|&|wrg|&|rergerwgergw|&|wergwgrerew|&|werweregwgrew|&|wrg|&|rergerwgergw|&|wergwgrerew|&|werweregwgrew|&|', 'true', ''),
(603, '19', '10', 'tymmymytumyutj', 'true', 'qa', '', 'false', ''),
(604, '19', '11', '53665478u7865', 'false', 'multi', 'mmyutmyuj|&|myum|&|', 'true', ''),
(605, '19', '12', '', 'true', 'single', 'mmyutmyuj|&|myum|&|mmyutmyuj|&|myum|&|mmyutmyuj|&|myum|&|mmyutmyuj|&|myum|&|', 'false', ''),
(606, '19', '13', 'ttjyrytyrrtyjtryj', 'true', 'yesno', '', 'false', ''),
(607, '19', '14', 'mtytrymtyrtyr', 'false', 'single', 'ytujmytumtuhjtmu|&|iytkyuktytukktyu|&|', 'false', ''),
(608, '19', '15', '', 'false', 'multi', 'ytujmytumtuhjtmu|&|iytkyuktytukktyu|&|ytujmytumtuhjtmu|&|iytkyuktytukktyu|&|ytujmytumtuhjtmu|&|iytkyuktytukktyu|&|ytujmytumtuhjtmu|&|iytkyuktytukktyu|&|', 'true', ''),
(609, '19', '16', '', 'false', 'qa', '', 'false', ''),
(610, '19', '17', ',kkyiiuyktjkyit', 'false', 'multi', 'tjyrtrytryjtryjtryj|&|rtyjrtyjrtyjtyrj|&|tyjtrjytyjtryj|&|', 'true', ''),
(611, '19', '18', 'rgvswdraefwe', 'false', 'single', 'tjyrtrytryjtryjtryj|&|rtyjrtyjrtyjtyrj|&|tyjtrjytyjtryj|&|tjyrtrytryjtryjtryj|&|rtyjrtyjrtyjtyrj|&|tyjtrjytyjtryj|&|tjyrtrytryjtryjtryj|&|rtyjrtyjrtyjtyrj|&|tyjtrjytyjtryj|&|', 'false', ''),
(612, '19', '19', 'yesno', 'false', 'yesno', '', 'false', ''),
(613, '19', '20', '4325465768', 'false', 'single', 'regregregw|&|egerwgerwgg|&|', 'false', ''),
(614, '19', '21', 'mult', 'false', 'multi', 'regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|', 'true', ''),
(615, '19', '22', '34tetrgtm5', 'true', 'single', 'regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|', 'false', ''),
(616, '19', '23', '', 'false', 'multi', 'regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|regregregw|&|egerwgerwgg|&|', 'true', ''),
(617, '19', '24', '431tr424424', 'true', 'qa', '', 'false', '');

-- --------------------------------------------------------

--
-- 資料表結構 `respond`
--

CREATE TABLE `respond` (
  `id` int(11) NOT NULL,
  `questionid` text NOT NULL,
  `questionorder` text NOT NULL,
  `respond` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `respond`
--

INSERT INTO `respond` (`id`, `questionid`, `questionorder`, `respond`) VALUES
(1, '17', '1', ''),
(2, '17', '2', ''),
(3, '17', '3', ''),
(4, '17', '4', ''),
(5, '17', '5', ''),
(6, '17', '6', ''),
(7, '17', '7', ''),
(8, '17', '8', ''),
(9, '17', '1', ''),
(10, '17', '2', ''),
(11, '17', '3', ''),
(12, '17', '4', ''),
(13, '17', '5', ''),
(14, '17', '6', ''),
(15, '17', '7', ''),
(16, '17', '8', ''),
(17, '17', '1', ''),
(18, '17', '2', ''),
(19, '17', '3', ''),
(20, '17', '4', ''),
(21, '17', '5', ''),
(22, '17', '6', ''),
(23, '17', '7', ''),
(24, '17', '8', ''),
(25, '17', '1', ''),
(26, '17', '2', ''),
(27, '17', '3', ''),
(28, '17', '4', ''),
(29, '17', '5', ''),
(30, '17', '6', ''),
(31, '17', '7', ''),
(32, '17', '8', ''),
(33, '17', '1', ''),
(34, '17', '2', ''),
(35, '17', '3', ''),
(36, '17', '4', ''),
(37, '17', '5', ''),
(38, '17', '6', ''),
(39, '17', '7', ''),
(40, '17', '8', ''),
(41, '17', '1', ''),
(42, '17', '2', ''),
(43, '17', '3', ''),
(44, '17', '4', ''),
(45, '17', '5', ''),
(46, '17', '6', ''),
(47, '17', '7', ''),
(48, '17', '8', ''),
(49, '1', '1', ''),
(50, '1', '2', ''),
(51, '1', '3', ''),
(52, '1', '4', ''),
(53, '1', '5', ''),
(54, '1', '6', ''),
(55, '1', '7', ''),
(56, '1', '8', '');

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
(1, 'admin', '1234', '', ''),
(2, 'user', '1234', '', '');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `questioncode`
--
ALTER TABLE `questioncode`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `questionlog`
--
ALTER TABLE `questionlog`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `respond`
--
ALTER TABLE `respond`
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
-- 使用資料表自動遞增(AUTO_INCREMENT) `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `questioncode`
--
ALTER TABLE `questioncode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `questionlog`
--
ALTER TABLE `questionlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=618;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `respond`
--
ALTER TABLE `respond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
