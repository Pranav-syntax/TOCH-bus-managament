-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2026 at 02:17 PM
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
-- Database: `hostel_db`
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
(1, 'admin', 'password123'),
(2, 'your_name', 'your_secure_password'),
(3, 'niveth', 'niveth45');

-- --------------------------------------------------------

--
-- Table structure for table `allotment`
--

CREATE TABLE `allotment` (
  `allot_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `allot_date` date DEFAULT NULL,
  `amount` int(11) DEFAULT 15000,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allotment`
--

INSERT INTO `allotment` (`allot_id`, `student_id`, `room_id`, `allot_date`, `amount`, `status`) VALUES
(1, 1, 201, '2026-01-01', 15000, 'Paid'),
(2, 2, 201, '2026-01-02', 15000, 'Pending'),
(3, 3, 201, '2026-01-03', 15000, 'Paid'),
(4, 4, 202, '2026-01-04', 15000, 'Pending'),
(5, 5, 202, '2026-01-05', 15000, 'Pending'),
(6, 6, 202, '2026-01-06', 15000, 'Pending'),
(7, 7, 203, '2026-01-07', 15000, 'Pending'),
(8, 8, 203, '2026-01-08', 15000, 'Pending'),
(9, 9, 203, '2026-01-09', 15000, 'Pending'),
(10, 10, 204, '2026-01-10', 15000, 'Pending'),
(11, 11, 204, '2026-01-11', 15000, 'Pending'),
(12, 12, 204, '2026-01-12', 15000, 'Pending'),
(13, 13, 205, '2026-01-13', 15000, 'Pending'),
(14, 14, 205, '2026-01-14', 15000, 'Pending'),
(15, 15, 205, '2026-01-15', 15000, 'Pending'),
(16, 16, 206, '2026-01-16', 15000, 'Pending'),
(17, 17, 206, '2026-01-17', 15000, 'Pending'),
(18, 18, 206, '2026-01-18', 15000, 'Pending'),
(19, 19, 207, '2026-01-19', 15000, 'Pending'),
(20, 20, 207, '2026-01-20', 15000, 'Pending'),
(21, 21, 207, '2026-01-21', 15000, 'Pending'),
(22, 22, 208, '2026-01-22', 15000, 'Paid'),
(23, 23, 208, '2026-01-23', 15000, 'Pending'),
(24, 24, 208, '2026-01-24', 15000, 'Pending'),
(25, 25, 209, '2026-01-25', 15000, 'Pending'),
(26, 26, 209, '2026-01-26', 15000, 'Pending'),
(27, 27, 209, '2026-01-27', 15000, 'Pending'),
(28, 28, 210, '2026-01-28', 15000, 'Paid'),
(29, 29, 210, '2026-01-29', 15000, 'Pending'),
(30, 30, 210, '2026-01-30', 15000, 'Paid'),
(31, 31, 211, '2026-02-01', 15000, 'Pending'),
(32, 32, 211, '2026-02-02', 15000, 'Pending'),
(33, 33, 211, '2026-02-03', 15000, 'Pending'),
(34, 34, 212, '2026-02-04', 15000, 'Pending'),
(35, 35, 212, '2026-02-05', 15000, 'Pending'),
(36, 36, 212, '2026-02-06', 15000, 'Pending'),
(37, 37, 213, '2026-02-07', 15000, 'Pending'),
(38, 38, 213, '2026-02-08', 15000, 'Pending'),
(39, 39, 213, '2026-02-09', 15000, 'Pending'),
(40, 40, 214, '2026-02-10', 15000, 'Pending'),
(41, 41, 214, '2026-02-11', 15000, 'Pending'),
(42, 42, 214, '2026-02-12', 15000, 'Pending'),
(43, 43, 215, '2026-02-13', 15000, 'Pending'),
(44, 44, 215, '2026-02-14', 15000, 'Pending'),
(45, 45, 215, '2026-02-15', 15000, 'Pending'),
(46, 46, 216, '2026-02-16', 15000, 'Pending'),
(47, 47, 216, '2026-02-17', 15000, 'Pending'),
(48, 48, 216, '2026-02-18', 15000, 'Pending'),
(49, 49, 217, '2026-02-19', 15000, 'Pending'),
(50, 50, 217, '2026-02-20', 15000, 'Pending'),
(51, 51, 201, '2026-02-13', 15000, 'Paid');

--
-- Triggers `allotment`
--
DELIMITER $$
CREATE TRIGGER `check_room_capacity` BEFORE INSERT ON `allotment` FOR EACH ROW BEGIN
    DECLARE total INT;
    DECLARE limit_cap INT;

    -- Count students in that room
    SELECT COUNT(*) INTO total
    FROM Allotment
    WHERE room_id = NEW.room_id;

    -- Get room capacity
    SELECT capacity INTO limit_cap
    FROM Room
    WHERE room_id = NEW.room_id;

    -- Compare
    IF total >= limit_cap THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Room Full! Cannot Allot.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Open',
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `student_id`, `category`, `message`, `status`, `submitted_at`) VALUES
(1, 1, 'Food', 'bad food', 'Open', '2026-02-20 15:13:12'),
(2, 1, 'Other', 'ragging', 'Open', '2026-02-20 15:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `fee_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL CHECK (`amount` > 0),
  `paid_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`fee_id`, `student_id`, `amount`, `paid_date`, `status`) VALUES
(1, 1, 15000, '2026-01-05', 'Paid'),
(2, 2, 15000, '2026-01-06', 'Paid'),
(3, 3, 15000, '2026-01-07', 'Paid'),
(4, 4, 15000, '2026-01-08', 'Paid'),
(5, 5, 15000, '2026-01-09', 'Paid'),
(6, 6, 15000, '2026-01-10', 'Paid'),
(7, 7, 15000, '2026-01-11', 'Paid'),
(8, 8, 15000, '2026-01-12', 'Paid'),
(9, 9, 15000, '2026-01-13', 'Paid'),
(10, 10, 15000, '2026-01-14', 'Paid'),
(11, 11, 15000, '2026-01-15', 'Paid'),
(12, 12, 15000, '2026-01-16', 'Paid'),
(13, 13, 15000, '2026-01-17', 'Paid'),
(14, 14, 15000, '2026-01-18', 'Paid'),
(15, 15, 15000, '2026-01-19', 'Paid'),
(16, 16, 15000, '2026-01-20', 'Paid'),
(17, 17, 15000, '2026-01-21', 'Paid'),
(18, 18, 15000, '2026-01-22', 'Paid'),
(19, 19, 15000, '2026-01-23', 'Paid'),
(20, 20, 15000, '2026-01-24', 'Paid'),
(21, 21, 15000, '2026-01-25', 'Paid'),
(22, 22, 15000, '2026-01-26', 'Paid'),
(23, 23, 15000, '2026-01-27', 'Paid'),
(24, 24, 15000, '2026-01-28', 'Paid'),
(25, 25, 15000, '2026-01-29', 'Paid'),
(26, 26, 15000, '2026-01-30', 'Paid'),
(27, 27, 15000, '2026-01-31', 'Paid'),
(28, 28, 15000, '2026-02-01', 'Paid'),
(29, 29, 15000, '2026-02-02', 'Paid'),
(30, 30, 15000, '2026-02-03', 'Paid'),
(31, 31, 15000, '2026-02-04', 'Paid'),
(32, 32, 15000, '2026-02-05', 'Paid'),
(33, 33, 15000, '2026-02-06', 'Paid'),
(34, 34, 15000, '2026-02-07', 'Paid'),
(35, 35, 15000, '2026-02-08', 'Paid'),
(36, 36, 15000, '2026-02-09', 'Paid'),
(37, 37, 15000, '2026-02-10', 'Paid'),
(38, 38, 15000, '2026-02-11', 'Paid'),
(39, 39, 15000, '2026-02-12', 'Paid'),
(40, 40, 15000, '2026-02-13', 'Paid'),
(41, 41, 15000, '2026-02-14', 'Pending'),
(42, 42, 15000, '2026-02-15', 'Pending'),
(43, 43, 15000, '2026-02-16', 'Pending'),
(44, 44, 15000, '2026-02-17', 'Pending'),
(45, 45, 15000, '2026-02-18', 'Pending'),
(46, 46, 15000, '2026-02-19', 'Pending'),
(47, 47, 15000, '2026-02-20', 'Pending'),
(48, 48, 15000, '2026-02-21', 'Pending'),
(49, 49, 15000, '2026-02-22', 'Pending'),
(50, 50, 15000, '2026-02-23', 'Pending');

-- --------------------------------------------------------

--
-- Stand-in structure for view `hostelreport`
-- (See below for the actual view)
--
CREATE TABLE `hostelreport` (
`name` varchar(50)
,`branch` varchar(30)
,`room_no` varchar(10)
,`floor` int(11)
,`amount` int(11)
,`status` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_no` varchar(10) DEFAULT NULL,
  `floor` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL CHECK (`capacity` > 0),
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_no`, `floor`, `capacity`, `status`) VALUES
(201, 'A-201', 1, 5, 'Full'),
(202, 'A-202', 1, 5, 'Available'),
(203, 'A-203', 1, 5, 'Available'),
(204, 'A-204', 1, 5, 'Available'),
(205, 'A-205', 1, 5, 'Available'),
(206, 'A-206', 1, 5, 'Available'),
(207, 'A-207', 1, 5, 'Available'),
(208, 'A-208', 1, 5, 'Available'),
(209, 'A-209', 1, 5, 'Available'),
(210, 'A-210', 1, 5, 'Available'),
(211, 'B-211', 2, 5, 'Available'),
(212, 'B-212', 2, 5, 'Available'),
(213, 'B-213', 2, 5, 'Available'),
(214, 'B-214', 2, 5, 'Available'),
(215, 'B-215', 2, 5, 'Available'),
(216, 'B-216', 2, 5, 'Available'),
(217, 'B-217', 2, 5, 'Available'),
(218, 'B-218', 2, 5, 'Available'),
(219, 'B-219', 2, 5, 'Available'),
(220, 'B-220', 2, 5, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `branch` varchar(30) DEFAULT NULL,
  `year` int(11) DEFAULT NULL CHECK (`year` between 1 and 4),
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT 'student123'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `branch`, `year`, `phone`, `email`, `password`) VALUES
(1, 'Albin K', 'CSE', 1, '9000000001', 's1@gmail.com', 'albin456'),
(2, 'Amal Xavier', 'CSE', 1, '9000000002', 's2@gmail.com', '91876a'),
(3, 'Amen Saj', 'CSE', 1, '9000000003', 's3@gmail.com', 'e31744'),
(4, 'Anson George', 'CSE', 1, '9000000004', 's4@gmail.com', 'fdc7a8'),
(5, 'Alfin Aby', 'ECE', 2, '9000000005', 's5@gmail.com', '9f3605'),
(6, 'Althaf B', 'ECE', 2, '9000000006', 's6@gmail.com', '4b96b0'),
(7, 'Arjun S Nair', 'ECE', 2, '9000000007', 's7@gmail.com', '2b2dd5'),
(8, 'Anson A John', 'ECE', 2, '9000000008', 's8@gmail.com', '331130'),
(9, 'Adithyan P K', 'ME', 3, '9000000009', 's9@gmail.com', '784426'),
(10, 'Akshy Sudhakaran', 'ME', 3, '9000000010', 's10@gmail.com', '28ef76'),
(11, 'Ahsandondathage', 'ME', 3, '9000000011', 's11@gmail.com', '433a5a'),
(12, 'Adithyan V', 'ME', 3, '9000000012', 's12@gmail.com', 'e2cea3'),
(13, 'Ashil Nazar', 'IT', 4, '9000000013', 's13@gmail.com', 'a7a9f2'),
(14, 'Arjun V', 'IT', 4, '9000000014', 's14@gmail.com', 'ff0948'),
(15, 'Albert Paul', 'IT', 4, '9000000015', 's15@gmail.com', '6b62e6'),
(16, 'Arjun S M', 'IT', 4, '9000000016', 's16@gmail.com', 'b30207'),
(17, 'Dev Lal', 'CSE', 1, '9000000017', 's17@gmail.com', '9953af'),
(18, 'Elban Shibu', 'CSE', 1, '9000000018', 's18@gmail.com', '1779b5'),
(19, 'Gautham Krishna', 'CSE', 1, '9000000019', 's19@gmail.com', '150432'),
(20, 'Haseeb D F', 'CSE', 1, '9000000020', 's20@gmail.com', '46a85b'),
(21, 'Iyad Hussain KT', 'ECE', 2, '9000000021', 's21@gmail.com', '7152e4'),
(22, 'Jipin Dev', 'ECE', 2, '9000000022', 's22@gmail.com', '678906'),
(23, 'Karthik Krishnan', 'ECE', 2, '9000000023', 's23@gmail.com', '862071'),
(24, 'Mohamad Ismail', 'ECE', 2, '9000000024', 's24@gmail.com', '8b2bc4'),
(25, 'Mohamad Malik', 'ME', 3, '9000000025', 's25@gmail.com', 'fc4f86'),
(26, 'Mohamad Rizwan Rahys', 'ME', 3, '9000000026', 's26@gmail.com', 'cf78a7'),
(27, 'Midhun A', 'ME', 3, '9000000027', 's27@gmail.com', 'cf5198'),
(28, 'Mishub P K', 'ME', 3, '9000000028', 's28@gmail.com', '58346a'),
(29, 'Nandha Kishor', 'IT', 4, '9000000029', 's29@gmail.com', '53522d'),
(30, 'Niveth K K', 'IT', 4, '9000000030', 's30@gmail.com', 'c24d7c'),
(31, 'Pavan Krishna P K', 'CSE', 1, '9000000031', 's31@gmail.com', '010bb0'),
(32, 'Pranav Santhosh', 'CSE', 1, '9000000032', 's32@gmail.com', '076506'),
(33, 'Richard Roy', 'ECE', 2, '9000000033', 's33@gmail.com', '7fc37b'),
(34, 'Shervin Fithel', 'ECE', 2, '9000000034', 's34@gmail.com', '3ce7db'),
(35, 'Sreehary J', 'ME', 3, '9000000035', 's35@gmail.com', '833c8b'),
(36, 'Sree Hary R', 'ME', 3, '9000000036', 's36@gmail.com', '62db0b'),
(37, 'Tahsin Sajid Marakkar', 'IT', 4, '9000000037', 's37@gmail.com', 'daf77c'),
(38, 'Yadhu Nandh P V', 'CSE', 1, '9000000038', 's38@gmail.com', 'f418a3'),
(39, 'P R Kasinath', 'ECE', 2, '9000000039', 's39@gmail.com', 'ccaf79'),
(40, 'Maneesh', 'ME', 3, '9000000040', 's40@gmail.com', 'bdc5a2'),
(41, 'Shigin Mon P C', 'IT', 4, '9000000041', 's41@gmail.com', '78caaa'),
(42, 'Student42', 'CSE', 1, '9000000042', 's42@gmail.com', 'a90c43'),
(43, 'Student43', 'ECE', 2, '9000000043', 's43@gmail.com', '1f65d8'),
(44, 'Student44', 'ME', 3, '9000000044', 's44@gmail.com', '8d707b'),
(45, 'Student45', 'IT', 4, '9000000045', 's45@gmail.com', '8fb1e5'),
(46, 'Student46', 'CSE', 1, '9000000046', 's46@gmail.com', '587468'),
(47, 'Student47', 'ECE', 2, '9000000047', 's47@gmail.com', '3bd8be'),
(48, 'Student48', 'ME', 3, '9000000048', 's48@gmail.com', 'b09077'),
(49, 'Student49', 'IT', 4, '9000000049', 's49@gmail.com', 'f2b1d5'),
(50, 'Student50', 'CSE', 1, '9000000050', 's50@gmail.com', 'bfbc9d'),
(51, 'jhon', 'CSE', 3, '7654356541', 'jhon@gmail.com', 'jhon123');

-- --------------------------------------------------------

--
-- Structure for view `hostelreport`
--
DROP TABLE IF EXISTS `hostelreport`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hostelreport`  AS SELECT `s`.`name` AS `name`, `s`.`branch` AS `branch`, `r`.`room_no` AS `room_no`, `r`.`floor` AS `floor`, `f`.`amount` AS `amount`, `f`.`status` AS `status` FROM (((`student` `s` join `allotment` `a` on(`s`.`student_id` = `a`.`student_id`)) join `room` `r` on(`a`.`room_id` = `r`.`room_id`)) left join `fees` `f` on(`s`.`student_id` = `f`.`student_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allotment`
--
ALTER TABLE `allotment`
  ADD PRIMARY KEY (`allot_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`fee_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allotment`
--
ALTER TABLE `allotment`
  ADD CONSTRAINT `allotment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `allotment_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
