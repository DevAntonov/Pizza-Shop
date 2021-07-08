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
(3, 'Pasta'),
(4, 'Pizza'),
(6, 'Beverage');

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
(36, 4, 'Pepperoni', 'pepperonicls.png', 'Mozzarella, Pepperoni', '16.50'),
(37, 4, 'Chicken', 'chickenpizza.png', 'Cheddar, Chicken, Tomato, Peppers', '14.20'),
(38, 4, 'Margherita', 'margarita.png', 'Mozzarella', '10.00'),
(39, 4, 'Cheese Much', 'another.png', 'Mozzarella, Bacon, Beef, Chicken, Onions', '18.60'),
(40, 4, 'Pepperoni Hot', 'pepperonihot.png', 'Mozzarella, Pepperoni, Mushrooms, Olives, Jalapeno', '18.50'),
(41, 4, 'Garden', 'olive.png', 'Mozzarella, Gorgonzola, Ham, Mushrooms, Corn, Olives, Onions, Peppers', '19.20'),
(42, 3, 'Bolognese', 'bolognese.png', 'Cheddar, Mozzarella, Beef, Peppers, Tomato, Onions', '15.90'),
(43, 3, 'Alfredo', 'macncheese.png', 'Mozzarella, Gouda, Chicken', '14.50'),
(44, 6, 'Cola', 'cola.png', 'Non alcoholic', '2.20'),
(45, 6, 'Pale Ale', 'paleale.png', 'Alcoholic, Malt', '4.50');


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
(1, 'Cheese', 'Cheddar'),
(2, 'Cheese', 'Mozzarella'),
(3, 'Cheese', 'Gouda'),
(8, 'Vegetables', 'Onions'),
(9, 'Meat', 'Pepperoni'),
(10, 'Vegetables', 'Olives'),
(11, 'Vegetables', 'Corn'),
(12, 'Vegetables', 'Mushrooms'),
(13, 'Meat', 'Chicken'),
(14, 'Meat', 'Ham'),
(15, 'Meat', 'Beef'),
(16, 'Meat', 'Bacon'),
(17, 'Cheese', 'Gorgonzola'),
(18, 'Vegetables', 'Tomato'),
(19, 'Vegetables', 'Peppers'),
(20, 'Vegetables', 'Jalapeno'),
(21, 'Alchohol', 'Malt'),
(22, 'Alchohol', 'Hops'),
(23, 'Alchohol', 'Yeast'),
(24, 'Alchohol', 'Non alcoholic'),
(25, 'Alchohol', 'Alcoholic');

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
(7, 'Alchohol'),
(1, 'Cheese'),
(6, 'Meat'),
(5, 'Vegetables');
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
