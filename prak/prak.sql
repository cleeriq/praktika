-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:27017
-- Время создания: Май 26 2024 г., 10:48
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `prak`
--

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `order_status_id` int NOT NULL,
  `shift_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `order_status_id`, `shift_id`, `user_id`) VALUES
(5, 1, 3, 4),
(6, 1, 3, 5),
(12, 1, 4, 5),
(2, 2, 3, 4),
(4, 2, 3, 4),
(7, 3, 3, 5),
(10, 3, 4, 7),
(1, 4, 3, 4),
(3, 5, 3, 4),
(8, 5, 4, 7),
(9, 5, 4, 7),
(11, 5, 4, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id` int NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Принят'),
(2, 'Готовится'),
(3, 'Готов'),
(4, 'Оплачен'),
(5, 'Отменен');

-- --------------------------------------------------------

--
-- Структура таблицы `order_to_position`
--

CREATE TABLE `order_to_position` (
  `order_id` int NOT NULL,
  `position_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_to_position`
--

INSERT INTO `order_to_position` (`order_id`, `position_id`) VALUES
(2, 1),
(4, 1),
(7, 1),
(8, 1),
(10, 1),
(11, 1),
(12, 1),
(1, 2),
(2, 2),
(3, 2),
(6, 2),
(8, 2),
(10, 2),
(11, 2),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(1, 4),
(2, 4),
(4, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(12, 4),
(4, 5),
(6, 5),
(7, 5),
(9, 5),
(10, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `position`
--

CREATE TABLE `position` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `position`
--

INSERT INTO `position` (`id`, `name`) VALUES
(1, 'Блюдо 1'),
(2, 'Блюдо 2'),
(3, 'Блюдо 3'),
(4, 'Блюдо 4'),
(5, 'Блюдо 5');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Администратор'),
(2, 'Официант'),
(3, 'Повар');

-- --------------------------------------------------------

--
-- Структура таблицы `shift`
--

CREATE TABLE `shift` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `shift_status_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `shift`
--

INSERT INTO `shift` (`id`, `date`, `start`, `end`, `shift_status_id`) VALUES
(1, '2024-05-27', '14:00:00', '20:00:00', 2),
(2, '2024-05-31', '08:00:00', '14:00:00', 3),
(3, '2024-05-16', '12:50:00', '17:50:00', 2),
(4, '2024-06-07', '15:00:00', '18:00:00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `shirt_status`
--

CREATE TABLE `shirt_status` (
  `id` int NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `shirt_status`
--

INSERT INTO `shirt_status` (`id`, `name`) VALUES
(1, 'открыта'),
(2, 'создана'),
(3, 'закрыта');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_file` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `login`, `password`, `photo_file`, `role_id`) VALUES
(3, 'kkkk', 'tyyy', '12345', NULL, 3),
(4, 'Лазарев Константин', '47484', '5984', NULL, 2),
(5, 'Кузьмин Иван', 'fyuid', '59www4', NULL, 2),
(7, 'Котова Агата', '4augiu4', '4605499', NULL, 2),
(8, 'Беляева Ульяна', 'bel', '123456', NULL, 1),
(17, 'Дубинин Виктор', 'fhsifewhowe', 'dshkjhweifj', 'Снимок экрана 2023-08-16 124131.png', 1),
(18, 'Орлова Елена', 'eleee', '56789', 'Снимок экрана 2024-05-08 121528.png', 2),
(19, 'Савельев Фёдор', 'sevff', '54321', 'Снимок экрана 2023-05-03 140837.png', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `user_to_shift`
--

CREATE TABLE `user_to_shift` (
  `user_id` int NOT NULL,
  `shift_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_to_shift`
--

INSERT INTO `user_to_shift` (`user_id`, `shift_id`) VALUES
(4, 1),
(5, 1),
(4, 2),
(5, 2),
(7, 2),
(4, 3),
(5, 3),
(5, 4),
(7, 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`,`order_status_id`,`shift_id`,`user_id`),
  ADD KEY `fk_order_order_status1_idx` (`order_status_id`),
  ADD KEY `fk_order_shift1_idx` (`shift_id`),
  ADD KEY `fk_order_user1_idx` (`user_id`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_to_position`
--
ALTER TABLE `order_to_position`
  ADD PRIMARY KEY (`order_id`,`position_id`),
  ADD KEY `fk_order_has_position_position1_idx` (`position_id`),
  ADD KEY `fk_order_has_position_order1_idx` (`order_id`);

--
-- Индексы таблицы `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`,`shift_status_id`),
  ADD KEY `fk_shift_shirt_status1_idx` (`shift_status_id`);

--
-- Индексы таблицы `shirt_status`
--
ALTER TABLE `shirt_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`role_id`),
  ADD KEY `fk_user_role_idx` (`role_id`);

--
-- Индексы таблицы `user_to_shift`
--
ALTER TABLE `user_to_shift`
  ADD PRIMARY KEY (`user_id`,`shift_id`),
  ADD KEY `fk_user_has_shift_shift1_idx` (`shift_id`),
  ADD KEY `fk_user_has_shift_user1_idx` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `position`
--
ALTER TABLE `position`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `shirt_status`
--
ALTER TABLE `shirt_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_order_status1` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`),
  ADD CONSTRAINT `fk_order_shift1` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`id`),
  ADD CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `order_to_position`
--
ALTER TABLE `order_to_position`
  ADD CONSTRAINT `fk_order_has_position_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `fk_order_has_position_position1` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

--
-- Ограничения внешнего ключа таблицы `shift`
--
ALTER TABLE `shift`
  ADD CONSTRAINT `fk_shift_shirt_status1` FOREIGN KEY (`shift_status_id`) REFERENCES `shirt_status` (`id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_to_shift`
--
ALTER TABLE `user_to_shift`
  ADD CONSTRAINT `fk_user_has_shift_shift1` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`id`),
  ADD CONSTRAINT `fk_user_has_shift_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
