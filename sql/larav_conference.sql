-- --------------------------------------------------------
-- Хост:                         192.168.10.251
-- Версия сервера:               5.6.27 - MySQL Community Server (GPL)
-- ОС Сервера:                   Linux
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица larav_conferen.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы larav_conferen.migrations: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2016_04_21_113152_create_users_table', 1),
	('2016_04_21_131602_add_to_users_table', 2),
	('2016_04_25_081508_add_field_to_users_table', 3),
	('2016_04_25_135513_create_permission_tables', 4),
	('2016_04_26_123155_create_new_users_table', 5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Дамп структуры для таблица larav_conferen.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы larav_conferen.permissions: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Дамп структуры для таблица larav_conferen.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы larav_conferen.roles: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2016-04-26 09:47:24', '2016-04-26 09:47:24');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Дамп структуры для таблица larav_conferen.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы larav_conferen.role_has_permissions: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;


-- Дамп структуры для таблица larav_conferen.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `birthday` date NOT NULL,
  `report_subj` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_hidden` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы larav_conferen.user: ~12 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `fname`, `sname`, `email`, `created_at`, `updated_at`, `birthday`, `report_subj`, `country`, `phone`, `company`, `position`, `about_me`, `photo`, `user_hidden`) VALUES
	(1, 'Petya', 'Volkov', 'sadasdas@gmail.com', NULL, NULL, '1980-01-02', 'My Life', 'Australia', '+3 (048) 568-2367', 'BWT', NULL, '', '5706426241f78.jpg', 0),
	(2, 'max', 'bgf', 'maxgol76@gmail.com', NULL, NULL, '1990-02-12', 'sds', 'Cameroon', '+1 (312) 312-3123', 'BWT', NULL, '', NULL, 0),
	(5, 'sadasd', 'asdasd', 'max3434gol76@gmail.com', NULL, NULL, '2016-04-04', 'adsd', 'Cameroon', '+1 (123) 213-2132', NULL, NULL, '', NULL, 1),
	(6, 's', 'dsfdf', 'maxg22ol76@gmail.com', NULL, NULL, '2016-04-11', 'dfd', 'Angola', '+1 (123) 213-2131', NULL, NULL, '', NULL, 1),
	(7, 'sd', 'sd', 'maxewewgol76@gmail.com', NULL, NULL, '2016-04-18', 'dd', 'Argentina', '+1 (211) 231-2323', NULL, NULL, '', NULL, 0),
	(8, 'sd', 'ds', 'to23232lik89@gmail.com', NULL, NULL, '2016-04-25', 'Drons', 'Cambodia', '+1 (312) 312-3213', NULL, NULL, '', NULL, 1),
	(9, 'вова', 'борисов', 'maxgolweewwt76@gmail.com', NULL, NULL, '2016-04-11', 'ssd', 'Argentina', '+1 (223) 232-3232', 'Робот', '', '', '571dcddf2434c.jpg', 0),
	(10, 'sdsd', 'sds', 'maqwqwxgol76@gmail.com', NULL, NULL, '2016-04-04', 'sds', 'Angola', '+1 (112) 321-3213', '', '', '', '571f1dbee3328.jpg', 0),
	(11, 's', 's', 'maxg2ol76@gmail.com', NULL, NULL, '2016-04-11', 'Drons', 'Angola', '+1 (321) 312-3123', NULL, NULL, '', NULL, 0),
	(12, 'a', 'a', 'maasasaxgol76@gmail.com', NULL, NULL, '2016-04-18', 'd', 'Cameroon', '+1 (211) 232-1312', NULL, NULL, '', NULL, 1),
	(13, 's', 's', 'max32434gol76@gmail.com', NULL, NULL, '2016-04-11', 'Drons', 'Cameroon', '+1 (312) 331-2332', '', '', '', '571f260615e00.jpg', 0),
	(14, 's', 's', 'maxg3ol76@gmail.com', NULL, NULL, '2016-04-25', 'Life', 'Cameroon', '+1 (213) 213-1232', NULL, NULL, '', NULL, 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Дамп структуры для таблица larav_conferen.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы larav_conferen.users: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `remember_token`) VALUES
	(1, 'admin', 'admin@gmail.com', '123456', NULL, NULL, NULL),
	(2, 'admin', 'admin@admin.com', '$2y$10$/Z2Yg0ai19VbKdxySR1IDOnh2Sa2fPNVILHpxTFrs2YTJF3TzlJDW', '2016-04-26 09:47:24', '2016-04-27 13:09:54', 'jvLPohmuk483Bx9s6feMPRzQtzJIi4XnJr1EAqb4q8iEjjDqQppY8mKFGFSz');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Дамп структуры для таблица larav_conferen.user_has_permissions
CREATE TABLE IF NOT EXISTS `user_has_permissions` (
  `user_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `user_has_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `user_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_has_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы larav_conferen.user_has_permissions: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_has_permissions` ENABLE KEYS */;


-- Дамп структуры для таблица larav_conferen.user_has_roles
CREATE TABLE IF NOT EXISTS `user_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `user_has_roles_user_id_foreign` (`user_id`),
  CONSTRAINT `user_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_has_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы larav_conferen.user_has_roles: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `user_has_roles` DISABLE KEYS */;
INSERT INTO `user_has_roles` (`role_id`, `user_id`) VALUES
	(1, 2);
/*!40000 ALTER TABLE `user_has_roles` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
