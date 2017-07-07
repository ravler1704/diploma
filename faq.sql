-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 07 2017 г., 14:59
-- Версия сервера: 5.7.16
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `faq`
--

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` text,
  `email` text NOT NULL,
  `answer` text,
  `theme_id` int(11) NOT NULL,
  `status` varchar(15) DEFAULT 'Не опубликовано'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `question`, `date`, `author`, `email`, `answer`, `theme_id`, `status`) VALUES
(16, 'Что такое HTML?', '2017-07-06 11:45:47', 'Александр', 'avr1704@yandex.ru', 'HTML - язык гипертекстовой разметки - стандартизованный язык разметки документов во всемирной паутине.', 12, 'Опубликовано'),
(17, 'Какая структура у HTML документа?', '2017-07-06 11:48:35', 'Александр', 'avr1704@yandex.ru', 'Любой документ на языке HTML представляет собой набор элементов, причем начало и конец каждого элемента обозначается специальными пометками - тегами.', 12, 'Опубликовано'),
(18, 'Какая версия HTML является актуальной на данный момент?', '2017-07-06 13:06:25', 'Александр', 'avr1704@yandex.ru', 'В настоящее время разработан HTML версии 5, которая расширяет HTML для лучшего представления семнатики различных типичных страниц, например форумов, сайтов аукционов, поисковых систем, онлайн магазинов и т.д., которые не очень удачно вписываются в модель XHTML 2.0.', 12, 'Опубликовано'),
(19, 'Что такое XHTML?', '2017-07-06 13:11:01', 'Александр', 'avr1704@yandex.ru', 'Это расширяемый язык гипертекстовой разметки - семейство языков разметки веб-страниц на основе XML. Развитие XHTML остановлено, новые версии не выпускаются. Рекомендуется использовать HTML', 12, 'Опубликовано'),
(20, 'Что такое PHP', '2017-07-06 13:12:42', 'Александр', 'avr1704@yandex.ru', 'Это распространенный язык программирования общего назначения с открытым исходным кодом. PHP сконструирован специально для ведения WEB разработок и его код может внедрятся непосредственно в HTML.', 13, 'Опубликовано'),
(21, 'Где применяется язык PHP?', '2017-07-06 13:13:31', 'Александр', 'avr1704@yandex.ru', 'Применяется в области веб-программирования, в частности в серверной части, PHP - один из популярных сценарных языков (наряду с JSP, Perl и языками, используемыми в ASP.NET).', 13, 'Опубликовано'),
(22, 'Какие есть основные фреймворки для PHP?', '2017-07-06 13:14:49', 'Александр', 'avr1704@yandex.ru', 'Наиболее популярные фреймворки для PHP это Laravel, Yii, Symphoni', 13, 'Опубликовано'),
(23, 'Что такое PEAR?', '2017-07-06 13:15:31', 'Александр', 'avr1704@yandex.ru', NULL, 13, 'Не опубликовано'),
(24, 'Что такое SQL?', '2017-07-06 13:18:20', 'Александр', 'avr1704@yandex.ru', NULL, 14, 'Не опубликовано'),
(25, 'Какие преимущества у SQL?', '2017-07-06 13:20:41', 'Александр', 'avr1704@yandex.ru', NULL, 14, 'Не опубликовано'),
(26, 'Какие недостатки у SQL?', '2017-07-06 13:21:24', 'Александр', 'avr1704@yandex.ru', NULL, 14, 'Не опубликовано'),
(27, 'Что означает реляционная БД?', '2017-07-06 13:25:02', 'Александр', 'avr1704@yandex.ru', NULL, 14, 'Не опубликовано'),
(28, 'Для чего нужны шаблонизаторы?', '2017-07-06 13:37:24', 'Александр', 'avr1704@yandex.ru', NULL, 16, 'Не опубликовано'),
(29, 'Какие шаблонизаторы PHP наиболее популярны?', '2017-07-06 13:38:08', 'Александр', 'avr1704@yandex.ru', NULL, 16, 'Не опубликовано'),
(30, 'В чем преимущества шаблонизатора TWIG?', '2017-07-06 13:41:58', 'Александр', 'avr1704@yandex.ru', NULL, 16, 'Не опубликовано'),
(31, 'Как использовать шаблонизатор TWIG?', '2017-07-06 13:42:40', 'Александр', 'avr1704@yandex.ru', NULL, 16, 'Не опубликовано');

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `questions_all` int(11) NOT NULL DEFAULT '0',
  `questions_published` int(11) NOT NULL DEFAULT '0',
  `questions_unanswerd` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `name`, `questions_all`, `questions_published`, `questions_unanswerd`) VALUES
(12, 'HTML', 0, 0, 0),
(13, 'PHP', 0, 0, 0),
(14, 'SQL', 0, 0, 0),
(16, 'Шаблонизаторы', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
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
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
