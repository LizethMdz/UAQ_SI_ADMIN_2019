-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2019 a las 06:49:07
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vegetales_carrito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'Bebidas'),
(1, 'Ensaladas'),
(3, 'Fruta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(1, 'ensalada_uvas_lec.jpg', 'image/jpeg'),
(2, 'ensalada_griega.jpg', 'image/jpeg'),
(3, 'ensalada_de_papas.jpg', 'image/jpeg'),
(4, 'Batido_nutritivo_de_chocolate.jpg', 'image/jpeg'),
(5, 'Granizado_de_sandia.JPG', 'image/jpeg'),
(6, 'Pancakes_de_arandano.JPG', 'image/jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`) VALUES
(1, 'Ensalada de Uvas y lechuga', '20', '20.00', '23.00', 1, 1, '2019-04-16 07:03:16'),
(2, 'Ensalada Griega', '13', '23.50', '25.50', 1, 2, '2019-04-18 18:03:06'),
(3, 'ensalada de papas', '18', '20.00', '45.00', 1, 3, '2019-04-23 22:56:15'),
(4, 'batido de chocolate', '5', '20.00', '35.00', 2, 4, '2019-05-12 01:02:40'),
(5, 'Granizado de sandia', '20', '25.00', '40.00', 2, 5, '2019-05-12 07:03:31'),
(6, 'Pancakes de arandano', '35', '20.00', '50.00', 3, 6, '2019-05-16 02:25:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL,
  `status` int(10) NOT NULL,
  `direccion` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `qty`, `price`, `date`, `status`, `direccion`) VALUES
(1, 1, 1, '20.00', '2019-04-09', 1, 'Col. Sauces, Camino Real #23 Juan Chavez 4427856249'),
(2, 2, 1, '25.50', '2019-04-11', 0, 'Col. Pradera, Bosque Verde #485 Santiago Fonceca 4427896347'),
(3, 1, 1, '23.00', '2019-05-15', 0, 'Col. Satelite, Saturno #212 Leticia Perez 4433724658'),
(10, 2, 1, '25.50', '2019-05-15', 0, 'Col. Zibatá, Romero #5464 Hugo Sanchez 44297956'),
(14, 2, 1, '25.50', '2019-05-15', 1, 'Col. Pueblito, Hidalgo #4533 Oscar Reyes 4423988791 '),
(15, 3, 1, '45.00', '2019-05-15', 1, 'Col. Casa Blanca, Laguna #6532 Rebeca Cabrera 442453543'),
(17, 2, 1, '25.50', '2019-05-22', 0, 'Col. Buena Vista, Piedra #2342 Victor Dominguez 42452452'),
(19, 4, 1, '35.00', '2019-05-22', 0, 'Col. Pradera, Dinamarca #513 Paola Juarez 31231'),
(20, 1, 1, '23.00', '2019-05-22', 0, 'Col. Alamos, Monte Real #121 Juan Benitez 5453231'),
(21, 6, 1, '50.00', '2019-05-22', 0, 'Col. Reforma, Cascada #1254 Elisabeth Lopez 21654987 '),
(22, 2, 1, '25.50', '2019-05-23', 0, 'Col. Centro. Juarez  #67, Elias Martinez 7897954'),
(23, 3, 1, '45.00', '2019-05-23', 0, 'Col. Jardinez de la hacienda, Paraiso #45232 Fernanda Lopez 4423654879'),
(24, 5, 1, '40.00', '2019-05-23', 0, 'Col. Francisquito, Cardenas #146 Irene Ortiz 4421231232'),
(25, 6, 1, '50.00', '2019-05-23', 0, 'Col. Cerrito, Diamante #2131 Benito Salazar 4422558798');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Pablo Martinez', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'sggateg71.png', 1, '2019-05-22 17:23:12'),
(2, 'Sandra Ortega', 'sanort', '404bd1aa4853fcee57ddae69106cedebb952f559', 2, 'no_image.jpg', 1, '2019-05-23 04:11:54'),
(4, 'ernesto', 'ernesto', '4ed0b4bd164d55cb658b6619f27f41bb1c3603ca', 1, 'no_image.jpg', 1, '2019-05-16 00:36:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'Default', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_level` (`user_level`);

--
-- Indices de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
