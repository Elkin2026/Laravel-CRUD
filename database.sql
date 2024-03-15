-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2024 a las 03:58:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `co&text_com`
--
CREATE DATABASE IF NOT EXISTS `co&text_com` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `co&text_com`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `identification_type` enum('NIT','RUT','CC') NOT NULL,
  `identification_number` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `contact_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `identification_type`, `identification_number`, `name`, `email`, `address`, `phone_number`, `contact_name`) VALUES
(1, 'CC', 1002345654, 'Elkin', 'elkinm20022@gmail.com', 'pereira risaralda', '30477873634', 'elkin contacto'),
(2, 'RUT', 1003445345, 'Laura', 'lauratest@test.com', 'pereira risaralda', '102438345', 'laura contacto'),
(3, 'RUT', 1002345656, 'Benjamin', 'benjamin@beg.com', 'Dosquebradas', '305786528', 'Benjamin contacto'),
(4, 'CC', 1004534423, 'Juanito alimaña', 'juanito@alimaña.com', 'puerto rico san juan', '3052078993', 'juanito alimaña contacto'),
(5, 'RUT', 1004534423, 'Manuel', 'manuel@co&text.com', 'new york EE:UU', '3022078993', 'Manuel contacto'),
(6, 'NIT', 1003456565, 'Ruben blades', 'blades@panama.com', 'Panamá', '3052078993', 'Blades contacto'),
(7, 'RUT', 102345823, 'Hector', 'hector@fania.com', 'Cali colombia ', '1029345545', 'Hector contacto'),
(8, 'CC', 1004534411, 'Leonardo', 'leonardo@turtle.com', 'Roma italia', '203485843', 'Leonardo contacto'),
(9, 'CC', 1004534423, 'Juanito alimaña', 'juanito@alimaña.com', 'puerto rico san juan', '3052078993', 'juanito alimaña contacto'),
(10, 'RUT', 1004534423, 'Manuel', 'manuel@co&text.com', 'new york EE:UU', '3022078993', 'Manuel contacto'),
(11, 'NIT', 1003456565, 'Ruben blades', 'blades@panama.com', 'Panamá', '3052078993', 'Blades contacto'),
(12, 'RUT', 102345823, 'Hector', 'hector@fania.com', 'Cali colombia ', '1029345545', 'Hector contacto'),
(13, 'CC', 1004534411, 'Leonardo', 'leonardo@turtle.com', 'Roma italia', '203485843', 'Leonardo contacto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_transaction` varchar(255) NOT NULL,
  `date_of_request` timestamp NULL DEFAULT NULL,
  `date_of_delivery` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity_request_by_client` varchar(40) NOT NULL,
  `state` enum('new','in_process','shipped','finished') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `code_transaction`, `date_of_request`, `date_of_delivery`, `created_at`, `client_id`, `client_name`, `product_id`, `product_name`, `quantity_request_by_client`, `state`) VALUES
(1, 'Co&tex-000001', '2021-01-04 02:59:52', '2021-01-06 02:59:52', '2021-01-04 02:59:52', 4, 'Juanito alimaña', 3, 'Medias deportivas', '2', 'new'),
(2, 'Co&tex-000002', '2021-01-04 02:59:52', '2021-01-06 02:59:52', '2021-01-04 02:59:52', 4, 'Juanito alimaña', 3, 'Medias deportivas', '1', 'finished'),
(3, 'Co&tex-000003', '2021-01-03 06:59:52', '2021-01-06 02:59:52', '2021-01-03 06:59:52', 1, 'Elkin', 3, 'Medias deportivas', '2', 'in_process'),
(4, 'Co&tex-000004', '2021-02-03 11:59:52', '2021-02-04 03:59:52', '2021-02-03 11:59:52', 2, 'Laura', 7, 'P434LON', '4', 'shipped'),
(5, 'Co&tex-000005', '2024-03-15 05:00:00', '2024-03-30 05:00:00', '2024-03-15 05:58:54', 12, 'Hector', 8, 'JEAN', '3', 'new'),
(6, 'Co&tex-000006', '2021-11-13 05:00:00', '2024-03-15 05:00:00', '2024-03-15 05:59:25', 2, 'Laura', 6, 'Corbata', '1', 'shipped'),
(7, 'Co&tex-000007', '2021-02-23 05:00:00', '2021-02-24 05:00:00', '2024-03-15 06:00:14', 2, 'Laura', 7, 'Pantalon', '4', 'finished'),
(8, 'Co&tex-000008', '2021-01-14 05:00:00', '2021-02-14 05:00:00', '2024-03-15 06:01:14', 2, 'Laura', 4, 'Camisa ejecutiva', '2', 'in_process'),
(9, 'Co&tex-000009', '2021-01-02 05:00:00', '2021-01-02 05:00:00', '2024-03-15 06:01:50', 2, 'Laura', 6, 'Corbata', '2', 'in_process'),
(10, 'Co&tex-000010', '2021-01-02 05:00:00', '2021-02-03 05:00:00', '2024-03-15 06:02:23', 2, 'Laura', 1, 'Jeans para mujer y hombre', '2', 'in_process'),
(11, 'Co&tex-000011', '2021-01-01 05:00:00', '2021-02-01 05:00:00', '2024-03-15 06:04:30', 2, 'Laura', 5, 'buso', '2', 'in_process'),
(12, 'Co&tex-000012', '2021-03-01 05:00:00', '2021-03-02 05:00:00', '2024-03-15 06:05:17', 2, 'Laura', 8, 'JEAN', '2', 'in_process'),
(13, 'Co&tex-000013', '2021-02-14 05:00:00', '2021-03-15 05:00:00', '2024-03-15 06:05:48', 1, 'Elkin', 4, 'Camisa ejecutiva', '1', 'in_process'),
(14, 'Co&tex-000014', '2021-01-14 05:00:00', '2021-01-14 05:00:00', '2024-03-15 06:06:22', 1, 'Elkin', 6, 'Corbata', '5', 'in_process'),
(15, 'Co&tex-000015', '2021-02-01 05:00:00', '2021-02-01 05:00:00', '2024-03-15 06:17:04', 2, 'Laura', 3, 'Medias deportivas', '2', 'in_process'),
(16, 'Co&tex-000016', '2021-01-02 05:00:00', '2021-02-02 05:00:00', '2024-03-15 06:17:43', 2, 'Laura', 8, 'JEAN', '1', 'in_process'),
(17, 'Co&tex-000017', '2021-02-01 05:00:00', '2021-02-01 05:00:00', '2024-03-15 06:18:27', 2, 'Laura', 5, 'buso', '3', 'in_process'),
(18, 'Co&tex-000018', '2021-02-02 05:00:00', '2021-02-03 05:00:00', '2024-03-15 06:18:56', 2, 'Laura', 1, 'Jeans para mujer y hombre', '3', 'in_process'),
(19, 'Co&tex-000019', '2021-01-30 05:00:00', '2021-01-31 05:00:00', '2024-03-15 06:20:25', 2, 'Laura', 2, 'Camiseta deportiva', '3', 'in_process'),
(20, 'Co&tex-000020', '2021-02-02 05:00:00', '2021-02-03 05:00:00', '2024-03-15 06:23:10', 1, 'Elkin', 1, 'Jeans para mujer y hombre', '3', 'in_process'),
(21, 'Co&tex-000021', '2021-02-20 05:00:00', '2021-01-21 05:00:00', '2024-03-15 06:23:48', 1, 'Elkin', 1, 'Jeans para mujer y hombre', '4', 'in_process'),
(22, 'Co&tex-000022', '2021-02-20 05:00:00', '2021-02-20 05:00:00', '2024-03-15 06:24:38', 1, 'Elkin', 5, 'buso', '3', 'shipped'),
(23, 'Co&tex-000023', '2021-02-20 05:00:00', '2021-02-21 05:00:00', '2024-03-15 06:25:12', 1, 'Elkin', 3, 'Medias deportivas', '2', 'new'),
(24, 'Co&tex-000024', '2021-01-03 05:00:00', '2021-01-31 05:00:00', '2024-03-15 06:26:13', 1, 'Elkin', 3, 'Medias deportivas', '1', 'finished'),
(25, 'Co&tex-000025', '2021-02-02 05:00:00', '2021-02-03 05:00:00', '2024-03-15 06:27:47', 1, 'Elkin', 2, 'Camiseta deportiva', '6', 'shipped'),
(26, 'Co&tex-000026', '2021-01-02 05:00:00', '2021-01-03 05:00:00', '2024-03-15 06:28:22', 1, 'Elkin', 5, 'buso', '5', 'in_process'),
(27, 'Co&tex-000027', '2021-02-01 05:00:00', '2021-02-02 05:00:00', '2024-03-15 06:28:59', 1, 'Elkin', 8, 'JEAN', '3', 'shipped'),
(28, 'Co&tex-000028', '2021-01-02 05:00:00', '2021-01-03 05:00:00', '2024-03-15 06:29:32', 1, 'Elkin', 5, 'buso', '4', 'finished'),
(29, 'Co&tex-000029', '2021-05-29 05:00:00', '2021-07-31 05:00:00', '2024-03-15 07:22:21', 11, 'Ruben blades', 16, 'Esqueleto para mujer', '2', 'finished'),
(30, 'Co&tex-000030', '2021-06-05 05:00:00', '2021-06-06 05:00:00', '2024-03-15 02:47:07', 13, 'Leonardo', 18, 'Camisa Estudiante', '4', 'shipped');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(12) NOT NULL,
  `description` varchar(40) NOT NULL,
  `size` varchar(255) NOT NULL,
  `color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `code`, `description`, `size`, `color`) VALUES
(1, 'KV2AC', 'Jeans para mujer y hombre', 'xs', 'azul'),
(2, 'NHEXO', 'Camiseta deportiva', 'M', 'Roja'),
(3, 'ALOH', 'Medias deportivas', 'L', 'Negro'),
(4, 'RO451', 'Camisa ejecutiva', 'X', 'Negro'),
(5, '35HP2#', 'buso', 'M', 'Rojo'),
(6, 'Cor24w', 'Corbata', '15cm', 'Amarillo'),
(7, 'P434LON', 'Pantalon', '32', 'Gris'),
(8, 'ALOH1', 'JEAN', '45', 'Cafe'),
(15, 'cod4345wt', 'Chaleco ejecutivo', '32', 'Negro mate'),
(16, 'pa3434jrt2', 'Esqueleto para mujer', '32', 'verde'),
(17, 'NHEXO1', 'Pantalon casual', 'M', 'Blanco'),
(18, 'cod4345fv', 'Camisa Estudiante', '45', 'azul con blanco');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_code_transaction_unique` (`code_transaction`),
  ADD KEY `orders_client_id_foreign` (`client_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
