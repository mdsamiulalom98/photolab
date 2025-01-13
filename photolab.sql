-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 11:12 AM
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
-- Database: `photolab`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'About Us', '<p>Lorem ipsum dolor sit, amet, consectetur adipisicing elit. Repellat ipsum, quis provident molestiae, in, excepturi odit optio, iste commodi eaque hic quae doloribus laudantium corporis quos magni ab eum tempora.</p><p>Doloribus nesciunt ut magni labore temporibus odio. Itaque, neque eos, accusamus unde asperiores laborum. Obcaecati repudiandae iste iure, provident quos aut numquam vero atque minus facere laborum iusto, explicabo sapiente!</p><p>Adipisci ut laudantium at ad esse voluptas possimus illo aut tempore necessitatibus ipsa blanditiis odio nihil similique molestiae fugiat, corrupti recusandae provident quam eius fuga quia magnam dolorum. Possimus, officiis!</p>', 'public/uploads/about/1734616384-about-us-page-1200x675.webp', 1, '2024-12-19 13:53:04', '2024-12-19 13:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `category_id`, `image`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'public/uploads/banner/1734533874why-us.png', '#', 1, '2024-12-18 13:23:57', '2024-12-18 14:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `banner_categories`
--

CREATE TABLE `banner_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_categories`
--

INSERT INTO `banner_categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Counter Banner', 1, '2024-12-18 12:32:59', '2024-12-18 12:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `title`, `slug`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Clipping Path Photo Editing Service', 'clipping-path-photo-editing-service', 'public/uploads/blog/1734539022-clipping-path2.webp', '<p><span style=\"color: rgb(124, 124, 144); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; text-align: justify;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 1, '2024-12-18 16:23:42', '2024-12-18 16:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Clipping Path', 'clipping-path', 1, '2024-12-18 16:15:23', '2024-12-18 16:15:23'),
(2, 'Image Masking', 'image-masking', 1, '2024-12-18 16:16:43', '2024-12-18 16:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nomant', 'nomant', 'public/uploads/brand/1734703264-clients-1.webp', 1, '2024-12-20 14:01:04', '2024-12-20 14:01:04'),
(2, 'Muchmore', 'muchmore', 'public/uploads/brand/1734703280-clients-2.webp', 1, '2024-12-20 14:01:20', '2024-12-20 14:01:20'),
(3, 'Businex', 'businex', 'public/uploads/brand/1734703295-clients-3.webp', 1, '2024-12-20 14:01:35', '2024-12-20 14:01:35'),
(4, 'Kitchuna', 'kitchuna', 'public/uploads/brand/1734703317-clients-4.webp', 1, '2024-12-20 14:01:57', '2024-12-20 14:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT 'public/uploads/category/default.png',
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `front_view` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `meta_title`, `meta_description`, `front_view`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Men\'s Collection', 'men\'s-collection', 'public/uploads/category/1730349059-49f31863cc17d101.webp', NULL, NULL, 1, 1, '2024-10-25 14:41:05', '2024-10-31 04:39:51'),
(2, 'Womens Fashion', 'womens-fashion', 'public/uploads/category/1730349037-46de73feaefc28cd.webp', NULL, NULL, 1, 1, '2024-10-25 15:37:18', '2024-10-31 04:30:37'),
(3, 'Cosmetics', 'cosmetics', 'public/uploads/category/1730349028-800e00a6322c6985.webp', NULL, NULL, 0, 1, '2024-10-25 15:39:21', '2024-10-31 04:30:28'),
(4, 'Gadgets', 'gadgets', 'public/uploads/category/1730349017-2e30d5fac47eff64.webp', NULL, NULL, 0, 1, '2024-10-25 15:41:46', '2024-10-31 04:30:17'),
(5, 'Grocery', 'grocery', 'public/uploads/category/1730348993-1400d6186b839cde.webp', NULL, NULL, 1, 1, '2024-10-25 15:47:44', '2024-10-31 04:29:54'),
(6, 'Home & Lifestyle', 'home-&-lifestyle', 'public/uploads/category/1730349005-e7947cc0cc4a6b7c.webp', NULL, NULL, 0, 1, '2024-10-26 15:38:59', '2024-10-31 04:30:05'),
(7, 'Mobile & Tablets', 'mobile-&-tablets', 'public/uploads/category/1730349126-6c22d4999cdb4144.webp', NULL, '<p>Mobile &amp; Tablets</p>', 0, 1, '2024-10-31 04:32:06', '2024-10-31 04:32:06'),
(8, 'TVs & Appliences', 'tvs-&-appliences', 'public/uploads/category/1730349178-4a5fb0c8e0461335.webp', NULL, '<p>TVs &amp; Appliences</p>', 0, 1, '2024-10-31 04:32:58', '2024-10-31 04:32:58'),
(10, 'Home & Kitchen', 'home-&-kitchen', 'public/uploads/category/1730349406-8538d487cd2bc8b7.webp', 'Home & Kitchen', '<p>Home &amp; Kitchen</p>', 0, 1, '2024-10-31 04:36:47', '2024-10-31 04:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `hotline` varchar(50) DEFAULT NULL,
  `hotmail` varchar(50) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `google_map` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `hotline`, `hotmail`, `phone`, `email`, `address`, `whatsapp`, `google_map`, `status`, `created_at`, `updated_at`) VALUES
(1, '01711991963', 'photolab365@gmail.com', '01711991963', 'photolab365@gmail.com', 'Mohammadpur,Dhaka-1207', '01711991963', NULL, 1, '2023-01-22 10:35:29', '2024-12-20 16:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `counter` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `icon`, `title`, `counter`, `status`, `created_at`, `updated_at`) VALUES
(1, 'fa-solid fa-users', 'Happy Clients', '50', 1, '2024-12-18 13:10:18', '2024-12-18 13:10:18'),
(2, 'fa-solid fa-cart-shopping', 'Total Orders', '500', 1, '2024-12-18 13:11:52', '2024-12-18 13:11:52'),
(3, 'fa-regular fa-clock', 'Working Hours', '4000', 1, '2024-12-18 13:12:52', '2024-12-18 13:12:52'),
(4, 'fa-solid fa-image', 'Photos Edited', '35000', 1, '2024-12-18 13:13:43', '2024-12-18 13:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `create_pages`
--

CREATE TABLE `create_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `create_pages`
--

INSERT INTO `create_pages` (`id`, `name`, `slug`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Refund & Return Policy', 'refund-&-return-policy', 'Refund & Return Policy', '<ul style=\"padding: 0px 0px 0px 20px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; border: 0px; list-style: none; color: rgb(33, 37, 41); font-family: Jost, sans-serif;\"><li style=\"margin: 0px; padding: 0px; border: 0px; list-style: initial;\"><p data-pm-slice=\"1 1 []\"><strong>Refund &amp; Return Policy</strong></p><p>Effective Date: [Insert Date]</p><p>At Photolab, we aim to ensure customer satisfaction with every order. This Refund &amp; Return Policy outlines the conditions under which refunds and returns may be processed. Please read carefully.</p><div><hr></div><h3>1. <strong>Eligibility for Refunds and Returns</strong></h3><h4>1.1 <strong>Damaged or Defective Products</strong></h4><p>If the product you receive is damaged or defective, you are eligible for a refund or replacement. Claims must be submitted within 7 days of receiving the product.</p><h4>1.2 <strong>Incorrect Orders</strong></h4><p>If you receive an incorrect order, please notify us within 7 days. We will correct the error at no additional cost.</p><h4>1.3 <strong>Non-Refundable Items</strong></h4><p>The following are not eligible for refunds:</p><ul data-spread=\"false\"><li><p>Digital photo editing services once completed and delivered</p></li><li><p>Customized or personalized photo products</p></li><li><p>Errors due to incorrect information or uploads provided by the customer</p></li></ul><div><hr></div><h3>2. <strong>Process for Refunds and Returns</strong></h3><h4>2.1 <strong>Refund Requests</strong></h4><p>To request a refund:</p><ul data-spread=\"false\"><li><p>Contact our customer service at [Insert Email Address] or [Insert Phone Number]</p></li><li><p>Provide your order number and a description of the issue</p></li><li><p>Attach photos of the damaged or defective item, if applicable</p></li></ul><h4>2.2 <strong>Return Process</strong></h4><p>For physical products:</p><ul data-spread=\"false\"><li><p>Return the item in its original condition and packaging</p></li><li><p>Include proof of purchase with the return</p></li><li><p>Ship the return to the address provided by our customer service team</p></li></ul><div><hr></div><h3>3. <strong>Refund Timeline</strong></h3><p>Refunds are processed within 7-10 business days after the returned item is received and inspected or after the refund request is approved for digital services.</p><div><hr></div><h3>4. <strong>Cancellation Policy</strong></h3><h4>4.1 <strong>Before Processing</strong></h4><p>Orders can be canceled without penalty if the request is made before processing begins.</p><h4>4.2 <strong>After Processing</strong></h4><p>Once processing has started, cancellations may not be eligible for a full refund.</p><div><hr></div><h3>5. <strong>Contact Us</strong></h3><p>If you have any questions or concerns about this Refund &amp; Return Policy, please contact us:</p><p><strong>Photolab</strong><br>Email: [Insert Email Address]<br>Phone: [Insert Phone Number]<br>Address: [Insert Address]</p><p>We value your trust and strive to provide the best service possible.</p><p></p></li></ul>', 1, '2023-10-04 07:03:42', '2024-12-23 11:06:35'),
(6, 'Terms & Conditions', 'terms-&-conditions', 'Terms & Conditions', '<p data-pm-slice=\"1 1 []\"><strong>Terms and Conditions for Photolab</strong></p><p>Effective Date: [Insert Date]</p><p>Welcome to Photolab. By accessing or using our website and services, you agree to be bound by these Terms and Conditions. Please read them carefully.</p><div><hr></div><h3>1. <strong>Acceptance of Terms</strong></h3><p>By using our services, you confirm that you have read, understood, and agreed to these Terms and Conditions. If you do not agree, please refrain from using our services.</p><div><hr></div><h3>2. <strong>Services Offered</strong></h3><p>Photolab provides photo editing, printing, and related services. The specific terms for each service will be outlined at the time of purchase.</p><div><hr></div><h3>3. <strong>User Responsibilities</strong></h3><p>When using our services, you agree to:</p><ul data-spread=\"false\"><li><p>Provide accurate and complete information</p></li><li><p>Not upload or share content that is unlawful, obscene, or infringes on intellectual property rights</p></li><li><p>Ensure that you have the rights to the photos or content you upload</p></li></ul><div><hr></div><h3>4. <strong>Payment and Pricing</strong></h3><h4>4.1 <strong>Pricing</strong></h4><p>Prices for our services are displayed on our website and are subject to change without notice.</p><h4>4.2 <strong>Payment</strong></h4><p>Payment is required at the time of order placement. We accept major credit cards and other payment methods as listed on our website.</p><h4>4.3 <strong>Refunds</strong></h4><p>Refunds are only issued under specific circumstances as outlined in our Refund Policy.</p><div><hr></div><h3>5. <strong>Content Ownership and Usage</strong></h3><p>You retain ownership of any photos or content you upload to our website. By uploading, you grant Photolab a non-exclusive, royalty-free license to use your content solely for the purpose of providing the requested services.</p><div><hr></div><h3>6. <strong>Delivery of Services</strong></h3><p>We aim to deliver all orders within the specified timeframes. Delays may occur due to unforeseen circumstances. Photolab is not responsible for delays caused by third-party service providers or events beyond our control.</p><div><hr></div><h3>7. <strong>Limitation of Liability</strong></h3><p>Photolab will not be held liable for any indirect, incidental, or consequential damages arising from the use of our services. Our maximum liability is limited to the amount paid for the specific service.</p><div><hr></div><h3>8. <strong>Termination</strong></h3><p>We reserve the right to terminate or suspend your access to our services without prior notice if you violate these Terms and Conditions or engage in prohibited activities.</p><div><hr></div><h3>9. <strong>Governing Law</strong></h3><p>These Terms and Conditions are governed by the laws of [Insert Jurisdiction]. Any disputes arising from these terms will be resolved in the courts of [Insert Jurisdiction].</p><div><hr></div><h3>10. <strong>Changes to Terms and Conditions</strong></h3><p>We may update these Terms and Conditions from time to time. The revised terms will be posted on this page and are effective immediately upon posting. Your continued use of our services constitutes acceptance of the revised terms.</p><div><hr></div><h3>11. <strong>Contact Us</strong></h3><p>If you have any questions about these Terms and Conditions, please contact us at:</p><p><strong>Photolab</strong><br>Email: [Insert Email Address]<br>Phone: [Insert Phone Number]<br>Address: [Insert Address]</p><p>Thank you for choosing Photolab.</p>', 1, '2023-10-04 07:04:05', '2024-12-23 11:05:15'),
(7, 'Privacy Policy', 'privacy-policy', 'Privacy Policy', '<p data-pm-slice=\"1 1 []\"><strong>Privacy Policy for Photolab</strong></p><p>Effective Date: [Insert Date]</p><p>Welcome to Photolab. Your privacy is important to us, and this Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website and use our services.</p><div><hr></div><h3>1. <strong>Information We Collect</strong></h3><h4>1.1 <strong>Personal Information</strong></h4><p>We may collect personal information that you voluntarily provide to us when you:</p><ul data-spread=\"false\"><li><p>Register an account</p></li><li><p>Place an order for photo editing or printing services</p></li><li><p>Contact customer support</p></li></ul><p>Examples of personal information include:</p><ul data-spread=\"false\"><li><p>Name</p></li><li><p>Email address</p></li><li><p>Phone number</p></li><li><p>Billing and shipping address</p></li><li><p>Payment information</p></li></ul><h4>1.2 <strong>Non-Personal Information</strong></h4><p>We automatically collect certain non-personal information when you visit our website, such as:</p><ul data-spread=\"false\"><li><p>IP address</p></li><li><p>Browser type and version</p></li><li><p>Operating system</p></li><li><p>Referring URL</p></li><li><p>Pages viewed</p></li><li><p>Time and date of access</p></li></ul><h4>1.3 <strong>Uploaded Content</strong></h4><p>When you upload photos for editing or printing, we collect and store the images and any associated data.</p><div><hr></div><h3>2. <strong>How We Use Your Information</strong></h3><p>We use the information we collect to:</p><ul data-spread=\"false\"><li><p>Process and fulfill your orders</p></li><li><p>Provide customer support</p></li><li><p>Improve and personalize your experience on our website</p></li><li><p>Send updates, promotions, or service-related communications</p></li><li><p>Detect and prevent fraud or unauthorized activities</p></li><li><p>Comply with legal obligations</p></li></ul><div><hr></div><h3>3. <strong>How We Share Your Information</strong></h3><p>We do not sell or rent your personal information to third parties. However, we may share your information in the following scenarios:</p><h4>3.1 <strong>Service Providers</strong></h4><p>We may share your information with trusted third-party vendors and service providers who assist in operating our website, processing payments, or delivering services. These parties are bound by confidentiality agreements.</p><h4>3.2 <strong>Legal Requirements</strong></h4><p>We may disclose your information if required by law or if we believe such action is necessary to:</p><ul data-spread=\"false\"><li><p>Comply with legal processes</p></li><li><p>Protect and defend our rights or property</p></li><li><p>Prevent fraud or illegal activity</p></li></ul><h4>3.3 <strong>Business Transfers</strong></h4><p>In the event of a merger, acquisition, or sale of assets, your information may be transferred to the involved parties.</p><div><hr></div><h3>4. <strong>How We Protect Your Information</strong></h3><p>We implement reasonable technical, administrative, and physical security measures to protect your personal information from unauthorized access, use, or disclosure. However, no method of transmission over the internet or electronic storage is 100% secure.</p><div><hr></div><h3>5. <strong>Your Rights and Choices</strong></h3><h4>5.1 <strong>Access and Update</strong></h4><p>You can access and update your personal information by logging into your account.</p><h4>5.2 <strong>Opt-Out</strong></h4><p>You may opt out of receiving promotional emails by following the unsubscribe link in our emails. Note that you may still receive non-promotional communications regarding your account or orders.</p><h4>5.3 <strong>Delete Your Information</strong></h4><p>You can request the deletion of your personal data by contacting us at [Insert Email Address].</p><div><hr></div><h3>6. <strong>Cookies and Tracking Technologies</strong></h3><p>We use cookies and similar technologies to enhance your browsing experience. You can control or disable cookies through your browser settings, but some features of our website may not function properly.</p><div><hr></div><h3>7. <strong>Children\'s Privacy</strong></h3><p>Our services are not intended for individuals under the age of 13. We do not knowingly collect personal information from children under 13. If we learn that we have collected such information, we will delete it promptly.</p><div><hr></div><h3>8. <strong>Third-Party Links</strong></h3><p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of those websites. We encourage you to read their privacy policies.</p><div><hr></div><h3>9. <strong>Changes to This Privacy Policy</strong></h3><p>We may update this Privacy Policy from time to time. Any changes will be effective immediately upon posting the revised policy on this page. We encourage you to review this page periodically.</p><div><hr></div><h3>10. <strong>Contact Us</strong></h3><p>If you have any questions or concerns about this Privacy Policy or our practices, please contact us at:</p><p><strong>Photolab</strong><br>Email: [Insert Email Address]<br>Phone: [Insert Phone Number]<br>Address: [Insert Address]</p><p>Thank you for trusting Photolab with your photos and personal information.</p>', 1, '2023-10-04 07:04:19', '2024-12-23 11:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, 'What is your return policy?', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum ipsam odio voluptates ab quae beatae nihil illo alias vitae minima cumque atque, deleniti quos animi nostrum, veritatis quisquam ullam ducimus laboriosam reprehenderit sapiente, quo necessitatibus dolorem. Impedit sed, similique corporis quo totam, veniam consequatur blanditiis, voluptates ipsa eligendi excepturi incidunt facilis ex tempore? Ut vero voluptatum quis doloremque accusantium saepe.', 1, '2024-12-22 11:52:41', '2024-12-22 12:59:08'),
(2, 'How do I place an order?', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum ipsam odio voluptates ab quae beatae nihil illo alias vitae minima cumque atque, deleniti quos animi nostrum, veritatis quisquam ullam ducimus laboriosam reprehenderit sapiente, quo necessitatibus dolorem. Impedit sed, similique corporis quo totam, veniam consequatur blanditiis, voluptates ipsa eligendi excepturi incidunt facilis ex tempore? Ut vero voluptatum quis doloremque accusantium saepe.', 1, '2024-12-22 11:53:57', '2024-12-22 12:56:36'),
(3, 'How can I track my order?', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum ipsam odio voluptates ab quae beatae nihil illo alias vitae minima cumque atque, deleniti quos animi nostrum, veritatis quisquam ullam ducimus laboriosam reprehenderit sapiente, quo necessitatibus dolorem. Impedit sed, similique corporis quo totam, veniam consequatur blanditiis, voluptates ipsa eligendi excepturi incidunt facilis ex tempore? Ut vero voluptatum quis doloremque accusantium saepe.', 1, '2024-12-22 12:57:48', '2024-12-22 12:58:47'),
(4, 'Can I modify or cancel my order after placing it?', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum ipsam odio voluptates ab quae beatae nihil illo alias vitae minima cumque atque, deleniti quos animi nostrum, veritatis quisquam ullam ducimus laboriosam reprehenderit sapiente, quo necessitatibus dolorem. Impedit sed, similique corporis quo totam, veniam consequatur blanditiis, voluptates ipsa eligendi excepturi incidunt facilis ex tempore? Ut vero voluptatum quis doloremque accusantium saepe.', 1, '2024-12-22 12:57:55', '2024-12-22 12:58:30'),
(5, 'What payment methods do you accept?', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum ipsam odio voluptates ab quae beatae nihil illo alias vitae minima cumque atque, deleniti quos animi nostrum, veritatis quisquam ullam ducimus laboriosam reprehenderit sapiente, quo necessitatibus dolorem. Impedit sed, similique corporis quo totam, veniam consequatur blanditiis, voluptates ipsa eligendi excepturi incidunt facilis ex tempore? Ut vero voluptatum quis doloremque accusantium saepe.', 1, '2024-12-22 12:58:01', '2024-12-22 12:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(55) NOT NULL,
  `white_logo` varchar(255) NOT NULL,
  `dark_logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `copyright` varchar(155) DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `name`, `white_logo`, `dark_logo`, `favicon`, `copyright`, `meta_description`, `meta_title`, `meta_keyword`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Photo Lab', 'public/uploads/settings/1734500666-photo-lab.webp', 'public/uploads/settings/1734500666-photo-lab.webp', 'public/uploads/settings/1729703921-favicon.webp', NULL, 'We sell cosmetics clothes jewelery in Bangladesh', 'Photo Lab', '<p>cosmetics, jewellery, clothes</p>', 1, '2023-01-21 12:01:07', '2024-12-18 05:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `how_it_works`
--

CREATE TABLE `how_it_works` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `how_it_works`
--

INSERT INTO `how_it_works` (`id`, `name`, `description`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Request Quote', 'Get a quote in your inbox within 45 minutes.', 'fa-regular fa-envelope', 1, '2024-12-23 13:24:08', '2024-12-23 13:24:08'),
(2, 'Place Order', 'Get a quote in your inbox within 45 minutes.', 'fa-solid fa-cart-plus', 1, '2024-12-23 13:26:10', '2024-12-23 13:29:47'),
(3, 'Pay your bill', 'Pick the service you are looking for- from the website or the app.', 'fa-solid fa-dollar-sign', 1, '2024-12-23 13:27:05', '2024-12-23 13:29:25'),
(4, 'Download Image', 'Enjoy up to 40% Off on accommodation when you stay at Adaaran Select Hudhuran Fushi.', 'fa-solid fa-download', 1, '2024-12-23 13:27:58', '2024-12-23 13:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'public/uploads/default/user.png',
  `district_id` int(4) DEFAULT NULL,
  `area_id` int(4) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `default_method` varchar(25) DEFAULT NULL,
  `payment_type` varchar(55) DEFAULT NULL,
  `verify` int(11) NOT NULL,
  `forgot` int(11) DEFAULT NULL,
  `agree` tinyint(4) NOT NULL,
  `read_notices` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`read_notices`)),
  `twofa` tinyint(2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `name`, `shop_name`, `shop_id`, `phone`, `email`, `password`, `image`, `district_id`, `area_id`, `address`, `default_method`, `payment_type`, `verify`, `forgot`, `agree`, `read_notices`, `twofa`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Merchant One', 'Merchant One', 100001, '01766950986', 'info@websolutionit.com', '$2y$10$zC77AtYIcD/gNzE.bofNZ.bvAnzRF.E2YniItAljjBhYUYxGa6WXm', 'public/uploads/default/user.png', 46, 887, 'Dinajpur City College', 'bkash', 'per', 1, NULL, 1, '[2,1]', NULL, 1, '2024-11-05 02:44:41', '2024-11-05 02:46:54'),
(2, 'Merchant 2', 'Business 2', 100002, '01781013627', 'nm.milon97@gmail.com', '$2y$10$z3mH0ClpjZbZuZedp.43NeiRVYwFDTSHuwtMemuMTE3xid7Z9HK7u', 'public/uploads/default/user.png', 46, 888, 'City College , Dinajpur', NULL, NULL, 1, NULL, 1, '[2,1]', NULL, 1, '2024-11-05 07:48:04', '2024-11-06 10:32:48'),
(3, 'Ekramul haque', 'other', 100003, '01824416130', 'test@gmail.com', '$2y$10$6i2PD2VvOAllUT8q.7pPw.unsxP2vFMAYxuuqkKE95/r3.Ycr8NH6', 'public/uploads/default/user.png', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, '[2,1]', NULL, 1, '2024-12-04 05:48:51', '2024-12-04 06:19:07'),
(4, 'Ekramul haque', 'Test', 100004, '01824416140', 'admin2@gmail.com', '$2y$10$CCLuFiWbiaXofijyJBCxm.jc6ZPKiiLSXu8yX/48nvNRiS5LqFR6a', 'public/uploads/default/user.png', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, 1, '2024-12-30 09:51:40', '2024-12-30 11:29:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_21_150317_create_general_settings_table', 1),
(6, '2023_01_22_140830_create_social_media_table', 1),
(7, '2023_01_22_153053_create_contacts_table', 1),
(8, '2023_01_22_171430_create_categories_table', 1),
(9, '2023_02_21_083509_create_banners_table', 1),
(10, '2023_02_21_083647_create_banner_categories_table', 1),
(11, '2023_02_25_022224_create_create_pages_table', 1),
(12, '2024_10_29_134102_create_permission_tables', 1),
(13, '2024_12_17_120733_create_sliders_table', 2),
(14, '2024_12_18_114738_create_services_table', 3),
(15, '2024_12_18_153215_create_why_chooses_table', 4),
(17, '2024_12_18_181409_create_counters_table', 5),
(22, '2024_12_18_214900_create_blog_categories_table', 6),
(23, '2024_12_18_220048_create_blogs_table', 6),
(24, '2023_03_30_050646_create_abouts_table', 7),
(25, '2024_04_01_084424_create_mission_vissions_table', 7),
(26, '2024_12_19_125049_create_brands_table', 8),
(27, '2024_12_19_150607_create_testimonials_table', 8),
(28, '2024_12_21_122943_create_portfolios_table', 9),
(29, '2024_12_21_122952_create_portfolio_categories_table', 9),
(30, '2024_12_22_173957_create_faqs_table', 10),
(31, '2024_12_22_174046_create_pricings_table', 10),
(32, '2024_12_23_185943_create_how_it_works_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `mission_vissions`
--

CREATE TABLE `mission_vissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mission_vissions`
--

INSERT INTO `mission_vissions` (`id`, `category`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Our Mission', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde vitae perferendis obcaecati totam recusandae saepe, aliquam autem culpa reprehenderit id, ex numquam blanditiis. Expedita odio similique sapiente excepturi deserunt consectetur.</p>', 1, '2024-12-19 15:46:22', '2024-12-19 15:46:22'),
(2, '2', 'Our Vission', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde vitae perferendis obcaecati totam recusandae saepe, aliquam autem culpa reprehenderit id, ex numquam blanditiis. Expedita odio similique sapiente excepturi deserunt consectetur.</p>', 1, '2024-12-19 15:46:39', '2024-12-19 15:46:39');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'web', '2024-12-17 05:03:39', '2024-12-17 05:03:39'),
(2, 'user-create', 'web', '2024-12-17 05:10:24', '2024-12-17 05:10:24'),
(3, 'user-edit', 'web', '2024-12-17 05:10:31', '2024-12-17 05:10:36'),
(4, 'user-delete', 'web', '2024-12-17 05:10:50', '2024-12-17 05:10:50'),
(5, 'role-list', 'web', '2024-12-17 05:10:58', '2024-12-17 05:10:58'),
(6, 'role-create', 'web', '2024-12-17 05:11:05', '2024-12-17 05:11:05'),
(7, 'role-edit', 'web', '2024-12-17 05:11:13', '2024-12-17 05:11:13'),
(8, 'role-delete', 'web', '2024-12-17 05:11:19', '2024-12-17 05:11:19'),
(9, 'permission-list', 'web', '2024-12-17 05:11:29', '2024-12-17 05:11:29'),
(10, 'permission-create', 'web', '2024-12-17 05:11:49', '2024-12-17 05:11:49'),
(11, 'permission-edit', 'web', '2024-12-17 05:11:58', '2024-12-17 05:12:04'),
(12, 'permission-delete', 'web', '2024-12-17 05:12:14', '2024-12-17 05:12:14'),
(13, 'setting-list', 'web', '2024-12-17 05:12:21', '2024-12-17 05:12:21'),
(14, 'setting-crete', 'web', '2024-12-17 05:12:31', '2024-12-17 05:12:31'),
(15, 'setting-edit', 'web', '2024-12-17 05:12:39', '2024-12-17 05:12:39'),
(16, 'setting-delete', 'web', '2024-12-17 05:12:45', '2024-12-17 05:12:45'),
(17, 'slider-list', 'web', '2024-12-17 06:14:02', '2024-12-17 06:14:30'),
(18, 'slider-create', 'web', '2024-12-17 06:14:13', '2024-12-17 06:14:13'),
(19, 'slider-edit', 'web', '2024-12-17 06:14:46', '2024-12-17 06:14:46'),
(20, 'slider-delete', 'web', '2024-12-17 06:15:03', '2024-12-17 06:15:03'),
(21, 'contact-list', 'web', '2024-12-18 05:45:10', '2024-12-18 05:45:10'),
(22, 'contact-create', 'web', '2024-12-18 05:45:17', '2024-12-18 05:45:17'),
(23, 'contact-edit', 'web', '2024-12-18 05:45:24', '2024-12-18 05:45:24'),
(24, 'contact-delete', 'web', '2024-12-18 05:45:31', '2024-12-18 05:45:31'),
(25, 'service-list', 'web', '2024-12-18 06:33:50', '2024-12-18 06:33:50'),
(26, 'service-create', 'web', '2024-12-18 06:33:57', '2024-12-18 06:33:57'),
(27, 'service-edit', 'web', '2024-12-18 06:34:27', '2024-12-18 06:34:27'),
(28, 'service-delete', 'web', '2024-12-18 06:34:38', '2024-12-18 06:34:38'),
(29, 'whychoose-list', 'web', '2024-12-18 10:34:55', '2024-12-18 10:34:55'),
(30, 'whychoose-create', 'web', '2024-12-18 10:35:04', '2024-12-18 10:35:04'),
(31, 'whychoose-edit', 'web', '2024-12-18 10:35:17', '2024-12-18 10:35:17'),
(32, 'whychoose-delete', 'web', '2024-12-18 10:35:27', '2024-12-18 10:35:27'),
(33, 'banner-list', 'web', '2024-12-18 12:02:52', '2024-12-18 12:02:52'),
(34, 'banner-create', 'web', '2024-12-18 12:05:53', '2024-12-18 12:05:53'),
(35, 'banner-edit', 'web', '2024-12-18 12:06:00', '2024-12-18 12:06:00'),
(36, 'banner-delete', 'web', '2024-12-18 12:06:07', '2024-12-18 12:06:07'),
(37, 'banner-category-list', 'web', '2024-12-18 12:07:07', '2024-12-18 12:07:07'),
(38, 'banner-category-create', 'web', '2024-12-18 12:07:16', '2024-12-18 12:07:16'),
(39, 'banner-category-edit', 'web', '2024-12-18 12:07:25', '2024-12-18 12:07:25'),
(40, 'banner-category-delete', 'web', '2024-12-18 12:07:34', '2024-12-18 12:07:34'),
(41, 'counter-list', 'web', '2024-12-18 13:03:32', '2024-12-18 13:03:32'),
(42, 'counter-create', 'web', '2024-12-18 13:03:39', '2024-12-18 13:03:39'),
(43, 'counter-edit', 'web', '2024-12-18 13:03:47', '2024-12-18 13:03:47'),
(44, 'counter-delete', 'web', '2024-12-18 13:03:56', '2024-12-18 13:03:56'),
(45, 'page-list', 'web', '2024-12-23 11:00:21', '2024-12-23 11:00:21'),
(46, 'page-create', 'web', '2024-12-23 11:00:30', '2024-12-23 11:00:30'),
(47, 'page-edit', 'web', '2024-12-23 11:00:37', '2024-12-23 11:00:37'),
(48, 'page-delete', 'web', '2024-12-23 11:00:47', '2024-12-23 11:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_one` text NOT NULL,
  `image_two` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `category_id`, `image_one`, `image_two`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'public/uploads/portfolio/1734947310-clipping-path2-before_1605700116.webp', 'public/uploads/portfolio/1734947310-clipping-path2-after_1605700116.webp', 1, '2024-12-21 07:49:33', '2024-12-23 09:48:30'),
(2, 2, 'public/uploads/portfolio/1734947267-background-removal2-before_1605699377.webp', 'public/uploads/portfolio/1734947267-background-removal2-after_1605699377.webp', 1, '2024-12-21 07:55:06', '2024-12-23 09:47:47'),
(3, 3, 'public/uploads/portfolio/1734947252-background-removal-before_1605699360.webp', 'public/uploads/portfolio/1734947252-background-removal-after_1605699360.webp', 1, '2024-12-21 07:55:25', '2024-12-23 09:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_categories`
--

CREATE TABLE `portfolio_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Clipping Path', 'clipping-path', 1, '2024-12-21 07:28:13', '2024-12-21 07:28:13'),
(2, 'Background Removal', 'background-removal', 1, '2024-12-21 07:28:52', '2024-12-21 07:28:52'),
(3, 'Image Masking', 'image-masking', 1, '2024-12-21 07:29:10', '2024-12-21 07:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `pricings`
--

CREATE TABLE `pricings` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `new_price` decimal(11,2) NOT NULL,
  `old_price` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricings`
--

INSERT INTO `pricings` (`id`, `service_id`, `name`, `new_price`, `old_price`, `created_at`, `updated_at`) VALUES
(1, 5, 'Easy Ghosting', 1.00, 1.50, '2024-12-22 12:12:40', '2024-12-23 09:31:55'),
(2, 5, 'Medium Ghosting', 2.00, 2.50, '2024-12-22 12:36:55', '2024-12-23 09:31:55'),
(3, 5, 'Hard Ghosting', 3.00, 3.45, '2024-12-22 12:37:10', '2024-12-23 09:31:55'),
(4, 6, 'Easy Retouching', 1.00, 1.40, '2024-12-22 12:38:57', '2024-12-23 09:22:36'),
(5, 6, 'Medium Retouching', 2.00, 2.40, '2024-12-22 12:38:57', '2024-12-23 09:22:37'),
(6, 6, 'Hard Retouching', 3.00, 3.40, '2024-12-23 09:22:37', '2024-12-23 09:22:37'),
(7, 2, 'Easy Background Remove', 1.01, 1.40, '2024-12-23 09:26:40', '2024-12-23 09:32:28'),
(8, 2, 'Medium Background Remove', 2.00, 2.40, '2024-12-23 09:26:40', '2024-12-23 09:32:28'),
(9, 2, 'Hard Background Remove', 3.00, 3.40, '2024-12-23 09:26:40', '2024-12-23 09:32:28'),
(10, 4, 'Easy Drop Shadow', 1.00, 1.45, '2024-12-23 09:28:48', '2024-12-23 09:28:48'),
(11, 4, 'Medium Drop Shadow', 2.00, 2.45, '2024-12-23 09:28:48', '2024-12-23 09:28:48'),
(12, 4, 'Hard Drop Shadow', 3.00, 3.45, '2024-12-23 09:28:48', '2024-12-23 09:28:48'),
(13, 3, 'Easy Masking', 1.00, 1.45, '2024-12-23 09:30:01', '2024-12-23 09:30:01'),
(14, 3, 'Medium Masking', 2.00, 2.45, '2024-12-23 09:30:01', '2024-12-23 09:30:01'),
(15, 3, 'Hard Masking', 3.00, 3.45, '2024-12-23 09:30:01', '2024-12-23 09:30:01'),
(16, 1, 'Easy Clipping path', 1.00, 1.45, '2024-12-23 09:30:55', '2024-12-23 09:30:55'),
(17, 1, 'Medium Clipping path', 2.00, 2.45, '2024-12-23 09:30:55', '2024-12-23 09:30:55'),
(18, 1, 'Hard Clipping path', 3.00, 3.45, '2024-12-23 09:30:55', '2024-12-23 09:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'web', '2024-12-17 05:13:00', '2024-12-17 05:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `short_description`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Clipping path', 'clipping-path', 'Clipping path is an exceptional choice of quality background removal priority service from Clipping Path India Pro.', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'public/uploads/service/1734512587-clipping-path.webp', 1, '2024-12-18 06:48:53', '2024-12-22 06:24:44'),
(2, 'Background Removal', 'background-removal', 'Clipping path is an exceptional choice of quality background removal priority service from Clipping Path India Pro.', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'public/uploads/service/1734512653-background-removal.webp', 1, '2024-12-18 06:50:36', '2024-12-22 06:24:49'),
(3, 'Image Masking', 'image-masking', 'Clipping path is an exceptional choice of quality background removal priority service from Clipping Path India Pro.', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'public/uploads/service/1734512663-image-masking.webp', 1, '2024-12-18 06:53:00', '2024-12-22 06:24:54'),
(4, 'Drop Shadow', 'drop-shadow', 'Clipping path is an exceptional choice of quality background removal priority service from Clipping Path India Pro.', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'public/uploads/service/1734512679-drop-shadow.webp', 1, '2024-12-18 06:54:00', '2024-12-22 06:24:39'),
(5, 'Ghost Mannequin', 'ghost-mannequin', 'Clipping path is an exceptional choice of quality background removal priority service from Clipping Path India Pro.', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'public/uploads/service/1734512705-ghost-mannequin.webp', 1, '2024-12-18 06:55:09', '2024-12-22 06:24:35'),
(6, 'Photo Retouching', 'photo-retouching', 'Clipping path is an exceptional choice of quality background removal priority service from Clipping Path India Pro.', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'public/uploads/service/1734512715-photo-retouching.webp', 1, '2024-12-18 07:10:56', '2024-12-22 06:24:28');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `sub_title`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Welcome to Clipping Photo Editior Website', 'Find Value And Build confidence. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'public/uploads/users/1734420760-slider-one.webp', 1, '2024-12-17 07:32:40', '2024-12-17 07:32:40'),
(2, 'Welcome to Clipping Photo Editior Website', 'Find Value And Build confidence. Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'public/uploads/users/1734425402-banner.webp', 1, '2024-12-17 08:50:02', '2024-12-17 08:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `link` varchar(155) NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `title`, `icon`, `link`, `color`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Facebook', 'fab fa-facebook-f', 'https://www.facebook.com/shoppingghor570', '#f78345', 1, '2023-02-12 11:32:20', '2024-03-02 18:17:42'),
(3, 'Official Mail', 'fab fa-google', 'https://www.instagram.com/shoppingghor1/', '#c53302', 1, '2023-02-14 03:29:41', '2024-06-07 19:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Md Zadu Mia', 'Sr. Developer', '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore sint amet fuga a, sit quia porro voluptatibus debitis, dolorum, aut quae omnis similique accusantium.</p>', 'public/uploads/testimonial/1734704048-1730514449-user.webp', 1, '2024-12-20 14:14:08', '2024-12-20 14:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$NUTmZoutuuOliWdRlt/GhuCyFp4Cab6GdosfNeKf7pCp1mymJDpse', '', 1, NULL, '2024-10-29 02:01:47', '2024-10-29 03:15:10'),
(2, 'Photo Lab', 'info@photolab.com', NULL, '$2y$10$g9U0UarpP.wHBP/HRbU8M.a059TKvsgXtb2rnGjJBCPH.0tJ3mk5u', 'public/uploads/users/1734968805-hub-user.webp', 1, NULL, '2024-10-29 03:17:01', '2024-12-23 15:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `why_chooses`
--

CREATE TABLE `why_chooses` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `why_chooses`
--

INSERT INTO `why_chooses` (`id`, `icon`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'fa-regular fa-star', '100% Quality Ensured', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 1, '2024-12-18 11:09:47', '2024-12-18 11:16:00'),
(2, 'fa-solid fa-truck', 'Fast Delivery', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 1, '2024-12-18 11:10:53', '2024-12-18 11:15:48'),
(3, 'fa-solid fa-list-check', 'Bulk Order Processing', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 1, '2024-12-18 11:11:55', '2024-12-18 11:15:34'),
(4, 'fa-regular fa-clock', '24/7 support', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 1, '2024-12-18 11:12:56', '2024-12-18 11:15:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_categories`
--
ALTER TABLE `banner_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_categories_slug_index` (`slug`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `how_it_works`
--
ALTER TABLE `how_it_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchants_phone_unique` (`phone`) USING BTREE,
  ADD UNIQUE KEY `merchants_email_unique` (`email`) USING BTREE,
  ADD KEY `merchants_district_index` (`district_id`) USING BTREE,
  ADD KEY `merchants_area_index` (`area_id`) USING BTREE,
  ADD KEY `merchants_status_index` (`status`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mission_vissions`
--
ALTER TABLE `mission_vissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_type`,`model_id`),
  ADD KEY `model_type` (`model_type`),
  ADD KEY `model_id` (`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_type`,`model_id`),
  ADD KEY `model_type` (`model_type`,`model_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricings`
--
ALTER TABLE `pricings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `why_chooses`
--
ALTER TABLE `why_chooses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner_categories`
--
ALTER TABLE `banner_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `how_it_works`
--
ALTER TABLE `how_it_works`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `mission_vissions`
--
ALTER TABLE `mission_vissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pricings`
--
ALTER TABLE `pricings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `why_chooses`
--
ALTER TABLE `why_chooses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
