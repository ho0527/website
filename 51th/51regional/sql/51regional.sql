-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-05-16 15:40:42
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
(66, 'admin', '填寫問卷', '2023-05-12 19:43:01', 'qid=17'),
(67, 'admin', '編輯問卷', '2023-05-12 21:46:38', 'qid=19'),
(68, 'admin', '編輯問卷', '2023-05-12 21:54:45', 'qid=19'),
(69, 'admin', '複製問卷(all)', '2023-05-12 21:56:55', 'qid=19'),
(70, 'admin', '刪除問卷', '2023-05-12 21:56:59', 'qid=23'),
(71, 'admin', '編輯問卷', '2023-05-12 21:57:02', 'qid=19'),
(72, 'admin', '登出系統', '2023-05-12 23:27:50', ''),
(73, 'admin', '登入系統', '2023-05-13 17:30:41', ''),
(74, 'admin', '編輯問卷', '2023-05-13 17:31:24', 'qid=19'),
(75, 'admin', '儲存問卷成功', '2023-05-13 20:48:39', 'qid=19'),
(76, 'admin', '儲存問卷成功', '2023-05-13 20:50:57', 'qid=19'),
(77, 'admin', '儲存問卷成功', '2023-05-13 20:51:29', 'qid=19'),
(78, 'admin', '編輯問卷', '2023-05-13 20:57:35', 'qid=19'),
(79, 'admin', '新增問卷', '2023-05-13 20:58:42', 'qid='),
(80, 'admin', '刪除問卷', '2023-05-13 20:58:49', 'qid=1'),
(81, 'admin', '新增問卷', '2023-05-13 20:59:50', 'qid='),
(82, 'admin', '編輯問卷', '2023-05-13 21:01:22', 'qid=1'),
(83, 'admin', '編輯問卷', '2023-05-13 21:02:00', 'qid=1'),
(84, 'admin', '編輯問卷', '2023-05-13 21:02:16', 'qid=1'),
(85, 'admin', '儲存問卷成功', '2023-05-13 22:18:15', 'qid=Array'),
(86, 'admin', '儲存問卷成功', '2023-05-13 22:23:52', 'qid=1'),
(87, 'admin', '儲存問卷成功', '2023-05-14 11:26:23', 'qid=1'),
(88, 'admin', '編輯問卷', '2023-05-14 11:27:17', 'qid=1'),
(89, 'admin', '儲存問卷成功', '2023-05-14 11:35:33', 'qid=1'),
(90, 'admin', '儲存問卷成功', '2023-05-14 11:35:47', 'qid=1'),
(91, 'admin', '儲存問卷成功', '2023-05-14 11:37:25', 'qid=1'),
(92, 'admin', '儲存問卷成功', '2023-05-14 11:40:59', 'qid=1'),
(93, 'admin', '儲存問卷成功', '2023-05-14 11:41:08', 'qid=1'),
(94, 'admin', '儲存問卷成功', '2023-05-14 11:41:32', 'qid=1'),
(95, 'admin', '儲存問卷成功', '2023-05-14 11:41:38', 'qid=1'),
(96, 'admin', '儲存問卷成功', '2023-05-14 11:41:54', 'qid=1'),
(97, 'admin', '儲存問卷成功', '2023-05-14 11:42:04', 'qid=1'),
(98, 'admin', '儲存問卷成功', '2023-05-14 11:42:36', 'qid=1'),
(99, 'admin', '儲存問卷成功', '2023-05-14 11:42:44', 'qid=1'),
(100, 'admin', '儲存問卷成功', '2023-05-14 11:45:45', 'qid=1'),
(101, 'admin', '儲存問卷成功', '2023-05-14 12:39:19', 'qid='),
(102, 'admin', '儲存問卷成功', '2023-05-14 12:40:27', 'qid=1'),
(103, 'admin', '儲存問卷成功', '2023-05-14 12:41:37', 'qid=1'),
(104, 'admin', '儲存問卷成功', '2023-05-14 12:41:47', 'qid=1'),
(105, 'admin', '儲存問卷成功', '2023-05-14 12:42:40', 'qid=1'),
(106, 'admin', '儲存問卷成功', '2023-05-14 12:43:45', 'qid=1'),
(107, 'admin', '編輯問卷', '2023-05-14 12:45:23', 'qid=1'),
(108, 'admin', '儲存問卷成功', '2023-05-14 12:45:27', 'qid=1'),
(109, 'admin', '儲存問卷成功', '2023-05-14 12:47:04', 'qid=1'),
(110, 'admin', '儲存問卷成功', '2023-05-14 12:47:21', 'qid=1'),
(111, 'admin', '填寫問卷', '2023-05-14 12:52:46', 'qid=1'),
(112, 'admin', '複製問卷(question)', '2023-05-14 12:55:27', 'qid=1'),
(113, 'admin', '編輯問卷', '2023-05-14 12:57:05', 'qid=1'),
(114, 'admin', '編輯問卷', '2023-05-14 13:01:03', 'qid=2'),
(115, 'admin', '儲存問卷成功', '2023-05-14 13:04:52', 'qid=2'),
(116, 'admin', '複製問卷(all)', '2023-05-14 13:05:59', 'qid=1'),
(117, 'admin', '編輯問卷', '2023-05-14 13:06:02', 'qid=3'),
(118, 'admin', '編輯問卷', '2023-05-14 13:06:10', 'qid=2'),
(119, 'admin', '儲存問卷成功', '2023-05-14 13:08:40', 'qid=2'),
(120, 'admin', '儲存問卷成功', '2023-05-14 13:09:26', 'qid=2'),
(121, 'admin', '鎖定問卷', '2023-05-14 13:17:17', 'qid=1'),
(122, 'admin', '解鎖問卷', '2023-05-14 13:17:20', 'qid=1'),
(123, 'admin', '鎖定問卷', '2023-05-14 13:17:20', 'qid=1'),
(124, 'admin', '解鎖問卷', '2023-05-14 13:17:20', 'qid=1'),
(125, 'admin', '鎖定問卷', '2023-05-14 13:17:20', 'qid=1'),
(126, 'admin', '解鎖問卷', '2023-05-14 13:17:20', 'qid=1'),
(127, 'admin', '鎖定問卷', '2023-05-14 13:17:21', 'qid=1'),
(128, 'admin', '鎖定問卷', '2023-05-14 13:17:22', 'qid=2'),
(129, 'admin', '解鎖問卷', '2023-05-14 13:17:22', 'qid=1'),
(130, 'admin', '填寫問卷', '2023-05-14 13:17:57', 'qid=1'),
(131, 'admin', '填寫問卷', '2023-05-14 13:26:48', 'qid=1'),
(132, 'admin', '填寫問卷', '2023-05-14 13:27:49', 'qid=1'),
(133, 'admin', '填寫問卷', '2023-05-14 13:27:56', 'qid=2'),
(134, 'admin', '編輯問卷', '2023-05-14 15:14:46', 'qid=1'),
(135, 'admin', '儲存問卷成功', '2023-05-14 15:15:51', 'qid=1'),
(136, 'admin', '儲存問卷成功', '2023-05-14 15:16:09', 'qid=1'),
(137, 'admin', '儲存問卷成功', '2023-05-14 15:30:43', 'qid=1'),
(138, 'admin', '填寫問卷', '2023-05-14 16:28:26', 'qid=3'),
(139, 'admin', '填寫問卷', '2023-05-14 16:37:17', 'qid=3'),
(140, 'admin', '編輯問卷', '2023-05-14 16:37:38', 'qid=1'),
(141, 'admin', '編輯問卷', '2023-05-14 16:37:45', 'qid=3'),
(142, 'admin', '儲存問卷成功', '2023-05-14 16:37:50', 'qid=3'),
(143, 'admin', '複製問卷(question)', '2023-05-14 16:38:15', 'qid=3'),
(144, 'admin', '刪除問卷', '2023-05-14 16:38:23', 'qid=4'),
(145, 'admin', '填寫問卷', '2023-05-14 16:39:10', 'qid=3'),
(146, 'admin', '填寫問卷', '2023-05-14 16:39:49', ''),
(147, 'admin', '編輯問卷', '2023-05-14 16:39:59', 'qid=3'),
(148, 'admin', '填寫問卷', '2023-05-14 16:40:33', ''),
(149, 'admin', '填寫問卷', '2023-05-14 16:40:47', ''),
(150, 'admin', '編輯問卷', '2023-05-14 17:04:58', 'qid=1'),
(151, 'admin', '編輯問卷', '2023-05-14 19:26:29', 'qid=1'),
(152, 'admin', '儲存問卷成功', '2023-05-14 19:53:12', 'qid=1'),
(153, 'admin', '儲存問卷成功', '2023-05-14 19:53:48', 'qid=1'),
(154, 'admin', '儲存問卷成功', '2023-05-14 19:59:35', 'qid=1'),
(155, 'admin', '儲存問卷成功', '2023-05-14 19:59:47', 'qid=1'),
(156, 'admin', '儲存問卷成功', '2023-05-14 20:13:34', 'qid=1'),
(157, 'admin', '儲存問卷成功', '2023-05-14 20:13:47', 'qid=1'),
(158, 'admin', '儲存問卷成功', '2023-05-14 20:17:56', 'qid=1'),
(159, 'admin', '儲存問卷成功', '2023-05-14 20:18:09', 'qid=1'),
(160, 'admin', '儲存問卷成功', '2023-05-14 21:28:36', 'qid=1'),
(161, 'admin', '編輯問卷', '2023-05-14 22:05:15', 'qid=1'),
(162, 'admin', '登入系統', '2023-05-15 20:00:26', ''),
(163, 'admin', '編輯問卷', '2023-05-15 20:00:46', 'qid=3'),
(164, 'admin', '編輯問卷', '2023-05-15 20:00:56', 'qid=1'),
(165, 'admin', '編輯問卷', '2023-05-15 20:00:59', 'qid=3'),
(166, 'admin', '填寫問卷', '2023-05-15 20:01:05', 'qid=3'),
(167, 'admin', '編輯問卷', '2023-05-15 20:06:50', 'qid=1'),
(168, 'admin', '填寫問卷', '2023-05-15 20:06:55', 'qid=1'),
(169, 'admin', '填寫問卷', '2023-05-15 20:07:12', 'qid=3'),
(170, 'admin', '填寫問卷', '2023-05-15 20:20:33', 'qid=3'),
(171, 'admin', '編輯問卷', '2023-05-15 20:20:40', 'qid=3'),
(172, 'admin', '填寫問卷', '2023-05-15 20:20:43', 'qid=3'),
(173, 'admin', '填寫問卷', '2023-05-15 20:20:51', 'qid=3'),
(174, 'admin', '填寫問卷', '2023-05-15 20:21:01', 'qid=3'),
(175, 'admin', '填寫問卷', '2023-05-15 20:21:05', 'qid=3'),
(176, 'admin', '填寫問卷', '2023-05-15 20:21:10', 'qid=3'),
(177, 'admin', '填寫問卷', '2023-05-15 20:21:23', 'qid=2'),
(178, 'admin', '填寫問卷', '2023-05-15 20:21:31', 'qid=3'),
(179, 'admin', '編輯問卷', '2023-05-15 20:26:09', 'qid=3'),
(180, 'admin', '儲存問卷成功', '2023-05-15 20:26:20', 'qid=3'),
(181, 'admin', '填寫問卷', '2023-05-15 20:26:27', 'qid=3');

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
  `log` text NOT NULL,
  `updatetime` text NOT NULL,
  `ps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `question`
--

INSERT INTO `question` (`id`, `title`, `questioncount`, `pagelen`, `responcount`, `lock`, `maxlen`, `log`, `updatetime`, `ps`) VALUES
(1, 'test1', '38', '1', '0', 'false', '', '[[\"1\",\"whwtretewh\",false,\"single\",\"rfdfdsfhdfhdf|&|\",false,\"\"],[\"2\",\"yesno\",false,\"yesno\",\"\",false,\"\"],[\"3\",\"single\",false,\"single\",\"sdfhdsfhsdhfg|&|dsgdgsd|&|\",false,\"\"],[\"4\",\"multi\",false,\"multi\",\"dgsdgssdd|&|dsdgsdgsd|&|gdgdgd|&|\",true,\"\"],[\"5\",\"wrgrwq\",false,\"multi\",\"\",false,\"\"],[\"6\",\"\",false,\"single\",\"\",false,\"\"],[\"7\",\"\",false,\"multi\",\"sgsgafsf|&|\",false,\"\"],[\"8\",\"\",false,\"single\",\"sasgfsfa|&|ffsaggfsafgs|&|\",false,\"\"],[\"9\",\"\",false,\"multi\",\"\",true,\"\"],[\"10\",\"\",false,\"single\",\"rqwrgwrq|&|rrqwgrwgqwr|&|\",false,\"\"],[\"11\",\"wrwgqrwgqrwgq\",false,\"single\",\"wqrwrqgrwgq|&|\",false,\"\"],[\"12\",\"rqgwrqwegrg\",false,\"single\",\"qrgrqwewqrgwrq|&|wqrwqrgw|&|\",false,\"\"],[\"13\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"14\",\"\",false,\"yesno\",\"\",false,\"\"],[\"15\",\"gqrrqrgqw\",false,\"yesno\",\"\",false,\"\"],[\"16\",\"qrqegrgq\",false,\"yesno\",\"\",false,\"\"],[\"17\",\"\",false,\"yesno\",\"\",false,\"\"],[\"18\",\"qrgqgrqrwqr\",true,\"single\",\"\",false,\"\"],[\"19\",\"\",false,\"single\",\"rgqrgrwq|&|\",false,\"\"],[\"20\",\"\",false,\"qa\",\"\",false,\"\"],[\"21\",\"\",false,\"qa\",\"\",false,\"\"],[\"22\",\"\",false,\"qa\",\"\",false,\"\"],[\"23\",\"rgeqqgwrgrwgwr\",true,\"qa\",\"\",false,\"\"],[\"24\",\"\",false,\"single\",\"\",false,\"\"],[\"25\",\"brgewretgwtewb\",false,\"multi\",\"eweebwtetwbbetwrb|&|\",true,\"\"],[\"26\",\"ebbewtrbtweetb\",false,\"single\",\"ewtebwttee|&|ebetetbeb|&|bretgbeebrt|&|\",false,\"\"],[\"27\",\"\",false,\"yesno\",\"\",false,\"\"],[\"28\",\"\",false,\"multi\",\"\",true,\"\"],[\"29\",\"\",false,\"single\",\"grrewgrgwe|&|rgwqwrgqwrg|&|\",false,\"\"],[\"30\",\"rgererge\",false,\"yesno\",\"\",false,\"\"],[\"31\",\"yrernretyrty\",false,\"single\",\"\",false,\"\"],[\"32\",\"ttyrettyenyetnrytt\",false,\"multi\",\"tytyrrebtenhytyty|&|\",true,\"\"],[\"33\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"34\",\"\",false,\"multi\",\"\",true,\"\"],[\"35\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"36\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"37\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"38\",\"\",\"false\",\"none\",\"\",false,\"\"]]', '2023-05-14 21:28:36', ''),
(2, 'copy test1', '42', '1', '0', 'true', '', '[[\"1\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"2\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"3\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"4\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"5\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"6\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"7\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"8\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"9\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"10\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"11\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"12\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"13\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"14\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"15\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"16\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"17\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"18\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"19\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"20\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"21\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"22\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"23\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"24\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"25\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"26\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"27\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"28\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"29\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"30\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"31\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"32\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"33\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"34\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"35\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"36\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"37\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"38\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"39\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"40\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"41\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"42\",\"\",\"false\",\"none\",\"\",false,\"\"]]', '2023-05-14 13:09:26', ''),
(3, 'test1 copy', '34', '1', '0', 'false', '100', '[[\"1\",\"whwtretewh\",false,\"multi\",\"rjthtrgrtgntrgh|&|\",true,\"\"],[\"2\",\"yesno\",false,\"yesno\",\"\",false,\"\"],[\"3\",\"single\",false,\"single\",\"sdfhdsfhsdhfg|&|dsgdgsd|&|\",false,\"\"],[\"4\",\"multi\",false,\"multi\",\"dgsdgssdd|&|dsdgsdgsd|&|gdgdgd|&|\",false,\"\"],[\"5\",\"wrgrwq\",false,\"multi\",\"\",false,\"\"],[\"6\",\"\",false,\"single\",\"\",false,\"\"],[\"7\",\"\",false,\"multi\",\"sgsgafsf|&|\",false,\"\"],[\"8\",\"\",false,\"single\",\"sasgfsfa|&|ffsaggfsafgs|&|\",false,\"\"],[\"9\",\"\",false,\"multi\",\"\",true,\"\"],[\"10\",\"\",false,\"single\",\"rqwrgwrq|&|rrqwgrwgqwr|&|\",false,\"\"],[\"11\",\"wrwgqrwgqrwgq\",false,\"single\",\"wqrwrqgrwgq|&|\",false,\"\"],[\"12\",\"rqgwrqwegrg\",false,\"single\",\"qrgrqwewqrgwrq|&|wqrwqrgw|&|\",false,\"\"],[\"13\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"14\",\"\",false,\"yesno\",\"\",false,\"\"],[\"15\",\"gqrrqrgqw\",false,\"yesno\",\"\",false,\"\"],[\"16\",\"qrqegrgq\",false,\"yesno\",\"\",false,\"\"],[\"17\",\"\",false,\"yesno\",\"\",false,\"\"],[\"18\",\"qrgqgrqrwqr\",true,\"single\",\"iojejiuewhuiewuijbh|&|hgrrfiuyiwuiui|&|uhifdvuhidfuhisdvfuhi|&|\",false,\"\"],[\"19\",\"\",false,\"single\",\"rgqrgrwq|&|\",false,\"\"],[\"20\",\"\",false,\"qa\",\"\",false,\"\"],[\"21\",\"\",false,\"qa\",\"\",false,\"\"],[\"22\",\"\",false,\"qa\",\"\",false,\"\"],[\"23\",\"rgeqqgwrgrwgwr\",true,\"qa\",\"\",false,\"\"],[\"24\",\"\",false,\"single\",\"\",false,\"\"],[\"25\",\"\",false,\"multi\",\"\",true,\"\"],[\"26\",\"\",false,\"single\",\"\",false,\"\"],[\"27\",\"\",false,\"yesno\",\"\",false,\"\"],[\"28\",\"\",false,\"multi\",\"\",true,\"\"],[\"29\",\"\",false,\"single\",\"grrewgrgwe|&|rgwqwrgqwrg|&|\",false,\"\"],[\"30\",\"rgererge\",false,\"yesno\",\"\",false,\"\"],[\"31\",\"\",false,\"single\",\"\",false,\"\"],[\"32\",\"\",false,\"multi\",\"\",true,\"\"],[\"33\",\"\",\"false\",\"none\",\"\",false,\"\"],[\"34\",\"\",\"false\",\"none\",\"\",false,\"\"]]', '2023-05-15 20:26:20', ''),
(4, 'copy test1 copy', '34', '1', '0', 'false', '100', '', '2023-05-14 16:38:15', 'del');

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
(1, '1', '', 'christest1'),
(2, '3', 'admin', 'chrisis'),
(3, '3', 'user', 'goodgood');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `questioncode`
--
ALTER TABLE `questioncode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `respond`
--
ALTER TABLE `respond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
