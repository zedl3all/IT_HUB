-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 05:07 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `anm_id` int(11) NOT NULL,
  `anm_name` varchar(50) NOT NULL,
  `anm_description` varchar(255) NOT NULL,
  `anm_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `u_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`anm_id`, `anm_name`, `anm_description`, `anm_create_date`, `u_id`, `c_id`) VALUES
(1, 'test', 'test', '0000-00-00 00:00:00', 1, 1),
(2, 'Test!!!!', '123456', '2024-10-18 18:00:47', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `announcement_tag`
--

CREATE TABLE `announcement_tag` (
  `at_id` int(11) NOT NULL,
  `anm_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `announcement_tag`
--

INSERT INTO `announcement_tag` (`at_id`, `anm_id`, `t_id`) VALUES
(1, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `ans_id` int(11) NOT NULL,
  `ans_anonymous` tinyint(1) NOT NULL,
  `ans_reply` varchar(255) NOT NULL,
  `ans_create_date` date NOT NULL,
  `q_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `ch_id` int(11) NOT NULL,
  `ch_name` varchar(255) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE `community` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `c_description` varchar(255) NOT NULL,
  `c_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `community`
--

INSERT INTO `community` (`c_id`, `c_name`, `c_description`, `c_create_date`, `u_id`) VALUES
(1, 'Dummy_Commu1', 'Dummy_Commu1_First_Dummy', '2024-10-14 23:13:05', 2),
(2, 'Dummy2', 'TestTest', '2024-10-16 00:58:46', 2),
(12, 'Test1', '', '2024-10-17 18:18:03', 2),
(13, 'Test2', '1234', '2024-10-17 18:20:15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `community_enroll`
--

CREATE TABLE `community_enroll` (
  `c_id` int(11) NOT NULL,
  `ce_enrollkey` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `community_enroll`
--

INSERT INTO `community_enroll` (`c_id`, `ce_enrollkey`) VALUES
(1, ''),
(12, '123'),
(13, '123');

-- --------------------------------------------------------

--
-- Table structure for table `community_tag`
--

CREATE TABLE `community_tag` (
  `ct_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `community_tag`
--

INSERT INTO `community_tag` (`ct_id`, `c_id`, `t_id`) VALUES
(1, 12, 2),
(2, 12, 3),
(3, 12, 4),
(4, 13, 2),
(5, 13, 3),
(6, 13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `community_user`
--

CREATE TABLE `community_user` (
  `cu_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `u_role` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `community_user`
--

INSERT INTO `community_user` (`cu_id`, `c_id`, `u_id`, `u_role`) VALUES
(31, 1, 1, 'Member'),
(33, 2, 1, 'Member'),
(35, 1, 3, 'Member'),
(37, 2, 3, 'Member'),
(44, 12, 2, 'Owner'),
(46, 13, 2, 'Member'),
(47, 2, 2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `n_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `anm_id` int(11) NOT NULL,
  `n_is_seen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`n_id`, `c_id`, `u_id`, `anm_id`, `n_is_seen`) VALUES
(1, 2, 1, 2, 1),
(2, 2, 2, 2, 0),
(3, 2, 3, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `p_id` int(11) NOT NULL,
  `p_anonymous` tinyint(1) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_description` varchar(255) NOT NULL,
  `p_create_date` datetime NOT NULL,
  `u_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poll_tag`
--

CREATE TABLE `poll_tag` (
  `pt_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_id` int(11) NOT NULL,
  `q_anonymous` tinyint(1) NOT NULL,
  `q_header` varchar(255) NOT NULL,
  `q_detail` varchar(255) DEFAULT NULL,
  `q_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `u_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_tag`
--

CREATE TABLE `question_tag` (
  `qt_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(15) NOT NULL,
  `t_description` varchar(255) NOT NULL,
  `t_create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`t_id`, `t_name`, `t_description`, `t_create_date`) VALUES
(1, 'test', 'test', '2024-10-17'),
(2, 'Tag1', 'Tag1', '2024-10-17'),
(3, 'Tag2', 'Tag2', '2024-10-17'),
(4, 'Tag3', 'Tag3', '2024-10-17'),
(10, '', '', '2024-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(50) NOT NULL,
  `u_lastname` varchar(50) NOT NULL,
  `u_username` varchar(25) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_role` varchar(2) NOT NULL,
  `u_create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_lastname`, `u_username`, `u_email`, `u_role`, `u_create_date`) VALUES
(1, 'Tanapat', 'Sanguanwong', 'zedl3all', '66070082@kmitl.ac.th', 'S', '2024-10-06 16:08:44'),
(2, 'Pakpao', 'Amporn', 'PA666', 'pakpao@gmail.com', 'T', '2024-10-06 16:51:39'),
(3, 'Teetat', 'Thongkumtae', 'Tee', '66070092@kmitl.ac.th', 'S', '2024-10-16 00:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_password`
--

CREATE TABLE `user_password` (
  `u_id` int(11) NOT NULL,
  `up_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_password`
--

INSERT INTO `user_password` (`u_id`, `up_password`) VALUES
(1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `vote_poll`
--

CREATE TABLE `vote_poll` (
  `v_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `ch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`anm_id`),
  ADD UNIQUE KEY `anm_id` (`anm_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `announcement_fk5` (`c_id`);

--
-- Indexes for table `announcement_tag`
--
ALTER TABLE `announcement_tag`
  ADD PRIMARY KEY (`at_id`),
  ADD UNIQUE KEY `at_id` (`at_id`),
  ADD KEY `announcement_tag_fk1` (`anm_id`),
  ADD KEY `announcement_tag_fk2` (`t_id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`ans_id`),
  ADD UNIQUE KEY `ans_id` (`ans_id`),
  ADD KEY `answer_fk5` (`u_id`),
  ADD KEY `answer_fk4` (`q_id`);

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`ch_id`),
  ADD UNIQUE KEY `ch_id` (`ch_id`),
  ADD KEY `choices_fk2` (`p_id`);

--
-- Indexes for table `community`
--
ALTER TABLE `community`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_id` (`c_id`),
  ADD UNIQUE KEY `c_name` (`c_name`),
  ADD KEY `community_fk4` (`u_id`);

--
-- Indexes for table `community_enroll`
--
ALTER TABLE `community_enroll`
  ADD KEY `community_enroll_fk0` (`c_id`);

--
-- Indexes for table `community_tag`
--
ALTER TABLE `community_tag`
  ADD PRIMARY KEY (`ct_id`),
  ADD UNIQUE KEY `ct_id` (`ct_id`),
  ADD KEY `community_tag_fk1` (`c_id`),
  ADD KEY `community_tag_fk2` (`t_id`);

--
-- Indexes for table `community_user`
--
ALTER TABLE `community_user`
  ADD PRIMARY KEY (`cu_id`),
  ADD UNIQUE KEY `cu_id` (`cu_id`),
  ADD KEY `community_user_fk2` (`u_id`),
  ADD KEY `community_user_ibfk_1` (`c_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`n_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `notification_ibfk_1` (`c_id`),
  ADD KEY `notification_ibfk_3` (`anm_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_id` (`p_id`),
  ADD KEY `polls_fk5` (`u_id`),
  ADD KEY `polls_fk6` (`c_id`);

--
-- Indexes for table `poll_tag`
--
ALTER TABLE `poll_tag`
  ADD PRIMARY KEY (`pt_id`),
  ADD UNIQUE KEY `pt_id` (`pt_id`),
  ADD KEY `poll_tag_fk1` (`p_id`),
  ADD KEY `poll_tag_fk2` (`t_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`),
  ADD UNIQUE KEY `q_id` (`q_id`),
  ADD KEY `questions_fk4` (`u_id`),
  ADD KEY `questions_fk5` (`c_id`);

--
-- Indexes for table `question_tag`
--
ALTER TABLE `question_tag`
  ADD PRIMARY KEY (`qt_id`),
  ADD UNIQUE KEY `qt_id` (`qt_id`),
  ADD KEY `question_tag_fk1` (`q_id`),
  ADD KEY `question_tag_fk2` (`t_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`t_id`),
  ADD UNIQUE KEY `t_id` (`t_id`),
  ADD UNIQUE KEY `t_name` (`t_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_id` (`u_id`),
  ADD UNIQUE KEY `u_username` (`u_username`),
  ADD UNIQUE KEY `u_email` (`u_email`);

--
-- Indexes for table `user_password`
--
ALTER TABLE `user_password`
  ADD KEY `user_password_fk0` (`u_id`);

--
-- Indexes for table `vote_poll`
--
ALTER TABLE `vote_poll`
  ADD PRIMARY KEY (`v_id`),
  ADD UNIQUE KEY `v_id` (`v_id`),
  ADD KEY `vote_poll_fk1` (`u_id`),
  ADD KEY `vote_poll_fk3` (`ch_id`),
  ADD KEY `vote_poll_fk2` (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `anm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcement_tag`
--
ALTER TABLE `announcement_tag`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `ans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `community`
--
ALTER TABLE `community`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `community_tag`
--
ALTER TABLE `community_tag`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `community_user`
--
ALTER TABLE `community_user`
  MODIFY `cu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poll_tag`
--
ALTER TABLE `poll_tag`
  MODIFY `pt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_tag`
--
ALTER TABLE `question_tag`
  MODIFY `qt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vote_poll`
--
ALTER TABLE `vote_poll`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_fk5` FOREIGN KEY (`c_id`) REFERENCES `community` (`c_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `announcement_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `announcement_tag`
--
ALTER TABLE `announcement_tag`
  ADD CONSTRAINT `announcement_tag_fk1` FOREIGN KEY (`anm_id`) REFERENCES `announcement` (`anm_id`),
  ADD CONSTRAINT `announcement_tag_fk2` FOREIGN KEY (`t_id`) REFERENCES `tag` (`t_id`);

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_fk4` FOREIGN KEY (`q_id`) REFERENCES `questions` (`q_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answer_fk5` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_fk2` FOREIGN KEY (`p_id`) REFERENCES `polls` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `community`
--
ALTER TABLE `community`
  ADD CONSTRAINT `community_fk4` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE;

--
-- Constraints for table `community_enroll`
--
ALTER TABLE `community_enroll`
  ADD CONSTRAINT `community_enroll_fk0` FOREIGN KEY (`c_id`) REFERENCES `community` (`c_id`) ON DELETE CASCADE;

--
-- Constraints for table `community_tag`
--
ALTER TABLE `community_tag`
  ADD CONSTRAINT `community_tag_fk1` FOREIGN KEY (`c_id`) REFERENCES `community` (`c_id`),
  ADD CONSTRAINT `community_tag_fk2` FOREIGN KEY (`t_id`) REFERENCES `tag` (`t_id`);

--
-- Constraints for table `community_user`
--
ALTER TABLE `community_user`
  ADD CONSTRAINT `community_user_fk2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `community_user_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `community` (`c_id`) ON DELETE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `community` (`c_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`anm_id`) REFERENCES `announcement` (`anm_id`) ON DELETE CASCADE;

--
-- Constraints for table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `polls_fk5` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `polls_fk6` FOREIGN KEY (`c_id`) REFERENCES `community` (`c_id`) ON DELETE CASCADE;

--
-- Constraints for table `poll_tag`
--
ALTER TABLE `poll_tag`
  ADD CONSTRAINT `poll_tag_fk1` FOREIGN KEY (`p_id`) REFERENCES `polls` (`p_id`),
  ADD CONSTRAINT `poll_tag_fk2` FOREIGN KEY (`t_id`) REFERENCES `tag` (`t_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_fk4` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `questions_fk5` FOREIGN KEY (`c_id`) REFERENCES `community` (`c_id`) ON DELETE CASCADE;

--
-- Constraints for table `question_tag`
--
ALTER TABLE `question_tag`
  ADD CONSTRAINT `question_tag_fk1` FOREIGN KEY (`q_id`) REFERENCES `questions` (`q_id`),
  ADD CONSTRAINT `question_tag_fk2` FOREIGN KEY (`t_id`) REFERENCES `tag` (`t_id`);

--
-- Constraints for table `user_password`
--
ALTER TABLE `user_password`
  ADD CONSTRAINT `user_password_fk0` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE;

--
-- Constraints for table `vote_poll`
--
ALTER TABLE `vote_poll`
  ADD CONSTRAINT `vote_poll_fk1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `vote_poll_fk2` FOREIGN KEY (`p_id`) REFERENCES `polls` (`p_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vote_poll_fk3` FOREIGN KEY (`ch_id`) REFERENCES `choices` (`ch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
