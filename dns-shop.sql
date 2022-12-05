-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 05 2022 г., 16:51
-- Версия сервера: 5.6.51-log
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dns-shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-image.png',
  `img_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-image.png',
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `banner`
--

INSERT INTO `banner` (`id`, `title`, `text`, `img_1`, `img_2`, `product_id`) VALUES
(1, 'Новая эра смартфонов', 'Новый Apple Iphone 14 Pro', 'banner-1.jpeg', 'banner-2.jpeg', 3),
(2, 'sadasd', 'adssasad asdadsada sadadasd', 'no-image.png', 'no-image.png', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Microsoft'),
(2, 'Sony'),
(3, 'POCO'),
(4, 'Apple');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Бытовая техника'),
(2, 'Смартфоны и гаджеты'),
(3, 'ТВ и мультимедиа'),
(4, 'Компьютеры'),
(5, 'Офис и сеть');

-- --------------------------------------------------------

--
-- Структура таблицы `characteristics`
--

CREATE TABLE `characteristics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `characteristics`
--

INSERT INTO `characteristics` (`id`, `name`, `subcategory_id`) VALUES
(1, 'Контроллеры', 8),
(2, 'Сеть', 8),
(3, 'Порты', 8),
(4, 'Цвет', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_methods`
--

CREATE TABLE `delivery_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `delivery_methods`
--

INSERT INTO `delivery_methods` (`id`, `name`, `delivery_time`, `price`) VALUES
(1, 'Почта России', 'от 7 до 14 дней', 0),
(2, 'ПВЗ СДЭК', 'от 7 до 14 дней', 350);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_method_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `qty_products` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Новый'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `city`, `address`, `note`, `comment`, `delivery_method_id`, `payment_method_id`, `total_price`, `qty_products`, `date`, `status`) VALUES
(24, 8, 'Орёл', 'ул. Пушкина, д. 9', '', '', 1, 1, 139970, 3, '2022-11-25 22:34:31', 'Новый'),
(25, 8, 'Орёл', 'ok[ok[', 'ok[ok[ok[', '', 1, 1, 25990, 1, '2022-11-26 10:55:31', 'Новый');

-- --------------------------------------------------------

--
-- Структура таблицы `order_body`
--

CREATE TABLE `order_body` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_body`
--

INSERT INTO `order_body` (`id`, `order_id`, `product_id`, `qty_product`) VALUES
(9, 24, 1, 2),
(10, 24, 2, 1),
(11, 25, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`) VALUES
(1, 'Оплата наличными курьеру'),
(2, 'Картой при получении'),
(3, 'Онлайн оплата');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '7-12',
  `img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `article`, `img`, `price`, `description`, `subcategory_id`, `brand_id`) VALUES
(1, 'Xbox Series X', '7-12', 'https://c.dns-shop.ru/thumb/st4/fit/500/500/71786805bb261cfe2e8b005151e0c3b5/19ac4a14da38ea84b516599741a1f739b3bd8221c3e171a495be44c9226b2b22.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/aa496ff024c49ede14c6d5cb9617b231/8255acf7c252381da2b40c9afab06a8d578cab1c60c39ecd755095c1a92c6566.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/d420f9791765f2626e3a9e090db99d92/301e3fa74c5136ad4a93b1249e8e9b0ff77b2f639d3fed3a9147f8972cd4445f.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/fa69fdb410212df6bb80d09aa3d311e9/5283397c80dfbbc5ef8d702bda0e5d6f99212688a39be98e45c76e0030029e38.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/6ec01125d60bcbb81a5360d0b28a1300/202c239230bbf0b247b3f84e9015c7bd79af396c695e027df6f6922362785ce8.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/ac052af22ed366b2ffb7988cee409a4d/866876513c3886cdc6c72c4397f54ef330bb5624d4b363b54225821244ef95da.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/210fc0915dca578da854ce607c338f7d/e12067cb3df2c21153262a4cc2f54156f3ba2e2ef4bc5521869b7d18cb102c1a.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/dae5103242776f8f7e1b4d7ffb8b4734/9bbd8309253a6f2902280b0a70f383e26fb93f487763a0efe71f7cc0c9cd734d.jpg.webp', 56990, 'Xbox Series X — консоль нового поколения, которая обеспечивает сенсационно плавную частоту до 120 к/с и яркую и контрастную HDR-картинку. Погрузитесь в игру с головой, наслаждаясь более чёткими персонажами, яркими мирами и невероятными деталями в сверхреалистичном качестве 4K. <br>\r\nСочетание новой системы на кристалле (SOC) и архитектуры Xbox Velocity обеспечивает максимальную скорость, в то время как процессор и специализированный твердотельный накопитель объёмом 1 ТБ отдают вам полный контроль и позволяют разгоняться с 0-60 до 120 к/с. <br>\r\nОтправляйтесь в новые приключения и наслаждайтесь ими в том виде, в котором они задумывались, вместе с Xbox Series X.', 8, 1),
(2, 'Poco X3 Pro', '7-12', 'https://c.dns-shop.ru/thumb/st4/fit/500/500/7cb1efbd8101a70ce66e67f5f1753938/26c78edfdadf70b83f55d06d25a52c40d5e17e635b3bdd77b298a6900f099aa7.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/7c4d5607961b89dc220fa74cc357cfcf/a1f0ba973f22ccde918b27d4b8ba26add8afd9b8b7d4de7ecee3d8bfba16facd.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/facff30fb9d81d598bcef90a69a262b7/7ac7efc5577b9bfa81689d0221b689dd215c1335eae987755d21a560d9a267c8.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/c86cd08f5cf2c146b187f8d767410553/4dea366690a3f1e0e03ca1fcb019debbb5d27a89e54f8206e038cd42ff93d342.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/e4bfb4d234b325014d1ea2c9266d82ed/a6b37c08241b62e2be5e0d4b85a8a67cebea155055712a91ac3b757cf622e4ea.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/2ea3c4d7b94b4c958a32371333226997/252139a38202edd1fe432677484f7196593fd79052a8687ba930941cbab5354f.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/466799f6354ce262f768756a24726ee9/ad194f51c5080d589675639b5d2f5c1654a3f54d1a30dcca5a79b777c8005185.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/e72065a71ea6a5eb017d6f58aa7ba743/ace823aa4b0ce2b21b42451ea2ab736851fb5a8a0439eb36dc936b34492bfdc3.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/ea26a5e2f78c9bc80b09fc37ce2545ed/af564d908c039129a502e8237463ea2c00acbc6ce4bce8bccd8164da4d243a2b.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/d3fb649015e01f6a5b6266d1fdd72af9/6725941e7518d1632ca266da3b25c9f93579851ee656146879d1fe7e656353f0.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/e020e61464094a19fd0f8f89a23b0240/e71b729ec1ad28be8ce44325705b003e42c91487562900cdd857beec25b34644.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/594005fb4c819dd93696b30ffd23f8c5/ddf6b66a88b52f6d8a591f01f9801e636e256bfedb34d829cc8334cdb18e105e.jpg.webp', 25990, 'Компания Xiaomi вновь предоставляет вам возможность насладиться «топовым» железом по самой заманчивой цене. Сверхбыстрый процессор Snapdragon 860 с быстрой памятью UFS 3.1 и ёмким аккумулятором 5160 мАч, цветной IPS-экран с частотой 120 Гц - всё это про РОСО Х3 Pro. <br> <br>\r\nСплошное удовольствие через экран\r\n<br> <br>\r\nВ смартфоне РОСО Х3 Pro установлен 6,67-дюймовый IPS LCD экран с частотой обновления 120 Гц, а также частотой дискретизации касания 240 Гц - что может быть лучше для суперплавного гейминга и быстрой работы с интерфейсом. Также экран защищён стеклом Corning Gorilla Glass 6, что в дополнение к его скорости отзывчивости добавляет ещё и устойчивости к повреждениям.\r\n<br> <br>\r\nКамера для съёмки со вкусом\r\n<br> <br>\r\nОсновная камера состоит из 4 объективов: широкоугольной 48 МП широкоугольный, ультраширокоугольной 8 МП с углом обзора 119 градусов, макро- и глубины 2 МП. Дополняйте съёмку различными эффектами и делайте фотографии и видео ещё более оригинальными и запоминающимися. Вы можете воспользоваться одновременной съёмкой на обе камеры, таймпласом, панорамой, клонированием и другими функциями для украшения картинки.\r\n<br> <br>\r\nБыстрая производительность на долгие годы\r\n<br> <br>\r\nРОСО Х3 Pro оснащён новейшим оперативным процессором Qualcomm Snapdragon 860, благодаря которому на смартфоне можно с комфортом играть во все современные игры любого объёма графики и памяти. А запаса мощности чипсета 855/860 может хватит на 3-4 года работы.\r\n<br> <br>\r\nЗаряд на весь день\r\n<br> <br>\r\nВ РОСО Х3 Pro установлена батарея ёмкостью 5160 мАч, которая поддерживает быструю зарядку. Вы можете сутки неотрывно заниматься своими делами -  работать, играть или просматривать контент, а потом зарядить смартфон на все 100% всего за 1 час.', 4, 3),
(3, 'Apple Iphone 14 Pro Max', '7-12', 'https://c.dns-shop.ru/thumb/st4/fit/500/500/fbe54ef433cfd0dea26735764b4967f9/928f208262d5c75241342483da048d7fd57b1bb9aa6099b7268208fbba2d47f7.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/fec4c64b327d4be5caf57f9419707a51/ce8392c6b7034c172f290e12ebac6fdccde23f8fa4c96f359dabc7af74b623e9.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/e7f0cd48257cdc1e99f359c69340323b/86b42c34a4cd3c55b9fcaf9591b88ef0e320365428b56441adf8c8e8e20ca0ba.jpg.webp', 119990, 'Новый волшебный способ взаимодействия с iPhone.\r\nНоваторские функции безопасности, призванные спасать жизни.\r\nИнновационная 48-мегапиксельная камера для потрясающей детализации.\r\nВсе они оснащены новейшим чипом для смартфонов.\r\nС керамическим экраном, более прочным, чем стекло любого смартфона. Водонепроницаемость. Нержавеющая сталь хирургического класса.\r\n<br> <br>\r\nПредставляем Dynamic Island, по-настоящему инновационную разработку Apple, состоящую из аппаратного и программного обеспечения. Он воспроизводит музыку, спортивные результаты, FaceTime и многое другое — и все это, не отвлекая вас от того, что вы делаете.\r\n<br> <br>\r\nДисплей всегда включен. Всегда наготове. Дисплей, который на солнце становится в 2 раза ярче. Теперь экран блокировки всегда виден, поэтому вам даже не нужно нажимать на него, чтобы оставаться в курсе событий. Когда iPhone повернут лицевой стороной вниз или лежит в кармане, он гаснет, чтобы сэкономить время автономной работы.\r\n<br> <br>\r\niOS 16 позволяет по-новому настраивать экран блокировки. Наложите слой на фотографию, чтобы сделать ее всплывающей. Отслеживайте свои звонки активности. И смотрите текущие обновления из ваших любимых приложений.\r\n<br> <br>\r\niPhone 14 Pro поднимает планку возможностей 48 мегапикселей, обеспечивая в 4 раза большее разрешение в ProRAW для умопомрачительной детализации в каждом кадре.\r\nНовая система Pro Camera System добавляет к диапазону зума телеобъектив оптического качества в 2 раза, что обеспечивает большую гибкость при съемке.\r\nКинематографический режим теперь снимает в формате 4K HDR со скоростью 24 кадра в секунду — стандарт киноиндустрии. Пусть ваши сотрудники позвонят нашим сотрудникам.\r\nТеперь вы можете легко редактировать вместе с другими профессиональными кадрами в формате 4K со скоростью 24 или 30 кадров в секунду. Вы даже можете отредактировать эффект глубины после съемки.\r\nДелайте самые четкие, красочные снимки крупным планом и групповые снимки благодаря новой фронтальной камере TrueDepth с автофокусом и увеличенной диафрагмой.\r\n<br> <br>\r\nНесмотря на оооочень много новых возможностей, iPhone 14 Pro по‑прежнему обеспечивает потрясающее время автономной работы в течение всего дня.\r\n<br> <br>\r\nПолучайте еще больше удовольствия от своего iPhone.', 4, 4),
(4, 'Playstation 5', '7-12', 'https://c.dns-shop.ru/thumb/st1/fit/500/500/9a684f65aea7847b60f36610d6e23168/ace309d3bcfc175ff0f153679c7dcfe0edbe63db7fc8c34ae5c3a242a7804548.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/d3c138e0a5a42721e6fa0d6725e689f0/6ca51ab88043b8f33bea570a3fd44157a88a0f4cbb333b55cb3fdebddbff25fb.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/21ed86a9ae8fbc08acbd23e76949ca00/ba4dfe86134b5f6fcb06e39fb299a0b64f016575703f1d4317b2ef5121f0a045.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/089db89257732cc56d1a4c9aec2a55b7/d3736e2a1d66022c46fc2cf734fb4c804cc5ba57b2e90fa8a6e5599a3dede363.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/d13e6f6c23daa1ba00cd535ce9108bd4/fd969cef66a6d4c9076665334c20d39fa8f9f48de7d84875abbfa07badafd9ef.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/2137435a3b800685cc9c0f9e26e42841/84c661f50f03f3afc83e932d247915f7ef30c6f32979c8fae81f039fecd20331.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/1af89be6b053194a7daa700b0dc5fcce/3e8eb6aa13e9d262af70868cf1a5ec39e172bccc7cb1f4e3c897bbfdbb2c5c9a.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/9f151dc919d2ee7be7fb3b19e1418eec/97c15204243e070a4a7cbcc677df8241c9968554713522311686b3bed3053ef6.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/af631354545e399a24dc9205274f5977/c88dca98aa76e6655b485f8db9d0d80f91e3e651790a277443c2f791cb84204e.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/366e6637370363100b6988c92e76d73d/95f34536ec90ddd31673d0def140a660b65a41c8a2ab7ce484d1c45e516b48a3.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/f6677aa43ad3edb7b5db537a8170e436/7e50c940eb78821b2c40980162bfc32d40f39cdbcef7d336355bd0d3e3ae74bd.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/993eb6b18cc89e21b0147be37a25ae77/bb259f292c5c7c423c539216cb3429443adb726b7d5f2dbd802c421b6d5a7106.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/cf3a6e7bab6db660a5544ffe61fb4cb0/eea1ae272184f157c7d727f69e74ed503c1df4c1685153d11c82e7df26e26c35.jpg.webp https://c.dns-shop.ru/thumb/st1/fit/500/500/5be10a92c2d2ee0eda0d7f3e2be0c9e6/97810d522c9458044f9bb72cd9b29eb3a4abd93fc6709daa9b0e2dafac063883.jpg.webp https://c.dns-shop.ru/thumb/st4/fit/500/500/43ef4cc41c3f32ff0afed0dae27965eb/d96ac1e0e0c9984d4ca193a03c419b5f17a65f115e00d382f2dbd8d04c8bc035.jpg.webp', 59990, 'Молниеносная скорость загрузки благодаря сверхскоростному накопителю SSD, невероятный эффект погружения благодаря тактильной отдаче, адаптивным спусковым кнопкам и 3D-звуку, а также потрясающие игры нового поколения для PlayStation. <br>\r\nНевероятно мощные центральный и графический процессоры, а также SSD-диск с интегрированной системой ввода-вывода перевернут ваше представление о возможностях консоли PlayStation. <br>\r\nБеспроводной контроллер DualSense™ для PS5 предлагает игрокам тактильную отдачу, дополняющую спектр ощущений от игры, адаптивные спусковые курки и встроенный микрофон – все эти функции прекрасно дополняют новый узнаваемый дизайн.', 8, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `product_characteristics`
--

CREATE TABLE `product_characteristics` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `characteristic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_characteristics`
--

INSERT INTO `product_characteristics` (`id`, `product_id`, `value`, `characteristic_id`) VALUES
(1, 1, 'геймпад - 1 шт.', 1),
(2, 1, 'Wi-Fi', 2),
(3, 1, 'USB 3.1 x3', 3),
(4, 1, 'Черный', 4),
(5, 4, 'геймпад - 2 шт.', 1),
(6, 4, 'Wi-Fi, LAN', 2),
(7, 4, 'USB 3.1 x3', 3),
(8, 4, 'Белый', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `description`, `category_id`, `counter`) VALUES
(1, 'Товары для кухни', '', 1, 7),
(2, 'Товары для дома', '', 1, 0),
(3, 'Красота и здоровье', '', 1, 0),
(4, 'Смартфоны', 'Смартфон - это мобильное устройство, в котором сочетается функционал сотового телефона и компьютера. Благодаря сенсорному экрану и большой вычислительной мощности девайс открывает для своего владельца обширные возможности для просмотра видеороликов, интернет-серфинга и игр. Несмотря на то, что в магазинах представлено достаточно много моделей смартфонов, сделать правильный выбор достаточно легко. В первую очередь определитесь с бюджетом будущей покупки: от цены напрямую зависит качество корпуса, обширность функций и техническое оснащение мобильной техники. Если вы планируете использовать устройство исключительно для звонков, общения в мессенджерах и нересурсоемких развлечений, вам подойдут недорогие смартфоны. Для тех пользователей, которые любят много фотографировать, созданы модели с хорошими основной и фронтальной камерами. Геймерам подойдут девайсы с большим экраном и мощной аппаратной частью. Любителям активного отдыха плюсом станет наличие защищенного корпуса у мобильного устройства. Далеко не последнюю роль играет операционная система: наиболее популярной ОС является Android, в то время как iOS привлекает стабильной работой. Интернет-магазин DNS предлагает вам множество моделей от ведущих производителей. Вы сможете, не выходя из дома, приобрести смартфон, удовлетворяющий вашим требованиям к его цене, функционалу и аппаратному оснащению.', 2, 53),
(5, 'Планшеты', '', 2, 3),
(6, 'Фототехника', '', 2, 1),
(7, 'Телевизоры', '', 3, 5),
(8, 'Консоли и видеоигры', '', 3, 49),
(9, 'Аудиотехника', '', 3, 2),
(10, 'Компьютеры', '', 4, 1),
(11, 'Ноутбуки', '', 4, 1),
(12, 'Комплектующие для ПК', '', 4, 0),
(13, 'Периферия', '', 4, 0),
(14, 'Оргтехника', '', 5, 0),
(15, 'Роутеры', '', 5, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Орёл',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `location`, `password`, `created`) VALUES
(1, 'test', 'test@gmail.com', '+7 (953) 819-11-22', 'Орёл', '123456', '2022-10-20 13:45:06'),
(2, 'cherpek', 'cherpek@gmail.com', '+7 (953) 819-13-63', 'Орёл', '$2y$10$TWXYHzTeuKRSDzKNWd4YIezAdX71.DjTYMpah7e86xaY.Cds8ZvK6', '2022-10-21 20:24:52'),
(3, 'test2', 'test2@mail.ru', '+7 (900) 121-54-46', 'Орёл', '$2y$10$hU652UvzzyagKvi.2PC59.XIy7/yk3.dmJ64cXCkD9opLUfuaensu', '2022-10-21 20:29:20'),
(4, 'test3', 'test3@gmail.com', '+7 (454) 121-26-15', 'Орёл', '$2y$10$x5GMhgwE.pNnle.tHy1LpOz7hn6OX3yp.W3jmYTpl/0ehWkbv/jh2', '2022-10-21 20:37:02'),
(8, 'Копылов Никита', 'test4@mail.ru', '+7 (953) 819-13-63', 'Орёл', '$2y$10$5DdS2KxF8I9Y3r1vVTqlZuiIg7deNZ4cDDbhSiaBKt8Y51P2sK9vO', '2022-11-24 15:28:31'),
(9, 'Владислав Химик', 'ximik@mail.ru', '+7 (953) 321-13-23', 'Орёл', '$2y$10$eN1y4/AWGOTBoVFtpmpfJuLG4GI3Nzn1Cn7ZKLNVgnGwTAnFyL876', '2022-11-29 16:08:44'),
(10, 'test6', 'test6@mail.ru', '+7 (111) 222-22-22', 'Орёл', '$2y$10$A1JSs0RIUBOsAfMJgA2sdu0LdV76vLTi98AQ1vuwSi.legfi1dVWK', '2022-11-29 16:10:51'),
(11, 'test7', 'test7@mail.ru', '+7 (333) 333-33-33', 'Орёл', '$2y$10$5yBXKkYqNo74qKDmXU5e6.74xhVkK6tyh6H4xtX8Fg2F4wl.im2tG', '2022-11-29 16:12:18'),
(12, 'test8', 'test8@mail.ru', '+7 (444) 444-44-44', 'Орёл', '$2y$10$mlzDNVImxdh3185exVtD8.uaHtPE5sVpdTXhLoy8UzalY7BCUcwDC', '2022-11-29 16:13:10'),
(13, 'test9', 'test9@mail.ru', '+7 (453) 443-15-61', 'Орёл', '$2y$10$H3Ggu/UaSdXG0l6ddcE9ReFATTLw6GASsg4yccIIy3XZt4ALvy89K', '2022-11-29 16:20:13'),
(14, 'test10', 'test10@mail.ru', '+7 (468) 415-61-35', 'Орёл', '$2y$10$76Zwx9VBjtbQ.UOhzrlwY.SuvZtQ.IOgYC9.91qyMnHF/gjiRLcqq', '2022-11-29 16:20:59'),
(15, 'Копылов Никита', 'test15@mail.ru', '+7 (888) 464-64-68', 'Орёл', '$2y$10$vPvx4juTaVj.pTdbBN5NBOnx6/FpAZYvxNMpzRvsldbi1xnc6A1We', '2022-11-30 09:38:39'),
(16, 'Тест', 'test@mai.ru', '+7 (874) 451-64-65', 'Орёл', '$2y$10$oWZugBEfU2jSEsliRYbDTOsAl2CnsvPlXtph7EuAm4AfEMdCqdVEa', '2022-11-30 09:44:31'),
(17, 'Тест', 'test@gmail.com', '+7 (641) 654-65-46', 'Орёл', '$2y$10$Mg6QRhyguTWvS5drldyLzeBQUskJGM0593eXS5.WcTH4qKKTxeAXG', '2022-11-30 09:45:05');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `characteristics`
--
ALTER TABLE `characteristics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategoty_id` (`subcategory_id`);

--
-- Индексы таблицы `delivery_methods`
--
ALTER TABLE `delivery_methods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `delivery_method_id` (`delivery_method_id`),
  ADD KEY `payment_method_id` (`payment_method_id`);

--
-- Индексы таблицы `order_body`
--
ALTER TABLE `order_body`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Индексы таблицы `product_characteristics`
--
ALTER TABLE `product_characteristics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `characteristic_id` (`characteristic_id`);

--
-- Индексы таблицы `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `characteristics`
--
ALTER TABLE `characteristics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `delivery_methods`
--
ALTER TABLE `delivery_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `order_body`
--
ALTER TABLE `order_body`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `product_characteristics`
--
ALTER TABLE `product_characteristics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `banner_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `characteristics`
--
ALTER TABLE `characteristics`
  ADD CONSTRAINT `characteristics_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`delivery_method_id`) REFERENCES `delivery_methods` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

--
-- Ограничения внешнего ключа таблицы `order_body`
--
ALTER TABLE `order_body`
  ADD CONSTRAINT `order_body_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_body_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Ограничения внешнего ключа таблицы `product_characteristics`
--
ALTER TABLE `product_characteristics`
  ADD CONSTRAINT `product_characteristics_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_characteristics_ibfk_2` FOREIGN KEY (`characteristic_id`) REFERENCES `characteristics` (`id`);

--
-- Ограничения внешнего ключа таблицы `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
