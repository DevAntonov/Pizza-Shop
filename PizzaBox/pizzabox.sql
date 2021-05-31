-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 31 май 2021 в 11:20
-- Версия на сървъра: 10.4.18-MariaDB
-- Версия на PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `pizzabox`
--

-- --------------------------------------------------------

--
-- Структура на таблица `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `password`) VALUES
(1, 'admin', 'pizzabox');

-- --------------------------------------------------------

--
-- Структура на таблица `category`
--

CREATE TABLE `category` (
  `cid` int(10) UNSIGNED NOT NULL,
  `ctg_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `category`
--

INSERT INTO `category` (`cid`, `ctg_name`) VALUES
(5, 'Pizza'),
(6, 'Pasta'),
(7, 'Soft drink');

-- --------------------------------------------------------

--
-- Структура на таблица `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `address`) VALUES
(2, 'John', 'Doe', 'john@doe.com', '$2y$10$.s7ie.1gx.Lim96hHCZKme9aS8CzTcGm15XQNDzkE3D2I3aRVYl2.', '0891011121', 'Sofia ul. bezimenna 1'),
(3, 'Tony', 'Tonov', 'tony@aab.bg', '$2y$10$HW1DaVsVShSuTyw.QnC0e.Hkr6Btf6QmZohZU2H3C.wrRqHD1Wvqu', '0891233210', 'Sofia ul. 333 A 6');

-- --------------------------------------------------------

--
-- Структура на таблица `deliveryman`
--

CREATE TABLE `deliveryman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `deliveryman`
--

INSERT INTO `deliveryman` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`) VALUES
(1, 'Johnny', 'Elenkov', 'johnny@doe.com', 'pizzabox', '0123456789');

-- --------------------------------------------------------

--
-- Структура на таблица `menu_item`
--

CREATE TABLE `menu_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `menu_item`
--

INSERT INTO `menu_item` (`id`, `category_id`, `name`, `image`, `description`, `price`) VALUES
(44, 5, 'Margarita', 'margarita-pizza.jpg', 'Mozarella', '5.00'),
(45, 5, 'Margarita Cheddar', 'margarita-chedar.jpg', 'Chedar', '5.50'),
(46, 6, 'Carbonara', 'spageti-karbonara-rimski.jpg', 'Mozarella, Prague', '8.00'),
(47, 7, 'Coca cola', 'cocacolacan.jpg', 'NoAlco', '3.00'),
(48, 5, 'Duo Cheese Margarita', 'pizzatop.jpg', 'Chedar, Mozarella', '7.20');

-- --------------------------------------------------------

--
-- Структура на таблица `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer` bigint(20) UNSIGNED NOT NULL,
  `deliveryman_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` float(10,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `orders`
--

INSERT INTO `orders` (`id`, `customer`, `deliveryman_id`, `status`, `order_date`, `total`) VALUES
(1, 2, 0, 'Finished', '2021-05-30 23:33:11', 21.50),
(2, 3, 0, 'Finished', '2021-05-31 02:20:41', 10.50),
(3, 2, 0, 'Pending', '2021-05-30 22:05:35', 16.50),
(4, 3, 0, 'Pending', '2021-05-31 02:20:54', 18.00),
(5, 2, 0, 'Pending', '2021-05-30 23:16:32', 5.00),
(6, 3, 0, 'Pending', '2021-05-31 02:20:49', 15.70),
(7, 3, 0, 'Pending', '2021-05-31 05:49:53', 5.50),
(8, 3, 0, 'Pending', '2021-05-31 06:16:23', 28.70);

-- --------------------------------------------------------

--
-- Структура на таблица `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_item` int(10) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `specific_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `order_details`
--

INSERT INTO `order_details` (`id`, `menu_item`, `order_id`, `quantity`, `specific_description`) VALUES
(1, 47, 1, 1, NULL),
(2, 46, 1, 1, NULL),
(3, 45, 1, 1, NULL),
(4, 44, 1, 1, NULL),
(5, 45, 2, 1, NULL),
(6, 44, 2, 1, NULL),
(7, 45, 3, 3, NULL),
(8, 46, 4, 1, NULL),
(9, 44, 4, 2, NULL),
(10, 44, 5, 1, NULL),
(11, 47, 6, 1, NULL),
(12, 45, 6, 1, NULL),
(13, 48, 6, 1, NULL),
(14, 45, 7, 1, NULL),
(15, 47, 8, 1, NULL),
(16, 46, 8, 1, NULL),
(17, 44, 8, 1, NULL),
(18, 48, 8, 1, NULL),
(19, 45, 8, 1, NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `product_item`
--

CREATE TABLE `product_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `product_item`
--

INSERT INTO `product_item` (`id`, `type_name`, `name`) VALUES
(24, 'Cheese', 'Chedar'),
(25, 'Cheese', 'Mozarella'),
(26, 'Ham', 'Prague'),
(27, 'Alcohol', 'NoAlco');

-- --------------------------------------------------------

--
-- Структура на таблица `product_type`
--

CREATE TABLE `product_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `product_type`
--

INSERT INTO `product_type` (`id`, `name`) VALUES
(11, 'Alcohol'),
(8, 'Cheese'),
(9, 'Ham');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Индекси за таблица `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `deliveryman`
--
ALTER TABLE `deliveryman`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_item_category` (`category_id`);

--
-- Индекси за таблица `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_details_customer` (`customer`);

--
-- Индекси за таблица `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_item_menu_item` (`menu_item`),
  ADD KEY `order_id` (`order_id`);

--
-- Индекси за таблица `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_item_product_type` (`type_name`);

--
-- Индекси за таблица `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_product_type_name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deliveryman`
--
ALTER TABLE `deliveryman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_item`
--
ALTER TABLE `product_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `menu_item`
--
ALTER TABLE `menu_item`
  ADD CONSTRAINT `fk_menu_item_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения за таблица `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_details_customer` FOREIGN KEY (`customer`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения за таблица `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_item_menu_item` FOREIGN KEY (`menu_item`) REFERENCES `menu_item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Ограничения за таблица `product_item`
--
ALTER TABLE `product_item`
  ADD CONSTRAINT `fk_product_item_product_type` FOREIGN KEY (`type_name`) REFERENCES `product_type` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
