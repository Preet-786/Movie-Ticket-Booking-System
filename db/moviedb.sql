-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 07:51 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `movielist`
--

CREATE TABLE `movielist` (
  `movieId` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Genre` varchar(25) DEFAULT NULL,
  `Director` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `imdb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movielist`
--

INSERT INTO `movielist` (`movieId`, `Name`, `Genre`, `Director`, `Description`, `image`, `imdb`) VALUES
(1, 'Batman Begins', 'Action', 'Christopher Nolan', 'A young Bruce Wayne (Christian Bale) travels to the Far East, where he\'s trained in the martial arts by Henri Ducard (Liam Neeson), a member of the mysterious League of Shadows. ', 'batman.jpg', '9.5'),
(2, 'Spider-Man: Homecoming (2017)', 'Adventure', 'Jon Watts', 'Thrilled by his experience with the Avengers, young Peter Parker returns home to live with his Aunt May. Under the watchful eye of mentor Tony Stark, Parker starts to embrace his newfound identity as Spider-Man.', 'spiderman.jpg', '8.5'),
(5, 'Star Wars', 'Adventure', 'George Lucas', 'Star Wars is an American epic space opera franchise, centered on a film series created by George Lucas. It depicts the adventures of various characters \"a long time ago in a galaxy far, far away\"', 'starwars.png', '9'),
(10, 'Godzilla', 'Adventure', 'Mr.x', 'Godzilla is an enormous, destructive, prehistoric sea monster awakened and empowered by nuclear radiation.', 'download.jpg', '8.1'),
(11, 'Roohi', 'Comedy', 'Hardik Mehta', 'Horror and comedy mixture movie', 'roohi.jpg', '3.2'),
(12, 'Sooryavanshi', 'Action', 'Rohit Shetty', 'Sooryavanshi is an upcoming Indian Hindi-language action film directed by Rohit Shetty and produced by Reliance Entertainment, Rohit Shetty Picturez, Dharma Productions and Cape of Good Films. The screenplay is given by Yunus Sajawal based on an original ', 'su3.jpeg', '8.1'),
(13, 'KGF Chapter 2', 'Action', 'Prashanth Neel', 'K.G.F: Chapter 2 is an upcoming Indian Kannada-language period action film written and directed by Prashanth Neel and produced by Vijay Kiragandur under the banner Hombale Films. ', 'kgf2.jpg', '9.1'),
(14, 'Major', 'Action', 'Mr x', 'Major is an upcoming Indian biographical film directed by Sashi Kiran Tikka and produced by Sony Pictures, G. Mahesh Babu Entertainment and A+S Movies. Shot simultaneously in Telugu and Hindi and later dubbed into Malayalam, it is based on the life of 200', 'Major_The_Film.jpg', '9.2');

-- --------------------------------------------------------

--
-- Table structure for table `showorder`
--

CREATE TABLE `showorder` (
  `showOrderId` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `timeslot` varchar(255) NOT NULL,
  `theater` varchar(255) NOT NULL,
  `movieName` varchar(255) NOT NULL,
  `seat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showorder`
--

INSERT INTO `showorder` (`showOrderId`, `date`, `timeslot`, `theater`, `movieName`, `seat`) VALUES
(12, '2021-04-14', '18', 'Basundhara Cineplex', 'Batman Begins', '49'),
(13, '2021-04-15', '18', 'Basundhara Cineplex', 'Spider-Man: Homecoming (2017)', '48'),
(14, '2021-04-15', '18', 'Basundhara Cineplex', 'Godzilla', '49'),
(15, '2021-04-12', '9', 'Basundhara Cineplex', 'Batman Begins', '50'),
(20, '2021-04-28', '12', 'cinepolis', 'Major', '49'),
(21, '2021-04-27', '9', 'BlockBluster', 'Major', '49'),
(22, '2021-05-13', '9', 'Basundhara Cineplex', 'Spider-Man: Homecoming (2017)', '50'),
(23, '2021-05-13', '9', 'Basundhara Cineplex', 'Batman Begins', '50'),
(24, '2021-05-07', '9', 'Basundhara Cineplex', 'Batman Begins', '50'),
(25, '2021-04-27', '9', 'BlockBluster', 'Batman Begins', '50'),
(26, '2021-04-27', '9', 'Basundhara Cineplex', 'Batman Begins', '50'),
(27, '2021-05-19', '9', 'Basundhara Cineplex', 'Batman Begins', '50'),
(28, '2021-05-06', '9', 'Basundhara Cineplex', 'Batman Begins', '50'),
(29, '2021-05-08', '9', 'Basundhara Cineplex', 'Batman Begins', '50'),
(30, '2021-05-26', '9', 'Basundhara Cineplex', 'Batman Begins', '50'),
(31, '2020-06-05', '9', 'Basundhara Cineplex', 'Batman Begins', '50'),
(32, '2021-05-14', '9', 'Basundhara Cineplex', 'Batman Begins', '50'),
(33, '2021-05-12', '9', 'Basundhara Cineplex', 'Batman Begins', '50'),
(34, '2021-04-09', '9', 'BlockBluster', 'Batman Begins', '50'),
(35, '2021-04-15', '18', 'Basundhara Cineplex', 'Batman Begins', '50'),
(36, '2021-04-15', '15', 'Basundhara Cineplex', 'Batman Begins', '50'),
(37, '2021-04-28', '18', 'cinepolis', 'Batman Begins', '49'),
(38, '2021-04-27', '18', 'BlockBluster', 'Godzilla', '48');

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE `theater` (
  `theaterId` int(11) NOT NULL,
  `theaterName` varchar(255) DEFAULT NULL,
  `seat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theater`
--

INSERT INTO `theater` (`theaterId`, `theaterName`, `seat`) VALUES
(1, 'Basundhara Cineplex', 50),
(2, 'BlockBluster', 45),
(3, 'Balaka Cineplex', 60),
(4, 'Shamoly Cineplex', 70),
(7, 'Cineplex', 53),
(8, 'cinepolis', 65);

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `timeslotId` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Theatre` varchar(250) NOT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`timeslotId`, `time`, `Name`, `Theatre`, `Date`) VALUES
(3, '18', 'Batman Begins', 'Basundhara Cineplex', '2021-04-15'),
(24, '9', 'KGF Chapter 2', 'Cineplex', '2021-04-27'),
(26, '12', 'KGF Chapter 2', 'Cineplex', '2021-04-27'),
(28, '9', 'Sooryavanshi', 'BlockBluster', '2021-04-27'),
(29, '12', 'Roohi', 'BlockBluster', '2021-04-27'),
(30, '15', 'KGF Chapter 2', 'BlockBluster', '2021-04-27'),
(31, '18', 'Godzilla', 'BlockBluster', '2021-04-27'),
(32, '9,12', 'Major', 'cinepolis', '2021-04-28'),
(33, '15', 'Star Wars', 'cinepolis', '2021-04-28'),
(34, '18', 'Batman Begins', 'cinepolis', '2021-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `trailer`
--

CREATE TABLE `trailer` (
  `Id` int(11) NOT NULL,
  `movieName` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trailer`
--

INSERT INTO `trailer` (`Id`, `movieName`, `link`) VALUES
(1, 'Batman Begins', 'https://www.youtube.com/watch?v=neY2xVmOfUM'),
(2, 'Spider-Man: Homecoming (2017)', 'https://www.youtube.com/watch?v=n9DwoQ7HWvI'),
(4, 'Star Wars', 'https://youtu.be/8Qn_spdM5Zg'),
(7, 'Godzilla', 'https://www.youtube.com/watch?v=vIu85WQTPRc'),
(8, 'Roohi', 'https://www.youtube.com/watch?v=mTT_V0t89MI'),
(9, 'Sooryavanshi', 'https://www.youtube.com/watch?v=u5r77-OQwa8'),
(10, 'KGF Chapter 2', 'https://youtu.be/Qah9sSIXJqk'),
(11, 'Major', 'https://youtu.be/UoM42huMhP0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `password`, `status`) VALUES
(1, 'admin', 'admin', 101),
(3, 'user', 'user', 202);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movielist`
--
ALTER TABLE `movielist`
  ADD PRIMARY KEY (`movieId`);

--
-- Indexes for table `showorder`
--
ALTER TABLE `showorder`
  ADD PRIMARY KEY (`showOrderId`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`theaterId`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`timeslotId`);

--
-- Indexes for table `trailer`
--
ALTER TABLE `trailer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movielist`
--
ALTER TABLE `movielist`
  MODIFY `movieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `showorder`
--
ALTER TABLE `showorder`
  MODIFY `showOrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `theater`
  MODIFY `theaterId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `timeslotId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `trailer`
--
ALTER TABLE `trailer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
