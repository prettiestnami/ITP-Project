-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2026 at 01:27 AM
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
-- Database: `trendora_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `username`, `password`, `created_at`) VALUES
(1, 'Safiyah', 'safiyah123@gmail.com', 'Safiyah', '$2y$10$5t4SdA6XJcl6NwWW93p.B.DZLRAcjgdkL0NJNTvSgdk.vgJ28RW2q', '2026-05-14 14:27:03'),
(2, 'Judy Ferrer', 'judyferrer36@gmail.com', 'Judy', '$2y$10$Vx0DSpnU1V8dxIhGTvsvgOvidAfpBTsZkBAjZGUDOcnL.mGmrGh7m', '2026-05-14 15:18:33'),
(3, 'Cinnamon Roll', 'Cinnamonroll@gmail.com', 'Cinn', '$2y$10$b9wSxooXSxQXYhiumEXj1OdK4E1/FYrGfuHAEa.uXfvVTmBwZsrFy', '2026-05-19 14:14:57'),
(4, 'Juan Tamad', 'juantamad@gmail.com', 'tamad', '$2y$10$W4pGAfu.HqPwU5z8IgMhkO/gneAdNMtCuMB6anypdtsXE0XUTyQCG', '2026-05-19 14:22:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
