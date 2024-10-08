-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-09-2024 a las 14:05:07
-- Versión del servidor: 10.6.7-MariaDB-2ubuntu1.1
-- Versión de PHP: 8.1.9

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
  `id_action` int(11) NOT NULL,
  `action_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actions`
--

INSERT INTO `actions` (`id_action`, `action_name`) VALUES
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id_log` int(11) NOT NULL,
  `log_date` varchar(45) NOT NULL,
  `id_action` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id_log`, `log_date`, `id_action`, `id_user`) VALUES
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
(91, '2024-05-13 18:51:10', 1, 6),
(92, '2024-05-13 19:22:50', 2, 6),
(93, '2024-05-14 17:57:39', 1, 6),
(94, '2024-05-15 17:56:33', 1, 6),
(95, '2024-05-15 18:53:28', 2, 6),
(96, '2024-05-15 18:53:58', 1, 6),
(97, '2024-05-15 18:54:11', 2, 6),
(98, '2024-05-15 18:54:29', 1, 6),
(99, '2024-05-15 18:55:11', 2, 6),
(100, '2024-05-24 18:40:55', 5, 6),
(101, '2024-05-24 18:47:21', 5, 6),
(102, '2024-05-24 18:58:50', 1, 6),
(103, '2024-05-27 11:25:24', 1, 6),
(104, '2024-05-27 11:25:53', 2, 6),
(105, '2024-05-27 16:14:18', 1, 6),
(106, '2024-05-27 16:14:33', 2, 6),
(107, '2024-05-27 16:14:40', 1, 6),
(108, '2024-05-27 16:18:46', 2, 6),
(109, '2024-05-27 18:28:55', 1, 6),
(110, '2024-05-27 18:34:57', 2, 6),
(111, '2024-05-27 18:35:04', 1, 11),
(112, '2024-05-28 09:31:25', 1, 6),
(113, '2024-05-28 16:18:08', 1, 6),
(114, '2024-05-28 16:19:32', 3, 6),
(115, '2024-05-28 16:19:33', 4, 6),
(116, '2024-05-28 16:19:34', 4, 6),
(117, '2024-05-28 16:19:36', 3, 6),
(118, '2024-05-29 09:06:19', 1, 6),
(119, '2024-05-29 09:06:30', 4, 6),
(120, '2024-05-29 09:06:31', 3, 6),
(121, '2024-05-29 10:48:10', 1, 6),
(122, '2024-05-29 11:04:36', 3, 6),
(123, '2024-05-29 11:04:37', 3, 6),
(124, '2024-05-29 11:04:39', 3, 6),
(125, '2024-05-29 11:26:15', 2, 6),
(126, '2024-05-29 11:27:05', 0, 12),
(127, '2024-05-29 11:27:09', 2, 12),
(128, '2024-05-29 11:27:14', 1, 6),
(129, '2024-05-29 16:34:09', 1, 6),
(130, '2024-05-29 17:48:30', 1, 6),
(131, '2024-05-29 18:45:28', 3, 6),
(132, '2024-05-29 18:45:29', 3, 6),
(133, '2024-05-29 18:45:30', 3, 6),
(134, '2024-05-29 18:45:34', 4, 6),
(135, '2024-05-29 18:45:35', 4, 6),
(136, '2024-05-29 18:45:36', 4, 6),
(137, '2024-05-29 18:45:37', 4, 6),
(138, '2024-05-30 09:27:09', 1, 6),
(139, '2024-05-30 11:10:19', 1, 6),
(140, '2024-05-30 12:18:53', 1, 6),
(141, '2024-05-30 16:06:57', 1, 6),
(142, '2024-05-31 09:52:56', 1, 6),
(143, '2024-05-31 09:53:37', 3, 6),
(144, '2024-05-31 09:54:30', 4, 6),
(145, '2024-05-31 09:54:40', 3, 6),
(146, '2024-05-31 09:54:42', 4, 6),
(147, '2024-05-31 10:02:37', 4, 6),
(148, '2024-05-31 10:02:37', 3, 6),
(149, '2024-05-31 10:02:38', 4, 6),
(150, '2024-05-31 10:02:40', 3, 6),
(151, '2024-05-31 10:23:55', 3, 6),
(152, '2024-05-31 10:23:55', 4, 6),
(153, '2024-05-31 10:23:57', 3, 6),
(154, '2024-05-31 10:23:58', 4, 6),
(155, '2024-05-31 10:24:00', 3, 6),
(156, '2024-05-31 17:31:17', 1, 6),
(157, '2024-05-31 19:12:32', 4, 6),
(158, '2024-05-31 19:12:38', 3, 6),
(159, '2024-05-31 19:12:55', 4, 6),
(160, '2024-05-31 19:12:56', 3, 6),
(161, '2024-05-31 19:13:25', 4, 6),
(162, '2024-05-31 19:13:26', 3, 6),
(163, '2024-05-31 19:14:13', 4, 6),
(164, '2024-05-31 19:17:18', 3, 6),
(165, '2024-05-31 19:17:19', 4, 6),
(166, '2024-05-31 19:17:49', 3, 6),
(167, '2024-05-31 19:17:50', 4, 6),
(168, '2024-05-31 19:17:50', 3, 6),
(169, '2024-05-31 19:17:50', 4, 6),
(170, '2024-05-31 19:17:51', 4, 6),
(171, '2024-05-31 19:17:51', 3, 6),
(172, '2024-05-31 19:17:51', 4, 6),
(173, '2024-05-31 19:17:54', 3, 6),
(174, '2024-05-31 19:17:55', 4, 6),
(175, '2024-05-31 19:17:55', 3, 6),
(176, '2024-05-31 19:17:55', 4, 6),
(177, '2024-05-31 19:18:00', 2, 6),
(178, '2024-05-31 19:18:08', 1, 6),
(179, '2024-05-31 19:18:28', 5, 6),
(180, '2024-09-24 12:46:48', 1, 6),
(181, '2024-09-24 13:12:21', 1, 6),
(182, '2024-09-24 13:33:22', 3, 6),
(183, '2024-09-24 13:33:24', 4, 6);

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
(84, 'Back To School', 'Diseño web de vuelta al cole en Freepick', 'imgs/Product/Back To School', 'jpg', 0, 0),
(85, 'UIUX Design', 'Diseño web de página de diseño y desarrollo por Freepick', 'imgs/Product/UIUX Design', 'jpg', 0, 0),
(86, 'UIUX Gradiente', 'Diseño con gradiente de página web de diseño de Freepick', 'imgs/Product/UIUX Gradiente', 'jpg', 0, 0);

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
(6, 'jorgito', '$2y$10$OjHQqAVcwAs8fNG2R5HBzu8RUDhz6akkMwoAtZdtk14lZDgD0sHGi', 'jorgepinogil013@gmail.com', 0, 0),
(11, 'jorgepino', '$2y$10$PX6SLs1EIPGAQ0.tJq6E4OXxxZH85mN3PaCIf63zC9RT1bMn9ptQS', 'jorge@a.com', 0, 0),
(12, 'registerprueba', '$2y$10$.IRoOGJb5KdILoBKM7hfv.yXec/ravZ7dHFyjSx/CYBrw8HjSKABq', 'register@c.com', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id_action`);

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
  ADD KEY `fk_Actions_has_User_Actions1_idx` (`id_action`);

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
  MODIFY `id_favorites` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT de la tabla `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `fk_users_has_products_products1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_has_products_users1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_Actions_has_User_Actions1` FOREIGN KEY (`id_action`) REFERENCES `actions` (`id_action`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Actions_has_User_User1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_user_has_product_product1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
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
