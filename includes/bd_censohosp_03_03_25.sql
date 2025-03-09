-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2025 a las 21:09:44
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

--
-- Volcado de datos para la tabla `egresos`
--

INSERT INTO `egresos` (`id`, `fecha_egreso`, `observacion`, `id_paciente`, `id_subservicio`) VALUES
(1, '2025-02-01', 'Paso a Lactantes', 3, 26),
(2, '2025-02-01', NULL, 35, 50),
(3, '2025-02-01', NULL, 36, 51),
(4, '2025-02-01', NULL, 40, 52),
(5, '2025-02-01', NULL, 45, 62),
(6, '2025-02-01', NULL, 56, 89),
(7, '2025-02-01', NULL, 61, 90),
(8, '2025-02-01', NULL, 66, 104),
(9, '2025-02-01', NULL, 69, 105),
(10, '2025-02-01', NULL, 70, 106),
(11, '2025-02-01', NULL, 72, 119),
(12, '2025-02-01', NULL, 75, 133),
(13, '2025-02-01', NULL, 78, 134),
(14, '2025-02-01', NULL, 98, 164),
(15, '2025-02-01', NULL, 123, 194),
(16, '2025-02-01', NULL, 136, 202),
(17, '2025-02-01', 'Fallecio', 143, 208);

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
(20, '2025-01-27', NULL, 20, 31),
(21, '2025-02-01', NULL, 3, 32),
(22, '2025-02-01', NULL, 27, 38),
(23, '2025-02-01', NULL, 29, 39),
(24, '2025-02-01', NULL, 32, 40),
(25, '2025-02-01', NULL, 33, 50),
(26, '2025-01-31', NULL, 34, 51),
(27, '2025-01-30', NULL, 35, 52),
(28, '2025-01-30', NULL, 36, 53),
(29, '2025-02-01', NULL, 37, 54),
(30, '2025-01-31', NULL, 38, 55),
(31, '2025-02-01', NULL, 39, 56),
(32, '2025-01-30', NULL, 40, 57),
(33, '2025-02-01', NULL, 41, 75),
(34, '2025-02-01', NULL, 42, 76),
(35, '2025-02-01', NULL, 43, 77),
(36, '2025-02-01', NULL, 44, 62),
(37, '2025-01-30', NULL, 45, 63),
(38, '2025-02-01', NULL, 46, 64),
(39, '2025-02-01', NULL, 47, 65),
(40, '2025-02-01', NULL, 48, 66),
(41, '2025-02-01', NULL, 49, 67),
(42, '2025-02-01', NULL, 50, 68),
(43, '2025-02-01', NULL, 51, 69),
(44, '2025-02-01', NULL, 52, 89),
(45, '2025-01-25', NULL, 53, 90),
(46, '2025-02-27', NULL, 54, 91),
(47, '2025-01-31', NULL, 55, 92),
(48, '2025-01-23', NULL, 56, 93),
(49, '2025-01-30', NULL, 57, 94),
(50, '2025-02-01', NULL, 54, 95),
(53, '2025-01-28', NULL, 59, 96),
(54, '2025-01-21', NULL, 60, 97),
(55, '2025-01-14', NULL, 61, 98),
(56, '2025-01-27', NULL, 62, 99),
(57, '2025-01-31', NULL, 63, 100),
(58, '2025-01-31', NULL, 64, 104),
(59, '2025-02-01', NULL, 65, 105),
(60, '2025-01-30', NULL, 66, 106),
(61, '2025-01-30', NULL, 67, 107),
(63, '2025-01-29', NULL, 68, 108),
(64, '2025-01-28', NULL, 69, 109),
(65, '2025-01-29', NULL, 70, 110),
(66, '2025-01-09', NULL, 71, 119),
(67, '2025-01-23', NULL, 72, 120),
(68, '2025-01-27', NULL, 73, 121),
(69, '2025-01-23', NULL, 74, 122),
(70, '2025-01-23', NULL, 75, 133),
(71, '2025-02-01', NULL, 76, 134),
(72, '2025-01-30', NULL, 77, 135),
(73, '2025-01-22', NULL, 78, 136),
(74, '2025-01-20', NULL, 79, 144),
(75, '2025-01-25', NULL, 80, 145),
(76, '2025-01-20', NULL, 81, 146),
(77, '2025-01-27', NULL, 82, 147),
(78, '2025-01-16', NULL, 83, 148),
(79, '2025-01-28', NULL, 84, 149),
(80, '2025-01-27', NULL, 85, 150),
(81, '2025-01-29', NULL, 86, 151),
(82, '2025-01-19', NULL, 87, 152),
(83, '2025-01-09', NULL, 88, 153),
(84, '2025-01-23', NULL, 89, 154),
(85, '2025-01-28', NULL, 90, 155),
(86, '2025-01-09', NULL, 91, 156),
(87, '2025-01-31', NULL, 92, 157),
(88, '2025-01-19', NULL, 93, 158),
(89, '2025-01-30', NULL, 94, 159),
(90, '2025-01-27', NULL, 95, 160),
(91, '2025-01-24', NULL, 96, 164),
(92, '2025-02-01', NULL, 97, 165),
(93, '2025-01-22', NULL, 98, 166),
(94, '2025-01-31', NULL, 100, 167),
(95, '2025-01-27', NULL, 101, 168),
(96, '2025-01-31', NULL, 102, 169),
(97, '2025-01-27', NULL, 103, 170),
(98, '2025-01-30', NULL, 117, 171),
(99, '2025-01-21', NULL, 104, 172),
(100, '2025-01-28', NULL, 105, 173),
(101, '2024-12-29', NULL, 106, 174),
(102, '2025-02-01', NULL, 107, 175),
(103, '2025-01-23', NULL, 108, 176),
(104, '2025-01-22', NULL, 109, 177),
(105, '2025-02-01', NULL, 110, 178),
(106, '2025-01-28', NULL, 112, 179),
(107, '2025-01-30', NULL, 113, 180),
(108, '2025-01-24', NULL, 114, 181),
(109, '2025-01-24', NULL, 118, 182),
(110, '2025-01-21', NULL, 119, 183),
(111, '2025-01-22', NULL, 120, 184),
(112, '2025-01-23', NULL, 121, 185),
(113, '2025-01-31', NULL, 122, 186),
(114, '2025-01-27', NULL, 123, 194),
(115, '2025-01-30', NULL, 124, 195),
(116, '2025-01-31', NULL, 125, 196),
(117, '2025-01-31', NULL, 126, 197),
(118, '2025-01-30', NULL, 127, 198),
(119, '2025-01-29', NULL, 128, 199),
(120, '2025-02-01', NULL, 129, 200),
(121, '2025-01-30', NULL, 130, 201),
(122, '2025-01-29', NULL, 131, 202),
(123, '2025-01-31', NULL, 132, 203),
(124, '2025-01-31', NULL, 133, 204),
(125, '2025-01-29', NULL, 134, 205),
(126, '2025-02-01', NULL, 135, 206),
(127, '2025-02-01', NULL, 136, 207),
(128, '2025-02-01', NULL, 137, 202),
(129, '2025-01-25', NULL, 138, 208),
(130, '2025-01-25', NULL, 139, 209),
(132, '2025-01-26', NULL, 140, 210),
(133, '2025-01-29', NULL, 141, 211),
(134, '2025-01-29', NULL, 142, 212),
(135, '2025-01-27', NULL, 143, 213),
(136, '2025-02-01', NULL, 144, 214),
(137, '2025-02-01', NULL, 145, 215),
(138, '2025-02-01', NULL, 146, 216),
(139, '2025-01-21', NULL, 147, 222),
(140, '2025-02-01', NULL, 148, 223),
(141, '2025-01-13', NULL, 149, 224),
(142, '2025-01-18', NULL, 150, 225),
(143, '2025-01-31', NULL, 151, 226);

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
(20, NULL, 'Leonel Alexander Rojas Rios', NULL),
(21, NULL, 'Flor Chemba Heredia', NULL),
(22, NULL, 'Wendy Rivas Valencia', NULL),
(23, NULL, 'Martha Cueva Bernilla', NULL),
(24, NULL, 'Maribel Angeles Diaz', NULL),
(25, NULL, 'Narda Reategui Ordoñes', NULL),
(26, NULL, 'Ruth Lachos Huementumi', NULL),
(27, NULL, 'Loren Tenorio Pizarro', NULL),
(28, NULL, 'Elsa Chuquimongo Mirende ', NULL),
(29, NULL, 'Hark Mendoza de la Cruz', NULL),
(30, NULL, 'Rachi Romero Melaydi', NULL),
(31, NULL, 'Irma Cueva Cueva', NULL),
(32, NULL, 'Lenny Serevrino Siesquen', NULL),
(33, NULL, 'Yesenia Salasar Leyva', NULL),
(34, NULL, 'Delicia Ramos Nicademo', NULL),
(35, NULL, 'Maryori Lalopu Chicoma', NULL),
(36, NULL, 'Elena Cunya Pinares', NULL),
(37, NULL, 'Leydi Gines Carrillo', NULL),
(38, NULL, 'Shirley Chira Mochica', NULL),
(39, NULL, 'Selena Carranza Mendoza', NULL),
(40, NULL, 'Dayami Potalatino Asmet', NULL),
(41, NULL, 'Micaela Cisneros Cardoza', NULL),
(42, NULL, 'Elita Sanchez Flores', NULL),
(43, NULL, 'Lady Juape Llaguento', NULL),
(44, NULL, 'Graciela Tantarico Castro', NULL),
(45, NULL, 'Nahomi Millacaltus Fuentes', NULL),
(46, NULL, 'Rossaly Fernandez Cabanillas', NULL),
(47, NULL, 'Ingrid Deza Mendoza', NULL),
(48, NULL, 'Maria Sara Pedraza Perez', NULL),
(49, NULL, 'Elizabeth Santamaria Fernandez', NULL),
(50, NULL, 'Marissela Victoria Hernandez Esqueche', NULL),
(51, NULL, 'Carmen Yohsny Guerrero Culqui', NULL),
(52, NULL, 'Luis Albert Hernandez Ignacio', NULL),
(53, NULL, 'Andres Guerrero Castillo', NULL),
(54, NULL, 'Jack Garcia Diaz', NULL),
(55, NULL, 'Johan Velazquez Rodriguez', NULL),
(56, NULL, 'Jose Bustamante Perales', NULL),
(57, NULL, 'Rodolfo Tonardo Llontop', NULL),
(58, NULL, 'Isac Fatana Toboya', NULL),
(59, NULL, 'Josias Abel Calvay Cueva', NULL),
(60, NULL, 'Victor Espinoza Idrogo', NULL),
(61, NULL, 'Manuel Custodio Eneque', NULL),
(62, NULL, 'Luis Callaca Montalvo', NULL),
(63, NULL, 'Junior Cuso Silva', NULL),
(64, NULL, 'Ashley Sanchez Rodriguez', NULL),
(65, NULL, 'Maria Barrantes Perez', NULL),
(66, NULL, 'Lisbeth Vega Lopez', NULL),
(67, NULL, 'Paula Amaya Guzman', NULL),
(68, NULL, 'Tomasa Casuso Samillan', NULL),
(69, NULL, 'Rosa Ruiz Osorio', NULL),
(70, NULL, 'Maria Petronila Lumbre Silva', NULL),
(71, NULL, 'Joseph Heredia Solano', NULL),
(72, NULL, 'Juan Carlos Pisfil Castillo', NULL),
(73, NULL, 'Francisco Humanta Quiroz', NULL),
(74, NULL, 'Mario Chirinos Saavedra', NULL),
(75, NULL, 'Eithan Flores Torres', NULL),
(76, NULL, 'Carmen Rosa Gomez Barrantes', NULL),
(77, NULL, 'Ashley Veli Labingo', NULL),
(78, NULL, 'Junior Ramirez Flores', NULL),
(79, NULL, 'Justino Pongo Ramirez', NULL),
(80, NULL, 'Godofredo Cruz Fermandez', NULL),
(81, NULL, 'Maximandro Calle Tinco', NULL),
(82, NULL, 'Fabriciano Cueva Espinoza', NULL),
(83, NULL, 'Vicente Vilchez Morena', NULL),
(84, NULL, 'Sebastian Zeña Seclen', NULL),
(85, NULL, 'Victor Aguilar Suchero', NULL),
(86, NULL, 'Gaspar Juan Santos', NULL),
(87, NULL, 'Bautista Roncio Marlon', NULL),
(88, NULL, 'Kenys Galiano Gonzales', NULL),
(89, NULL, 'Luis Izquierdo Campos', NULL),
(90, NULL, 'Jose Aquino Puicon', NULL),
(91, NULL, 'Albart Lluen Jacinto', NULL),
(92, NULL, 'Felix Reyes Peña', NULL),
(93, NULL, 'Marcos Urbina Soto', NULL),
(94, NULL, 'Jose Gutierres Leon', NULL),
(95, NULL, 'Alvaro Ortiz Vasquez', NULL),
(96, NULL, 'Edith Abuhaba Castillo', NULL),
(97, NULL, 'Yessica Sanchez Fernandez', NULL),
(98, NULL, 'Bernardina de la Cruz Rojas', NULL),
(100, NULL, 'Veronica Cueva Samillan', NULL),
(101, NULL, 'Alejandra Fuentes Hernandez ', NULL),
(102, NULL, 'Anita Hernandez Cristoba', NULL),
(103, NULL, 'Dorotea Rodriguez Cieza', NULL),
(104, NULL, 'Juana Gamero Heredia', NULL),
(105, NULL, 'Katherine Perez Saavedra', NULL),
(106, NULL, 'Nelly Davila Hernandez', NULL),
(107, NULL, 'Jacinta Mel de Gonzales', NULL),
(108, NULL, 'Lemela Llontop Effio', NULL),
(109, NULL, 'Maria Salazar Fernandez', NULL),
(110, NULL, 'Ylda Tacure Cordova', NULL),
(112, NULL, 'Linares Tello Danisa', NULL),
(113, NULL, 'Maria Cipion Aricache', NULL),
(114, NULL, 'Daydamia Cruz de Tello', NULL),
(117, NULL, 'Libani Pasapera Ramirez', NULL),
(118, NULL, 'Luz Hernandez Espinoza', NULL),
(119, NULL, 'Roberth Rodriguez Carpio', NULL),
(120, NULL, 'Orlando Morales Ipanaque', NULL),
(121, NULL, 'Orlando Vera Davila', NULL),
(122, NULL, 'Eduardo Chavez Moncada', NULL),
(123, NULL, 'Marbila Apagueño Chota', NULL),
(124, NULL, 'Maria Chapoñan de Zeña', NULL),
(125, NULL, 'Alcibiades Hurtado Diaz', NULL),
(126, NULL, 'Eva Reque Perez', NULL),
(127, NULL, 'Carmela Vasquez Vasquez', NULL),
(128, NULL, 'Ruth Santa Cruz Piscoya', NULL),
(129, NULL, 'Maria Diesquen Santamaria', NULL),
(130, NULL, 'Maria Diaz Maloves', NULL),
(131, NULL, 'Hector Diaz Pinillos', NULL),
(132, NULL, 'Cesar Martinez Carrillo', NULL),
(133, NULL, 'Orlando Bazan Purisaga', NULL),
(134, NULL, 'Alberto Serquen Vilchez', NULL),
(135, NULL, 'Marlon Soplapuco Falen', NULL),
(136, NULL, 'Tomas Coronado Paico', NULL),
(137, NULL, 'Francisco Cubas Rulasto', NULL),
(138, NULL, 'Magdalena Vilches Manayalle', NULL),
(139, NULL, 'Brenda Cespedes Davila', NULL),
(140, NULL, 'Matilda Acha Alvarez', NULL),
(141, NULL, 'Esther Silva Tineo', NULL),
(142, NULL, 'Teodolinda Ortiz Susannibor', NULL),
(143, NULL, 'Blanca Perez Mego', NULL),
(144, NULL, 'Justin Chapoñan Matos', NULL),
(145, NULL, 'Sofia Gutierrez Lopez', NULL),
(146, NULL, 'Sebastian Walter Soto', NULL),
(147, NULL, 'Milagros Pupuche Mendoza', NULL),
(148, NULL, 'Smith Gonzales Orosco', NULL),
(149, NULL, 'Adelaida Peregrino Gutierrez', NULL),
(150, NULL, 'Moises Perez Saavedra', NULL),
(151, NULL, 'Luz Maria Vasquez Estela', NULL),
(152, NULL, 'Cajusol Sandoval', NULL),
(153, NULL, 'Chapoñan Alamo', NULL),
(154, NULL, 'Huancas Palacios', NULL),
(155, NULL, 'Vasquez Sanchez', NULL),
(156, NULL, 'Medina Cubas', NULL),
(157, NULL, 'Martinez Leysequia', NULL),
(158, NULL, 'Bonilla Manayalle', NULL),
(159, NULL, 'Villena Ocroñe', NULL),
(161, NULL, 'Olazabal Pacherres', NULL),
(162, NULL, 'Cubas Arizaga', NULL),
(163, NULL, 'Chero Liza', NULL),
(164, NULL, 'Quispe Villbana', NULL),
(165, NULL, 'Siesquen Sandoval', NULL),
(166, NULL, 'Cerna Bustamante', NULL),
(167, NULL, 'Delgado Ramirez', NULL);

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
(26, 'Neonatologia', 'N-1', 'Desocupada', 1),
(27, 'Neonatologia', 'N-2', 'Ocupada', 1),
(28, 'Neonatologia', 'N-3', 'Ocupada', 1),
(29, 'Neonatologia', 'N-4', 'Ocupada', 1),
(30, 'Neonatologia', 'N-5', 'Ocupada', 1),
(31, 'Neonatologia', 'N-6', 'Ocupada', 1),
(32, 'Neonatologia', 'N-7', 'Ocupada', 1),
(33, 'Neonatologia', 'N-8', 'Desocupada', 1),
(34, 'Neonatologia', 'N-9', 'Desocupada', 1),
(35, 'Neonatologia', 'N-10', 'Desocupada', 1),
(36, 'Neonatologia', 'N-11', 'Desocupada', 1),
(37, 'Neonatologia', 'N-12', 'Desocupada', 1),
(38, 'Aro A', 'A.A-1', 'Ocupada', 2),
(39, 'Aro A', 'A.A-2', 'Ocupada', 2),
(40, 'Aro A', 'A.A-3', 'Ocupada', 2),
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
(53, 'Aro B', 'A.B-4', 'Ocupada', 2),
(54, 'Aro B', 'A.B-5', 'Ocupada', 2),
(55, 'Aro B', 'A.B-6', 'Ocupada', 2),
(56, 'Aro B', 'A.B-7', 'Ocupada', 2),
(57, 'Aro B', 'A.B-8', 'Ocupada', 2),
(58, 'Aro B', 'A.B-9', 'Desocupada', 2),
(59, 'Aro B', 'A.B-10', 'Desocupada', 2),
(60, 'Aro B', 'A.B-11', 'Desocupada', 2),
(61, 'Aro B', 'A.B-12', 'Desocupada', 2),
(62, 'Puerperio', 'P-1', 'Desocupada', 2),
(63, 'Puerperio', 'P-2', 'Ocupada', 2),
(64, 'Puerperio', 'P-3', 'Ocupada', 2),
(65, 'Puerperio', 'P-4', 'Ocupada', 2),
(66, 'Puerperio', 'P-5', 'Ocupada', 2),
(67, 'Puerperio', 'P-6', 'Ocupada', 2),
(68, 'Puerperio', 'P-7', 'Ocupada', 2),
(69, 'Puerperio', 'P-8', 'Ocupada', 2),
(70, 'Puerperio', 'P-9', 'Desocupada', 2),
(71, 'Puerperio', 'P-10', 'Desocupada', 2),
(72, 'Puerperio', 'P-11', 'Desocupada', 2),
(73, 'Puerperio', 'P-12', 'Desocupada', 2),
(74, 'Puerperio', 'P-13', 'Desocupada', 2),
(75, 'Ginecologia', 'G-1', 'Ocupada', 2),
(76, 'Ginecologia', 'G-2', 'Ocupada', 2),
(77, 'Ginecologia', 'G-3', 'Ocupada', 2),
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
(91, 'Cir. Varones', 'C.V-3', 'Ocupada', 3),
(92, 'Cir. Varones', 'C.V-4', 'Ocupada', 3),
(93, 'Cir. Varones', 'C.V-5', 'Ocupada', 3),
(94, 'Cir. Varones', 'C.V-6', 'Ocupada', 3),
(95, 'Cir. Varones', 'C.V-7', 'Ocupada', 3),
(96, 'Cir. Varones', 'C.V-8', 'Ocupada', 3),
(97, 'Cir. Varones', 'C.V-9', 'Ocupada', 3),
(98, 'Cir. Varones', 'C.V-10', 'Ocupada', 3),
(99, 'Cir. Varones', 'C.V-11', 'Ocupada', 3),
(100, 'Cir. Varones', 'C.V-12', 'Ocupada', 3),
(101, 'Cir. Varones', 'C.V-13', 'Desocupada', 3),
(102, 'Cir. Varones', 'C.V-14', 'Desocupada', 3),
(103, 'Cir. Varones', 'C.V-15', 'Desocupada', 3),
(104, 'Cir. Mujeres', 'C.M-1', 'Desocupada', 3),
(105, 'Cir. Mujeres', 'C.M-2', 'Desocupada', 3),
(106, 'Cir. Mujeres', 'C.M-3', 'Desocupada', 3),
(107, 'Cir. Mujeres', 'C.M-4', 'Ocupada', 3),
(108, 'Cir. Mujeres', 'C.M-5', 'Ocupada', 3),
(109, 'Cir. Mujeres', 'C.M-6', 'Ocupada', 3),
(110, 'Cir. Mujeres', 'C.M-7', 'Ocupada', 3),
(111, 'Cir. Mujeres', 'C.M-8', 'Desocupada', 3),
(112, 'Cir. Mujeres', 'C.M-9', 'Desocupada', 3),
(113, 'Cir. Mujeres', 'C.M-10', 'Desocupada', 3),
(114, 'Cir. Mujeres', 'C.M-11', 'Desocupada', 3),
(115, 'Cir. Mujeres', 'C.M-12', 'Desocupada', 3),
(116, 'Cir. Mujeres', 'C.M-13', 'Desocupada', 3),
(117, 'Cir. Mujeres', 'C.M-14', 'Desocupada', 3),
(118, 'Cir. Mujeres', 'C.M-15', 'Desocupada', 3),
(119, 'Traumatologia', 'T-1', 'Desocupada', 3),
(120, 'Traumatologia', 'T-2', 'Ocupada', 3),
(121, 'Traumatologia', 'T-3', 'Ocupada', 3),
(122, 'Traumatologia', 'T-4', 'Ocupada', 3),
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
(135, 'Quemados', 'Q-3', 'Ocupada', 3),
(136, 'Quemados', 'Q-4', 'Ocupada', 3),
(137, 'Quemados', 'Q-5', 'Desocupada', 3),
(138, 'Quemados', 'Q-6', 'Desocupada', 3),
(139, 'Quemados', 'Q-7', 'Desocupada', 3),
(140, 'Quemados', 'Q-8', 'Desocupada', 3),
(141, 'Quemados', 'Q-9', 'Desocupada', 3),
(142, 'Quemados', 'Q-10', 'Desocupada', 3),
(143, 'Quemados', 'Q-11', 'Desocupada', 3),
(144, 'Med. Varones', 'M.V-1', 'Ocupada', 4),
(145, 'Med. Varones', 'M.V-2', 'Ocupada', 4),
(146, 'Med. Varones', 'M.V-3', 'Ocupada', 4),
(147, 'Med. Varones', 'M.V-4', 'Ocupada', 4),
(148, 'Med. Varones', 'M.V-5', 'Ocupada', 4),
(149, 'Med. Varones', 'M.V-6', 'Ocupada', 4),
(150, 'Med. Varones', 'M.V-7', 'Ocupada', 4),
(151, 'Med. Varones', 'M.V-8', 'Ocupada', 4),
(152, 'Med. Varones', 'M.V-9', 'Ocupada', 4),
(153, 'Med. Varones', 'M.V-10', 'Ocupada', 4),
(154, 'Med. Varones', 'M.V-11', 'Ocupada', 4),
(155, 'Med. Varones', 'M.V-12', 'Ocupada', 4),
(156, 'Med. Varones', 'M.V-13', 'Ocupada', 4),
(157, 'Med. Varones', 'M.V-14', 'Ocupada', 4),
(158, 'Med. Varones', 'M.V-15', 'Ocupada', 4),
(159, 'Med. Varones', 'M.V-16', 'Ocupada', 4),
(160, 'Med. Varones', 'M.V-17', 'Ocupada', 4),
(161, 'Med. Varones', 'M.V-18', 'Desocupada', 4),
(162, 'Med. Varones', 'M.V-19', 'Desocupada', 4),
(163, 'Med. Varones', 'M.V-20', 'Desocupada', 4),
(164, 'Med. Mujeres', 'M.M-1', 'Desocupada', 4),
(165, 'Med. Mujeres', 'M.M-2', 'Ocupada', 4),
(166, 'Med. Mujeres', 'M.M-3', 'Ocupada', 4),
(167, 'Med. Mujeres', 'M.M-4', 'Ocupada', 4),
(168, 'Med. Mujeres', 'M.M-5', 'Ocupada', 4),
(169, 'Med. Mujeres', 'M.M-6', 'Ocupada', 4),
(170, 'Med. Mujeres', 'M.M-7', 'Ocupada', 4),
(171, 'Med. Mujeres', 'M.M-8', 'Ocupada', 4),
(172, 'Med. Mujeres', 'M.M-9', 'Ocupada', 4),
(173, 'Med. Mujeres', 'M.M-10', 'Ocupada', 4),
(174, 'Med. Mujeres', 'M.M-11', 'Ocupada', 4),
(175, 'Med. Mujeres', 'M.M-12', 'Ocupada', 4),
(176, 'Med. Mujeres', 'M.M-13', 'Ocupada', 4),
(177, 'Med. Mujeres', 'M.M-14', 'Ocupada', 4),
(178, 'Med. Mujeres', 'M.M-15', 'Ocupada', 4),
(179, 'Med. Mujeres', 'M.M-16', 'Ocupada', 4),
(180, 'Med. Mujeres', 'M.M-17', 'Ocupada', 4),
(181, 'Med. Mujeres', 'M.M-18', 'Ocupada', 4),
(182, 'Med. Mujeres', 'M.M-19', 'Ocupada', 4),
(183, 'UNET', 'UN-1', 'Ocupada', 4),
(184, 'UNET', 'UN-2', 'Ocupada', 4),
(185, 'UNET', 'UN-3', 'Ocupada', 4),
(186, 'UNET', 'UN-4', 'Ocupada', 4),
(187, 'UNET', 'UN-5', 'Desocupada', 4),
(188, 'UNET', 'UN-6', 'Desocupada', 4),
(189, 'UNET', 'UN-7', 'Desocupada', 4),
(190, 'UNET', 'UN-8', 'Desocupada', 4),
(191, 'UNET', 'UN-9', 'Desocupada', 4),
(192, 'UNET', 'UN-10', 'Desocupada', 4),
(193, 'UNET', 'UN-11', 'Desocupada', 4),
(194, 'Obs. 01', 'O.01-1', 'Desocupada', 5),
(195, 'Obs. 01', 'O.01-2', 'Ocupada', 5),
(196, 'Obs. 01', 'O.01-3', 'Ocupada', 5),
(197, 'Obs. 03(Mixtas)', 'O.03-1', 'Ocupada', 5),
(198, 'Obs. 03(Mixtas)', 'O.03-2', 'Ocupada', 5),
(199, 'Obs. 03(Mixtas)', 'O.03-3', 'Ocupada', 5),
(200, 'Obs. 03(Mixtas)', 'O.03-4', 'Ocupada', 5),
(201, 'Obs. 03(Mixtas)', 'O.03-5', 'Ocupada', 5),
(202, 'Obs. Varones', 'O.V-1', 'Ocupada', 5),
(203, 'Obs. Varones', 'O.V-2', 'Ocupada', 5),
(204, 'Obs. Varones', 'O.V-3', 'Ocupada', 5),
(205, 'Obs. Varones', 'O.V-4', 'Ocupada', 5),
(206, 'Obs. Varones', 'O.V-5', 'Ocupada', 5),
(207, 'Obs. Varones', 'O.V-6', 'Ocupada', 5),
(208, 'Obs. Mujeres', 'O.M-1', 'Desocupada', 5),
(209, 'Obs. Mujeres', 'O.M-2', 'Ocupada', 5),
(210, 'Obs. Mujeres', 'O.M-3', 'Ocupada', 5),
(211, 'Obs. Mujeres', 'O.M-4', 'Ocupada', 5),
(212, 'Obs. Mujeres', 'O.M-5', 'Ocupada', 5),
(213, 'Obs. Mujeres', 'O.M-6', 'Ocupada', 5),
(214, 'Obs. Pediatria', 'O.P-1', 'Ocupada', 5),
(215, 'Obs. Pediatria', 'O.P-2', 'Ocupada', 5),
(216, 'Obs. Pediatria', 'O.P-3', 'Ocupada', 5),
(217, 'Obs. Pediatria', 'O.P-4', 'Desocupada', 5),
(218, 'Obs. Pediatria', 'O.P-5', 'Desocupada', 5),
(219, 'Obs. Pediatria', 'O.P-6', 'Desocupada', 5),
(220, 'Obs. Pediatria', 'O.P-7', 'Desocupada', 5),
(221, 'Obs. Pediatria', 'O.P-8', 'Desocupada', 5),
(222, 'UCI Adultos', 'U.A-1', 'Ocupada', 6),
(223, 'UCI Adultos', 'U.A-2', 'Ocupada', 6),
(224, 'UCI Adultos', 'U.A-3', 'Ocupada', 6),
(225, 'UCI Adultos', 'U.A-4', 'Ocupada', 6),
(226, 'UCI Adultos', 'U.A-5', 'Ocupada', 6),
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

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
