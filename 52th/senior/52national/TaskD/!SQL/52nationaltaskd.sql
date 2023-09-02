-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-09-02 05:02:20
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `52nationaltaskd`
--

-- --------------------------------------------------------

--
-- 資料表結構 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '留言的使用者',
  `post_id` int(11) NOT NULL COMMENT '所屬貼文',
  `content` varchar(300) NOT NULL COMMENT '內容',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `created_at`) VALUES
(1, 1, 7, 'comment content text', '2023-09-02 01:45:50'),
(3, 2, 7, 'comment content text', '2023-09-02 01:50:06');

-- --------------------------------------------------------

--
-- 資料表結構 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL COMMENT '發布者',
  `content` varchar(300) NOT NULL COMMENT '內文',
  `type` enum('public','only_follow','only_self') NOT NULL COMMENT '貼文的類型',
  `tag` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `place_lat` decimal(10,5) DEFAULT NULL COMMENT '地點的經度',
  `place_lng` decimal(10,5) DEFAULT NULL COMMENT '地點的緯度',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `content`, `type`, `tag`, `location`, `place_lat`, `place_lng`, `created_at`, `updated_at`) VALUES
(2, 1, 'post conent2', 'only_self', 'tag1 tag6', '', NULL, NULL, '2023-09-02 01:26:30', '2023-09-02 01:57:08'),
(3, 1, 'post conent', 'public', 'tag1 tag2', '', NULL, NULL, '2023-09-02 01:27:22', NULL),
(4, 1, 'post conent', 'public', 'teg123456 teg 456789', '', NULL, NULL, '2023-09-02 01:27:53', NULL),
(5, 1, 'post conent', 'public', 'teg123456 teg 456789', '', NULL, NULL, '2023-09-02 01:28:26', NULL),
(7, 1, 'post conent', 'public', 'teg123456 teg 456789', '', NULL, NULL, '2023-09-02 01:32:10', NULL),
(8, 1, 'this is an context', 'only_follow', 'greate hillow', 'there', NULL, NULL, '2023-09-02 01:34:28', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `post_images`
--

CREATE TABLE `post_images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL COMMENT '所屬貼文',
  `width` int(11) NOT NULL COMMENT '圖片寬度',
  `height` int(11) NOT NULL COMMENT '圖片高度',
  `filename` varchar(1024) NOT NULL COMMENT '檔案名稱',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `post_images`
--

INSERT INTO `post_images` (`id`, `post_id`, `width`, `height`, `filename`, `created_at`) VALUES
(1, 2, 640, 360, 'image/EGrlwnap8nmldsRWb4f8dATjFkuLDCNV2qeXbhJO.jpg', '2023-09-02 01:26:30'),
(2, 3, 640, 360, 'image/4TOmCkcmQDo1coMo361ngt7qNwZMpJpHLfa7s9y4.jpg', '2023-09-02 01:27:22'),
(3, 4, 640, 507, 'image/tnxJLhkmpVcYuIduhCUv7Cx2rv8q5OQ6sydClCYD.jpg', '2023-09-02 01:27:53'),
(4, 5, 640, 507, 'image/5UrAPE0V81HijaWsbmlJMgQ0jdzGQKud9BQ5wLoa.jpg', '2023-09-02 01:28:26'),
(5, 7, 640, 427, 'image/AUy41PG1RUuVttVVu5vZ0A0EpxQ9PxokYviuU9dQ.jpg', '2023-09-02 01:32:10'),
(6, 7, 640, 427, 'image/yrxI0SF4Mx2MXyyYaMundzsqq0wRypehMLqLQBHB.jpg', '2023-09-02 01:32:10'),
(7, 7, 640, 427, 'image/JAZ0CfhZOfSB72WiT66dz5lW63mU9vNmKRhQz9c2.jpg', '2023-09-02 01:32:10'),
(8, 7, 640, 427, 'image/EzvAoq0831SJtpAW9zhkIpY169KMYKcttPg28H7E.jpg', '2023-09-02 01:32:10'),
(9, 7, 640, 427, 'image/fapSZpPe7x5hErBEgX6d9Ar0EuQARp6EcExROFHB.jpg', '2023-09-02 01:32:10'),
(10, 7, 640, 427, 'image/5xsDFtdEeTolWZh7tQmjdLY22Xgw02TnlbUheE8P.jpg', '2023-09-02 01:32:10'),
(11, 7, 640, 956, 'image/3EsE38aiAK3FXlM1GXpOVWx81LxWZ5kAimN4sQBQ.jpg', '2023-09-02 01:32:10'),
(12, 8, 640, 360, 'image/4iPusI1bz43whWbZfuexZ5cJvc6WHXVa3F0zJ86t.jpg', '2023-09-02 01:34:28');

-- --------------------------------------------------------

--
-- 資料表結構 `post_tags`
--

CREATE TABLE `post_tags` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '標籤名稱',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'Email',
  `password` varchar(255) DEFAULT NULL COMMENT '密碼',
  `nickname` varchar(255) NOT NULL COMMENT '暱稱',
  `profile_image` varchar(1024) NOT NULL,
  `access_token` char(64) DEFAULT NULL COMMENT 'Login Token',
  `type` enum('USER','ADMIN') NOT NULL DEFAULT 'USER' COMMENT '身分',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='使用者';

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nickname`, `profile_image`, `access_token`, `type`, `created_at`, `updated_at`) VALUES
(1, 'admin@web.tw', '$2y$10$TNYNFBpg4eBxMsg1tm4mK.ZPX.Fr74T2QCgvd57ZEk1EPJhOR/cM2', 'new_nickname', 'image/0twYvnANDim9FFljpz0aLLVNnayu0USiTp56wtfH.jpg', NULL, 'ADMIN', '2023-09-02 01:14:47', '2023-09-02 02:32:35'),
(2, 'user@web.tw', '$2y$10$.KdrRHWNZCwxHImB0Vcy2un0Q5KzhP/ZktJCOVn3f8pZdBcRYwEae', 'user', 'image/rItbyBk70eJxZOGNYhmlck2c5I1PyQbpBvGPH8hI.jpg', NULL, 'USER', '2023-09-02 01:15:48', NULL),
(3, 'test@web.tw', '$2y$10$4CbgzfJB1QqSih5E01GmwuoMFrX6uijV2AFLFB2FLNckyComAoWUi', 'test', 'image/A9zlmL39EFBJDSZ370Glen3hB8QaOKvEFQFvSGg8.jpg', NULL, 'USER', '2023-09-02 02:43:28', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `user_follows`
--

CREATE TABLE `user_follows` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follow_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `user_follows`
--

INSERT INTO `user_follows` (`id`, `user_id`, `follow_user_id`, `created_at`) VALUES
(2, 2, 1, '2023-09-02 02:36:01'),
(3, 3, 1, '2023-09-02 02:43:39');

-- --------------------------------------------------------

--
-- 資料表結構 `user_likes`
--

CREATE TABLE `user_likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `user_likes`
--

INSERT INTO `user_likes` (`id`, `user_id`, `post_id`, `created_at`) VALUES
(2, 1, 7, '2023-09-02 02:03:22'),
(3, 1, 8, '2023-09-02 02:09:01');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 資料表索引 `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- 資料表索引 `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- 資料表索引 `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- 資料表索引 `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `token` (`access_token`);

--
-- 資料表索引 `user_follows`
--
ALTER TABLE `user_follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follow_user_id` (`follow_user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 資料表索引 `user_likes`
--
ALTER TABLE `user_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_follows`
--
ALTER TABLE `user_follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_likes`
--
ALTER TABLE `user_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 資料表的限制式 `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- 資料表的限制式 `post_images`
--
ALTER TABLE `post_images`
  ADD CONSTRAINT `post_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- 資料表的限制式 `post_tags`
--
ALTER TABLE `post_tags`
  ADD CONSTRAINT `post_tags_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- 資料表的限制式 `user_follows`
--
ALTER TABLE `user_follows`
  ADD CONSTRAINT `user_follows_ibfk_1` FOREIGN KEY (`follow_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_follows_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- 資料表的限制式 `user_likes`
--
ALTER TABLE `user_likes`
  ADD CONSTRAINT `user_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `user_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
