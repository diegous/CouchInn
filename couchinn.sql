-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2016 a las 22:15:18
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `couchinn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `couchs`
--

CREATE TABLE `couchs` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `location` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `couchs`
--

INSERT INTO `couchs` (`id`, `enabled`, `published`, `user_id`, `type_id`, `title`, `description`, `capacity`, `location`) VALUES
(1, 1, 1, 11, 11, 'Mi casa piola', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 3, 'La Plata'),
(2, 1, 1, 12, 18, 'Choza Feliz', 'Acogedora choza en la selva misionera. Cuenta con capacidad para 6 personas. Se encuentra en una aldea, ideal para compartir momentos con la tribu.\r\n\r\nNo cuenta con ventanas.', 6, 'La Plata'),
(3, 1, 1, 13, 13, 'Camping Juancito', 'Ideal para hacer camping :)', 15, 'Hipódromo, La Plata'),
(4, 1, 1, 14, 19, 'Mucha Gente', 'Un lugar ideal para pasar el rato y conocer gente nueva', 20, 'La Plata, Buenos Aires, Argentina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `couch_comments`
--

CREATE TABLE `couch_comments` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `couch_id` int(11) NOT NULL,
  `comment_question` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_answer` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `couch_scores`
--

CREATE TABLE `couch_scores` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `reservation_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `couch_types`
--

CREATE TABLE `couch_types` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `couch_types`
--

INSERT INTO `couch_types` (`id`, `enabled`, `description`) VALUES
(11, 1, 'Casa'),
(12, 1, 'Departamento'),
(13, 1, 'Camping'),
(18, 1, 'Choza'),
(19, 1, 'Hostel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `couch_id` int(11) NOT NULL,
  `filename` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pictures`
--

INSERT INTO `pictures` (`id`, `enabled`, `couch_id`, `filename`) VALUES
(1, 1, 2, '2-1.jpg'),
(2, 1, 3, '3-1.jpg'),
(3, 1, 3, '3-2.jpg'),
(4, 1, 1, '1-1.jpg'),
(5, 1, 4, '4-1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `couch_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `enabled`, `user_id`, `couch_id`, `state_id`, `start_date`, `end_date`) VALUES
(7, 1, 13, 1, 3, '2016-06-16', '2016-06-23'),
(8, 1, 13, 1, 4, '2016-06-15', '2016-06-20'),
(9, 1, 13, 1, 3, '2016-06-18', '2016-06-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation_states`
--

CREATE TABLE `reservation_states` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservation_states`
--

INSERT INTO `reservation_states` (`id`, `enabled`, `description`) VALUES
(1, 1, 'Pendiente'),
(2, 1, 'Confirmada'),
(3, 1, 'Rechazada'),
(4, 1, 'Finalizada'),
(5, 1, 'Vencida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_premium` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `enabled`, `email`, `password`, `name`, `last_name`, `birthday`, `phone`, `is_admin`, `is_premium`) VALUES
(10, 1, 'admin@a.b', 'admin', '', '', '0000-00-00', '', 1, 0),
(11, 1, 'user1@a.b', '1234', 'Esteban', 'Quito', '1995-06-12', NULL, 0, 0),
(12, 1, 'user2@a.b', '1234', 'Stella', 'Garto', '1975-01-26', '', 0, 1),
(13, 1, 'user3@a.b', '1234', 'Elena', 'Nito', '1976-11-09', NULL, 0, 0),
(14, 1, 'user4@a.b', '1234', 'q', 'q', '1111-11-11', '', 0, 0),
(23, 1, 'user5@a.b', '1234', 'Armando ', 'Perez', '1111-11-11', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_scores`
--

CREATE TABLE `user_scores` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `reservation_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `couchs`
--
ALTER TABLE `couchs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `couch_comments`
--
ALTER TABLE `couch_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `couch_scores`
--
ALTER TABLE `couch_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `couch_types`
--
ALTER TABLE `couch_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservation_states`
--
ALTER TABLE `reservation_states`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `user_scores`
--
ALTER TABLE `user_scores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `couchs`
--
ALTER TABLE `couchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `couch_comments`
--
ALTER TABLE `couch_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `couch_scores`
--
ALTER TABLE `couch_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `couch_types`
--
ALTER TABLE `couch_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `reservation_states`
--
ALTER TABLE `reservation_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `user_scores`
--
ALTER TABLE `user_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
