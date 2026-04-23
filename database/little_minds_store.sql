-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 23, 2026 at 02:58 PM
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
-- Database: `little_minds_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'atheer1', '$2y$10$EFCWXKRSMA8HmWFyq8AT2uaMYd0vEp2O.BWqoF7ktoex6TAZKHstW'),
(3, 'dana2', '$2y$10$BEfmJPOP51MZfSd81UDGK.Die4WMcrwv1VBq1zcGKhzrAwD4mLvhq'),
(4, 'aljowry1', '$2y$10$yJLiGCEL4nT9xDcdwbXCX.kCUiMZGzfz28n4/DSRf4qY7Jk2cfh3e'),
(5, 'hana2', '$2y$10$HiulJJgCdMfJj6FRC5B8Jujs61jA1h6ejdw4N0MG4pB/Y6cNKt0lm'),
(6, 'jana1', '$2y$10$azVNCGzqQD/o0Qslfy.DdOW/7LSghoNiVwPO8MxN5j1Bnjp2tb9za');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `image`) VALUES
(1, 'Alphabet Toy', 'Educational alphabet toy for kids', 40.00, 10, 'alphabet-toy.jpg'),
(2, 'Building Blocks', 'Colorful blocks for creativity', 60.00, 8, 'blocks.jpg'),
(3, 'Coloring Book', 'Fun coloring book for children', 25.00, 15, 'coloring-book.jpeg'),
(4, 'Numbers Toy', 'Learn numbers with fun toys', 35.00, 12, 'numbers-toy.jpg'),
(5, 'Puzzle', 'Brain puzzle game', 30.00, 9, 'puzzle.jpg'),
(6, 'Story Book', 'Kids story book', 20.00, 20, 'storybook.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
