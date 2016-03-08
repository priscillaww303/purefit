-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2016 at 10:01 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql`
--

-- --------------------------------------------------------

--
-- Table structure for table `cs_messages`
--

CREATE TABLE `cs_messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender` int(11) UNSIGNED NOT NULL,
  `recipient` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `message` varchar(255) NOT NULL,
  `when` int(11) NOT NULL DEFAULT '0',
  `room` int(5) UNSIGNED NOT NULL DEFAULT '0',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cs_messages`
--

INSERT INTO `cs_messages` (`id`, `sender`, `recipient`, `message`, `when`, `room`, `type`) VALUES
(1, 4, 0, 'hello there', 1457028249, 0, 0),
(2, 4, 3, 'yeah i got it', 1457028267, 0, 0),
(3, 4, 0, 'MEOW', 2147483647, 0, 0),
(4, 4, 0, 'MOO', 2147483647, 0, 0),
(5, 4, 0, 'ZZZ', 2147483647, 0, 0),
(6, 4, 0, 'MMM', 2147483647, 0, 0),
(7, 4, 0, 'QQQ', 2147483647, 0, 0),
(8, 5, 0, 'n', 1457030980, 0, 0),
(9, 6, 0, 'i am sarah', 1457034267, 0, 0),
(10, 6, 0, 'qwertyuioplkjhgfdsazxcvbnm', 1457035065, 0, 0),
(11, 7, 0, 'hey i am here', 1457037890, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cs_profiles`
--

CREATE TABLE `cs_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `salt` varchar(10) NOT NULL DEFAULT '',
  `status` enum('active','passive') NOT NULL DEFAULT 'active',
  `role` tinyint(4) UNSIGNED NOT NULL DEFAULT '1',
  `about` varchar(255) NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_nav` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `color` varchar(6) NOT NULL,
  `rate` float NOT NULL,
  `rate_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cs_profiles`
--

INSERT INTO `cs_profiles` (`id`, `name`, `first_name`, `last_name`, `email`, `password`, `salt`, `status`, `role`, `about`, `date_reg`, `date_nav`, `color`, `rate`, `rate_count`) VALUES
(1, 'priscillawang', 'priscilla', 'wang', 'priscillawang303@gmail.com', 'qwerty', 'testing', 'active', 1, 'meow', '2016-01-14 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(5, 'tonyguy', 'tony', 'guy', 'tony.guy@gmail.com', 'b1ebb0bacfd1fab764204a5003c37e3bf8673f68', 'FJMgU5XG', 'active', 1, '', '2016-03-03 11:49:23', '2016-03-03 12:14:39', '', 0, 0),
(2, 'takaakana', 'taka', 'akana', 'taka.akana@gmail.com', 'qwerty', 'testing', 'active', 4, 'woof', '2016-01-15 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(3, 'sukilee', 'suki', 'lee', 'suki.lee@gmail.com', 'qwerty', 'testing', 'active', 5, 'eeeeek', '2016-01-16 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(4, 'nancylynn', 'nancy', 'lynn', 'nancy.lynn@gmail.com', '70edc5df690e8caaf636ce49ee11264d2e7e5eda', 'a8QYbJ2e', 'active', 1, '', '2016-03-03 10:44:09', '2016-03-03 11:47:46', '', 0, 0),
(6, 'sarahy', 'sarah', 'y', 'sarahy@gmail.com', 'd3911c2615aa79ad17182f52b69d1f357e9dbae1', 'LebLhVkG', 'active', 1, '', '2016-03-03 12:43:26', '2016-03-03 13:43:35', '', 0, 0),
(7, 'oscarp', 'oscar', 'p', 'oscarp@gmail.com', '2e72e5e427defc5eee65a81b87e650dd3aebe5cf', 'RZ392b4x', 'active', 1, '', '2016-03-03 13:44:18', '2016-03-03 13:44:19', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cs_messages`
--
ALTER TABLE `cs_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cs_profiles`
--
ALTER TABLE `cs_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cs_messages`
--
ALTER TABLE `cs_messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `cs_profiles`
--
ALTER TABLE `cs_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
