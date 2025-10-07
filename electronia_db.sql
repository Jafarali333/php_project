-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 08:27 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electronia_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `a_username` varchar(20) NOT NULL,
  `a_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_username`, `a_password`) VALUES
(1, 'sunasara', '$2y$10$ElmvkHsPrcWPbwAETVrw6el0aahQFH71kbB.iEEqd.KiDm2LNJfAK'),
(3, 'asamdi', '$2y$10$VwRQzBpDzSUl5IRW6t1hReMafdWiPXN84pBg7tyNCEWgxOeHwUEle'),
(4, 'kojar', '$2y$10$hf9m/QDdGknQB/32cKlNkOS/chNlcCUZ8Rf4EOmD9C04x0cD.gT0C');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cid` int(11) NOT NULL,
  `id` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `cquantity` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cid`, `id`, `pid`, `cquantity`) VALUES
(1, 29, 9, 1),
(2, 29, 12, 2),
(3, 29, 8, 1),
(4, 30, 7, 2),
(5, 30, 10, 1),
(6, 31, 6, 3),
(7, 33, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `email`) VALUES
(1, 'shamsheerhaidar2005@gmail.com'),
(5, 's@mail.com'),
(6, '');

-- --------------------------------------------------------

--
-- Table structure for table `liked_items`
--

CREATE TABLE `liked_items` (
  `l_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `liked_items`
--

INSERT INTO `liked_items` (`l_id`, `c_id`, `p_id`) VALUES
(5, 31, 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `delivery_address` varchar(100) NOT NULL,
  `order_status` varchar(15) NOT NULL DEFAULT 'Order placed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `username`, `total_amount`, `order_date`, `payment_method`, `delivery_address`, `order_status`) VALUES
(1, 'mohsina', '1274000.00', '2024-09-25 18:42:06', 'cash_on_delivery', 'ali pura vas vaghrol siddhpur patan gujarat', 'delivered'),
(2, 'mohsina', '42000.00', '2024-09-25 18:45:29', 'debit_card', 'ali pura vas vaghrol siddhpur patan gujarat', 'Order placed'),
(3, 'mohsina', '100000.00', '2024-09-25 19:25:48', 'cash_on_delivery', 'shamsheer haidar vaghrol siddhpur', 'Order placed'),
(4, 'mohsina', '74000.00', '2024-09-25 19:39:04', 'cash_on_delivery', 'ali pura vas vaghrol siddhpur patan gujarat', 'Order placed'),
(5, 'sarfarajpatel', '248000.00', '2024-09-26 12:01:35', 'paypal', 'nfkdlsiowiofjweoij', 'Order placed'),
(6, 'sarfarajpatel', '1200000.00', '2024-09-26 12:58:24', 'cash_on_delivery', 'kheda gujarat ', 'Order placed'),
(7, 'sarfarajpatel', '148000.00', '2024-09-26 13:25:15', 'credit_card', 'kheda gujarat ', 'Order placed'),
(8, 'sunasara', '70000.00', '2024-10-18 22:23:36', 'credit_card', 'gdfgesrdyxjgckl,mktk', 'Order placed'),
(9, 'sunasara', '248000.00', '2024-10-19 12:34:10', 'cash_on_delivery', 'Juhapura, Ahmedabad', 'Order placed'),
(10, 'sunasara', '123997.00', '2024-10-22 10:15:14', 'cash_on_delivery', 'stretsres kheda gujarat', 'Order placed'),
(11, 'sunasara', '200000.00', '2024-10-22 12:06:00', 'cash_on_delivery', 'fewt5ytw5u76swv5fy5yy5f3y', 'Order placed'),
(12, 'sunasara', '124000.00', '2024-10-29 16:13:30', 'credit_card', 'zaheermanzil,alipuravas,vaghrol', 'Order placed'),
(13, 'sunasara', '26200.00', '2024-10-29 17:45:34', 'debit_card', 'sdfzgxdfgrehfvdfzddtgdvxfgser', 'Order placed'),
(14, 'sunasara', '112500.00', '2024-11-12 10:04:25', 'cash_on_delivery', 'shasefiojioiojgiojsliefmgrte', 'delivered'),
(15, 'sshamsheer', '81200.00', '2024-11-14 10:47:33', 'credit_card', 'sshamsheer vklkmkjmlkgmkldfsm', 'Order placed'),
(16, 'sunasara', '713500.00', '2024-11-15 08:15:29', 'credit_card', 'shamsheer haidar dnskjnfjksnjdnfjknk', 'Shipped');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `quantity`, `price`) VALUES
(1, 1, 'Samsun Galaxy S23', 2, '600000.00'),
(2, 1, 'Iphone 14', 1, '74000.00'),
(3, 2, 'Oneplus Nord CE3', 2, '21000.00'),
(4, 3, 'Samsung Galaxy S23 Ultra', 1, '100000.00'),
(5, 4, 'Iphone 14', 1, '74000.00'),
(6, 5, 'Samsung Galaxy S24 Ultra', 2, '124000.00'),
(7, 6, 'Samsun Galaxy S23', 2, '600000.00'),
(8, 7, 'Iphone 14', 2, '74000.00'),
(9, 8, 'Iphone 13', 1, '70000.00'),
(10, 9, 'Samsung Galaxy S24 Ultra', 2, '124000.00'),
(11, 10, 'Vivo T3 5G ', 3, '17999.00'),
(12, 10, 'Iphone 13', 1, '70000.00'),
(13, 11, 'Samsung Galaxy S23 Ultra', 2, '100000.00'),
(14, 12, 'Samsung Galaxy S24 Ultra', 1, '124000.00'),
(15, 13, 'realme TechLife 7 kg 5 Star rating Semi Automatic ', 1, '7200.00'),
(16, 13, 'LG 8 kg 5 Star with Smart Inverter Technology, Tur', 1, '19000.00'),
(17, 14, 'MarQ 6 kg 5 Star Rating Innowash Range Semi Automa', 1, '6500.00'),
(18, 14, 'Iphone 14', 1, '74000.00'),
(19, 14, 'Mi by Xiaomi A Series 80 cm (32 inch) HD Ready LED', 1, '12000.00'),
(20, 14, 'Apple iPad (9th Gen) 64 GB ROM 10.2 inch with Wi-F', 1, '20000.00'),
(21, 15, 'realme TechLife 7 kg 5 Star rating Semi Automatic ', 1, '7200.00'),
(22, 15, 'Iphone 14', 1, '74000.00'),
(23, 16, 'MarQ 1.5 Ton 3 Star Split Inverter AC', 1, '28000.00'),
(24, 16, 'SAMSUNG 8 kg 5 star, Ecobubble, Digital Inverter, Fully Automatic Top Load Washing Machine', 1, '19500.00'),
(25, 16, 'Samsun Galaxy S23', 1, '600000.00'),
(26, 16, 'SAMSUNG Galaxy Tab S9 FE+ 8 GB RAM 128 GB ROM 12.4 Inch with Wi-Fi Only Tablet', 1, '36000.00'),
(27, 16, 'LG UR7500 108 cm (43 inch) Ultra HD (4K) LED Smart WebOS TV ', 1, '30000.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Pid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` int(7) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `photo` varchar(70) NOT NULL,
  `quantity` int(5) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Pid`, `name`, `category`, `price`, `description`, `photo`, `quantity`, `deleted`) VALUES
(5, 'Vivo T3 5G ', 'Mobile', 17999, 'The Vivo T3 features a 6.58-inch Full HD+ display with a 90Hz refresh rate. Its powered by a MediaTek Dimensity 700 chipset, paired with 4GB of RAM and 128GB of storage, expandable via microSD. It has a dual-camera setup with a 50MP main sensor and a 2MP depth sensor, and a 5000mAh battery supporti', 'vivo t3.jpeg', 17, 0),
(6, 'Iphone 13', 'Mobile', 70000, 'The iPhone 13 features a 6.1-inch Super Retina XDR display, powered by the A15 Bionic chip. It has a dual-camera system with 12MP wide and ultra-wide lenses, and offers up to 512GB storage. It supports 5G connectivity, Face ID, and has a 3,240mAh battery with MagSafe and fast charging capabilities.', 'iphone13.jpeg', 13, 0),
(7, 'Iphone 14', 'Mobile', 74000, 'The iPhone 14 features a 6.1-inch Super Retina XDR display and is powered by the A15 Bionic chip. It has a dual 12MP camera system with improved low-light performance and 4K Dolby Vision HDR recording. The device offers up to 512GB of storage, supports 5G, and includes Face ID, MagSafe, and a 3,279m', 'iphone14.jpeg', 45, 0),
(8, 'Iphone 15', 'Mobile', 79000, 'The iPhone 15 features a 6.2-inch Super Retina XDR display and is powered by the A17 Pro chip. It sports a dual-camera system with a 48MP main sensor and a 12MP ultra-wide lens. It offers up to 1TB of storage, 5G connectivity, and includes Face ID, MagSafe, and a 3,349mAh battery with fast and wirel', 'iphone15.jpeg', 0, 0),
(9, 'Samsung Galaxy S24 Ultra', 'Mobile', 124000, 'The Samsung Galaxy S24 Ultra features a 6.8-inch QHD+ Dynamic AMOLED 2X display with a 120Hz refresh rate. It is powered by the Exynos 2400 or Snapdragon 8 Gen 3 chip, depending on the region. The device boasts a quad-camera setup, including a 200MP main sensor, and offers up to 1TB of storage. It i', 's24ultra.jpeg', 5, 0),
(10, 'Samsung Galaxy S24 ', 'Mobile', 74000, 'The Samsung Galaxy S24 features a 6.1-inch FHD+ Dynamic AMOLED 2X display with a 120Hz refresh rate. Powered by the Exynos 2400 or Snapdragon 8 Gen 3 chipset, it has a triple-camera system with a 50MP main sensor. It offers up to 512GB of storage, supports 5G, and includes a 4,300mAh battery with fa', 's24.jpeg', 11, 0),
(11, 'Samsung Galaxy S23 Ultra', 'Mobile', 100000, 'The Samsung Galaxy S23 Ultra features a 6.8-inch QHD+ Dynamic AMOLED 2X display with a 120Hz refresh rate. It is powered by the Snapdragon 8 Gen 2 processor and includes a quad-camera setup with a 200MP main sensor. The device offers up to 1TB of storage, supports 5G, includes an S Pen, and has a 5,', 's23ultra.jpeg', 18, 0),
(12, 'Samsun Galaxy S23', 'Mobile', 600000, 'The Samsung Galaxy S23 features a 6.1-inch FHD+ Dynamic AMOLED 2X display with a 120Hz refresh rate. It is powered by the Snapdragon 8 Gen 2 processor and has a triple-camera setup with a 50MP main sensor. The device offers up to 512GB of storage, supports 5G, and includes a 3,900mAh battery with fa', 's23.jpeg', 12, 0),
(13, 'Oneplus Nord CE3', 'Mobile', 21000, 'The Oneplus nord Ce3 a 6.58-inch Full HD+ display with a 90Hz refresh rate. It\'s powered by a MediaTek Dimensity 700 chipset, paired with 4GB of RAM and 128GB of storage, expandable via microSD. It has a dual-camera setup with a 50MP main sensor and a 2MP depth sensor, and a 5000mAh battery supporti', 'oneplusnordce3.jpeg', 0, 0),
(15, 'MarQ 1.5 Ton 3 Star Split Inverter AC', 'Ac', 28000, 'Introducing MarQ\'s 2024 model of 4-in-1 Convertible AC, the smart solution for your customised comfort. EcoZone provides ideal cooling for 1 person, Comfort Zone allows you to enjoy all-day cooling for 2, StandardZone makes a cosy environment for 3 and the Perfect Cool Zone hosts a group of 4, adapt', 'MarQ.webp', 12, 0),
(16, 'Voltas 1.5 Ton 3 Star Split Inverter AC ', 'Ac', 34000, 'Integrated with Auto-clean technology, the Voltas 125V CAX(4503689) Air Conditioner maintains a clean evaporator coil by eliminating moisture. As a result, this AC helps prevent the chances of harmful bacteria and mould.', 'Voltas.webp', 20, 0),
(17, 'Daikin 1.5 Ton 3 Star Split Inverter AC', 'Ac', 36500, 'At the push of a button, Dew Clean Technology of the Daikin AC uses condensate water to effectively clean the evaporator coil of the indoor unit heat exchanger. This makes it possible to clean the interior unit heat exchanger more thoroughly, ensuring improved airflow and reliable cooling performanc', 'Daikin.webp', 30, 0),
(18, ' LG 1.5 Ton 3 Star Split Dual Inverter AC', 'Ac', 37000, 'LG’s unique AI Dual Inverter combines varied speed Dual Rotary compressor technology with Artificial Intelligence. Picture this: a cooling system that adapts to your needs, providing hypercapacity cooling for optimal comfort. It\'s not just an AC; it\'s a personalised climate control system designed t', 'LG.webp', 25, 0),
(19, 'Godrej 1.5 Ton 3 Star Split Inverter AC', 'Ac', 32000, 'Take advantage of the 5-in-1 Convertible Cooling function for unmatched versatility. With the inverter compressor that comes with this air conditioner, you may change the cooling power from 40% to 110%. This adaptable function makes sure you\'re as comfortable as possible while maximising energy econ', 'Godrej.webp', 35, 0),
(20, 'Lloyd 1.5 Ton 3 Star Split Inverter AC', 'Ac', 33500, 'The unique 5-in-1 Convertible AC function sets the Lloyd 1.5-Ton Split Inverter AC apart. With this multimode setting, you may adjust the cooling to suit your needs based on factors like heat load, outside temperature, or the number of people in the room. This air conditioner easily adjusts to your ', 'llyod.webp', 20, 0),
(21, 'MOTOROLA 1.5 Ton 5 Star Split Inverter AC ', 'Ac', 32000, 'This Motorola AC comes with 4 customised operating modes that can optimise the energy usage of the AC depending on the number of people in the room. It boasts the Me time mode for one person, We time mode for two people, a family-time mode for 3 people, and party time for 4 or more people at the hou', 'Motorolla.webp', 23, 0),
(22, 'Panasonic 1.5 Ton 3 Star Split Inverter AC ', 'Ac', 36000, 'Embark on a journey to blissful sleep with Panasonic AC\'s Custom Sleep Profile, meticulously crafted to create an ideal environment for tranquil nights and revitalising mornings. Say goodbye to midnight chills as you immerse yourself in a personalised haven of supreme comfort, ensuring every night\'s', 'Panasonic.webp', 25, 0),
(23, 'realme TechLife 1.5 Ton 5 Star Split Inverter AC', 'Ac', 32500, '1 Indoor Unit, 1 Outdoor Unit, Remote Control, User Manual, Warranty Card, 2 Batteries', 'Realme.webp', 20, 0),
(24, 'Haier 1.5 Ton 3 Star Split Dual Inverter AC', 'Ac', 32500, 'Enjoy 5 convertible modes for every season and weather. With this feature, users gets the flexibility to increase or decrease the cooling capacity as per their need. This means that the AC functions efficiently at the required tonnage with saving energy .', 'Harrier.webp', 22, 0),
(25, 'realme TechLife 7 kg 5 Star rating Semi Automatic Top Load Washing Machine', 'Washing machine', 7200, 'Offering up to 1400 RPM spin cycle as well as air dry circulation through the lid, the Realme 7 kg Washing Machine ensures rapid drying even during monsoons', 'realmewm.webp', 8, 0),
(26, 'MarQ 6 kg 5 Star Rating Innowash Range Semi Automatic Top Load Washing Machine ', 'Washing machine', 6500, 'Air Dry Lid with 1350 Rpm Turbo Spin Cycle, this washing machine quickly dries damp clothes even during the monsoon season. This appliance will solve all your laundry worries, allowing you to enjoy rapid drying in any weather condition.', 'Marqwm.webp', 14, 0),
(27, 'SAMSUNG 8 kg 5 star, Ecobubble, Digital Inverter, Fully Automatic Top Load Washing Machine', 'Washing machine', 19500, 'Built with a Digital Inverter, this washing machine uses high-performance magnets, ensuring enduring performance with low power consumption and minimal operational noise.', 'Samsungwm.webp', 29, 0),
(28, 'Motorola 10.5 kg 5 Star Smart Wi-Fi Enabled Inverter Technology Fully Automatic Front Load', 'Washing machine', 24000, 'You can remotely control this washing machine using your phone – anywhere, anytime.It ensures that connected appliances work better with this chipset. Also, it is well-suited for to withstand momentary fluctuating voltage conditions up to 500 V.', 'Motorollawm.webp', 25, 0),
(29, 'LG 8 kg 5 Star with Smart Inverter Technology, TurboDrum and Smart Diagnosis Fully Automatic', 'Washing machine', 19000, 'Equipped with a smart inverter motor, the LG 8 kg Fully Automatic Top-loading Washing Machine delivers excellent wash performance and is hassle-free to use.', 'LGwm.webp', 22, 0),
(30, 'Whirlpool 7 kg Magic Clean 5 Star Fully Automatic Top Load Washing Machine', 'Washing machine', 15000, 'Whirlpool 7 kg Magic Clean 5 Star Fully Automatic Top Load Washing Machine. Whirlpool 7 kg Magic Clean 5 Star Fully Automatic Top Load Washing Machine', 'Whirpoolwm.webp', 16, 0),
(31, 'Haier Washing Machines Haier 7 kg Balance Clean Pulsator, Custom Wash', 'Washing machine', 14000, 'This Haier washing machine\'s Oceanus Wave Drum simulates the soft movements of waves in the ocean. It lessens wear and tangling for a more pleasurable washing experience while gently cleaning garments.', 'Haierwm.webp', 20, 0),
(32, 'realme TechLife 7 kg 5 Star Rating Fabric Safe Wash Fully Automatic Top Load Washing Machine', 'Washing machine', 11000, 'This machine\'s innovative Magic Filter traps lint, fluff, and particles from your clothes, giving you a deeper clean with every wash. The Magic Filter helps prevent clogging and ensures your clothes are free from unwanted debris', 'realme2wm.webp', 18, 0),
(33, 'IFB 8 kg 5 Star with Steam Refresh program, 9 Swirl Wash, Eco Inverter, Touch Panel with AI Fully Au', 'Washing machine', 34000, '1 Unit Washing Machine, Drain Hose, Inlet Pipe, User Manual, Warranty Card, Clip Ring, Screw Fitting, Protective Rat Mash Cover', 'IFBwm.webp', 35, 0),
(34, 'Voltas Beko 9 kg Semi Automatic Top Load Washing Machine Black, Grey  (WTT90UHA/OK5B1B1S26)', 'Washing machine', 12000, 'This washing machine comes with Double Side Waterfall features which improves the dissolutio of the detergent by creating strong streams of water on both sides. This helps to ensure that the clothes get a thorough clean.', 'Voltaswm.webp', 15, 0),
(35, 'Apple iPad (9th Gen) 64 GB ROM 10.2 inch with Wi-Fi Only (', 'Tablet', 20000, 'iPad (9th Gen), Entertainment, For Kids, Reading and Browsing', 'Applet.webp', 17, 0),
(36, 'Apple iPad (10th Gen) 64 GB ROM 10.9 inch with Wi-Fi Only (Silver)', 'Tablet', 31000, 'iPad (10th Gen), Entertainment, For Kids, Reading and Browsing', 'Apple2t.webp', 30, 0),
(37, 'MOTOROLA Tab G62 4 GB RAM 128 GB ROM 10.61 inch with 4G Tablet (Frost Blue)', 'Tablet', 18000, 'Tab G62, Entertainment, Gaming, Reading and Browsing, For Kids,Business, Frost Blue, 4G Connectivity, Android', 'Motorollat.webp', 14, 0),
(38, 'Apple iPad mini (6th Gen) 64 GB ROM 8.3 inch with Wi-Fi Only ', 'Tablet', 48000, 'iPad mini (6th Gen), No cost EMI starting from ₹7,817/month', 'apple3t.webp', 30, 0),
(39, ' Compare Share SAMSUNG Galaxy Tab A9+ 8 GB RAM 128 GB ROM 11.0 inch with Wi-Fi+5G Tablet ', 'Tablet', 21000, 'Galaxy Tab A9+, Entertainment, Gaming, Reading and Browsing, For Kids, Business', 'Samsungt.webp', 22, 0),
(40, 'Xiaomi Pad 6 8 GB RAM 256 GB ROM 11.0 inch with Wi-Fi Only Tablet ', 'Tablet', 23000, 'Pad 6, Entertainment, High Processing Tasks', 'Xiomit.webp', 20, 0),
(41, 'OnePlus Pad Go 8 GB RAM 128 GB ROM 11.35 inch with Wi-Fi Only Tablet', 'Tablet', 18000, 'Pad Go, Entertainment, Gaming, Reading and Browsing, For Kids, Business', 'Oneplust.webp', 19, 0),
(42, 'realme Pad 2 6 GB RAM 128 GB ROM 11.5 inch with 4G Tablet', 'Tablet', 20000, 'Thanks to the 120 Hz 2K Super Display of the realme Pad 2, you can engage yourself in the immersive display while browsing through the web, playing games, and creating content. You can elevate your viewing experience without facing any lag on this tablet. The 120 Hz display enables you to smooth scr', 'Realmet.webp', 24, 0),
(43, 'Lenovo Tab M10 FHD 3rd Gen 4 GB RAM 64 GB ROM 10.1 inch with Wi-Fi Only Tablet', 'Tablet', 12000, 'The blazing-fast Unisoc T610 Octa-core CPU of the Wi-fi Only Lenovo Tab M10 makes it simple to navigate between several programmes. In addition, the 64 GB of ROM and 4 GB of RAM can handle virtually all your tasks, providing a flawless user experience.', 'Lenovot.webp', 13, 0),
(44, 'SAMSUNG Galaxy Tab S9 FE+ 8 GB RAM 128 GB ROM 12.4 Inch with Wi-Fi Only Tablet', 'Tablet', 36000, 'Galaxy Tab S9 FE+, Entertainment, Gaming, Reading and Browsing, For Kids, Business', 'Samsung2t.webp', 34, 0),
(45, 'TCL V6B 108 cm (43 inch) Ultra HD (4K) LED Smart Google TV ', 'Tv', 21000, 'Provides a superior viewing experience with striking brightness, exceptional shadow details, and vivid color. Sit still and enjoy picture details as intended by the filmmakers.', 'TCLtv.webp', 23, 0),
(46, 'Mi by Xiaomi A Series 80 cm (32 inch) HD Ready LED Smart Google TV', 'Tv', 12000, 'Prepare to be captivated by the Mi A Series TV\'s fullscreen display, which offers an unparalleled visual experience. Whether you\'re watching your favorite movies, binge-watching the latest TV series, or enjoying live sports, the Mi A Series TV ensures that you don\'t miss a single detail. The expansi', 'MItv.webp', 19, 0),
(47, 'LG 32LMBPTC 80 cm (32 inch) HD Ready LED Smart WebOS TV ', 'Tv', 13000, 'Integrated with WebOS, the LG Smart LED TV lets you watch your favourite TV shows and movies on various platforms, such as Hotstar, Amazon Prime, Netflix, and more.', 'LGtv.webp', 18, 0),
(48, 'Thomson FA Series 80 cm (32 inch) HD Ready LED Smart Android TV', 'Tv', 10000, 'Watch all your favourite content all day long on the stunningly built Thomson TVs HDR innovation that mesmerises you with its impressive picture quality and life-like colours. With Thomson TV, you will cherish your television time like never before.', 'Thomsontv.webp', 13, 0),
(49, 'KODAK Special Edition 80 cm (32 inch) HD Ready LED Smart Linux TV', 'Tv', 8000, 'Thanks to the HD Ready resolution of this Kodak Linux TV, you can watch all your favourite content with exceptional quality and clarity. The colour accuracy delivered by this TV enables you with true colours and offers an immersive display experience.', 'Kodaktv.webp', 8, 0),
(50, 'SAMSUNG 80 cm (32 Inch) HD Ready LED Smart Tizen TV', 'Tv', 14000, 'Thanks to the 3-side bezel-less design of this TV, you get more screen space so that you can enjoy an immersive visual experience by being drawn into the beautiful colours.', 'Samsungtcv.webp', 24, 0),
(51, 'Infinix 81 cm (32 inch) HD Ready LED Smart Linux TV', 'Tv', 9000, 'Infinix TV comes with HD Ready panel which improves the overall colors, sharpness and contrast of the picture. Along with HD resolution, It comes with upto 250 NITS super bright panel which enhances the overall viewing experience', 'Infinixtv.webp', 10, 0),
(52, 'LG UR7500 108 cm (43 inch) Ultra HD (4K) LED Smart WebOS TV ', 'Tv', 30000, 'The LG UHD TV with HDR10 Pro takes your visual experience to a whole new level. It brings optimised brightness levels, ensuring vibrant colours and remarkable details that will leave you in awe. Whether you\'re watching an action-packed movie or a nature documentary, every scene will be brought to li', 'LG2tv.webp', 24, 0),
(53, 'SONY Bravia 2 108 cm (43 inch) Ultra HD (4K) LED Smart Google TV', 'Tv', 40000, 'Bring Smart entertainment home with lifelike colors, sharp contrasts, and finer details for an unparalleled visual experience.', 'Sonytv.webp', 35, 0),
(54, 'Coocaa 108 cm (43 inch) Full HD LED Smart Coolita TV ', 'Tv', 12000, 'Say goodbye to complex menus and slow navigation. Coocaa TV is powered by the Coolita OS, an intuitive operating system that delivers next-level performance with a streamlined interface. Effortlessly access your favorite apps, channels, and settings with just a few clicks. Coolita OS is designed for', 'Coocaatv.webp', 14, 0),
(214, 'sarfaraj sir', 'Mobile', 200000, 'sfejfokckfmslkmkdfmdmfomioemomfmds', 'Shamsheer2.jpg', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `address` varchar(150) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `number`, `email`, `password`, `address`, `deleted`) VALUES
(24, 'shamsheer', '2147999999', 'sheerhaidar2005@gmail.com', '$2y$10$2Nlg8cM6u4C20ehFvQl52.ULuq8l8IVVcebBLEDxP7DvxZxRday4y', 'vafjlskjfliejjeijwoj', 0),
(25, 'sabirali', '2147483647', 's@gmail.com', '$2y$10$ezE1OK.LMsr6CNzr9/I1hejDf38ZbAo38.H34REzqMBXRcmNiEHVW', '', 0),
(26, 'shamsheerhaid', '2147483647', 'sheerhaidar@gmail.com', '$2y$10$6NrJoAyL8qeADImobacOuehS/LQGuzgtykH5FMJnZRYoTgf3eT84O', '', 0),
(27, 'zulopav', '1234567890', 'zulfikarpav05@gmail.com', '$2y$10$ilR0QTfWgfPNNcC6rxznOuewRUA190ReBHeWDjgKSW/o/ceH60S0.', '', 0),
(28, 'zulfikar', '2147483647', 'shamsheerhaidar2005@gmail.com', '$2y$10$vRm2/isWfvfQpevaQvlkfOkdYt5u4g.45nCgYf7g3bckRh7Y48Ew6', '', 0),
(29, 'zayanab', '2147483647', 'zayanab@gmail.com', '$2y$10$B2WdVp.wVMF4DssyvvGWi.PsTYg2hTsPNIKRCuD5wdtQsRV34frmS', '', 0),
(30, 'bashirali', '2147483647', 'sheedar2005@gmail.com', '$2y$10$5oQgk2YyTl63NHRtE5lBiOAa6Hf4OAEkLPjBH0DuODWb/wT3ySnfe', '', 0),
(31, '', '0', '', '$2y$10$qZugPzZkIaDw8hZO8nokmOawqVJte7U/Krk/jI2lfbOr5ISt6So0W', '', 1),
(32, 'haidara', '2147483647', 'shamshaidar2005@gmail.com', '$2y$10$52ecRS4TQsEwNSJAD/zbYuxB7Dn4XdI7QKqfXbd./eOCo3zd9HqXO', '', 0),
(33, 'alimohamad', '2147483647', 'ssheerhaidar2005@gmail.com', '$2y$10$Z5qC6JpU2qpii4HLkM31ReHdNZCegHvZN7qT5W7QubFvfxa9l74gq', '', 0),
(34, 'mohsina', '7867867867', 'msheerhaidar2005@gmail.com', '$2y$10$ohJPtTin.R40B7AnNwJu1u65Drry1jQQ5z/rY8U6P/3wkV9ll6yFy', 'ali pura vas vaghrol siddhpur patan gujarat', 0),
(36, 'sarfarajpatel', '9408263440', 'sarfaraj2005@gmail.com', '$2y$10$9Z6H6Bt1kC5FjEjUbE./IuUuJuJ2K/fbcBJHFlR47elX0FcQebuuC', 'kheda gujarat ', 0),
(38, 'abbasbhaisun', '9408263441', 'shamsheersun@gmail.com', '$2y$10$TF59CSFVAL.ct.IMwiscyO.QCbdMCUUvgAYEL1sOGD0.eAXEQEhjS', 'alipura,vaghrol,siddhpur,pata,gujarat', 0),
(39, 'sunasara', '9408263440', 'sunasara2005@gmail.com', '$2y$10$ElmvkHsPrcWPbwAETVrw6el0aahQFH71kbB.iEEqd.KiDm2LNJfAK', '', 0),
(40, 'sshamsheer', '9999999999', 'shamsheerhaidars2005@gmail.com', '$2y$10$JqKyL//KDhJXNakPV2UPL.svAOuoM2R7rtYrGLs4QD.QUOjVuf9DW', '', 0),
(41, 'ljuniversity', '9408263440', 'ljuniversity@gmail.com', '$2y$10$9zI6lV8gyvqSRTKWmcoLgOECbwqYgOc5zYjKg7vAq6glKKPUw2eOC', 'ljuniversity fdkgkmgmoi', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liked_items`
--
ALTER TABLE `liked_items`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `liked_items`
--
ALTER TABLE `liked_items`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
