-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 11:16 AM
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
-- Database: `irecoverdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `number` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `type_of_entity` varchar(100) NOT NULL,
  `registered_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `user_name`, `password`, `number`, `email`, `district`, `address`, `type_of_entity`, `registered_at`) VALUES
(1, 'Dovin Ssenyange', '$2y$10$lveIVyqq.RQgfh.Mc7yu/OgV0e8sVGhwUltLA3pkFy/ZUImlHNkRK', 777512529, 'dovinsmart@gmail.com', 'Wakiso', 'Wakiso Kampala Street P.O.Box 102', 'Company', '2025-01-17 / 03:59:58 PM'),
(2, 'Kasongo John', '$2y$10$Mn2S8ZtrUMvBI9c5wisYAu1WTRnlsyxw5qxuvUv2FnwMko/9Kahn6', 777512529, 'raymond.kisekka360@gmail.com', 'Wakiso', 'Wakiso Kampala Street P.O.Box 102', 'Organization', '2025-01-17 / 04:04:53 PM'),
(3, 'Ekure', 'Joseph', 777512529, 'raymond.kisekka360@gmail.com', 'Wakiso', 'Wakiso Kampala Street P.O.Box 102', 'Organization', '2025-01-20 / 10:46:51 AM');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `document_type` varchar(50) DEFAULT NULL,
  `id_number` varchar(100) DEFAULT NULL,
  `id_name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `document_photo` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document_type`, `id_number`, `id_name`, `dob`, `document_photo`, `phone_number`, `email`, `created_at`) VALUES
(2, NULL, NULL, NULL, NULL, 'uploads/WhatsApp Image 2024-12-04 at 11.08.55_ef8acdcc.jpg', NULL, NULL, '2024-12-04 14:12:33'),
(3, 'nationalID', 'hhghghgh', 'jrttt', '2024-12-25', 'uploads/WhatsApp Image 2024-12-04 at 11.08.54_86e19604.jpg', '+256 9777676206', 'sedricksedu2@gmail.com', '2024-12-04 14:17:08'),
(4, 'nationalID', 'cm48038345-08', 'Sedrick Otolo', '2024-12-04', 'uploads/ekuka.png', '+256 9777676206', 'sedricksedu2@gmail.com', '2024-12-04 14:33:59'),
(5, 'nationalID', '123', 'Sedu', '2024-12-04', 'uploads/WhatsApp Image 2024-12-04 at 11.08.55_ef8acdcc.jpg', '+256 9777676206', 'sedricksedu2@gmail.com', '2024-12-04 14:45:48'),
(6, 'studentID', '12', '12', '2024-12-03', 'uploads/WhatsApp Image 2024-12-04 at 11.08.55_04591312.jpg', '0777676206', 'sedricksedu2@gmail.com', '2024-12-04 15:00:26'),
(7, 'drivingPermit', '1234', 'Nam Ronny', '2024-12-04', 'uploads/WhatsApp Image 2024-12-04 at 11.08.56_7bfff6b1.jpg', '0780286800', 'steujps@gmail.com', '2024-12-04 15:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `driving_permits`
--

CREATE TABLE `driving_permits` (
  `driver_id` int(11) NOT NULL,
  `sur_name` varchar(255) NOT NULL,
  `given_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `permit_number` varchar(100) NOT NULL,
  `nin_number` varchar(100) NOT NULL,
  `front` varchar(255) NOT NULL,
  `back` varchar(255) NOT NULL,
  `user_action` varchar(100) NOT NULL,
  `date_found` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driving_permits`
--

INSERT INTO `driving_permits` (`driver_id`, `sur_name`, `given_name`, `dob`, `permit_number`, `nin_number`, `front`, `back`, `user_action`, `date_found`) VALUES
(1, 'Ssenyange', 'Dovin', '2025-01-16', '422244', '98765467', '11.jpg', '7.jpg', 'Found', '2025-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `found_documents`
--

CREATE TABLE `found_documents` (
  `id` int(11) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `name_on_document` varchar(255) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `contact_info` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `found_ids`
--

CREATE TABLE `found_ids` (
  `id` int(11) NOT NULL,
  `id_type` varchar(50) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `submitter_name` varchar(255) NOT NULL,
  `submitter_phone` varchar(15) NOT NULL,
  `nin` varchar(50) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `sub_county` varchar(100) DEFAULT NULL,
  `id_number` varchar(50) DEFAULT NULL,
  `place_found` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `student_number` varchar(50) DEFAULT NULL,
  `document_type` varchar(100) DEFAULT NULL,
  `institution_name` varchar(255) DEFAULT NULL,
  `graduation_year` year(4) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `national_ids`
--

CREATE TABLE `national_ids` (
  `national_id` int(11) NOT NULL,
  `sur_name` varchar(255) NOT NULL,
  `given_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `nin_number` int(100) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `front` varchar(255) NOT NULL,
  `back` varchar(255) NOT NULL,
  `user_action` varchar(100) NOT NULL,
  `date_found` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `national_ids`
--

INSERT INTO `national_ids` (`national_id`, `sur_name`, `given_name`, `dob`, `nin_number`, `gender`, `front`, `back`, `user_action`, `date_found`) VALUES
(1, 'Ssenyange', 'Dovin', '2025-01-16', 2147483647, 'male', 'b.jfif', '1672128496808.jpg', '', '2025-01-16'),
(2, 'BEN', 'NAM', '1996-04-04', 0, 'male', 'NID_FrontRand_66_EuPtA.png', 'NID_BackRand_55_EuPtA.png', 'Found', '2025-01-16 / 02:28:38 PM'),
(3, 'Ssebo', 'NAM', '2025-01-17', 2147483647, 'male', 'NID_FrontRand_66_8ttAw.png', 'NID_BackRand_55_8ttAw.png', 'Reported', '2025-01-17 / 02:55:38 PM');

-- --------------------------------------------------------

--
-- Table structure for table `student_ids`
--

CREATE TABLE `student_ids` (
  `student_id` int(11) NOT NULL,
  `sur_name` varchar(255) NOT NULL,
  `given_name` varchar(255) NOT NULL,
  `student_number` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `date_issued` date NOT NULL,
  `school` varchar(255) NOT NULL,
  `front` varchar(255) NOT NULL,
  `back` varchar(255) NOT NULL,
  `user_action` varchar(100) NOT NULL,
  `date_found` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_ids`
--

INSERT INTO `student_ids` (`student_id`, `sur_name`, `given_name`, `student_number`, `course`, `date_issued`, `school`, `front`, `back`, `user_action`, `date_found`) VALUES
(3, 'Ssenyange', 'Dovin', '7878765', 'it', '2025-01-16', 'Otinowaa', '_65861403_65861402.jpg', '4.jpg', 'Found', '2025-01-16 / 12:04:52 PM'),
(5, 'Ssenyanges', 'Dovins', '78787653', 'it', '2025-01-31', 'Otinowaa', 'b.jfif', 'Capture001.png', 'Found', '2025-01-16 / 01:18:02 PM'),
(6, 'Ssenyangesa', 'Dovinsa', '787876531', 'it', '2025-01-16', 'Otinowaa', 'NID_FrontRand_66_iIaar.png', 'NID_BackRand_55_iIaar.png', 'Found', '2025-01-16 / 01:27:54 PM'),
(8, 'Ssebo', 'Wange', '7878765rr', 'Plumbing', '2025-01-08', 'Otinowaa', 'NID_FrontRand_66_T1spj.png', 'NID_BackRand_55_T1spj.png', 'Found', '2025-01-16 / 07:00:21 PM');

-- --------------------------------------------------------

--
-- Table structure for table `superadmins`
--

CREATE TABLE `superadmins` (
  `admin_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superadmins`
--

INSERT INTO `superadmins` (`admin_id`, `name`, `password`) VALUES
(1, 'Dovin Ssenyange', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `id` int(11) NOT NULL,
  `document_type` varchar(255) DEFAULT NULL,
  `name_on_document` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driving_permits`
--
ALTER TABLE `driving_permits`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `found_documents`
--
ALTER TABLE `found_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `found_ids`
--
ALTER TABLE `found_ids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `national_ids`
--
ALTER TABLE `national_ids`
  ADD PRIMARY KEY (`national_id`);

--
-- Indexes for table `student_ids`
--
ALTER TABLE `student_ids`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_number` (`student_number`);

--
-- Indexes for table `superadmins`
--
ALTER TABLE `superadmins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `driving_permits`
--
ALTER TABLE `driving_permits`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `found_documents`
--
ALTER TABLE `found_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `found_ids`
--
ALTER TABLE `found_ids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `national_ids`
--
ALTER TABLE `national_ids`
  MODIFY `national_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_ids`
--
ALTER TABLE `student_ids`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `superadmins`
--
ALTER TABLE `superadmins`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
