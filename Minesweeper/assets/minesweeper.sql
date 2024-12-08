-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 03:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minesweeper`
--

-- --------------------------------------------------------

--
-- Table structure for table `beginnerleaderboard`
--

CREATE TABLE `beginnerleaderboard` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `score` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beginnerleaderboard`
--

INSERT INTO `beginnerleaderboard` (`id`, `username`, `score`, `created_at`) VALUES
(1, 'Player1', 1000.00, '2024-11-25 22:29:19'),
(2, 'Player2', 1100.00, '2024-11-25 22:29:19'),
(3, 'Player3', 1101.00, '2024-11-25 22:29:19'),
(4, 'Player4', 1102.00, '2024-11-25 22:29:19'),
(5, 'Player5', 1103.00, '2024-11-25 22:29:19'),
(6, 'Player6', 1104.00, '2024-11-25 22:29:19'),
(7, 'Player7', 1105.00, '2024-11-25 22:29:19'),
(8, 'Player8', 1106.00, '2024-11-25 22:29:19'),
(9, 'Player9', 1107.00, '2024-11-25 22:29:19'),
(10, 'Player10', 1108.00, '2024-11-25 22:29:19'),
(11, 'Player11', 1109.00, '2024-11-25 22:29:19'),
(12, 'Player12', 1110.00, '2024-11-25 22:29:19'),
(13, 'Player13', 1111.00, '2024-11-25 22:29:19'),
(14, 'Player14', 1112.00, '2024-11-25 22:29:19'),
(15, 'Player15', 1113.00, '2024-11-25 22:29:19'),
(16, 'Player16', 1114.00, '2024-11-25 22:29:19'),
(17, 'Player17', 1115.00, '2024-11-25 22:29:19'),
(19, 'Player19', 1117.00, '2024-11-25 22:29:19'),
(20, 'Player20', 1118.00, '2024-11-25 22:29:19'),
(21, 'Player21', 1119.00, '2024-11-25 22:29:19'),
(22, 'Player22', 1120.00, '2024-11-25 22:29:19'),
(23, 'Player23', 1121.00, '2024-11-25 22:29:19'),
(24, 'Player24', 1122.00, '2024-11-25 22:29:19'),
(25, 'Player25', 3500.00, '2024-11-25 22:29:19'),
(26, 'zekebranham', 85.88, '2024-11-26 23:28:35'),
(27, 'zekebranham', 12.47, '2024-11-27 00:25:55'),
(28, 'PleaseWork James', 25.79, '2024-11-27 00:27:51'),
(29, 'Travis', 17.91, '2024-12-01 17:48:27'),
(30, 'SideShowBob', 13.42, '2024-12-01 18:00:45'),
(31, 'Marlon', 20.69, '2024-12-03 01:35:32'),
(32, 'Marlon', 319.31, '2024-12-04 22:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `expertleaderboard`
--

CREATE TABLE `expertleaderboard` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `score` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expertleaderboard`
--

INSERT INTO `expertleaderboard` (`id`, `username`, `score`, `created_at`) VALUES
(1, 'Player1', 1000.00, '2024-11-25 22:30:40'),
(2, 'Player2', 1100.00, '2024-11-25 22:30:40'),
(3, 'Player3', 1101.00, '2024-11-25 22:30:40'),
(4, 'Player4', 1102.00, '2024-11-25 22:30:40'),
(5, 'Player5', 1103.00, '2024-11-25 22:30:40'),
(6, 'Player6', 1104.00, '2024-11-25 22:30:40'),
(7, 'Player7', 1105.00, '2024-11-25 22:30:40'),
(8, 'Player8', 1106.00, '2024-11-25 22:30:40'),
(9, 'Player9', 1107.00, '2024-11-25 22:30:40'),
(10, 'Player10', 1108.00, '2024-11-25 22:30:40'),
(11, 'Player11', 1109.00, '2024-11-25 22:30:40'),
(12, 'Player12', 1110.00, '2024-11-25 22:30:40'),
(13, 'Player13', 1111.00, '2024-11-25 22:30:40'),
(14, 'Player14', 1112.00, '2024-11-25 22:30:40'),
(15, 'Player15', 1113.00, '2024-11-25 22:30:40'),
(16, 'Player16', 1114.00, '2024-11-25 22:30:40'),
(17, 'Player17', 1115.00, '2024-11-25 22:30:40'),
(18, 'Player18', 11016.00, '2024-11-25 22:30:40'),
(19, 'Player19', 1117.00, '2024-11-25 22:30:40'),
(20, 'Player20', 1118.00, '2024-11-25 22:30:40'),
(21, 'Player21', 1119.00, '2024-11-25 22:30:40'),
(22, 'Player22', 1120.00, '2024-11-25 22:30:40'),
(23, 'Player23', 1121.00, '2024-11-25 22:30:40'),
(24, 'Player24', 1122.00, '2024-11-25 22:30:40'),
(25, 'Player25', 3500.00, '2024-11-25 22:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `intermediateleaderboard`
--

CREATE TABLE `intermediateleaderboard` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `score` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intermediateleaderboard`
--

INSERT INTO `intermediateleaderboard` (`id`, `username`, `score`, `created_at`) VALUES
(1, 'Player1', 1000.00, '2024-11-25 22:30:14'),
(2, 'Player2', 1100.00, '2024-11-25 22:30:14'),
(3, 'Player3', 1101.00, '2024-11-25 22:30:14'),
(4, 'Player4', 1102.00, '2024-11-25 22:30:14'),
(5, 'Player5', 1103.00, '2024-11-25 22:30:14'),
(6, 'Player6', 1104.00, '2024-11-25 22:30:14'),
(7, 'Player7', 1105.00, '2024-11-25 22:30:14'),
(8, 'Player8', 1106.00, '2024-11-25 22:30:14'),
(9, 'Player9', 1107.00, '2024-11-25 22:30:14'),
(10, 'Player10', 1108.00, '2024-11-25 22:30:14'),
(11, 'Player11', 1109.00, '2024-11-25 22:30:14'),
(12, 'Player12', 1110.00, '2024-11-25 22:30:14'),
(13, 'Player13', 1111.00, '2024-11-25 22:30:14'),
(14, 'Player14', 1112.00, '2024-11-25 22:30:14'),
(15, 'Player15', 1113.00, '2024-11-25 22:30:14'),
(16, 'Player16', 1114.00, '2024-11-25 22:30:14'),
(17, 'Player17', 1115.00, '2024-11-25 22:30:14'),
(18, 'Player18', 11016.00, '2024-11-25 22:30:14'),
(19, 'Player19', 1117.00, '2024-11-25 22:30:14'),
(20, 'Player20', 1118.00, '2024-11-25 22:30:14'),
(21, 'Player21', 1119.00, '2024-11-25 22:30:14'),
(22, 'Player22', 1120.00, '2024-11-25 22:30:14'),
(23, 'Player23', 1121.00, '2024-11-25 22:30:14'),
(24, 'Player24', 1122.00, '2024-11-25 22:30:14'),
(25, 'Player25', 3500.00, '2024-11-25 22:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `games_played` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `games_played`) VALUES
(4, 'Travis', '$2y$10$l8bvv/DsW0/MrrvASfUwG.pv.qCJVD0M5B5Eso4POXFZJQlu4tZ1e', 0),
(5, 'SideShowBob', '$2y$10$L3YbwOWSYowj8iOTINNqXe/RPF3TcO.QrjIM9aoIIrYYlCjOfBn/6', 0),
(6, 'Mobile Device', '$2y$10$ocvUgRHmK6EipIV1IzvafuY4OUlGSsYEllOQI/0eVYPbUYB0r7XWS', 0),
(7, 'Huck', '$2y$10$7/syBiq6G456YwaMpQFYFOGmWlm5Czi/Fmfl/Q5iJ8RoXv8HHcWMm', 0),
(8, 'Please', '$2y$10$4vjJ6AVUPWL5/1eSBL4on.zZ9w2GO3ncJDiUQ9Iqlx87nKm6RUowq', 0),
(9, 'Marlon', '$2y$10$y9TBCKNkWSe5yhioDx40Oe8XtLP/PzBiCtRG9yVe14i/8c2dz30nK', 21),
(10, 'iwwswords', '$2y$10$LPgcyppLi1tnbAQGQtJhTur/qVIhN2WdTEj5yjDJIsRAt21wkIdlC', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beginnerleaderboard`
--
ALTER TABLE `beginnerleaderboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expertleaderboard`
--
ALTER TABLE `expertleaderboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intermediateleaderboard`
--
ALTER TABLE `intermediateleaderboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beginnerleaderboard`
--
ALTER TABLE `beginnerleaderboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `expertleaderboard`
--
ALTER TABLE `expertleaderboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `intermediateleaderboard`
--
ALTER TABLE `intermediateleaderboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
