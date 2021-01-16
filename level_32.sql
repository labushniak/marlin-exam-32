-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 16 2021 г., 16:38
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `level_32`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `verified` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `resettable` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `roles_mask` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `registered` int(10) UNSIGNED NOT NULL,
  `last_login` int(10) UNSIGNED DEFAULT NULL,
  `force_logout` mediumint(7) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`) VALUES
(1, 'test@mail.ru', '$2y$10$pAG3O2I8hC3Q7EkuJwOnweHv9Weu3c9qsEsD0zvIUtsZmKtwbA.Ca', NULL, 0, 1, 1, 1, 1609535376, 1610803206, 16),
(2, 'test2@mail.ru', '$2y$10$VXKUDFlnDnh45cuO0tGz3.Gs9ZWiTrxnaz1q4XmlWxqjqtSUTXWDi', NULL, 0, 1, 1, 0, 1609537456, 1610803993, 3),
(3, 'test3@mail.ru', '$2y$10$ZA4gyTYbtE95BVfds0Qcn.Rlx/rMl906.Wkd8Egw0g1RfY92B.jV.', NULL, 0, 1, 1, 0, 1609538924, 1610802218, 8),
(4, 'test4@mail.ru', '$2y$10$cQZVHyhHT58pcJi28hjk2eImR6xfS50.LTyxOAVWgrY6gAMP/BxrO', NULL, 0, 1, 1, 0, 1609539583, 1610705252, 2),
(5, 'test5@mail.ru', '$2y$10$oBeCOA8N6OiHJR21estcLOZNqJJW.tJDMoAX2TPzw7XnKAlmJdTOS', NULL, 0, 1, 1, 0, 1609539626, NULL, 0),
(6, 'test7@mail.ru', '$2y$10$hWadwJDIvWKfPHj0lUoWGeEiXXGtXjWzs9IFg98HWReexLwyn73Iy', NULL, 0, 1, 1, 0, 1610712821, NULL, 0),
(17, 'test20@mail.ru', '$2y$10$ln9dgU0eRYK7rr3jsMLQh.WrQJ5rKtAUsGaszZrav9PVNNjzqlRvi', NULL, 0, 1, 1, 0, 1610803347, NULL, 0),
(12, 'test13@mail.ru', '$2y$10$qDG3jU2978rfxki.gxcMP.7xGAsMBav/uv.i5MiV5PeoqmaHcfNm.', NULL, 0, 1, 1, 0, 1610716156, NULL, 0),
(11, 'test12@mail.ru', '$2y$10$B5teGv8.m5lzaaAf0PAX/.H9NQXHIqQG86He9lGdgwoOtdbHmiU7y', NULL, 0, 1, 1, 0, 1610715915, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users_confirmations`
--

CREATE TABLE `users_confirmations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users_info`
--

CREATE TABLE `users_info` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users_info`
--

INSERT INTO `users_info` (`id`, `user_id`, `name`, `job_title`, `phone`, `address`, `status`, `avatar`) VALUES
(1, 2, 'Oliver Kopyov', 'IT Manager, Gotbootstrap Inc.', '+13174562565', '15 Charist St, Detroit, MI, 48212, USA', 'dont_disturb', 'avatar_2.png'),
(2, 3, 'Alita Gray', 'Project Manager, Gotbootstrap Inc.', '+13134611347', '134 Hamtrammac, Detroit, MI, 48314, USA', 'online', 'avatar_3.png'),
(3, 4, 'Jim Ketty', 'Staff Orgnizer, Gotbootstrap Inc.', '+13137793314', '134 Tasy Rd, Detroit, MI, 48212, USA', 'online', 'avatar_45.png'),
(4, 5, 'Sarah McBrook', 'Xray Division, Gotbootstrap Inc.', '+13137797613', '13 Jamie Rd, Detroit, MI, 48313, USA', 'dont_disturb', 'avatar_46.png'),
(5, 6, 'Jimmy Fellan', 'Accounting, Gotbootstrap Inc.', '+13137794314', '55 Smyth Rd, Detroit, MI, 48341, USA', 'online', 'avatar_47.png'),
(6, 7, 'Dr. John Oliver', 'Oncologist, Gotbootstrap Inc.', '+13137794314', '134 Gallery St, Detroit, MI, 46214, USA', 'online', 'avatar_48.png'),
(9, 11, 'testtest', 'testtest', '7911123456', 'testtest', 'online', 'avatar_11.png'),
(10, 12, 'testtest13', 'testtest13', '7911123456', 'testtest13', 'out', 'avatar_12.png'),
(15, 17, 'Тест20', 'Тест20', 'Тест20', 'Тест20', 'out', 'avatar_17.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users_links`
--

CREATE TABLE `users_links` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `vk` varchar(255) NOT NULL,
  `telegram` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users_links`
--

INSERT INTO `users_links` (`id`, `user_id`, `vk`, `telegram`, `instagram`) VALUES
(1, 2, 'oliver.kopyov', 'oliverkopyov', 'oliverkopyov'),
(2, 3, 'Alita', 'Alita', 'Alita'),
(3, 4, 'jim.ketty', 'jimketty', 'jimketty'),
(4, 5, 'sarah.mcbrook', 'sarah.mcbrook', 'sarah.mcbrook'),
(5, 6, 'jimmy.fallan', 'jimmy.fallan', 'jimmy.fallan'),
(6, 7, 'john.oliver', 'john.oliver', 'john.oliver'),
(8, 11, 'testtest', 'testtest', 'testtest'),
(9, 12, 'testtest13', 'testtest13', 'testtest13'),
(14, 17, 'test20', 'test20', 'test20');

-- --------------------------------------------------------

--
-- Структура таблицы `users_remembered`
--

CREATE TABLE `users_remembered` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users_resets`
--

CREATE TABLE `users_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users_throttling`
--

CREATE TABLE `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float UNSIGNED NOT NULL,
  `replenished_at` int(10) UNSIGNED NOT NULL,
  `expires_at` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_throttling`
--

INSERT INTO `users_throttling` (`bucket`, `tokens`, `replenished_at`, `expires_at`) VALUES
('PZ3qJtO_NLbJfRIP-8b4ME4WA3xxc6n9nbCORSffyQ0', 4, 1610803347, 1611235347),
('QduM75nGblH2CDKFyk0QeukPOwuEVDAUFE54ITnHM38', 70.2186, 1610803993, 1611343993);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `users_confirmations`
--
ALTER TABLE `users_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `email_expires` (`email`,`expires`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_links`
--
ALTER TABLE `users_links`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_remembered`
--
ALTER TABLE `users_remembered`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user` (`user`);

--
-- Индексы таблицы `users_resets`
--
ALTER TABLE `users_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user_expires` (`user`,`expires`);

--
-- Индексы таблицы `users_throttling`
--
ALTER TABLE `users_throttling`
  ADD PRIMARY KEY (`bucket`),
  ADD KEY `expires_at` (`expires_at`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `users_confirmations`
--
ALTER TABLE `users_confirmations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users_links`
--
ALTER TABLE `users_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `users_remembered`
--
ALTER TABLE `users_remembered`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users_resets`
--
ALTER TABLE `users_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
