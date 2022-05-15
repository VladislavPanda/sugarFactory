-- phpMyAdmin SQL Dump
-- version 5.2.0-dev+20220215.20f1656050
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 11 2022 г., 11:02
-- Версия сервера: 8.0.24
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sugarfactory`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attachmentable`
--

CREATE TABLE `attachmentable` (
  `id` int UNSIGNED NOT NULL,
  `attachmentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachmentable_id` int UNSIGNED NOT NULL,
  `attachment_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `attachments`
--

CREATE TABLE `attachments` (
  `id` int UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '0',
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `alt` text COLLATE utf8mb4_unicode_ci,
  `hash` text COLLATE utf8mb4_unicode_ci,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `name`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'Коммунарка', '+375(29) 171-97-65', '2022-04-13 19:57:43', '2022-04-13 19:57:43', NULL),
(2, 5, 'Спартак', '+375(44) 142-93-91', '2022-04-20 11:43:48', '2022-04-20 11:43:48', NULL),
(3, 6, 'Доброном', '+375(44) 586-51-80', '2022-05-10 04:30:19', '2022-05-10 04:30:19', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `nutritional_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `energy_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shelf_life` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `title`, `short_description`, `forma`, `description`, `nutritional_value`, `energy_value`, `shelf_life`, `images`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Сахар', 'белый кусковой', 'В ФОРМЕ «БРИДЖ»', 'Сахар белый кусковой – это классическое дополнение к вашим напиткам в форме кубиков. Обладает отличными вкусовыми характеристиками. Кусковой сахар рафинад можно купить как в форме кубиков, так и в форме карточных мастей («бридж»).\r\n\r\nОригинальная форма сахара в виде карточных мастей – «бридж»- украсит стол и приятно удивит Ваших гостей. ', 'углеводы – 100 г.', '1700 кДж (400 ккал.)', '5 лет', '[\"http://sugarfactory/storage/goods/1-1.jpg\", \"http://sugarfactory/storage/goods/1-2.jpg\", \"http://sugarfactory/storage/goods/1-3.jpg\", \"http://sugarfactory/storage/goods/1-4.jpg\", \"http://sugarfactory/storage/goods/1-5.jpg\", \"http://sugarfactory/storage/goods/1-6.jpg\"]', NULL, NULL, NULL),
(2, 'Сахар', 'прессованный «Городейский» с корицей', 'В ФОРМЕ «БРИДЖ»', 'В составе сахар и корица (натуральный компонент). Этот вид прессованного сахара особенно подойдёт для кофе и травяных чаев. ', 'углеводы – 98 г.', '670 кДж (390 ккал.)', '2 года', '[\"http://sugarfactory/storage/goods/2-1.jpg\", \"http://sugarfactory/storage/goods/2-2.jpg\", \"http://sugarfactory/storage/goods/2-3.jpg\", \"http://sugarfactory/storage/goods/2-4.jpg\", \"http://sugarfactory/storage/goods/2-5.jpg\", \"http://sugarfactory/storage/goods/2-6.jpg\"]', NULL, NULL, NULL),
(3, 'Сахар', 'белый кусковой', 'В ФОРМЕ КУБИКОВ', 'Сахар белый кусковой – это классическое дополнение к вашим напиткам в форме кубиков. Обладает отличными вкусовыми характеристиками. Кусковой сахар рафинад можно купить как в форме кубиков, так и в форме карточных мастей («бридж»).', 'углеводы – 100 г.', '1700 кДж (400 ккал.)', '5 лет', '[\"http://sugarfactory/storage/goods/3-1.jpg\", \"http://sugarfactory/storage/goods/3-2.jpg\", \"http://sugarfactory/storage/goods/3-3.jpg\", \"http://sugarfactory/storage/goods/3-4.jpg\", \"http://sugarfactory/storage/goods/3-5.jpg\", \"http://sugarfactory/storage/goods/3-6.jpg\"]', NULL, NULL, NULL),
(4, 'Сахар', 'прессованный «Элитный» с ароматом и вкусом лимона', 'В ФОРМЕ «БРИДЖ»', 'В составе прессованного сахара содержится высушенный перетёртый лимон. Аромат помогает сконцентрироваться, бодрит и заряжает энергией.', 'углеводы – 95 г.', '1620 кДж (380 ккал.)', '2 года', '[\"http://sugarfactory/storage/goods/4-1.jpg\", \"http://sugarfactory/storage/goods/4-2.jpg\", \"http://sugarfactory/storage/goods/4-3.jpg\", \"http://sugarfactory/storage/goods/4-4.jpg\", \"http://sugarfactory/storage/goods/4-5.jpg\", \"http://sugarfactory/storage/goods/4-6.jpg\"]', NULL, NULL, NULL),
(5, 'Сахар', 'прессованный «Элитный» с ароматом и вкусом мяты', 'В ФОРМЕ «БРИДЖ»', 'Прессованный сахар содержит натуральный ароматизатор на основе мятного масла. Добавьте сахар с мятой по вкусу в чай, кофе, морс или коктейль и Вы получите бодрящее мятное послевкусие. А можно вприкуску!', 'углеводы – 95 г.', '1620 кДж (380 ккал.)', '2 года', '[\"http://sugarfactory/storage/goods/5-1.jpg\", \"http://sugarfactory/storage/goods/5-2.jpg\", \"http://sugarfactory/storage/goods/5-3.jpg\", \"http://sugarfactory/storage/goods/5-4.jpg\", \"http://sugarfactory/storage/goods/5-5.jpg\", \"http://sugarfactory/storage/goods/5-6.jpg\"]', NULL, NULL, NULL),
(6, 'Сахар', 'прессованный «Элитный» с ароматом и вкусом лесных ягод', 'В ФОРМЕ «БРИДЖ»', 'Кто попробовал хоть раз купить прессованный сахар, тот убедился как удобно использовать его с чаем, кофе или компотом. В составе порошок лесных ягод и натуральный ароматизатор, которые подарят Вашему напитку чарующий аромат.', 'углеводы – 98 г.', '1670 кДж (390 ккал.)', '2 года', '[\"http://sugarfactory/storage/goods/6-1.jpg\", \"http://sugarfactory/storage/goods/6-2.jpg\", \"http://sugarfactory/storage/goods/6-3.jpg\", \"http://sugarfactory/storage/goods/6-4.jpg\", \"http://sugarfactory/storage/goods/6-5.jpg\", \"http://sugarfactory/storage/goods/6-6.jpg\"]', NULL, NULL, NULL),
(7, 'Сахар', 'белый кристаллический', 'ПОРЦИОННЫЙ', 'Отличный способ продвигать свою торговую марку или фирменное наименование магазина, пекарни или кафе. Чтобы купить кристаллический сахар, необходимо сделать заказ минимум на 150 кг сахара.\r\n\r\nПредлагаем Вам сахар белый кристаллический свекловичный, выпускаемый под торговой маркой «Городейский сахар»:  Все лучшее и сладкое - для Вас!\r\n\r\nТехнологии производства сахара на нашем комбинате обеспечивают выпуск продукции, соответствующей требованиям ГОСТов и технических условий.', 'углеводы – 100 г.', '1700 кДж (400 ккал.)', '2 года', '[\"http://sugarfactory/storage/goods/7-1.jpg\", \"http://sugarfactory/storage/goods/7-2.jpg\", \"http://sugarfactory/storage/goods/7-3.jpg\", \"http://sugarfactory/storage/goods/7-4.jpg\", \"http://sugarfactory/storage/goods/7-5.jpg\", \"http://sugarfactory/storage/goods/7-6.jpg\"]', NULL, NULL, NULL),
(8, 'Сахар', 'белый кристаллический', 'ФАСОВАННЫЙ', 'Категория ТС2, категория «Экстра»', 'углеводы – 100 г.', '1700 кДж (400 ккал.)', '5 лет', '[\"http://sugarfactory/storage/goods/8-1.jpg\", \"http://sugarfactory/storage/goods/8-2.jpg\", \"http://sugarfactory/storage/goods/8-3.jpg\", \"http://sugarfactory/storage/goods/8-4.jpg\", \"http://sugarfactory/storage/goods/8-5.jpg\", \"http://sugarfactory/storage/goods/8-6.jpg\"]', NULL, NULL, NULL),
(9, 'Пудра', 'сахарная «Городейская»', NULL, 'Предлагаем Вам сахарную пудру, выпускаемую под торговой маркой «Городейский сахар»:  Все лучшее и сладкое - для Вас!\r\n\r\nВо время семейного торжества или праздничного ужина на столе всегда присутствует ароматная выпечка. Украшением сладкого блюда является сахарная пудра... Покупатели нашей сахарной пудры характеризуют её мелким помолом, что позволяет творить шедевры при украшении тортов, при изготовлении кремов и мастик.\r\n\r\nЧтобы оригинально украсить Ваши кулинарные десерты достаточно просто купить сахарную пудру мелкого помола! Удобную упаковку оценит любая хозяйка и профессиональный кондитер, а невысокая цена сахарной пудры позволяет щедро использовать ее для различных целей. Имеется возможность производства сахарной пудры БЕЗ антислеживающего агента.', 'углеводы – 93 г.', '1580 кДж (370 ккал.)', '2 года', '[\"http://sugarfactory/storage/goods/9-1.jpg\", \"http://sugarfactory/storage/goods/9-2.jpg\", \"http://sugarfactory/storage/goods/9-3.jpg\", \"http://sugarfactory/storage/goods/9-4.jpg\"]', NULL, NULL, NULL),
(10, 'Пудра', 'сахарная «Городейская» с корицей', NULL, 'Предлагаем Вам сахарную пудру, выпускаемую под торговой маркой «Городейский сахар»:  Все лучшее и сладкое - для Вас!\r\n\r\nВо время семейного торжества или праздничного ужина на столе всегда присутствует ароматная выпечка. Украшением сладкого блюда является сахарная пудра... Покупатели нашей сахарной пудры характеризуют её мелким помолом, что позволяет творить шедевры при украшении тортов, при изготовлении кремов и мастик.\r\n\r\nЧтобы оригинально украсить Ваши кулинарные десерты достаточно просто купить сахарную пудру мелкого помола! Удобную упаковку оценит любая хозяйка и профессиональный кондитер, а невысокая цена сахарной пудры позволяет щедро использовать ее для различных целей. Имеется возможность производства сахарной пудры БЕЗ антислеживающего агента.\r\n\r\nВ составе натуральная молотая корица. Нежный аромат корицы наполнит Ваш дом при приготовлении сладких блюд.', 'углеводы – 97 г.', '1580 кДж (370 ккал.)', '2 года', '[\"http://sugarfactory/storage/goods/10-1.jpg\", \"http://sugarfactory/storage/goods/10-2.jpg\", \"http://sugarfactory/storage/goods/10-3.jpg\"]', NULL, NULL, NULL),
(11, 'Пудра', 'сахарная «Городейская» с ванилью', NULL, 'Предлагаем Вам сахарную пудру, выпускаемую под торговой маркой «Городейский сахар»:  Все лучшее и сладкое - для Вас!\r\n\r\nВо время семейного торжества или праздничного ужина на столе всегда присутствует ароматная выпечка. Украшением сладкого блюда является сахарная пудра... Покупатели нашей сахарной пудры характеризуют её мелким помолом, что позволяет творить шедевры при украшении тортов, при изготовлении кремов и мастик.\r\n\r\nЧтобы оригинально украсить Ваши кулинарные десерты достаточно просто купить сахарную пудру мелкого помола! Удобную упаковку оценит любая хозяйка и профессиональный кондитер, а невысокая цена сахарной пудры позволяет щедро использовать ее для различных целей. Имеется возможность производства сахарной пудры БЕЗ антислеживающего агента.\r\n\r\nВ составе натуральный ароматизатор ваниль. Это настоящий подарок для ценителей хорошего вкуса.', 'углеводы – 97 г.', '1650 кДж (390 ккал.)', '2 года', '[\"http://sugarfactory/storage/goods/11-1.jpg\", \"http://sugarfactory/storage/goods/11-2.jpg\", \"http://sugarfactory/storage/goods/11-3.jpg\"]', NULL, NULL, NULL),
(12, 'Сахар', 'белый кристаллический «Леденцовый»', 'НА ПАЛОЧКЕ', 'Предлагаем Вам сахар леденцовый на палочке, выпускаемый под торговой маркой «Городейский сахар»: Все лучшее и сладкое - для Вас!\r\n\r\nНеобычные сахарные кристаллы на деревянной палочке созданы специально для тех, кто ценит качество, стиль и любит себя побаловать!\r\n\r\nПрименение леденцового сахара придаст особый шарм и дополнит любой напиток: кофе, чай, коктейль, глинтвейн, грог, пунш.\r\n\r\nЕсли же вместо ложечки сахара Вы опустите этот роскошный кристалл в чашку с напитком, то он будет медленно растворяться, придавая сладкий вкус. Вы можете купить леденцовый сахар на палочке также в качестве гостинца, который по достоинству оценят сладкоежки.\r\n\r\nБалуйте себя, удивляйте гостей!\r\n\r\nРоскошные кристаллические леденцы на палочке – это оригинальная замена чайной или кофейной ложечке. Применение леденцового сахара придаст особый шарм Вашему мероприятию и дополнит любой напиток: чай, кофе, коктейль.', 'углеводы – 100 г.', '1700 кДж (400 ккал.)', '5 лет', '[\"http://sugarfactory/storage/goods/12-1.jpg\", \"http://sugarfactory/storage/goods/12-2.jpg\", \"http://sugarfactory/storage/goods/12-3.jpg\", \"http://sugarfactory/storage/goods/12-4.jpg\", \"http://sugarfactory/storage/goods/12-5.jpg\", \"http://sugarfactory/storage/goods/12-6.jpg\"]', NULL, NULL, NULL),
(13, 'Сахар', 'тростниковый', 'В ФОРМЕ КУБИКОВ', 'Карамельный цвет и медово-карамельный вкус тростникового сахара будут неповторимым дополнением к Вашим любимым напиткам: чаю, кофе, коктейлям. Кулинары всего мира оценили тростниковый сахар за то, что он придаёт оригинальные вкусовые оттенки любым блюдам. Коричневый тростниковый сахар в форме кубиков можно купить в картонных коробках по 250 грамм.', 'углеводы – 98 г.', '1670 кДж (390 ккал.)', '2 года', '[\"http://sugarfactory/storage/goods/13-1.jpg\", \"http://sugarfactory/storage/goods/13-2.jpg\", \"http://sugarfactory/storage/goods/13-3.jpg\", \"http://sugarfactory/storage/goods/13-4.jpg\", \"http://sugarfactory/storage/goods/13-5.jpg\", \"http://sugarfactory/storage/goods/13-6.jpg\"]', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_04_11_074459_create_goods_table', 2),
(7, '2022_04_11_143232_create_packs_table', 3),
(8, '2015_04_12_000000_create_orchid_users_table', 4),
(9, '2015_10_19_214424_create_orchid_roles_table', 4),
(10, '2015_10_19_214425_create_orchid_role_users_table', 4),
(11, '2016_08_07_125128_create_orchid_attachmentstable_table', 4),
(12, '2017_09_17_125801_create_notifications_table', 4),
(15, '2022_04_13_223447_create_companies_table', 5),
(17, '2022_04_19_211710_create_orders_table', 6),
(21, '2022_04_20_161021_create_reviews_table', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `good_id` bigint UNSIGNED DEFAULT NULL,
  `pack_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `good_id`, `pack_id`, `quantity`, `date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 12, 26, 5, '2022-04-22', 'Отменен', '2022-04-19 20:34:37', '2022-04-27 13:51:08', NULL),
(2, 4, 5, 7, 7, '2022-04-21', 'Доставлен', '2022-04-20 10:37:13', '2022-04-23 15:35:37', NULL),
(3, 5, 13, 28, 3, '2022-04-20', 'Готов к отгрузке', '2022-04-20 11:56:29', '2022-04-24 06:27:28', NULL),
(4, 5, 6, 8, 2, '2022-04-19', 'Доставлен', '2022-04-20 11:57:14', '2022-04-27 13:51:13', NULL),
(5, 4, 3, 4, 7, '2022-04-12', 'Не оплачен', '2022-04-23 06:38:10', '2022-04-23 15:35:42', NULL),
(6, 4, 8, 18, 20, '2022-04-27', 'Новый заказ', '2022-04-27 14:03:59', '2022-04-27 14:03:59', NULL),
(7, 4, 1, 1, 10, '2022-05-05', 'Новый заказ', '2022-05-05 06:32:23', '2022-05-05 06:32:23', NULL),
(8, 4, 3, 3, 5, '2022-05-05', 'Новый заказ', '2022-05-05 06:33:44', '2022-05-05 06:33:44', NULL),
(9, 4, 2, 2, 40, '2022-05-05', 'Новый заказ', '2022-05-05 07:17:41', '2022-05-05 07:17:41', NULL),
(10, 6, 8, 16, 3, '2022-05-10', 'Новый заказ', '2022-05-10 05:37:34', '2022-05-10 05:37:34', NULL),
(11, 6, 13, 28, 8, '2022-05-10', 'Новый заказ', '2022-05-10 05:44:36', '2022-05-10 05:44:36', NULL),
(12, 6, 11, 23, 5, '2022-05-10', 'Новый заказ', '2022-05-10 05:45:24', '2022-05-10 05:45:24', NULL),
(13, 6, 7, 11, 3, '2022-05-10', 'Новый заказ', '2022-05-10 05:49:36', '2022-05-10 05:49:36', NULL),
(14, 6, 6, 8, 3, '2022-05-10', 'Новый заказ', '2022-05-10 05:50:18', '2022-05-10 05:50:18', NULL),
(15, 6, 8, 15, 5, '2022-05-11', 'Новый заказ', '2022-05-11 04:19:47', '2022-05-11 04:19:47', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `packs`
--

CREATE TABLE `packs` (
  `id` bigint UNSIGNED NOT NULL,
  `good_id` bigint UNSIGNED DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `weight` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `packs`
--

INSERT INTO `packs` (`id`, `good_id`, `photo`, `weight`, `forma`, `group`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'http://sugarfactory/storage/packs/1.jpg', '0,5 кг.', 'Картонная коробка', 'по 12 коробок в гофроящик (6 кг.)', NULL, NULL, NULL),
(2, 2, 'http://sugarfactory/storage/packs/2.jpg', '0,5 кг.', 'Картонная коробка', 'по 12 коробок в гофроящик (6 кг.)\r\n', NULL, NULL, NULL),
(3, 3, 'http://sugarfactory/storage/packs/3.jpg', '0,25 кг.', 'Картонная коробка', 'по 24 коробки в гофроящик (6 кг.)', NULL, NULL, NULL),
(4, 3, 'http://sugarfactory/storage/packs/4.jpg', '0,5 кг.', 'Картонная коробка', 'по 12 коробок в гофроящик (6 кг.)', NULL, NULL, NULL),
(5, 3, 'http://sugarfactory/storage/packs/5.jpg', '1 кг.', 'Картонная коробка', 'по 6 коробок в гофроящик (6 кг.)', NULL, NULL, NULL),
(6, 4, 'http://sugarfactory/storage/packs/6.jpg', '0,5 кг.', 'Картонная коробка', 'по 12 коробок в гофроящик (6 кг.)', NULL, NULL, NULL),
(7, 5, 'http://sugarfactory/storage/packs/7.jpg', '0,5 кг.', 'Картонная коробка', 'по 12 коробок в гофроящик (6 кг.)', NULL, NULL, NULL),
(8, 6, 'http://sugarfactory/storage/packs/8.jpg', '0,5 кг.', 'Картонная коробка', 'по 12 коробок в гофроящик (6 кг.)', NULL, NULL, NULL),
(9, 7, 'http://sugarfactory/storage/packs/9.jpg', '5 г.', 'Бумажный ламинированный пакетик «саше»', 'по 600 шт. в гофроящике (3 кг.)', NULL, NULL, NULL),
(10, 7, 'http://sugarfactory/storage/packs/10.jpg', '5 г.', 'Бумажный ламинированный пакетик «стик»', 'по 600 шт. в гофроящике (3 кг.)', NULL, NULL, NULL),
(11, 7, 'http://sugarfactory/storage/packs/11.jpg', '10 г.', 'Бумажный ламинированный пакетик «саше»', 'по 300 шт. в гофроящике (3 кг.)', NULL, NULL, NULL),
(12, 8, 'http://sugarfactory/storage/packs/12.jpg', '1 кг. (категория ТС2)', 'Бумажный пакет', 'по 10 пакетов в термоусадочной плёнке (10 кг.)', NULL, NULL, NULL),
(13, 8, 'http://sugarfactory/storage/packs/13.jpg', '900 г. (категория «Экстра»)', 'Бумажный пакет', 'по 10 пакетов в термоусадочной плёнке (9 кг.)', NULL, NULL, NULL),
(14, 8, 'http://sugarfactory/storage/packs/14.jpg', '1 кг. (категория «Экстра»)', 'Бумажный пакет', 'по 10 пакетов в термоусадочной плёнке (10 кг)', NULL, NULL, NULL),
(15, 8, 'http://sugarfactory/storage/packs/15.jpg', '450 г. (категория ТС2)', 'Пакет из ламинированной пленки', 'по 15 пакетов в гофроящик (6,75 кг.)', NULL, NULL, NULL),
(16, 8, 'http://sugarfactory/storage/packs/16.jpg', '5 кг. (категория ТС2)', NULL, NULL, NULL, NULL, NULL),
(17, 8, 'http://sugarfactory/storage/packs/17.jpg', '25 кг., 50 кг.', 'Полипропиленовый мешок с полиэтиленовым вкладышем', NULL, NULL, NULL, NULL),
(18, 8, 'http://sugarfactory/storage/packs/18.jpg', '1000 кг. (категория «Экстра»)', 'Мягкий специализированный контейнер', NULL, NULL, NULL, NULL),
(19, 9, 'http://sugarfactory/storage/packs/19.jpg', '350 г.', 'Пакет из ламинированной плёнки', 'по 15 пакетов в гофроящике (5,25 кг.)', NULL, NULL, NULL),
(20, 9, 'http://sugarfactory/storage/packs/11.jpg', '4 кг.', 'Бумажный пакет', NULL, NULL, NULL, NULL),
(21, 9, 'http://sugarfactory/storage/packs/21.jpg', '20 кг.', 'Полипропиленовый мешок с полиэтиленовым вкладышем', NULL, NULL, NULL, NULL),
(22, 10, 'http://sugarfactory/storage/packs/22.jpg', '200 г.', 'Пакет из ламинированной плёнки', 'по 20 пакетов в гофроящике (4 кг.)', NULL, NULL, NULL),
(23, 11, 'http://sugarfactory/storage/packs/23.jpg', '200 г.', 'Пакет из ламинированной плёнки', 'по 20 пакетов в гофроящике (4 кг.)', NULL, NULL, NULL),
(24, 12, 'http://sugarfactory/storage/packs/24.jpg', '48 г.', 'Картонная коробка (6 шт. по 8 г.)', 'по 30 коробок в гофроящике (1440 г.)', NULL, NULL, NULL),
(25, 12, 'http://sugarfactory/storage/packs/25.jpg', '75 г.', 'Картонная коробка (6 шт. по 12,5 г.)', 'по 14 коробок в гофроящике (1050 г.)', NULL, NULL, NULL),
(26, 12, 'http://sugarfactory/storage/packs/26.jpg', '8 г.', 'Полипропиленовая плёнка', 'по 150 шт. навалом в гофроящик (1,2 кг.)', NULL, NULL, NULL),
(27, 12, 'http://sugarfactory/storage/packs/27.jpg', '12,5 г.', 'Полипропиленовая плёнка', 'по 100 шт. навалом в гофроящик (1,25 кг.)', NULL, NULL, NULL),
(28, 13, 'http://sugarfactory/storage/packs/28.jpg', '0,25 кг.', 'Картонная коробка', 'по 24 коробки в гофроящик (6 кг.)', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `good_id` bigint UNSIGNED DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `good_id`, `company_name`, `title`, `review`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 'comp name', 'Отзыв1', 'Текст отзыва1', '2022-04-22', '2022-04-22 14:26:07', '2022-04-22 14:26:07', NULL),
(2, 5, 'comp name', 'Заголовок2', 'Текст 2', '2022-04-22', '2022-04-22 14:29:51', '2022-04-22 14:29:51', NULL),
(3, 3, 'comp name', 'Отличный сахар', 'Все понравилось!', '2022-04-23', '2022-04-23 06:38:39', '2022-04-23 06:38:39', NULL),
(4, 3, 'comp name', 'Заголовок отзыва новый', 'Текст отзыва 1234567890', '2022-04-27', '2022-04-27 13:36:22', '2022-04-27 13:36:22', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `role_users`
--

CREATE TABLE `role_users` (
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permissions` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `permissions`) VALUES
(1, 'admin', 'mbedulya@gmail.com', NULL, '$2y$10$qnztCuq4se2E9n/V64BKJ.WJ9nlx2nx5Q72VmEpoYUCsBCQUMa4b6', 'zYF4ea7XucN72vvtzV3WjPhe2kFPDGJcnpcbMWQDrb4ks6uCmWo0parEVL67', '2022-04-12 16:13:35', '2022-04-12 16:13:35', '{\"platform.index\": true, \"platform.systems.roles\": true, \"platform.systems.users\": true, \"platform.systems.attachment\": true}'),
(4, 'Олег', 'company@gmail.com', NULL, '$2y$10$1jDnGXRgbC5QnZI3SHa0bejO4yROEp3pcumUPKRu.TH6F8qFcTQz6', NULL, '2022-04-13 19:57:42', '2022-04-13 19:57:42', NULL),
(5, 'Иван', 'comp1@gmail.com', NULL, '$2y$10$OYmMxy114zpdkyh9A53CbeQ3T9lDG7mpTL4016eRwrAxCQjTtv5uS', NULL, '2022-04-20 11:43:47', '2022-04-20 11:43:47', NULL),
(6, 'Юрий', 'dobronom@gmail.com', NULL, '$2y$10$dvS/YnPMNJmWWLZg3ar.WeuTu0UCG2rerMPA8N0bhgzxkENwr9rsK', NULL, '2022-05-10 04:30:19', '2022-05-10 04:30:19', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachmentable_attachmentable_type_attachmentable_id_index` (`attachmentable_type`,`attachmentable_id`),
  ADD KEY `attachmentable_attachment_id_foreign` (`attachment_id`);

--
-- Индексы таблицы `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_good_id_foreign` (`good_id`),
  ADD KEY `orders_pack_id_foreign` (`pack_id`);

--
-- Индексы таблицы `packs`
--
ALTER TABLE `packs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packs_good_id_foreign` (`good_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_good_id_foreign` (`good_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Индексы таблицы `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_users_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `packs`
--
ALTER TABLE `packs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  ADD CONSTRAINT `attachmentable_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`),
  ADD CONSTRAINT `orders_pack_id_foreign` FOREIGN KEY (`pack_id`) REFERENCES `packs` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `packs`
--
ALTER TABLE `packs`
  ADD CONSTRAINT `packs_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`);

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`);

--
-- Ограничения внешнего ключа таблицы `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
