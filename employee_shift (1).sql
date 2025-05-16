-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2025 at 10:43 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `employee_shift`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `phone`, `password`, `status`) VALUES
(1, 'saleforce', 'saleforce@gmail.com', '7558083475', '123', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `cid`, `department_name`) VALUES
(1, 1, 'Sales'),
(2, 1, 'Finance'),
(3, 1, 'Operations'),
(4, 1, 'HR'),
(5, 1, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `department_head`
--

CREATE TABLE IF NOT EXISTS `department_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `department_head`
--

INSERT INTO `department_head` (`id`, `name`, `email`, `phone`, `password`, `department_id`) VALUES
(1, 'anandhu', 'anandhu@gmail.com', '987654322', '123', 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `phone`, `password`, `department`, `status`) VALUES
(1, 'mike', 'roshanjose023@gmail.com', '9876543456', '123', '3', 'accepted'),
(2, 'Laura', 'roshanjose23@gmail.com', '7558083473', '123', '3', 'accepted'),
(3, 'John Doe', 'roshanjose023@gmail.com', '9876543210', 'pass123', '3', 'accepted'),
(4, 'Jane Smith', 'eliasshaju6084@gmail.com', '9876543211', 'pass456', '3', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `employee_shifts`
--

CREATE TABLE IF NOT EXISTS `employee_shifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shift_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `shift_date` date NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `employee_shifts`
--

INSERT INTO `employee_shifts` (`id`, `shift_id`, `employee_id`, `shift_date`, `assigned_by`, `status`) VALUES
(1, 1, 1, '2025-03-24', 1, 'reassigned'),
(2, 1, 2, '2025-03-24', 1, 'assigned'),
(3, 2, 3, '2025-03-24', 1, 'assigned'),
(4, 3, 4, '2025-03-24', 1, 'assigned'),
(5, 1, 1, '2025-03-25', 1, 'reassigned'),
(6, 1, 2, '2025-03-25', 1, 'assigned'),
(7, 2, 3, '2025-03-25', 1, 'assigned'),
(8, 3, 4, '2025-03-25', 1, 'assigned'),
(9, 1, 1, '2025-03-26', 1, 'assigned'),
(10, 1, 2, '2025-03-26', 1, 'assigned'),
(11, 2, 3, '2025-03-26', 1, 'assigned'),
(12, 3, 4, '2025-03-26', 1, 'assigned'),
(13, 1, 1, '2025-03-27', 1, 'assigned'),
(14, 1, 2, '2025-03-27', 1, 'assigned'),
(15, 2, 3, '2025-03-27', 1, 'assigned'),
(16, 3, 4, '2025-03-27', 1, 'assigned'),
(17, 1, 1, '2025-03-28', 1, 'assigned'),
(18, 1, 2, '2025-03-28', 1, 'assigned'),
(19, 2, 3, '2025-03-28', 1, 'assigned'),
(20, 3, 4, '2025-03-28', 1, 'assigned'),
(21, 1, 1, '2025-03-29', 1, 'assigned'),
(22, 1, 2, '2025-03-29', 1, 'assigned'),
(23, 2, 3, '2025-03-29', 1, 'assigned'),
(24, 3, 4, '2025-03-29', 1, 'assigned'),
(25, 1, 1, '2025-03-30', 1, 'assigned'),
(26, 1, 2, '2025-03-30', 1, 'assigned'),
(27, 2, 3, '2025-03-30', 1, 'assigned'),
(28, 3, 4, '2025-03-30', 1, 'assigned');

-- --------------------------------------------------------

--
-- Table structure for table `leave_application`
--

CREATE TABLE IF NOT EXISTS `leave_application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `leave_application`
--

INSERT INTO `leave_application` (`id`, `employee_id`, `leave_type`, `start_date`, `end_date`, `status`) VALUES
(2, 1, 'Casual Leave', '2025-03-24', '2025-03-25', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `employee_id`, `status`, `message`) VALUES
(1, 0, 'active', 'Holiday on coming Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE IF NOT EXISTS `shift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `shift_name` varchar(50) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `max_employees` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `department_id`, `shift_name`, `start_time`, `end_time`, `max_employees`) VALUES
(1, 3, 'Morning', '06:00:00', '14:00:00', 2),
(2, 3, 'Noon', '14:00:00', '22:00:00', 1),
(3, 3, 'Night', '22:00:00', '06:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shift_reassign`
--

CREATE TABLE IF NOT EXISTS `shift_reassign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shift_id` int(11) NOT NULL,
  `original_employee_id` int(11) NOT NULL,
  `reassigned_employee_id` int(11) NOT NULL,
  `shift_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `st` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shift_reassign`
--

INSERT INTO `shift_reassign` (`id`, `shift_id`, `original_employee_id`, `reassigned_employee_id`, `shift_date`, `status`, `st`) VALUES
(1, 1, 1, 4, '2025-03-24', 'assigned', ''),
(2, 1, 1, 4, '2025-03-25', 'assigned', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
