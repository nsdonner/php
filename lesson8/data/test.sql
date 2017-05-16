-- --------------------------------------------------------
-- Хост:                         172.19.55.38
-- Версия сервера:               5.6.23 - MySQL Community Server (GPL)
-- ОС Сервера:                   Linux
-- HeidiSQL Версия:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Дамп данных таблицы test.basket: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `basket` DISABLE KEYS */;
INSERT INTO `basket` (`id_basket`, `id_user`, `id_good`, `price`, `is_in_order`, `id_order`) VALUES
	(2, 1, 1, 1000, 1, 5);
/*!40000 ALTER TABLE `basket` ENABLE KEYS */;

-- Дамп данных таблицы test.feedback: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` (`id_feedback`, `feedback_body`, `feedback_user`) VALUES
	(1, 'Тест', 'Тестовый отзыв'),
	(3, '13123123', '1123123');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;

-- Дамп данных таблицы test.goods: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` (`id_good`, `good_name`, `good_description`, `good_price`, `is_active`) VALUES
	(1, 'Клавиатура Razor', 'Крутая клавиатура', 1000, 1);
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;

-- Дамп данных таблицы test.news: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id_news`, `news_title`, `news_preview`, `news_content`, `datetime_create`, `datetime_update`) VALUES
	(1, 'Test', 'Test', 'Test', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, '123', '123', '123', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- Дамп данных таблицы test.order: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` (`id_order`, `id_user`, `amount`, `datetime_create`, `id_order_status`) VALUES
	(2, 1, 1000, '2016-09-22 10:21:21', 1),
	(3, 1, 1000, '2016-09-22 10:22:34', 1),
	(4, 1, 1000, '2016-09-22 10:23:17', 1),
	(5, 1, 1000, '2016-09-22 10:23:57', 1);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;

-- Дамп данных таблицы test.order_status: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
INSERT INTO `order_status` (`id_order_status`, `order_status_name`) VALUES
	(1, 'Новый'),
	(2, 'Принят'),
	(3, 'Выполнен'),
	(4, 'Отменён');
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;

-- Дамп данных таблицы test.role: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id_role`, `role_name`) VALUES
	(1, 'Админ'),
	(2, 'Пользователь');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Дамп данных таблицы test.user: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `user_name`, `user_login`, `user_password`, `user_last_action`) VALUES
	(1, 'admin', 'admin', '$2a$08$ZDYxOGU5ODA0YTk3M2Y1YugWWmWSZ0TTigwlFqe7TePdk6KanN5WS', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Дамп данных таблицы test.user_role: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`id_user_role`, `id_user`, `id_role`) VALUES
	(1, 1, 1);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
