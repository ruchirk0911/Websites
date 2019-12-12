-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2016 at 01:19 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cheapbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `ssn` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`ssn`, `name`, `address`, `phone`) VALUES
('004-18-1954', 'Stephen King', 'Chicago, IL, USA', '6822545887'),
('305-24-1415', 'Rameez Elmasri', 'Arlington, TX, USA', '6854521456'),
('445-46-2374', 'J.K.Rowling', 'San Jose, CA, USA', '6548956412'),
('482-86-7957', 'William Shakespeare', 'Austin, TX, USA', '6855647589'),
('579-11-2374', 'David Kung', 'Dallas, TX, USA', '6822568522');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ISBN` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `year` date NOT NULL,
  `price` float NOT NULL,
  `Publisher` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ISBN`, `title`, `year`, `price`, `Publisher`) VALUES
('9972108597', 'Hamlet', '1998-04-10', 250, 'TMH'),
('9992234636', 'Romeo and Juliet', '1996-05-01', 300, 'TMH'),
('9992241691', 'Mr. Mercedes', '2014-06-15', 499.99, 'ThomasReuters'),
('9992247592', 'Harry Potter- 2', '2001-08-18', 700, 'Pearson'),
('9992270764', 'Agile Methodology', '2010-07-16', 320.99, 'Wolters Kluwer'),
('9992277408', 'Under the dome', '2009-04-24', 839.99, 'ThomsonReuters'),
('9992277409', 'Fundamentals of Databases', '2005-05-11', 399.99, 'Wiley'),
('9992280492', 'Harry Potter - 1', '1996-11-26', 500, 'Pearson');

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `ISBN` varchar(30) NOT NULL,
  `BasketID` varchar(13) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `username` varchar(10) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`username`, `address`, `email`, `phone`, `password`) VALUES
('user1', '404, Border Apts, Arlington- 76019', 'user1@gmail.com', '1234567890', '24c9e15e52afc47c225b757e7bee1f9d'),
('user2', '1000 W.Mitchell, Arlington- 76013', 'user2@gmail.com', '4567891230', '7e58d63b60197ceb55a1c487989a3720'),
('user3', '1895 W.Mitchell, Arlington- 76013', 'user3@gmail.com', '7894561230', '92877af70a45fd6a2ed7fe81e1236b78'),
('user4', '925 Benge Dr, Arlington, TX- 76013', 'user4@gmail.com', '4516516466', '3f02ebe3d7929b091e3d8ccfde2f3bc6');

-- --------------------------------------------------------

--
-- Table structure for table `shippingorder`
--

CREATE TABLE `shippingorder` (
  `isbn` varchar(30) NOT NULL,
  `warehousecode` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shoppingbasket`
--

CREATE TABLE `shoppingbasket` (
  `basketId` varchar(13) NOT NULL,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoppingbasket`
--

INSERT INTO `shoppingbasket` (`basketId`, `username`) VALUES
('58393f93d5ae4', 'user1'),
('583f2b2ced482', 'user2'),
('583f2b5d9c170', 'user3'),
('584528c8e6810', 'user4');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `isbn` varchar(30) NOT NULL,
  `warehousecode` int(20) NOT NULL,
  `number` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`isbn`, `warehousecode`, `number`) VALUES
('9972108597', 12345, 100),
('9972108597', 12346, 100),
('9972108597', 12347, 100),
('9972108597', 12348, 100),
('9992234636', 12345, 100),
('9992234636', 12346, 100),
('9992234636', 12347, 100),
('9992234636', 12348, 100),
('9992241691', 12345, 100),
('9992241691', 12346, 100),
('9992241691', 12347, 100),
('9992241691', 12348, 100),
('9992247592', 12345, 100),
('9992247592', 12346, 100),
('9992247592', 12347, 100),
('9992247592', 12348, 100),
('9992270764', 12345, 100),
('9992270764', 12346, 100),
('9992270764', 12347, 100),
('9992270764', 12348, 100),
('9992277408', 12345, 100),
('9992277408', 12346, 100),
('9992277408', 12347, 100),
('9992277408', 12348, 100),
('9992277409', 12345, 100),
('9992277409', 12346, 100),
('9992277409', 12347, 100),
('9992277409', 12348, 100),
('9992280492', 12345, 100),
('9992280492', 12346, 100),
('9992280492', 12347, 100),
('9992280492', 12348, 100);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `Warehousecode` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`Warehousecode`, `name`, `address`, `phone`) VALUES
(12345, 'Warehouse1', 'Chicago', '9895475889'),
(12346, 'Warehouse2', 'Arlington', '6856847585'),
(12347, 'Warehouse3', 'Dallas', '9854562546'),
(12348, 'Warehouse4', 'Miami', '8654123545');

-- --------------------------------------------------------

--
-- Table structure for table `writtenby`
--

CREATE TABLE `writtenby` (
  `ssn` varchar(20) NOT NULL,
  `isbn` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `writtenby`
--

INSERT INTO `writtenby` (`ssn`, `isbn`) VALUES
('004-18-1954', '9992241691'),
('004-18-1954', '9992277408'),
('305-24-1415', '9992277409'),
('445-46-2374', '9992247592'),
('445-46-2374', '9992280492'),
('482-86-7957', '9972108597'),
('482-86-7957', '9992234636'),
('579-11-2374', '9992270764');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ssn`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `contains`
--
ALTER TABLE `contains`
  ADD PRIMARY KEY (`ISBN`,`BasketID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `shoppingbasket`
--
ALTER TABLE `shoppingbasket`
  ADD PRIMARY KEY (`basketId`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`isbn`,`warehousecode`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`Warehousecode`);

--
-- Indexes for table `writtenby`
--
ALTER TABLE `writtenby`
  ADD PRIMARY KEY (`ssn`,`isbn`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
