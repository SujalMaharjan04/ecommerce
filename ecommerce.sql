-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2025 at 02:45 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('Pending','Shipped','Delivered') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `email`, `address`, `total_price`, `status`, `created_at`) VALUES
(1, 'Sudhir', 'sudhir.vega@gmail.com', 'A/P Gaundwadi, Tal-Walwa, Dist-Sangli, Pin-415413', 49990.00, 'Shipped', '2025-02-14 20:04:56');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock`, `image`, `created_at`, `category_id`, `description`) VALUES
(3, 'HP All-in-One 12Th Gen Windows 11, Intel Core i3-23.8 Inch(60.5 Cm) 8GB Ram/512GB SSD/Fhd, Micro-Edge, Anti-Glare Display/Wireless Keyboard & Mouse/Intel UHD Graphics/Win 11', 49990.00, 3, '../uploads/HP_PC_1.jpg', '2025-02-14 18:47:36', NULL, NULL),
(4, 'Lenovo IdeaCentre AIO 3 Intel i5-13420H 27\" FHD IPS 3-Side Edgeless All-in-One Desktop (16GB/1TB SSD/Win11', 82990.00, 6, '../uploads/Lenovo_PC_1.jpg', '2025-02-14 18:48:20', NULL, NULL),
(5, 'HP All-in-One PC 13th Gen Intel Core i5 27\" (68.6cm) FHD 16GB RAM, 1TB SSD, Intel UMA Graphics, 710 White Wireless Keyboard and Mouse Combo, Windows 11 Home', 72990.00, 6, '../uploads/HP_PC_2.jpg', '2025-02-14 20:30:17', NULL, NULL),
(6, 'Lenovo IdeaCentre AIO 3 AMD Ryzen 7 7730U 27\" FHD IPS 3-Side Edgeless All-in-One Desktop with Alexa Built-in (16GB/1TB SSD/Win11/Office 2021/5.0 MP + IR Camera/Wireless Keyboard & Mouse)', 60990.00, 5, '../uploads/Lenovo_PC_2.jpg', '2025-02-14 20:33:06', NULL, NULL),
(7, 'Lenovo V15 AMD Ryzen 7 7730U 15.6\" (39.62cm) FHD 250 Nits Antiglare Thin and Light Laptop (16GB/512GB SSD/Windows 11/Iron Grey/1.65 Kg) Grey', 39990.00, 6, '../uploads/Lenovo_LP_1.jpg', '2025-02-14 20:36:57', NULL, NULL),
(8, 'HP 15, 13th Gen Intel Core i5-1334U, 16GB DDR4, 512GB SSD, (Win 11, Office 21, Silver, 1.59kg), Anti-Glare, 15.6-inch(39.6cm) FHD Laptop, Iris Xe Graphics, FHD Camera, Backlit KB, fd0316TU/fd0315TU', 54990.00, 6, '../uploads/HP_LP_1.jpg', '2025-02-14 20:39:54', NULL, NULL),
(9, 'Lenovo LOQ 2024 AMD Ryzen 5 7235HS 15.6\" (39.6cm) 144Hz 300Nits FHD IPS Gaming Laptop (24GB/512GB SSD/Win 11/NVIDIA RTX 3050 6GB Graphics/100% sRGB/Office 21/1Yr ADP Free/Grey/2.4Kg), 83JC0078IN', 65490.00, 6, '../uploads/Lenovo_LP_2.jpg', '2025-02-14 20:43:43', NULL, NULL),
(10, 'HP Laptop 255 G9 AMD Ryzen 3 3250U Dual Core - (8GB/512GB SSD/AMD Radeon Graphics) Thin and Light Business Laptop/15.6\" (39.62cm)/Black/1.47 kg', 24250.00, 6, '../uploads/HP_LP_2.jpg', '2025-02-14 20:48:27', NULL, NULL),
(11, 'Zebronics Transformer Gaming Keyboard and Mouse Combo,Braided Cable,Durable Al body,Multimedia keys and Gaming Mouse with 6 Buttons, Multi-Color LED Lights, High-Resolution Sensor with 3200 DPI(Black)', 1099.00, 6, '../uploads/Keyboard_Z_1.jpg', '2025-02-14 20:55:02', NULL, NULL),
(12, 'Dell KM3322W Wireless USB Keyboard and Mouse Combo, Anti-Fade & Spill-Resistant Keys, up to 36 Month Battery Life, 3Y Advance Exchange Warranty - Black', 1299.00, 6, '../uploads/Keyboard_D_1.jpg', '2025-02-14 20:56:38', NULL, NULL),
(13, 'ZEBRONICS Transformer K1 Premium Gaming Keyboard with 104 Keys, 1.7m Cable, Laser Keycaps, Multi Color LED Modes, Integrated Multimedia Keys, All Keys Enable/Disable Function', 499.00, 5, '../uploads/Keyboard_Z_2.jpg', '2025-02-14 20:58:25', NULL, NULL),
(14, 'Dell USB Wired Keyboard and Mouse Set (Black) KB216+MS116', 1089.00, 6, '../uploads/Keyboard_D_2.jpg', '2025-02-14 21:00:22', NULL, NULL),
(15, 'Samsung 27-inch (68.59cm) FHD, IPS Display, 100 Hz, 1920 x 1080 Flat Monitor, Bezel Less Design, AMD FreeSync, Flicker Free, HDMI, Display Port (LS27C330GAWXXL, Black)', 9699.00, 4, '../uploads/sam_mon_1.jpg', '2025-02-14 21:08:12', NULL, NULL),
(16, 'Acer Predator Helios Neo 16 Gaming Laptop 13th Gen Intel Core i7 Processor (16 GB/1 TB SSD/Windows 11 Home/NVIDIA ® GeForce RTX ¢ 4050) PHN16-71, (16\") WUXGA Display', 115000.00, 2, '../uploads/ACER_LP_1.jpg', '2025-02-14 21:13:18', NULL, NULL),
(17, 'Acer Nitro V Gaming Laptop 13th Gen Intel Core i7-13620H (Windows 11 Home/16 GB DDR5/512 GB SSD/6 GB NVIDIA GeForce RTX 4050 Graphics/165 Hz/Wi-Fi 6) ANV15-51, 39.6 cm (15.6\") FHD IPS Display, 2.1 KG', 90990.00, 2, '../uploads/ACER_LP_2.jpg', '2025-02-14 21:15:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(6, 'Admin', 'admin@example.com', '$2y$10$k9kC5X.6UuPyl1y3uo8IuO5SRs2PTU9h7L15iJHhBoC62mPS.5xkG', 'admin', '2025-02-14 17:23:00'),
(7, 'Sudhir Arjun Chavan', 'sudhirchavan99@gmail.com', '$2y$10$MJaeRKaLY4fYEgRilgfh..xAvAWP6oBkqMlluhO5Elb5SBR1ZE0Pm', 'customer', '2025-02-14 17:23:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
