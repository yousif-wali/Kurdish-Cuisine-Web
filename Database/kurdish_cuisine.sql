-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2025 at 10:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kurdish_cuisine`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `Id` int(11) NOT NULL,
  `Username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Post_Id` int(11) DEFAULT NULL,
  `Comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `Files`
--

CREATE TABLE `Files` (
  `Id` int(11) NOT NULL,
  `Post_Id` int(11) DEFAULT NULL,
  `Filename` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Files`
--


-- --------------------------------------------------------

--
-- Table structure for table `Likes`
--

CREATE TABLE `Likes` (
  `Id` int(11) NOT NULL,
  `Username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Post_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE `Posts` (
  `ID` int(11) NOT NULL,
  `Username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `PublishDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Posts`
--

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password` text DEFAULT NULL,
  `Email` text DEFAULT NULL,
  `Gender` enum('Male','Female') DEFAULT NULL,
  `Role` enum('Regular','Admin') DEFAULT NULL,
  `LastOnline` date DEFAULT current_timestamp(),
  `SignedUpDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Post_Id` (`Post_Id`),
  ADD KEY `Comments_Username_Users_Username` (`Username`);

--
-- Indexes for table `Files`
--
ALTER TABLE `Files`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Post_Id` (`Post_Id`);

--
-- Indexes for table `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `unique_user_post_like` (`Username`,`Post_Id`),
  ADD KEY `Post_Id` (`Post_Id`),
  ADD KEY `Likes_Username_Users_Username` (`Username`);

--
-- Indexes for table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Posts_Username_Users_Username` (`Username`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Files`
--
ALTER TABLE `Files`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `Likes`
--
ALTER TABLE `Likes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_Username_Users_Username` FOREIGN KEY (`Username`) REFERENCES `Users` (`Username`),
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`Post_Id`) REFERENCES `Posts` (`ID`);

--
-- Constraints for table `Files`
--
ALTER TABLE `Files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`Post_Id`) REFERENCES `Posts` (`ID`);

--
-- Constraints for table `Likes`
--
ALTER TABLE `Likes`
  ADD CONSTRAINT `Likes_Username_Users_Username` FOREIGN KEY (`Username`) REFERENCES `Users` (`Username`),
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`Post_Id`) REFERENCES `Posts` (`ID`);

--
-- Constraints for table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `Posts_Username_Users_Username` FOREIGN KEY (`Username`) REFERENCES `Users` (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
