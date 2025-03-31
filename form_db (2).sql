-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 12, 2025 at 04:46 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `form_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `schedule` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `requirements` text,
  `special_offers` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `description`, `image_url`, `schedule`, `location`, `price`, `duration`, `requirements`, `special_offers`, `created_at`) VALUES
(1, 'Spa Treatments', 'Relax and rejuvenate with our exclusive spa treatments.', 'https://hospitalityinsights.ehl.edu/hubfs/Blog-EHL-Insights/Blog-Header-EHL-Insights/wealth%20wellness.jpeg', '9 AM - 9 PM daily', '2nd Floor, Wellness Center', 5000.00, '1 hour', 'None', '10% off for first-time visitors', '2025-01-23 15:05:58'),
(2, 'Fully Equipped Gym', 'Stay fit with our state-of-the-art gym facilities.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRugFRwT21Ws1ErCjLgZv9b0IHQwhyZijaZPQ&s', 'Open 24/7', '1st Floor, Fitness Center', 0.00, 'Unlimited', 'Proper gym attire required', 'Free personal training session with a 1-week stay', '2025-01-23 15:05:58'),
(3, 'Night Clubs', 'Enjoy vibrant nightlife with our in-house night clubs featuring live music and DJs.', 'https://do6raq9h04ex.cloudfront.net/sites/2/2021/07/5550ne-1350x630-1.jpg', '8 PM - 2 AM daily', 'Ground Floor, Entertainment Wing', 2000.00, '6 hours', 'Age 21+ only', 'Free entry on your birthday', '2025-01-23 15:05:58'),
(4, 'Guided Tours', 'Explore the local area with our expert-guided tours.', 'https://images.squarespace-cdn.com/content/v1/5d650d92e5f2b000019d92ea/1623747963389-8W2AHPU580CBF8PIM3GV/DJI_0921.jpg', '9 AM - 5 PM daily', 'Lobby, Tour Desk', 2500.00, '2 hours', 'Comfortable walking shoes recommended', 'Buy one, get one free on weekends', '2025-01-23 15:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Username`, `Password`) VALUES
(1, 'Admin@123', 'BCD#$234'),
(2, 'Admin#234', 'ABC@#123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `room_name` varchar(50) DEFAULT NULL,
  `guests` int DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `special_requests` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `User_ID`, `room_name`, `guests`, `arrival_date`, `departure_date`, `special_requests`, `created_at`, `status`) VALUES
(51, 'USR11110', 'Deluxe Suite', 3, '2025-03-02', '2025-03-06', 'none', '2025-03-02 06:33:35', 'Active'),
(54, 'USR40628', 'Superior King', 3, '2025-03-10', '2025-03-13', 'none', '2025-03-08 10:28:12', 'Active'),
(53, 'USR53551', 'Superior Twin', 4, '2025-03-19', '2025-03-21', 'none', '2025-03-05 12:36:22', 'Cancelled'),
(55, 'USR49328', 'Superior King', 3, '2025-03-21', '2025-03-24', 'None', '2025-03-12 09:07:48', 'Active'),
(56, 'USR53551', 'Superior Twin', 4, '2025-03-14', '2025-03-17', 'None', '2025-03-12 09:11:47', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(50) NOT NULL,
  `CustomerName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Number` varchar(20) NOT NULL,
  `Password` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Gender` enum('male','female','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `User_ID`, `CustomerName`, `Email`, `Number`, `Password`, `Gender`) VALUES
(10, 'USR49328', 'Geethika Rasadara', 'jayanisilva68@gmail.com', '0718309589', 'ABC@#123', 'male'),
(14, 'USR40628', 'Chirantha Kumarasiri', 'chiranthakumarasiri21@gmail.com', '0761629589', 'BCD#$234', 'male'),
(12, 'USR53551', 'Priyashan Prabashwara', 'priyashan419@gmail.com', '0763079330', 'priya@123', 'male'),
(13, 'USR11110', 'Pawan Mihisara', 'mwpmihisara16@gmail.com', '0761609589', 'pawan@123', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `dining`
--

DROP TABLE IF EXISTS `dining`;
CREATE TABLE IF NOT EXISTS `dining` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `available_times` varchar(255) NOT NULL,
  `amenities` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dining`
--

INSERT INTO `dining` (`id`, `name`, `image_url`, `description`, `available_times`, `amenities`) VALUES
(1, 'Elegant Dining Hall', 'https://i.pinimg.com/474x/40/bc/40/40bc4080750e39c675c681910294befc.jpg', 'Our Elegant Dining Hall combines luxury and sophistication, offering a rich culinary experience with a focus on locally sourced ingredients. This dining option is perfect for those who love fine dining in an opulent atmosphere, with an emphasis on personalized service, delicious gourmet meals, and a curated wine list to pair with your dishes.', 'Breakfast: 7:00 AM - 10:00 AM | Lunch: 12:00 PM - 3:00 PM | Dinner: 6:00 PM - 10:00 PM', 'WiFi, Wheelchair Accessible, Private Dining, Valet Parking, Live Piano Music, Gourmet Menu, Extensive Wine Selection'),
(2, 'Tenku', 'https://thekingsburyhotel.imgix.net/2023/05/Tenku-Interior-copy-KB-web-image.jpg?w=485&h=460&fit=crop&crop=center&auto=format&q=10', 'Tenku takes you on a culinary journey through authentic Japanese flavors, with a stunning city view as the backdrop. Enjoy meticulously crafted sushi, teppanyaki, and other Japanese delicacies prepared by world-renowned chefs. This restaurant offers a tranquil and modern ambiance, perfect for both intimate and group dining experiences.', 'Breakfast: 8:00 AM - 11:00 AM | Lunch: 12:00 PM - 3:00 PM | Dinner: 6:00 PM - 11:00 PM', 'WiFi, Outdoor Seating, Teppanyaki Table, Private Rooms, Sushi Bar, Zen Garden, Japanese Beverage Selection'),
(3, 'Sky Lounge', 'https://i.pinimg.com/474x/41/c0/60/41c060ce7ad9cbb543bc72c07b7e4dc4.jpg', 'Perched on the rooftop of our hotel, the Sky Lounge offers a relaxing and chic setting to enjoy cocktails and light bites while soaking in panoramic city views. The lounge is known for its live music, premium cocktail menu, and a serene ambiance perfect for unwinding after a long day. Ideal for casual gatherings and celebrations.', 'Breakfast: 7:00 AM - 10:30 AM | Lunch: 1:00 PM - 3:00 PM | Dinner: 6:00 PM - 12:00 AM', 'Rooftop View, Live Music, Signature Cocktails, WiFi, Lounge Seating, Fire Pit, Snack Menu'),
(4, 'The Mediterranean Room', 'https://i.pinimg.com/474x/be/79/39/be7939385ba17a121d8e1d0d7eace4d5.jpg', 'The Mediterranean Room brings the essence of coastal dining to life with its vibrant flavors, fresh seafood, and artisanal bread. Indulge in the finest Mediterranean cuisines inspired by the sunny coasts of Italy, Spain, and Greece. This space is adorned with rustic decor and an inviting atmosphere.', 'Breakfast: 7:30 AM - 10:30 AM | Lunch: 12:00 PM - 2:30 PM | Dinner: 6:00 PM - 9:30 PM', 'Seafood Bar, WiFi, Kid-Friendly Menu, Outdoor Patio, Mediterranean Wine Selection, Vegan Options, Open Kitchen'),
(5, 'Asian Fusion Bistro', 'https://i.pinimg.com/474x/3b/59/93/3b5993978ba17543d8208ef36ce353cd.jpg', 'The Asian Fusion Bistro offers a delightful combination of flavors from across Asia, blending traditional recipes with modern culinary techniques. With an open-concept kitchen and vibrant decor, the bistro creates an interactive dining experience that celebrates the diversity of Asian cuisine.', 'Breakfast: 8:00 AM - 11:00 AM | Lunch: 12:30 PM - 3:30 PM | Dinner: 6:30 PM - 10:30 PM', 'Interactive Kitchen, Vegan Options, Bar, WiFi, Traditional Decor, Tea Pairing, Group Seating'),
(6, 'Ocean Breeze Cafe', 'https://i.pinimg.com/474x/dd/6e/83/dd6e83884f0b43b86ba8ee617b6daed0.jpg', 'Located by the poolside, Ocean Breeze Cafe is a relaxed and breezy spot to enjoy fresh seafood and refreshing beverages. The cafe features an array of light dishes, from tropical salads to grilled fish, all served with a picturesque view of the water. Perfect for those seeking a casual dining option with a refreshing vibe.', 'Breakfast: 7:00 AM - 10:00 AM | Lunch: 12:00 PM - 2:30 PM | Dinner: 6:30 PM - 9:00 PM', 'Poolside View, WiFi, Tropical Menu, Vegan Options, Smoothie Bar, Live Grilling Station, Lounge Chairs'),
(7, 'Garden Courtyard', 'https://i.pinimg.com/474x/ad/e0/3f/ade03ff25b5552433b4928517aa0f977.jpg', 'Nestled in the heart of our lush hotel gardens, the Garden Courtyard offers an enchanting dining experience surrounded by greenery. Enjoy a farm-to-table menu featuring seasonal produce and freshly baked breads. This is a perfect escape for nature lovers looking to combine fine dining with a serene outdoor ambiance.', 'Breakfast: 6:30 AM - 10:00 AM | Lunch: 11:30 AM - 2:00 PM | Dinner: 5:30 PM - 8:30 PM', 'Farm-to-Table Menu, Vegan Options, Outdoor Seating, WiFi, Pet-Friendly, Private Dining, Eco-Friendly Practices'),
(8, 'The Grill House', 'https://i.pinimg.com/474x/66/0d/d9/660dd9ee1f12cc8505161113e656cd71.jpg', 'The Grill House specializes in premium cuts of meat, expertly grilled to perfection. With a contemporary ambiance and a robust menu, this dining option caters to meat lovers seeking a hearty and fulfilling meal. Pair your steaks with our wide range of craft beers and signature sauces for an unforgettable experience.', 'Breakfast: 8:00 AM - 10:30 AM | Lunch: 12:30 PM - 2:30 PM | Dinner: 6:00 PM - 10:00 PM', 'Craft Beer, WiFi, Premium Steaks, Open Kitchen, Family-Friendly, Barbecue Menu, Outdoor Grill');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

DROP TABLE IF EXISTS `foods`;
CREATE TABLE IF NOT EXISTS `foods` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Category` varchar(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `Category`, `name`, `category_id`, `quantity`, `price`, `image`, `description`) VALUES
(1, 'Cakes', 'Chocolate Cake', 1, 6, 2000.00, 'https://i.pinimg.com/236x/f0/d2/1f/f0d21f5bec274c9d0b20460d506e02e0.jpg', 'Rich chocolate sponge cake with creamy frosting'),
(3, 'Sawans', 'Chicken Sawan', 2, 5, 5500.00, 'https://i.pinimg.com/736x/41/e8/89/41e8892b87ea44a2af7fdc9e5f829f29.jpg', 'Large platter of rice with spicy grilled chicken and curry'),
(4, 'Sawans', 'Mutton Sawan', 2, 9, 6500.00, 'https://i.pinimg.com/736x/a1/d0/22/a1d022693a354b5feaa4f8c37148cd13.jpg', 'Fragrant biriyani rice with slow-cooked mutton pieces'),
(5, 'Lunch Time Specials', 'Rice & Curry', 3, 4, 850.00, 'https://i.pinimg.com/236x/d3/d0/9e/d3d09edb5afd31cce16017c3c3844959.jpg', 'A mix of traditional Sri Lankan rice with vegetable curries'),
(6, 'Lunch Time Specials', 'Fried Rice Set', 3, 5, 1200.00, 'https://i.pinimg.com/474x/11/9c/2c/119c2c95b3f0108dbb5ab52abc5e5977.jpg', 'Stir-fried rice with eggs, vegetables, and chicken'),
(7, 'Dinner Time Specials', 'Chicken Biriyani', 4, 8, 1500.00, 'https://i.pinimg.com/236x/54/63/6a/54636a7dc98f0aef25b9d19c5a94b78f.jpg', 'Aromatic biriyani rice with tender chicken and raita'),
(8, 'Dinner Time Specials', 'BBQ Chicken Platter', 4, 5, 2000.00, 'https://i.pinimg.com/236x/44/35/18/443518d06bd0ecc3c21934f9c71ce943.jpg', 'Juicy BBQ chicken with mashed potatoes and salad'),
(9, 'Drinks', 'Fresh Lime Juice', 5, 8, 300.00, 'https://i.pinimg.com/236x/b0/dc/12/b0dc12f07c43831f4216373d3f0ce2c8.jpg', 'Refreshing lime juice with honey and mint'),
(10, 'Drinks', 'Chocolate Milkshake', 5, 14, 600.00, 'https://i.pinimg.com/236x/50/e1/9d/50e19d05d71a121b62ed2db7df19ca4a.jpg', 'Thick chocolate milkshake topped with whipped cream'),
(11, 'Desserts', 'Ice Cream Sundae', 6, 12, 750.00, 'https://i.pinimg.com/474x/d7/e5/ee/d7e5eedbea6016ba2be953ba03f40b75.jpg', 'Vanilla ice cream with chocolate syrup and nuts'),
(12, 'Desserts', 'Cheesecake Slice', 6, 14, 900.00, 'https://i.pinimg.com/736x/62/d2/e5/62d2e5878efb730c58e1df9ad18d5195.jpg', 'Creamy cheesecake with a buttery graham cracker crust'),
(13, 'Cakes', 'Red Velvet Cake', 1, 10, 2500.00, 'https://i.pinimg.com/474x/16/53/a5/1653a589b11b889ab0bb2a336f0d5dda.jpg', 'Classic red velvet cake with smooth cream cheese topping');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `restaurant` varchar(255) NOT NULL,
  `inquiry_date` date NOT NULL,
  `inquiry_time` time NOT NULL,
  `title` enum('Mr.','Ms.','Mrs.') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text,
  `Gustes_No` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `restaurant`, `inquiry_date`, `inquiry_time`, `title`, `first_name`, `last_name`, `email`, `phone`, `message`, `Gustes_No`) VALUES
(4, 'Elegant Dining Hall', '2025-03-22', '09:30:00', 'Mr.', 'Chirantha', 'Kumarasiri', 'chiranthakumarasiri21@gmail.com', '0761609589', 'Looking forward to a wonderful dining experience', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Delivery_Place` enum('house','room') NOT NULL,
  `address` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Processing','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `User_ID`, `Delivery_Place`, `address`, `total_price`, `payment_method`, `order_date`, `status`) VALUES
(19, 'USR49328', 'room', 'Superior Twin', 2250.00, 'cash', '2025-02-08 14:13:45', 'Completed'),
(24, 'USR11110', 'room', 'Deluxe Suite', 11000.00, 'card', '2025-03-02 06:51:21', 'Pending'),
(25, 'USR40628', 'room', 'Superior King', 4000.00, 'cash', '2025-03-08 19:29:40', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_name`, `quantity`, `price`, `image_url`) VALUES
(21, 19, 'Rice & Curry', 3, 750.00, 'https://i.pinimg.com/236x/d3/d0/9e/d3d09edb5afd31cce16017c3c3844959.jpg'),
(26, 24, 'Chicken Sawan', 2, 5500.00, 'https://i.pinimg.com/736x/41/e8/89/41e8892b87ea44a2af7fdc9e5f829f29.jpg'),
(27, 25, 'BBQ Chicken Platter', 2, 2000.00, 'https://i.pinimg.com/236x/44/35/18/443518d06bd0ecc3c21934f9c71ce943.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

DROP TABLE IF EXISTS `queries`;
CREATE TABLE IF NOT EXISTS `queries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `User_ID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Message` longtext NOT NULL,
  `QueryDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Response` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `Name`, `User_ID`, `Message`, `QueryDate`, `Response`) VALUES
(7, 'Geethika Rasadara', 'USR49328', 'I Placed my order for Milkshake 5 hours ago. Haven\'t received it yet.', '2025-02-28 10:58:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `rating` int NOT NULL,
  `review_text` text,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `customer_name`, `rating`, `review_text`, `image_url`, `created_at`) VALUES
(8, 'Pasan', 4, 'Had a Wonderful dining experience. Looking forward to come again.', 'uploads/WhatsApp Image 2025-03-09 at 11.09.57_dbe73ea7.jpg', '2025-03-09 06:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amenities` text NOT NULL,
  `other_amenities` longtext NOT NULL,
  `occupancy` int NOT NULL,
  `size` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `category`, `description`, `amenities`, `other_amenities`, `occupancy`, `size`, `image_url`, `price`) VALUES
(1, 'Superior King', 'Luxury', 'A luxurious abode designed for comfort.', 'Free Wi-Fi, Air Conditioning, Mini Bar, Sea View', 'Baby Crib on Request, Private Bath (Bathtub and Walk-in Shower), Sauna (Daily 7am - 7pm), Steam Bath (Daily 7am - 7pm), 24/7 In-Room Dining, Use of the Gymnasium (Daily 7am - 7pm)', 4, '315 ft²', 'https://i.pinimg.com/736x/6c/88/6a/6c886a58955b62b80b29d29a69432904.jpg', 15000.00),
(2, 'Superior Twin', 'Luxury', 'Thoughtfully designed for seamless views.', 'Free Wi-Fi, Air Conditioning, Mini Bar, Pool Access', 'Complimentary Mini Bar, 24/7 Room Service, Smart TV with Streaming Services, High-Speed Wi-Fi, Coffee & Tea Making Facilities, Daily Housekeeping', 2, '315 ft²', 'https://i.pinimg.com/736x/b6/aa/91/b6aa915a8af1139561f0b9ec24a2e5af.jpg', 22000.00),
(3, 'Deluxe Suite', 'Premium', 'Spacious suite with premium amenities.', 'Free Wi-Fi, Private Balcony, Jacuzzi, Ocean View', 'Baby Crib on Request, Private Bath (Bathtub and Walk-in Shower), Sauna (Daily 7am - 7pm), Steam Bath (Daily 7am - 7pm), 24/7 In-Room Dining, Use of the Gymnasium (Daily 7am - 7pm)', 3, '450 ft²', 'https://i.pinimg.com/736x/00/bb/ac/00bbace43882aff6d5f5a7273911278f.jpg', 25000.00),
(4, 'Executive Room', 'Business', 'Designed for business travelers with workspaces.', 'Free Wi-Fi, Work Desk, Coffee Maker, City View', 'Complimentary Mini Bar, 24/7 Room Service, Smart TV with Streaming Services, High-Speed Wi-Fi, Coffee & Tea Making Facilities, Daily Housekeeping', 2, '350 ft²', 'https://i.pinimg.com/736x/b4/e4/4b/b4e44bf808d35a4a1eb9899e8ca3df0e.jpg', 19000.00),
(5, 'Family Room', 'Family', 'Perfect for families with extra space.', 'Free Wi-Fi, Extra Beds, Kitchenette, Garden View', 'Kid’s Play Area Access, Extra Beds on Request, Baby Cot Available, Cartoon & Family Channels on TV, Childproof Safety Features, Complimentary Breakfast for Kids', 4, '500 ft²', 'https://i.pinimg.com/736x/fe/e9/6d/fee96d7973a88944942e269d161935e1.jpg', 32200.00),
(6, 'Honeymoon Suite', 'Romantic', 'A romantic getaway with exclusive perks.', 'Free Wi-Fi, Private Jacuzzi, Candlelit Dinners, Mountain View', 'Romantic Room Setup, Private Jacuzzi with Rose Petals, Candlelight Dinner Option, Complimentary Champagne Bottle, King-Sized Bed with Premium Linens, Couple’s Spa Treatment', 2, '400 ft²', 'https://i.pinimg.com/736x/98/26/94/982694e67bfff1db3e2bb79c89e184ab.jpg', 29280.00),
(7, 'Standard Room', 'Budget', 'Affordable comfort with all essentials.', 'Free Wi-Fi, TV, Air Conditioning, Street View', 'Private Garden Access, Hammock & Outdoor Seating, Eco-Friendly Room Features, Organic Bath Products, Quiet Zone for Relaxation, Complimentary Yoga & Meditation Sessions', 4, '250 ft²', 'https://i.pinimg.com/736x/57/63/74/5763742b4f6a36b5c01ad9a5e0d04877.jpg', 31100.00),
(9, 'Penthouse Suite', 'Elite', 'A top-tier suite for the most luxurious stay.', 'Free Wi-Fi, Rooftop Access, Personal Butler, Panoramic View', 'Complimentary Mini Bar, 24/7 Room Service, Smart TV with Streaming Services, High-Speed Wi-Fi, Coffee & Tea Making Facilities, Daily Housekeeping', 4, '700 ft²', 'https://i.pinimg.com/474x/8c/cf/ce/8ccfcedb0fbd92e90e8a36f24ff71611.jpg', 33000.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `username`, `password`) VALUES
(7, 'Jane Smith', 'janesmith@gmail.com', 'janesmith', 'ABC@#123'),
(8, 'Michael Brown', 'michaelbrown@gmail.com', 'michaelbrown', 'BCD#$234'),
(9, 'Jayani de silva', 'smjayanidesilva@gmail.com', 'smj@123', 'bcd#$234');

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

DROP TABLE IF EXISTS `transport`;
CREATE TABLE IF NOT EXISTS `transport` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(50) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `vehicle` varchar(100) NOT NULL,
  `fare` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `vehicle_image` text NOT NULL,
  `booking_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  KEY `User_ID` (`User_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`booking_id`, `User_ID`, `destination`, `date`, `vehicle`, `fare`, `vehicle_image`, `booking_time`) VALUES
(3, 'USR74102', 'Matara, Matara District, Southern Province, 81000, Sri Lanka', '2025-03-11 10:00:00', 'Car', '7250', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSECDEiHIXdHIk12pWVoIe_10UL0eofh7V0JNw2bDXKGIsfLJT29TH1HlP7nZmfiyR6Kmw&usqp=CAU', '2025-03-03 13:45:29'),
(4, 'USR40628', 'Talpe Beach, Colombo -Matara Road, Talpe, Galle District, Southern Province, 80615, Sri Lanka', '2025-03-20 09:00:00', 'Car', '1412', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSECDEiHIXdHIk12pWVoIe_10UL0eofh7V0JNw2bDXKGIsfLJT29TH1HlP7nZmfiyR6Kmw&usqp=CAU', '2025-03-09 08:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

DROP TABLE IF EXISTS `user_cart`;
CREATE TABLE IF NOT EXISTS `user_cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `food_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`id`, `User_ID`, `food_id`, `name`, `price`, `image`, `quantity`) VALUES
(57, 'USR49328', 3, 'Chicken Sawan', 5500.00, 'https://i.pinimg.com/736x/41/e8/89/41e8892b87ea44a2af7fdc9e5f829f29.jpg', 1),
(59, 'USR11110', 10, 'Chocolate Milkshake', 600.00, 'https://i.pinimg.com/236x/50/e1/9d/50e19d05d71a121b62ed2db7df19ca4a.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `weddingpackages`
--

DROP TABLE IF EXISTS `weddingpackages`;
CREATE TABLE IF NOT EXISTS `weddingpackages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package_name` varchar(100) DEFAULT NULL,
  `menu` text,
  `image_url` varchar(255) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `features` text,
  `max_guests` int DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `deposit_required` decimal(10,2) DEFAULT NULL,
  `available_dates` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `weddingpackages`
--

INSERT INTO `weddingpackages` (`id`, `package_name`, `menu`, `image_url`, `description`, `price`, `features`, `max_guests`, `duration`, `deposit_required`, `available_dates`) VALUES
(1, 'Classic Elegance', '3-Course Meal: Starter, Main Course, Dessert', 'https://i.pinimg.com/736x/64/d4/e6/64d4e65ed9eb72184848a1fe79b9d638.jpg', 'An elegant wedding package featuring timeless décor and exceptional catering.', 255000.00, 'Elegant Decorations, Sound System, Complimentary Cake Cutting, Parking for Guests', 100, '6 Hours', 45000.00, '2025-02-14, 2025-03-20, 2025-04-15'),
(2, 'Golden Bliss', '5-Course Meal: Starter, Soup, Main Course, Dessert, Cheese Platter', 'https://i.pinimg.com/236x/44/59/e6/4459e65024f0bf4d39b586f29cf0f545.jpg', 'A luxurious package with stunning golden décor and a gourmet menu.', 170500.00, 'Luxurious Decorations, Private Dressing Room, Live Music, Sparkling Wine on Arrival', 150, '8 Hours', 2000.00, '2025-05-01, 2025-06-10, 2025-07-15'),
(3, 'Rustic Charm', 'BBQ Buffet with Salads, Grilled Meats, and Desserts', 'https://i.pinimg.com/236x/a4/cd/87/a4cd870b15b0156a559dc29fdc39bd16.jpg', 'A cozy and rustic wedding package with a countryside vibe.', 250500.00, 'Rustic Décor, Fairy Lights, DIY Photobooth, Complimentary Campfire', 80, '5 Hours', 55000.00, '2025-03-05, 2025-04-25, 2025-08-10'),
(4, 'Modern Romance', 'Plated Dinner: Starter, Main, Dessert, and Champagne Toast', 'https://i.pinimg.com/736x/2e/cf/07/2ecf078228d1e7c010d6b0b7cf91af1c.jpg', 'A sleek and modern wedding package with personalized touches.', 175000.00, 'Customizable Décor, On-Site Wedding Planner, Open Bar for 2 Hours, Private Lounge', 120, '7 Hours', 50000.00, '2025-03-12, 2025-05-18, 2025-07-22'),
(5, 'Beachside Bliss', 'Seafood Buffet with Tropical Cocktails', 'https://i.pinimg.com/736x/e9/2b/10/e92b10c01b562b8d7321d9b191dd20c2.jpg', 'Celebrate your big day with the serene backdrop of the ocean.', 360000.00, 'Beachside Venue, Tropical Themed Decorations, Fire Dancers, Cocktail Bar', 100, '6 Hours', 35000.00, '2025-03-30, 2025-06-05, 2025-08-20'),
(6, 'Royal Grandeur', 'Full Course Meal: Appetizer, Soup, Main Course, Dessert, Tea/Coffee', 'https://i.pinimg.com/736x/18/12/43/18124387d10ded13cd895d1f7ea163c0.jpg', 'An opulent package with grand décor and premium services.', 250000.00, 'Royal Themed Decorations, Chauffeur Service, Champagne Tower, VIP Parking', 200, '10 Hours', 46000.00, '2025-04-10, 2025-06-20, 2025-09-15'),
(7, 'Vintage Dream', 'Buffet: Assorted Starters, Carving Station, Desserts', 'https://i.pinimg.com/236x/9d/53/f9/9d53f9bbebf8fd9983d78519fbd6fbf9.jpg', 'A vintage-inspired wedding package with charming décor.', 290000.00, 'Vintage Props, Floral Arrangements, String Quartet, Coffee Station', 90, '6 Hours', 56000.00, '2025-03-08, 2025-05-12, 2025-09-18'),
(8, 'Enchanted Garden', 'Farm-to-Table Dining: Organic Starters, Mains, and Desserts', 'https://i.pinimg.com/474x/ab/79/6e/ab796e01e7c281c3e46cdec6f1bbef16.jpg', 'A whimsical outdoor wedding package surrounded by nature.', 455500.00, 'Garden Setup, Floral Arches, Live Acoustic Music, Eco-Friendly Décor', 120, '7 Hours', 75000.00, '2025-04-02, 2025-07-05, 2025-10-12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
