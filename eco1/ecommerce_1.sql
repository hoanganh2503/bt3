-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 30, 2024 at 10:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`) VALUES
(1, 'Điện thoại', 'phone.svg'),
(2, 'Camera', 'camera.svg'),
(3, 'Headphone', 'headphone.svg'),
(4, 'Laptop', 'laptop.svg'),
(5, 'Chuột', 'mouse.svg'),
(6, 'Màn hình', 'screen.svg');

-- --------------------------------------------------------

--
-- Table structure for table `flashsale`
--

CREATE TABLE `flashsale` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `percent` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flashsale`
--

INSERT INTO `flashsale` (`id`, `product_id`, `percent`, `start_time`, `end_time`) VALUES
(3, '30,34,37', 15, '2024-11-28 08:53:00', '2024-11-29 20:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `cost_price`, `selling_price`, `image`, `quantity`) VALUES
(30, 1, 'Apple iPhone 15 128GB', 'Thông tin bảo hành:\r\n\r\nBảo hành: 12 tháng kể từ ngày kích hoạt sản phẩm.\r\n\r\nKích hoạt bảo hành tại: https://checkcoverage.apple.com/vn/en/\r\n\r\n\r\n\r\nHướng dẫn kiểm tra địa điểm bảo hành gần nhất:\r\n\r\nBước 1: Truy cập vào đường link https://getsupport.apple.com/?caller=grl&locale=en_VN \r\n\r\nBước 2: Chọn sản phẩm.\r\n\r\nBước 3: Điền Apple ID, nhập mật khẩu.\r\n\r\nSau khi hoàn tất, hệ thống sẽ gợi ý những trung tâm bảo hành gần nhất.', 20090000.00, 25090000.00, '6747d28072e56.webp,6747d28078513.webp,6747d28078966.webp', 12),
(31, 1, 'Apple iPhone 16 Plus 256GB', 'Thông tin bảo hành:\r\n\r\nBảo hành: 12 tháng kể từ ngày kích hoạt sản phẩm.\r\n\r\nKích hoạt bảo hành tại: https://checkcoverage.apple.com/vn/en/\r\n\r\n\r\n\r\nHướng dẫn kiểm tra địa điểm bảo hành gần nhất:\r\n\r\nBước 1: Truy cập vào đường link https://getsupport.apple.com/?caller=grl&locale=en_VN \r\n\r\nBước 2: Chọn sản phẩm.\r\n\r\nBước 3: Điền Apple ID, nhập mật khẩu.\r\n\r\nSau khi hoàn tất, hệ thống sẽ gợi ý những trung tâm bảo hành gần nhất.', 28999000.00, 30998999.00, '6747d2b7712f3.webp,6747d2b7718d8.webp,6747d2b771e2d.webp', 100),
(32, 1, 'Samsung Galaxy A15 LTE', 'Thông tin kỹ thuật và đặc điểm chi tiết chưa được cập nhật cho đến khi có thông báo từ phía nhãn hàng', 4990000.00, 5089999.00, '6747d371a751e.webp,6747d371a7b04.webp,6747d371a7f67.webp', 123),
(34, 1, 'iPhone 16 Plus 512GB', 'Thông tin bảo hành:\r\n\r\nBảo hành: 12 tháng kể từ ngày kích hoạt sản phẩm.\r\n\r\nKích hoạt bảo hành tại: https://checkcoverage.apple.com/vn/en/\r\n\r\n\r\n\r\nHướng dẫn kiểm tra địa điểm bảo hành gần nhất:\r\n\r\nBước 1: Truy cập vào đường link https://getsupport.apple.com/?caller=grl&locale=en_VN \r\n\r\nBước 2: Chọn sản phẩm.\r\n\r\nBước 3: Điền Apple ID, nhập mật khẩu.\r\n\r\nSau khi hoàn tất, hệ thống sẽ gợi ý những trung tâm bảo hành gần nhất.', 12000000.00, 15000000.00, '6747d42c1b8f2.webp,6747d42c1bd08.webp,6747d42c1c295.webp', 1233),
(35, 1, 'Điện Thoại Oppo F11', 'Chỉ như vậy Mới đánh giá được ngoại hình, cũng như chất lượng của sản phẩm Mình tin rằng , Quý khách đến xem và test máy sẽ không thất vọng về dịch vụ cũng như sản phẩm của shop.\r\nCấu hình Điện thoại OPPO F11\r\nMàn hình: LTPS LCD6.5\"Full HD+\r\nHệ điều hành: Android 9 (Pie)\r\nCamera sau: Chính 48 MP & Phụ 5 MP\r\nCamera trước: 16 MP\r\nChip: MediaTek Helio P70\r\nRAM: 8GB\r\nBộ nhớ trong: 256 GB\r\nSIM: 2 Nano SIM (SIM 2 chung khe thẻ nhớ)Hỗ trợ 4G\r\nPin, Sạc: 4020 mAh\r\nCam kết chất lượng: Sản phẩm là Máy Chính hãng Sản Xuất. (shop không bán hàng Nhái, Fake, hàng Copy, kém chất lượng.\r\nMáy mới, Full Zalo, Facebook, Youtube, nghe gọi tốt, đặc biệt chơi Liên Quân-PUBG-Free Fire mướt. Trân Trọng!', 12000000.00, 1300000.00, '6747f4fee06d5.webp,6747f4fee0971.webp,6747f4fee0bfc.webp', 12),
(36, 2, 'Máy ẢNh Kỹ ThuậT Số', 'Thẻ nhớ cần được mua riêng, Máy ảnh này yêu cầu thẻ nhớ để sử dụng bình thường\r\n Mô tả sản phẩm\r\n Các tính năng:\r\n 1. Với chức năng chụp ảnh / video, một món quà hoàn hảo cho trẻ em.\r\n\r\n 2. Với dây buộc cổ để treo trên cổ, có thể bảo vệ máy ảnh khỏi bị rơi và hư hỏng.\r\n 3. Sử dụng thẻ nhớ TF thay thế thuận tiện, cung cấp nhiều khả năng sáng tạo hơn.\r\n 4. Thao tác một nút, dễ dàng và thuận tiện.\r\n 5. Máy ảnh trẻ em hiệu quả về chi phí, vui nhộn và thiết thực.', 1000000.00, 2000000.00, '6747f63798aee.webp,6747f63798d6d.webp,6747f63799036.webp', 12),
(37, 2, 'X2 HD 800W 2.0 Inch IPS ', 'Thẻ nhớ cần được mua riêng, Máy ảnh này yêu cầu thẻ nhớ để sử dụng bình thường\r\n\r\n Mô tả sản phẩm\r\n\r\n Các tính năng:\r\n\r\n 1. Với chức năng chụp ảnh / video, một món quà hoàn hảo cho trẻ em.\r\n\r\n 2. Với dây buộc cổ để treo trên cổ, có thể bảo vệ máy ảnh khỏi bị rơi và hư hỏng.\r\n\r\n 3. Sử dụng thẻ nhớ TF thay thế thuận tiện, cung cấp nhiều khả năng sáng tạo hơn.\r\n\r\n 4. Thao tác một nút, dễ dàng và thuận tiện.\r\n\r\n 5. Máy ảnh trẻ em hiệu quả về chi phí, vui nhộn và thiết thực.', 30000.00, 45000.00, '6747f65c978d6.webp,6747f65c97b01.webp', 123),
(38, 2, 'Máy Ảnh Mini Mèo Camera-007', 'Tính năng sản phẩm: chế độ máy ảnh, chế độ video, trò chơi mini tích hợp, nhãn dán ảnh, nghe nhạc, bộ lọc, v.v.\r\n\r\n Hỗ trợ nhiều ngôn ngữ: tiếng Trung, tiếng Anh, tiếng Trung, tiếng Nhật, tiếng Nga, tiếng Tây Ban Nha, tiếng Ba Lan, tiếng Pháp, v.v.\r\n\r\n Phụ kiện: máy ảnh, cáp, sách hướng dẫn, dây buộc\r\n\r\n Thẻ nhớ màn hình màu 2.0 inch hỗ trợ tối đa: 128GB\r\n\r\n Kích thước đơn: 120 * 105 * 60mm\r\n\r\n Trọng lượng cá nhân: 100g\r\n\r\n Dòng sạc và điện áp: 5V / 1A', 69000.00, 100000.00, '6747f6a1eeb84.webp,6747f6a1eee75.webp,6747f6a1ef06b.webp', 23),
(39, 3, 'Tai Nghe bass Mạnh Mẽ IC350', 'Thiết kế thời trang:✅Tai nghe F10 có các màu trắng, đen và một số màu khác trông rất đẹp, cá tính và được thiết kế khá thời trang.Giắc cắm mạ kim loại bắt mắt giúp truyền âm thanh tốt hơn.✅Sự tiện lợi:✅Một trong những điểm nổi bật của tai nghe F10 là có thể gấp gọn, bạn không chiếm nhiều diện tích khi cất vào balo, túi xách...Với thiết kế cáp tai nghe dài 1,2m, dễ dàng kết nối với điện thoại và laptop ở một khoảng cách nhất định.\r\n', 1200000.00, 1500000.00, '6747f763592af.webp,6747f763595bf.webp,6747f76359923.webp', 12);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'administrator', '2024-11-21 18:42:06', '2024-11-21 18:42:06'),
(2, 'user', 'normal user', '2024-11-21 18:42:06', '2024-11-21 18:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `image`, `password`, `address`, `phone`, `role_id`) VALUES
(1, 'admin', 'admin@gmail.com', 'aothethao.webp', '$2y$10$kM.5SxB7oROqnpRnTMq9T.WnOZ3tUmaXBoycfK8ivKZEWvy6vr8qO', '12', '12', 1),
(2, 'b21dcat027', 'lesyhoanganh2503@gmail.com', 'den.webp', '$2y$10$zDnHfafb3qF6YB1nSEvY2egoxpBRrnSmHDIGVyAod0FvdcxPvg6E6', 'hanoi', '0342835419', 2),
(3, 'hoanganh2503', 'abc@gmail.com', 'den.webp', '$2y$10$T9cybGe9E5gUOgPXvrzLjODzjPCAszDPaqzEREnhhJOSBRycx5bE2', '123', '123', 2),
(4, 'hoanganh', 'anh@gmail.com', 'aothethao.webp', '$2y$10$93KJ.hT9IHn0kUogp9wcF.kIC4HqxddaxBG2RVZnmToJM9YL9VAZC', 'hanoi', '0342835419', 2),
(5, 'ql@gmail.com', 'admi2n@gmail.com', 'aothethao.webp', '$2y$10$p4190kqGumuAycucNta6ueNOwsbUm4w4PZaDAExUPqYOv7eV3tOh.', '12', '12', 2),
(6, 'b21dcat0271', 'AnhLSH.B21AT027@stu.ptit.edu.vn', 'buom dem.jpg', '$2y$10$bn9debOKmOiLcjQt/33Z0.7RW2rY90SV9coKxLwA6z4iIlrcwNjqS', '123', '123', 2),
(7, '1212', 'admin1@gmail.com', 'sg-11134201-7qvdg-lfpcn9b9704n49.webp', '$2y$10$BdujYkYxreprREj3kJaCWelRibQFg9/kUW4kwX.ndzwNsa9XxaFpW', 'da', '0342835419', 2),
(8, 'abc', 'admi2n2@gmail.com', 'c1ecfa629db556147df42fa3a9e28c55.webp', '$2y$10$4h9GkNu4uhVXehXz8upy4ewRRW6FhyNGVq4UZ5unp9P8SH2AjPMJO', 'hanoi', '0342835419', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flashsale`
--
ALTER TABLE `flashsale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `flashsale`
--
ALTER TABLE `flashsale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
