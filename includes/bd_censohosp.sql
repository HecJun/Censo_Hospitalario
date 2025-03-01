-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2025 a las 20:48:00
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
-- Base de datos: `bd_censohosp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_egreso` date NOT NULL,
  `observacion` varchar(20) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_subservicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `observacion` varchar(20) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_subservicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `fecha_ingreso`, `observacion`, `id_paciente`, `id_subservicio`) VALUES
(1, '2025-01-28', NULL, 1, 1),
(2, '2025-01-22', NULL, 2, 2),
(3, '2025-02-01', NULL, 3, 3),
(4, '2025-01-30', NULL, 4, 4),
(5, '2025-01-27', NULL, 5, 5),
(6, '2025-01-27', NULL, 7, 13),
(7, '2025-01-27', NULL, 8, 14),
(8, '2025-01-23', NULL, 9, 15),
(9, '2025-01-28', NULL, 10, 16),
(10, '2025-01-31', NULL, 11, 17),
(11, '2025-01-29', NULL, 12, 18),
(12, '2025-01-30', NULL, 13, 19),
(13, '2025-01-26', NULL, 14, 20),
(14, '2025-01-26', NULL, 14, 20),
(15, '2025-01-27', NULL, 15, 26),
(16, '2025-01-30', NULL, 16, 27),
(17, '2025-02-01', NULL, 17, 28),
(18, '2025-01-30', NULL, 18, 29),
(19, '2025-01-31', NULL, 19, 30),
(20, '2025-01-27', NULL, 20, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `dni`, `nombre`, `edad`) VALUES
(1, NULL, 'Eithan Amir Sánchez Mendoza', NULL),
(2, NULL, 'Enzo Lionel Davila Velez', NULL),
(3, NULL, 'Ailany Stacy Barrantes Huaman', NULL),
(4, NULL, 'Diego Alexander Vargas Barboza', NULL),
(5, NULL, 'Ivan Samuel Castillo Villalobos', NULL),
(6, NULL, 'Emily Borjas Fuentes', NULL),
(7, NULL, 'Edrian Herrera Cubas', NULL),
(8, NULL, 'Eimy Sanchez Mendoza', NULL),
(9, NULL, 'Mateo Rivera Rodriguez', NULL),
(10, NULL, 'Benjamin Galindo Manayay', NULL),
(11, NULL, 'Fariol Saavedra Ramirez', NULL),
(12, NULL, 'Mayte Bernabe Flores', NULL),
(13, NULL, 'Luz Ferroñan Montalvan', NULL),
(14, NULL, 'Diana Sanchez Finquin', NULL),
(15, NULL, 'Aitana Diaz Quesquey', NULL),
(16, NULL, 'Mateo Estela Culqui', NULL),
(17, NULL, 'Lucas Mateo Cubas Arteaga', NULL),
(18, NULL, 'Valetina Caello Urapari', NULL),
(19, NULL, 'Liban Fernandez Orrillo', NULL),
(20, NULL, 'Leonel Alexander Rojas Rios', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `total_camas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `total_camas`) VALUES
(1, 'Pediatria', 37),
(2, 'Ginocologia y Obstetricia', 51),
(3, 'Cirugia', 55),
(4, 'Medicina', 50),
(5, 'Emergencia', 28),
(6, 'UCI', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subservicios`
--

CREATE TABLE `subservicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `num_cama` varchar(8) NOT NULL,
  `estado` varchar(15) NOT NULL DEFAULT 'Desocupada',
  `id_servicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subservicios`
--

INSERT INTO `subservicios` (`id`, `nombre`, `num_cama`, `estado`, `id_servicio`) VALUES
(1, 'Lactantes', 'L-1', 'Ocupada', 1),
(2, 'Lactantes', 'L-2', 'Ocupada', 1),
(3, 'Lactantes', 'L-3', 'Ocupada', 1),
(4, 'Lactantes', 'L-4', 'Ocupada', 1),
(5, 'Lactantes', 'L-5', 'Ocupada', 1),
(6, 'Lactantes', 'L-6', 'Desocupada', 1),
(7, 'Lactantes', 'L-7', 'Desocupada', 1),
(8, 'Lactantes', 'L-8', 'Desocupada', 1),
(9, 'Lactantes', 'L-9', 'Desocupada', 1),
(10, 'Lactantes', 'L-10', 'Desocupada', 1),
(11, 'Lactantes', 'L-11', 'Desocupada', 1),
(12, 'Lactantes', 'L-12', 'Desocupada', 1),
(13, 'Pre Escolares', 'PE-1', 'Ocupada', 1),
(14, 'Pre Escolares', 'PE-2', 'Ocupada', 1),
(15, 'Pre Escolares', 'PE-3', 'Ocupada', 1),
(16, 'Pre Escolares', 'PE-4', 'Ocupada', 1),
(17, 'Pre Escolares', 'PE-5', 'Ocupada', 1),
(18, 'Pre Escolares', 'PE-6', 'Ocupada', 1),
(19, 'Pre Escolares', 'PE-7', 'Ocupada', 1),
(20, 'Pre Escolares', 'PE-8', 'Ocupada', 1),
(21, 'Pre Escolares', 'PE-9', 'Desocupada', 1),
(22, 'Pre Escolares', 'PE-10', 'Desocupada', 1),
(23, 'Pre Escolares', 'PE-11', 'Desocupada', 1),
(24, 'Pre Escolares', 'PE-12', 'Desocupada', 1),
(25, 'Pre Escolares', 'PE-13', 'Desocupada', 1),
(26, 'Neonatologia', 'N-1', 'Ocupada', 1),
(27, 'Neonatologia', 'N-2', 'Ocupada', 1),
(28, 'Neonatologia', 'N-3', 'Ocupada', 1),
(29, 'Neonatologia', 'N-4', 'Ocupada', 1),
(30, 'Neonatologia', 'N-5', 'Ocupada', 1),
(31, 'Neonatologia', 'N-6', 'Ocupada', 1),
(32, 'Neonatologia', 'N-7', 'Desocupada', 1),
(33, 'Neonatologia', 'N-8', 'Desocupada', 1),
(34, 'Neonatologia', 'N-9', 'Desocupada', 1),
(35, 'Neonatologia', 'N-10', 'Desocupada', 1),
(36, 'Neonatologia', 'N-11', 'Desocupada', 1),
(37, 'Neonatologia', 'N-12', 'Desocupada', 1),
(38, 'Aro A', 'A.A-1', 'Desocupada', 2),
(39, 'Aro A', 'A.A-2', 'Desocupada', 2),
(40, 'Aro A', 'A.A-3', 'Desocupada', 2),
(41, 'Aro A', 'A.A-4', 'Desocupada', 2),
(42, 'Aro A', 'A.A-5', 'Desocupada', 2),
(43, 'Aro A', 'A.A-6', 'Desocupada', 2),
(44, 'Aro A', 'A.A-7', 'Desocupada', 2),
(45, 'Aro A', 'A.A-8', 'Desocupada', 2),
(46, 'Aro A', 'A.A-9', 'Desocupada', 2),
(47, 'Aro A', 'A.A-10', 'Desocupada', 2),
(48, 'Aro A', 'A.A-11', 'Desocupada', 2),
(49, 'Aro A', 'A.A-12', 'Desocupada', 2),
(50, 'Aro B', 'A.B-1', 'Desocupada', 2),
(51, 'Aro B', 'A.B-2', 'Desocupada', 2),
(52, 'Aro B', 'A.B-3', 'Desocupada', 2),
(53, 'Aro B', 'A.B-4', 'Desocupada', 2),
(54, 'Aro B', 'A.B-5', 'Desocupada', 2),
(55, 'Aro B', 'A.B-6', 'Desocupada', 2),
(56, 'Aro B', 'A.B-7', 'Desocupada', 2),
(57, 'Aro B', 'A.B-8', 'Desocupada', 2),
(58, 'Aro B', 'A.B-9', 'Desocupada', 2),
(59, 'Aro B', 'A.B-10', 'Desocupada', 2),
(60, 'Aro B', 'A.B-11', 'Desocupada', 2),
(61, 'Aro B', 'A.B-12', 'Desocupada', 2),
(62, 'Puerperio', 'P-1', 'Desocupada', 2),
(63, 'Puerperio', 'P-2', 'Desocupada', 2),
(64, 'Puerperio', 'P-3', 'Desocupada', 2),
(65, 'Puerperio', 'P-4', 'Desocupada', 2),
(66, 'Puerperio', 'P-5', 'Desocupada', 2),
(67, 'Puerperio', 'P-6', 'Desocupada', 2),
(68, 'Puerperio', 'P-7', 'Desocupada', 2),
(69, 'Puerperio', 'P-8', 'Desocupada', 2),
(70, 'Puerperio', 'P-9', 'Desocupada', 2),
(71, 'Puerperio', 'P-10', 'Desocupada', 2),
(72, 'Puerperio', 'P-11', 'Desocupada', 2),
(73, 'Puerperio', 'P-12', 'Desocupada', 2),
(74, 'Puerperio', 'P-13', 'Desocupada', 2),
(75, 'Ginecologia', 'G-1', 'Desocupada', 2),
(76, 'Ginecologia', 'G-2', 'Desocupada', 2),
(77, 'Ginecologia', 'G-3', 'Desocupada', 2),
(78, 'Ginecologia', 'G-4', 'Desocupada', 2),
(79, 'Ginecologia', 'G-5', 'Desocupada', 2),
(80, 'Ginecologia', 'G-6', 'Desocupada', 2),
(81, 'Ginecologia', 'G-7', 'Desocupada', 2),
(82, 'Ginecologia', 'G-8', 'Desocupada', 2),
(83, 'Ginecologia', 'G-9', 'Desocupada', 2),
(84, 'Ginecologia', 'G-10', 'Desocupada', 2),
(85, 'Ginecologia', 'G-11', 'Desocupada', 2),
(86, 'Ginecologia', 'G-12', 'Desocupada', 2),
(87, 'Ginecologia', 'G-13', 'Desocupada', 2),
(88, 'Ginecologia', 'G-14', 'Desocupada', 2),
(89, 'Cir. Varones', 'C.V-1', 'Desocupada', 3),
(90, 'Cir. Varones', 'C.V-2', 'Desocupada', 3),
(91, 'Cir. Varones', 'C.V-3', 'Desocupada', 3),
(92, 'Cir. Varones', 'C.V-4', 'Desocupada', 3),
(93, 'Cir. Varones', 'C.V-5', 'Desocupada', 3),
(94, 'Cir. Varones', 'C.V-6', 'Desocupada', 3),
(95, 'Cir. Varones', 'C.V-7', 'Desocupada', 3),
(96, 'Cir. Varones', 'C.V-8', 'Desocupada', 3),
(97, 'Cir. Varones', 'C.V-9', 'Desocupada', 3),
(98, 'Cir. Varones', 'C.V-10', 'Desocupada', 3),
(99, 'Cir. Varones', 'C.V-11', 'Desocupada', 3),
(100, 'Cir. Varones', 'C.V-12', 'Desocupada', 3),
(101, 'Cir. Varones', 'C.V-13', 'Desocupada', 3),
(102, 'Cir. Varones', 'C.V-14', 'Desocupada', 3),
(103, 'Cir. Varones', 'C.V-15', 'Desocupada', 3),
(104, 'Cir. Mujeres', 'C.M-1', 'Desocupada', 3),
(105, 'Cir. Mujeres', 'C.M-2', 'Desocupada', 3),
(106, 'Cir. Mujeres', 'C.M-3', 'Desocupada', 3),
(107, 'Cir. Mujeres', 'C.M-4', 'Desocupada', 3),
(108, 'Cir. Mujeres', 'C.M-5', 'Desocupada', 3),
(109, 'Cir. Mujeres', 'C.M-6', 'Desocupada', 3),
(110, 'Cir. Mujeres', 'C.M-7', 'Desocupada', 3),
(111, 'Cir. Mujeres', 'C.M-8', 'Desocupada', 3),
(112, 'Cir. Mujeres', 'C.M-9', 'Desocupada', 3),
(113, 'Cir. Mujeres', 'C.M-10', 'Desocupada', 3),
(114, 'Cir. Mujeres', 'C.M-11', 'Desocupada', 3),
(115, 'Cir. Mujeres', 'C.M-12', 'Desocupada', 3),
(116, 'Cir. Mujeres', 'C.M-13', 'Desocupada', 3),
(117, 'Cir. Mujeres', 'C.M-14', 'Desocupada', 3),
(118, 'Cir. Mujeres', 'C.M-15', 'Desocupada', 3),
(119, 'Traumatologia', 'T-1', 'Desocupada', 3),
(120, 'Traumatologia', 'T-2', 'Desocupada', 3),
(121, 'Traumatologia', 'T-3', 'Desocupada', 3),
(122, 'Traumatologia', 'T-4', 'Desocupada', 3),
(123, 'Traumatologia', 'T-5', 'Desocupada', 3),
(124, 'Traumatologia', 'T-6', 'Desocupada', 3),
(125, 'Traumatologia', 'T-7', 'Desocupada', 3),
(126, 'Traumatologia', 'T-8', 'Desocupada', 3),
(127, 'Traumatologia', 'T-9', 'Desocupada', 3),
(128, 'Traumatologia', 'T-10', 'Desocupada', 3),
(129, 'Traumatologia', 'T-11', 'Desocupada', 3),
(130, 'Traumatologia', 'T-12', 'Desocupada', 3),
(131, 'Traumatologia', 'T-13', 'Desocupada', 3),
(132, 'Traumatologia', 'T-14', 'Desocupada', 3),
(133, 'Quemados', 'Q-1', 'Desocupada', 3),
(134, 'Quemados', 'Q-2', 'Desocupada', 3),
(135, 'Quemados', 'Q-3', 'Desocupada', 3),
(136, 'Quemados', 'Q-4', 'Desocupada', 3),
(137, 'Quemados', 'Q-5', 'Desocupada', 3),
(138, 'Quemados', 'Q-6', 'Desocupada', 3),
(139, 'Quemados', 'Q-7', 'Desocupada', 3),
(140, 'Quemados', 'Q-8', 'Desocupada', 3),
(141, 'Quemados', 'Q-9', 'Desocupada', 3),
(142, 'Quemados', 'Q-10', 'Desocupada', 3),
(143, 'Quemados', 'Q-11', 'Desocupada', 3),
(144, 'Med. Varones', 'M.V-1', 'Desocupada', 4),
(145, 'Med. Varones', 'M.V-2', 'Desocupada', 4),
(146, 'Med. Varones', 'M.V-3', 'Desocupada', 4),
(147, 'Med. Varones', 'M.V-4', 'Desocupada', 4),
(148, 'Med. Varones', 'M.V-5', 'Desocupada', 4),
(149, 'Med. Varones', 'M.V-6', 'Desocupada', 4),
(150, 'Med. Varones', 'M.V-7', 'Desocupada', 4),
(151, 'Med. Varones', 'M.V-8', 'Desocupada', 4),
(152, 'Med. Varones', 'M.V-9', 'Desocupada', 4),
(153, 'Med. Varones', 'M.V-10', 'Desocupada', 4),
(154, 'Med. Varones', 'M.V-11', 'Desocupada', 4),
(155, 'Med. Varones', 'M.V-12', 'Desocupada', 4),
(156, 'Med. Varones', 'M.V-13', 'Desocupada', 4),
(157, 'Med. Varones', 'M.V-14', 'Desocupada', 4),
(158, 'Med. Varones', 'M.V-15', 'Desocupada', 4),
(159, 'Med. Varones', 'M.V-16', 'Desocupada', 4),
(160, 'Med. Varones', 'M.V-17', 'Desocupada', 4),
(161, 'Med. Varones', 'M.V-18', 'Desocupada', 4),
(162, 'Med. Varones', 'M.V-19', 'Desocupada', 4),
(163, 'Med. Varones', 'M.V-20', 'Desocupada', 4),
(164, 'Med. Mujeres', 'M.M-1', 'Desocupada', 4),
(165, 'Med. Mujeres', 'M.M-2', 'Desocupada', 4),
(166, 'Med. Mujeres', 'M.M-3', 'Desocupada', 4),
(167, 'Med. Mujeres', 'M.M-4', 'Desocupada', 4),
(168, 'Med. Mujeres', 'M.M-5', 'Desocupada', 4),
(169, 'Med. Mujeres', 'M.M-6', 'Desocupada', 4),
(170, 'Med. Mujeres', 'M.M-7', 'Desocupada', 4),
(171, 'Med. Mujeres', 'M.M-8', 'Desocupada', 4),
(172, 'Med. Mujeres', 'M.M-9', 'Desocupada', 4),
(173, 'Med. Mujeres', 'M.M-10', 'Desocupada', 4),
(174, 'Med. Mujeres', 'M.M-11', 'Desocupada', 4),
(175, 'Med. Mujeres', 'M.M-12', 'Desocupada', 4),
(176, 'Med. Mujeres', 'M.M-13', 'Desocupada', 4),
(177, 'Med. Mujeres', 'M.M-14', 'Desocupada', 4),
(178, 'Med. Mujeres', 'M.M-15', 'Desocupada', 4),
(179, 'Med. Mujeres', 'M.M-16', 'Desocupada', 4),
(180, 'Med. Mujeres', 'M.M-17', 'Desocupada', 4),
(181, 'Med. Mujeres', 'M.M-18', 'Desocupada', 4),
(182, 'Med. Mujeres', 'M.M-19', 'Desocupada', 4),
(183, 'UNET', 'UN-1', 'Desocupada', 4),
(184, 'UNET', 'UN-2', 'Desocupada', 4),
(185, 'UNET', 'UN-3', 'Desocupada', 4),
(186, 'UNET', 'UN-4', 'Desocupada', 4),
(187, 'UNET', 'UN-5', 'Desocupada', 4),
(188, 'UNET', 'UN-6', 'Desocupada', 4),
(189, 'UNET', 'UN-7', 'Desocupada', 4),
(190, 'UNET', 'UN-8', 'Desocupada', 4),
(191, 'UNET', 'UN-9', 'Desocupada', 4),
(192, 'UNET', 'UN-10', 'Desocupada', 4),
(193, 'UNET', 'UN-11', 'Desocupada', 4),
(194, 'Obs. 01', 'O.01-1', 'Desocupada', 5),
(195, 'Obs. 01', 'O.01-2', 'Desocupada', 5),
(196, 'Obs. 01', 'O.01-3', 'Desocupada', 5),
(197, 'Obs. 03(Mixtas)', 'O.03-1', 'Desocupada', 5),
(198, 'Obs. 03(Mixtas)', 'O.03-2', 'Desocupada', 5),
(199, 'Obs. 03(Mixtas)', 'O.03-3', 'Desocupada', 5),
(200, 'Obs. 03(Mixtas)', 'O.03-4', 'Desocupada', 5),
(201, 'Obs. 03(Mixtas)', 'O.03-5', 'Desocupada', 5),
(202, 'Obs. Varones', 'O.V-1', 'Desocupada', 5),
(203, 'Obs. Varones', 'O.V-2', 'Desocupada', 5),
(204, 'Obs. Varones', 'O.V-3', 'Desocupada', 5),
(205, 'Obs. Varones', 'O.V-4', 'Desocupada', 5),
(206, 'Obs. Varones', 'O.V-5', 'Desocupada', 5),
(207, 'Obs. Varones', 'O.V-6', 'Desocupada', 5),
(208, 'Obs. Mujeres', 'O.M-1', 'Desocupada', 5),
(209, 'Obs. Mujeres', 'O.M-2', 'Desocupada', 5),
(210, 'Obs. Mujeres', 'O.M-3', 'Desocupada', 5),
(211, 'Obs. Mujeres', 'O.M-4', 'Desocupada', 5),
(212, 'Obs. Mujeres', 'O.M-5', 'Desocupada', 5),
(213, 'Obs. Mujeres', 'O.M-6', 'Desocupada', 5),
(214, 'Obs. Pediatria', 'O.P-1', 'Desocupada', 5),
(215, 'Obs. Pediatria', 'O.P-2', 'Desocupada', 5),
(216, 'Obs. Pediatria', 'O.P-3', 'Desocupada', 5),
(217, 'Obs. Pediatria', 'O.P-4', 'Desocupada', 5),
(218, 'Obs. Pediatria', 'O.P-5', 'Desocupada', 5),
(219, 'Obs. Pediatria', 'O.P-6', 'Desocupada', 5),
(220, 'Obs. Pediatria', 'O.P-7', 'Desocupada', 5),
(221, 'Obs. Pediatria', 'O.P-8', 'Desocupada', 5),
(222, 'UCI Adultos', 'U.A-1', 'Desocupada', 6),
(223, 'UCI Adultos', 'U.A-2', 'Desocupada', 6),
(224, 'UCI Adultos', 'U.A-3', 'Desocupada', 6),
(225, 'UCI Adultos', 'U.A-4', 'Desocupada', 6),
(226, 'UCI Adultos', 'U.A-5', 'Desocupada', 6),
(227, 'UCI NEO', 'U.N-1', 'Desocupada', 6),
(228, 'UCI NEO', 'U.N-2', 'Desocupada', 6),
(229, 'UCI NEO', 'U.N-3', 'Desocupada', 6),
(230, 'UCI NEO', 'U.N-4', 'Desocupada', 6),
(231, 'UCI NEO', 'U.N-5', 'Desocupada', 6),
(232, 'UCI NEO', 'U.N-6', 'Desocupada', 6),
(233, 'UCI NEO', 'U.N-7', 'Desocupada', 6),
(234, 'UCI NEO', 'U.N-8', 'Desocupada', 6),
(235, 'UCI NEO', 'U.N-9', 'Desocupada', 6),
(236, 'UCI NEO', 'U.N-10', 'Desocupada', 6),
(237, 'UCI NEO', 'U.N-11', 'Desocupada', 6),
(238, 'UCI NEO', 'U.N-12', 'Desocupada', 6),
(239, 'UCI NEO', 'U.N-13', 'Desocupada', 6),
(240, 'UCI NEO', 'U.N-14', 'Desocupada', 6),
(241, 'UCI NEO', 'U.N-15', 'Desocupada', 6),
(242, 'UCI NEO', 'U.N-16', 'Desocupada', 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subservicios`
--
ALTER TABLE `subservicios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `subservicios`
--
ALTER TABLE `subservicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
