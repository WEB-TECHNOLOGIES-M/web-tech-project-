-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2020 at 11:03 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobplatdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(10) NOT NULL,
  `userID` int(5) NOT NULL,
  `email` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `userID`, `email`, `name`, `address`) VALUES
(1, 1, 'admin@job.com', 'admin', NULL),
(2, 2, 'admin2@job.com', 'admin2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `ID` int(10) NOT NULL,
  `userID` int(5) NOT NULL,
  `email` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `contact` int(20) NOT NULL,
  `location` varchar(100) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `license` varchar(100) NOT NULL,
  `approval` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`ID`, `userID`, `email`, `name`, `type`, `contact`, `location`, `website`, `license`, `approval`) VALUES
(1, 3, 'adidas@adidas.com', 'adidas', 'Clothing', 1234, 'germany', NULL, '1234', 1),
(2, 4, 'aiub@aiub.edu', 'aiub', 'Education', 123, 'Kuril', NULL, '1234', 1),
(3, 5, 'inc@inc.ltd', 'incltd', 'ltd', 1234, 'Home', NULL, '1234', 1),
(4, 20, 'xyz@gmail.com', 'asdfadfd', 'asdasd', 343, 'vzxcv', '113123123', 'vzw3rw3', 1),
(5, 25, 'ami@ami.com', 'ami', 'ami', 1234, '1234', NULL, '1234', 0),
(6, 26, 'ama@ama.com', 'ama', 'ama', 123, '123', NULL, '123', 0),
(7, 29, 'jon@gmail.com', 'jon', 'full time', 1111111111, 'dhaka', '3425', '4564747', 0);

-- --------------------------------------------------------

--
-- Table structure for table `expire`
--

CREATE TABLE `expire` (
  `id` int(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `duration` int(50) NOT NULL,
  `ts_created` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `ID` int(10) NOT NULL,
  `job_id` varchar(50) NOT NULL,
  `employer` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `location` varchar(100) NOT NULL,
  `catagory` varchar(50) NOT NULL,
  `experience` int(2) NOT NULL,
  `vacancy` int(5) NOT NULL,
  `salary` int(10) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `ts_created` timestamp(5) NOT NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5),
  `pic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`ID`, `job_id`, `employer`, `title`, `type`, `location`, `catagory`, `experience`, `vacancy`, `salary`, `description`, `ts_created`, `pic`) VALUES
(1, 'tg001', 'tiget-it', 'Web Developer', 'full-time', 'dhaka', 'it', 1, 5, 9000, 'dexxxxxxxxxx', '2020-05-17 06:28:33.79860', 'index.jpg'),
(2, 'db001', 'dhaka bank', 'Manager', 'part-time', 'sylhet', 'bangking', 5, 1, 30000, 'dexxxxxxx', '2020-05-17 06:31:17.92065', 'job_logo_1.jpg'),
(3, 'br001', 'brainstation-23', 'ios Developer', 'full-time', 'dhaka', 'it', 4, 5, 30000, 'dexxxxxxx', '2020-05-17 06:31:21.10011', 'job_logo_1.jpg'),
(4, 'pr001', 'prolog-it', 'android Developer', 'full-time', 'chittagong', 'it', 2, 5, 20000, 'dexxxxxxx', '2020-05-17 06:31:23.87070', 'job_logo_1.jpg'),
(5, 'nm001', 'name-it', 'android Developer', 'full-time', 'sylhet', 'it', 2, 5, 20000, 'dexxxxxxx', '2020-05-17 06:31:25.66091', 'job_logo_1.jpg'),
(6, 'brb001', 'Brack bank', 'AGM', 'part-time', 'dhaka', 'bangking', 5, 1, 30000, 'dexxxxxxx', '2020-05-17 06:31:27.78224', 'job_logo_1.jpg'),
(7, 'dbbl001', 'DBBL bank', 'AGM', 'full-time', 'dhaka', 'bangking', 5, 1, 30000, 'dexxxxxxx', '2020-05-17 06:31:30.45609', 'job_logo_1.jpg'),
(8, 'nm002', 'name222-it', 'android Developer', 'part-time', 'sylhet', 'it', 2, 5, 20000, 'dexxxxxxx', '2020-05-17 06:31:32.00598', 'job_logo_1.jpg'),
(9, 'it001', 'itMan-23', 'ios Developer', 'part-time', 'sylhet', 'it', 2, 5, 35000, 'dexxxxxxx', '2020-05-17 06:31:33.37029', 'job_logo_1.jpg'),
(10, 'lf001', 'LifeBD', 'Area Officer', 'full-time', 'sylhet', 'insurance', 2, 5, 20000, 'dexxxxxxx', '2020-05-17 06:31:35.04581', 'job_logo_1.jpg'),
(11, 'dv001', 'Dev-it', 'Front-End designer', 'part-time', 'dhaka', 'it', 2, 5, 20000, 'dexxxxxxx', '2020-05-17 06:31:36.82010', 'job_logo_1.jpg'),
(12, 'it002', 'it-Dev', 'ios Developer', 'full-time', 'dhaka', 'it', 2, 5, 20000, 'dexxxxxxx', '2020-05-17 06:31:38.70606', 'job_logo_1.jpg'),
(13, 'tg002', 'tiget-it', 'Android Developer', 'full-time', 'dhaka', 'it', 7, 5, 70000, 'dexxxxxxx', '2020-05-17 06:31:40.77249', 'job_logo_1.jpg'),
(14, 'brio001', 'BRIOM-it', 'Front-End designer', 'part-time', 'dhaka', 'it', 2, 5, 10000, 'dexxxxxxx', '2020-05-17 06:31:42.44103', 'job_logo_1.jpg'),
(16, 'a001', 'a-it', 'Front-End designer', 'part-time', 'dhaka', 'it', 3, 4, 10000, 'dexxxxxxx', '2020-05-17 06:31:44.31003', 'job_logo_1.jpg'),
(17, 'b001', 'b-it', 'Front-End designer', 'full-time', 'dhaka', 'it', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:31:50.82165', 'job_logo_1.jpg'),
(18, 'c001', 'c-it', 'ios designer', 'full-time', 'sylhet', 'it', 2, 4, 30000, 'dexxxxxxx', '2020-05-17 06:31:53.83759', 'job_logo_1.jpg'),
(19, 'd001', 'd-it', 'ios designer', 'full-time', 'sylhet', 'it', 2, 4, 40000, 'dexxxxxxx', '2020-05-17 06:31:55.91299', 'job_logo_1.jpg'),
(20, 'e001', 'e-it', 'android designer', 'full-time', 'chittagong', 'it', 3, 4, 15000, 'dexxxxxxx', '2020-05-17 06:31:57.28536', 'job_logo_1.jpg'),
(21, 'f001', 'f-bangking', 'Manager', 'full-time', 'chittagong', 'bangking', 3, 4, 30000, 'dexxxxxxx', '2020-05-17 06:31:59.52733', 'job_logo_1.jpg'),
(22, 'g001', 'g-bangking', 'Manager', 'full-time', 'sylhet', 'bangking', 3, 4, 30000, 'dexxxxxxx', '2020-05-17 06:32:05.07250', 'job_logo_1.jpg'),
(23, 'm001', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'marketing', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:29:50.57826', 'job_logo_1.jpg'),
(25, 'm002', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'marketing', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:29:50.70290', 'job_logo_1.jpg'),
(26, 'm003', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'marketing', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:29:50.76174', 'job_logo_1.jpg'),
(27, 'm004', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'marketing', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:32:07.40031', 'job_logo_1.jpg'),
(28, 'm005', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'marketing', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:32:10.49100', 'job_logo_1.jpg'),
(29, 'm006', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'marketing', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:32:12.01193', 'job_logo_1.jpg'),
(30, 'm007', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'marketing', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:32:15.59040', 'job_logo_1.jpg'),
(34, 'j001', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'bangking', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:29:50.81763', 'job_logo_1.jpg'),
(35, 'j002', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'bangking', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:29:50.92730', 'job_logo_1.jpg'),
(36, 'j003', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'bangking', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:29:51.01606', 'job_logo_1.jpg'),
(37, 'j004', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'bangking', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:29:51.07195', 'job_logo_1.jpg'),
(38, 'j005', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'bangking', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:32:18.78881', 'job_logo_1.jpg'),
(39, 'j006', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'bangking', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:32:20.54116', 'job_logo_1.jpg'),
(40, 'j007', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'bangking', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:32:22.53379', 'job_logo_1.jpg'),
(41, 'j008', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'bangking', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:32:25.12486', 'job_logo_1.jpg'),
(42, 'j009', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'bangking', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:32:26.86026', 'job_logo_1.jpg'),
(43, 'j010', 'j-bangking', 'AGM', 'part-time', 'dhaka', 'bangking', 3, 4, 20000, 'dexxxxxxx', '2020-05-17 06:32:29.48620', 'job_logo_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `usertype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `username`, `email`, `password`, `usertype`) VALUES
(9, '', '', '', ''),
(10, '', '', '', ''),
(11, '', '', '', ''),
(12, 'admin', 'admin@job.com', '$2y$10$apNi.yW9YThkIcGFFT654uYxneEUajYK1KlivgDwfsiOMhvzFqNou', 'admin'),
(13, 'admin2', 'admin2@job.com', '$2y$10$0z0xB8Ghb8zwkAI1SEu64OosyW5coNN.WtZw5hlOapVGWjpkY1XFu', 'admin'),
(14, 'adidas', 'adidas@adidas.com', '$2y$10$X0bKsmZhFWYIIGGJH80Mh.pTJ/wnW8YZN.jIbjEaulzwtl9uYtfwe', 'employer'),
(15, 'aiub', 'aiub@aiub.edu', '$2y$10$oiNruEuDU06PsSqBFwyCAuY1yDSWC8aiF36rerKlA4.3mZEeRf/6q', 'employer'),
(16, 'inc', 'inc@inc.ltd', '$2y$10$lsr8qRPQQXz3GdAeB2.pse1yVNKMa0AOCf4Hd7Q/TzWOIk1N46JDy', 'employer'),
(17, 'ayon', 'ayon@aiub.edu', '$2y$10$nSLj/alRaIPdPk4kC4nr7.Nd5880uH1/4dnJB6NkFajkrf3IHwOJO', 'seeker'),
(18, 'belle', 'belle@abc.com', '$2y$10$67bH2kZiJL9ApuvNRackY.F.d47ZFmJceTxDblRcmTpjVbPF1w2FC', 'seeker'),
(19, 'abc', 'abc@abc.abc', '$2y$10$A9ZY29jUOkk415D7oma.CeVm5JP1Gx2bqEJetuL..V70UTCgk96D.', 'seeker'),
(20, 'xyz', 'xyz@gmail.com', '$2y$10$1/AlE.t42vBcNIrIet1Ige4Ok.Pq6BaTXGjzWMSPPEaP0y1Xp.fca', 'employer'),
(22, 'aaa', 'aaa@gmail.com', '$2y$10$YsscXftOP20egeRjO0FNxOaiFES6dUyw2ZE5OqTIOaISLKLhHZSDu', 'seeker'),
(23, 'www', 'www@gmail.com', '$2y$10$exeW8jB/.KHDsvlrevtBueD1fC6E6H7SIXGm7HBKqFnlKWCcsTzcq', 'employer'),
(24, 'qqqqqq', 'q@g', '$2y$10$S8ADZZMdJmIY3cKyGT4kquhn6oyLn9RdRXI3jhnYzXvdXzkd60Hii', 'seeker'),
(25, 'ami', 'ami@ami.com', '$2y$10$ytD40OkTabcnj82FyfoNteObaLKiOeo8HB.GWxOhRV298lNy5HQN6', 'employer'),
(26, 'ama', 'ama@ama.com', '$2y$10$TPsyYAjlFoN8SgibyrE6jeTt7IP0HN.obHwVIwG8fFNADGFZRxkjO', 'employer'),
(27, 'zrsaimun', 'zrsaimun@gmail.com', '$2y$10$gCl9Pme8FMKGlJrl88WVlO0OCTyTbewjy5R7iG6D2dS4Fgcocij0a', 'seeker'),
(28, 'abul', 'abul@gmail.com', '$2y$10$5cYw1zmVGRWkSO19HUz92OS6bqV9zjwOlp9zph/a1/I5U0b1Y5Zcy', 'seeker'),
(29, 'jojo', 'jon@gmail.com', '$2y$10$Q7/HH1lIJgpCNU54cdd06.0BjrASIyLKct6wAnRQ1EeSmRygPihiq', 'employer');

-- --------------------------------------------------------

--
-- Table structure for table `org`
--

CREATE TABLE `org` (
  `ID` int(10) NOT NULL,
  `userID` int(5) NOT NULL,
  `email` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `contact` int(20) NOT NULL,
  `location` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `license` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seeker`
--

CREATE TABLE `seeker` (
  `ID` int(10) NOT NULL,
  `userID` int(5) NOT NULL,
  `email` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seekerappliedjobs`
--

CREATE TABLE `seekerappliedjobs` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `appliedJobs` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seekerappliedjobs`
--

INSERT INTO `seekerappliedjobs` (`id`, `email`, `appliedJobs`) VALUES
(1, 's@gmail.com', 'j006;16-05-20,j003;16-05-20,j007;16-05-20,j001;16-05-20,j009;16-05-20,m004;16-05-20,m002;16-05-20,m007;16-05-20,it001;16-05-20,'),
(2, 'mun@gmail.com', 'dv001;24-04-20,brb001;24-04-20,lf001;24-04-20,'),
(3, 'abc@abc.abc', 'dv001;24-04-20,j003;16-05-20,j002;16-05-20,m007;16-05-20,'),
(5, 'aaa@gmail.com', 'j008;16-05-20,j003;16-05-20,m006;16-05-20,j002;17-05-20,'),
(6, 'q@g', ''),
(7, 'zrsaimun@gmail.com', ''),
(8, 'abul@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `seekereducation`
--

CREATE TABLE `seekereducation` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `history` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seekereducation`
--

INSERT INTO `seekereducation` (`id`, `email`, `history`) VALUES
(1, 's@gmail.com', '2010-2013;SSC;JC High School,2013-2015;HSC;Agricultural University College,2015-2019;Bsc in CSE;American International University Bangladesh (AIUB),1111-2222;dfdsf;dvfgdfg,1111-2222;MAnager;dsfdsgdgd,1111-2222;mmmmm;xgdfgdfsgdfg,'),
(2, 'mun@gmail.com', ''),
(3, 'abc@abc.abc', '2015-2019;cse;aiub,2222-3333;msc;nsu,'),
(5, 'aaa@gmail.com', '6554-5465;dfgdfsg;vcbvxcxvcn,'),
(6, 'q@g', ''),
(7, 'zrsaimun@gmail.com', ''),
(8, 'abul@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `seekerinfo`
--

CREATE TABLE `seekerinfo` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cgpa` float NOT NULL,
  `experience` float NOT NULL,
  `salary` int(11) NOT NULL,
  `aboutMe` varchar(50000) NOT NULL,
  `title` varchar(50) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `linkedin` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `projects` varchar(500) NOT NULL,
  `age` int(10) NOT NULL,
  `website` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `google` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `picture` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seekerinfo`
--

INSERT INTO `seekerinfo` (`id`, `email`, `name`, `cgpa`, `experience`, `salary`, `aboutMe`, `title`, `facebook`, `linkedin`, `twitter`, `projects`, `age`, `website`, `phone`, `city`, `address`, `google`, `gender`, `file_name`, `picture`) VALUES
(1, 's@gmail.com', 'saimun md', 3.8, 3, 30000, 'about meeeeeeeeeeeeeeeee1', 'ios Developerr', 'https://www.facebook.com/saimun md', 'https://www.linkedin.com/saimun md', 'https://www.twitter.com/saimun md', 'project1', 24, 'saimun md', '12345678911', 'Sylhet', 'basundharaa R/A', 'https://www.googleplus.com/saimun md', 'Male', 'CORE_CV_template_1.doc', 'index.jpg'),
(2, 'mun@gmail.com', 'Zr Saimun', 4, 2, 30000, 'sdfhisodf fdsi fsidf sdfsd fiosd fids fiosdf sdfsdiof siod fiodsfiods fiosd iodfio sdiofsdiof siod iods fios fiods fiods fiodsj fio dsfiodsjfiods fiosd fiods fiods fiosjfiosd jfiodsj fiods fiodsjfiodsfiosjfios f.', 'Web Developer', 'https://www.facebook.com/zr.saimun', 'https://www.linkedin.com/zr.saimun', 'https://www.twitter.com/zr.saimun', 'project1', 25, 'zr.saimun', ' +88001912345678', 'Sylhet', 'basundhara R/A', 'https://www.googleplus.com/zr.saimun', 'Male', '', ''),
(3, 'ddd@gmail.com', 'DDD Ahmed', 3.75, 4, 50000, '', '', '', '', '', '', 0, '', '', '', '', '', '', '', ''),
(4, 'abc@abc.abc', 'abc', 3, 3, 20000, 'about me eerewrewrewrr. werwerwerewr', 'ios Developer', 'https://www.facebook.com/abc', 'https://www.linkedin.com/abc', 'https://www.twitter.com/aabc', 'project1aa', 24, 'www.abc.com', '01234567891', 'Sylhet', 'basundhara R/A', 'https://www.googleplus.com/abc', 'Male', 'ss.pdf', ''),
(5, 'aaa@gmail.com', 'sdfdsfdsf', 3.9, 3.5, 50000, 'ddfgfdgdfg', 'sdfadsfdsaf', '', '', 'https://www.twitter.com/aaaa', '', 25, 'www.aaa.com', '11111111111', 'asdfdsaf', 'dsfadsf', '', 'Male', 'aaaa.pdf', 'emp1.jpg'),
(6, 'q@g', 'qqqqqqqqqqqqqqq', 0, 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '', ''),
(7, 'zrsaimun@gmail.com', 'md saimun', 0, 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '', ''),
(8, 'abul@gmail.com', 'mr abul', 0, 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `seekerskill`
--

CREATE TABLE `seekerskill` (
  `id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `skill` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seekerskill`
--

INSERT INTO `seekerskill` (`id`, `email`, `skill`) VALUES
(1, 's@gmail.com', 'Java;90,PHP;75,C#;80,Js;75,ruby;70,Kotlin;60,A;60,W;2,q;1,t;22,swimming;50,'),
(2, 'mun@gmail.com', ''),
(3, 'abc@abc.abc', 'php;75,java;95,'),
(5, 'aaa@gmail.com', 'php;85,'),
(6, 'q@g', ''),
(7, 'zrsaimun@gmail.com', ''),
(8, 'abul@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `seekerworkexperience`
--

CREATE TABLE `seekerworkexperience` (
  `id` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `history` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seekerworkexperience`
--

INSERT INTO `seekerworkexperience` (`id`, `email`, `year`, `designation`, `description`, `history`) VALUES
(1, 's@gmail.com', 'a', 'a', 'a', '2010-2012;Manager;JOb Descriptionnnnn,2015-2017;AGM;JOb DescriptionnnnnAGM,2222-3333;Manannanaa;sffsffsfsafafsfafafafsfasdf,'),
(3, 'mun@gmail.com', '', '', '', ''),
(4, 'abc@abc.abc', '', '', '', '2015-2018;MAnager;tiger it,1111-2222;agm;sssss,'),
(6, 'aaa@gmail.com', '', '', '', '3453-5345;sdfd;cvbcvb,'),
(7, 'q@g', '', '', '', ''),
(8, 'zrsaimun@gmail.com', '', '', '', ''),
(9, 'abul@gmail.com', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `adminID` (`userID`) USING BTREE;

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `orgID` (`userID`);

--
-- Indexes for table `expire`
--
ALTER TABLE `expire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `org`
--
ALTER TABLE `org`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `orgID` (`userID`);

--
-- Indexes for table `seeker`
--
ALTER TABLE `seeker`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `seekerID` (`userID`);

--
-- Indexes for table `seekerappliedjobs`
--
ALTER TABLE `seekerappliedjobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seekereducation`
--
ALTER TABLE `seekereducation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seekerinfo`
--
ALTER TABLE `seekerinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seekerskill`
--
ALTER TABLE `seekerskill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seekerworkexperience`
--
ALTER TABLE `seekerworkexperience`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expire`
--
ALTER TABLE `expire`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `org`
--
ALTER TABLE `org`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seeker`
--
ALTER TABLE `seeker`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seekerappliedjobs`
--
ALTER TABLE `seekerappliedjobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seekereducation`
--
ALTER TABLE `seekereducation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seekerinfo`
--
ALTER TABLE `seekerinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seekerskill`
--
ALTER TABLE `seekerskill`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seekerworkexperience`
--
ALTER TABLE `seekerworkexperience`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `adminID` FOREIGN KEY (`userID`) REFERENCES `admin` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `org`
--
ALTER TABLE `org`
  ADD CONSTRAINT `orgID` FOREIGN KEY (`userID`) REFERENCES `login` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seeker`
--
ALTER TABLE `seeker`
  ADD CONSTRAINT `seekerID` FOREIGN KEY (`userID`) REFERENCES `login` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
