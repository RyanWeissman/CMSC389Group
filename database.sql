-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 26, 2018 at 10:02 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `wall_information`
--

-- --------------------------------------------------------

--
-- Table structure for table `climbs`
--

CREATE TABLE `climbs` (
  `name` varchar(50) NOT NULL,
  `grade` int(11) NOT NULL,
  `color` varchar(20) NOT NULL,
  `setter` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `location` tinyint(4) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `climbs`
--

INSERT INTO `climbs` (`name`, `grade`, `color`, `setter`, `date`, `location`, `image`) VALUES
('Climb 2', 7, 'Green', 'Bob', '2018-11-26', 4, 'test2.jpg'),
('Climb1', 4, 'Blue', 'Ryan W.', '2018-10-29', 4, 'test.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `name` varchar(50) NOT NULL,
  `user` varchar(100) NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`name`, `user`, `grade`) VALUES
('Climb1', 'test user 1', 3),
('Climb1', 'Test user 2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `admin`) VALUES
('weissman@umd.edu', 'password', 1);

-- --------------------------------------------------------

--
-- Table structure for table `walls`
--

CREATE TABLE `walls` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `climbs`
--
ALTER TABLE `climbs`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `walls`
--
ALTER TABLE `walls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);
