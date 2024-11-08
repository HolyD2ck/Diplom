-- Таблица категорий
CREATE TABLE IF NOT EXISTS `Категории` (
    `id` int AUTO_INCREMENT NOT NULL UNIQUE,
    `Название` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
);

-- Таблица товаров
CREATE TABLE IF NOT EXISTS `Товары` (
    `id` int AUTO_INCREMENT NOT NULL UNIQUE,
    `Категория` int NOT NULL,
    `Название` varchar(255) NOT NULL,
    `Описание` text NOT NULL,
    `Производитель` varchar(100) NOT NULL,
    `Цена` decimal(10,2) NOT NULL,
    `Дата_выпуска` date NOT NULL,
    `Дата_поступления_в_продажу` date NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`Категория`) REFERENCES `Категории`(`id`) ON DELETE CASCADE
);

-- Таблица фотографий
CREATE TABLE IF NOT EXISTS `Фотографии` (
    `id` int AUTO_INCREMENT NOT NULL UNIQUE,
    `Фото` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
);

-- Промежуточная таблица для связи товаров и фотографий (многие ко многим)
CREATE TABLE IF NOT EXISTS `Товар_Фотографии` (
    `tovar_id` int NOT NULL,
    `photo_id` int NOT NULL,
    PRIMARY KEY (`tovar_id`, `photo_id`),
    FOREIGN KEY (`tovar_id`) REFERENCES `Товары`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`photo_id`) REFERENCES `Фотографии`(`id`) ON DELETE CASCADE
);

-- Таблица параметров
CREATE TABLE IF NOT EXISTS `Параметры` (
    `id` int AUTO_INCREMENT NOT NULL UNIQUE,
    `Название` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
);

-- Таблица значений параметров для товаров
CREATE TABLE IF NOT EXISTS `Значения` (
    `id` int AUTO_INCREMENT NOT NULL UNIQUE,
    `tovar_id` int NOT NULL,
    `attribute_id` int NOT NULL,
    `Значение` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`tovar_id`) REFERENCES `Товары`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`attribute_id`) REFERENCES `Параметры`(`id`) ON DELETE CASCADE
);

-- Таблица пользователей
CREATE TABLE IF NOT EXISTS `Пользователи` (
    `id` int AUTO_INCREMENT NOT NULL UNIQUE,
    `Имя` varchar(100) NOT NULL,
    `Электронная_почта` varchar(100) NOT NULL UNIQUE,
    `Пароль` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
);

-- Таблица адресов
CREATE TABLE IF NOT EXISTS `Адреса` (
    `id` int AUTO_INCREMENT NOT NULL UNIQUE,
    `Улица` varchar(100) NOT NULL,
    `Город` varchar(100) NOT NULL,
    `Область` varchar(100) NOT NULL,
    `Почтовый_Индекс` varchar(20) NOT NULL,
    `Страна` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
);

-- Промежуточная таблица для связи пользователей и адресов (если пользователю может принадлежать несколько адресов)
CREATE TABLE IF NOT EXISTS `Пользователь_Адрес` (
    `user_id` int NOT NULL,
    `address_id` int NOT NULL,
    PRIMARY KEY (`user_id`, `address_id`),
    FOREIGN KEY (`user_id`) REFERENCES `Пользователи`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`address_id`) REFERENCES `Адреса`(`id`) ON DELETE CASCADE
);

-- Таблица заказов
CREATE TABLE IF NOT EXISTS `Заказы` (
    `id` int AUTO_INCREMENT NOT NULL UNIQUE,
    `user_id` int NOT NULL,
    `Итоговая_цена` decimal(10,2) NOT NULL,
    `Статус` ENUM('Оплачено', 'В обработке', 'Доставлено', 'Отменено') NOT NULL DEFAULT 'Оплачено',
    `Адрес_Доставки` int,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `Пользователи`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`Адрес_Доставки`) REFERENCES `Адреса`(`id`) ON DELETE SET NULL
);

-- Таблица деталей заказа
CREATE TABLE IF NOT EXISTS `Детали_Заказа` (
    `id` int AUTO_INCREMENT NOT NULL UNIQUE,
    `order_id` int NOT NULL,
    `tovar_id` int NOT NULL,
    `Количество` int NOT NULL,
    `Цена` decimal(10,2) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`order_id`) REFERENCES `Заказы`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`tovar_id`) REFERENCES `Товары`(`id`) ON DELETE CASCADE
);
