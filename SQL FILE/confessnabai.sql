-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2015 at 11:04 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `confessnabai`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
`accounts_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `secret_questions_id` int(11) NOT NULL,
  `secret_question_answer` varchar(50) NOT NULL,
  `profile_picture` varchar(50) NOT NULL,
  `account_type` int(11) NOT NULL,
  `total_post` int(11) NOT NULL,
  `account_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accounts_id`, `username`, `password`, `secret_questions_id`, `secret_question_answer`, `profile_picture`, `account_type`, `total_post`, `account_status`) VALUES
(1, 'admin', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', 'c4ca4238a0b923820dcc509a6f75849b.jpeg', 3, 40, 1),
(2, 'almeerara', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', 'c81e728d9d4c2f636f067f89cc14862c.JPG', 3, 8, 1),
(3, 'illuminati', 'efe6398127928f1b2e9ef3207fb82663', 4, 'cebu city', 'eccbc87e4b5ce2fe28308fd9f2a7baf3.jpg', 1, 0, 1),
(4, 'macmac', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', 'a87ff679a2f3e71d9181a67b7542122c.jpg', 1, 1, 1),
(5, 'nerdyme', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', 'e4da3b7fbbce2345d7772b0674a318d5.JPG', 2, 1, 1),
(7, 'akosisecret', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', '8f14e45fceea167a5a36dedd4bea2543.JPG', 1, 1, 1),
(8, 'riyyyooowww', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', 'c9f0f895fb98ab9159f51fd0297e236d.JPG', 1, 1, 1),
(11, 'iamfine', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', '6512bd43d9caa6e02c990b0a82652dca.jpg', 1, 0, 1),
(12, 'hahahehe', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', 'c20ad4d76fe97759aa27a0c99bff6710.jpg', 1, 0, 1),
(13, 'hardwell', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'hardwell', 'c51ce410c124a10e0db5e4b97fc2af39.jpg', 2, 0, 2),
(15, 'tryagain', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', '9bf31c7ff062936a96d3c8bd1f8f2ff3.jpg', 2, 0, 2),
(16, 'hardship', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', 'c74d97b01eae257e44aa9d5bade97baf.jpg', 2, 0, 2),
(17, 'nakunamantanga', '65ec1e9ca4d5c2ca4ebc071b2047d1c1', 1, 'dog', '70efdf2ec9b086079795c442636b55fb.png', 2, 4, 1),
(18, 'shopaps', 'd51e9e9150a0ce3cfae31bd165984611', 1, 'Harris', '6f4922f45568161a8cdf4ad2299f6d23.JPG', 2, 1, 1),
(19, 'gspat', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', '1f0e3dad99908345f7439f8ffabdffc4.png', 2, 1, 1),
(20, 'Yooky', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'Anne Curtis', '98f13708210194c475687be6106a3b84.jpg', 2, 0, 1),
(21, 'akosiharris', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', '3c59dc048e8850243be8079a5c74d079.jpg', 2, 1, 1),
(22, 'rawr', '29ceabb4211cbeb83f12348ba4ad8a6c', 6, 'england', 'b6d767d2f8ed5d21a44b0e5886680cb9.jpg', 2, 3, 1),
(23, 'ed', 'efe6398127928f1b2e9ef3207fb82663', 1, 'secret', '37693cfc748049e45d87b8c7d8b9aacd.jpg', 2, 0, 1),
(24, 'harritbal', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', '1ff1de774005f8da13f42943881c655f.jpeg', 2, 0, 1),
(25, 'timex', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 'secret', '8e296a067a37563370ded05f5a3bf3ec.jpg', 2, 2, 1),
(26, 'jejgorl', '827ccb0eea8a706c4c34a16891f84e7b', 6, 'Los Angeles, USA', '4e732ced3463d06de0ca9a15b6153677.jpg', 2, 1, 1),
(27, 'oinkypoinkydoinky', '02b2e8e5889271235826257449f8a261', 6, 'France', '0', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE IF NOT EXISTS `account_type` (
`account_type_id` int(11) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`account_type_id`, `account_type`, `description`) VALUES
(1, 'Limited user', 'Normal control of confessnabai.'),
(2, 'Group admin', 'Has control of all the posts in a particular group. Can ban a user in the group.'),
(3, 'Super admin', 'Has control of everything. Add, edit, delete, suspend a user or group admin.');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`category_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'academic'),
(2, 'drugs'),
(3, 'envy'),
(4, 'joke'),
(5, 'love'),
(6, 'lust'),
(7, 'maoy'),
(8, 'Angry'),
(9, 'annoyed'),
(10, 'happy'),
(11, 'meh');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`comments_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `user_accounts_id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comments_id`, `comment`, `user_accounts_id`, `posts_id`, `time_stamp`) VALUES
(1, 'wassap', 1, 122, '0000-00-00 00:00:00'),
(2, 'try', 1, 136, '0000-00-00 00:00:00'),
(3, 'heeyy!! test me comment!! :snake:', 1, 136, '0000-00-00 00:00:00'),
(4, 'wassap! :snake:', 1, 119, '0000-00-00 00:00:00'),
(5, 'heyy!! :snake:', 1, 6, '0000-00-00 00:00:00'),
(6, 'haha. ayay!! :snake: :snake: :snake:', 1, 137, '0000-00-00 00:00:00'),
(7, 'boompaness! sakpan! wahahaha :snake:', 1, 137, '0000-00-00 00:00:00'),
(8, 'maka comment na bitaw sah. hahahaha. amazing!!! :snake:', 2, 137, '0000-00-00 00:00:00'),
(9, 'wait', 2, 137, '0000-00-00 00:00:00'),
(10, 'hey', 2, 137, '0000-00-00 00:00:00'),
(11, 'walay deletay ug comment. huashuash!!', 2, 137, '0000-00-00 00:00:00'),
(12, 'haller :ahhh:', 1, 118, '0000-00-00 00:00:00'),
(13, 'wait', 1, 123, '0000-00-00 00:00:00'),
(14, 'hi :*', 1, 121, '0000-00-00 00:00:00'),
(15, 'good evening! :ahhh:', 2, 136, '0000-00-00 00:00:00'),
(19, 'try anon comment', 0, 137, '0000-00-00 00:00:00'),
(20, 'hahahaha. hi anon!!!', 1, 137, '0000-00-00 00:00:00'),
(21, 'halu, ako si anon! :)', 0, 136, '0000-00-00 00:00:00'),
(22, 'halu anon! :D', 1, 136, '0000-00-00 00:00:00'),
(26, 'di ui! akoi anon! :snake:', 0, 80, '0000-00-00 00:00:00'),
(27, 'haha. giatay. ka racist nimo ui!', 0, 140, '0000-00-00 00:00:00'),
(28, 'hahahaha. kinsa ka oy?', 1, 140, '0000-00-00 00:00:00'),
(29, 'relate! hahaha', 1, 119, '0000-00-00 00:00:00'),
(30, ' :snake:', 0, 140, '0000-00-00 00:00:00'),
(31, 'okay ra na bro. hahaha', 0, 141, '0000-00-00 00:00:00'),
(32, 'kill them bitchezzzz!! hahahahahaha :snake:', 0, 141, '0000-00-00 00:00:00'),
(33, 'makasapot bitaw. haha. ahak', 1, 141, '0000-00-00 00:00:00'),
(34, 'wassap yow!!', 1, 117, '0000-00-00 00:00:00'),
(35, 'okay ra na bradd!! :snake:', 0, 142, '0000-00-00 00:00:00'),
(36, 'heyy :snake:', 0, 144, '0000-00-00 00:00:00'),
(37, 'wassaaappp :D', 1, 144, '0000-00-00 00:00:00'),
(38, 'haaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1, 144, '0000-00-00 00:00:00'),
(39, 'sure oy?!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!', 1, 144, '0000-00-00 00:00:00'),
(40, 'hahahahahahahahaha sure ba?!', 1, 144, '0000-00-00 00:00:00'),
(41, 'hoy pag answer na!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! ', 1, 144, '0000-00-00 00:00:00'),
(42, 'mu refresh ang unsa ba? :D', 8, 147, '0000-00-00 00:00:00'),
(43, 'secret!! :snake:', 1, 147, '0000-00-00 00:00:00'),
(44, 'haha! congrats!! :snake:', 1, 148, '0000-00-00 00:00:00'),
(45, 'salamat!!! :snake:', 21, 148, '0000-00-00 00:00:00'),
(46, 'adik. hahahaha :snake:', 1, 151, '0000-00-00 00:00:00'),
(47, 'hahahaha', 0, 137, '0000-00-00 00:00:00'),
(48, 'so gwapo. omg :snake:', 1, 153, '0000-00-00 00:00:00'),
(49, 'hi :snake:', 0, 193, '0000-00-00 00:00:00'),
(50, 'hello', 1, 193, '0000-00-00 00:00:00'),
(51, 'hihihi :snake:', 2, 196, '0000-00-00 00:00:00'),
(52, 'unsay ngilngig na tambal ang maka ayo ani? :blank:', 26, 196, '0000-00-00 00:00:00'),
(53, 'unsay ngilngig na tambal ang maka ayo ani? :blank:', 26, 196, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
`followers_id` int(11) NOT NULL,
  `user_accounts_id` int(11) NOT NULL,
  `followers_accounts_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`followers_id`, `user_accounts_id`, `followers_accounts_id`) VALUES
(1, 1, 13),
(2, 2, 13),
(5, 13, 1),
(6, 2, 1),
(7, 3, 1),
(8, 1, 2),
(9, 7, 1),
(11, 12, 1),
(12, 1, 7),
(13, 11, 1),
(14, 18, 1),
(15, 4, 1),
(17, 8, 1),
(18, 1, 4),
(19, 8, 4),
(20, 22, 1),
(21, 17, 1),
(22, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE IF NOT EXISTS `following` (
`following_id` int(11) NOT NULL,
  `user_accounts_id` int(11) NOT NULL,
  `following_accounts_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`group_id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `group_accounts_id_admin` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_accounts_id_admin`) VALUES
(1, 'Global', 1),
(2, 'USC Confessions', 2),
(3, 'UC Confessions', 1),
(4, 'Moriah Confessions', 1),
(5, 'LJD Confessions', 1),
(6, 'CompE Confessions', 1),
(7, 'Almira Confessions', 1),
(8, 'LB264TC', 1),
(9, 'CEAC1 Confessions', 1),
(10, 'LB267TC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `picture_post`
--

CREATE TABLE IF NOT EXISTS `picture_post` (
`picture_post_id` int(11) NOT NULL,
  `picture_post_filename` varchar(100) NOT NULL,
  `accounts_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `picture_post`
--

INSERT INTO `picture_post` (`picture_post_id`, `picture_post_filename`, `accounts_id`) VALUES
(1, 'c4ca4238a0b923820dcc509a6f75849b.png', 1),
(3, 'a87ff679a2f3e71d9181a67b7542122c.png', 1),
(4, '1679091c5a880faf6fb5e6087eb1b2dc.jpg', 2),
(5, '8f14e45fceea167a5a36dedd4bea2543.JPG', 1),
(6, '45c48cce2e2d7fbdea1afc51c7c6ad26.JPG', 2),
(7, 'd3d9446802a44259755d38e6d163e820.JPG', 1),
(8, '6512bd43d9caa6e02c990b0a82652dca.jpg', 2),
(9, 'c51ce410c124a10e0db5e4b97fc2af39.jpg', 0),
(10, 'aab3238922bcc25a6f606eb525ffdc56.jpg', 0),
(11, '9bf31c7ff062936a96d3c8bd1f8f2ff3.jpg', 0),
(12, 'c74d97b01eae257e44aa9d5bade97baf.png', 1),
(13, '70efdf2ec9b086079795c442636b55fb.png', 0),
(14, '6f4922f45568161a8cdf4ad2299f6d23.jpg', 0),
(15, '1f0e3dad99908345f7439f8ffabdffc4.jpg', 5),
(16, '98f13708210194c475687be6106a3b84.JPG', 1),
(17, 'b6d767d2f8ed5d21a44b0e5886680cb9.JPG', 0),
(18, '37693cfc748049e45d87b8c7d8b9aacd.png', 1),
(19, '8e296a067a37563370ded05f5a3bf3ec.jpg', 0),
(20, '02e74f10e0327ad868d138f2b4fdd6f0.jpg', 0),
(21, '6ea9ab1baa0efb9e19094440c317e21b.jpg', 0),
(22, 'c16a5320fa475530d9583c34fd356ef5.jpg', 0),
(23, '1c383cd30b7c298ab50293adfecb7b18.jpg', 0),
(24, 'd67d8ab4f4c10bf22aa353e27879133c.jpg', 1),
(25, 'f457c545a9ded88f18ecee47145a72c0.png', 17),
(26, '2838023a778dfaecdc212708f721b788.png', 0),
(27, 'ea5d2f1c4608232e07d3aa3d998e5135.JPG', 1),
(28, 'fc490ca45c00b1249bbe3554a4fdf6fb.JPG', 0),
(29, '735b90b4568125ed6c3f678819b6e058.JPG', 0),
(30, 'fe9fc289c3ff0af142b6d3bead98a923.png', 1),
(31, '93db85ed909c13838ff95ccfa94cebd9.png', 1),
(32, '5ef059938ba799aaa845e1c2e8a762bd.png', 1),
(33, '07e1cd7dca89a1678042477183b7ac3f.jpg', 2),
(34, '3def184ad8f4755ff269862ea77393dd.png', 0),
(35, '3988c7f88ebcb58c6ce932b957b6f332.jpg', 2),
(36, 'b3e3e393c77e35a4a3f3cbd1e429b5dc.JPG', 22),
(37, '2a79ea27c279e471f4d180b08d62b00a.jpg', 1),
(38, '82aa4b0af34c2313a562076992e50aa3.jpg', 1),
(39, 'bf8229696f7a3bb4700cfddef19fa23f.jpg', 1),
(40, '82161242827b703e6acf9c726942a1e4.jpg', 1),
(41, 'a2557a7b2e94197ff767970b67041697.jpeg', 1),
(42, '0aa1883c6411f7873cb83dacb17b0afc.jpg', 25);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`posts_id` int(11) NOT NULL,
  `post` text NOT NULL,
  `post_accounts_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `with_picture` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`posts_id`, `post`, `post_accounts_id`, `group_id`, `category`, `time_stamp`, `with_picture`, `file_name`) VALUES
(1, 'hey, i just met you and this is crazy. here''s my schedule, so stalk me maybe? :snake:', 1, 1, 1, '2014-11-12 01:24:41', 1, 'c4ca4238a0b923820dcc509a6f75849b.png'),
(3, 'hello :)', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(6, 'yey, maka post na ko ug picture. hihihihihihi :snake:', 2, 1, 5, '2014-11-12 01:39:41', 1, '1679091c5a880faf6fb5e6087eb1b2dc.jpg'),
(7, 'this is a test', 1, 1, 1, '2014-11-12 01:40:41', 1, '8f14e45fceea167a5a36dedd4bea2543.JPG'),
(8, 'what?', 2, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(11, 'i sense bugs', 2, 1, 1, '2014-11-12 01:45:15', 1, '6512bd43d9caa6e02c990b0a82652dca.jpg'),
(12, 'try anon', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(13, 'try upload anon :snake:', 0, 1, 2, '2014-11-12 01:53:40', 1, 'c51ce410c124a10e0db5e4b97fc2af39.jpg'),
(14, 'hahaha. nigana na lage! :snake:', 0, 1, 1, '2014-11-12 01:55:08', 1, 'aab3238922bcc25a6f606eb525ffdc56.jpg'),
(15, 'mao ni pcb', 0, 1, 2, '2014-11-12 01:56:08', 1, '9bf31c7ff062936a96d3c8bd1f8f2ff3.jpg'),
(16, 'route route route :snake:', 1, 1, 1, '2014-11-12 02:35:48', 1, 'c74d97b01eae257e44aa9d5bade97baf.png'),
(17, 'halu ;-P', 0, 1, 2, '2014-11-12 02:43:51', 1, '70efdf2ec9b086079795c442636b55fb.png'),
(18, 'hey what''s up?', 0, 1, 3, '2014-11-12 02:46:29', 1, '6f4922f45568161a8cdf4ad2299f6d23.jpg'),
(19, 'hello, i''m new :red:', 5, 1, 5, '2014-11-12 02:47:00', 1, '1f0e3dad99908345f7439f8ffabdffc4.jpg'),
(21, 'yey, mana jud klase! :D', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(22, 'my crush :red:', 0, 1, 6, '2014-11-12 09:53:41', 1, 'b6d767d2f8ed5d21a44b0e5886680cb9.JPG'),
(24, 'hello! :)', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(25, 'ahh! laguta jud gaina sa tc oy!! :vampire:', 0, 1, 1, '2014-11-13 16:41:54', 1, '8e296a067a37563370ded05f5a3bf3ec.jpg'),
(26, 'oh yeah, TJR dude!!!!! :snake:', 0, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(27, ' :snake:', 0, 1, 2, '2014-11-14 00:58:08', 1, '02e74f10e0327ad868d138f2b4fdd6f0.jpg'),
(28, 'the drama is so intense that i can''t even!! :snake:', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(29, 'kung naay picture kay okay? :snake:', 0, 1, 5, '2014-11-15 01:14:03', 1, '6ea9ab1baa0efb9e19094440c317e21b.jpg'),
(30, 'kung wai picture kay walay date?', 0, 1, 4, '0000-00-00 00:00:00', 0, '0'),
(31, 'pero kung naay picture kay naay date?', 0, 1, 6, '2014-11-15 01:15:30', 1, 'c16a5320fa475530d9583c34fd356ef5.jpg'),
(32, 'i love you :ahhh:', 2, 1, 5, '0000-00-00 00:00:00', 0, '0'),
(33, 'hello, first post here! :P', 7, 1, 5, '0000-00-00 00:00:00', 0, '0'),
(34, 'hi almira!! :snake:', 0, 1, 5, '0000-00-00 00:00:00', 0, '0'),
(35, 'gwapo naa sa taas nako. %-P', 0, 1, 5, '2014-11-15 08:56:30', 1, '1c383cd30b7c298ab50293adfecb7b18.jpg'),
(36, 'hahahaha. salamat anon!!! :coolsmirk:', 1, 1, 5, '0000-00-00 00:00:00', 0, '0'),
(37, 'uhh... hi?', 1, 1, 4, '0000-00-00 00:00:00', 0, '0'),
(38, 'wassap?', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(40, 'halu! :ahhh:', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(41, 'hala naguba', 0, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(42, 'whatt??', 0, 1, 3, '0000-00-00 00:00:00', 0, '0'),
(43, 'hello, what''s up? :coolsmirk:', 0, 1, 5, '0000-00-00 00:00:00', 0, '0'),
(44, 'spread the love, brother :P', 0, 1, 5, '0000-00-00 00:00:00', 0, '0'),
(45, 'hello', 1, 1, 5, '0000-00-00 00:00:00', 0, '0'),
(46, 'heeeyyy!!!! :snake:', 1, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(47, 'naa koi iconfess sa BUNZEL BLDG, c melody miramontes BS-CPE 5 DSD boang nang bayhana.', 17, 1, 6, '0000-00-00 00:00:00', 0, '0'),
(48, '', 17, 1, 6, '0000-00-00 00:00:00', 0, '0'),
(49, '', 17, 1, 5, '2014-11-17 02:55:48', 1, 'f457c545a9ded88f18ecee47145a72c0.png'),
(50, '', 17, 1, 6, '0000-00-00 00:00:00', 0, '0'),
(51, '', 0, 1, 4, '2014-11-17 03:14:14', 1, '2838023a778dfaecdc212708f721b788.png'),
(52, 'anon', 1, 1, 4, '0000-00-00 00:00:00', 0, '0'),
(53, 'that''s it. fuck you all >:-(', 0, 1, 3, '0000-00-00 00:00:00', 0, '0'),
(55, 'wut', 1, 1, 4, '0000-00-00 00:00:00', 0, '0'),
(56, 'halu', 1, 1, 6, '0000-00-00 00:00:00', 0, '0'),
(57, 'hi :)', 0, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(58, 'hey you, i''m anon!! :D', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(59, 'hi anon! :snake:', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(60, 'wut???', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(61, 'gabie ni gamit ko tunga me sa ako ig agaw', 18, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(62, 'hi', 0, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(63, 'halu', 1, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(65, 'IDOL!!! %-P', 0, 1, 5, '2014-11-24 13:17:45', 1, 'fc490ca45c00b1249bbe3554a4fdf6fb.JPG'),
(66, 'tired as shit :sick:', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(67, 'giduka ko!!', 0, 1, 1, '2014-11-25 03:34:45', 1, '735b90b4568125ed6c3f678819b6e058.JPG'),
(69, 'short bondpaper exam 324 thursday, 11/27/14', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(70, 'hasula :blank:', 1, 1, 7, '0000-00-00 00:00:00', 0, '0'),
(71, 'halu', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(72, 'hiii', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(73, 'ayusa sa embedded du!! :snake:', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(74, ' :question:', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(75, 'kapuya :snake:', 1, 9, 1, '0000-00-00 00:00:00', 0, '0'),
(76, 'uhh.. anon?', 1, 1, 3, '0000-00-00 00:00:00', 0, '0'),
(77, 'hiii', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(81, 'klasmet reporting', 0, 8, 1, '0000-00-00 00:00:00', 0, '0'),
(82, 'ay sig basa classmate', 1, 8, 1, '0000-00-00 00:00:00', 0, '0'),
(85, ' :snake:', 19, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(87, 'heeyyy!!', 0, 1, 4, '0000-00-00 00:00:00', 0, '0'),
(88, 'halu', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(89, 'hi?', 0, 1, 6, '0000-00-00 00:00:00', 0, '0'),
(90, 'haller!!! :snake:', 0, 1, 5, '0000-00-00 00:00:00', 0, '0'),
(92, 'hi, 11th post! hahaha', 1, 1, 4, '0000-00-00 00:00:00', 0, '0'),
(93, 'what?', 1, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(118, 'haller :snake:', 2, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(119, '', 2, 1, 2, '2014-12-11 04:18:16', 1, '07e1cd7dca89a1678042477183b7ac3f.jpg'),
(121, 'halu', 1, 1, 7, '0000-00-00 00:00:00', 0, '0'),
(122, 'heeyyy :snake:', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(123, 'tarunga ko ha', 1, 1, 4, '0000-00-00 00:00:00', 0, '0'),
(129, 'hi', 0, 1, 5, '0000-00-00 00:00:00', 0, '0'),
(133, 'wa nai error pls', 0, 1, 4, '0000-00-00 00:00:00', 0, '0'),
(134, 'kalain', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(135, 'yey, wa nai error!! :snake:', 0, 1, 4, '0000-00-00 00:00:00', 0, '0'),
(136, 'good evening carolinians!! :D', 1, 2, 1, '0000-00-00 00:00:00', 0, '0'),
(137, 'tulog din pag may time! hahahahaha :snake:', 2, 1, 1, '2014-12-13 06:12:54', 1, '3988c7f88ebcb58c6ce932b957b6f332.jpg'),
(140, 'kanang nigger namo nga silingan ba! hahahaha :snake:', 0, 5, 2, '0000-00-00 00:00:00', 0, '0'),
(143, 'halu, anon ko :snake:', 0, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(144, 'hala grabi', 0, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(145, 'hey', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(147, 'di mu refresh :down:', 1, 1, 9, '0000-00-00 00:00:00', 0, '0'),
(148, 'maka ilis na ug profile picture!!!! :snake:', 21, 1, 10, '0000-00-00 00:00:00', 0, '0'),
(149, '90% done. thanks God :D', 1, 1, 10, '0000-00-00 00:00:00', 0, '0'),
(150, 'good evening!!! :snake:', 1, 1, 10, '0000-00-00 00:00:00', 0, '0'),
(151, 'my profile picture issshhh ssshhhooo fffuunneeehh!! :snake:', 4, 1, 10, '0000-00-00 00:00:00', 0, '0'),
(152, 'i''m high', 22, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(153, 'haha', 22, 1, 10, '2015-01-15 04:29:35', 1, 'b3e3e393c77e35a4a3f3cbd1e429b5dc.JPG'),
(154, ' :coolmad:', 22, 1, 8, '0000-00-00 00:00:00', 0, '0'),
(155, '', 1, 1, 1, '2015-01-15 19:33:50', 1, '2a79ea27c279e471f4d180b08d62b00a.jpg'),
(157, ' :snake:', 1, 1, 10, '0000-00-00 00:00:00', 0, '0'),
(158, 'halu halu', 0, 1, 10, '0000-00-00 00:00:00', 0, '0'),
(174, 'ok ra ka? hahaha', 1, 1, 10, '2015-01-20 22:54:52', 1, 'bf8229696f7a3bb4700cfddef19fa23f.jpg'),
(178, 'pssttt!!', 0, 1, 3, '0000-00-00 00:00:00', 0, '0'),
(180, 'wassap global!!', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(181, 'hoy', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(182, 'hey wassap', 0, 1, 3, '0000-00-00 00:00:00', 0, '0'),
(183, 'wassap yow', 1, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(187, 'hi', 2, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(189, 'testing... :snake:', 1, 1, 1, '2015-01-24 19:23:41', 1, 'a2557a7b2e94197ff767970b67041697.jpeg'),
(190, 'hi :snake:', 25, 1, 1, '0000-00-00 00:00:00', 0, '0'),
(191, 'ako ni :long:', 25, 1, 2, '2015-01-24 21:39:25', 1, '0aa1883c6411f7873cb83dacb17b0afc.jpg'),
(192, 'hi', 0, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(193, 'hi', 0, 3, 8, '0000-00-00 00:00:00', 0, '0'),
(194, 'hi', 8, 1, 2, '0000-00-00 00:00:00', 0, '0'),
(195, 'heeeyyyy', 0, 1, 3, '0000-00-00 00:00:00', 0, '0'),
(196, 'I have herpes! Lord help.', 26, 1, 6, '0000-00-00 00:00:00', 0, '0'),
(197, 'Naa ko karun sa teaO''clock with friends nya hinay ang wifi connection ngari.', 27, 1, 7, '0000-00-00 00:00:00', 0, '0'),
(198, 'hi', 1, 2, 1, '0000-00-00 00:00:00', 0, '0'),
(199, 'yow, confess na!', 27, 1, 1, '0000-00-00 00:00:00', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `secret_questions`
--

CREATE TABLE IF NOT EXISTS `secret_questions` (
`secret_questions_id` int(11) NOT NULL,
  `questions` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secret_questions`
--

INSERT INTO `secret_questions` (`secret_questions_id`, `questions`) VALUES
(1, 'What is the first name of the person you first kissed?'),
(2, 'What is the last name of the teacher who gave you your first failing grade?'),
(3, 'What is the name of the first beach you visited?'),
(4, 'In what city or town did you meet your spouse/partner?'),
(5, 'What was the name of your elementary / primary school?'),
(6, 'What is the country of your ultimate dream vacation?'),
(7, 'What is the name of your favorite childhood teacher?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`accounts_id`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
 ADD PRIMARY KEY (`account_type_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`comments_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
 ADD PRIMARY KEY (`followers_id`);

--
-- Indexes for table `following`
--
ALTER TABLE `following`
 ADD PRIMARY KEY (`following_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `picture_post`
--
ALTER TABLE `picture_post`
 ADD PRIMARY KEY (`picture_post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`posts_id`);

--
-- Indexes for table `secret_questions`
--
ALTER TABLE `secret_questions`
 ADD PRIMARY KEY (`secret_questions_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `accounts_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
MODIFY `account_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `comments_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
MODIFY `followers_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `following`
--
ALTER TABLE `following`
MODIFY `following_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `picture_post`
--
ALTER TABLE `picture_post`
MODIFY `picture_post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `posts_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=200;
--
-- AUTO_INCREMENT for table `secret_questions`
--
ALTER TABLE `secret_questions`
MODIFY `secret_questions_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
