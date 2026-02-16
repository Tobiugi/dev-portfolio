-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2026 at 02:57 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hub`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Elektronika'),
(2, 'Dom'),
(3, 'Moda');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `stock`) VALUES
(1, 1, 'Smartfon X', 2500.00, 15),
(2, 2, 'Lampa LED', 150.00, 50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `system_logs`
--

CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL,
  `action` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`id`, `action`, `created_at`) VALUES
(1, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:41:41'),
(2, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:41:49'),
(3, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:42:01'),
(4, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:42:04'),
(5, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:42:04'),
(6, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:08'),
(7, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:33'),
(8, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:34'),
(9, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:35'),
(10, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:35'),
(11, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:36'),
(12, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:36'),
(13, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:37'),
(14, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:37'),
(15, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:37'),
(16, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:38'),
(17, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:38'),
(18, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:38'),
(19, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:38'),
(20, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:39'),
(21, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:39'),
(22, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:39'),
(23, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:39'),
(24, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:39'),
(25, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:39'),
(26, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:40'),
(27, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:40'),
(28, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:57'),
(29, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:43:58'),
(30, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:47:36'),
(31, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:47:40'),
(32, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:47:41'),
(33, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:47:41'),
(34, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:47:42'),
(35, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:47:43'),
(36, 'Pobrano statystyki magazynowe przez API', '2026-02-16 13:47:44');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksy dla tabeli `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
