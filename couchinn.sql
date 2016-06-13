-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 13, 2016 at 06:16 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `couchinn`
--

-- --------------------------------------------------------

--
-- Table structure for table `couchs`
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
-- Dumping data for table `couchs`
--

INSERT INTO `couchs` (`id`, `enabled`, `published`, `user_id`, `type_id`, `title`, `description`, `capacity`, `location`) VALUES
(1, 1, 1, 11, 11, 'Mi casa', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 3, 'La Plata'),
(2, 1, 1, 12, 18, 'Choza Feliz', 'Acogedora choza en la selva misionera. Cuenta con capacidad para 6 personas. Se encuentra en una aldea, ideal para compartir momentos con la tribu.\r\n\r\nNo cuenta con ventanas.', 6, 'La Plata'),
(3, 1, 1, 13, 13, 'Camping Juancito', 'Ideal para hacer camping :)', 15, 'Hipódromo, La Plata');

-- --------------------------------------------------------

--
-- Table structure for table `couch_comments`
--

CREATE TABLE `couch_comments` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `couch_id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `couch_scores`
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
-- Table structure for table `couch_types`
--

CREATE TABLE `couch_types` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `couch_types`
--

INSERT INTO `couch_types` (`id`, `enabled`, `description`) VALUES
(11, 1, 'Casa'),
(12, 1, 'Departamento'),
(13, 1, 'Camping'),
(18, 1, 'Choza');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
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
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `couch_id` int(11) NOT NULL,
  `filename` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `enabled`, `couch_id`, `filename`) VALUES
(1, 1, 2, '312956.jpg'),
(2, 1, 3, '456825.jpg'),
(3, 1, 3, '613248.jpg'),
(4, 1, 1, '521987.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
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

-- --------------------------------------------------------

--
-- Table structure for table `reservation_states`
--

CREATE TABLE `reservation_states` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation_states`
--

INSERT INTO `reservation_states` (`id`, `enabled`, `description`) VALUES
(1, 1, 'Pendiente'),
(2, 1, 'Confirmada'),
(3, 1, 'Rechazada'),
(4, 1, 'Finalizada'),
(5, 1, 'Vencida');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `enabled`, `email`, `password`, `name`, `last_name`, `birthday`, `phone`, `is_admin`, `is_premium`) VALUES
(10, 1, 'admin@a.b', 'admin', '', '', '0000-00-00', '', 1, 0),
(11, 1, 'estebanquito@hotmail.com', '123456', 'Esteban', 'Quito', '1995-06-12', NULL, 0, 0),
(12, 1, 'stella@gmail.com', '123456', 'Stella', 'Garto', '1975-01-26', '', 0, 1),
(13, 1, 'e.nito@aol.com', '123456', 'Elena', 'Nito', '1976-11-09', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_scores`
--

CREATE TABLE `user_scores` (
  `id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `reservation_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `couchs`
--
ALTER TABLE `couchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couch_comments`
--
ALTER TABLE `couch_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couch_scores`
--
ALTER TABLE `couch_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couch_types`
--
ALTER TABLE `couch_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation_states`
--
ALTER TABLE `reservation_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_scores`
--
ALTER TABLE `user_scores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `couchs`
--
ALTER TABLE `couchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `couch_comments`
--
ALTER TABLE `couch_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `couch_scores`
--
ALTER TABLE `couch_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `couch_types`
--
ALTER TABLE `couch_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reservation_states`
--
ALTER TABLE `reservation_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user_scores`
--
ALTER TABLE `user_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
