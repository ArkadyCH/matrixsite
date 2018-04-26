-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 26 2018 г., 12:20
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `matrix`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dialog`
--

CREATE TABLE `dialog` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `send` int(11) NOT NULL,
  `recive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dialog`
--

INSERT INTO `dialog` (`id`, `status`, `send`, `recive`) VALUES
(1, 0, 1, 4),
(2, 1, 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'current'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `filename`, `status`) VALUES
(1, 'arhive.rar', 'current');

-- --------------------------------------------------------

--
-- Структура таблицы `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `title_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `lvl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forum`
--

INSERT INTO `forum` (`id`, `title_name`, `description`, `data`, `user_id`, `parent_id`, `type_id`, `lvl`) VALUES
(2, 'Основное', '', '2018-04-22 14:13:11', 1, 0, 1, 0),
(3, 'Тестовая категория', '', '2018-04-22 14:13:23', 1, 0, 1, 0),
(5, 'Категория 1', 'Тестовая категория для проверки #1', '2018-04-22 14:23:24', 1, 2, 2, 1),
(11, 'Тестовая тема', '<p align=\"center\">dwadaw123</p>', '2018-04-22 14:40:20', 1, 5, 3, 2),
(14, 'dwadwa', '<p align=\"center\">dawdwadawd</p><h1 align=\"center\">dwadwadwadwadaw1<br></h1>', '2018-04-22 15:46:05', 1, 5, 3, 2),
(15, 'моя тема тут тоже будет', '<p>Что я тоже хочу свою тему!!!!</p>', '2018-04-24 12:15:57', 5, 5, 3, 2),
(22, 'one more', '<p>1111<br></p>', '2018-04-24 18:17:39', 1, 5, 3, 2),
(34, 'Категория 2', 'вцфвцфв', '2018-04-24 19:38:58', 1, 3, 2, 1),
(35, 'фвфцвфц', '<p>вфцвцфв<br></p>', '2018-04-24 19:39:03', 1, 34, 3, 2),
(39, 'Второй раздел', '', '2018-04-25 17:24:21', 1, 0, 1, 0),
(40, 'test 1', 'dwadwad', '2018-04-25 17:38:47', 1, 39, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `dialog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `text`, `date`, `dialog_id`) VALUES
(1, 1, 'Привет Андрей', '2018-04-23 22:18:14', 1),
(2, 4, 'И вам здрасте', '2018-04-23 22:19:03', 1),
(3, 5, 'ahahah', '2018-04-23 22:38:25', 2),
(8, 1, '1', '2018-04-23 23:27:28', 1),
(9, 4, 'что  1 ?', '2018-04-23 23:29:26', 1),
(10, 1, '1', '2018-04-23 23:36:16', 2),
(11, 5, '+1', '2018-04-23 23:36:37', 2),
(12, 1, '1', '2018-04-23 23:47:27', 1),
(13, 1, 'Так ,что 1 ?', '2018-04-24 11:47:55', 2),
(14, 5, 'да работает)', '2018-04-24 11:48:38', 2),
(15, 5, 'htddfgh', '2018-04-24 19:33:47', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `stats`
--

CREATE TABLE `stats` (
  `id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `stats`
--

INSERT INTO `stats` (`id`, `count`, `user_id`, `data`, `file_id`) VALUES
(1, 10, 1, '2018-04-16 16:04:44', 1),
(2, 3, 4, '2018-04-16 16:05:14', 1),
(3, 1, 5, '2018-04-16 20:49:19', 1),
(4, 3, 2, '2018-04-16 20:50:08', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `topic_messages`
--

CREATE TABLE `topic_messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topic_messages`
--

INSERT INTO `topic_messages` (`id`, `message`, `data`, `parent_id`, `user_id`, `topic_id`) VALUES
(6, 'dwadwa', '2018-04-24 13:07:32', 0, 1, 11),
(7, 'hdrdfhfdhfd', '2018-04-24 13:07:35', 0, 1, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` varchar(7) NOT NULL DEFAULT 'common'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `permission`) VALUES
(1, 'ArkadyCH', 'arkadychu4vaga@gmail.com', '$2y$10$Z6Ja9qHwnsAWmoppdV2PqeFNrwuYgrnRRATsENQIeA.dWV7CmPRZS', 'admin'),
(2, 'dwadawd', 'dwadawd@DADWA.COM', '$2y$10$RzlROqLdvT0WwNR9fOJRze/LPD5bj9fTHhdggXfsmmda9j0wHT.LW', 'common'),
(3, 'Lolipop322', 'lolipop@gmail.com', '$2y$10$A1IS0YoZ9599rkvSEeT7F.C/G8KNaVv0QXwUxssSMrQxfUbSP4UOu', 'common'),
(4, 'Andrewy', 'andrew@mail.com', '$2y$10$GipNaoO77brKNsTHJga5X.ZpsWxQGqb6U1q7slM4acJ6Vkk1S4p72', 'common'),
(5, 'Lolipoll1', 'lolipoll1@mail.ru', '$2y$10$DvXxsJL2ddQpiwYaBa54AulvCCTUEKBc67eDdTtlyq4Xpu33xHZPC', 'common'),
(6, 'LoserAf', 'loser@mail.ru', '$2y$10$ibyh2EKT2ciKpO7duAfrKuIjtOHJnTOjmvOrsq3XqAJW6ZEgu/y.K', 'common');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dialog`
--
ALTER TABLE `dialog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `topic_messages`
--
ALTER TABLE `topic_messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dialog`
--
ALTER TABLE `dialog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `stats`
--
ALTER TABLE `stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `topic_messages`
--
ALTER TABLE `topic_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
