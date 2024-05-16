-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2024 a las 19:16:00
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pingidev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actions`
--

CREATE TABLE `actions` (
  `id_actions` int(11) NOT NULL,
  `actions_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actions`
--

INSERT INTO `actions` (`id_actions`, `actions_name`) VALUES
(0, 'register'),
(1, 'login'),
(2, 'logout'),
(3, 'fav'),
(4, 'noFav'),
(5, 'order');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorites`
--

CREATE TABLE `favorites` (
  `id_favorites` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `favorites`
--

INSERT INTO `favorites` (`id_favorites`, `id_user`, `id_product`) VALUES
(192, 11, 74),
(193, 6, 74);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id_log` int(11) NOT NULL,
  `log_date` varchar(45) NOT NULL,
  `id_actions` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id_log`, `log_date`, `id_actions`, `id_user`) VALUES
(7, '2024-05-08 18:27:52', 4, 6),
(8, '2024-05-08 18:27:53', 3, 6),
(9, '2024-05-08 18:27:54', 4, 6),
(10, '2024-05-08 18:27:55', 3, 6),
(11, '2024-05-08 21:14:24', 1, 6),
(12, '2024-05-08 21:21:38', 1, 6),
(13, '2024-05-08 21:21:51', 2, 6),
(14, '2024-05-08 21:33:12', 1, 6),
(15, '2024-05-08 21:33:18', 4, 6),
(16, '2024-05-08 21:33:23', 3, 6),
(17, '2024-05-08 21:49:00', 4, 6),
(18, '2024-05-08 21:49:01', 3, 6),
(19, '2024-05-08 21:49:01', 4, 6),
(20, '2024-05-08 21:49:06', 3, 6),
(21, '2024-05-09 10:11:47', 1, 6),
(22, '2024-05-09 12:32:17', 4, 6),
(23, '2024-05-09 12:32:18', 3, 6),
(24, '2024-05-09 12:32:18', 4, 6),
(25, '2024-05-09 12:32:19', 3, 6),
(26, '2024-05-09 12:38:32', 4, 6),
(27, '2024-05-09 12:38:33', 3, 6),
(28, '2024-05-09 18:50:21', 1, 6),
(29, '2024-05-10 09:13:17', 1, 6),
(30, '2024-05-10 09:15:58', 4, 6),
(31, '2024-05-10 09:16:02', 3, 6),
(32, '2024-05-10 09:16:11', 4, 6),
(33, '2024-05-10 10:55:22', 3, 6),
(34, '2024-05-10 10:55:25', 4, 6),
(35, '2024-05-10 10:55:27', 3, 6),
(36, '2024-05-10 10:55:30', 4, 6),
(37, '2024-05-10 11:55:20', 3, 6),
(38, '2024-05-10 11:55:23', 4, 6),
(39, '2024-05-10 11:55:24', 3, 6),
(40, '2024-05-10 12:02:07', 4, 6),
(41, '2024-05-10 12:02:08', 3, 6),
(42, '2024-05-10 13:06:09', 1, 6),
(43, '2024-05-10 16:08:57', 1, 6),
(44, '2024-05-10 16:11:04', 4, 6),
(45, '2024-05-10 16:11:05', 3, 6),
(46, '2024-05-10 16:11:09', 4, 6),
(47, '2024-05-10 16:16:39', 3, 6),
(48, '2024-05-10 16:37:51', 4, 6),
(49, '2024-05-10 16:37:55', 3, 6),
(50, '2024-05-10 16:37:56', 4, 6),
(51, '2024-05-10 16:37:56', 3, 6),
(52, '2024-05-10 16:37:59', 4, 6),
(53, '2024-05-10 16:38:02', 3, 6),
(54, '2024-05-10 16:38:05', 4, 6),
(55, '2024-05-10 16:38:06', 3, 6),
(56, '2024-05-10 16:38:10', 4, 6),
(57, '2024-05-10 16:38:11', 3, 6),
(58, '2024-05-10 16:38:11', 4, 6),
(59, '2024-05-10 16:38:12', 3, 6),
(60, '2024-05-10 16:38:13', 4, 6),
(61, '2024-05-10 16:38:13', 3, 6),
(62, '2024-05-10 16:38:18', 4, 6),
(63, '2024-05-10 16:38:18', 3, 6),
(64, '2024-05-10 16:38:19', 4, 6),
(65, '2024-05-10 16:38:19', 3, 6),
(66, '2024-05-10 16:38:23', 4, 6),
(67, '2024-05-10 16:38:24', 3, 6),
(68, '2024-05-10 16:38:24', 4, 6),
(69, '2024-05-10 16:38:29', 3, 6),
(70, '2024-05-10 17:03:22', 4, 6),
(71, '2024-05-10 17:03:24', 3, 6),
(72, '2024-05-10 17:03:25', 4, 6),
(73, '2024-05-10 17:03:25', 3, 6),
(74, '2024-05-10 17:03:26', 4, 6),
(75, '2024-05-10 17:03:26', 3, 6),
(76, '2024-05-10 17:03:27', 4, 6),
(77, '2024-05-10 17:03:28', 3, 6),
(78, '2024-05-10 17:05:38', 4, 6),
(79, '2024-05-10 17:05:44', 3, 6),
(80, '2024-05-13 09:26:37', 1, 6),
(81, '2024-05-13 12:12:55', 2, 6),
(82, '2024-05-13 12:32:59', 1, 6),
(83, '2024-05-13 12:39:40', 2, 6),
(84, '2024-05-13 12:39:57', 1, 11),
(85, '2024-05-13 16:17:49', 1, 6),
(86, '2024-05-13 18:46:15', 2, 6),
(87, '2024-05-13 18:46:26', 1, 11),
(88, '2024-05-13 18:50:34', 2, 11),
(89, '2024-05-13 18:50:47', 1, 6),
(90, '2024-05-13 18:51:03', 2, 6),
(91, '2024-05-13 18:51:10', 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `order_description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `order`
--

INSERT INTO `order` (`id_order`, `id_user`, `id_product`, `order_description`) VALUES
(1, 6, 73, 'asdfadf'),
(2, 6, 73, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(1000) DEFAULT NULL,
  `img_folder` varchar(45) NOT NULL,
  `img_extension` varchar(5) NOT NULL DEFAULT 'jpg',
  `img_carousel_length` int(11) NOT NULL DEFAULT 1,
  `product_ban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id_product`, `product_name`, `product_description`, `img_folder`, `img_extension`, `img_carousel_length`, `product_ban`) VALUES
(73, 'Test Web', 'Web to do a test', 'imgs/Product/Test Web', 'jpg', 1, 0),
(74, 'Product Prueba', 'Prueba web', 'imgs/Product/Product Prueba', 'jpg', 1, 0),
(75, 'Prueba 1', 'Prueba web', 'imgs/Product/Prueba 1', 'jpg', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL DEFAULT 1,
  `rol_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol_name`) VALUES
(0, 'admin'),
(1, 'defaultUser');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `email` varchar(45) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `user_ban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `pass`, `email`, `id_rol`, `user_ban`) VALUES
(6, 'jpingil', '$2y$10$QnIlDJdDkT/W0EA/4DzFsOaEAPrS3HOB.YgHI7q2Jtpv4y2NHnu1m', 'jorgepinogil013@gmail.com', 0, 0),
(11, 'jorgeprueba', '$2y$10$Y9m5ZJKS.8CsUz9RaaCdt.JYTFKBz2MaQVm.UNgexWPs0/sY.LBmK', 'jorge@a.com', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id_actions`);

--
-- Indices de la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id_favorites`),
  ADD KEY `fk_users_has_products_products1_idx` (`id_product`),
  ADD KEY `fk_users_has_products_users1_idx` (`id_user`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `fk_Actions_has_User_User1_idx` (`id_user`),
  ADD KEY `fk_Actions_has_User_Actions1_idx` (`id_actions`);

--
-- Indices de la tabla `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `fk_user_has_product_product1_idx` (`id_product`),
  ADD KEY `fk_user_has_product_user1_idx` (`id_user`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_users_rol_idx` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id_favorites` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `fk_users_has_products_products1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_products_users1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_Actions_has_User_Actions1` FOREIGN KEY (`id_actions`) REFERENCES `actions` (`id_actions`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Actions_has_User_User1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_user_has_product_product1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_product_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_users_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
