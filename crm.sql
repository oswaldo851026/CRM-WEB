-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-09-2020 a las 02:28:42
-- Versión del servidor: 5.7.21-log
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre_almacen` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prioridad_entrada` int(11) DEFAULT NULL,
  `tipo_almacen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prioridad_salida` int(11) DEFAULT NULL,
  `capacidad` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id`, `created_at`, `updated_at`, `nombre_almacen`, `descripcion`, `prioridad_entrada`, `tipo_almacen`, `prioridad_salida`, `capacidad`) VALUES
(1, '2018-04-20 11:51:35', '2018-04-20 11:54:09', 'Almacen A', 'Almacen dedicado al producto terminado', 1, 'producto', 1, 500),
(2, '2018-04-20 11:53:05', '2018-04-20 11:53:05', 'Almacen B', 'Almacen dedicado al producto terminado', 2, 'producto', 1, 3000),
(3, '2018-04-20 11:54:00', '2018-04-20 11:54:00', 'Almacen C', 'almacen dedicado a la materia prima', 1, 'materia prima', 1, 5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bill_materials`
--

CREATE TABLE `bill_materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_productos` int(11) NOT NULL,
  `id_materias_primas` int(11) NOT NULL,
  `cantidad` double(8,2) NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `created_at`, `updated_at`, `nombre`, `descripcion`) VALUES
(1, '2018-04-20 08:47:46', '2018-04-20 08:47:46', 'Materiales para textiles', 'Material relacionado para elaborar ropa'),
(2, '2018-04-20 08:48:19', '2018-04-20 08:48:19', 'Playeras Polo', 'Toda variedad de playeras polo'),
(3, '2018-04-20 08:49:04', '2018-04-20 08:49:04', 'Playeras y camisetas', 'cuello redondo, sport, casual'),
(4, '2018-04-20 08:49:27', '2018-04-20 08:49:27', 'Camisas de vestir', 'Variedad de camisas para vestir'),
(5, '2018-04-20 08:49:54', '2018-04-20 08:49:54', 'Pantalones', 'mezclillas y de vestir'),
(6, '2018-04-20 08:50:11', '2018-04-20 08:50:11', 'Servicios de mquila', 'Sublimado, serigrafia y tampografia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `telefono` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descuento` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `direccion`, `razon_social`, `created_at`, `updated_at`, `telefono`, `descuento`) VALUES
(1, 'Rodolfo', 'Fernandez', 'calle 45 numero 13 a colonia centro merida yucatan mexico', 'Plaza azul sa de cv', '2018-04-20 08:35:44', '2018-04-20 08:35:44', '99383645', 5),
(2, 'Carlos', 'Sam', 'calle 46  num 21a avenida industrial merida yucatan mexico', 'Optimiza consulting sa de cv', '2018-04-20 08:36:59', '2018-04-20 08:38:23', '9394837255', 10),
(3, 'Elda Leticia', 'Mandri', 'calle 54 numero 23A colonia centro merida yucatan mexico', 'Angel mandri y sucesores sa de cv', '2018-04-20 08:38:12', '2018-04-20 08:38:12', '99847464535', 15),
(10, 'Generico', 'n-a', 'n-a', '', NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_cobrar`
--

CREATE TABLE `cuentas_cobrar` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_OrdenCompra` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `estatus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_pagar`
--

CREATE TABLE `cuentas_pagar` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `estatus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuentas_pagar`
--

INSERT INTO `cuentas_pagar` (`id`, `id_pedido`, `id_cliente`, `estatus`, `monto`, `created_at`, `updated_at`) VALUES
(1, 12, 1, 'Pendiente por cobro', 243.60, '2018-04-21 01:35:33', '2018-04-21 01:35:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ordenes_compras`
--

CREATE TABLE `detalle_ordenes_compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_ordenCompra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_producto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad_producto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_producto` double(8,2) NOT NULL,
  `importe` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_ordenes_compras`
--

INSERT INTO `detalle_ordenes_compras` (`id`, `created_at`, `updated_at`, `id_ordenCompra`, `id_producto`, `nombre_producto`, `descripcion_producto`, `cantidad_producto`, `precio_producto`, `importe`) VALUES
(1, '2018-04-20 11:22:52', '2018-04-20 11:22:52', 2, 1, '1', 'Tela para hacer ropa', '3', 1.00, 3.00),
(2, '2018-04-20 11:58:25', '2018-04-20 11:58:25', 6, 2, '2', 'Algodon para hacer ropa', '6', 2.00, 12.00),
(3, '2018-04-20 12:54:14', '2018-04-20 12:54:14', 7, 3, '3', 'Polliester usados para fabricar playeras Polos', '3', 3.00, 9.00),
(4, '2018-04-20 12:58:12', '2018-04-20 12:58:12', 9, 3, '3', 'Polliester usados para fabricar playeras Polos', '3', 3.00, 9.00),
(5, '2018-04-20 14:26:37', '2018-04-20 14:26:37', 10, 2, '2', 'Algodon para hacer ropa', '6', 2.00, 12.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `nombre_producto` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion_producto` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad_producto` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio_producto` double(8,2) DEFAULT NULL,
  `importe` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `created_at`, `updated_at`, `id_pedido`, `id_producto`, `nombre_producto`, `descripcion_producto`, `cantidad_producto`, `precio_producto`, `importe`) VALUES
(1, '2018-04-20 14:17:27', '2018-04-20 14:17:27', 3, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '3', 200.00, 600.00),
(2, '2018-04-20 14:30:10', '2018-04-20 14:30:10', 4, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '5', 200.00, 1000.00),
(3, '2018-04-20 23:26:31', '2018-04-20 23:26:31', 5, 3, 'Pantalon de mezclilla estilo skinny', 'Pantalon de mezclilla  estilo skinny para jovenes', '50', 300.00, 15000.00),
(5, '2018-04-20 23:28:46', '2018-04-20 23:28:46', 6, 1, 'Playera azul  modelo er35f', 'Prod1', '2', 70.00, 140.00),
(6, '2018-04-21 01:22:01', '2018-04-21 01:22:01', 7, 3, 'Pantalon de mezclilla estilo skinny', 'Pantalon de mezclilla  estilo skinny para jovenes', '2', 300.00, 600.00),
(7, '2018-04-21 01:35:33', '2018-04-21 01:35:33', 12, 1, 'Playera azul  modelo er35f', 'Prod1', '3', 70.00, 210.00),
(8, '2018-04-21 01:49:16', '2018-04-21 01:49:16', 13, 1, 'Playera azul  modelo er35f', 'Prod1', '1', 70.00, 70.00),
(9, '2018-08-01 07:41:09', '2018-08-01 07:41:09', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(10, '2018-08-01 07:41:20', '2018-08-01 07:41:20', 53, 1, NULL, NULL, NULL, NULL, NULL),
(11, '2018-08-01 07:41:47', '2018-08-01 07:41:47', 54, 1, 'prueba', 'probando', NULL, NULL, NULL),
(12, '2018-08-01 07:42:29', '2018-08-01 07:42:29', 55, 1, 'prueba', 'probando', '23', NULL, NULL),
(13, '2018-08-01 07:42:47', '2018-08-01 07:42:47', 56, 1, 'prueba', 'probando', '23', 10.00, 2300.00),
(14, '2018-08-01 08:09:40', '2018-08-01 08:09:40', NULL, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(15, '2018-08-01 08:11:08', '2018-08-01 08:11:08', NULL, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(16, '2018-08-01 08:11:08', '2018-08-01 08:11:08', NULL, 1, 'Playera azul  modelo er35f', 'Prod1', '10', 70.00, 700.00),
(17, '2018-08-01 08:11:08', '2018-08-01 08:11:08', NULL, 3, 'Pantalon de mezclilla estilo skinny', 'Pantalon de mezclilla  estilo skinny para jovenes', '5', 300.00, 1500.00),
(18, '2018-08-01 08:13:17', '2018-08-01 08:13:17', 75, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(19, '2018-08-01 08:13:17', '2018-08-01 08:13:17', 75, 1, 'Playera azul  modelo er35f', 'Prod1', '10', 70.00, 700.00),
(20, '2018-08-01 08:13:17', '2018-08-01 08:13:17', 75, 3, 'Pantalon de mezclilla estilo skinny', 'Pantalon de mezclilla  estilo skinny para jovenes', '5', 300.00, 1500.00),
(21, '2018-08-01 08:27:12', '2018-08-01 08:27:12', 76, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(22, '2018-08-05 18:03:16', '2018-08-05 18:03:16', 77, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(23, '2018-08-05 18:03:58', '2018-08-05 18:03:58', 78, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(24, '2018-08-05 18:03:58', '2018-08-05 18:03:58', 78, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(25, '2018-08-05 18:03:58', '2018-08-05 18:03:58', 78, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(26, '2018-08-05 18:05:30', '2018-08-05 18:05:30', 79, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(27, '2018-08-05 18:05:30', '2018-08-05 18:05:30', 79, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(28, '2018-08-05 18:05:30', '2018-08-05 18:05:30', 79, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(29, '2018-08-07 21:30:32', '2018-08-07 21:30:32', 80, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(30, '2018-08-07 21:33:27', '2018-08-07 21:33:27', 81, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(31, '2018-08-07 21:35:27', '2018-08-07 21:35:27', 82, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(32, '2018-08-07 21:37:02', '2018-08-07 21:37:02', 83, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(33, '2018-08-07 21:44:10', '2018-08-07 21:44:10', 84, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(34, '2018-08-07 22:06:06', '2018-08-07 22:06:06', 85, 1, 'Playera azul  modelo er35f', 'Prod1', '34', 70.00, 2380.00),
(35, '2018-08-07 22:06:36', '2018-08-07 22:06:36', 86, 1, 'Playera azul  modelo er35f', 'Prod1', '34', 70.00, 2380.00),
(36, '2018-08-07 22:07:32', '2018-08-07 22:07:32', 87, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(37, '2018-08-07 22:11:09', '2018-08-07 22:11:09', 88, 1, 'Playera azul  modelo er35f', 'Prod1', '34', 70.00, 2380.00),
(38, '2018-08-07 22:29:25', '2018-08-07 22:29:25', 89, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(39, '2018-08-07 22:42:34', '2018-08-07 22:42:34', 90, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(40, '2018-08-07 23:00:26', '2018-08-07 23:00:26', 91, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(41, '2018-08-07 23:18:43', '2018-08-07 23:18:43', 92, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(42, '2018-08-07 23:20:14', '2018-08-07 23:20:14', 93, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(43, '2018-08-07 23:30:46', '2018-08-07 23:30:46', 94, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(44, '2018-08-07 23:35:19', '2018-08-07 23:35:19', 95, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '23', 200.00, 4600.00),
(45, '2018-08-08 03:57:27', '2018-08-08 03:57:27', 96, 4, 'Otro', 'Producto generico dedicado a pruebas', '23', 10.00, 230.00),
(46, '2018-08-08 11:00:02', '2018-08-08 11:00:02', 97, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(47, '2018-08-08 11:07:20', '2018-08-08 11:07:20', 98, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(48, '2018-08-09 11:35:23', '2018-08-09 11:35:23', 99, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(49, '2018-08-09 11:43:53', '2018-08-09 11:43:53', 100, 1, 'Playera azul  modelo er35f', 'Prod1', '20', 70.00, 1400.00),
(50, '2018-08-09 11:43:53', '2018-08-09 11:43:53', 100, 3, 'Pantalon de mezclilla estilo skinny', 'Pantalon de mezclilla  estilo skinny para jovenes', '13', 300.00, 3900.00),
(51, '2018-08-09 11:45:55', '2018-08-09 11:45:55', 101, 4, 'Otro', 'Producto generico dedicado a pruebas', '20', 10.00, 200.00),
(52, '2018-08-09 12:49:41', '2018-08-09 12:49:41', 102, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(53, '2018-08-09 12:49:41', '2018-08-09 12:49:41', 102, 1, 'Playera azul  modelo er35f', 'Prod1', '23', 70.00, 1610.00),
(54, '2018-08-09 13:33:32', '2018-08-09 13:33:32', 103, 2, 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', '20', 200.00, 4000.00),
(55, '2018-08-10 12:04:47', '2018-08-10 12:04:47', 104, 1, 'Playera azul  modelo er35f', 'Prod1', '10', 70.00, 700.00),
(56, '2018-08-10 12:04:47', '2018-08-10 12:04:47', 104, 3, 'Pantalon de mezclilla estilo skinny', 'Pantalon de mezclilla  estilo skinny para jovenes', '2', 300.00, 600.00),
(57, '2018-08-11 03:58:00', '2018-08-11 03:58:00', 105, 1, 'Playera azul  modelo er35f', 'Prod1', '12', 70.00, 840.00),
(58, '2018-08-11 03:58:01', '2018-08-11 03:58:01', 105, 1, 'Playera azul  modelo er35f', 'Prod1', '10', 70.00, 700.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Users', '{\"users\":1}', '2018-02-06 07:49:04', '2018-02-06 07:49:04'),
(2, 'Admins', '{\"admin\":1,\"users\":1}', '2018-02-06 07:49:04', '2018-02-06 07:49:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE `inventarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `concepto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_producto` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `cantidad` double(8,2) NOT NULL,
  `tipo_movimiento` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inventarios`
--

INSERT INTO `inventarios` (`id`, `concepto`, `id_producto`, `id_almacen`, `cantidad`, `tipo_movimiento`, `created_at`, `updated_at`) VALUES
(2, 'Registro hecho mediante pedido', 'Prod2', 1, 3.00, 'salida', '2018-04-20 14:17:27', '2018-04-20 14:17:27'),
(3, 'Registro hecho mediante pedido', 'Prod2', 1, -5.00, 'salida', '2018-04-20 14:30:10', '2018-04-20 14:30:10'),
(4, 'Registro hecho mediante pedido', 'Prod3', 1, -50.00, 'salida', '2018-04-20 23:26:30', '2018-04-20 23:26:30'),
(5, 'Registro hecho mediante pedido', 'Prod1', 1, -2.00, 'salida', '2018-04-20 23:28:45', '2018-04-20 23:28:45'),
(6, 'Hecha desde el panel', 'Prod1', 1, 23.00, 'salida', '2018-04-21 00:47:01', '2018-04-21 00:47:01'),
(7, 'Registro hecho mediante pedido', 'Prod3', 1, -2.00, 'salida', '2018-04-21 01:22:01', '2018-04-21 01:22:01'),
(8, 'Registro hecho mediante pedido', 'Prod1', 1, -3.00, 'salida', '2018-04-21 01:35:33', '2018-04-21 01:35:33'),
(9, 'Hecha desde el panel', 'Prod1', 1, 122.00, 'entrada', '2018-04-21 03:00:36', '2018-04-21 03:00:36'),
(10, 'Hecha desde el panel', 'Prod1', 1, 5.00, 'entrada', '2018-04-21 03:01:24', '2018-04-21 03:01:24'),
(11, 'Hecha desde el panel', 'Prod1', 1, 3.00, 'entrada', '2018-04-21 03:09:37', '2018-04-21 03:09:37'),
(12, 'Hecha desde el panel', 'Prod2', 1, 5.00, 'entrada', '2018-04-21 03:10:17', '2018-04-21 03:10:17'),
(13, 'Hecha desde el panel', 'Prod1', 1, 2.00, 'salida', '2018-04-21 03:12:38', '2018-04-21 03:12:38'),
(14, 'Hecha desde el panel', 'Prod1', 2, 24.00, 'entrada', '2018-04-21 03:18:44', '2018-04-21 03:18:44'),
(15, 'Hecha desde el panel', 'Prod1', 2, 5.00, 'entrada', '2018-04-21 03:21:26', '2018-04-21 03:21:26'),
(16, 'Hecha desde el panel', 'Prod1', 1, 34.00, 'salida', '2018-04-21 03:24:31', '2018-04-21 03:24:31'),
(17, 'Hecha desde el panel', 'Prod1', 1, 5.00, 'entrada', '2018-04-21 03:29:30', '2018-04-21 03:29:30'),
(18, 'Hecha desde el panel', 'Prod1', 1, -5.00, 'salida', '2018-04-21 03:30:00', '2018-04-21 03:30:00'),
(19, 'Hecha desde el panel', 'Prod1', 1, 200.00, 'entrada', '2018-04-21 05:46:48', '2018-04-21 05:46:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios2`
--

CREATE TABLE `inventarios2` (
  `id` int(10) UNSIGNED NOT NULL,
  `concepto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_materiaPrima` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `cantidad` double(8,2) NOT NULL,
  `tipo_movimiento` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inventarios2`
--

INSERT INTO `inventarios2` (`id`, `concepto`, `id_materiaPrima`, `id_almacen`, `cantidad`, `tipo_movimiento`, `created_at`, `updated_at`) VALUES
(1, 'Registro hecho mediante orden de compra', 'MP3', 3, 3.00, 'entrada', '2018-04-20 12:58:12', '2018-04-20 12:58:12'),
(2, 'Registro hecho mediante orden de compra', 'MP2', 3, 6.00, 'entrada', '2018-04-20 14:26:37', '2018-04-20 14:26:37'),
(3, 'Hecha desde el panel', 'MP1', 1, 344.00, 'entrada', '2018-04-21 00:47:37', '2018-04-21 00:47:37'),
(4, 'Hecha desde el panel', 'MP1', 1, 10.00, 'entrada', '2018-04-21 03:32:51', '2018-04-21 03:32:51'),
(5, 'Hecha desde el panel', 'MP1', 1, 100.00, 'entrada', '2018-04-21 03:33:26', '2018-04-21 03:33:26'),
(6, 'Hecha desde el panel', 'MP1', 1, 200.00, 'entrada', '2018-04-21 03:35:19', '2018-04-21 03:35:19'),
(7, 'Hecha desde el panel', 'MP1', 1, -10.00, 'salida', '2018-04-21 03:44:17', '2018-04-21 03:44:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_primas`
--

CREATE TABLE `materia_primas` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `costo` double(8,2) NOT NULL,
  `comentarios` longtext COLLATE utf8mb4_unicode_ci,
  `imagen_principal` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `medidas` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `existencias` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materia_primas`
--

INSERT INTO `materia_primas` (`id`, `codigo`, `nombre`, `descripcion`, `id_proveedor`, `costo`, `comentarios`, `imagen_principal`, `id_categoria`, `created_at`, `updated_at`, `medidas`, `existencias`) VALUES
(1, 'MP1', 'Telas', 'Tela para hacer ropa', 1, 100.00, NULL, NULL, NULL, '2018-04-20 08:40:53', '2018-04-21 03:44:17', 'centimetros', 193),
(2, 'MP2', 'Algodon', 'Algodon para hacer ropa', 2, 250.00, '100 cm equivale a 250 pesos', NULL, NULL, '2018-04-20 08:41:55', '2018-04-20 14:26:37', 'centimetros', 30),
(3, 'MP3', 'Poliester', 'Polliester usados para fabricar playeras Polos', 2, 190.00, 'por cada 100 equivale $190 pesos', NULL, NULL, '2018-04-20 08:43:20', '2018-04-20 12:58:12', 'centimetros', 6),
(4, 'MP4', 'Hijos', 'Hilos para elaborar cierto tipo de ropa', 1, 900.00, '300 pulgadas de hilos', NULL, NULL, '2018-04-20 08:45:19', '2018-04-20 08:45:19', 'pulgadas', 0),
(5, 'MP5', 'Tintas', 'tintas para personalizar ropa para el trabajo', 1, 230.00, NULL, NULL, NULL, '2018-04-20 08:46:26', '2018-04-20 08:46:26', 'gramos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_compras`
--

CREATE TABLE `ordenes_compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `asunto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comentarios` text COLLATE utf8mb4_unicode_ci,
  `direccion_envio` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` double(8,2) NOT NULL,
  `iva` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `metodo_pago` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ordenes_compras`
--

INSERT INTO `ordenes_compras` (`id`, `created_at`, `updated_at`, `id_proveedor`, `id_usuario`, `asunto`, `estatus`, `comentarios`, `direccion_envio`, `subtotal`, `iva`, `total`, `metodo_pago`, `fecha_entrega`, `id_almacen`) VALUES
(1, '2018-04-20 11:21:26', '2018-04-20 11:21:26', 1, 1, 'Compra del mes de Marzo', 'enAlmacen', 'Esto es la compra  del proveedor vestimentas', 'oficinas', 300.00, 48.00, 348.00, 'Credito', '2018-04-20', NULL),
(2, '2018-04-20 11:22:52', '2018-04-20 11:22:52', 1, 1, 'Compra del mes de Marzo', 'enAlmacen', 'Esto es la compra  del proveedor vestimentas', 'oficinas', 300.00, 48.00, 348.00, 'Credito', '2018-04-20', NULL),
(6, '2018-04-20 11:58:25', '2018-04-20 11:58:25', 1, 1, 'Nuevo pedido', 'enAlmacen', 'Compra de varios materiales', 'local', 1500.00, 240.00, 1740.00, 'Credito', '2018-04-20', 3),
(7, '2018-04-20 12:54:14', '2018-04-20 12:54:14', 1, 1, 'prueba', 'creado', NULL, 'asdasd', 570.00, 91.20, 661.20, 'Credito', '2018-04-23', 3),
(8, '2018-04-20 12:56:37', '2018-04-20 12:56:37', 2, 1, 'zcxzxc', 'enAlmacen', 'zxc', 'zxczz', 570.00, 91.20, 661.20, 'Credito', '2018-04-30', 3),
(9, '2018-04-20 12:58:12', '2018-04-20 12:58:12', 2, 1, 'zcxzxc', 'enAlmacen', 'zxc', 'zxczz', 570.00, 91.20, 661.20, 'Credito', '2018-04-30', 3),
(10, '2018-04-20 14:26:37', '2018-04-20 14:26:37', 1, 1, 'probando', 'enAlmacen', NULL, 'local', 1500.00, 240.00, 1740.00, 'Efectivo', '2018-04-25', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `asunto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comentarios` longtext COLLATE utf8mb4_unicode_ci,
  `subtotal` double(8,2) NOT NULL,
  `iva` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `descuento` float DEFAULT NULL,
  `direccion_envio` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `metodo_pago` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_vendedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `created_at`, `updated_at`, `id_cliente`, `id_usuario`, `asunto`, `estatus`, `comentarios`, `subtotal`, `iva`, `total`, `descuento`, `direccion_envio`, `fecha_entrega`, `metodo_pago`, `id_vendedor`) VALUES
(2, '2018-04-20 14:03:02', '2018-04-20 14:03:02', 1, 1, 'Ventas al centro en la tiendita de la esquina', 'enviado', NULL, 600.00, 96.00, 696.00, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-04-23', 'Efectivo', 3),
(3, '2018-04-20 14:17:27', '2018-04-20 14:17:27', 1, 1, 'Ventas al centro en la tiendita de la esquina', 'enviado', NULL, 600.00, 96.00, 696.00, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-04-23', 'Efectivo', 3),
(4, '2018-04-20 14:30:10', '2018-04-20 14:30:10', 1, 1, 'Ventas a juanita', 'enviado', NULL, 1000.00, 160.00, 1160.00, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-04-25', 'Credito', 1),
(5, '2018-04-20 23:26:30', '2018-04-20 23:26:30', 1, 1, 'Pedido 200 payeras', 'enviado', NULL, 15000.00, 2400.00, 17400.00, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-04-30', 'Efectivo', 1),
(6, '2018-04-20 23:28:25', '2018-04-20 23:28:45', 3, 1, '20-04-2018', 'enviado', NULL, 140.00, 22.40, 162.40, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-04-30', 'Efectivo', 1),
(7, '2018-04-21 01:22:01', '2018-04-21 01:22:01', 1, 1, 'Pedido Al centro', 'enviado', NULL, 600.00, 96.00, 696.00, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-05-02', 'Credito', 2),
(8, '2018-04-21 01:23:46', '2018-04-21 01:23:46', 1, 1, 'Probando credito', 'creado', NULL, 210.00, 33.60, 243.60, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-04-30', 'Credito', 1),
(9, '2018-04-21 01:27:55', '2018-04-21 01:27:55', 1, 1, 'Probando', 'enviado', NULL, 210.00, 33.60, 243.60, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-04-30', 'Credito', 2),
(10, '2018-04-21 01:29:25', '2018-04-21 01:29:25', 1, 1, 'Probando', 'enviado', NULL, 210.00, 33.60, 243.60, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-04-30', 'Credito', 2),
(11, '2018-04-21 01:31:41', '2018-04-21 01:31:41', 1, 1, 'Probando', 'enviado', NULL, 210.00, 33.60, 243.60, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-04-30', 'Credito', 2),
(12, '2018-04-21 01:35:33', '2018-04-21 01:35:33', 1, 1, 'Probando', 'enviado', NULL, 210.00, 33.60, 243.60, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-04-30', 'Credito', 2),
(13, '2018-04-21 01:49:16', '2018-04-21 01:49:16', 1, 1, 'saddas', 'creado', 'asdasd', 70.00, 11.20, 81.20, 0, 'calle 45 numero 13 a colonia centro merida yucatan mexico', '2018-04-25', 'Efectivo', 3),
(76, '2018-08-01 08:27:12', '2018-08-01 08:27:12', 1, 1, 'sa', 'enviado', '', 4600.00, 73600.00, 5336.00, 0, 'n/a', '2018-08-01', 'Efectivo', 1),
(77, '2018-08-05 18:03:15', '2018-08-05 18:03:15', 1, 1, 'sdas', 'enviado', '', 1610.00, 25760.00, 1867.60, 0, 'n/a', '2018-08-05', 'Efectivo', 1),
(78, '2018-08-05 18:03:58', '2018-08-05 18:03:58', 1, 1, 'sdas', 'enviado', '', 7820.00, 125120.00, 9071.20, 0, 'n/a', '2018-08-05', 'Efectivo', 1),
(79, '2018-08-05 18:05:29', '2018-08-05 18:05:29', 1, 1, 'sdas', 'enviado', '', 7820.00, 125120.00, 9071.20, 0, 'n/a', '2018-08-05', 'Credito', 1),
(80, '2018-08-07 21:30:31', '2018-08-07 21:30:31', 1, 1, 'Probando', 'enviado', '', 1610.00, 25760.00, 1867.60, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(81, '2018-08-07 21:33:27', '2018-08-07 21:33:27', 1, 1, 'probando', 'enviado', '', 1610.00, 25760.00, 1867.60, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(82, '2018-08-07 21:35:27', '2018-08-07 21:35:27', 1, 1, 'probando', 'enviado', '', 1610.00, 25760.00, 1867.60, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(83, '2018-08-07 21:37:02', '2018-08-07 21:37:02', 1, 1, 'sd', 'enviado', '', 1610.00, 25760.00, 1867.60, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(84, '2018-08-07 21:44:10', '2018-08-07 21:44:10', 1, 1, 'ssd', 'enviado', '', 1610.00, 25760.00, 1867.60, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(85, '2018-08-07 22:06:06', '2018-08-07 22:06:06', 1, 1, 'dds', 'enviado', '', 2380.00, 38080.00, 2760.80, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(86, '2018-08-07 22:06:36', '2018-08-07 22:06:36', 1, 1, 'dds', 'enviado', '', 2380.00, 38080.00, 2760.80, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(87, '2018-08-07 22:07:32', '2018-08-07 22:07:32', 1, 1, 'probando', 'enviado', '', 4600.00, 73600.00, 5336.00, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(88, '2018-08-07 22:11:09', '2018-08-07 22:11:09', 1, 1, 'ss', 'enviado', '', 2380.00, 38080.00, 2760.80, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(89, '2018-08-07 22:29:25', '2018-08-07 22:29:25', 1, 1, 'dsds', 'enviado', '', 1610.00, 25760.00, 1867.60, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(90, '2018-08-07 22:42:34', '2018-08-07 22:42:34', 2, 1, 'Probandi', 'enviado', '', 4600.00, 73600.00, 5336.00, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(91, '2018-08-07 23:00:26', '2018-08-07 23:00:26', 2, 1, 'Probando movil', 'enviado', '', 1610.00, 25760.00, 1867.60, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(92, '2018-08-07 23:18:43', '2018-08-07 23:18:43', 2, 1, 'Probando', 'enviado', '', 4600.00, 73600.00, 5336.00, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(93, '2018-08-07 23:20:14', '2018-08-07 23:20:14', 2, 1, 'Probando', 'enviado', '', 4600.00, 73600.00, 5336.00, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(94, '2018-08-07 23:30:46', '2018-08-07 23:30:46', 2, 1, 'Prueba', 'enviado', '', 4600.00, 73600.00, 5336.00, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(95, '2018-08-07 23:35:18', '2018-08-07 23:35:18', 2, 1, 'Probando', 'enviado', '', 4600.00, 73600.00, 5336.00, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(96, '2018-08-08 03:57:26', '2018-08-08 03:57:26', 10, 1, 'probando genericos', 'enviado', '', 230.00, 3680.00, 266.80, 0, 'n/a', '2018-08-07', 'Efectivo', 1),
(97, '2018-08-08 11:00:02', '2018-08-08 11:00:02', 1, 1, 'Prueba', 'enviado', '', 1610.00, 25760.00, 1867.60, 0, 'n/a', '2018-08-08', 'Efectivo', 1),
(98, '2018-08-08 11:07:20', '2018-08-08 11:07:20', 1, 1, 'prueba', 'enviado', '', 1610.00, 25760.00, 1867.60, 0, 'n/a', '2018-08-08', 'Efectivo', 1),
(99, '2018-08-09 11:35:23', '2018-08-09 11:35:23', 1, 1, 'sd', 'enviado', '', 1610.00, 25760.00, 1867.60, 0, 'n/a', '2018-08-09', 'Efectivo', 1),
(100, '2018-08-09 11:43:53', '2018-08-09 11:43:53', 1, 1, 'Probando', 'enviado', '', 5300.00, 84800.00, 6148.00, 0, 'n/a', '2018-08-09', 'Efectivo', 1),
(101, '2018-08-09 11:45:55', '2018-08-09 11:45:55', 1, 1, 'Probando offline', 'enviado', '', 200.00, 3200.00, 232.00, 0, 'n/a', '2018-08-09', 'Efectivo', 1),
(102, '2018-08-09 12:49:40', '2018-08-09 12:49:40', 1, 1, 'cxx', 'enviado', '', 3220.00, 51520.00, 3735.20, 0, 'n/a', '2018-08-09', 'Efectivo', 1),
(103, '2018-08-09 13:33:32', '2018-08-09 13:33:32', 1, 1, 'Probando', 'enviado', '', 4000.00, 64000.00, 4640.00, 0, 'n/a', '2018-08-09', 'Efectivo', 1),
(104, '2018-08-10 12:04:47', '2018-08-10 12:04:47', 1, 1, 'Prueba final', 'enviado', '', 1300.00, 20800.00, 1508.00, 0, 'n/a', '2018-08-10', 'Efectivo', 1),
(105, '2018-08-11 03:57:59', '2018-08-11 03:57:59', 1, 1, 'Ordinario', 'enviado', '', 1540.00, 24640.00, 1786.40, 0, 'n/a', '2018-08-10', 'Efectivo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `created_at`, `updated_at`, `nombre`) VALUES
(1, '2018-04-19 05:00:00', '2018-04-19 05:00:00', 'Admin'),
(2, '2018-04-19 05:00:00', '2018-04-19 05:00:00', 'Compras'),
(3, '2018-04-19 05:00:00', '2018-04-19 05:00:00', 'Producción'),
(4, '2018-04-19 05:00:00', '2018-04-19 05:00:00', 'Finanzas'),
(5, '2018-04-19 05:00:00', '2018-04-19 05:00:00', 'Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `precio` double(8,2) NOT NULL,
  `existencias` int(11) DEFAULT NULL,
  `codigo_barras` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comentarios` longtext COLLATE utf8mb4_unicode_ci,
  `imagen_principal` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_producto` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `id_proveedor`, `precio`, `existencias`, `codigo_barras`, `comentarios`, `imagen_principal`, `tipo_producto`, `id_categoria`, `created_at`, `updated_at`) VALUES
(1, 'Prod1', 'Playera azul  modelo er35f', 'Prod1', 1, 70.00, 295, '3234234242334', NULL, 'download (1).jpg', NULL, 3, '2018-04-20 08:52:40', '2018-04-21 05:46:48'),
(2, 'Prod2', 'Camisas de caballero blanca', '100 % algodon camisa de caballero.', 2, 200.00, 86, NULL, 'Medidas disponibles:  lg, md, xs', 'camisa-de-vestir-para-nino-refinada-blanca.jpg', NULL, 4, '2018-04-20 09:11:01', '2018-04-20 14:30:10'),
(3, 'Prod3', 'Pantalon de mezclilla estilo skinny', 'Pantalon de mezclilla  estilo skinny para jovenes', 2, 300.00, 48, NULL, 'Muy buen pantalon', 'Diesel_11645417_bjbZQ7tmC8.jpg', NULL, 5, '2018-04-20 09:16:23', '2018-04-21 01:22:01'),
(4, 'Prod4', 'Otro', 'Producto generico dedicado a pruebas', 1, 10.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Prod5', 'Prueba', 'asdasd', 2, 23.00, 0, 'asdasdas', NULL, 'WWW.YTS.AG.jpg', NULL, 1, '2018-08-09 12:50:40', '2018-08-09 12:50:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(10) UNSIGNED NOT NULL,
  `direccion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_contacto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `apellido_contacto` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `direccion`, `razon_social`, `telefono`, `nombre_contacto`, `created_at`, `updated_at`, `apellido_contacto`) VALUES
(1, 'calle 234 num 12 b col camestre', 'Vestimentas del sureste sa de cv', '01645382746', 'Rodrigo', '2018-04-20 08:28:40', '2018-04-20 08:33:46', 'Salazar'),
(2, 'c 34 d por 13 y 15 merida yucatan mexico', 'vestimentas de mexico sa de cv', '839393372534', 'Fulano', '2018-04-20 08:29:46', '2018-04-20 08:29:46', 'Marciano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `throttle`
--

CREATE TABLE `throttle` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 1, '::1', 0, 0, 0, NULL, NULL, NULL),
(2, 3, '::1', 0, 0, 0, NULL, NULL, NULL),
(3, 5, NULL, 0, 0, 0, NULL, NULL, NULL),
(4, 4, '::1', 1, 0, 0, '2018-04-20 10:55:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perfil` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`, `username`, `id_perfil`) VALUES
(1, 'admin@admin.com', '$2y$10$IlRsOCJ3YQBvvf9J8MrwuOd4ceUpWqKh1T7nRfatRUHzS81YPYct.', NULL, 1, NULL, NULL, '2020-09-11 05:22:55', '$2y$10$UH8lsQod9YPgSkE15nqeUeLwNFGba1GEIYLdaL1DoOaqupbl2Bysm', NULL, 'Oswaldo', 'Rodriguez', '2018-02-06 07:49:05', '2020-09-11 05:22:55', 'admin', '1'),
(2, 'user@user.com', '$2y$10$puqtNjIjwkXruEpchnL1t.ua3zfYxI1zH4j32Ki2.FORrE5QYsf7e', NULL, 1, NULL, NULL, NULL, NULL, NULL, 'Javier', 'Gongora', '2018-02-06 07:49:05', '2018-02-06 07:49:05', '', '1'),
(3, 'prueba@pruebas.com', '$2y$10$zW6MdDcbecNatk0Z.XBRK.fldbl4IwFLbCBR7qhtKvEYgacMq6X2O', NULL, 1, NULL, '2018-04-12 07:03:39', NULL, NULL, NULL, 'Pedro', 'Ortiz', '2018-04-12 07:03:39', '2018-04-12 07:03:39', 'Pedro', '4'),
(4, 'rod@hotmail.com', '$2y$10$tcwI3HKwSz88a9Lvu4Xzwe0906za9CGlClH3.2YTFR/MTv2SHLhMq', NULL, 1, NULL, '2018-04-20 09:58:39', '2018-04-20 10:53:23', '$2y$10$DA5ERAxswzx42BPlyp8wCuQi3A6ySBEmj4Bf4pVnYl4jp8Ke0VpE6', NULL, 'Rodolfo', 'Guzman', '2018-04-20 09:58:39', '2018-04-20 10:53:23', 'rodi', '2'),
(5, 'licho@hotmail.com', '$2y$10$L44k6/dhvZigh6mgME5FEejQOkqhmMA.ww.RhiPqTCLsrx5RiuHA.', NULL, 1, NULL, '2018-04-20 10:01:50', '2018-04-20 10:55:16', '$2y$10$xbJKDQD/GxHtS96/JkIbieRxT7RMDPvDg43s/3w9SmO/Nx6omgifa', NULL, 'Luis ANgel', 'ROdriguez', '2018-04-20 10:01:50', '2018-04-20 10:55:16', 'licho', '5'),
(6, 'eri@hotmail.com', '$2y$10$LOLu0i/AA.UaqYNxmw6U1eZLG5wAJ9LBhpVRtIzWrhEO.NFy49tCe', NULL, 1, NULL, '2018-04-20 10:02:23', NULL, NULL, NULL, 'Ericka', 'Rodriguez', '2018-04-20 10:02:23', '2018-04-20 10:04:09', 'bubus', '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE `users_groups` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 2),
(2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bill_materials`
--
ALTER TABLE `bill_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas_cobrar`
--
ALTER TABLE `cuentas_cobrar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas_pagar`
--
ALTER TABLE `cuentas_pagar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_ordenes_compras`
--
ALTER TABLE `detalle_ordenes_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indices de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventarios2`
--
ALTER TABLE `inventarios2`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materia_primas`
--
ALTER TABLE `materia_primas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes_compras`
--
ALTER TABLE `ordenes_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `throttle`
--
ALTER TABLE `throttle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_activation_code_index` (`activation_code`),
  ADD KEY `users_reset_password_code_index` (`reset_password_code`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `bill_materials`
--
ALTER TABLE `bill_materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cuentas_cobrar`
--
ALTER TABLE `cuentas_cobrar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas_pagar`
--
ALTER TABLE `cuentas_pagar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_ordenes_compras`
--
ALTER TABLE `detalle_ordenes_compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `inventarios2`
--
ALTER TABLE `inventarios2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `materia_primas`
--
ALTER TABLE `materia_primas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordenes_compras`
--
ALTER TABLE `ordenes_compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `throttle`
--
ALTER TABLE `throttle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
