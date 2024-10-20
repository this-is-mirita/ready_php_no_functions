-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 13 2024 г., 10:24
-- Версия сервера: 8.0.39
-- Версия PHP: 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mini-dataBase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `AnimeServices`
--

CREATE TABLE `AnimeServices` (
  `ServiceID` int NOT NULL,
  `ServiceName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Description` text COLLATE utf8mb4_general_ci,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `AnimeServices`
--

INSERT INTO `AnimeServices` (`ServiceID`, `ServiceName`, `Description`, `Price`) VALUES
(1, 'Онлайн-показ аниме', 'Еженедельные трансляции популярных аниме-сериалов', 9.99),
(2, 'Курсы по рисованию аниме', 'Обучение рисованию в стиле аниме для начинающих', 49.99),
(3, 'Мастер-классы по созданию аниме', 'Интенсивные курсы по созданию аниме с нуля', 99.99);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tyan_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `name`, `comment`, `date`, `tyan_id`) VALUES
(1, 'йцу', 'йцу', '2024-10-05 01:13:43', 1),
(2, 'nikita', 'tilted for php fom', '2024-10-05 03:05:44', 2),
(3, 'nikita', 'tilted for php fom', '2024-10-05 03:06:04', 1),
(4, 'depress', 'авыфавыфа', '2024-10-05 03:56:53', 1),
(5, 'depress', '123', '2024-10-05 20:42:52', 14),
(6, 'depress', 'йуйцуцй', '2024-10-11 10:20:53', 12),
(7, 'depress', 'qwewqeqwewq', '2024-10-11 15:43:55', 11);

-- --------------------------------------------------------

--
-- Структура таблицы `comments_on_index_page`
--

CREATE TABLE `comments_on_index_page` (
  `id` int NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `comments_on_index_page`
--

INSERT INTO `comments_on_index_page` (`id`, `user_id`, `name`, `comment`, `created_at`) VALUES
(26, 9, 'фыввф', 'фывфвв', '2024-10-13 09:50:52'),
(27, 9, 'Уфы', 'вый', '2024-10-13 09:53:11');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int UNSIGNED NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `followers` int NOT NULL,
  `description` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `name_tyan` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `image`, `followers`, `description`, `name_tyan`) VALUES
(1, 'img/1.jpg', 10, 'Я чувствую, что все меня игнорируют, и мир становится все более серым.', 'няшка 1'),
(2, 'img/2.jpg', 20, 'Каждый день похож на предыдущий, и надежда уходит вместе с последним солнечным лучом.', 'няшка 2'),
(3, 'img/3.jpg', 15, 'Внутри меня царит пустота, которую ничто не может заполнить.', 'няшка 3'),
(4, 'img/4.jpg', 25, 'Я боюсь, что никогда не найду свой путь и останусь в темноте навсегда.', 'няшка 4'),
(5, 'img/5.jpg', 30, 'Каждый раз, когда я улыбаюсь, я прячу свою истинную боль.', 'няшка 5'),
(6, 'img/6.jpg', 5, 'Жизнь кажется бесконечной чередой страданий и разочарований.', 'няшка 6'),
(7, 'img/7.jpg', 12, 'Я теряю себя в своих собственных мыслях и страхах.', 'няшка 7'),
(8, 'img/8.jpg', 18, 'Порой мне кажется, что надежда — это лишь иллюзия.', 'няшка 8'),
(9, 'img/9.jpg', 7, 'Я чувствую себя одиноким даже в толпе.', 'няшка 9'),
(10, 'img/10.jpg', 14, 'Мир вокруг меня кажется серым и безжизненным.', 'няшка 10'),
(11, 'img/11.jpg', 11, 'Каждый новый день — это борьба с самим собой.', 'няшка 11'),
(12, 'img/12.jpg', 22, 'Я не знаю, как найти радость в этой жизни.', 'няшка 12'),
(13, 'img/13.jpg', 33, 'Мои мечты становятся все более недостижимыми.', 'няшка 13'),
(14, 'img/14.jpg', 8, 'Время от времени я чувствую, что теряю контроль над своей жизнью.', 'няшка 14'),
(15, 'img/15.jpg', 19, 'Я пытаюсь улыбаться, но внутри меня пустота.', 'няшка 16');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `duration` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `duration`) VALUES
(1, 'Creation of Emptiness', 'Проект, который наполняет экран бессмысленностью и глубокой меланхолией.', 1000.00, 'Endless'),
(2, 'Silence of Eternity', 'Анимация, отражающая безысходность и потерянные мечты.', 1500.00, 'Moments of Eternity'),
(3, 'Darkness of Existence', 'Тёмный мир, в котором нет выхода. Лишь тлен и сожаления.', 2000.00, 'Infinity in Gray'),
(4, 'Destruction of Hopes', 'История, где персонажи теряют всё, что когда-то имело смысл.', 2500.00, 'Time Lost Its Meaning');

-- --------------------------------------------------------

--
-- Структура таблицы `sliders`
--

CREATE TABLE `sliders` (
  `id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `title`, `description`) VALUES
(1, '1.png', 'чб аниме', 'крутое аниме'),
(2, '2.png', 'чб аниме', 'крутое аниме'),
(3, '3.png', 'чб аниме', 'крутое аниме'),
(4, '4.png', 'чб аниме', 'крутое аниме');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `linkimg` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `username`, `email`, `password`, `is_admin`, `linkimg`) VALUES
(9, 'depress', 'depress', 'depress@mail.com', '85470e20d22998dc3f1477df0d420e27', 1, '9.jpg'),
(13, 'asdasффыв', 'asdasффыв', 'asdasффыв', 'asdasффыв', 0, 'asdas');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `AnimeServices`
--
ALTER TABLE `AnimeServices`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_id` (`tyan_id`);

--
-- Индексы таблицы `comments_on_index_page`
--
ALTER TABLE `comments_on_index_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `sliders`
--
ALTER TABLE `sliders`
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
-- AUTO_INCREMENT для таблицы `AnimeServices`
--
ALTER TABLE `AnimeServices`
  MODIFY `ServiceID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `comments_on_index_page`
--
ALTER TABLE `comments_on_index_page`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_post_id` FOREIGN KEY (`tyan_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comments_on_index_page`
--
ALTER TABLE `comments_on_index_page`
  ADD CONSTRAINT `comments_on_index_page_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
