-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 10 юли 2021 в 09:18
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
-- База данни: `test`
--

-- --------------------------------------------------------

--
-- Структура на таблица `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `cid` bigint(20) NOT NULL,
  `ctg_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `category`
--

INSERT INTO `category` (`cid`, `ctg_name`) VALUES
(1, 'Pizza'),
(2, 'Pasta'),
(3, 'Beverage');

-- --------------------------------------------------------

--
-- Структура на таблица `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `address`) VALUES
(2, 'John', 'Doe', 'john@doe.com', '$2y$10$gBleslbvXK3syYl3jRqu6.S6Zlc/x7o1z9AJAv4LjU9YJHbBBQ4tu', '0388942327', 'Sofia Street 404');

-- --------------------------------------------------------

--
-- Структура на таблица `delivery_details`
--

CREATE TABLE `delivery_details` (
  `delivery_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `delivery_man_id` bigint(20) DEFAULT NULL,
  `date` datetime NOT NULL,
  `status` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `delivery_details`
--

INSERT INTO `delivery_details` (`delivery_id`, `customer_id`, `delivery_man_id`, `date`, `status`) VALUES
(1, 2, 9, '2021-07-10 04:47:07', 'Pending');

-- --------------------------------------------------------

--
-- Структура на таблица `delivery_man`
--

CREATE TABLE `delivery_man` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `delivery_man`
--

INSERT INTO `delivery_man` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(9, 'Johnny', 'Doe', 'johnny@doe.com', '1234');

-- --------------------------------------------------------

--
-- Структура на таблица `menu_item`
--

CREATE TABLE `menu_item` (
  `id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `menu_item`
--

INSERT INTO `menu_item` (`id`, `category_id`, `name`, `image`, `description`, `price`) VALUES
(1, 1, 'Pepperoni Classic', 'pepperonicls.png', 'Mozzarella, Pepperoni', '16.50'),
(2, 1, 'Meat Mix', 'chickenpizza.png', 'Mozzarella, Beef, Chicken, Onions', '18.40'),
(3, 1, 'Garden', 'olive.png', 'Mozzarella, Bacon, Mushrooms, Peppers, Olives', '15.60'),
(4, 1, 'Pepperoni Hot', 'pepperonihot.png', 'Mozzarella, Pepperoni, Mushrooms, Jalapeno', '17.60'),
(5, 2, 'Bolognese', 'bolognese.png', 'Mozzarella, Cheddar, Beef, Onions, Tomato, Peppers', '16.80'),
(6, 2, 'Alfredo', 'alfredo.png', 'Mozzarella, Chicken, Peppers', '15.90'),
(7, 1, 'Margherita', 'margarita.png', 'Mozzarella', '14.20'),
(8, 1, 'Basic', 'another.png', 'Mozzarella, Beef, Onions, Tomato', '16.10'),
(9, 3, 'Cola', 'cola.png', 'Non Alcoholic', '2.20'),
(10, 3, 'Pale Ale', 'paleale.png', 'Alcoholic', '4.50');

-- --------------------------------------------------------

--
-- Структура на таблица `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) NOT NULL,
  `delivery_details_id` bigint(20) DEFAULT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `supplements` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `order_details`
--

INSERT INTO `order_details` (`id`, `delivery_details_id`, `item_name`, `description`, `supplements`, `quantity`, `total`) VALUES
(1, 1, 'Pepperoni Hot', 'Mozzarella, Pepperoni, Mushrooms, Jalapeno', '', 1, '17.60'),
(2, 1, 'Garden', 'Mozzarella, Bacon, Mushrooms, Peppers, Olives', '', 2, '31.20'),
(3, 1, 'Basic', 'Mozzarella, Beef, Onions, Tomato', '', 1, '16.10');

-- --------------------------------------------------------

--
-- Структура на таблица `product_item`
--

CREATE TABLE `product_item` (
  `id` bigint(20) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `product_item`
--

INSERT INTO `product_item` (`id`, `type_name`, `name`) VALUES
(1, 'Cheese', 'Mozzarella'),
(2, 'Cheese', 'Cheddar'),
(3, 'Meat', 'Pepperoni'),
(4, 'Meat', 'Bacon'),
(5, 'Meat', 'Beef'),
(6, 'Vegetables', 'Onions'),
(7, 'Vegetables', 'Mushrooms'),
(8, 'Meat', 'Chicken'),
(9, 'Vegetables', 'Tomato'),
(10, 'Vegetables', 'Jalapeno'),
(11, 'Alcohol', 'Alcoholic'),
(12, 'Alcohol', 'Non Alcoholic'),
(13, 'Vegetables', 'Peppers'),
(14, 'Vegetables', 'Olives');

-- --------------------------------------------------------

--
-- Структура на таблица `product_type`
--

CREATE TABLE `product_type` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `product_type`
--

INSERT INTO `product_type` (`id`, `name`) VALUES
(4, 'Alcohol'),
(1, 'Cheese'),
(3, 'Meat'),
(2, 'Vegetables');

-- --------------------------------------------------------

--
-- Структура на таблица `supplement`
--

CREATE TABLE `supplement` (
  `supplement_id` bigint(20) NOT NULL,
  `supplement_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `supplement`
--

INSERT INTO `supplement` (`supplement_id`, `supplement_name`) VALUES
(2, 'Extra Mozzarella'),
(3, 'Extra Chicken');

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
-- Индекси за таблица `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `delivery_details_fk1` (`customer_id`),
  ADD KEY `delivery_details_fk2` (`delivery_man_id`);

--
-- Индекси за таблица `delivery_man`
--
ALTER TABLE `delivery_man`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_item_fk0` (`category_id`);

--
-- Индекси за таблица `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_details_delivery_details` (`delivery_details_id`);

--
-- Индекси за таблица `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_item_fk0` (`type_name`);

--
-- Индекси за таблица `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индекси за таблица `supplement`
--
ALTER TABLE `supplement`
  ADD PRIMARY KEY (`supplement_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `delivery_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_man`
--
ALTER TABLE `delivery_man`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_item`
--
ALTER TABLE `product_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplement`
--
ALTER TABLE `supplement`
  MODIFY `supplement_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD CONSTRAINT `delivery_details_fk1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `delivery_details_fk2` FOREIGN KEY (`delivery_man_id`) REFERENCES `delivery_man` (`id`);

--
-- Ограничения за таблица `menu_item`
--
ALTER TABLE `menu_item`
  ADD CONSTRAINT `menu_item_fk0` FOREIGN KEY (`category_id`) REFERENCES `category` (`cid`);

--
-- Ограничения за таблица `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_details_delivery_details` FOREIGN KEY (`delivery_details_id`) REFERENCES `delivery_details` (`delivery_id`);

--
-- Ограничения за таблица `product_item`
--
ALTER TABLE `product_item`
  ADD CONSTRAINT `product_item_fk0` FOREIGN KEY (`type_name`) REFERENCES `product_type` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
