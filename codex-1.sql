-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2017 at 03:59 PM
-- Server version: 10.0.29-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.13-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codex-1`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `ansid` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answered_by` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`ansid`, `question_id`, `answered_by`, `answer`, `time`) VALUES
(23, 15, 12, 'Python programming is a joyful programming. If your practice will more then more you will learn python programming. ', '2017-01-30 12:01:29'),
(24, 12, 18, 'There is three types errors in PHP .', '2017-01-29 05:01:18'),
(49, 26, 18, 'Programming is fun.', '2017-01-30 01:01:43'),
(50, 11, 18, 'You are wrong ! project work time is 8 days.', '2017-01-30 01:01:16'),
(51, 17, 12, 'You can use this query.\r\nSELECT * FROM table-1 JOIN table-2 ON table-1.key = table-2.key condition.', '2017-01-30 01:01:23'),
(52, 26, 16, 'Programming is one kind of gaming  !\r\nWhat can change your mind  !', '2017-01-30 03:01:29'),
(53, 12, 16, 'There are 3 type of error may occurred in PHP.', '2017-01-30 03:01:38'),
(54, 21, 16, 'ASP dot net is one kind of server site script language like PHP..!', '2017-01-30 03:01:07'),
(55, 11, 16, 'Actually there is a simple change of thinking of your mind, if you are motivated for this project, it must be your time !', '2017-01-30 03:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `question_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `user_id`, `question`, `title`, `question_time`) VALUES
(11, 17, 'How to implement this project within 4 days ??', 'PHP', '2017-01-26 05:01:18'),
(12, 17, 'How many  types of errors in PHP', 'PHP', '2017-01-26 06:01:33'),
(15, 16, 'How to learn python programming ?', 'Python programming', '2017-01-27 09:01:15'),
(17, 16, 'How to join two table using sql?', 'SQL table join', '2017-01-27 09:01:27'),
(18, 16, 'How to search data from two table in one time ?', 'Search data in database', '2017-01-27 09:01:46'),
(21, 18, 'What is the easy way for learning ASP dot net ?', 'ASP dot net', '2017-01-30 01:01:44'),
(26, 12, 'What is programming  ?', 'Programming', '2017-01-30 10:01:47'),
(27, 16, 'What is the easy way for learning PHP and what kind of site is suitable for suggest me any time  ?', 'Learning PHP', '2017-01-30 03:01:57'),
(28, 16, 'What is your thinking about programming carrier ?', 'Programming carrier', '2017-01-30 03:01:44'),
(29, 16, 'What is Java ?\r\nHow can it use in a program ?', 'Java', '2017-01-30 03:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `hobby` varchar(255) NOT NULL,
  `interest` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `cover_photo` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `hobby`, `interest`, `photo`, `cover_photo`, `phone`) VALUES
(4, 'monirul@ppi.edu.bd', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '0000-00-00', '', '', '', '', ''),
(8, 'omi@ppi.edu.bd', 'e10adc3949ba59abbe56e057f20f883e', 'omi', '', '', 'Male', '0000-00-00', '', '', '', '', ''),
(12, 'mehedi@ppi.edu.bd', 'e10adc3949ba59abbe56e057f20f883e', 'Mehedi', 'Hasan', 'Monirul', 'Male', '0000-00-01', 'codding', 'computer', 'uploadsImg/647e9def052fa4ad8d520513a8485024.jpg', 'uploadsImg/3b8b5147ebd8dce66cb74c11aef479fe.jpg', '01767248797'),
(14, 'shammy@ppi.edu.bd', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '0000-00-00', '', '', '', '', ''),
(15, 'admin@ppi.edu.bd', 'e10adc3949ba59abbe56e057f20f883e', 'omi', 'Hasan', 'emon', 'Male', '1990-05-12', 'Codding ', 'in computer', 'uploadsImg/b06663ac5f03cfaa1874d33ce1dff8c0.jpg', 'uploadsImg/bbee8402e7b9ddeb7baec3f0d620c227.jpg', '01767248789'),
(16, 'shihabnasifun89@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Md. Nasifun', 'Newaz', 'Shihab Bhuiyan', 'Male', '1990-08-20', 'Programming', 'Travelling', 'uploadsImg/e24149fd245bf4c9f5e5aa5f09965842.jpg', 'uploadsImg/0c9d8569fee2cee3e37aa06e89cf37a5.jpg', '01812089603'),
(17, 'sazzad7066@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Sazzad', 'Hossain', 'Saju', 'Male', '1993-05-05', 'Traveling', 'Internet Browsing', 'uploadsImg/abd267c8d7890b52b1ff4a0b430812a3.jpg', 'uploadsImg/d53da420b01336058a8d7b996ed0eee9.jpg', '01675747280'),
(18, 'bdmehedi92@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Monirul', 'Islam', 'Emon', 'Male', '0000-00-00', 'Traveling', 'Internet Browsing', 'uploadsImg/ef8b4394a7d9284b4de29c5376ce53cc.jpg', 'uploadsImg/ebcba56f84374acec6400d746658cfe1.jpg', '01686023434');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`ansid`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `answered_by` (`answered_by`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `ansid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`answered_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
