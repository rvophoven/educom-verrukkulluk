-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2022 at 11:37 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verruk1`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `content` int(11) DEFAULT NULL,
  `calorie` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `name`, `description`, `price`, `unit`, `content`, `calorie`, `picture`) VALUES
(1, 'Kaas', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 100, 'gr', 200, 50, NULL),
(2, 'Ham', 'dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 300, 'gr', 500, 80, NULL),
(3, 'Melk', ' elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 100, 'ml', 1000, 30, NULL),
(6, 'Pasta', '\"Lorem ipsum dolor sit amet, consectetur adipisc eiusmod tempor incididunt ut labore et dolore magna aliqua', 200, 'gr', 500, 70, NULL),
(7, 'Tomaat', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, slabore et dolore magna aliqua', 120, 'gr', 600, 60, NULL),
(8, 'Rijst', ' labore et dolore magna aliqua', 80, 'gr', 300, 50, NULL),
(9, 'aardbei', 'strud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute ', 200, 'gr', 200, 80, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `id` int(11) NOT NULL,
  `kitchen_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `dat_added` date DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`id`, `kitchen_id`, `type_id`, `users_id`, `dat_added`, `title`, `short_description`, `long_description`, `picture`) VALUES
(1, 1, 3, 2, '2022-10-10', 'Pizza', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'strud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', NULL),
(2, 2, 4, 1, '2021-10-20', 'Lasagna', 'on ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute ', 'commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id es\"', NULL),
(3, 1, 4, 2, '2022-05-09', 'Curry', ' ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cill', 'stin reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', NULL),
(4, 1, 4, 1, '2022-01-02', 'Smoothie', 'sint occaecat cupidatat non proident, sunt in culpa qui officia  est laborum.\"', 'strud exercmodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dish_info`
--

CREATE TABLE `dish_info` (
  `id` int(11) NOT NULL,
  `record_type` varchar(1) DEFAULT NULL,
  `dish_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `textfield` text DEFAULT NULL,
  `numberfield` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish_info`
--

INSERT INTO `dish_info` (`id`, `record_type`, `dish_id`, `users_id`, `date_added`, `textfield`, `numberfield`) VALUES
(2, 'o', 3, 2, NULL, 'lokker', NULL),
(3, 'o', 2, 2, NULL, 'goed', NULL),
(4, 'o', 4, 2, NULL, 'vies', NULL),
(5, 'o', 1, 2, NULL, 'top', NULL),
(6, 'b', 3, NULL, NULL, 'afsdgdfgdfgdfgdfagadgrgadg\r\n', 1),
(7, 'b', 3, NULL, NULL, 'sfsdgdngfyfy\r\n', 2),
(8, 'b', 3, NULL, NULL, 'gfuyykthfyui67ghvh', 3),
(9, 'b', 3, NULL, NULL, 'fgjrdhjgzdf6hjkvhj', 4),
(10, 'w', 3, NULL, NULL, NULL, 2),
(11, 'w', 2, NULL, NULL, NULL, 3),
(12, 'w', 1, NULL, NULL, NULL, 5),
(13, 'w', 4, NULL, NULL, NULL, 5),
(14, 'w', 3, NULL, NULL, NULL, 3),
(15, 'w', 2, NULL, NULL, NULL, 1),
(16, 'w', 1, NULL, NULL, NULL, 4),
(17, 'w', 4, NULL, NULL, NULL, 3),
(18, 'f', 3, 2, NULL, NULL, NULL),
(19, 'f', 4, 1, NULL, NULL, NULL),
(20, 'f', 1, 1, NULL, NULL, NULL),
(69, 'b', 2, NULL, NULL, 'fgjghzdrg53', 1),
(70, 'b', 2, NULL, NULL, 'shsdwe546yryrgdr', 2),
(71, 'b', 2, NULL, NULL, 'dgdry565rgdf5ryry5gdr', 3),
(72, 'b', 1, NULL, NULL, '3raweaet4taegeawrt', 1),
(73, 'b', 1, NULL, NULL, 'ddsgasgar4ge4tgae4etgawet', 2),
(74, 'b', 1, NULL, NULL, 'f4aeta4wtetg4eya', 3),
(75, 'b', 1, NULL, NULL, 'gsretrgsETrthgg5yege', 4),
(76, 'b', 1, NULL, NULL, '4t4et4g4geatgreagrgeargrhedfggfnegn', 5),
(77, 'b', 4, NULL, NULL, '4tgrg4gergwenflubfx', 1),
(78, 'b', 4, NULL, NULL, '4yhrseFgh6rgeg56hgegh6jezrg', 2),
(79, 'o', 2, 1, NULL, 'Lekkers', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `dish_id` int(11) DEFAULT NULL,
  `artikel_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `dish_id`, `artikel_id`, `amount`) VALUES
(1, 3, 8, 500),
(2, 3, 7, 600),
(3, 3, 1, 200),
(4, 2, 2, 300),
(5, 2, 1, 600),
(6, 2, 7, 800),
(7, 1, 2, 200),
(8, 1, 6, 500),
(9, 1, 7, 300),
(10, 4, 3, 600),
(11, 4, 9, 400);

-- --------------------------------------------------------

--
-- Table structure for table `kitchen_type`
--

CREATE TABLE `kitchen_type` (
  `id` int(11) NOT NULL,
  `record_type` varchar(1) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kitchen_type`
--

INSERT INTO `kitchen_type` (`id`, `record_type`, `description`) VALUES
(1, 'k', 'Spaans'),
(2, 'k', 'Americaans'),
(3, 't', 'Vegan'),
(4, 't', 'vlees');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `email`, `picture`) VALUES
(1, 'Job', '1234', 'email@gmail.com', NULL),
(2, 'Janet', '4321', 'email@hotmail.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kitchen_id` (`kitchen_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `dish_info`
--
ALTER TABLE `dish_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dish_id` (`dish_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dish_id` (`dish_id`),
  ADD KEY `artikel_id` (`artikel_id`);

--
-- Indexes for table `kitchen_type`
--
ALTER TABLE `kitchen_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dish_info`
--
ALTER TABLE `dish_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kitchen_type`
--
ALTER TABLE `kitchen_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dish`
--
ALTER TABLE `dish`
  ADD CONSTRAINT `dish_ibfk_1` FOREIGN KEY (`kitchen_id`) REFERENCES `kitchen_type` (`id`),
  ADD CONSTRAINT `dish_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `kitchen_type` (`id`),
  ADD CONSTRAINT `dish_ibfk_3` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `dish_info`
--
ALTER TABLE `dish_info`
  ADD CONSTRAINT `dish_info_ibfk_1` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`),
  ADD CONSTRAINT `dish_info_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`),
  ADD CONSTRAINT `ingredients_ibfk_2` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
