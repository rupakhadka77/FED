-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 23, 2022 at 04:22 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neps_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `blog_id` int NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(100) NOT NULL,
  `blog_img` varchar(1000) NOT NULL DEFAULT 'default.png',
  `blog_by` int NOT NULL,
  `blog_date` date NOT NULL,
  `blog_votes` int NOT NULL DEFAULT '0',
  `blog_content` longtext NOT NULL,
  PRIMARY KEY (`blog_id`),
  KEY `blog_by` (`blog_by`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_title`, `blog_img`, `blog_by`, `blog_date`, `blog_votes`, `blog_content`) VALUES
(21, 'Data Validation', '614193e72af559.73251518.jpg', 43, '2021-09-15', 2, 'Overview\r\nData validation is an essential part of any data handling task whether you’re in the field collecting information, analyzing data, or preparing to present data to stakeholders. If data isn’t accurate from the start, your results definitely won’t be accurate either. That’s why it’s necessary to verify and validate data before it is used.\r\n\r\nWhile data validation is a critical step in any data workflow, it’s often skipped over. It may seem as if data validation is a step that slows down your pace of work, however, it is essential because it will help you create the best results possible. These days data validation can be a much quicker process than you might’ve thought. With data integration platforms that can incorporate and automate validation processes, validation can be treated as an essential ingredient to your workflow rather than an additional step.\r\n\r\nWhy Validate?\r\nValidating the accuracy, clarity, and details of data is necessary to mitigate any project defects. Without validating data, you run the risk of basing decisions on data with imperfections that are not accurately representative of the situation at hand.\r\n\r\nWhile verifying data inputs and values is important, it is also necessary to validate the data model itself. If the data model is not structured or built correctly, you will run into issues when trying to use data files in various applications and software.\r\n\r\nBoth the structure and content of data files will dictate what exactly you can do with data. Using validation rules to cleanse data before use helps to mitigate “garbage in = garbage out” scenarios. Ensuring the integrity of data helps to ensure the legitimacy of your conclusions.'),
(22, 'Cryptocurrency', '61419570906128.26822841.jpg', 43, '2021-09-15', 0, 'A cryptocurrency, crypto-currency, or crypto is a binary data designed to work as a medium of exchange wherein individual coin ownership records are stored in a ledger existing in a form of a computerized database using strong cryptography to secure transaction records, to control the creation of additional coins, and to verify the transfer of coin ownership.[1][2] Some crypto schemes use validators to maintain the cryptocurrency. In a proof-of-stake model, owners put up their tokens as collateral. In return, they get authority over the token in proportion to the amount they stake. Generally, these token stakers get additional ownership in the token over time via network fees, newly minted tokens or other such reward mechanisms.[3] Cryptocurrency does not exist in physical form (like paper money) and is typically not issued by a central authority. Cryptocurrencies typically use decentralized control as opposed to a central bank digital currency (CBDC).[4] When a cryptocurrency is minted or created prior to issuance or issued by a single issuer, it is generally considered centralized. When implemented with decentralized control, each cryptocurrency works through distributed ledger technology, typically a blockchain, that serves as a public financial transaction database.[5]\r\n\r\nBitcoin, first released as open-source software in 2009, is the first decentralized cryptocurrency.[6] Since the release of bitcoin, many other cryptocurrencies have been created.'),
(23, 'twat is this', 'blog-cover.png', 43, '2021-10-05', 1, 'this is shit.');

-- --------------------------------------------------------

--
-- Table structure for table `blogvotes`
--

DROP TABLE IF EXISTS `blogvotes`;
CREATE TABLE IF NOT EXISTS `blogvotes` (
  `voteId` int NOT NULL AUTO_INCREMENT,
  `voteBlog` int NOT NULL,
  `voteBy` int NOT NULL,
  `voteDate` date NOT NULL,
  `vote` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`voteId`),
  KEY `voteBlog` (`voteBlog`),
  KEY `voteBy` (`voteBy`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogvotes`
--

INSERT INTO `blogvotes` (`voteId`, `voteBlog`, `voteBy`, `voteDate`, `vote`) VALUES
(24, 21, 43, '2021-09-15', 1),
(25, 23, 43, '2021-10-05', 1),
(26, 21, 47, '2022-08-01', 1);

--
-- Triggers `blogvotes`
--
DROP TRIGGER IF EXISTS `calc_blog_votes_after_delete`;
DELIMITER $$
CREATE TRIGGER `calc_blog_votes_after_delete` AFTER DELETE ON `blogvotes` FOR EACH ROW BEGIN

		update blogs
        set blogs.blog_votes = blogs.blog_votes - old.vote
        where blogs.blog_id = old.voteBlog;	

END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `calc_blog_votes_after_insert`;
DELIMITER $$
CREATE TRIGGER `calc_blog_votes_after_insert` AFTER INSERT ON `blogvotes` FOR EACH ROW BEGIN
	
	update blogs
        set blogs.blog_votes = blogs.blog_votes + new.vote
        where blogs.blog_id = new.voteBlog;	
		
    END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `calc_blog_votes_after_update`;
DELIMITER $$
CREATE TRIGGER `calc_blog_votes_after_update` AFTER UPDATE ON `blogvotes` FOR EACH ROW BEGIN
	
		update blogs
        set blogs.blog_votes = blogs.blog_votes + (new.vote * 2)
        where blogs.blog_id = new.voteBlog;	
		
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name_unique` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
(5, 'gardening', 'different gardening techniques used to torture helpless victims and make them dream of attending horrible opera performances'),
(8, 'sad', 'sadsadsadsad'),
(9, 'Technical Difficulties', 'Issues and debates related to immediate actions which must be taken on event of a serious butthurt'),
(15, '456', '212');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_one` int NOT NULL,
  `user_two` int NOT NULL,
  `uidUsers` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_one` (`user_one`),
  KEY `user_two` (`user_two`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `user_one`, `user_two`, `uidUsers`) VALUES
(41, 41, 40, '1'),
(49, 43, 40, '2'),
(50, 43, 41, '3'),
(51, 43, 44, '4'),
(52, 43, 43, '5'),
(54, 45, 41, ''),
(55, 47, 41, ''),
(56, 47, 40, ''),
(57, 47, 43, ''),
(58, 47, 50, ''),
(59, 54, 43, '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event_by` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `event_date` varchar(10) NOT NULL,
  `event_image` varchar(200) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `events_ibfk_1` (`event_by`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_by`, `title`, `date_created`, `event_date`, `event_image`) VALUES
(28, 43, 'final', '2021-09-22', '2021-10-05', 'event-cover.png'),
(29, 43, 'mid', '2021-09-22', '2021-09-25', 'event-cover.png'),
(30, 43, 'final twat', '2021-10-05', '2021-10-09', 'event-cover.png');

-- --------------------------------------------------------

--
-- Table structure for table `event_info`
--

DROP TABLE IF EXISTS `event_info`;
CREATE TABLE IF NOT EXISTS `event_info` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `headline` varchar(100) NOT NULL,
  `description` varchar(6000) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `event` (`event`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_info`
--

INSERT INTO `event_info` (`event_id`, `event`, `title`, `headline`, `description`) VALUES
(20, 28, 'final', 'project', 'final of project'),
(21, 29, 'mid', 'defence', 'defence project mid'),
(22, 30, 'final twat', 'hell', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `iv` text NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `iv`) VALUES
(40, 456822, 54, 'Cw==', 'ce28f5d1caff095a3094c0ee10545157'),
(41, 456822, 54, 'Gvzk', '1b88d774a110c5333344b13ace636aed'),
(42, 456822, 54, 'oGQ5', '0481ff442eeffe70c0a42df9eeb0dbf0'),
(43, 281216680, 47, 'Ixw=', 'e3c9cf2d02d786ef4f07adbac3124b7b'),
(44, 4565, 54, 'KJB0aFc=', '4aeefc26ed1d26ddfa7f2fa987be966e'),
(45, 4565, 54, 'Rj58pxe0MA==', 'f63ef6962f49d8e153141b7f801e3f78'),
(46, 281216680, 47, 'QAeoXY1UNQ==', '3bb6a18d3d99a6e7c6ed6f0b1f178f71'),
(47, 281216680, 47, 'uQ==', '6517d0ac1762734d6d89a37eaba83a94'),
(48, 281216680, 47, 'Y68X7HkP', '636f26bb203a89d244aad308575f22fc'),
(49, 281216680, 47, 'yf+fHg==', '82163a8e4000944ed3ca573e9d353c9d'),
(50, 4565, 54, 'OjYf', '3af33cbb41b0b52f4d6c4110bea49a78'),
(51, 281216680, 47, '77Uz', '430fadda1ae209b9435b833faa342b67'),
(52, 281216680, 47, 'PCRI', '563cc5cbd46120e1bb2a2d18de5edcad'),
(53, 281216680, 47, 'mCQN', '1040ea2f5073043f168cc1c0591618a3'),
(54, 281216680, 47, 'c9s=', 'b9aeb0102182845c0b70ff1bb8ac593a'),
(55, 4565, 54, 'DP4=', 'cacfb1a3980c375f6bef7f96d05ed868'),
(56, 54, 47, 'ZDg=', '12d8630c7ecfdec902dc38c3b902c70b'),
(57, 47, 54, 'Kwk=', '162ef6c3be597bad1da3af030ce36905'),
(58, 54, 47, '0yCFqA==', '5501ce5e7970f45c1b327df4b09637b3'),
(59, 54, 47, 'clsJsg==', 'c6964f7b1b3f44658908989d85b2a768'),
(60, 47, 54, 'v0xH', 'e87bf1c111cce4f98be2199024b0c07c'),
(61, 47, 54, 'o5I=', '3b104c3d1a04776902f103d532f5303b'),
(62, 47, 54, '2wvLwOrduQw1vWc=', '3911d9853bc00075b050c637e71bc569'),
(63, 47, 54, 'rWM=', 'd2fdb3348f16de6a5755817573055383'),
(64, 47, 54, 'yE0qXUJsnjUcWR32sX+JbAjNHUNxO+NeD37SDUfRE+221EdZO/F4DlRheFdP9oH0zeA4d4yxmV7r', '17a5c91933df8b411d864f9add31db7f'),
(65, 47, 54, 'GWRfsdHAO8HI2am0x6u3GiX4LOrAyhIfGr+lP07SRskffhEGXTuufV2GhNokhenGQ36pQcQ8h2XTXwMLBpy4nKAt9PYic+sHNpRDlmwrq8xChpGC4+bvMryDqxrZ/umtvIqWMcSG06Z55pA4Zvjpy8hh8/C5sumpWA9/onbr1nbKbD0WADQuQA26AEk4', '9e093b1523ceaf151319cc60ca15d329');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
CREATE TABLE IF NOT EXISTS `polls` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_by` int NOT NULL,
  `poll_desc` varchar(5000) NOT NULL,
  `locked` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `subject`, `created`, `modified`, `status`, `created_by`, `poll_desc`, `locked`) VALUES
(18, 'who is best', '2021-09-23 01:17:09', '2021-09-23 01:17:09', '1', 43, 'best person', 0),
(19, 'Best Sport', '2021-09-23 01:20:36', '2021-09-23 01:20:36', '1', 43, 'what might be the best sport of all time', 0),
(20, 'who is twat', '2021-10-05 14:38:15', '2021-10-05 14:38:15', '1', 43, 'twat guy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

DROP TABLE IF EXISTS `poll_options`;
CREATE TABLE IF NOT EXISTS `poll_options` (
  `id` int NOT NULL AUTO_INCREMENT,
  `poll_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poll_options`
--

INSERT INTO `poll_options` (`id`, `poll_id`, `name`, `created`, `modified`, `status`) VALUES
(36, 18, 'messi', '2021-09-23 01:17:09', '2021-09-23 01:17:09', '1'),
(37, 18, 'Ronaldo', '2021-09-23 01:17:09', '2021-09-23 01:17:09', '1'),
(38, 18, 'Ozil', '2021-09-23 01:17:09', '2021-09-23 01:17:09', '1'),
(39, 18, 'Drogba', '2021-09-23 01:17:10', '2021-09-23 01:17:10', '1'),
(40, 19, 'Football', '2021-09-23 01:20:36', '2021-09-23 01:20:36', '1'),
(41, 19, 'Cricket', '2021-09-23 01:20:36', '2021-09-23 01:20:36', '1'),
(42, 20, 'gan', '2021-10-05 14:38:15', '2021-10-05 14:38:15', '1'),
(43, 20, 'man', '2021-10-05 14:38:15', '2021-10-05 14:38:15', '1');

-- --------------------------------------------------------

--
-- Table structure for table `poll_votes`
--

DROP TABLE IF EXISTS `poll_votes`;
CREATE TABLE IF NOT EXISTS `poll_votes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `poll_id` int NOT NULL,
  `poll_option_id` int NOT NULL,
  `vote_by` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`),
  KEY `poll_option_id` (`poll_option_id`),
  KEY `vote_by` (`vote_by`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poll_votes`
--

INSERT INTO `poll_votes` (`id`, `poll_id`, `poll_option_id`, `vote_by`) VALUES
(27, 18, 36, 43),
(28, 20, 42, 43),
(29, 18, 36, 45);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int NOT NULL,
  `post_by` int NOT NULL,
  `post_votes` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `post_topic` (`post_topic`),
  KEY `post_by` (`post_by`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`, `post_votes`) VALUES
(129, 'nm,nm,n,', '2021-09-15 12:20:58', 48, 43, 0),
(133, 'why is this most popular layout', '2021-09-17 20:23:50', 51, 43, 0),
(136, 'ok', '2021-10-05 12:43:09', 48, 43, 0),
(137, 'TWAT YOU?', '2021-10-05 14:25:46', 53, 43, 1),
(138, 'this is twat forum', '2021-10-06 13:29:45', 54, 45, 1),
(139, 'none', '2022-08-01 10:23:19', 51, 47, 0);

-- --------------------------------------------------------

--
-- Table structure for table `postvotes`
--

DROP TABLE IF EXISTS `postvotes`;
CREATE TABLE IF NOT EXISTS `postvotes` (
  `voteId` int NOT NULL AUTO_INCREMENT,
  `votePost` int NOT NULL,
  `voteBy` int NOT NULL,
  `voteDate` date NOT NULL,
  `vote` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`voteId`),
  KEY `voteBy` (`voteBy`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postvotes`
--

INSERT INTO `postvotes` (`voteId`, `votePost`, `voteBy`, `voteDate`, `vote`) VALUES
(35, 124, 41, '2021-05-19', 1),
(36, 125, 41, '2021-05-19', 1),
(37, 128, 44, '2021-09-15', 1),
(38, 137, 47, '2022-07-11', 1),
(39, 138, 47, '2022-08-01', 1);

--
-- Triggers `postvotes`
--
DROP TRIGGER IF EXISTS `calc_forum_votes_after_delete`;
DELIMITER $$
CREATE TRIGGER `calc_forum_votes_after_delete` AFTER DELETE ON `postvotes` FOR EACH ROW BEGIN

		update posts
        set posts.post_votes = posts.post_votes - old.vote
        where posts.post_id = old.votePost;	

END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `calc_forum_votes_after_insert`;
DELIMITER $$
CREATE TRIGGER `calc_forum_votes_after_insert` AFTER INSERT ON `postvotes` FOR EACH ROW BEGIN
	
	update posts
        set posts.post_votes = posts.post_votes + new.vote
        where posts.post_id = new.votePost;	
		
    END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `calc_forum_votes_after_update`;
DELIMITER $$
CREATE TRIGGER `calc_forum_votes_after_update` AFTER UPDATE ON `postvotes` FOR EACH ROW BEGIN
	
		update posts
        set posts.post_votes = posts.post_votes + (new.vote * 2)
        where posts.post_id = new.votePost;	
		
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

DROP TABLE IF EXISTS `pwdreset`;
CREATE TABLE IF NOT EXISTS `pwdreset` (
  `pwdResetId` int NOT NULL AUTO_INCREMENT,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL,
  PRIMARY KEY (`pwdResetId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(4, 'asd@as.asd', 'fb72aeade725bc83', '$2y$10$HTEtmrlaWZpcspmoFAa90Owrd5V4UDorSyWapnRzGOjqxFkHKTexC', '1545079924'),
(5, 'a@a.a', '4c5a0e6dcd3aa696', '$2y$10$R6lxGNFwcrf0t3/onGFqseQNxzrYzsimBUU23k7XKUONE3rUZaTrm', '1545079978'),
(14, '', '04130afc342988ca', '$2y$10$tpXnN2IDdWONRJdqUpxXo.7wnMrxfVl2ujfsaaFNb8ml8EENxLQy2', '1633501917');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int NOT NULL AUTO_INCREMENT,
  `topic_subject` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int NOT NULL,
  `topic_by` int NOT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `topic_cat` (`topic_cat`),
  KEY `topic_by` (`topic_by`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`) VALUES
(48, '1234', '2021-09-15 12:09:18', 8, 43),
(51, 'qwerty', '2021-09-17 20:23:50', 9, 43),
(53, 'SHIT IS THIS', '2021-10-05 14:25:46', 15, 43),
(54, 'test', '2021-10-06 13:29:45', 9, 45);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int NOT NULL AUTO_INCREMENT,
  `unique_id` int NOT NULL,
  `userLevel` int NOT NULL DEFAULT '0',
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `gender` char(1) NOT NULL,
  `headline` varchar(500) DEFAULT NULL,
  `bio` varchar(4000) DEFAULT NULL,
  `userImg` varchar(500) DEFAULT 'default.png',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `unique_id`, `userLevel`, `f_name`, `l_name`, `uidUsers`, `emailUsers`, `pwdUsers`, `gender`, `headline`, `bio`, `userImg`, `status`) VALUES
(40, 281216681, 0, 'qwe', 'rty', 'ok', 'ok@gmail.com', '$2y$10$.1UUNX3462qUb70mkLdxJ.uLLVqhn5GyaVgSuuo6esTSigaaeYMdK', 'm', '', '', 'default.png', 'Offline'),
(41, 281216682, 0, '', '', 'okok', 'okok@gmail.com', '$2y$10$ItkMdRYq9GswVmIX1ARy0eAZ9garoXXbnS7EM2ssSPfdc1ybEZtyq', 'm', '', '', 'default.png', 'Offline'),
(43, 123, 1, '', '', '1', '123@gmail.com', '$2y$10$/34/WV8pPDPJUwQNa2BMQeeOP/rLd7vxbYuqfj8fDHad/re1HUhru', 'm', '', '', '615c7c058782a2.13148629.png', 'Offline'),
(44, 789, 0, '', '', '2', '123@gmail.com', '$2y$10$dy6UgOedd0riy0AG7tuRheaMEb0GhglZP0bbqKUJBaSl1CAQn.0kW', 'm', '', '', 'default.png', 'Offline'),
(45, 456, 1, '', '', 'root', 'root@gmail.com', '$2y$10$x/ghEzVNbTWmLsSdQ/86b.RBlHbi0Qd89KPJ8uO99IIZvkKlghgvO', 'm', '', '', '615c7b4b0dfba4.29753368.jpg', 'Offline'),
(46, 782, 0, '', '', 'user1', 'user1@gmail.com', '$2y$10$lrJoIVsUvYqP/qn7Xz9FIuywvuEvfEbwickLYybY6SpbqGteTfvfy', 'm', 'I am User 1', '', '615c7af2e3e8f0.55244693.png', 'Offline'),
(47, 4565, 0, '12', '', '12', '123@gmail.com', '$2y$10$gBTQsFgjxiIDAFoLz9m9Tu6f9k4PatBUbEXLpSR/ncPgXRvYaPiEi', 'm', '', '', 'default.png', 'Online'),
(48, 668, 0, '', '', 'a', 'a@gmail.com', '$2y$10$mJHDH/R8HOrYs1wjC1nYSO3B3MTJGkMcZIyBn.cRiiAx7YyWSq9ey', 'm', '', '', 'default.png', 'Offline'),
(49, 215, 0, '', '', 'kalu', 'kalu@gmail.com', '$2y$10$1LDeYddMS5tThyyKw.k5MeHMQ08EW5ASisEWPn/oieATvHQX5mRhu', 'm', '', '', 'default.png', 'Offline'),
(50, 897, 0, '', '', '1234', '123@gmail.com', '$2y$10$yKZKoq5Muhl6.PHGrGyj5OIUiCWUix5VstmPqY8UUawwTiqY1wDKK', 'm', '', '', 'default.png', 'Offline'),
(51, 4568, 0, '', '', '12345', '123@gmail.com', '$2y$10$zMyvbuZaffh/A6OWWC4O7uVFglB0jPTmcjY4Gi3Q/K0rXrF04meyC', 'm', '', '', 'default.png', 'Offline'),
(52, 9878, 0, '', '', '1236', '123@gmail.com', '$2y$10$wyDBrLWQaOO4ZjhhAKK14uW7mG84C0iqIeWVuNkXkmg0AO/7t.b8m', 'm', '', '', 'default.png', 'Offline'),
(53, 456822, 0, '', '', '456', '123@gmail.com', '$2y$10$h94SGkx5PcucJ5tbzzegvu94DQX3vs9Z4BXqNHcilrGvkLV.8fouq', 'm', '', '', 'default.png', 'Offline'),
(54, 281216680, 0, '11', '', '11', '123@gmail.com', '$2y$10$Pqa8WKGktjDJE4q8uFu5Kepaxh1hBIZ5sZoG.vCjmTDPTzTvTmc9u', 'm', '', '', 'default.png', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`blog_by`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogvotes`
--
ALTER TABLE `blogvotes`
  ADD CONSTRAINT `blogvotes_ibfk_1` FOREIGN KEY (`voteBlog`) REFERENCES `blogs` (`blog_id`),
  ADD CONSTRAINT `blogvotes_ibfk_2` FOREIGN KEY (`voteBy`) REFERENCES `users` (`idUsers`);

--
-- Constraints for table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`user_one`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`user_two`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`event_by`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_info`
--
ALTER TABLE `event_info`
  ADD CONSTRAINT `event_info_ibfk_1` FOREIGN KEY (`event`) REFERENCES `events` (`event_id`) ON UPDATE CASCADE;

--
-- Constraints for table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `polls_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD CONSTRAINT `poll_options_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD CONSTRAINT `poll_votes_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `poll_votes_ibfk_2` FOREIGN KEY (`poll_option_id`) REFERENCES `poll_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `poll_votes_ibfk_3` FOREIGN KEY (`vote_by`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`idUsers`) ON UPDATE CASCADE;

--
-- Constraints for table `postvotes`
--
ALTER TABLE `postvotes`
  ADD CONSTRAINT `postvotes_ibfk_1` FOREIGN KEY (`voteBy`) REFERENCES `users` (`idUsers`) ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_by`) REFERENCES `users` (`idUsers`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
